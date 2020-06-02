'use strict'

const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const cartItemCounter = document.querySelector("#shopping_cart_item_counter");
const counter_products_cart = document.querySelector("#counter_products_cart");
const url = '/cart';
const table = document.getElementById("tableOffers");
const totalPriceDiv = document.getElementById("total-price-div");
const cartNoEntries = document.querySelector("#cart-no-entries");
const topCheckoutButton = document.querySelector("#checkout-top-button");
const totalPrice = document.querySelector("#total_price");
const addEventListeners = () => {

    let buttons = document.querySelectorAll(".remove_cart_button");

    buttons.forEach(button => {
        button.addEventListener('click', () => {
            event.preventDefault();
            const cartId = button.getAttribute('data_cart_id')
            const offerPrice = parseFloat(button.getAttribute('value_offer')).toFixed(2);
            button.disabled = true;
            sendDelete(cartId, offerPrice).then(async () =>{
                let response = await sendGet();
                totalPrice.innerHTML = response.amount;
                if(response.amount === 0){
                    if(!table.classList.contains('d-none'))
                        table.className += " d-none";
                    if(cartNoEntries.classList.contains('d-none'))
                        cartNoEntries.classList.remove('d-none');
                    if(!totalPriceDiv.classList.contains('d-none'))
                        totalPriceDiv.className += " d-none";
                    if(!topCheckoutButton.classList.contains('d-none'))
                        topCheckoutButton.className += " d-none";
                }
            })
        });
    });
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

    return fetch("/api/getCartTotalPrice", options)
        .then(res => res.json())
        .catch(error => console.error("Error: " + error));
}


const sendDelete = (cartId, offerPrice) => {
    const options = {
        method: 'delete',
        headers: new Headers({
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token
        })
    }
    return fetch(url + '/' + cartId, options)
        .then(function (res) {
            res.json();
            if (res.ok) {
                let totalPriceNumber = parseFloat(totalPrice.innerHTML).toFixed(2);
                totalPriceNumber -= offerPrice
                totalPrice.innerHTML = totalPriceNumber.toFixed(2);

                let tableEntry = document.querySelector('#row' + cartId);
                tableEntry.remove();
                cartItemCounter.innerHTML = cartItemCounter.innerHTML - 1;
                counter_products_cart.innerHTML = counter_products_cart.innerHTML - 1;
            }

        })
        .catch(error => console.error("Error:" + error));
}

addEventListeners();