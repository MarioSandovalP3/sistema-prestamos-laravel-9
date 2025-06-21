<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Email de notificación de préstamo aceptado
 *
 * @property array $msn_loan Datos del préstamo:
 * - company_ico: Logo de la compañía
 * - partner: Nombre del cliente
 * - loan_amount: Monto del préstamo
 * - installments: Número de cuotas
 */
class MessageLoanAccepted extends Mailable
{
    use Queueable, SerializesModels;
    public $subject = "Solicitud de préstamo aceptado";
    public $msn_loan;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    /**
     * @param array $msn_loan Datos del préstamo para el email
     */
    public function __construct($msn_loan)
    {
        $this->msn_loan = $msn_loan;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    /**
     * Construye el email usando la vista message-loan-accepted
     */
    public function build()
    {
        return $this->view('livewire.emails.message-loan-accepted');
    }
}
