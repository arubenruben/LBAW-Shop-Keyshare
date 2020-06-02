'use strict'

const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const url = '/search';

const addEventListeners = () => {
    let filters = document.querySelectorAll("form.option");

    for(let i = 0; i < filters.length; i++) {
        filters[i].addEventListener("click", function () {
            let sort_by_input = filters[i].querySelectorAll("input.sort-by");
            let genres_input = filters[i].querySelectorAll("input.genre");
            let platform_input = filters[i].querySelectorAll("input.platform");
            let category_input = filters[i].querySelectorAll("input.category");
            let min_price_input = filters[i].querySelector("input#min-price-range");
            let max_price_input = filters[i].querySelector("input#max-price-range");

            for (let i = 0; i < sort_by_input.length; i++) {
                sort_by_input[i].addEventListener("click", sendRequest.bind(sort_by_input[i], filters[i]));
            }

            for (let i = 0; i < genres_input.length; i++) {
                genres_input[i].addEventListener("click", sendRequest.bind(genres_input[i], filters[i]));
            }

            for (let i = 0; i < platform_input.length; i++) {
                platform_input[i].addEventListener("click", sendRequest.bind(platform_input[i], filters[i]));
            }

            for (let i = 0; i < category_input.length; i++) {
                category_input[i].addEventListener("click", sendRequest.bind(category_input[i], filters[i]));
            }

            min_price_input.addEventListener("keyup", function () {
                if(max_price_input && max_price_input.value && min_price_input.value && (max_price_input.value < min_price_input.value || min_price_input < 0))
                    min_price_input.value = max_price_input.value;

                sendRequest(filters[i]);
            });
            max_price_input.addEventListener("keyup", function () {
                if(min_price_input && min_price_input.value && max_price_input.value && (min_price_input.value > max_price_input.value || max_price_input < 0))
                    max_price_input.value = min_price_input.value

                sendRequest(filters[i])
            });
        });
    }
}

const sendGet = get => {
    let request = encodeForAjax(get);
    console.log(get)

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

    window.history.pushState("", "", window.location.pathname + "?" + request);

    return fetch("api/product?" + request, options)
        .then(res => res.json())
        .catch(error => console.error("Error: " + error));
}

/** Filter results **/
const sendRequest = form => {
    let data = assembleData(form);
    sendGet(data)
        .then(res => received(res, form))
        .catch(error => console.error("Error: " + error));
}

const assembleData = formElement => {
    const form = new FormData(formElement);

    let data = {};

    let sort_by = form.get('sort_by');
    if (sort_by != null) {
        data.sort_by = sort_by;
    }

    let genres = form.getAll('genres[]');

    if (genres.length !== 0) {
        data.genres = genres;
    }

    let platform = form.get('platform');
    if (platform != null && platform !== "") {
        data.platform = platform;
    }

    let category = form.get('category');
    if (category != null && category !== "") {
        data.category = category;
    }

    let min_price = form.get('min_price');
    if (min_price) {
        data.min_price = min_price;
    }

    let max_price = form.get('max_price');
    if (max_price) {
        data.max_price = max_price;
    }

    return data;
}

const received = (response, form) => {
    const receivedProducts = (products) => {
        const templateListInit = `<div class="row justify-content-between mx-auto flex-wrap">`;
        const templateListEnd = `</div>`;
        let productList = document.querySelector('#product_list');
        let list = templateListInit;

        for (let i = 0; i < products.length; i++) {
            if ((i !== 0) && i % 3 === 0) {
                list += templateListEnd + templateListInit;
            }
            list += templateProduct(products[i].name, products[i].url, products[i].image, products[i].price);
        }

        productList.innerHTML = list + templateListEnd;
    }

    receivedProducts(response.products);
}

const templateProduct = (name, url, image, price) => {
    return `<div class="card col-md-3 col-sm-4 col-10 cardProductList my-2 mx-auto">
                <a href="#"><img class="card-img-top cardProductListImg img-fluid" src="${image}"></a>
                <div class="card-body">
                    <h6 class="card-title"> <a href=${url} class="text-decoration-none text-secondary">${name}</a></h6>
                    <h5 class="cl-orange2">${price !== null ? '$'+price : 'Unavailable'}</h5>
                </div>
            </div>`
}

const encodeForAjax = (data) => {
    if (data == null) return null;
    return Object.keys(data).map(function (k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');
}

/** input search **/
function preventDefaultQuerySubmit() {
    if(document.getElementById("#query-form")) {
        document.getElementById("#query-form").addEventListener("submit", function(event){
            event.preventDefault()

            let data = {};
            data.query = document.querySelector("form input#query").value
            sendGet(data)
                .then(res => received(res))
                .catch(error => console.error("Error: " + error));
        });
    }
}

addEventListeners();
preventDefaultQuerySubmit();