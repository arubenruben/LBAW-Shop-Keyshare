'use strict'

const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const url = '/user';


const isValidEmail = (email) => {
    return /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/.test(email);
}

const isValidPassword = (password) => {
    return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/u.test(password);
}

const isValidDescription = (description) => {
    return description.length <= 500;
}

const addEventListeners = () => {
    let email_invalid = document.querySelector("#email-invalid");
    let email_valid = document.querySelector("#email-valid");

    const email_btn = document.querySelector("#button_submit_email");
    email_btn.addEventListener("click", () => {
        let email_field = document.querySelector("#form_update_user #email-input");

       if(!isValidEmail(email_field.value)){
            email_invalid.innerHTML = "Invalid Email, choose another one";
            if(email_field.classList.contains('border-success'))
                email_field.classList.remove('border-success');
            email_field.className += " border-danger";
            email_valid.innerHTML = "";
            email_field.className += " border-danger";
        }else{
            const data = {
                email: email_field.value
            }
            sendPost(data).then(res => {
                if (res != "Success") {
                    if(email_field.classList.contains('border-success'))
                        email_field.classList.remove('border-success');
                    email_field.className += " border-danger";
                    email_valid.innerHTML = "";
                    email_invalid.innerHTML = res['errors']['email'];
                }else {
                    if(email_field.classList.contains('border-danger'))
                        email_field.classList.remove('border-danger');
                    email_field.className += " border-success";
                    email_invalid.innerHTML = "";
                    email_valid.innerHTML = "Changed email successfully";
                }
            }
        );
    }
});


const description_btn = document.querySelector("#button_submit_description");
description_btn.addEventListener("click", () => {
    const description_field = document.querySelector("#form_update_user #description_textarea");
    let description_invalid = document.querySelector("#description-invalid");
    let description_valid = document.querySelector("#description-valid");

    console.log(description_valid);
    console.log(description_invalid)

    if(!isValidDescription(description_field.value)){
        description_invalid.innerHTML = "Invalid Email, choose another one";
        if(description_field.classList.contains('border-success'))
            description_field.classList.remove('border-success');
        if(description_valid.classList.contains('d-block'))
            description_valid.classList.remove('d-block');
        description_valid.innerHTML = "";
        description_field.className += " border-danger";
        description_invalid.className += " d-block";
        description_invalid.innerHTML =  "Description must have 500 or less characters";
    }else {
        const data = {
            description: description_field.value
        }
        sendPost(data).then(res => {
            if (res != "Success") {
                if(description_field.classList.contains('border-success'))
                    description_field.classList.remove('border-success');
                if(description_valid.classList.contains('d-block'))
                    description_valid.classList.remove('d-block');
                description_field.className += " border-danger";
                description_valid.innerHTML = "";
                description_invalid.className += " d-block";
                description_invalid.innerHTML = res['errors']['description'];
            }else {
                if(description_field.classList.contains('border-danger'))
                    description_field.classList.remove('border-danger');
                if(description_field.classList.contains('d-block'))
                    description_field.classList.remove('d-block');
                description_field.className += " border-success";
                description_invalid.innerHTML = "";
                description_valid.className += " d-block";
                description_valid.innerHTML = "Changed description successfully";
            }
        });
    }
});


const password_btn = document.querySelector("#button_submit_password");
password_btn.addEventListener("click", () => {

    let oldPassword = (document.querySelector("#old-password-input"));
    let newPassword = (document.querySelector("#new-password-input"));
    let newPassword_confirmation = (document.querySelector("#confirm-password-input"));

    let oldPassword_value = oldPassword.value;
    let newPassword_value = newPassword.value;
    let newPassword_confirmation_value = newPassword_confirmation.value;

    let invalid_feedback_new_password = (document.querySelector("#new-password-invalid"));
    let invalid_feedback_old_password = (document.querySelector("#old-password-invalid"));
    let valid_feedback_confirmation = (document.querySelector("#new-password-valid"));



    let valid_old = true;
    let valid_new = true;

    if (oldPassword_value === "") {
        if(oldPassword.classList.contains('border-success'))
            oldPassword.classList.remove('border-success');
        valid_feedback_confirmation.innerHTML = "";
        oldPassword.className += " border-danger";
        invalid_feedback_old_password.innerHTML = "Please fill out the old password";
        invalid_feedback_old_password.className = "invalid-feedback d-block";
        valid_old = false;
    } else {
        if (oldPassword.classList.contains('border-danger')) {
            oldPassword.classList.remove('border-danger');
            invalid_feedback_old_password.className = "invalid-feedback";
        }
    }


    if (newPassword_value === "" || newPassword_confirmation_value === "") {
        if(newPassword.classList.contains('border-success'))
            newPassword.classList.remove('border-success');
        valid_feedback_confirmation.innerHTML = "";
        newPassword.className += " border-danger";
        newPassword_confirmation.className += " border-danger";
        invalid_feedback_new_password.innerHTML = "Please provide and confirm a new password";
        invalid_feedback_new_password.className = "invalid-feedback d-block";
        valid_new = false;

    } else if (newPassword_value !== newPassword_confirmation_value) {
        if(newPassword.classList.contains('border-success'))
            newPassword.classList.remove('border-success');
        valid_feedback_confirmation.innerHTML = "";
        newPassword.className += " border-danger";
        newPassword_confirmation.className += " border-danger";
        invalid_feedback_new_password.innerHTML = "The passwords dont match";
        invalid_feedback_new_password.className = "invalid-feedback d-block";
        valid_new = false;

    } else if(!isValidPassword(newPassword_value)){
        if(newPassword.classList.contains('border-success'))
            newPassword.classList.remove('border-success');
        valid_feedback_confirmation.innerHTML = "";
        newPassword.className += " border-danger";
        newPassword_confirmation.className += " border-danger";
        invalid_feedback_new_password.innerHTML = " <p>The password needs to contains characters from this categories:</p>\n" +
            "        <p>* Minimum eight characters</p>\n" +
            "        <p>* At least one uppercase letter </p>\n" +
            "        <p>* One lowercase letter</p>\n" +
            "        <p>* One number and one special character</p>";
        invalid_feedback_new_password.className = "invalid-feedback d-block";
        valid_new = false;
    }
    else {
        invalid_feedback_new_password.innerHTML = "";
        invalid_feedback_new_password.className = "invalid-feedback";

        if (newPassword.classList.contains('border-danger')) {
            newPassword.classList.remove('border-danger');
        }
        if (newPassword_confirmation.classList.contains('border-danger')) {
            newPassword_confirmation.classList.remove('border-danger');
        }
    }

    if (valid_new && valid_old){

        const data = {
            oldPassword: oldPassword.value,
            newPassword: newPassword.value,
            newPassword_confirmation: newPassword_confirmation.value
        }

        sendPost(data).then(res => {
            if (res != "Success") {
                if(oldPassword.classList.contains('border-success'))
                    oldPassword.classList.remove('border-success');
                if(newPassword.classList.contains('border-success'))
                    newPassword.classList.remove('border-success');
                if(newPassword_confirmation.classList.contains('border-success'))
                    newPassword_confirmation.classList.remove('border-success');

                valid_feedback_confirmation.innerHTML = "";
                console.log(res);
                if(typeof res['errors']['newPassword']  !== 'undefined') {
                    if(!newPassword.classList.contains('border-danger'))
                        newPassword.className += " border-danger";
                    if(!newPassword_confirmation.classList.contains('border-danger'))
                        newPassword_confirmation.className += ' border-danger';
                    invalid_feedback_new_password.innerHTML = res['errors']['newPassword']
                    invalid_feedback_new_password.className = "invalid-feedback d-block";
                }
                if(typeof res['errors']['oldPassword']  !== 'undefined') {
                    if(!oldPassword.classList.contains('border-danger'))
                        oldPassword.className += " border-danger";
                    invalid_feedback_old_password.innerHTML = res['errors']['oldPassword'];
                    invalid_feedback_old_password.className = "invalid-feedback d-block";
                }
            }
            else {
                if(oldPassword.classList.contains('border-danger'))
                    oldPassword.classList.remove('border-danger');
                if(newPassword.classList.contains('border-danger'))
                    newPassword.classList.remove('border-danger');
                if(newPassword_confirmation.classList.contains('border-danger'))
                    newPassword_confirmation.classList.remove('border-danger');


                if(!oldPassword.classList.contains('border-success'))
                    oldPassword.className += ' border-success';
                if(!newPassword.classList.contains('border-success'))
                    newPassword.className += ' border-success';
                if(!newPassword_confirmation.classList.contains('border-success'))
                    newPassword_confirmation.className += ' border-success';


                invalid_feedback_new_password.innerHTML = "";
                invalid_feedback_old_password.innerHTML = "";
                invalid_feedback_old_password.className = "invalid-feedback";
                invalid_feedback_new_password.className = "invalid-feedback";

                valid_feedback_confirmation.className = "valid-feedback d-block";
                valid_feedback_confirmation.innerHTML = "Changed password successfully";
            }
        });
    }
});





const delete_account_btn = document.querySelector("#delete-account-confirmation");
const delete_account_input = document.querySelector("#delete-account-confirmation-input");
const invalid_username_feedback = document.querySelector("#invalid-username-feedback");
const username = document.querySelector("#username");
delete_account_btn.addEventListener("click", () => {
    if(delete_account_input.value !== username.innerHTML){
        delete_account_input.className += " border-danger";
        invalid_username_feedback.className = "invalid-feedback d-block";
        invalid_username_feedback.innerHTML = "Username doesn't match";
    }
    else {
        if(delete_account_input.classList.contains('border-danger'))
            delete_account_input.classList.remove('border-danger');
        invalid_username_feedback.className = "invalid-feedback";
        invalid_username_feedback.innerHTML = "";
        sendDelete(username.innerHTML).then(window.location.replace("/"))
    }
});

const uploadImageForm = document.querySelector('#form-img-upload');
uploadImageForm.addEventListener('change', () => {

    const fileBlob = document.querySelector('#img-upload').files[0];

    const fileReader = new FileReader();

    fileReader.onload = function () {
        const imgPreview = document.querySelector('#profile-image');
        const imgPreviewHeader = document.querySelector('#profile-image-icon');
        imgPreview.setAttribute('src', fileReader.result);
        imgPreviewHeader.setAttribute('src', fileReader.result);
    }
    fileReader.readAsDataURL(fileBlob);

    uploadFile(fileBlob);

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
        body: JSON.stringify(post),
    }

    return fetch("/user/", options)
        .then(res => res.json())
        .catch(error => console.error("Error:" + error));
}

const sendDelete = () => {
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

const uploadFile = file => {

    let form = new FormData();
    form.append("picture", file, file.name);
    //form.append("string", "ola");

    const options = {
        headers: {
            "X-CSRF-TOKEN": token,
        },
        credentials: "same-origin",
        method: 'post',
        contentType: false,
        processData: false,
        body: form
    }

    return fetch("/user/", options)
        .then(res => res.json())
        .catch(error => console.error("Error:" + error));

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
        } else {
            newPassword_confirmation.style.backgroundColor = 'white';
            newPassword_confirmation.style.border = 'solid 1px rgb(176, 183, 187)';

            curr_password.querySelector("p").innerHTML = '';
            return true;
        }
    } else {
        let msg = document.createElement("p");
        msg.innerHTML = "Enter a valid password";
        msg.style.color = 'red';
        msg.style.backgroundColor = 'rgb(246, 220, 220)';
    }
    return false;
}

addEventListeners();