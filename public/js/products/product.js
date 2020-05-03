
const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

let dots = document.getElementById("dots");
let moreText = document.getElementById("more");
let btnText = document.getElementById("moreTextButton");

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
    console.log(id);
    
    let data={
        offer_id:id
    }
    sendPut(data).then(console.log('Sucesso'));
}

function encodeForAjax(data) {
    if (data == null) return null;
    return Object.keys(data).map(function(k){
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');
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