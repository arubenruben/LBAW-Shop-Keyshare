'use strict'

const addEventListeners = () => {
    const buttons = document.querySelectorAll('#all-faq-table button');
    const confirm = document.querySelector('#faqUpdateModal form');
    const questionInput = document.querySelector('#faqUpdateModal form input[name="question"]');
    const answerInput = document.querySelector('#faqUpdateModal form textarea[name="answer"]');

    const faqs = document.querySelectorAll('table#all-faq-table tbody tr');

    const faqInputs = [];
    for (let i = 0; i < faqs.length; i++) {
        faqInputs.push(faqs[i].querySelectorAll('h6'));
    }

    function updateModal(inputs) {
        let id = this.getAttribute('data-faq');
        questionInput.value = inputs[0].innerText;
        answerInput.value = inputs[1].innerText;
        confirm.setAttribute('action', confirm.getAttribute('data-default') + id);
    }

    for (let i = 0; i < buttons.length; i++) {
        buttons[i].addEventListener('click', updateModal.bind(buttons[i], faqInputs[i]));
    }
}

addEventListeners();