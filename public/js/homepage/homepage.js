'use strict'

const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const url = '/';

const addEventListeners = () => {
    document.querySelectorAll('section#content img').forEach(function (image) {
        if(!image.complete) {
            let prev_image = image.cloneNode(true);
            image.src = 'pictures/spinner.gif';
            image.style.visibility = 'visible';

            if(prev_image.classList.contains("carousel-item")) {
                image.style = "max-width:700px; max-height: 700px !important; display:block";
                image.className = "mx-auto";
            }

            if(!image.complete)
                prev_image.addEventListener('load', loaded.bind(prev_image, image, prev_image.src, prev_image.style));
        }
    });
}

function loaded(img, src, style) {
    img.src = src;
    img.style = style;
    if(img.classList.contains("mx-auto")) img.classList.remove("mx-auto");
}

addEventListeners();