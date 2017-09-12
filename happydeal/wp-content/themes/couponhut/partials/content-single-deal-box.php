<div class="single-deal-box" data-post-id="<?php echo esc_attr(get_the_ID()) ?>">

	<div class="single-deal-box-inner">
		<?php if( couponhut_get_field('expiring_date') ) : ?>
		<div class="single-deal-countdown">
			<i class="icon-Clock"></i>
			<p class="single-deal-expires-text"><?php esc_html_e('Expires in', 'couponhut'); ?></p>
			<div class="jscountdown-wrap" data-time="<?php echo esc_attr(couponhut_get_field('expiring_date')) ?>" itemprop="availability" href="http://schema.org/InStock"></div>
		</div><!-- end single-deal-countdown -->
		<?php endif; ?>

	<?php if ( couponhut_get_field('deal_summary') ) : ?>
		<div class="single-deal-summary" itemprop="description">
			<?php echo do_shortcode(wp_kses_post(couponhut_get_field('deal_summary'))); ?>
		</div><!-- end single-deal-summary -->
	<?php endif; ?>

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

	<?php 
	$current_date = date('Y/m/d');
	$woocommerce_enable = fw_ssd_get_option('woocommerce-switch');

	$deal_is_available = true;

	if( couponhut_get_field('limited_deal') == 'yes' && $woocommerce_enable['woocommerce-picker'] == 'yes' && !empty(couponhut_get_field('woocommerce_price')) && couponhut_get_field('show_pricing_fields') ) { 
		$deals_available = couponhut_get_field('deals_available') ? couponhut_get_field('deals_available') : 0;

		if ( $deals_available < 1 ) {
			$deal_is_available = false;
		}
	}

	if ( $deal_is_available ) {
		
		if ( !couponhut_get_field('expiring_date') || $current_date < couponhut_get_field('expiring_date') ) {

			if ( $woocommerce_enable['woocommerce-picker'] == 'yes' && couponhut_get_field('show_pricing_fields') && !empty(couponhut_get_field('woocommerce_price')) ) {
			?>
				<div class="woocommerce">
					<form class="cart" method="post" enctype="multipart/form-data">
						<div class="quantity hidden">
							<input type="hidden" class="qty" name="quantity" value="1">
						</div>

						<button type="submit" name="add-to-cart" value="<?php echo $post->ID ?>" class="single_add_to_cart_button button alt"><?php esc_html_e('Add to cart', 'couponhut') ?></button>

					</form>
				</div>
			<?php
			} else if ( couponhut_get_field('printable_coupon')  )  {
				echo '<a href="#" class="btn btn-color btn-deal is-btn-print" data-post_id="' . get_the_ID() . '">' . fw_ssd_get_option('print-text') . '</a>';
				$print_image = couponhut_get_field('print_image');

				if ( $print_image && fw_ssd_get_option('download-coupon-switch')) {
					echo '<div class="download-deal-link">';
					echo '<a href="' . esc_url($print_image['url']) . '" target="_blank" download>' . esc_html__('or download as image', 'couponhut') . '<i class="fa fa-download"></i></a>'; 
					echo '</div>';
				}
				
			} elseif ( couponhut_get_field('deal_type') == 'discount' )  {

				$deal_redirect_url = couponhut_get_field('url') ? '?deal_redirect=' . couponhut_get_field('url') : '#';

				echo'<a href="' . esc_url($deal_redirect_url) . '" target="_blank" class="btn btn-color btn-deal" rel="nofollow" data-post_id="' . get_the_ID() . '">' . fw_ssd_get_option('buy-now-text') . '</a>';

			} else {

				$deal_redirect_url = couponhut_get_field('url') ? '?deal_redirect=' . couponhut_get_field('url') : '#';
				
				$enable_redirect = couponhut_get_field('redirect_to_offer') ? couponhut_get_field('redirect_to_offer') : array('');
				echo'<a href="' . esc_url($deal_redirect_url) . '" target="_blank" class="btn btn-color btn-deal show-coupon-code" data-target="#discount-modal" data-clipboard-text="' . esc_attr(couponhut_get_field('coupon_code')) . '" rel="nofollow" data-redirect="' . $enable_redirect[0] . '">' . fw_ssd_get_option('show-code-text') . '</a>';
			}

		} else {
			echo'<button class="btn btn-deal btn-disabled">' . esc_html__('Deal Expired', 'couponhut') . '</button>';
		}

	} else { // deal is not available
		echo'<button class="btn btn-deal btn-disabled">' . esc_html__('Deal Not Available', 'couponhut') . '</button>';
	}

	
	?>

	<?php if( couponhut_get_field('discount_value') ) : ?>
		<div class="discount-ribbon">
			<?php echo wp_kses_post(couponhut_get_field('discount_value')); ?>
		</div>
	<?php endif; ?>

	<?php if( couponhut_get_field('limited_deal') == 'yes' && $woocommerce_enable['woocommerce-picker'] == 'yes' && !empty(couponhut_get_field('woocommerce_price')) && couponhut_get_field('show_pricing_fields') ) : ?>
		<div class="limited-deal">
		<?php 
		$deals_available = couponhut_get_field('deals_available') ? couponhut_get_field('deals_available') : 0;

		if ( $deals_available > 0 ) {
			echo sprintf(wp_kses_post(fw_ssd_get_option('deals-remaining-text')), number_format($deals_available, 0, '.', ' '));
		} else {
			esc_html_e('Sorry, all deals are taken.', 'couponhut');
		}
		?>
		</div>
	<?php endif; ?>

</div><!-- end single-deal-box-inner -->


</div><!-- end single-deal-box -->