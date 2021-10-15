/// <reference path="../../typings/globals/jquery/index.d.ts"/>

document.querySelectorAll('.post-summary').forEach(post => {
    post.addEventListener('click', function () {
        location.href = post.getAttribute('data-click-link');
    });

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

function getScrollPosition() {
    return scrollY / (document.documentElement.scrollHeight - innerHeight) * 100;
}

let isAjaxRunning = false;
let currentPage = 1;

function loadPosts() {
    if (isAjaxRunning) {
        return;
    }

    $.ajax({
        type: 'GET',
        url: getNextPage(),
        success: function (data) {
            let document = $.parseHTML(data);
            $('main.container').append($(document).find('.post'));

            isAjaxRunning = false;
        }
    });

    isAjaxRunning = true;
}

function getNextPage() {
    return '?page=' + ++currentPage;
}

$('.vote-arrows').each(function () {
    const voteArrows = $(this);

    $(voteArrows).find('button').each(function () {
        $(this).on('click', e => {
            e.stopPropagation();

            let postId = $(voteArrows).data('post-id');
            let action = $(this).data('action');

            const vote = new Vote(voteArrows);
            vote.vote(`/posts/${ postId }/${ action }`);
        });
    })
});

$('.post .js-delete-post').each((i, form) => {
    $(form).children('input:submit').on('click', e => {
        e.preventDefault();
        e.stopPropagation();

        $.ajax({
            type: 'GET',
            url: $(form).attr('action'),
            success: function (popup) {
                $('body').prepend(popup);
            }
        });
    });
});