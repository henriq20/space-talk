@extends('layouts.main')

@section('title', 'Home - SpaceTalk')

@section('content')
    @include('inc.navbar')
    <main class="container">
        @auth
            <div class="row">
                <a href="/posts/create" class="btn btn-primary">New Post</a>
            </div>
            <hr>
        @endauth
        @foreach ($posts as $post)
            @include('inc.post-summary')
        @endforeach
    </main>

    <script src="/js/votes.js"></script>
    <script src="/js/posts.js"></script>
@endsection