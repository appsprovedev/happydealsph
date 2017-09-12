<?php
/**
 Template Name: HomePage
 */
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 */
set_query_var( 'show_form', true ); 
get_header(); 
if (!is_user_logged_in()) {
        $counter = 0;
} else {
        $favorite_post_ids = wpfp_get_user_meta();

        if (isset($favorite_post_ids)) {
                $counter = count($favorite_post_ids);
        } else {
               $counter = 0; 
        }       
 
 }  

?>



<!-- Sidebar -->
	<div class="item sideBarNav  hidden-xs" style="position: fixed; float: left;  display: inline-flex; z-index: 1; background-color: #f0f0f0 !important; margin-top: 18% !important;"> 
			<table>
		       <tr>
		            <td style="padding:5px">
		              <a href="/my-account/my-favorites/">  <img src="sidebar/favorites.png" style="width: 130%;" /> </a>
		              </td>
		            <td style="padding:5px">
		               <span id="favorite_counter" style="color: #41C1C1; font-weight: bold;"><?php echo $counter  ?></span>
 		             </td>
		        </tr>

		    </table>
	</div>

<!-- Cart -->
	<!--<div class="cartRight pull-right hidden-xs">
        <img src="sliderforcart.png" class="img-responsive pull-right" width="60%">
 
	</div> -->

	<style type="text/css">

		.cartRight {

			position: fixed;
			float: right;
	
			display: block;
			 z-index: 1 !important;	
			 top: 160px;
			 right: -260px;
			 height: 55%;

		}



	</style>


	<script type="text/javascript">
	 // $('.first-section').load('.fw-main-rows');
		// $('.ham-menu').click(function(){
		//   $('.first-section').toggle();
		// })
	</script>

<!-- Slider -->

	<?php 

		get_template_part( 'content', 'sliders' );

	?>

<!-- Best Deals Section -->

<div  id="cart-right-display">

	<?php 

		get_template_part( 'content', 'best-deal-section' );

	?>
		

<!-- Dining Section -->
	<?php 

	 get_template_part( 'content', 'dining-section' );

	?>	

<!-- Get Aways-->
	
	<?php 

	get_template_part( 'content', 'get-away-section' );

	?>

<!-- Beauty and Fitness-->
	<?php 

		get_template_part( 'content', 'beauty-and-fitness' );

	?>

</div>

<?php get_footer();?>