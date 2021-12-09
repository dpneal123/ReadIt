<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'active', 'user_id'];

    public function author() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function post() {
        return $this->hasMany(Post::class);
    }

    public function user() {
        return $this->hasMany(UserForum::class);
    }

    public static function boot()
    {
        parent::boot();

        static::deleted(function($forum)
        {
            $forum->post()->delete();
        });
    }

}
