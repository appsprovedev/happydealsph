<?php
// Check if user is logged and if this is a deal for registered users only
if ( fw_ssd_woocommerce() && !is_user_logged_in() && couponhut_get_field('registered_members_only') ) {
	$user_has_access = false;
} else {
	$user_has_access = true;
}


if ( !$user_has_access ) {
	$url_login = wc_get_page_id( 'myaccount' ) ? get_permalink( wc_get_page_id( 'myaccount' ) ) : '';
	wp_redirect( $url_login);
	exit;
}



$user_company_name = get_user_meta( get_current_user_id(), 'user_company_name', true ) ? get_user_meta( get_current_user_id(), 'user_company_name', true ) : '';

$user_company = get_term_by('name', $user_company_name, 'deal_company');

if ( get_current_user_id() && !empty($user_company) && fw_ssd_get_option('member-allow-edit') && has_term( $user_company->slug, 'deal_company' ) ) {
	$can_edit = true;
} else if ( get_current_user_id() && fw_ssd_get_option('member-allow-edit') && fw_ssd_get_option('member-submit-without-company-switch') ) {
	$can_edit = true;
} else {
	$can_edit = false;	
}

if ( isset($_GET['edit']) && $can_edit ) {
	if ( function_exists('acf_form') ) {
		acf_form_head();
	}
}

get_header();
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


	<?php 
	if ( couponhut_get_field('image_type') == 'image' ) { 

		$image = couponhut_get_field('header_image') ? couponhut_get_field('header_image') : couponhut_get_field('image');

	} else { 

		if( couponhut_have_rows('slider') ):

			$img_num = 1; 

			while ( couponhut_have_rows('slider') ) : the_row(); 

				if ( $img_num == 1 && couponhut_get_sub_field('image') ) {
					$image = couponhut_get_sub_field('image');

				}
				$img_num++;

			endwhile;

		endif;
	}

	?>

	<?php if ( $user_has_access ) : ?>

	<div class="modal fade" id="discount-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel"><?php the_title(); ?></h4>
					<?php if ( $image ) : ?>
					<div class="bg-image modal-deal-image" data-bgimage="<?php echo esc_url( $image['sizes']['ssd_single-post-image'] ); ?>"></div>
					<?php endif; ?>
				</div>
				<div class="modal-body">
					<div class="modal-deal-code">
						<?php echo wp_kses_post(couponhut_get_field('coupon_code')); ?>
					</div>
				</div>
				<div class="modal-footer is-clipboard-success">
					<p><?php esc_html_e('Code is copied', 'couponhut') ?></p>
					<?php
					if ( couponhut_get_field('printable_coupon')  )  {
						echo '<a href="#" class="btn btn-color btn-deal is-btn-print" data-post_id="' . get_the_ID() . '">' . fw_ssd_get_option('print-text') . '</a>';
						$print_image = couponhut_get_field('print_image');

						if ( $print_image && fw_ssd_get_option('download-coupon-switch')) {
							echo '<div class="download-deal-link mb-40">';
							echo '<a href="' . esc_url($print_image['url']) . '" target="_blank" download>' . esc_html__('or download as image', 'couponhut') . '<i class="fa fa-download"></i></a>'; 
							echo '</div>';
						}
					}
					?>
					<?php if ( couponhut_get_field('url') ) : ?>
					<a href="<?php echo esc_url(couponhut_get_field('url')); ?>" target="_blank" class="btn btn-color"><?php echo esc_html_e('Visit Deal', 'couponhut'); ?></a>
					<?php endif; ?>
				</div>
				<div class="modal-footer is-clipboard-error">
					<p><?php esc_html_e('Please copy the following code.', 'couponhut') ?></p>
					<?php
					if ( couponhut_get_field('printable_coupon')  )  {
						echo '<a href="#" class="btn btn-color btn-deal is-btn-print" data-post_id="' . get_the_ID() . '">' . fw_ssd_get_option('print-text') . '</a>';
						$print_image = couponhut_get_field('print_image');

						if ( $print_image && fw_ssd_get_option('download-coupon-switch')) {
							echo '<div class="download-deal-link mb-40">';
							echo '<a href="' . esc_url($print_image['url']) . '" target="_blank" download>' . esc_html__('or download as image', 'couponhut') . '<i class="fa fa-download"></i></a>'; 
							echo '</div>';
						}
					}
					?>
					<?php if ( couponhut_get_field('url') ) : ?>
					<a href="<?php echo esc_url(couponhut_get_field('url')); ?>" target="_blank" class="btn btn-color"><?php echo esc_html_e('Visit Deal', 'couponhut'); ?></a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div><!-- end modal -->

	<?php endif; // $user_has_access ?>
	
	<?php 
	/**
	*  Edit Deal Notice
	*/
	if ( !isset($_GET['edit']) && $can_edit ) : ?>
	<div class="edit-deal" >
		<p><?php esc_html_e('This is one of your deals - ', 'couponhut') ?><a href="<?php echo add_query_arg('edit', 'true');?>"><?php esc_html_e('[Edit]', 'couponhut') ?></a></p>	
	</div>
	<?php endif; ?>
	
	<?php if ( isset($_GET['edit']) && $can_edit ) : ?>
	<div class="edit-deal" >
		<p><?php esc_html_e('Editing deal: ', 'couponhut') ?></p>	
	</div>
	<?php endif; ?>
	
	<?php 
	/**
	*  Print Image
	*/
	$print_image = couponhut_get_field('print_image');
	if ( $print_image ) : 
	?>
		<img src="<?php echo esc_url($print_image['url']) ?>" alt="" class="image-deal-print">
	<?php endif; ?>
	
	<div class="single-deal-wrapper" itemscope itemtype="http://schema.org/Product">

	<?php 
	/**
	*  WooCommerce Before
	*/
	?>
	<div class="container">
		<div class="com-sm-12">
			<?php 
			do_action( 'woocommerce_before_single_product' ); 
			?>
		</div>
	</div>

	<?php if ( !isset($_GET['edit']) ) : ?>
	<div class="single-deal-header-wrapper">
		<div class="single-deal-header">
			
			<?php get_template_part('partials/content', 'single-deal-header');  ?>
			<?php get_template_part('partials/content', 'single-deal-box');  ?>

		</div><!-- end single-deal-header -->
	</div>
	<?php endif; ?>


	<div class="container">

		<div class="row">
			<div class="col-sm-8 col-md-9">

				<div class="single-deal-content">
					<?php 
					if ( isset($_GET['edit']) && $can_edit ) {

						ob_start(); ?>
						<div class="acf-hidden">
							<input type="hidden" name="submit_page_id" value="<?php the_ID() ?>" id="submit_page_id" autocomplete="off">
						</div>

						<?php
						$html_after_fields = ob_get_contents();
						ob_end_clean();


						$options = array(
							'html_after_fields' => $html_after_fields
						);

						acf_form($options);
					} else {
						fw_ssd_set_post_views();
						if ( fw_ssd_get_option('deal-sales-switch') ) :
						?>		
						<div class="deal-stats">
							<div class="deal-stat">
								<?php
								$woocommerce_enable = fw_ssd_get_option('woocommerce-switch');

								if ( $woocommerce_enable['woocommerce-picker'] == 'yes' && !empty(couponhut_get_field('woocommerce_price')) && couponhut_get_field('show_pricing_fields') ) :

								$deal = new WC_CouponHut_Deal_Simple(get_the_ID());
								$deal_sales = $deal->get_total_sales();
								$deal_sales = $deal_sales ? $deal_sales : 0;
								?>
								<span class="deal-stat-number"><?php echo wp_kses_post(number_format($deal_sales)); ?></span>
								<span class="deal-stat-text"><?php echo $deal_sales == 1 ? esc_html_e('Sale', 'couponhut') : esc_html_e('Sales', 'couponhut'); ?></span>
								<?php else : 
								$button_clicked_count = fw_ssd_get_post_clicks();
								?>
								<span class="deal-stat-number"><?php echo wp_kses_post(number_format($button_clicked_count)); ?></span>
								<span class="deal-stat-text"><?php esc_html_e('Times Redeemed', 'couponhut'); ?></span>
								<?php endif ?>
							</div>
							<div class="deal-stat">
								<?php
								$deal_views = fw_ssd_get_post_views();
								?>
								<span class="deal-stat-number"><?php echo wp_kses_post(number_format($deal_views)); ?></span>
								<span class="deal-stat-text"><?php $deal_views == 1 ? esc_html_e('View', 'couponhut') : esc_html_e('Views', 'couponhut'); ?></span>
							</div>
						</div><!-- end deal-stats -->
						<?php
						endif; // fw_ssd_get_option('deal-sales-switch')

						the_content();
					}
					?>
					<div class="single-deal-share">
						<?php get_template_part( 'partials/content', 'share-buttons' ); ?>
					</div><!-- end single-deal-share -->
				</div>
				<?php if ( 'open' == $post->comment_status ) : ?>
				<div class="comments-container">
					<?php comments_template( '', true ); ?>
				</div>
				<?php endif ?>
				
			</div><!-- end col-sm-8 col-md-9 -->

			<div class="col-sm-4 col-md-3" itemscope itemtype="http://schema.org/Offer">

				<?php 
				$companies = get_the_terms( get_the_ID(), 'deal_company' );

				if ( $companies && ! is_wp_error( $companies ) ) :
				?>
				
				<div class="widget" itemprop="seller" itemscope itemtype="http://schema.org/Organization">
					<h2 class="widget-title"><?php esc_html_e('Company', 'couponhut') ?></h2>
					<?php
					$company_taxonomy = $companies[0]->taxonomy;
					$company_id = $companies[0]->term_id;
					$acf_term =  $company_taxonomy . '_' . $company_id;
					if ( couponhut_get_field('company_logo', $acf_term) ) :
						$logo = couponhut_get_field('company_logo', $acf_term);?>
						<a href="<?php echo esc_url(get_term_link($companies[0])); ?>" >
						<?php
						echo wp_get_attachment_image($logo['id'], 'ssd_company-logo');?>
						</a>
					<?php endif; ?>
					<h5><a href="<?php echo esc_url(get_term_link($companies[0])); ?>"><span itemprop="name"><?php echo wp_kses_post($companies[0]->name); ?></span></a></h5>
					<p>
						<?php echo wp_kses_post($companies[0]->description); ?>
					</p>
				</div><!-- end single-deal-company -->

				<?php endif; ?> 

				<?php 
				if ( couponhut_get_field('show_location') =='show' && couponhut_get_field('location') ) :
				?>

				<div class="widget">
					<h2 class="widget-title" ><?php esc_html_e('Location', 'couponhut') ?></h2>
					<?php 
					$location = couponhut_get_field('location');
					$address = explode( ',' , $location['address']);

					$map_zoom = couponhut_get_field('map_zoom') ? couponhut_get_field('map_zoom') : 16;
					?>
					<div class="single-deal-map" data-gmap-zoom="<?php echo esc_attr($map_zoom); ?>">
						<div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>">
							<h6><?php echo wp_kses_post($location['address']); ?></h6>
							<a href="<?php echo esc_url('https://www.google.com/maps?q=@' . $location['lat'] . ',' . $location['lng'] . '&z=13');?>" target="_blank"><?php esc_html_e('Visit Location', 'couponhut') ?></a>
						</div>
					</div>
					<p>
					<?php echo esc_attr($location['address']); ?>
					</p>
					
				</div><!-- end single-deal-company -->

				<?php endif; ?>
	
			</div><!-- end col-sm-3 -->

		</div><!-- end row -->
		
	</div><!-- end container -->

</div><!-- end single-deal-wrapper -->


<?php endwhile; endif; ?>
<?php
get_footer();
?>