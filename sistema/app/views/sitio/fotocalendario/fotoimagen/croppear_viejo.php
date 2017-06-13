<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php //echo anchor('sitio/fotocalendario/fotoimagen/croppear/foo', 'Try it again!'); ?>



<?php 
get_header('sistema'); 
$this->load->view( 'sitio/fotocalendario/fotoimagen/header' ); ?>   

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
      <?php $this->load->view( 'sitio/fotocalendario/fotoimagen/navbar' ); ?> 
              


    	


      <?php $this->load->view( 'sitio/fotocalendario/fotoimagen/slider',$datos); ?>
      
      
      <div class="col-md-9 col-md-offset-1 col-sm-9 col-xs-12">
         <div id="foo"></div>
         
         
         <div class="alert" id="messages"></div>
         

<!--  componente de libreria de imagenes -->


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

<!-- Fin del componente de libreria de imagenes -->

      	<div id="meses" class="btn-group mb-20" style="width:100%">                  
              
            <button id="mes0" nmes="0" type="button" class="btn btn-success mes">Ene</button>
            <button id="mes1" nmes="1" type="button" class="btn btn-success mes">Feb</button>
            <button id="mes2" nmes="2" type="button" class="btn btn-success mes">Mar</button>
            <button id="mes3" nmes="3" type="button" class="btn btn-success mes">Abr</button>
            <button id="mes4" nmes="4" type="button" class="btn btn-success mes">May</button>
            <button id="mes5" nmes="5" type="button" class="btn btn-success mes">Jun</button>
            <button id="mes6" nmes="6" type="button" class="btn btn-success mes">Jul</button>
            <button id="mes7" nmes="7" type="button" class="btn btn-success mes">Ago</button>
            <button id="mes8" nmes="8" type="button" class="btn btn-success mes">Sep</button>
            <button id="mes9" nmes="9" type="button" class="btn btn-success mes">Oct</button>
            <button id="mes10" nmes="10" type="button" class="btn btn-success mes">Nov</button>
            <button id="mes11" nmes="11" type="button" class="btn btn-success mes">Dic</button>			
			<button id="mes_anterior" type="button" class="btn btn-success"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></button>
			<button id="mes_siguiente" type="button" class="btn btn-success"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></button>
        </div>

        <span class="help-block"><span>*</span>Més con imagen cargada</span>


        <h3 class="page-header text-left">Imagen:</h3>

         
        


       <!-- <p class="form-control-static">Arrastra una imagen en el siguiente cuadro para añadirla o reemplazar la actual.</p> -->
        <p class="form-control-static">Es necesario agregar una imagen para cada mes. Al finalizar da click en CONTINUAR</p> 
      


        <div id="drop-area">         
         

        
        </div>
 

    

      <div class="controles">
        <!-- <h3 class="page-header">Preview:</h3> -->
        <div class="docs-preview clearfix" style="display:none">
          <div class="img-preview preview-lg"></div>
          <div class="img-preview preview-md"></div>
          <div class="img-preview preview-sm"></div>
          <div class="img-preview preview-xs"></div>
        </div>

          <div class="row">
            <div class="col-md-12 docs-buttons">
             
              <div class="btn-group">
                <button type="button" class="btn btn-primary" data-method="zoom" data-option="0.1" title="Zoom In">
                  <span class="docs-tooltip" data-toggle="tooltip" title="Acercar">
                    <span class="fa fa-search-plus"></span>
                  </span>
                </button>
                <button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.1" title="Zoom Out">
                  <span class="docs-tooltip" data-toggle="tooltip" title="Alejar">
                    <span class="fa fa-search-minus"></span>
                  </span>
                </button>
              </div>
        
              <div class="btn-group">
                <button type="button" class="btn btn-primary" data-method="rotate" data-option="-45" title="Rotate Left">
                  <span class="docs-tooltip" data-toggle="tooltip" title="Rotar izquierda">
                    <span class="fa fa-rotate-left"></span>
                  </span>
                </button>
                <button type="button" class="btn btn-primary" data-method="rotate" data-option="45" title="Rotate Right">
                  <span class="docs-tooltip" data-toggle="tooltip" title="Rotar derecha">
                    <span class="fa fa-rotate-right"></span>
                  </span>
                </button>
              </div>
       
              <div class="btn-group">
                <button type="button" class="btn btn-primary" data-method="scaleX" data-option="-1" title="Flip Horizontal">
                  <span class="docs-tooltip" data-toggle="tooltip" title="Reflejar horizontal">
                    <span class="fa fa-arrows-h"></span>
                  </span>
                </button>
                <button type="button" class="btn btn-primary" data-method="scaleY" data-option="-1" title="Flip Vertical">
                  <span class="docs-tooltip" data-toggle="tooltip" title="Reflejar vertical">
                    <span class="fa fa-arrows-v"></span>
                  </span>
                </button>
              </div>
              
              <!--
                <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
                  <input type="file" class="sr-only" id="inputImage" name="file" accept="image/*">
                  <span class="docs-tooltip" data-toggle="tooltip" title="Subir una imagen">
                    <span class="fa fa-upload"></span>
                    SUBIR UNA IMAGEN
                  </span>
                </label>
              -->
                  <button id="guardar" style="display:none;" type="button" class="pull-right btn btn-success continuar">continuar<span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></button>
             </div><!-- /.docs-buttons -->
         </div> <!-- row -->










      </div> <!-- controles -->




                
        



    </div> <!-- col-md-9 -->

  

</div> <!-- container -->

<?php $this->load->view( 'sitio/fotocalendario/fotoimagen/footer' ); 
get_footer('sistema'); 
?>

<style type="text/css">
  ul li div.plupload_file_name {
    display:none !important;
  }
</style>


<script type="text/javascript">
	$(document).ready(function() {
		$('.navbar-nav li:nth-child(3)').addClass('current-menu-item')
	});
</script>
