<aside>
    <div class="vote-arrows" data-post-id="{{ $post->id }}">
        <button class="upvote btn btn-transparent" data-action="upvote">
            <i class="fas fa-arrow-up text-dark @auth @if (auth()->user()->upvoted($post)) upvoted @endif @endauth"></i>
        </button>
        <div class="votes">{{ abbreaviate($post->totalVotes()) }}</div>
        <button class="downvote btn btn-transparent" data-action="downvote">
            <i class="fas fa-arrow-down text-dark @auth @if (auth()->user()->downvoted($post)) downvoted @endif @endauth"></i>
        </button>
    </div>
</aside>