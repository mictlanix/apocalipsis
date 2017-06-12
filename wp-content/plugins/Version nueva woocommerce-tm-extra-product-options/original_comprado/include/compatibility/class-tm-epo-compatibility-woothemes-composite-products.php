<?php
// Direct access security
if (!defined('TM_EPO_PLUGIN_SECURITY')){
    die();
}

final class TM_EPO_COMPATIBILITY_woothemes_composite_products {

    protected static $_instance = null;

    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {

        add_action( 'wc_epo_add_compatibility', array( $this, 'add_compatibility' ) );

    }

    public function init() {
        
    }

    public function add_compatibility(){
        /** WooCommerce Composite Products (woothemes) support **/
        add_action( 'woocommerce_composite_product_add_to_cart', array( $this, 'tm_bto_display_support' ), 11, 2 );
        add_action( 'woocommerce_composited_product_add_to_cart', array( $this, 'tm_composited_display_support' ), 11, 3 );
        add_filter( 'woocommerce_composite_button_behaviour', array( $this, 'tm_woocommerce_composite_button_behaviour' ), 50, 2 );
        add_action( 'woocommerce_composite_products_remove_product_filters', array( $this, 'tm_woocommerce_composite_products_remove_product_filters' ), 99999 );
    }

    /** WooCommerce Composite Products (woothemes) support **/
    public function tm_woocommerce_composite_products_remove_product_filters() {
        TM_EPO()->is_bto=false;
    }
    /** WooCommerce Composite Products (woothemes) support **/
    public function tm_bto_display_support( $product_id="", $item_id="" ) {
        global $product;

        if (!$product){
            $product = wc_get_product( $product_id );
        }
        if (!$product){
            // something went wrong. wrond product id??
            // if you get here the plugin will not work :(
        }else{          
            TM_EPO()->set_tm_meta($product_id);
            TM_EPO()->is_bto=true;
            if ((TM_EPO()->tm_epo_display=='normal' || TM_EPO()->tm_meta_cpf['override_display']=='normal') && TM_EPO()->tm_meta_cpf['override_display']!='action'){     
                TM_EPO()->frontend_display($product_id, $item_id);
            }
        }
    }

    /** WooCommerce Composite Products (woothemes) support **/
    public function tm_woocommerce_composite_button_behaviour($type="",$product=""){
        if ( isset($_POST) && isset($_POST['cpf_bto_price']) && isset($_POST['add-product-to-cart']) && isset($_POST['item_quantity']) ){
             $type = 'posted';
        }
        return $type;
    }

    /** WooCommerce Composite Products (woothemes) support **/
    public function tm_composited_display_support( $product=false, $component_id="", $composite_product ) {

        if (!$product){
            // something went wrong. wrond product id??
            // if you get here the plugin will not work :(
        }else{
            TM_EPO()->set_tm_meta($product->id);       
            TM_EPO()->is_bto=true;
            if ((TM_EPO()->tm_epo_display=='normal' || TM_EPO()->tm_meta_cpf['override_display']=='normal') && TM_EPO()->tm_meta_cpf['override_display']!='action'){
                TM_EPO()->frontend_display($product->id, $component_id);
            }
        }
    }
}


?>