<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\Drivers\Imagick\Decoders\Base64ImageDecoder;
use Intervention\Image\Drivers\Imagick\Decoders\DataUriImageDecoder;
use Intervention\Image\Drivers\Imagick\Decoders\FilePathImageDecoder;


class ImagenController extends Controller
{
    public function store(Request $request){

        $manager = new ImageManager(new Driver());
        
        $imagen = $request->file('file');

        $nombreImagen = Str::uuid() . "." . $imagen->extension();
        
        $imagenServidor = $manager->read($imagen);
        $imagenServidor->resize(1000, 1000);

        //agregamos la imagen a la  carpeta en public donde se guardaran las imagenes
        $imagenesPath = public_path('uploads') . '/' . $nombreImagen;

        //Una vez procesada la imagen entonces guardamos la imagen en la carpeta que creamos
        $imagenServidor->save($imagenesPath);
 
        return response()->json(['imagen' => $nombreImagen]);
    }
}

