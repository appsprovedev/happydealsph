<?php

$voucher_details = get_post_meta($post->ID);
$voucher_code = $voucher_details['voucher_code'][0];
$deal_id = $voucher_details['deal_id'][0];
$order_id = $voucher_details['order_id'][0];

$order = wc_get_order( $order_id );
$user = $order->get_user();

// Check if user is logged and if this is a deal for registered users only
if ( fw_ssd_woocommerce() && !is_user_logged_in() ) {
	$user_has_access = false;
} else {
	$user_has_access = true;
}


if ( !$user_has_access ) {
	$url_login = wc_get_page_id( 'myaccount' ) ? get_permalink( wc_get_page_id( 'myaccount' ) ) : '';
	wp_redirect( $url_login);
	exit;
}





get_header();
?>

<?php 
//Deal info

$query = new WP_Query( array( 'post_type' => 'deal', 'post__in' => array( $deal_id ) ) );

              

 if ($query->have_posts()) : $query->the_post(); ?>


	
        <?php 
        $redemption = 'service'; 
        $companies = get_the_terms( get_the_ID(), 'deal_company' );
        
        ?>
        
	<div class="single-deal-wrapper single-voucher-wrapper" itemscope itemtype="http://schema.org/Product">

	<div class="container">

		<div class="row">
			<div class="col-sm-12 col-md-12">
                                <div class="col-md-8">
                                        <div class="deal-v">
                                                Non-refundable
                                        </div>
                                 </div> 
                                 <div class="col-md-4">
                                      <img src="/logo.png" alt="logo" >
                                 </div>       
                                
                                        
                           
				<div class="single-deal-content single-voucher-content">
                                        <div class="voucher-details col-md-12 ">
                                                 <div class="voucher-details-content col-md-8 ">
                                                <div class="qr-code pull-left">
                                                  <?php echo do_shortcode('[qrcode content="'.$voucher_code.'" size="190" alt="'.$voucher_code.'" class="qr_code"]'); ?> 
                                                </div>
                                                
                                                <div class="col-sm-4">
                                                        <div class="voucher-code">
                                                              Voucher Code:
                                                              <span><?php echo $voucher_code; ?></span>
                                                        </div>
                                                        
                                                        <div>
                                                            Redemption: <span class="voucher-code-redemption"><?php echo $redemption; ?></span>
                                                            <div class="redemption-l">Redeem in store</div>
                                                            
                                                        </div>
                                                </div>
                                                <div class="row">
                                                        <div class="col-md-12">
                                                        <h1><?php the_title(); ?></h1>
                                                        <h2>
                                                            Merchant: <a href="<?php echo esc_url(get_term_link($companies[0])); ?>"><span itemprop="name"><?php echo wp_kses_post($companies[0]->name); ?></span></a>
                                                        </h2>
                                                        
                                                        <div class="redeemable">
                                                               Redeemable at: 
                                                        </div>
                                                        
                                                        <div>
                                                           <div class="pull-left">
                                                               MAP
                                                           </div>
                                                           <div class="contact_details col-sm-6">
                                                               <?php echo get_field('contact_us'); ?>
                                                           </div>
                                                           
                                                        </div>
                                                </div>
                                                </div>
                                        </div>
                             
				</div>
                                
                               <div class="row deal-other-details">
                                    <div class="col-md-6">
                                         <h3 class="deal-desc-title">Deal Description</h3>
                                         <p><?php echo get_field('about_this_deal'); ?> </p>
                                         
                                    </div>
                                    <div class="col-md-6">
                                         <h3 class="deal-desc-title">Terms and Conditions</h3>
                                         <p><?php echo get_field('terms_and_condition'); ?> </p>
                                    </div>
                               </div> 
                               
                               <div class="row">
                                    <div class="col-md-12 fmessage">
                                        <p class="messagewborder">
                                            If you have issues or concerns kindly call us at (02) 985-1629, Mondays to Fridays 6am to 11pm and<br/>
                                            Saturdays & Sundays 9am to 6pm.
                                        </p>
                                        <p>HOW TO USE THIS COUPON: 1. Save via mobile QR code, 2. Present in store.
                                        
                                    </div>
                               </div> 
			</div><!-- end col-sm-8 col-md-9 -->

			<div class="col-md-12 single-voucher-action" itemscope itemtype="http://schema.org/Offer">
                               
                                
			
                                 <a class="btn btn-primary noslimstat" href="#" rel="nofollow" onclick="window.print(); return false;">Print</a>
                                 <a class="btn btn-warning download-btn" href="<?php echo get_permalink($voucher_post_id) . '?output=pdf'; ?>" rel="nofollow">Download</a>
	
			</div><!-- end col-sm-3 -->

		</div><!-- end row -->
		
                </div>
	</div><!-- end container -->

</div><!-- end single-deal-wrapper -->


<?php endif;?>
<?php
get_footer();
?>