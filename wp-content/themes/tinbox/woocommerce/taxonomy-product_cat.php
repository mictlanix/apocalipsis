<?php
/**
 * The Template for displaying products in a product category. Simply includes the archive template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/taxonomy-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}



  $refer      = (isset($_SERVER['REQUEST_URI'])) ? strtolower($_SERVER['REQUEST_URI']) : "error";
  $hash = explode("?", $refer);  
  $porciones1 = explode("/", $hash[0]);
  
  if  ($porciones1[1]=='categoria-producto')  {
	    wp_redirect(admin_url('admin.php?page=redirect-import-export&update=4'),302);
	    exit();
  } else {
			wc_get_template( 'archive-product.php' );     	
  }
     





