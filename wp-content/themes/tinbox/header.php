<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Tinbox</title>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

   <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.form.min.js"></script>
   <!-- <script src="<?php echo get_template_directory_uri(); ?>/js/spin.min.js"></script> -->


<script src="<?php echo get_template_directory_uri(); ?>/js/easyResponsiveTabs.js"></script>

<!-- <script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.js"></script> -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/estilos.css">
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/font-awesome.css">

<!-- <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.css"> -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.css">

<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/easy-responsive-tabs.css " />
  <script src="<?php echo get_template_directory_uri(); ?>/js/base64/jquery.base64.js" type="text/javascript"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/base64/jquery.base64.min.js" type="text/javascript"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/introjs.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/animate.min.css" />
  <script src="<?php echo get_template_directory_uri(); ?>/js/noframework.waypoints.min.js" type="text/javascript"></script>
<?php wp_head(); ?>
</head>


<body>
	<!-- TOP -->
	<div class="container-fliud top">
		<div class="container">
		  <div class="row">
			<div class="col-md-4 col-sm-4 col-xs-6 recibe"><span>Recibe noticias y promociones de Tinbox</span></div>
			<div class="col-md-3 col-md-offset-5 col-sm-6 col-sm-offset-2 col-xs-6 redes text-right">
				<span class="cta">


					<?php echo do_shortcode('[ciusan_login redirect="current"]') ?>

					<?php echo do_shortcode('[ciusan_logout redirect="current"]') ?>
				</span>
				<span class="ic"><a href="https://www.facebook.com/TinboxMX"><i class="fa fa-facebook"></i></a></span>
				<span class="ic"><a href="https://twitter.com/TinboxMX"><i class="fa fa-twitter"></i></a></span>
			</div>
		  </div>
		</div>
	</div>
	<!-- MENU -->
	<div class="container-fluid">
		<div class="container">      
				
	      		<nav class="row navbar navbar-default">
				  <div class="container-fluid">
				    <!-- Brand and toggle get grouped for better mobile display -->
				    <div class="navbar-header">
				      <button type="button" class="navbar-toggle collapsed " data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				        <span class="sr-only">Toggle navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				      </button>
				      <a class="navbar-brand" href="<?php echo get_site_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo-timbox.png"></a>
				    </div>

				    <!-- Collect the nav links, forms, and other content for toggling -->
				    <div class="collapse navbar-collapse menu oculto" id="bs-example-navbar-collapse-1">
				    <?php
	                	wp_nav_menu( array( 'theme_location' => 'primero', 'container' => '', 'items_wrap' => '<ul class="nav navbar-nav">%3$s</ul>' ) );
	                ?>
				      
				 
					  
					  <div class="buscar-carrito">
					  	<div style="display:table-cell; vertical-align:middle">
							
							<span class="ic" id="carrito"><a href="<?php echo site_url(); ?>/carro"><i class="fa fa-shopping-cart"></i><span class="count"><?php echo WC()->cart->get_cart_contents_count(); ?></span></a></span>
						</div>
					  </div>

				    </div><!-- /.navbar-collapse -->
				  </div><!-- /.container-fluid -->
				</nav>

				
		</div>
	</div>