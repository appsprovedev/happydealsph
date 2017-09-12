jQuery(document).ready(function($){

	"use strict";

	/**
	 * ----------------------------------------------------------------------------------------
	 *    Globals
	 * ----------------------------------------------------------------------------------------
	 */

	var $body = $('body');
	var $window = $(window);
	var deviceAgent = navigator.userAgent.toLowerCase();
	var isMobile = deviceAgent.match(/(android|webos|iphone|ipad|ipod|blackberry)/);

	/**
	* ----------------------------------------------------------------------------------------
	*    Functions
	* ----------------------------------------------------------------------------------------
	*/
	// Get URL Parameter
	function getUrlParameter(url, name) {
		return (RegExp(name + '=' + '(.*?)(&|$)').exec(url)||['',''])[1];
	}

	// Get Page Index
	function getPageIndex(url) {
		// return (RegExp(/(?:page\/|paged=)(\d+)\/*/).exec(url)||['','']);
		return (RegExp(/(?:(page\/)|(paged=))(\d+)\/*/).exec(url)||['','']);
	}

	/**
	 * ----------------------------------------------------------------------------------------
	 *    <bgimage>
	 * ----------------------------------------------------------------------------------------
	 */

	var $bgimage = $('.bg-image, .widget-bgimage');

	$bgimage.each(function(){
		var $this = $(this);
		var bgimage = $this.data('bgimage')

		$this.css('background-image', 'url("' + bgimage + '")' );
	})

	/**
	* ----------------------------------------------------------------------------------------
	*    Countdown Init
	* ----------------------------------------------------------------------------------------
	*/
	
	var $dealCountdown = $('.jscountdown-wrap');
	var expiredText = couponhut.expired;
	var dayText = couponhut.day;
	var daysPluralText = couponhut.days;
	var hourText = couponhut.hour;
	var hoursPluralText = couponhut.hours;
	var minuteText = couponhut.minute;
	var minutesPluralText = couponhut.minutes;

	function initCountdown(el){
		var $this = el;
		var finalDate = $this.data('time');

		$this.countdown(finalDate)
		.on('update.countdown', function(event) {

			var format = '%H:%M:%S';

			if ( $this.data('short') ) {

				if( event.offset.totalDays > 0 ) {
					format = '%-D %!D:' + dayText + ' ,' + daysPluralText + ' ;';
				} else if ( event.offset.hours > 0 ) {
					format = '%-H %!H:' + hourText + ' ,' + hoursPluralText + ' ;';
				} else {
					format = '%-M %!M:' + minuteText + ' ,' + minutesPluralText  + ' ;';
				}

				$this.html(event.strftime(format));

			} else if(event.offset.totalDays > 0) {
				var daysFormat = '%-D';

				$this.html('<span class="jscountdown-days">' + 
					event.strftime(daysFormat) +
					'</span>' + 
					'<span class="jscountdown-days-text">' + 
					event.strftime('%!D:' + dayText + ' ,' + daysPluralText + ' ;') + 
					'</span>' +
					'<span class="jscountdown-time">' +
					event.strftime(format) + 
					'</span>');

				// $this.html(event.strftime(daysFormat));
			} else {
				$this.html(event.strftime(format));
			}

		})
		.on('finish.countdown', function(event) {
			$this.html(expiredText)
			.parent().addClass('disabled')

		})
	}

	$dealCountdown.each(function(){

		initCountdown($(this));

	})


	/**
	* ----------------------------------------------------------------------------------------
	*    Isotope
	* ----------------------------------------------------------------------------------------
	*/

	var isotopeCols = 0;

 	var itemGutter = 0;

	var startIsotopemethods = {
        init : function(options) {


        	var $this = (this);

        	$this.startIsotope('setOptions');

		 	var isotopeType = $this.data('isotope-type');

		 	if ( isotopeType == null ) {
		 		isotopeType = 'masonry';
		 	}


		 	itemGutter = $this.data('isotope-gutter');

			// Fires Layout when all images are loaded
			$this.imagesLoaded( function() {
				$this.show();

				// Isotope Init
				$this.isotope({
					transitionDuration: '.3s',
					layoutMode: isotopeType,
					masonry: {
						gutter: itemGutter
					},
				});

				if ( $this.hasClass('is-lightbox-gallery') ) {
					$this.isotope( 'on', 'layoutComplete', function() {
						setTimeout(function(){
							initSimpleLightbox();
						}, 0)
					});
				}

				$window.trigger('refreshisotope');
			});


			// Set the items width on resize
			// $window.on('resize refreshisotope', function (){
			$window.on('refreshisotope', function (){
				$this.startIsotope('refresh');
			});


        },
        setOptions : function(){

	        var $this = $(this);

			$this.imagesLoaded(function(){

				// SET ISOTOPE GUTTER AND SPACINGS
		 		$this.width($this.parent().width() + 1); 

		 		if( typeof($this.data('isotope-gutter')) != 'undefined' && $this.data('isotope-gutter') !== null && $this.data('isotope-gutter') != 0 ) {

		 			$this.css({
		 				'margin-right' : - itemGutter + 'px',
		 				'margin-top' : itemGutter + 'px',
		 			})

		 			$this.children().css({
		 				'margin-bottom' : itemGutter + 'px',
		 				// 'overflow' : 'hidden'
		 			})

		 		}

		 		// SET ISOTOPE COLUMNS

		 		var windowWidth = window.innerWidth;

		 		if ( windowWidth <= 478 ) {
		 			if(typeof $this.data('isotope-cols-xs') != 'undefined') {
		 				isotopeCols = $this.data('isotope-cols-xs');
		 			} else {
		 				isotopeCols = 1;
		 			}
		 		}
		 		else if ( windowWidth <= 767 ) {
		 			if(typeof $this.data('isotope-cols-xs') != 'undefined') {
		 				isotopeCols = $this.data('isotope-cols-xs');
		 			} else if(typeof $this.data('isotope-cols-sm') != 'undefined') {
		 				isotopeCols = $this.data('isotope-cols-sm');
		 			} else if ( $this.data('isotope-cols') == 1){
		 				isotopeCols = 1;
		 			} else {
		 				isotopeCols = 2;
		 			}
		 		} else if ( windowWidth < 992 ) {
		 			if(typeof $this.data('isotope-cols-sm') != 'undefined') {
		 				isotopeCols = $this.data('isotope-cols-sm');
		 			} else if ( $this.data('isotope-cols') > 2 ) {
		 				isotopeCols = $this.data('isotope-cols') - 1;
		 			} else {
		 				isotopeCols = $this.data('isotope-cols');
		 			}

		 		} else {
		 			if ( typeof $this.data('isotope-cols') == 'undefined' ) {
		 				isotopeCols = 3;
		 			} else {
		 				isotopeCols = $this.data('isotope-cols');
		 			}

		 		}

		 		if ( isotopeCols >= 2 ) {
		 			// $this.children().not('.isotope-item-width-2').css('width', Math.floor($this.width() / isotopeCols - itemGutter) + 'px' );
		 			$this.children().not('.isotope-item-width-2').css('width', Math.floor(($this.width() - (itemGutter * (isotopeCols - 1))) / isotopeCols) + 'px' );
		 			$this.children('.isotope-item-width-2').css('width', Math.floor(($this.width() / isotopeCols) * 2 - 2) + 'px' );
		 		} else {
		 			$this.children().css('width', $this.width() / isotopeCols - 1 + 'px' );
		 		}

		 		if( $this.data('isotope-square') == true ) {
		 			var itemsHeight = $this.children().not('.isotope-item-width-2').width();
		 			$this.children().css('height', itemsHeight + 'px' );
		 		}

		 		if ( $this.find('.is-aspectratio').length > 0 ) {

		 			var elWidth = $this.find('.is-aspectratio').width();

		 			$this.find('.is-aspectratio').each(function(){
			 			var $el = $(this);
			 			var height = 0;
			 			var landscapeHeight = 0;

			 			if ( $el.hasClass('ar_4_3') ) {
			 				height = elWidth / 1.333 ;
			 			}
			 			if ( $el.hasClass('ar_1_1') ) {
			 				height = elWidth;
			 			}
			 			if ( $el.hasClass('ar_3_2') ) {
			 				height = elWidth / 1.5;
			 			}
			 			if ( $el.hasClass('ar_16_9') ) {
			 				height = elWidth / 1.777;
			 			}
			 			if ( $el.hasClass('ar_3_1') ) {
			 				height = elWidth / 3 ;
			 			}

			 			if ( $el.hasClass('ar_3_4') ) {
			 				height = elWidth / 0.75;
			 			}
			 			if ( $el.hasClass('ar_2_3') ) {
			 				height = elWidth / 0.666;
			 			}
			 			if ( $el.hasClass('ar_9_16') ) {
			 				height = elWidth / 0.5625;
			 			}
			 			if ( $el.hasClass('ar_1_3') ) {
			 				height = elWidth / 0.333;
			 			}

			 			// searches if there are landcape items
			 			landscapeHeight = $this.find('.is-autox-landscape').height();

			 			// checks if the current item is portrait
			 			if ( $el.hasClass('is-autox-portrait') ) {
			 				// if landscapeHeight is greater than 0, it means that there is at least one landscape image
			 				if ( landscapeHeight > 0 ) {
			 					//
			 					// tuk moje bi trqbva da se promeni na:
			 					// $el.height(Math.floor(height + $this.data('isotope-gutter')));	
			 					// poneje dva puti zavurta isotope, vtoriqt pyt sa tochno ichisleni height-a na tozi element, no ne i na landscape elementa
			 					$el.height(Math.floor(landscapeHeight*2 + $this.data('isotope-gutter')));	
			 				} else {
			 					$el.height(Math.floor(height));	
			 				}

			 			} else {
			 				$el.height(Math.floor(height));
			 			}

			 		})
		 		}

			}) //imagesLoaded

	 	},
	 	refresh : function(){
 			var $this = $(this);
 			var windowWidth = window.innerWidth;

				$this.startIsotope('setOptions');

 				if ( $this.hasClass('is-isotope-match-height') ) {
 					if ( windowWidth <= 478 ) {
 						$this.children().matchHeight({
 							remove: true,
 						});
 					} else {
 						$this.children().matchHeight({
 							byRow: true,
 						});
 					}
 				}

 				setTimeout(function(){
 					$this.isotope('layout'); 					
 				}, 100)

	 	}
    };


	$.fn.startIsotope = function(methodOrOptions) {
		if ( startIsotopemethods[methodOrOptions] ) {
			return startIsotopemethods[ methodOrOptions ].apply( this, Array.prototype.slice.call( arguments, 1 ));
		} else if ( typeof methodOrOptions === 'object' || ! methodOrOptions ) {
	        // Default to "init"
	        return startIsotopemethods.init.apply( this, arguments );
	    } else {
	    	$.error( 'Method ' +  methodOrOptions + ' does not exist on jQuery.startIsotope' );
	    }    
	};


	var $isotopeContainer = $('.isotope-wrapper');

	$isotopeContainer.each(function(){
		var $this = $(this);

		$this.wrap( "<div class='is-resize-sensor'></div>" );
		$this.startIsotope();
	})


	function ResizeSensorTriggerRefreshIsotope(){
		$window.trigger('refreshisotope');

		// setTimeout(function(){
		// 	$window.trigger('refreshisotope');
		// }, 200)
	}

	var triggerRefreshIsotope;

	new ResizeSensor(jQuery('.is-resize-sensor'), function(){
		clearTimeout(triggerRefreshIsotope);
		triggerRefreshIsotope = setTimeout(ResizeSensorTriggerRefreshIsotope, 300);
	});


	/**
	 * ----------------------------------------------------------------------------------------
	 *    Nav Menu
	 * ----------------------------------------------------------------------------------------
	 */

	$('.is-slicknav').slicknav({
		label: '',
		init: function(){
			var $brandLogo = $('.navigation-wrapper .site-logo').clone();
			$('.slicknav_menu').prepend($brandLogo);
		}
	});

	$('.main-navigation').find('.menu-item-has-children a').each(function(){

		var $this = $(this);

		if ( $this.next().hasClass('sub-menu') ) {
			$this.append('<i class="fa fa-angle-down"></i>');
		}

	})


	/**
	 * ----------------------------------------------------------------------------------------
	 *    Header on Scroll
	 * ----------------------------------------------------------------------------------------
	 */

	var $navigation = $('.navigation-wrapper');
	var $navOffset = $('.nav-offset');
	var navHeight = $navigation.height();

	function stickyNav() {

		navHeight = $navigation.height();
		
		if ( $window.scrollTop() > navHeight ){
			$navigation.addClass('nav-sticky');
			$navOffset.css('padding-top', navHeight);

		} else if ( $window.scrollTop() == 0 ){
			$navigation.removeClass('nav-sticky');
			$navOffset.css('padding-top', '');

		}

	}

	stickyNav();

	$window.scroll(function(){
		stickyNav();
	});

	$window.on('resize',function(){
		stickyNav();
	});

	/**
	* ----------------------------------------------------------------------------------------
	*    Search Deals when Enter is Pressed in the Header Screen
	* ----------------------------------------------------------------------------------------
	*/

	$('.form-deal-submit.header-screen-search input[type="text"]').on('keypress', function(e) { 
		if (e.which == 13) {
			e.preventDefault();
			$('.form-deal-submit.header-screen-search button[type="submit"]').trigger('click'); 

			document.activeElement.blur(); 
			var onClickScrollTo = $('.grid-wrapper.is-ajax-deals-content').offset().top;

			if ( onClickScrollTo != null) { 
				$('html, body').animate({ scrollTop: 498 }, '500');
			}
		} 
	}); 
	
	/**
	 * ----------------------------------------------------------------------------------------
	 *    Video Background
	 * ----------------------------------------------------------------------------------------
	 */

	var bigvideos = {};
	

	$('.bigvideo-wrapper').each(function( index, value ){

		var $this = $(this);
		$this.find('.bg-image').hide();
		var fallback = false;
		var vjsPlayer = false;

		bigvideos[value] = new $.BigVideo({
			useFlashForFirefox: false,
			forceAutoplay: true,
			controls: false,
			doLoop: true,
			container: $this,
			shrinkable: false
		});

		bigvideos[value].init();

		if ( !isMobile && ($this.data('bigvideo-mp4') || $this.data('bigvideo-webm') || $this.data('bigvideo-ogg')) ) {

			vjsPlayer = bigvideos[value].getPlayer();

			bigvideos[value].show([
				{ type: "video/mp4",  src: $this.data('bigvideo-mp4') },
				{ type: "video/webm", src: $this.data('bigvideo-webm') },
				{ type: "video/ogg",  src: $this.data('bigvideo-ogg') },
			]);

		} else {
			$this.find('.bg-image').show();
		}

		
	})


	/**
	* ----------------------------------------------------------------------------------------
	*    Hero Full Height
	* ----------------------------------------------------------------------------------------
	*/

	var $heroImage = $('.hero-image')
	var $navWrap = $('.navigation-wrapper')
	var $navMobile = $('.slicknav_menu');
	var wHeight = $window.height();

	function heroFullHeight(){
		wHeight = $window.height();
		if ( $navWrap.height() > 0 ) {
			var navHeight = $navWrap.height()
		} else {
			var navHeight = $navMobile.height();
		}
		$heroImage.height(wHeight - navHeight);
	}

	// heroFullHeight();
	$heroImage.height(wHeight);
	
	$window.on( 'scroll resize', function(){
		heroFullHeight();
	});

	/**
	* ----------------------------------------------------------------------------------------
	*    Featured Deals Slider
	* ----------------------------------------------------------------------------------------
	*/

	$(".featured-deals-slider, .image-carousel").each(function(){
		var $this = $(this);
		$this.owlCarousel({
			singleItem: true,
			slideSpeed : 300,
			paginationSpeed : 400,
			autoPlay: 7000,
			stopOnHover: true,
			navigation: true,
			navigationText: ['<i class="icon-Triangle-ArrowLeft"></i>','<i class="icon-Triangle-ArrowRight"></i>'],
			rewindSpeed: 400
		});
	})

	

	/**
	 * ----------------------------------------------------------------------------------------
	 *    ClipboardJS
	 * ----------------------------------------------------------------------------------------
	 */

	$('.is-clipboard-error').hide();
	$('.is-clipboard-success').hide();

	var clipboard = new Clipboard('.show-coupon-code');

	$('.show-coupon-code').on('click', function(e){

	 	var $this = $(this);

	 	if( !$this.data('redirect') ) {
	 		e.preventDefault();
	 	}

	 	$($this.data('target')).modal('show');

	 })

	clipboard.on('success', function(e) {
		e.clearSelection();
		$('.is-clipboard-success').show();
	});

	clipboard.on('error', function(e) {
		e.clearSelection();
		$('.is-clipboard-error').show();
	});


	/**
	 * ----------------------------------------------------------------------------------------
	 *    Single Deal Slider
	 * ----------------------------------------------------------------------------------------
	 */

	var $dealSlider = $('.single-deal-slider');

	$dealSlider.owlCarousel({
		singleItem:true,
		navigation: true,
		navigationText: ['<i class="icon-Triangle-ArrowLeft"></i>','<i class="icon-Triangle-ArrowRight"></i>'],
		rewindSpeed: 400,
		autoPlay: 4000
	});

    /**
    * ----------------------------------------------------------------------------------------
    *    5 Star Rating
    * ----------------------------------------------------------------------------------------
    */

	$(".post-star-rating i").click(function(){

		var $this = $(this);
        var post_id = $this.data("post-id");
        var rating = $this.data("rating");

        $.ajax({
        	type: "post",
        	url: couponhut.ajaxurl,
        	dataType: 'json',
        	data: "action=_action_ssd_post_rate&nonce="+couponhut.nonce+"&post_rate=&post_id="+post_id+"&rating="+rating,
        	success: function(data){
                // If vote successful
                if(data['average'] != "already") {

                	$.each( data['stars'], function( index, value ){

                		var $starElement = $this.closest('.post-star-rating').find('i').eq(index);

                		switch (value) {
                			case 'full':
                				$starElement.removeClass('fa-star fa-star-half-o fa-star-o').addClass('fa-star');
                				break;
                			case 'half':
                				$starElement.removeClass('fa-star fa-star-half-o fa-star-o').addClass('fa-star-half-o');
                				break;
                			case 'empty':
                				$starElement.removeClass('fa-star fa-star-half-o fa-star-o').addClass('fa-star-o');
                				break;
                		}
                	});

                	// $this.addClass("voted");
                	$this.closest('.post-star-rating').siblings('.rating-average').text(data['average']);
                	$this.closest('.post-star-rating').siblings('.rating-text').find('.rating-count').text(data['rating_count_total']);

                	if(data['rating_count_total'] == 1) {
                		$this.closest('.post-star-rating').siblings('.rating-text').find('.rates').text('rating');
                	} else {
                		$this.closest('.post-star-rating').siblings('.rating-text').find('.rates').text('ratings');
                	}
                	
                }
            }
        });

        return false;
    })

	/**
	* ----------------------------------------------------------------------------------------
	*    Rating Star Hover
	* ----------------------------------------------------------------------------------------
	*/

	$(".post-star-rating i").on({
		mouseenter: function () {
			var $this = $(this);
			$this.addClass('hovered');
			$this.prevAll().addClass('hovered');
			$this.nextAll().addClass('not-hovered');
		},
		mouseleave: function () {
			var $this = $(this);
			$this.removeClass('hovered');
			$this.prevAll().removeClass('hovered');
			$this.nextAll().removeClass('not-hovered');
		}
	});

	/**
	* ----------------------------------------------------------------------------------------
	*    Dropdown Select Save Input In Hidden Field
	* ----------------------------------------------------------------------------------------
	*/


	$(document).on('click', '.dropdown .dropdown-menu li a', function(e){

		var $this = $(this);

		var el = $this.parents('ul').data('name');

		if( el ){
			e.preventDefault();

			var dropdownButton = $this.parents( '.dropdown' ).find('button');
			
			dropdownButton.html( $this.html() );

			$this.closest('form').find('input[name="'+el+'"]').val( $this.data('value') );
		}

	});

	$('.dropdown').each(function(){

		var $this = $(this);

		var dropdownButton = $this.find('button');
		var currentItem = $this.find( '.dropdown-menu li a[data-current="true"]' );

		if ( currentItem.length > 0 ) {
			dropdownButton.html( currentItem.clone() );
		};

	})

	/**
	* ----------------------------------------------------------------------------------------
	*    AJAX Filter Search Button
	* ----------------------------------------------------------------------------------------
	*/

	function showDeals($dealsContainer, response) {

		var $response = $(response);
		var $res_paginaton = $response.find('.is-ajax-paging-navigation');
		var $res_deals = $response.find('.grid-wrapper.is-ajax-deals-content > *');

		$dealsContainer.siblings('.ajax-deals-notice').remove();

		// Set current sort deals button
		var sPageURL = decodeURIComponent(window.location.search);
		var dealSort = getUrlParameter(sPageURL, 'sort');

		$('.btn-sort').removeClass('current')

		if ( dealSort == '' ) {
			$('.btn-sort-default').addClass('current')
		} else {
			$('.btn-sort-' + dealSort).addClass('current')
		}

		if ( $res_deals.html() ) {
			$dealsContainer.append($res_deals).isotope('appended', $res_deals);

			// Init JSCountdown on the new deals
			$res_deals.find('.jscountdown-wrap').each(function(){
				initCountdown($(this));
			})

			$dealsContainer.imagesLoaded(function(){
				$window.trigger('resize');
			})	
		} else {
			$dealsContainer.imagesLoaded(function(){
				$window.trigger('resize');
			})	
			// Show No Deals notice
			var $noDeals = $('<div class="ajax-deals-notice" ><h3>' + couponhut.no_deals + '</h3></div>');
			$dealsContainer.after($noDeals);
		}

		if ( $res_paginaton.html() ) {
			$('.is-ajax-paging-navigation').html($res_paginaton.html()).fadeIn('fast');	
		}
	}

	function removeDeals($dealsContainer) {

		$dealsContainer.siblings('.ajax-deals-notice').remove();

		var $spinner = $('<div class="ajax-deals-notice" ><h3>' + couponhut.loading_deals + '</h3><i class="fa fa-circle-o-notch fa-spin"></i></div>');
		// $dealsContainer.isotope('remove', $dealsContainer.isotope('getItemElements'));
		$dealsContainer.empty();
		
		// Change Pagination Opacity
		$('.is-ajax-paging-navigation').fadeOut('fast', function(){
			$(this).empty();
		});

		//Resize Isotope
		$dealsContainer.imagesLoaded(function(){
			$window.trigger('resize');
		})
		$dealsContainer.after($spinner);

	}

	$('.form-deal-submit button[type="submit"]:not(.is-ajax-deal-filter)').on('click', function(){
		var $this = $(this);

		$this.html('<i class="fa fa-circle-o-notch fa-spin"></i>');
		$this.attr('disabled','disabled');
		$this.closest('form').submit();
	})


	$('.form-deal-submit button[type="submit"].is-ajax-deal-filter').on('click', function(e){

		var $this = $(this);
		var buttonHtml = $this.html();

		// Button Spinner
		var buttonWidth = $this.width();
		$this.width(buttonWidth);
		$this.html('<i class="fa fa-circle-o-notch fa-spin"></i>');
		$this.attr('disabled','disabled');

		// If $dealContainer is present on current page, continue
		var $dealsContainer = $('.is-ajax-deals-content');
		if (  $dealsContainer.length == 0 ) {
			$this.closest('form').submit();
			return;
		};

		e.preventDefault();

		var search_keyword = $this.closest('form').find('input[name="deal_search"]').val();
		var s_deal_category = $this.closest('form').find('input[type="hidden"][name="s_deal_category"]').val();
		var s_deal_company = $this.closest('form').find('input[type="hidden"][name="s_deal_company"]').val();
		var days_start_range = $this.closest('form').find('input[type="hidden"][name="days_start_range"]').val();
		var days_end_range = $this.closest('form').find('input[type="hidden"][name="days_end_range"]').val();
		var deal_country = $this.closest('form').find('input[type="hidden"][name="deal_country"]').val();
		var deal_city = $this.closest('form').find('input[type="hidden"][name="deal_city"]').val();

		var $sort_current = $('.is-ajax-sort-deals a.current');
		var deal_sort = getUrlParameter($sort_current.attr('href'), 'sort');

		removeDeals($dealsContainer);

		// Change the URL bar
		var sPageURL = document.location.origin + document.location.pathname;
		sPageURL = sPageURL.replace(/(page\/\d+\/*)/, '');

		// var sPageURL = couponhut.homeurl;

		// Get the page ID if page_id is present
		var pageId = (RegExp(/(page_id=\d+\/*)/).exec(window.location.href)||['',''])[1];

		sPageURL += '?';
		sPageURL += ( pageId ? pageId : '');
		sPageURL += ( search_keyword ? '&deal_search=' + search_keyword : '');
		sPageURL += ( days_start_range ? '&days_start_range=' + days_start_range : '');
		sPageURL += ( days_end_range ? '&days_end_range=' + days_end_range : '');
		sPageURL += ( s_deal_category ? '&s_deal_category=' + s_deal_category : '');
		sPageURL += ( s_deal_company ? '&s_deal_company=' + s_deal_company : '');
		sPageURL += ( deal_country ? '&deal_country=' + deal_country : '');
		sPageURL += ( deal_city ? '&deal_city=' + deal_city : '');
		sPageURL += ( deal_sort ? '&sort=' + deal_sort : '');		
		sPageURL += '&search_type=deal';

		sPageURL = sPageURL.replace('?&', '?');

		history.pushState({}, '', sPageURL);

		$.get(sPageURL, null, function(response){

			showDeals($dealsContainer, response);

			// Enable button and show results
			$this.html(buttonHtml);
			$this.removeAttr('disabled');	
			$this.css('width', '');	

		});	

		if(document.activeElement) { 
			document.activeElement.blur(); 
		}

		var onClickScrollTo = $('.grid-wrapper.is-ajax-deals-content').offset().top;

		if ( onClickScrollTo != null) { 
			$('html, body').animate({ scrollTop: 498 }, '500');
		}

	})

	/**
	* ----------------------------------------------------------------------------------------
	*    AJAX Deal Sort Button
	* ----------------------------------------------------------------------------------------
	*/

	$('.is-ajax-sort-deals a').on('click', function(e){

		e.preventDefault();

		var $this = $(this);

		var sPageURL = decodeURIComponent(window.location.search);
		
		var search_keyword = getUrlParameter(sPageURL, 'deal_search');
		var s_deal_category = getUrlParameter(sPageURL, 's_deal_category');
		var s_deal_company = getUrlParameter(sPageURL, 's_deal_company');
		var days_start_range = getUrlParameter(sPageURL, 'days_start_range');
		var days_end_range = getUrlParameter(sPageURL, 'days_end_range');
		var deal_country = getUrlParameter(sPageURL, 'deal_country');
		var deal_city = getUrlParameter(sPageURL, 'deal_city');

		var deal_sort = getUrlParameter($this.attr('href'), 'sort');

		// Change current sort button
		$this.siblings().removeClass('current');
		$this.addClass('current');

		// Spinner in Deals Container
		var $dealsContainer = $('.is-ajax-deals-content');
		
		removeDeals($dealsContainer);

		// Change the URL bar
		var sPageURL = document.location.origin + document.location.pathname;

		// Get the page ID if page_id is present
		var pageId = (RegExp(/(page_id=\d+\/*)/).exec(window.location.href)||['',''])[1];

		sPageURL += '?';
		sPageURL += ( pageId ? pageId : '');
		sPageURL += ( search_keyword ? '&deal_search=' + search_keyword : '');
		sPageURL += ( days_start_range ? '&days_start_range=' + days_start_range : '');
		sPageURL += ( days_end_range ? '&days_end_range=' + days_end_range : '');
		sPageURL += ( s_deal_category ? '&s_deal_category=' + s_deal_category : '');
		sPageURL += ( s_deal_company ? '&s_deal_company=' + s_deal_company : '');
		sPageURL += ( deal_country ? '&deal_country=' + deal_country : '');
		sPageURL += ( deal_city ? '&deal_city=' + deal_city : '');
		sPageURL += ( deal_sort ? '&sort=' + deal_sort : '');
		sPageURL += '&search_type=deal';

		sPageURL = sPageURL.replace('?&', '?');

		console.log(sPageURL);

		history.pushState({}, '', sPageURL);

		$.get(sPageURL, null, function(response){
			
			showDeals($dealsContainer, response);
			
		});	

	})
	

	/**
	* ----------------------------------------------------------------------------------------
	*    AJAX Pagination
	* ----------------------------------------------------------------------------------------
	*/
	$(document).on('click', '.is-ajax-paging-navigation a', function(e){

		e.preventDefault();

		var $this = $(this);

		var sPageURL = decodeURIComponent(window.location.search);
		
		var s_deal_category = getUrlParameter(sPageURL, 's_deal_category');
		var s_deal_company = getUrlParameter(sPageURL, 's_deal_company');
		var days_start_range = getUrlParameter(sPageURL, 'days_start_range');
		var days_end_range = getUrlParameter(sPageURL, 'days_end_range');
		var deal_country = getUrlParameter(sPageURL, 'deal_country');
		var deal_city = getUrlParameter(sPageURL, 'deal_city');

		var $sort_current = $('.is-ajax-sort-deals a.current');
		var deal_sort = getUrlParameter($sort_current.attr('href'), 'sort');

		var paged = getPageIndex($this.attr('href'));

		// Spinner in Deals Container
		var $dealsContainer = $('.is-ajax-deals-content');

		removeDeals($dealsContainer);

		// Change the URL bar
		var sPageURL = document.location.origin + document.location.pathname;
		sPageURL = sPageURL.replace(/(page\/\d+\/*)/, '');

		// Get the page ID if page_id is present
		var pageId = (RegExp(/(page_id=\d+\/*)/).exec(window.location.href)||['',''])[1];

		sPageURL += ( paged[1] ? paged[0] : '');
		sPageURL += '?';
		sPageURL += ( paged[2] ? paged[2] + paged[3] : '');
		sPageURL += ( pageId ? '&' + pageId : '');
		sPageURL += ( days_start_range ? '&days_start_range=' + days_start_range : '');
		sPageURL += ( days_end_range ? '&days_end_range=' + days_end_range : '');
		sPageURL += ( s_deal_category ? '&s_deal_category=' + s_deal_category : '');
		sPageURL += ( s_deal_company ? '&s_deal_company=' + s_deal_company : '');
		sPageURL += ( deal_country ? '&deal_country=' + deal_country : '');
		sPageURL += ( deal_city ? '&deal_city=' + deal_city : '');
		sPageURL += ( deal_sort ? '&sort=' + deal_sort : '');
		sPageURL += '&search_type=deal';		
		
		history.pushState({}, '', sPageURL);

		if ( $('.grid-wrapper.is-ajax-deals-content').length > 0 ) {
			var onClickScrollTo = $('.grid-wrapper.is-ajax-deals-content').offset().top;

			if ( onClickScrollTo != null) {
				$window.scrollTop(onClickScrollTo - 300);
			}
		}

			
		$.get(sPageURL, null, function(response){

			showDeals($dealsContainer, response);

		});	


	})

	function loadPage(href) {

		var $dealsContainer = $('.is-ajax-deals-content');

		removeDeals($dealsContainer);

		$.get(href, null, function(response){

			showDeals($dealsContainer, response);

			if ( $('.grid-wrapper.is-ajax-deals-content').length > 0 ) {
				var onClickScrollTo = $('.grid-wrapper.is-ajax-deals-content').offset().top;

				if ( onClickScrollTo != null) {
					$window.scrollTop(onClickScrollTo - 300);
				}
			}

		});

	};

	$(window).on('popstate', function() {
		loadPage(location.href);
	});


	/**
	* ----------------------------------------------------------------------------------------
	*    Show Cities on Country Dropdown Click
	* ----------------------------------------------------------------------------------------
	*/

	$('.dropdown .dropdown-menu[data-name="deal_country"] li a').on('click', function(e){

		var $this = $(this);
		var country = $this.data('value');
		var $citiesButton = $this.closest('.dropdown').siblings().find('button.is-city-deal-dropdown');

		$citiesButton.empty().html('<i class="fa fa-circle-o-notch fa-spin"></i>');

		console.log(country);

		$.ajax({
			type: 'post',
        	url: couponhut.ajaxurl,
        	dataType: 'json',
			data: "action=_action_ssd_show_cities&nonce="+couponhut.nonce+"&country="+country,
			success: function(response){

				var $citiesDropdown = $this.closest('.dropdown').siblings().find('ul[aria-labelledby="cities-deal-dropdown"], ul[aria-labelledby="cities-widget-dropdown"]');
				
				$citiesDropdown.html(response.html);
				$citiesDropdown.find('.select-country-first').remove();

				$citiesButton.empty().html($citiesDropdown.find('li:first-child').html());
            }
        });

	});

	/**
	* ----------------------------------------------------------------------------------------
	*   Autofill cities and select current City if $_GET['deal_city'] exists
	* ----------------------------------------------------------------------------------------
	*/
	$('.is-city-deal-dropdown').siblings('.dropdown-menu').each(function(){
		var $this = $(this);

		var sPageURL = decodeURIComponent(window.location.search);
		var country = getUrlParameter(sPageURL, 'deal_country');
		var city = getUrlParameter(sPageURL, 'deal_city');

		var $citiesButton = $this.siblings('button.is-city-deal-dropdown');

		var buttonText = $citiesButton.html();

		if ( country && city ) {
			$citiesButton.empty().append('<i class="fa fa-circle-o-notch fa-spin"></i>');	
		}


		$.ajax({
			type: 'post',
        	url: couponhut.ajaxurl,
        	dataType: 'json',
			data: "action=_action_ssd_show_cities&nonce="+couponhut.nonce+"&country="+country+"&city="+city,
			success: function(result){

				$this.append(result.html);

				if ( result.cities_found) {

					$this.find('.select-country-first').remove();

					var currentItem = $this.find('li a[data-current="true"]');

					if ( currentItem.length > 0 ) {
						$citiesButton.html( currentItem.clone() );
					};
				} else {
					$citiesButton.html(buttonText);
				}

				
            }
        });
	})


	/**
	* ----------------------------------------------------------------------------------------
	*    Print Deal
	* ----------------------------------------------------------------------------------------
	*/

	$('.is-btn-print').on('click', function(){
		$('.image-deal-print').appendTo('body');
		window.print();
	})

	
	
	/**
	* ----------------------------------------------------------------------------------------
	*    Post Share Buttons
	* ----------------------------------------------------------------------------------------
	*/

	$('.is-shareable .facebook').on('click', function(e){
		e.preventDefault();
		var postUrl = $(this).closest('.is-shareable').data('post-url');
		window.open('http://www.facebook.com/sharer.php?u=' + postUrl,'sharer','toolbar=0,status=0,width=626,height=436');
		return false;
	})

	$('.is-shareable .twitter').on('click', function(e){
		e.preventDefault();
		var postUrl = $(this).closest('.is-shareable').data('post-url');
		window.open('https://twitter.com/share?url=' + postUrl,'sharer','toolbar=0,status=0,width=626,height=436');
		return false;
	})

	$('.is-shareable .google-plus').on('click', function(e){
		e.preventDefault();
		var postUrl = $(this).closest('.is-shareable').data('post-url');
		window.open('https://plus.google.com/share?url=' + postUrl,'sharer','toolbar=0,status=0,width=626,height=436');
		return false;
	})

	$('.is-shareable .pinterest').on('click', function(e){
		e.preventDefault();
		var postUrl = $(this).closest('.is-shareable').data('post-url');
		var img = $('.single-deal-slider .owl-item:first-child .bg-image').data('bgimage');
		if ( typeof img == 'undefined' ) {
			img = $('.single-deal-header .bg-image').data('bgimage');
		}
		window.open('http://pinterest.com/pin/create/button/?url=' + postUrl + '&media=' + img,'sharer','toolbar=0,status=0,width=626,height=436');
		return false;
	})

	/**
	* ----------------------------------------------------------------------------------------
	*    Match Height
	* ----------------------------------------------------------------------------------------
	*/

	$('.is-matchheight, .grid-wrapper > *').matchHeight({
		byRow: true
	});
	
	$('.is-matchheight-container .row').each(function(){
		var $this = $(this);

		$this.find('[class^="fw-col-"], [class^="col-"]').matchHeight({
			byRow: false
		});
	})


	/**
	* ----------------------------------------------------------------------------------------
	*    Parallax
	* ----------------------------------------------------------------------------------------
	*/

	function isScrolledIntoView(elem) {
		var $elem = $(elem);
		var $window = $(window);

		var docViewTop = $window.scrollTop();
		var docViewBottom = docViewTop + $window.height();

		var elemTop = $elem.offset().top;
		var elemBottom = elemTop + $elem.height();

		return (elemTop <= docViewBottom);
	}

	function parallax(){
		var windowWidth = $(document).width();

		if ( windowWidth > 992 ) {
			var docViewTop = $window.scrollTop();
			var docViewBottom = docViewTop + $window.height();

			$('.parallax').each(function(){
				var $this = $(this);
				var top = 0;
				if ( isScrolledIntoView($this) ) {

					top = docViewBottom - $this.offset().top;
					$this.css('background-position', '50% ' + ( 100 - (top * 0.07)) + '%');
				} else {
					$this.css('background-position', '50% 0%');
				}

			})
		}

		
	}

	parallax();

	$(window).on('scroll resize', function(e){
		parallax();
	});


	/**
	* ----------------------------------------------------------------------------------------
	*    Count How Many Times a Deal is Redeemed
	* ----------------------------------------------------------------------------------------
	*/

	$('.single-deal-box-inner .btn-deal:not(.btn-disabled), .download-deal-link a').on('click', function(e){

		var $this = $(this);
        var post_id = couponhut.post_id;

       	var buttonText = $this.text();
       	var buttonHref = $this.attr('href');

        $this.addClass('btn-disabled');
		$this.attr('disabled','disabled');

		setTimeout(function(){
			$this.attr('href', '#');
		}, 0)

		$this.text(couponhut.redeemed);

        $.ajax({
        	type: "post",
        	url: couponhut.ajaxurl,
        	dataType: 'json',
        	data: "action=_action_ssd_deal_clicked&nonce="+couponhut.nonce+"&post_id="+post_id,
        	success: function(response){

        		if ( response.limited_deal ) {
        			$('.limited-deal strong').text(response.deals_available_after);
        		} else {
        			$this.removeClass('btn-disabled');
					$this.removeAttr('disabled');
					$this.attr('href', buttonHref);
					$this.text(buttonText);
        		}
        		
        	}
        });


    })

})