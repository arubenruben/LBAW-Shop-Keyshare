const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const url = '/user';

const pressed_delete_Button = offer_id => {
    const tableRowElem = document.querySelector('#offer' + offer_id);
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
                tableRowElem.remove();
            } else {
                console.log('Network response was not ok.');
            }
        })
        .then(res => res.json())
        .then(res => console.log(res))
        .catch(error => console.error("Error:" + error));
}
