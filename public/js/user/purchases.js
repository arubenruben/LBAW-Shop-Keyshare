'use strict'

const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
let evaluation = null;


const orderNumberPlaceHolder = document.querySelector('#orderNumber');
orderNumberPlaceHolder.innerHTML = "";
const usernamePlaceHolder = document.querySelector('#username');
usernamePlaceHolder.innerHTML = "";
const pricePlaceHolder = document.querySelector('#price');
pricePlaceHolder.innerHTML = "";
const productNamePlaceHolder = document.querySelector('#productName');
productNamePlaceHolder.innerHTML = "";
const approvalRatePlaceHolder = document.querySelector('#approvalRate');
approvalRatePlaceHolder.innerHTML = "";
const numSellsPlaceHolder = document.querySelector('#numSells');
numSellsPlaceHolder.innerHTML = "";
const commentPlaceHolder = document.querySelector('#comment');
commentPlaceHolder.innerHTML = "";

const buttonSubmitFeedback = document.querySelector('#submitButton');
const positiveButton = document.querySelector('#buttonPositive');
const negativeButton = document.querySelector('#buttonNegative');

const arrayButtonsToOpenFeedback = document.querySelectorAll('.modal-feedback-opener');

const addFeedbackEventListeners = () => {
    arrayButtonsToOpenFeedback.forEach(button => {
        let keyId = button.getAttribute('data-key-id');
        let orderNumber = button.getAttribute('data-order-number')
        button.addEventListener('click', function () {
            processClick(keyId, orderNumber);
        });
    });

    positiveButton.addEventListener('click', buttonPositiveClick);
    negativeButton.addEventListener('click', buttonNegativeClick);


}


const processClick = (keyId, orderNumber) => {

    buttonSubmitFeedback.addEventListener('click', function () {
        submitComment(keyId);
    });

    sendGet('/api/key/' + keyId).then(function (res) {
        orderNumberPlaceHolder.innerHTML += orderNumber;

        usernamePlaceHolder.innerHTML += res.seller.username;
        pricePlaceHolder.innerHTML += res.offer.price;
        productNamePlaceHolder.innerHTML += res.product.name;
        approvalRatePlaceHolder.innerHTML += res.seller.rating;
        numSellsPlaceHolder.innerHTML += res.seller.num_sells;

        if (res.feedback !== null) {
            buttonSubmitFeedback.remove();
            commentPlaceHolder.innerHTML = res.feedback.comment;
        }

    })
};

const buttonPositiveClick = () => {
    evaluation = true;
}

const buttonNegativeClick = () => {
    evaluation = false;
}
const submitComment = (keyId) => {

    let data = {
        comment: commentPlaceHolder.value,
        evaluation: evaluation,
        key: keyId
    };

    sendPut(data).then(function (res) {

        console.log(res);


    })

}




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

const sendPut = put => {
    const options = {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token
        },
        method: 'put',
        credentials: "same-origin",
        body: JSON.stringify(put)
    }

    return fetch('/key/' + put.key + '/feedback', options);
}