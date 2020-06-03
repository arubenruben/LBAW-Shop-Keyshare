'use strict'

const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const url = '/search';

const addEventListeners = () => {
    const filters = document.querySelectorAll("form.option");

    for(let i = 0; i < filters.length; i++) {
        let filter = filters[i];

        let sort_by_inputs = filter.querySelectorAll("input[name='sort_by");
        let genres_inputs = filter.querySelectorAll("input[name='genres[]']");
        let platform_inputs = filter.querySelectorAll("input[name='platform']");
        let category_inputs = filter.querySelectorAll("input[name='category']");
        let min_price_input = filter.querySelector("input[name='min_price']");
        let max_price_input = filter.querySelector("input[name='min_price']");

        for (let i = 0; i < sort_by_inputs.length; i++) {
            let sort_by_input = sort_by_inputs[i];
            sort_by_input.addEventListener("click", function () {sendRequest(filter)});
        }

        for (let i = 0; i < genres_inputs.length; i++) {
            let genres_input = genres_inputs[i];
            genres_input.addEventListener("click", function () {sendRequest(filter)});
        }

        for (let i = 0; i < platform_inputs.length; i++) {
            let platform_input = platform_inputs[i];
            platform_input.addEventListener("click", function () {sendRequest(filter)});
        }

        for (let i = 0; i < category_inputs.length; i++) {
            let category_input = category_inputs[i];
            category_input.addEventListener("click", function () {sendRequest(filter)});
        }

        min_price_input.addEventListener("change", function () {
            if(max_price_input && max_price_input.value && min_price_input.value && (max_price_input.value < min_price_input.value || min_price_input < 0))
                min_price_input.value = max_price_input.value;

            sendRequest(filter);
        });

        max_price_input.addEventListener("change", function () {
            if(min_price_input && min_price_input.value && max_price_input.value && (min_price_input.value > max_price_input.value || max_price_input < 0))
                max_price_input.value = min_price_input.value

            sendRequest(filter)
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

    window.history.replaceState("", "", window.location.pathname + "?" + request);

    return fetch("api/product?" + request, options)
        .then(res => res.json())
        .catch(error => console.error("Error: " + error));
}

/** Filter results **/
function sendRequest(form) {
    let data = assembleData(form);

    sendGet(data)
        .then(res => received(res))
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

const received = (response) => {
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