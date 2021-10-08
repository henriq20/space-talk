<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'username',
        'email',
        'password'
    ];

    protected $hidden = [
        'password'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function upvoted(Post $post)
    {
        return $this->voted(true, $post);
    }

    public function downvoted(Post $post)
    {
        return $this->voted(false, $post);
    }

    private function voted(bool $value, Post $post)
    {
        return $post->votes()->where('user_id', auth()->id())
                             ->where('value', $value)
                             ->exists();
    }
}
