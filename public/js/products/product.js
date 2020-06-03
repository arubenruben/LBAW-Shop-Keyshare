const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

/** Read More **/
const btnText = document.getElementById("moreTextButton");
const dots = document.getElementById("dots");
const moreText = document.getElementById("more");
const seeMoreButtons = document.getElementById("see-more-buttons");
const readmoreText = document.querySelector("#text-readmore");
let allAddToCartButtons = document.querySelectorAll(".button-offer");
const radioButtons = document.getElementById("radio-buttons");

const collapseDescription = () => {
    if (dots.style.display === "none") {
        dots.style.display = "inline";
        btnText.innerHTML = "Read more";
        moreText.style.display = "none";
    } else {
        dots.style.display = "none";
        btnText.innerHTML = "Read less";
        moreText.style.display = "inline";
    }
}

if (readmoreText.textContent.length < 200) {
    btnText.style.display = 'none';
} else {
    btnText.addEventListener('click', collapseDescription);
    btnText.style.display = 'block';
}

const htmlToInsertWithoutOffers = '<div class="col-sm-12 text-center align-middle"> <p class = "mt-5" >No offers available for this product</p> </div >'
const cartItemCounter = document.querySelector("#shopping_cart_item_counter");
const counterNumberOffers = document.querySelector("#counter-number-offers");
const htmlToInsertPlace = document.querySelector('#offers-content');
/** Add to cart **/

const sendPut = put => {
    const options = {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token
        },
        method: 'put',
        credentials: "same-origin",
        body: JSON.stringify(put)
    }

    let buttons = document.querySelectorAll(".button-offer");
    let selectButton = null;

    buttons.forEach(button => {
        if (button.getAttribute('data-offer') === put.offer_id) {
            selectButton = button;
        }
    });

    selectButton.disabled = true;

    return fetch("/cart/", options)
        .then(function (res) {
            if (res.ok) {
                cartItemCounter.innerHTML = parseInt(cartItemCounter.innerHTML) + 1.0;
                let offerStock = document.querySelector('#offer-' + put.offer_id + '-stock');
                offerStock.innerHTML -= 1;
                selectButton.disabled = false;
                //Out of stock
                if (offerStock.innerHTML == '0') {
                    let offerTableEntry = document.querySelector('#entry-offer-' + put.offer_id);
                    offerTableEntry.remove();
                    counterNumberOffers.innerHTML -= 1
                    if (counterNumberOffers.innerHTML === '0' && !radioButtons.classList.contains('d-none')) {
                        radioButtons.className += " d-none";
                        htmlToInsertPlace.innerHTML = htmlToInsertWithoutOffers;
                    }
                }
            }
            res.json();
        })
        .catch(error => console.error("Error:" + error));
}

const addEventListenerAddToCardButton = () => {
    allAddToCartButtons = document.querySelectorAll(".button-offer");
    allAddToCartButtons.forEach(button => {
        button.addEventListener('click', () => {
            let data = {
                offer_id: button.getAttribute('data-offer')
            }
            sendPut(data);
        });
    });
}

addEventListenerAddToCardButton();


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

    return fetch(`/api${window.location.pathname}/sort?` + encodeForAjax(get), options)
        .then(res => res.text())
        .catch(error => console.error("Error: " + error));
}

let radioBestRating = document.querySelector("#radio_best_rating");
let radioBestPrice = document.querySelector("#radio_best_price");
let seeMoreOffers = document.querySelector("#see_more_offers");
let closeMoreOffers = document.querySelector("#close_more_offers");
let loadingMoreOffers = document.querySelector("#loading_offers");

if (seeMoreOffers != null && closeMoreOffers != null) {
    seeMoreOffers.addEventListener('click', collapseOffers);
    closeMoreOffers.addEventListener('click', collapseOffers);

}

const received = (response) => {
    let tableOffersBody = document.querySelector("#offers_body");
    tableOffersBody.innerHTML = response;

    addEventListenerAddToCardButton();
}

const receivedAll = (response) => {
    let tableOffersBody = document.querySelector("#offers_body");
    tableOffersBody.innerHTML = response;

    addEventListenerAddToCardButton();
}


let changedSortBy = true;

async function collapseOffers() {

    let tableOffersBody = document.querySelectorAll("#offers_body > tr");

    if (seeMoreOffers.style.display === "none" || seeMoreOffers.classList.contains("d-none")) {
        seeMoreOffers.style.display = "block";
        closeMoreOffers.style.display = "none";

        for (let i = 0; i < tableOffersBody.length; i++) {
            if(i >= 10)
                tableOffersBody[i].style.display = "none";
        }
    } else if (closeMoreOffers.style.display === "none" || closeMoreOffers.classList.contains("d-none")) {
        if (changedSortBy) {
            seeMoreOffers.style.display = "none";
            loadingMoreOffers.style.display = "block";
            await sendRequestForAllOffers();
            changedSortBy = false;
        }
        loadingMoreOffers.style.display = "none";
        closeMoreOffers.style.display = "block";
        seeMoreOffers.style.display = "none";
        for (let i = 0; i < tableOffersBody.length; i++) {
            tableOffersBody[i].style.display = "table-row";
        }
    }
}

const sendRequest = () => {
    changedSortBy = true;
    let data = assembleData(false);
    sendGet(data)
        .then(res => received(res))
        .catch(error => console.error("Error: " + error));
}

const sendRequestForAllOffers = async () => {
    let data = assembleData(true);
    await sendGet(data)
        .then(res => receivedAll(res))
        .catch(error => console.error("Error: " + error));
}

function assembleData(allOffers) {
    let data = {};

    if (radioBestRating.checked) data.sort_by = 2;
    else data.sort_by = 1;

    data.all_offers = allOffers ? 1 : 0;

    return data;
}

function encodeForAjax(data) {
    if (data == null) return null;
    return Object.keys(data).map(function (k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');
}

radioBestPrice.addEventListener("click", sendRequest);
radioBestRating.addEventListener("click", sendRequest);