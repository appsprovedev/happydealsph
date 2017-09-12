<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'general' => array(
		'title'   => __( 'General', 'couponhut' ),
		'type'    => 'tab',
		'options' => array(
			'logo_name'    => array(
				'label' => esc_html__( 'Logo Name', 'couponhut' ),
				'desc'  => esc_html__( 'Write your website logo name', 'couponhut' ),
				'type'  => 'text',
				'value' => get_bloginfo( 'name' )
			),
			'logo_image' => array(
				'label' => esc_html__( 'Logo Image', 'couponhut' ),
				'desc'  => esc_html__( 'Upload the logo image', 'couponhut' ),
				'type'  => 'upload',
				'images_only' => true
			),
			'top_logo_padding' => array(
				'type'  => 'text',
				'value' => '20px 0px 0px 0px',
				'label' => esc_html__('Logo Padding', 'couponhut'),
				'desc'  => esc_html__('Positon the logo in the main navigation - TOP(px), RIGHT(px), BOTTOM(px), LEFT(px)', 'couponhut'),
			),
			'footer_image' => array(
				'label' => esc_html__( 'Footer Image', 'couponhut' ),
				'desc'  => esc_html__( 'Upload a footer image', 'couponhut' ),
				'type'  => 'upload'
			),
			'copyright-text' => array(
				'label' => esc_html__( 'Copyright Text', 'couponhut' ),
				'type'  => 'text',
				'value' => '&copy; ' . date("Y") . ' CouponHut. All rights reserved.'
			)
		),
	),
	'layout' => array(
		'title'   => __( 'Styling & Layout', 'couponhut' ),
		'type'    => 'tab',
		'options' => array(
			'show-login-switch' => array(
				'type'  => 'switch',
				'value' => 'show',
				'label' => esc_html__('Show Log In Drop Menu in Navigation', 'couponhut'),
				'left-choice' => array(
					'value' => 'hide',
					'label' => esc_html__('Hide', 'couponhut'),
				),
				'right-choice' => array(
					'value' => 'show',
					'label' => esc_html__('Show', 'couponhut'),
				),
			),
			'show-cart-switch' => array(
				'type'  => 'switch',
				'value' => 'show',
				'label' => esc_html__('Show Cart Icon Drop Menu in Navigation', 'couponhut'),
				'left-choice' => array(
					'value' => 'hide',
					'label' => esc_html__('Hide', 'couponhut'),
				),
				'right-choice' => array(
					'value' => 'show',
					'label' => esc_html__('Show', 'couponhut'),
				),
			),
			'search-screen' => array(
			    'type'  => 'checkboxes',
			    'inline' => false,
			    'value' => array(
			        'post' => false,
			        'deal' => false,
			        'archive' => true,
			        'search' => true,
			    ),
			    'label' => __('Show Search Header', 'couponhut'),
			    'choices' => array(
			        'post' => __('Posts', 'couponhut'),
			        'page' => __('Pages', 'couponhut'),
			        'archive' => __('Archive (Categories, etc.)', 'couponhut'),
			        'search' => __('Search', 'couponhut'),
			    ),
			),
			'taxonomy-sidebar-switch' => array(
				'type'  => 'switch',
				'value' => false,
				'label' => esc_html__('Show Sidebar in Categories and Companies Archive Pages', 'couponhut'),
				'left-choice' => array(
					'value' => false,
					'label' => esc_html__('Hide', 'couponhut'),
				),
				'right-choice' => array(
					'value' => true,
					'label' => esc_html__('Show', 'couponhut'),
				),
			),
			'submit-deal-sidebar-switch' => array(
				'type'  => 'switch',
				'value' => false,
				'label' => esc_html__('Show Sidebar in Submit Page', 'couponhut'),
				'left-choice' => array(
					'value' => false,
					'label' => esc_html__('Hide', 'couponhut'),
				),
				'right-choice' => array(
					'value' => true,
					'label' => esc_html__('Show', 'couponhut'),
				),
			),
			'sidebar-switch' => array(
				'type'  => 'switch',
				'value' => 'right',
				'label' => esc_html__('Sidebar Position', 'couponhut'),
				'left-choice' => array(
					'value' => 'left',
					'label' => esc_html__('Left', 'couponhut'),
				),
				'right-choice' => array(
					'value' => 'right',
					'label' => esc_html__('Right', 'couponhut'),
				),
			),
			'post-content-switch' => array(
				'type'  => 'switch',
				'value' => 'content',
				'label' => esc_html__('Blog Post Content or Excerpt', 'couponhut'),
				'left-choice' => array(
					'value' => 'content',
					'label' => esc_html__('Content', 'couponhut'),
				),
				'right-choice' => array(
					'value' => 'excerpt',
					'label' => esc_html__('Excerpt', 'couponhut'),
				),
			),
			'header-search-image' => array(
				'label' => esc_html__( 'Header Search Image', 'couponhut' ),
				'desc'  => esc_html__( 'Upload the logo image', 'couponhut' ),
				'type'  => 'upload',
				'images_only' => true
			),
			'custom-css' => array(
				'type'  => 'textarea',
				'value' => '',
				'label' => esc_html__('Custom CSS', 'couponhut'),
				'desc'  => esc_html__('Paste your custom CSS here.', 'couponhut'),
			)
		)
	),
	'colors' => array(
		'title'   => __( 'Colors', 'couponhut' ),
		'type'    => 'tab',
		'options' => array(
			'color-main' => array(
				'type'  => 'color-picker',
				'value' => '#EF6464',
				'label' => esc_html__('Main Color', 'couponhut'),
				'desc' => esc_html__('Default: #EF6464', 'couponhut'),
			),
			
			'color-secondary' => array(
				'type'  => 'color-picker',
				'value' => '#84CC76',
				'label' => esc_html__('Secondary Color', 'couponhut'),
				'desc' => esc_html__('Default: #84CC76', 'couponhut'),
			),
			'color-secondary-light' => array(
				'type'  => 'color-picker',
				'value' => '#a5da9b',
				'label' => esc_html__('Secondary Color Light', 'couponhut'),
				'desc' => esc_html__('Default: #a5da9b', 'couponhut'),
			),
			'color-fill' => array(
				'type'  => 'color-picker',
				'value' => '#F7C842',
				'label' => esc_html__('Fill Color', 'couponhut'),
				'desc' => esc_html__('Default: #F7C842', 'couponhut'),
			)
		)
	),
	'deals' => array(
		'title'   => __( 'Deals', 'couponhut' ),
		'type'    => 'tab',
		'options' => array(
			'box-submit' => array(
				'title'   => __( 'Deal Submit', 'couponhut' ),
				'type' => 'box',
				'options' => array(
					'new-deal-email' => array(
						'label' => esc_html__( 'New Deal Email', 'couponhut' ),
						'desc'  => esc_html__( 'Enter the email that the new deal confirmation emails will be send', 'couponhut' ),
						'type'  => 'text',
						'value' => ''
					),
					'member-submit-switch' => array(
						'type'  => 'switch',
						'value' => false,
						'label' => esc_html__('Allow Deal Submit Without Registration', 'couponhut'),
						'left-choice' => array(
							'value' => false,
							'label' => esc_html__('No', 'couponhut'),
						),
						'right-choice' => array(
							'value' => true,
							'label' => esc_html__('Yes', 'couponhut'),
						),
					),
					'member-submit-without-company-switch' => array(
						'type'  => 'switch',
						'value' => false,
						'label' => esc_html__('Allow Deal Submit for Registered Users without Company', 'couponhut'),
						'left-choice' => array(
							'value' => false,
							'label' => esc_html__('No', 'couponhut'),
						),
						'right-choice' => array(
							'value' => true,
							'label' => esc_html__('Yes', 'couponhut'),
						),
					),
					'company-register-switch' => array(
						'type'  => 'switch',
						'value' => false,
						'label' => esc_html__('Show register as a Company field on registration.', 'couponhut'),
						'desc' => __('Make sure that you have checked "Enable registration on the "My Account" page" in WooCOmmerce > Settings > Account.', 'couponhut'),
						'left-choice' => array(
							'value' => false,
							'label' => esc_html__('No', 'couponhut'),
						),
						'right-choice' => array(
							'value' => true,
							'label' => esc_html__('Yes', 'couponhut'),
						),
					)
				)
			),
			'box-wooommerce' => array(
				'title'   => __( 'WooCommerce Integration', 'couponhut' ),
				'type' => 'box',
				'options' => array(
					'woocommerce-switch' => array(
						'type'  => 'multi-picker',
						'label' => false,
						'desc'  => false,
						'value' => array(
							'woocommerce-picker' => 'no',
							'yes' => array(
								'checkout-switch' => 'no',
								'autocomplete-switch' => 'yes'
							)
	    				),
						'picker' => array(
							'woocommerce-picker' => array(
								'label'   => __('Enable WooCommerce', 'couponhut'),
								'type'    => 'switch',
								'left-choice' => array(
									'value' => 'no',
									'label' => esc_html__('No', 'couponhut'),
								),
								'right-choice' => array(
									'value' => 'yes',
									'label' => esc_html__('Yes', 'couponhut'),
								)
							)
						),
						'choices' => array(
							'yes' => array(
								'checkout-switch' => array(
									'label'   => __('Hide Checkout Billing Fields', 'couponhut'),
									'type'    => 'switch',
									'value'	  => 'no',
									'left-choice' => array(
										'value' => 'no',
										'label' => esc_html__('No', 'couponhut'),
									),
									'right-choice' => array(
										'value' => 'yes',
										'label' => esc_html__('Yes', 'couponhut'),
									)
								),
								'autocomplete-switch' => array(
									'label'   => __('Auto Complete WooCommerce Orders', 'couponhut'),
									'type'    => 'switch',
									'value'	  => 'yes',
									'left-choice' => array(
										'value' => 'no',
										'label' => esc_html__('No', 'couponhut'),
									),
									'right-choice' => array(
										'value' => 'yes',
										'label' => esc_html__('Yes', 'couponhut'),
									)
								),
							)
						),
    					'show_borders' => false,
					)
				)
			),
			'box-ajax' => array(
				'title'   => __( 'AJAX', 'couponhut' ),
				'type' => 'box',
				'options' => array(
					'ajax-switch' => array(
						'type'  => 'switch',
						'value' => false,
						'label' => esc_html__('AJAX Deal Search', 'couponhut'),
						'desc' => esc_html__('Use AJAX for the main deal search page. NOTE: If your widgets doesn\'t update, deactivate and activate the theme again.', 'couponhut'),
						'left-choice' => array(
							'value' => false,
							'label' => esc_html__('No', 'couponhut'),
						),
						'right-choice' => array(
							'value' => true,
							'label' => esc_html__('Yes', 'couponhut'),
						),
					)
				)
			),
			'box-geolocation' => array(
				'title'   => __( 'Geolocation', 'couponhut' ),
				'type' => 'box',
				'options' => array(
					'google-api-key' => array(
					    'type'  => 'text',
					    'value' => '',
					    'label' => __('Google API Key', 'couponhut'),
					    'desc'  => __('You can find more information about acquiring key from <a href="https://developers.google.com/maps/documentation/android-api/signup">here</a>.', 'couponhut'),
					),
					'geolocation-switch' => array(
						'type'  => 'switch',
						'value' => true,
						'label' => esc_html__('Deals Geolocation', 'couponhut'),
						'desc' => esc_html__('Show Country and City search options.', 'couponhut'),
						'left-choice' => array(
							'value' => false,
							'label' => esc_html__('No', 'couponhut'),
						),
						'right-choice' => array(
							'value' => true,
							'label' => esc_html__('Yes', 'couponhut'),
						),
					),
					'hide-country' => array(
						'type'  => 'switch',
						'value' => false,
						'label' => esc_html__('Hide Country Search Field', 'couponhut'),
						'desc' => esc_html__('Note: Geolocation must be set to "Yes".', 'couponhut'),
						'left-choice' => array(
							'value' => false,
							'label' => esc_html__('No', 'couponhut'),
						),
						'right-choice' => array(
							'value' => true,
							'label' => esc_html__('Yes', 'couponhut'),
						),
					),
					'default-location-lat'    => array(
						'label' => esc_html__( 'Center location field - Latitude', 'couponhut' ),
						'type'  => 'text',
						'value' => ''
					),
					'default-location-lng'    => array(
						'label' => esc_html__( 'Center location field - Longitude', 'couponhut' ),
						'type'  => 'text',
						'value' => '',
						'desc' => esc_html__( 'For example. Melbourne is Lat: -37.77, Lng: 144.96', 'couponhut' ),
					),
				)
			),
			'box-membership' => array(
				'title'   => __( 'Deal Submit', 'couponhut' ),
				'type' => 'box',
				'options' => array(
					'member-only-show-switch' => array(
						'type'  => 'switch',
						'value' => false,
						'label' => esc_html__('Show Registered Members Only Deals', 'couponhut'),
						'desc'  => esc_html__('Show "Registered Members Only" Deals and prompt user to register on click.', 'couponhut'),
						'left-choice' => array(
							'value' => false,
							'label' => esc_html__('No', 'couponhut'),
						),
						'right-choice' => array(
							'value' => true,
							'label' => esc_html__('Yes', 'couponhut'),
						),
					),
					'member-allow-edit' => array(
						'type'  => 'switch',
						'value' => false,
						'label' => esc_html__('Allow members to edit their submitted deals', 'couponhut'),
						'left-choice' => array(
							'value' => false,
							'label' => esc_html__('No', 'couponhut'),
						),
						'right-choice' => array(
							'value' => true,
							'label' => esc_html__('Yes', 'couponhut'),
						),
					),
				)
			),
			'box-presentation' => array(
				'title'   => __( 'Deal Presentation', 'couponhut' ),
				'type' => 'box',
				'options' => array(
					'popup-coupons-switch' => array(
						'type'  => 'switch',
						'value' => false,
						'label' => esc_html__('Show Coupons Only As Pop Up.', 'couponhut'),
						'desc'  => esc_html__('Coupon deals show only popup and Discount deals redirect when clicked. Do not show single deal pages. Works only if WooCommerce is disabled.', 'couponhut'),
						'left-choice' => array(
							'value' => false,
							'label' => esc_html__('No', 'couponhut'),
						),
						'right-choice' => array(
							'value' => true,
							'label' => esc_html__('Yes', 'couponhut'),
						),
					),
					'stamp-switch' => array(
						'type'  => 'switch',
						'value' => 'show',
						'label' => esc_html__('Show Deal Discount Stamp', 'couponhut'),
						'left-choice' => array(
							'value' => 'hide',
							'label' => esc_html__('Hide', 'couponhut'),
						),
						'right-choice' => array(
							'value' => 'show',
							'label' => esc_html__('Show', 'couponhut'),
						),
					),
					'rating-switch' => array(
						'type'  => 'switch',
						'value' => 'show',
						'label' => esc_html__('Show Deal Rating', 'couponhut'),
						'left-choice' => array(
							'value' => 'hide',
							'label' => esc_html__('Hide', 'couponhut'),
						),
						'right-choice' => array(
							'value' => 'show',
							'label' => esc_html__('Show', 'couponhut'),
						),
					),
					'download-coupon-switch' => array(
						'type'  => 'switch',
						'value' => false,
						'label' => esc_html__('Show Download Coupon Link', 'couponhut'),
						'desc'  => esc_html__('Show download coupon as image link next to the Print button on a single deal page.', 'couponhut'),
						'left-choice' => array(
							'value' => false,
							'label' => esc_html__('Hide', 'couponhut'),
						),
						'right-choice' => array(
							'value' => true,
							'label' => esc_html__('Show', 'couponhut'),
						),
					),
					'deal-sales-switch' => array(
						'type'  => 'switch',
						'value' => true,
						'label' => esc_html__('Show Deal Sales and Views', 'couponhut'),
						'desc'  => esc_html__('Shows the deal sales (or times redeemed) and views above the deal content.', 'couponhut'),
						'left-choice' => array(
							'value' => false,
							'label' => esc_html__('Hide', 'couponhut'),
						),
						'right-choice' => array(
							'value' => true,
							'label' => esc_html__('Show', 'couponhut'),
						),
					),
				)
			),
			'box-browse' => array(
				'title'   => __( 'Deal Browsing', 'couponhut' ),
				'type' => 'box',
				'options' => array(
					'deals-per-page' => array(
						'type'  => 'slider',
						'value' => -1,
						'properties' => array(
							'min' => -1,
							'max' => 60,
							'sep' => 1,
						),
						'label' => esc_html__('Deals Per Page', 'couponhut'),
						'desc'  => esc_html__('Deals per page when browsing and filtering deals. Select -1 for unlimited.', 'couponhut'),
					),
					'order-categories' => array(
						'type'  => 'select',
						'value' => 'name',
						'label' => esc_html__('Order Categories By', 'couponhut'),
						'choices' => array(
							'name' => esc_html__('Category Name', 'couponhut'),
							'count' => esc_html__('Offers Count', 'couponhut'),
						)
					),
					'deals-per-page-in-categories' => array(
						'type'  => 'slider',
						'value' => 10,
						'properties' => array(
							'min' => -1,
							'max' => 60,
							'sep' => 1,
						),
						'label' => esc_html__('Deals Per Page in Category/Company View', 'couponhut'),
						'desc'  => esc_html__('Deals per page when browsing a Category. ', 'couponhut'),
					),
					'sort-deals-tab' => array(
						'type'  => 'select-multiple',
						'value' => array( 'rating', 'expiring', 'popular', 'newest', 'viewed' ),
						'label' => esc_html__('Tabs To Display On Browsing Page', 'couponhut'),
						'desc'  => esc_html__('Use Ctrl + Click to select multiple.', 'couponhut'),
						'choices' => array(
							'rating' => esc_html__('Most Appreciated', 'couponhut'),
							'expiring' => esc_html__('Expiring', 'couponhut'),
							'popular' => esc_html__('Popular', 'couponhut'),
							'newest' => esc_html__('Newest', 'couponhut'),
							'viewed' => esc_html__('Most Viewed', 'couponhut'),
						),
					),
					'default-sort-deals-tab' => array(
						'type'  => 'select',
						'value' => 'newest',
						'label' => esc_html__('Default Sorting Tab On Browsing Page', 'couponhut'),
						'choices' => array(
							'rating' => esc_html__('Most Appreciated', 'couponhut'),
							'expiring' => esc_html__('Expiring', 'couponhut'),
							'popular' => esc_html__('Popular', 'couponhut'),
							'newest' => esc_html__('Newest', 'couponhut'),
							'viewed' => esc_html__('Most Viewed', 'couponhut'),
						),
					)
				)
			)
		)
	),
	'typography' => array(
		'title'   => __( 'Typography', 'couponhut' ),
		'type'    => 'tab',
		'options' => array(
			'heading_font'  => array(
				'type'  => 'typography-v2',
				'family' => 'Josefin Sans',
				'variation'  => '600',
				'components' => array(
					'family'         => true,
					'size'           => false,
					'line-height'    => false,
					'letter-spacing' => false,
					'color'          => false,
					),
				'label' => esc_html__('Heading Font', 'couponhut'),
			),
			'body_font'  => array(
				'type'  => 'typography-v2',
				'family' => 'Lato',
				'variation'  => 'regular',
				'components' => array(
					'family'         => true,
					'size'           => false,
					'line-height'    => false,
					'letter-spacing' => false,
					'color'          => false,
					),
				'label' => esc_html__('Body Font', 'couponhut'),
			),
		)
	),
	'text' => array(
		'title'   => __( 'Text Strings', 'couponhut' ),
		'type'    => 'tab',
		'options' => array(
			'show-code-text'    => array(
				'label' => esc_html__( 'Show Code Button Text', 'couponhut' ),
				'type'  => 'text',
				'value' => 'Show Code'
			),
			'buy-now-text'    => array(
				'label' => esc_html__( 'Buy Now Button Text', 'couponhut' ),
				'type'  => 'text',
				'value' => 'Buy Now'
			),
			'print-text'    => array(
				'label' => esc_html__( 'Print Deal Button Text', 'couponhut' ),
				'type'  => 'text',
				'value' => 'Print Coupon'
			),
			'deals-remaining-text'    => array(
				'label' => esc_html__( 'Deals Remaining Text', 'couponhut' ),
				'desc'  => esc_html__( 'HTML tags allowed. In the place of the number, insert "%s" without the quotes.', 'couponhut' ),
				'type'  => 'text',
				'value' => 'Only <strong>%s</strong> Deals Remaining'
			),
		),
	),
	'social' => array(
		'title'   => __( 'Connect & Social', 'couponhut' ),
		'type'    => 'tab',
		'options' => array(
			'twitter_section' => array(
				'title'   => __( 'Twitter', 'couponhut' ),
				'type'    => 'box',
				'options' => array(

					'consumer_key'    => array(
						'type'     => 'text',
						'label'    => esc_html__( 'Consumer Key', 'couponhut' ),
						'desc'     => esc_html__( 'Note: You can find the Consumer Key in the Application -> Keys and Access Tokens -> Application Settings.', 'couponhut' ),
						),
					'consumer_secret'    => array(
						'type'     => 'text',
						'label'    => esc_html__( 'Consumer Secret', 'couponhut' ),
						'desc'     => esc_html__( 'Note: You can find the Consumer Secret in the Application -> Keys and Access Tokens -> Application Settings.', 'couponhut' ),
						),
					'access_token'    => array(
						'type'     => 'text',
						'label'    => esc_html__( 'Access Token', 'couponhut' ),
						'desc'     => esc_html__( 'Note: You can find the Access Token in the Application -> Keys and Access Tokens -> Your Access Token.', 'couponhut' ),
						),
					'access_token_secret'    => array(
						'type'     => 'text',
						'label'    => esc_html__( 'Access Token Secret', 'couponhut' ),
						'desc'     => esc_html__( 'Note: You can find the Access Token Secret in the Application -> Keys and Access Tokens -> Your Access Token.', 'couponhut' ),
						),
					)
				),//twitter_section

			'mailchimp_section' => array(
				'title'   => __( 'Mailchimp', 'couponhut' ),
				'type'    => 'box',
				'options' => array(

					'mailchimp_api_key'    => array(
						'type'  => 'text',
						'label' => esc_html__( 'API Key', 'couponhut' ),
						'desc'  => esc_html__( 'Write your Mailchimp API key.', 'couponhut' ),
						'value' => ''
					),
					'mailchimp_list_id' => array(
						'type'  => 'text',
						'label' => esc_html__( 'Mailchimp Subscription List ID', 'couponhut' ),
						'desc'  => esc_html__( 'The Mailchimp Subscription List ID that you want the users to be subscribed to.', 'couponhut' ),
						'value' => ''
					)
				)
			), //mailchimp_section
		),
	), //social
);