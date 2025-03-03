/**
 * Initialize a Swiper instance for the posts slider with a smooth loading effect.
 *
 * @param {String} uniqueId - The unique ID of the posts slider element.
 */
function PrimekitPostsSliderInitialize(uniqueId) {
    'use strict';

    var slider = document.getElementById(uniqueId);
    if (!slider) return;

    // Hide the slider initially to prevent flickering
    slider.style.opacity = "0";

    // Retrieve settings from the data-settings attribute
    var settings = slider.getAttribute('data-settings');
    var parsedSettings;

    // Parse JSON settings
    try {
        parsedSettings = JSON.parse(settings);
    } catch (e) {
        console.error('Error parsing Swiper settings:', e);
        return;
    }

    // Wait for images to load before initializing Swiper
    let imagesLoaded = 0;
    const totalImages = slider.querySelectorAll('img').length;

    function checkAllImagesLoaded() {
        imagesLoaded++;
        if (imagesLoaded >= totalImages) {
            // Initialize Swiper once all images are loaded
            new Swiper(slider.querySelector('.primekit-posts-slider-container'), {
                loop: parsedSettings.loop || false,
                autoplay: parsedSettings.autoplay || false,
                autoHeight: true,
                pagination: {
                    el: slider.querySelector('.swiper-pagination'),
                    clickable: true,
                },
                navigation: {
                    nextEl: slider.querySelector('.swiper-button-next'),
                    prevEl: slider.querySelector('.swiper-button-prev'),
                },
                containerModifierClass: 'primekit-posts-slider-container-',
                wrapperClass: 'primekit-posts-slider-wrapper',
                slideClass: 'primekit-posts-slider-single-item',
                breakpoints: {
                    1024: { slidesPerView: parseInt(parsedSettings.slidesPerView) || 3 },
                    768: { slidesPerView: parseInt(parsedSettings.slidesPerViewTablet) || 2 },
                    480: { slidesPerView: parseInt(parsedSettings.slidesPerViewMobile) || 1 }
                }
            });

            // Fade in slider after initialization
            setTimeout(() => {
                slider.style.opacity = "1";
                slider.style.transition = "opacity 0.3s ease-in-out";
            }, 100);
        }
    }

    // If no images exist, initialize immediately
    if (totalImages === 0) {
        checkAllImagesLoaded();
    } else {
        slider.querySelectorAll('img').forEach(img => {
            if (img.complete) {
                checkAllImagesLoaded();
            } else {
                img.addEventListener('load', checkAllImagesLoaded);
                img.addEventListener('error', checkAllImagesLoaded); // Handle missing images
            }
        });
    }
}

// Activate the posts slider on Elementor frontend
jQuery(window).on('elementor/frontend/init', () => {
    elementorFrontend.hooks.addAction('frontend/element_ready/global', ($scope) => {
        var sliderElement = $scope.find('.primekit-posts-slider-area');
        if (sliderElement.length > 0 && sliderElement.attr('id')) {
            var uniqueId = sliderElement.attr('id');
            PrimekitPostsSliderInitialize(uniqueId);
        }
    });
});
