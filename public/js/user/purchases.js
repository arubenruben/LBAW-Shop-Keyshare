'use strict'

const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
let evaluation = null;

const orderNumberPlaceHolder = document.querySelector('#orderNumber');
const orderNumberOriginalContent = orderNumberPlaceHolder.innerHTML;
const usernamePlaceHolder = document.querySelector('#username');
const usernameOriginalContent = usernamePlaceHolder.innerHTML;
const pricePlaceHolder = document.querySelector('#price');
const priceOriginalContent = pricePlaceHolder.innerHTML;
const productNamePlaceHolder = document.querySelector('#productName');
const productNameOriginalContent = productNamePlaceHolder.innerHTML;
const approvalRatePlaceHolder = document.querySelector('#approvalRate');
const approvalRateOriginalContent = approvalRatePlaceHolder.innerHTML;
const numSellsPlaceHolder = document.querySelector('#numSells');
const numSellsOriginalContent = numSellsPlaceHolder.innerHTML;
const commentPlaceHolder = document.querySelector('#comment');
const commentOriginalContent = commentPlaceHolder.innerHTML;
const submitButtonContainer = document.querySelector('#submit-button-container');

const buttonSubmitFeedback = document.querySelector('#submitButton');
const positiveButton = document.querySelector('#buttonPositive');
const positiveButtonContainer = document.querySelector('#positive-button-container');
const negativeButton = document.querySelector('#buttonNegative');
const negativeButtonContainer = document.querySelector('#negative-button-container');

const positiveThumb = document.querySelector('#positive-thumb');
const negativeThumb = document.querySelector('#negative-thumb');

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
        //TODO : DONT KNOW IF THIS IS SUPOOSED to be here
        //orderNumberPlaceHolder.innerHTML += orderNumber;
        usernamePlaceHolder.innerHTML = usernameOriginalContent + res.seller.username;
        pricePlaceHolder.innerHTML = priceOriginalContent + res.offer.price;
        productNamePlaceHolder.innerHTML = productNameOriginalContent + res.product.name;
        approvalRatePlaceHolder.innerHTML = approvalRateOriginalContent + res.seller.rating;
        numSellsPlaceHolder.innerHTML = numSellsOriginalContent + res.seller.num_sells;
        orderNumberPlaceHolder.innerHTML = orderNumberOriginalContent + orderNumber;
        commentPlaceHolder.innerHTML = commentOriginalContent;

        if (res.feedback !== null) {
            buttonSubmitFeedback.remove();
            commentPlaceHolder.innerHTML = res.feedback.comment;

            if (res.feedback.evaluation) {

                if (negativeButtonContainer.contains(negativeButton))
                    negativeButton.remove();

                if (!positiveButtonContainer.contains(positiveButton))
                    positiveButtonContainer.append(positiveButton);

            } else {

                if (positiveButtonContainer.contains(positiveButton))
                    positiveButton.remove();

                if (!negativeButtonContainer.contains(negativeButton))
                    negativeButtonContainer.append(negativeButton);

            }

        } else {
            if (!document.body.contains(buttonSubmitFeedback))
                submitButtonContainer.append(buttonSubmitFeedback);
            if (!positiveButtonContainer.contains(positiveButton))
                positiveButtonContainer.append(positiveButton);
            if (!negativeButtonContainer.contains(negativeButton))
                negativeButtonContainer.append(negativeButton);
        }

    })
};

const buttonPositiveClick = () => {
    evaluation = true;
    positiveButton.classList.add('bg-aux1');
    positiveThumb.classList.add('cl-white');
    negativeButton.classList.remove('bg-aux');
    negativeThumb.classList.remove('cl-white');

}

const buttonNegativeClick = () => {
    evaluation = false;
    negativeButton.classList.add('bg-aux');
    negativeThumb.classList.add('cl-white');
    positiveButton.classList.remove('bg-aux1');
    positiveThumb.classList.remove('cl-white');

}

const submitComment = (keyId) => {
    let data = {
        comment: commentPlaceHolder.value,
        evaluation: evaluation,
        key: keyId
    };

    sendPut(data).then(function (res) {
        if (res.ok) {
            if (data.evaluation && negativeButtonContainer.contains(negativeButton))
                negativeButton.remove();
            else if(positiveButtonContainer.contains(positiveButton))
                positiveButton.remove();

            buttonSubmitFeedback.remove();
        }
    });
};

const submitReport = (keyId) => {
    let data = {
        key_id: reportkeyId,
        title: reportTitle,
        description: reportDescription,
    };

    sendPut(data).then(function (res) {
        if (res.ok) {

        }
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

    return fetch('/key/' + put.key + '/feedback', options)
        .then(res => res.json())
        .catch(error => console.error("Error: " + error));
}

addFeedbackEventListeners();