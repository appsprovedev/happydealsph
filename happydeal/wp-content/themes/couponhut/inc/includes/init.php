<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

/**
 * ACF Init
 */
// include_once( get_template_directory() . '/inc/includes/acf/acf.php');

/**
 * ACF FontIconPicker Init
 */
if ( function_exists('get_field') ) {
	include_once( get_template_directory() . '/inc/includes/acf-fonticonpicker/fonticonpicker-v5.php');
}

/**
 * ACF Fields
 */

if ( file_exists( get_stylesheet_directory() . '/inc/includes/acf-fields/acf-fields.php') ) {
	include_once( get_stylesheet_directory() . '/inc/includes/acf-fields/acf-fields.php');
} else {
	include_once( get_template_directory() . '/inc/includes/acf-fields/acf-fields.php');
}




/**
 * Subsolar Widget Forms Init
 */
include_once( get_template_directory() . '/inc/includes/subsolar-widget-fields/subsolar-widget-fields.php');

/**
 * Mailchimp API Wrapper
 */
include_once( get_template_directory() . '/inc/includes/MailChimp.php');