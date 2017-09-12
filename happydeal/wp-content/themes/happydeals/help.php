<?php
/**
 Template Name: help
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

<div class="container-fluid imgBG" style='background-image: url("/images/help.jpg"); padding-left: 0; padding-right: 0; width: 100%;'>


		<div class="row">
			<div class="text-bg">
				<div class="col-md-8" style="		padding-top: 100px;
													padding-bottom: 100px;"	
													>
					<h1>HOW CAN WE HELP YOU? </h1>
					<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
				</div>
			</div>
		</div>

</div>


<!-- Start Tabbing -->
<div class="container">


<br>
<br>






	<div class="tabs">

<br>
<br>
	    <ul class="tab-links">
	        <li class="active"><a href="#tab1">Deals</a> <hr/></li>
	        <li><a href="#tab2">Payment</a><hr/></li>
	        <li><a href="#tab3">Redemptions</a><hr/></li>
	        <li><a href="#tab4">Merchants</a><hr/></li>
	    </ul>

        <br>

	    <div class="row">
	       <div class="col-md-12">
    		    
                <div class="tab-content">
    		        	
                    <div id="tab1" class="tab active">
                    	<h3>Lorem ipsum dolor sit amet </h3>
    		         	   Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.                    	
    		         	   <h3>Lorem ipsum dolor sit amet </h3>
    		         	   Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.                    	
    		         	   <h3>Lorem ipsum dolor sit amet </h3>
    		         	   Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.                    	
    		         	   <h3>Lorem ipsum dolor sit amet </h3>
    		         	   Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    		        </div>
    		 
    		        <div id="tab2" class="tab ">
       		         	   Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    		         </div>
    		 
    		        <div id="tab3" class="tab">
    		         	   Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    		        </div>
    		 
    		        <div id="tab4" class="tab">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
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


<style type="text/css">
	
	table, th, td {
	   border: 1px solid black;
	   margin: 5px,5px,5px,5px;
	}

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
            /*background:#A79689;*/
            font-size:16px;
            font-weight:600;
            color:#4c4c4c
            ;
            /*transition:all linear 0.15s;*/
/*             border-top-right-radius: 3em;
            border-bottom-right-radius: 3em;*/
        }
 
        .tab-links a:hover {
            /*background:#a7cce5;*/
            text-decoration:none;
            color: #44BC99;

        }
 
    li.active a, li.active a:hover {
        /*background:#f0f0f0;*/
        color:#44BC99;
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
<?php get_footer();?>