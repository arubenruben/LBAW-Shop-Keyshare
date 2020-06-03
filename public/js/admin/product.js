'use strict'

const inputCategory = document.querySelector('#gameCategories');
const inputPlatform = document.querySelector('#gamePlatforms');
const inputGenre = document.querySelector('#gameGenres');

const dropdownGenreArray = document.querySelectorAll('#dropdownGenre .dropdown-item');
const dropdownPlatformArray = document.querySelectorAll('#dropdownPlatform .dropdown-item');
const dropdownCategoryArray = document.querySelectorAll('#dropdownCategory .dropdown-item');
const imgUploadInput = document.querySelector('#img-upload');

imgUploadInput.addEventListener('change', pictureUpdate);

dropdownGenreArray.forEach(element => {
    element.addEventListener('click', genreChange);
});

dropdownPlatformArray.forEach(element => {
    element.addEventListener('click', platformChange);
});

dropdownCategoryArray.forEach(element => {
    element.addEventListener('click', categoryChange);
});

function categoryChange() {
    inputCategory.value = event.target.textContent;

}

function platformChange() {
    if (inputPlatform.value == "")
        inputPlatform.value += event.target.textContent;
    else {
        inputPlatform.value += ",";
        inputPlatform.value += event.target.textContent;
    }
}

function genreChange() {

    if (inputGenre.value == "")
        inputGenre.value += event.target.textContent;
    else {
        inputGenre.value += ",";
        inputGenre.value += event.target.textContent;
    }
}

function pictureUpdate() {
    const fileBlob = document.querySelector('#img-upload').files[0];

    const fileReader = new FileReader();

    fileReader.onload = function () {
        const imgPreview = document.querySelector('#product-img');
        imgPreview.setAttribute('src', fileReader.result);
    }
    fileReader.readAsDataURL(fileBlob);
}