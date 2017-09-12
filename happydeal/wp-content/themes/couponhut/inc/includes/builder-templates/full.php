<?php if (!defined('FW')) die('Forbidden');

$templates_list = array(
	'front_page' =>  esc_html__('Front Page', 'couponhut'),
	'front_page_image' =>  esc_html__('Front Page - Image', 'couponhut')
);

$json_dir = get_template_directory() .'/inc/includes/builder-templates/';
$json_files = glob($json_dir . '*.json');

foreach ($json_files as $key => $value) {
	$match = array();
	preg_match('/\/([\w]+)\.json/', $value, $match);
	$list_key = $templates_list[$match[1]];

	if ( $list_key ) {
		$json_file = get_template_directory_uri() .'/inc/includes/builder-templates/' . $match[1] . '.json';
		$json = wp_remote_fopen($json_file);
		$template_item = array(
			'title' => $list_key,
			'json'  => $json
			);
		$templates[$match[1]] = $template_item;
	}
}