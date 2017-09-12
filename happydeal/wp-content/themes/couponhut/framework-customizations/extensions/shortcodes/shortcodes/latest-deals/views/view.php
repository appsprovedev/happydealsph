<?php if (!defined('FW')) die( 'Forbidden' ); ?>

<?php
$template_url = fw_ssd_get_browse_template_url();
if ( !$template_url ) : ?>
	<p><?php esc_html_e('<strong>Note!</strong> Make sure than you have published one (and only one) page that uses the "Browse Deals" Template.', 'couponhut') ?></p>
<?php else:	?>

<div class="section-title-block">
	<h1 class="section-title"><?php echo wp_kses_post( $atts['title'] ); ?></h1>
	<a href="<?php echo esc_url($template_url); ?>" class="see-more"><span><?php echo wp_kses_post( $atts['all_deals_text'] ); ?></span><i class="fa fa-arrow-right"></i></a>
</div>

<?php endif; ?>

<?php 
$grid_columns = $atts['columns_count'] ? $atts['columns_count'] : 'col-xs-6 col-sm-6 col-md-4';

if ( $grid_columns == 1 ) {
	$grid_item_class = 'col-sm-12 col-sm-12 col-md-12';
} else if ( $grid_columns == 2 ) {
	$grid_item_class = 'col-xs-6 col-sm-6 col-md-6';
} else if ( $grid_columns == 3 ) {
	$grid_item_class = 'col-xs-6 col-sm-6 col-md-4';
} else if ( $grid_columns == 4 ) {
	$grid_item_class = 'col-xs-6 col-sm-4 col-md-3';
}
?>

<div class="latest-deals-wrapper grid-wrapper">

	<?php

	$args = array(
		'post_type' => 'deal',
		'posts_per_page' => $atts['deals_count'],
	);

	if ( $atts['type'] == 'coupons' ) {
		$args['meta_key'] = 'deal_type';
		$args['meta_value'] = 'coupon';
	} 

	if( $atts['type'] == 'discounts' ) {
		$args['meta_key'] = 'deal_type';
		$args['meta_value'] = 'discount';
	}

	// Query only not expired deals

	if ( !isset( $args['meta_query'] ) ) {
		$args['meta_query'] = array();
	}

	array_push(
		$args['meta_query'], 
		array(
			array(
				'relation' => 'OR',
				array(
					'key' => 'expiring_date',
					'value' => date('Ymd'),
					'compare' => '>',
					'type' => 'UNSIGNED'
				),
				array(
					'key' => 'expiring_date',
					'value' => ''
				)
			)
		)
	);

	// Hide deals with enabled "Registered Members Only" when not registered

	if ( fw_ssd_woocommerce() && !is_user_logged_in() && !fw_ssd_get_option('member-only-show-switch') ) {
		$registered_array = array(
			'relation' => 'OR',
			array(
				'key' => 'registered_members_only',
				'value' => false,
				'compare' => '=',
				'type' => 'UNSIGNED'
			),
			array(
				'key' => 'registered_members_only',
				'compare' => 'NOT EXISTS'
				)
		);
		$args['meta_query']['relation'] = 'AND';
		array_push($args['meta_query'], $registered_array);
	}

	$the_query = new WP_Query($args);

	if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>

		<div class="deal-item-wrapper <?php echo esc_attr($grid_item_class) ?>">
			<?php get_template_part('loop/content', 'deal'); ?>
		</div>

	<?php
	endwhile;
	wp_reset_postdata(); 
	endif;
	?>

</div><!-- end latest-deals-wrapper -->