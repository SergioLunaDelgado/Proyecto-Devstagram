<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct()
    {
        /* siempre se va a ejecutar primero antes que las otras funciones */

        /* Si fuera con php nativo seria de esta forma 
        function is_admin() : bool {
            if (!isset($_SESSION)) {
                session_start();
            }
        
            return isset($_SESSION['admin']) && !empty($_SESSION['admin']);
        }
        if(!is_admin()) {
            header('location: /login');
        } */
        $this->middleware('auth')->except(['show', 'index']);
        // $this->middleware('auth');
        $this->CleanCache();
    }

    public function CleanCache()
    {
        header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');
    }

    public function index(User $user)
    {
        // dd(auth()->user());
        // dd($user->username);

        /* esto es lo mismo que 
        $router->render('admin/dashboard/index', [
            'user' => $user,
        ]); */

        /*                  get se trae los resultados */
        // $posts = Post::where('user_id', $user->id)->get();

        /* si queremos paginar al final de la consulta agregamos el paginate y automaticamente hara toda la logica */
        // $posts = Post::where('user_id', $user->id)->simplePaginate(4); muestra solamente los btn de anterior y siguiente
        $posts = Post::where('user_id', $user->id)->latest()->paginate(4);

        return view('dashboard', [
            'user' => $user,
            'posts' => $posts,
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

        Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id,
        ]);

        /* Otra forma, Instancia, asigna, consulta en la bd para insertar */
        // $post = new Post;
        // $post->titulo = $request->titulo;
        // $post->descripcion = $request->descripcion;
        // $post->imagen = $request->imagen;
        // $post->user_id = auth()->user()->id;
        // $post->save();

        /* otra forma para crear un usuario especificando su relacion, posts asi no nombre en el modelo de user */
        // $request->user()->posts()->create([
        //     'titulo' => $request->titulo,
        //     'descripcion' => $request->descripcion,
        //     'imagen' => $request->imagen,
        //     'user_id' => auth()->user()->id,
        // ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }

    /* es necesario agregar esta funcion para borrar los post */
    public function authorize($ability, $arguments = [])
    {
        return true;
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post); /* policy */
        $post->delete();

        /* Eliminar la imagen */
        $imagen_path = public_path('uploads/' . $post->imagen);
        if(File::exists($imagen_path)) {
            unlink($imagen_path);
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
