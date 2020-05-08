'use strict'

const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const cartItemCounter=document.querySelector("#shopping_cart_item_counter");
const counter_products_cart=document.querySelector("#counter_products_cart");
const url = '/cart';
const totalPrice = document.querySelector("#total_price");
let totalPriceNumber = 0;

const addEventListeners = () => {

    let buttons=document.querySelectorAll(".remove_cart_button");

    buttons.forEach(button => {
        button.addEventListener('click',()=>{
            const cartId=button.getAttribute('data_cart_id')
            const offerPrice=parseFloat(button.getAttribute('value_offer')).toFixed(2);
            event.preventDefault();
            let totalPriceNumber = parseFloat(totalPrice.innerHTML).toFixed(2);
            totalPriceNumber -= offerPrice;
            totalPriceNumber = totalPriceNumber.toFixed(2);
            totalPrice.innerHTML = totalPriceNumber;
            sendDelete(cartId).then(function() {
                let tableEntry=document.querySelector('#row'+cartId);
                tableEntry.remove();        
                cartItemCounter.innerHTML=cartItemCounter.innerHTML-1;
                counter_products_cart.innerHTML=counter_products_cart.innerHTML-1;
              });              
        });
    });
   
}
const sendDelete = cartId => {
    const options = {
        method: 'delete',
        headers: new Headers({
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token
        })
    }
    return fetch(url+'/'+cartId, options)
        .then(res => res.json())
        .catch(error => console.error("Error:"+error));
}

addEventListeners();