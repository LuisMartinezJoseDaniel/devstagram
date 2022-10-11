<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct()
    {
        //* Proteger el dashboard con el middleware de auth
        $this->middleware('auth')->except(['show','index']);
    }

    public function index(User $user)
    {
        // 1. utilizando esta forma si se puede paginar
        $posts = Post::where('user_id' , $user->id)->latest()->paginate(20);
        // 2. Utilizar has many directamente en la vista, pero no se puede paginar

        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }
    public function create (){
        return view("posts.create");
    }
    public function store(Request $request){
        $validated = $request->validate(
            [
            'titulo' => 'required|min:5|max:255',
            'descripcion' => 'required|min:5',
            'imagen' => 'required'
            ]
        );

        //1. Forma de crear un registro
        // Post::create([
        //     ...$validated,
        //     'user_id' => auth()->user()->id
        // ]);
        //2. Instanciando con new Post e indicando cada atributo
        //3. utilizar hasMany definido en User
        $request->user()->posts()->create([
            ...$validated,
            'user_id' => auth()->user()->id
        ]);


        return to_route('posts.index',['user' => auth()->user()]);
    }

    public function show(User $user, Post $post){
        return view('posts.show', ['post'=> $post, 'user' => $user]);
    }

    public function destroy(Post $post)
    {
        //? En vez de hacer esto
        // if($post->user_id === auth()->user()->id){
        //     $post->delete();
        // }
        //? Crear un policy de acceso -> make:policy PostPolicy --model=Post
        $this->authorize('delete', $post);
        $post->delete();

        // Eliminar la imagen
        $imagenPath = public_path("uploads/{$post->imagen}");

        if(File::exists($imagenPath)){
            unlink($imagenPath);
            // File::delete($imagenPath); aveces funciona
        }

        return to_route('posts.index', ['user'=>auth()->user()]);
    }

}
