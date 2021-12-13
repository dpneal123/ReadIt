<?php

namespace App\Http\Livewire;

use App\Models\Forum;
use App\Models\Post;
use Livewire\Component;

class Search extends Component
{
    public $search = '';

    public function render()
    {
        if (strlen($this->search) > 0) {
            $posts = Post::where('title', 'like', '%'.$this->search.'%')->get();
            $forums = Forum::where('name', 'like', '%'.$this->search.'%')->orWhere('description', 'like', '%'.$this->search.'%')->get();
        }
        else {
            $posts = null;
            $forums = null;
        }
        return view('livewire.search', [
            'posts' => $posts,
            'forums' => $forums
        ]);
    }
}
