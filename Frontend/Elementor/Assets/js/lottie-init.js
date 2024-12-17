(function ($) {
    const primekitInitLottieAnimations = function ($scope) {
        const $elements = $scope.find('.primekit-lottie-wrapper');

        if (!$elements.length) {
            return;
        }

        $elements.each(function () {
            const $container = $(this);

            // Prevent duplicate initialization
            if ($container.data('lottie-initialized')) {
                return;
            }

            // Mark as initialized
            $container.data('lottie-initialized', true);

            // Fetch data attributes
            const path = $container.attr('data-lottie-json');
            const autoplay = $container.attr('data-autoplay') === 'true';
            const loop = $container.attr('data-loop') === 'true';
            const loopCount = parseInt($container.attr('data-loop-count')) || 0;
            const reverse = parseInt($container.attr('data-reverse')) || 1;
            const renderer = $container.attr('data-renderer') || 'svg';
            const hoverAction = $container.attr('data-hover-action') || '';
            const speed = parseFloat($container.attr('data-speed')) || 1;

            if (path) {
                // Initialize animation
                const animation = lottie.loadAnimation({
                    container: this, // Pass the DOM element
                    renderer: renderer,
                    loop: loopCount > 0 ? loopCount - 1 : loop,
                    autoplay: autoplay,
                    path: path,
                    rendererSettings: {
                        preserveAspectRatio: 'xMidYMid meet',
                    },
                });

                // Set animation speed and direction
                animation.setSpeed(speed);
                animation.setDirection(reverse);

                // Handle hover actions
                if (hoverAction) {
                    let isPaused = !autoplay;

                    $container.on('mouseenter', function () {
                        if (hoverAction === 'play') animation.play();
                        if (hoverAction === 'pause') {
                            isPaused = animation.isPaused; // Save the paused state
                            animation.pause();
                        }
                        if (hoverAction === 'reverse') animation.setDirection(-1);
                    });

                    $container.on('mouseleave', function () {
                        if (hoverAction === 'play' && !isPaused) {
                            animation.play(); // Resume playing if it was not paused
                        }
                        if (hoverAction === 'pause' && !isPaused) {
                            animation.play(); // Resume playing if it was paused by hover
                        }
                        if (hoverAction === 'reverse') animation.setDirection(1); // Reset to normal direction
                    });
                }
            }
        });
    };

    // Elementor Frontend Hook
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction(
            'frontend/element_ready/primekit-lottie.default',
            primekitInitLottieAnimations
        );
    });
})(jQuery);