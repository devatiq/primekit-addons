jQuery(document).ready(function($) {
    $('#primekit-mailchimp-form').on('submit', function(e) {
        e.preventDefault();

        var formData = {
            action: 'primekit_mailchimp_subscribe',
            nonce: PrimekitMailchimpAjax.nonce,
            email: $('#primekit-mailchimp-email').val(),
            fname: $('#primekit-mailchimp-fname').val(),
            lname: $('#primekit-mailchimp-lname').val(),
            mailchimp_list_id: $('#primekit-mailchimp-list').val()
        };

        $('.primekit-mailchimp-response').html('<p>Processing...</p>');

        $.ajax({
            url: PrimekitMailchimpAjax.ajax_url,
            type: 'POST',
            dataType: 'json',
            data: formData,
            success: function(response) {
                if (response.success) {                    
                    $('.primekit-mailchimp-response').html('<p>' + response.data.message + '</p>');
                } else {
                    $('.primekit-mailchimp-response').html('<p>' + response.data.message + '</p>');
                }
            },
            error: function() {
                $('.primekit-mailchimp-response').html('<p>There was an error. Please try again.</p>');
            }
        });
    });
});
