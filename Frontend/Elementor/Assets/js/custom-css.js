(function($) {
    $(window).on('elementor:init', function() {
        elementor.channels.editor.on('change:setting:primekit_custom_css', function(view) {
            var elementId = view.model.id;
            var customCssSetting = view.model.get('settings').get('primekit_custom_css');
            applyCustomCSS(elementId, customCssSetting);
        });

        function applyCustomCSS(elementId, css) {
            var cssRule = '.elementor-element.elementor-element-' + elementId + ' { ' + css + ' }';
            $('#primekit-custom-css-' + elementId).remove();
            $('head').append('<style id="primekit-custom-css-' + elementId + '">' + cssRule + '</style>');
        }
    });

    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/global', function($scope) {
            var elementId = $scope.data('id');
            var settings = elementorFrontend.config.elements.data[elementId].settings;
            if (settings && settings.primekit_custom_css) {
                applyCustomCSS(elementId, settings.primekit_custom_css);
            }
        });
    });
})(jQuery);