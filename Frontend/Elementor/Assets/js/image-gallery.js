jQuery(document).ready(function($) {
    'use strict';
    $('.primekit-photos-gallery').each(function() {
        var configData = $(this).data('primekit-config');

        // Parse JSON data if needed
        if (typeof configData === 'string') {
            configData = JSON.parse(configData);
        }

        $(this).magnificPopup({
            delegate: '.primekit-photos-gallery-item',
            type: 'image',
            closeOnContentClick: configData.close_on_content_click,
            showCloseBtn: configData.show_close_btn,
            mainClass: 'mfp-with-zoom mfp-img-mobile primekit-photos-gallery-popup',
            allowHTMLInTemplate: true,
            image: {
                verticalFit: true,
                titleSrc: function(item) {
                    return item.el.attr('title');
                }
            },
            callbacks: {
                elementParse: function(item) {
                    item.src = item.el.attr('primekit-data-url');
                }
            },
            gallery: {
                enabled: configData.gallery_enabled,
                preload: configData.preload,
                arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%">' +
                    '<svg height="512" viewBox="0 0 32 32" width="512" xmlns="http://www.w3.org/2000/svg">' +
                    '<g id="_16_next" data-name="16 next">' +
                    '<path d="m16 2a14 14 0 1 0 14 14 14 14 0 0 0 -14-14zm0 26a12 12 0 1 1 12-12 12 12 0 0 1 -12 12zm-2.5-18.41 6.41 6.41-6.41 6.41-1.41-1.41 5-5-5-5z"></path>' +
                    '</g></svg>' +
                    '</button>',
                tPrev: 'Previous',
                tNext: 'Next',
            },
            zoom: {
                enabled: configData.zoom_enabled,
                duration: configData.zoom_duration,
                opener: function(element) {
                    return element.find('img');
                }
            },
        });
    });
});
