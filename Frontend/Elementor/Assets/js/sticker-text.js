jQuery(document).ready(function($) {
    $('.primekit-sticker-close-icon').click(function() {
        $(this).parent('.primekit-elementor-sticker-text-area').fadeOut(500);
    });
});