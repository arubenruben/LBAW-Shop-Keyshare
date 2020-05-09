const addFeedbackEventListeners = () => {
    let all_feedback = document.querySelector(".modal-body #userNavbar .nav-item button.btn-blue-full");
    let positive_feedback = document.querySelector(".modal-body #userNavbar .nav-item button.btn-green");
    let negative_feedback = document.querySelector(".modal-body #userNavbar .nav-item button.btn-red");

    all_feedback.addEventListener("click", showAll);
    positive_feedback.addEventListener("click", showPositive);
    negative_feedback.addEventListener("click", showNegative);
}

const showAll = () => {
    let content = document.querySelectorAll("table tbody tr")
    for(let i=0; i<content.length; i++) {
        let element = content[i];
        element.style.visibility = "visible";
    }
}

const showPositive = () => {
    let content = document.querySelectorAll("table tbody tr")
    for(let i=0; i<content.length; i++) {
        let element = content[i];
        if(element.querySelector("i.cl-success") !== null)
            element.style.visibility = "visible";
        else
            element.style.visibility = "hidden";
    }
}

const showNegative = () => {
    let content = document.querySelectorAll("table tbody tr")
    for(let i=0; i<content.length; i++) {
        let element = content[i];
        if(element.querySelector("i.cl-fail") !== null)
            element.style.visibility = "visible";
        else
            element.style.visibility = "hidden";
    }
}

addFeedbackEventListeners();