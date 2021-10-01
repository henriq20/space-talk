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
        <div class="row">
            <a href="/posts/create" class="btn btn-primary">New Post</a>
        </div>
        <hr>
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
                    <div class="author">
                        <img src="/img/user-one.jpg" class="author-picture">
                        <p class="text-dark">
                            Posted By <span class="author-name">{{ $post->user->first_name }}</span> {{ $post->created_at->diffForHumans() }}
                        </p>
                    </div>
                    <hr>
                    <div class="content">
                        <h2>{{ $post->title }}</h2>
                        <p class="text-dark">{{ $post->body }}</p>
                        <script src="/js/home.js"></script>
                    </div>
                    <footer>
                        <i class="fas fa-comments text-dark"></i>
                        <span class="comments">500</span>
                    </footer>
                </main>
            </section>
        @endforeach
    </main>
@endsection