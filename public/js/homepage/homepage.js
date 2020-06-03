'use strict'

const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const url = '/';

const spinner = document.querySelector("#spinner");
const startSpinners = () => {
    let images = document.querySelectorAll('img');
    images.forEach(function (image) {
        image.src = 'pictures/spinner.gif';
    })
}


const addEventListeners = () => {
    let images = document.querySelectorAll('img');
    images.forEach(function (image) {
        let source = image.cloneNode(true).src;
        image.src = 'pictures/spinner.gif';
        console.log(source)
        console.log(image.src)
        //image.addEventListener('load', loaded.bind(image, image, src));
    })
}

const loaded = (img, src) => {
    if(img.complete) {
        img.src = src;
    }
}

startSpinners();
addEventListeners();
