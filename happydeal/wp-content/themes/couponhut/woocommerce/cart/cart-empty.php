<?php
/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

wc_print_notices();

?>

<p class="cart-empty">
	<?php esc_html_e( 'Your cart is currently empty.', 'couponhut' ) ?>
</p>

<?php do_action( 'woocommerce_cart_is_empty' ); ?>

<?php 
$template_url = fw_ssd_get_browse_template_url();
if ( $template_url ) :
?>

<p class="return-to-shop">
	<a class="button wc-backward" href="<?php echo esc_url( $template_url ); ?>">
		<?php esc_html_e( 'Return To Deals', 'couponhut' ) ?>
	</a>
</p>
<?php endif; ?>