let all_feedback = document.querySelector(".modal-body #userNavbar .nav-item button.all");
let positive_feedback = document.querySelector(".modal-body #userNavbar .nav-item button.positive");
let negative_feedback = document.querySelector(".modal-body #userNavbar .nav-item button.negative");

const addFeedbackEventListeners = () => {
    all_feedback.addEventListener("click", showAll);
    positive_feedback.addEventListener("click", showPositive);
    negative_feedback.addEventListener("click", showNegative);
}

const showAll = () => {
    if(!all_feedback.classList.contains('btn-blue-full')) {
        all_feedback.classList.remove('btn-blue')
        all_feedback.classList.add('btn-blue-full')
    }
    if(positive_feedback.classList.contains('btn-green-full')) {
        positive_feedback.classList.remove('btn-green-full')
        positive_feedback.classList.add('btn-green')
    }
    if(negative_feedback.classList.contains('btn-red-full')) {
        negative_feedback.classList.remove('btn-red-full')
        negative_feedback.classList.add('btn-red')
    }

    let content = document.querySelectorAll("table tbody tr.feedback")
    for(let i=0; i<content.length; i++) {
        let element = content[i];
        element.style.visibility = "visible";
    }
}

const showPositive = () => {
    positive_feedback.classList.add('btn-green-full')
    if(!positive_feedback.classList.contains('btn-green-full')) {
        positive_feedback.classList.remove('btn-green')
        positive_feedback.classList.add('btn-green-full')
    }
    if(all_feedback.classList.contains('btn-blue-full')) {
        all_feedback.classList.remove('btn-blue-full')
        all_feedback.classList.add('btn-blue')
    }
    if(negative_feedback.classList.contains('btn-red-full')) {
        negative_feedback.classList.remove('btn-red-full')
        negative_feedback.classList.add('btn-red')
    }

    let content = document.querySelectorAll("table tbody tr.feedback");

    for(let i=0; i<content.length; i++) {
        let element = content[i];
        if(element.querySelector("td.eval i.cl-success") !== null)
            element.style.visibility = "visible";
        else
            element.style.visibility = "hidden";
    }
}

const showNegative = () => {
    if(!negative_feedback.classList.contains('btn-red-full')) {
        negative_feedback.classList.remove('btn-red')
        negative_feedback.classList.add('btn-red-full')
    }
    if(all_feedback.classList.contains('btn-blue-full')) {
        all_feedback.classList.remove('btn-blue-full')
        all_feedback.classList.add('btn-blue')
    }
    if(positive_feedback.classList.contains('btn-green-full')) {
        positive_feedback.classList.remove('btn-green-full')
        positive_feedback.classList.add('btn-green')
    }

    let content = document.querySelectorAll("table tbody tr.feedback");
    for(let i=0; i<content.length; i++) {
        let element = content[i];
        if(element.querySelector("td.eval i.cl-fail") !== null)
            element.style.visibility = "visible";
        else
            element.style.visibility = "hidden";
    }
}

addFeedbackEventListeners();