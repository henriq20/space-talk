/// <reference path="../../typings/globals/jquery/index.d.ts"/>

class Vote {
    constructor (voteArrows) {
        this.upvoteButton = $(voteArrows).children('button.upvote');
        this.upvoteIcon = $(this.upvoteButton).children('i');

        this.downvoteButton = $(voteArrows).children('button.downvote');
        this.downvoteIcon = $(this.downvoteButton).children('i');

        this.votesDiv = $(voteArrows).children('.votes');
    }

    upvote() {
        this.upvoteIcon.addClass('upvoted');

        if (this.downvoteIcon.hasClass('downvoted')) {
            this.downvoteIcon.removeClass('downvoted');
            this.updateVotesNumber(2);
            return;
        }
        
        this.updateVotesNumber(1);
    }
    
    downvote() {
        this.downvoteIcon.addClass('downvoted');

        if (this.upvoteIcon.hasClass('upvoted')) {
            this.upvoteIcon.removeClass('upvoted');
            this.updateVotesNumber(-2);
            return;
        }
        
        this.updateVotesNumber(-1);
    }

    undoVote() {
        if (this.upvoteIcon.hasClass('upvoted')) {
            this.upvoteIcon.removeClass('upvoted');
            this.updateVotesNumber(-1);
            return;
        }
        
        this.downvoteIcon.removeClass('downvoted');
        this.updateVotesNumber(1);
    }

    updateVotesNumber(number) {
        let votesCount = parseInt(this.votesDiv.text());
        this.votesDiv.text(votesCount + number);
    }

    vote(url) {
        $.ajax({
            type: 'POST',
            url: url,
            dataType: 'json',
            error: xhr => {
                let flashMessage = $(xhr.responseText).filter('.flash-message');
                showFlashMessage(flashMessage);
            },
            success: data => {
                switch (data) {
                    case 1:
                        this.upvote();
                        break;

                    case -1:
                        this.downvote();
                        break;
                
                    default:
                        this.undoVote();
                }
            }
        });
    }
}

function showFlashMessage(flashMessage) {
    if (!$(document.body).has('.flash-message').length) {
        $(document.body).prepend(flashMessage);
        removeFlashMessage();
    }
}