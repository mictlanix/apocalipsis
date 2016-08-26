<?php
/*
 * Template Name: Calendario y Fotocalendario
 * Description: Plantilla de pagina personalizada.
 */

get_header();
?>

	
<div class="container">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			the_content();

			

		// End the loop.
		endwhile;
		?>

</div>


<!-- PROCESO DE COMPRA -->

	<div class="container">
		<hr>
		<div class="row">
			<h1>Proceso de compra</h1>
		</div>
		<div class="row">
			<div class="col-md-3 col-sm-6 col-xs-12 text-center proceso">
				<img src="<?php echo get_template_directory_uri(); ?>/images/ico-elige.png" class="img-responsive">
				<p class="titulo">ELIGE TU PRODUCTO</p>
				<p>Checa nuestro catálogo y elige tu calendario o libreta ideal.</p>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12 text-center proceso">
				<img src="<?php echo get_template_directory_uri(); ?>/images/ico-personaliza.png" class="img-responsive">
				<p class="titulo">PERSONALÍZALO</p>
				<p>Pon tu nombre, fechas especiales y fotos para hacerlo único.</p>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12 text-center proceso">
				<img src="<?php echo get_template_directory_uri(); ?>/images/ico-compra.png" class="img-responsive">
				<p class="titulo">REALIZA TU COMPRA</p>
				<p>Una vez terminado tu producto, finaliza tu proceso de compra y proporciona tus datos de envío.</p>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12 text-center proceso">
				<img src="<?php echo get_template_directory_uri(); ?>/images/ico-espera.png" class="img-responsive">
				<p class="titulo">ESPERA TU PRODUCTO</p>
				<p>En 5 días recibirás tu calendario, libreta o agenda.</p>
			</div>
		</div>
	</div>

<!-- TAMAÑOS -->
<div class="container-fluid tamanos">
	<div class="container">
		<div class="row">
			<?php 
				$pagename = get_query_var('pagename'); 

				switch ($pagename) {
				 	case 'calendarios':
				 		echo '<div class="col-md-3 col-sm-3 col-xs-6 text-center"><a href="';
				 		echo get_site_url();
				 		echo '/sistema/calendarios"><img src="';
				 		echo get_template_directory_uri();
				 		echo '/images/b_tam_1.png" class="img-responsive"></a></div>';
				 		break;
				 	case 'fotocalendarios':
				 		echo '<div class="col-md-3 col-sm-3 col-xs-6 text-center"><a href="';
				 		echo get_site_url();
				 		echo '/sistema/fotocalendario"><img src="';
				 		echo get_template_directory_uri();
				 		echo '/images/b_tam_1.png" class="img-responsive"></a></div>';
				 		break;
				 	case 'libretas':
				 		echo '<div class="col-md-3 col-sm-3 col-xs-6 text-center"><a href="';
				 		echo get_site_url();
				 		echo '/sistema/libretas"><img src="';
				 		echo get_template_directory_uri();
				 		echo '/images/b_tam_1.png" class="img-responsive"></a></div>';
				 		break;
				 	case 'agendas':
				 		echo '<div class="col-md-3 col-sm-3 col-xs-6 text-center"><a href="';
				 		echo get_site_url();
				 		echo '/sistema/agendas"><img src="';
				 		echo get_template_directory_uri();
				 		echo '/images/b_tam_1.png" class="img-responsive"></a></div>';
				 		break;
				 	default:
				 		
				 		break;
				 }
			?>
			
			<div class="col-md-3 col-sm-3 col-xs-6 text-center"><img src="<?php echo get_template_directory_uri(); ?>/images/b_tam_2.png" class="img-responsive"></div>
			<div class="col-md-3 col-sm-3 col-xs-6 text-center"><img src="<?php echo get_template_directory_uri(); ?>/images/b_tam_3.png" class="img-responsive"></div>
			<div class="col-md-3 col-sm-3 col-xs-6 text-center"><img src="<?php echo get_template_directory_uri(); ?>/images/b_tam_4.png" class="img-responsive"></div>
		</div>
	</div>
</div>

<?php get_footer(); ?>