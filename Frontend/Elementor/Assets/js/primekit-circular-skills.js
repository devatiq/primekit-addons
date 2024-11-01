(function($) {
    'use strict';

    // Function to check if element is in viewport
    function isElementInViewport(el) {
        const rect = el.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }

    // Function to initialize a specific skill circle with JSON configuration
    function PrimeKitinitSkillCircle(circle) {
        const $circle = $(circle);

        // Avoid re-initialization
        if ($circle.data('inited')) {
            return;
        }

        // Parse the JSON configuration
        const config = JSON.parse($circle.attr('data-circle-config'));

        // Initialize circleProgress with values from JSON
        $circle.circleProgress({
            value: config.skillValue,
            size: config.skillSize,
            fill: {
                gradient: [config.skillColorOne, config.skillColorTwo]
            },
            emptyFill: config.skillEmptyColor
        }).on('circle-animation-progress', function(event, progress) {
            $(this).find('strong').html(parseInt(config.skillValue * 100 * progress) + '<i>%</i>');
        });

        $circle.data('inited', true);
    }

    // Initialize skill circles with appear functionality
    function PrimeKitinitializeSkillCircles() {
        $('.primekit-ele-skill-circle').each(function() {
            const $circle = $(this);

            // Check if the element is already in the viewport
            if (isElementInViewport($circle[0])) {
                PrimeKitinitSkillCircle($circle);
            } else {
                // Apply appear to each skill circle with specific options
                $circle.appear({ force_process: true });

                // Trigger initialization when the element appears in the viewport
                $circle.on('appear', function() {
                    PrimeKitinitSkillCircle($circle);
                });

                // Optional: Handle the "disappear" event if needed
                $circle.on('disappear', function() {

                });
            }
        });
    }

    $(function() {
        PrimeKitinitializeSkillCircles();
    });

    // Re-initialize in Elementor's editor mode
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/global', function() {
            PrimeKitinitializeSkillCircles();
        });
    });
})(jQuery);