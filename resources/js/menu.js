$(document).ready(function () {
    var overlayFlag = 1;
    $("#header .navbar-toggler").click(function () {
        toggleOverlay();
    });
    $(".overlay").click(function () {
        toggleOverlay();
    });

    function toggleOverlay() {
        if (overlayFlag) {
            $(".menu").toggleClass('menu-active');
            overlayFlag = 0;
            if ($(".menu").hasClass('menu-active')) {
                $(".overlay").css({'display': 'block'}).animate({
                    'opacity': 1
                }, 300, function () {
                    overlayFlag = 1;
                })
            } else {
                $(".overlay").animate({
                    'opacity': 0
                }, 300, function () {
                    $(".overlay").css({'display': 'none'});
                    overlayFlag = 1;
                })
            }
        }
    }
});
