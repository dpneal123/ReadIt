<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google2fa_secret',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'google2fa_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

//    public function setGoogle2faSecretAttribute($value)
//    {
//        $this->attributes['google2fa_secret'] = encrypt($value);
//    }
//
//    public function getGoogle2faSecretAttribute($value)
//    {
//        return decrypt($value);
//    }

    public function post() {
        return $this->hasMany(Post::class);
    }

    public function vote() {
        return $this->hasMany(PostVote::class);
    }

    public function forum() {
        return $this->hasMany(UserForum::class);
    }

    public function comment() {
        return $this->hasMany(Comment::class);
    }

    public function reply() {
        return $this->hasMany(CommentReply::class);
    }

}
