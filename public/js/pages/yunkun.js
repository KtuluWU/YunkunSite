$(document).ready(function () {
    var d = new Date();
    var day = ("0" + d.getDate()).slice(-2);
    var mon = ("0" + (d.getMonth() + 1)).slice(-2);
    var year = d.getFullYear();
    var date = day + "/" + mon + "/" + year;
    console.log(date);

    $('.pr__blog__details .links__edit__delete #delete_confirm').click(function () {
        $('.modal__conrfim__delete').toggle();
    });

    $('.user_page #delete_confirm').click(function () {
        $('.modal__conrfim__delete').toggle();
    });

    $('.modal__conrfim__delete #cancel_delete').click(function () {
        $('.modal__conrfim__delete').toggle();
    });
})