$(document).ready(function () {
    var d = new Date();
    var day = ("0" + d.getDate()).slice(-2);
    var mon = ("0" + (d.getMonth() + 1)).slice(-2);
    var year = d.getFullYear();
    var date = day + "/" + mon + "/" + year;
    console.log(date);

    $('.links__edit__delete #delete_confirm').click(function () {    // Animation de la "div" de Recherche Avancée
        $('.modal__conrfim__delete').toggle();
    });

    $('.modal__conrfim__delete #cancel_delete').click(function () {    // Animation de la "div" de Recherche Avancée
        $('.modal__conrfim__delete').toggle();
    });
})