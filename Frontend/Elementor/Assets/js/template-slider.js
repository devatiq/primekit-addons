/**
 * Initialize Swiper for Primekit Template Slider.
 *
 * @param {String} uniqueId - The unique ID of the slider.
 */
function PrimekitSliderInitialize(uniqueId) {
    'use strict';

    var slider = document.getElementById(uniqueId);
    if (!slider) return;

    // Retrieve the settings from the data-settings attribute
    var settings = slider.getAttribute('data-settings');
    var parsedSettings;

    try {
        parsedSettings = JSON.parse(settings);
    } catch (e) {
        console.error('Error parsing Swiper settings:', e);
        return;
    }

    function initializeSwiper() {
        var swiperContainer = slider.querySelector('.primekit-template-swiper-container');

        // Ensure Swiper container exists before initializing
        if (!swiperContainer) {
            console.error("Swiper container not found for:", uniqueId);
            return;
        }

        // Initialize Swiper
        new Swiper(swiperContainer, {
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
            breakpoints: {
                1024: { slidesPerView: parseInt(parsedSettings.slidesPerView) || 3 },
                768: { slidesPerView: parseInt(parsedSettings.slidesPerViewTablet) || 2 },
                320: { slidesPerView: parseInt(parsedSettings.slidesPerViewMobile) || 1 }
            }
        });

        // Reveal the slider after Swiper is initialized
        setTimeout(() => {
            slider.style.opacity = "1";
            slider.style.transition = "opacity 0.3s ease-in-out";
        }, 100);
    }

    // Check if template content exists, then initialize Swiper
    function waitForTemplateContent(attempts = 0) {
        var swiperWrapper = slider.querySelector('.primekit-template-swiper-wrapper');

        if (swiperWrapper && swiperWrapper.children.length > 0) {
            initializeSwiper();
        } else if (attempts < 20) {
            // Retry checking every 200ms (max 20 attempts = 4 seconds)
            setTimeout(() => {
                waitForTemplateContent(attempts + 1);
            }, 200);
        } else {
            console.warn("Swiper initialization timed out for:", uniqueId);
            initializeSwiper(); // Force initialize if content is still missing
        }
    }

    // Start checking for template readiness
    waitForTemplateContent();
}

// Elementor Hook for Primekit Template Slider
jQuery(window).on('elementor/frontend/init', () => {
    elementorFrontend.hooks.addAction('frontend/element_ready/global', ($scope) => {
        var sliderElement = $scope.find('.primekit-addons-template-slider-wrapper');
        if (sliderElement.length > 0 && sliderElement.attr('id')) {
            var uniqueId = sliderElement.attr('id');

            // Ensure Swiper only initializes if content is ready
            setTimeout(() => {
                PrimekitSliderInitialize(uniqueId);
            }, 500);
        }
    });
});
