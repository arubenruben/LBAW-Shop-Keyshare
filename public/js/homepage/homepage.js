'use strict'

const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const url = '/';

const spinner = document.querySelector("#spinner");

const addEventListeners = () => {
    document.querySelectorAll('img').forEach(function (image) {
        let cloned = image.cloneNode(true);
        image.src = 'pictures/spinner.gif';
        cloned.addEventListener('load', loaded.bind(image, image, img.src));
    });
}

const loaded = (img, src) => {
    if(img.complete) img.src = src;
    this.removeEventListener('load', loaded);
}

addEventListeners();
