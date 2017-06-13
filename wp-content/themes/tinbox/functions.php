<?php
function append_query_string( $url, $post ) {
  if ($_GET ==array()) {
    $refer      = (isset($_SERVER['REQUEST_URI'])) ? strtolower($_SERVER['REQUEST_URI']) : "error";

    $hash = explode("?", $refer);  
    $porciones1 = explode("/", $hash[0]);
    $array=parse_url($url);
    $hash = $array['path'];

    $porciones = explode("/", $hash);
    if ( ( ($porciones[1]=='producto')  && ($porciones1[1]=='producto') )  )  {
        wp_redirect(admin_url('admin.php?page=redirect-import-export&update=4'),302);
        exit();
     }
     return true;
  }
    
}



add_filter( 'post_type_link', 'append_query_string', 10, 2 );




//esto es para cambiar el jquery de wordpress
function modify_jquery() {
  if (!is_admin()) {
    // comment out the next two lines to load the local copy of jQuery
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://code.jquery.com/jquery-migrate-1.2.1.min.js', false, '1.2.1');
    wp_enqueue_script('jquery');
  }
}
add_action('init', 'modify_jquery');

//este es para agregar el campo a la tienda
function agregar_campo_atienda() {

    echo '<table class="variations" cellspacing="0">
          <tbody>
              <tr>
              <td class="label"><label for="color">Etiqueta que sale en la tienda</label></td>
              <td class="value">
                  <input type="text" name="campo_personalizado" value="" />                      
              </td>
          </tr>                               
          </tbody>
      </table>';
    ?>  
     
     <!--
      <button type="submit" class="single_add_to_cart_button button alt">
          <?php echo apply_filters('single_add_to_cart_text', __('Add to cart', 'woocommerce'), $product->product_type); ?>
     </button>

     -->

<?php
}
//add_action( 'woocommerce_before_add_to_cart_button', 'agregar_campo_atienda' );



//para validar el nombre del campo personalizado
function nombre_campo_personalizado_validation() { 
    if ( empty( $_REQUEST['campo_personalizado'] ) ) {
        wc_add_notice( __( 'Please enter a Name for Printing&hellip;', 'woocommerce' ), 'error' );
        return false;
    }
    return true;
}
//add_action( 'woocommerce_add_to_cart_validation', 'nombre_campo_personalizado_validation', 10, 3 );



 //Este almacenar los campos personalizados (para el producto que se va a añadir a la cesta "cart")
 //en datos de la compra de artículos (cada elemento(item) del carrito tiene sus propios datos)
function save_campo_presentar_field( $cart_item_data, $product_id ) {
   //$valor = '{"tmhasepo":1,"tmcartepo":'.(string)$_REQUEST['tmcartepo'].',"tmsubscriptionfee":0,"tmcartfee":[]}';  
   //$valor = (string)$_REQUEST['tmcartepo'];  
   $valor = $_REQUEST['tmcartepo'];  
   return $valor; // json_decode((string)$valor, true);
   //$valor= '{"tmhasepo":1,"tmcartepo":[{"mode":"builder","cssclass":"adicionales_image","name":"ADICIONALES","value":"separador","price":"10","section":"56eacaa703b0b7.69437817","section_label":"ADICIONALES","percentcurrenttotal":0,"price_per_currency":{"MXN":"10"},"quantity":"1","multiple":"1","key":"separador_0","use_images":"images","changes_product_image":"custom","imagesp":"","images":"http:\/\/tinbox.dev.com\/wp-content\/uploads\/2016\/03\/separador.png"},{"mode":"builder","cssclass":"adicionales_image","name":"ADICIONALES","value":"plastico","price":"15","section":"56eacaa703b0b7.69437817","section_label":"ADICIONALES","percentcurrenttotal":0,"price_per_currency":{"MXN":"15"},"quantity":"1","multiple":"1","key":"plastico_1","use_images":"images","changes_product_image":"custom","imagesp":"","images":"http:\/\/tinbox.dev.com\/wp-content\/uploads\/2016\/03\/folder-plastico-interno.png"}],"tmsubscriptionfee":0,"tmcartfee":[]}';
}
add_action( 'woocommerce_add_cart_item_data', 'save_campo_presentar_field', 10, 2 );



//Este renderizara los datos personalizados en la página de (cart y checkout page).
function render_meta_on_cart_and_checkout( $cart_data, $cart_item = null ) {
    $custom_items = array();
    /* Woo 2.4.2 updates */
    if( !empty( $cart_data ) ) {
        $custom_items = $cart_data;
    }
    if( isset( $cart_item['campo_presentar'] ) ) {
        $custom_items[] = array( "name" => 'etiqueta que sale en el carro', "value" => $cart_item['campo_presentar'] );
    }

    if( isset( $cart_item['radio'] ) ) {
        $custom_items[] = array( "name" => 'radio carro', "value" => $cart_item['radio'] );
    }


    return $custom_items;
}
add_filter( 'woocommerce_get_item_data', 'render_meta_on_cart_and_checkout', 10, 2 );



////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
/*
add_action( 'template_redirect', 'add_product_to_cart' );
function add_product_to_cart() {
    return true;

}
*/

  function my_custom_function(){
        //woocommerce_variable_add_to_cart();
         //do_action( 'woocommerce_single_product_summary' );
        //do_action( 'woocommerce_after_shop_loop_item' );
        //do_action("woocommerce_tm_epo");
        //do_action("woocommerce_tm_epo_fields",408);
        do_action("woocommerce_tm_epo_fields");
        //do_action("woocommerce_tm_epo_totals");

        //wc_tm_epo_ac_product_price, wc_tm_epo_ac_product_qty, wc_tm_epo_ac_qty)
        //do_action("woocommerce_tm_epo",$product_id);
        //do_action("woocommerce_tm_custom_price_fields");

        //do_action("wc_tm_epo_ac_product_price");
        /*
        if (isset($post) && is_object($post) && ($post instanceof WP_Post )){
           do_action("woocommerce_tm_epo",$product_id);
        }
        */
        //do_action( 'woocommerce_single_variation' );
    }

    add_action( 'woocommerce_before_add_to_cart_button1','my_custom_function');

function mi_funcion(){
    do_action("woocommerce_tm_epo");
}
    
add_action( 'msld_before_single_product_tab','mi_funcion');




//"This displays the extra options box on the frontend and the native product"   Loading outside WooCommerce
/*
function tm_epo_js_loader(){
  do_action( 'woocommerce_tm_epo_enqueue_scripts');
}
add_action( 'wp_enqueue_scripts', 'tm_epo_js_loader' );

*/
/*
add_action( 'init', 'registrar_shorcode_woocommerce'); 

//Crea el conector add_shortcode
function registrar_shorcode_woocommerce(){ 
   add_shortcode('mi_shortcode', WC_Shortcode_Cart::output()); 
}
*/

function func_mishorcode( $atts, $content = "" ) {

  return '<iframe id="mis_listas" src="'.site_url().'/sistema/micuenta" scrolling="no"></iframe>';

  
//$array = WC_Session_Handler::get_session_data();
//return "array";

  //return "Este es mi shortcode";
  //return "content = $content";
}

add_action('init', function() {
    //if (!is_user_logged_in()) 
    {
      //  remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
       // remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
    add_shortcode('mi_shortcode', 'func_mishorcode'); 
    }
});


add_action( 'wp_enqueue_scripts', 'blankslate_load_scripts' );
function blankslate_load_scripts() {
	wp_enqueue_script( 'jquery' );
  
  //se levante corra el script .js
  do_action( 'woocommerce_tm_epo_enqueue_scripts');

}

register_nav_menu( 'primero', __( 'Top', 'tinbox' ) );
register_nav_menu( 'segundo', __( 'Footer Info', 'tinbox' ) );
register_nav_menu( 'tercero', __( 'Footer Prod', 'tinbox' ) );

register_sidebar( array(
		'name'          => __( 'Widget de Newsletter' ),
		'id'            => 'sidebar-footer',
		'description'   => __( 'Este widget es para la Newsletter' ),
		'before_widget' => '<div id="news" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
) );
register_sidebar( array(
		'name'          => __( 'Direccion en footer' ),
		'id'            => 'sidebar-footer1',
		'description'   => __( 'Este widget es para la Dirección en el footer' ),
		'before_widget' => '<div id="dir" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '',
		'after_title'   => '',
) );

function todo() {
 	?>  	
 	<div class="container">
            <div class="col-md-4 col-xs-6 prod-img">
              <img src="<?php img();?>" style="width:250px;height:250px;">
            </div>
            <div class="col-md-4 col-xs-12 prod-des">
              <h4><?php the_title(); ?></h4>     
              <h3><?php the_content(); ?></h3> 
             <p class="stock"><?php my_stock(); ?></p>
             <p class="cart"><?php   woocommerce_variable_add_to_cart(); ?></p> 
             <p class="info"><?php woocommerce_product_additional_information_tab(); ?></p>

            </div>
            <div class="col-md-4 col-xs-12 prod-cot">
             <a href="<?php bloginfo('url'); ?>/contacto?cto=<?php the_title(); ?>" class='btn-cot'><span>PEDIR COTIZACIÓN</span></a>
            </div>
          </div>
           
  <?php
 }


function woocommerce_variable_add_to_cart(){
   global $product;

   // Enqueue variation scripts
   wp_enqueue_script( "wc-add-to-cart-variation" );

   // Get Available variations?
   $get_variations = sizeof( $product->get_children() ) <= apply_filters( "woocommerce_ajax_variation_threshold", 30, $product );

   // Load the template

   $is_variation = $product->is_type( "variable" );
   
   if ( $is_variation ) {
         
         
       wc_get_template( "single-product/add-to-cart/variable.php", array(
         "available_variations" => $get_variations ? $product->get_available_variations() : false,
         "attributes"           => $product->get_variation_attributes(),
         "selected_attributes"  => $product->get_variation_default_attributes()
       ) );
    
   }
}

// Añadiendo campos en Finalizar compra
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );

function custom_override_checkout_fields( $fields ) {
     $fields['shipping']['shipping_entrecalles'] = array(
        'label'     => __('Entre que calles', 'woocommerce'),
	    'required'  => false,
	    'class'     => array('form-row-wide'),
	    'clear'     => true
	     );
     $fields['billing']['billing_entrecalles'] = array(
        'label'     => __('Entre que calles', 'woocommerce'),
	    'required'  => false,
	    'class'     => array('form-row-wide'),
	    'clear'     => true
	     );

	     return $fields;
	 }


?>