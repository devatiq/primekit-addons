/**
 * Initialize a Swiper instance for the given template slider.
 *
 * Retrieves the settings from the data-settings attribute of the container element,
 * parses the JSON string, and passes the settings to Swiper.
 *
 * @param {String} uniqueId - The unique ID of the template slider element.
 */
function PrimekitSliderInitialize(uniqueId) {
    'use strict';

    var slider = document.getElementById(uniqueId);

    // Retrieve the settings from the data-settings attribute
    var settings = slider.getAttribute('data-settings');
    var parsedSettings;

    // Parse the settings JSON string
    try {
        parsedSettings = JSON.parse(settings);
    } catch (e) {
        console.error('Error parsing Swiper settings:', e);
        return;
    }

console.log('arrow', parsedSettings.arrows);
    // Initialize Swiper using the parsed settings and custom class names
    new Swiper(slider.querySelector('.primekit-template-swiper-container'), {
        loop: parsedSettings.loop || false,
        autoplay: parsedSettings.autoplay || false,
        pagination: parsedSettings.pagination ? {
            el: slider.querySelector('.swiper-pagination'),
            clickable: true,
        } : false,
        navigation: parsedSettings.arrows ? {
            nextEl: slider.querySelector('.swiper-button-next'),
            prevEl: slider.querySelector('.swiper-button-prev'),
        } : false,

        // Custom class names for container, wrapper, and slides
        containerModifierClass: 'primekit-template-swiper-container-', // Prefix class for container
        wrapperClass: 'primekit-template-swiper-wrapper',              // Custom wrapper class
        slideClass: 'primekit-template-swiper-slide',                  // Custom slide class

        breakpoints: {
            1024: {
                slidesPerView: parseInt(parsedSettings.slidesPerView) || 3,
            },
            768: {
                slidesPerView: parseInt(parsedSettings.slidesPerViewTablet) || 2,
            },
            320: {
                slidesPerView: parseInt(parsedSettings.slidesPerViewMobile) || 1,
            }
        }
    });
}


jQuery(window).on('elementor/frontend/init', () => {
    elementorFrontend.hooks.addAction('frontend/element_ready/global', ($scope) => {
        var sliderElement = $scope.find('.primekit-addons-template-slider-wrapper');
        if (sliderElement.length > 0 && sliderElement.attr('id')) {
            var uniqueId = sliderElement.attr('id');  // Get the unique ID           
            PrimekitSliderInitialize(uniqueId);  // Initialize the Swiper with the unique ID
        }
    });
});