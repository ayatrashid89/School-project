(function () {

    let closeBtns = document.getElementsByClassName('close');
    let body = document.querySelector('body');

    for (i = 0; i < closeBtns.length; i++) {
        closeBtns[i].addEventListener('click', handleClose);
    }

    function handleClose() {
        this.parentElement.style.display = 'none';

        body.style.overflow = "auto";
    }

})();

function toggle_visibility(id) {

    let e = document.getElementById(id);
    let body = document.querySelector('body');

    e.style.display = 'flex';
    body.style.overflow = "hidden";
}