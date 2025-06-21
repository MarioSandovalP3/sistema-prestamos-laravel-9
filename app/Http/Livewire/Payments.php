<?php

namespace App\Http\Livewire;

use App\Models\Loan;
use App\Models\Company;
use App\Models\Payment;
use App\Models\Partner;
use Livewire\Component;
use Livewire\WithPagination;
use App\Mail\MessagePaymentVoucher;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Intervention\Image\Exception\NotReadableException;

/**
 * Gestión de pagos de préstamos
 *
 * @property int $loanId ID del préstamo asociado
 * @property float $to_pay Monto del pago
 * @property string $payment_method Método de pago
 */
class Payments extends Component
{
    use WithPagination;
    public $loans,$loanName,$loanId,$date, $to_pay,$note, $num_pay,$selected_id, $pageTitle, $componentName;
    public $payment_method,$email_verification,$paymentId,$paymentName;
	private $pagination = 25;

    public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Pagos';
        $this->loans = [];
        $this->loanId = "Seleccione";
        $this->paymentId = 'Seleccione';
        
    }

    public function paginationView()
    {
        return 'livewire.pagination';
    }



    /**
     * @return \Illuminate\View\View
     *
     * - Lista paginada de pagos (25 items)
     * - Carga préstamos pendientes para selección
     */
    public function render()
    {
        
        $payments = Payment::orderBy('id','desc')->paginate($this->pagination);
        $this->loans = Loan::where('status','Pendiente')->orderBy("num_loan", "desc")->get();

        return view('livewire.payments.component',['payments' => $payments])
        ->extends('layouts.theme.app')
        ->section('content');

    }

    /**
     * Registra nuevo pago
     *
     * - Calcula saldos y estados
     * - Actualiza préstamo y cliente asociados
     * @event payment-added|payment-error Resultado
     */
    public function Store(){
        
    	$rules = [
    		'loanId' => 'required|not_in:Seleccione',
    		'date' => 'required|date',
            'to_pay' => 'required|numeric',
            'paymentId' => 'required|not_in:Seleccione',
    	];
    	$messages = [
            'loanId.required' => 'Requerido',
    		'loanId.not_in' => 'Requerido',
            'date.required' => 'Requerido',
            'date.date' => 'Fecha incorrecta',
            'to_pay.required' => 'Requerido',
            'to_pay.numeric' => 'Solo números',
            'paymentId.required' => 'Requerido',
    		'paymentId.not_in' => 'Requerido',

    	];

    	$this->validate($rules,$messages);
        $loan = Loan::where('id',$this->loanId)->first();
        $num_pay = Payment::where('loan_id',$this->loanId)->count();
        $num_pay_to_loan = Payment::where('loan_id',$this->loanId)
        ->where('status','Registrado')
        ->count();
        $partner = Partner::where('id',$loan->partner_id)->first();


        $num_pay_total = $num_pay + 1;
        $num_pay_total_loan = $num_pay_to_loan + 1;

        $sum_pay = Payment::where('loan_id', $this->loanId)
        ->where('status','Registrado')
        ->sum('to_pay');
        $total_pay_payment = $sum_pay + $this->to_pay;
        try { 
 
            $total_pay = $loan->total_pay + $this->to_pay;
         
            if($total_pay_payment > $loan->loan_amount){
                $earnings = $loan->total_to_pay - $loan->loan_amount;
            }else{
                $earnings = 0 ;
            }


            $debt = $loan->total_to_pay - $total_pay_payment;
            if($total_pay_payment >= $loan->total_to_pay  || $num_pay_total_loan == $loan->installments_total){
                $num_pay_to_loan = $loan->installments_total;
                $status = 'Pagado';
                $total_pay_payment = $loan->total_to_pay;
                $debt = 0;
            }else{
                $status = 'Pendiente';           
            }

            $payment = Payment::create([    
                'loan_id' => $this->loanId,
                'date' => $this->date,
                'to_pay' => $this->to_pay,
                'payment_method' => $this->paymentId,
                'note' => $this->note,
                'num_pay' => $num_pay_total,
                'remaining_payments' => $loan->installments_total - $num_pay_total,
                'total_pay' => $total_pay_payment,
                'debt' => $loan->total_to_pay - $total_pay_payment,
                'status' => 'Registrado'
            ]);
        
            $loan->update([
                'num_pay' => $num_pay_total_loan,
                'total_pay' => $total_pay_payment,
                'debt' =>  $debt,
                'earnings' => $earnings,
                'status' => $status
            ]);
            $partner->update([
                'debt' =>  $debt,
            ]);

        $this->resetUI();
        $this->emit('payment-added', 'Se ha registrado correctamente');
        } catch (NotReadableException $e) {
            $this->emit('payment-error',$e);
        }
    }

    protected $listeners = [
        'cancelPay' => 'cancelPay',
        'emailPDF' => 'emailPDF',
    ];

    /**
     * Anula pago existente
     *
     * - Recalcula saldos y estados
     * - Actualiza registros relacionados
     * @param Payment $payment Modelo inyectado
     * @event payment-deleted Confirmación
     */
    public function cancelPay(Payment $payment)
    {
        $loan = Loan::where('id',$payment->loan_id)->first();
        $num_pay = Payment::where('loan_id',$payment->loan_id)
        ->where('status','Registrado')
        ->count();

        if(($loan->total_pay - $payment->to_pay) < $loan->total_to_pay){
            $status = 'Pendiente';
        }else{
            $status = 'Pagado';
        }
        if(( $num_pay - 1) == 0){
            $total_pay = 0;
            $debt = $loan->total_to_pay;
        }else{
            $total_pay = $loan->total_pay - $payment->to_pay;
            $debt = $loan->total_to_pay - $total_pay;
        }

        $payment->update([
            'status' => 'Anulado',
        ]);

        $loan->update([
            'total_pay' => $total_pay,
            'debt' =>  $debt,
            'earnings' => 0,
            'status' => $status,
            'num_pay' => $num_pay - 1,

        ]);
        $partner = Partner::where('id',$loan->partner_id)->first();
        $partner->update([
            'debt' =>  $debt,
        ]);
        
        $this->resetUI();
        $this->emit('payment-deleted', 'Se ha anulado correctamente');
    }

    /**
     * Genera comprobante de pago en PDF
     *
     * @param int $id ID del pago
     * @return \Barryvdh\DomPDF\Facade\Pdf Stream PDF
     */
    public function voucherPDF($id)
    {
        // Obtener el pago junto con el préstamo asociado
        $payment = Payment::with('loan')->where('id', $id)->first();
        $num_pay_anul = Payment::where('loan_id',$payment->loan_id)
        ->where('status','Anulado')
        ->count();

        if (!$payment) {
            // Manejar el caso cuando no se encuentra el pago
            abort(404, 'Payment not found');
        }
    
        // Pasar los datos necesarios a la vista
        $data = [
            'payment' => $payment,
            'loan' => $payment->loan,
            "num_pay_anul" => $num_pay_anul,
            'partner' => $payment->loan->partner,
            'company' => Company::where('id', 1)->first(),
        ];
    
        // Generar el PDF
        $pdf = PDF::loadView('pdf.voucher', $data);
    
        return $pdf->stream('Voucher.pdf');
    }

    /**
     * Envía comprobante por email al cliente
     *
     * @param int $id ID del pago
     * @event payment-email|payment-error Resultado
     */
    public function emailVoucher($id)
    {
        
        // Obtener el pago junto con el préstamo asociado
        $payment = Payment::with('loan')->where('id', $id)->first();
        $company = Company::where('id', 1)->first();
        $num_pay_anul = Payment::where('loan_id',$payment->loan_id)
        ->where('status','Anulado')
        ->count();
        
        // Generar el PDF
        //$pdf = PDF::loadView('pdf.voucher', $data);
    
        // Guardar el PDF en el almacenamiento local
        //$pdfPath = storage_path('app/public/vouchers/voucher_email_' . $id . '.pdf');
        //$pdf->save($pdfPath);

        $recipientEmail = $payment->loan->partner->email;
        $msn_payment = [
            "company_ico" => $company->ico,
            "num_pay" => $payment->num_pay,
            "num_loan" => $payment->loan->num_loan,
            "date" => $payment->date,
            "to_pay" => $payment->to_pay,
            "payment_method" => $payment->payment_method,
            "total_pay" => $payment->loan->total_pay,
            "installments_total" => $payment->loan->installments_total,
            "remaining_payments" => $payment->remaining_payments,
            "num_pay_loan" => $payment->loan->num_pay,
            "num_pay_anul" => $num_pay_anul,
            "debt" => $payment->debt,
            "subject" => "Comprobante de pago",
            'partner' => $payment->loan->partner->name,
                ];

        try {
            
            Mail::to($recipientEmail)->send(new MessagePaymentVoucher($msn_payment)); 
            $payment->update([
                "email_verification" => "ENVIADO",
            ]);
            $this->emit("payment-email", "Correo enviado");
            //unlink($pdfPath);
        } catch (\Exception $e) {

            $payment->update([
                "email_verification" => "FALLIDO",
            ]);
            $this->emit("payment-error", "Envio de correo fallido");
        }    
    }
 
    public function resetUI(){
        $this->loanId = "Seleccione";
        $this->loans = [];
        $this->date = '';
        $this->to_pay = '';
        $this->note = '';
        $this->num_pay = '';
        $this->paymentId = 'Seleccione';
        $this->emit("reset-loan", "");
        $this->emit("reset-payment", "");
    	$this->resetValidation();  	
    }
}
