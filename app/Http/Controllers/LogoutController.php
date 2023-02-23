<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function store()
    {
        /* esto es lo mismo que $_SESSION = [] */
        auth()->logout();

        return redirect()->route('login');
    }
}
