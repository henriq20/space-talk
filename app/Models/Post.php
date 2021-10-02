<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'body',
        'tags'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearch($query, $value)
    {
        $escapedValue = str_replace(['%', '_'], ['\%', '\_'], $value);

        return $query->where('title', 'LIKE', "%$escapedValue%")
                     ->orWhere('tags', 'LIKE', "%$escapedValue%")
                     ->get();
    }
}
