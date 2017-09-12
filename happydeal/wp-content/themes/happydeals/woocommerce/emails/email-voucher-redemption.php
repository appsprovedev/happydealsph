<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$product_info = get_post($email_info['pid']);
$url = site_url( '/review/?email='. $email_info['email_to'] .'&pid='.$email_info['pid']); 
$companies = get_the_terms( $email_info['pid'], 'deal_company' ); 

$text_align = is_rtl() ? 'right' : 'left';
do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<div style="text-align: center; margin-top: 5px;">
 <h1 style="color: #44bc99; font-size: 20px;">Hello! <?php echo $email_info['username']; ?>!</h1>  
 <p style="font-color: #565656;">We hope you enjoyed your deal at <?php echo wp_kses_post($companies[0]->name); ?><br/>
 Would you mind telling us how was your<br/>Happy Deals experience?</p> 
 <h2 style="font-size: 16px; text-align: center; font-color: #565656; ">REDEMPTION FOR</h2>
 <div style="overflow: auto; width: 400px; margin: 0 auto; margin-top: 20px;">
     <div style="float: left; width: 175px"><?php
     
      $image = couponhut_get_field('image', $product_info->ID); 
      ?>
      <img style="width: 170px;" src="<?php echo $image['sizes']['ssd_blog-thumb'];?>">
      </div>
     <div style="float: left; width: 150px; text-align: left; padding-left: 15px;">
             <h3 style="font-size: 14px; color: #FFB715; text-align: left; margin: 0;">
             <?php echo wp_kses_post($companies[0]->name); ?></h3>
             <p style="color: #37BB93; font-size: 12px; padding: 5px 0; margin: 0; text-align: left;"><?php echo $product_info->post_title ?></p>
             <img style="width: 115px; text-align: left; float: left;" src="<?php echo get_stylesheet_directory_uri() .'/email-images/successful.png' ?>">  
     </div>     
 </div>  
</div>
</td>
</tr>
</table>

<table border="0" cellpadding="20" cellspacing="0" width="600"  style="background: #45BB99">
<tr>
<td style="padding:10px 25px 30px 25px;">
<div style="text-align: center;">
     <h3 style="font-size: 16px; color: #FFF; text-align: center; border-bottom: 1px solid #88D5C1; padding-bottom: 10px; "><?php echo wp_kses_post($companies[0]->name); ?></h3>
     <p style="font-size: 20px; color: #fff; font-weight: bold;">Help us improve our service <br/>by clicking stars below</p>
     <div style="width: 100%; overflow: auto;">
        <div style="width: 50%; float: left;">
        <a href="<?php echo $url . '&rate=5';?>" style="display: inline-block;width: 240px;background: #fff;text-align: center;float: left;border-radius: 20px;padding: 10px 0;height: 40px;text-decoration: none; "><?php echo genrating('5','Excellent'); ?></a>
        </div>
        <div style="width: 50%; float: left;">
        <a href="<?php echo $url . '&rate=4';?>" style="display: inline-block;width: 240px;background: #fff;text-align: center;float: right;border-radius: 20px;padding: 10px 0;height: 40px;text-decoration: none; "><?php echo genrating('4','Good'); ?></a>
        </div>
     </div>
     <div style="width: 100%; margin-top: 20px; overflow: auto;">
        <div style="width: 50%; float: left;">
        <a href="<?php echo $url . '&rate=3';?>" style="display: inline-block;width: 240px;background: #fff;text-align: center;float: left;border-radius: 20px;padding: 10px 0;height: 40px;text-decoration: none; "><?php echo genrating('3','OK'); ?></a>
        </div>
        <div style="width: 50%; float: left;">
        <a href="<?php echo $url . '&rate=2';?>" style="display: inline-block;width: 240px;background: #fff;text-align: center;float: right;border-radius: 20px;padding: 10px 0;height: 40px;text-decoration: none; "><?php echo genrating('2','Bad'); ?></a>
        </div>
     </div>
     
     <div style="width: 100%; margin-top: 20px; overflow: auto;">
        <a href="<?php echo $url . '&rate=1';?>" style="display: inline-block;width: 240px;background: #fff;text-align: center; border-radius: 20px;padding: 10px 0;height: 40px;text-decoration: none; "><?php echo genrating('1','Very Bad'); ?></a>
       </div>
     
     
</div>

</td>
</tr>
</table>
<table border="0" cellpadding="20" cellspacing="0" width="600"  style="background: #fff">
<tr>
<td style="padding:0;">

<div>
        <img src="<?php echo get_stylesheet_directory_uri() .'/email-images/banner-sample.png' ?>" style="width: 100%;">
</div>

</td>
</tr>
</table>
<table border="0" cellpadding="20" cellspacing="0" width="600"  style="background: #fff">
<tr>
<td style="padding:40px 25px;">
<div>
<!-- Latest deals -->

<?php

 $args = array('showposts' => 4, 'post_type' => 'deal');
 $display_posts = query_posts( $args );
 
 if (count($display_posts) > 0 ) { ?>
        <ul style="margin-left: -2.5%; padding: 0;">
        <?php 
        foreach ($display_posts as $post) {  ?>
        <?php 
                $image = couponhut_get_field('image', $post->ID); 
                $companies = get_the_terms( $post->ID, 'deal_company' );
                 
         ?>
        <li style="width: 21.5%; display: inline-block; padding: 0; margin: 0 0 2.5% 2.5%; background: none; border: 0; vertical-align: top; box-shadow: none; box-sizing: border-box; -moz-box-sizing: border-box; -webkit-box-sizing: border-box;">
                
                <a href="<?php echo get_permalink($post->ID); ?>" style="display: inline-block;">
                <img style="width: 100%; vertical-align: middle; object-fit: cover; height: 124px; " src="<?php echo esc_url( $image['sizes']['ssd_deal-thumb'] );?>"> </a>
                            
                 <?php $n = 0;
                        $r = 5;
                        $d =  5 - $r;
                        while ($n++ < $r) { ?>  
                                 <img style="width: 8px;" src="<?php echo get_stylesheet_directory_uri() .'/email-images/star1.png' ?>">
                        <?php } 
                        $n = 0;
                        while ($n++ < $d) { ?>  
                                 <img style="width: 8px;" src="<?php echo get_stylesheet_directory_uri() .'/email-images/star2.png' ?>">
                        <?php } ?>  
                <h4 style="color: #44BC99; font-size: 10px; margin: 0;"> <?php echo  wp_kses_post(couponhut_get_field('deals_available',$post->ID));  ?> Stocks Left </h4>        
                <p style="font-size: 10px; margin: 0;"><a href="<?php echo get_permalink($post->ID); ?>"><?php echo $product_info->post_title ?></a></p>  
                <h2 style="font-size: 10px; color: #FFB715; margin: 0;"><?php echo wp_kses_post($companies[0]->name); ?></h2>
                <div>
                              <?php 
        	   		$newPrice = wp_kses_post(couponhut_get_field('new_price', $post->ID )); 
        	   		$oldPrice = wp_kses_post(couponhut_get_field('old_price', $post->ID )); ?>
        
        
        	   	<?php if( $oldPrice == ''){
        
        	   		echo '<p style="font-size: 10px; margin: 0; font-weight: bold;" >P'.$newPrice.'</h2></p>';
        	   		
        	   		}else{
        	   			    echo '<p style="font-size: 10px; margin: 0; font-weight: bold;">(from P'.$oldPrice.')</p>';
        	   			    echo '<p style="font-size: 10px; margin: 0; font-weight: bold;">P'.$newPrice.'</p>';
        	   		}
        	   		?> 
                     </div>    
                   
                
        </li>               
<?php  }  ?>
        </ul>
<?php }  ?>

                  <div style="text-align: center;">
                     <a href="#" style="text-decoration: none; display: nline-block; color: #fff; padding: 10px; background-color:#F1934D; font-weight: bold; text-align: center; margin-top: 15px;">view all deals</a>
                </div>
</div>






<?php do_action( 'woocommerce_email_footer', $email ); ?>

<?php 

function genrating($r, $label) {

        $n = 0;
        $d =  5 - $r;
        $return = ''; 
        $return .='<div>';
        while ($n++ < $r) {   
                 $return .='<img style="width: 15px;" src="'.get_stylesheet_directory_uri() .'/email-images/star1.png">';
        } 
        $n = 0;
        while ($n++ < $d) {  
                 $return .='<img style="width: 15px;" src="'.get_stylesheet_directory_uri() .'/email-images/star2.png">';
        } 
        
        $return .='</div>';
        
        $return .='<p style="color: #37BB93; font-size: 20px; font-weight: bold; margin: 0">'. $label .'</p>';
        
        return $return;
} 


?>