@extends('layouts.main')

@section('title', 'Create Post - SpaceTalk')

@section('content')
    @include('inc.navbar')
    <main class="container">
        <div id="card">
            <h1>Create Post</h1>
            <hr>
            <form action="/posts/store" method="POST" id="validate-form">
                @csrf
                <div class="field">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="text-input">
                </div>
                <div class="field">
                    <label for="body">Body</label>
                    <textarea name="body" class="text-input"></textarea>
                </div>
                <div class="field">
                    <label for="tags">Tags</label>
                    <input type="text" name="tags" class="text-input">
                </div>
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                <input type="submit" class="btn btn-primary" id="js-validate-inputs" value="Create">

                <script src="/js/validation.js"></script>
            </form>
        </div>
    </main>
@endsection