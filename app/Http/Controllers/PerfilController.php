<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        return view('perfil.index');
    }
    public function store(Request $request){
        $request->request->add(['username' => Str::slug($request->username)]);
        //not_in -> lista negra que el usuario no puede tener como nombre
        //in: CLIENTE -> util para roles, el usuario solo puede elegir los que estan en la lista
        // 'unique:users,username,' . auth()->user()->id -> permitir que el usuario guarde su mismo nombre
        $validated = $request->validate([
            'username' => ['required','unique:users,username,' . auth()->user()->id,'min:3','max:30', 'not_in:twitter,editar-perfil'],
            'email' => ['required','unique:users,email,' . auth()->user()->id,'email','max:60'],

        ]);

        if($request->password || $request -> nuevo_password){
            $request -> validate([
                'password' => 'required',
                'nuevo_password' => 'required|min:6'
            ]);
            // Para nuevo password, intentar autenticar con el email y el password del request
            if(!auth()->attempt($request->only('email', 'password'))){
                return back()->withErrors(['password' => 'password incorrecto']);
            }

        }

        if($request->imagen){
                    // Similiar a la superglobal de $_FILES
            $imagen = $request->file('imagen');//Obtener la imagen
            $nombreImagen = Str::uuid()  . "." . $imagen ->extension();

            $imagenServidor = Image::make($imagen);

            $imagenServidor -> fit(1000,1000);

            //public/perfiles/image.jpg
            $imagenPath = public_path('perfiles') . "/" . $nombreImagen;
            $imagenServidor ->save($imagenPath);

        }

        //Guardar los cambios
        $nuevoPassword = $request->nuevo_password ? Hash::make($request->nuevo_password) : null;

        $usuario = User::find(auth()->user()->id);
        $usuario -> username = $request->username;
        $usuario -> email = $request->email;
        $usuario -> password = $nuevoPassword ?? auth()->user()->password;
        $usuario -> imagen = $nombreImagen ?? auth()->user()->imagen ??  null;

        $usuario -> save();


        return to_route('posts.index', $usuario);
    }
}
