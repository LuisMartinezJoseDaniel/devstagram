@extends('layout.app')

@section("titulo")
  Inicia sesión en Devstagram
@endsection

@section('contenido')
<div class="p-5 md:flex md:justify-center md:gap-8 md:items-center">
  <div class="md:w-6/12">
    <img src="{{asset('img/login.jpg')}}" alt="Imagen de login usuario">
  </div>
  <div class="md:w-4/12 bg-white rounded-lg p-6 shadow-lg">
    <form method="POST" action="{{route('login')}}" novalidate>
      @csrf
      {{-- Mensaje de store()-> LoginController --}}
      @if (session('mensaje'))
        <p class="bg-red-500 text-sm text-white uppercase my-2 rounded-lg p-2 text-center">
          {{ session('mensaje')}}
        </p>
      @endif
        

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
        {{-- Crear un cookie para mantener abierta la sesion--}}
        <input id="remember" type="checkbox" name="remember">
        <label for="remember" class="text-sm text-gray-500 ">Mantener mi sesión abierta</label>
      </div>

      <input type="submit" value="Iniciar sesión" class="bg-sky-600 hover:bg-700 transition-colors cursor-pointer uppercase font-bold rounded-lg p-3 text-white w-full" >
    </form>
  </div>
</div>
    
@endsection