<?php
/**
 * Email Header
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-header.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates/Emails
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
		<title><?php echo get_bloginfo( 'name', 'display' ); ?></title>
	</head>
	<body <?php echo is_rtl() ? 'rightmargin' : 'leftmargin'; ?>="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
		<div id="wrapper" dir="<?php echo is_rtl() ? 'rtl' : 'ltr'?>">
			<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
				<tr>
					<td align="center" valign="top">
						
						<table border="0" cellpadding="0" cellspacing="0" width="600" id="template_container">
							<tr>
								<td align="center" valign="top">
									<!-- Header -->
									<table border="0" cellpadding="0" cellspacing="0" width="550" id="template_header" style="width: 100%;">
										<tr>
											<td id="header_wrapper">
												<div id="template_header_image">
							<?php
								if ( $img = get_option( 'woocommerce_email_header_image' ) ) {
									echo '<div style="float: left"><img style="width: 214px;" src="' . esc_url( $img ) . '" alt="' . get_bloginfo( 'name', 'display' ) . '" /></div>';
								}
							?>
                                                        
                                                    <div style="float: right;">
                                                         <a href="#"><img style="width: 26px;" src="<?php echo get_stylesheet_directory_uri() .'/email-images/tweet-icon.png' ?>"></a>
                                                         <a href="#"><img style="width: 26px; margin-left: 15px;" src="<?php echo get_stylesheet_directory_uri() .'/email-images/fb-icon.png' ?>"></a>
                                                         <a href="#"><img style="width: 26px; margin-left: 15px;" src="<?php echo get_stylesheet_directory_uri() .'/email-images/ig-icon.png' ?>"></a>
                                                         
                                                    </div>    
						</div>
											</td>
										</tr>
									</table>
									<!-- End Header -->
								</td>
							</tr>
							<tr>
								<td align="center" valign="top">
									<!-- Body -->    
									<table border="0" cellpadding="0" cellspacing="0" width="600" id="template_body">
										<tr>
											<td valign="top" id="body_content" align="center">
												<!-- Content -->
												<table border="0" cellpadding="20" cellspacing="0" width="550" style="background: #fff">
													<tr>
														<td valign="top" style="padding: 40px 25px;">
															<div id="body_content_inner">
                                                                                                                        <?php if ($email_heading != '') { ?>
                                                                                                                         <h1><?php echo $email_heading; ?></h1>
                                                                                                                         <?php } ?>