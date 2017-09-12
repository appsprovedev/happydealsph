<?php
/* Template Name: Full Width */
get_header();
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('page-wrapper'); ?>>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="container">
			<div class="page-content">
				<?php 
				if ( function_exists('fw_ext_breadcrumbs') ) {
					fw_ext_breadcrumbs( '>' );
				}
				?>
				<?php the_content(); ?>
			</div>
		</div>

	<?php endwhile; else : ?>

		<div class="no-posts-wrapper">
			<h3><?php esc_html_e('Sorry, no posts found.', 'couponhut'); ?></h3>
		</div>

	<?php endif; ?>
	
</div><!-- end post -->

<?php get_footer(); ?>