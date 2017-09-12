<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * Filters and Actions
 */


if ( ! function_exists( '_action_ssd_theme_setup' ) ) {
	function _action_ssd_theme_setup() {

		/*
		 * Make Theme available for translation.
		 */
		load_theme_textdomain( 'couponhut', get_template_directory() . '/lang' );

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'title-tag' );
		add_image_size( 'ssd_deal-thumb', 400, 470, true );
        add_image_size( 'ssd_blog-thumb', 420, 280, true );
        add_image_size( 'ssd_single-post-image', 1950, 1050, true );
        add_image_size( 'ssd_company-logo', 440, 200, true );
        add_image_size( 'ssd_half-image', 1200, 1500, true );
        add_image_size( 'ssd_widget-bgimage', 400, 800, true );


		set_post_thumbnail_size( 50, 50, true );

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption'
			) );

		if ( ! isset( $content_width ) ) {
			$content_width = 1200;
		}

	}
}
add_action( 'init', '_action_ssd_theme_setup' );

/**
*  Declare theme supports. These are used by the Subsolar Designs Extras plugin to
*  register the needed custom post types and widgets for the theme. If the plugin is activated
* on nonSubsoalr Designs theme, it will activate everything.
*/

if(!( function_exists('_action_ssd_declare_theme_support') )){
	function _action_ssd_declare_theme_support() {
		add_theme_support('subsolar-theme');
		add_theme_support('subsolar-deal');
	}
	add_action('after_setup_theme', '_action_ssd_declare_theme_support', 10);
}

/**
 * Register widget areas.
 */
if(!( function_exists('_action_ssd_theme_widgets_init') )){
	function _action_ssd_theme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Widget Area', 'couponhut' ),
		'id'            => 'sidebar-main',
		'description'   => esc_html__( 'Appears in the sidebar section of the site.', 'couponhut' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
		) );
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar Widget Area', 'couponhut' ),
		'id'            => 'sidebar-blog',
		'description'   => esc_html__( 'Appears in the sidebar section of the blog page.', 'couponhut' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div><!-- end widget -->',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
		) );

	// Footer Columns
	register_sidebar(
		array(
			'id' => 'footer1',
			'name' => esc_html__( 'Footer Column 1', 'couponhut' ),
			'description' => esc_html__( 'If this is set, your footer will be 1 column', 'couponhut' ),
			'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
			'after_widget' => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
			)
		);
	register_sidebar(
		array(
			'id' => 'footer2',
			'name' => esc_html__( 'Footer Column 2', 'couponhut' ),
			'description' => esc_html__( 'If this and Footer Column 1 are set, your footer will be 2 columns.', 'couponhut' ),
			'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
			'after_widget' => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
			)
		);	
	register_sidebar(
		array(
			'id' => 'footer3',
			'name' => esc_html__( 'Footer Column 3', 'couponhut' ),
			'description' => esc_html__( 'If this Footer Column 1 and Footer Column 2 are set, your footer will be 3 columns.', 'couponhut' ),
			'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
			'after_widget' => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
			)
		);
	register_sidebar(
		array(
			'id' => 'footer4',
			'name' => esc_html__( 'Footer Column 4', 'couponhut' ),
			'description' => esc_html__( 'If this Footer Column 1, Footer Column 2 and Footer Column 3 are set, your footer will be 4 columns.', 'couponhut' ),
			'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
			'after_widget' => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
			)
		);
}
}


add_action( 'widgets_init', '_action_ssd_theme_widgets_init' );

/**
*  JS Check
*/
if( !( function_exists('_action_ssd_html_js_class') ) ){
	function _action_ssd_html_js_class () {
		echo '<script>document.documentElement.className = document.documentElement.className.replace("no-js","js");</script>'. "\n";
	}
}

add_action( 'wp_head', '_action_ssd_html_js_class', 1 );

/**
*  AJAX
*/

add_action( 'wp_ajax_nopriv__action_ssd_post_like', '_action_ssd_post_like' );
add_action( 'wp_ajax__action_ssd_post_like', '_action_ssd_post_like' );

if( !( function_exists('_action_ssd_post_like')) ){
	function _action_ssd_post_like() {
	    // Check for nonce security

		if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
			die ( 'Busted!');

		if(isset($_POST['post_like'])) {
	        // Retrieve user IP address
			if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] != '') {
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} else {
				$ip = $_SERVER['REMOTE_ADDR'];
			}
			$post_id = $_POST['post_id'];

	        	// Get voters'IPs for the current post
			$meta_IP = get_post_meta($post_id, "voted_IP");
			if( isset($meta_IP[0]) ) {
				$voted_IP = $meta_IP[0];
			} else {
				$voted_IP = array();
			}

			// Get votes count for the current post
			$votes_count = get_post_meta($post_id, "votes_count", true);

			if(!is_array($voted_IP)) {
				$voted_IP = array();
			}

	        // User has already voted ?
			if(!$fw_ssd_has_already_voted($post_id)) {
	            // Save IP and increase votes count
				update_post_meta($post_id, "voted_IP", sanitize_text_field($voted_IP));
				update_post_meta($post_id, "votes_count", sanitize_text_field(++$votes_count));

	            // Display count (ie jQuery return value)
				echo $votes_count;
			}
			else
				echo "already";
		}
		die();
	}
}


add_action( 'wp_ajax_nopriv__action_ssd_post_rate', '_action_ssd_post_rate' );
add_action( 'wp_ajax__action_ssd_post_rate', '_action_ssd_post_rate' );

if( !( function_exists('_action_ssd_post_rate')) ){
	function _action_ssd_post_rate() {

	    // Check for nonce security
		$nonce = $_POST['nonce'];

		if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
			die ( 'Busted!');

		if(isset($_POST['post_rate'])) {
	        // Retrieve user IP address
			if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] != '') {
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} else {
				$ip = $_SERVER['REMOTE_ADDR'];
			}
			$post_id = $_POST['post_id'];

	        // Get voters'IPs for the current post
			$meta_IP = get_post_meta($post_id, "voted_IP");
			if( isset($meta_IP[0]) ) {
				$voted_IP = $meta_IP[0];
			} else {
				$voted_IP = array();
			}

			// Get votes count for the current post
			$rating = $_POST['rating'];
			$rating_field = 'rating_count_' . $rating;

			$ratings_count = get_post_meta($post_id, $rating_field, true);
			$rating_count_total = get_post_meta($post_id, "rating_count_total", true);

			if(!is_array($voted_IP)) {
				$voted_IP = array();
			}

	        // User has already voted ?
			if(!fw_ssd_has_already_voted($post_id)) {

				$return = array();
				$voted_IP[$ip] = time();

	            // Save IP and increase votes count
				update_post_meta($post_id, "voted_IP", $voted_IP);
				update_post_meta($post_id, $rating_field, sanitize_text_field(++$ratings_count) );

				update_post_meta($post_id, "rating_count_total", sanitize_text_field(++$rating_count_total) );

				$stars_total = 0;
				$votes_num = 0;

				for ( $i = 1; $i <= 5; $i++ ) {
					$rating_field = 'rating_count_' . $i;
					$ratings_count = get_post_meta($post_id, $rating_field, true);
					$stars_total += $i * $ratings_count;

					$votes_num += $ratings_count; 
				}

				update_post_meta($post_id, 'stars_total', sanitize_text_field($stars_total) );

				$rating_average = $stars_total / $votes_num;
				$rating_average = number_format((float)$rating_average, 2, '.', '');

				update_post_meta($post_id, "rating_average", sanitize_text_field($rating_average) );

	            	// The array containing the printable stars in the front end
				$stars_array = array();

				for ( $i = 0; $i <= 4; $i++ ) {

					if ( $rating_average >= ( $i + 0.75 ) ) {
						$stars_array[$i] = 'full';
					} else if ( $rating_average >= ( $i + 0.25 ) ) {
						$stars_array[$i] = 'half';
					} else {
						$stars_array[$i] = 'empty';
					}

				}

				$return['average'] = $rating_average;
				$return['rating_count_total'] =get_post_meta($post_id, 'rating_count_total');
				$return['stars'] = $stars_array;

				echo json_encode($return);
			}
			else
				echo "already";
		}
		die();
	}
}



/**
*  AJAX show cities on Country Dropdown select
*/

add_action( 'wp_ajax_nopriv__action_ssd_show_cities', '_action_ssd_show_cities' );
add_action( 'wp_ajax__action_ssd_show_cities', '_action_ssd_show_cities' );

if( !( function_exists('_action_ssd_show_cities')) ){
	function _action_ssd_show_cities() {

		$deal_country_slug = $_POST['country'] ?  sanitize_title($_POST['country']) : '';
		$deal_city_slug = $_POST['city'] ?  sanitize_title($_POST['city']) : '';

		$cities = array();
		
		if( ( $all_locations = get_transient('ssd_all_locations') ) === false ) {	
			$all_locations = fw_ssd_get_all_locations();
			set_transient('ssd_all_locations', $all_locations, 0);
		}

		$html ='';

		// If cities are found create cities dropdown list
		if ( fw_ssd_get_option('hide-country') ) {
			$cities = $all_locations['all_cities'];
		} else if (isset($all_locations[$deal_country_slug])) {
			$cities = $all_locations[$deal_country_slug];
		}
		if ( !empty($cities) ) {

			$cities_found = true;

			$html .= '<li><a href="javascript:void(0)" data-value="" data-current="">' . esc_html__('None', 'couponhut') . '</a href="javascript:void(0)"></li>';

			foreach ( $cities as $city ) {
				if ( $city['slug'] != '' && $city['slug'] ==  $deal_city_slug ) {
					$current = 'true';
				} else {
					$current = 'false';
				}

				$html .= '<li><a href="javascript:void(0)" data-value="' . $city['slug'] . '" data-current="' . $current . '">' . $city['name'] . '</a></li>';
			}

		} else {
			$cities_found = false;

			$html .= '<li><a href="javascript:void(0)" data-value="" data-current="">' . esc_html__('None', 'couponhut') . '</a href="javascript:void(0)"></li>';
			$html .= '<li class="select-country-first"><a href="javascript:void(0)">' . esc_html__('Please select a country', 'couponhut') . '</a></li>';
		}

		$response = array(
			'html' => $html,
			'cities_found' => $cities_found
		);

		echo json_encode($response);


		die();
	}
}



/**
*  AJAX Deal Button Clicked
*/

add_action( 'wp_ajax_nopriv__action_ssd_deal_clicked', '_action_ssd_deal_clicked' );
add_action( 'wp_ajax__action_ssd_deal_clicked', '_action_ssd_deal_clicked' );

if( !( function_exists('_action_ssd_deal_clicked')) ){
	function _action_ssd_deal_clicked() {

		 // Check for nonce security
		$nonce = $_POST['nonce'];

		if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
			die ( 'Busted!');

		$post_id = $_POST['post_id'];

		$count = get_post_meta($post_id, 'ssd_post_button_clicks_count', true);

		if( $count == '' ){
			delete_post_meta($post_id, 'ssd_post_button_clicks_count');
			add_post_meta($post_id, 'ssd_post_button_clicks_count', 1);
		} else{
			$count++;
			update_post_meta($post_id, 'ssd_post_button_clicks_count', $count);
		}

		

		$woocommerce_enable = fw_ssd_get_option('woocommerce-switch');

		if( couponhut_get_field('limited_deal') == 'yes' && $woocommerce_enable['woocommerce-picker'] == 'yes' && !empty(couponhut_get_field('woocommerce_price')) && couponhut_get_field('show_pricing_fields') ) { 

			$limited_deal = true;

			$deals_available = get_post_meta($post_id, 'deals_available', true);
		}

		$response = array(
			'limited_deal' => $limited_deal,
			'deals_available_after' => $deals_available,
			'url' => $url,
		);

		echo json_encode($response);

		die();
	}
}


/**
 *  Hide not needed Unyson Extensions
 */

if (defined('FW')):

	if( !( function_exists('_action_ssd_hide_extensions_from_the_list')) ){
		function _action_ssd_hide_extensions_from_the_list() {

			if (fw_current_screen_match(array('only' => array('id' => 'toplevel_page_fw-extensions')))) {
				echo '
				<style type="text/css">
				#fw-ext-analytics, #fw-ext-megamenu, #fw-ext-portfolio, #fw-ext-styling, #fw-ext-seo, #fw-ext-feedback, #fw-ext-events, #fw-ext-learning, #fw-ext-social, #fw-ext-translation, #fw-ext-slider, #fw-ext-sidebars, fw-ext-backup { display: none !important; }
				</style>';
			}
		}
	}
	
	add_action('admin_print_scripts', '_action_ssd_hide_extensions_from_the_list');
	endif;

/**
*  Unyson Builder Templates
*/

add_filter(
    'fw_ext_builder:predefined_templates:page-builder:full',
    '_filter_ssd_page_builder_predefined_templates_full'
);

if( !( function_exists('_filter_ssd_page_builder_predefined_templates_full')) ){
	function _filter_ssd_page_builder_predefined_templates_full($templates) {

		$variables = fw_get_variables_from_file(
			get_template_directory() .'/inc/includes/builder-templates/full.php',
			array('templates' => array())
			);

		return array_merge($templates, $variables['templates']);
	}
}



/**
 *  Remove default sliders from Slider Extension
 */

if( !( function_exists('_filter_ssd_theme_flush_rewrite')) ){
	function _filter_ssd_theme_flush_rewrite(){ 

		flush_rewrite_rules() ;
	}
}


add_filter( 'fw_ext_backup_after_import_demo_content' , '_filter_ssd_theme_flush_rewrite');


/**
 *  Remove default Shortcodes
 */

if (defined('FW')):

	if( !( function_exists('_filter_ssd_disable_default_shortcodes')) ){
		function _filter_ssd_disable_default_shortcodes($to_disable) {
			$to_disable = array( 'calendar', 'icon', 'map', 'special_heading', 'table', 'team_member', 'testimonials', 'contact_form', 'widget_area', 'call_to_action');
			return $to_disable;
		}
	}

	add_filter('fw_ext_shortcodes_disable_shortcodes', '_filter_ssd_disable_default_shortcodes');

	endif;

/**
*  Save Unyson settings in Wordpress so that they can be used before Unyson is initialized
*/

if( !( function_exists('_action_ssd_save_unyson_settings')) ){
	function _action_ssd_save_unyson_settings() {

		if ( fw_ssd_get_option('member-submit-without-company-switch') ) {
			update_option('unyson-member-submit-without-company-switch', true);
		}
	}
}

add_action('fw_settings_form_saved', '_action_ssd_save_unyson_settings');

/**
*  ACF Save JSON
*/

if( !( function_exists('_filter_ssd_acf_json_save_point')) ){
	function _filter_ssd_acf_json_save_point( $path ) {

		$path = get_template_directory() . '/acf-json';
		return $path;

	}
}

add_filter('acf/settings/save_json', '_filter_ssd_acf_json_save_point');

/**
*  ACF Load JSON
*/

if( !( function_exists('_filter_ssd_acf_json_load_point')) ){
	function _filter_ssd_acf_json_load_point( $paths ) {

		unset($paths[0]);
		$paths[] = get_stylesheet_directory() . '/acf-json';
		return $paths;

	}
}

add_filter('acf/settings/load_json', '_filter_ssd_acf_json_load_point');

/**
*  ACF Localization
*/

if( !( function_exists('_filter_ssd_acf_localization')) ){
	function _filter_ssd_acf_localization() {
		return 'couponhut';
	}
}

add_filter('acf/settings/l10n_textdomain', '_filter_ssd_acf_localization');

if( !( function_exists('_filter_ssd_acf_localization_fields')) ){	
	function _filter_ssd_acf_localization_fields() {
		return array('label', 'instructions', 'choices', 'message');
	}
}

add_filter('acf/settings/l10n_field', '_filter_ssd_acf_localization_fields');


/**
*  ACF Google Maps API
*/

add_filter('acf/fields/google_map/api', '_filter_ssd_acf_google_api_key');

if( !( function_exists('_filter_ssd_acf_google_api_key')) ){
	function _filter_ssd_acf_google_api_key($api) {
		$api['key'] = fw_ssd_get_option('google-api-key');
		return $api;
	}
}




/**
*  ACF Geolocation Default
*/

if( !( function_exists('_filter_ssd_geolocation_default')) ){	
	function _filter_ssd_geolocation_default($field) {

		if ( is_numeric(fw_ssd_get_option('default-location-lat')) ) {
			$field['center_lat'] = fw_ssd_get_option('default-location-lat');
		}
		if ( is_numeric(fw_ssd_get_option('default-location-lng')) ) {
			$field['center_lng'] = fw_ssd_get_option('default-location-lng');
		}
		
		return $field;
	}
}

add_filter('acf/load_field/name=location', '_filter_ssd_geolocation_default');


/**
*  ACF Geolocation Saving
*/

if( !( function_exists('_action_ssd_save_geolocation_meta')) ){	
	function _action_ssd_save_geolocation_meta($post_id) {

		fw_ssd_save_post_geolocation($post_id);

		$all_countries = fw_ssd_get_all_countries();
		set_transient('ssd_all_countries', $all_countries, 0);

		$all_locations = fw_ssd_get_all_locations();
		set_transient('ssd_all_locations', $all_locations, 0);
	}
}

add_action('acf/save_post', '_action_ssd_save_geolocation_meta', 20);



/**
*  ACF Geolocation Save All Posts
*/

if( !( function_exists('_action_ssd_all_posts_save_geolocation_meta')) ){	
	function _action_ssd_all_posts_save_geolocation_meta() {

		if ( get_option('all_posts_geo_saved_v4') != 'yes' ) {

			$args = array(
				'post_type' => 'deal',
				'posts_per_page' => -1
				);

			$deals_query = new WP_Query($args);

			if ($deals_query->have_posts()) : while ($deals_query->have_posts()) : $deals_query->the_post();

			fw_ssd_save_post_geolocation(get_the_ID());

			endwhile;
			wp_reset_postdata();
			endif;

			$all_countries = fw_ssd_get_all_countries();
			set_transient('ssd_all_countries', $all_countries, 0);

			$all_locations = fw_ssd_get_all_locations();
			set_transient('ssd_all_locations', $all_locations, 0);

			update_option( 'all_posts_geo_saved_v4', 'yes' );
		}

	}
}


add_action('after_setup_theme', '_action_ssd_all_posts_save_geolocation_meta', 20);


/**
*  ACF Show in Admin
*/

//add_filter('acf/settings/show_admin', '__return_false');

/**
*  ACF Show Updates
*/

//add_filter('acf/settings/show_updates', '__return_false');


/**
*  Unyson Icon Select Field
*/

if( !( function_exists('_action_ssd_include_custom_option_types')) ){	
	function _action_ssd_include_custom_option_types() {
	    require_once get_template_directory() . '/inc/includes/option-types/icon-select/class-fw-option-type-icon-select.php';
	}
}

add_action('fw_option_types_init', '_action_ssd_include_custom_option_types');


/**
*  Google Fonts Link in Header
*/

if(!function_exists('_action_ssd_process_google_fonts')) {
	function _action_ssd_process_google_fonts()
	{
		$include_from_google = array();
		$google_fonts = fw_get_google_fonts();

		$body_font = fw_get_db_settings_option('body_font');
		$heading_font = fw_get_db_settings_option('heading_font');
		$monospace_font = fw_get_db_settings_option('monospace_font');

        // if is google font
		if( isset($google_fonts[$body_font['family']]) ){
			$include_from_google[$body_font['family']] =  $google_fonts[$body_font['family']];
		}

		if( isset($google_fonts[$heading_font['family']]) ){
			$include_from_google[$heading_font['family']] =  $google_fonts[$heading_font['family']];
		}

		if( isset($google_fonts[$monospace_font['family']]) ){
			$include_from_google[$monospace_font['family']] =  $google_fonts[$monospace_font['family']];
		}

		$google_fonts_links = fw_ssd_get_remote_fonts($include_from_google);
        // set a option in db for save google fonts link
		update_option( 'fw_ssd_google_fonts_link', $google_fonts_links );
	}
	add_action('fw_settings_form_saved', '_action_ssd_process_google_fonts', 999, 2);
}

/**
*  Print Google Fonts link
*/
if (!function_exists('_action_ssd_print_google_fonts_link')) :
	function _action_ssd_print_google_fonts_link() {
		$google_fonts_link = get_option('fw_ssd_google_fonts_link', '');
		if($google_fonts_link != ''){
			echo $google_fonts_link;
		}
	}
	add_action('wp_head', '_action_ssd_print_google_fonts_link');
endif;


/**
 *  Custom Excerpt More
 */
if( !( function_exists('_filter_ssd_excerpt_more')) ){	
	function _filter_ssd_excerpt_more( $more ) {
		return '...';
	}
}

add_filter('excerpt_more', '_filter_ssd_excerpt_more');


/**
*  Comment Avatar Class
*/
if( !( function_exists('_filter_ssd_avatar_css')) ){
	function _filter_ssd_avatar_css($class) {
		$class = str_replace("class='avatar", "class='avatar media-object", $class) ;
		return $class;
	}
}

add_filter('get_avatar','_filter_ssd_avatar_css');


/**
*  Custom Post Type Search Page
*/
if( !( function_exists('_fitler_ssd_cpt_search_page')) ){
	function _fitler_ssd_cpt_search_page($template) { 

		if (isset($_GET['deal_search']) && $_GET['search_type'] == 'deal' ) {

			$new_template = locate_template( array( 'template-browse-deals.php' ) );
			if ( '' != $new_template ) {
				return $new_template ;
			}
			
		}

		return $template; 
	}
}

add_filter('template_include', '_fitler_ssd_cpt_search_page');


if( !( function_exists('_filter_ssd_alter_search_deals')) ){
	function _filter_ssd_alter_search_deals($query) {

		if ( get_query_var('search') && $post_type = 'deal' ) {
			$url = home_url( add_query_arg( null, null ));
			preg_match('/\/\?(.+)/', $url, $matches);
			$parameters = explode('&', $matches[1]);

			foreach ($parameters as $parameter) {
				$parameter_array = explode('=', $parameter);
				$args[$parameter_array[0]] = $parameter_array[1];
			}

		}

		if ( ($query->is_search) && get_query_var('post_type') == 'deal' ) {
			$query->set('post_type', 'deal');
		}
		return $query;
	}
}

// add_filter('pre_get_posts','_filter_ssd_alter_search_deals');




/**
*  Subscription Widget
*/

add_action('wp_ajax__action_fw_ssd_mailchimp_widget', '_action_fw_ssd_mailchimp_widget');
add_action('wp_ajax_nopriv__action_fw_ssd_mailchimp_widget', '_action_fw_ssd_mailchimp_widget');

if ( !function_exists( '_action_fw_ssd_mailchimp_widget' ) ) {
	function _action_fw_ssd_mailchimp_widget() { 

		$api_key = fw_ssd_get_option('mailchimp_api_key') ? fw_ssd_get_option('mailchimp_api_key') : false;
		$list_id = fw_ssd_get_option('mailchimp_list_id') ? fw_ssd_get_option('mailchimp_list_id') : false;

		if ( !$api_key || !$list_id ) {
			if ( current_user_can( 'edit_theme_options' ) ) {
				$error_msg = esc_html__('Mailchimp API Key or List ID are not set.', 'couponhut');
			} else { 
				$error_msg = esc_html__( "Something went wrong. We couldn't sign you up.", 'couponhut');
			}
			echo '<div class="response-error">' . $error_msg .'</div>';
		}
		else {
			$email = strtolower($_POST['email']);
			
			$Mailchimp = new Mailchimp( $api_key );
			$result = $Mailchimp->call('lists/subscribe', array(
				'id'                => $list_id,
				'email'             => array('email'=> $email ),
				'double_optin'      => false,
				'update_existing'   => false,
				'replace_interests' => false,
				'send_welcome'      => true,
				));

			if( !empty( $result->status ) && 'error' == $result->status ) {
				$error_msg = '';
				if( 'List_AlreadySubscribed' == $result->name)
					$error_msg = esc_html__('Oops! This email address is already subscribed!', 'couponhut');
				elseif( 'Email_NotExists' == $result->name )
					$error_msg = esc_html__('Email address does not exist', 'couponhut');
				elseif( 'List_DoesNotExist' == $result->name )
					$error_msg = current_user_can( 'edit_theme_options' ) ? esc_html__('List does not exist, please choose a valid list.', 'couponhut') : esc_html__( "Something went wrong. We couldn't sign you up.", 'couponhut');
				else
					$error_msg = esc_html__( "Something went wrong. We couldn't sign you up.", 'couponhut');
				// An error ocurred, return error message	
				echo '<div class="alert alert-danger">' . $error_msg .'</div>';

			}else{
				echo '<div class="alert alert-success">' . esc_html__( 'Success! You have signed up.', 'couponhut' ) . '</div>';
				
			}
		}
		die();

	}
}

/**
 * This plugin will fix the problem where next/previous of page number buttons are broken on list
 * of posts in a category when the custom permalink string is:
 * /%category%/%postname%/ 
 * The problem is that with a url like this:
 * /categoryname/page/2
 * the 'page' looks like a post name, not the keyword "page"
 */
if( !( function_exists('remove_page_from_query_string')) ){
	function remove_page_from_query_string($query_string) { 
	    if (isset($query_string['name']) && $query_string['name'] == 'page' && isset($query_string['page'])) {
	        // unset($query_string['name']);
	        // 'page' in the query_string looks like '/2', so i'm spliting it out
	        $pagePart = explode('/', $query_string['page']);
	        $query_string['paged'] = end($pagePart);
	    }
	    return $query_string;
	}
}

// add_filter('request', 'remove_page_from_query_string');

// following are code adapted from Custom Post Type Category Pagination Fix by jdantzer
if( !( function_exists('fix_category_pagination')) ){
	function fix_category_pagination($qs){
		$dummy_query = new WP_Query();  // the query isn't run if we don't pass any query vars
		$dummy_query->parse_query( $qs );

		if( $dummy_query->is_tax() && isset($qs['paged'])){
			$qs['post_type'] = get_post_types($args = array(
				'public'   => true,
				'_builtin' => false
				));
			array_push($qs['post_type'],'post');
		}
		return $qs;
	}
}

// add_filter('request', 'fix_category_pagination');


if( !( function_exists('_filter_ssd_custom_taxonomy_pagination')) ){
	function _filter_ssd_custom_taxonomy_pagination($query) {
		$dummy_query = new WP_Query();  // the query isn't run if we don't pass any query vars
		$dummy_query->parse_query( $query );

		if ( $query->is_tax() && empty($query->query_vars['suppress_filters']) ) {

			if ( fw_ssd_woocommerce() && !is_user_logged_in() && !fw_ssd_get_option('member-only-show-switch') ) {

				$registered_array = array(
					'relation' => 'OR',
					array(
						'key' => 'registered_members_only',
						'value' => false,
						'compare' => '=',
						'type' => 'UNSIGNED'
						),
					array(
						'key' => 'registered_members_only',
						'compare' => 'NOT EXISTS'
						)
					);

				$query->set( 'meta_query', array('relation' => 'AND'));
				$query->set( 'meta_query', $registered_array);
			}


			if ( get_queried_object()->taxonomy == 'deal_category' || get_queried_object()->taxonomy == 'deal_company' ) {
				$posts_per_page = fw_ssd_get_option('deals-per-page-in-categories') ? fw_ssd_get_option('deals-per-page-in-categories') : -1;
			} else {
				$posts_per_page = get_option( 'posts_per_page' );
			}

			$query->set( 'post_type', 'deal');
			$query->set( 'posts_per_page', $posts_per_page);

			return $query;
		}
	}    
}

  

// add_filter('pre_get_posts', '_filter_ssd_custom_taxonomy_pagination');

add_filter( 'option_posts_per_page', '_filter_tax_filter_posts_per_page' );

if( !( function_exists('_filter_tax_filter_posts_per_page')) ){
	function _filter_tax_filter_posts_per_page( $value ) {
		return ( is_tax('deal_category') || is_tax('deal_company') ) ? 1 : $value;
	}
}


/**
*  Front End Deal Submit
*/
if( !( function_exists('_action_ssd_acf_submit_deal')) ){
	function _action_ssd_acf_submit_deal( $post_id ) {

	    $submit_page_id = $_POST['submit_page_id'];

		if( empty($_POST['acf']) ) {
			return $post_id;
		}

	    if ( !isset($_POST['deal_submit']) ) {
	    	return $post_id;
	    }

	    $user_company_name = get_user_meta(get_current_user_id(), 'user_company_name', true);

	    if( empty($user_company_name) && !fw_ssd_get_option('member-submit-switch') ) {
	    	wp_redirect(add_query_arg( 'error', 'company_name', get_permalink($submit_page_id)));
	    	exit;
		}

    	return $post_id;
	   
	}
}

add_action( 'acf/pre_save_post', '_action_ssd_acf_submit_deal', 1 );


/**
*  Front End Deal Submit
*/
if( !( function_exists('_action_ssd_acf_submit_deal_save')) ){
	function _action_ssd_acf_submit_deal_save( $post_id ) {

		if( empty($_POST['acf']) ) {
			return;
		}

	    if ( !isset($_POST['deal_submit']) || !isset($_POST['submit_page_id']) ) {
	    	return;
	    }

	    $submit_page_id = $_POST['submit_page_id'];

	    $user_company_name = get_user_meta(get_current_user_id(), 'user_company_name', true);

	    if( empty($user_company_name) && !fw_ssd_get_option('member-submit-switch') ) {
	    	wp_redirect(add_query_arg( 'error', 'company_name', get_permalink($submit_page_id)));
	    	exit;
		}

		$fields = $_POST['acf'];

		$post = array(
		    'ID'           => $post_id,
		    'post_title'   => $_POST['post_title'],
		    'post_content'   => $_POST['post_content']
		);

		// Update the Post
		wp_update_post( $post );

		// Deal Category
		if ( isset($_POST['post_category']) ) {
			wp_set_object_terms($post_id, $_POST['post_category'], 'deal_category');
		}
		
		// Deal Company
		if ( get_user_meta( get_current_user_id(), 'user_company', true ) == 'yes' ) {
			$user_company_name = get_user_meta(get_current_user_id(), 'user_company_name', true);
			$user_company = get_term_by('name', $user_company_name, 'deal_company');

			if ( isset($user_company->slug) ) {
				wp_set_object_terms($post_id, $user_company->slug, 'deal_company');
			}
		}

		// Deal Information
		$title = $_POST['post_title'];
		$content = $_POST['post_content'];
		$deal_type = isset($fields['field_5519756e0f4e2']) ? $fields['field_5519756e0f4e2'] : '';
		$deal_summary = isset($fields['field_554f8e55b6dd8']) ? $fields['field_554f8e55b6dd8'] : '';
		$coupon_code = isset($fields['field_551976780f4e4']) ? $fields['field_551976780f4e4'] : '';
		$discount_value = isset($fields['field_55016e0911ba1']) ? $fields['field_55016e0911ba1'] : '';
		$url = isset($fields['field_55016e3011ba3']) ? $fields['field_55016e3011ba3'] : '';
		$expiring_date = isset($fields['field_55016e3d11ba4']) ? $fields['field_55016e3d11ba4'] : '';

		$admin_page = admin_url( 'edit.php?post_status=pending&post_type=deal' );

		$message = __( 'New deal has been submited. Here are the details:', 'couponhut' )."\n\n
	".__( 'Deal Name:', 'couponhut' )." {$title}\n\n
	".__( 'Deal Type:', 'couponhut' )." {$deal_type}\n\n
	".__( 'Deal Summary:', 'couponhut' )." {$deal_summary}\n\n
	".__( 'Coupon Code:', 'couponhut' )." {$coupon_code}\n\n
	".__( 'Discount:', 'couponhut' )." {$discount_value}\n\n
	".__( 'Content:', 'couponhut' )." {$content}\n\n
	".__( 'Deal URL:', 'couponhut' )." {$url}\n\n
	".__( 'Expiring Date:', 'couponhut' )." {$expiring_date}\n\n
	".__( 'Please visit your admin dashboard to approve it - ', 'couponhut' )." {$admin_page}";

		$email_to = fw_ssd_get_option('new-deal-email');

		wp_mail( $email_to, __( 'New Deal Submited', 'couponhut' ), $message );
	   
	}
}

add_action( 'acf/save_post', '_action_ssd_acf_submit_deal_save', 20 );


/**
*  Login, Logout, Register In Menu
*/

add_filter( 'wp_nav_menu_items', '_filter_ssd_add_loginout_link', 10, 2 );

if( !( function_exists('_filter_ssd_add_loginout_link')) ){
	function _filter_ssd_add_loginout_link( $nav, $args ) {

		if ( fw_ssd_woocommerce() && fw_ssd_get_option('show-login-switch') == 'show' ) {
			
			$url_user = get_option('woocommerce_myaccount_page_id') ? get_permalink( get_option('woocommerce_myaccount_page_id') ) : '';
		
			$url_login = get_permalink( get_option('woocommerce_myaccount_page_id') ) ? get_permalink( get_option('woocommerce_myaccount_page_id') ) : '';

			$url_logout = wc_get_page_id( 'myaccount' ) ? wp_logout_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ) : '';

			ob_start(); ?>

			<li class="menu-item-has-children menu-item-login-register">
				<?php if ( is_user_logged_in() ) : ?>
					<?php 
					$current_user = wp_get_current_user();
					?>
					<a href="<?php echo $url_user; ?>"><i class='icon-User'></i><?php echo $current_user->user_login; ?></a>
				<?php else: ?>
					<a href="<?php echo $url_login; ?>"><i class='icon-User'></i></a>
				<?php endif; ?>
				<ul class="sub-menu">
					<?php if ( is_user_logged_in() ) : ?>
						<li><a href="<?php echo $url_user; ?>"><?php esc_html_e('Profile', 'couponhut') ?></a></li>
						<?php 

						$allow_no_reg = fw_ssd_get_option('member-submit-switch');
						$allow_no_company = fw_ssd_get_option('member-submit-without-company-switch');
						$show_submit_menu = true;

						if ( fw_ssd_woocommerce() && !is_user_logged_in() && !$allow_no_reg ) {
							$show_submit_menu = false;
						}

						if ( fw_ssd_woocommerce() && is_user_logged_in() && !$allow_no_reg && !get_user_meta( get_current_user_id(), 'user_company_name', true ) && !$allow_no_company  ) {
							$show_submit_menu = false;
						}	


						if ( $show_submit_menu ) :
						?>
						<li><a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')) . 'submitted-deals'; ?>"><?php esc_html_e( 'Submitted Deals', 'couponhut' ); ?></a></li>
						<?php endif; ?>
						<?php 
						$template_id = fw_ssd_get_submit_template_id();
						if ( $template_id && $show_submit_menu ) : ?>
							<li><a href="<?php echo get_permalink($template_id); ?>"><?php esc_html_e('Submit', 'couponhut') ?></a></li>
						<?php endif; ?>
						<li><a href="<?php echo $url_logout; ?>"><?php esc_html_e('Log Out', 'couponhut') ?></a></li>
						<?php elseif ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
						<li><a href="<?php echo $url_login; ?>"><?php esc_html_e('Log In / Register', 'couponhut') ?></a></li>
						<?php else: ?>
						<li><a href="<?php echo $url_login; ?>"><?php esc_html_e('Log In', 'couponhut') ?></a></li>
					<?php endif; ?>
				</ul>
			</li>
			<?php
			$ob_content = ob_get_contents();
			ob_end_clean();
		    return $nav . $ob_content;

		} else {
			return $nav;
		}


	}
}


/**
 * Validate the extra register fields.
 *
 * @param  string $username          Current username.
 * @param  string $email             Current email.
 * @param  object $validation_errors WP_Error object.
 *
 * @return void
 */

add_action( 'init', '_action_ssd_validate_user_company_fields', 30 );

if( !( function_exists('_action_ssd_validate_user_company_fields')) ){
	function _action_ssd_validate_user_company_fields() {

		if ( isset( $_POST['user_company_edit'] ) && '1' == $_POST['user_company_edit'] ) {

			$errors = false;

			if ( !isset($_POST['user_company_name']) || empty($_POST['user_company_name']) ) {

				wc_add_notice( sprintf( esc_html__( 'Error: Company Name is required!', 'couponhut' ) ) ,'error' );

				$errors = true;
			}

			if ( !$errors && isset( $_POST['user_company_name'] ) ) {

				$user_company = get_term_by('name', sanitize_text_field( $_POST['user_company_name'] ), 'deal_company', ARRAY_A);

				if ( $user_company ) {

					// The Query
					$user_query = new WP_User_Query();

					// User Loop
					$found = false;

					$users = get_users();

					if ( ! empty( $users ) ) {
						foreach ( $users as $user ) {
							if ( get_user_meta( $user->ID, 'user_company_name', true) == sanitize_text_field( $_POST['user_company_name'] ) && ( get_current_user_id() != $user->ID ) ) {
								$found = true;
							}
						}
					}

					if ( $found ) {
						wc_add_notice( sprintf( esc_html__( 'Error: A user with the same company name already exists. Please add some additional information to your company name (town or city perhaps) to make it unique.', 'couponhut' ) ) ,'error' );
						$errors = true;
					}

				}

			}

			if ( !$errors ) {

				if ( isset( $_POST['user_company_name'] ) ) {
					// Check if the Company exists, if no - create it
					$user_company = get_term_by('name', sanitize_text_field( $_POST['user_company_name'] ), 'deal_company', ARRAY_A);
					if ( !$user_company ) {

						$company_name = sanitize_text_field( $_POST['user_company_name'] );

						wp_insert_term(
							$company_name,
							'deal_company'
						);
						$user_company = get_term_by('name', $company_name, 'deal_company', ARRAY_A);
					}


					if ( isset( $_POST['user_company_description'] ) ) {
						// Update the top Company with the following description
						wp_update_term($user_company['term_id'], 'deal_company', array(
							'description' => $_POST['user_company_description'],
							));

					}

					if( ! empty( $_FILES ) ) {
						foreach( $_FILES as $file ) {
							if( is_array( $file ) ) {
								$attachment_id = fw_ssd_upload_user_file( $file );
								if ( $attachment_id ) {
									$acf_term = 'deal_company_' . $user_company['term_id'];
									update_field('field_55073707dee91', $attachment_id, $acf_term);
								}
								
							}
						}
					}


					// Insert the company of the user in his meta
					update_user_meta( get_current_user_id(), 'user_company_name', sanitize_text_field( $_POST['user_company_name'] ) );
				}

			}

		}
	}
}


/**
*  Add HTML tags in Taxonomy description
*/

remove_filter( 'pre_term_description', 'wp_filter_kses' );
remove_filter( 'pre_link_description', 'wp_filter_kses' );
remove_filter( 'pre_link_notes', 'wp_filter_kses' );
remove_filter( 'term_description', 'wp_kses_data' );


/**
*  Show Google API Notice
*/

if( !( function_exists('_action_ssd_show_google_api_notice')) ){
	function _action_ssd_show_google_api_notice() {

		global $current_user;

		if ( !fw_ssd_get_option('google-api-key') && !get_user_meta($current_user->ID, 'show_google_api_notice_ignore', true) ) :
		?>
		<div class="error notice">
		    <h2><?php esc_html_e('Warning!', 'couponhut') ?></h2>
			<p><?php esc_html_e('Google recently changed the terms of use of its Google Maps APIs. Please go to the theme options panel and write you Google API Key in the Deals of the panel tab. Otherwise the City and Country geolocation will not work as it should.', 'couponhut') ?></p>
			<p><a href="?show_google_api_notice_ignore"><?php esc_html_e('Dismiss', 'couponhut') ?></a></p>
		</div>
		<?php
		endif;
	}
}

add_action( 'admin_notices', '_action_ssd_show_google_api_notice' );



if( !( function_exists('_action_ssd_show_google_api_notice_ignore')) ){
	function _action_ssd_show_google_api_notice_ignore() {
	
		global $current_user;
		
		if (isset($_GET['show_google_api_notice_ignore'])) {
			
			update_user_meta($current_user->ID, 'show_google_api_notice_ignore', true);
			
		}
		
	}
}


add_action('admin_init', '_action_ssd_show_google_api_notice_ignore');


/**
*  Show Google API Error Notice
*/

if( !( function_exists('_action_ssd_show_google_api_error_notice')) ){
	function _action_ssd_show_google_api_error_notice() {

		if ( get_transient('ssd_google_api_key') !== false ) {
			set_transient('ssd_google_api_key', '', 0);
		}

		global $current_user;


		if ( fw_ssd_get_option('google-api-key') && !get_user_meta($current_user->ID, 'show_google_api_error_notice', true) ) {

			$apikey = fw_ssd_get_option('google-api-key');

			if( $apikey != get_transient('ssd_google_api_key') ) {	 // so we can check only once per new api key

				$request = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=0,0&sensor=false&key=' . fw_ssd_get_option('google-api-key'); 
				$file_contents = wp_remote_fopen(trim($request));
				$json_decode = json_decode($file_contents);

				if ( isset($json_decode->error_message) ) {
				?>
				<div class="error notice">
				    <h2><?php esc_html_e('Google API Key Error!', 'couponhut') ?></h2>
					<p><?php echo wp_kses_post($json_decode->error_message); ?></p>
					<p><?php esc_html_e('Please see here for more information - ' , 'couponhut') ?><a href="https://developers.google.com/maps/faq"><?php esc_html_e('Google API FAQ' , 'couponhut') ?></a>
					<p>
					<p><a href="?show_google_api_error_notice"><?php esc_html_e('Dismiss', 'couponhut') ?></a></p>
				</div>
				<?php 
				}
				
				set_transient('ssd_google_api_key', $apikey, 0);

			}

		}
		
	}
}


add_action( 'admin_notices', '_action_ssd_show_google_api_error_notice' );


if( !( function_exists('_action_ssd_update_show_google_api_error_notice_meta')) ){
	function _action_ssd_update_show_google_api_error_notice_meta() {
	
		global $current_user;
		
		if (isset($_GET['show_google_api_error_notice'])) {
			
			update_user_meta($current_user->ID, 'show_google_api_error_notice', true);
			
		}
		
	}
	add_action('admin_init', '_action_ssd_update_show_google_api_error_notice_meta');
}


/**
*  Save Deals Availability on Theme Init
*/

if( !( function_exists('_action_ssd_save_deals_availability')) ){
	function _action_ssd_save_deals_availability() {

		if ( get_option('all_deals_availability_saved') != 'yes' ) {

			$args = array(
			'post_type' => 'deal'
			);

			$deals_query = new WP_Query($args);

			if ($deals_query->have_posts()) : while ($deals_query->have_posts()) : $deals_query->the_post();

				if ( couponhut_get_field('field_58e5fdaa9c519') == 'yes' ) { // acf limited_deal

					$deals_available = !empty(couponhut_get_field('field_58e5fddf9c51a', get_the_ID())) ? couponhut_get_field('field_58e5fddf9c51a', get_the_ID()) : 0; // acf deals_available
					update_post_meta(get_the_ID(), 'deals_available', $deals_available);
					
				} else {
					delete_post_meta(get_the_ID(), 'deals_available');
				}

			endwhile; endif;

			wp_reset_postdata();

			update_option( 'all_deals_availability_saved', 'yes' );
		}
		
	}
}

add_action('init', '_action_ssd_save_deals_availability', 99);


/**
* ----------------------------------------------------------------------------------------
*    WooCommerce
* ----------------------------------------------------------------------------------------
*/

if( !( function_exists('_action_ssd_woocommerce_support')) ){
	function _action_ssd_woocommerce_support() {
	    add_theme_support( 'woocommerce' );
	}
}

add_action( 'after_setup_theme', '_action_ssd_woocommerce_support' );

/**
*  WooCommerce Native Shop Page
*/

if( !( function_exists('_action_ssd_woocommerce_before_main_content')) ){
	function _action_ssd_woocommerce_before_main_content() { 
	    echo '<div class="page-wrapper">';
	    echo '<div class="container">';
	    echo '<div class="row">';
	    echo '<div class="col-sm-8 col-md-9 ">';
	}; 
}

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 ); 
add_action( 'woocommerce_before_main_content', '_action_ssd_woocommerce_before_main_content', 10 ); 

if( !( function_exists('_action_ssd_woocommerce_after_shop_loop')) ){
	function _action_ssd_woocommerce_after_shop_loop() { 
	    echo '</div><!-- end col-sm-8 -->';
	};
}

add_action( 'woocommerce_after_shop_loop', '_action_ssd_woocommerce_after_shop_loop', 10 ); 
add_action( 'woocommerce_after_single_product_loop', '_action_ssd_woocommerce_after_shop_loop', 10 ); 

if( !( function_exists('_action_ssd_woocommerce_after_main_content')) ){
	function _action_ssd_woocommerce_after_main_content() { 
		echo '</div><!-- end row -->';
		echo '</div><!-- end container -->';
		echo '</div><!-- end page-wrapper -->';
	}; 
}

remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 ); 
add_action( 'woocommerce_after_main_content', '_action_ssd_woocommerce_after_main_content', 10 ); 


if( !( function_exists('_action_ssd_woocommerce_before_my_account')) ){
	function _action_ssd_woocommerce_before_my_account() { 

		if ( get_user_meta( get_current_user_id(), 'user_company', true ) == 'yes' ) { ?>

			<h2><?php esc_html_e('My Company', 'couponhut'); ?></h2>

			<p class="myaccount_address">
				<?php esc_html_e( 'The company information fields.', 'couponhut' ); ?>
			</p>

			<div class="col-1 address">
				<header class="title">
					<a href="<?php echo wc_get_endpoint_url( 'my-company' ); ?>" class="edit"><?php _e( 'Edit', 'couponhut' ); ?></a>
				</header>
				<div>
					<?php
						$user_company_name = get_user_meta( get_current_user_id(), 'user_company_name', true);
						if ( $user_company_name ) {

							$user_company_term = get_term_by('name', $user_company_name, 'deal_company');
							// Logo
							$acf_term = 'deal_company_' . $user_company_term->term_id;
							$company_logo = couponhut_get_field('company_logo', $acf_term);
							if ( $company_logo ) {
								echo wp_get_attachment_image($company_logo['ID'], 'ssd_company-logo');
							echo '<br>';
							}

							// Name
							echo $user_company_name;
							echo '<br>';

							// Description
							if ( $user_company_term ) {	
								$description = $user_company_term->description;
								echo $description;
							}
						}

					?>
				</div>
			</div>

			<?php
		} else {

			wc_get_template( 'myaccount/my-downloads.php' );
			woocommerce_account_orders(1);
			wc_get_template( 'myaccount/my-address.php' );

		} //if get_user_meta( get_current_user_id(), 'user_company' ) == 'yes' )
	}; 
}

add_action( 'woocommerce_before_my_account', '_action_ssd_woocommerce_before_my_account', 10, 0 ); 


/**
*  Additional Registration Fields
*
*  @return string Register fields HTML.
*/

add_action( 'woocommerce_register_form', '_action_ssd_extra_register_fields' );

if( !( function_exists('_action_ssd_extra_register_fields')) ){
	function _action_ssd_extra_register_fields() { ?>

		<?php if ( fw_ssd_get_option('company-register-switch') ) : ?>
		<p class="form-row form-row-wide">
			<label for="user_company" class="inline">
			<input name="user_company" type="checkbox" id="user_company" value=""><?php esc_html_e('Register as a company', 'couponhut') ?></label>
		</p>
		<?php endif; ?>

		<?php
	}
}


/**
 * Save the extra register fields.
 *
 * @param  int  $customer_id Current customer ID.
 *
 * @return void
 */

add_action( 'woocommerce_created_customer', '_action_ssd_save_extra_register_fields' );

if( !( function_exists('_action_ssd_save_extra_register_fields')) ){
	function _action_ssd_save_extra_register_fields( $customer_id ) {
		if ( isset( $_POST['user_company'] ) ) {
			update_user_meta( $customer_id, 'user_company', 'yes' );
		}
	}
}


/**
*  Cart Icon In Menu
*/

add_filter( 'woocommerce_add_to_cart_fragments', '_filter_ssd_header_add_to_cart_fragment' );

if( !( function_exists('_filter_ssd_header_add_to_cart_fragment')) ){
	function _filter_ssd_header_add_to_cart_fragment( $fragments ) {

		$woocommerce_enable = fw_ssd_get_option('woocommerce-switch');

		if ( $woocommerce_enable['woocommerce-picker'] == 'yes' && fw_ssd_get_option('show-cart-switch') == 'show' ) {
			ob_start();
			$count = WC()->cart->cart_contents_count;
			?>
			<a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart', 'couponhut' ); ?>"><?php if ( $count > 0 ) echo '(' . $count . ')'; ?></a>
			<?php

			$fragments['a.cart-contents'] = ob_get_clean();
		}

	    return $fragments;
	}
}



add_filter('wp_nav_menu_items', 'update_cart_count_function', 15, 2);

if( !( function_exists('update_cart_count_function')) ){
	function update_cart_count_function( $nav, $args ) {

		$woocommerce_enable = fw_ssd_get_option('woocommerce-switch');

		if ( $woocommerce_enable['woocommerce-picker'] == 'yes' && fw_ssd_get_option('show-cart-switch') == 'show' ) {
			if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

				ob_start();

				$count = WC()->cart->cart_contents_count;
				?>
				<a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart', 'couponhut' ); ?>"><?php if ( $count > 0 ) echo '(' . $count . ')'; ?></a>

				<?php 
				$ob_content = ob_get_clean();
				return $nav . $ob_content;
			}

		}

	    return $nav;
	}
}



/**
*  Remove Checkout Fields
*/

add_filter( 'woocommerce_checkout_fields' , '_filter_ssd_override_checkout_fields' );

if( !( function_exists('_filter_ssd_override_checkout_fields')) ){
	function _filter_ssd_override_checkout_fields( $fields ) {
		$woocommerce_enable = fw_ssd_get_option('woocommerce-switch');
		if ( $woocommerce_enable['yes']['checkout-switch'] =='yes' ) {
			unset($fields['billing']['billing_first_name']);
			unset($fields['billing']['billing_last_name']);
			unset($fields['billing']['billing_company']);
			unset($fields['billing']['billing_address_1']);
			unset($fields['billing']['billing_address_2']);
			unset($fields['billing']['billing_city']);
			unset($fields['billing']['billing_postcode']);
			unset($fields['billing']['billing_country']);
			unset($fields['billing']['billing_state']);
			unset($fields['billing']['billing_phone']);
			unset($fields['order']['order_comments']);
			unset($fields['billing']['billing_email']);
			unset($fields['account']['account_username']);
			unset($fields['account']['account_password']);
			unset($fields['account']['account_password-2']);
		}
		
		return $fields;
	}
}


/**
 * Auto Complete all WooCommerce orders.
 */

add_action( 'woocommerce_thankyou', 'custom_woocommerce_auto_complete_order' );

if( !( function_exists('custom_woocommerce_auto_complete_order')) ){
	function custom_woocommerce_auto_complete_order( $order_id ) { 

		$woocommerce_enable = fw_ssd_get_option('woocommerce-switch');

		if ( $woocommerce_enable['yes']['autocomplete-switch'] =='yes' ) {
			if ( ! $order_id ) {
				return;
			}

			$order = wc_get_order( $order_id );
			$order->update_status( 'completed' );
		}
	}
}


/**
*  Make the Deal post type available for adding to cart
*/

function _filter_ssd_woocommerce_product_class( $classname, $product_type, $post_type, $product_id ) { 

    if ( get_post_type($product_id) == 'deal' ) {
    	$classname = 'WC_CouponHut_Deal_Simple';
    }

    return $classname; 
}; 
         
add_filter( 'woocommerce_product_class', '_filter_ssd_woocommerce_product_class', 10, 4 ); 


/**
*  Remove password strength
*/

if( !( function_exists('_action_ssd_wcvendors_remove_password_strength')) ){
	function _action_ssd_wcvendors_remove_password_strength() {
		if ( wp_script_is( 'wc-password-strength-meter', 'enqueued' ) ) {
			wp_dequeue_script( 'wc-password-strength-meter' );
		}
	}
}

add_action( 'wp_print_scripts', '_action_ssd_wcvendors_remove_password_strength', 100 );


/**
*  Deal WooCommerce Save
*/

if( !( function_exists('_action_ssd_save_deal_woocommerce_meta')) ){
	function _action_ssd_save_deal_woocommerce_meta($post_id) {

		if ( get_post_type($post_id) != 'deal' ) {
			return;
		}

		// $deal = new WC_CouponHut_Deal($post_id);
		$deal = new WC_CouponHut_Deal_Simple($post_id);

		if ( couponhut_get_field('image', $post_id) ) {
			$image = couponhut_get_field('image', $post_id);
			$deal->set_image_id($image['ID']);
		}


		if ( couponhut_get_field('show_pricing_fields', $post_id) && couponhut_get_field('woocommerce_price', $post_id) && couponhut_get_field('show_pricing_fields') ) {
			$price = couponhut_get_field('woocommerce_price', $post_id);

			$deal->set_regular_price($price);
			$deal->set_price($price);
		} else {
			$deal->set_regular_price(0);
			$deal->set_price(0);
		}

		if ( couponhut_get_field('virtual_deal', $post_id) ) {
			$deal->set_virtual(true);
		} else {
			$deal->set_virtual(false);
		}

		$woocommerce_enable = fw_ssd_get_option('woocommerce-switch');

		if ( couponhut_get_field('limited_deal', $post_id) == 'yes' && $woocommerce_enable['woocommerce-picker'] == 'yes' && !empty(couponhut_get_field('woocommerce_price', $post_id)) && couponhut_get_field('show_pricing_fields', $post_id) ) {

			$deal->set_manage_stock(true);

			$deals_available =  couponhut_get_field('deals_available', $post_id) ?  couponhut_get_field('deals_available', $post_id) : 0;

			$deal->set_stock_quantity($deals_available);

		}

		$deal->set_sold_individually(true);

		$deal->save();
		
	}
}

add_action('acf/save_post', '_action_ssd_save_deal_woocommerce_meta', 99);

/**
*  Save Deal Item Order in a WC_Order_Item_Deal because the default WC_Order_Item_Product doesn't allow ID setting
*/

if( !function_exists( '_action_ssd_change_wc_order_item_meta' ) ) {
	function _action_ssd_change_wc_order_item_meta( $item, $cart_item_key, $values, $order) {
		$item->update_meta_data('deal_id', $values['product_id']);
	}
}

add_action( 'woocommerce_checkout_create_order_line_item', '_action_ssd_change_wc_order_item_meta', 10, 4 );


/**
*  Create new WooCommerce Data Store (our Data Store is with removed 'product' check')
*/

if( !function_exists( '_filter_ssd_wc_set_deal_data_store' ) ) {
	function _filter_ssd_wc_set_deal_data_store( $stores ) {
		$stores['dealdata'] = 'WC_Deal_Data_Store_CPT';

		return $stores;
	}
}

add_filter( 'woocommerce_data_stores', '_filter_ssd_wc_set_deal_data_store' );


/**
*  Update the Deal Availability and the WooCommerce Stock QUantity meta
*/

if( !function_exists( '_action_ssd_wc_order_status_completed' ) ) {
	function _action_ssd_wc_order_status_completed( $order_id ) {
	    $order = wc_get_order( $order_id );

	    $order_items = $order->get_items();

	    foreach ($order_items as $item_id => $item) {

	    	$deal_id = $item->get_meta('deal_id');

	    	if ( $deal_id ) {
	    		if ( couponhut_get_field('limited_deal', $deal_id) == 'yes' ) {

					$deals_available = !empty(couponhut_get_field('deals_available', $deal_id)) ? couponhut_get_field('deals_available', $deal_id) : 0;

					$deals_available_before = intval($deals_available);

					$deals_available--;

					$deals_available = $deals_available < 0 ? 0 : $deals_available; // make deals available zero if they are below

					$deal = new WC_CouponHut_Deal_Simple($deal_id);

					$deal->set_stock_quantity($deals_available);

					$deal->save();

					update_post_meta($deal_id, 'deals_available', $deals_available);
				}
	    	}	

	    }
	}
}

add_action( 'woocommerce_order_status_completed', '_action_ssd_wc_order_status_completed', 10, 1 );



/**
*  Set Shop Permalink to be the Browse Template Page URL
*/

if( !function_exists( '_filter_ssd_change_shop_permalink' ) ) {
	function _filter_ssd_change_shop_permalink($permalink){
		$template_url = fw_ssd_get_browse_template_url();
		if ( $template_url ) {
			return $template_url;
		}
		return $permalink;
	}
}



add_filter( 'woocommerce_get_shop_page_permalink', '_filter_ssd_change_shop_permalink', 10, 1 );



/**
*  Update Total Sales on Deal Sale
*/

if( !function_exists( '_action_ssd_wc_update_deal_total_sales_counts' ) ) {
	function _action_ssd_wc_update_deal_total_sales_counts( $order_id ) {
		$order = wc_get_order( $order_id );

		if ( sizeof( $order->get_items() ) > 0 ) {
			foreach ( $order->get_items() as $item ) {

				$deal_id = $item->get_meta('deal_id');

				if ( $deal_id ) {
					$data_store = WC_Data_Store::load( 'dealdata' );
					$data_store->update_product_sales( $deal_id, absint( $item['qty'] ), 'increase' );
				}
			}
		}
	}
}

add_action( 'woocommerce_order_status_completed', '_action_ssd_wc_update_deal_total_sales_counts' );