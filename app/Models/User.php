<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username'
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

    /* creando relaciones, es muy importante como nombro esta funcion */
    public function posts() {
        return $this->hasMany(Post::class); /* one to many */
        // return $this->hasMany(Post::class, 'especificar_id'); por si rompemos las convenciones y necesitamos especificar la llave foreana
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }

    /* Almacenar los seguidores de un usuario */
    public function followers() {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id'); /* hacemos esto porque nos salimos un poco de las convenciones de laravel */
    }

    /* Almacenar los que seguimos */
    public function followings() {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id'); /* hacemos esto porque nos salimos un poco de las convenciones de laravel */
    }

    /* Comprobar si un usuario ya sigue a otro */
    public function siguiendo(User $user) {
        return $this->followers->contains($user->id);
    }
}
