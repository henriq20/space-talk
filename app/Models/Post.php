<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'title',
        'body',
        'tags'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function totalVotes()
    {
        return $this->votes()->sum('value');
    }

    public function scopeSearch($query, $value)
    {
        $escapedValue = str_replace(['%', '_'], ['\%', '\_'], $value);

        return $query->where('title', 'LIKE', "%$escapedValue%")
                     ->orWhere('tags', 'LIKE', "%$escapedValue%")
                     ->get();
    }
}
