@extends('layout.app')

@section('titulo')
@endsection

{{-- stack('styles') -> en app.blade --}}
@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('contenido')
  <div class="md:flex md:items-center">
    <div class="md:w-1/2 px-10">
      <form action="{{route('imagenes.store')}}" enctype="multipart/form-data" method="POST" id="dropzone" class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
        @csrf
      </form>
    </div>
    <div class="md:w-1/2 p-10 bg-white rounded-lg shadow-lg mt-10 md:mt-0">

      <form action="{{route('posts.store')}}" method="POST" novalidate>
        @csrf
        <div class="mb-5">
          <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">
            Título
          </label>
          <input type="text" id="titulo" name="titulo" value="{{old('titulo')}}" placeholder="El título de la publicación" 
          class="border w-full p-3 rounded-lg @error('titulo') border-red-500 @enderror" >
          @error('titulo')
            <p class="bg-red-500 text-sm text-white uppercase my-2 rounded-lg p-2 text-center">
              {{ $message }}
            </p>
          @enderror
        </div>
        <div class="mb-5">
          <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">
            Descripción
          </label>
          <textarea 
            type="text"
            id="descripcion"
            name="descripcion"
            placeholder="Descripción de la publicación" 
            class="border w-full p-3 rounded-lg @error('descripcion') border-red-500 @enderror">{{old('descripcion')}}</textarea>
          @error('descripcion')
            <p class="bg-red-500 text-sm text-white uppercase my-2 rounded-lg p-2 text-center">
              {{ $message }}
            </p>
          @enderror
        </div>
        <div class="mb-5">
          <input id="imagen" type="hidden" name="imagen" value="{{ old('imagen') }}">
          @error('imagen')
            <p class="bg-red-500 text-sm text-white uppercase my-2 rounded-lg p-2 text-center">
              {{ $message }}
            </p>
          @enderror
        </div>
        
        <input type="submit" value="Crear publicación" class="bg-sky-600 hover:bg-700 transition-colors cursor-pointer uppercase font-bold rounded-lg p-3 text-white w-full" >

      </form>

    </div>
  </div>

@endsection