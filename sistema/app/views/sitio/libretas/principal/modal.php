<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php
global $product;  //este es para el caso de las imagenes
$nombre_meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
?>


<div class="modal fade bs-example-modal-lg modal_prod" id="modalMessage<?php echo get_the_ID(); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
       <div valor="<?php echo get_the_ID() ?>" class="modal-content">
            <!--  boton de cerrar -->
            <a class="close" data-dismiss="modal">&times;</a>
            <!--  Encabezado -->
            <div class="modal-header">
                <h3 class="text-left">Características del producto</h3>
            </div>
            <!--  Cuerpo -->
            <div class="modal-body">
                  <!--  row1 -->              
                  <div class="row">


                            <!-- Izquierda -->
                            <div class="col-md-6 col-sm-6 col-xs-6 azul-izq">
                                   <!-- Imagen con su titulo --> 
                                   <div class="row">
                                      <div class="col-md-12 thumb">
                                            <img src="<?php  the_post_thumbnail_url() ?>" class="img-responsive img-diseno">
                                            <?php 
                                              //get_post_thumbnail( get_the_ID() );
                                              echo '<p class="nombre">';
                                                   the_title();                                              
                                              echo '</p>';

                                            ?>
                                      </div>
                                  </div>
                                  <div class="row">
                                     	<div class="col-md-12">
                                     		<p>Incluye:</p>
                                     		<p>Tu nombre en cada página interior o el de quien quieras.</p>
  								  	               </div>
                  								  	<div class="col-md-12 colores">
                  								  		<h4 class="text-left">ELIGE EL COLOR</h4>
                                                     		<?php do_action("woocommerce_tm_epo_fields"); ?>
                                                        <?php do_action("woocommerce_tm_epo_totals"); ?>
                                                        
                  								  	</div>
                								  </div>
                              </div>  <!--  fin de Izquierda -->       



                            <!-- Derecha -->
                             <div class="col-md-6 col-sm-6 col-xs-6 blanco-der">
                                  <div class="notif-cont"> 
                                            <i class="fa fa-book"></i><span class="notificacion"></span><span class="cs">LIBRETAS SELECCIONADAS</span>    
                                  </div>

                                  


                                  <?php //wc_get_template_part( 'content', 'product' ); ?>

                                  <?php
                                          //do_action( 'woocommerce_after_single_product_summary' ); 
                                         //do_action( 'woocommerce_before_single_product_summary' ); 
                                         do_action( 'woocommerce_single_product_summary' );
                                         //do_action( 'msld_before_single_product_tab' ); 
                                         
                                         //do_action("woocommerce_tm_epo");
                                         
                                         do_action("woocommerce_tm_epo_fields");

                                         do_action("woocommerce_tm_epo_totals");

                                  ?>
	                                 
                                   <div class="adicional<?php echo get_the_ID(); ?>"> </div>
                                  <div class="alert" id="messagesModal"></div>
                                  <!--  Agregar otro diseño y continuar -->                                               
                                  <div class="modal-footer">
                                            <button class="btn btn-default agregar_cancelar" value="<?php echo get_the_ID() ?>" id="agregar_cancelar"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Agregar Otro diseño<span class="fc"> de libreta</span></button><br>
                                            <button disabled class="btn btn-danger continuar" value="<?php echo get_the_ID() ?>">Continuar<span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></button>                                        
                                  </div>

                            </div>  <!--  fin de Derecha -->       


           
                  </div>  <!--  fin del row1 -->              


            </div>  <!--  fin del Cuerpo -->
                                      
       </div>  <!--  fin del content -->
    </div> <!--  fin del dialogo -->
</div>  <!--  fin de la modal -->

<style>
  .tm-extra-product-options input.use_images:checked + label .radio_image, .tm-extra-product-options input.use_images:checked + label .checkbox_image {
      border-color: #75cacf;
      /* border-width: 1px; */
  }
</style>
