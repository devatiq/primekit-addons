<?php
/**
 * Render View file for PrimeKit Testimonials Widget.
 */
if (!defined('ABSPATH')) exit; // Exit if accessed directly

$primekit_settings = $this->get_settings_for_display();
$unique_id = $this->get_id();

// get testimonial type
$primekit_testimonial_type = $primekit_settings['primekit_ele_testimonial_types'] ? $primekit_settings['primekit_ele_testimonial_types'] : 'grid';

//set templates for testimonial
if($primekit_testimonial_type == 'grid'){
    include 'templates/grid.php';
}elseif($primekit_testimonial_type == 'slider'){
    include 'templates/sliders.php';
}