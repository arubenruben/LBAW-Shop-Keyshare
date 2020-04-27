'use strict'

const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const url = '/cart';

const addEventListeners = () => {

    let buttons=document.querySelectorAll(".remove_cart_button");

    buttons.forEach(button => {
        button.addEventListener('click',()=>{
            const cartId=button.getAttribute('data_cart_id');
            event.preventDefault();
            sendDelete(cartId);
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