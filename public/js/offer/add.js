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
    add_key.addEventListener("click", addKey)
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
            <input type="text" name="key[]" class="form-control mr-2" placeholder="Key" value="${key}">
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
        key_error.innerText = "The key must not be empty!";
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

const resetKeys = () => {
    const keys_buttons = document.querySelectorAll('#key-input-added button');

    keys_buttons.forEach((key) => {
        key.addEventListener("click", () => {
            key.parentElement.parentElement.remove();
        })
    });
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

const addDiscount = () => {
    let discount_add = document.querySelectorAll('#discount-input-add input');

    let key_error = document.getElementById('discount-input-error');



    let discount = newDiscount(discount_add[0].value, discount_add[1].value, discount_add[2].value);
    let added_keys = document.getElementById('key-input-added');

    let today = new Date();
    let tomorrow = new Date(today);
    tomorrow.setDate(tomorrow.getDate() + 1);

    discount_add[0].value = `${today.getUTCFullYear()}/${today.getUTCMonth()}/${today.getUTCDay()}`;
    discount_add[1].value = `${tomorrow.getUTCFullYear()}/${tomorrow.getUTCMonth()}/${tomorrow.getUTCDay()}`;
    discount_add[2].value = 1;

    added_keys.innerHTML += key;

    numberDiscounts();
}

const newDiscount = (start, end, rate) => {
    return `
        <tr>
            <th scope="row">2</th>
            <td><input type="date" class="mx-auto form-control" value="${start}"></td>
            <td><input type="date" class="mx-auto form-control" value="${end}"></td>
            <td class="w-25"><input type="number" class="mx-auto form-control" value="${rate}"></td>
            <td><button class="btn btn-red ml-2"><i class="fas fa-times-circle mt-auto mb-auto d-inline-block"></i></button></td>
        </tr>
    `;
}

addEventListeners();