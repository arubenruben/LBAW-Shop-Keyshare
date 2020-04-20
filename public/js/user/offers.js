

let crsf_token = document.querySelector('meta[name="csrf-token"]');

const pressed_delete_Button = (offer_id) => {

    const options = {
        method: 'DELETE',
        headers: new Headers({
            'X-CSRF-TOKEN' : crsf_token.getAttribute("content"),
            'Content-Type': 'application/json'
        })
    }


    return fetch('/user/offer/' + offer_id, options)
        .then(alert("consegui"))
        .then(res => res.json())
        .then(res => console.log(res))
        .catch(error => console.error("Error: {error}"));
    
}
