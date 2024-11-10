// For wrapper feature
document.addEventListener('DOMContentLoaded', function() {
    var clickableWidgets = document.querySelectorAll('.primekit-custom-elementor-widget-link[data-primekit-link-settings]');

    clickableWidgets.forEach(function(widget) {
        var linkSettings = JSON.parse(widget.getAttribute('data-primekit-link-settings'));

        if (linkSettings && linkSettings.url) {
            widget.style.cursor = 'pointer';

            widget.addEventListener('click', function(event) {
                event.preventDefault();
                event.stopPropagation();

                var target = linkSettings.is_external ? '_blank' : '_self';

                var anchor = document.createElement('a');
                anchor.href = linkSettings.url;
                anchor.target = target;
                if (linkSettings.nofollow) {
                    anchor.rel = 'nofollow';
                }

                document.body.appendChild(anchor); // Temporarily add to body to ensure click works
                anchor.click();
                document.body.removeChild(anchor); // Remove after click
            });
        }
    });
});