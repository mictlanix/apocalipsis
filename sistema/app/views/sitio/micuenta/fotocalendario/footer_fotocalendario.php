<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>




    <!--para conversion a base64.encode y base64.decode -->
    <script src="<?php echo base_url(); ?>js/base64/jquery.base64.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>js/base64/jquery.base64.min.js" type="text/javascript"></script>


    <!-- Mi estilo 
      <link rel="stylesheet" href="<?php echo base_url();?>css/fotocalendario/estilo.css">
    -->
    <link rel="stylesheet" href="<?php echo base_url();?>css/fotocalendario/principal/estilo.css">

 

      <!-- Estilo del calendario -->
    <link rel="stylesheet" href="<?php echo base_url();?>css/fotocalendario/fotocalendario/calendarioEventos.css">

    <!-- Plugins dependiente para mostrar las fechas -->
    <script src="<?php echo base_url(); ?>js/fotocalendario/fotocalendario/moment.js" type="text/javascript"></script>

    <script src="<?php echo base_url(); ?>js/micuenta/fotocalendario/estrategas.calendarioEventos.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>js/micuenta/fotocalendario/calendario.js" type="text/javascript"></script>
   <script src="<?php echo base_url(); ?>js/micuenta/fotocalendario/sistema.js" type="text/javascript"></script>



<?php //wp_footer(); ?>

  <script src="<?php echo get_template_directory_uri(); ?>/js/base64/jquery.base64.js" type="text/javascript"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/base64/jquery.base64.min.js" type="text/javascript"></script>



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

    $(document).ready(function($) {
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

</script>


<?php //wp_footer(); ?>

</body>
</html>




    
    
    
