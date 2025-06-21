<?php

namespace App\Http\Livewire;
use Mail;
use Exception;
use App\Models\Loan;
use App\Models\Company;
use App\Models\Partner;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;
use App\Mail\MessageLoanAccepted;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Intervention\Image\Exception\NotReadableException;

/**
 * Gestión completa de préstamos financieros
 *
 * @property float $loan_amount Monto del préstamo
 * @property float $interest_rate_yearly Tasa anual
 * @property int $installments Número de cuotas
 * @property string $modality Modalidad (Meses/Años)
 * @property string $type_loan Tipo (AMORTIZABLE/INTERES FIJO/INTERES SIMPLE)
 */
class Loans extends Component
{
    use WithPagination;

    public $partners,$partnerName, $num_loan, $date, $loan_amount,$interest_rate_yearly, $interest_rate, $to_pay, $modality, $installments, $installments_total, $payment_frequency, $payment_type,$interest,$total_interest,$debt,$total_to_pay,$total_pay,$num_pay,$search, $selected_id, $pageTitle, $componentName,$num_loan_new,$final_payment,$note,$dates,$plazos,$type_loan;
	private $pagination = 25;

    public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Prestamos';

        $this->partners = [];
        $this->partnerId = "Seleccione";
        $this->modality = "Seleccione";
        $this->payment_frequency = "Seleccione";
        $this->payment_type = "Seleccione";
        $this->dates = [];
        $this->plazos = 0;
        $this->type_loan = "Seleccione";
        $this->selected_id = 0;
    }

    public function paginationView()
    {
        return 'livewire.pagination';
    }

    /**
     * Calcula términos del préstamo según tipo seleccionado
     *
     * - Convierte plazos según frecuencia de pago
     * - Calcula amortización/intereses según tipo
     * - Genera fechas de pago automáticas
     */
    public function cal_loan(){
        if($this->modality=='Meses'){
           
            if($this->payment_frequency=='Mensual'){ 
                $this->plazos = round((int)($this->installments ?? 0),0);    
                $this->installments_total = $this->plazos;
            }elseif($this->payment_frequency=='Quincenal'){
                $this->plazos = round((int)($this->installments ?? 0) * 26 / 12, 0);             
                $this->installments_total = $this->plazos;      
            }
        }
        else{
            if($this->payment_frequency=='Mensual'){
                $this->plazos = round((int)($this->installments ?? 0) * 12,0);
                $this->installments_total = $this->plazos;
             }elseif($this->payment_frequency=='Quincenal'){
                $this->plazos = round((int)($this->installments ?? 0) * 26, 0);              
                $this->installments_total = $this->plazos;
             }
        }

        
            $amount = (float)($this->loan_amount ?? 0);
            
            $nper = $this->installments_total;
                                
            if ($nper > 0) {                          
                if($this->type_loan=='AMORTIZABLE'){    
                    $this->interest_rate = ($this->payment_frequency == "Mensual") 
                    ? ((float)$this->interest_rate_yearly / 12) 
                    : ((float)$this->interest_rate_yearly / 26);
 
                    $rate = (float)($this->interest_rate / 100 ?? 0);
                           
                    if ($rate == 0) {
                        $pay = $amount / $nper; // Si la tasa de interés es 0, simplemente divide el monto entre el número de pagos
                    } else {
                        $pay = ($amount * $rate) / (1 - pow(1 + $rate, -$nper));
                    }
                    

                    $this->total_to_pay = $pay * $nper;
                    
                    $this->total_interest = ($pay * $nper) - $amount;
                    $this->interest = (($pay * $nper) - $amount) / $nper;
                    if($this->payment_type=='Pago Regular'){
                        $this->to_pay = $pay;
                        $this->final_payment = $pay;
                    }elseif($this->payment_type=='Interés + Prestamo al final'){
                        $this->to_pay = $this->interest;
                        $this->final_payment = $this->interest + $amount;
                        
                    }
                
                }
                elseif($this->type_loan=='INTERES FIJO'){
                    $this->interest_rate = ($this->payment_frequency == "Mensual") 
                    ? ((float)$this->interest_rate_yearly / $nper) 
                    : ((float)$this->interest_rate_yearly / $nper); 

                    $rate = (float)($this->interest_rate / 100 ?? 0);
                        $this->total_interest = (($amount * $rate)) * $nper;
                        $this->interest = (($amount * $rate));
                        $this->total_to_pay = $this->total_interest  + $amount;
                        
                        $pay = $this->total_to_pay / $nper;

                    if($this->payment_frequency=='Mensual'){     

                        if($this->payment_type=='Pago Regular'){
                            $this->to_pay = $pay;
                            $this->final_payment = $pay;
                        }else{
                            $this->to_pay = $this->interest;
                            $this->final_payment = $this->interest + $amount;
                        }
                    }else{

                        if($this->payment_type=='Pago Regular'){
                            $this->to_pay = $pay;
                            $this->final_payment = $pay;
                        }else{
                            $this->to_pay = $this->interest;
                            $this->final_payment = $this->interest + $amount;
                        }
                    }
                }
                elseif($this->type_loan=='INTERES SIMPLE'){
                    $this->interest_rate = ($this->payment_frequency == "Mensual") 
                    ? ((float)$this->interest_rate_yearly / $nper) 
                    : ((float)$this->interest_rate_yearly / $nper);  

                    $rate = (float)($this->interest_rate / 100 ?? 0);

                        
                        
                        
                        

                    if($this->payment_frequency=='Mensual'){    
                        $this->total_interest = ($amount * $rate * $nper / 12) * $nper;
                        $this->interest = ($amount * $rate * $nper / 12);
                        $this->total_to_pay = $this->total_interest  + $amount;
                        $pay = $this->total_to_pay / $nper;

                        if($this->payment_type=='Pago Regular'){
                            $this->to_pay = $pay;
                            $this->final_payment = $pay;
                        }else{
                            $this->to_pay = $this->interest;
                            $this->final_payment = $this->interest + $amount;
                        }
                    }else{
                        $this->total_interest = ($amount * $rate * $nper / 26) * $nper;
                        $this->interest = ($amount * $rate * $nper / 26);
                        $this->total_to_pay = $this->total_interest  + $amount;
                        $pay = $this->total_to_pay / $nper;

                        if($this->payment_type=='Pago Regular'){
                            $this->to_pay = $pay;
                            $this->final_payment = $pay;
                        }else{
                            $this->to_pay = $this->interest;
                            $this->final_payment = $this->interest + $amount;
                        }
                    }
                }


                }
            else {
                $this->total_to_pay = 0;
                $this->to_pay = 0;
            }
       


        
            if($this->payment_frequency=='Mensual'){
                $date = Carbon::parse($this->date); 

                for ($i = 1; $i <= $this->plazos; $i++) {
                    $this->dates[$i] = $date->copy()->addMonths($i)->format('Y-m-d');
                }
            }else{
                $date = Carbon::parse($this->date);

                for ($i = 1; $i <= $this->plazos; $i++) {
                    $this->dates[$i] = $date->copy()->addDays(15 * $i)->format('Y-m-d');
            }
            }
            

            




    }

    /**
     * @return \Illuminate\View\View
     *
     * - Lista paginada de préstamos
     * - Filtra clientes sin deuda (excepto en edición)
     * - Calcula próximo número de préstamo
     */
    public function render()
    {

        $this->cal_loan();

        
        $this->num_loan_new = Loan::count() + 1;

        $loans = Loan::orderBy('id','desc')->paginate($this->pagination);
      
        $editingPartnerId = $this->selected_id ? $this->partnerId : null;

        $this->partners = Partner::where('debt', '<=', 0)
            ->when($editingPartnerId, function ($query, $editingPartnerId) {
                return $query->orWhere('id', $editingPartnerId);
            })
            ->get();
        

        return view('livewire.loans.component',['loans' => $loans])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    /**
     * Registra nuevo préstamo
     *
     * - Valida datos requeridos
     * - Actualiza deuda del cliente
     * @event loan-added|loan-error Resultado de operación
     */
    public function Store(){
        
    	$rules = [
    		'partnerId' => 'required|not_in:Seleccione',
    		'date' => 'required|date',
            'type_loan' => 'required|not_in:Seleccione',
            'loan_amount' => 'required|numeric',
            'interest_rate_yearly' => 'required',
            'installments' => 'required|integer',
            'modality' => 'required|not_in:Seleccione',
            'payment_frequency' => 'required|not_in:Seleccione',
            'payment_type' => 'required|not_in:Seleccione',
    	];
    	$messages = [
            'partnerId.required' => 'Requerido',
    		'partnerId.not_in' => 'Requerido',
            'date.required' => 'Requerido',
            'date.date' => 'Fecha incorrecta',
            'type_loan.required' => 'Requerido',
            'type_loan.not_in' => 'Requerido',
            'loan_amount.required' => 'Requerido',
            'loan_amount.numeric' => 'Solo números',
            'interest_rate_yearly.required' => 'Requerido',
            'interest_rate_yearly.numeric' => 'Solo números',
            'installments.required' => 'Requerido',
            'installments.integer' => 'Solo enteros',
            'modality.required' => 'Requerido',
    		'modality.not_in' => 'Requerido',
            'payment_frequency.required' => 'Requerido',
    		'payment_frequency.not_in' => 'Requerido',
            'payment_type.required' => 'Requerido',
    		'payment_type.not_in' => 'Requerido',
    	];

    	$this->validate($rules,$messages);
        try { 
        $num_loan = Loan::count();
     
    	$loan = Loan::create([
    		'num_loan' => $num_loan + 1,
            'date' => $this->date,
            'type_loan' => $this->type_loan,
    		'partner_id' => $this->partnerId,
    		'loan_amount' => $this->loan_amount,
    		'interest_rate_yearly' => $this->interest_rate_yearly,
    		'interest_rate' => $this->interest_rate,
            'to_pay' => $this->to_pay,
            'modality' => $this->modality,
            'installments' => $this->installments,
            'installments_total' => $this->installments_total,
            'payment_dates' => json_encode($this->dates),
            'payment_frequency' => $this->payment_frequency,
            'payment_type' => $this->payment_type,
            'interest' => $this->interest,
            'total_interest' => $this->total_interest,
            'total_to_pay' => $this->total_to_pay,
            'final_payment' => $this->final_payment,
            'debt' => $this->total_to_pay,
            'note' => $this->note,
            'status' => 'Pendiente',
    	]);

        $partner = Partner::where('id',$this->partnerId)->first();
        $partner->update([
            'debt' => $this->total_to_pay,
        ]);



        $this->resetUI();
        $this->emit('loan-added', 'Préstamo registrado');
        } catch (NotReadableException $e) {
            $this->emit('loan-error',$e);
        }
    }

    

    /**
     * Prepara datos para edición
     *
     * @param int $id ID del préstamo
     * @event show-modal Dispara modal de edición
     */
    public function Edit($id)
    {
        $loan = Loan::with('partner')->find($id);
        

    
        if ($loan) {
            
            $this->selected_id = $loan->id;
            $this->num_loan = $loan->num_loan;
            $this->partnerId = $loan->partner_id;
            $this->type_loan = $loan->type_loan;
            $this->partnerName = $loan->partner->name;
            $this->date = Carbon::parse($loan->date)->format('Y-m-d');
            $this->loan_amount = $loan->loan_amount;
            $this->interest_rate_yearly = $loan->interest_rate_yearly;
            $this->installments = $loan->installments;
            $this->modality = $loan->modality;
            $this->debt = $loan->debt;
            $this->total_pay = $loan->total_pay;
            $this->payment_frequency = $loan->payment_frequency;
            $this->payment_type = $loan->payment_type;
            $this->num_pay = $loan->num_pay;
            $this->note = $loan->note;
            $this->emit("show-modal", "Show Modal!!");
            $this->emit("set-partner", $this->partnerName);

        }
    }
    


    /**
     * Actualiza préstamo existente
     *
     * - Recalcula términos si cambian datos clave
     * @event loan-updated|loan-error Resultado de operación
     */
    public function Update(){
        
    	$rules = [
    		'partnerId' => 'required|not_in:Seleccione',
    		'date' => 'required|date',
            'type_loan' => 'required|not_in:Seleccione',
            'loan_amount' => 'required|numeric',
            'interest_rate_yearly' => 'required|numeric',
            'installments' => 'required|integer',
            'modality' => 'required|not_in:Seleccione',
            'payment_frequency' => 'required|not_in:Seleccione',
            'payment_type' => 'required|not_in:Seleccione',
    	];
    	$messages = [
            'partnerId.required' => 'Requerido',
    		'partnerId.not_in' => 'Requerido',
            'date.required' => 'Requerido',
            'date.date' => 'Fecha incorrecta',
            'type_loan.required' => 'Requerido',
            'type_loan.not_in' => 'Requerido',
            'loan_amount.required' => 'Requerido',
            'loan_amount.numeric' => 'Solo números',
            'interest_rate_yearly.required' => 'Requerido',
            'interest_rate_yearly.numeric' => 'Solo números',
            'installments.required' => 'Requerido',
            'installments.integer' => 'Solo enteros',
            'modality.required' => 'Requerido',
    		'modality.not_in' => 'Requerido',
            'payment_frequency.required' => 'Requerido',
    		'payment_frequency.not_in' => 'Requerido',
            'payment_type.required' => 'Requerido',
    		'payment_type.not_in' => 'Requerido',
    	];

    	$this->validate($rules,$messages);
        
        try { 
            $loan = Loan::find($this->selected_id);
       
            $loan->update([
            'date' => $this->date,
    		'partner_id' => $this->partnerId,
            'type_loan' => $this->type_loan,
    		'loan_amount' => $this->loan_amount,
    		'interest_rate_yearly' => $this->interest_rate_yearly,
    		'interest_rate' => $this->interest_rate,
            'to_pay' => $this->to_pay,
            'modality' => $this->modality,
            'installments' => $this->installments,
            'installments_total' => $this->installments_total,
            'payment_dates' => json_encode($this->dates),
            'payment_frequency' => $this->payment_frequency,
            'payment_type' => $this->payment_type,
            'interest' => $this->interest,
            'total_interest' => $this->total_interest,
            'final_payment' => $this->final_payment,
            'total_to_pay' => $this->total_to_pay,
            'debt' => $this->total_to_pay,
            'note' => $this->note,
        ]);
        

        $this->resetUI();
        $this->emit('loan-updated', 'Prestamo Actualizado');
        } catch (NotReadableException $e) {
            $this->emit('loan-error',$e);
        }

    }

    protected $listeners = [
        'destroy' => 'Destroy',
        'emailPDF' => 'emailPDF',
    ];

    public function receiptPDF($id)
    {
        $loan = Loan::find($id);

        $data = [
            'user' => Auth::user(),
            'loan' => $loan,
            'loan_dates' => json_decode($loan->payment_dates, true),
            'partner' => $loan->partner,
            'company' => Company::where('id', 1)->first(),
        ];

        $pdf = PDF::loadView('pdf.receipt-loan', $data);
        
        return $pdf->stream('receipt_' . $id . 'pdf');
    }


    public function emailPDF($id){

            $loan = Loan::find($id);
            $partner = Partner::where('id',$loan->partner_id)->first();
            $subject_loan = "Solicitud de préstamo aceptado";
            $company = Company::where('id', 1)->first();
            $for_client = $partner->email;
            
            $msn_loan = [
                "company_ico" => $company->ico,
                "partner" => $partner->name,
                "date" => $loan->date,
                "type_loan" => $loan->type_loan,
                "loan_amount" => $loan->loan_amount,
                "interest_rate_yearly" => $loan->interest_rate_yearly,
                "to_pay" => $loan->to_pay,
                "final_payment" => $loan->final_payment,
                "payment_frequency" => $loan->payment_frequency,
                "installments" => $loan->installments,
                "total_to_pay" => $loan->total_to_pay,
                "user" => Auth::user()->name,
                "subject" => $subject_loan,
                "loan_dates" => json_decode($loan->payment_dates, true),
            ];
          
            try {
                Mail::to($for_client)->send(new MessageLoanAccepted($msn_loan));   
                $loan->update([
                    "email_verification" => "ENVIADO",
                ]);     
                $this->resetUI();
                $this->emit('loan-email', 'Correo enviado');
                
            } catch (Exception $e) {
                $loan->update([
                    "email_verification" => "FALLIDO",
                ]);
                $this->emit('loan-error', 'Envio fallido');
            }
               
       
    }

    public function Destroy(Loan $loan)
    {
        $loan->delete();
        $partner = Partner::where('id',$loan->partner_id)->first();
        $partner->update([
            'debt' => 0
        ]);

        $this->resetUI();
        $this->emit('loan-deleted', 'Se ha eliminado correctamente');
    }

    public function resetUI(){
        
        $this->loan_amount = null;
        $this->partnerId = "Seleccione";
        $this->type_loan = "Seleccione";
        $this->partners = [];
        $this->dates = [];
        $this->plazos = 0;
        $this->selected_id = 0;
        $this->num_loan = '';
        $this->partnerName = '';
        $this->date = '';
        $this->loan_amount ='';
        $this->interest_rate_yearly = '';
        $this->installments = '';
        $this->modality = "Seleccione";
        $this->payment_frequency = "Seleccione";
        $this->payment_type = "Seleccione";
        $this->emit("reset-partner", "");
    	$this->resetValidation();
    	

    }
}
