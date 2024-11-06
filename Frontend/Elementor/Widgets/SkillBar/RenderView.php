<?php
/**
 * Render View file for Skill Bar Widget.
 */
if (!defined('ABSPATH')) exit; // Exit if accessed directly

$primekit_settings = $this->get_settings_for_display();
$primekit_id = $this->get_id(); //unique id for this widget

?>
<!--Single Skill Bar-->
<div class="primekit-ele-skill-bar-area">
    <?php if ($primekit_settings['primekit_skills_bar_list']): ?>
        <?php foreach ($primekit_settings['primekit_skills_bar_list'] as $item): ?>
            <div class="primekit-ele-progress-bar-row elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">
                <p class="primekit-ele-progress-bar-text">
                    <?php echo esc_attr($item['primekit_elementor_skill_bar_text']); ?>
                    <?php if ($primekit_settings['primekit_elementor_skill_bar_percent_value_right'] == 'yes'): ?>
                        <span>
                            <?php echo esc_attr($item['primekit_elementor_skill_bar_value']); ?>%
                        </span>
                    <?php endif; ?>
                </p>
                <div class="primekit-ele-progress-bar">
                    <span class="primekit-ele-skill-bar-percent"
                        data-percent="<?php echo esc_attr($item['primekit_elementor_skill_bar_value']); ?>">
                        <?php if ($primekit_settings['primekit_elementor_skill_bar_tooltip_switch'] == 'yes'): ?>
                            <span class="primekit_skills_bar_percent_tooltip">
                                <?php echo esc_attr($item['primekit_elementor_skill_bar_value']); ?>%
                            </span>
                        <?php endif; ?>
                    </span>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div><!--/ Single Skill Bar-->