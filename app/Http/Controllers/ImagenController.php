<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class ImagenController extends Controller
{
    public function store(Request $request){
        // Similiar a la superglobal de $_FILES
        $imagen = $request->file('file');//Obtener la imagen

        $nombreImagen = Str::uuid()  . "." . $imagen ->extension();

        $imagenServidor = Image::make($imagen);

        $imagenServidor -> fit(1000,1000);

        //public/upload/image.jpg
        $imagenPath = public_path('uploads') . "/" . $nombreImagen;
        $imagenServidor ->save($imagenPath);

        // Retornar un JSON como respuesta
        // Al retornar un response de tipo JSON, el evento en app.js se dispara
        // dropzone.on('success', (file, response)=>{clg(response)})
        return response()->json(['imagen' => $nombreImagen]);

    }
}
