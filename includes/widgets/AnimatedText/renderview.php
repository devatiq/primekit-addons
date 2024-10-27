<?php
/**
 * Render View for PrimeKit Animated Text
 */
if (!defined('ABSPATH')) exit; // Exit if accessed directly

$primekit_settings = $this->get_settings_for_display();
$primekit_anim_text_before = $primekit_settings['primekit_elementor_anim_text_before'];
$primekit_anim_text_after = $primekit_settings['primekit_elementor_anim_text_after'];
$primekit_animated_texts = $primekit_settings['primekit_elementor_anim_text_list']; 
$primekit_animated_text_type = $primekit_settings['primekit_elementor_anim_text_type']; 
?>

<div class="primekit-elementor-anim-text-area <?php if (!empty($primekit_anim_text_after)) : ?>primekit-anim-has-after-text<?php endif; ?>">
    <<?php echo esc_html($primekit_settings['primekit_elementor_anim_text_tag']); ?> class="primekit-anim-text-headline cd-headline <?php echo esc_html($primekit_animated_text_type);?>">
	<?php if (!empty($primekit_anim_text_before)) : ?><span class="primekit-anim-before-text"><?php echo esc_html($primekit_anim_text_before); ?></span><?php endif; ?>
        <span class="primekit-anim-texts cd-words-wrapper">
            <?php if (!empty($primekit_animated_texts)) : ?>
                <?php foreach ($primekit_animated_texts as $index => $item) : ?>
                    <b class="<?php echo $index === 0 ? 'is-visible' : ''; ?>"><?php echo esc_html($item['primekit_elementor_anim_text']); ?></b>
                <?php endforeach; ?>
            <?php endif; ?>
        </span>
		<?php if (!empty($primekit_anim_text_after)) : ?> <span class="primekit-anim-after-text"><?php echo esc_html($primekit_anim_text_after); ?></span><?php endif; ?></<?php echo esc_html($primekit_settings['primekit_elementor_anim_text_tag']); ?>>
</div><!-- end animated text area -->