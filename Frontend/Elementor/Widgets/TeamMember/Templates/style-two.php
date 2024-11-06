<?php
/**
 * Render View file for Team Member 2
 */
if (!defined('ABSPATH')) exit; // Exit if accessed directly

$primekit_settings = $this->get_settings_for_display();
$primekit_style_two_id = $this->get_id();

$primekit_member_image = $primekit_settings['primekit_elementor_teammember_image'];
$primekit_member_name = $primekit_settings['primekit_elementor_teammember_name'];
$primekit_team_designation = $primekit_settings['primekit_elementor_teammember_designation'];
$primekit_member_link = $primekit_settings['primekit_elementor_teammember_link'];
$primekit_member_image_dimension = $primekit_settings['primekit_elementor_teammember_image_dimension'];
?>

<!-- Team Member Wrap Start-->
<div class="primekit-elementor-team-member-area  primekit-team-style-two" id="primekit-team-member-<?php echo esc_attr($primekit_style_two_id); ?>">
 
    <!-- Team Member Single Item-->
    <div class="primekit-team-single-item-style-two">
        <div class="primekit-elementor-team-img" id="primekit-elementor-team-style-two-img">
           
        <!-- Team Member Image -->
        <div class="primekit-ele-team-image">
            <?php
             if (!empty($primekit_member_image['id'])) {
             $primekit_image_id = $primekit_member_image['id'];
             $primekit_image_dimension = $primekit_member_image_dimension;

             $primekit_image_size = !empty($primekit_image_dimension) ? [$primekit_image_dimension['width'], $primekit_image_dimension['height']] : 'primekit_square_img';

             $primekit_image_array = wp_get_attachment_image_src($primekit_image_id, $primekit_image_size);
             $primekit_member_image_url = $primekit_image_array ? $primekit_image_array[0] : '';
           }

            if (empty($primekit_member_image_url)) {
            $primekit_member_image_url = PRIMEKIT_ELEMENTOR_ASSETS . '/img/member-placeholder.jpg';
           }
          ?>
           <img src="<?php echo esc_url($primekit_member_image_url); ?>" alt="<?php echo esc_html($primekit_member_name); ?>">
            </div><!-- /Team Member Image -->

            <div class="primekit-ele-team-style-two-info">
                
            <?php if (!empty($primekit_team_designation)) : ?>
                        <p class="primekit-ele-team-designation"><?php echo esc_html($primekit_team_designation); ?></p>
                    <?php endif; ?>

                <div class="primekit-elementor-team-name" id="primekit-elementor-team-two-name">
                <?php if (!empty($primekit_member_name)) : ?>
                        <h3 class="primekit-ele-team-name">
                        <?php if (!empty($primekit_member_link)) : ?>
                        <a href="<?php echo esc_url($primekit_member_link); ?>">
                        <?php endif; ?>
                         <?php echo esc_html($primekit_member_name); ?></h3>
                         <?php if (!empty($primekit_member_link)) : ?>
                         </a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

                <?php 
                    if($primekit_settings['primekit_elementor_teammember_display_social' ] == 'yes') :
                ?>
                <!--Social Profile Overlay-->
                <div class="primekit-ele-team-social-overlay primekit-team-style-two-social">
                <?php include __DIR__ . '/partials/social-links.php'; ?><!-- social icons -->                     
                </div><!--Social Profile Overlay-->
                <?php endif; ?>
            </div>

        </div>
    </div><!--/ Team Member Single Item-->   
    
</div><!-- Team Member Wrap Start-->