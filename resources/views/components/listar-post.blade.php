<div>
    {{-- Primera forma de hacerlo --}}
    @if ($posts->count())
    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
    @foreach ($posts as $post)
        <div class="">
        <a href="{{ route('posts.show', ['post' => $post, 'user'=>$post->user]) }}">
            <img src="{{ asset('uploads/' . $post->imagen )}}" alt="Imagen del post {{$post->titulo}}">
        </a>
        </div>
    @endforeach
    </div> {{-- Fin grid --}}
    @else ()
    <p class="text-center">No hay posts, sigue a alguien para poder mostrar sus posts</p>
    @endif

    {{-- Segunda forma de hacerlo --}}
    {{-- @forelse ($posts as $post)
        <h1>{{$post -> titulo }}</h1>
    @empty
        <p>No hay posts</p>
    @endforelse --}}

</div>