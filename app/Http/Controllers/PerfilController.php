<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        /* modificar el request */
        $request->request->add(['username' => Str::slug($request->username)]);

        /* cuando son mas de 3 reglas, laravel recomienda usar un arreglo
        especificamos en el unique que si somos nosotros mismo no marque el error de usuario existente
        usando not_in podemos crear una lista negra de nombres que no se pueden tomar */
        $this->validate($request, [
            'username' => ['required', 'unique:users,username,' . auth()->user()->id, 'min:3', 'max:20', 'not_in:twitter,editar-perfil'],
            'email' => ['required','unique:users,email,'.auth()->user()->id, 'email', 'max:60']
        ]);

        if($request->password || $request->password_confirmation) {
            $this->validate($request, [
                'password' => 'required|min:8|confirmed',
            ]);
        }

        if ($request->imagen) {
            $imagen = $request->file('imagen');
            $nombre_imagen = Str::uuid() . "." . $imagen->extension();

            $imagen_servidor = Image::make($imagen); /* siempre elegir facades */
            $imagen_servidor->fit(1000, 1000);

            $imagen_path = public_path('perfiles') . '/' . $nombre_imagen;
            $imagen_servidor->save($imagen_path);
        }

        /* Guardar cambios */
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->imagen = $nombre_imagen ?? auth()->user()->imagen ?? null;
        $usuario->save();

        /* Redireccionar */
        return redirect()->route('posts.index', $usuario->username); /* puede ser que el usuario halla modificado el nombre de usuario es por eso que colocamos la ultima instancia */
    }
}
