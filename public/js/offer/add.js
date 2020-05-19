'use strict'


const addEventListeners = () => {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const send_offer = document.querySelector("button#offer-submit");
    const add_discount = document.querySelector("section#discount-input button.btn-blue");
    const product_choice = document.getElementById("product-selection");
    const product_image = document.querySelector("img.productPageImgPreview");
    const add_key = document.querySelector("section#key-input button.btn-blue");

    const sendOffer = () => {
        const form = new FormData(document.querySelector("form#content"));

        const submit_error = document.getElementById("offer-submit-error");

        const submit_button = document.getElementById("offer-submit");

        if (product_choice.value === "") {
            submit_error.innerText = "Please select a product and platform.";
            product_choice.classList.add('border-danger');
            submit_button.classList.add('border-danger');
            submit_error.classList.add('d-block');
            return;
        } else {
            product_choice.classList.remove('border-danger');
        }

        const keys = form.getAll("key[]");

        if (keys.length === 0) {
            submit_error.innerText = "There must be at least one key.";
            submit_button.classList.add('border-danger');
            submit_error.classList.add('d-block');
            return;
        }

        for (let i = 0; i < keys.length; i++) {
            const key = keys[i];

            if (!isValidKey(key.value)) {
                submit_error.innerText = "There is an invalid key.";
                submit_button.classList.add('border-danger');
                submit_error.classList.add('d-block');
                return;
            }
        }

        const discounts_start = form.getAll("discount[][start]");
        const discounts_end = form.getAll("discount[][end]");
        const discounts_rate = form.getAll("discount[][rate]");

        if (discounts_start.length !== discounts_end.length || discounts_start.length !== discounts_rate.length) {
            submit_error.innerText = "There is an invalid discount row.";
            submit_button.classList.add('border-danger');
            submit_error.classList.add('d-block');
            return;
        }
        for (let i = 0; i < discounts_start.length; i++) {
            if (!isValidDate(discounts_start[i]) || !isValidDate(discounts_end[i]) ||
                discounts_rate[i] < 1 || discounts_rate[i] > 99) {
                submit_error.innerText = "There is an invalid discount row.";
                submit_button.classList.add('border-danger');
                submit_error.classList.add('d-block');
                return;
            }
        }

        const price = form.get("price");
        if (price === null || price < 1) {
            submit_error.innerText = "Please fill the price per key with a valid value.";
            submit_button.classList.add('border-danger');
            submit_error.classList.add('d-block');
        }

        submit_error.innerText = "";
        submit_button.classList.remove('border-danger');
        submit_error.classList.remove('d-block');

        let discounts = [];
        for (let i = 0; i < discounts_start.length; i++) {
            discounts.push({
                start: discounts_start[i],
                end: discounts_end[i],
                rate: discounts_rate[i],
            });
        }

        const platform = document.getElementById("platform-selection");
        const paypal = form.get('paypal');
        let data = {
            product: product_choice.value,
            platform: platform.value,
            keys: keys,
            discounts: discounts,
            price: price,
            paypal: paypal
        };

        send_offer.removeEventListener("click", sendOffer);

        sendPut(data)
            .then(res => {
                let status = res.status;
                res.text().then(response => {
                    if (status === 200) {
                        window.location = response;
                    } else {
                        submit_error.innerText = response;
                    }
                    send_offer.addEventListener("click", sendOffer);
                });
            })
            .catch(error => {
                submit_error.innerText = `${error}`;
                submit_button.classList.add('border-danger');
                submit_error.classList.add('d-block');
                send_offer.addEventListener("click", sendOffer);
            });
    }

    const setPlatforms = platforms => {
        if (platforms == null || !Array.isArray(platforms)) {
            return;
        }

        const platform_choice = document.getElementById("platform-selection");

        for (let i = platform_choice.length - 1; i >= 0; i--) {
            platform_choice.remove(i);
        }

        for (let i = 0; i < platforms.length; i++) {
            let platform = platforms[i];

            let option = document.createElement("option");
            option.value = platform.id;
            option.text = platform.name;
            platform_choice.add(option);
        }
    }

    const newKey = key => {
        return `
        <div class="input-group mt-2">
            <input type="text" name="key[]" class="form-control mr-2" readonly value="${key}">
            <span class="input-group-btn">
                <button type="button" class="btn btn-red"><i class="fas fa-times-circle"></i></button>
            </span>
        </div>
    `;
    }

    const addKey = () => {
        let key_add = document.getElementById('key-input-add');

        let key_error = document.getElementById('key-input-error');

        if (key_add.value == null || key_add.value.length === 0) {
            key_error.innerText = "The key must not be empty.";
            key_add.classList.add('border-danger')
            key_error.classList.add('d-block')
            return;
        } else if (!isValidKey(key_add.value)) {
            key_error.innerText = "The key inserted must have only letters and numbers and can be divided with - or \\ or /.";
            key_add.classList.add('border-danger')
            key_error.classList.add('d-block')
            return;
        } else {
            key_error.innerText = null;
            key_add.classList.remove('border-danger');
            key_error.classList.remove('d-block');
        }

        let key = newKey(key_add.value);
        let added_keys = document.getElementById('key-input-added');

        key_add.value = null;
        added_keys.innerHTML += key;

        resetKeys();
    }

    const isValidKey = (key) => {
        return /^\w+([\-|\\|/]\w+)*$/g.test(key);
    }

    const resetKeys = () => {
        const keys_buttons = document.querySelectorAll('#key-input-added button');

        keys_buttons.forEach((key) => {
            key.addEventListener("click", () => {
                key.parentElement.parentElement.remove();
            })
        });
    }

    const newDiscount = (index, start, end, rate) => {
        let discount = document.createElement("tr");
        discount.innerHTML = `    
            <th scope="row">${index}</th>
            <td><input type="date" name="discount[][start]" class="mx-auto form-control" value="${start}" readonly></td>
            <td><input type="date" name="discount[][end]" class="mx-auto form-control" value="${end}" readonly></td>
            <td class="w-25"><input type="number" name="discount[][rate]" class="mx-auto form-control" value="${rate}" readonly></td>
            <td><button class="btn btn-red ml-2"><i class="fas fa-times-circle mt-auto mb-auto d-inline-block"></i></button></td>
        `;

        return discount;
    }

    const addDiscount = () => {
        let discounts = document.querySelector('#discount-input tbody');
        let discount_inputs = document.querySelectorAll('#discount-input-add input');
        let discount_add = document.getElementById('discount-input-add');

        if (!verifyDiscount(discount_inputs)) {
            return;
        }

        let discount = newDiscount(discounts.children.length, discount_inputs[0].value, discount_inputs[1].value, discount_inputs[2].value);

        let today = new Date();
        let tomorrow = new Date(today);
        tomorrow.setDate(tomorrow.getDate() + 1);

        discount_inputs[0].setAttribute("value", formatDate(today));
        discount_inputs[1].setAttribute("value", formatDate(tomorrow));
        discount_inputs[2].value = 1;

        discounts.insertBefore(discount, discount_add);

        resetDiscounts();
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
        const discount_error = document.getElementById('discount-input-error');
        const start = discount_inputs[0];
        const end = discount_inputs[1];
        const rate = discount_inputs[2];

        discount_error.innerText = null;
        discount_error.classList.remove('d-block');
        start.classList.remove('border-danger');
        end.classList.remove('border-danger');
        rate.classList.remove('border-danger');

        if (start.value == null) {
            discount_error.innerText = "The start date must not be empty.";
            start.classList.add('border-danger');
            discount_error.classList.add('d-block');
            return false;
        }

        if (end.value == null) {
            discount_error.innerText = "The end date must not be empty.";
            start.classList.add('border-danger');
            discount_error.classList.add('d-block');
            return false;
        }

        if (rate.value == null) {
            discount_error.innerText = "The discount rate must not be empty.";
            rate.classList.add('border-danger');
            discount_error.classList.add('d-block');
            return false;
        }

        if (!isValidDate(start.value)) {
            discount_error.innerText = "The start date must be in the correct format and be valid.";
            start.classList.add('border-danger');
            discount_error.classList.add('d-block');
            return false;
        }

        if (!isValidDate(end.value)) {
            discount_error.innerText = "The end date must be in the correct format and be valid.";
            end.classList.add('border-danger');
            discount_error.classList.add('d-block');
            return false;
        }

        if (rate.value < 1 || rate.value > 99) {
            discount_error.innerText = "The discount rate must be between 1% and 99%.";
            rate.classList.add('border-danger');
            discount_error.classList.add('d-block');
            return false;
        }

        if (new Date(end.value) <= new Date(start.value)) {
            discount_error.innerText = "The end date must be at least one day after the start date.";
            start.classList.add('border-danger');
            end.classList.add('border-danger');
            discount_error.classList.add('d-block');
            return false;
        }

        return true;
    }

    const resetDiscounts = () => {
        const deleteButtons = document.querySelectorAll('#discount-input tbody button');

        deleteButtons.forEach((button) => {
            button.addEventListener('click', () => {
                button.parentElement.parentElement.remove();
                numberDiscounts();
            })
        })
    }

    const numberDiscounts = () => {
        const discounts_headers = document.querySelectorAll('#discount-input tbody th');

        for (let i = 0; i < discounts_headers.length - 1; i++) {
            discounts_headers[i].innerHTML = String(i + 1);
        }
    }

    const sendPut = put => {
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

        return fetch("/offer/", options);
    }

    product_choice.addEventListener("change", () => {
        let selected = product_choice.options[product_choice.selectedIndex];

        product_image.src = selected.getAttribute("data-img");
        let platforms = JSON.parse(selected.getAttribute("data-platforms"));

        setPlatforms(platforms);
    });

    add_key.addEventListener("click", addKey);

    add_discount.addEventListener("click", addDiscount);

    send_offer.addEventListener("click", sendOffer);
}

addEventListeners();