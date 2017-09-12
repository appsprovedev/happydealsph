jQuery(document).ready( function($) {
    $('.wpfp-link').live('click', function() {
        dhis = $(this);
        wpfp_do_js( dhis, 1 );
        // for favorite post listing page
        if (dhis.hasClass('remove-parent')) {
            dhis.parent("li").fadeOut();
        }
        return false;
    });
});

function wpfp_do_js( dhis, doAjax ) {
    loadingImg = dhis.prev();
    loadingImg.show();
    beforeImg = dhis.prev().prev();
    beforeImg.hide();
    url = document.location.href.split('#')[0];         
    params = dhis.attr('href').replace('?', '') + '&ajax=1';
   
    if ( doAjax ) {
        jQuery.get(url, params, function(data) {  
		if (data == 'authentication_error') {
			window.location.replace("http://dev.happydeals.ph/my-account");

		} else {   
                dhis.parent().html(data);
                if(typeof wpfp_after_ajax == 'function') {
                    wpfp_after_ajax( dhis ); // use this like a wp action.
                }
                loadingImg.hide();
                	jQuery.get(url, 'wpfpaction=update_counter&ajax=1', function(data) {
                		jQuery('#favorite_counter').html(data);
                	});       
           	}
	    }
        );  
	

        
        
        
    }
}
