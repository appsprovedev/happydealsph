<?php
/*
Template name: Browse Categories
*/
get_header();
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('page-wrapper'); ?>>
	
	<?php
	$args = array(
		'hide_empty'  => false,
		'orderby'     => fw_ssd_get_option('order-categories'),
		'order'       => fw_ssd_get_option('order-categories') == 'name' ? 'ASC' : 'DESC'
		); 
	$terms = get_terms( 'deal_category', $args );
	
	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) : ?>

	<div class="container">
	
		<div class="row">

			<?php if ( fw_ssd_get_option('taxonomy-sidebar-switch') ) : ?>
				<div class="col-sm-8 col-md-9 <?php echo fw_ssd_get_option('sidebar-switch') == 'left' ? 'col-sm-push-4 col-md-push-3' : '' ?>">
			<?php else : ?>
				<div class="col-sm-12">
			<?php endif; ?>

				<div class="section-title-block">
					<h1 class="section-title"><?php the_title(); ?></h1>
					<?php 
					if ( function_exists('fw_ext_breadcrumbs') ) {
						fw_ext_breadcrumbs( '>' );
					}
					?>
				</div><!-- end section-title-block -->

				<div class="grid-wrapper">

				<?php
				foreach ( $terms as $term ) :
					$acf_term = $term->taxonomy . '_' . $term->term_id;
					?>

						<div class="grid-item col-xs-6 col-sm-6 col-md-4">
							<a href="<?php echo get_term_link( $term->slug, 'deal_category' ); ?>" class="grid-item-icon">
							<?php if ( couponhut_get_field('icon', $acf_term) ) : ?>
								<i class="icon <?php echo esc_attr(couponhut_get_field('icon', $acf_term)); ?>"></i>
							<?php endif; ?>
								<h2><?php echo wp_kses_post($term->name); ?></h2>
							</a>
						</div><!-- end grid-item -->
				<?php		
				endforeach;
				?>

				</div><!-- end grid-wrapper -->

			</div><!-- end col-sm-8 col-md-9 -->

			<?php
			if ( fw_ssd_get_option('taxonomy-sidebar-switch') ) {
				get_sidebar(); 
			}
			?>

		</div><!-- end rows cols-np -->

	</div><!-- end container-fluid -->

	<?php endif; ?>

</div><!-- end post-id -->


<?php
get_footer();
?>