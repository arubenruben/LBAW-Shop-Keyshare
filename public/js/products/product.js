
const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

let dots = document.getElementById("dots");
let moreText = document.getElementById("more");
let btnText = document.getElementById("moreTextButton");
let cartItemCounter=document.querySelector("#shopping_cart_item_counter");
let radioBestRating=document.querySelector("#radio_best_rating");
let radioBestPrice=document.querySelector("#radio_best_price");
let seeMoreOffers=document.querySelector("#see_more_offers");
let closeMoreOffers=document.querySelector("#close_more_offers");
let bodyTableOffersPrice=document.querySelector("#offers_sort_price");
let bodyTableOffersRating=document.querySelector("#offers_sort_rating");

if(seeMoreOffers != null && closeMoreOffers != null) {
    seeMoreOffers.addEventListener('click', collapseOffers);
    closeMoreOffers.addEventListener('click', collapseOffers);
}

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

function collapseOffers(){
    let allMoreOffers = document.querySelectorAll(".offer_outside");

    if (seeMoreOffers.style.display === "none" || seeMoreOffers.classList.contains("d-none")) {
        seeMoreOffers.style.display = "block";
        closeMoreOffers.style.display = "none";
        for(let i = 0; i < allMoreOffers.length; i++){
            allMoreOffers[i].style.display = "none";
        }
    } else if(closeMoreOffers.style.display === "none" || closeMoreOffers.classList.contains("d-none")){
        closeMoreOffers.style.display = "block";
        seeMoreOffers.style.display = "none";
        for(let i = 0; i < allMoreOffers.length; i++){
            allMoreOffers[i].style.display = "table-row";
        }
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

function switchOffers(){

    if(radioBestRating.checked){
        bodyTableOffersRating.style.display = "table-row-group";
        bodyTableOffersPrice.style.display = "none";
    }

    else{
        bodyTableOffersRating.style.display = "none";
        bodyTableOffersPrice.style.display = "table-row-group";
    }

}

radioBestPrice.addEventListener("click", switchOffers);
radioBestRating.addEventListener("click", switchOffers);