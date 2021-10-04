@extends('layouts.main')

@section('title', 'Login - SpaceTalk')

@section('content')
    @if (session('action_success'))
        <div class="flash-message success" id="js-flash-message">
            <i class="fas fa-check-circle"></i>
            <div>
                <h4>Success!</h4>
                <p>{{ session('action_success') }}</p>
            </div>
        </div>
    @endif
    <main id="auth" class="flex-columns">
        <aside class="r-shadow">
            <img src="/img/milky-way.png" class="space" alt="An illustration of the Milky Way galaxy">
            <div class="attribution">
                By <a href="https://dribbble.com/shots/2212776-The-Milky-Way-Galaxy" target="_blank" class="btn btn-transparent">Aiden Guinnip</a>
            </div>
            @include('inc.logo')
        </aside>
        <div class="content">
            <p>Not a member? <a href="/register">Sign Up</a></p>
            <form action="/login" method="POST" id="validate-form">
                @csrf
                <h1>Log In</h1>
                <p>The best place to talk about our vast universe.</p>

                {{-- Username --}}
                <div class="field">
                    <label for="username">Username</label>
                    <input type="text" class="text-input" name="username" value="{{ old('username') }}">
                </div>

                {{-- Password --}}
                <div class="field">
                    <label for="password">Password</label>
                    <input type="password" class="text-input" name="password">
                </div>

                <input type="submit" class="btn btn-primary" id="js-validate-inputs" value="Log In">

                <script src="/js/validation.js"></script>
            </form>
        </div>
    </main>
@endsection