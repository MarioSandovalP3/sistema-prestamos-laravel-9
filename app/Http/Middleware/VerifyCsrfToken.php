<?php

namespace App\Http\Middleware;
use Carbon\Carbon; // Import the Carbon class
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];

    protected function tokensMatch($request)
    {
        // Obtener la marca de tiempo del token CSRF almacenado en la sesión
        $storedToken = $request->session()->token();

        // Obtener la marca de tiempo actual del token CSRF enviado con la solicitud
        $requestToken = $request->input('_token') ?: $request->header('X-CSRF-TOKEN');

        // Verificar si los tokens coinciden
        return hash_equals($storedToken, $requestToken);
    }
}
