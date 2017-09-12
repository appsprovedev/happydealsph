<?php
/**
 * Order details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
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

$order = wc_get_order( $order_id );

$show_purchase_note    = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses', array( 'completed', 'processing' ) ) );
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
?>

<section class="woocommerce-order-details">

	<h2 class="woocommerce-order-details__title"><?php _e( 'Order Details', 'couponhut' ); ?></h2>

	<?php 
	$order_items = $order->get_items();

	foreach ($order_items as $item_id => $item) {

		$deal_id = $item->get_meta('deal_id');

		if ( get_post_type($deal_id) == 'deal' ) {

			echo '<div class="row mb40">';

			// Deal Image
			if ( couponhut_get_field('image_type', $deal_id) == 'image') {
				if ( couponhut_get_field('image', $deal_id) ) {
			 			$image = couponhut_get_field('image', $deal_id);
			 		}
			} else {

				if( couponhut_have_rows('slider', $deal_id) ) {

					$img_num = 1;

					while ( couponhut_have_rows('slider', $deal_id) ) {

						the_row();
						if ( $img_num == 1 && couponhut_get_sub_field('image', $deal_id) ) {
							$image = couponhut_get_sub_field('image', $deal_id);

						}
						$img_num++;

				 	}

				}

			}

			if( isset($image) ) {
				echo '<div class="col-sm-3">
				<img src="' . esc_url( $image['sizes']['ssd_deal-thumb'] ) .'" alt="' . esc_attr( $image['alt'] ) . '">
				</div>';
			}

			echo '<div class="col-sm-9">';

			// Deal Name
			echo '<h3><a href="' . get_permalink($deal_id) . '">' . $item['name'] . '</a></h3>';

			if ( couponhut_get_field('deal_summary', $deal_id) ) {
				echo wp_kses_post(couponhut_get_field('deal_summary', $deal_id));
			}

			if ( couponhut_get_field('printable_coupon', $deal_id)  )  {

				echo '<a href="#" class="btn btn-color btn-deal is-btn-print" data-post_id="' . $deal_id . '">' . fw_ssd_get_option('print-text') . '</a>';
				$print_image = couponhut_get_field('print_image', $deal_id);

				if ( $print_image ) {
				echo '<img src="' . esc_url($print_image['url']). '" alt="" class="image-deal-print">';
				}
				if ( $print_image && fw_ssd_get_option('download-coupon-switch')) {
					echo '<div class="download-deal-link">';
					echo '<a href="' . esc_url($print_image['url']) . '" target="_blank" download>' . esc_html__('or download as image', 'couponhut') . '<i class="fa fa-download"></i></a>'; 
					echo '</div>';
				}

			} else if ( couponhut_get_field('coupon_code', $deal_id ) ) {

				echo '<div>' . esc_html__('Your voucher code is:', 'couponhut') . couponhut_get_field('coupon_code', $deal_id ) . '</div>';

			}

			if ( couponhut_get_field('url', $deal_id) )  {
				echo '<div class="go-to-deal-link">';
				echo '<i class="fa fa-chevron-right"></i><a href="' . couponhut_get_field('url', $deal_id) . '" target="_blank">' . esc_html__('Go to the deal website.' , 'couponhut') . '</a>';
				echo '</div>';

			}

			echo '</div>';// end col-sm-9
			echo '</div>';// end row

		} // get_post_type() == deal	

	} // end foreach 
	?>

	<table class="woocommerce-table woocommerce-table--order-details shop_table order_details">

		<thead>
			<tr>
				<th class="woocommerce-table__product-name product-name"><?php _e( 'Product', 'woocommerce' ); ?></th>
				<th class="woocommerce-table__product-table product-total"><?php _e( 'Total', 'woocommerce' ); ?></th>
			</tr>
		</thead>

		<tbody>
			<?php
				foreach ( $order->get_items() as $item_id => $item ) {

					// $deal_id = $item->get_meta('deal_id');

					$product = apply_filters( 'woocommerce_order_item_product', $item->get_product(), $item );

					wc_get_template( 'order/order-details-item.php', array(
						'order'			     => $order,
						'item_id'		     => $item_id,
						'item'			     => $item,
						'show_purchase_note' => $show_purchase_note,
						'purchase_note'	     => $product ? $product->get_purchase_note() : '',
						'product'	         => $product,
						'deal_id'	         => $deal_id,
					) );
				}
			?>
			<?php do_action( 'woocommerce_order_items_table', $order ); ?>
		</tbody>

		<tfoot>
			<?php
				foreach ( $order->get_order_item_totals() as $key => $total ) {
					?>
					<tr>
						<th scope="row"><?php echo $total['label']; ?></th>
						<td><?php echo $total['value']; ?></td>
					</tr>
					<?php
				}
			?>
		</tfoot>

	</table>

	<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>

	<?php if ( $show_customer_details ) : ?>
		<?php wc_get_template( 'order/order-details-customer.php', array( 'order' =>  $order ) ); ?>
	<?php endif; ?>

</section>