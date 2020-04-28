'use strict'

const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const url = '/search';

const addEventListeners = () => {
    const sort_by_input = document.querySelectorAll("form#option input.sort-by");
    const genres_input = document.querySelectorAll("form#option input.genre");
    const platform_input = document.querySelectorAll("form#option input.platform");
    const category_input = document.querySelectorAll("form#option input.category");
    const max_price_input = document.querySelector("form#option input#price-range");

    let sort_by = 2;
    sort_by_input[sort_by].checked = true;
    let genres_array = [];
    let platform = null;
    let category = null;

    for(let i = 0; i < sort_by_input.length; i++) {
        sort_by_input[i].addEventListener("click", () => {
            sort_by = i;
            sendGet(assembleData(sort_by_input[sort_by], genres_array, platform_input[platform], category_input[category], max_price_input))
                .then(res => {
                    for(let i = 0; i < res.products.length; i++) {
                        let product = document.querySelector("div.cardProductList#pos" + i);
                        product.querySelector('.card-body h6 a').innerHTML = res.products[i].name;
                        //product.querySelector('.card-body h5').innerHTML = res.products[i].price;
                    } //e se o length for menor que 9 ... fazer outro for
                })
                .catch(error => console.error("Error: " + error));
        });
    }

    for(let i = 0; i < genres_input.length; i++) {
        genres_input[i].addEventListener("click", () => {
            genres_array.push(genres_input[i].value);
            sendGet(assembleData(sort_by_input[sort_by], genres_array, platform_input[platform], category_input[category], max_price_input))
                .then(res => {
                    for(let i = 0; i < res.products.length; i++) {
                        let product = document.querySelector("div.cardProductList#pos" + i);
                        product.querySelector('.card-body h6 a').innerHTML = res.products[i].name;
                        //product.querySelector('.card-body h5').innerHTML = res.products[i].price;
                    }
                })
        });
    }

    for(let i = 0; i < platform_input.length; i++) {
        platform_input[i].addEventListener("click", () => {
            platform = i;
            sendGet(assembleData(sort_by_input[sort_by], genres_array, platform_input[platform], category_input[category], max_price_input))
                .then(res => {
                    for(let i = 0; i < res.products.length; i++) {
                        let product = document.querySelector("div.cardProductList#pos" + i);
                        product.querySelector('.card-body h6 a').innerHTML = res.products[i].name;
                        //product.querySelector('.card-body h5').innerHTML = res.products[i].price;
                    }
                });
        });
    }

    for(let i = 0; i < category_input.length; i++) {
        category_input[i].addEventListener("click", () => {
            category = i;
            sendGet(assembleData(sort_by_input[sort_by_input], genres_array, platform_input[platform], category_input[category], max_price_input))
                .then(res => {
                    for(let i = 0; i < res.products.length; i++) {
                        let product = document.querySelector("div.cardProductList#pos" + i);
                        product.querySelector('.card-body h6 a').innerHTML = res.products[i].name;
                        //product.querySelector('.card-body h5').innerHTML = res.products[i].price;
                    }
                });
        });
    }

    max_price_input.addEventListener("input", () => {
        document.querySelector("form#option label#max_price_value").innerHTML = max_price_input.value;
        sendGet(assembleData(sort_by_input[sort_by], genres_array, platform_input[platform], category_input[category], max_price_input)).then(res => {
            for(let i = 0; i < res.products.length; i++) {
                let product = document.querySelector("div.cardProductList#pos" + i);
                product.querySelector('.card-body h6 a').innerHTML = res.products[i].name;
                //product.querySelector('.card-body h5').innerHTML = res.products[i].price;
            }
        });
    });
}

function assembleData (sort_by, genres_array, platform, category, max_price) {
    let data = {};

    if(sort_by !== undefined)
        data.sort_by = sort_by.value;

    if(genres_array.length !== 0)
        data.genres = genres_array;

    if(platform !== undefined)
        data.platform = platform.value;

    if(category !== undefined)
        data.category = category.value;

    if(max_price !== undefined)
        data.max_price = max_price.value;

    return data;
}

function encodeForAjax(data) {
    if (data == null) return null;
    return Object.keys(data).map(function(k){
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');
}


const sendGet = get => {
    const options = {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token
        },
        method: 'get',
        credentials: "same-origin",
    }

    return fetch("api/product?" + encodeForAjax(get), options)
        .then(res => res.json())
        .catch(error => console.error("Error: " + error));
}

addEventListeners();