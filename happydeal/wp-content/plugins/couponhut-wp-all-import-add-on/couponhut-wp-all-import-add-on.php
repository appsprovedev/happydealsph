<?php
/*
Plugin Name: CouponHut WP All Import Add-On
Description: WP All Import Add-On for bulk Deals Import.
Version: 1.0
Author: Subsolar Designs
*/


include "rapid-addon.php";


$couponhut_addon = new RapidAddon('CouponHut Add-On', 'couponhut_addon');

$couponhut_addon->add_field('company', esc_html__('Company', 'couponhut'), 'text');

$couponhut_addon->add_field('category', esc_html__('Category', 'couponhut'), 'text');

$couponhut_addon->add_field('deal_type', 'Deal Type', 'radio',
	array(
		'discount' => esc_html__('Discount'),
		'coupon' => esc_html__('Coupon'),
	)
);

$couponhut_addon->add_field('printable_coupon', 'Printable Coupon', 'radio',
	array(
		true => esc_html__('Yes', 'couponhut'),
		false => esc_html__('No', 'couponhut'),
	)
);

$couponhut_addon->add_field('print_image', esc_html__('Print Image', 'couponhut'), 'text');

$couponhut_addon->add_field('deal_summary', esc_html__('Deal Summary', 'couponhut'), 'text');

$couponhut_addon->add_field('redirect_to_offer', esc_html__('Redirect to offer URL', 'couponhut'), 'radio',
	array(
		true => esc_html__('Yes', 'couponhut'),
		false => esc_html__('No', 'couponhut'),
	)
);

$couponhut_addon->add_field('image_type', esc_html__('Image Type', 'couponhut'), 'radio',
	array(
		'image' => esc_html__('Image', 'couponhut'),
		'slider' => esc_html__('Slider', 'couponhut')
	)
);

$couponhut_addon->add_field('image', esc_html__('Deal Image', 'couponhut'), 'image');

$couponhut_addon->add_field('header_image', esc_html__('Header Image', 'couponhut'), 'image');

$couponhut_addon->add_field('slider_1_image', esc_html__('Slider Image 1', 'couponhut'), 'image');
$couponhut_addon->add_field('slider_2_image', esc_html__('Slider Image 2', 'couponhut'), 'image');
$couponhut_addon->add_field('slider_3_image', esc_html__('Slider Image 3', 'couponhut'), 'image');
$couponhut_addon->add_field('slider_4_image', esc_html__('Slider Image 4', 'couponhut'), 'image');
$couponhut_addon->add_field('slider_5_image', esc_html__('Slider Image 5', 'couponhut'), 'image');
$couponhut_addon->add_field('slider_6_image', esc_html__('Slider Image 6', 'couponhut'), 'image');


$couponhut_addon->add_field('coupon_code', esc_html__('Coupon Code', 'couponhut'), 'text');

$couponhut_addon->add_field('discount_value', esc_html__('Discout Value', 'couponhut'), 'text');

$couponhut_addon->add_field('url', esc_html__('URL', 'couponhut'), 'text');

$couponhut_addon->add_field('expiring_date', esc_html__('Expiring Date (mm/dd/YYYY) - USE ONLY ONE OF THESE', 'couponhut'), 'text');

$couponhut_addon->add_field('expiring_date_eu', esc_html__('Expiring Date (dd/mm/YYYY) - USE ONLY ONE OF THESE', 'couponhut'), 'text');

$couponhut_addon->add_field('show_pricing_fields', esc_html__('Show Pricing Fields', 'couponhut'), 'radio',
	array(
		true => esc_html__('Yes', 'couponhut'),
		false => esc_html__('No', 'couponhut'),
	)
);

$couponhut_addon->add_field('old_price', esc_html__('Old Price', 'couponhut'), 'text');

$couponhut_addon->add_field('new_price', esc_html__('New Price', 'couponhut'), 'text');

$couponhut_addon->add_field('woocommerce_price', esc_html__('WooCommerce Sale Price (Important: cNumbers Only)', 'couponhut'), 'text');

$couponhut_addon->add_field('save', esc_html__('You Save Price', 'couponhut'), 'text');

$couponhut_addon->add_field('virtual_deal', esc_html__('Virtual Deal', 'couponhut'), 'radio',
	array(
		true => esc_html__('Yes', 'couponhut'),
		false => esc_html__('No', 'couponhut'),
	)
);

$couponhut_addon->add_field('registered_members_only', esc_html__('Registered Members Only', 'couponhut'), 'radio',
	array(
		true => esc_html__('Yes', 'couponhut'),
		false => esc_html__('No', 'couponhut'),
	)
);

$couponhut_addon->add_field('show_location', esc_html__('Show Location', 'couponhut'), 'radio',
	array(
		true => esc_html__('Yes', 'couponhut'),
		false => esc_html__('No', 'couponhut'),
	)
);

$couponhut_addon->add_field('location_lat', esc_html__('Location Latitude', 'couponhut'), 'text');

$couponhut_addon->add_field('location_lng', esc_html__('Location Longitude', 'couponhut'), 'text');

$couponhut_addon->add_field('map_zoom', esc_html__('Map Zoom', 'couponhut'), 'text');

$couponhut_addon->set_import_function('ssd_couponhut_addon_import');


// the add-on will run for all themes/post types if no arguments are passed to run()
$couponhut_addon->run(
	array(
		'themes' => array( 'CouponHut' ),
		'post_types' => array( 'deal' ),
	)
); 


const ACF_DEAL_TYPE = 'field_5519756e0f4e2';
const ACF_PRINTABLE_COUPON = 'field_5683c0ebd307f';
const ACF_PRINT_IMAGE = 'field_5683c22bbfa74';
const ACF_DEAL_SUMMARY = 'field_554f8e55b6dd8';
const ACF_REDIRECT_TO_OFFER = 'field_551976ac0f4e5';
const ACF_IMAGE_TYPE = 'field_55532006b5e0c';
const ACF_IMAGE = 'field_55016dd111b9f';
const ACF_HEADER_IMAGE = 'field_56b75ea64f4f7';
const ACF_SLIDER = 'field_5553204db5e0d';
const ACF_COUPON_CODE = 'field_551976780f4e4';
const ACF_DISCOUNT_VALUE = 'field_55016e0911ba1';
const ACF_URL = 'field_55016e3011ba3';
const ACF_EXPIRING_DATE = 'field_55016e3d11ba4';
const ACF_SHOW_PRICING_FIELDS = 'field_568a54a25476a';
const ACF_OLD_PRICE = 'field_568a548054767';
const ACF_NEW_PRICE = 'field_568a548f54768';
const ACF_WOOCOMMERCE_PRICE = 'field_56e7e66951a0f';
const ACF_SAVE = 'field_568a549854769';
const ACF_VIRTUAL_DEAL = 'field_56f12e67f1d15';
const ACF_REGISTERED_MEMBERS_ONLY = 'field_5673f4f869107';
const ACF_SHOW_LOCATION = 'field_55d30607a99a0';
const ACF_LOCATION = 'field_55acf7df457a3';
const ACF_MAP_ZOOM = 'field_5645d20916d2e';


function ssd_couponhut_addon_import($post_id, $data, $import_options) {

	global $couponhut_addon;

	if ($couponhut_addon->can_update_meta('company', $import_options)) {

		$company = get_term_by('name', $data['company'], 'deal_company', ARRAY_A);

		if ( !$company ) {
			wp_insert_term(
				$data['company'],
				'deal_company'
			);

			$company = get_term_by('name', $data['company'], 'deal_company', ARRAY_A);
		} 

		wp_set_object_terms($post_id, $company['term_id'], 'deal_company' );
	
	}

	if ($couponhut_addon->can_update_meta('category', $import_options)) {

		$category = get_term_by('name', $data['category'], 'deal_category', ARRAY_A);

		if ( !$category ) {
			wp_insert_term(
				$data['category'],
				'deal_category'
			);

			$category = get_term_by('name', $data['category'], 'deal_category', ARRAY_A);

		} 

		wp_set_object_terms($post_id, $category['term_id'], 'deal_category' );
	
	}

	if ($couponhut_addon->can_update_meta('deal_type', $import_options)) {
		update_field(ACF_DEAL_TYPE, $data['deal_type'], $post_id);
	}

	if ($couponhut_addon->can_update_meta('printable_coupon', $import_options)) {
		update_field(ACF_PRINTABLE_COUPON, $data['printable_coupon'], $post_id);
	}

	if ($couponhut_addon->can_update_meta('print_image', $import_options)) {
		update_field(ACF_PRINT_IMAGE, $data['print_image'], $post_id);
	}

	if ($couponhut_addon->can_update_meta('deal_summary', $import_options)) {
		update_field(ACF_DEAL_SUMMARY, $data['deal_summary'], $post_id);
	}

	if ($couponhut_addon->can_update_meta('redirect_to_offer', $import_options)) {
		update_field(ACF_REDIRECT_TO_OFFER, $data['redirect_to_offer'], $post_id);
	}

	if ($couponhut_addon->can_update_meta('image_type', $import_options)) {
		update_field(ACF_IMAGE_TYPE, $data['image_type'], $post_id);
	}

	if ($couponhut_addon->can_update_meta('image', $import_options)) {
		update_field(ACF_IMAGE, $data['image']['attachment_id'], $post_id);
	}

	if ($couponhut_addon->can_update_meta('header_image', $import_options)) {
		update_field(ACF_HEADER_IMAGE, $data['header_image']['attachment_id'], $post_id);
	}

	if ($couponhut_addon->can_update_meta('slider_1_image', $import_options)) {
		update_sub_field( array(ACF_SLIDER, 1, 'image'), $data['slider_1_image']['attachment_id'], $post_id);
	}
	if ($couponhut_addon->can_update_meta('slider_2_image', $import_options)) {
		update_sub_field( array(ACF_SLIDER, 1, 'image'), $data['slider_2_image']['attachment_id'], $post_id);
	}
	if ($couponhut_addon->can_update_meta('slider_3_image', $import_options)) {
		update_sub_field( array(ACF_SLIDER, 1, 'image'), $data['slider_3_image']['attachment_id'], $post_id);
	}
	if ($couponhut_addon->can_update_meta('slider_4_image', $import_options)) {
		update_sub_field( array(ACF_SLIDER, 1, 'image'), $data['slider_4_image']['attachment_id'], $post_id);
	}
	if ($couponhut_addon->can_update_meta('slider_5_image', $import_options)) {
		update_sub_field( array(ACF_SLIDER, 1, 'image'), $data['slider_5_image']['attachment_id'], $post_id);
	}
	if ($couponhut_addon->can_update_meta('slider_6_image', $import_options)) {
		update_sub_field( array(ACF_SLIDER, 1, 'image'), $data['slider_6_image']['attachment_id'], $post_id);
	}

	if ($couponhut_addon->can_update_meta('coupon_code', $import_options)) {
		update_field(ACF_COUPON_CODE, $data['coupon_code'], $post_id);
	}

	if ($couponhut_addon->can_update_meta('discount_value', $import_options)) {
		update_field(ACF_DISCOUNT_VALUE, $data['discount_value'], $post_id);
	}

	if ($couponhut_addon->can_update_meta('url', $import_options)) {
		update_field(ACF_URL, $data['url'], $post_id);
	}

	if ($couponhut_addon->can_update_meta('expiring_date', $import_options)) {

		if ( !empty($data['expiring_date']) ) {
			$old_expiring_date = $data['expiring_date'];
		} else {
			$old_expiring_date = $data['expiring_date_eu'];
			$old_expiring_date = str_replace('/', '-', $old_expiring_date);
		}
		$expiring_date = date('Ymd', strtotime($old_expiring_date));
		update_field(ACF_EXPIRING_DATE, $expiring_date, $post_id);
	}

	if ($couponhut_addon->can_update_meta('show_pricing_fields', $import_options)) {
		update_field(ACF_SHOW_PRICING_FIELDS, $data['show_pricing_fields'], $post_id);
	}

	if ($couponhut_addon->can_update_meta('old_price', $import_options)) {
		update_field(ACF_OLD_PRICE, $data['old_price'], $post_id);
	}

	if ($couponhut_addon->can_update_meta('new_price', $import_options)) {
		update_field(ACF_NEW_PRICE, $data['new_price'], $post_id);
	}

	if ($couponhut_addon->can_update_meta('woocommerce_price', $import_options)) {
		update_field(ACF_WOOCOMMERCE_PRICE, $data['woocommerce_price'], $post_id);
	}

	if ($couponhut_addon->can_update_meta('save', $import_options)) {
		update_field(ACF_SAVE, $data['save'], $post_id);
	}

	if ($couponhut_addon->can_update_meta('virtual_deal', $import_options)) {
		update_field(ACF_VIRTUAL_DEAL, $data['virtual_deal'], $post_id);
	}

	if ($couponhut_addon->can_update_meta('registered_members_only', $import_options)) {
		update_field(ACF_REGISTERED_MEMBERS_ONLY, $data['registered_members_only'], $post_id);
	}

	if ($couponhut_addon->can_update_meta('show_location', $import_options)) {
		update_field(ACF_SHOW_LOCATION, $data['show_location'], $post_id);
	}

	if ($couponhut_addon->can_update_meta('location_lat', $import_options) && $couponhut_addon->can_update_meta('location_lng', $import_options)) {
		$location['lat'] = $data['location_lat'];
		$location['lng'] = $data['location_lng'];
		update_field(ACF_LOCATION, $location, $post_id);
	}

	if ($couponhut_addon->can_update_meta('map_zoom', $import_options)) {
		update_field(ACF_MAP_ZOOM, $data['map_zoom'], $post_id);
	}

	do_action('acf/save_post', $post_id);

}

add_action('pmxi_saved_post ', 'ssd_couponhut_after_wp_all_import', 30, 1);

function ssd_couponhut_after_wp_all_import($post_id) {
	do_action('acf/save_post', $post_id);
}