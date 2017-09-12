<?php
/**
 * Orders
 *
 * Shows orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/orders.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_account_orders', $has_orders ); ?>     

<?php if ( $has_orders ) : ?>
        <h2 class="my-account-ptitle">Your Purchases</h2>
        <div class="row">
             <div class="list-group">
         	<?php 
                 
                 foreach ( $customer_orders->orders as $customer_order ) :
                        $order_id = wc_get_order_id_by_order_key($customer_order->order_key);
                        $order      = wc_get_order( $order_id );
			$item_count = $order->get_item_count();
			$items = $order->get_items();
                        
                      
                   ?>  
                        
                  <?php foreach ( $items as $item_id => $item ) :
                  
                  if ( apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
                       $product = $item->get_product();
                        //check if deal
                       $deal_id = $item->get_meta('deal_id');
                       
                       
	               	if ( get_post_type($deal_id) == 'deal' ) {
                              	if ( couponhut_get_field('image', $deal_id) ) {
			 	   $image = couponhut_get_field('image', $deal_id);
			 	} 
                                
                          $companies = get_the_terms( $deal_id, 'deal_company' );
                          $deal_price =  get_post_meta($deal_id, 'new_price', true);
                          $old_price =  get_post_meta($deal_id, 'old_price', true);
                          $quantity = $item->get_quantity();
                          $purchase_date = $order->order_date;
                          $vouchers =  get_voucher_codes($order_id, $deal_id);
                          $subtotal = $order->get_formatted_line_subtotal( $item );
                          
                          
                        
                        } //end deal post type
                          
                  }
                           
                        
                           
                                                                                                                                                               
                   ?>                                   
                  <div class="list-group-item deal-item">
                      <div class="row">
                      <div class="col-md-6 nopadding">
                               <?php 
                                if( isset($image) ) {
                                echo '<div class="pull-left">
                                <img style="height: 50px; margin-right: 10px;" src="' . esc_url( $image['sizes']['ssd_deal-thumb'] ) .'" alt="' . esc_attr( $image['alt'] ) . '">
                                </div>';
                                }   
                                echo '<h2>'. $companies[0]->name .'</h2>';
                                echo '<h3><a href="' . get_permalink($deal_id) . '">' . $item['name'] . '</a></h3>';
                               ?>
                               
                         </div>
                      <div class="col-md-6">
                                <div class="deal-item-info">
                                     <ul>
                                        <li>Purchased on: <?php echo $purchase_date; ?></li>
                                        <li>Voucher Price: <?php echo wc_price($deal_price); ?> </li>
                                        <li>Vouchers: <?php echo $quantity; ?> x <a href="<?php echo get_permalink($deal_id); ?>">(Buy More)</a></li>
                                        <li>Total Amount: <?php echo  $subtotal ; ?> </li>  
                                        <li>You Save: <?php echo $deal_price; ?> </li>                                        
                                      </ul>  
                                </div>
                      </div>
                      
                      <div class="col-sm-12 nopadding">
                      <?php if (count($vouchers) > 0 ): ?>
                        
                        <table id="voucher-details" class="table table-condensed">
                                <thead>
                                        <tr>
                                                <td>Voucher No.</td>
                                                <td>Voucher Code</td>
                                                <td>Status</td>
                                                <td>View your voucher</td>
                                        </tr>
                                </thead>
                                <tbody>
                                <?php 
                                   $count = 1;
                                   foreach ($vouchers as $voucher): ?>
                                        <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td><?php echo $voucher['voucher_code'][0]; ?></td>
                                        <td><?php echo ($voucher['voucher_status'][0] == 'active' || $voucher['voucher_status'][0] == 'new') ?  'Paid' : ''; ?></td>
                                        <td><a target="_blank" href="<?php echo get_post_permalink($voucher['id'][0]); ?>">View</a></td>
                                         </tr>
                                 <?php  endforeach;  ?>
                                </tbody>
                        </table>
                
<?php 
endif; 
/*CSD*/
?>
                             
                       </div>                                              
                      </div>                                               
                  </div>
                  <?php endforeach; ?>
                 <?php endforeach; ?>
             </div>
        
        </div>
	

	<?php do_action( 'woocommerce_before_account_orders_pagination' ); ?>

	<?php if ( 1 < $customer_orders->max_num_pages ) : ?>
		<div class="woocommerce-pagination woocommerce-pagination--without-numbers woocommerce-Pagination">
			<?php if ( 1 !== $current_page ) : ?>
				<a class="woocommerce-button woocommerce-button--previous woocommerce-Button woocommerce-Button--previous button" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page - 1 ) ); ?>"><?php _e( 'Previous', 'woocommerce' ); ?></a>
			<?php endif; ?>

			<?php if ( intval( $customer_orders->max_num_pages ) !== $current_page ) : ?>
				<a class="woocommerce-button woocommerce-button--next woocommerce-Button woocommerce-Button--next button" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page + 1 ) ); ?>"><?php _e( 'Next', 'woocommerce' ); ?></a>
			<?php endif; ?>
		</div>
	<?php endif; ?>

<?php else : ?>
	<div class="woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">
		<a class="woocommerce-Button button" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
			<?php _e( 'Go shop', 'woocommerce' ) ?>
		</a>
		<?php _e( 'No order has been made yet.', 'woocommerce' ); ?>
	</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_account_orders', $has_orders ); ?>
