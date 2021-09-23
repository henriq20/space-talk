// setInterval(() => {
//     location.reload();
// }, 1000);

const inputs = document.querySelectorAll('input.text-input');

inputs.forEach(input => {
    input.addEventListener('mouseover', () => {
        if (document.activeElement !== input) {
            input.classList.add('text-input-hover-animation');
            input.classList.remove('text-input-focus-animation');
        }
    });

    input.addEventListener('mouseout', () => {
        input.classList.remove('text-input-hover-animation');
    });

    input.addEventListener('focus', () => {
        input.classList.remove('text-input-hover-animation');
        setTimeout(() => {
            input.classList.add('text-input-focus-animation');
        }, 100);
    });
    
    input.addEventListener('focusout', () => {
        input.classList.remove('text-input-focus-animation');
    });
});