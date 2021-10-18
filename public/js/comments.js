$('.comment .vote-arrows').each(function () {
    const voteArrows = $(this);

    $(voteArrows).find('button').each(function () {
        $(this).on('click', e => {
            e.stopPropagation();

            let commentId = $(voteArrows).data('comment-id');
            let action = $(this).data('action');

            const vote = new Vote(voteArrows);
            vote.vote(`/posts/comments/${ commentId }/vote/${ action == 'upvote' ? 1 : -1 }`);
        });
    })
});