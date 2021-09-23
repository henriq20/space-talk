@include('inc.header')
<main class="flex-columns">
    <div class="column">
        <img src="img/space.png" alt="" class="space">
        <div class="logo">
            <img src="img/logo.png" alt="">
            <span>SpaceTalk</span>
        </div>
    </div>
    <div class="column bg-dark">
        <form method="POST">
            @csrf
            <h1>Sign Up</h1>
            <p>The best place to talk about our vast universe.</p>

            <label for="first_name">First Name</label>
            <input type="text" class="text-input" name="first_name" value="{{ old('first_name') }}">

            <label for="username">Username</label>
            <input type="text" class="text-input" name="username" value="{{ old('username') }}">

            <label for="email">Email</label>
            <input type="email" class="text-input" name="email" value="{{ old('email') }}">
            
            <div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" class="text-input" name="password">
                </div>
                <div>
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" class="text-input" name="confirm_password">
                </div>
            </div>
            
            <input type="submit" class="btn btn-primary" value="Sign Up">
        </form>
    </div>
</main>
@include('inc.footer')