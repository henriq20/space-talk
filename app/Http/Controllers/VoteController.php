<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Str;

class VoteController extends Controller
{
    public function vote(int $id, int $value)
    {
        $table = $this->getVotingTable();
        $model = $table == 'comments' ? Comment::find($id) : Post::find($id);

        if ($model == null) {
            return response()->json('Not found');
        }

        if ($this->wantsToUndoVote($model, $value)) {
            $model->votes()->delete($id);
            return response()->json(0);
        }

        $foreignKey = Str::singular($table) . '_id';

        $model->votes()->updateOrCreate([$foreignKey => $model->id, 'voter_id' => auth()->id()], [
            $foreignKey => $model->id,
            'voter_id' => auth()->id(),
            'value' => $value
        ]);

        return response()->json($value);
    }

    private function wantsToUndoVote($model, $value)
    {
        return user()->upvoted($model) && $value == 1 || user()->downvoted($model) && $value == -1;
    }

    private function getVotingTable()
    {
        return str_starts_with(request()->getRequestUri(), '/posts/comments/')
            ? 'comments'
            : 'posts';
    }
}
