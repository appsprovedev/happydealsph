<?php
/**
 * Email Order Items
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-order-items.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$text_align = is_rtl() ? 'right' : 'left';

foreach ( $items as $item_id => $item ) :
	if ( apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
		$product = $item->get_product();
                $deal_id = $item->get_meta('deal_id');
                $vouchers =  get_voucher_codes($order->ID, $deal_id);
                $companies = get_the_terms( $deal_id, 'deal_company' );
                $deal_price =  get_post_meta($deal_id, 'new_price', true);
                $quantity = $item->get_quantity();
                $purchase_date = $order->order_date;
                $subtotal = $order->get_formatted_line_subtotal( $item );
        
                if ( get_post_type($deal_id) == 'deal' ) {
                              	if ( couponhut_get_field('image', $deal_id) ) {
			 	   $image = couponhut_get_field('image', $deal_id);
			 	} 
                }
                                
                        
		?>
		<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_order_item_class', 'order_item', $item, $order ) ); ?>">
			<td class="td" colspan="2" style="text-align:<?php echo $text_align; ?>; vertical-align:middle; border: 1px solid #eee; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; word-wrap:break-word;">
                        
                        <?php 
                                if( isset($image) ) {
                                echo '<div style="float: left;">
                                <img style="height: 50px; margin-right: 10px;" src="' . esc_url( $image['sizes']['ssd_deal-thumb'] ) .'">
                                </div>';
                                }   
                                echo '<h2 style="color: #FFB715; font-size: 16px">'. $companies[0]->name .'</h2>';
                                echo '<h3><a style="color: #84cc76;  font-size: 16px" href="' . get_permalink($deal_id) . '">' . $item['name'] . '</a></h3>';
                               ?>
                               
                        
                        </td>
			<td class="td" style="text-align: right; vertical-align:middle; border: 1px solid #eee; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;">
                        <div class="deal-item-info">
                                     <ul style="font-size: 10px; list-style-type: none;">
                                        <li>Purchased on: <?php echo $purchase_date; ?></li>
                                        <li>Voucher Price: <?php echo $subtotal ?> </li>
                                        <li>Vouchers: <?php echo $quantity; ?> x <a href="<?php echo get_permalink($deal_id); ?>">(Buy More)</a></li>
                                        <li>Total Amount: <?php echo $deal_price; ?> </li>  
                                        <li>You Save: <?php echo $deal_price; ?> </li>                                        
                                      </ul>  
                                </div>
                        
                        </td>
		
		</tr>
		<?php
                
                /* RFD */

                        
if (count($vouchers) > 0 ): ?>     
      
        <tr>
        
        	<td colspan="3">
                  <?php if (count($vouchers) > 0 ): ?>
                        
                        <table id="voucher-details" class="table table-condensed">
                                <thead>
                                        <tr>
                                                <td style="background-color: #f9f9f9;font-size: 11px;">Voucher No.</td>
                                                <td style="background-color: #f9f9f9;font-size: 11px;">Voucher Code</td>
                                                <td style="background-color: #f9f9f9;font-size: 11px;">Status</td>
                                                <td style="background-color: #f9f9f9;font-size: 11px;">View your voucher</td>
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
                </td>
        
        </tr>

<?php         

endif; 
/*CSD*/
	}

	if ( $show_purchase_note && is_object( $product ) && ( $purchase_note = $product->get_purchase_note() ) ) : ?>
		<tr>
			<td colspan="3" style="text-align:<?php echo $text_align; ?>; vertical-align:middle; border: 1px solid #eee; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;"><?php echo wpautop( do_shortcode( wp_kses_post( $purchase_note ) ) ); ?></td>
		</tr>
	<?php endif; ?>

<?php endforeach; ?>
