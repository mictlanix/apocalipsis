<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php
global $product;  //este es para el caso de las imagenes
$nombre_meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
?>

<div class="modal fade bs-example-modal-lg modal_prod" id="modalMessage<?php echo get_the_ID(); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
       <div nombre="<?php echo the_title() ?>" valor="<?php echo get_the_ID() ?>" class="modal-content">
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
                                              echo '<span>Incluye:</span>';
                                              echo '</p>';
                                            ?>
                                      </div>
                                      <div class="col-md-12">
                                      	<h4 class="text-left">ELIGE EL COLOR</h4>
                                      	<?php do_action("woocommerce_tm_epo_fields"); ?>
                                      </div>
                                  </div>

                                 

                          </div>  <!--  fin de Izquierda -->       



                            <!-- Derecha -->
                             <div class="col-md-6 col-sm-6 col-xs-6 blanco-der">
                                  <div class="notif-cont"> 
                                            <i class="fa fa-calendar"></i><span class="notificacion"></span><span class="cs">FOTOAGENDAS SELECCIONADAS</span>    
                                  </div>

                                  <h4 class="text-left">ELIGE EL TAMAÑO</h4>
                                  <p>¡Selecciona varios tamaños al mismo tiempo!</p>


                                  <?php //wc_get_template_part( 'content', 'product' ); ?>

                                   
                                   <div class="variacion_producto"> </div>
                                  <?php
                                        //tipos  de fotoagendas
                                         echo '<div class="prod_oculto" style="display:none;">';
                                           do_action( 'woocommerce_single_product_summary' );
                                         echo '</div>';
                                          do_action("woocommerce_tm_epo_fields");

                                  ?>

                                  <div class="alert" id="messagesModal"></div>
                                  <!--  Agregar otro diseño y continuar -->                                               
                                  <div class="modal-footer">
                                            <button class="btn btn-default agregar_cancelar" value="<?php echo get_the_ID() ?>" id="agregar_cancelar"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Agregar Otro diseño<span class="fc"> de fotocalendario</span></button><br>
                                            <button disabled class="btn btn-danger continuar" value="<?php echo get_the_ID() ?>">Continuar<span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></button>                                        
                                  </div>

                            </div>  <!--  fin de Derecha -->       


           
                  </div>  <!--  fin del row1 -->              


            </div>  <!--  fin del Cuerpo -->
                                      
       </div>  <!--  fin del content -->
    </div> <!--  fin del dialogo -->
</div>  <!--  fin de la modal -->
