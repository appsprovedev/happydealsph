<?php
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
	'key' => 'group_550736b4eeebc',
	'title' => __('Company', 'couponhut'),
	'fields' => array (
		array (
			'key' => 'field_55073707dee91',
			'label' => __('Company Logo', 'couponhut'),
			'name' => 'company_logo',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
			'preview_size' => 'thumbnail',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array (
			'key' => 'field_55225d80cd66e',
			'label' => __('Company Website', 'couponhut'),
			'name' => 'company_website',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'taxonomy',
				'operator' => '==',
				'value' => 'deal_company',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

acf_add_local_field_group(array (
	'key' => 'group_55605fb7df4d0',
	'title' => __('Contact', 'couponhut'),
	'fields' => array (
		array (
			'key' => 'field_5563003417fa3',
			'label' => __('Image Title', 'couponhut'),
			'name' => 'image_title',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_55ed438821018',
			'label' => __('Image or Map Location', 'couponhut'),
			'name' => 'image_or_map_location',
			'type' => 'radio',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array (
				'image' => __('Image', 'couponhut'),
				'map' => __('Map Location', 'couponhut'),
			),
			'other_choice' => 0,
			'save_other_choice' => 0,
			'default_value' => 'map',
			'layout' => 'vertical',
			'allow_null' => 0,
			'return_format' => 'value',
		),
		array (
			'key' => 'field_556063551154d',
			'label' => __('Upload Image', 'couponhut'),
			'name' => 'upload_image',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_55ed438821018',
						'operator' => '==',
						'value' => 'image',
					),
				),
			),
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
			'preview_size' => 'thumbnail',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array (
			'key' => 'field_556060065ab2d',
			'label' => __('Image Text', 'couponhut'),
			'name' => 'image_text',
			'type' => 'wysiwyg',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_55ed438821018',
						'operator' => '==',
						'value' => 'image',
					),
				),
			),
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'full',
			'media_upload' => 0,
		),
		array (
			'key' => 'field_55ed434b21017',
			'label' => __('Location', 'couponhut'),
			'name' => 'location',
			'type' => 'google_map',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_55ed438821018',
						'operator' => '==',
						'value' => 'map',
					),
				),
			),
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'center_lat' => '-37.81',
			'center_lng' => '144.96',
			'zoom' => '',
			'height' => '',
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'page_template',
				'operator' => '==',
				'value' => 'template-contact.php',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

acf_add_local_field_group(array (
	'key' => 'group_553527fa98297',
	'title' => __('Deal Category', 'couponhut'),
	'fields' => array (
		array (
			'key' => 'field_55352808d52c4',
			'label' => __('Icon', 'couponhut'),
			'name' => 'icon',
			'type' => 'fonticonpicker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'allow_null' => 0,
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'taxonomy',
				'operator' => '==',
				'value' => 'deal_category',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

acf_add_local_field_group(array (
	'key' => 'group_55c4d6b94af2d',
	'title' => __('Show Top Search Header', 'couponhut'),
	'fields' => array (
		array (
			'key' => 'field_55c4d6c6cc1e5',
			'label' => __('Search Header', 'couponhut'),
			'name' => 'search_header',
			'type' => 'radio',
			'instructions' => __('Display search block at the top of the page.', 'couponhut'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array (
				'show' => __('Show', 'couponhut'),
				'hide' => __('Hide', 'couponhut'),
			),
			'other_choice' => 0,
			'save_other_choice' => 0,
			'default_value' => '',
			'layout' => 'vertical',
			'allow_null' => 0,
			'return_format' => 'value',
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'page',
			),
			array (
				'param' => 'page_template',
				'operator' => '!=',
				'value' => 'template-submit-deal.php',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

acf_add_local_field_group(array (
	'key' => 'group_55016dc725a05',
	'title' => __('Single Deal', 'couponhut'),
	'fields' => array (
		array (
			'key' => 'field_5519756e0f4e2',
			'label' => __('Deal Type', 'couponhut'),
			'name' => 'deal_type',
			'type' => 'radio',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '33.333',
				'class' => '',
				'id' => '',
			),
			'choices' => array (
				'discount' => __('Discount', 'couponhut'),
				'coupon' => __('Coupon', 'couponhut'),
			),
			'allow_null' => 0,
			'other_choice' => 0,
			'save_other_choice' => 0,
			'default_value' => 'discount',
			'layout' => 'vertical',
			'return_format' => 'value',
		),
		array (
			'key' => 'field_58e5fdaa9c519',
			'label' => __('Limited Deal (*for purchasable deals only)', 'couponhut'),
			'name' => 'limited_deal',
			'type' => 'radio',
			'instructions' => __('Important! Works only for deals with shown prices and entered WooCommerce price.', 'couponhut'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '33.333',
				'class' => '',
				'id' => '',
			),
			'choices' => array (
				'yes' => __('Yes', 'couponhut'),
				'no' => __('No', 'couponhut'),
			),
			'allow_null' => 0,
			'other_choice' => 0,
			'save_other_choice' => 0,
			'default_value' => 'no',
			'layout' => 'vertical',
			'return_format' => 'value',
		),
		array (
			'key' => 'field_58e5fddf9c51a',
			'label' => __('Deals Available', 'couponhut'),
			'name' => 'deals_available',
			'type' => 'number',
			'instructions' => __('Enter the number of available deals that can be redeemed.', 'couponhut'),
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_58e5fdaa9c519',
						'operator' => '==',
						'value' => 'yes',
					),
				),
			),
			'wrapper' => array (
				'width' => '33.333',
				'class' => '',
				'id' => '',
			),
			'default_value' => 1,
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => '',
			'max' => '',
			'step' => '',
		),
		array (
			'key' => 'field_5683c0ebd307f',
			'label' => __('Printable Coupon', 'couponhut'),
			'name' => 'printable_coupon',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_5519756e0f4e2',
						'operator' => '==',
						'value' => 'coupon',
					),
				),
			),
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => __('Enable', 'couponhut'),
			'default_value' => 0,
		),
		array (
			'key' => 'field_5683c22bbfa74',
			'label' => __('Print Image', 'couponhut'),
			'name' => 'print_image',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_5683c0ebd307f',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
			'preview_size' => 'thumbnail',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array (
			'key' => 'field_554f8e55b6dd8',
			'label' => __('Deal Summary', 'couponhut'),
			'name' => 'deal_summary',
			'type' => 'textarea',
			'instructions' => __('The text that appears on the side in the single deal page.', 'couponhut'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => '',
			'new_lines' => 'wpautop',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_551976ac0f4e5',
			'label' => __('Redirect to offer URL', 'couponhut'),
			'name' => 'redirect_to_offer',
			'type' => 'checkbox',
			'instructions' => __('If it\'s enabled, the user will be redirected to the web site of the offer code.', 'couponhut'),
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_5519756e0f4e2',
						'operator' => '==',
						'value' => 'coupon',
					),
				),
			),
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array (
				'enable' => __('Enable', 'couponhut'),
			),
			'default_value' => array (
				0 => 'enable',
			),
			'layout' => 'vertical',
			'toggle' => 0,
			'return_format' => 'value',
		),
		array (
			'key' => 'field_55532006b5e0c',
			'label' => __('Image Type', 'couponhut'),
			'name' => 'image_type',
			'type' => 'radio',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '33.333',
				'class' => '',
				'id' => '',
			),
			'choices' => array (
				'image' => __('Image', 'couponhut'),
				'slider' => __('Slider', 'couponhut'),
			),
			'allow_null' => 0,
			'other_choice' => 0,
			'save_other_choice' => 0,
			'default_value' => 'image',
			'layout' => 'vertical',
			'return_format' => 'value',
		),
		array (
			'key' => 'field_55016dd111b9f',
			'label' => __('Image', 'couponhut'),
			'name' => 'image',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_55532006b5e0c',
						'operator' => '==',
						'value' => 'image',
					),
				),
			),
			'wrapper' => array (
				'width' => '33.333',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
			'preview_size' => 'thumbnail',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array (
			'key' => 'field_56b75ea64f4f7',
			'label' => __('Header Image', 'couponhut'),
			'name' => 'header_image',
			'type' => 'image',
			'instructions' => __('Upload image if you want the single deal page to have its own header different from the thumbnail..', 'couponhut'),
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_55532006b5e0c',
						'operator' => '==',
						'value' => 'image',
					),
				),
			),
			'wrapper' => array (
				'width' => '33.333',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
			'preview_size' => 'thumbnail',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array (
			'key' => 'field_5553204db5e0d',
			'label' => __('Slider', 'couponhut'),
			'name' => 'slider',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_55532006b5e0c',
						'operator' => '==',
						'value' => 'slider',
					),
				),
			),
			'wrapper' => array (
				'width' => '66.666',
				'class' => '',
				'id' => '',
			),
			'collapsed' => '',
			'min' => '',
			'max' => '',
			'layout' => 'table',
			'button_label' => 'Add Row',
			'sub_fields' => array (
				array (
					'key' => 'field_5553205db5e0e',
					'label' => __('Image', 'couponhut'),
					'name' => 'image',
					'type' => 'image',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => array (
						array (
							array (
								'field' => 'field_55532006b5e0c',
								'operator' => '==',
								'value' => 'slider',
							),
						),
					),
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'return_format' => 'array',
					'preview_size' => 'thumbnail',
					'library' => 'all',
					'min_width' => '',
					'min_height' => '',
					'min_size' => '',
					'max_width' => '',
					'max_height' => '',
					'max_size' => '',
					'mime_types' => '',
				),
			),
		),
		array (
			'key' => 'field_551976780f4e4',
			'label' => __('Coupon Code', 'couponhut'),
			'name' => 'coupon_code',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_5519756e0f4e2',
						'operator' => '==',
						'value' => 'coupon',
					),
					array (
						'field' => 'field_5683c0ebd307f',
						'operator' => '!=',
						'value' => '1',
					),
				),
			),
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_55016e0911ba1',
			'label' => __('Discount Value', 'couponhut'),
			'name' => 'discount_value',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_55016e3011ba3',
			'label' => __('URL', 'couponhut'),
			'name' => 'url',
			'type' => 'text',
			'instructions' => __('Entering link will redirect the user on deal redeeming.', 'couponhut'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array (
			'key' => 'field_55016e3d11ba4',
			'label' => __('Expiring Date', 'couponhut'),
			'name' => 'expiring_date',
			'type' => 'date_picker',
			'instructions' => __('The deal will expire exactly when the selected day begins.', 'couponhut'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'display_format' => 'd/m/Y',
			'return_format' => 'Y/m/d',
			'first_day' => 1,
		),
		array (
			'key' => 'field_568a54a25476a',
			'label' => __('Show Pricing Fields', 'couponhut'),
			'name' => 'show_pricing_fields',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '33.333',
				'class' => '',
				'id' => '',
			),
			'message' => __('Show', 'couponhut'),
			'default_value' => 0,
		),
		array (
			'key' => 'field_568a548054767',
			'label' => __('Old Price', 'couponhut'),
			'name' => 'old_price',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_568a54a25476a',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array (
				'width' => '33.333',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array (
			'key' => 'field_568a548f54768',
			'label' => __('New Price', 'couponhut'),
			'name' => 'new_price',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_568a54a25476a',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array (
				'width' => '33.333',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array (
			'key' => 'field_56e7e66951a0f',
			'label' => __('WooCommerce Sale Price', 'couponhut'),
			'name' => 'woocommerce_price',
			'type' => 'number',
			'instructions' => __('This is the price that will be used for the WooCommerce Pricing. Only numbers must be placed here. The currency sign must not be entered. Make sure you have selected the correct currency in WooCommerce > Settings > General. If WooCommerce Sale Price is left blank or WooCommerce is disabled, the deal will not use a payment system.', 'couponhut'),
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_568a54a25476a',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => '',
			'max' => '',
			'step' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_568a549854769',
			'label' => __('Save', 'couponhut'),
			'name' => 'save',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_568a54a25476a',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_56f12e67f1d15',
			'label' => __('Virtual Deal', 'couponhut'),
			'name' => 'virtual_deal',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'message' => __('If this is enabled, no shipping information will be entered for this deal.', 'couponhut'),
			'default_value' => 1,
		),
		array (
			'key' => 'field_5673f4f869107',
			'label' => __('Registered Members Only', 'couponhut'),
			'name' => 'registered_members_only',
			'type' => 'true_false',
			'instructions' => __('Important! Enable WooCommerce plugin if this is set.', 'couponhut'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'message' => __('Enable', 'couponhut'),
			'default_value' => 0,
		),
		array (
			'key' => 'field_55d30607a99a0',
			'label' => __('Show Location', 'couponhut'),
			'name' => 'show_location',
			'type' => 'radio',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'choices' => array (
				'show' => __('Show', 'couponhut'),
				'hide' => __('Hide', 'couponhut'),
			),
			'allow_null' => 0,
			'other_choice' => 0,
			'save_other_choice' => 0,
			'default_value' => 'show',
			'layout' => 'vertical',
			'return_format' => 'value',
		),
		array (
			'key' => 'field_5645d20916d2e',
			'label' => __('Map Zoom', 'couponhut'),
			'name' => 'map_zoom',
			'type' => 'number',
			'instructions' => __('Enter map zoom level from 1 to 20.', 'couponhut'),
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_55d30607a99a0',
						'operator' => '==',
						'value' => 'show',
					),
				),
			),
			'wrapper' => array (
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'default_value' => 16,
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => 1,
			'max' => 20,
			'step' => '',
		),
		array (
			'key' => 'field_55acf7df457a3',
			'label' => __('Location', 'couponhut'),
			'name' => 'location',
			'type' => 'google_map',
			'instructions' => __('<strong>Receiving map error?</strong>	Google have changed their Google Maps policies and now an API Key has to be present for Google Maps to work. Please go to Appearance > Theme Settings > Deals and fill the "Google API Key" field.', 'couponhut'),
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_55d30607a99a0',
						'operator' => '==',
						'value' => 'show',
					),
				),
			),
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'center_lat' => '-37.81',
			'center_lng' => '144.96',
			'zoom' => '',
			'height' => '',
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'deal',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

endif;