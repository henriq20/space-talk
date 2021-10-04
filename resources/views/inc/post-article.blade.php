<section class="post post-article bg-dark-lighter">
    @include('inc.post-aside')
    <main>
        <div class="author">
            <img src="/img/user-one.jpg" class="author-picture">
            <div class="text-dark">
                Posted By
                <a href="/users/{{ $post->author->username }}" class="author-name">{{ $post->author->username }}</a>
                {{ $post->created_at->diffForHumans() }}
            </div>
        </div>
        <hr>
        <div class="content">
            <h2>{{ $post->title }}</h2>
            <pre>{{ $post->body }}</pre>
        </div>
        <footer>
            <i class="fas fa-comments text-dark"></i>
            <span class="comments">500</span>
        </footer>
    </main>
</section>