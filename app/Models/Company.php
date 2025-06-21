<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Eloquent para la entidad Company.
 *
 * Representa una compañía en el sistema con sus atributos básicos.
 * Utiliza el trait HasFactory para permitir la creación de factories.
 */
class Company extends Model
{
    use HasFactory;
    
    /**
     * Atributos asignables masivamente (mass assignment).
     *
     * @var array<string>
     *
     * Campos permitidos:
     * - name: Nombre de la compañía
     * - address: Dirección física
     * - city: Ciudad
     * - state: Estado/Provincia
     * - postal_code: Código postal
     * - website: URL del sitio web
     * - email: Correo electrónico principal
     * - phone: Teléfono fijo
     * - movil: Teléfono móvil
     * - rif: Registro de Información Fiscal
     * - image: Ruta de imagen/logo
     * - ico: Ícono/favicon
     * - slogan: Eslogan corporativo
     * - us: Campo de uso específico
     * - iframe_map: Código iframe para mapa de ubicación
     */
    protected $fillable = [
        'name',
        'address',
        'city',
        'state',
        'postal_code',
        'website',
        'email',
        'phone',
        'movil',
        'rif',
        'image',
        'ico',
        'slogan',
        'us',
        'iframe_map'
    ];
}
