<?php /* Template Name: Home */
get_header();
?>

	<div class="container-fluid">
		<div class="row">
			
			<?php				
				$img1 = get_field( "banner_top1" );
				$img2 = get_field( "banner_top2" );
				$img3 = get_field( "banner_top3" );
				$img4 = get_field( "banner_top4" );
				$img5 = get_field( "banner_top5" );
				$img6 = get_field( "banner_top6" );
				$img7 = get_field( "banner_top7" );
			?>
		
		  	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			  <!-- Indicators -->
			  <ol class="carousel-indicators">
			    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
			    <?php 
				if ( $img2 != '' ) {
				 echo '<li data-target="#carousel-example-generic" data-slide-to="1"></li>';				    			 
				}
				?>
				<?php 
				if ( $img3 != '' ) {
				 echo '<li data-target="#carousel-example-generic" data-slide-to="2"></li>';				    			 
				}
				?>
				<?php 
				if ( $img4 != '' ) {
				 echo '<li data-target="#carousel-example-generic" data-slide-to="3"></li>';				    			 
				}
				?>
				<?php 
				if ( $img5 != '' ) {
				 echo '<li data-target="#carousel-example-generic" data-slide-to="4"></li>';				    			 
				}
				?>
				<?php 
				if ( $img6 != '' ) {
				 echo '<li data-target="#carousel-example-generic" data-slide-to="5"></li>';				    			 
				}
				?>
				<?php 
				if ( $img7 != '' ) {
				 echo '<li data-target="#carousel-example-generic" data-slide-to="6"></li>';				    			 
				}
				?>
			    
			  </ol>

			  <!-- Wrapper for slides -->
			  <div class="carousel-inner" role="listbox">

			    <div class="item active">
			      <img src="<?php echo $img1; ?>" alt="">
			    </div>
			    <?php 
				if ( $img2 != '' ) {
				 echo '<div class="item"><img src="'.$img2.'" ></div>';				    			 
				}
				?>
				<?php 
				if ( $img3 != '' ) {
				 echo '<div class="item"><img src="'.$img3.'" ></div>';				    			 
				}
				?>
				<?php 
				if ( $img4 != '' ) {
				 echo '<div class="item"><img src="'.$img4.'" ></div>';				    			 
				}
				?>
				<?php 
				if ( $img5 != '' ) {
				 echo '<div class="item"><img src="'.$img5.'" ></div>';				    			 
				}
				?>
				<?php 
				if ( $img6 != '' ) {
				 echo '<div class="item"><img src="'.$img6.'" ></div>';				    			 
				}
				?>
				<?php 
				if ( $img7 != '' ) {
				 echo '<div class="item"><img src="'.$img7.'" ></div>';				    			 
				}
				?>
			  </div>

			  <!-- Controls -->
			  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
			    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
			  </a>
			  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
			    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			  </a>
			</div>
		</div>
	</div>

	<!-- NUESTROS PRODUCTOS -->

	<div class="container">



		<div class="row">
			<h1 id="titulo1">Nuestros Productos</h1>
		</div>
		<div class="row">

			<div class="col-md-3 col-sm-3 col-xs-6 producto">
				<div class="celda">
					<img src="<?php echo get_template_directory_uri(); ?>/images/foto_calendarios.jpg" class="img-responsive">
					<div class="boton"><a href="<?php echo get_site_url(); ?>/calendarios">Calendarios</a></div>
				</div>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-6 producto">
				<div class="celda">
					<img src="<?php echo get_template_directory_uri(); ?>/images/foto_fotocalendarios.jpg" class="img-responsive">
					<div class="boton"><a href="<?php echo get_site_url(); ?>/fotocalendarios">Fotocalendarios</a></div>
				</div>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-6 producto">
				<div class="celda">
					<img src="<?php echo get_template_directory_uri(); ?>/images/foto_agenda.jpg" class="img-responsive">
					<div class="boton"><a href="<?php echo get_site_url(); ?>/agendas">Agendas</a></div>
				</div>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-6 producto">
				<div class="celda">
					<img src="<?php echo get_template_directory_uri(); ?>/images/foto_libreta.jpg" class="img-responsive">
					<div class="boton"><a href="<?php echo get_site_url(); ?>/libretas">Libretas</a></div>
				</div>
			</div>
			
		</div>
	</div>
	
	<!-- PROCESO DE COMPRA -->

	<div class="container">
		<div class="row" id="proceso">
			<h1 id="titulo2">Proceso de compra</h1>
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
				<p>Una vez terminado tu producto, finaliza tu proceso de compra y proporciona tus datos de envio.</p>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12 text-center proceso">
				<img src="<?php echo get_template_directory_uri(); ?>/images/ico-espera.png" class="img-responsive">
				<p class="titulo">ESPERA TU PRODUCTO</p>
				<p>En 5 días recibirás tu calendario, libreta o agenda.</p>
			</div>
		</div>
	</div>

	<!-- LOS MAS VENDIDOS -->

	<div class="container">
		<div class="row">
			<h1 id="titulo3">De temporada</h1>
		</div>
		<div class="row">
			<!--Horizontal Tab-->
	        <div id="parentHorizontalTab">
	            <ul class="resp-tabs-list hor_1">
	                <li>Calendarios111111111111111111111111111111111111111</li>
	                <li>Fotocalendarios</li>
	                <li>Libretas</li>
	                <li>Agendas</li>
	            </ul>
	            <div class="resp-tabs-container hor_1">
	                
	                <div>

		                <?php

						/*
						$meta_query   = WC()->query->get_meta_query();
						$meta_query[] = array(
						    'key'   => '_featured',
						    'value' => 'yes'
						);*/
						$args = array(
							  'post_type' => 'product',
							  'posts_per_page' => 4, // -1 cuanto muestra por pagina -1 para mostrar todos
							  'product_cat' => 'calendarios',
							  'post_status'=> 'publish',  //cuando esta publicado
							);
						echo "asdasdasd sadasddasdasd asdasd";	
						$loop = new WP_Query( $args );
			          
						if ( $loop->have_posts() ) {
					            while ( $loop->have_posts() ) : $loop->the_post();
					print_r($loop);
					                   if ( has_post_thumbnail() ) {
									echo '<div class="col-md-3 col-sm-6 col-xs-6 producto">';
									echo 	'<div class="celda">';
									echo 		the_post_thumbnail();						
									echo '</div>';
									echo '<p>'.the_title().'</p>';
									echo '</div>';
							  }
				         	 endwhile; // End of the loop.          
						}			
						wp_reset_postdata();
						?>

						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
							<a href="<?php echo site_url(); ?>/calendarios" class="btn btn-default vertodos">Ver calendarios</a>
						</div>
	                    
	                </div>	                

	                <div>

		                <?php

						/*$meta_query   = WC()->query->get_meta_query();
						$meta_query[] = array(
						    'key'   => '_featured',
						    'value' => 'yes'
						);*/
						$loop = new WP_Query( array(								
	    							'product_cat' => 'fcalendario',    						  							
	    							'posts_per_page' => 4,
	    							//'meta_query'  =>  $meta_query

	    							'post_type' => 'product',
	    							'post_status'=> 'publish',  	

								));
			          
				         while ( $loop->have_posts() ) : $loop->the_post();
				        	echo '<div class="col-md-3 col-sm-6 col-xs-6 producto">';
							echo 	'<div class="celda">';
							echo 		the_post_thumbnail();						
							echo '</div>';
							echo '<p>'.the_title().'</p>';
							echo '</div>';
				          endwhile; // End of the loop.          
									
						wp_reset_query();
						?>

						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
							<a href="<?php echo site_url(); ?>/fotocalendarios" class="btn btn-default vertodos">Ver fotocalendarios</a>
						</div>
	                    
	                </div>
	                <div>

		                <?php

						/*$meta_query   = WC()->query->get_meta_query();
						$meta_query[] = array(
						    'key'   => '_featured',
						    'value' => 'yes'
						);*/
						$loop = new WP_Query( array(								
	    							'product_cat' => 'libretas',    						  							
	    							'posts_per_page' => 4,
	    							//'meta_query'  =>  $meta_query,
	    							'post_type' => 'product',
	    							'post_status'=> 'publish',  	


								));
			          
				         while ( $loop->have_posts() ) : $loop->the_post();
				        	echo '<div class="col-md-3 col-sm-6 col-xs-6 producto">';
							echo 	'<div class="celda">';
							echo 		the_post_thumbnail();						
							echo '</div>';
							echo '<p>'.the_title().'</p>';
							echo '</div>';
				          endwhile; // End of the loop.          
									
						wp_reset_query();
						?>

						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
							<a href="<?php echo site_url(); ?>/libretas" class="btn btn-default vertodos">Ver libretas</a>
						</div>
	                    
	                </div>
	                <div>

		                <?php

						/*$meta_query   = WC()->query->get_meta_query();
						$meta_query[] = array(
						    'key'   => '_featured',
						    'value' => 'yes'
						);*/
						$loop = new WP_Query( array(								
	    							'product_cat' => 'agendas',    						  							
	    							'posts_per_page' => 4,
									//'meta_query'  =>  $meta_query,
	    							'post_type' => 'product',
	    							'post_status'=> 'publish',  	

								));
			          
				         while ( $loop->have_posts() ) : $loop->the_post();
				        	echo '<div class="col-md-3 col-sm-6 col-xs-6 producto">';
							echo 	'<div class="celda">';
							echo 		the_post_thumbnail();						
							echo '</div>';
							echo '<p>'.the_title().'</p>';
							echo '</div>';
				          endwhile; // End of the loop.          
									
						wp_reset_query();
						?>

						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
							<a href="<?php echo site_url(); ?>/agendas" class="btn btn-default vertodos">Ver agendas</a>
						</div>
	                    
	                </div>
	            </div>
	        </div> <!-- Fin de tabs -->


		</div>
	</div>
	
	<!-- CARRUSEL -->
	<div class="container-fluid">
		<div class="row">
			<?php				
				$imgn1 = get_field( "banner-abajo1" );
				$imgn2 = get_field( "banner-abajo2" );
				$imgn3 = get_field( "banner-abajo3" );
				$imgn4 = get_field( "banner-abajo4" );
				$imgn5 = get_field( "banner-abajo5" );
				$imgn6 = get_field( "banner-abajo6" );
				$imgn7 = get_field( "banner-abajo7" );
			?>
		  	<div id="carousel-example-generic2" class="carousel slide" data-ride="carousel">
			  <!-- Indicators -->
			  <ol class="carousel-indicators">
			    <li data-target="#carousel-example-generic2" data-slide-to="0" class="active"></li>
			    <?php 
				if ( $imgn2 != '' ) {
				 echo '<li data-target="#carousel-example-generic2" data-slide-to="1"></li>';				    			 
				}
				?>
				<?php 
				if ( $imgn3 != '' ) {
				 echo '<li data-target="#carousel-example-generic2" data-slide-to="2"></li>';				    			 
				}
				?>
				<?php 
				if ( $imgn4 != '' ) {
				 echo '<li data-target="#carousel-example-generic2" data-slide-to="3"></li>';				    			 
				}
				?>
				<?php 
				if ( $imgn5 != '' ) {
				 echo '<li data-target="#carousel-example-generic2" data-slide-to="4"></li>';				    			 
				}
				?>
				<?php 
				if ( $imgn6 != '' ) {
				 echo '<li data-target="#carousel-example-generic2" data-slide-to="5"></li>';				    			 
				}
				?>
				<?php 
				if ( $imgn7 != '' ) {
				 echo '<li data-target="#carousel-example-generic2" data-slide-to="6"></li>';				    			 
				}
				?>
			  </ol>

			  <!-- Wrapper for slides -->
			  <div class="carousel-inner" role="listbox">

			    <div class="item active">
			      <img src="<?php echo $imgn1; ?>">
			    </div>
				<?php
				if ( $imgn2 != '' ) {
				 echo '<div class="item"><img src="'.$imgn2.'" ></div>';
				}
				?>
				<?php
				if ( $imgn3 != '' ) {
				 echo '<div class="item"><img src="'.$imgn3.'" ></div>';
				}
				?>
				<?php 
				if ( $imgn4 != '' ) {
				 echo '<div class="item"><img src="'.$imgn4.'" ></div>';
				}
				?>
				<?php 
				if ( $imgn5 != '' ) {
				 echo '<div class="item"><img src="'.$imgn5.'" ></div>';
				}
				?>
				<?php 
				if ( $imgn6 != '' ) {
				 echo '<div class="item"><img src="'.$imgn6.'" ></div>';
				}
				?>
				<?php 
				if ( $imgn7 != '' ) {
				 echo '<div class="item"><img src="'.$imgn7.'" ></div>';
				}
				?>
			  
			    
			  </div>

			  <!-- Controls -->
			  <a class="left carousel-control" href="#carousel-example-generic2" role="button" data-slide="prev">
			    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
			  </a>
			  <a class="right carousel-control" href="#carousel-example-generic2" role="button" data-slide="next">
			    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			  </a>
			</div>
		</div>
	</div>

	<!-- TINBOX -->
	<div class="container-fluid tinbox">
		<div class="row etiqueta text-center">
			<img src="<?php echo get_template_directory_uri(); ?>/images/tinbox-cuadro.png">
		</div>
		<div class="container">
			<div class="row ">
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id orci nec felis tempor dictum. Donec ullamcorper, mauris egestas fermentum tempus, nulla purus tincidunt sapien, quis eleifend elit massa sed dui. Praesent vel nisl et eros tristique egestas. Cras a vehicula sapien. Donec porttitor nisl at mi ultrices, aliquam fringilla orci varius. Nulla consectetur tincidunt justo ac vestibulum. Etiam non nisl sed erat rutrum placerat.</p>
			</div>
			<div class="row iconos" id="iconos">
				<div class="col-md-2 col-md-offset-3 col-sm-4 col-xs-12 ico">
					<img src="<?php echo get_template_directory_uri(); ?>/images/ico-calidad.png" class="img-responsive">
					<p>CALIDAD</p>
					<hr>
					<p>Checa nuestro catálogo y elige tu calendario o libreta ideal.</p>
				</div>
				<div class="col-md-2 col-sm-4 col-xs-12 ico">
					<img src="<?php echo get_template_directory_uri(); ?>/images/ico-compromiso.png" class="img-responsive">
					<p>ENTUSIASMO</p>
					<hr>
					<p>Checa nuestro catálogo y elige tu calendario o libreta ideal.</p>
				</div>
				<div class="col-md-2 col-sm-4 col-xs-12 ico">
					<img src="<?php echo get_template_directory_uri(); ?>/images/ico-entusiasmo.png" class="img-responsive">
					<p>COMPROMISO</p>
					<hr>
					<p>Checa nuestro catálogo y elige tu calendario o libreta ideal.</p>
				</div>
			</div>
		</div>
		<div class="pajarito">
			<img src="<?php echo get_template_directory_uri(); ?>/images/pajarito.png">
		</div>
	</div>

	<!-- CONTACTO -->
	<div class="container contacto">
		<div class="row">
			<h1 id="titulo4">Contacto</h1>
		</div>
		
			<?php echo do_shortcode('[contact-form-7 id="65" title="Formulario de contacto"]'); ?>	 		  
		
	</div>

	<!-- NEWSLETTER -->

	<div class="container-fluid news">
		<div class="container">
			<div class="col-md-4">
				<span>Suscríbete</span>
				<p>Recibe noticias y promociones de nuestros productos</p>
			</div>
			<div class="col-md-8">

				<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Widget de Newsletter')) : ?>
				<?php endif; ?>
				
			</div>
		</div>
	</div>

	

<?php get_footer(); ?>
