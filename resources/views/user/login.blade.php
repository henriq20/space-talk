@include('inc.header')
@if (session('register_success'))
    <div class="flash-message bg-success" id="js-flash-message">
        {{ session('register_success') }}
    </div>
@endif
<main id="auth" class="flex-columns">
    <aside class="r-shadow">
        <img src="img/milky-way.png" class="space" alt="An illustration of two astronauts watching the space through a window inside a spaceship">
        @include('inc.logo')
    </aside>
    <div class="content bg-dark">
        <p>Not a member? <a href="/register">Sign Up</a></p>
        <form action="/login" method="POST">
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

            <script src="js/validation.js"></script>
        </form>
    </div>
</main>
@include('inc.footer')