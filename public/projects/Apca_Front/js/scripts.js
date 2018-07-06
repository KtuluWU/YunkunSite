console.log("Bienvenue chez APCA!");

$(document).ready(function () {
    var d = new Date();
    var day = ("0" + d.getDate()).slice(-2);
    var mon = ("0" + (d.getMonth() + 1)).slice(-2);
    var year = d.getFullYear();
    var date = day + "/" + mon + "/" + year;
    console.log(date);

    $('#recapitulatif_date, #commandes_error_date, #research_no_date, #justif_date, #commandes_informations_date').append(date);    // Le temps local pour certaines pages

    $('.search-advanced-topbar').click(function () {    // Animation de la "div" de Recherche Avancée
        $('.search-advanced-block').toggle();
    });
    $('#sa_close').click(function () {        // Animation de le croix pour fermer la "div" de Recherche Avancée
        $('.search-advanced-block').fadeOut();
    });
    $('#qsn').click(function () {       // Deux images de la page Home (Qui sommes nous et Comment ça marche)
        $('.qsnp').toggleClass('open');
    })
    $('#ccm').click(function () {
        $('.ccmp').toggleClass('open');
    })
    $('#search_return_icon, .search-return-tip').hover(function () {    // Animation de l'aide de Résultats de Recherche
        $('.search-return-tip').toggleClass('search-return-open-tip');
    })
    $("td[id^='panier_icon_del_']").each(function () {       // Aniamtion d'enlever un article dans le Panier
        $(this).on("click", function () {
            $('.panier-del-confirm').css('display', "block");
        })
    });
    $('.panier-del-confirm-non').click(function () {        // Animation de la suppression du Panier
        $('.panier-del-confirm').css('display', "none");
    })

    /************************************** Exemple à enlever **************************************/
    $(".search-return-pages-line span[id^='page_']").each(function () {
        $(this).click(function () {
            $('.search-return-pages-line *').removeClass('active');
            $(this).addClass('active');
        })
    })

    $(".search-return-pages-marks span[id^='page_']").each(function () {
        $(this).click(function () {
            $('.search-return-pages-marks *').removeClass('active');
            $(this).addClass('active');
        })
    })


    /************************************** Animation mise au panier **************************************/
    var cartCount = $('.count-panier');

    $("img[id^='cd-add-to-cart-']").each(function () {
        $(this).on("click", function () {
            cartCount.css('opacity', '1');
            updateCartCount();
        })
    });
    $("i[id^='cd-del-to-cart-']").each(function () {
        $(this).on("click", function () {
            updateCartCount(-1);
        })
    });

    function updateCartCount(remove) {
        if (typeof remove === 'undefined') {
            var actual = Number(cartCount.find('li').eq(0).text()) + 1;
            var next = actual + 1;
        } else {
            if (Number(cartCount.find('li').eq(0).text()) > 1) {
                var actual = Number(cartCount.find('li').eq(0).text()) + remove;
                var next = actual + 1;
            } else if (Number(cartCount.find('li').eq(0).text()) == 1) {
                cartCount.css('opacity', '0');
                var actual = Number(cartCount.find('li').eq(0).text()) + remove;
                var next = actual + 1;
            } else return false;
        }

        cartCount.addClass('update-count');
        setTimeout(function () {
            cartCount.find('li').eq(0).text(actual);
        }, 150);

        setTimeout(function () {
            cartCount.removeClass('update-count');
        }, 200);

        setTimeout(function () {
            cartCount.find('li').eq(1).text(next);
        }, 230);

        cartCount.find('li').eq(0).text(actual);
        cartCount.find('li').eq(1).text(next);
    }
    /*********************************************************************************************************/

})