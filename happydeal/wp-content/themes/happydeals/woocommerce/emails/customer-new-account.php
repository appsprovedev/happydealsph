<?php
/**
 * Customer new account email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-new-account.php.
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
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}         
        $user = get_user_by('login', $user_login);
        $user_id =  $user->ID;       
        
        $scret_code = md5($user_id . time());
        update_user_meta($user_id, "wcemailverifiedcode", $scret_code);
         
        $createLink = $scret_code . "@" . $user_id ;
        $hyperlink = add_query_arg(array("woo_confirmation_verify" => base64_encode($createLink)), get_permalink( get_option('woocommerce_myaccount_page_id') ) );

        //    $hyperlink = get_the_permalink($this->my_account) . "?woo_confirmation_verify=" . base64_encode($createLink);
        $link = "<a href='" . $hyperlink . "'>".$hyperlink."</a>";
        
        $email_heading = '';
        
        $user_info = get_userdata($user_id);
        $first_name = $user_info->first_name;
?>

<?php do_action( 'woocommerce_email_header', $email_heading, $email ); ?>   

<h1>Hi! <?php echo $first_name; ?></h1> 
<h2 style="font-size: 30px; text-align: center;">Welcome to Happy Deals</h2>        

<p style="margin-bottom: 10px;">Don't miss the bliss!</p>
<p style="margin-bottom: 10px;">Thank you so much for signing up with us. You now have a whole new world of shopping that fits right in your pocket. From discounted vouchers, to affordable products, we have them all in one place.</p>
<p style="margin-bottom: 10px;">We hope you enjoy all the perks of being a HappyDeals shopper.</p>
<p style="margin-bottom: 10px;">Kindly click the link to verify your account: <?php echo $link; ?></p>
<p></p>
<p style="margin-bottom: 10px;">Happy Shopping!</p>          



<?php //do_action( 'woocommerce_email_footer', $email );
