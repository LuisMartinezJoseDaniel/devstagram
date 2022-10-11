<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function store(Request $request){
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required', 
        ]);

        

        //* Si no esta autenticado, laravel comprueba desde la base de datos
        //* attemp([datos de autenticacion], remember = false)
        //* con remember crea un cookie -> ver en Application ->Cookies
        if(!auth()->attempt($request->only('email', 'password'), $request->remember)){
            //* Colocar el mensaje en una session
            //* Regresar a la vista
            return back()->with('mensaje','Credenciales Incorrectas');
        }
        //* Si las credenciales existen ir al muro
        return redirect()->route('posts.index', auth()->user()->username);

    }
}
