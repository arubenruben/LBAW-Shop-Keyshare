const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const urlPart1 = '/key/';
const urlPart2 = '/feedback';


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
    console.log(keyId);
    console.log(orderNumber);
}
addFeedbackEventListeners();