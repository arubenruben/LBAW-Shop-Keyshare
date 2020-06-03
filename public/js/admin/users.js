'use strict'

const addEventListeners = () => {
    const buttons = document.querySelectorAll('#all-user-table button');
    const confirm = document.querySelector('#banModal form#banModal-confirm');
    const banned = document.querySelector('#banModal form input[name="ban"]');

    const updateModal = button => {
        let id = button.getAttribute('data-user');
        let isBanned = button.getAttribute('data-banned');
        banned.setAttribute('value', isBanned === 'true' ? 0 : 1);
        confirm.setAttribute('action', confirm.getAttribute('data-default') + id);
    }

    for (let i = 0; i < buttons.length; i++) {
        buttons[i].addEventListener('click', updateModal.bind(buttons[i], buttons[i]));
    }
}

addEventListeners();