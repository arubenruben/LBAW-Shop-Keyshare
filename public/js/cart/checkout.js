const checkout_tab_1 = document.querySelector("#checkout-tab-1");
const checkout_tab_2 = document.querySelector("#checkout-tab-2");
const comfirm_order_button = document.querySelector("#confirm-order");
const your_info_button = document.querySelector("#your-info");

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


const clicked_info_button = () => {

    checkout_tab_1.style.display = "block";
    checkout_tab_2.style.display = "none";
}


comfirm_order_button.addEventListener('click', clicked_confirm_button);
your_info_button.addEventListener('click', clicked_info_button);



