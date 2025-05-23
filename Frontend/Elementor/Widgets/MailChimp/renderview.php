<?php
/**
 * Render View for MailChimp
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

$settings = $this->get_settings_for_display();
$style = $settings['mailchimp_form_style'];
?>

<!-- MailChimp Form Area-->
<div class="primekit-mailchimp-wrapper">
    <!-- MailChimp Form -->
    <form id="primekit-mailchimp-form"
        class="primekit-mailchimp-single-form <?php if ('inline' === $style): ?> primekit-mailchimp-inline-form <?php endif; ?>">
            <!-- Name Fields -->
        <?php if ('yes' === $settings['enable_name_fields']): ?>
            <input id="primekit-mailchimp-fname" type="text" name="fname" placeholder="First Name">
            <input id="primekit-mailchimp-lname" type="text" name="lname" placeholder="Last Name">
        <?php endif; ?> <!--/ Name Fields -->

        <!-- Email Fields -->
        <input id="primekit-mailchimp-email" type="email" name="email"
            placeholder="<?php echo esc_html($settings['email_placeholder_text']); ?>" required>  <!--/ Email Fields -->
        <input id="primekit-mailchimp-list" type="hidden" name="list"
            value="<?php echo esc_attr($settings['mailchimp_list_id']); ?>">        
        
        <?php if ('default' === $style): ?>
            <!-- Submit Button for default style -->
            <button type="submit" id="primekit-mailchimp-submit"><?php echo esc_html($settings['submit_button_text']); ?>
            </button><!--/ Submit Button for default style -->
        <?php elseif ('inline' === $style): ?>
            <!-- Submit Button for inline style -->
            <button type="submit" id="primekit-mailchimp-inline-submit" class="<?php if('text' == $settings['button_type']) : ?>primekit-mailchimp-inline-submit-text <?php endif; ?>">
                <?php if ('text' == $settings['button_type']): ?>
                    <!-- Text Button for inline style -->
                    <?php echo esc_html($settings['submit_button_inline_text']); ?> <!--/ Text Button for inline style -->
                <?php elseif ('icon' == $settings['button_type']): ?>
                    <!-- Icon Button for inline style -->
                    <svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"
                        id="fi_12604076">
                        <g clip-rule="evenodd" fill="rgb(0,0,0)" fill-rule="evenodd">
                            <path
                                d="m19 13.5c.2761 0 .5-.2239.5-.5v-8.5h-8.5c-.2761 0-.5.22386-.5.5s.2239.5.5.5h7.5v7.5c0 .2761.2239.5.5.5z">
                            </path>
                            <path
                                d="m4.64645 19.3536c.19526.1952.51184.1952.7071 0l14.00005-14.00005c.1952-.19526.1952-.51184 0-.7071-.1953-.19527-.5119-.19527-.7072 0l-13.99995 13.99995c-.19527.1953-.19527.5119 0 .7072z">
                            </path>
                        </g>
                    </svg> <!--/ Icon Button for inline style -->
                <?php endif; ?>
            </button><!--/ Submit Button for inline style -->
        <?php endif; ?>
    </form> <!--/ MailChimp Form -->
    <!-- MailChimp Response -->
    <div class="primekit-mailchimp-response"></div><!--/ MailChimp Response -->
</div><!--/ MailChimp Form Area -->