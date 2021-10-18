/// <reference path="../../typings/globals/jquery/index.d.ts"/>

document.querySelectorAll('textarea').forEach(textArea => {
    textArea.addEventListener('input', fitContent);
});

/**
 * Auto resizes the textArea's height when content is too long.
 * @param {Event} e 
 */
function fitContent(e) {
    let textArea = e.currentTarget;
    let offset = textArea.offsetHeight - textArea.clientHeight;
    
    textArea.style.height = 'auto';
    textArea.style.height = textArea.scrollHeight + offset + 'px';
}

// const popup = document.getElementById('popup');

// popup.querySelector('input[value="Cancel"]').addEventListener('click', () => {
//     document.body.removeChild(popup);
// });

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});