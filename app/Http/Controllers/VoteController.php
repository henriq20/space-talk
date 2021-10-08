<?php

namespace App\Http\Controllers;

use App\Models\Post;

class VoteController extends Controller
{
    public function upvote(Post $post)
    {
        // If the user has already upvoted the post, then deletes the vote
        if (user()->upvoted($post)) {
            user()->votes()->where('post_id', $post->id)->delete();

            return response()->json(['status' => 'deleted']);
        }

        $this->vote($post, true);

        return response()->json(['status' => 'upvoted']);
    }

    public function downvote(Post $post)
    {
        // If the user has already downvoted the post, then deletes the vote
        if (user()->downvoted($post)) {
            user()->votes()->where('post_id', $post->id)->delete();

            return response()->json(['status' => 'deleted']);
        }

        $this->vote($post, false);

        return response()->json(['status' => 'downvoted']);
    }

    private function vote(Post $post, bool $value)
    {
        $post->votes()->updateOrCreate(['user_id' => user()->id, 'post_id' => $post->id], [
            'user_id' => $post->user_id,
            'post_id' => $post->id,
            'value' => $value
        ]);
    }
}
