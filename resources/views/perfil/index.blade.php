@extends('layouts.app')

@section('titulo')
    Editar Perfil: {{ auth()->user()->username }}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <form method="POST" action="{{ route('perfil.store') }}" enctype="multipart/form-data" class="mt-10 md:mt-0">
            @csrf
            <div class="mb-5">
                <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Username</label>
                <input type="text" name="username" id="username" class="border p-3 w-full rounded @error('username') border-red-500 @enderror" placeholder="Tu Nombre de Usuario" value="{{ auth()->user()->username }}">
                @error('username')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">Imagen del Perfil</label>
                <input type="file" name="imagen" id="imagen" class="border p-3 w-full rounded" accept=".jpg, .jpeg, .png"> {{-- no vamos a validar la imagen porque no es obligatorio subir una --}}
            </div>
            <div class="mb-5">
                <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                <input type="email" name="email" id="email" class="border p-3 w-full rounded @error('email') border-red-500 @enderror" placeholder="Tu email de registro" value="{{ auth()->user()->email }}">
                @error('email')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Password Actual</label>
                <input type="password" name="password" id="password" class="border p-3 w-full rounded @error('password') border-red-500 @enderror" placeholder="Password Actual">
                @error('password')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">Password Nuevo</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="border p-3 w-full rounded" placeholder="Repite tu password">
                {{-- password_confirmation es una convencion de laravel --}}
            </div>
            <input type="submit" value="Guardar Cambios" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
        </form>
    </div>
@endsection