<aside>
    <form id="form" action="/posts/upvote/{{ $post->id }}" method="POST">
        @csrf
        <button type="submit" class="upvote btn btn-transparent" data-post-id="{{ $post->id }}">
            <i class="fas fa-arrow-up text-dark"></i>
        </button>
        <div class="votes">{{ $post->totalVotes() }}</div>
        <button class="btn btn-transparent"><i class="fas fa-arrow-down text-dark"></i></button>
    </form>
</aside>