<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function index()
    {
        return view("auth.register");
    }

    public function store(Request $request)
    {
        //* Interceptar username -> evitar Error de Laravel -> unique en users table
        //* convertir a URL el username antes de validar
        $request -> request->add(['username'=>Str::slug($request->get('username'))]);

        //* Validacion
        $this->validate($request,[
            'name' => 'required|min:3|max:30',
            'username' => 'required|unique:users|min:3|max:30',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6', //* Verificar que sean iguales los password
        ]);
        //* INSERT INTO users inputs con name
        User::create([
        'name' => $request->get('name'),
        'username' => $request->get('username'), //* lower y slug === url
        'email' => $request->get('email'),
        'password' => Hash::make( $request->get('password') ) //* Hashear password
        ]);

        //* 1. Primera forma Autenticar usuarios
        // auth()->attempt([
            //     'email' => $request->email,
            //     'password'=> $request->get('password')
            // ]);
        //* 2. Segunda forma Autenticar usuarios
        auth()->attempt($request->only('email','password'));

        //Redireccionar
        return redirect()->route('posts.index', auth()->user()->username);
    }

}
