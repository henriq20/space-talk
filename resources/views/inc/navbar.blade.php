<nav id="navbar" class="b-shadow bg-dark">
    <div class="container">
        @include('inc.logo')
        <form action="/" method="GET" class="search bg-dark-lighter">
            <i class="fas fa-search"></i>
            <input type="text" name="q" placeholder="Search Posts">
        </form>
        <div class="navbar-links">
            @auth
                <div class="dropdown">
                    <a href="/{{ auth()->user()->username }}">
                        <i class="fas fa-user-circle text-dark dropdown-toggle"></i>
                    </a>
                    <div class="dropdown-menu bg-dark">
                        <a href="/users/{{ auth()->user()->username }}" class="dropdown-item">Profile</a>
                        <form action="/logout" method="POST">
                            @csrf
                            <input type="submit" value="Log out" class="dropdown-item">
                        </form>
                    </div>
                </div>
            @endauth
            @guest
                <a href="/login" class="btn btn-transparent navbar-item">Log in</a>
                <a href="/register" class="btn btn-primary navbar-item">Sign Up</a>
            @endguest
        </div>
    </div>
</nav>
