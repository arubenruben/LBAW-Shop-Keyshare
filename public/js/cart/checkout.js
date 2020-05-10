const checkout_tab_1 = document.querySelector("#checkout-tab-1");
const checkout_tab_2 = document.querySelector("#checkout-tab-2");

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

let valid_inputs;

const addEventListenersCheckout = () => {
    comfirm_order_button.addEventListener('click', clicked_confirm_button);
    your_info_button.addEventListener('click', clicked_info_button);
    paypal_button.addEventListener('click', sendRequest);
}


const verify_input = (input_variable, invalid_block, invalid_text, extra_validation) => {

    if(input_variable.value === ""){
        valid_inputs = false;
        invalid_block.innerHTML = invalid_text;
        input_variable.className += " border-danger";
    }
    else{
        valid_inputs = true;
        if(input_variable.classList.contains('border-danger')){
            input_variable.classList.remove('border-danger');
            invalid_block.innerHTML = "";
        }
    }

}

const clicked_confirm_button = () => {

    valid_inputs = true;

    verify_input(input_name, name_invalid, "Please fill out your name");
    verify_input(input_email, email_invalid, "Please fill out your email");
    verify_input(input_address, address_invalid, "Please fill out your address");
    verify_input(input_zip_code, zip_code_invalid, "Please fill out your zip-code");


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
}

const validate_info = (res) => {



}

const sendRequest = () => {
    let data = assembleData();
    sendGet(data)
        .then(res => validate_info(res))
        .catch(error => console.error("Error: " + error));
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

    return fetch("api/validateCheckoutInfo?" + encodeForAjax(get), options)
        .then(res => res.json())
        .catch(error => console.error("Error: " + error));
}


function encodeForAjax(data) {
    if (data == null) return null;
    return Object.keys(data).map(function(k){
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');
}




// going to check device data
/*braintree.client.create({
    authorization: 'CLIENT_AUTHORIZATION'
}, function (err, clientInstance) {
    // Creation of any other components...

    braintree.dataCollector.create({
        client: clientInstance,
        paypal: true
    }, function (err, dataCollectorInstance) {
        if (err) {
            // Handle error in creation of data collector
            return;
        }
        // At this point, you should access the dataCollectorInstance.deviceData value and provide it
        // to your server, e.g. by injecting it into your form as a hidden input.
        var deviceData = dataCollectorInstance.deviceData;
    });
});*/



var button = document.querySelector('#paypal-button');


braintree.dropin.create({
    authorization: document.querySelector("#client-token").innerHTML,
    container: '#dropin-container'
}, function (createErr, instance) {
    button.addEventListener('click', function () {
        instance.requestPaymentMethod(function (err, payload) {
            // Submit payload.nonce to your server
            sendPut(payload.nonce);
        });
    });
});


// Create a client.
braintree.client.create({
    authorization: document.querySelector("#client-token").innerHTML,
}, function (clientErr, clientInstance) {

    // Stop if there was a problem creating the client.
    // This could happen if there is a network error or if the authorization
    // is invalid.
    if (clientErr) {
        console.error('Error creating client:', clientErr);
        return;
    }

    // Create a PayPal Checkout component.
    braintree.paypalCheckout.create({
        client: clientInstance
    }, function (paypalCheckoutErr, paypalCheckoutInstance) {

        // Stop if there was a problem creating PayPal Checkout.
        // This could happen if there was a network error or if it's incorrectly
        // configured.
        if (paypalCheckoutErr) {
            console.error('Error creating PayPal Checkout:', paypalCheckoutErr);
            return;
        }


        // Set up PayPal with the checkout.js library
        paypal.Button.render({
            env: 'production', // or 'sandbox'

            onError: function (err) {
                console.error('checkout.js error', err);
            },

            payment: function () {
                return paypalCheckoutInstance.createPayment({
                    // Your PayPal options here. For available options, see
                    // http://braintree.github.io/braintree-web/current/PayPalCheckout.html#createPayment
                    flow: 'checkout',
                    amount: 200,
                    currency: 'USD',
                    billingAgreementDescription: 'My Company name',
                    enableShippingAddress: false,
                    enableBillingAddress: false,
                });
            },


            onAuthorize: function (data, actions) {
                return paypalCheckoutInstance.tokenizePayment(data, function (err, payload) {
                    // Submit `payload.nonce` to your server.
                });
            },


            onCancel: function (data) {
                console.log('checkout.js payment cancelled', JSON.stringify(data, 0, 2));
            },


        }, '#paypal-button').then(function () {
            // The PayPal button will be rendered in an html element with the id
            // `paypal-button`. This function will be called when the PayPal button
            // is set up and ready to be used.
        });

    });

});

addEventListenersCheckout();


