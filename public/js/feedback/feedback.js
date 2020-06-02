let all_feedback = document.querySelectorAll(".modal-body #userNavbar .nav-item button.all");
let positive_feedback = document.querySelectorAll(".modal-body #userNavbar .nav-item button.positive");
let negative_feedback = document.querySelectorAll(".modal-body #userNavbar .nav-item button.negative");

const addFeedbackEventListeners = () => {
    for(let i = 0; i < all_feedback.length; i++) {
        all_feedback[i].addEventListener("click", showAll.bind(all_feedback[i], all_feedback[i], positive_feedback[i], negative_feedback[i]));
        positive_feedback[i].addEventListener("click", showPositive.bind(all_feedback[i], all_feedback[i], positive_feedback[i], negative_feedback[i]));
        negative_feedback[i].addEventListener("click", showNegative.bind(all_feedback[i], all_feedback[i], positive_feedback[i], negative_feedback[i]));
    }
}

const showAll = (all_feedback, positive_feedback, negative_feedback) => {
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

const showPositive = (all_feedback, positive_feedback, negative_feedback) => {
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

const showNegative = (all_feedback, positive_feedback, negative_feedback) => {
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