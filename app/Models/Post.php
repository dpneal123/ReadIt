<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'user_id', 'forum_id', 'body','published_at'];

    protected $with = ['author', 'forum'];

    public function author() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function forum() {
        return $this->belongsTo(Forum::class, 'forum_id');
    }

    public function comment() {
        return $this->hasMany(Comment::class)->orderByDesc('created_at');
    }

    public function vote() {
        return $this->hasMany(PostVote::class);
    }

}
