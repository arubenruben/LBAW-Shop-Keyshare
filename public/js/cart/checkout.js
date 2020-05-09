const checkout_tab_1 = document.querySelector("#checkout-tab-1");
const checkout_tab_2 = document.querySelector("#checkout-tab-2");
const comfirm_order_button = document.querySelector("#confirm-order");
const your_info_button = document.querySelector("#your-info");


const clicked_confirm_button = () => {
    checkout_tab_1.style.display = "none";
    checkout_tab_2.style.display = "block";
}

const clicked_info_button = () => {
    checkout_tab_1.style.display = "block";
    checkout_tab_2.style.display = "none";
}


comfirm_order_button.addEventListener('click', clicked_confirm_button);
your_info_button.addEventListener('click', clicked_info_button);



