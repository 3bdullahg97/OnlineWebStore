import Zooming from "zooming";

document.addEventListener('DOMContentLoaded', function () {
    new Zooming({
        zIndex: 1000,
        width: 1000,
        height: 1000,
    }).listen('.main-image');
});
