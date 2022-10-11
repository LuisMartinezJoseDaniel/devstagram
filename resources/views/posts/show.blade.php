@extends('layout.app')

@section('titulo')
  {{ $post->titulo }}
@endsection

@section('contenido')
<div class="md:flex bg-white shadow-lg">
  <div class="md:w-1/2 border-gray-500">
    <img src='{{asset("uploads/{$post->imagen}")}}' alt="Imagen de {{$post->titulo}}">
  </div>
  <div class="md:w-1/2 md:px-5">
    <div class="shadow bg-white p-5 mb-5 md:flex md:flex-col md:h-full ">
      {{-- descripcion de la publicacion --}}
      <section class="md:flex justify-between border-gray-200 border-b py-2">
      {{-- relacion belongsTo del modelo Post --}}
        <p class="">
        {{-- relacion en el modelo de post --}}
          <a class="font-bold" href="{{route('posts.index', $post->user)}}">{{$post->user->username}}</a>
          <span class="justify-self-start	">{{$post->descripcion}}</span>
        </p>
        @auth
        <button type="button">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
          </svg>
          {{-- Eliminar publicacion --}}
          {{-- TODO: Agregar un modal para poder eliminar la publicacion --}}
          {{-- el propietario del post es el mismo que esta autenticado? --}}
            @if ($post->user_id === auth()->user()->id)
            <div id="eliminar-publicacion" class="hidden">
              <form action="{{route('posts.destroy', ['post'=>$post])}}" method="POST">
                @csrf
                {{-- METHOD SPOOFING ->permite agregar otro tipo de peticiones--}}
                @method('DELETE') 
                <input class="bg-red-500 p-2 rounded text-white font-bold mt-4 hover:cursor-pointer" type="submit" value="Eliminar publicacion">
              </form>                
            </div>
            @endif
            
          </button>
          @endauth
        
      </section>
      <div class="md:flex md:flex-col md:justify-between md:h-full">
        {{-- Caja de comentarios --}}
        <section class="bg-white mt-10 shadow-md mb-5 md:flex-1 {{$post->comentarios->count() ? 'overflow-y-scroll': ''}}">
          {{-- Relacion hasMany, se accede como un atributo normal en las vistas --}}
          @if (!($post->comentarios->count()))
            <p class="p-10 text-center">No hay comentarios aún</p>
            @else
            @foreach ($post->comentarios as $comentario)
            <div class="p-5 ">
              <p>
                {{-- relacion en el modelo de comentario --}}
                <a class="font-bold" href="{{route('posts.index', $comentario->user)}}">{{$comentario->user->username}}</a>
                {{ $comentario ->comentario}}
              </p>
              <p class="text-sm text-gray-500 mt-2">
                
                {{ $comentario->created_at->diffForHumans()}}</p>
            </div>
              
            @endforeach
          @endif
  
        </section>
        {{-- Caja de likes --}}
       
        <section class="p-2 border-gray-300 border-t">
          <div class="flex items-center gap-3">
            @auth
            <livewire:like-post :post="$post" />
   
            @endauth
          </div>
          {{-- diffForHumans -> muestra el tiempo en dias desde que fue creado --}}
          <p class="text-sm text-gray-700">{{$post->created_at->diffForHumans()}}</p>
        </section>
          
       
        {{-- form --}}
        @auth
        @if (session('mensaje'))
        <p class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
          {{session('mensaje')}}
        </p>     
        @endif
        {{-- <p class="text-xl font-bold text-center mb-4">
          Agrega un nuevo comentario
        </p> --}}
        <form method="POST" 
            action="{{route('comentarios.store', ['user'=> $user, 'post' => $post])}}"
            class="border-gray-200 border-t-2 py-3">
          @csrf
          <div class="flex justify-between gap-2">
            <div class="mb-5 flex-1">
              <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                Añade un comentario
              </label>
              <div class="">
                <textarea 
                  type="text"
                  id="comentario"
                  name="comentario"
                  placeholder="Agrega un comentario" 
                  class="border w-full p-3 rounded-lg @error('comentario') border-red-500 @enderror"></textarea>
                @error('comentario')
                  <p class="bg-red-500 text-sm text-white uppercase my-2 rounded-lg p-2 text-center">
                    {{ $message }}
                  </p>
                @enderror

              </div>
            </div>
            <input type="submit" value="Comentar" class="text-sky-600 uppercase font-bold" >
  
          </div>
  
        </form>
        @endauth

      </div>


    </div>

  </div>
</div>
  
@endsection