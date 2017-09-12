<?php
/**
 Template Name: why partner with us
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

<div class="container-fluid" style='background-image: url("/images/partners-with-us.jpg"); padding-left: 0; padding-right: 0;'>


		<div class="row">
			<div class="text-bg">
				<div class="col-md-4" style="		padding-top: 100px;
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

<br>
<br>

	<div class="row">
		<div class="col-md-6">
			<h3> Increased Brand Awareness</h3>
			<p>Grow your online presence and amplify your audience reach through itegrated promotion channels. </p>
		</div>		

		<div class="col-md-6">
			<h3> Monitor Consumer Behaviour</h3>
			<p>Gain access to real-time insights regarding consumer behaviour through customer feedbacks and analytics.</p>
		</div>
	</div>	
	<br>
	<br>
	<br>
	<div class="row">
		<div class="col-md-6">
			<h3> X-Deal Packages</h3>
			<p>No cash our for outdoors ad placements and online promotions. Maximize the cost-efficiency of your services to empower your brand.. </p>
		</div>		

		<div class="col-md-6">
			<h3> Ease of use</h3>
			<p>Both for consumers and merchants. User friendly process of purchase for the convinience of consumers. Merchants can track purchases and redemptions made by consumers.</p>
		</div>
	</div>

<br>
<br>
</div>


<div class="container-fluid" style='background-image: url("/images/partners-with-us01.jpg"); padding-left: 0; padding-right: 0;'>


		<div class="row">
			<div class="text-bg">
				<div class="col-md-10" style="		padding-top: 100px;
													padding-bottom: 100px;
													text-align: center;
													"	
														>

													
					<h3>Want to know how our X-Deal services<br>
					can help your business grow?</h3>
					<h2> Contact us.</h2>
				
				</div>
			</div>
		</div>

</div>




		<div class="row">
			<div class="text-bg">
				<div class="col-md-10" style="		padding-top: 50px;
													padding-bottom: 50px;
													color: #5F5F5F;
													
													"	
														>

													
					<h3>Sign up form contents: <br> <br>
						<form>
							<div class="col-md-6">
								<div class="row">
								  <div class="form-group col-md-6">
								    <label for="exampleInputEmail1">Name of Business</label>
								    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  >
							
								  </div>					  

								  <div class="form-group col-md-6">
								    <label for="exampleInputEmail1">Type of Business</label>
								    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
							
								  </div>	
								</div>										

								<div class="row">
								  <div class="form-group col-md-6">
								    <label for="exampleInputEmail1">Name</label>
								    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  >
							
								  </div>					  

								  <div class="form-group col-md-6">
								    <label for="exampleInputEmail1">Contact Number</label>
								    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
							
								  </div>	
								</div>										

								<div class="row">
								  <div class="form-group col-md-6">
								    <label for="exampleInputEmail1">Email Address</label>
								    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  >
							
								  </div>					  


								</div>					  
							 </div>

							  <div class="form-group col-md-6">
							    <label for="exampleInputEmail1">Message to us</label>
							    <textarea  type="textarea" rows="10" cols="70" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" > </textarea>

						
							  </div>
						  <br>
						  <button type="submit" class="btn btn-primary">Submit</button>
						</form>
				</div>
			</div>
		</div>


		<div class="container" style="color: #5F5F5F">
		<hr/>

		<br>

		<h1> Take your brand further </h1>
		<h2> Tel No: 02 637 4444  &nbsp;&nbsp;&nbsp; Email address: team@happydeals.ph </h2>

			<br>
			<br>
		</div>



<style type="text/css">
	.text-bg{
		margin-left: 15%;
		color: #fff;
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