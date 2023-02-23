<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function __invoke()
    {
        /* Obtener a quienes seguimos */
        /* pluck se trae los atributos que especifiquemos */
        $ids = auth()->user()->followings->pluck('id')->toArray();
        /* Where in es un where con un arreglo, en el Active Records que hice en el otro curso viene siendo un whereArray */
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);
        return view('home', [
            'posts' => $posts
        ]);
    }
}
