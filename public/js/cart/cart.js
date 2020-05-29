'use strict'

const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const cartItemCounter = document.querySelector("#shopping_cart_item_counter");
const counter_products_cart = document.querySelector("#counter_products_cart");
const url = '/cart';
const totalPrice = document.querySelector("#total_price");
let totalPriceNumber = 0;

const addEventListeners = () => {

    let buttons = document.querySelectorAll(".remove_cart_button");

    buttons.forEach(button => {
        button.addEventListener('click', () => {
            event.preventDefault();
            const cartId = button.getAttribute('data_cart_id')
            const offerPrice = parseFloat(button.getAttribute('value_offer')).toFixed(2);
            sendDelete(cartId, offerPrice)
        });
    });

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