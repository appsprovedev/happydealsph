<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
?>

<div class="ImageCarouselWrapper">
	<?php 
		$image_count = count($atts['image_carousel']);
	?>
	<?php if ( $image_count > 0 ): ?>
	<div class="image-carousel">
	<?php endif; ?>

	<?php foreach ($atts['image_carousel'] as $image) : ?>
		<div class="Image text-center">
			<?php echo wp_get_attachment_image( $image['attachment_id'], 'couponhut_large_soft' ); ?>
		</div> <!-- end Image -->
	<?php endforeach; ?>

	</div> <!-- end owl-carousel -->
		
</div> <!-- end ImageCarouselWrapper -->