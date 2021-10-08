function vote(url, asideElement) {
    let xhr = new XMLHttpRequest();
    xhr.open('POST', url, true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);

    const upvotedEvent = new CustomEvent('upvoted', { detail: getDetails(asideElement) });
    const downvotedEvent = new CustomEvent('downvoted', { detail: getDetails(asideElement) });
    const voteUndoneEvent = new CustomEvent('voteUndone', { detail: getDetails(asideElement) });

    xhr.onload = function () {
        // Not logged in
        if (this.responseURL.endsWith('/login')) {
            console.log(this.responseURL);
            let loginPage = new DOMParser().parseFromString(this.responseText, 'text/html');
            let flashMessage = loginPage.querySelector('.flash-message');
            showFlashMessage(flashMessage);

            return;
        }

        let data = JSON.parse(this.responseText);

        switch (data.status) {
            case 'upvoted':
                document.dispatchEvent(upvotedEvent);
                break;
            
            case 'downvoted':
                document.dispatchEvent(downvotedEvent);
                break;
        
            default:
                document.dispatchEvent(voteUndoneEvent);
                break;
        }
    };

    xhr.send();
}

function getDetails(asideElement) {
    return {
        votesDiv: asideElement.querySelector('.votes'),
        upvoteButton: asideElement.querySelector('button.upvote'),
        upvoteIcon: asideElement.querySelector('button.upvote > i'),
        downvoteButton: asideElement.querySelector('button.downvote'),
        downvoteIcon: asideElement.querySelector('button.downvote > i')
    };
}

function showFlashMessage(flashMessage) {
    if (document.querySelector('.flash-message') === null) {
        document.body.appendChild(flashMessage);
        removeFlashMessage();
    }
}

document.addEventListener('upvoted', function(e) {
    e.detail.upvoteIcon.classList.add('upvoted');

    if (e.detail.downvoteIcon.classList.contains('downvoted')) {
        e.detail.downvoteIcon.classList.remove('downvoted');
        e.detail.votesDiv.textContent = Number(e.detail.votesDiv.textContent) + 2;
        return;
    }
    
    e.detail.votesDiv.textContent = Number(e.detail.votesDiv.textContent) + 1;
});

document.addEventListener('downvoted', function(e) {
    e.detail.downvoteIcon.classList.add('downvoted');

    if (e.detail.upvoteIcon.classList.contains('upvoted')) {
        e.detail.upvoteIcon.classList.remove('upvoted');
        e.detail.votesDiv.textContent = Number(e.detail.votesDiv.textContent) - 2;
        return;
    }
    
    e.detail.votesDiv.textContent = Number(e.detail.votesDiv.textContent) - 1;
});

document.addEventListener('voteUndone', function(e) {
    if (e.detail.upvoteIcon.classList.contains('upvoted')) {
        e.detail.upvoteIcon.classList.remove('upvoted');
        e.detail.votesDiv.textContent = Number(e.detail.votesDiv.textContent) - 1;
        return;
    }
    
    e.detail.downvoteIcon.classList.remove('downvoted');
    e.detail.votesDiv.textContent = Number(e.detail.votesDiv.textContent) + 1;
});