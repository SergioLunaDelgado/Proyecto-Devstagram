<?php

use App\Http\Controllers\ComentariosController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* forma closures  */
// Route::get('/', function () {
//     return view('principal');
// });
Route::get('/', HomeController::class)->name('home'); /* solo tiene un closure porque tiene un invoke */

/* Se recomienda que las rutas que contengan una variable se escriban hasta el final del archivo */

/* el name sustituye la url por si en algun momento cambiamos la url
si la ruta del get y post se llama igual no es necesario colocar el name en el post */
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

/* Rutas para el perfil */
Route::get('/editar-perfil', [PerfilController::class, 'index'])->name('perfil.index');
Route::post('/editar-perfil', [PerfilController::class, 'store'])->name('perfil.store');

/* esto son propiedades avanzadas de laravel, se conoce como route-model-binding, eso significa que laravel consulta y valida de forma automatica */
/*          user representa el modelo y lo que sigue despues de los 2 puntos es un atributo de la bd */
Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index');
Route::get('/post/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/post', [PostController::class, 'store'])->name('posts.store');
Route::delete('/post/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::post('/{user:username}/posts/{post}', [ComentariosController::class, 'store'])->name('comentarios.store');

/* Like a las fotos */
Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');
Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('posts.likes.store');
Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])->name('posts.likes.destroy');

/* Siguiendo a usuarios */
Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('users.follow');
Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('users.unfollow');
