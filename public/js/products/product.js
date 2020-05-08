
const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

let dots = document.getElementById("dots");
let moreText = document.getElementById("more");
let btnText = document.getElementById("moreTextButton");
let cartItemCounter=document.querySelector("#shopping_cart_item_counter");
let radioBestRating=document.querySelector("#radio_best_rating");
let radioBestPrice=document.querySelector("#radio_best_price");


btnText.addEventListener('click',collapseDescription);

const templateEntryOffer = (username, rating, offer_id,  num_sells, price, discount_price, stock, current_user, banned) => {
    let html =  `<tr class="offer">
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



    if(price !== discount_price) {
        html += `<td class="text-center align-middle"><del><strong>${price}</strong></del><strong
            class="cl-green pl-2">${discount_price}</strong></td>`;
    }
    else {
        html += ` <td class="text-center align-middle"><strong>${price}</strong></td>`;
    }

    html +=  `<td class="text-center align-middle">
        <div class="btn-group-justified">`;

    if(current_user !== 'none'){
        html += ` <button id="add_offer_to_cart_{{$offer->id}}"
                onclick="pressed_add_offer_to_cart(${offer_id})" class="btn btn-orange"
                ${banned ? 'disabled' : ''}><i class="fas fa-cart-plus"></i></button>`;
    }
    else{
        html +=  `<button id="add_offer_to_cart_{{$offer->id}}"
                    onclick="pressed_add_offer_to_cart(${offer_id})" class="btn btn-orange"><i class="fas fa-cart-plus"></i></button>`

    }
    html +=` </div> </td> </tr>`;

    return html;
}

const received = (response) => {

    let tableOffersBody= document.querySelector("#offers_body");
    let entriesTable = "";
    for(let i = 0; i < response.offers.length; i++) {
        entriesTable += templateEntryOffer(response.offers[i].username, response.offers[i].rating, response.offers[i].offer_id, response.offers[i].num_sells, response.offers[i].price, response.offers[i].discount_price, response.offers[i].stock, response.current_user, response.banned);
    }

    tableOffersBody.innerHTML = entriesTable;

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


function pressed_add_offer_to_cart(id){

    let data={
        offer_id:id
    }
    sendPut(data).then(
        cartItemCounter.innerHTML=parseInt(cartItemCounter.innerHTML)+1.0
    );
}

function assembleData () {

    let game = document.querySelector("#product_name_platform");

    let data = {};

    data.game_name = game.getAttribute('data_product_name');
    console.log(data.game_name);
    data.game_platform = game.getAttribute('data_product_platform');

    if(radioBestRating.checked){
        data.sort_by = "rating";
    }
    else{
        data.sort_by = "price";
    }

    return data;
}

const sendPut = post => {
    const options = {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token
        },
        method: 'put',
        credentials: "same-origin",
        body: JSON.stringify(post)
    }

    return fetch("/cart/", options)
        .then(res => res.json())
        .catch(error => console.error("Error: {error}"));
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

    return fetch("/api/product/sort?" + encodeForAjax(get), options)
        .then(res => res.json())
        .catch(error => console.error("Error: " + error));
}

function encodeForAjax(data) {
    if (data == null) return null;
    return Object.keys(data).map(function(k){
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');
}



radioBestPrice.addEventListener("click", sendRequest);
radioBestRating.addEventListener("click", sendRequest);