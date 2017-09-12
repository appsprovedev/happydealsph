<?php 
if ( isset($_GET['deal_redirect']) ) {
	fw_ssd_hande_deal_redirect();
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
	<link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">



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
                        	
?>

<body <?php body_class($body_classes);?>>

<div class="navigation-wrapper">
        <div class="row nav-top">
        
                        <div class="nav-top-right">
                              <div class="col-sm-3 navbar-right">
                                      
                                      <ul class="nav navbar-nav">
                                        <li><a href="/how-it-works">How it works</a></li>
                                        <li class="menu-item-has-children menu-item-login-register">
				<?php if ( is_user_logged_in() ) : ?>
					<?php 
					$current_user = wp_get_current_user();
					?>
					<a href="<?php echo $url_user; ?>"><i class='icon-User'></i><span class="userlogin"><?php echo substr($current_user->user_login, 0, 5); ?></span></a>
                                        <i class="fa fa-angle-down"></i>
				<?php else: ?>
					<a href="<?php echo $url_login; ?>"><i class='icon-User'></i></a>
				<?php endif; ?>
				<ul class="sub-menu">
					<?php if ( is_user_logged_in() ) : ?>
						<li><a href="<?php echo $url_user; ?>"><?php esc_html_e('Profile', 'couponhut') ?></a></li>
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


						if ( $show_submit_menu ) :
						?>
						<li><a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')) . 'submitted-deals'; ?>"><?php esc_html_e( 'Submitted Deals', 'couponhut' ); ?></a></li>
						<?php endif; ?>
						<?php 
						$template_id = fw_ssd_get_submit_template_id();
						if ( $template_id && $show_submit_menu ) : ?>
							<li><a href="<?php echo get_permalink($template_id); ?>"><?php esc_html_e('Submit', 'couponhut') ?></a></li>
						<?php endif; ?>
						<li><a href="<?php echo $url_logout; ?>"><?php esc_html_e('Log Out', 'couponhut') ?></a></li>
						<?php elseif ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
						<li><a href="<?php echo $url_login; ?>"><?php esc_html_e('Log In / Register', 'couponhut') ?></a></li>
						<?php else: ?>
						<li><a href="<?php echo $url_login; ?>"><?php esc_html_e('Log In', 'couponhut') ?></a></li>
					<?php endif; ?>
				</ul>
			</li>
                                        
                                      </ul>
                               </div>
                        </div>
                </div>
	<div class="container">
                
		<div class="row">
			<div class="col-sm-3">

			<img src="logo.png" alt="logo"></a>
				<!-- <div class="site-logo">
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
					</div> -->
			</div><!-- end col-sm-3 -->
			<div class="col-sm-9">
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
		</div><!-- end row -->
	</div><!-- end container -->
	
</div><!-- end navigation-wrapper -->
<div class="nav-offset"></div>

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

if ( $show_search ) {
	get_template_part( 'partials/content', 'header-screen' );
}