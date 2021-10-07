document.querySelectorAll('.post-summary').forEach(post => {
    post.addEventListener('click', function () {
        location.href = post.getAttribute('data-click-link');
    });

    truncate(post.querySelector('.content > p'), 1500);
});

document.addEventListener('scroll', function () {
    if (getScrollPosition() >= 85) {
        loadPosts();
    }
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

function getScrollPosition() {
    return scrollY / (document.documentElement.scrollHeight - innerHeight) * 100;
}

let isAjaxRunning = false;
let currentPage = 1;

function loadPosts() {
    if (isAjaxRunning) {
        return;
    }

    let xhr = new XMLHttpRequest();
    xhr.open('GET', getNextPage(), true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

    xhr.onload = function () {
        if (this.status === 200) {  
            let div = document.createElement('div');
            div.innerHTML = this.response;

            let posts = div.querySelectorAll('main.container > .post');
            let main = document.querySelector('main.container');

            posts.forEach(post => {
                main.appendChild(post);
            });

            isAjaxRunning = false;
        }
    };
    
    xhr.send();
    isAjaxRunning = true;
}

function getNextPage() {
    return '?page=' + ++currentPage;
}