const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const url = '/user';

const addEventListeners = () => {
    let deleteOffer = document.querySelector('#delete-offer-btn');
    //let offerId = document.querySelector()
    deleteOffer.addEventListener('click', function () {
        sendDelete('offer/')
    })
}

const sendDelete = url => {
    const options = {
        method: 'delete',
        headers: new Headers({
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token
        })
    }

    return fetch(url, options)
        .then(res => res.json())
        .catch(error => console.error("Error:" + error));
}

addEventListeners();