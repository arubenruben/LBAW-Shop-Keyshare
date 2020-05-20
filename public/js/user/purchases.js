const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


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
    sendGet('/api/order/' + orderNumber);
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
        .then(res => console.log(res.json()))
        .catch(error => console.error("Error: " + error));
}