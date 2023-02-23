<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /* fillable es la info que se llena en la bd  */
    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
        // return $this->belongsTo(User::class)->select(['name', 'username']); especificar los atributos que queramos
    }

    public function comentarios()
    {
        return $this->hasMany(Comentarios::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function checkLike(User $user)
    {
        /* se posiciona en la table de likes y pregunta si contiene user_id */
        return $this->likes->contains('user_id', $user->id);
    }
}
