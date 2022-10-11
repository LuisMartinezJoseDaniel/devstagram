@extends('layout.app')

@section('titulo')
Perfil:  {{ $user->username }}
@endsection

@section('contenido')
<div class="flex justify-center">
  <div class="w-full flex flex-col items-center md:w-8/12 lg:w-6/12 md:flex-row">
    <div class="w-8/12 lg:1/2 px-5">
      <img class="rounded-full" src="{{asset( $user->imagen ? 'perfiles/' . $user->imagen : 'img/usuario.svg' )}}" alt="Imagen usuario">

    </div>
    <div class="w-full md:w-8/12 lg:1/2 flex flex-col items-center md:justify-center py-10 md:items-start">
      <div class="flex gap-3 items-center">
        <p class="text-gray-700 text-2xl">  {{ $user->username }} </p>
        {{-- Botones de seguir --}}
        @auth
        {{-- Usuario a quien vemos, Usuario autenticado --}}
        {{-- No nos podemos seguir a nosotros mismos --}}
        @if ($user -> id !== auth()->user()->id)
          {{-- Mostrar botones de seguir dejar de seguir--}}
          @if ($user -> siguiendo(auth()->user()))
          <form action="{{ route('users.unfollow', $user) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold hover:cursor-pointer">
              Degar de seguir
            </button>
          </form>
          @else 
          <form action="{{ route('users.follow', $user)}}" method="POST">
            @csrf
            <button type="submit" class="bg-blue-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold hover:cursor-pointer">
              Seguir
            </button>
          </form>

          @endif
        @endif
        @endauth
        {{-- Fin botones de seguir --}}
        @auth
          @if ($user->id === auth()->user()->id)
            <a href="{{route('perfil.index')}}" class="text-gray-500 hover:text-gray-600">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
              </svg>
            </a>
          @endif
        @endauth
      </div>
      
      <div class="w-full flex gap-3 border-t-2 border-b-2 md:border-t-0 md:border-b-0 border-gray-300 p-3 mt-5">
        <p class="flex-1 text-gray-800 text-sm mb-3 font-bold flex flex-col items-center md:flex-row md:gap-3">
          {{ $user->followers-> count() }}
          <span class="font-normal">
            {{-- En base  a la cantidad aplica el enum  --}}
            @choice('Seguidor|Seguidores', $user->followers-> count())
          </span>
        </p>
        <p class="flex-1 text-gray-800 text-sm mb-3 font-bold flex flex-col items-center md:flex-row md:gap-3">
          {{ $user->followings->count() }}
          <span class="font-normal">
            Siguiendo
          </span>
        </p>
        <p class="flex-1 text-gray-800 text-sm mb-3 font-bold flex flex-col items-center md:flex-row md:gap-3">
          {{ $user->posts->count() }}
          <span class="font-normal">Post</span>
        </p>

      </div>
      
    </div>

  </div>
</div>

  <section class="container mx-auto mt-10">
    <h2 class="text-4xl font-black my-10 text-center"> Publicaciones</h2>
    <x-listar-post :posts="$posts"/>
    {{-- $user->posts as $post, utilizando el modelo de user, pero se pierde la paginacion --}}
    {{-- @if (!($posts->count()))
      <p class="text-gray-600 text-sm text-center font-bold uppercase">No hay publicaciones</p>
    @endif
    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
      @foreach ($posts as $post)
        <div class="">
          <a href="{{ route('posts.show', ['post' => $post, 'user'=>$post->user]) }}">
            <img src="{{ asset('uploads/' . $post->imagen )}}" alt="Imagen del post {{$post->titulo}}">
          </a>
        </div>
      @endforeach
    </div>  --}}
    {{-- Fin grid --}}
      
    {{-- Paginacion, configurar tailwind.config.js --}}
    {{-- <div class="my-10">
      {{ $posts->links('pagination::tailwind') }}
    </div> --}}
  </section>
@endsection

