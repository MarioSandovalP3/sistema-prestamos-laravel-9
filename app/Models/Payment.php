<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo que representa un pago en el sistema de préstamos.
 *
 * @property int $loan_id ID del préstamo asociado
 * @property string $date Fecha del pago
 * @property float $to_pay Monto programado a pagar
 * @property string $payment_method Método de pago utilizado
 * @property string|null $note Notas adicionales sobre el pago
 * @property string $email_verification Estado de verificación por email
 * @property int $num_pay Número de pago (secuencial)
 * @property int $remaining_payments Cuotas restantes después de este pago
 * @property float $total_pay Monto total pagado hasta la fecha
 * @property float $debt Saldo pendiente después del pago
 * @property string $status Estado actual del pago
 */
class Payment extends Model
{
    use HasFactory;

    /**
     * Campos asignables masivamente
     * @var array
     */
    protected $fillable = [
        'loan_id', 'date', 'to_pay', 'payment_method', 'note',
        'email_verification', 'num_pay', 'remaining_payments',
        'total_pay', 'debt', 'status'
    ];

    /**
     * Relación con el préstamo asociado a este pago
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}
