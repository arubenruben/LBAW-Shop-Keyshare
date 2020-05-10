'use strict'

const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

const addEventListeners = () => {
    const product_image = document.querySelector("img.productPageImgPreview");

    const game_choice = document.getElementById("game-selection");
    game_choice.addEventListener("change", () => {
        let selected = game_choice.options[game_choice.selectedIndex];

        product_image.src = selected.getAttribute("data-img");
        let platforms = JSON.parse(selected.getAttribute("data-platforms"));

        setPlatforms(platforms);
    });

    const add_key = document.querySelector("section#key-input button.btn-blue");
    add_key.addEventListener("click", addKey);

    const add_discount = document.querySelector("section#discount-input button.btn-blue");
    add_discount.addEventListener("click", addDiscount);

    const send_offer = document.querySelector("button#offer-submit");
    send_offer.addEventListener("click", sendOffer);
}

const sendOffer = () => {
    const form = new FormData(document.querySelector("form#content"));

    const keys = form.getAll("key");
    console.log(keys);
    if(keys.length === 0) {
        return;
    }

    for (let i = 0; i < keys.length; i++) {
        const key = keys[i];

        if(!isValidKey(key.value)){
            return;
        }
    }

    const discounts = form.getAll("discount");
    console.log(discounts);
    for (let i = 0; i < discounts.length; i++) {
        const discount = discounts[i];

        if(discount.length === 3 || !isValidDate(discount[0]) || !isValidDate(discount[1])
                || discount[2] < 1 || discount[2] > 99){
            return;
        }
    }

    //sendPut()
}

const setPlatforms = platforms => {
    if(platforms == null || !Array.isArray(platforms)) {
        return;
    }

    const platform_choice = document.getElementById("platform-selection");

    for (let i = platform_choice.length - 1; i >= 0; i--) {
        platform_choice.remove(i);
    }

    for (let i = 0; i < platforms.length; i++){
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


    if(key_add.value == null || key_add.value.length === 0){
        key_error.innerText = "The key must not be empty.";
        key_add.classList.add('border-danger')
        key_error.classList.add('d-block')
        return;
    } else if (!isValidKey(key_add.value)){
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

const isValidKey = (key : String) => {
    return /^\w+[[-\\/]\w+]*$/g.test(key);
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

    if(!verifyDiscount(discount_inputs)){
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

const formatDate = (date : Date) => {
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

const isValidDate = (date : String) => {
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

    return fetch("/user/", options)
        .then(res => res.json())
        .catch(error => console.error("Error: {error}"));
}

addEventListeners();