<?php
if( !empty( $ssd_get_option['tracking-code']) ) {
  echo wp_kses_post( $ssd_get_option['tracking-code'] );
}
?>
<?php if( is_active_sidebar('footer1') ) : ?>



<div class="partners" style="background-color: #E8E8E8; padding-top: 2%; padding-bottom: 2%; z-index: 10;">
	<div class="container">
		<div class="row">
			<div class="col-md-6" style="text-align: center; color: #B1A399; margin-top: 3% !important;" >
				<h2 style="letter-spacing: 6px;"> FEATURED <br>PARTNERS </h2>
				<button class="btn btn-default" style="letter-spacing: 4px;">VIEW ALL</button>
			</div>

			<div class="col-md-2" style="padding-bottom: 15px;">
				<img src="/partners/01.png">
			</div>
			<div class="col-md-2" style="padding-bottom: 15px;">
				<img src="/partners/02.png">
			</div>
			<div class="col-md-2" style="padding-bottom: 15px;">
				<img src="/partners/03.png">
			</div>
			<br>
			<br>
			<div class="col-md-2">
				<img src="/partners/04.png">
			</div>
			<div class="col-md-2">
				<img src="/partners/05.png">
			</div>
			<div class="col-md-2">
				<img src="/partners/06.png">
			</div>
		</div>
	</div>
</div>

<footer class="footer">	
	<?php if ( fw_ssd_get_option('footer_image') ): ?>
		<?php $footer_img = fw_ssd_get_option('footer_image'); ?>
		<div class="bg-image parallax" data-bgimage="<?php echo esc_url($footer_img['url']); ?>"></div>
		<div class="overlay-dark"></div>
	<?php endif ?>
	
<div class="container">	
	<div class="row">
		<div class="col-md-6">
			<img src="/logo2.png">
		</div>		

		<div class="col-md-6 pull-right" style="text-align: right;">
			<p style="color: #fff;"> STAY CONNECTED </p>
			<div class="socialmedia">
				<ul>

				<li><img src="/socialmedia/twitter.png"></li>
				<li><img src="/socialmedia/facebook.png"></li>
				<li><img src="/socialmedia/instagram.png"></li>
				<li><img src="/socialmedia/youtube.png"></li>
							

				</ul>
			</div>

		</div>
	</div>

<br>
<br>

	<div class="row footer-links">
		<div class="col-md-2">
			<ul>
				<li>HOME</li>
				<li><a href="/our-partners/">PARTNERS</a></li>
				<li>SIGN UP</li>
				<li><a href="/help/">HELP</li>

			</ul>
		</div>		

		<div class="col-md-3">
			<ul>
				<li>CAREERS</li>
				<li><a href="/about-us/">ABOUT US</a></li>
				<li><a href="/why-partner-with-us/">PARTNER WITH US</a></li>
				<li><a href="/rewards/">REWARDS PROGRAM</a></li>
		
			</ul>
		</div>		

		<div class="col-md-2">
			
		</div>


		<div class="col-md-5" style="text-align: right;">
		<p> CUSTOMER SERVICE HOURS <br>
		Monday to Friday 10am - 8pm <br>
		 excluding declared holidays <br>
		 team@happydeals.com · +63 917 547 6237 <br>
		<img src="/icon/vl.png"> TERMS AND PRIVACY </p>

		</div>
	</div>
</div>



<style type="text/css">
	
	.footer-links {
	
		color: #fff;
		letter-spacing: 2px;
	}	

	.socialmedia li{

		display: inline-block;
		margin-left: 4%;
	}


</style>

</footer>

<div class="twofooter" style="background-color: #fff; height: 50px;">
	<div class="row">

	</div>	
</div>


<div class="foot" style="background-color: #D8600E; height: 20px;">
	<div class="row">
	
	</div>
</div>

<?php endif; ?>


<!-- Fade in products -->
<script type="text/javascript">
$(document).ready(function() {
    
    /* Every time the window is scrolled ... */
    $(window).scroll( function(){
    
        /* Check the location of each desired element */
        $('.fade').each( function(i){
            
            var bottom_of_object = $(this).offset().top + $(this).outerHeight();
            var bottom_of_window = $(window).scrollTop() + $(window).height();
            
            /* If the object is completely visible in the window, fade it it */
            if( bottom_of_window > bottom_of_object ){
                
                $(this).animate({'opacity':'1'},500);
                    
            }
            
        }); 
    
    });
    
});</script>

<style type="text/css">
	.hideme
{
    opacity:0;
}
</style>



<?php wp_footer() ;?>

</body>
</html>
