<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

wc_print_notices(); ?>

<p class="myaccount_user">
	<?php


	printf(
		__( 'Hello <strong>%1$s</strong> (not %1$s? <a href="%2$s">Sign out</a>).', 'woocommerce' ) . ' ',
		$current_user->display_name,
		wc_get_endpoint_url( 'customer-logout', '', wc_get_page_permalink( 'myaccount' ) )
	);

	printf( __( 'From your account dashboard you can view your recent orders, manage your shipping and billing addresses and <a href="%s">edit your password and account details</a>.', 'woocommerce' ),
		wc_customer_edit_account_url()
	);

   /*
	printf(
		__( 'Hello <strong>%1$s</strong> (not %1$s? <a href="%2$s">Sign out</a>).', 'woocommerce' ) . ' ',
		$current_user->display_name,
		wc_get_endpoint_url( 'customer-logout', '', wc_get_page_permalink( 'myaccount' ) )
	);

	printf( __( 'From your account dashboard you can view your recent orders, manage your shipping and billing addresses and <a href="%s">edit your password and account details</a>.', 'woocommerce' ),
		wc_customer_edit_account_url()
	);
	*/
	
	//USER_EMAIL

	//var_dump( $current_user );
/*
USER_NICENAME
DISPLAY_NAME
USER_LOGIN
USER_REGISTERED
*/

//http://bitsandbabble.com/2014/10/custom-user-fields-on-woocommerce-my-account-page/
//https://gist.github.com/anonymous/01261f48dbbe28c53840
//https://themes.trac.wordpress.org/changeset?old_path=promax/1.5.2&new_path=promax/1.5.3
//https://www.snip2code.com/Snippet/663090/Show--WC-Vendor--Custom-Fields-in-front-
//$array = WC_Session_Handler::get_session_data();

//print_r($current_user->get_session_data());


	$nombre_session= get_user_meta( $current_user->id, 'first_name' , true);
	$apellido_session= get_user_meta( $current_user->id, 'last_name' , true);

echo '';
echo '<h2>INFORMACIÓN DE LA CUENTA</h2>';
echo '<div style="display:block; text-align:right"><a href="'.wc_customer_edit_account_url().'" class="edit"> Editar</a></div>';

echo '<div class="table-responsive"><table class="table table-bordered">';
echo '<tr>';
echo '<td><b>Nick:</b></td><td>'.$current_user->display_name.'</td>';
echo '</tr>';
echo '<tr>';
echo '<td><b>Nombre:</b></td><td>'.$nombre_session.'</td>';
echo '</tr>';
echo '<tr>';
echo '<td><b>Apellido:</b></td><td>'.$apellido_session.'</td>';
echo '</tr>';
echo '<tr>';
echo '<td><b>Email:</b></td><td>'.$current_user->user_email.'</td>';
echo '</table></div>';
	


	?>
</p>



<!-- Antes de mi cuenta-->
<?php do_action( 'woocommerce_before_my_account' ); ?>

<?php wc_get_template( 'myaccount/my-downloads.php' ); ?>


<!-- Direcciones-->
<?php wc_get_template( 'myaccount/my-address.php' ); ?>


<!-- Pedidos recientes-->
<?php wc_get_template( 'myaccount/my-orders.php', array( 'order_count' => $order_count ) ); ?>


<!-- Despues de mi cuenta-->
<?php do_action( 'woocommerce_after_my_account' ); ?>
