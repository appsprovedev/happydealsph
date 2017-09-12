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
</head>
<?php 
$body_classes = array();
                                                                                        
$woocommerce_enable = fw_ssd_get_option('woocommerce-switch');
if ( is_singular('deal') && $woocommerce_enable['woocommerce-picker'] == 'yes' ) {
	array_push($body_classes, 'woocommerce');
}	
?>

<body <?php body_class($body_classes);?>>

<div class="navigation-wrapper">
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