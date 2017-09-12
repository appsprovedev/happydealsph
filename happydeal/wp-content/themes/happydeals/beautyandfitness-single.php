<?php
/**
 Template Name: beauty and fitness
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
        $counter = count($favorite_post_ids);
}

?>



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



		

<!-- Dining Section -->
	<?php 

get_template_part( 'content', 'beauty-and-fitness' );

	?>	



<?php get_footer();?>
