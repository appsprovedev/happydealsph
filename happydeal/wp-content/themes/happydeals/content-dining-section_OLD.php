	<section class="fw-main-row" style="margin-bottom: 100px;">
		<div class="fw-container">
		<h1 class="section-title3" style="text-align: center;"> DEALS </h1>
			<div class="section-title-block"></div>
			<h1 class="section-title2"> DINING</h1>
			<div class="latest-deals-wrapper grid-wrapper"> </div>
		</div>


			<div class="container" style="text-align: left;"> 

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
		                        <div class="col-md-3">
							

										<!-- Image Thumbnail -->
										 
											<?php if ( has_post_thumbnail() ) : ?>

											   <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
											     
												      <div class="deal-thumb-image thumb-image-category" class="img-responsive"> 
															
															<div class="prices-bg2" style="background-image: url('pricetag2.png');
											                           height: 100%;
											                           width: 100%;
																		   background-repeat: no-repeat;"> 
																   
																   <div class="prices2"><a href="#"> 
																   <?php 
																   		$newPrice = wp_kses_post(couponhut_get_field('new_price')); 
																   		$oldPrice = wp_kses_post(couponhut_get_field('old_price')); ?>


																   	<?php if( $oldPrice == ''){

																   		echo '<h2>P'.$newPrice.'</h2>';
																   		
																   		}else{
																   			    echo '<p>(from P'.$oldPrice.')</p>';
																   				echo '<h1>P'.$newPrice.'</h1>';

																   		}
																   		?> 

															   </a></div>
													</div>

											      	<?php $img_url = wp_get_attachment_image_src(get_post_thumbnail_id(),'kev-feature'); ?>
													<img src="<?php echo $img_url[0] ;?>"/>
											      	  <div class="overlay2" style=" background-image: url('hover2.png');">
													    <!-- <div class="text"><a href="<?php  // the_permalink(); ?>"><h2>View</h2></a></div> -->
													    <div class="text3" style="display: inline-block;">
														    
														    <a href="<?php the_permalink(); ?>">	<li> <img src="/icon/search.png"></li> </a>
														    <a href="<?php the_permalink(); ?>">	<li> <img src="/icon/share.png"></li> </a>
														    <a href="<?php the_permalink(); ?>">	<li> <img src="/icon/favorites.png"></li> </a>
														    <a href="<?php the_permalink(); ?>">	<li> <img src="/icon/addtocart.png"></li> </a>
														   
														   
														    
														   
													  </div>
													  </div>

											      </div>
													 

											    </a>
											<?php endif; ?>
										

										
										<!-- Post Rating -->
										<div class="card-meta-rating">
											 <?php
												global $post;

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

												<meta style="display:none;" itemprop="worstRating" content="1"/>
												<meta style="display:none;" itemprop="bestRating" content="5" />
												<meta style="display:none;" itemprop="ratingValue" content="<?php echo $rating_average; ?>">

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
												<span class="rating-text"> (<span class="rating-count"><?php echo wp_kses_post($rating_count_total); ?></span> <span class="rates" itemprop="reviewCount"><?php ( ($rating_count_total == 1) ? esc_html_e('review', 'couponhut') : esc_html_e('reviews', 'couponhut') ) ?></span>)</span>
										</div>


										<!-- Get Title -->
										<a href="<?php the_permalink();?>">  <p style="height: 65px; color: #A6968A; font-size: 18px; margin-bottom: 10px; "> <?php the_title(); ?> </p> </a>
										<!-- Get Category -->
										<p style="height: 40px; color: #FFB715 !important; font-size: 18px; margin-bottom: 10px; "><?php echo get_the_term_list( $post->ID, 'deal_category' );  ?></p>

										

										
								




										


						
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
