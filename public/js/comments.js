const form = document.getElementById('store-comment-form');
const storeComment = document.getElementById('store-comment');

storeComment.addEventListener('click', e => {
    e.preventDefault();
    
    let xhr = new XMLHttpRequest();
    xhr.open('POST', form.getAttribute('action'), true);
    xhr.setRequestHeader('Accept', 'application/json');
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);

    xhr.onload = function () {
        if (this.status === 200) {
            console.log(this.responseText);
        }
    };

    xhr.send(new FormData(form));
});