require('lightgallery/src/js/lightgallery');
$(document).ready(function () {
    // Открытие полного текста элемента портфолио
    $(".portfolio__full-text-toggler").click(function () {
        $(this).parents('.portfolio').find(".portfolio__full-text").toggleClass("portfolio__full-text_show");
    });
    // Включение галереи для портфолио
    $('.portfolio__links-container').lightGallery({
        selector: '.gallery-image',
    });
});


