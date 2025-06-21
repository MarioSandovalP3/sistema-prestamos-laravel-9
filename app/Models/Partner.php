<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo que representa un socio en el sistema de préstamos.
 *
 * @property string|null $image Nombre del archivo de imagen del socio
 * @property string $name Nombre completo del socio
 * @property string $cedula Cédula o identificación
 * @property string $address Dirección física
 * @property string $contry País de residencia
 * @property string $state Estado/Provincia
 * @property string $city Ciudad
 * @property string $postal_code Código postal
 * @property string $phone Teléfono fijo
 * @property string $movil Teléfono móvil
 * @property string $email Correo electrónico
 * @property string|null $website Sitio web
 * @property float $debt Saldo deudor total
 */
class Partner extends Model
{
    use HasFactory;

    /**
     * Campos asignables masivamente
     * @var array
     */
    protected $fillable = [
        'image', 'name', 'cedula', 'address', 'contry',
        'state', 'city', 'postal_code', 'phone', 'movil',
        'email', 'website', 'debt'
    ];

    /**
     * Relación con los préstamos asociados al socio
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    /**
     * Accesor para obtener la ruta de la imagen del socio
     * @return string Ruta relativa de la imagen o imagen por defecto
     */
    public function getImagenAttribute()
    {
        if ($this->image != null) {
            return file_exists('storage/partners/' . $this->image)
                ? 'partners/' . $this->image
                : 'noimg.png';
        }
        return 'noimg.png';
    }
}
