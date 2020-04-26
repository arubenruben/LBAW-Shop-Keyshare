'use strict'

//const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
//const url = '/user';

const addEventListeners = () => {
    let form = document.querySelector("form#option");
    let genresArray = [];

    const sort_by = document.querySelector("form#option input.sort-by");
    const genres = document.querySelectorAll("form#option input.genre");
    const platform = document.querySelector("form#option input.platform");
    const category = document.querySelector("form#option input.category");
    const max_price = document.querySelector("form#option input#price-range");

    sort_by.addEventListener("onchange", () => {
        sendPost(assembleData()).then(res => console.log(res));
    });

    for(let genre in genres) {
        genre.addEventListener("onchange", () => {
            genresArray.push(genre.value);
            sendPost(assembleData()).then(res => console.log(res));
        });
    }

    platform.addEventListener("onchange", () => {
        sendPost(assembleData()).then(res => console.log(res));
    });

    category.addEventListener("onchange", () => {
        sendPost(assembleData()).then(res => console.log(res));
    });


    max_price.addEventListener("onchange", () => {
        sendPost(assembleData()).then(res => console.log(res));
    });
}

function assembleData () {
    return {
        sort_by: sort_by.value,
        genres: genresArray,
        platform: platform.value,
        category: category.value,
        max_price: max_price.value
    }
}

const sendPost = post => {
    const options = {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token
        },
        method: 'post',
        credentials: "same-origin",
        body: JSON.stringify(post)
    }

    return fetch("/user/", options)
        .then(res => res.json())
        .catch(error => console.error("Error: {error}"));
}

addEventListeners();