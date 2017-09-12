<?php

get_header();

?>          


<!-- Slider -->


<div class="jquery-script-clear"></div>
</div>
</div>
<div id="myCarousel" class="carousel slide" data-ride="carousel"> 
  <!-- Indicators -->
  
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="item active"> <img src="<?php  echo CFS()->get( 'image_slider' ); ?>" style="width:100%" alt="First slide">
      <div class="container">
<!--         <div class="carousel-caption">
          <h1>Slide 1</h1>
          <p>Aenean a rutrum nulla. Vestibulum a arcu at nisi tristique pretium.</p>
          <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
        </div> -->
      </div>
    </div>
    <div class="item"> <img src="<?php  echo CFS()->get( 'image_slider_2' ); ?>" style="width:100%" data-src="" alt="Second    slide">
      <div class="container">
<!--         <div class="carousel-caption">
          <h1>Slide 2</h1>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae egestas purus. </p>
          <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
        </div> -->
      </div>
    </div>
    <div class="item"> <img src="<?php  echo CFS()->get( 'image_slider_3' ); ?>" style="width:100%" data-src="" alt="Third slide">
      <div class="container">
<!--         <div class="carousel-caption">
          <h1>Slide 3</h1>
          <p>Donec sit amet mi imperdiet mauris viverra accumsan ut at libero.</p>
          <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
        </div> -->
      </div>
    </div>
  </div>
  <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a> </div>
  
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

    <!-- End Slider -->




<!-- Start Tabbing -->
<div class="container">


<br>
<br>






	<div id="cart-right-display" class="tabs">

<br>
<br>
	    <ul class="tab-links">
	        <li class="active"><a href="#tab1">About this deal</a></li>
	        <li><a href="#tab2">Terms & Conditions</a></li>
	        <li><a href="#tab3">Maps & Details</a></li>
	        <li><a href="#tab4">Reviews</a></li>
	    </ul>

        <br>

	    <div class="row">
	       <div class="col-md-8">
    		    
                <div class="tab-content">
    		        	
                    <div id="tab1" class="tab active">
    		         	   <?php  echo CFS()->get( 'about_this_deal' ); ?>
    		        </div>
    		 
    		        <div id="tab2" class="tab ">
       		         	   <?php  echo CFS()->get( 'terms_and_condition' ); ?>
    		         </div>
    		 
    		        <div id="tab3" class="tab">
    		         	   <?php  echo CFS()->get( 'maps_details' ); ?>
    		        </div>
    		 
    		        <div id="tab4" class="tab">
                           <div class="comments-container">
				 <?php echo do_shortcode('[WPCR_SHOW POSTID="'.$post->ID.'" SHOWFORM="0" HIDEREVIEWS="0" HIDERESPONSE="0"]'); ?>
			  </div>
                         </div>

                        
               </div>  

                    <hr>
                    <div style="display:flex;">
                    <?php  echo CFS()->get( 'contact_us' ); ?>
                    </div>
                    <hr>

                    <br>
                    <br>



		    </div>

                <div class="col-md-4 verticalLine pull-right" style="text-align: center; margin-top: -70px;">
                    <center>
                        <table>
                            <tr >
                                <th style="padding-top: 12px;padding-bottom: 12px;padding-right: 12px;padding-left: 12px;">VALID NOW</th>
                                <th style="padding-top: 12px;padding-bottom: 12px;padding-right: 12px;padding-left: 12px;"> <?php echo  wp_kses_post(couponhut_get_field('deals_available'));  ?> LEFT</th>
                            </tr>
                        </table>
                    </center>
                        <h2 style="text-align: center;"> <b style="color: #333333;"><?php the_title(); ?></b> </h2>
                        <h4 style="color: #44BC99;"><?php  echo CFS()->get( 'merchant' ); ?></h4>
                        <?php the_excerpt();?>

                       <div class="priceNew" style="color: #F5944F; font-size: 32px;"> <b><?php echo get_woocommerce_currency_symbol()?> <?php 
                       $prices =  wp_kses_post(couponhut_get_field('new_price'));  

                       echo number_format($prices);

                       ?></b>  
                        <?php echo sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="button %s product_type_%s">%s</a>',
														        esc_url( '/?add-to-cart='.$post->ID ),
														        esc_attr( $post->ID ),
														        '',
														        esc_attr( '1' ),
														        'add_to_cart_button ajax_add_to_cart img-btn',
														        esc_attr( 'simple' ),
														        '<img src="/buynow.png">'
														    );
														    ?>	
                                                                                                                    
                       
                       </div>



                </div>
		</div>

    		
    		</div>
    	</div>
    </div>
    	































<style type="text/css">
	
/*	table, th, td {
	   border: 1px solid black;
	   margin: 5px,5px,5px,5px;
	}  */

	.vertical_line{
        height:150px; 
        width:3px;
        background:#000;

    }

	hr {
	    display: block;
	    height: 1px;
	    border: 0;
	    border-top: 1px solid #ccc;
	    margin: 1em 0;
	    padding: 0;
	}
	/*----- Tabs -----*/
	.tabs {
	    width:100%;
	    display:inline-block;
	}
 
    /*----- Tab Links -----*/
    /* Clearfix */
    .tab-links:after {
        display:block;
        clear:both;
        content:'';
    }
 
    .tab-links li {
        margin:0px 5px;
        float:left;
        list-style:none;
    }
 
        .tab-links a {
            padding:9px 15px;
            display:inline-block;
            border-radius:3px 3px 0px 0px;
            background:#A79689;
            font-size:16px;
            font-weight:600;
            color:#f0f0f0;
            transition:all linear 0.15s;
             border-top-right-radius: 3em;
            border-bottom-right-radius: 3em;
        }
 
        .tab-links a:hover {
            background:#a7cce5;
            text-decoration:none;
            border-top-right-radius: 3em;
            border-bottom-right-radius: 3em;
        }
 
    li.active a, li.active a:hover {
        background:#f0f0f0;
        color:#4c4c4c;
    }
 
    /*----- Content of Tabs -----*/
    .tab-content {
        /*padding:15px;*/
        border-radius:3px;
        /*box-shadow:-1px 1px 1px rgba(0,0,0,0.15);*/
        background:#fff;
    }
 
        .tab {
            display:none;
        }
 
        .tab.active {
            display:block;
        }
</style>


<script type="text/javascript">
	jQuery(document).ready(function() {
    jQuery('.tabs .tab-links a').on('click', function(e)  {
        var currentAttrValue = jQuery(this).attr('href');
 
        // Show/Hide Tabs
        jQuery('.tabs ' + currentAttrValue).show().siblings().hide();
 
        // Change/remove current tab to active
        jQuery(this).parent('li').addClass('active').siblings().removeClass('active');
 
        e.preventDefault();
    });
});
</script>

<!-- end of tabbing -->





			
<?php get_footer();?>
