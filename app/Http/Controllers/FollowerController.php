<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function store( User $user, Request $request)
    {
        // $user -> Es el perfil que vemos
        // $user va a ser seguido por el que esta autenticado
        // attach-> para relacion de muchos a muchos (entre usuarios)
        $user->followers()->attach(auth()->user()->id);
        return back();
    }

    public function destroy (User $user)
    {
        // Eliminar en una relacion entre usuarios
        // detach para eliminar de los followers el usuario que esta autenticado
        $user -> followers() -> detach(auth()->user()->id);

        return back();
    }
}
