const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const url = '/user/purchases';

let submit_feedback = document.querySelector("div.submit-feedback button.submit");
let positive_feedback = document.querySelector("button.positive-feedback");
let negative_feedback = document.querySelector("button.negative-feedback");

const addFeedbackEventListeners = () => {
    submit_feedback.addEventListener("click", submitFeedback);
    positive_feedback.addEventListener("click", positiveFeedback);
    negative_feedback.addEventListener("click", negativeFeedback);
}

const submitFeedback = () => {
    let description = document.querySelector("textarea#description").value;

    let feedback;
    if(positive_feedback.classList.contains('btn-green') && negative_feedback.classList.contains('btn-red-full'))
        feedback = false;
    else if(positive_feedback.classList.contains('btn-green-full') && negative_feedback.classList.contains('btn-red'))
        feedback = true;
    else
        return;

    let data = {
        key_id: document.querySelector('div.key input.key-name').value,
        description: description,
        feedback: feedback
    }
    sendPut(data).then(r => {
        console.log(r)
    })
}

const positiveFeedback = () => {
    if(negative_feedback.classList.contains('btn-red-full')) {
        negative_feedback.classList.remove('btn-red-full')
        negative_feedback.classList.add('btn-red')
        negative_feedback.querySelector('i.negative-feedback-i').classList.replace('cl-white', 'cl-fail')
    }

    if(positive_feedback.classList.contains('btn-green')) {
        positive_feedback.classList.remove('btn-green')
        positive_feedback.classList.add('btn-green-full')
        positive_feedback.querySelector('i.positive-feedback-i').classList.replace('cl-success', 'cl-white')
    }
}

const negativeFeedback = () => {
    if(!negative_feedback.classList.contains('btn-red-full')) {
        negative_feedback.classList.add('btn-red-full')
        negative_feedback.classList.remove('btn-red')
        negative_feedback.querySelector('i.negative-feedback-i').classList.replace('cl-fail', 'cl-white')
    }

    if(!positive_feedback.classList.contains('btn-green')) {
        positive_feedback.classList.add('btn-green')
        positive_feedback.classList.remove('btn-green-full')
        positive_feedback.querySelector('i.positive-feedback-i').classList.replace('cl-white', 'cl-success')
    }
}

const sendPut = put => {
    let key_id = document.querySelector('div.key input.key-name').value
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

    return fetch('/key/' + key_id + '/feedback/', options)
        .catch(error => console.error("Error:" + error));
}

addFeedbackEventListeners();