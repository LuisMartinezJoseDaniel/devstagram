@extends('layout.app')

@section('titulo')
Editar pefil {{auth()->user()->username}}
@endsection

@section('contenido')
  <div class="md:flex justify-center">
    <div class="md:w-1/2 bg-white shadow p-6">
      <form action="{{ route('perfil.store') }}" enctype="multipart/form-data" method="POST" class="mt-10 md:mt-0">
        @csrf
        <div class="mb-5">
          <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
            Nombre
          </label>
          <input type="text" id="username" name="username" value="{{ auth()->user()->username }}" placeholder="Tu nombre de usuario:" 
          class="border w-full p-3 rounded-lg @error('name') border-red-500 @enderror" >
          @error('username')
            <p class="bg-red-500 text-sm text-white uppercase my-2 rounded-lg p-2 text-center">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="mb-5">
          <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
            Email:
          </label>
          <input type="text" id="email" name="email" value="{{ auth()->user()->email }}" placeholder="Tu nombre de usuario:" 
          class="border w-full p-3 rounded-lg @error('name') border-red-500 @enderror" >
          @error('email')
            <p class="bg-red-500 text-sm text-white uppercase my-2 rounded-lg p-2 text-center">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="mb-5">
          <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
            Imagen perfil
          </label>
          <input type="file" 
                 accept=".jpg, .jpeg, .png" 
                 id="imagen" name="imagen" 
                 class="border w-full p-3 rounded-lg @error('name') border-red-500 @enderror" >
        </div>

        <div class="mb-5">
          <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
            Password actual
          </label>
          <input
            type="password"
            id="password"
            name="password"
            placeholder="Tu password de registro: "
            class="border w-full p-3 rounded-lg @error('password') border-red-500 @enderror">  
            @error('password')
              <p class="bg-red-500 text-sm text-white uppercase my-2 rounded-lg p-2 text-center">
                {{ $message }}
              </p>
            @enderror
      </div>
        <div class="mb-5">
          <label for="nuevo_password" class="mb-2 block uppercase text-gray-500 font-bold">
            Nuevo password
          </label>
          <input
            type="password"
            id="nuevo_password"
            name="nuevo_password"
            placeholder="Tu nuevo password: "
            class="border w-full p-3 rounded-lg @error('nuevo_password') border-red-500 @enderror">  
            @error('nuevo_password')
              <p class="bg-red-500 text-sm text-white uppercase my-2 rounded-lg p-2 text-center">
                {{ $message }}
              </p>
            @enderror
      </div>
        

        <input type="submit" value="Guardar cambios" class="bg-sky-600 hover:bg-700 transition-colors cursor-pointer uppercase font-bold rounded-lg p-3 text-white w-full" >

      </form>
    </div>
  </div>
@endsection

