<?php

namespace App\Models;

use App\Models\Comentario;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

     //?Para deshabilitar la asignacion masiva a todos los modelos app/Models/Providers/AppServiceProvider
    //* guarded es opuesto a fillable, se definen los campos que NO pueden asignarse de forma masiva
    //* guarded -> como arreglo vacío deshabilita la protección como asignacion masiva
    // es decir deja pasar todos los campos
    //! UNICA REGLA -> NUNCA UTILIZARLO con $request ->all(), en los metodos create y update del controlador
    //! ya que, dejaría pasar todos los campos, incluidos los token y tipos de metodos
    protected $guarded = [];

    // Un post pertenece a un usuario, [solo los campos que se requiere]
    public function user(){
        return $this->belongsTo(User::class)->select(['name','username']);
    }

    public function comentarios(){
        return $this->hasMany(Comentario::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }
    // Revisar si en la columna user_id , ya existe el usuario que le dio Like
    public function checkLike(User $user){
        return $this->likes->contains('user_id',$user->id);
    }

}
