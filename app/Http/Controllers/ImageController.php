<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

/**
 * Controlador para manejar operaciones relacionadas con imágenes
 *
 * Proporciona funcionalidad para subir imágenes al sistema de archivos
 * y generar URLs públicas para acceder a ellas.
 */
class ImageController extends Controller
{
    /**
     * Sube una imagen al sistema de archivos y devuelve su URL pública
     *
     * @param \Illuminate\Http\Request $request Debe contener un campo 'upload' con el archivo de imagen
     * @return array Array asociativo con la URL pública de la imagen subida
     *
     * @example Respuesta exitosa:
     * {
     *     "url": "http://ejemplo.com/sys/storage/app/images/nombre_archivo.jpg"
     * }
     */
    public function upload(Request $request){
        $path = Storage::put('images', $request->file('upload'));
        
        
        return [
            'url' => asset('sys/storage/app/'.$path)
        ];

        /***
         * 
         * Para un hosting que no este directorio raiz publi_html
         * return [
            'url' => asset('sys/storage/app/'.$path)
        ];
        ***/
    }

    
}
