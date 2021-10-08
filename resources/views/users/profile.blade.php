@extends('layouts.main')

@section('title')
    {{ $user->username }} - SpaceTalk
@endsection

@section('content')
    @include('inc.navbar')
    <main class="container">
        <h2>{{ $user->username }}</h2>
        <hr>
        @foreach ($user->posts as $post)
            @include('inc.post-summary')
        @endforeach
    </main>

    <script src="/js/votes.js"></script>
    <script src="/js/posts.js"></script>
@endsection