@extends('layouts.main')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
    @include('inc.navbar')
    <main class="container">
        <section id="post" class="bg-dark-lighter">
            <aside>
                <form id="form" action="/posts/upvote/{{ $post->id }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-transparent" data-post-id="{{ $post->id }}" data-action="upvote"><i class="fas fa-arrow-up text-dark"></i></button>
                    <div class="votes">9</div>
                    <button class="btn btn-transparent" data-action="downvote"><i class="fas fa-arrow-down text-dark"></i></button>
                </form>
            </aside>
            <main>
                <div class="author">
                    <img src="/img/user-one.jpg" class="author-picture">
                    <p class="text-dark">
                        Posted By <span class="author-name">{{ $post->user->username }}</span> {{ $post->created_at->diffForHumans() }}
                    </p>
                </div>
                <hr>
                <div class="content">
                    <h2>{{ $post->title }}</h2>
                    <pre>{{ $post->body }}</pre>
                </div>
                <footer>
                    <i class="fas fa-comments text-dark"></i>
                    <span class="comments">500</span>
                </footer>
            </main>
        </section> 
    </main>
@endsection