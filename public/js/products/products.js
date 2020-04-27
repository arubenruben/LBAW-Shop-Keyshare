'use strict'

const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const url = '/products';

const addEventListeners = () => {
    const sort_by_input = document.querySelectorAll("form#option input.sort-by");
    const genres_input = document.querySelectorAll("form#option input.genre");
    const platform_input = document.querySelectorAll("form#option input.platform");
    const category_input = document.querySelectorAll("form#option input.category");
    const max_price_input = document.querySelector("form#option input#price-range");
    document.querySelector("form#option label#max_price_value").innerHTML = 50;

    let sort_by = null;
    let genres_array = [];
    let platform = null;
    let category = null;

    for(let i = 0; i < sort_by_input.length; i++) {
        sort_by_input[i].addEventListener("click", () => {
            sort_by = i;
            sendPost(assembleData(sort_by_input[sort_by], genres_array, platform_input[platform], category_input[category], max_price_input)).then(res => console.log(res));
        });
    }

    for(let i = 0; i < genres_input.length; i++) {
        genres_input[i].addEventListener("click", () => {
            genres_array.push(genres_input[i]);
            sendPost(assembleData(sort_by_input[sort_by], genres_array, platform_input[platform], category_input[category], max_price_input)).then(res => console.log(res));
        });
    }

    for(let i = 0; i < platform_input.length; i++) {
        platform_input[i].addEventListener("click", () => {
            platform = i;
            sendPost(assembleData(sort_by_input[sort_by], genres_array, platform_input[platform], category_input[category], max_price_input)).then(res => console.log(res));
        });
    }

    for(let i = 0; i < category_input.length; i++) {
        category_input[i].addEventListener("click", () => {
            category = i;
            sendPost(assembleData(sort_by_input[sort_by_input], genres_array, platform_input[platform], category_input[category], max_price_input)).then(res => console.log(res));
        });
    }

    max_price_input.addEventListener("input", () => {
        document.querySelector("form#option label#max_price_value").innerHTML = max_price_input.value;
        sendPost(assembleData(sort_by_input[sort_by], genres_array, platform_input[platform], category_input[category], max_price_input)).then(res => console.log(res));
    });
}

function assembleData (sort_by, genres_array, platform, category, max_price) {
    console.log(sort_by.name)
    console.log(genres_array)
    console.log(platform.name)
    console.log(category.name)
    console.log(max_price.name)

    let data = {
        sort_by: sort_by.value,
        genres: genres_array,
        platform: platform.value,
        category: category.value,
        max_price: max_price.value
    }
    return data;
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