jQuery( document ).on( 'change', 'input.qty', function() {
        var item_hash = jQuery( this ).attr( 'name' ).replace(/cart\[([\w]+)\]\[qty\]/g, "$1");
        var item_quantity = jQuery( this ).val();
        var currentVal = parseFloat(item_quantity);

        function qty_cart() {
		     
            jQuery.ajax({
                type: 'POST',
                url: cart_qty_ajax.ajax_url,
                data: {
                    action: 'qty_cart',
                    hash: item_hash,
                    quantity: currentVal
                },
                success: function(data) {              
                   jQuery( '#cart_total' ).html(data);
                }
            });  

        }

        qty_cart();

    });        
    
    
     jQuery( document ).on( 'click', '.remove_product', function(e) {  
    	e.preventDefault();
	var item_hash = jQuery(this).attr("rel");
      	bravowp_woo_floatingcart_displayloadingimage();
      	jQuery.ajax({
                type: 'POST',
                url: cart_qty_ajax.ajax_url,
                data: {
                    action: 'remove_product_cart',
                    hash: item_hash,
        
                },
                success: function(data) {              
                   jQuery( '#cart_items_table' ).html(data);
                   update_subtotal();  
                }
         });  
      	
      
    });      
    
    
 
 function update_subtotal() {
           jQuery.ajax({
                type: 'GET',
                url: cart_qty_ajax.ajax_url,
                data: {
                    action: 'update_subtotal_cart'
                },
                success: function(data) {              
                   jQuery( '#cart_total' ).html(data);
                   jQuery('#bravowp-woo-floatingcart-loader').hide();
                }
            });  

 }      
 
 
 /* FAVORITES */
 
$( document ).ready(function() {
     display_myfavorites();
});    

$(document).on('click', '.remove-fav-link', function (e) {
         e.preventDefault();
         var remove_link = $(this).attr("href");
	 var r = confirm("Are you sure you want to remove this item?");
	 if (r == true) {
	      jQuery.ajax({
	        type: 'GET',
	        url:  remove_link,
	        success: function(data) {              
	            display_myfavorites();
	        }
	     });  
	} 
});

    
    
function display_myfavorites() {
	 jQuery.ajax({
                type: 'GET',
                url: cart_qty_ajax.ajax_url,
                data: {
                    action: 'update_favorites_container'
                },
                success: function(data) {              
                   jQuery( '#myfavorites_container' ).html(data);
                }
        });  	
}

/* END FAVORITES */