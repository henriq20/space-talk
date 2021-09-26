const flashMessage = document.getElementById('js-flash-message');

// If not null, removes flash message after 4 seconds
if (flashMessage !== null) {
    setTimeout(() => {
        flashMessage.parentNode.removeChild(flashMessage);
    }, 4000);
}