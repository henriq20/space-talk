<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Post $post, Request $request)
    {
        $request->validate([
            'body' => 'required'
        ]);

        Comment::create([
            'post_id' => $post->id,
            'author_id' => auth()->id(),
            'body' => $request->input('body')
        ]);

        return back();
    }
}
