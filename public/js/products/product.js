const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

/** Read More **/
const btnText = document.getElementById("moreTextButton");
const dots = document.getElementById("dots");
const moreText = document.getElementById("more");
const seeMoreButtons = document.getElementById("see-more-buttons");
const readmoreText = document.querySelector("#text-readmore");

if(readmoreText.textContent.length < 200) {
    btnText.style.display = 'none';
} else {
    btnText.addEventListener('click', collapseDescription);
    btnText.style.display = 'block';
}

function collapseDescription() {
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

/** Add to cart **/
const cartItemCounter = document.querySelector("#shopping_cart_item_counter");
const counterNumberOffers = document.querySelector("#counter-number-offers");
const htmlToInsertWithoutOffers = '<div class="col-sm-12 text-center align-middle"> <p class = "mt-5" >No offers available for this product</p> </div >'
const htmlToInsertPlace = document.querySelector('#offers_body');

function pressed_add_offer_to_cart(id) {
    let data = {
        offer_id: id
    }
    sendPut(data);
}

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

    return fetch("/cart/", options)
        .then(function (res) {
            if (res.ok) {
                cartItemCounter.innerHTML = parseInt(cartItemCounter.innerHTML) + 1.0;
                let offerStock = document.querySelector('#offer-' + put.offer_id + '-stock');
                offerStock.innerHTML -= 1;
                //Out of stock
                if (offerStock.innerHTML === 0) {
                    let offerTableEntry = document.querySelector('#entry-offer-' + put.offer_id);
                    offerTableEntry.remove();
                    counterNumberOffers.innerHTML -= 1
                }
                if (counterNumberOffers.innerHTML === 0) {
                    htmlToInsertPlace.innerHTML = htmlToInsertWithoutOffers;
                }
            }
            res.json();
        })
        .catch(error => console.error("Error:" + error));
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

    return fetch("/api/product/sort?" + encodeForAjax(get), options)
        .then(res => res.json())
        .catch(error => console.error("Error: " + error));
}

let radioBestRating = document.querySelector("#radio_best_rating");
let radioBestPrice = document.querySelector("#radio_best_price");
let seeMoreOffers = document.querySelector("#see_more_offers");
let closeMoreOffers = document.querySelector("#close_more_offers");
let loadingMoreOffers = document.querySelector("#loading_offers");

if(seeMoreOffers != null && closeMoreOffers != null) {
    seeMoreOffers.addEventListener('click', collapseOffers);
    closeMoreOffers.addEventListener('click', collapseOffers);

}

const templateEntryOffer = (username, rating, offer_id, num_sells, price, discount_price, stock, current_user, banned, display) => {
    let html = `<tr class="offer`
    if (display === true) {
        html += ' offer_outside" style="display: none;';
    }

    html += `">
    <td scope="row" class="border-0 align-middle">
        <div class="p-2 m-0">
            <h4><a data-toggle="modal" data-target=".bd-modal-lg{{$offer->id}}" href="#"
                    class="seller" style="color:black">${username}</a></h4>
            <span class="font-weight-bold cl-success"><i class="fas fa-thumbs-up"></i>
                ${rating}</span>
            | <i class="fas fa-shopping-cart"></i> ${num_sells} | Stock:
            ${stock}
        </div>
    </td>`;


    if (price !== discount_price) {
        html += `<td class="text-center align-middle"><del><strong> ` + '$' + `${price}</strong></del><strong
            class="cl-green pl-2">` + '$' + `${discount_price} </strong></td>`;
    } else {
        html += ` <td class="text-center align-middle"><strong>` + '$' + `${price}</strong></td>`;
    }

    html += `<td class="text-center align-middle">
        <div class="btn-group-justified">`;

    if (current_user !== 'none') {
        html += ` <button id="add_offer_to_cart_{{$offer->id}}"
                onclick="pressed_add_offer_to_cart(${offer_id})" class="btn btn-orange"
                ${banned ? 'disabled' : ''}><i class="fas fa-cart-plus"></i></button>`;
    } else {
        html += `<button id="add_offer_to_cart_{{$offer->id}}"
                    onclick="pressed_add_offer_to_cart(${offer_id})" class="btn btn-orange"><i class="fas fa-cart-plus"></i></button>`

    }
    html += ` </div> </td> </tr>`;

    return html;
}

const received = (response) => {
    let tableOffersBody = document.querySelector("#offers_body");
    let entriesTable = "";
    let boolean;

   /* if(response.numberOffers > 10 && seeMoreButtons.classList.contains('d-none'))
            seeMoreButtons.classList.remove('d-none');
    else if(!seeMoreButtons.classList.contains('d-none'))
        seeMoreButtons.className += " d-none";

    if(response.numberOffers !== counterNumberOffers.innerHTML)
            counterNumberOffers.innerHTML = response.numberOffers;*/


    for (let i = 0; i < response.offers.length; i++) {
        if (i < 10)
            boolean = false;
        else
            boolean = true;
         entriesTable += templateEntryOffer(response.offers[i].username, response.offers[i].rating, response.offers[i].offer_id, response.offers[i].num_sells, response.offers[i].price, response.offers[i].discount_price, response.offers[i].stock, response.current_user, response.banned, boolean);
    }

    tableOffersBody.innerHTML = entriesTable;
}

const receivedAll = (response) => {
    let tableOffersBody = document.querySelector("#offers_body");
    let boolean;

    for (let i = 0; i < response.offers.length; i++) {
        boolean = true;
        tableOffersBody.innerHTML += templateEntryOffer(response.offers[i].username, response.offers[i].rating, response.offers[i].offer_id, response.offers[i].num_sells, response.offers[i].price, response.offers[i].discount_price, response.offers[i].stock, response.current_user, response.banned, boolean);
    }

}

let changedSortBy = true;

async function collapseOffers() {

    let allMoreOffers = document.querySelectorAll(".offer_outside");

    if (seeMoreOffers.style.display === "none" || seeMoreOffers.classList.contains("d-none")) {
        seeMoreOffers.style.display = "block";
        closeMoreOffers.style.display = "none";
        for (let i = 0; i < allMoreOffers.length; i++) {
            allMoreOffers[i].style.display = "none";
        }
    } else if (closeMoreOffers.style.display === "none" || closeMoreOffers.classList.contains("d-none")) {
            if(changedSortBy) {
                seeMoreOffers.style.display = "none";
                loadingMoreOffers.style.display = "block";
                await sendRequestForAllOffers();
                changedSortBy = false;
            }
            loadingMoreOffers.style.display = "none";
            allMoreOffers = document.querySelectorAll(".offer_outside");
            closeMoreOffers.style.display = "block";
            seeMoreOffers.style.display = "none";
            for (let i = 0; i < allMoreOffers.length; i++) {
                allMoreOffers[i].style.display = "table-row";
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
    let game = document.querySelector("#product_name_platform");
    let data = {};

    data.game_name = game.getAttribute('data_product_name');
    data.game_platform = game.getAttribute('data_product_platform');

    if (radioBestRating.checked) data.sort_by = "rating";
    else data.sort_by = "price";

    data.all_offers = allOffers;

    return data;
}

function encodeForAjax(data) {
    if (data == null) return null;
    return Object.keys(data).map(function(k){
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');
}

radioBestPrice.addEventListener("click", sendRequest);
radioBestRating.addEventListener("click", sendRequest);
