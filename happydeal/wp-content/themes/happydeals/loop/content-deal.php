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
			
			


										<!-- Image Thumbnail -->
										 
											<?php if ( has_post_thumbnail() ) : ?>

											   <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"> </a>
											     
											      <div class="deal-thumb-image" class="img-responsive"> 

														<div class="prices-bg" style="height: 100%; width: 100%;background-repeat: no-repeat;"> 

   																				
															   <div class="prices">
															   <?php 
															   		$newPrice = wp_kses_post(couponhut_get_field('new_price')); 
															   		$oldPrice = wp_kses_post(couponhut_get_field('old_price')); ?>


															   	<?php if( $oldPrice == ''){

															   		echo '<b><h2 style="font-size: 24px; margin-left:-15%; margin-bottom: 3px; margin-top: 12px;" >P'.$newPrice.'</h2></b>';
															   		
															   		}else{
															   			    echo '<p>(from P'.$oldPrice.')</p>';
															   				echo '<h1>P'.$newPrice.'</h1>';

															   		}
															   		?> 



															 

															   </div>
													</div>

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


													<!-- End Image --> 
											      	  <div class="overlay" style=" background-image: url('hover.png');">
													    <!-- <div class="text"><a href="<?php  // the_permalink(); ?>"><h2>View</h2></a></div> -->
													    <div class="text2" style="display: inline-block;">
														    <ul style="margin-top: 25px;">
														    <li style="padding-left: 0;><a href="<?php the_permalink(); ?>"><img src="/icon/search.png"></a>
														    <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><img src="/icon/share.png"></a></li> 
														    <li><a href="<?php the_permalink(); ?>"><?php wpfp_link() ?></a></li>
                                                                                                                    <li>
														    <?php echo sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="button %s product_type_%s">%s</a>',
														        esc_url( '/?add-to-cart='.$post->ID ),
														        esc_attr( $post->ID ),
														        '',
														        esc_attr( '1' ),
														        'add_to_cart_button ajax_add_to_cart',
														        esc_attr( 'simple' ),
														        '<img src="/icon/addtocart.png">'
														    );
														    ?>	
                                                                                                                    </li>
														    
														   </ul> 
														   
													  </div>
													  </div>

											      </div>
											<?php endif; ?>
		</div><!-- end deal-thumb-image -->

		<div class="product-desc-f"> 
       <p class="mname"><?php  echo CFS()->get( 'merchant' ); ?></b></p>
			
			<!-- Get Title -->
			<p><a href="<?php the_permalink();?>"><?php the_title(); ?></p>

        <div class="col-sm-8 nopadding">
                	<!-- Rating -->    
                        <?php echo do_shortcode('[WPCR_SHOW POSTID="'.$post->ID.'" NUM="3" SHOWFORM="0"]'); ?>
        </div>

	
                                                                                                <div class="col-sm-4 nopadding" style="text-align: right;">
                                                                                                     <!-- Stocks Let -->
        											     <span class="stocks-left-f"> <?php echo  wp_kses_post(couponhut_get_field('deals_available'));  ?> LEFT</span>
                                                                                                     <!-- Stocks Let End-->          
                                                                                         	</div>
			<!-- Rating -->


			<!-- Pricing -->
			

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
