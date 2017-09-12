<?php
/**
 * Order Item Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-item.php.
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

if ( ! apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
	return;
}
?>
<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_order_item_class', 'woocommerce-table__line-item order_item', $item, $order ) ); ?>">

	<td class="woocommerce-table__product-name product-name">
		<?php
			$is_visible        = $product && $product->is_visible();
			$product_permalink = apply_filters( 'woocommerce_order_item_permalink', $is_visible ? $product->get_permalink( $item ) : '', $item, $order );

			echo apply_filters( 'woocommerce_order_item_name', $product_permalink ? sprintf( '<a href="%s">%s</a>', $product_permalink, $item->get_name() ) : $item->get_name(), $item, $is_visible );
			echo apply_filters( 'woocommerce_order_item_quantity_html', ' <strong class="product-quantity">' . sprintf( '&times; %s', $item->get_quantity() ) . '</strong>', $item );

			do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $order );

			wc_display_item_meta( $item );
			wc_display_item_downloads( $item );
                        
                          

			do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $order );
		?>
	</td>

	<td class="woocommerce-table__product-total product-total">
		<?php echo $order->get_formatted_line_subtotal( $item ); ?>
	</td>

</tr>

<?php 
 /* RFD */
$deal_id = $item->get_meta('deal_id');
$vouchers =  get_voucher_codes($order->ID, $deal_id);
                        
if (count($vouchers) > 0 ): ?>
        <tr class="woocommerce-table__product-purchase-note product-purchase-note">
        
        	<td colspan="2">
                        <table id="voucher-details" class="table table-condensed">
                                <thead>
                                        <tr>
                                                <td>Voucher No.</td>
                                                <td>Voucher Code</td>
                                                <td>Payment Status</td>
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
                </td>
        
        </tr>
<?php 
endif; 
/*CSD*/
?>


<?php if ( $show_purchase_note && $purchase_note ) : ?>

<tr class="woocommerce-table__product-purchase-note product-purchase-note">

	<td colspan="3"><?php echo wpautop( do_shortcode( wp_kses_post( $purchase_note ) ) ); ?></td>

</tr>

<?php endif; ?>