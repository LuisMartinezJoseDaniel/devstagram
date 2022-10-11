<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Post;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    //* Fillable -> Datos que se insertarán en la tabla
    protected $fillable = [
        'name',
        'email',
        'password',
        'username', //* Campo que hemos agregado manualmente
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // One to many -> hasMany(Post::class, 'foreign_key')
    // sin especificar el foreign key, laravel sabe que se hace referencia por las convenciones
    // en este caso Post tiene user_id -> laravel lo infiere
    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    // Almacenar los seguidores de un usuario
    // La tabla de followers pertenece a muchos usuarios
    public function followers(){
        // Al salirnos de la convencion de Laravel, hay que especificar a que tabla pertenece la relacion
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    //Almacenar los que seguimos
    public function followings(){
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }

    //Comprobar si un usuario ya sigue a otro
    public function siguiendo(User $user){
        // Este usuario en todos los registro s de followers contiene al usuario
        return $this -> followers -> contains($user->id);
    }



}
