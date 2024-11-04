// Function to handle the range value and price calculations
function primekitGetRangeValue(uniqueId) {
    // Get the pricing data from the attribute and parse it
    let pricingData = JSON.parse(document.querySelector(`.primekit-pricing-calculator[data-unique-id='${uniqueId}']`).getAttribute('data-pricing'));

    // Get range slider value
    let primekitPricingRangeSlider = document.getElementById(`primekitPricingRangeSlider_${uniqueId}`);
    if (!primekitPricingRangeSlider) return; // Prevent errors in editor mode
    let primekitGetRangeSliderValue = primekitPricingRangeSlider.value;

    // Get selected package
    let selectedPackage = '';
    const packageRadios = document.querySelectorAll(`.primekit_cost_calculator_package_${uniqueId}`);
    for (let i = 0; i < packageRadios.length; i++) {
        if (packageRadios[i].checked) {
            selectedPackage = packageRadios[i].value;
            break;
        }
    }

    // Set the selected pages number
    let primekitNumberOfPagesSelected = document.getElementById(`primekit-pricing-range-selected-page_${uniqueId}`);
    if (primekitNumberOfPagesSelected) {
        primekitNumberOfPagesSelected.innerText = primekitGetRangeSliderValue;
    }

    // Get the total price based on selected step and package
    let primekitTotalPrice = document.getElementById(`primekitTotalPrice_${uniqueId}`);
    if (pricingData[primekitGetRangeSliderValue] && pricingData[primekitGetRangeSliderValue][selectedPackage]) {
        let totalPrice = pricingData[primekitGetRangeSliderValue][selectedPackage];
        if (primekitTotalPrice) {
            primekitTotalPrice.innerText = totalPrice;
        }
    }
}

// Function to initialize the event listeners
function initializeprimekitCostEstimation(uniqueId) {
    const pricingRangeSlider = document.getElementById(`primekitPricingRangeSlider_${uniqueId}`);
    const packageRadios = document.querySelectorAll(`.primekit_cost_calculator_package_${uniqueId}`);

    if (pricingRangeSlider) {
        pricingRangeSlider.addEventListener('input', () => primekitGetRangeValue(uniqueId));
    }

    if (packageRadios.length > 0) {
        packageRadios.forEach(radio => {
            radio.addEventListener('change', () => primekitGetRangeValue(uniqueId));
        });
    }

    // Initialize the calculations on page load
    primekitGetRangeValue(uniqueId);
}


// Ensure the script runs in both Elementor's frontend and editor modes
jQuery(window).on('elementor/frontend/init', () => {
    elementorFrontend.hooks.addAction('frontend/element_ready/global', ($scope) => {
        // First script: Initialize cost estimation logic
        $scope.find('.primekit-pricing-calculator').each(function () {
            let uniqueId = jQuery(this).data('unique-id');
            initializeprimekitCostEstimation(uniqueId);
        });

        // Second script: Initialize range slider logic
        $scope.find('.primekit-range-slider').each(function() {
            const slider = this;
            const uniqueId = slider.id.split('_').pop(); // Extract the unique id
            const selectedPageElement = document.getElementById(`primekit-pricing-range-selected-page_${uniqueId}`);

            // Function to set the slider background and selected page text based on its value
            function primekit_cost_range_update_slider(slider) {
                const value = (slider.value - slider.min) / (slider.max - slider.min) * 100;
                const activeColor = slider.getAttribute('data-active-color') || '#0f4fff';  // Default blue active color
                const inactiveColor = slider.getAttribute('data-inactive-color') || '#300bff';  // Default purple inactive color

                // Update slider background using the active and inactive colors
                slider.style.background = `linear-gradient(to right, ${activeColor} ${value}%, ${inactiveColor} ${value}%)`;

                // Update the selected page text
                selectedPageElement.textContent = slider.value;
            }

            // Initialize the slider background and selected page text on page load
            primekit_cost_range_update_slider(slider);

            // Update the slider background and selected page text when the value changes
            jQuery(slider).on('input', function() {
                primekit_cost_range_update_slider(slider);
            });
        });
    });
});
