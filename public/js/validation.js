/// <reference path="../../typings/globals/jquery/index.d.ts" />

const form = document.querySelector('form');

document.getElementById('js-validate-inputs').addEventListener('click', validateInputs);

function validateInputs(e) {
    e.preventDefault();

    let xhr = new XMLHttpRequest();
    xhr.open('POST', location.href, true);
    xhr.setRequestHeader('Accept', 'application/json');
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

    xhr.onload = function () {
        if (hasErrors(this.responseText)) {
            displayErrors(JSON.parse(this.responseText).errors);
        } else {
            form.submit();
        }
    };

    xhr.send(new FormData(form));
}

function hasErrors(responseText) {
    return responseText !== '[]';
}

function displayErrors(errors = {}) {
    form.querySelectorAll('input.text-input').forEach(input => {
        let errorMessage = errors[input.name];

        if (errorMessage !== undefined) {
            addError(input, errorMessage);
        } else {
            removeErrorIfExists(input);
        }
    });
}

function addError(input, message) {
    let elementAfterInput = input.nextElementSibling;
    
    if (isParagraph(elementAfterInput)) {
        elementAfterInput.innerHTML = message;
        return;
    }
    
    let p = createError(message);

    input.classList.add('is-invalid');
    input.parentNode.insertBefore(p, input.nextElementSibling);
}

function removeErrorIfExists(input) {
    let elementAfterInput = input.nextElementSibling;
    
    if (isParagraph(elementAfterInput)) {
        input.classList.remove('is-invalid');
        input.parentNode.removeChild(elementAfterInput);
    }
}

function createError(message) {
    let p = document.createElement('p');
    p.innerHTML = message;
    p.classList.add('error-message');

    return p;
}

function isParagraph(element) {
    return element !== null && element.nodeName === 'P';
}