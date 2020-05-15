'use strict'


const addEventListeners = () => {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const offer_id = document.querySelector('meta[name="offer-id"]').getAttribute('content');
    const add_discount = document.querySelector("section#offer-discounts button.btn-blue");
    const add_key = document.querySelector("section#offer-keys button.btn-blue");

    const newKey = (id, key) => {
        return `
            <div class="input-group mt-2">
                <p class="form-control mr-2" readonly>${key}</p>
                <span class="input-group-btn mt-2">
                    <button type="button" class="btn btn-red" data-key-id="${id}"><i class="fas fa-times-circle"></i></button>
                </span>
            </div>
    `;
    }

    const addKey = () => {
        let key_add = document.getElementById('offer-keys-add');

        let key_error = document.getElementById('offer-keys-error');

        if(key_add.value == null || key_add.value.length === 0){
            key_error.innerText = "The key must not be empty.";
            key_add.classList.add('border-danger');
            key_error.classList.add('d-block');
            return;
        } else if (!isValidKey(key_add.value)){
            key_error.innerText = "The key inserted must have only letters and numbers and can be divided with - or \\ or /.";
            key_add.classList.add('border-danger');
            key_error.classList.add('d-block');
            return;
        } else {
            key_error.innerText = null;
            key_add.classList.remove('border-danger');
            key_error.classList.remove('d-block');
        }

        sendPut(`/offer/${offer_id}/key`, {key: key_add.value})
            .then(response => {
                if(response.status === 200){
                    response.json().then(res => {
                        let key = newKey(res.id, key_add.value);
                        let added_keys = document.getElementById('offer-keys-added');

                        key_add.value = null;
                        added_keys.innerHTML += key;

                        resetKeys();
                    })
                    .catch(reason => {
                        key_error.innerText = reason;
                        key_add.classList.add('border-danger');
                        key_error.classList.add('d-block');
                    });
                } else {
                    key_error.innerText = "The key inserted is invalid.";
                    key_add.classList.add('border-danger');
                    key_error.classList.add('d-block');
                }
            })
            .catch(reason => {
                key_error.innerText = reason;
                key_add.classList.add('border-danger');
                key_error.classList.add('d-block');
            });
    }

    const isValidKey = (key) => {
        return /^\w+([\-|\\|/]\w+)*$/g.test(key);
    }

    const resetKeys = () => {
        const keys_buttons = document.querySelectorAll('#offer-keys button.btn-red');

        keys_buttons.forEach((key) => {
            key.addEventListener("click", () => {
                sendDelete('/key/' + key.getAttribute("data-key-id"))
                    .then(response => {
                        if(response.status === 200)
                            key.parentElement.parentElement.remove();
                    });
            })
        });
    }

    const newDiscount = (index, id, start, end, rate) => {
        let discount = document.createElement("tr");
        discount.innerHTML = `    
            <th scope="row">${index}</th>
            <td><span class="mx-auto form-control nobr" readonly>${start}</span></td>
            <td><span class="mx-auto form-control nobr" readonly>${end}</span></td>
            <td class="w-25"><span class="mx-auto form-control" readonly>${rate}</span></td>
            <td><button class="btn btn-red ml-2" data-discount-id="${id}"><i class="fas fa-times-circle mt-auto mb-auto d-inline-block"></i></button></td>
        `;

        return discount;
    }

    const addDiscount = () => {
        const discounts = document.querySelector('#offer-discounts tbody');
        const discount_inputs = document.querySelectorAll('#offer-discounts-add input');
        const discount_add = document.getElementById('offer-discounts-add');
        const discount_error = document.getElementById('offer-discounts-error');

        if (!verifyDiscount(discount_inputs)) {
            return;
        }

        let data = {
            start: discount_inputs[0].value,
            end: discount_inputs[1].value,
            rate: discount_inputs[2].value
        };

        sendPut(`/offer/${offer_id}/discount`, data)
            .then(response => {
                if (response.status === 200) {
                    response.json()
                        .then(res => {
                            let discount = newDiscount(discounts.children.length, res.id, discount_inputs[0].value, discount_inputs[1].value, discount_inputs[2].value);

                            let today = new Date();
                            let tomorrow = new Date(today);
                            tomorrow.setDate(tomorrow.getDate() + 1);

                            discount_inputs[0].setAttribute("value", formatDate(today));
                            discount_inputs[1].setAttribute("value", formatDate(tomorrow));
                            discount_inputs[2].value = 1;

                            discounts.insertBefore(discount, discount_add);

                            resetDiscounts();
                        })
                        .catch(reason => {
                            discount_error.innerText = reason;
                            discount_add.classList.add('border-danger');
                            discount_error.classList.add('d-block');
                        });
                } else {
                    discount_error.innerText = "The discount inserted is invalid.";
                    discount_add.classList.add('border-danger');
                    discount_error.classList.add('d-block');
                }
            })
            .catch(reason => {
                discount_error.innerText = reason;
                discount_add.classList.add('border-danger');
                discount_error.classList.add('d-block');
            });
    }

    const formatDate = (date) => {
        let year = date.getFullYear();
        let month = date.getMonth() + 1;
        let day = date.getDate();

        if (month < 10) {
            month = "0" + month;
        }

        if (day < 10) {
            day = "0" + day;
        }

        return [year, month, day].join("-");
    }

    const isValidDate = (date) => {
        return /^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$/.test(date);
    }

    const verifyDiscount = (discount_inputs) => {
        const discount_error = document.getElementById('offer-discounts-error');
        const start = discount_inputs[0];
        const end = discount_inputs[1];
        const rate = discount_inputs[2];

        discount_error.innerText = null;
        discount_error.classList.remove('d-block');
        start.classList.remove('border-danger');
        end.classList.remove('border-danger');
        rate.classList.remove('border-danger');

        if(start.value == null){
            discount_error.innerText = "The start date must not be empty.";
            start.classList.add('border-danger');
            discount_error.classList.add('d-block');
            return false;
        }

        if(end.value == null){
            discount_error.innerText = "The end date must not be empty.";
            start.classList.add('border-danger');
            discount_error.classList.add('d-block');
            return false;
        }

        if(rate.value == null){
            discount_error.innerText = "The discount rate must not be empty.";
            rate.classList.add('border-danger');
            discount_error.classList.add('d-block');
            return false;
        }

        if(!isValidDate(start.value)){
            discount_error.innerText = "The start date must be in the correct format and be valid.";
            start.classList.add('border-danger');
            discount_error.classList.add('d-block');
            return false;
        }

        if(!isValidDate(end.value)){
            discount_error.innerText = "The end date must be in the correct format and be valid.";
            end.classList.add('border-danger');
            discount_error.classList.add('d-block');
            return false;
        }

        if(rate.value < 1 || rate.value > 99 ){
            discount_error.innerText = "The discount rate must be between 1% and 99%.";
            rate.classList.add('border-danger');
            discount_error.classList.add('d-block');
            return false;
        }

        if(new Date(end.value) <= new Date(start.value) ){
            discount_error.innerText = "The end date must be at least one day after the start date.";
            start.classList.add('border-danger');
            end.classList.add('border-danger');
            discount_error.classList.add('d-block');
            return false;
        }

        return true;
    }

    const resetDiscounts = () => {
        const deleteButtons = document.querySelectorAll('#offer-discounts tbody button');

        deleteButtons.forEach((button) => {
            button.addEventListener('click', () => {
                sendDelete('/discount/' + button.getAttribute("data-discount-id"))
                    .then(response => {
                        if(response.status === 200){
                            button.parentElement.parentElement.remove();
                            numberDiscounts();
                        }
                    });

            })
        })
    }

    const numberDiscounts = () => {
        const discounts_headers = document.querySelectorAll('#offer-discounts tbody th');

        for (let i = 0; i < discounts_headers.length - 1; i++) {
            discounts_headers[i].innerHTML = String(i + 1);
        }
    }

    const sendPut = (url, put) => {
        const options = {
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json, text-plain, */*",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": token
            },
            method: 'put',
            credentials: "same-origin",
            body: JSON.stringify(put)
        }

        return fetch(url, options);
    }

    const sendDelete = url => {
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
            .catch(error => console.error("Error:"+error));
    }

    add_key.addEventListener("click", addKey);

    add_discount.addEventListener("click", addDiscount);

    resetKeys();
    resetDiscounts();
}

addEventListeners();