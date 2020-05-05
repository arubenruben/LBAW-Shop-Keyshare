
const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

let dots = document.getElementById("dots");
let moreText = document.getElementById("more");
let btnText = document.getElementById("moreTextButton");
let cartItemCounter=document.querySelector("#shopping_cart_item_counter");

btnText.addEventListener('click',collapseDescription);


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