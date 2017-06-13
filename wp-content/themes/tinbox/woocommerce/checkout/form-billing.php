<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.1.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/** @global WC_Checkout $checkout */

?>
<div class="woocommerce-billing-fields">
	<?php if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>

		<h3><?php //_e( 'Billing &amp; Shipping', 'woocommerce' ); ?>Datos personales</h3>

	<?php else : ?>

		<h3><?php //_e( 'Billing Details', 'woocommerce' ); ?>Datos personales</h3>

	<?php endif; ?>

	<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

	<?php foreach ( $checkout->checkout_fields['billing'] as $key => $field ) : ?>

		<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

	<?php endforeach; ?>

	<?php do_action('woocommerce_after_checkout_billing_form', $checkout ); ?>

	<?php if ( ! is_user_logged_in() && $checkout->enable_signup ) : ?>

		<?php if ( $checkout->enable_guest_checkout ) : ?>

			<p class="form-row form-row-wide create-account">
				<input class="input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true) ?> type="checkbox" name="createaccount" value="1" /> <label for="createaccount" class="checkbox"><?php _e( 'Create an account?', 'woocommerce' ); ?></label>
			</p>

		<?php endif; ?>

		<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

		<?php if ( ! empty( $checkout->checkout_fields['account'] ) ) : ?>

			<div class="create-account">

				<p><?php _e( 'Create an account by entering the information below. If you are a returning customer please login at the top of the page.', 'woocommerce' ); ?></p>

				<?php foreach ( $checkout->checkout_fields['account'] as $key => $field ) : ?>

					<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

				<?php endforeach; ?>

				<div class="clear"></div>

			</div>

		<?php endif; ?>

		<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>

	<?php endif; ?>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#billing_entrecalles_field').insertAfter('#billing_address_2_field');
		$('#shipping_entrecalles_field').insertAfter('#shipping_address_2');
		$('div.add_info_wccs').append('<div class="facturacion"></div>');
		$('div.facturacion').append('<p><input type="checkbox" id="copiar" value=""><label>Copiar datos personales</label></p>');
		$('div.facturacion').append('<p><input type="checkbox" id="extranjero" value=""><label>Soy extranjero</label></p>');		
		$('div.add_info_wccs h3').append('<input type="checkbox" id="si" value="second_checkbox">');

		$('#myfld1_field, #myfield2_field, #myfield3_field, #myfield11_field, #myfield6_field, #myfield7_field, #myfield10_field, #myfield8_field, #myfield4_field, #myfield9_field, #myfield5_field').appendTo('.facturacion');
		$( "#myfield2_field" ).after( "<h4 class='text-left' style='clear:both; margin-top:20px; display:inline-block'>Dirección</h4>" );

		$('div.facturacion').hide();
		
		$('#si').click(function() {
		    if( $(this).is(':checked')) {
		        $(".facturacion").show(300);
		    } else {
		        $(".facturacion").hide(300);
		    }
		});

		$('#extranjero').click(function() {
		    if( $(this).is(':checked')) {
		        $("p#myfield2_field").hide(300);
		    } else {
		        $("p#myfield2_field").show(300);
		        $('#myfield2').val('');
		    }
		});

		$('#copiar').click(function() {
		    if( $(this).is(':checked')) {
		        $('#myfld1').val($('#billing_first_name').val()+ ' ' + $('#billing_last_name').val());
		        $('#myfield3').val($('#billing_address_1').val());
		        $('#myfield4').val($('#billing_city').val());
		        $('#myfield8').val($('#billing_state').val());
		        $('#myfield5').val($('#billing_postcode').val());
		        $('#myfield11').val($('#billing_entrecalles_field').val());
		    } else {
		        $('#myfld1').val('');
		        $('#myfield3').val('');
		        $('#myfield4').val('');
		        $('#myfield8').val('');
		        $('#myfield5').val('');
		        $('#myfield11').val('');
		    }
		});
	});
</script>
