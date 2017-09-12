<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'image_carousel' => array(
		'label'  => esc_html__( 'Image Carousel', 'couponhut' ),
		'type'   => 'multi-upload',
		'value'  => '',
		'images_only' => true,
		'desc'   => esc_html__( 'Add Images that will appear in the carousel.', 'couponhut' ),
	)
);