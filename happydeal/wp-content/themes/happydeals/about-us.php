<?php
/**
 Template Name: about us
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

<div class="container-fluid imgBG" style='background-image: url("/images/about-us.jpg"); padding-left: 0; padding-right: 0; width: 100%;'>


		<div class="row">
			<div class="text-bg">
				<div class="col-md-4" style="		padding-top: 300px;
													padding-bottom: 100px;"	
													>
					<h1>Why Partner with Us? </h1>
					<p> 300+ merchants could not have been wrong.<br>
					that's because we're not just a deal site </p>
				</div>
			</div>
		</div>

</div>


<div class="container">
	<div class="col-md-12">
		<div class="row">
			<h2> COMMUNITY </h2>
			<h3> Build great neigborhoods </h3>
			<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
		</div>		
		<div class="row">
			<h2> OWNERSHIP & PERFORMANCE</h2>
			<h3> Build great neigborhoods </h3>
			<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
		</div>		
		<div class="row">
			<h2> INSPIRATION </h2>
			<h3> Build great neigborhoods </h3>
			<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
		</div>		
		<div class="row">
			<h2> RESPECT INTEGRETIY & INCLUSION </h2>
			<h3> Build great neigborhoods </h3>
			<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
		</div>		
		<div class="row">
			<h2> CUSTOMERS </h2>
			<h3> Build great neigborhoods </h3>
			<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
		</div>
		

	</div>
</div>
<style type="text/css">
	.text-bg{
		margin-left: 15%;
		color: #fff;
	}

	.imgBG img{
		 width: 100%;

	}

	hr {
    display: block;
    height: 1px;
    border: 0;
    border-top: 1px solid #ccc;
    margin: 1em 0;
    padding: 0;
}
</style>

<?php get_footer();?>