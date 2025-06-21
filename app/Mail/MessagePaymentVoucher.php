<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Email de comprobante de pago de préstamo
 *
 * @property array $msn_payment Datos del pago:
 * - company_ico: Logo de la compañía
 * - num_pay: Número de pago
 * - num_loan: Número de préstamo
 * - to_pay: Monto pagado
 * - remaining_payments: Cuotas restantes
 */
class MessagePaymentVoucher extends Mailable
{
    use Queueable, SerializesModels;
    public $subject = "Comprobante de pago";
    public $msn_payment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    /**
     * @param array $msn_payment Datos del pago para el email
     */
    public function __construct($msn_payment)
    {
        $this->msn_payment = $msn_payment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    /**
     * Construye el email usando la vista message-payment-voucher
     */
    public function build()
    {
        return $this->view('livewire.emails.message-payment-voucher');
    }
}
