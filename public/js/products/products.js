'use strict'

const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const url = '/search';

const templateProduct = (name, image, price) => {
    return  `<div class="card col-md-3 col-sm-4 col-10 cardProductList my-2 mx-auto">
                <a href="#"><img class="card-img-top cardProductListImg img-fluid" src="${image}"></a>
                <div class="card-body">
                    <h6 class="card-title"> <a href="product.php" class="text-decoration-none text-secondary">${name}</a></h6>
                    <h5 class="cl-orange2">${price !== null ? '$'+price : 'Unavailable'}</h5>
                </div>
            </div>`
}

const received = (response) => {
    const receivedProducts = (products) => {
        const templateListInit = `<div class="row justify-content-between mx-auto flex-wrap">`;
        const templateListEnd = `</div>`;
        let productList = document.querySelector('#product_list');
        let list = templateListInit;

        for(let i = 0; i < products.length; i++) {
            if((i !== 0) && i % 3 === 0){
                list += templateListEnd + templateListInit;
            }
            list += templateProduct(products[i].name, products[i].image, products[i].price);
        }

        productList.innerHTML = list + templateListEnd;
    }

    const receivedPrices = (maxPrice, minPrice) => {
        const max_price_input = document.querySelector("form#option input#price-range");
        max_price_input.setAttribute('max', maxPrice);
        max_price_input.setAttribute('min', minPrice);

        if(parseFloat(max_price_input.value) > parseFloat(maxPrice)){
            max_price_input.value = maxPrice;
        } else if(parseFloat(max_price_input.value) < parseFloat(minPrice)) {
            max_price_input.value = minPrice;
        }
    }

    receivedProducts(response.products);
    receivedPrices(response.max_price, response.min_price);
}



const addEventListeners = () => {
    let sort_by_input = document.querySelectorAll("form#option input.sort-by");
    let genres_input = document.querySelectorAll("form#option input.genre");
    let platform_input = document.querySelectorAll("form#option input.platform");
    let category_input = document.querySelectorAll("form#option input.category");
    let max_price_input = document.querySelector("form#option input#price-range");

    for(let i = 0; i < sort_by_input.length; i++) {
        sort_by_input[i].addEventListener("click", sendRequest);
    }

    for(let i = 0; i < genres_input.length; i++) {
        genres_input[i].addEventListener("click", sendRequest);
    }

    for(let i = 0; i < platform_input.length; i++) {
        platform_input[i].addEventListener("click", sendRequest);
    }

    for(let i = 0; i < category_input.length; i++) {
        category_input[i].addEventListener("click", sendRequest);
    }

    max_price_input.addEventListener("click", sendRequest);
}

function assembleData () {
    const sort_by_input = document.querySelectorAll("form#option input.sort-by");
    const genres_input = document.querySelectorAll("form#option input.genre");
    const platform_input = document.querySelectorAll("form#option input.platform");
    const category_input = document.querySelectorAll("form#option input.category");
    const max_price_input = document.querySelector("form#option input#price-range");

    let data = {};

    for (let i = 0; i < sort_by_input.length; i++){
        if(sort_by_input[i].checked){
            data.sort_by = sort_by_input[i].value;
            break;
        }
    }

    let genres_array = [];
    for (let i = 0; i < genres_input.length; i++){
        if(genres_input[i].checked){
            genres_array.push(genres_input[i].value);
        }
    }

    if(genres_array.length !== 0){
        data.genres_array = genres_array;
    }

    for (let i = 0; i < platform_input.length; i++){
        if(platform_input[i].checked){
            data.platform = platform_input[i].value;
            break;
        }
    }

    for (let i = 0; i < category_input.length; i++){
        if(category_input[i].checked){
            data.category = category_input[i].value;
            break;
        }
    }

    data.max_price = max_price_input.value;

    console.log(data);

    return data;
}

function encodeForAjax(data) {
    if (data == null) return null;
    return Object.keys(data).map(function(k){
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');
}

const sendRequest = () => {
    let data = assembleData();
    sendGet(data)
        .then(res => received(res))
        .catch(error => console.error("Error: " + error));
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