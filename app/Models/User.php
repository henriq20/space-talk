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
        return $this->hasMany(Post::class, 'author_id');
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function upvoted(Post|Comment $entity)
    {
        return $this->voted($entity, 1);
    }

    public function downvoted(Post|Comment $entity)
    {
        return $this->voted($entity, -1);
    }

    private function voted(Post|Comment $entity, int $value)
    {
        return $entity->votes()->where('voter_id', auth()->id())
                               ->where('value', $value)
                               ->exists();
    }
}
