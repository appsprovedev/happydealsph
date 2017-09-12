<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * Helper functions and classes with static methods for usage in theme
 */

/**
* ----------------------------------------------------------------------------------------
*    DEBUG FUCNTIONS
* ----------------------------------------------------------------------------------------
*/

if(!function_exists('log_it')){
	function log_it( $message ) {
		if( WP_DEBUG === true ){
			if( is_array( $message ) || is_object( $message ) ){
				error_log( print_r( $message, true ) );
			} else {
				error_log( $message );
			}
		}
	}
}

/**
* ----------------------------------------------------------------------------------------
*    ACF
* ----------------------------------------------------------------------------------------
*/

/**
 * Return a custom field stored by the Advanced Custom Fields plugin 
 */

if ( !function_exists( 'couponhut_get_field' ) ) {
	function couponhut_get_field( $key, $id=false, $default='' ) {
		global $post;
		$key = trim( filter_var( $key, FILTER_SANITIZE_STRING ) );
		$result = '';

		if ( function_exists( 'get_field' ) ) {
			if ( isset( $post->ID ) && !$id )
				$result = get_field( $key );
			else
				$result = get_field( $key, $id );

		if ( $result == '' ) // If ACF enabled but key is undefined, return default
		$result = $default;

		} else {
			$result = $default;
		}
	return $result;
}
}

if ( !function_exists( 'couponhut_the_field' ) ) {
	function couponhut_the_field( $key, $id=false, $default='' ) {

		$value = couponhut_get_field($key, $id, $default);

		if( is_array($value) ) {

			$value = @implode( ', ', $value );

		}

		echo $value;
	}
}

if ( !function_exists( 'couponhut_get_sub_field' ) ) {
	function couponhut_get_sub_field( $key, $default='' ) {
		if ( function_exists( 'get_sub_field' ) &&  get_sub_field( $key ) )  
			return get_sub_field( $key );
		else 
			return $default;
	}
}

if ( !function_exists( 'couponhut_the_sub_field' ) ) {
	function couponhut_the_sub_field( $key, $default='' ) {
		$value = couponhut_get_sub_field( $key, $default );
		echo $value;
	}
}

if ( !function_exists( 'couponhut_has_sub_field' ) ) {
	function couponhut_has_sub_field( $key, $id=false ) {
		if ( function_exists('has_sub_field') )
			return has_sub_field( $key, $id );
		else
			return false;
	}
}

if ( !function_exists( 'couponhut_have_rows' ) ) {
	function couponhut_have_rows( $key, $id=false ) {
		if ( function_exists('have_rows') )
			return have_rows( $key, $id );
		else
			return false;
	}
}

/**
* ----------------------------------------------------------------------------------------
*    Unyson
* ----------------------------------------------------------------------------------------
*/

/**
 *  Get Unyson option
 */
if ( !function_exists( 'fw_ssd_get_option' ) ) {
	function fw_ssd_get_option($option_id, $default_value = false) {
		if ( function_exists( 'fw_get_db_settings_option' ) ) {
			return fw_get_db_settings_option($option_id, $default_value);
		}

		return $default_value;
	}
}


/**
 *  Print typography CSS
 */

if ( !function_exists( 'fw_ssd_typography_css' ) ) {
	function fw_ssd_typography_css($field) {

		$output = '';
		$pattern = '/(\d+)|(regular|italic)/i';

		
		if ( isset($field['family']) ) {
			$output .= 'font-family: ' . $field['family'] . ';';
			$output .= "\r\n";
		}

		if ( isset($field['google_font']) ) {
			preg_match_all($pattern, $field['variation'], $matches);
		} else {
			preg_match_all($pattern, $field['style'], $matches);
		}

		if ( $matches[0] ) {
			foreach ($matches[0] as $value) {
				if ( $value == 'italic' ) {
					$output .= 'font-style: ' . $value . ';';
					$output .= "\r\n";
				} else if ( $value == 'regular' ) {
					$output .= 'font-style: normal;';
					$output .= "\r\n";
				} else {
					$output .= 'font-weight: ' . $value . ';';
					$output .= "\r\n";
				}
			}
		}

		return $output;
		
	}
}


/**
*  Get remote Google Fonts
*/

if (!function_exists('fw_ssd_get_remote_fonts')) :
	function fw_ssd_get_remote_fonts($include_from_google) {
		/**
		 * Get remote fonts
		 * @param array $include_from_google
		 */
		if ( ! sizeof( $include_from_google ) ) {
			return '';
		}

		$html = '<link href="//fonts.googleapis.com/css?family=';

		foreach ( $include_from_google as $font => $styles ) {
			$html .= str_replace( ' ', '+', $font ) . ':' . implode( ',', $styles['variants'] ) . '|';
		}

		$html = substr( $html, 0, - 1 );
		$html .= '" rel="stylesheet" type="text/css">';

		return $html;
	}
endif;

/**
 *  Populate an array with IDs and Titles of posts
 */

if ( !function_exists( 'fw_ssd_get_post_names' ) ) {
	function fw_ssd_get_post_names($post_type = null) {

		global $post;

		$original_post = $post;

		$array = array();

		$args = array(
			'post_type' => $post_type,
			'posts_per_page' => -1
			);

		if ( post_type_exists($post_type) ) {

			$the_query = new WP_Query($args);

			if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();

			$array[get_the_ID()] = get_the_title();

			endwhile; endif;

			wp_reset_postdata();

			$post = $original_post;
			unset($original_post);

		} else {
			$array['no-such-post-type'] = 'There is no ' . $post_type . ' post type detected. Please install Deals plugin.';
		}

		return $array;
	}	
}


/**
 *  Populate an array with IDs and Titles of taonomies
 */

if ( !function_exists( 'fw_ssd_get_term_names' ) ) {
	function fw_ssd_get_term_names($taxonomy = null) {

		$array = array();

		$args = array(
			'hide_empty' => false
			);

		$terms = get_terms( $taxonomy, $args );

		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){

			foreach ($terms as $term) {
				$array[$term->term_id] = $term->name;
			}

		} else {
			$array['no-such-taxonomy'] = 'There is no ' . $taxonomy . ' taxonomy detected. Please install Deals plugin.';
		}

		return $array;
	}
}


/**
 *  Populate an array with social icons and titles
 */

if ( !function_exists( 'fw_ssd_get_social_icons' ) ) {
	function fw_ssd_get_social_icons() {

		$social_options = array();

		$social_titles = array(
			'Google-Plus'  => esc_html__( 'Google URL:', 'couponhut' ),
			'Facebook'     => esc_html__( 'Facebook URL:', 'couponhut' ),
			'Twitter'      => esc_html__( 'Twitter URL:', 'couponhut' ),
			'Vimeo'        => esc_html__( 'Vimeo URL:', 'couponhut' ),
			'Linkedin'     => esc_html__( 'Linkedin URL:', 'couponhut' ),
			'Instagram'    => esc_html__( 'Instagram URL:', 'couponhut' )
			);

		foreach ($social_titles as $key => $value) {

			$social_options[$key] = array(
				'label' => $value,
				'type'  => 'text',
				'value' => ''
				);

		}

		return $social_options;
	}
}


/**
* ----------------------------------------------------------------------------------------
*    Theme
* ----------------------------------------------------------------------------------------
*/

/**
*  Get the "Browse Deals" Template URL
*/

if ( !function_exists( 'fw_ssd_get_browse_template_url' ) ) {
	function fw_ssd_get_browse_template_url(){
		$pages = get_pages(array(
			'meta_key' => '_wp_page_template',
			'meta_value' => 'template-browse-deals.php',
			'post_status' => 'publish',
			));
		if ( count($pages) != 1 ) {
			return false;
		} else {
			$template_url = get_permalink( $pages[0]->ID );
			return $template_url;
		}
	}
}


/**
*  Get the "Submit Deals" Template URL
*/

if ( !function_exists( 'fw_ssd_get_submit_template_id' ) ) {
	function fw_ssd_get_submit_template_id(){
		$pages = get_pages(array(
			'meta_key' => '_wp_page_template',
			'meta_value' => 'template-submit-deal.php',
			'post_status' => 'publish',
			));
		if ( count($pages) != 1 ) {
			return false;
		} else {
			return $pages[0]->ID;
		}
	}
}



/**
 *  Check If Current User Has ALready Voted
 */

if ( !function_exists( 'fw_ssd_has_already_voted' ) ){
	function fw_ssd_has_already_voted($post_id) {

	    // Retrieve post votes IPs
		$meta_IP = get_post_meta($post_id, "voted_IP");
		$voted_IP = $meta_IP[0];

		if(!is_array($voted_IP)) {
			$voted_IP = array();
		}

	    // Retrieve current user IP
		if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] != '') {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}

	    // If user has already voted
		if(in_array($ip, array_keys($voted_IP)))
		{
			return true;
		}

		return false;
	}
}



/**
 *  Print taxonomy links
 */

if ( !function_exists( 'fw_ssd_taxonomy_links' ) ) {
	function fw_ssd_taxonomy_links($taxonomy = null) {

		global $post;

		$terms_array = array();
		$terms = wp_get_post_terms( $post->ID, $taxonomy );

		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){

			foreach($terms as $term) {
				$term_link = '<a href="' . get_term_link( $term ) . '">' . $term->name . '</a>';
				array_push($terms_array, $term_link);
			}
			$terms_string = implode(', ',$terms_array);

			return $terms_string;
		}

	}
}

/**
 *  Element Style Options
 */

if ( !function_exists( 'fw_ssd_inline_css' ) ){
	function fw_ssd_inline_css($options = array()) {

		$output = 'style="';

		foreach ($options as $property => $option_value) {

			if ( !empty($option_value) ) {

				switch ($property) {
					case 'bg_image':
					$output .= 'background-image: url(\'' . htmlspecialchars($option_value) . '\'); ';
					break;
					case 'bg_color':
					$output .= 'background-color: ' . $option_value . '; ';
					break;
					case 'color':
					$output .= 'color: ' . $option_value . '; ';
					break;
					case 'opacity':
					$output .= 'opacity: ' . $option_value / 100 . '; ';
					break;
				}

			}

		}

		$output .= '"';
		
		echo $output;

	}
}



/**
 *  Open Graph
 */

if ( !function_exists( 'fw_ssd_og_header' ) ){
	function fw_ssd_og_header(){

		global $post;
		
		if (is_single()) {


			$page_object = get_queried_object();
			$page_id     = get_queried_object_id();

			
			if ( is_singular('deal') ) {
				
				if ( couponhut_get_field('image_type') == 'image' ) { 

					$image = couponhut_get_field('header_image') ? couponhut_get_field('header_image') : couponhut_get_field('image');

				} else { 

					if( couponhut_have_rows('slider') ):

						$img_num = 1; 

					while ( couponhut_have_rows('slider') ) : the_row(); 

					if ( $img_num == 1 && couponhut_get_sub_field('image') ) {
						$image = couponhut_get_sub_field('image');

					}
					$img_num++;

					endwhile;

					endif;
				}
				
				if ( $image ) {
					echo '<meta property="og:image" content="' . $image['sizes']['ssd_deal-thumb'] . '" />'; 
				}

			} elseif (function_exists('wp_get_attachment_thumb_url')) {
				$image = wp_get_attachment_thumb_url(get_post_thumbnail_id($post->ID));
				if ( $image ) {
					echo '<meta property="og:image" content="' . $image . '" />'; 
				}
			}
			echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '" />';
			echo '<meta property="og:title" content="' . get_the_title() . '" />';
			if ( isset($page_id) ) {
				$post = get_post($page_id);
				setup_postdata($post);
				echo '<meta property="og:description" content="' . strip_tags(get_the_excerpt()) . '" />';
				wp_reset_postdata();
			}
			echo '<meta property="og:type" content="article" />';

			
		} else { // not single
			echo '<meta property="og:site_name" content="' . get_bloginfo('name') . '" />';
			echo '<meta property="og:description" content="' . get_bloginfo('description') . '" />';

			$logo_image = fw_ssd_get_option('logo_image');
			$logo_name = fw_ssd_get_option('logo_name');

			if ( !empty( $logo_image ) ) {

				echo '<meta property="og:image" content="' . $logo_image['url'] . '" />'; 

			}
			echo '<meta property="og:type" content="website" />';
		}
	}
}


/**
*  Prev / Next Pagination
*/

if ( ! function_exists( 'fw_ssd_paging_nav' ) ) : 
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 */ 
{
	function fw_ssd_paging_nav( $wp_query = null, $ajax = false ) {

		if ( ! $wp_query ) {
			$wp_query = $GLOBALS['wp_query'];
		}

		// Don't print empty markup if there's only one page.
		if ( $wp_query->max_num_pages < 2 ) {
			return;
		}

		$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;

		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link,
			'index.php' ) ? 'index.php/' : '';
		$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%',
			'paged' ) : '?paged=%#%';

		// Set up paginated links.
		$links = paginate_links( array(
			'base'      => $pagenum_link,
			'format'    => $format,
			'total'     => $wp_query->max_num_pages,
			'current'   => $paged,
			'mid_size'  => 1,
			'add_args'  => array_map( 'urlencode', $query_args ),
			'prev_text' => esc_html__( '&larr; Previous', 'couponhut' ),
			'next_text' => esc_html__( 'Next &rarr;', 'couponhut' ),
			) );

		if ( $links ) :

			$ajax_class = ( fw_ssd_get_option('ajax-switch') && $ajax ) ? 'is-ajax-paging-navigation' : '';

			?>

		<nav class="navigation paging-navigation <?php echo $ajax_class; ?>" role="navigation">
			<div class="posts-pagination loop-pagination">
				<?php echo $links; ?>
			</div>
			<!-- .pagination -->
		</nav><!-- .navigation -->
		<?php
		endif;
	}
}
endif;


/**
*  AJAX Prev / Next Pagination
*/

if ( ! function_exists( 'fw_ssd_ajax_paging_nav' ) ) : 
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 */ 
{
	function fw_ssd_ajax_paging_nav( $wp_query = null ) {

		if ( ! $wp_query ) {
			$wp_query = $GLOBALS['wp_query'];
		}

		// Don't print empty markup if there's only one page.
		if ( $wp_query->max_num_pages < 2 ) {
			return;
		}

		$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;

		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link,
			'index.php' ) ? 'index.php/' : '';
		$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%',
			'paged' ) : '?paged=%#%';

		// Set up paginated links.
		$links = paginate_links( array(
			'base'      => $pagenum_link,
			'format'    => $format,
			'total'     => $wp_query->max_num_pages,
			'current'   => $paged,
			'mid_size'  => 1,
			'add_args'  => array_map( 'urlencode', $query_args ),
			'prev_text' => esc_html__( '&larr; Previous', 'couponhut' ),
			'next_text' => esc_html__( 'Next &rarr;', 'couponhut' ),
			) );

		if ( $links ) :

			?>
		<nav class="navigation paging-navigation is-ajax-paging-navigation" role="navigation">
			<div class="posts-pagination loop-pagination">
				<?php echo $links; ?>
			</div>
			<!-- .pagination -->
		</nav><!-- .navigation -->
		<?php
		endif;
	}
}
endif;


/**
*  Custom Length Excerpt
*/

if ( !function_exists( 'fw_ssd_get_excerpt' ) ) {
	function fw_ssd_get_excerpt($limit = 55) {
		$excerpt = explode(' ', get_the_content(), $limit);
		if (count($excerpt)>=$limit) {
			array_pop($excerpt);
			$excerpt = implode(" ",$excerpt).'...';
		} else {
			$excerpt = implode(" ",$excerpt);
		}
		$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
		return $excerpt;
	}
}





/**
*  Comments
*/

if ( !function_exists( 'fw_ssd_comments' ) ) {
	function fw_ssd_comments($comment, $args, $depth) {

		$GLOBALS['comment'] = $comment; ?>

		<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
			<article class="comment-content">
				<div class="media">
					<div class="media-left">
						<figure class="comment-avatar">
							<?php
							$avatar_size = 50;
							echo get_avatar($comment, $avatar_size); ?>
						</figure>

					</div><!-- end media-left -->
					<div class="media-body comment-body">
						<header class="comment-header">

							<h5 class="comment-author"><?php comment_author_link(); ?></h5>
							<span class="comment-meta"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_date(); ?> - <?php comment_time(); ?></a><?php edit_comment_link(esc_html__('[Edit]', 'couponhut'),'  ','') ?> &middot; <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span>
						</header>
						<div class="comment-main-content">
							<?php if ( $comment->comment_approved == 0 ) : ?>

								<p class="awaiting-moderation alert"><?php esc_html_e('Your comment is awaiting moderation', 'couponhut'); ?></p>

							<?php endif; ?>

							<?php comment_text(); ?>
						</div>

					</div><!-- end media-body -->
				</div><!-- end media -->
				
			</article>
			<?php

		}
	}

/**
*  Social API Check
*/

if ( !function_exists( 'fw_ssd_api_key_check' ) ) {
	function fw_ssd_api_key_check( $name ) { 

		$twitter_key = fw_ssd_get_option('consumer_key');
		$twitter_secret = fw_ssd_get_option('consumer_secret');
		$twitter_token = fw_ssd_get_option('access_token');
		$twitter_token_secret = fw_ssd_get_option('access_token_secret');

		$api_key = fw_ssd_get_option('mailchimp_api_key') ? fw_ssd_get_option('mailchimp_api_key') : false;
		$list_id = fw_ssd_get_option('mailchimp_list_id') ? fw_ssd_get_option('mailchimp_list_id') : false;

		// Mailchimp Api Key and List ID check
		if ($name == 'mailchimp') {
			if ( !$api_key && !$list_id ) {
				printf( esc_html__('Mailchimp API Key and List ID are not set, enter them from %s -> Mailchimp','couponhut'), sprintf( '<a href="%s">%s</a>', admin_url( 'admin.php?page=fw-settings' ), esc_html__( 'Appearance -> Theme Settings', 'couponhut' ) ));
			}
			elseif ( !$api_key ) {
				printf( esc_html__('Mailchimp API Key not found, enter it from %s -> Mailchimp','couponhut'), sprintf( '<a href="%s">%s</a>', admin_url( 'admin.php?page=fw-settings' ), esc_html__( 'Appearance -> Theme Settings', 'couponhut' ) ));
			}
			elseif ( !$list_id ) {
				printf( esc_html__('Mailchimp List ID not found, enter it from %s -> Mailchimp','couponhut'), sprintf( '<a href="%s">%s</a>', admin_url( 'admin.php?page=fw-settings' ), esc_html__( 'Appearance -> Theme Settings', 'couponhut' ) ));
			}
		}
		if ($name == 'twitter') {
			if ( empty($twitter_key) || empty($twitter_secret) || empty($twitter_token) || empty($twitter_token_secret) ) {
				printf( esc_html__('Twitter API Key is not set. Make sure that the Consumer Key & Access Token are set in Theme Setting->Connect & Social->APIs','couponhut'));
			}
		}
	}
}

/**
*  Twitter Feed
*/

if ( !function_exists( 'fw_ssd_twitter_feed' ) ) {
	function fw_ssd_twitter_feed($count = 3, $user = '') { 

		$twitter_key = fw_ssd_get_option('consumer_key');
		$twitter_secret = fw_ssd_get_option('consumer_secret');
		$twitter_token = fw_ssd_get_option('access_token');
		$twitter_token_secret = fw_ssd_get_option('access_token_secret');

		$i = 0;
		$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
		$getfield = '?screen_name=' . $user . '&count=' . $count;
		$requestMethod = 'GET';
		$return = array();

		if ( empty($twitter_key) || empty($twitter_secret) || empty($twitter_token) || empty($twitter_token_secret) ) {
			$settings = array(
				'consumer_key' 				=> '',
				'consumer_secret' 			=> '',
				'oauth_access_token'		=> '',
				'oauth_access_token_secret'	=> ''
			);
		}
		else {
			$settings = array(
				'consumer_key' 				=> fw_ssd_get_option('consumer_key'),
				'consumer_secret' 			=> fw_ssd_get_option('consumer_secret'),
				'oauth_access_token'		=> fw_ssd_get_option('access_token'),
				'oauth_access_token_secret'	=> fw_ssd_get_option('access_token_secret')
			);
		}

		if ( $url === '' || $getfield === '' || $requestMethod === '' ) {
			return;
		}

		$exchanger = new TwitterAPIExchange( $settings );

		if ( is_wp_error( $exchanger ) ) {
			return '';
		}
		
		$tweets = $exchanger->setGetfield( $getfield )
					 ->buildOauth( $url, $requestMethod )
					 ->performRequest(); 
		$tweets = json_decode( $tweets, true );

		if ( empty( $tweets ) ) {
			return $return;
		}

		if (!empty($tweets['errors'])) {
			if ( current_user_can( 'edit_theme_options' ) ) {
				$return = array(
					'error' => esc_html__('Make sure Twitter Consumer Key and Access Token are set.', 'couponhut'));
			}
			return $return;
		}

		foreach( $tweets as $tweet ){
			$tweet_text = !empty( $tweet['text'] ) ? $tweet['text'] : '';
			$tweet_date = !empty( $tweet['created_at'] ) ? fw_ssd_twitter_relative_time( $tweet['created_at'] ) : '';
			
			/*
			 * Replace URLs to working Links
			 */
			$tweet_text = preg_replace( '/\b(?:(http(s?):\/\/)|(?=www\.))(\S+)/is', '<a href="http$2://$3" target="_blank">$1$3</a>', $tweet_text ); 
			/*
			 * match name@address
			 */
			$tweet_text = preg_replace( "/\b([a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]*\@[a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]{2,6})\b/i","<a href=\"mailto://$1\" class=\"twitter-link\">$1</a>", $tweet_text );
			
			/*
			 * Replace username start by @ to working link
			 */
			$tweet_text = preg_replace( '/([\.|\,|\:|\¡|\¿|\>|\{|\(]?)@{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/$2\" class=\"twitter-user\">@$2</a>$3 ", $tweet_text );
			
			/*
			 * Replace hash (#) to search link
			 */
			$tweet_text = preg_replace( '/\s#(\w+)/', ' <a href="//twitter.com/search?q=$1">#$1</a>', $tweet_text );
			
			$return[$i]['tweet'] = $tweet_text;
			$return[$i]['time'] = $tweet_date;
			
			$i++;
		}

		return ( array ) $return;

	}
}


/**
*  Twitter Relative Time
*/

if( !function_exists( 'fw_ssd_twitter_relative_time' ) ) {
	function fw_ssd_twitter_relative_time( $time ) {
		//get current timestamp
		$b = strtotime( "now" ); 
		//get timestamp when tweet created 
		$c = strtotime( $time ); 
		//get difference 
		$d = $b - $c; 
		//calculate different time values 
		$minute = 60; 
		$hour = $minute * 60; 
		$day = $hour * 24; 
		$week = $day * 7; 
		if(is_numeric($d) && $d > 0) { 
			//if less then 3 seconds 
			if( $d < 3 ) return esc_html__( 'right now', 'couponhut' ); 
			//if less then minute 
			if( $d < $minute ) return floor( $d ) . esc_html__( ' seconds ago', 'couponhut' ); 
			//if less then 2 minutes 
			if( $d < $minute * 2 ) return esc_html__( 'about a minute ago', 'couponhut' ); 
			//if less then hour 
			if( $d < $hour ) return floor( $d / $minute ) . esc_html__(' minutes ago', 'couponhut' );
			//if less then 2 hours 
			if( $d < $hour * 2 ) return esc_html__('about an hour ago', 'couponhut' ); 
			//if less then day 
			if( $d < $day ) return floor( $d / $hour ) . esc_html__( ' hours ago','couponhut' ); 
			//if more then day, but less then 2 days 
			if( $d > $day && $d < $day * 2 ) return esc_html__( 'yesterday','couponhut' ); 
			//if less then year 
			if( $d < $day * 365 ) return floor( $d / $day ) . esc_html__( ' days ago', 'couponhut' ); 
			// else return more than a year return "over a year ago"; 
		}
	}
}

/**
*  Save Geolocation Field
*/

if( !function_exists( 'fw_ssd_save_post_geolocation' ) ) {
	function fw_ssd_save_post_geolocation($post_id) {
		$location = couponhut_get_field('location', $post_id);

		if ( !$location ) {
			update_post_meta($post_id, 'geo_city', '');
			update_post_meta($post_id, 'geo_city_slug', '');
			update_post_meta($post_id, 'geo_country', '');
			update_post_meta($post_id, 'geo_country_slug', '');
		} else {
			$geolocation = $location['lat'] . ',' . $location['lng'];
			$request = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' . $geolocation.'&sensor=false&key=' . fw_ssd_get_option('google-api-key'); 
			$file_contents = wp_remote_fopen(trim($request));
			$json_decode = json_decode($file_contents);

			if(isset($json_decode->results[0])) {
				$response = array();
				foreach($json_decode->results[0]->address_components as $addressComponet) {
					if( in_array('political', $addressComponet->types) && 
						in_array('locality', $addressComponet->types) && 
						!in_array('sublocality', $addressComponet->types) && 
						!in_array('ward', $addressComponet->types) && 
						!in_array('neighborhood', $addressComponet->types) ) {
						$response[] = $addressComponet->long_name; 
					} elseif ( in_array('political', $addressComponet->types) ) {
						$response[] = $addressComponet->long_name; 
					}
				}

				if(isset($response[0])){ $first  =  $response[0];  } else { $first  = 'null'; }
				if(isset($response[1])){ $second =  $response[1];  } else { $second = 'null'; } 
				if(isset($response[2])){ $third  =  $response[2];  } else { $third  = 'null'; }
				if(isset($response[3])){ $fourth =  $response[3];  } else { $fourth = 'null'; }
				if(isset($response[4])){ $fifth  =  $response[4];  } else { $fifth  = 'null'; }
				if(isset($response[5])){ $sixth  =  $response[5];  } else { $sixth  = 'null'; }

				if( $first != 'null' && $second != 'null' && $third != 'null' && $fourth != 'null' && $fifth != 'null' && $sixth != 'null' ) {
					$geo_meta['city'] = $second;
					$geo_meta['country'] = $sixth;
				}
				else if ( $first != 'null' && $second != 'null' && $third != 'null' && $fourth != 'null' && $fifth != 'null'  && $sixth == 'null') {
					$geo_meta['city'] = $second;
					$geo_meta['country'] = $fifth;
				}
				else if ( $first != 'null' && $second != 'null' && $third != 'null' && $fourth != 'null' && $fifth == 'null'  && $sixth == 'null') {
					$geo_meta['city'] = $first;
					$geo_meta['country'] = $fourth;
				}
				else if ( $first != 'null' && $second != 'null' && $third != 'null' && $fourth == 'null' && $fifth == 'null' && $sixth == 'null') {
					$geo_meta['city'] = $first;
					$geo_meta['country'] = $third;
				}
				else if ( $first != 'null' && $second != 'null' && $third == 'null' && $fourth == 'null' && $fifth == 'null'  && $sixth == 'null') {
					$geo_meta['city'] = '';
					$geo_meta['country'] = $second;
				}
				else if ( $first != 'null' && $second == 'null' && $third == 'null' && $fourth == 'null' && $fifth == 'null'  && $sixth == 'null') {
					$geo_meta['city'] = '';
					$geo_meta['country'] = $first;
				} else {
					$geo_meta['city'] = $first;
					$geo_meta['country'] = $fifth;
				}
			}

			update_post_meta($post_id, 'geo_city', wp_kses_post($geo_meta['city']));
			update_post_meta($post_id, 'geo_city_slug', sanitize_title($geo_meta['city']));
			update_post_meta($post_id, 'geo_country', wp_kses_post($geo_meta['country']));
			update_post_meta($post_id, 'geo_country_slug', sanitize_title($geo_meta['country']));
		}
		
	}	
}


/**
*  Get All Countries
*/

if( !function_exists( 'fw_ssd_get_all_countries' ) ) {
	function fw_ssd_get_all_countries(){

		$all_countries = array();

		$args = array(
			'post_type' => 'deal',
			'posts_per_page' => -1
			);

		$deals_query = new WP_Query($args);

		if ($deals_query->have_posts()) : while ($deals_query->have_posts()) : $deals_query->the_post();

			$post_country_slug = get_post_meta(get_the_ID(), 'geo_country_slug');

			if ($post_country_slug ) {
				$post_country_slug = $post_country_slug[0];
			}
			$post_country = get_post_meta(get_the_ID(), 'geo_country');
			if ($post_country ) {
				$post_country = $post_country[0];
			}

			if (  $post_country_slug && !in_array($post_country_slug, $all_countries)  ) {
				$all_countries[$post_country_slug]['name'] = $post_country;
				$all_countries[$post_country_slug]['slug'] = $post_country_slug;
			}
		
		endwhile;
		wp_reset_postdata();
		endif;

		return $all_countries;
	}
}

/**
*  Get All Locations
*/
if( !function_exists( 'fw_ssd_get_all_locations' ) ) {
	function fw_ssd_get_all_locations(){

		$all_locations = array();
		$all_countries = fw_ssd_get_all_countries();

		$args = array(
			'post_type' => 'deal',
			'posts_per_page' => -1
			);

		$deals_query = new WP_Query($args);

		if ($deals_query->have_posts()) : while ($deals_query->have_posts()) : $deals_query->the_post();

		$post_country_slug = get_post_meta(get_the_ID(), 'geo_country_slug');
		if ($post_country_slug ) {
			$post_country_slug = $post_country_slug[0];
		}

		$post_city_slug = get_post_meta(get_the_ID(), 'geo_city_slug');


		if ( !empty($post_city_slug) ) {
			$post_city_slug = $post_city_slug[0];
		} else {
			$post_city_slug = '';
		}

		$post_city = get_post_meta(get_the_ID(), 'geo_city');
		if ($post_city ) {
			$post_city = $post_city[0];
		}

		$current_city = array(
			'name' => $post_city,
			'slug' => $post_city_slug,
			);

		if ( $post_country_slug && !isset($all_locations[$post_country_slug]) ) {
			$all_locations[$post_country_slug] = array();
		}

		if (  $post_country_slug && !array_key_exists($post_city_slug, $all_locations[$post_country_slug])  ) {

			$all_locations[$post_country_slug][$post_city_slug] = $current_city;

		}

		if ( !isset($all_locations['all_cities']) ) {
			$all_locations['all_cities'] = array();
		}
		
		if ( $post_city_slug && !array_key_exists($post_city_slug, $all_locations['all_cities'])  ) {

			$all_locations['all_cities'][$post_city_slug] = $current_city;

		}

		endwhile;
		wp_reset_postdata();
		endif;

		return $all_locations;
	}
}



/**
*  Get an attachment ID given a URL.
*/

if( !function_exists( 'fw_ssd_get_attachment_id' ) ) {
	function fw_ssd_get_attachment_id( $url ) {
		$attachment_id = 0;
		$dir = wp_upload_dir();
		if ( false !== strpos( $url, $dir['baseurl'] . '/' ) ) { // Is URL in uploads directory?
			$file = basename( $url );
			$query_args = array(
				'post_type'   => 'attachment',
				'post_status' => 'inherit',
				'fields'      => 'ids',
				'meta_query'  => array(
					array(
						'value'   => $file,
						'compare' => 'LIKE',
						'key'     => '_wp_attachment_metadata',
						),
					)
				);
			$query = new WP_Query( $query_args );
			if ( $query->have_posts() ) {
				foreach ( $query->posts as $post_id ) {
					$meta = wp_get_attachment_metadata( $post_id );
					$original_file       = basename( $meta['file'] );
					$cropped_image_files = wp_list_pluck( $meta['sizes'], 'file' );
					if ( $original_file === $file || in_array( $file, $cropped_image_files ) ) {
						$attachment_id = $post_id;
						break;
					}
				}
				wp_reset_postdata();
			}
		}
		return $attachment_id;
	}
}



/**
 * Checks if the required plugin is active in network or single site.
 *
 * @param $plugin
 *
 * @return bool
 */

if( !function_exists( 'fw_ssd_queryloop_is_active' ) ) {
	function fw_ssd_queryloop_is_active( $plugin ) {
		$network_active = false;
		if ( is_multisite() ) {
			$plugins = get_site_option( 'active_sitewide_plugins' );
			if ( isset( $plugins[$plugin] ) ) {
				$network_active = true;
			}
		}
		return in_array( $plugin, get_option( 'active_plugins' ) ) || $network_active;
	}
}


/**
 * Check if WooCommerce is activated
 */

if( !function_exists( 'fw_ssd_woocommerce' ) ) {
	function fw_ssd_woocommerce() {

		if ( !defined( 'WC_ABSPATH' ) ) {
			return false;
		}

		if ( fw_ssd_queryloop_is_active( 'woocommerce/woocommerce.php' ) || class_exists( 'WooCommerce' ) ) {
			return true;
		} else {
			return false;
		}
	}
}


/**
 * Returns all the orders made by the user
 * @param int $user_id
 * @param string $status (completed|processing|canceled|on-hold etc)
 * @return array of order ids
 */

if( !function_exists( 'fw_ssd_get_all_user_orders' ) ) {
	function fw_ssd_get_all_user_orders($user_id, $status = 'completed') {
	    if(!$user_id) {
	        return false;
	    }
	    $args = array(
	        'numberposts' => -1,
	        'meta_key' => '_customer_user',
	        'meta_value' => $user_id,
	        'post_type' => 'shop_order',
	        'post_status' => array( 'wc-completed' )
	    );
	    $posts = get_posts($args);
	    //get the post ids as order ids
	    return wp_list_pluck($posts, 'ID');
	}
}



/**
*  Upload Front End Image
*/

if( !function_exists( 'fw_ssd_upload_user_file' ) ) {
	function fw_ssd_upload_user_file( $file = array() ) {
		require_once( ABSPATH . 'wp-admin/includes/admin.php' );
	      $file_return = wp_handle_upload( $file, array('test_form' => false ) );
	      if( isset( $file_return['error'] ) || isset( $file_return['upload_error_handler'] ) ) {
	          return false;
	      } else {
	          $filename = $file_return['file'];
	          $attachment = array(
	              'post_mime_type' => $file_return['type'],
	              'post_title' => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
	              'post_content' => '',
	              'post_status' => 'inherit',
	              'guid' => $file_return['url']
	          );
	          $attachment_id = wp_insert_attachment( $attachment, $file_return['url'] );
	          require_once(ABSPATH . 'wp-admin/includes/image.php');
	          $attachment_data = wp_generate_attachment_metadata( $attachment_id, $filename );
	          wp_update_attachment_metadata( $attachment_id, $attachment_data );
	          if( 0 < intval( $attachment_id ) ) {
	          	return $attachment_id;
	          }
	      }
	      return false;
	}
}



/**
*   Display Number of Post Views
*/

if( !function_exists( 'fw_ssd_get_post_views' ) ) {
	function fw_ssd_get_post_views($post_id = 0){
		global $post;
		$post_id = $post -> ID;

		$count_key = 'ssd_post_views_count';
		$count = get_post_meta($post_id, $count_key, true);
		if( $count == '' ){
			delete_post_meta($post_id, $count_key);
			add_post_meta($post_id, $count_key, '0');
			return '0';
		}
		return $count;
	}
}


/**
*   Set Post Views
*/

if( !function_exists( 'fw_ssd_set_post_views' ) ) {
	function fw_ssd_set_post_views($post_id = 0) {
		global $post;
		$post_id = $post -> ID;

		$count_key = 'ssd_post_views_count';
		$count = get_post_meta($post_id, $count_key, true);
		if( $count == '' ){
			$count = 0;
			delete_post_meta($post_id, $count_key);
			add_post_meta($post_id, $count_key, '0');
		} else{
			$count++;
			update_post_meta($post_id, $count_key, $count);
		}
	}
}


/**
*  Get Number of Post Button Clicks
*/

if( !function_exists( 'fw_ssd_get_post_clicks' ) ) {
	function fw_ssd_get_post_clicks($post_id = 0){
		global $post;
		$post_id = $post -> ID;

		$count = get_post_meta($post_id, 'ssd_post_button_clicks_count', true);
		if( $count == '' ){
			delete_post_meta($post_id, 'ssd_post_button_clicks_count');
			add_post_meta($post_id, 'ssd_post_button_clicks_count', '0');
			return '0';
		}
		return $count;
	}
}


/**
*  Redirect Deal on Redeem
*/

if( !function_exists( 'fw_ssd_hande_deal_redirect' ) ) {
	function fw_ssd_hande_deal_redirect($post_id = 0) {

		if ( !$post_id ) {
			global $post;
			$post_id = $post->ID;
		}

		$woocommerce_enable = fw_ssd_get_option('woocommerce-switch');

		$limited_deal = false;

		if ( couponhut_get_field('limited_deal', $post_id) == 'yes' && $woocommerce_enable['woocommerce-picker'] == 'yes' && !empty(couponhut_get_field('woocommerce_price', $post_id)) && couponhut_get_field('show_pricing_fields', $post_id) ) {

			if ( get_post_meta($post_id, 'deals_available', true) < 1 ) {
				die();
			}

			$limited_deal = true;

			$deals_available = !empty(couponhut_get_field('deals_available', $post_id)) ? couponhut_get_field('deals_available', $post_id) : 0;

			$deals_available_before = intval($deals_available);

			$deals_available--;

			$deals_available = $deals_available < 0 ? 0 : $deals_available; // make deals available zero if they are below

			$deal = new WC_CouponHut_Deal_Simple($post_id);

			$deal->set_stock_quantity($deals_available);

			$deal->save();

			update_post_meta($post_id, 'deals_available', $deals_available);
		}

		wp_redirect($_GET['deal_redirect']);	
		die();
	}

}