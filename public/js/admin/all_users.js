'use strict'

const addEventListeners = () => {
    const buttons = document.querySelectorAll('#all-user-table button');
    const confirm = modal.querySelector('#banModal form#banModal-confirm');

    const updateModal = () => {
        let id = this.getAttribute('data-user');
        confirm.setAttribute('action', confirm.getAttribute('data-default') + id);
    }

    for (let i = 0; i < buttons.length; i++) {
        buttons[i].addEventListener('click', updateModal.bind(buttons[i]));
        buttons[i].getAttribute('data-user');
    }
}

addEventListeners();