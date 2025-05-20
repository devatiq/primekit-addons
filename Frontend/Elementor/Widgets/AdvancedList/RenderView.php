<?php
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

$settings = $this->get_settings_for_display();

if (!empty($settings['primekit_advanced_list_items'])): ?>
    <ul class="primekit-feature-list-wrapper">
        <?php foreach ($settings['primekit_advanced_list_items'] as $item): ?>
            <li class="primekit-list-item">
                <div class="primekit-content">
                    <div class="primekit-list-item-icon">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div class="primekit-list-item-content">
                        <?php
                        if (!empty($item['list_title'])) {
                            ?>
                            <h4 class="primekit-list-title">
                                <?php echo esc_html($item['list_title']); ?>
                            </h4>
                            <?php
                        } elseif (!empty($item['list_sub_title'])) {
                            ?>
                            <p class="primekit-list-text">
                                <?php echo esc_html($item['list_sub_title']); ?>
                            </p>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>