
$( function() {

	$('.number').number(true,2);

	$('.selectize').selectize();

	$('.container').prop('style','width: 90%;');
	$('.container.footer-wrapper').removeAttr('style');
	$('.navigation-wrapper .container').prop('style','width: 100%');
	$('.container-fluid .container').prop('style','width: 100%;padding-top:10px;');

	$('#filter_puller_button').click(function(){
		// jQuery('#filter_button').trigger('click');
		var clicked = $('#trigger').val();
		if(clicked == 1) {
			// jQuery('#header_filter_div').attr('style','position: relative; display: none');
			$('#header_filter_div').addClass('hide');
			$('#trigger').val('0');
		}
		else {
			// jQuery('#header_filter_div').attr('style','position: relative; padding: 20px;');
			$('#header_filter_div').removeClass('hide');
			$('#trigger').val('1');
		}

	});

	var amount_to = 10000;
	var amount_from = $('[name="deal_range_from"]').val();
	if($('[name="deal_range_to"]').val() != '') amount_to = $('[name="deal_range_to"]').val();

	$( "#slider-range" ).slider({
	  range: true,
	  min: 0,
	  max: 10000,
	  values: [ amount_from, amount_to ],
	  slide: function( event, ui ) {
	    $('[name="deal_range_from"]').attr('value', number_format(ui.values[ 0 ],2));
	    $('[name="deal_range_to"]').attr('value', number_format(ui.values[ 1 ],2));
	  }
	});
	// if(jQuery('[name="deal_range_from"]').val() == null)
		$('[name="deal_range_from"]').attr('value', number_format($( "#slider-range" ).slider( "values", 0 ),2));
	// if(jQuery('[name="deal_range_to"]').val() == null)
		$('[name="deal_range_to"]').attr('value', number_format($( "#slider-range" ).slider( "values", 1 ),2));
} );

function number_format(number,decimals,dec_point,thousands_sep) {
    number  = number*1;//makes sure `number` is numeric value
    var str = number.toFixed(decimals?decimals:0).toString().split('.');
    var parts = [];
    for ( var i=str[0].length; i>0; i-=3 ) {
        parts.unshift(str[0].substring(Math.max(0,i-3),i));
    }
    str[0] = parts.join(thousands_sep?thousands_sep:',');
    return str.join(dec_point?dec_point:'.');
}


$( document ).ready(function() {
    var user_verified = getUrlVars()["verified"];
    
    if (user_verified) {
    	alert ('Your Email Address is verified, Happy Shopping!')
    }
     
});


function getUrlVars()
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}