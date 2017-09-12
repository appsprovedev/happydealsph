<?php
/* Template Name: Review */

if( !is_user_logged_in() )
{
    wp_redirect('/my-account/?redirect_to=' . $_SERVER["REQUEST_URI"]);
}

if (!isset($_GET['pid']) || !isset($_GET['email'])  || $_GET['email'] == '' || $_GET['pid'] == '') {
     wp_redirect('/my-account/');   
}

$reviewer_email = $_GET['email'];
$reviewer_rating = $_GET['rate'];
$rating_width = $_GET['rate'] * 20;
$post_id = $_GET['pid'];
$reviewthis = get_post($post_id);

$title = $reviewthis->post_title;
$type =   $reviewthis->post_type;
$reviewer = get_user_by_email($reviewer_email);


global $current_user;
get_currentuserinfo();
$error = '';

if ($reviewer->ID != $current_user->ID ) {
     echo   $error = 'You are not authorized to view this page.';
}


if ( $type == 'deal' ) { 
        if ( couponhut_get_field('image', $reviewthis->ID) ) {
           $image = couponhut_get_field('image', $reviewthis->ID);
        } 
        
        $companies = get_the_terms( $reviewthis->ID, 'deal_company' );
} 


get_header();

?>
<style>
 .logged-in-as {
        display: none;
 }
 
 .wpcr3_review_form_text_field td {
    padding-bottom: 10px;     
 }  
 
 .wpcr3_div_2 {
        width: 100%;
        margin-top: 30px;
 }     
 
 .wpcr3_submit_btn {
        background: #F5924F;
        border-radius: 10px;   
        text-transform: uppercase;
        color: #fff;                
 }    
 

</style>

<div id="post-<?php the_ID(); ?>" <?php post_class('page-wrapper'); ?> class="review-page">
                       
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="container">
			<div class="page-content">
                        <h1>Reviews</h1>
			       <div class="row deal-item" style="border-bottom: 1px solid #B0B0B0; padding-bottom: 15px;">
                                        <div class="col-md-5 nopadding">
                                                <div class="pull-left">
                                                        <img style="height: 50px; margin-right: 10px;" src="<?php echo esc_url( $image['sizes']['ssd_deal-thumb'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ) ?>">
                                                </div>
                                                <h2><?php echo  $companies[0]->name; ?></h2>
                                                <h3><a href="<?php echo get_permalink($reviewthis->ID); ?>"><?php echo $reviewthis->post_title; ?></a></h3>
                                         </div>
                                         <div class="col-md-5 pull-right">
                                               
                                         </div>
                               </div>
			  
                          
                          
                          <?php if ($error != '') { ?>
                          
                          <?php } else { ?>
                          <div class="row">
                        <div class="col-md-8">
                             <div data-wpcr3-content="<?php echo $reviewthis->ID; ?>">
                             <div class='wpcr3_respond_1 '  data-ajaxurl='["http:||dev","happydeals","ph|wp-admin|admin-ajax","php?action=wpcr3-ajax"]' data-on-postid='1377' data-postid='<?php echo $reviewthis->ID; ?>'>
                                <div class="wpcr3_respond_2" style="display: block;">
                                        <div class="wpcr3_div_2">
                                        <input maxlength="150" class="text-input " type="hidden" id="wpcr3_fname" name="wpcr3_fname" value="<?php echo $current_user->first_name; ?>" />
                                        <input maxlength="150" class="text-input " type="hidden" id="wpcr3_femail" name="wpcr3_femail" value="<?php echo $current_user->user_email; ?>" />
                                        
                                                <div class="wpcr3_table_2">
                                                       
                                                               <div class="wpcr3_review_form_text_field form-group">
                                                                        <label for="wpcr3_ftitle" class="comment-field">Title: </label>
                                                                        <input maxlength="150" class="text-input form-control " type="text" id="wpcr3_ftitle" name="wpcr3_ftitle" value="" />
                                                                </div>
                                                                <div class="wpcr3_review_form_rating_field form-group">
                                                                        <label for="id_wpcr3_frating" class="comment-field">Rating: </label>
                                                                       
                                                                          <div class="wpcr3_rating_stars" style="position: relative;">
                                                                                <div class="wpcr3_rating_style1">
                                                                                        <div class="wpcr3_rating_style1_status wpcr3_hide">
                                                                                                <div class="wpcr3_rating_style1_score">
                                                                                                        <div class="wpcr3_rating_style1_score1">1</div>
                                                                                                        <div class="wpcr3_rating_style1_score2">2</div>
                                                                                                        <div class="wpcr3_rating_style1_score3">3</div>
                                                                                                        <div class="wpcr3_rating_style1_score4">4</div>
                                                                                                        <div class="wpcr3_rating_style1_score5">5</div>
                                                                                                </div>
                                                                                        </div>
                                                                                        <div class="wpcr3_rating_style1_base">
                                                                                        <div class="wpcr3_rating_style1_average" style="width:<?php echo $rating_width; ?>%;"></div>
                                                                                        </div>
                                                                                </div>
                                                                                
                                                                              <img style="cursor: pointer;position: absolute; left: 100px;" src="<?php echo bloginfo('stylesheet_directory');?>/assets/images/clicktorate.png" id="clicktorate">   
                                                                        </div>
                                                                       
                                                                        <input style="display: none;" type="hidden" class="wpcr3_required wpcr3_frating" id="id_wpcr3_frating" name="wpcr3_frating" value="<?php echo $reviewer_rating; ?>" />
                                                                        </div>
                                                                <div class="wpcr3_review_form_review_field_label form-group">
                                                                       <label for="id_wpcr3_ftext" class="comment-field">Review: </label></td>
                                                               
                                                                
                                                                        <textarea class="wpcr3_required wpcr3_ftext form-control" id="id_wpcr3_ftext" name="wpcr3_ftext" rows="8" cols="50"></textarea></td>
                                                                </div>
                                                                <div class="form-group">
                                                                        
                                                                                <input type="hidden" name="wpcr3_postid" value="<?php echo $reviewthis->ID; ?>" /><input type="text" class="wpcr3_fakehide wpcr3_fake_website" name="website" />
                                                                                <input type="text" class="wpcr3_fakehide wpcr3_fake_url" name="url" /><input type="checkbox" class="wpcr3_fakehide wpcr3_fconfirm1" name="wpcr3_fconfirm1" value="1" />
                                                                                
                                                                <label><input type="checkbox" name="wpcr3_fconfirm2" class="wpcr3_fconfirm2" value="1" />&nbsp; Check this box to confirm you are human.</label>
                                                                <input type="checkbox" class="wpcr3_fakehide wpcr3_fconfirm3" name="wpcr3_fconfirm3" checked="checked" value="1" />
                                                                </div>
                                                                
                                                                <div class="wpcr3_button_1 wpcr3_submit_btn pull-right" href="javascript:void(0);">Submit you review</div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div style="display: none;" class="wpcr3_button_1 wpcr3_cancel_btn" href="javascript:void(0);">Cancel</div>
                                                                
                                                                </div>
                                                                </div>
                                                                <div class="wpcr3_clear wpcr3_pb5"></div>
                                                                <div class="wpcr3_dotline">
                                                                </div>
                                                                <div class="wpcr3_reviews_holder">
                                                                <div class="wpcr3_review_item"></div>
                                                                </div>
                                                                </div>
                                                                </div>
                                                                </div> 
                             <?php // echo do_shortcode('[WPCR_SHOW POSTID="'.$post_id.'" SHOWFORM="1" ]'); ?>
                               </div>
                               </div>
                           <?php } ?>
                          
                          
			</div>
		</div>

	<?php endwhile; else : ?>

		<div class="no-posts-wrapper">
			<h3><?php esc_html_e('Sorry, no posts found.', 'couponhut'); ?></h3>
		</div>

	<?php endif; ?>
	
</div><!-- end post -->

<?php get_footer(); ?>