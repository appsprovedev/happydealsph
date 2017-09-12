<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


$custom_account_birthdate = get_user_meta( $user->ID, 'custom_account_birthdate', true );
$custom_account_gender = get_user_meta( $user->ID, 'custom_account_gender', true );



do_action( 'woocommerce_before_edit_account_form' ); ?>



<form class="woocommerce-EditAccountForm edit-account" action="" method="post">

	<?php do_action( 'woocommerce_edit_account_form_start' ); ?>
        <div class="row">
        <h2 class="my-account-ptitle">Account Settings</h2>
        <div class="col-md-8">
        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
		<label for="account_email"><?php _e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span></label>
		<input type="email" class="woocommerce-Input woocommerce-Input--email input-text" name="account_email" id="account_email" value="<?php echo esc_attr( $user->user_email ); ?>" />
	</p>
        
	<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
		<label for="account_first_name"><?php _e( 'First name', 'woocommerce' ); ?> <span class="required">*</span></label>
		<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_first_name" id="account_first_name" value="<?php echo esc_attr( $user->first_name ); ?>" />
	</p>
	<p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
		<label for="account_last_name"><?php _e( 'Last name', 'woocommerce' ); ?> <span class="required">*</span></label>
		<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_last_name" id="account_last_name" value="<?php echo esc_attr( $user->last_name ); ?>" />
	</p>
	
        </div>
        <div class="col-md-4">
             <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
		<label for="account_email"><?php _e( 'Birthday', 'woocommerce' ); ?></label>
		<input type="date" class="woocommerce-Input input-text" name="custom_account_birthdate" id="account_birthdate" value="<?php echo esc_attr( $custom_account_birthdate ); ?>" />
	</p>
        
        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
		<label for="account_email"><?php _e( 'Gender', 'woocommerce' ); ?></label>
		<label class="radio-inline"><input name="custom_account_gender" type="radio" value="Male" <?php echo ($custom_account_gender == "Male") ? ' checked="checked" ' : ''; ?>>Male</label>
                <label class="radio-inline"><input name="custom_account_gender" type="radio" value="Female" <?php echo ($custom_account_gender == "Female") ? ' checked="checked" ' : ''; ?>>Female</label>
	</p>

        </div>
        </div>
        
        <div class="row">
        <?php 	
        
        $customer_id = get_current_user_id();
        global $woocommerce;
        $checkout = $woocommerce->checkout();
        
       
         ?>
        <div class="col-md-6" style="padding: 0 10px;">
                <h2 class="my-account-ptitle" style="margin-top: 40px; margin-bottom: 0;">Billing Address</h2>
	<fieldset>
	        <div class="col-sm-12">
                
               <?php  foreach ($checkout->checkout_fields['billing'] as $key => $field) :
        woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
        endforeach;
                ?>
                </div>      
       	</fieldset>
        </div>
        <div class="col-md-6" style="padding: 0 10px;">
                <h2 class="my-account-ptitle" style="margin-top: 40px; margin-bottom: 0;">Shipping Address</h2>
      	<fieldset>
                <div class="col-sm-12" style="background-color: #F1F1F1;">
                
               <?php  foreach ($checkout->checkout_fields['shipping'] as $key => $field) :
        woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
        endforeach;
                ?>
                </div>
	</fieldset>
        </div>
        </div>

        <div class="row">
	<fieldset>
		<h2 class="my-account-ptitle" style="margin-top: 40px;">Change Password</h2>
            <div class="col-md-8">
		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			<label for="password_current"><?php _e( 'Old Password', 'woocommerce' ); ?></label>
			<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_current" id="password_current" />
		</p>
		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			<label for="password_1"><?php _e( 'New Password', 'woocommerce' ); ?></label>
			<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_1" id="password_1" />
		</p>
		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			<label for="password_2"><?php _e( 'Confirm Password', 'woocommerce' ); ?></label>
			<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_2" id="password_2" />
		</p>
             </div>   
	</fieldset>
        </div>
	<div class="clear"></div>

	<?php do_action( 'woocommerce_edit_account_form' ); ?>

	<p>
		<?php wp_nonce_field( 'save_account_details' ); ?>
		<input style="margin-top: 50px;" type="submit" class="woocommerce-Button button pull-right btn-sub" name="save_account_details" value="<?php esc_attr_e( 'Save', 'woocommerce' ); ?>" />
		<input type="hidden" name="action" value="save_account_details" />
	</p>

	<?php do_action( 'woocommerce_edit_account_form_end' ); ?>
</form>

<?php do_action( 'woocommerce_after_edit_account_form' ); ?>
