// let popovers = document.querySelectorAll("[data-toggle='popover']");
// popovers.forEach(popover => {
//     popover.popover();
// });
$(function () {
    $('[data-toggle="popover"]').popover({
        trigger: 'focus',
        html: true
    })
})
    