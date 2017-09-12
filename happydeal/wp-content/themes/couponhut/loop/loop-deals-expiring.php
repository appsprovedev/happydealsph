<?php
if( get_query_var( 'paged' ) )
	$paged = get_query_var( 'paged' );
else {
	if( get_query_var( 'page' ) )
		$paged = get_query_var( 'page' );
	else
		$paged = 1;
	set_query_var( 'paged', $paged );
}

$args = array(
	'post_type' => 'deal',
	'posts_per_page' => fw_ssd_get_option('deals-per-page'),
	'paged' => $paged
);

$args['meta_key'] = 'expiring_date';
$args['orderby'] = 'meta_value';
$args['order'] = 'asc';

// Query only not expired deals
$args['meta_query'] = array(
	array(
		'relation' => 'OR',
		array(
			'key' => 'expiring_date',
			'value' => date('Ymd'),
			'compare' => '>=',
			'type' => 'UNSIGNED'
		),
		array(
			'key' => 'expiring_date',
			'value' => ''
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

$deals_query = new WP_Query($args); // The Query

?>

<?php 
	/**
	*  Posts Loop
	*/
	if ($deals_query->have_posts()) : ?>

	<div class="grid-wrapper">
		
		<?php while  ( $deals_query->have_posts() ) : $deals_query->the_post(); ?>
				<div class="deal-item-wrapper col-xs-6 col-sm-6 col-md-4">
					<?php get_template_part('loop/content', 'deal'); ?>
				</div>
				
		<?php
		endwhile;
		?>

	</div><!-- end grid-wrapper -->

	<?php
	// Pagination
	$ajax = fw_ssd_get_option('ajax-switch');
	fw_ssd_paging_nav($deals_query, $ajax);

	wp_reset_postdata();

	endif; //have_posts()