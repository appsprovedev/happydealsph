<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}


$options = array(
	'title' => array(
		'type'  => 'text',
		'value' => 'Latest News',
		'label' => esc_html__('Title', 'couponhut'),
	),
	'all_news_text'  => array(
		'label' => esc_html__( 'All News Link Text', 'couponhut' ),
		'type'  => 'text',
		'value' => 'All News'
	),

);