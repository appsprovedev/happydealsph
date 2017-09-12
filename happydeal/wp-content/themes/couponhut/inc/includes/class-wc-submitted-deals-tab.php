<?php
if ( !class_exists('Couponhut_WC_Submitted_Deals') ) {
	class Couponhut_WC_Submitted_Deals {

		/**
		 * Custom endpoint name.
		 *
		 * @var string
		 */
		public static $endpoint = 'submitted-deals';

		/**
		 * Plugin actions.
		 */
		public function __construct() {
			// Actions used to insert a new endpoint in the WordPress.
			add_action( 'init', array( $this, 'add_endpoints' ) );
			add_filter( 'query_vars', array( $this, 'add_query_vars' ), 0 );

			// Change the My Accout page title.
			// add_filter( 'the_title', array( $this, 'endpoint_title' ) );

			if  ( get_metadata('user', get_current_user_id(), 'user_company', true) == 'yes' || get_option('unyson_member_submit_without_company_switch') )  {
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
				$title = __( 'Submitted Deals', 'couponhut' );

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
			$items[ self::$endpoint ] = __( 'Submitted Deals', 'couponhut' );

			// Insert back the logout item.
			$items['customer-logout'] = $logout;

			return $items;
		}

		/**
		 * Endpoint HTML content.
		 */
		public function endpoint_content() {
			
			ob_start();
			wc_print_notices();

			if( get_query_var( 'paged' ) )
				$paged = get_query_var( 'paged' );
			else {
				if( get_query_var( 'page' ) )
					$paged = get_query_var( 'page' );
				else if( get_query_var( 'submitted-deals' ) ) {
					$page_string = get_query_var( 'submitted-deals' );
					preg_match('/page\/(\d+)/', $page_string, $matches);
					$paged = $matches[1] ? $matches[1] : 1;
				}
				else
					$paged = 1;
				set_query_var( 'paged', $paged );
			}

			$user_company_name = get_user_meta( get_current_user_id(), 'user_company_name', true ) ? get_user_meta( get_current_user_id(), 'user_company_name', true ) : '';

			$user_company = get_term_by('name', $user_company_name, 'deal_company');

			if ( fw_ssd_get_option('member-submit-without-company-switch') ) {
				$args = array(
					'post_type' => 'deal',
					'post_status' => 'publish',
					'posts_per_page' => 12,
					'author' => get_current_user_id(),
					'paged' => $paged
				);

				$user_deals = new WP_Query($args);

			} else if ( $user_company ){
				$args = array(
					'post_type' => 'deal',
					'post_status' => 'publish',
					'posts_per_page' => 12,
					'tax_query' => array(
						array(
							'taxonomy' => 'deal_company',
							'field'    => 'slug',
							'terms'    => $user_company->slug,
							),
						),
					'paged' => $paged
				);

				$user_deals = new WP_Query($args);
			}
			?>

				<h1 class="section-title"><?php echo esc_html_e( 'Your Submitted Deals', 'couponhut' ); ?></h1>

			<?php
			if ( !$user_company ) {
				echo '<p>' . esc_html__('Your Company Name is empty. Please enter a Company Name in your profile page', 'couponhut') . '</p>';
			}

			if (($user_company || fw_ssd_get_option('member-submit-without-company-switch')) && $user_deals->have_posts() && ( get_current_user_id() && ( !empty($user_company) || fw_ssd_get_option('member-submit-without-company-switch') ) ) ) : ?>

			<div class="grid-wrapper">
				
				<?php while  ( $user_deals->have_posts() ) : $user_deals->the_post(); ?>
					<div class="deal-item-wrapper col-xs-6 col-sm-6 col-md-4">
						<?php get_template_part('loop/content', 'deal'); ?>
					</div>
				<?php
				endwhile;
				?>

			</div><!-- end grid-wrapper -->

			<?php
			fw_ssd_paging_nav($user_deals);

			wp_reset_postdata();
			endif;

			$output = ob_get_clean();
			echo $output;
		}

	}
}

add_action('after_setup_theme', '_action_ssd_wp_submitted_deals_init');

if( !( function_exists('_action_ssd_wp_submitted_deals_init')) ){
	function _action_ssd_wp_submitted_deals_init(){
		if (  get_current_user_id() ) {
			new Couponhut_WC_Submitted_Deals();

			if ( get_option('wp_submitted_deals_flush_rewrite') == false ) {
				flush_rewrite_rules();
				update_option('wp_submitted_deals_flush_rewrite', true);
			}
		}
	}
}
