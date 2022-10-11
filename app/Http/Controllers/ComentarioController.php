<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    /**
     * @param $user -> Usuario propietario del post, no el usuario que comenta 
     * */ 
    public function store(Request $request, User $user, Post $post)
    {
        //validar
        $validated = $request ->validate([
            'comentario' => 'required|max:255'
        ]);

        Comentario::create([
            
            'user_id' => auth()->user()->id, //Obtener el usuario que comenta
            'post_id' => $post->id,
            'comentario'=> $request-> comentario
        ]);

        

        // Retornar a la pantalla que envio la peticion
        return back()->with('mensaje', 'Comentario realizado correctamente');
    }
}
