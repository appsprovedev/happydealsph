

jQuery( function( $ ) {
	   jQuery( "#bravowp-woo-floatingcart" ).css("right", "-290px");
	if ($('body').hasClass('home') || $('body').hasClass('deal-template-default')) {
	
	$(window).scroll(checkscroll);  
        var top = $(window).scrollTop();
        if(top < 600){
            $('#bravowp-woo-floatingcart').hide();
        }
        
        } else {
         
	    jQuery( "#bravowp-woo-floatingcart" ).css("display", "none");
	    
	}

      function checkscroll(){
      
          var top = $(window).scrollTop();              
          var my_div = $("#cart-right-display");
          var target_top = my_div.offset().top;
	 
          if(top > target_top - 200){
           
            $('#bravowp-woo-floatingcart').show();
          }else{
             $('#bravowp-woo-floatingcart').hide();
          }          
      }
  if ($('body').hasClass('home') || $('body').hasClass('deal-template-default')) {
   checkscroll();
   
  } 
   

        //Called when woocommerce finishes the adding to cart process and produce fragments with the new data
        jQuery( document.body ).on( "added_to_cart", function( event, fragments )
        {
			  
                //the fragments object shall contain our property
                if ( fragments.bw_wwo_floatingcartdata != null)
                {
                            
                        //remove the previous id in case
                        jQuery("#bravowp-woo-floatingcart").remove();

                        //appends the new cart content
                        jQuery("body").append(fragments.bw_wwo_floatingcartdata);    
                        
                        jQuery(".glyphicon-shopping-cart span").html(' '+jQuery('#qty_total').val()+' ');
                }
                else
                {
                        //the custom data in the fragments was not found
                }

        });

        //Called when woocommerce finishes the adding to cart process and produce fragments with the new data
        jQuery( document.body ).on( "adding_to_cart", function( event, data )
        {
		if (jQuery( "#bravowp-woo-floatingcart" ).css("right") == "-290px") {
		    jQuery( "#bravowp-woo-floatingcart" ).animate({
			right:"0"
		     }, 400, function() {
			
		     });
		}    
                //showing loading gif in the cart
                bravowp_woo_floatingcart_displayloadingimage();

        });




});


//opening or collapsing the cart

function bravowp_woo_floatingcart_togglecart_c()
{
     
     if (jQuery( "#bravowp-woo-floatingcart" ).css("right") == "0px" ) {
       
        jQuery( "#bravowp-woo-floatingcart" ).animate({
		right:"-290px"
	}, 400, function() {
	
	});
	
     } else {
	jQuery( "#bravowp-woo-floatingcart" ).animate({
		right:"0"
	}, 400, function() {
	
	});

    }
}


function bravowp_woo_floatingcart_togglecart()
{
	   
        if ( jQuery( "#bravowp-woo-floatingcart-bodypane" ).css("height") != "0px" )
        {

                bravowp_woo_floatingcart_heightstyle = jQuery( "#bravowp-woo-floatingcart-bodypane" ).css("height");

                jQuery( "#bravowp-woo-floatingcart-bodypane" ).animate({
                        height:"0px",opacity:"0"
                }, 150, function() {

                });
                jQuery( "#bravowp-woo-floatingcart-footerpane" ).animate({
                        height:"4px"
                }, 150 );
                jQuery("#bravowp-woo-floatingcart-titlepane-downicon").fadeOut();
                jQuery("#bravowp-woo-floatingcart-titlepane-upicon").fadeIn();

        }
        else
        {

                jQuery( "#bravowp-woo-floatingcart-bodypane" ).animate({
                        height:"100%",opacity:"1"
                }, 400, function() {

                });
                jQuery( "#bravowp-woo-floatingcart-footerpane" ).animate({
                        height:"10px"
                }, 400 );
                jQuery("#bravowp-woo-floatingcart-titlepane-downicon").fadeIn();
                jQuery("#bravowp-woo-floatingcart-titlepane-upicon").fadeOut();

        }

}



//display loading image
function bravowp_woo_floatingcart_displayloadingimage()
{

//	bravowp_woo_floatingcart_togglecart_c();
        jQuery("#bravowp-woo-floatingcart-loader").show();
}
