<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        /* Validacion */
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        /* en php seria de esta forma:
                            where toma una columna y un valor    
        $usuario = Usuario::where('email', $usuario->email);
        if (!$usuario || !$usuario->confirmado) {
            Usuario::setAlerta('error', 'Credenciales Incorrectas');
        }
        $alertas = Usuario::getAlertas();
        $router->render('auth/login', [
            'alertas' => $alertas
        ]); */
        /* el $request->remember crea una cookie que guarda un valor en la bd de la tabla usuarios en el atributo remember_token, laravel lo hace de forma automatico */
        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) { /* en caso que el usuario no se pueda autenticar */
            return back()->with('mensaje', 'Credenciales Incorrectas');
            /* back() hace que puedas volver a la pagina anterior, en este caso a /login (GET) */
        }

        /* no va apuntar a /muro o /sergio /melisa_luna ni nada porque es dinamico, esta es la importancia de usar un name en la ruta */
        return redirect()->route('posts.index', ['user' => auth()->user()->username]);
    }
}
