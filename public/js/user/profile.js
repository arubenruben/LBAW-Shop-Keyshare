const addEventListeners = () => {

    const feedback_btn = document.querySelector("#");
    feedback_btn.addEventListener("click", () => {

    });

    const password_btn = document.querySelector("#");
    password_btn.addEventListener("click", () => {
        // check password validity


        // get values
        const curr_password = document.querySelector("#").value;
        const new_password = document.querySelector("#").value;
        const confirm_password = document.querySelector("#").value;

        const change_password = {
            oldPassword: curr_password,
            newPassword: new_password,
            newPassword_confirmation: confirm_password
        }

         // changes password
        sendPost(change_password).then(r => console.log(r));

    });
}

const sendPost = post => {
    const options = {
        method: 'POST',
        body: JSON.stringify(post),
        headers: new Headers({
            'Content-Type': 'application/json'
        })
    }

    return fetch("/user", options)
        .then(res => res.json())
        .then(res => console.log(res))
        .catch(error => console.error("Error: {error}"));
}

const checkPassword = (password) => {
        let password = escapeHtml(document.getElementById('password').value);
        let isLegal = /(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])./.test(password);

        if (isLegal) {
            document.getElementById('password').style.backgroundColor = 'white';
            document.getElementById('msg-password1').innerHTML = '';
            if (document.getElementById('confirm_password').value != password) {
                if (document.getElementById('password-change'))
                    document.getElementById('password-change').disabled = true;

                document.getElementById('confirm_password').style.backgroundColor = 'rgb(246, 220, 220)';
                document.getElementById('confirm_password').style.border = 'solid 1px rgb(233, 76, 76)'
                document.getElementById('msg-password2').innerHTML = 'The password\'s don\'t match';
                document.getElementById('msg-password2').style.color = 'red';
            }
            else {
                if (document.getElementById('password-change'))
                    document.getElementById('password-change').disabled = false;

                document.getElementById('confirm_password').style.backgroundColor = 'white';
                document.getElementById('confirm_password').style.border = 'solid 1px rgb(176, 183, 187)'
                document.getElementById('msg-password2').innerHTML = '';
                return true;
            }
        }
        else {
            document.getElementById('password').style.backgroundColor = 'rgb(246, 220, 220)';
            document.getElementById('msg-password1').style.color = 'red';
            document.getElementById('msg-password1').innerHTML = 'Enter a valid password';
        }
        return false;
}