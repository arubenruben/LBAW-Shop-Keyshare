'use strict'

const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const url = '/';

const spinner = document.querySelector("#spinner");

const addEventListeners = () => {
    let images = document.querySelectorAll('img');
    images.forEach(function (image) {
        let source = image.cloneNode(true).src;
        image.style.display = "block";
        image.src = 'pictures/spinner.gif';
        image.addEventListener('load', loaded.bind(image, image, source));
    });
}

const loaded = (img, src) => {
    if(img.complete) img.src = src;
    this.removeEventListener('load', loaded);
}

addEventListeners();