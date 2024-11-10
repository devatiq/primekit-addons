<?php
/**
 * Render View file for Pricing Table Widget.
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

$primekit_settings = $this->get_settings_for_display();

//recommended switch
$primekit_recom_switch = $primekit_settings['primekit_elementor_pricingTable_recommended'] ? $primekit_settings['primekit_elementor_pricingTable_recommended'] : 'no';
// recommended text
$primekit_recom_text = $primekit_settings['primekit_elementor_pricingTable_recommended_text'] ? $primekit_settings['primekit_elementor_pricingTable_recommended_text'] : 'Recommended';

//recommended position
$recommended_position = $primekit_settings['primekit_elementor_pricingTable_recommended_position'] ? $primekit_settings['primekit_elementor_pricingTable_recommended_position'] : 'top';

//button url
if (!empty($primekit_settings['primekit_elementor_pricingTable_button_link']['url'])) {
    $this->add_link_attributes('primekit_elementor_pricingTable_button_link', $primekit_settings['primekit_elementor_pricingTable_button_link']);
}

//button text
$primekit_button_text = $primekit_settings['primekit_elementor_pricingTable_button_text'] ? $primekit_settings['primekit_elementor_pricingTable_button_text'] : 'Purchase Now';

//pricing table type 
$primekit_table_type = $primekit_settings['primekit_elementor_pricingTable_type'] ? $primekit_settings['primekit_elementor_pricingTable_type'] : 'standard';

?>

<!-- Pricing Table Area -->
<div
    class="primekit-ele-pricing-table-area primekit-ele-pricing-table-type-<?php echo esc_attr($primekit_table_type); ?>">
    <div class="primekit-ele-pricing-table">
        <!-- Pricing Table Header -->
        <div class="primekit-ele-pricing-table-header-area">
            <?php if ($primekit_recom_switch == 'yes'): ?>
                <!--Recommended-->
                <div
                    class="primekit-ele-pricing-recommended <?php echo esc_attr($recommended_position != 'top' ? 'primekit-ep-recommended-left' : ''); ?>">
                    <!-- primekit-ep-recommended-left-->
                    <span><?php echo esc_html($primekit_recom_text); ?></span>
                </div><!--/ Recommended-->
            <?php endif; ?>
            <div class="primekit-ele-pricing-table-header">
                <?php if ($primekit_table_type != 'standard'): ?>
                    <!--Background Shape-->
                    <div class="primekit-ele-pricing-header-bg">
                        <svg width="416" height="275" viewBox="0 0 416 275" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M425 18.9283V124.477C424.904 146.134 414.166 166.883 395.13 182.197C376.093 197.511 350.301 206.148 323.379 206.226H80.2925C57.4712 206.23 35.5146 213.25 18.9156 225.849C2.31661 238.447 -0.669656 256.173 -2 274.5L-2 18.9283C-2 10.4604 -4.81845 2.33927 2.62484 -3.64845C10.0681 -9.63617 20.1634 -13 30.6898 -13H385.406C395.916 -12.9796 405.986 -9.60666 413.409 -3.62115C420.831 2.36436 425 10.4738 425 18.9283Z"
                                fill="#448E08" />
                        </svg>
                    </div><!--/ Background Shape-->

                    <?php if ('yes' == $primekit_settings['primekit_elementor_pricingTable_header_stock_shape']): ?>
                        <!--Background Shape-->
                        <div class="primekit-ele-pricing-header-strock">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 437.88 122.1"
                                style="enable-background:new 0 0 437.88 122.1;" xml:space="preserve">
                                <path class="st0" d="M437.88,0v28.42c-18.07,16.5-38.95,27.62-62.85,33.11c-12.36,2.83-24.86,3.94-37.53,3.93
                            c-85.38-0.05-170.76-0.41-256.14,0.14C49.45,65.81,25.61,82,8.21,108.15c-2.99,4.49-5.49,9.29-8.21,13.95v-12.24
                            c0-6.04,1.26-12.04,3.75-17.54c0.01-0.03,0.03-0.06,0.04-0.08c0-0.01,0.01-0.01,0.01-0.02c4.68-11.27,12.93-19.59,23.68-26
                            c17.6-10.51,36.7-15.48,57.08-15.5c84.88-0.06,169.77-0.01,254.66-0.03c29.35-0.01,55.98-8.1,78.84-27.04
                            C426.09,16.98,432.63,9.02,437.88,0z" />
                            </svg>
                        </div><!--/ Background Shape-->
                    <?php endif; endif; ?>

                <div class="primekit-ele-pricing-pack-name">
                    <h3><?php echo esc_html($primekit_settings['primekit_elementor_pricingTable_name']); ?></h3>
                </div>
                <div class="primekit-ele-pricing-pack-preiod">
                    <h3><?php echo esc_html($primekit_settings['primekit_elementor_pricingTable_price']); ?>
                        <sub><?php echo esc_html($primekit_settings['primekit_elementor_pricingTable_price_period']); ?></sub>
                    </h3>
                </div>
            </div>
        </div><!--/ Pricing Table Header -->
        <!-- Pricing Table Body -->
        <div class="primekit-ele-pricing-table-body">
            <ul>
                <?php
                if ($primekit_settings['primekit_pricingTable_features_list']):
                    foreach ($primekit_settings['primekit_pricingTable_features_list'] as $feature):
                        ?>
                        <li class="elementor-repeater-item-<?php echo esc_attr($feature['_id']); ?>">
                            <?php \Elementor\Icons_Manager::render_icon($feature['primekit_elementor_pricingTable_feature_icon'], ['aria-hidden' => 'true']); ?>

                            <?php echo esc_html($feature['primekit_elementor_pricingTable_feature_text']); ?>
                        </li>
                    <?php endforeach;
                endif; ?>
            </ul>
        </div><!--/ Pricing Table Body -->
        <!-- Pricing Table Footer -->
        <div class="primekit-ele-pricing-table-footer">
            <a <?php echo wp_kses_post($this->get_render_attribute_string('primekit_elementor_pricingTable_button_link')); ?>
                class="primekit-ele-btn primekit-ele-btn-default"><?php echo esc_html($primekit_button_text); ?>
                <?php \Elementor\Icons_Manager::render_icon($primekit_settings['primekit_elementor_pricingTable_button_icon'], ['aria-hidden' => 'true']); ?></a>
        </div><!--/ Pricing Table Footer -->
    </div>
</div><!--/ Pricing Table Area -->