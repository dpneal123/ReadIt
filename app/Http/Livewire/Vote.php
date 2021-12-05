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

    protected function voteExists($voteData)
    {
        return PostVote::where([
            'post_id' => $voteData['post_id'],
            'user_id' => $voteData['user_id'],
        ])->exists();
    }

    protected function addVote($post_id, $user_id, $isUp)
    {
        PostVote::create([
            'post_id' => $post_id,
            'user_id' => $user_id,
            'isUp' => $isUp
        ]);
    }

    public function upVote($post)
    {
        $user = Auth::id();
        $postId = $post["id"];

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
        $postId = $post["id"];

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
//        dd($this->post);
        return view('livewire.vote', ['post' => $this->post]);
    }
}
