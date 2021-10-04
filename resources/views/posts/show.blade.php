@extends('layouts.main')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
    @include('inc.navbar')
    <main class="container">
        @include('inc.post-article') 
    </main>
@endsection