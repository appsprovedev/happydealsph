<?php
if ( !class_exists('CouponHut_Main_Menu_Walker') ) {
	class CouponHut_Main_Menu_Walker extends Walker_Nav_Menu {

		// override parent method
		function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
			$id = $element->object_id;
			if ( $id == fw_ssd_get_submit_template_id() ) {

				$allow_no_reg = fw_ssd_get_option('member-submit-switch');
				$allow_no_company = fw_ssd_get_option('member-submit-without-company-switch');

				if ( fw_ssd_woocommerce() && !is_user_logged_in() && !$allow_no_reg ) {
					return;
				}

				if ( fw_ssd_woocommerce() && is_user_logged_in() && !$allow_no_reg && !get_user_meta( get_current_user_id(), 'user_company_name', true ) && !$allow_no_company  ) {
					return;
				}	
			}
			parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}  

	}
}