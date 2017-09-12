<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<div class="phoen_rewpts_order_report_table_div"><?php _e('REWARD POINTS DETAIL','phoen-rewpts'); ?></div>

<table class="wp-list-table widefat fixed striped customers">
				
	<thead>
		
		<tr class="phoen_rewpts_user_reward_point_tr">
			
			<th class=" column-customer_name " scope="col"><span><?php _e('EMAIL ID','phoen-rewpts'); ?></span>
				
			</th>

			<th class=" column-spent" scope="col"><span><?php _e('REWARD POINTS','phoen-rewpts'); ?></span>
				
			</th>

			<th class=" column-spent" scope="col"><span><?php _e('POINTS USED','phoen-rewpts'); ?></span>
				
			</th>
	
			<th class=" column-spent" scope="col"><span><?php _e('AMOUNT IN WALLET','phoen-rewpts'); ?></span>
				
			</th>

		</tr>
		
	</thead>	
	
	<tbody>	
			<?php 
			global $woocommerce;
			
			$curr=get_woocommerce_currency_symbol();
			
			$argsm    = array('posts_per_page' => -1, 'post_type' => 'shop_order','post_status'=>array_keys(wc_get_order_statuses()));
			
			$products_order = get_posts( $argsm ); 
			
			$user_detail=get_users();
						
			for($a=0;$a<count($user_detail);$a++) 	{
				
				$total_point_reward=0;
				
				$order_count=0;
				
				$amount_spent=0;
				
				$id=$user_detail[$a]->ID;
				
				
				
					?>
					<tr><td class="customer_name " ><?php echo $user_detail[$a]->user_email; ?></td>
					
					<?php 	
				
					$gen_val = get_option('phoe_rewpts_value');
					
					$reward_point=isset($gen_val['reward_point'])?$gen_val['reward_point']:'';
					
					$reedem_point=isset($gen_val['reedem_point'])?$gen_val['reedem_point']:'';
					
					$reward_money=isset($gen_val['reward_money'])?$gen_val['reward_money']:'';
					
					$reedem_money=isset($gen_val['reedem_money'])?$gen_val['reedem_money']:'';
                                        
                                        $reward_referral_point =  isset($gen_val['reward_referral_point'])?$gen_val['reward_referral_point']:'';
					
					$reward_value=$reward_point/$reward_money;
					
					$reedem_value=$reedem_point/$reedem_money;
                                        
                                          
                                 /* get reviews points */
                                 $reviews = get_reviews_by_user($id);
                                 $point_reward = count( $reviews ) * $reward_point;
                                 $total_point_reward+=$point_reward;
        		        
                                
                                /* get referral points */
                              
                               
        			$cur_email = $user_detail[$a]->user_email; 
                                $referral_id = get_referral_id( $id );
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
                                 
                                 
                                          $total_point_reward;
					  $used_point_reward = 0;
					for($i=0;$i<count($products_order);$i++)  	{	
					
						$products_detail=get_post_meta($products_order[$i]->ID); 
						
						$gen_settings=get_post_meta( $products_order[$i]->ID, 'phoe_rewpts_order_status', true );
						
						if(($products_detail['_customer_user'][0]==$user_detail[$a]->ID)&&(is_array($gen_settings)))
						{
							 
							
														
							if($products_order[$i]->post_status=="wc-completed")
        						{
                						$gen_settings=get_post_meta( $products_order[$i]->ID, 'phoe_rewpts_order_status', true );
                        					$used_reward_point=isset($gen_settings['used_reward_point'])?$gen_settings['used_reward_point']:'';
                        					$used_point_reward+=$used_reward_point;
        						}
							
							
							
						}
						
					} 			?>
					
					<td class="customer_name " ><?php echo round($total_point_reward); ?></td>
					
					<td class=" column-email" ><?php echo str_replace('-','',$used_point_reward); ?></td>
					
					<td class=" column-spent" ><?php 
                                        $total_point_reward_a =  $total_point_reward+$used_point_reward;
                                        echo $curr.round($total_point_reward_a/$reedem_value,2); ?></td></tr>
					
					<?php 	
				
				
			}
			
				?>
	</tbody>
	
	<tfoot>
					
		<tr class="phoen_rewpts_user_reward_point_tr">
		
			<th class=" column-customer_name " scope="col"><span><?php _e('EMAIL ID','phoen-rewpts'); ?></span>
				
			</th>

			<th class=" column-spent" scope="col"><span><?php _e('REWARD POINTS','phoen-rewpts'); ?></span>
				
			</th>

			<th class=" column-spent" scope="col"><span><?php _e('POINTS USED','phoen-rewpts'); ?></span>
				
			</th>
	
			<th class=" column-spent" scope="col"><span><?php _e('AMOUNT IN WALLET','phoen-rewpts'); ?></span>
				
			</th>

		</tr>
		
	</tfoot>	
</table>

<?php 

function phoen_order_count($id) {
	
	global $woocommerce;
			
	$curr=get_woocommerce_currency_symbol();
	
	$argsm    = array('posts_per_page' => -1, 'post_type' => 'shop_order','post_status'=>array_keys(wc_get_order_statuses()));
	
	$products_order = get_posts( $argsm ); 
	
	$user_detail=get_user_by('id',$id);
		
	$order_count=0;
		
	$customer_orders = get_posts( array(
		'numberposts' => -1,
		'meta_key'    => '_customer_user',
		'meta_value'  => $id,
		'post_type'   => wc_get_order_types(),
		'post_status' => array_keys( wc_get_order_statuses() )
	) );
		
	for($i=0;$i<count($customer_orders);$i++)  	{	
	
		$products_detail=get_post_meta($customer_orders[$i]->ID); 
		$gen_settings=get_post_meta( $customer_orders[$i]->ID, 'phoe_rewpts_order_status', true );
		if(($customer_orders[$i]->post_status=="wc-completed")||($customer_orders[$i]->post_status=="wc-refunded")&&(is_array($gen_settings)))
		{
							
		$order_count++;
		}
					

	}

	return $order_count;
}

?>