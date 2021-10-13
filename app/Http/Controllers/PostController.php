<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post');
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display all the posts.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = request()->query('q')
            ? Post::search(request()->query('q'))
            : Post::paginate(15);

        return view('home', ['posts' => $posts]);
    }

    /**
     * Show the page for creating a new post.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created post into the database.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required'
        ]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json();
        }

        Post::create($request->input());

        return redirect('/')->
               with('action_success', 'Post created!');
    }

    /**
     * Display the specified post.
     * @param  Post  $post The post to show.
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post, 'comments' => $post->comments]);
    }

    /**
     * Show the page for editing the specified post.
     * @param  Post  $post The post to edit.
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post  $post The post to update.
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required'
        ]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json();
        }

        $post = $post->fill($request->input());
        $post->save();

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     * @param  Post  $post The post to delete
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('action_success', 'Your post was deleted.');
    }
}
