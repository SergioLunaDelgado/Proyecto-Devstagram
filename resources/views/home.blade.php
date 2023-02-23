<!-- Esto es un include en sintaxis de blade
el '.' viene siendo un '/'
las directivas NO LLEVAN ; -->

@extends('layouts.app')

@section('titulo', 'Página Principal')

@section('contenido')
    {{-- de esta forma podemos llamar los componentes (templates como si tuviera un include) --}}
    <x-listar-post :posts="$posts" /> {{-- de esta forma le pasamos parametros al componente --}}
    {{-- los slots actuan como variables, como contenedores que estan esperando llenarse de informacion --}}
    {{-- <x-listar-post>
    <h1>mostrando post desde slot</h1>
    </x-listar-post> --}}
@endsection
