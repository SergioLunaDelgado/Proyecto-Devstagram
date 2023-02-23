<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comentarios;
use Illuminate\Http\Request;

class ComentariosController extends Controller
{
    /* No se puede pasar directo el post ya que en la ruta del route-model-binding primero pasamos el user */
    public function store(Request $request, User $user, Post $post) {
        /* Validar */
        $this->validate($request, [
            'comentario' => 'required|max:255'
        ]);

        /* Almacenar el resultado */
        Comentarios::create([
            'user_id' => auth()->user()->id, /* seria incorrecto poner $user->id ya que este usaurio es el de la publicacion y no es la persona que comenta */
            'post_id' => $post->id,
            'comentario' => $request->comentario,
        ]);

        /* Imprimir un mensaje */
        return back()->with('mensaje', 'Comentario Realizado Correctamente');
    }
}
