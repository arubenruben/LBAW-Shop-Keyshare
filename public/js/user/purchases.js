const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const orderNumberPlaceHolder = document.querySelector('#orderNumber');
const usernamePlaceHolder = document.querySelector('#username');
const pricePlaceHolder = document.querySelector('#price');
const productNamePlaceHolder = document.querySelector('#productName');
const approvalRatePlaceHolder = document.querySelector('#approvalRate');
const numSellsPlaceHolder = document.querySelector('#numSells');



const arrayButtonsToOpenFeedback = document.querySelectorAll('.modal-feedback-opener');

const addFeedbackEventListeners = () => {
    arrayButtonsToOpenFeedback.forEach(button => {
        let keyId = button.getAttribute('data-key-id');
        let orderNumber = button.getAttribute('data-order-number')
        button.addEventListener('click', function () {
            processClick(keyId, orderNumber);
        });
    });
}


const processClick = (keyId, orderNumber) => {
    sendGet('/api/key/' + keyId).then(function (res) {
        orderNumberPlaceHolder.innerHTML += orderNumber;

        usernamePlaceHolder.innerHTML += res.seller.username;
        pricePlaceHolder.innerHTML += res.offer.price;
        productNamePlaceHolder.innerHTML += res.product.name;
        approvalRatePlaceHolder.innerHTML += res.seller.rating;
        numSellsPlaceHolder.innerHTML += res.seller.num_sells;

    })
};
addFeedbackEventListeners();


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
    return fetch(get, options)
        .then(res => res.json())
        .catch(error => console.error("Error: " + error));
}