<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( !fw_ssd_woocommerce() ) {
	return false; // exit ii WooCOmmerce plugin is not activated
}

/**
 * CouponHut Deal Class.
 *
 * The default CouponHut deal.
 *
 * @class 		WC_CouponHut_Deal_Simple
 * @package		WooCommerce/Classes/Products
 * @category	Class
 * @author 		WooThemes
 */

if ( !class_exists('WC_CouponHut_Deal_Simple') ) {

	class WC_CouponHut_Deal_Simple extends WC_CouponHut_Deal {

		/**
		 * Initialize simple product.
		 *
		 * @param mixed $product
		 */
		public function __construct( $product = 0 ) {
			$this->supports[]   = 'ajax_add_to_cart';
			parent::__construct( $product );
		}

		/**
		 * Get internal type.
		 * @return string
		 */
		public function get_type() {
			return 'simple';
		}

		/**
		 * Get the add to url used mainly in loops.
		 *
		 * @return string
		 */
		public function add_to_cart_url() {
			$url = $this->is_purchasable() && $this->is_in_stock() ? remove_query_arg( 'added-to-cart', add_query_arg( 'add-to-cart', $this->id ) ) : get_permalink( $this->id );

			return apply_filters( 'woocommerce_product_add_to_cart_url', $url, $this );
		}

		/**
		 * Get the add to cart button text.
		 *
		 * @return string
		 */
		public function add_to_cart_text() {
			$text = $this->is_purchasable() && $this->is_in_stock() ? __( 'Add to cart', 'couponhut' ) : __( 'Read more', 'couponhut' );

			return apply_filters( 'woocommerce_product_add_to_cart_text', $text, $this );
		}
	}


}