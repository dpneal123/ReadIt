<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\CommentReply;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Replies extends Component
{
    public Comment $comm;
    public $replyCount;
    public $reply_input;
    public $comment_id;

    protected $rules = [
        'reply' => 'required|min:1',
        'comment_id' => 'required|min:1',
    ];

    protected $listeners = ['repliesUpdated' => 'replyRefresh'];

    public function replyRefresh() {
        $this->replyCount = $this->comm->reply()->count();
    }

    public function addReply($comment_id) {
        $reply = new CommentReply();
        $reply->comment_id = $comment_id;
        $reply->author()->associate(Auth::user());
        $reply->reply = $this->reply_input;
        $reply->save();

        $this->reply_input = '';
        $this->emit('repliesUpdated');
        $this->emit('commentsUpdated');
    }

    public function removeReply($reply_id) {
        $reply = CommentReply::find($reply_id);
        if ($reply->user_id == Auth::id()) {
            $reply->delete();
            $this->emit('repliesUpdated');
        }
    }

    public function render()
    {
        return view('livewire.replies', ['comm' => $this->comm]);
    }
}
