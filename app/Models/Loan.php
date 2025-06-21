<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo que representa un préstamo en el sistema.
 *
 * @property string $num_loan Número único del préstamo
 * @property string $date Fecha de creación del préstamo
 * @property string $type_loan Tipo de préstamo
 * @property int $partner_id ID del socio asociado
 * @property float $loan_amount Monto total del préstamo
 * @property float $interest_rate_yearly Tasa de interés anual
 * @property float $interest_rate Tasa de interés aplicada
 * @property float $to_pay Total a pagar
 * @property string $modality Modalidad de pago
 * @property int $installments Número de cuotas pagadas
 * @property int $installments_total Total de cuotas programadas
 * @property string $payment_dates Fechas de pago programadas
 * @property string $payment_frequency Frecuencia de pagos
 * @property string $payment_type Tipo de pago
 * @property float $interest Interés acumulado
 * @property float $total_interest Interés total generado
 * @property float $total_to_pay Total a pagar incluyendo intereses
 * @property string $final_payment Fecha de pago final
 * @property int $num_pay Número de pagos realizados
 * @property float $total_pay Total pagado hasta la fecha
 * @property float $debt Saldo pendiente
 * @property float $earnings Ganancia generada
 * @property string $note Notas adicionales
 * @property string $status Estado actual del préstamo
 * @property string $email_verification Verificación por email
 */
class Loan extends Model
{
    use HasFactory;

    /**
     * Campos asignables masivamente
     * @var array
     */
    protected $fillable = [
        'num_loan', 'date', 'type_loan', 'partner_id', 'loan_amount',
        'interest_rate_yearly', 'interest_rate', 'to_pay', 'modality',
        'installments', 'installments_total', 'payment_dates', 'payment_frequency',
        'payment_type', 'interest', 'total_interest', 'total_to_pay', 'final_payment',
        'num_pay', 'total_pay', 'debt', 'earnings', 'note', 'status', 'email_verification'
    ];
    
    /**
     * Relación con el socio asociado al préstamo
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    /**
     * Relación con los pagos realizados del préstamo
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
