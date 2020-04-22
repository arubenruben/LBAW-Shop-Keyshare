const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const url = '/user';


const pressed_delete_Button = offer_id => {
    const tableRowElem = document.querySelector('#offer' + offer_id);
    const currentOfferCounter = document.querySelector('#current-offer-counter');
    const pastOfferCounter = document.querySelector('#past-offer-counter');
    const pastOfferTable = document.querySelector('#user-past-offer-table');
    const options = {
        method: 'delete',
        headers: new Headers({
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token
        })
    }

    fetch('/user/offer/' + offer_id, options)
        .then(function (response) {
            if (response.ok) {
                location.reload();
            } else {
                console.log('Network response was not ok.');
            }
        })
        .catch(error => console.error("Error:" + error));
}
