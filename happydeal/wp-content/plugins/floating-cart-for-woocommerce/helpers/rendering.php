<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//builds the html structure of the floating cart, given the cart data
function bw_woofc_build_floatingcartcontent( $cartdata, $settings )
{

        $result = "";

        //change the line below to customize your cart
        $color_main = "#337ab7";

        //buttons links
        $linkCheckOutPage = $cartdata['checkoutUrl'];
        $linkCartPage = $cartdata['cartUrl'];
        $linkCheckOutPageAlertDemo = "";
        $linkCartPageAlertDemo = "";
        if (bw_woofc_demo_is_active() == 1)
        {
                $linkCheckOutPageAlertDemo = " onclick='alert(\"For the Demo, these links are disabled. Thank you!\")'";
                $linkCheckOutPage = "#";
                $linkCartPageAlertDemo = " onclick='alert(\"For the Demo, these links are disabled. Thank you!\")'";
                $linkCartPage = "#";
        }

        $option_heightbodypane = "";
        $option_displayarrowup = "";
        $option_displayarrowdown = "";

        if ( $settings['general_defaultmode'] == 'extended')
        {
                $option_heightbodypane = "height:100%";
                $option_displayarrowup = "display:none";
                $option_displayarrowdown = "display:block";
        }
        else
        {
                $option_heightbodypane = "height:0px";
                $option_displayarrowup = "display:block";
                $option_displayarrowdown = "display:none";
        }


        //Main box
       // $result .= "<div id=\"bravowp-woo-floatingcart\" style=\" z-index:10000; min-width: 200px;background-color:#fff;position:fixed;bottom:5px;right:10px;border:1px solid #b3b3b3;box-shadow: 0 2px 1em 0 rgba(0, 0, 0, 0.4);border-radius:4px; \" >";
       
        $result .= "<div id=\"bravowp-woo-floatingcart\" style=\" z-index:10000; height: 450px; width: 400px;background-image: url(".get_stylesheet_directory_uri().'/assets/images/sliderforcart.png'.");top: 50%; right: 0; transform: translate(0, -50%); position:fixed; bottom:5px; background-size: 100%; background-repeat: no-repeat;  \" >";
        //button
      /*  $result .= '<img onclick="bravowp_woo_floatingcart_togglecart_c();" style=" cursor: pointer; position: absolute; left: 35px; top: 50%; transform: translate(0, -50%); height: 60px;" src="'.get_stylesheet_directory_uri().'/assets/images/cart.png' .'">'; */
        
          $result .= "<div onclick=\"bravowp_woo_floatingcart_togglecart_c();\" style=\"background-image: url(".get_stylesheet_directory_uri().'/assets/images/cart.png'."); cursor: pointer; position: absolute; left: 35px; top: 50%; transform: translate(0, -50%); height: 60px; width: 60px; background-size: 36px; background-color: #FFF; background-position: center center; border-radius: 50%; image-rendering: -webkit-optimize-contrast; background-repeat: no-repeat; \"></div>"; 

        $result .="<div style=\"padding-left: 170px;
    padding-top: 48px;\">";
        
        
        //Body pane
        $result .= "<div style=\"position:relative;overflow: hidden;" . $option_heightbodypane .  ";\"  id='bravowp-woo-floatingcart-bodypane' >";


        //ajax loader
        $result .= "<div id='bravowp-woo-floatingcart-loader' class='bravowp-woo-floatingcart-ajaxloader' style=\" display:none; \">";
        $result .= "<img src='" . bw_woofc_globals_plugin_url . "\images\loading.gif' >";
        $result .= "</div>";

        //Items pane 
        $result .='<form class="woocommerce-cart-form" action="'.  esc_url( wc_get_cart_url() ) .'" method="post">';    
        $result .= "<div style=\" height:300px; overflow: auto; font-size: 12px; color: #fff; padding: 10px 10px 0px 10px; \" >";

        $result .= "<table class='table' style='border: 1px solid #fff;'><thead><th></th><th>QTY</th><th>PRICE</th></thead><tbody id='cart_items_table'>";
        //listing products in the cart    
                
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
                        //$result .= "<td><a onclick=\"bravowp_woo_floatingcart_displayloadingimage();\" href='" . $Item["deleteItemUtl"] . "'> <img style=\"width:10px;\" src='" . bw_woofc_globals_plugin_url .  "\images\icon-delete-1.png'> </a>&nbsp;".$Item["productTitle"]."</td>";
                        $result .= "<td><a href='#' class='remove_product' rel='".$cart_item_key."'> <img style=\"width:10px;\" src='" . bw_woofc_globals_plugin_url .  "\images\icon-delete-1.png'> </a>&nbsp;".$Item["productTitle"]."</td>";
                     
                        //$result .= "<td><input type='text' value='". $Item["quantity"] . "' class='qty' ></td>";   
                                        
                        $result .=  "<td class='wc_quantity'>" . apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $Item ) . "</td>";
                        $result .= "<td>" . $Item["price"] . "</td>";
                        $result .= "</tr>";
        
                }
        } else {
            $result .= "<tr><td colspan='3' style='height: 200px;'>Your shopping cart is empty</td></tr>";
        }
        
        $result .= "</tbody></table>";

        //Items pane     
        $nonce = wp_create_nonce( 'woocommerce-cart' );
        
        $result .= "</div>"; 
        $result .= '<input type="submit" class="button" name="update_cart" value="Update" style="display: none;" />';
        $result .=  '<input type="hidden" id="_wpnonce" name="_wpnonce" value="'. $nonce .'"><input type="hidden" name="_wp_http_referer" value="/">'; 
        
        $result .= '</form>';
        
                        


        if ( count( $cartdata["products"] ) > 0 )
        {
                //Subtotal pane                     
                $result .= "<div style=\" padding-bottom:10px; \" >";
                $result .= "<input type='hidden' name='qty_total' id='qty_total' value='". $cartdata["itemsCount"] ."'/>";
                $result .= "<div id='cart_total' style=\" margin: 0px 5%; text-align: center; border-radius: 4px; padding: 4px 0px; font-size: 14px; font-weight: bold; background-color: #f2f2f2; color: #5f5f5f; \" >";
                $result .= "Subtotal: " . $cartdata["cartTotal"];
                $result .= "</div>";
                $result .= "</div>";
        }
       

      
               
        
        



        //Body pane
        $result .= "</div>";



        //Footer pane
        $result .= "<div id='bravowp-woo-floatingcart-footerpane' >";
        $result .= "</div>";


        //Main box
        $result .= "</div>";
         //Buttons pane
                $result .= "<div style=\" padding-bottom:15px;text-align: center;margin-right: 10px; margin-left: 10px; \" >";
                $result .= "<a href='" . $linkCheckOutPage . "' " . $linkCheckOutPageAlertDemo . " style=\" background-color: transparent;border-color: #4cae4c;color: #ffffff;border-radius: 4px;padding: 8px 12px;text-align: center;font-size: 20px;cursor:pointer;text-decoration:none;font-weight: bold;position: absolute;bottom: 15px;right: 0px;width: 210px; \" >";
                $result .= "Checkout";
                $result .= "</a>";
                $result .= "</div>";
                
        $result .= "</div>";


        return $result;

}


//returns 1 if the cart must be displayed
function bw_woofc_showforcurrentpage()
{

        $result = 0;

        //getting settings
        $settings = bw_woofc_readsettings();

        //shows the cart only in the correct pages, according to settings
        if ( $settings['show_on_pages'] == "allpages")
        {
                //show on all pages, but can never be displayed on cart or checkout
                if ( ! is_cart() && ! is_checkout() )
                {
                        $result = 1;
                }
        }
        else
        {
                //must be shown only on SHOP page of woocommerce
                if ( is_shop() )
                {
                        $result = 1;
                }
        }

        return $result;

}




?>
