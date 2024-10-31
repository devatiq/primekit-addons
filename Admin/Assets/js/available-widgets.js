document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.nav-tab');
    const contents = document.querySelectorAll('.tab-content');

    tabs.forEach(tab => {
        tab.addEventListener('click', function(event) {
            event.preventDefault();

            tabs.forEach(t => t.classList.remove('nav-tab-active'));
            tab.classList.add('nav-tab-active');

            const target = tab.getAttribute('href').substring(1);

            contents.forEach(content => {
                if (content.getAttribute('id') === target) {
                    content.style.display = 'block';
                } else {
                    content.style.display = 'none';
                }
            });
        });
    });
});

jQuery(document).ready(function($) {
    $('.primekit-switch input[type="checkbox"]').change(function() {
        var widgetName = $(this).attr('name'); // Ensure 'name' attribute is present in markup
        var value = $(this).is(':checked') ? '1' : '0';
        var thisCheckbox = $(this); // Reference to the current checkbox

        // Remove any existing 'Saved...' message next to this checkbox
        thisCheckbox.siblings('.primekit-save-message').remove();

        // Create the 'Saving...' message element
        var saveMessage = $('<span class="primekit-save-message">Saving...</span>');

        // Append the 'Saving...' message next to the checkbox
        saveMessage.insertAfter(thisCheckbox);

        // Perform the AJAX request
        $.post(primekitAjax.ajaxurl, {
            action: 'primekit_save_widget_setting',
            widgetName: widgetName,
            value: value,
            nonce: primekitAjax.nonce
        }, function(response) {
            // Change the message to 'Saved!' and fade it out after a few seconds
            saveMessage.text('Saved!').fadeOut(500, function() {
                $(this).remove(); // Remove the message after fading out
            });
        });
    });
});

