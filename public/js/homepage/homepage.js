'use strict'

const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const url = '/';

const addEventListeners = () => {
    document.querySelectorAll('img').forEach(function (image) {
        if(image.style.display === 'none') {
            let source = image.cloneNode(true).src;
            image.style.display = 'block';
            image.src = 'pictures/spinner.gif';
            console.log('adding new event listener')
            image.addEventListener('load', loaded.bind(image, image, source));
        }
    });
}

const loaded = (img, src) => {
    if(img.complete) img.src = src;
    this.removeEventListener('load', loaded);
}

addEventListeners();