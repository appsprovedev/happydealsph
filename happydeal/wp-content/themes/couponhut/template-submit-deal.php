<?php
// Admin Send Deal Mail
$email_to = fw_ssd_get_option('new-deal-email');
// Allow deal submit without registration
$allow_no_reg = fw_ssd_get_option('member-submit-switch');
$allow_no_company = fw_ssd_get_option('member-submit-without-company-switch');

if ( fw_ssd_woocommerce() || $allow_no_reg || $allow_no_company ) : 


	if ( fw_ssd_woocommerce() && !is_user_logged_in() && !$allow_no_reg ) {
		$url_login = get_option('woocommerce_myaccount_page_id') ? get_permalink( get_option('woocommerce_myaccount_page_id') ) : '';
		wp_redirect( $url_login);
		exit;
	}

	if ( fw_ssd_woocommerce() && is_user_logged_in() && !$allow_no_reg && !get_user_meta( get_current_user_id(), 'user_company_name', true ) && !$allow_no_company  ) {
		get_header();
		?>
		<div id="post-<?php the_ID(); ?>" <?php post_class('page-wrapper'); ?>>
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="section-title-block">
							<h1 class="section-title"><?php esc_html_e('Not Authorized', 'couponhut') ?></h1>
						</div><!-- end section-title-block -->
						<p><?php esc_html_e('You must be registered as a company to submit a deal.', 'couponhut') ?></p>
					</div>
				</div>
			</div>
		</div>
		<?php
		get_footer();
		exit;
	}

	if ( $email_to ) {
		if ( function_exists('acf_form') ) {
			acf_form_head();
		}
	}

/* Template Name: Submit Deal */
get_header();
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('page-wrapper'); ?>>

	<div class="container">

		<div class="row">

			<div class="col-sm-12">
				<div class="section-title-block">
					<h1 class="section-title"><?php esc_html_e('New Deal', 'couponhut') ?></h1>
				</div><!-- end section-title-block -->
			</div>

			<?php if ( fw_ssd_get_option('submit-deal-sidebar-switch') ) : ?>
				<div class="col-sm-8 col-md-9 <?php echo fw_ssd_get_option('sidebar-switch') == 'left' ? 'col-sm-push-4 col-md-push-3' : '' ?>">
			<?php else : ?>
				<div class="col-sm-12">
			<?php endif; ?>

				<?php 
				if ( isset($_REQUEST['error']) ) {
					$error = '';

					if ( $_REQUEST['error'] == 'company_name' ) {
						$url_user = get_option('woocommerce_myaccount_page_id') ? get_permalink( get_option('woocommerce_myaccount_page_id') ) : '';
						$error = esc_html__('Error! Please enter your Company Name in ', 'couponhut') . '<a href="' . $url_user . '">Your Profile Page</a>.';
					}
					echo '<div class="alert alert-danger"><p>' . $error . '</p></div>';
				}
				?>
				
				
				<?php
				$user_company_name = get_user_meta(get_current_user_id(), 'user_company_name', true);

				if( empty($user_company_name) && !fw_ssd_get_option('member-submit-switch') ) {
					$url_user = get_option('woocommerce_myaccount_page_id') ? get_permalink( get_option('woocommerce_myaccount_page_id') ) : '';
					$error = esc_html__('Error! Please enter your Company Name in ', 'couponhut') . '<a href="' . $url_user . '">Your Profile Page</a>.';
					echo '<div class="alert alert-danger"><p>' . $error . '</p></div>';
				} else if ( $email_to ) {

					ob_start(); ?>
					<div class="acf-hidden">
						<input type="hidden" name="submit_page_id" value="<?php the_ID() ?>" id="submit_page_id" autocomplete="off">
						<input type="hidden" name="deal_submit" size="30" id="deal_submit" autocomplete="off">
					</div>

					<?php
					$html_after_fields = ob_get_contents();
					ob_end_clean();

					ob_start(); ?>
					<div class="acf-field">
						<div class="acf-label">
							<label for="post_title"><?php esc_html_e('Title', 'couponhut'); ?></label for="post_title">
						</div>
						<div class="acf-input">
							<input type="text" name="post_title" size="30" id="post_title" autocomplete="off">
						</div>
					</div>

					<?php 
					$term_args = array( 
						'hide_empty' => 0 
					);

					$deal_cats = get_terms('deal_category', $term_args );

					if ( ! empty( $deal_cats ) && ! is_wp_error( $deal_cats ) ) :
					?>

					<div class="acf-field acf-field-select">
						<div class="acf-label">
							<label for="post_category"><?php esc_html_e('Category', 'couponhut') ?></label>
						</div>
						<div class="acf-input">
							<select id="post_category" class="" name="post_category">
								<option value="" disabled selected><?php esc_html_e('Select deal category', 'couponhut') ?></option>
								<?php 
								foreach ( $deal_cats as $deal_cat ) {
									echo '<option value="' . $deal_cat->slug . '">' . $deal_cat->name . '</option>';
								}
								?>
							</select>		
						</div>
					</div>

					<?php endif; //$deal_cats ?>

					<div class="acf-field">
						<div class="acf-label">
							<label for="post_content"><?php esc_html_e('Content', 'couponhut'); ?></label for="post_content">
						</div>
						<div class="acf-input">
							<textarea type="text" name="post_content" size="30" rows="8" id="post_content"></textarea>
						</div>
					</div>

					<?php
					$html_before_fields = ob_get_contents();
					ob_end_clean();
					
					$options = array(
						'post_id' => 'new_post',
						'new_post' => array(
							'post_type'   	 => 'deal',
							 'post_status'   => 'pending'
							),
						'html_before_fields' => $html_before_fields,
						'html_after_fields' => $html_after_fields,
						'uploader' => 'basic',
						'submit_value' => __("Create", 'couponhut'),
						'updated_message' => __("Your deal was submitted successfully! Please wait for it to be approved.", 'couponhut'),
						);
					if ( function_exists('acf_form') ) {
						acf_form($options);
					} else {
						esc_html_e('Please isntall the Advanced Custom Fields PRO plugin.', 'couponhut');
					}
					

				} else if( current_user_can( 'manage_options' ) ) { ?>
				
				<p><?php esc_html_e('Please enter an email in the "New Deal Email" field in Appearance > Theme Settings > Deals.', 'couponhut') ?></p>

				<?php
				} else { ?>

				<p><?php esc_html_e('No administrator email found. Please contact the owner of the website.', 'couponhut') ?></p>

				<?php
				}
				?>
			</div><!-- end col-sm-8 col-md-9 -->
			<?php if ( fw_ssd_get_option('submit-deal-sidebar-switch') ) : ?>
			<?php get_sidebar(); ?>
			<?php endif; ?>

		</div>

	</div><!-- end container -->
	
</div><!-- end post -->

<?php get_footer(); ?>

<?php 
else:
	get_header();
?>
	<div class="no-posts-wrapper">
		<h3><?php esc_html_e('Please Allow Deal Submit Without Registration from Theme Settings > Deals or enable WooCommerce so that the theme can have registration functionality.', 'couponhut'); ?></h3>
	</div>
<?php
get_footer();
exit;

endif;

?>