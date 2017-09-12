jQuery(document).ready(function($){

	$('#simple_add_to_favourites').click(function(){
		var prod_id = $(this).data().productid;
		if( isNaN(prod_id) ){
			return;
		}
		prod_id = parseInt(prod_id);
		data = {
			prod_id:prod_id,
			action:'simple_ajax_add_to_favourites',
			simple_favourites_nonce:simple_nonce.simple_favourites_nonce
		}
		$.post(myAjax.ajaxurl, data, function(msg){
			$('.simple_message').html(msg);
			$('.simple_message').fadeIn();
			setTimeout(function(){ $('.simple_message').fadeOut(); }, 4000);
		});
	});

	$('.simple-remove-from-favourites').click(function(){
		var prod_id    = $(this).data().product_id;
		if( isNaN(prod_id) ){
			return;
		}
		prod_id = parseInt(prod_id);
		data = {
			prod_id:prod_id,
			action:'simple_ajax_remove_from_favourites',
			simple_favourites_nonce:simple_nonce.simple_favourites_nonce
		}
		$.post(myAjax.ajaxurl, data, function(msg){
			location.reload();
		});
	});

	if( $('#simple_favourites_display').length != 0 ){
		var max_height = 0;
		$('ul.products li.product').each(function(){
			max_height = $(this).height() > max_height ? $(this).height() : max_height;
		});
		$('ul.products li.product').height(max_height);
	}

});