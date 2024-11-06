<?php
/**
 * Render View file for Team Member Widget.
 */
if (!defined('ABSPATH')) exit; // Exit if accessed directly

$primekit_settings = $this->get_settings_for_display();
$primekit_team_member_style = $primekit_settings['primekit_elementor_teammember_style'];

    if ($primekit_team_member_style == 'style-one') {
      require(PRIMEKIT_ELEMENTOR_PATH . 'Widgets/TeamMember/Templates/style-one.php');
    } elseif ($primekit_team_member_style == 'style-two') {
       require(PRIMEKIT_ELEMENTOR_PATH . 'Widgets/TeamMember/Templates/style-two.php');
    }
    else {
        require(PRIMEKIT_ELEMENTOR_PATH . 'Widgets/TeamMember/Templates/style-three.php');
    }
?>