<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        /* esto es un Dump and Die */
        // dd($request);
        // dd($request->get('username));

        /* modificar el request, como ultima opcion */
        /* slug convierte los strings en url, esto hace lo convierte en minusculas y los espacios los cambia por un '-' */
        $request->request->add(['username' => Str::slug($request->username)]);

        /* Validacion */
        $this->validate($request, [
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username, 
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        /* Auntenticar un usuario */
        /* esto equivale a un session_start() y a la superglobal $_SESSION[] */
        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password,
        // ]);
        /* otra forma de autenticar, unicamente extrae el email y password */
        auth()->attempt($request->only('email', 'password'));

        /* Redireccionar */
        return redirect()->route('posts.index', ['user' => auth()->user()->username]); /* en php es un header('location: /posts/' ) */
    }
}
