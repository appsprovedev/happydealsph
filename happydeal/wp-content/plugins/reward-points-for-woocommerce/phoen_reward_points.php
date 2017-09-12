<?php 

/*
** Plugin Name: Happy Deals Rewards Program

** Plugin URI: https://example.com

** Description: It is a plugin which provides the customers to get the reward points on the basis of the  purchase of the products or the money spent by them.

** Version: 1.3

** Author: appsprovve

** Text Domain: appsprove

** Author URI: http://appsprove.com

** License: GPLv2 or later

** License URI: http://www.gnu.org/licenses/gpl-2.0.html

**/  

if ( ! defined( 'ABSPATH' ) ) exit;
	
		
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	
		define('PHOEN_REWPTSPLUGURL',plugins_url(  "/", __FILE__));
	
		define('PHOEN_REWPTSPLUGPATH',plugin_dir_path(  __FILE__));
			
		function phoe_rewpts_menu_booking() {
			
			add_menu_page('Phoeniixx_Reward_pts',__( 'Reward Points', 'phoen-rewpts' ) ,'nosuchcapability','Phoeniixx_Reward_pts',NULL, PHOEN_REWPTSPLUGURL.'assets/images/aa2.png' ,'57.1');
			
			add_submenu_page( 'Phoeniixx_Reward_pts', 'Phoeniixx_reward_settings', 'Settings','manage_options', 'Phoeniixx_reward_settings',  'Phoeniixx_reward_settings_func' );
			
			add_submenu_page( 'Phoeniixx_Reward_pts', 'Phoeniixx_reward_order', 'Customers Report','manage_options', 'Phoeniixx_reward_order',  'phoeniixx_rewpts_check_order_admin' );
	
		}
		
		add_action('admin_menu', 'phoe_rewpts_menu_booking');
	
		add_action('wp_head','phoen_rewpts_frontend_func');
		
		add_action('admin_head','phoen_rewpts_backend_func');

		function phoen_rewpts_frontend_func(){
				
			
		include_once(PHOEN_REWPTSPLUGPATH.'includes/phoen_rewpts_frontend.php');
				
		}
		
		function phoen_rewpts_backend_func(){
				
			wp_enqueue_style( 'phoen_rewpts_backend_func_css', PHOEN_REWPTSPLUGURL. "assets/css/phoen_rewpts_backend.css" );	
			wp_enqueue_script( 'phoen_rewpts_backend_func_js', PHOEN_REWPTSPLUGURL. "assets/js/phoen_rewpts_backend.js" );	
			wp_enqueue_style( 'wp-color-picker');
			
			wp_enqueue_script( 'wp-color-picker');
		
			
		}
		function phoeniixx_rewpts_check_order_admin()
		{	
			// reward points per user shown in admin panel
			include_once(PHOEN_REWPTSPLUGPATH.'includes/phoeniixx_rewpts_admin_panel.php');
			
		}
		
		
		//setting Tab
		
		function Phoeniixx_reward_settings_func() 	{ ?>
				
			<div id="profile-page" class="wrap">
		
				<?php
					if(isset($_GET['tab']))
						
					{
						$tab = sanitize_text_field( $_GET['tab'] );
						
					}
					else
						
					{
						
						$tab="";
						
					}
					
				?>
				<h2> <?php _e('Reward Points For Woocommerce','phoen-rewpts'); ?></h2>
				
				<?php $tab = (isset($_GET['tab']))?$_GET['tab']:'';?>
				
				<h2 class="nav-tab-wrapper woo-nav-tab-wrapper">
				
					<a class="nav-tab <?php if($tab == 'phoen_rewpts_setting' || $tab == ''){ echo esc_html( "nav-tab-active" ); } ?>" href="?page=Phoeniixx_reward_settings&amp;tab=phoen_rewpts_setting"><?php _e('Settings','phoen-rewpts'); ?></a>
					
				
					
				</h2>
				
			</div>
			
			<?php
			
			if($tab == 'phoen_rewpts_setting'|| $tab == ''){
				
				include_once(PHOEN_REWPTSPLUGPATH.'includes/phoeniixx_reward_pagesetting.php');
				
			}
			if($tab == 'phoen_rewpts_styling'){
				
				include_once(PHOEN_REWPTSPLUGPATH.'includes/phoeniixx_reward_styling.php');
				
			}
			
			if($tab == 'phoen_rewpts_premium'){
				
				include_once(PHOEN_REWPTSPLUGPATH.'includes/phoen_reward_premium.php');
				
			}
			
			
		}
		
		// shows message on cart for apply or remove reward points
		
		function phoen_rewpts_action_woocommerce_before_cal_table() { 
				
			$current_user = wp_get_current_user();
    
			global $woocommerce;
			
			$curr=get_woocommerce_currency_symbol();
			
			$gen_val = get_option('phoe_rewpts_value');  
					
			$reward_point=isset($gen_val['reward_point'])?$gen_val['reward_point']:'';
			
			$reedem_point=isset($gen_val['reedem_point'])?$gen_val['reedem_point']:'';
			
			$reward_money=isset($gen_val['reward_money'])?$gen_val['reward_money']:'';
			
			$reedem_money=isset($gen_val['reedem_money'])?$gen_val['reedem_money']:'';
			
			$reward_value=$reward_point/$reward_money;
			
			$reedem_value=$reedem_point/$reedem_money;

			$total_point_reward=phoen_rewpts_user_reward_point();
				
			$amt=round($total_point_reward/$reedem_value,2);
					
			$bill_price=$woocommerce->cart->cart_contents_total;
						
			if((round($total_point_reward)!=0)||((int)$total_point_reward>0))
			{
				?>
								<div class="phoen_rewpts_pts_link_div_main">
				<?php 
				if($bill_price>=$amt)
					
				{	
				echo "<div class='phoen_rewpts_redeem_message_on_cart'>You can apply ".round($total_point_reward). " Points to get ".$curr.$amt." Discount.</div>";
				
				}
				else if ($bill_price<$amt)
				{
					echo "<div class='phoen_rewpts_redeem_message_on_cart'>You can apply ".round($reedem_value*$bill_price). " Points to get ".$curr.$bill_price." Discount.</div>";
				
					
				}
				$gen_settings=get_option('phoen_rewpts_custom_btn_styling');
	
				$apply_btn_title    = (isset($gen_settings['apply_btn_title']))?( $gen_settings['apply_btn_title'] ):'APPLY POINTS';
				$remove_btn_title    = (isset($gen_settings['remove_btn_title']))?( $gen_settings['remove_btn_title'] ):'REMOVE POINTS';
							
				?>
				<div class="phoen_rewpts_pts_link_div">
			
					<form method="post" action="">
					
						<input type="submit" class="button primary"  value="<?php echo $apply_btn_title; ?>" name="apply_points">&nbsp;
						
						<input type="submit" class="button primary"  value="<?php echo $remove_btn_title; ?>" name="remove_points">
					
					</form>
			
				</div>
			 </div>
				<?php  
			} 
		}
		
		// returns user reward amount
		
		function phoen_rewpts_user_reward_amount()
		{
			
			$total_point_reward=phoen_rewpts_user_reward_point();
			
			$gen_val = get_option('phoe_rewpts_value');
					
			$reward_point=isset($gen_val['reward_point'])?$gen_val['reward_point']:'';
			
			$reedem_point=isset($gen_val['reedem_point'])?$gen_val['reedem_point']:'';
			
			$reward_money=isset($gen_val['reward_money'])?$gen_val['reward_money']:'';
			
			$reedem_money=isset($gen_val['reedem_money'])?$gen_val['reedem_money']:'';
			
			$reward_value=$reward_point/$reward_money;
			
			$reedem_value=$reedem_point/$reedem_money;
		
			return round($total_point_reward/$reedem_value,2);
			
		}
		
		//return user reward points
		function phoen_rewpts_user_reward_point()	{
			
			//$current_user = wp_get_current_user();   
			
			global $woocommerce;
			
			$curr=get_woocommerce_currency_symbol();
		
                	$user_detail=get_users();
		
			$total_point_reward=0;
			
			$amount_spent=0;
			$order_count=0;
			
			$gen_val = get_option('phoe_rewpts_value');      
                        
                                                                                                
			
			$reward_point=isset($gen_val['reward_point'])?$gen_val['reward_point']:'';
			
			$reedem_point=isset($gen_val['reedem_point'])?$gen_val['reedem_point']:'';
			
			$reward_money=isset($gen_val['reward_money'])?$gen_val['reward_money']:'1';
			
			$reedem_money=isset($gen_val['reedem_money'])?$gen_val['reedem_money']:'';
                        
                        $reward_referral_point =  isset($gen_val['reward_referral_point'])?$gen_val['reward_referral_point']:'';
			
			$reward_value=$reward_point/$reward_money;
			
			$reedem_value=$reedem_point/$reedem_money;
			
			$current_user = wp_get_current_user();
			$cur_email = $current_user->user_email;
			
		
                        
                        /* get reviews points */
                         $reviews = get_reviews_by_user();
                         $point_reward = count( $reviews ) * $reward_point;
                         $total_point_reward+=$point_reward;
		        
                        
                        /* get referral points */
                      
                        $current_user = wp_get_current_user();
			$cur_email = $current_user->user_email; 
                        $referral_id = get_referral_id( $current_user->ID );
                        $orders = get_order_by_coupon($referral_id);    
                        
                          if (count($orders) > 0) {
                                 foreach ($orders as $order) { 
                                                                    
                                        $products_detail=get_post_meta($order->order_id);
                                       	$order_email_id = $products_detail['_billing_email'][0];
                                        if ($order_email_id  != $cur_email ) {
                                                $total_point_reward+=$reward_referral_point;
                                        }
                                        
                                }
                        }
                
                                                                              
                        
                        /* get used points */
                        
                        $argsm    = array('posts_per_page' => -1, 'post_type' => 'shop_order','post_status'=>array_keys(wc_get_order_statuses()));
			
			$products_order = get_posts( $argsm ); 
			
			$user_detail=get_users();
                	
			for($i=0;$i<count($products_order);$i++)  	{	
				
				$products_detail=get_post_meta($products_order[$i]->ID); 
				
				$gen_settings=get_post_meta( $products_order[$i]->ID, 'phoe_rewpts_order_status', true );
			
		              	$order_email_id = $products_detail['_billing_email'][0];
				                                                       
				if(($order_email_id==$cur_email) && (is_array($gen_settings)))
				{
                                        	if($products_order[$i]->post_status=="wc-completed")
						{
        						$gen_settings=get_post_meta( $products_order[$i]->ID, 'phoe_rewpts_order_status', true );
                					$used_reward_point=isset($gen_settings['used_reward_point'])?$gen_settings['used_reward_point']:'';
                					$used_point_reward+=$used_reward_point;
						}
                                                        
					
				}
				
			} 
                        
                        $total_point_reward+= $used_point_reward;                                       
                       
			return $total_point_reward;
				
		}
		
		
		// save data in post meta when click on checkout in order page
		function phoen_rewpts_click_on_checkout_action( $order_id ){
						
			$gen_val = get_option('phoe_rewpts_value');
			
			$reward_point=isset($gen_val['reward_point'])?$gen_val['reward_point']:'';
			
			$reedem_point=isset($gen_val['reedem_point'])?$gen_val['reedem_point']:'';
			
			$reward_money=isset($gen_val['reward_money'])?$gen_val['reward_money']:'';
			
			$reedem_money=isset($gen_val['reedem_money'])?$gen_val['reedem_money']:'';
			
			$reward_value=$reward_point/$reward_money;
			
			$reedem_value=$reedem_point/$reedem_money;
			
			$reedem_amt=phoen_rewpts_user_reward_amount();
			
			$reedem_point=phoen_rewpts_user_reward_point();
			
			$order_detail=get_post_meta($order_id);
			
			$bill_price=$order_detail['_order_total'][0];
			
			global $woocommerce;
			
			$used_reward_amount=$woocommerce->cart->fees[0]->amount;
			
			$used_reward_point=$used_reward_amount*$reedem_value;
			
			$get_reward_point=$bill_price*$reward_value;
		   
			$phoe_rewpts_value = array(
						 
				'phoen_reward_enable'=>1,
				
				'total_reward_point'=>$reedem_point, //total reward points
				
				'total_reward_amount'=>$reedem_amt,  //total reward amount
				
				'used_reward_point'=>$used_reward_point, // get used reward point if used
				
				'used_reward_amount'=>$used_reward_amount, // get used reward amount if used
				
				'points_per_price'=>$reward_value, //POINTS PER PRICE
				
				'reedem_per_price'=>$reedem_value, //REEDEM PER PRICE
				
				'get_reward_point'=>$get_reward_point, //get reward points from shopping
				
				'get_reward_amount'=>$bill_price // order amount
				
			);

		   update_post_meta( $order_id, 'phoe_rewpts_order_status', $phoe_rewpts_value );

		   session_destroy();
		}
		
	

		//add and display reward points to total if click on rmove points
		
		function phoen_rewpts_woo_add_cart_fee() {
				 
		  global $woocommerce;
		
			$curr=get_woocommerce_currency_symbol();
			
			$amt=phoen_rewpts_user_reward_amount();
			
		$bill_price=$woocommerce->cart->cart_contents_total;
			
		$u_price=0;
		
		if($amt>=$bill_price) 	{
			
			$u_price=$bill_price; 
		 
		}
		else if($amt<$bill_price){
			
			$u_price=$amt;
			
		} 
		
			//$woocommerce->cart->add_fee( __('Reward Amount', 'woocommerce'), "-".$amt ); 
			
			$woocommerce->cart->add_fee( __('Reward Amount', 'woocommerce'), "-".$u_price ); 
		}
		
		// activation hook function
		
		function phoe_rewpts_activation_func() 	{
			
			$phoen_setting_data = get_option('phoe_rewpts_value');
			
			if(empty($phoen_setting_data)){
				
				$phoe_rewpts_value = array(
		
					'enable_plugin'=>1,
				
					'reward_point'=>1,
					
					'reward_money'=>1,
					
					'reedem_point'=>100,
			
					'reedem_money'=>1,
                                        
                                        'reward_referral_point' => 1      
                                        
                                        
				
				);
									
					update_option('phoe_rewpts_value',$phoe_rewpts_value);
				
			}			
				
			
		}
		
		// shows number of points to get on cart page
		function phoen_rewpts_action_get_reward_points() {
			
			$gen_val = get_option('phoe_rewpts_value');
			
			$reward_point=isset($gen_val['reward_point'])?$gen_val['reward_point']:'';
			
			$reedem_point=isset($gen_val['reedem_point'])?$gen_val['reedem_point']:'';
			
			$reward_money=isset($gen_val['reward_money'])?$gen_val['reward_money']:'';
			
			$reedem_money=isset($gen_val['reedem_money'])?$gen_val['reedem_money']:'';
			
			$reward_value=$reward_point/$reward_money;
			
			$reedem_value=$reedem_point/$reedem_money;
			
			global $woocommerce;
			
			if(isset($woocommerce->cart->fees[0])){
				
				$used_reward_amount = $woocommerce->cart->fees[0]->amount;
			}
			else{
				$used_reward_amount = 0;
			}
			
			$bill_price=$woocommerce->cart->cart_contents_total;
			
			if(round(($bill_price+$used_reward_amount)*$reward_value)!=0) 	{
				
				echo "<div class='phoen_rewpts_reward_message_on_cart'>You will get ".round(($bill_price+$used_reward_amount)*$reward_value)." points on completing this order.</div>";
			}
			
		}
                
                 function phoen_rewpts_account_page_show_code() {

        	$referral_id = get_referral_id( get_current_user_id() );
                return $referral_id;
	}
        
        function generate_user_coupon() {
		$randomString = 'ref';
                $characters = "0123456789";
        	    for ($i = 0; $i < 7; $i++) {
        	        $randomString .= $characters[rand(0, strlen($characters) - 1)];
        	    }
	    
                return $randomString;
              
	}
        
        function get_referral_id($user_id) {

		if ( !$user_id ) {
			return false;
		}
                
                $user_info = get_userdata($user_id);
		$user_email = $user_info->user_email;
		
                
		$referralID = get_user_meta($user_id, "gens_referral_id", true);
		if($referralID && $referralID != "") {
			return $referralID;
		} else {
			do{
                            $referralID = generate_user_coupon();  
			} while (exists_ref_id($referralID));
                        $coupon = array(
			'post_title' => $referralID,
			'post_excerpt' => 'Referral coupon for: '.$user_email,
			'post_status' => 'publish',
			'post_author' => 1,
			'post_type'  => 'shop_coupon'
		);
							
		$new_coupon_id = wp_insert_post( $coupon );

		// Add meta
		update_post_meta( $new_coupon_id, 'discount_type', 'fixed_cart' );
		update_post_meta( $new_coupon_id, 'coupon_amount', 100 );
		update_post_meta( $new_coupon_id, 'individual_use', 'yes' );
		update_post_meta( $new_coupon_id, 'product_ids', '' );
		update_post_meta( $new_coupon_id, 'customer_email', '' );
		update_post_meta( $new_coupon_id, 'exclude_product_ids', '' );
		update_post_meta( $new_coupon_id, 'usage_limit_per_user', '1' ); // Only one coupon
		update_post_meta( $new_coupon_id, 'expiry_date', '' );
		update_post_meta( $new_coupon_id, 'minimum_amount', 100 );
		update_post_meta( $new_coupon_id, 'apply_before_tax', 'yes' );
		update_post_meta( $new_coupon_id, 'free_shipping', 'no' );
                
                update_user_meta( $user_id, 'gens_referral_id', $referralID );
		
                return $referralID;
		
                }

	}
        
        
        
        function exists_ref_id($referralID) {

		$args = array('meta_key' => "gens_referral_id", 'meta_value' => $referralID );
		if (get_users($args)) {
			return true;
		} else {
			return false;
		}

	}
        
        function get_order_by_coupon($coupon_code) {
                
                global $wpdb;
                
                $query = "SELECT
                p.ID AS order_id
                FROM
                {$wpdb->prefix}posts AS p
                INNER JOIN {$wpdb->prefix}woocommerce_order_items AS woi ON p.ID = woi.order_id
                WHERE
                p.post_type = 'shop_order' AND
                p.post_status IN ('wc-completed') AND
                woi.order_item_type = 'coupon' AND
                woi.order_item_name = '" . $coupon_code ."'";
        
                $orders = $wpdb->get_results($query);
                return $orders;  

        }
        
      
		
		//remove reward points from total if click on rmove points
		function phoeniixx_rewpts_remove_fee_from_cart()
		{
			
			if(isset($_POST['remove_points'])) {	
				
				remove_action( 'woocommerce_cart_calculate_fees','phoen_rewpts_woo_add_cart_fee',10,1);    
				
				
			
				$_SESSION['action']="remove";
			}
		}
		
		//add reward points to total if click on rmove points
		function phoeniixx_rewpts_add_fee_from_cart()
		{
			if(isset($_POST['apply_points'])) 	{	
			
				add_action( 'woocommerce_cart_calculate_fees', 'phoen_rewpts_woo_add_cart_fee', 10, 1); 
				
				
			
				$_SESSION['action']="apply";
			}
		}
	
		$gen_settings = get_option('phoe_rewpts_value');
				
		$enable_plugin=isset($gen_settings['enable_plugin'])?$gen_settings['enable_plugin']:'';
		
		register_activation_hook( __FILE__, 'phoe_rewpts_activation_func');
		
		if($enable_plugin==1)
		{
			session_start();
		
			if(isset($_SESSION['action']) && $_SESSION['action']=="remove")
			{
				// remove reward points from  order or review order page when remove points click is done on cart page
				
				remove_action( 'woocommerce_cart_calculate_fees','phoen_rewpts_woo_add_cart_fee',10,1);    
				
			}
			
			if(isset($_SESSION['action']) && $_SESSION['action']=="apply")
			{
				// add reward points to  order or review order page when apply points click is done on cart page
				
				add_action( 'woocommerce_cart_calculate_fees', 'phoen_rewpts_woo_add_cart_fee', 10, 1); 
			}
			
			// add reward to cart page
			add_action( 'init', 'phoeniixx_rewpts_add_fee_from_cart', 2);
			
			//remove rewards from cart
			add_action( 'init', 'phoeniixx_rewpts_remove_fee_from_cart', 2);
			
			// save data in post meta when click on checkout in order page
			add_action( 'woocommerce_checkout_order_processed', 'phoen_rewpts_click_on_checkout_action',  1, 1  );
			
			//show message to add or remove rewards
			add_action( 'woocommerce_before_cart', 'phoen_rewpts_action_woocommerce_before_cal_table', 10, 0);	
			
			// shows number of points to get on cart page
			add_action( 'woocommerce_after_cart_table', 'phoen_rewpts_action_get_reward_points', 10, 0);	
		}	
		
	}else{
		
		add_action('admin_notices', 'phoen_rewpts_admin_notice');

		function phoen_rewpts_admin_notice() {
			
			global $current_user ;
				
				$user_id = $current_user->ID;
				
				/* Check that the user hasn't already clicked to ignore the message */
			
			if ( ! get_user_meta($user_id, 'phoen_rewpts_ignore_notice') ) {
				
				echo '<div class="error"><p>'; 
				
				printf(__('Woocommerce Reward Points could not detect an active Woocommerce plugin. Make sure you have activated it. | <a href="%1$s">Hide Notice</a>'), '?phoen_rewpts_nag_ignore=0');
				
				echo "</p></div>";
			}
		}

		add_action('admin_init', 'phoen_rewpts_nag_ignore');

		function phoen_rewpts_nag_ignore() {
			
			global $current_user;
				
				$user_id = $current_user->ID;
				
				/* If user clicks to ignore the notice, add that to their user meta */
				
				if ( isset($_GET['phoen_rewpts_nag_ignore']) && '0' == $_GET['phoen_rewpts_nag_ignore'] ) {
					
					add_user_meta($user_id, 'phoen_rewpts_ignore_notice', 'true', true);
				}
		}
		
         }
         
         
       
        
        
        ?>
