<?php
$discount_value = couponhut_get_field('discount_value');
?>



<div class="card-deal">

	
	<?php 
	$woocommerce_enable = fw_ssd_get_option('woocommerce-switch');

	if ( fw_ssd_get_option('popup-coupons-switch') && couponhut_get_field('deal_type') == 'coupon' && $woocommerce_enable['woocommerce-picker'] != 'yes' ) :
	?>

	<?php 
	if ( couponhut_get_field('image_type') == 'image' ) { 

		$image = couponhut_get_field('image');

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
	<!-- Modal Popup for Coupon Deals if enabled -->
	<div class="modal fade" id="discount-modal-<?php the_ID();?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
				<?php the_excerpt(); ?>
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
	<?php endif; // fw_ssd_get_option('popup-coupons-switch')?>

	<div class="card-deal-inner">

		<?php 
		$user_company_name = get_user_meta( get_current_user_id(), 'user_company_name', true ) ? get_user_meta( get_current_user_id(), 'user_company_name', true ) : '';

		$user_company = get_term_by('name', $user_company_name, 'deal_company');

		if ( get_current_user_id() && !empty($user_company) && fw_ssd_get_option('member-allow-edit') && has_term( $user_company->slug, 'deal_company' ) ) {
			$can_edit = true;
		} else if ( get_current_user_id() && fw_ssd_get_option('member-allow-edit') && fw_ssd_get_option('member-submit-without-company-switch') ) {
			$can_edit = true;
		} else {
			$can_edit = false;	
		}

		if ( $can_edit ) : ?>
			<a href="<?php echo add_query_arg('edit', 'true', get_permalink());?>">
				<span><?php esc_html_e('Edit Deal', 'couponhut'); ?></span>
			</a>
		<?php endif; ?>

		<div class="deal-thumb-image">
			<?php 
			$enable_redirect = couponhut_get_field('redirect_to_offer') ? couponhut_get_field('redirect_to_offer') : array('');
			
			if ( !$can_edit && fw_ssd_get_option('popup-coupons-switch') && couponhut_get_field('deal_type') == 'coupon' && $woocommerce_enable['woocommerce-picker'] != 'yes' ) :
			?>
			<a href="<?php echo esc_url(couponhut_get_field('url')); ?>" target="_blank" class="show-coupon-code" data-target="#discount-modal-<?php the_ID();?>" data-clipboard-text="<?php echo esc_attr(couponhut_get_field('coupon_code')) ?>" data-redirect="<?php echo $enable_redirect[0]; ?>">
			<?php
			elseif ( !$can_edit && fw_ssd_get_option('popup-coupons-switch') && couponhut_get_field('deal_type') == 'discount' && $woocommerce_enable['woocommerce-picker'] != 'yes' ) :
			?>
			<a href="<?php echo esc_url(couponhut_get_field('url')); ?>" target="_blank">	
			<?php
			else :
			?>
			<a href="<?php echo esc_url(get_permalink()); ?>">	
			<?php endif; ?>
			
				<!-- Ribbon -->
				<?php if( $discount_value && (fw_ssd_get_option('stamp-switch') == 'show') ) : ?>
					<div class="discount-ribbon"><?php echo wp_kses_post( $discount_value ); ?></div>
				<?php endif; ?>

				<!-- Button -->
				<?php if ( couponhut_get_field('deal_type') == 'discount' ) : ?>
					<div class="btn-card-deal"><i class="icon-Shopping-Cart"></i><span><?php esc_html_e('View Deal', 'couponhut'); ?></span></div>
				<?php else : ?>
					<div class="btn-card-deal"><i class="icon-Scissor"></i><span><?php esc_html_e('View Coupon', 'couponhut'); ?></span></div>
				<?php endif; ?>

				<!-- Image -->
				<?php 

				if ( couponhut_get_field('image_type') == 'image') {
					if ( couponhut_get_field('image') ) {
				 			$image = couponhut_get_field('image');
				 		}
				} else {

					if( couponhut_have_rows('slider') ) {

						$img_num = 1;

						while ( couponhut_have_rows('slider') ) {

							the_row();
							if ( $img_num == 1 && couponhut_get_sub_field('image') ) {
								$image = couponhut_get_sub_field('image');

							}
							$img_num++;

					 	}

					}

				}
				?>

				<?php if( isset($image) ) : ?>
					<img src="<?php echo esc_url( $image['sizes']['ssd_deal-thumb'] );?>" alt="<?php echo $image['alt'] ? esc_attr( $image['alt'] ) : ''; ?>">
				<?php endif; ?>
			</a>
		</div><!-- end deal-thumb-image -->

		<div class="card-deal-info">
			
			<!-- Title -->
			<?php
			if ( fw_ssd_get_option('popup-coupons-switch') && couponhut_get_field('deal_type') == 'coupon' && $woocommerce_enable['woocommerce-picker'] != 'yes' ) :
			?>
			<h2 class="card-deal-title"><a href="<?php echo esc_url(couponhut_get_field('url')); ?>" target="_blank" class="show-coupon-code" data-target="#discount-modal-<?php the_ID();?>" data-clipboard-text="<?php echo esc_attr(couponhut_get_field('coupon_code')) ?>" data-redirect="<?php echo $enable_redirect[0]; ?>"><?php the_title(); ?></a></h2>
			<?php
			elseif (fw_ssd_get_option('popup-coupons-switch') && couponhut_get_field('deal_type') == 'discount' && $woocommerce_enable['woocommerce-picker'] != 'yes' ) :
			?>
			<h2 class="card-deal-title"><a href="<?php echo esc_url(couponhut_get_field('url')); ?>" target="_blank"><?php the_title(); ?></a></h2>
			<?php
			else :
			?>
			<h2 class="card-deal-title"><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a></h2>
			<?php endif; ?>

			<!-- Category -->
			<?php
			$cats = get_the_terms( get_the_ID(), 'deal_category' );
			$cats_array = array();

			if ( $cats && ! is_wp_error( $cats ) ) {

				foreach ($cats as $cat) {
					$cat_link = '<a href="' . get_term_link($cat) . '">' . $cat->name . '</a>';
					array_push($cats_array, $cat_link);
				}

			}

			$cats_string = implode(', ',$cats_array);
			?>

			<div class="card-deal-categories"><?php echo $cats_string ?></div>
	

			<!-- Rating -->
			<div class="card-deal-meta-rating">
				<?php if ( fw_ssd_get_option('rating-switch') == 'show' ) : ?>
					
					<?php	
					$rating_average = get_post_meta($post->ID, 'rating_average', true);

					if( empty( $rating_average ) ){
						update_post_meta($post->ID, 'rating_average', 0 );
						$rating_average = 0;
					}

					$rating_count_total = get_post_meta($post->ID, 'rating_count_total', true);

					if( empty( $rating_count_total ) ){
						update_post_meta($post->ID, 'rating_count_total', 0 );
						$rating_count_total = 0;
					}
					?>

					<div class="post-star-rating">
						<?php
						for ( $i = 0; $i <= 4; $i++ ) {

							$rating_value = $i + 1;

							if ( $rating_average >= ( $i + 0.75 ) ) { ?>
								<i class="rating-star fa fa-star" data-post-id="<?php echo esc_attr($post->ID) ?>" data-rating="<?php echo esc_attr($rating_value); ?>"></i>
							<?php
							} else if ( $rating_average >= ( $i + 0.25 ) ) { ?>
								<i class="rating-star fa fa-star-half-o" data-post-id="<?php echo esc_attr($post->ID) ?>" data-rating="<?php echo esc_attr($rating_value); ?>"></i>
								<?php
							} else { ?>
								<i class="rating-star fa fa-star-o" data-post-id="<?php echo esc_attr($post->ID) ?>" data-rating="<?php echo esc_attr($rating_value); ?>"></i>
							<?php
							}

						}
						?>
					</div>

				<?php endif; ?>

			</div>

			<!-- Pricing -->
			<?php if ( couponhut_get_field('show_pricing_fields') ) : ?>

			<div class="deal-prices">
				<?php if ( couponhut_get_field('old_price') ) : ?>
				<div class="deal-old-price">
					<?php echo wp_kses_post(couponhut_get_field('old_price')); ?>
				</div>
				<?php endif; ?>
				<?php if ( couponhut_get_field('new_price') ) : ?>
				<div class="deal-new-price">
					<?php echo wp_kses_post(couponhut_get_field('new_price')); ?>
				</div>
				<?php endif; ?>
				<?php if ( couponhut_get_field('save') ) : ?>
				<div class="deal-save-price">
					<span><?php esc_html_e('You save:', 'couponhut') ?></span>
					<?php echo wp_kses_post(couponhut_get_field('save')); ?>
				</div>
				<?php endif; ?>
			</div>

			<?php endif; ?>

			<!-- Expiring -->
			<?php if( couponhut_get_field('expiring_date') ) : ?>
				<div class="card-deal-meta-expiring">
					<div class="card-deal-meta-title"><?php esc_html_e('Expires in', 'couponhut'); ?></div>
					<span class="jscountdown-wrap" data-time="<?php echo esc_attr(couponhut_get_field('expiring_date') ) ?>" data-short="true" ></span>
				</div>
			<?php endif; ?>

		</div><!-- end card-deal-info -->

	</div><!-- end card-deal-inner -->

</div><!-- end card-deal -->