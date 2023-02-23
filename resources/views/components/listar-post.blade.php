<div>
    {{-- <b>mostrando post desde componente</b>
    <b>{{ $slot }}</b> --}}

    @if ($posts->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($posts as $post)
                <div class="">
                    {{-- por defecto toma el id de todos los atributos de post --}}
                    <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}">
                        <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}">
                    </a>
                </div>
            @endforeach
        </div>
        <div class="my-10">
            {{-- agregamos paginacion con links y por defecto tiene los estilos de tailwind links('pagination::tailwind') --}}
            {{ $posts->links() }}
        </div>
    @else
        <p class="text-center">No Hay Posts, sigue a alguien para poder mostrar sus posts</p>
    @endif

    {{-- esto es la fusion entre un foreach y la parte falsa del if (else) --}}
    {{-- @forelse ($posts as $post)
            <h1>{{ $post->titulo }}</h1>
        @empty
            <p>no hay posts</p>
        @endforelse --}}
</div>