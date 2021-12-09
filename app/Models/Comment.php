<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'post_id', 'comment'];

//    protected $with = ['CommentReply'];

    public function author() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function post() {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function reply() {
        return $this->hasMany(CommentReply::class);
    }

    public static function boot()
    {
        parent::boot();

        static::deleted(function($comment)
        {
            $comment->reply()->delete();
        });
    }
}
