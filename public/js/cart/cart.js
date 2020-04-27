'use strict'

const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const cartItemCounter=document.querySelector("#shopping_cart_item_counter");
const url = '/cart';

const addEventListeners = () => {

    let buttons=document.querySelectorAll(".remove_cart_button");

    buttons.forEach(button => {
        button.addEventListener('click',()=>{
            const cartId=button.getAttribute('data_cart_id');
            event.preventDefault();
            sendDelete(cartId).then(function() {
                let tableEntry=document.querySelector('#row'+cartId);
                tableEntry.remove();        
                cartItemCounter.innerHTML=cartItemCounter.innerHTML-1;
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