@extends('layout.app')

@section("titulo")
  Regístrate en devstagram
@endsection

@section('contenido')
<div class="p-5 md:flex md:justify-center md:gap-8 md:items-center">
  <div class="md:w-6/12">
    <img src="{{asset('img/registrar.jpg')}}" alt="Imagen de registro">
  </div>
  <div class="md:w-4/12 bg-white rounded-lg p-6 shadow-lg">
    <form action="{{route('register.store')}}" method="POST" novalidate>
      @csrf
      <div class="mb-5">
        <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">
          Nombre
        </label>
        <input type="text" id="name" name="name" value="{{old('name')}}" placeholder="Tu nombre:" 
        class="border w-full p-3 rounded-lg @error('name') border-red-500 @enderror" >
        @error('name')
          <p class="bg-red-500 text-sm text-white uppercase my-2 rounded-lg p-2 text-center">
            {{ $message }}
          </p>
        @enderror
      </div>

      <div class="mb-5">
        <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
          Username
        </label>
        <input
          type="text"
          id="username"
          name="username"
          value="{{old('username')}}"
          placeholder="Tu nombre de usuario:"
          class="border w-full p-3 rounded-lg @error('username') border-red-500 @enderror">
          @error('username')
            <p class="bg-red-500 text-sm text-white uppercase my-2 rounded-lg p-2 text-center">
              {{ $message }}
            </p>
          @enderror     
      </div>

      <div class="mb-5">
        <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
          Email
        </label>
        <input
          type="text"
          id="email"
          name="email"
          placeholder="Tu email de registro:"
          value="{{old('email')}}"
          class="border w-full p-3 rounded-lg @error('email') border-red-500 @enderror"> 
          @error('email')
            <p class="bg-red-500 text-sm text-white uppercase my-2 rounded-lg p-2 text-center">
              {{ $message }}
            </p>
          @enderror
      </div>

      <div class="mb-5">
        <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
          Password
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
        <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
          Repetir password
        </label>
        <input
          type="password"
          id="password_confirmation"
          name="password_confirmation"
          placeholder="Repite tu password: "
          class="border w-full p-3 rounded-lg">      
      </div>
      <input type="submit" value="Crear cuenta" class="bg-sky-600 hover:bg-700 transition-colors cursor-pointer uppercase font-bold rounded-lg p-3 text-white w-full" >
    </form>
  </div>
</div>
    
@endsection