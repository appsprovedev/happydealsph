<?php
add_action( 'wp_enqueue_scripts', 'ssd_theme_enqueue_styles' );
function ssd_theme_enqueue_styles() {

	wp_enqueue_style( 'child-styles' , get_stylesheet_directory_uri() . '/style.css', array('ssd_master-css'));

}

show_admin_bar( false );


register_sidebar(array(
      'id' => 'footer-menu1',
      'name' => 'Footer Menu 1',
));

register_sidebar(array(
      'id' => 'footer-menu2',
      'name' => 'Footer Menu 2',
));

register_sidebar(array(
      'id' => 'footer-menu3',
      'name' => 'Footer Menu 3',
));

register_sidebar(array(
      'id' => 'favorites-page',
      'name' => 'My-favorites',
));


//Thumbnail Size

add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 400, 470 );

add_image_size( 'product-list-size', 280, 329, true );




// Create Custom Fields
function add_your_fields_meta_box() {
	add_meta_box(
		'your_fields_meta_box', // $id
		'Your Fields', // $title
		'show_your_fields_meta_box', // $callback
		'your_post', // $screen
		'normal', // $context
		'high' // $priority
	);
}
add_action( 'add_meta_boxes', 'add_your_fields_meta_box' );


// Cart

// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php).
// Used in conjunction with https://gist.github.com/DanielSantoro/1d0dc206e242239624eb71b2636ab148
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
 
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	
	ob_start();
	
	?>
	<a class="cart-customlocation" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
	<?php
	
	$fragments['a.cart-customlocation'] = ob_get_clean();
	
	return $fragments;
	
}


// Add Favorites

/**
* Change the Simple Favorites loading indicator
*/
add_filter( 'simplefavorites_spinner_url', 'custom_favorites_loader' );
function custom_favorites_loader($src){
	return get_stylesheet_directory_uri() . '/assets/images/loading-small-purple.gif';
}

add_filter( 'simplefavorites_spinner_url_active', 'custom_favorites_loader_active' );
function custom_favorites_loader_active($src){
	return get_stylesheet_directory_uri() . '/assets/images/loading-small-green.gif';
}


function default_no_quantities( $individually, $product ){
$individually = false;
return $individually;
}

add_filter( 'woocommerce_is_sold_individually', 'default_no_quantities', 10, 2 );


//Voucher custom post type
function voucher_register() {
 
	$labels = array(
		'name'  => _x('Vouchers', 'post type general name'),
		'singular_name'  => _x('Voucher', 'post type singular name'),
		'add_new'  => _x('Add New', 'voucher'),
		'add_new_item'  => __('Add New voucher'),
		'edit_item'  => __('Edit voucher'),
		'new_item'  => __('New voucher'),
		'view_item'  => __('View voucher'),
		'search_items'  => __('Search'),
		'not_found'  =>  __('Nothing found'),
		'not_found_in_trash'  => __('Nothing found in Trash'),
		'parent_item_colon'  => ''
	);
 
	$args = array(
		'labels'  => $labels,
		'public'  => true,
		'publicly_queryable'  => true,
		'show_ui'  => true,
		'query_var'  => true,
		'menu_icon'  => 'dashicons-products',
		'rewrite'  => true,
		'capability_type'  => 'post',
		'hierarchical'  => false,
		'menu_position'  => null,
		'supports'  => array('title','editor','thumbnail'),
                'exclude_from_search' => true

	  ); 
 
	register_post_type( 'voucher' , $args );
}


add_action('init', 'voucher_register');


add_action("admin_init", "admin_init");
 
function admin_init(){
  add_meta_box("voucher_details", "Voucher Details", "voucher_details", "voucher", "side", "low");
}
 
function voucher_details(){
  global $post;
  $voucher_status_options = array('active' => 'Active', 'redeemed' => 'Redeemed', 'expired' => 'Expired');
  
  $custom = get_post_custom($post->ID);
  
  
  $voucher_code = $custom["voucher_code"][0];
  $expiration_date = $custom["expiration_date"][0];
  $voucher_status = $custom["voucher_status"][0];
  $deal_id = $custom["deal_id"][0];
  $order_id = $custom["order_id"][0];
  $redeemed_date = $custom["redeemed_date"][0];
  
  ?>
  <div>
          <label>Voucher Code:</label><br/>
          <input name="voucher_code" value="<?php echo $voucher_code; ?>" style="width:100%"  />
  </div>
  <div>
          <label>Expiration Date:</label><br/>
          <input type="text" name="expiration_date" value="<?php echo $expiration_date; ?>" style="width:100%" />
  </div>
  <div>
          <label>Deal ID: </label><br/>
          <input type="text" name="deal_id" value="<?php echo $deal_id; ?>" style="width:100%" />
  </div>
   <div>
          <label>Order ID: </label><br/>
          <input type="text" name="order_id" value="<?php echo $order_id; ?>" style="width:100%" />
  </div>
  
    <div>
          <label>Status : </label><br/>
          <select name="voucher_status">
                <?php foreach ($voucher_status_options as $voucher_option_key => $voucher_option) { ?>            
                        <?php 
                        $selected = '';
                        if ($voucher_status == $voucher_option_key) { 
                            $selected = ' selected="selected" ';
                        } ?>
                        <option value="<?php echo $voucher_option_key; ?>"  <?php echo $selected; ?>><?php echo $voucher_option; ?></option>
                <?php } ?>
          </select>
          
  </div>
    <?php if ($voucher_status == 'redeemed') { ?>
   <div>
          <label>Redeemed Date:</label><br/>
          <input type="text" name="redeemed_date" value="<?php echo $redeemed_date; ?>" style="width:100%" />
  </div>
  <?php } ?>
  
  <div>
        <label>Quick Response Code</label>
        <?php echo do_shortcode('[qrcode content="'.$voucher_code.'" size="120" alt="'.$voucher_code.'" class="qr_code"]'); ?>
  </div>
  <?php 
}

add_action('save_post', 'save_voucher_details');

function save_voucher_details(){
  global $post;
  update_post_meta($post->ID, "voucher_code", $_POST["voucher_code"]);
  update_post_meta($post->ID, "expiration_date", $_POST["expiration_date"]);
  update_post_meta($post->ID, "voucher_status", $_POST["voucher_status"]);
  update_post_meta($post->ID, "redeemed_date", $_POST["redeemed_date"]);
}

add_action("manage_posts_custom_column",  "voucher_custom_columns");
add_filter("manage_edit-voucher_columns", "voucher_edit_columns");
 
function voucher_edit_columns($columns){
  $columns = array(
    "cb" => "<input type='checkbox' />",
    "title" => "Title",
    "description" => "Description",
    "voucher_code" => "Voucher Code",
    "voucher_status" => "Status",
    "expiration_date" => "Expiration Date",
  );
 
  return $columns;
}
function voucher_custom_columns($column){
  global $post;
 
  switch ($column) {
    case "description":
      the_excerpt();
      break;
    case "voucher_code":
      $custom = get_post_custom();
      echo $custom["voucher_code"][0];
      break;
     case "voucher_status":
      $custom = get_post_custom();
      echo $custom["voucher_status"][0];
      break;
    case "expiration_date":
      $custom = get_post_custom();
      echo $custom["expiration_date"][0];
      break;
  }
}

/* GENERATE RANDOM STRINGS */

function generateRandomString() {
    $length = 10;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    
        $args = array(
        	'post_type'	=> 'voucher',
        	'meta_query' => array(
                 array(
                    'key'     => 'voucher_code',
        	    'value'   =>  $randomString,
                )
            )
        );
        // Query the posts
        $voucher_posts = query_posts( $args );

        
        if (count($voucher_posts) > 0 ) {
             generateRandomString();  
        }
        
    $randomString =  strtoupper($randomString);
    
    return $randomString;
}




/* payment complete */
add_action( 'woocommerce_order_status_completed', 'so_payment_complete' );
function so_payment_complete( $order_id ){
    $order = wc_get_order( $order_id );
    $user = $order->get_user();
    
    //get items 
    $order_items = $order->get_items();     
   
  
    foreach ($order_items as $item_id => $item) {
             //AUTO INSERT VOUCHER CODE
             //GET DEAL INFO
             $expiration_date = '';
             $deal_id = $item->get_meta('deal_id');
             $expiration_date =  get_post_meta($deal_id, 'expiring_date',true);
             if ($expiration_date != '') {
                $expiration_date  = date('m/d/Y', strtotime($expiration_date)) ;
             }
             
             $order_id = $item['order_id']; 
             $qty  =  $item['qty'];
             $status  =  'active';
             
             // Prepare title
             $n = 1;
             while ($n++ <= $qty ) {
                    $voucher_code= 'HD'. generateRandomString();
                    $title = 'VOUCHER-'. $voucher_code;
              
                    // Gather post data
                    $post = array(
                        'post_title' => $title,
                        'post_content' => '/*AUTO GENERATED VOUCHER CODE*/ '. "\n" . $item['name'],
                        'post_status' => 'publish', 
                        'post_type' => 'voucher',
                        'post_author' => 1
                    );
                
                    // Attempt to add post
                    if($id = wp_insert_post($post)) {
                        // Add metadata to post
                        update_post_meta($id, 'voucher_code', $voucher_code);
                        update_post_meta($id, 'expiration_date', $expiration_date);
                        update_post_meta($id, 'deal_id', $deal_id);
                        update_post_meta($id, 'order_id', $order_id);
                        update_post_meta($id, 'voucher_status', 'active');
                    
                    }
            
            }
    
    }
           
}

function get_voucher_codes($order_id, $deal_id) {
         $args = array(
        	'post_type'	=> 'voucher',
        	'meta_query' => array(
                        
                 array(
                    'key'     => 'order_id',
        	    'value'   =>  $order_id,
                 ),
                 array(
                    'key'     => 'deal_id',
        	    'value'   =>  $deal_id,
                 )
                 
            )
        );
        // Query the posts
        $voucher_posts = get_posts( $args );
        $return = array();
        
        if (count($voucher_posts) > 0 ) {
                foreach ($voucher_posts as $voucher_post) {
                        
                        $voucher_r = get_post_meta($voucher_post->ID);
                        $voucher_r['id'] = array($voucher_post->ID);
                        $return[] = $voucher_r;
                }
        }
        
        
        return $return;
       
}


//API get voucher details

function restGetVoucherDetails( $data ) {      
	
        if (!empty($data['voucher_code'])) {
            $voucher_code = $data['voucher_code'];   
        
        }  else {
                return null;
        }
        
         $args = array(
        	'post_type'	=> 'voucher',
        	'meta_query' => array(
                 array(
                    'key'     => 'voucher_code',
        	    'value'   => $voucher_code,
                ),
               /*  array(
                    'key'     => 'voucher_status',
        	    'value'   => 'new',
                ) */
            )
        );
       
        $voucher_post = query_posts( $args );
        
        if (!empty($voucher_post)) {
                $voucher_id = $voucher_post[0]->ID;
                 //Update voucher status to redeemed and add redeemed date
                update_post_meta($voucher_id, 'voucher_status', 'redeemed');
                update_post_meta($voucher_id, 'redeemed_date', date('Y-m-d h:i:s A'));
                        
                $voucher_meta_fields = get_post_meta($voucher_post[0]->ID);
                $order_id = $voucher_meta_fields['order_id'][0]; 
                $deal_id = $voucher_meta_fields['deal_id'][0];
                //get deal
                $deal_r = get_post( $deal_id ); 
                //deal details
                $deal_price =  get_post_meta($deal_id, 'new_price', true);
                $order_r = wc_get_order( $order_id );
                $purchase_date = $order_r->order_date;
                //seller info
                
                $company = get_the_terms( $deal_id, 'deal_company' );
                $seller_id = '';
                $seller_name = '';
                if ($company) {
                        $seller_id =  $company[0]->term_id; 
                        $seller_name =  $company[0]->name; 
                }
                
                //customer_details
                $customer_id =  $order_r->get_user_id();
                $user_info = get_userdata($customer_id);
                $email_to = $user_info->user_email;
                $username = $user_info->display_name;
                $email_to = 'okjd12@yahoo.com';
                
                $email_info = array(
                  'email_to' => $email_to,
                  'user_id' =>  $customer_id,
                  'username' =>  $username,
                  'voucher_code' =>  $data['voucher_code'],
                  'voucher_id' => $voucher_id,
                  'pid' => $deal_id,
                  'deal_title' => $deal_r->post_title
                );
                
                //check if customer already made a review 
                  $comment_count = getCommentbyUserIDandPostId($deal_id, $customer_id);
                //send email
                sendRedeemedEmail($email_info);
               
                
                
                $return = array (
                        'deal_id' => $deal_id,
                        'deal_title' => $deal_r->post_title,
                        'deal_price' => $deal_price,
                        'purchase_date' => $purchase_date,
                        'buyers_last_name' => $order_r->billing_last_name,
                        'buyers_first_name' => $order_r->billing_first_name,
                        'seller_id' => $seller_id,
                        'seller_name' =>  $seller_name
                );
                
                return $return;
                
               
                
        }
        

       
        
}

function sendRedeemedEmail($email_info) {
        //$headers = 'From: HappyDealsPH <no-reply@happydealsph.com>' . "\r\n";

	// Deal Information
	$title = $email_info['deal_title'];
        $voucher = $email_info['voucher_code'];
        $pid =  $email_info['pid'];    
        $url = site_url( '/review/?email='. $email_to .'&pid='.$pid);   
        
        // load the mailer class
        $mailer = WC()->mailer();
         
        //format the email
        $recipient =  $email_info['email_to'];
        $subject =  __( 'Voucher Successfully Redeemed', 'couponhut' );
        $template = 'emails/email-voucher-redemption.php';
        $content = get_custom_email_html( $email_info, '', $mailer, $template );
        $headers = "Content-Type: text/html\r\n";
         
        //send the email through wordpress
        $mailer->send( $recipient, $subject, $content, $headers );
}

function get_custom_email_html( $email_info, $heading = false, $mailer, $template ) {
 

 
    return wc_get_template_html( $template, array(
        'email_info'         => $email_info,
        'email_heading' => $heading,
        'sent_to_admin' => false,
        'plain_text'    => false,
        'email'         => $mailer
    ) );
 
}
 


function getCommentbyUserIDandPostId($post_id, $author_id) {
     $args = array(
        'date_query' => array(
                                                        'after' => '3 weeks ago',
                                                        'before' => 'tomorrow',
                                                        'inclusive' => true,
                                        ), 
	'post_id' => $post_id,
        'author__in' => $author_id
        );
        
        $comments = get_comments($args);
        
        return $comments;

}

//http://happydeals/wp-json/happydeals/v2/voucher/HD5MCW7ZHD7I
add_action( 'rest_api_init', function () {
	register_rest_route( 'happydeals/v2', '/voucher/(?P<voucher_code>[a-zA-Z0-9-]+)', array(
		'methods' => 'GET',
		'callback' => 'restGetVoucherDetails',
	) );
} );

//http://happydeals/wp-json/happydeals/v2/merchants
add_action( 'rest_api_init', function () {
	register_rest_route( 'happydeals/v2', '/merchants/', array(
		'methods' => 'GET',
		'callback' => 'restGetMerchants',
	) );
} );

function restGetMerchants() {      

$merchants = get_terms( 'deal_company', array(
    'orderby'    => 'count',
    'hide_empty' => 0
) );

$return = array();

if (!empty($merchants)) {

        foreach ($merchants as $merchant) {
                $return[] = array('merchant_id' => $merchant->term_id, 'merchant_name' => $merchant->name);      
        }
                
}

return $return;
  
}

/* GET ALL MERCHANT DEALS/VOUCHERS */

function restGetMerchantVouchers( $data ) {      
	        
        if (!empty($data['merchant_id'])) {
            $merchant_id = $data['merchant_id'];   
        
        }  else {
                return null;
        }
        
        $args = array(
        	'post_type'	=> 'deal',
                 'numberposts' => -1,
        	'tax_query' => array(
                 array(
                    'taxonomy'     => 'deal_company',
        	    'terms'   =>  $merchant_id,
                )
            )
        );
        // Query the posts
        $deals = get_posts( $args );

        
        if (count($deals) > 0 ) {
            foreach ($deals as $deal) {
                $meta_query = array();
                $deal_id =  $deal->ID;   
                $meta_query[] =  array(
                                    'key'     => 'deal_id',
                        	    'value'   =>  $deal_id,
                                 );
                //redeemed date
                if ($data['redeemed_date_from'] != 'null') {
                      $redeemed_date_from = $data['redeemed_date_from'];
                      $meta_query[] = array('key' => 'redeemed_date',
                                          'value' => $redeemed_date_from,
                                          'compare' => '>=',
                                          'type' => 'DATE');
                 }              
                 
                 if ($data['redeemed_date_to'] != 'null') {
                      $redeemed_date_to = $data['redeemed_date_to'];
                      $meta_query[] = array('key' => 'redeemed_date',
                                          'value' => $redeemed_date_to,
                                          'compare' => '<=',
                                          'type' => 'DATE');
                 }  
            
                //get vouchers
                // print_r($meta_query);
                
                 $args =  array(
                        	'post_type'	=> 'voucher',
                        	'meta_query' => $meta_query
                 );
                 
               
                 // Query the posts
                 $voucher_posts = query_posts( $args );
                 
                 
                 if (count($voucher_posts) > 0) {
                      foreach ($voucher_posts as $voucher_post) {
                                $voucher_meta_fields = get_post_meta($voucher_post->ID); 
                               
                                $voucher_code = $voucher_meta_fields['voucher_code'][0]; 
                                $order_id = $voucher_meta_fields['order_id'][0]; 
                                $deal_id = $voucher_meta_fields['deal_id'][0];
                                //get deal
                                $deal_r = get_post( $deal_id ); 
                                //deal details
                                $deal_price =  get_post_meta($deal_id, 'new_price', true);
                                $order_r = wc_get_order( $order_id );
                                $purchase_date = $order_r->order_date;
                                $redeemed_date = $voucher_meta_fields['redeemed_date'][0];
                                $voucher_status =  $voucher_meta_fields['voucher_status'][0];
                                //seller info
                                
                                $company = get_the_terms( $deal_id, 'deal_company' );
                                $seller_id = '';
                                $seller_name = '';
                                if ($company) {
                                        $seller_id =  $company[0]->term_id; 
                                        $seller_name =  $company[0]->name; 
                                }
                                
                                 $purchased_date_from_q = true;
                                 $purchased_date_to_q = true;
                                   
                                //purchase date    
                                //reformat purchase date 
                                 $puchase_date_o = new DateTime($purchase_date);

                                 $purchase_date_f = $puchase_date_o->format('Y-m-d');
        
                                 if ($data['purchased_date_from'] != 'null') {
                                     $purchased_date_from_q = false;       
                                                                    
                                     $purchased_date_from = $data['purchased_date_from']; 
                                     if(strtotime($purchase_date_f) >= strtotime($purchased_date_from)) {
                                        $purchased_date_from_q = true;
                                     }
                                 }
                                 
                                  if ($data['purchased_date_to'] != 'null') {
                                     $purchased_date_to_q = false;                     
                                     $purchased_date_to = $data['purchased_date_to']; 
                                     if(strtotime($purchase_date_f) <= strtotime($purchased_date_to)) {
                                        $purchased_date_to_q = true;
                                     }
                                 }
                                if ($purchased_date_from_q && $purchased_date_to_q) {
                                        $voucher_details = array (
                                                'deal_id' => $deal_id,
                                                'deal_title' => $deal_r->post_title,
                                                'deal_price' => $deal_price,
                                                'voucher_code' => $voucher_code,
                                                'purchase_date' => $purchase_date,
                                                'redeemed_date' => $redeemed_date,
                                                'status' => $voucher_status, 
                                                'buyers_last_name' => $order_r->billing_last_name,
                                                'buyers_first_name' => $order_r->billing_first_name,
                                                'seller_id' => $seller_id,
                                                'seller_name' =>  $seller_name
                                        );
                                        
                                        $return[] = $voucher_details;                                                                                 
                                        
                                }
                                                        
                              
                      
                     
                      }
                      
                       return $return;
                 }
            
            } 
        } else {
                return null;
        }
        
        
        
        
}
//http://dev.happydeals.ph/wp-json/happydeals/v2/getvouchersbymerchant/merchant_id=40/redeemed_date_from=2017-06-18/redeemed_date_to=2017-06-21/purchased_date_from=2017-06-14/purchased_date_to=2017-06-16
add_action( 'rest_api_init', function () {
	register_rest_route( 'happydeals/v2', '/getvouchersbymerchant/merchant_id=(?P<merchant_id>[a-zA-Z0-9-]+)/redeemed_date_from=(?P<redeemed_date_from>[a-zA-Z0-9-]+)/redeemed_date_to=(?P<redeemed_date_to>[a-zA-Z0-9-]+)/purchased_date_from=(?P<purchased_date_from>[a-zA-Z0-9-]+)/purchased_date_to=(?P<purchased_date_to>[a-zA-Z0-9-]+)', array(
		'methods' => 'GET',
		'callback' => 'restGetMerchantVouchers',
                
	) ); 
        
       /* register_rest_route( 'happydeals/v2', '/getvouchersbymerchant/(?P<merchant_id>[a-zA-Z0-9-]+)', array(
		'methods' => 'GET',
		'callback' => 'restGetMerchantVouchers',
                
	) );  */
        
} );
 
 
  
 //Enqueue Ajax Scripts
function enqueue_cart_qty_ajax() {

    wp_register_script( 'cart-qty-ajax-js', get_stylesheet_directory_uri() . '/js/cart-qty-ajax.js', array( 'jquery' ), '', true );
    wp_localize_script( 'cart-qty-ajax-js', 'cart_qty_ajax', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
    wp_enqueue_script( 'cart-qty-ajax-js' );

}
add_action('wp_enqueue_scripts', 'enqueue_cart_qty_ajax');

function ajax_qty_cart() {

    // Set item key as the hash found in input.qty's name
    $cart_item_key = $_POST['hash'];

    // Get the array of values owned by the product we're updating
    $threeball_product_values = WC()->cart->get_cart_item( $cart_item_key );

    // Get the quantity of the item in the cart
    $threeball_product_quantity = apply_filters( 'woocommerce_stock_amount_cart_item', apply_filters( 'woocommerce_stock_amount', preg_replace( "/[^0-9\.]/", '', filter_var($_POST['quantity'], FILTER_SANITIZE_NUMBER_INT)) ), $cart_item_key );

    // Update cart validation
    $passed_validation  = apply_filters( 'woocommerce_update_cart_validation', true, $cart_item_key, $threeball_product_values, $threeball_product_quantity );

    // Update the quantity of the item in the cart
    if ( $passed_validation ) {
        WC()->cart->set_quantity( $cart_item_key, $threeball_product_quantity, true );
    }

    // Refresh the page          
    
    echo $amount = "Subtotal: " . WC()->cart->get_cart_total();


    die();

}

add_action('wp_ajax_qty_cart', 'ajax_qty_cart');
add_action('wp_ajax_nopriv_qty_cart', 'ajax_qty_cart');

function ajax_remove_product_cart() {
     global $woocommerce;
     
     $cart_item_key = $_POST['hash'];

     WC()->cart->set_quantity( $cart_item_key, 0, true );
     
     
     //listing products in the cart    
     	if ( is_object($woocommerce->cart ) ) {
	       $cartItems = $woocommerce->cart->get_cart();
        }         
        
        	$cartItems = $woocommerce->cart->get_cart();

		//array holding the data that will be attached to fragments
		$arrayForFragments = array();

		//generic information about the cart
		$arrayForFragments["cartTotal"] = $woocommerce->cart->get_cart_total();
		$arrayForFragments["cartUrl"] = $woocommerce->cart->get_cart_url();
		$arrayForFragments["checkoutUrl"] = $woocommerce->cart->get_checkout_url();
		$arrayForFragments["shopUrl"] = get_permalink( woocommerce_get_page_id( 'shop' ) );
		$arrayForFragments["currencySymbol"] = get_woocommerce_currency_symbol();
		$arrayForFragments["itemsCount"] = WC()->cart->get_cart_contents_count();

		//building data set for products in the cart
		$arrayForFragmentsProducts = array();
             
		foreach($cartItems as $cartItemkey => $cartItem  )
		{

			//getting data from the Post of this Woo Product
			$cartItemProduct = $cartItem['data']->post;

			//storing only the informations we need
			$productToAddToCart = array();
			$productToAddToCart["productTitle"] = $cartItemProduct->post_title;
			$productToAddToCart["quantity"] = $cartItem['quantity'];
			$productToAddToCart["price"] = wc_price( $cartItem['data']->price );
			$productToAddToCart["deleteItemUtl"] = $woocommerce->cart->get_remove_url( $cartItemkey );    
                        $productToAddToCart["cart_item_key"] = $cartItemkey;  
                        $productToAddToCart["stock_quantity"] = $cartItem['stock_quantity'];  
                                                                      
                        //getting product image
			$productObject = wc_get_product( $cartItemProduct->ID );
			$productToAddToCart["image"] = $productObject->get_image( 32 );

			//storing this product in the array of products
			array_push( $arrayForFragmentsProducts, $productToAddToCart );

		}

		//pushing the products in the array of data
		$cartdata["products"] = $arrayForFragmentsProducts;
       
        if ( count( $cartdata["products"] ) > 0 ) {                         
                foreach($cartdata["products"] as $Item )
                {
                        $cart_item_key = $Item['cart_item_key'];
                        $product_quantity = woocommerce_quantity_input( array(
        										'input_name'  => "cart[{$cart_item_key}][qty]",
        										'input_value' =>  $Item['quantity'],
        										'max_value'   =>  $Item['stock_quantity'],
        										'min_value'   => '0',
        									),  $Item , false );                                
                       
                        $result .= "<tr>";
                        $result .= "<td><a href='#' class='remove_product' rel='".$cart_item_key."'> <img style=\"width:10px;\" src='" . bw_woofc_globals_plugin_url .  "\images\icon-delete-1.png'> </a>&nbsp;".$Item["productTitle"]."</td>";
                        $result .=  "<td class='wc_quantity'>" . apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $Item ) . "</td>";
                        $result .= "<td>" . $Item["price"] . "</td>";
                        $result .= "</tr>";
        
                }
        } else {
            $result .= "<tr><td colspan='3' style='height: 200px;'>Your shopping cart is empty</td></tr>";
        }
        
        echo $result;

    die();

}

add_action('wp_ajax_remove_product_cart', 'ajax_remove_product_cart');
add_action('wp_ajax_nopriv_remove_product_cart', 'ajax_remove_product_cart');


function ajax_update_subtotal_cart() {
        echo $amount = "Subtotal: " . WC()->cart->get_cart_total();
        die();
}

add_action('wp_ajax_update_subtotal_cart', 'ajax_update_subtotal_cart');
add_action('wp_ajax_nopriv_update_subtotal_cart', 'ajax_update_subtotal_cart');

/* DISPLAY FAVORITES */

function ajax_update_favorites_container() {
        $favorites =  wpfp_get_user_meta();
  
        
        if (count($favorites) > 0 ) {
                 $favorites_content .= '<ul class="my-favorites">';
                     foreach ($favorites as $favorite) {
                        $favorite_post =  get_post($favorite);
                        if ( get_post_type($favorite_post->ID) == 'deal' ) {
                              	if ( couponhut_get_field('image', $favorite_post->ID) ) {
			 	   $image = couponhut_get_field('image', $favorite_post->ID);
			 	} 
                                
                          $companies = get_the_terms( $favorite_post->ID, 'deal_company' );
                         //end deal post type
                         $favorites_content .= '<li class="deal-item">';
                                if( isset($image) ) {
                                         $favorites_content .= '<div class="row"><div class="col-md-9"><div class="pull-left">
                                        <img style="height: 50px; margin-right: 10px;" src="' . esc_url( $image['sizes']['ssd_deal-thumb'] ) .'" alt="' . esc_attr( $image['alt'] ) . '">
                                        </div>';
                                }   
                                $favorites_content .='<h2>'. $companies[0]->name .'</h2>';
                                $favorites_content .='<h3><a href="' . get_permalink($favorite_post->ID) . '">' . $favorite_post->post_title . '</a></h3>'; 
                                $favorites_content .='</div>';
                                $favorites_content .='<div class="col-md-3"><div class="favorite_action"><a class="remove-fav-link" href="?wpfpaction=remove&postid='.$favorite_post->ID.'">Remove</a><!--<a href="#" class="action_undo">Undo</a>--></div></div>';
                                $favorites_content .='</div>';
                        
                        $favorites_content .= '</li>';
                        }
                     }
                $favorites_content .= '</ul>';
        } else {
            $favorites_content .= '<p><strong>No Favorites</strong></p>';      
        }


     echo  $favorites_content;
     
     die();
}

add_action('wp_ajax_update_favorites_container', 'ajax_update_favorites_container');
add_action('wp_ajax_nopriv_update_favorites_container', 'ajax_update_favorites_container');



 

function wc_limit_account_menu_items() {
// Administrator and Shop Manager roles
//	if ( current_user_can( 'manage_woocommerce' ) ) {
		$items = array(
			'orders'		=> __( 'Purchases', 'woocommerce' ),
                        'my-reviews'               => __( 'Reviews', 'happydeals' ),
                        'my-favorites'          => __( 'Favorites', 'happydeals' ),
		 	'rewards'	=> __( 'Rewards', 'happydeals' ),
			'edit-account'		=> __( 'Account Settings', 'woocommerce' ),
		
		);
//	}

	return $items;
 }
 
add_filter( 'woocommerce_account_menu_items', 'wc_limit_account_menu_items' );


function happydeals_add_my_account_endpoint() {
 
    add_rewrite_endpoint( 'my-favorites', EP_PAGES ); 
 
}
 
add_action( 'init', 'happydeals_add_my_account_endpoint' );

function happydeals_add_my_account_endpoint_content() {  
      $favorites =  wpfp_get_user_meta();
      $favorites_content = '<h2 class="my-account-ptitle">Your Favorites</h2>';
      $favorites_content .= '<div class="row"><div class="col-md-12 nopadding" id="myfavorites_container">';
        
       
      $favorites_content .= '</div></div>';
     
     echo  $favorites_content;
}
 
add_action( 'woocommerce_account_my-favorites_endpoint', 'happydeals_add_my_account_endpoint_content' );

/* ADD REVIEWS PAGE */
function happydeals_add_my_account_reviews_endpoint() {
 
    add_rewrite_endpoint( 'my-reviews', EP_PAGES );
 
}
 
add_action( 'init', 'happydeals_add_my_account_reviews_endpoint' );

function happydeals_add_my_account_reviews_endpoint_content() {
     $reviews = get_reviews_by_user();
     
     $reviews_content = '<h2 class="my-account-ptitle">Reviews</h2>';
     
      $reviews_content .= '<div class="row"><div class="col-md-12 nopadding">';
        
        if (count($reviews) > 0 ) {
                 $reviews_content .= '<ul class="my-reviews">';
                     foreach ($reviews as $review) {
                        $review_post =  get_post($review['review_post']);
                        $reviewer_rating = $review['stars'];
                        $rating_width = $reviewer_rating * 20;
                        $post_time =  get_post_time('U', false, $review['id']);
                        if ( get_post_type($review_post->ID == 'deal' )) {
                              	if ( couponhut_get_field('image', $review_post->ID) ) {
			 	   $image = couponhut_get_field('image', $review_post->ID);
			 	} 
                                
                          $companies = get_the_terms( $review_post->ID, 'deal_company' );
                         //end deal post type
                          $reviews_content .= '<li class="deal-item">';
                                if( isset($image) ) {
                                         $reviews_content .= '<div class="row"><div class="col-md-9"><div class="pull-left">
                                        <img style="height: 50px; margin-right: 10px;" src="' . esc_url( $image['sizes']['ssd_deal-thumb'] ) .'" alt="' . esc_attr( $image['alt'] ) . '">
                                        </div>';
                                }   
                                $reviews_content .='<h2>'. $companies[0]->name .'</h2>';
                                $reviews_content .='<h3><a href="' . get_permalink($review_post->ID) . '">' . $review_post->post_title . '</a></h3>'; 
                                $reviews_content .='</div>';
                                $reviews_content .='<div class="col-md-3">'.human_time_diff( $post_time, current_time('timestamp') ) . ' ago</div>';
                                $reviews_content .='<div class="col-md-12"><h4>"'.$review['title'].'"</h4>';
                                $reviews_content .='<div class="wpcr3_rating_stars" style="position: relative;">
                                                                                <div class="wpcr3_rating_style1">
                                                                                        <div class="wpcr3_rating_style1_base">
                                                                                        <div class="wpcr3_rating_style1_average" style="width:'.$rating_width .'%;"></div>
                                                                                        </div>
                                                                                </div>
                                                                        </div>';
                                
                                $reviews_content .='<p>'.$review['content'].'</p>';
                                $reviews_content .='</div>';
                                $reviews_content .='</div>';
                        
                        $reviews_content .= '</li>';
                        }
                     }
                $reviews_content .= '</ul>';
        } else {
            $reviews_content .= '<p><strong>No Reviews</strong></p>';      
        }

      
      $reviews_content .= '</div></div>';
      
      echo $reviews_content;


}


function get_reviews_by_user($user_id=false) {
       
      
        if ($user_id) {
             get_userdata( $user_id );
        } else {
            global $current_user;
            get_currentuserinfo();
            $user_id = $current_user->ID;   
        }
        
        
        $queryOpts = array(
			'orderby' => 'date',
			'order' => 'DESC',
			'showposts' => 100,
			'post_type' => 'wpcr3_review',
			'post_status' => 'publish',
                        'author'        =>  $user_id
   	);
        
        $reviews = new WP_Query($queryOpts); 
        
       	foreach ($reviews->posts as $post) {
           
           $meta = get_post_custom($post->ID);
           $review['id'] = $post->ID;
           $review['stars'] = $meta['wpcr3_review_rating'][0];
           $review['title'] = $meta['wpcr3_review_title'][0];
           $review['content'] = $post->post_content;
           $review['review_post'] = $meta['wpcr3_review_post'][0];
	   $post_date = explode(" ",$post->post_date);		
	   $review['post_date'] = $post_date[0];
	   $review['post_date'] = date("M j, Y", strtotime($out['post_date']));
           $reviews_r[] = $review;
        }
        
        return $reviews_r;
        
}
 
add_action( 'woocommerce_account_my-reviews_endpoint', 'happydeals_add_my_account_reviews_endpoint_content' );



/* ADD REWARDS PAGE */
function happydeals_add_my_account_rewards_endpoint() {
 
    add_rewrite_endpoint( 'rewards', EP_PAGES );
 
}
 
add_action( 'init', 'happydeals_add_my_account_rewards_endpoint' );

function happydeals_add_my_account_rewards_endpoint_content() {
     global $current_user;
     get_currentuserinfo();
     
     $rewards = phoen_rewpts_user_reward_point();
     $code = phoen_rewpts_account_page_show_code();
     $user_city = $current_user->billing_city;  
     $user_country = WC()->countries->countries[ $current_user->billing_country ];

     
     
     
     $rewards_content = '<h2 class="my-account-ptitle">Rewards</h2>';
      
     $rewards_content .= '<div class="row"><div class="col-md-12 nopadding" style="padding-top: 50px;">';  
     
     $rewards_content .= '<div class="col-md-7"><div class="pull-left"><span class="author-avatar"><img style="height: 67px; border-radius: 50%; margin-right: 10px;"src="'.esc_url( get_avatar_url( $current_user->ID ) ) .'"></span></div><div style="padding-top: 10px;"><span><strong>'. $current_user->user_firstname .'</strong></span><br/>'.$user_city.' '. $user_country .'</div></div>';
     $rewards_content .= '<div class="col-md-5"><div class="rewards_pts" style="font-size: 30px;"><span class="points" style="font-size:90px; color: #FD8A3B;"><strong>'. $rewards .'</strong></span>pts<p style="font-size: 18px;font-weight: normal; padding: 10px;">Your available points</p></div></div>';   
                            
     $rewards_content .= '</div></div>';    
     
     $rewards_content .= '<div class="row" style="border-top: 1px solid #C4C4C4; border-bottom: 1px solid #C4C4C4;"><div class="col-md-12 nopadding" style="padding: 50px 0;">';  
     
     $rewards_content .= '<div class="col-md-6" style="font-size: 16px;"><p style="margin-bottom: 5px;"><strong>How to earn points</strong></p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin dictum sollicitudin justo ac gravida. Integer tincidunt, eros condimentum</p></div>';
     $rewards_content .= '<div class="col-md-6" style="text-align: center; font-size: 18px;"><span>Share your invite code</span><div style="border: 1px solid; width: 219px; font-size: 20px; padding: 15px; margin: 10px auto;">'.$code.'</div><button style="text-transform: uppercase; color: #fff; padding: 0px 30px; line-height: 1em; height: 36px !important; background-color: #FDAA3B;">Send Invites</button></div>';   
                            
     $rewards_content .= '</div></div>';     
     
     echo $rewards_content;
}
 
add_action( 'woocommerce_account_rewards_endpoint', 'happydeals_add_my_account_rewards_endpoint_content' );

add_filter('woocommerce_login_redirect', 'wc_login_redirect', 9);


function wc_login_redirect() {
      global $current_user;  
     if (isset($_GET['redirect_to'])) {
             $redirect_to = $_GET['redirect_to'];
             return $redirect_to;
     }  else {
       
        if ($current_user) {
        $redirect_to = home_url();
        return $redirect_to;
        }
     }          
     
     
}


add_action( 'woocommerce_register_form_start', 'happydeals_add_name_woo_account_registration' );
 
function happydeals_add_name_woo_account_registration() {
    ?>
 
    <p class="form-row form-row-first">
    <label for="reg_billing_first_name"><?php _e( 'First name', 'woocommerce' ); ?> <span class="required">*</span></label>
    <input type="text" class="input-text" name="billing_first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>" />
    </p>
 
    <p class="form-row form-row-last">
    <label for="reg_billing_last_name"><?php _e( 'Last name', 'woocommerce' ); ?> <span class="required">*</span></label>
    <input type="text" class="input-text" name="billing_last_name" id="reg_billing_last_name" value="<?php if ( ! empty( $_POST['billing_last_name'] ) ) esc_attr_e( $_POST['billing_last_name'] ); ?>" />
    </p>
 
    <div class="clear"></div>
 
    <?php
}


add_filter( 'woocommerce_registration_errors', 'happydeals_validate_name_fields', 10, 3 );
 
function happydeals_validate_name_fields( $errors, $username, $email ) {
    if ( isset( $_POST['billing_first_name'] ) && empty( $_POST['billing_first_name'] ) ) {
        $errors->add( 'billing_first_name_error', __( '<strong>Error</strong>: First name is required!', 'woocommerce' ) );
    }
    if ( isset( $_POST['billing_last_name'] ) && empty( $_POST['billing_last_name'] ) ) {
        $errors->add( 'billing_last_name_error', __( '<strong>Error</strong>: Last name is required!.', 'woocommerce' ) );
    }
    return $errors;
}
 

add_action( 'woocommerce_created_customer', 'happydeals_save_name_fields' );
 
function happydeals_save_name_fields( $customer_id ) {
    if ( isset( $_POST['billing_first_name'] ) ) {
        update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
         update_user_meta( $customer_id, 'first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
    }
    if ( isset( $_POST['billing_last_name'] ) ) {
        update_user_meta( $customer_id, 'billing_last_name', sanitize_text_field( $_POST['billing_last_name'] ) );   
         update_user_meta( $customer_id, 'last_name', sanitize_text_field( $_POST['billing_last_name'] ) );        
    }
 
}    


add_action( 'woocommerce_save_account_details', 'happydeals_save_account_details' );

function happydeals_save_account_details( $user_id ) {    
	update_user_meta( $user_id, 'custom_account_birthdate', htmlentities( $_POST[ 'custom_account_birthdate' ] ) ); 
        update_user_meta( $user_id, 'custom_account_gender', htmlentities( $_POST[ 'custom_account_gender' ] ) ); 
} // end func




/*add_filter( 'woocommerce_coupon_code', 'woocommerce_coupon_code_no_discount', 10, 1 );
function woocommerce_coupon_code_no_discount($coupon_code){
global $woocommerce;
    if (is_user_logged_in()) {
        $users = get_users(array(
            'meta_key'     => 'gens_referral_id',
            'meta_value'   => $coupon_code,
        
        ));
        
        if (count($users) > 0 ) {
              if (!$woocommerce->cart->remove_coupons( sanitize_text_field( $coupon_code ))) {
          
        }
        $woocommerce->cart->calculate_totals();
        
             return ' '.$coupon_code.' '; // return anything that is not a coupon code...
        }
        
         return  $coupon_code;
        
    }
    
    return  $coupon_code;



}  */


add_action( 'woocommerce_save_account_details', 'custom_woocommerce_save_account_details', 10, 1 ); 

function custom_woocommerce_save_account_details() {
        global $woocommerce;
        $user_id = get_current_user_id();
        $address = $_POST;
        foreach ($address as $key => $field) :
        if(startsWith($key,'billing_'))
        {
        // Condition to add firstname and last name to user meta table
                update_user_meta( $user_id, $key, $_POST[$key] );
        } else if(startsWith($key,'shipping_')) {
                
                update_user_meta( $user_id, $key, $_POST[$key] );   
        }
        endforeach;

}

function startsWith($haystack, $needle)
{
return $needle === '' || strpos($haystack, $needle) === 0;
}       
                                                  



 



