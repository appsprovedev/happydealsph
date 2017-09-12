<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

/**
 * Theme Includes
 */

require_once get_template_directory() .'/inc/init.php';


/**
 * TGM Plugin Activation
 */
{
	require_once get_template_directory() . '/TGM-Plugin-Activation/class-tgm-plugin-activation.php';

	/** @internal */
	function _action_theme_register_required_plugins() {
		tgmpa( array(
			array(
				'name'      => 'Unyson',
				'slug'      => 'unyson',
				'required'  => true,
			),
			array(
				'name'     				=> esc_html__('Envato Market', 'couponhut'),
				'slug'     				=> 'envato-market',
				'source'   				=> get_template_directory() . '/TGM-Plugin-Activation/plugins/envato-market.zip',
				'required' 				=> false,
				'version' 				=> '',
				'force_activation' 		=> false,
				'force_deactivation' 	=> false,
				'external_url' 			=> ''
			),
			array(
				'name'     				=> 'Subsolar Designs Extras',
				'slug'     				=> 'subsolar-extras',
				'source'   				=> get_template_directory() . '/TGM-Plugin-Activation/plugins/subsolar-extras.zip',
				'required' 				=> true,
				'version' 				=> '1.3.3',
				'force_activation' 		=> false,
				'force_deactivation' 	=> false,
				'external_url' 			=> ''
			),
			array(
				'name'     				=> 'Contact Form 7',
				'slug'     				=> 'contact-form-7',
				'required' 				=> false,
				'version' 				=> '',
				'force_activation' 		=> false,
				'force_deactivation' 	=> false,
				'external_url' 			=> ''
			),
			array(
				'name'     				=> 'WooCommerce',
				'slug'     				=> 'woocommerce',
				'required' 				=> false,
				'version' 				=> '',
				'force_activation' 		=> false,
				'force_deactivation' 	=> false,
				'external_url' 			=> ''
			),
			array(
				'name'     				=> 'WP ALL Import',
				'slug'     				=> 'wp-all-import',
				'required' 				=> false,
				'version' 				=> '',
				'force_activation' 		=> false,
				'force_deactivation' 	=> false,
				'external_url' 			=> ''
			),
			array(
				'name'     				=> 'CouponHut WP All Import Add-On',
				'slug'     				=> 'couponhut-wp-all-import-add-on',
				'source'   				=> get_template_directory() . '/TGM-Plugin-Activation/plugins/couponhut-wp-all-import-add-on.zip',
				'required' 				=> false,
				'version' 				=> '',
				'force_activation' 		=> false,
				'force_deactivation' 	=> false,
				'external_url' 			=> ''
			),
			array(
				'name'     				=> 'Advanced Custom Fields Pro',
				'slug'     				=> 'advanced-custom-fields-pro',
				'source'   				=> get_template_directory() . '/TGM-Plugin-Activation/plugins/advanced-custom-fields-pro.zip',
				'required' 				=> true,
				'force_activation' 		=> false
			),
		) );

	}
	add_action( 'tgmpa_register', '_action_theme_register_required_plugins' );
}