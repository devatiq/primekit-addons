jQuery(document).ready(function($) {
    'use strict';
    // Enable the submit button when all fields are filled out
    $('#primekit-tb-modal-ftemplate-name, #primekit-tb-modal-select-template-type').on('change keyup', function() {
        let templateName = $('#primekit-tb-modal-ftemplate-name').val().trim();
        let templateType = $('#primekit-tb-modal-select-template-type').val();
        let isFormValid = templateName !== '' && templateType !== '';
        
        $('#primekit-tb-modal-content-form-submit').prop('disabled', !isFormValid);
    });

    $('#primekit-tb-modal-template-form').on('submit', function(e) {
        e.preventDefault();

        let formData = {
            action: 'primekit_library_new_post',
            postTitle: $('#primekit-tb-modal-ftemplate-name').val(),
            templateType: $('#primekit-tb-modal-select-template-type').val(),
            postType: $('#primekit-tb-post-type').val(),
            security: abcbizNewTemplateCreated.nonce,
        };

        $.ajax({
            type: 'POST',
            url: abcbizNewTemplateCreated.ajaxurl,
            data: formData,
            success: function(response) {
                if (response.success) {
                    window.location.href = response.data.redirect_url;
                } else {
                    alert(response.data.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('AJAX error: ' + textStatus + ' - ' + errorThrown);
                alert('AJAX error: ' + textStatus + ' - ' + errorThrown);
            }
        });
    });
});