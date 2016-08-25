<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php 
get_header('sistema'); 
$this->load->view( 'sitio/fotocalendario/fotocarga/header' ); ?>   

<span style="display:none">
<input type="text" id="id_session" name="id_session" value="<?php echo $id_session; ?>" >
<input type="text" id="id_diseno" name="id_diseno" value="<?php echo $id_diseno; ?>" >
<input type="text" id="id_tamano" name="id_tamano" value="<?php echo $id_tamano; ?>" >
<input type="text" id="consecutivo" name="consecutivo" value="<?php echo $consecutivo; ?>" >
<input type="text" id="ano" name="ano" value="<?php echo $ano; ?>" >
<input type="text" id="mes" name="mes" value="<?php echo $mes; ?>" >
<input type="text" id="mesclick" name="mesclick" value="" >
</span>

  <!-- Content -->
   
  <div class="container">

      <?php $this->load->view( 'sitio/fotocalendario/fotocarga/navbar' ); ?> 
              


    	


      <?php $this->load->view( 'sitio/fotocalendario/fotocarga/slider',$datos); ?>
      
      
      <div class="col-md-9 col-md-offset-1 col-sm-9 col-xs-12">

        <h3 class="page-header text-left">Biblioteca de Imagenes:</h3>


       <!-- <p class="form-control-static">Arrastra una imagen en el siguiente cuadro para añadirla o reemplazar la actual.</p> -->
        <p class="form-control-static">Es necesario agregar una imagen para cada mes. Al finalizar da click en CONTINUAR</p> 



<div id="console"></div>

<div id="drop-target">
  
</div>

<form id="form" method="post" action="../dump.php">

  
  <div id="uploader" >

    <p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
  </div>
  <br />
  <input type="submit" value="Submit" />

</form>

<div id="listaimagenes"></div>

<div id="imagenes"></div>

<br />
    


                
        



    </div> <!-- col-md-9 -->

  

</div> <!-- container -->

<?php $this->load->view( 'sitio/fotocalendario/fotocarga/footer' ); 
get_footer('sistema'); 
?>

<script type="text/javascript">
	$(document).ready(function() {
		$('.navbar-nav li:nth-child(3)').addClass('current-menu-item')
	});
</script>
