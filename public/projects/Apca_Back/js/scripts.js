console.log("Bienvenue chez APCA!");

$(document).ready(function () {
    $('#consultation_res_icon').hover(function () {    // Animation de l'aide de Résultats de Recherche
        $('.consultation-res-tip').toggleClass('consultation-res-open-tip');
    })



    /************************************** Exemple à enlever **************************************/
    $(".consultation-res-line span[id^='page_']").each(function () {
        $(this).click(function () {
            $('.consultation-res-line *').removeClass('active');
            $(this).addClass('active');
        })
    })

    $(".consultation-res-marks span[id^='page_']").each(function () {
        $(this).click(function () {
            $('.consultation-res-marks *').removeClass('active');
            $(this).addClass('active');
        })
    })
    /***********************************************************************************************/

})