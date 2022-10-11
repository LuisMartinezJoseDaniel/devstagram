<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    public $post;//Se pasa a la vista automaticamente posts.show.blade
    public bool $isLiked;
    public int $likes;

    // Se ejecuta cuando se instancia la clase(similar al constructor)
    // $post se inyecta automaticamente
    public function mount($post)
    {
        $this->isLiked = $post->checkLike(auth()->user());
        $this->likes = $post->likes->count();
    }

    public function like()
    {
        // Revisar si el usuario dio like
        if($this->post->checkLike(auth()->user())){
            // El usuario ya dio like entonces eliminar el like
            $this->post->likes()->where('post_id', $this->post->id)->delete();
            $this->isLiked = false;
            $this->likes--;
        }else{
            $this->post->likes()->create([
            'user_id' => auth()->user()->id
            ]);
            $this->isLiked = true;
            $this->likes++;
        }

        return "desde la funcion de like";
    }
    public function render()
    {
        return view('livewire.like-post');
    }

}
