<?php
/**
 * My Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-address.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$customer_id = get_current_user_id();

if ( ! wc_ship_to_billing_address_only() && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) {
	$page_title = apply_filters( 'woocommerce_my_account_my_address_title', __( 'Información de la cuenta', 'woocommerce' ) );

	$get_addresses    = apply_filters( 'woocommerce_my_account_get_addresses', array(
		//'billing' => __( 'Billing Address', 'woocommerce' ),
		//'shipping' => __( 'Shipping Address', 'woocommerce' )
		'billing' => __( 'Dirección de Cobro', 'woocommerce' ),
		'shipping' => __( 'Dirección de Envío', 'woocommerce' )

	), $customer_id );
} else {
	$page_title = apply_filters( 'woocommerce_my_account_my_address_title', __( 'Información de la cuenta', 'woocommerce' ) );
	$get_addresses    = apply_filters( 'woocommerce_my_account_get_addresses', array(
		'billing' =>  __( 'Dirección de Cobro', 'woocommerce' )
	), $customer_id );
}

$col = 1;
?>

<h2><?php //echo $page_title; ?></h2>

<p class="myaccount_address">
	<?php echo apply_filters( 'woocommerce_my_account_my_address_description', __( 'The following addresses will be used on the checkout page by default.', 'woocommerce' ) ); ?>
</p>

<?php if ( ! wc_ship_to_billing_address_only() && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) echo '<div class="col2-set addresses">'; ?>


<?php foreach ( $get_addresses as $name => $title ) : ?>
<?php 
//print_r($name);  

//print_r( get_user_meta( $customer_id, 'shipping' . '_country', true ));


?>
	<div class="col-<?php echo ( ( $col = $col * -1 ) < 0 ) ? 1 : 2; ?> address">
		<header class="title">
			<h3><?php echo $title; ?></h3>
			<div style="display:block; text-align:right"><a href="<?php echo wc_get_endpoint_url( 'edit-address', $name ); ?>" class="edit"><?php _e( 'Edit', 'woocommerce' ); ?></a></div>
		</header>
		<address>
			<?php
				$address = apply_filters( 'woocommerce_my_account_my_address_formatted_address', array(
					
					'email'  => get_user_meta( $customer_id, $name . '_email', true ),
					'phone'  => get_user_meta( $customer_id, $name . '_phone', true ),

					'first_name'  => get_user_meta( $customer_id, $name . '_first_name', true ),
					'last_name'   => get_user_meta( $customer_id, $name . '_last_name', true ),
					'company'     => get_user_meta( $customer_id, $name . '_company', true ),
					'address_1'   => get_user_meta( $customer_id, $name . '_address_1', true ),
					'address_2'   => get_user_meta( $customer_id, $name . '_address_2', true ),
					'city'        => get_user_meta( $customer_id, $name . '_city', true ),
					'state'       => get_user_meta( $customer_id, $name . '_state', true ),
					'postcode'    => get_user_meta( $customer_id, $name . '_postcode', true ),
					'country'     => get_user_meta( $customer_id, $name . '_country', true )
				), $customer_id, $name );

				$formatted_address = WC()->countries->get_formatted_address( $address );

				if ( ! $formatted_address )
					_e( 'You have not set up this type of address yet.', 'woocommerce' );
				else
					//echo $formatted_address;
					
					echo '<div class="table-responsive"><table class="table table-bordered">';
					echo '<tr>';
					echo '<td><b>Nombres:</b></td><td>'.$address['first_name'].' '.$address['last_name'].'</td>';
					echo '</tr>';
					echo '<tr>';				
					echo '<td><b>Log in ID/E-mail:</b></td><td>'.$address['email'].'</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td><b>Teléfono:</b></td><td>'.$address['phone'].'</td>';
					echo '</tr>';
					echo '<tr>';					
					echo '<td><b>Dirección:</b></td><td>'.$address['address_1'].' '.$address['address_2'].'</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td><b>Localidad / Ciudad:</b></td><td>'.$address['city'].'</td>';
					echo '</tr>';
					echo '<tr>';					
					echo '<td><b>Estado:</b></td><td>'.$address['state'].'</td>';
					echo '</tr>';
					echo '<tr>';					
					echo '<td><b>POSTCODE / ZIP:</b></td><td>'.$address['postcode'].'</td>';
					echo '</tr>';
					echo '</table></div>';				
					//echo 'PAÍS: '.$address['country'].'<br/>';					
					/*
					echo 'ESTADO / PAÍS: '.$address['state'].'<br/>';					
					echo 'NOMBRE DE LA EMPRESA: '.$address['company'].'<br/>';			
					echo 'APELLIDO: '.$address['last_name'].'<br/>';					
					*/
					
					
									
			?>
		</address>
	</div>

<?php endforeach; ?>

<?php if ( ! wc_ship_to_billing_address_only() && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) echo '</div>'; ?>

