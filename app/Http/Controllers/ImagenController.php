<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    public function store(Request $request) {
        // $input = $request->all();
        $imagen = $request->file('file');
        $nombre_imagen = Str::uuid() . "." . $imagen->extension();

        $imagen_servidor = Image::make($imagen); /* siempre elegir facades */
        $imagen_servidor->fit(1000,1000);
        /* uploads es el nombre de la carpeta y se guarda dentro de public */
        $imagen_path = public_path('uploads') . '/' . $nombre_imagen;
        $imagen_servidor->save($imagen_path);

        // return "desde imagen controlador";
        // return response()->json($input);
        return response()->json(['imagen' => $nombre_imagen]);
    }
}
