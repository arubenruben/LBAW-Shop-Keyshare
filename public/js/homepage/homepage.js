'use strict'

const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const url = '/';

let most_popular_offset = 0;
let most_popular = document.querySelectorAll(".most-popular .cardHomepage")
let most_recent_offset = 0;
let most_recent = document.querySelectorAll(".most-recent .cardHomepage")

for(let i = 0; i < most_popular.length && i < most_recent.length; i++) {
    if(i < 5) {
        most_popular[i].style.display  = 'block';
        most_recent[i].style.display  = 'block';
    } else {
        most_popular[i].style.display = 'none';
        most_recent[i].style.display  = 'none';
    }
}

const addEventListeners = () => {
    let right_most_popular = document.querySelector("#right-most-popular");
    let left_most_popular = document.querySelector("#left-most-popular");
    let right_most_recent = document.querySelector("#right-most-recent");
    let left_most_recent = document.querySelector("#left-most-recent");

    right_most_popular.addEventListener("click", rightMostPopular);
    left_most_popular.addEventListener("click", leftMostPopular);
    right_most_recent.addEventListener("click", rightMostRecent);
    left_most_recent.addEventListener("click", leftMostRecent);
}

const rightMostPopular = () => {
    let count_visible = document.querySelectorAll(".most-popular .cardHomepage:not([style='display: none;'])").length;
    if(count_visible === 5 && most_popular_offset + 5 < most_popular.length) {
        most_popular[most_popular_offset].style.display = 'none';
        most_popular_offset += 1;
        most_popular[4 + most_popular_offset].style.display = 'block';
    }
}

const leftMostPopular = () => {
    let count_visible = document.querySelectorAll(".most-popular .cardHomepage:not([style='display: none;'])").length;
    if(count_visible === 5 && most_popular_offset > 0) {
        most_popular[4 + most_popular_offset].style.display = 'none';
        most_popular_offset -= 1;
        most_popular[most_popular_offset].style.display = 'block';
    }
}

const rightMostRecent = () => {
    let count_visible = document.querySelectorAll(".most-recent .cardHomepage:not([style='display: none;'])").length;
    if(count_visible === 5 && most_recent_offset + 5 < most_recent.length) {
        most_recent[most_recent_offset].style.display = 'none';
        most_recent_offset += 1;
        most_recent[4 + most_recent_offset].style.display = 'block';
    }
}

const leftMostRecent = () => {
    let count_visible = document.querySelectorAll(".most-recent .cardHomepage:not([style='display: none;'])").length;
    if(count_visible === 5 && most_recent_offset > 0) {
        most_recent[4 + most_recent_offset].style.display = 'none';
        most_recent_offset -= 1;
        most_recent[most_recent_offset].style.display = 'block';
    }
}

addEventListeners();
