<?php
get_header();
?>
<div <?php post_class('page-wrapper'); ?>>

	<div class="container">
		<div class="row">
			<div class="col-sm-offset-2 col-sm-8">
				<div class="page-content mb-40">
					<header class="error-header">
						<h1>Error 404</h1>
					</header>

					<div class="error404-message">

						<p><?php esc_html_e('Whatever you were looking for was not found, but maybe try looking again or search using the form below.', 'couponhut') ?></p>
					</div>

					<div class="error404-search">
						<?php get_search_form(); ?>
					</div>

				</div><!-- end page-content -->
				
			</div><!-- end col-sm-12 -->
		</div><!-- end row -->
		
	</div><!-- end container -->

	<?php if ( current_user_can( 'manage_options' ) ): ?>
		<div class="container">
			<div class="row">
				<div class="col-sm-12 alert alert-warning">
					<h2><?php esc_html_e('Warning!', 'couponhut') ?></h2>
					<p><?php esc_html_e('This warning is visible to logged administrators only.', 'couponhut') ?></p>
					<p><?php esc_html_e('If you are trying to load a single deal page, one of the issues could be that the Permalinks are not refreshed. In the Admin Dashboard, click on Settings -> Permalinks and select the "Post Name" checkbox.', 'couponhut') ?></p>
					<p>
						<a href="<?php echo add_query_arg('gmaps-notice', 'close', get_permalink()); ?>"><?php esc_html_e('Remove this notice.', 'couponhut') ?></a>
					</p>
				</div>
			</div>
		</div>

	<?php endif; ?>

</div><!-- end post -->

<?php get_footer(); ?>