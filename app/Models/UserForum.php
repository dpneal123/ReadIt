<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserForum extends Model
{
    use HasFactory;

    protected $fillable = ['forum_id', 'user_id', 'created_at', 'updated_at'];

    protected $hidden = ['canEditForumDetails', 'canRemovePost', 'canRemoveComment'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function forum() {
        return $this->belongsTo(Forum::class, 'forum_id');
    }
}
