'use strict'

const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

const addFeedbackEventListeners = () => {
    const arrayButtonsToOpenGiveFeedback = document.querySelectorAll('.modal-feedback-opener');
    arrayButtonsToOpenGiveFeedback.forEach(button => {
        let keyId = button.getAttribute('data-key-id');
        button.addEventListener('click', function () {
            leaveFeedback(keyId);
        });
    });

    const arrayButtonsToOpenReportSeller = document.querySelectorAll('.modal-report-opener');
    arrayButtonsToOpenReportSeller.forEach(button => {
        let keyId = button.getAttribute('data-key-id');
        button.addEventListener('click', function () {
            giveReport(keyId);
        });
    });

    const clipboard = document.querySelector('#clipboard-copy');
    clipboard.addEventListener('click', copyToClipBoard);
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

const sendPut = (put, link) => {
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

const getKeyInfo = (keyId, option) => {
    sendGet('/api/key/' + keyId).then(function (res) {
        if(option === "feedback") {
            usernamePlaceHolderFeedback.innerHTML = usernameOriginalContentFeedback + res.seller.username;
            pricePlaceHolderFeedback.innerHTML = priceOriginalContentFeedback + res.offer.price;
            productNamePlaceHolderFeedback.innerHTML = productNameOriginalContentFeedback + res.product.name;
            approvalRatePlaceHolderFeedback.innerHTML = approvalRateOriginalContentFeedback + res.seller.rating;
            numSellsPlaceHolderFeedback.innerHTML = numSellsOriginalContentFeedback + res.seller.num_sells;
            orderNumberPlaceHolderFeedback.innerHTML = orderNumberOriginalContentFeedback + orderNumber;
            commentPlaceHolder.innerHTML = commentOriginalContent;
        } else if(option === "report") {
            usernamePlaceHolderReport.innerHTML = usernameOriginalContentReport + res.seller.username;
            pricePlaceHolderReport.innerHTML = priceOriginalContentReport + res.offer.price;
            productNamePlaceHolderReport.innerHTML = productNameOriginalContentReport + res.product.name;
            approvalRatePlaceHolderReport.innerHTML = approvalRateOriginalContentReport + res.seller.rating;
            numSellsPlaceHolderReport.innerHTML = numSellsOriginalContentReport + res.seller.num_sells;
            orderNumberPlaceHolderReport.innerHTML = orderNumberOriginalContentReport + orderNumber;
            commentPlaceHolder.innerHTML = commentOriginalContent;
        }

        if (option === "feedback" && res.feedback !== null) {
            submitButtonReport.remove();
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
            if (!document.body.contains(submitButtonReport))
                submitButtonContainerFeedback.append(submitButtonFeedback);
            if (!positiveButtonContainer.contains(positiveButton))
                positiveButtonContainer.append(positiveButton);
            if (!negativeButtonContainer.contains(negativeButton))
                negativeButtonContainer.append(negativeButton);

        }
    });
}

/** See key **/
const clipboard = document.querySelector('#clipboard-copy');

const copyToClipBoard = () => {
    const clipboardValue = document.querySelector('#key-val');
    clipboardValue.select();
    clipboardValue.setSelectionRange(0, 99999);
    document.execCommand('copy');

}

/** Give Feedback **/
const orderNumberPlaceHolderFeedback = document.querySelector('#orderNumber-feedback');
const orderNumberOriginalContentFeedback = orderNumberPlaceHolderFeedback.innerHTML;
const usernamePlaceHolderFeedback = document.querySelector('#username-feedback');
const usernameOriginalContentFeedback = usernamePlaceHolderFeedback.innerHTML;
const pricePlaceHolderFeedback = document.querySelector('#price-feedback');
const priceOriginalContentFeedback = pricePlaceHolderFeedback.innerHTML;
const productNamePlaceHolderFeedback = document.querySelector('#productName-feedback');
const productNameOriginalContentFeedback = productNamePlaceHolderFeedback.innerHTML;
const approvalRatePlaceHolderFeedback = document.querySelector('#approvalRate-feedback');
const approvalRateOriginalContentFeedback = approvalRatePlaceHolderFeedback.innerHTML;
const numSellsPlaceHolderFeedback = document.querySelector('#numSells-feedback');
const numSellsOriginalContentFeedback = numSellsPlaceHolderFeedback.innerHTML;
const submitButtonContainerFeedback = document.querySelector('#submit-button-container-feedback');
const submitButtonFeedback = document.querySelector('#submitButton-feedback');

let evaluation = null;
const positiveButton = document.querySelector('#buttonPositive');
const positiveButtonContainer = document.querySelector('#positive-button-container');
const negativeButton = document.querySelector('#buttonNegative');
const negativeButtonContainer = document.querySelector('#negative-button-container');
const positiveThumb = document.querySelector('#positive-thumb');
const negativeThumb = document.querySelector('#negative-thumb');
const commentPlaceHolder = document.querySelector('#comment');
const commentOriginalContent = commentPlaceHolder.innerHTML;

const leaveFeedback = (keyId) => {
    positiveButton.addEventListener('click', buttonPositiveClick);
    negativeButton.addEventListener('click', buttonNegativeClick);
    submitButtonFeedback.addEventListener('click', function () {
        submitComment(keyId);
    });

    getKeyInfo(keyId);
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

    sendPut(data, '/key/' + data.key + '/feedback').then(function (res) {
        if (res == "Success") {
            if (data.evaluation && negativeButtonContainer.contains(negativeButton))
                negativeButton.remove();
            else if(positiveButtonContainer.contains(positiveButton))
                positiveButton.remove();

            submitButtonFeedback.remove();

            // Print success response
            const feedbackResponse = document.querySelector('#feedback-response');
            feedbackResponse.innerHTML = 'Submited feedback successfully';
            feedbackResponse.style.color = 'green';
            feedbackResponse.style.textAlign = 'left';
        } else {
            // Print fail response
            const feedbackResponse = document.querySelector('#feedback-response');
            if(res['errors'][0] !== undefined) feedbackResponse.innerHTML = res['errors'][0];
            else feedbackResponse.innerHTML = 'Error while submitting feedback';
            feedbackResponse.style.color = 'red';
            feedbackResponse.style.textAlign = 'left';
        }
    });
};

/** Give Report **/
const orderNumberPlaceHolderReport = document.querySelector('#orderNumber-report');
const orderNumberOriginalContentReport = orderNumberPlaceHolderReport.innerHTML;
const usernamePlaceHolderReport = document.querySelector('#username-report');
const usernameOriginalContentReport = usernamePlaceHolderReport.innerHTML;
const pricePlaceHolderReport = document.querySelector('#price-report');
const priceOriginalContentReport = pricePlaceHolderReport.innerHTML;
const productNamePlaceHolderReport = document.querySelector('#productName-report');
const productNameOriginalContentReport = productNamePlaceHolderReport.innerHTML;
const approvalRatePlaceHolderReport = document.querySelector('#approvalRate-report');
const approvalRateOriginalContentReport = approvalRatePlaceHolderReport.innerHTML;
const numSellsPlaceHolderReport = document.querySelector('#numSells-report');
const numSellsOriginalContentReport = numSellsPlaceHolderReport.innerHTML;
const submitButtonContainerReport = document.querySelector('#submit-button-container-report');
const submitButtonReport = document.querySelector('#submitButton-report');

const giveReport = (keyId, orderNumber) => {
    submitButtonReport.addEventListener('click', function () {
        submitReport(keyId);
    });

    getKeyInfo(keyId);
};

const submitReport = (keyId) => {
    let title = document.querySelector("#report-title");
    let description = document.querySelector("#report-description");
    let data = {
        key_id: keyId,
        title: title,
        description: description,
    };

    sendPut(data, '/key/' + data.key + '/report').then(function (res) {
        if (res.ok) {
            console.log(res)
        }
    });
}

addFeedbackEventListeners();