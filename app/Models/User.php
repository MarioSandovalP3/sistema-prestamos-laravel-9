<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo que representa un usuario del sistema con capacidades de autenticación.
 *
 * @property string $name Nombre completo del usuario
 * @property string $email Correo electrónico (único)
 * @property string $password Contraseña encriptada
 * @property string|null $profile Perfil o rol principal
 * @property string|null $phone Teléfono de contacto
 * @property string $status Estado del usuario (activo/inactivo)
 * @property string|null $image Nombre del archivo de imagen de perfil
 * @property \Illuminate\Support\Carbon|null $email_verified_at Fecha de verificación de email
 * @property string $remember_token Token de sesión persistente
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    /**
     * Campos asignables masivamente
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile',
        'phone',
        'status',
        'image',
    ];

    /**
     * Campos ocultos en serializaciones
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Conversiones de tipos para atributos
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Accesor para obtener la ruta de la imagen de perfil
     * @return string Ruta relativa de la imagen o imagen por defecto
     */
    public function getImagenAttribute()
    {
        if ($this->image != null) {
            return file_exists('storage/users/' . $this->image)
                ? 'users/' . $this->image
                : 'noimguser.png';
        }
        return 'noimguser.png';
    }
}
