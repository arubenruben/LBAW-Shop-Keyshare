'use strict'

const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const url = '/user';

const addEventListeners = () => {
    const email_btn = document.querySelector("#button_submit_email");

    email_btn.addEventListener("click", () => {

        let emailField = (document.querySelector("#form_update_user #email-input")).value;
        const data = {
            email: emailField
        }

        sendPut(data);
    });

    const description_btn = document.querySelector("#button_submit_description");

    description_btn.addEventListener("click", () => {

        const descriptionField = (document.querySelector("#form_update_user #description_textarea")).value;
        const data = {
            description: descriptionField
        }

        sendPut(data);
    });

    const paypal_btn = document.querySelector("#paypalButton");
    paypal_btn.addEventListener("click", () => {
        const paypalField = (document.querySelector("#form_update_user #paypal-input")).value;
        const data = {
            paypal: paypalField
        }

        sendPut(data);
    });

    const password_btn = document.querySelector("#button_submit_password");
    password_btn.addEventListener("click", () => {

        let oldPassword = (document.querySelector("#old-password-input"));
        let newPassword = (document.querySelector("#new-password-input"));
        let newPassword_confirmation = (document.querySelector("#confirm-password-input"));

        let oldPassword_value = oldPassword.value;
        let newPassword_value = newPassword.value;
        let newPassword_confirmation_value = newPassword_confirmation.value;

        let invalid_feedback_new_password  = (document.querySelector("#new_password_invalid"));
        let invalid_feedback_old_password  = (document.querySelector("#old_password_invalid"));

        let valid_old = true;
        let valid_new = true;

        if(oldPassword_value === ""){
            oldPassword.className += " border-danger";
            invalid_feedback_old_password.innerHTML = "Please fill out the old password";
            invalid_feedback_old_password.className = "invalid-feedback d-block";
            valid_old = false;
        }

        else{
            if(oldPassword.classList.contains('border-danger')){
                oldPassword.classList.remove('border-danger');
                invalid_feedback_old_password.className = "invalid-feedback";
            }
        }

        if(newPassword_value === "" || newPassword_confirmation_value === ""){
            newPassword.className += " border-danger";
            newPassword_confirmation.className += " border-danger";
            invalid_feedback_new_password.innerHTML = "Please provide and confirm a new password";
            invalid_feedback_new_password.className = "invalid-feedback d-block";
            valid_new = false;

        }
        else if(newPassword_value !== newPassword_confirmation_value) {
            newPassword.className += " border-danger";
            newPassword_confirmation.className += " border-danger";
            invalid_feedback_new_password.innerHTML = "The passwords dont match";
            invalid_feedback_new_password.className = "invalid-feedback d-block";
            valid_new = false;

        }
        else{
            invalid_feedback_new_password.innerHTML = "";
            invalid_feedback_new_password.className = "invalid-feedback";

            if(newPassword.classList.contains('border-danger')){
                newPassword.classList.remove('border-danger');
            }
            if(newPassword_confirmation.classList.contains('border-danger')){
                newPassword_confirmation.classList.remove('border-danger');
            }
        }

        if(!valid_new && !valid_old) {

            const data = {
                oldPassword: oldPassword.value,
                newPassword: newPassword.value,
                newPassword_confirmation: newPassword_confirmation.value
            }

            sendPut(data).then(res => {
                console.log(res);
            });
        }


    });

    const delete_account_btn = document.querySelector("#delete-account-confirmation");
    delete_account_btn.addEventListener("click", () => {
        const username=(document.querySelector("#delete-account-confirmation-input")).value
        sendDelete(username)
            .then(r=> console.log(r))
            .then(window.location.replace("/"))
    });
}

const sendPost = post => {
    const options = {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token
        },
        method: 'post',
        credentials: "same-origin",
        body: JSON.stringify(post)
    }

    return fetch("/user/", options)
        .then(res => res.json())
        .then(res => console.log(res))
        .catch(error => console.error("Error: {error}"));
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

    return fetch(url, options)
        .then((data) => {
            console.log('Sucesso')
            console.log(data);
        })
        .catch(function (error) {
            console.log(error);
        });
}

const sendDelete = username => {
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
        .catch(error => console.error("Error:"+error));
}

const passwordIsLegal = (curr_password, newPassword, newPassword_confirmation) => {
    newPassword.value = encodeURIComponent(newPassword.value);
    newPassword_confirmation.value = encodeURIComponent(newPassword_confirmation.value);
    let is_legal = /(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])./.test(newPassword.value);

    if (is_legal) {
        curr_password.style.backgroundColor = 'white';
        document.getElementById('msg-password1').innerHTML = '';
        if (newPassword !== newPassword_confirmation) {
            newPassword_confirmation.style.backgroundColor = 'rgb(246, 220, 220)';
            newPassword_confirmation.style.border = 'solid 1px rgb(233, 76, 76)';

            let msg = document.createElement("p");
            msg.innerHTML = "The password\'s don\'t match";
            msg.style.color = 'red';

            curr_password.parentNode.insertBefore(msg, newPassword_confirmation);
            return false;
        }
        else {
            newPassword_confirmation.style.backgroundColor = 'white';
            newPassword_confirmation.style.border = 'solid 1px rgb(176, 183, 187)';

            curr_password.querySelector("p").innerHTML = '';
            return true;
        }
    }
    else {
        let msg = document.createElement("p");
        msg.innerHTML = "Enter a valid password";
        msg.style.color = 'red';
        msg.style.backgroundColor = 'rgb(246, 220, 220)';
    }
    return false;
}

addEventListeners();