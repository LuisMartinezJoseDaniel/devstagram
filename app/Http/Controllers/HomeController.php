<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Solo usuario autenticados pueden ver el Home
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke()
    {
        //Obtener a quienes seguimos
        //pluck->obtener los campos que requerimos
        $ids = auth()->user()->followings->pluck('id')->toArray();
        // Obtener los post de los usuarios a quienen seguimos
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);
  
        return view('home', ['posts' => $posts]);
    }
}
