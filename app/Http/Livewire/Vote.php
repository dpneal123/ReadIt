<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\PostVote;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Vote extends Component
{
    public Post $post;
    public $postCount;

    protected $listeners = ['voteUpdated' => 'voteRefresh'];

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function voteRefresh() {
        $this->postCount = Post::count();
    }

    protected function voteExists($voteData)
    {
        return PostVote::where([
            'post_id' => $voteData['post_id'],
            'user_id' => $voteData['user_id'],
        ])->exists();
    }

    public function addVote($post_id, $user_id, $isUp)
    {
        PostVote::create([
            'post_id' => $post_id,
            'user_id' => $user_id,
            'isUp' => $isUp
        ]);
        $this->emit('voteUpdated');
    }

    public function upVote($post)
    {
        $user = Auth::id();
        $postId = $post;

        if ($this->voteExists([
            'post_id' => $postId,
            'user_id' => $user
        ])) {
            $postVote = PostVote::where([
                'post_id' => $postId,
                'user_id' => $user
            ])->get();

            if ($postVote[0]->isUp == 0) {
                $postVote[0]->delete();
                return $this->addVote($postId, $user, 1);
            } elseif ($postVote[0]->isUp == 1) {
                $postVote[0]->delete();
//                return $this->_voteRedirect();
            } else {
//                return redirect()->back();
            }
        } else {
            return $this->addVote($postId, $user, 1);
        }
    }

    public function downVote($post)
    {
        $user = Auth::id();
        $postId = $post;

        if ($this->voteExists([
            'post_id' => $postId,
            'user_id' => $user
        ])) {
            $postVote = PostVote::where([
                'post_id' => $postId,
                'user_id' => $user
            ])->get();
            if ($postVote[0]->isUp == 1) {
                $postVote[0]->delete();
                return $this->addVote($postId, $user, 0);
            } elseif ($postVote[0]->isUp == 0) {
                $postVote[0]->delete();
//                return $this->_voteRedirect();
            } else {
//                return redirect()->back();
            }
        } else {
            return $this->addVote($postId, $user, 0);
        }
    }

    public function render()
    {
        $this->emit('voteUpdated');

        $upOrDown = '';

        for ($x = 0; $x < $this->post['vote']->count(); $x++) {
            if ($this->post['vote'][$x]->user_id == Auth::id()) {
                if ($this->post['vote'][$x]->isUp === 1) {
                    $upOrDown = 'up';
                    break;
                }
                elseif ($this->post['vote'][$x]->isUp === 0) {
                    $upOrDown = 'down';
                    break;
                }
            }
            else {
                // do nothing - move to next vote
                $upOrDown = 'none';
            }
        }

        return view('livewire.vote', ['post' => $this->post, 'upOrDown' => $upOrDown]);
    }
}
