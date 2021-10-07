<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'post_id',
        'value'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function getValueAttribute()
    {
        return $this->attributes['value'] ? 1 : -1;
    }
}
