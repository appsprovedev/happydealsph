<?php if (!defined('FW')) die('Forbidden');

$uri = fw_get_template_customizations_directory_uri('/extensions/shortcodes/shortcodes/image-carousel');

wp_enqueue_script(
	'fw-shortcode-image-carousel',
	$uri . '/static/js/scripts.js',
	false,
	true
);
wp_enqueue_style(
	'fw-shortcode-image-carousel',
	$uri . '/static/css/styles.css'
);
