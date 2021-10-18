<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'author_id',
        'title',
        'body',
        'tags'
    ];

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function votes()
    {
        return $this->hasMany(PostVote::class);
    }

    public function scopeSearch($query, $value)
    {
        $escapedValue = str_replace(['%', '_'], ['\%', '\_'], $value);

        return $query->where('title', 'LIKE', "%$escapedValue%")
                     ->orWhere('tags', 'LIKE', "%$escapedValue%")
                     ->get();
    }
}
