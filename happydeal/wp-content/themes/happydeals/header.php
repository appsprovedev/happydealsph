<?php 
if ( isset($_GET['deal_redirect']) ) {
	fw_ssd_hande_deal_redirect();
}

if ( is_user_logged_in() ) {
        if(!is_checkout()) {
        $current_user = wp_get_current_user();
        $user_id = $current_user->ID;
        $approved_status = get_user_meta($user_id, 'wcemailverified', true);
        global $wp;
        $current_url = home_url(add_query_arg(array(),$wp->request));
                if ( !$approved_status){
                   wp_logout();
                   wp_redirect( $current_url );
                   exit;
                }
        }                 
}      

?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />

	<!-- Open Graph -->
	<?php fw_ssd_og_header(); ?>

    <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>

    <?php wp_head(); ?>

    <!-- Slider -->
	<link rel="stylesheet" type="text/css" media="print" href="<?php bloginfo('stylesheet_directory'); ?>/print.css" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	



        	<!-- PLEASE SEE LINKED STYLESHEETS AND SCRIPTS -->
 	<!--<link rel="stylesheet" href="/wp-includes/css/jquery-ui.css">-->
 		<script src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.number.min.js"></script> 
		<script src="<?php bloginfo('stylesheet_directory'); ?>/js/selectize.js"></script>
 		<script src="<?php bloginfo('stylesheet_directory'); ?>/js/custom.js"></script>   
		<!--<link href="/wp-includes/css/materialize.css" rel="stylesheet" />  -->
	        <link href="<?php bloginfo('stylesheet_directory'); ?>/css/custom.css" rel="stylesheet" />



</head>
<?php 
$body_classes = array();

$woocommerce_enable = fw_ssd_get_option('woocommerce-switch');
if ( is_singular('deal') && $woocommerce_enable['woocommerce-picker'] == 'yes' ) {
	array_push($body_classes, 'woocommerce');
}

$url_user = get_option('woocommerce_myaccount_page_id') ? get_permalink( get_option('woocommerce_myaccount_page_id') ) : '';
		
			$url_login = get_permalink( get_option('woocommerce_myaccount_page_id') ) ? get_permalink( get_option('woocommerce_myaccount_page_id') ) : '';

			$url_logout = wc_get_page_id( 'myaccount' ) ? wp_logout_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ) : '';
   $image = fw_ssd_get_option('header-search-image');
	if ( $image ) {
		$bg_image = wp_get_attachment_image_src( $image['attachment_id'], 'ssd_single-post-image' );
		$image_url = $bg_image['0'];
	} else {
		$image_url = '';
	}
	

	// Categories
	$term_args = array( 'hide_empty' => 0 );
	$deal_cats = get_terms('deal_category', $term_args );   
	$deal_country = get_terms('deal_country', $term_args ); 

?>
    <body <?php body_class($body_classes);?>>
     <div class="navigation-wrapper">
        <div style="float:right;background-color: #45BB99;height: 75px;width: 50%;position: absolute;right: 0;"></div>
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<div class="site-logo">
					<a href="<?php echo esc_url(home_url('/')); ?>">
						<?php
						$logo_image = fw_ssd_get_option('logo_image');
						$logo_name = fw_ssd_get_option('logo_name');
						if( !empty( $logo_image ) ) {
							?>
							<img src="<?php echo esc_url( $logo_image['url'] ); ?>" alt="<?php echo esc_attr( $logo_name ); ?>">
							<?php } else if( !empty( $logo_image ) ) { ?>
							<h1><?php echo esc_attr( $logo_name ); ?></h1>
							<?php } else { ?>
							<h1><?php echo get_bloginfo( 'name', 'display' ); ?></h1>
							<?php } ?>
						</a>
					</div>
			</div><!-- end col-sm-3 -->   
                                        
			<div class="col-sm-9 navbar-right">
                                <div class="navbar-right-bg"></div>
                                <div class="navbar-right-content">
                                <div class="col-md-7" style="padding-left: 0;">
                                <!-- Search -->
                                        <div class="inner-addon left-addon" >
                                                <form id="searchform" action="<?php echo esc_url( home_url( "/" ) ); ?>" method="get">
                                                <div style="color: grey; border-radius: 25px; background-color: #fff; height: 28px;">
                                                    <i class="glyphicon glyphicon-search search_icon"></i>  
                                                    <input id="deal_search" type="text" style="border:none;background: none;" name="deal_search" class="form-control"  placeholder="<?php esc_attr_e('Search Deals', 'couponhut');?>" />
                                                    <i class="glyphicon glyphicon-search search_glyph_button" style="background-color: #F5944F; border-radius: 25px; color: white;margin-left: 6px; pointer-events: auto;" onClick='submitDetailsForm()' ></i>  
                                                
                                                </div>
                                                    
                                                <input type="hidden" name="search_type" value="deal" />
                                                </form>
                                        </div>
                                        
                                </div>
                                <div class="col-md-5" style="padding: 0">
                                        <div class="col-xs-4" style="padding: 0;">
                                     	<a href="/cart" class="shoppingCart shoppingCarttop">
					 	<i class="glyphicon glyphicon-shopping-cart" ><span><?php echo sprintf ( _n( '%d', '%d', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?></span></i>
					 </a> 
                                         </div>           
                                        <div class="col-xs-8 nav-top" style="padding: 0 0 0 10px;"> 
                                        <ul class="nav navbar-nav usermenu">
                                       
                                        <li class="menu-item-has-children menu-item-login-register">
				<?php if ( is_user_logged_in() ) : ?>
					<?php 
					$current_user = wp_get_current_user();
					?>
					<a href="<?php echo $url_user; ?>" style="padding: 0"><i class='glyphicon glyphicon-user'></i><span class="userlogin"><?php echo substr($current_user->first_name, 0, 10); ?></span></a>
                                        <i class="fa fa-angle-down"></i>
				<?php else: ?>
					<a href="<?php echo $url_login; ?>" style="padding: 0"><i class='glyphicon glyphicon-user'></i></a>   
                                        <a style="padding: 0;" href="<?php echo $url_login; ?>"><?php esc_html_e('Log In / Register', 'couponhut') ?></a>                                        
				<?php endif; ?>      
                                <?php if ( is_user_logged_in() ) : ?>
				<ul class="sub-menu">
					<?php  $array_menu = wp_get_nav_menu_items('User menu'); ?>
                                                <?php  foreach ($array_menu as $m)  { ?>
                                                        <li><a href="<?php echo $m->url; ?>"><?php echo $m->title; ?></a></li>
                                                <?php } ?>
					
						<?php 

						$allow_no_reg = fw_ssd_get_option('member-submit-switch');
						$allow_no_company = fw_ssd_get_option('member-submit-without-company-switch');
						$show_submit_menu = true;

						if ( fw_ssd_woocommerce() && !is_user_logged_in() && !$allow_no_reg ) {
							$show_submit_menu = false;
						}

						if ( fw_ssd_woocommerce() && is_user_logged_in() && !$allow_no_reg && !get_user_meta( get_current_user_id(), 'user_company_name', true ) && !$allow_no_company  ) {
							$show_submit_menu = false;
						}	

					
						$template_id = fw_ssd_get_submit_template_id(); ?>
					
						<li><a href="<?php echo $url_logout; ?>"><?php esc_html_e('Log Out', 'couponhut') ?></a></li>
						
					
				</ul>    
                                <?php endif; ?>  
			</li>
                                        
                                      </ul>
                                      </div>
                                </div>
			</div><!-- end col-sm-9 -->
		</div><!-- end row -->
                
                <div class="row">
                    	<div class="col-sm-12">
				<?php
				if ( has_nav_menu('main-navigation') ) : ?>
				<nav id="main-navigation" class="main-navigation">
					<?php
					wp_nav_menu( array(
						'theme_location'  => 'main-navigation',
						'container' 	  => false,
						'menu_class'      => 'is-slicknav',
						'walker'		  => new CouponHut_Main_Menu_Walker
						));
						?>
					</nav>
				<?php endif; ?>
			</div><!-- end col-sm-9 -->
                </div>
                </div><!-- end row -->
	</div><!-- end container -->
	
        
        <div style="padding-bottom: 8px; height: 50px;position: absolute; width: 100%; z-index: 99;">
	<div class="header-screen hide" id="header_filter_div" style="padding: 20px; background-color: #f9f9e2; position: relative; z-index: 1">
		<div class="header-screen-content" style="width: 90% !important">
			<form action="<?php echo esc_url( home_url( "/" ) ); ?>" method="get" class="form-deal-submit">
				<div class="row" align="center">
					<h5><?php esc_html_e("FILTER YOUR SEARCH", 'couponhut') ?></h5>
				</div>
				<div class="row">
					<div class="col-sm-6">
					<h6><?php esc_html_e("What are you looking for?", 'couponhut') ?></h6>
					</div>
					<div class="col-sm-6">
					<h6><?php esc_html_e("Price Range:", 'couponhut') ?></h6>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<input type="text" name="deal_search" placeholder="<?php esc_attr_e('Deals & Coupons', 'couponhut');?>">
					</div>
					<div class="col-sm-5">
							<div id="slider-range"></div>
					</div>
					<div class="col-sm-1">&nbsp;</div>
				</div>
				<div class="row">
					<div class="col-sm-3">
						<h6><?php esc_html_e('Category', 'couponhut');?></h6>
					</div>
					<div class="col-sm-3">
						<h6><?php esc_html_e('Location', 'couponhut');?></h6>
					</div>
					<div class="col-sm-6">&nbsp;</div>
				</div>
				<div class="row">
					<div class="col-sm-3">
					<?php 
					if ( ! empty( $deal_cats ) && ! is_wp_error( $deal_cats ) ){

						if ( !empty($_GET['s_deal_category']) ) {
							$deal_cat_current = $_GET['s_deal_category'];
						} else {
							$deal_cat_current = '';
						}

						// Categories Dropdown
						echo '<div class="dropdown">';

						echo '<button id="categories-deal-dropdown dropdown-menu-one-column" class="btn-dropdown" data-toggle="dropdown" >' . esc_html__('Category', 'couponhut') . '</button>';

						echo '<ul class="dropdown-menu dropdown-menu-one-column" aria-labelledby="categories-deal-dropdown" data-name="s_deal_category">';
						
							echo '<li>
									<a href="javascript:void(0)" data-value="" data-current="false">' . esc_html__('None', 'couponhut') . '</a>
								</li>';

						if ( !isset($current) ) $current = false;
						
						foreach ( $deal_cats as $deal_cat ) {

							if ( $deal_cat->slug ==  $deal_cat_current ) {
								$current = 'true';
							} else {
								$current = 'false';
							}

							echo '<li>';
							if ( couponhut_get_field('icon', "{$deal_cat->taxonomy}_{$deal_cat->term_id}") ) {
								$icon_class = couponhut_get_field('icon', "{$deal_cat->taxonomy}_{$deal_cat->term_id}");	
								echo '<a href="' . get_term_link($deal_cat) . '" data-value="' . $deal_cat->slug . '" data-current="' . $current . '"><i class="' . $icon_class . '"></i>' . $deal_cat->name . '</a>';		
							} else {
								echo '<a href="' . get_term_link($deal_cat) . '" data-value="' . $deal_cat->slug . '" data-current="' . $current . '">' . $deal_cat->name . '</a>';	
							}
							echo '</li>';
							
						}
						echo '</ul>';
						echo '</div>';

					} ?>
						<input type="hidden" name="search_type" value="deal" />
						<input type="hidden" name="s_deal_category" value="<?php echo $_GET['s_deal_category'] ? $_GET['s_deal_category'] : '' ?>" />
						<input type="hidden" name="deal_country" value="<?php echo $_GET['deal_country'] ? $_GET['deal_country'] : '' ?>">
					</div>
					<div class="col-sm-3">
					
						<?php 
						$all_countries = array();

						// if( ( $all_countries = get_transient('ssd_all_countries') ) === false ) {	
							$all_countries = fw_ssd_get_all_countries();
							// set_transient('ssd_all_countries', $all_countries, 0);
						// }

						if ( !empty($_GET['deal_country']) ) {
							$deal_country_current = sanitize_title($_GET['deal_country']);
							$deal_country_current_none = '';
						} else {
							$deal_country_current = '';
							$deal_country_current_none = 'true';
						}

						// $deal_country_current = 'italy';
						// $deal_country_current_none = '';
						// Countries Dropdown
						echo '<div class="dropdown">';

							echo '<button id="countries-deal-dropdown" class="btn-dropdown" data-toggle="dropdown" >' . esc_html__('Location', 'couponhut') . '</button>';

							echo '<ul class="dropdown-menu" aria-labelledby="countries-deal-dropdown" data-name="deal_country">';

								echo '<li>
									<a href="javascript:void(0)" data-value="" data-current="false">' . esc_html__('None', 'couponhut') . '</a>
								</li>';

							foreach ( $all_countries as $deal_country ) {

								if ( $deal_country['slug'] ==  $deal_country_current ) {
									$current = 'true';
								} else {
									$current = 'false';
								}
								echo '<li>
									<a href="javascript:void(0)" data-value="' . $deal_country['slug'] . '" data-current="' . $current . '">' . $deal_country['name'] . '</a>
								</li>';
							}
							echo '</ul>';
						echo '</div>';

						?>
					</div>
					<div class="col-sm-2">
						<h4 style="position: absolute;margin: 5px 0px 0px 170px; color: #ddd; z-index: 0 !important;">-</h4>
						<input type="text" class="number amount-slider-left-side" name="deal_range_from" placeholder="From" value="<?php echo $_GET['deal_range_from'] ? $_GET['deal_range_from'] : ''; ?>">
					</div>
					<div class="col-sm-2">
						<input type="text" class="number amount-slider-right-side" name="deal_range_to" placeholder="To" value="<?php echo $_GET['deal_range_to'] ? $_GET['deal_range_to'] : ''; ?>">
					</div>
					<div class="col-sm-2">
						<button type="submit" class="submit">APPLY FILTER</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<input type="hidden" id="trigger" value="0">
		<div style="position: absolute;padding-left: 1000px;border-top: 2px solid #F58B43;">
			<a type="button" id="filter_puller_button" class="btn-default" style="z-index: 2 !important">
			<label style="position: absolute;padding: 5px 35px 0px 35px; color: white">Filter</label>
 			</a>
			<svg height="30" width="470" border="1">
		    	<path d="M48, 80 L100,0 L0, 0 A0,56 0 0,1 0, 0z" fill="#FC9741"/></path>
	  		</svg>
 		</div>

</div>
</div>


</div><!-- end navigation-wrapper -->




<script language="javascript" type="text/javascript">
    function submitDetailsForm() {
       $("#searchform").submit();
    }
</script>



	


<?php 
$show_search = false;

$search_screen = fw_ssd_get_option('search-screen');

switch ( get_post_type(get_the_ID()) ) {
	case 'post':
		$show_search = isset($search_screen['post']) ? $search_screen['post'] : false;
		break;
	case 'deal':
		$show_search = isset($search_screen['deal']) ? $search_screen['deal'] : false;
		break;
	case 'page':
		if ( is_page_template( 'template-submit-deal.php' ) ) {
			$show_search = false;
		} else {
			$show_search = couponhut_get_field('search_header') == 'show' ? true : false;
		}	
		break;
}

if ( is_archive()  ) {
	$show_search = isset($search_screen['archive']) ? true : false;
}

if ( is_search() ) {
	$show_search = isset($search_screen['search']) ? true : false;
}

// if ( $show_search ) {
// 	get_template_part( 'partials/content', 'header-screen' );
// }

