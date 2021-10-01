@extends('layouts.main')

@section('title', 'Home - SpaceTalk')

@section('content')
    @include('inc.navbar')
    @if (session('store_post_success'))
        <div class="flash-message bg-success" id="js-flash-message">
            {{ session('store_post_success') }}
        </div>
    @endif
    <main class="container">
        @auth
            <div class="row">
                <a href="/posts/create" class="btn btn-primary">New Post</a>
            </div>
            <hr>
        @endauth
        @foreach ($posts as $post)
            <section id="post" class="bg-dark-lighter">
                <aside>
                    <form id="form" action="/posts/upvote/{{ $post->id }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-transparent"><i class="fas fa-arrow-up text-dark"></i></button>
                        <div class="votes">0</div>
                        <button class="btn btn-transparent"><i class="fas fa-arrow-down text-dark"></i></button>
                    </form>
                </aside>
                <main>
                    <header>
                        <div class="author">
                            <img src="/img/user-one.jpg" class="author-picture">
                            <p class="text-dark">
                                Posted By <span class="author-name">{{ $post->user->username }}</span> {{ $post->created_at->diffForHumans() }}
                            </p>             
                        </div>
                        @auth
                            @if (auth()->id() === $post->user_id)
                                <div class="actions">
                                    <a href="/posts/edit/{{ $post->id }}" class="btn btn-dark">Edit</a>
                                    <form action="/posts/destroy/{{ $post->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" class="btn btn-dark" value="Delete">
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </header>
                    <hr>
                    <a href="/posts/show/{{ $post->id }}" class="content text-white">
                        <h2>{{ $post->title }}</h2>
                        <p class="text-dark">{{ $post->body }}</p>
                    </a>
                    <footer>
                        <i class="fas fa-comments text-dark"></i>
                        <span class="comments">500</span>
                    </footer>
                </main>
            </section>
        @endforeach
    </main>

    <script src="/js/home.js"></script>
@endsection