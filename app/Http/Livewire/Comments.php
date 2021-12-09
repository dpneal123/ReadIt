<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Comments extends Component
{
    public Post $post;
    public $comment_input;

    protected $rules = [
        'comment' => 'required|min:1',
        'post' => 'required|min:1',
    ];

    protected $listeners = ['commentsUpdated' => 'commentRefresh'];

    public function commentRefresh() {
        $this->commentCount = $this->post->comment->count();
    }

    public function addComment() {
        $comment = new Comment();
        $comment->post_id = $this->post['id'];
        $comment->author()->associate(Auth::user());
        $comment->comment = $this->comment_input;
        $comment->save();

        $this->comment_input = '';
        $this->emit('commentsUpdated');
    }

    public function removeComment($comment_id) {
        $comment = Comment::find($comment_id);
        if ($comment->user_id == Auth::id())
        {
            $comment->delete();
            $this->emit('commentsUpdated');
        }
    }

    public function render()
    {
        return view('livewire.comments', ['post' => $this->post]);
    }
}
