'use strict'

const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const url = '/user';

const addEventListeners = () => {
    const email_btn = document.querySelector("#button_submit_email");


    email_btn.addEventListener("click", () => {
        let emailField = (document.querySelector("#form_update_user input[type=email]")).value;

        const objData = {
            email: emailField
        }
        
        sendPut(objData);

    });

    /*
    
    const description_btn = document.querySelector("#");
    email_btn.addEventListener("click", () => {

    });
    const upload_img_btn = document.querySelector("#");
    upload_img_btn.addEventListener("click", () => {

    });
    const delete_img_btn = document.querySelector("#");
    delete_img_btn.addEventListener("click", () => {

    });



    const password_btn = document.querySelector("#");
    password_btn.addEventListener("click", () => {
        const curr_password = document.querySelector("input[type=\"password\"]:nth-child(0)");
        const new_password = document.querySelector("input[type=\"password\"]:nth-child(1)");
        const confirm_password = document.querySelector("input[type=\"password\"]:nth-child(2)");

        if(!passwordIsLegal(curr_password, new_password, confirm_password)) return;

        const change_password = {
            oldPassword: curr_password.value,
            newPassword: new_password.value,
            newPassword_confirmation: confirm_password.value
        }

         // changes password
        sendPost(change_password).then(r => console.log(r));

    });

    const delete_account_btn = document.querySelector("#");
    delete_account_btn.addEventListener("click", () => {

    });
    */
}
const sendPost = post => {
    const options = {
        method: 'POST',
        body: JSON.stringify(post),
        headers: new Headers({
            'X-CSRF-TOKEN': crsf_token.getAttribute("content"),
            'Content-Type': 'application/json'
        })
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