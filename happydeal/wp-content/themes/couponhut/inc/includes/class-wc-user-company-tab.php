<?php
if ( !class_exists('Couponhut_WC_User_Company') ) {
	class Couponhut_WC_User_Company {

		/**
		 * Custom endpoint name.
		 *
		 * @var string
		 */
		public static $endpoint = 'my-company';

		/**
		 * Plugin actions.
		 */
		public function __construct() {
			// Actions used to insert a new endpoint in the WordPress.
			add_action( 'init', array( $this, 'add_endpoints' ) );
			add_filter( 'query_vars', array( $this, 'add_query_vars' ), 0 );

			// Change the My Accout page title.
			// add_filter( 'the_title', array( $this, 'endpoint_title' ) );
			if (  get_metadata('user', get_current_user_id(), 'user_company', true) == 'yes' ) {
				// Insering your new tab/page into the My Account page.
				add_filter( 'woocommerce_account_menu_items', array( $this, 'new_menu_items' ) );
				add_action( 'woocommerce_account_' . self::$endpoint .  '_endpoint', array( $this, 'endpoint_content' ) );
			}

			
		}

		/**
		 * Register new endpoint to use inside My Account page.
		 *
		 * @see https://developer.wordpress.org/reference/functions/add_rewrite_endpoint/
		 */
		public function add_endpoints() {
			add_rewrite_endpoint( self::$endpoint, EP_ROOT | EP_PAGES );
		}

		/**
		 * Add new query var.
		 *
		 * @param array $vars
		 * @return array
		 */
		public function add_query_vars( $vars ) {
			$vars[] = self::$endpoint;

			return $vars;
		}

		/**
		 * Set endpoint title.
		 *
		 * @param string $title
		 * @return string
		 */
		public function endpoint_title( $title ) {
			global $wp_query;

			$is_endpoint = isset( $wp_query->query_vars[ self::$endpoint ] );

			if ( $is_endpoint && ! is_admin() && is_main_query() && !in_the_loop() && is_account_page() ) {
				// New page title.
				$title = __( 'My Company', 'couponhut' );

				remove_filter( 'the_title', array( $this, 'endpoint_title' ) );
			}

			return $title;
		}

		/**
		 * Insert the new endpoint into the My Account menu.
		 *
		 * @param array $items
		 * @return array
		 */
		public function new_menu_items( $items ) {
			// Remove the logout menu item.
			$logout = $items['customer-logout'];
			unset( $items['customer-logout'] );

			// Insert your custom endpoint.
			$items[ self::$endpoint ] = __( 'My Company', 'couponhut' );

			// Insert back the logout item.
			$items['customer-logout'] = $logout;

			return $items;
		}

		/**
		 * Endpoint HTML content.
		 */
		public function endpoint_content() {
			
			ob_start();
			
			wc_print_notices(); ?>

			<div class="section-title-block">
				<h1 class="section-title"><?php echo esc_html_e( 'Your Company Details', 'couponhut' ); ?></h1>
			</div>

			<form method="post" enctype="multipart/form-data">

				<p class="form-row form-row form-row-wide" id="billing_company_field">
					<label for="user_company_name" class=""><?php esc_html_e('Company Name', 'couponhut') ?></label>
					<?php
					$user_company_name = get_user_meta( get_current_user_id(), 'user_company_name', true ) ? get_user_meta( get_current_user_id(), 'user_company_name', true ) : '';
					?>
					<?php 
					if ( $user_company_name ) :
					?>
					<p class="form-row form-row form-row-wide"><?php echo $user_company_name; ?></p>

					<input type="hidden" name="user_company_name" value="<?php echo $user_company_name; ?>" />
					<?php else: ?>
					<input type="text" class="input-text " name="user_company_name" id="user_company_name" placeholder="" value="">
					<?php endif; ?>
				</p>

				<?php
				$user_company = get_term_by('name', $user_company_name, 'deal_company');

				if ( $user_company ) {	
					$description = isset($user_company->description) ? $user_company->description : '';
				} else {
					$description = '';	
				}
				?>
				<p class="form-row form-row form-row-wide" id="billing_company_field">
					<label for="user_company_description" class=""><?php esc_html_e('Company Description', 'couponhut') ?></label>
					<textarea type="text" class="input-text " name="user_company_description" id="user_company_description" placeholder=""><?php echo $description; ?></textarea>
				</p>

				<p class="form-row form-row form-row-wide" id="billing_company_field">
				<?php 
				if ( $user_company ) {
					$acf_term = 'deal_company_' . $user_company->term_id;
					$company_logo = couponhut_get_field('company_logo', $acf_term);
					if ( $company_logo ) {
						echo wp_get_attachment_image($company_logo['ID'], 'ssd_company-logo');
					}
				}
				
				?>
				</p>
				<div id="upload_user_company_logo" class="mb-40">
					<input id="file_upload" name="file_upload" type="file" accept="image/*" multiple="false">
				</div>
				<p>
					<input type="submit" class="button" name="save_user_company" value="<?php esc_attr_e( 'Save', 'couponhut' ); ?>" />
					<?php wp_nonce_field( 'woocommerce-user_company' ); ?>
					<input type="hidden" name="user_company_edit" value="1" />
				</p>

			</form>

			<?php

			$output = ob_get_clean();
			echo $output;
		}

	}
}


add_action('after_setup_theme', '_action_ssd_wp_user_company_init');

if( !( function_exists('_action_ssd_wp_user_company_init')) ){
	function _action_ssd_wp_user_company_init(){
		if (  get_current_user_id() ) {

			new Couponhut_WC_User_Company();
			if ( get_option('wp_submitted_deals_flush_rewrite') == false ) {
				flush_rewrite_rules();
				update_option('wp_submitted_deals_flush_rewrite', true);
			}
			
		}
	}
}
