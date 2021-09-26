@include('inc.header')
<main id="auth" class="flex-columns">
    <aside class="r-shadow">
        <img src="img/space.png" class="space" alt="An illustration of two astronauts watching the space through a window inside a spaceship">
        <div class="author">  
            By <a href="https://dribbble.com/shots/14693095-Travelers" target="_blank" class="btn btn-transparent">Marko Stupic</a>
        </div>
        @include('inc.logo')
    </aside>
    <div class="content bg-dark">
        <p>Already have an account? <a href="/login">Log in</a></p>
        <form action="/register" method="POST">
            @csrf
            <h1>Sign Up</h1>
            <p>Join us and share your thoughts, discover more, learn, and have fun!</p>

            {{-- First Name and Username --}}
            <div class="group-field">
                <div class="field">
                    <label for="first_name">First Name</label>
                    <input type="text" class="text-input" name="first_name" value="{{ old('first_name') }}">
                </div>
                <div class="field">
                    <label for="username">Username</label>
                    <input type="text" class="text-input" name="username" value="{{ old('username') }}">
                </div>
            </div>

            {{-- Email --}}
            <div class="field">
                <label for="email">Email</label>
                <input type="email" class="text-input" name="email" value="{{ old('email') }}">
            </div>

            {{-- Password and Confirm Password --}}
            <div class="group-field">
                <div class="field">
                    <label for="password">Password</label>
                    <input type="password" class="text-input" name="password">
                </div>
                <div class="field">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" class="text-input" name="confirm_password">
                </div>
            </div>

            <input type="submit" class="btn btn-primary" id="js-validate-inputs" value="Create Account">

            <script src="js/validation.js"></script>
        </form>
    </div>
</main>
@include('inc.footer')