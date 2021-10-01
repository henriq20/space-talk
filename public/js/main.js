const textAreas = document.querySelectorAll('textarea');
const flashMessage = document.getElementById('js-flash-message');

if (flashMessage !== null) {
    removeFlashMessage();
}

textAreas.forEach(textArea => fitContent(textArea));

textAreas.forEach(textArea => textArea.addEventListener('keyup', () => {
    fitContent(textArea);
}));

/**
 * Removes the flash message after 4 seconds.
 * @param {number} timeout 
 */
function removeFlashMessage() {
    setTimeout(() => {
        flashMessage.parentNode.removeChild(flashMessage);
    }, 4000);
}

/**
 * Auto resizes the textArea's height when content is too long.
 * @param {HTMLTextAreaElement} textArea 
 */
function fitContent(textArea) {
    textArea.style.height = 'auto';
    textArea.style.height = textArea.scrollHeight + 'px';
}
