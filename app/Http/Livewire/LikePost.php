<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    /* request NO ESTA DISPONIBLE EN LIVEWIRE */
    // public $mensaje = "Hola mundo de livewire";
    public $post;
    public $isLiked;
    public $likes;

    /* esto es un contructor de livewire */
    public function mount($post) {
        $this->isLiked = $post->checkLike(auth()->user());
        $this->likes = $post->likes->count();
    }

    public function like()
    {
        /* checkLike viene del modelo de post y funciona para devolver true o false si contiene el id del usuario */
        if ($this->post->checkLike(auth()->user())) {
            $this->post->likes()->where('post_id', $this->post->id)->delete();
            $this->isLiked = false;
            $this->likes--;
        } else {
            $this->post->likes()->create([
                'user_id' => auth()->user()->id
            ]);
            $this->isLiked = true;
            $this->likes++;
        }
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
