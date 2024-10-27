<?php
/*
Plugin Widgets
*/
if (!defined('ABSPATH')) exit; // Exit if accessed directly

        $primekit_widgets = [];

			$primekit_widgets[] = \PrimeKit\Includes\Widgets\AnimatedText\Main::class;
			$primekit_widgets[] = \PrimeKit\Includes\Widgets\ArchiveTitle\Main::class;

		foreach ($primekit_widgets as $widget_class) {
			$primekit_widgets_manager->register(new $widget_class());
		}