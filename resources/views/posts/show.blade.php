@extends('layouts.main')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
    @include('inc.navbar')
    <main class="container">
        @include('inc.post-article')
        <section id="discussion" class="bg-dark-lighter">
            <h2>Discussion</h2>
            <form action="/posts/{{ $post->id }}/comments" method="POST">
                @csrf
                <textarea name="body" placeholder="Leave a comment"></textarea>
                <input type="submit" value="Comment" class="btn btn-primary" disabled>
                
                <script>
                    const submit = document.querySelector('input[value="Comment"]');
                    
                    // Disables the submit button when the textarea is empty; otherwise, enables it.
                    document.querySelector('textarea[name="body"]').addEventListener('input', e => {
                        if (e.currentTarget.value.length > 0) {
                            submit.removeAttribute('disabled');
                            return;
                        }

                        submit.setAttribute('disabled', '');
                    });
                </script>
            </form>
            @foreach ($comments as $comment)  
                <div class="comment bg-dark-lighter">
                    <aside>
                        <img src="/img/user-one.jpg" class="author-picture">
                        <div class="vertical-line"></div>
                    </aside>
                    <main>
                        <div class="author">
                            <div class="text-dark">
                                <a href="/users/{{ $comment->author->username }}" class="author-name">{{ $comment->author->username }}</a>
                                {{ $comment->created_at->diffForHumans() }}
                            </div>
                        </div>
                        <div class="content">
                            <pre>{{ $comment->body }}</pre>
                        </div>
                        <div class="actions">
                            <div class="vote-arrows" data-comment-id="{{ $comment->id }}">
                                <button class="upvote btn btn-transparent" data-action="upvote">
                                    <i class="fas fa-arrow-up text-dark"></i>
                                </button>
                                <div class="votes">0</div>
                                <button class="downvote btn btn-transparent" data-action="downvote">
                                    <i class="fas fa-arrow-down text-dark"></i>
                                </button>
                            </div>
                        </div>
                    </main>
                </div>
            @endforeach
        </section>
    </main>
    <script src="/js/votes.js"></script>
    <script src="/js/posts.js"></script>
@endsection