	<footer class="container-fluid">
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-sm-4 col-xs-6">
					<img src="<?php echo get_template_directory_uri(); ?>/images/logo-tinbox-fotter.png" id="imagenfooter">
				</div>
				<div class="col-md-3 col-sm-4 col-xs-6 borde-r">
					
						<?php
	                		wp_nav_menu( array( 'theme_location' => 'segundo', 'container' => '', 'items_wrap' => '<ul class="menu-fot"><li>Información</li>%3$s</ul>' ) );
	                	?>
						
				</div>
				<div class="col-md-3 col-sm-4 col-xs-6 borde-r">
					
						<?php
	                		wp_nav_menu( array( 'theme_location' => 'tercero', 'container' => '', 'items_wrap' => '<ul class="menu-fot"><li>Nuestros productos</li>%3$s</ul>' ) );
	                	?>
					
				</div>
				<div class="col-md-3 col-sm-4 col-xs-6">
					
					<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Direccion en footer')) : ?>
					<?php endif; ?>
					
				</div>
			</div>
		</div>
		<div class="row copy">
			<div class="container">
				<div class="row">
					<div class="col-md-1 col-sm-4 col-xs-12">
						©Tinbox2015
					</div>
					<div class="col-md-3 col-md-offset-8 col-sm-8 col-xs-12 text-right">
						Realizado por: <a href="http://estrategasdigitales.com/" target="_blank">Estrategas Digitales</a>
					</div>
				</div>
			</div>
		</div>
	</footer>


  

<script type="text/javascript">

	$(document).ready(function($) {
        //Horizontal Tab
        $('#parentHorizontalTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true, // 100% fit in a container
            tabidentify: 'hor_1', // The tab groups identifier
            activate: function(event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#nested-tabInfo');
                var $name = $('span', $info);
                $name.text($tab.text());
                $info.show();
            }
        });
        $('#parentHorizontalTab2').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true, // 100% fit in a container
            tabidentify: 'tamanos', // The tab groups identifier
            activate: function(event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#nested-tabInfo');
                var $name = $('span', $info);
                $name.text($tab.text());
                $info.show();
            }
        });        
    });

    $(document).ready(function() {
    	var $alto = $('.navbar-collapse').height();    	
    	$('ul.nav, ul.nav li, ul.nav li a, .buscar-carrito').css({'height':$alto});
    });
    $('.producto').hover(function() {
    	/* Stuff to do when the mouse enters the element */
    	$(this).find('.boton').stop().animate({'opacity':'1'}, 200, function(){});
    }, function() {
    	/* Stuff to do when the mouse leaves the element */
    	$(this).find('.boton').stop().animate({'opacity':'0'}, 200, function(){});
    });
    $(document).ready(function() {
    	setTimeout(function(){
        var alt = $('iframe#mis_listas').contents().height();
    	// alert(alt);
    	$("iframe#mis_listas").height(alt);

    	$("iframe#mis_listas").contents().find(".modal-dialog").addClass("ancho");     
        }, 1000);
    

    



    });
   	
    
    
    	
	    $('div.diseno').click(function() {
	    	setTimeout(function(){
	          var altom = $('.modal[aria-hidden="false"] .modal-dialog').outerHeight();
	          var altoheader = $('.modal[aria-hidden="false"] .modal-dialog .modal-header').outerHeight();
	    	  
	          $('.modal[aria-hidden="false"] .modal-dialog .azul-izq').css({'height':altom-altoheader});
	    	  }, 200);	
	    

    });

	$('.recibe span').click(function() {
		var point = $('.news').offset();

		$('html, body').animate({
        	scrollTop: point.top
    	}, 1200,'easeOutCubic');
		
	});


</script>

<script src="<?php echo get_template_directory_uri(); ?>/js/animaciones.js" type="text/javascript"></script>


<?php wp_footer(); ?>

</body>
</html>
