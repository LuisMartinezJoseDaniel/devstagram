<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;
    //?Para deshabilitar la asignacion masiva a todos los modelos app/Models/Providers/AppServiceProvider
    //* guarded es opuesto a fillable, se definen los campos que NO pueden asignarse de forma masiva
    //* guarded -> como arreglo vacío deshabilita la protección como asignacion masiva
    // es decir deja pasar todos los campos
    //! UNICA REGLA -> NUNCA UTILIZARLO con $request ->all(), en los metodos create y update del controlador
    //! ya que, dejaría pasar todos los campos, incluidos los token y tipos de metodos
    protected $guarded = [];

    // belongsTo -> un comentario pertenece a un usuario
    public function user(){
        return $this->belongsTo(User::class);
    }
}
