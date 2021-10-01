const posts = document.querySelectorAll('#post');

posts.forEach(post => {
    truncate(post.querySelector('.content > p'), 1500);
});

/**
 * Truncates the text content of the element if its length is greather than the
 * provided length.
 * @param {HTMLElement} element
 * @param {number} length
 */
function truncate(element, length) {
    if (element.innerText.length > length) {
        element.innerText = element.innerText.slice(0, 1000);
        element.classList.add('text-opacity');
    }
}