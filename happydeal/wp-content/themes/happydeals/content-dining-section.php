	<section class="fw-main-row" style="margin-bottom: 10px;">
		<div class="container">
			<div class="section-title-block"></div>
			<h1 class="section-title topborder">BEST DEALS</h1>
			<h2 class="section-subtitle">Travel to the country’s best vacation destinations: tranquil beaches, charming hideaways and road trips included.</h2>
			<div class="latest-deals-wrapper grid-wrapper"> </div>
		</div>
		<br>
		<br>
                                                                                 
			<div class="container" style="text-align: left; padding-left: 15px; padding-right: 15px;"> 

					<ul style="list-style-type: none;
							    margin: 0;
							    padding: 0;
							    vertical-align: middle;">

							<div class="row">

								<?php
								$params = array('posts_per_page' => 8, 'post_type' => 'deal',  'deal_category' => 'dining');
								$wc_query = new WP_Query($params);
								?>
								<?php if ($wc_query->have_posts()) : ?>
								<?php while ($wc_query->have_posts()) :
								                $wc_query->the_post(); ?>
		                        <div class="col-md-4 fade">

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

															   		echo '<b><h2>P'.$newPrice.'</h2></b>';
															   		
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
														    <li style="padding-left: 0;"><a href="<?php the_permalink(); ?>"><img src="/icon/search.png"></a>
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
														   <!-- End Price -->
													 

											   
											<?php endif; ?>
                                                                                        <div class="product-desc-f"> 
        										        <p class="mname"><?php  echo CFS()->get( 'merchant' ); ?></b></p>
                                                                                                   <!-- Get Title -->
        										        <p><a href="<?php the_permalink();?>"><?php the_title(); ?></p>
                                                                                                <div class="col-sm-8 nopadding">
                                                                                                        	<!-- Rating -->    
                                                                                                                <?php echo do_shortcode('[WPCR_SHOW POSTID="'.$post->ID.'" NUM="3" SHOWFORM="0"]'); ?>
                                                                                			<!--<div class="card-deal-meta-rating">
                                                                                                		<div class="post-star-rating">
                                                        								<i class="rating-star fa fa-star" data-post-id="<?php echo esc_attr($post->ID) ?>" data-rating="<?php echo esc_attr($rating_value); ?>"></i>
                                                        								<i class="rating-star fa fa-star" data-post-id="<?php echo esc_attr($post->ID) ?>" data-rating="<?php echo esc_attr($rating_value); ?>"></i>
                                                        								<i class="rating-star fa fa-star" data-post-id="<?php echo esc_attr($post->ID) ?>" data-rating="<?php echo esc_attr($rating_value); ?>"></i>
                                                        								<i class="rating-star fa fa-star" data-post-id="<?php echo esc_attr($post->ID) ?>" data-rating="<?php echo esc_attr($rating_value); ?>"></i>
                                                        								<i class="rating-star fa fa-star" data-post-id="<?php echo esc_attr($post->ID) ?>" data-rating="<?php echo esc_attr($rating_value); ?>"></i>
                                                                                				</div>
                                                                                           	</div>  -->
                                                                                                </div>
                                                                                                <div class="col-sm-4 nopadding" style="text-align: right;">
                                                                                                     <!-- Stocks Let -->
        											     <span class="stocks-left-f"> <?php echo  wp_kses_post(couponhut_get_field('deals_available'));  ?> LEFT</span>
                                                                                                     <!-- Stocks Let End-->          
                                                                                         	</div>
                                                                                        </div>
										<!-- Get Category -->
                                                                                        
                                                                                                                        
    									                                      
										
		
						
							</div>
									<?php endwhile; ?>
									<?php wp_reset_postdata(); ?>
									<?php else:  ?>
									<p>
									     <?php _e( 'No Products'); ?>
									</p>



									<?php endif; ?>

						</ul>
					</div>		



					</div>

		</div>
	</section>
