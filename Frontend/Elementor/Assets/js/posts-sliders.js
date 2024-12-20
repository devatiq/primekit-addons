/**
 * Initialize a Swiper instance for the posts slider.
 *
 * Retrieves the settings from the data-settings attribute of the container element,
 * parses the JSON string, and passes the settings to Swiper.
 *
 * @param {String} uniqueId - The unique ID of the posts slider element.
 */
function PrimekitPostsSliderInitialize(uniqueId) {
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

    // Initialize Swiper using the parsed settings and custom class names
    new Swiper(slider.querySelector('.primekit-posts-slider-container'), {
        loop: parsedSettings.loop || false,
        autoplay: parsedSettings.autoplay || false,
        pagination: {
            el: slider.querySelector('.swiper-pagination'),
            clickable: true,
        },
        navigation: {
            nextEl: slider.querySelector('.swiper-button-next'),
            prevEl: slider.querySelector('.swiper-button-prev'),
        },

        // Custom class names for container, wrapper, and slides
        containerModifierClass: 'primekit-posts-slider-container-', // Prefix class for container
        wrapperClass: 'primekit-posts-slider-wrapper',              // Custom wrapper class
        slideClass: 'primekit-posts-slider-single-item',             // Custom slide class

        breakpoints: {
            1024: {
                slidesPerView: parseInt(parsedSettings.slidesPerView) || 3,
            },
            768: {
                slidesPerView: parseInt(parsedSettings.slidesPerViewTablet) || 2,
            },
            480: {
                slidesPerView: parseInt(parsedSettings.slidesPerViewMobile) || 1,
            }
        }
    });
}

// Activate the posts slider on Elementor frontend
jQuery(window).on('elementor/frontend/init', () => {
    elementorFrontend.hooks.addAction('frontend/element_ready/global', ($scope) => {
        var sliderElement = $scope.find('.primekit-posts-slider-area');
        if (sliderElement.length > 0 && sliderElement.attr('id')) {
            var uniqueId = sliderElement.attr('id');  // Get the unique ID           
            PrimekitPostsSliderInitialize(uniqueId);  // Initialize the Swiper with the unique ID
        }
    });
});
