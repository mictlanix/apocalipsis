<?php
// Direct access security
if (!defined('TM_EPO_PLUGIN_SECURITY')){
	die();
}

final class TM_EPO_CHECK_base {

    protected static $_instance = null;

    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    function __construct() {
        add_action( 'admin_init', array( $this, 'check_version' ) );

        if ( ! self::compatible_version() ) {
            return;
        }
        add_action( 'plugins_loaded', array( $this, 'wcml_check' ) );
        //self::wcml_check();
    }

    function init() {
        
    }

    function wcml_check() {
        if(defined('WCML_VERSION') && class_exists('woocommerce_wpml') && get_magic_quotes_gpc()){
            add_action( 'admin_notices', array( $this, 'wcml_notice' ) );
        }
    }
    function wcml_notice() {
        $message = sprintf(__('%sImportant:%s WooCommerce Multilingual plugin is not supported and will cause loss of data.',TM_EPO_TRANSLATION),
            '<strong>', '</strong>');
             
        echo '<div class="error fade"><h4>TM Extra Product Options</h4><p>' . $message . '</p></div>' . "\n";       
    }

    function check_version() {
        if ( ! self::compatible_version() ) {
            if ( is_plugin_active( plugin_basename( __FILE__ ) ) ) {
                deactivate_plugins( plugin_basename( __FILE__ ) );
                add_action( 'admin_notices', array( $this, 'disabled_notice' ) );
                if ( isset( $_GET['activate'] ) ) {
                    unset( $_GET['activate'] );
                }
            }
        }
        if ( self::old_version() ) {
            deactivate_plugins( 'woocommerce-tm-custom-price-fields/tm-woo-custom-prices.php' );
            add_action( 'admin_notices', array( $this, 'deprecated_notice' ) );
        }
        if ( ! self::woocommerce_check() ) {
            add_action( 'admin_notices', array( $this, 'disabled_notice_woocommerce_check' ) );
        }

    }

    function disabled_notice_woocommerce_check() {
        $message = sprintf(__('%sImportant:%s WooCommerce TM Extra Product Options requires %sWooCommerce%s 2.1 or later.',TM_EPO_TRANSLATION),
            '<strong>', '</strong>','<a href="http://wordpress.org/extend/plugins/woocommerce/">','</a>');

        if (tm_woocommerce_check_only()){            
            $message = sprintf( __( '%sImportant:%s Please run WooCommerce updater before using WooCommerce TM Extra Product Options.', 
             TM_EPO_TRANSLATION ), 
             '<strong>', '</strong>');
        }
        echo '<div class="error fade"><p>' . $message . '</p></div>' . "\n";       
    }

    function deprecated_notice() {
        $active_plugins = apply_filters( 'active_plugins', get_option('active_plugins' ) );
            
            if ( in_array( 'woocommerce-tm-custom-price-fields/tm-woo-custom-prices.php', $active_plugins ) ){
                $deactivate_url = 'plugins.php?action=deactivate&plugin=' . urlencode( 'woocommerce-tm-custom-price-fields/tm-woo-custom-prices.php' ) . '&plugin_status=all&paged=1&s&_wpnonce=' . urlencode( wp_create_nonce( 'deactivate-plugin_woocommerce-tm-custom-price-fields/tm-woo-custom-prices.php' ) );
                $message = '<strong>Important:</strong> It is highly recommended that you <a href="' . esc_url( admin_url( $deactivate_url ) ) . '"> deactivate the old Custom Price Fields</a> plugin.';
                echo '<div class="error fade"><p>' . $message . '</p></div>' . "\n";
            }else{
                $delete_url = 'plugins.php?action=delete-selected&checked%5B0%5D=' . urlencode( 'woocommerce-tm-custom-price-fields/tm-woo-custom-prices.php' ) . '&plugin_status=all&paged=1&s&_wpnonce=' . urlencode( wp_create_nonce( 'bulk-plugins' ) );
                $message = '<strong>Important:</strong> It is highly recommended that you <a href="' . esc_url( admin_url( $delete_url ) ) . '"> delete the old Custom Price Fields</a> plugin.';
                echo '<div class="error fade"><p>' . $message . '</p></div>' . "\n";
            }       
    }

    function disabled_notice() {
        $message = sprintf(__('%sImportant:%s WooCommerce TM Extra Product Options requires WordPress 3.5 or later.',TM_EPO_TRANSLATION),
            '<strong>', '</strong>');
             
        echo '<div class="error fade"><p>' . $message . '</p></div>' . "\n";       
    } 

    public function stop_plugin(){
        if ( ! self::compatible_version() ) {
            return true;
        }
        if ( self::old_version() ) {
            return true;
        }
        if ( ! self::woocommerce_check() ) {
            return true;
        }

        return false;
    }

    static function activation_check() {
        if ( ! self::compatible_version() ) {
            deactivate_plugins( plugin_basename( __FILE__ ) );
            wp_die( __( 'WooCommerce TM Extra Product Options requires WordPress 3.5 or later.', TM_EPO_TRANSLATION ) );
        }
        
        set_transient( '_tm_activation_redirect', 1, HOUR_IN_SECONDS );
    }

    static function compatible_version() {
        if ( version_compare( $GLOBALS['wp_version'], '3.5', '<' ) ) {
             return false;
         }

        return true;
    }

    static function old_version() {
        if (  class_exists( 'TM_Custom_Prices' )  )  {
             return true;
         }

        return false;
    }
    
    static function woocommerce_check() {
        if ( tm_woocommerce_check() && !version_compare( get_option( 'woocommerce_db_version' ), '2.1', '<' ) )  {
             return true;
         }

        return false;
    }

}


?>