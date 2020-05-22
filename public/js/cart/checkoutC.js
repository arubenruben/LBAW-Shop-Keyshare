const checkout_tab_1 = document.querySelector("#checkout-tab-1");
const checkout_tab_2 = document.querySelector("#checkout-tab-2");
const checkout_tab_3 = document.querySelector("#checkout-tab-3");

const comfirm_order_button = document.querySelector("#confirm-order");
const your_info_button = document.querySelector("#your-info");

const paypal_button = document.querySelector("#paypal-button");

const input_name = document.querySelector("#checkoutInputName");
const input_email = document.querySelector("#checkoutInputEmail");
const input_address = document.querySelector("#checkoutInputAddress");
const input_zip_code = document.querySelector("#checkoutInputZipcode");

const client_name = document.querySelector("#client-name");
const client_email = document.querySelector("#client-email");
const client_address = document.querySelector("#client-address");
const client_zip_code = document.querySelector("#client-zip-code");

const name_invalid = document.querySelector("#name-invalid");
const email_invalid = document.querySelector("#email-invalid");
const address_invalid = document.querySelector("#address-invalid");
const zip_code_invalid = document.querySelector("#zip-code-invalid");

const checkout_tab_3_success = document.querySelector("#checkout-success");
const checkout_tab_3_fail = document.querySelector("#checkout-fail");



let valid_inputs;

const addEventListenersCheckout = () => {
    comfirm_order_button.addEventListener('click', clicked_confirm_button);
    your_info_button.addEventListener('click', clicked_info_button);
}

const isValidEmail = (email) => {
    return /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/.test(email);
}

const isValidZipCode = (zipcode) => {
    return /^[a-z0-9][a-z0-9\- ]{0,10}[a-z0-9]$/.test(zipcode);
}

const isValidName = (name) => {
    return /^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/.test(name);
}



const verify_input = (input_variable, invalid_block, invalid_text, extra_validation, extra_validation_message) => {

    if(input_variable.value === "") {
        valid_inputs = false;
        invalid_block.innerHTML = invalid_text;
        input_variable.className += " border-danger";
    }
    else if((extra_validation != null && !extra_validation(input_variable.value))){
        valid_inputs = false;
        invalid_block.innerHTML = extra_validation_message;
        input_variable.className += " border-danger";
    }
    else{
        if(input_variable.classList.contains('border-danger')){
            input_variable.classList.remove('border-danger');
            invalid_block.innerHTML = "";
        }
    }



}

const clicked_confirm_button = () => {

    valid_inputs = true;

    verify_input(input_name, name_invalid, "Please fill out your name", isValidName, "Name is not a valid one");
    verify_input(input_email, email_invalid, "Please fill out your email", isValidEmail, "Please enter a valid email");
    verify_input(input_address, address_invalid, "Please fill out your address");
    verify_input(input_zip_code, zip_code_invalid, "Please fill out your zip-code", isValidZipCode, "Please enter a valid zip-code");

    if(valid_inputs){
        checkout_tab_1.style.display = "none";
        checkout_tab_2.style.display = "block";

        client_name.innerHTML = input_name.value;
        client_email.innerHTML = input_email.value;
        client_address.innerHTML = input_address.value;
        client_zip_code.innerHTML = input_zip_code.value;
    }
}


const assembleData = () => {

    let data = {};

    data.name = client_name.innerHTML;
    data.email = client_email.innerHTML;
    data.address = client_address.innerHTML;
    data.zip_code = client_zip_code.innerHTML;

    return data;
}

const clicked_info_button = () => {

    checkout_tab_1.style.display = "block";
    checkout_tab_2.style.display = "none";
    checkout_tab_3.style.display = "none";
}


const sendPut = post => {
    const options = {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token
        },
        method: 'put',
        credentials: "same-origin",
        body: JSON.stringify(post)
    }

    return fetch("/cart/checkout", options)
        .then(res => res.json())
        .catch(error => console.error("Error: {error}"));
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

    return fetch("/api/getCartTotalPrice", options)
        .then(res => res.json())
        .catch(error => console.error("Error: " + error));
}


function encodeForAjax(data) {
    if (data == null) return null;
    return Object.keys(data).map(function(k){
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');
}


function check_transaction_result(res){
    console.log(JSON.stringify(res));

    checkout_tab_1.style.display = "none";
    checkout_tab_2.style.display = "none";

    if(res.success === true){
        checkout_tab_3.style.display = "block";
        checkout_tab_3_success.style.display = "block";
        checkout_tab_3_fail.style.display = "none";
    }
    else{
        checkout_tab_3.style.display = "block";
        checkout_tab_3_success.style.display = "none";
        checkout_tab_3_fail.style.display = "block";
    }

}


paypal.Button.render({

    braintree: braintree,
    client: {
        production: document.querySelector("#client-token").innerHTML,
        sandbox: document.querySelector("#client-token").innerHTML
    },
    env: 'sandbox', // Or 'sandbox'
    commit: true, // This will add the transaction amount to the PayPal button

    payment: async function (data, actions) {

        //clicked_info_button();

        let response = await sendGet();

        return actions.braintree.create({
            flow: 'checkout', // Required
            amount: response.amount, // Required
            currency: 'USD', // Required
        });

    },

    onAuthorize: function (payload) {
        console.log(JSON.stringify(payload));
        const data = {
            nonce: payload.nonce,
            orderId: payload.orderID,
            name: input_name.value,
            zipcode: input_zip_code.value,
            address: input_address.value,
            email: input_email.value
        }
        sendPut(data).then(res => check_transaction_result(res));
    },

    locale: 'en_US',
    style: {
        size: 'medium',
        color: 'gold',
        shape: 'pill',
        label: 'checkout',
        tagline: 'true'
    }

}, '#paypal-button');



addEventListenersCheckout();


