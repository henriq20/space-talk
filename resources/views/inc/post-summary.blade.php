<section class="post post-summary bg-dark-lighter" data-click-link="/posts/{{ $post->id }}">
    @include('inc.post-aside')
    <main>
        <header>
            <div class="author">
                <img src="/img/user-one.jpg" class="author-picture">
                <div class="text-dark">
                    Posted By
                    <a href="/users/{{ $post->author->username }}" class="author-name">{{ $post->author->username }}</a>
                    {{ $post->created_at->diffForHumans() }}
                </div>
            </div>
            @auth
                @if (auth()->id() === $post->user_id)
                    <div class="actions">
                        <a href="/posts/{{ $post->id }}/edit" class="btn">Edit</a>
                        <form action="/posts/{{ $post->id }}/delete" method="GET" class="js-delete-post">
                            @csrf
                            <input type="submit" class="btn" value="Delete">
                        </form>
                    </div>
                @endif
            @endauth
        </header>
        <hr>
        <div class="content">
            <h2>{{ $post->title }}</h2>
            <p class="text-dark">{{ $post->body }}</p>
        </div>
        <footer>
            <i class="far fa-comment-alt text-dark"></i>
            <span class="comments">{{ $post->comments()->count() }}</span>
        </footer>
    </main>
</section>