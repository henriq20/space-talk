@extends('layouts.main')

@section('title', 'Edit Post - SpaceTalk')

@section('content')
    @include('inc.navbar')
    <main class="container">
        <div id="card">
            <h1>Edit Post</h1>
            <hr>
            <form action="/posts/{{ $post->id }}" method="POST" id="validate-form">
                @method('PUT')
                @csrf
                <div class="field">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="text-input" value="{{ $post->title }}">
                </div>
                <div class="field">
                    <label for="body">Body</label>
                    <textarea name="body" class="text-input">{{ $post->body }}</textarea>
                </div>
                <div class="field">
                    <label for="tags">Tags</label>
                    <input type="text" name="tags" class="text-input" value="{{ $post->tags }}">
                </div>
                <input type="submit" class="btn btn-primary" id="js-validate-inputs" value="Save Changes">

                <script src="/js/validation.js"></script>
            </form>
        </div>
    </main>
@endsection