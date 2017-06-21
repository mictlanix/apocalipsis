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
                                   
                                        <div class="col-md-12 thumb">
                                              <img src="<?php  the_post_thumbnail_url() ?>" class="img-responsive img-diseno">
                                              <?php 
                                                echo '<p class="nombre">';
                                                     the_title();
                                                echo '</p>';
                                              ?>
                                        </div>

                                        <!--galeria de 12 imagenes  -->
                                        <div class="row">
                                                <div class="col-md-12">
                                                  <p>Incluye:</p>
                                                  <p>Una imagen distinta por mes, cada una personalizada con tu nombre.</p>
                                                </div>
                                              <?php
                                               wc_get_template( 'single-product/migaleria-producto.php' ); ?>
                                       </div>

                                       <!-- Fotos especiales-->
                                        <div class="row">

                                          <?php

                                            if (!empty( get_post_meta( get_the_ID(),'logo_formulario' ,true) )) {
                                                  $logos= get_post_meta(get_the_ID(), 'logo_formulario', true );
                                                  $cadena = implode("-", $logos);
                                                  echo '<span style="display:none;" class="logos"  >'.$cadena.'</span>';
                                                                       
                                            }  


                                            if (!empty( get_post_meta( get_the_ID(),'icono_especial' ,true) )) {
                                                    $icono_especial = wp_get_attachment_image_src( get_post_meta(get_the_ID(), 'icono_especial', true ), 'thumbnail' );

                                                              echo '<div class="col-md-6 col-sm-6 col-xs-6 esp">';
                                                              echo '<p>Foto especial e ícono en mes de cumpleaños.</p>';
                                                              echo '<div class="img-galeria">';                     
                                                                echo '<img src="'.$icono_especial[0].'" class="img-responsive" style="float:left">';                                            

                                                       if (!empty( get_post_meta( get_the_ID(),'icono_mes' ,true) )) {
                                                          $img_icono_mes = wp_get_attachment_image_src( get_post_meta(get_the_ID(), 'icono_mes', true ), 'thumbnail' );
                                                             
                                                              echo '<div class="img-galeria" style="bottom: 0;position: absolute;right: 0;max-width: 70px;">                     
                                                                  <img src="'.$img_icono_mes[0].'" class="img-responsive" style="float:left"></div>';
                                                            
                                                       }    
                                                       echo '</div></div>';                                      
                                            }     


                                            if (!empty( get_post_meta( get_the_ID(),'imagen_referencial' ,true) )) {
                                                          $imagen_referencial = wp_get_attachment_image_src( get_post_meta(get_the_ID(), 'imagen_referencial', true ), 'thumbnail' );
                                                              echo '<div class="col-md-6 col-sm-6 col-xs-6 esp" style="border-left: 1px solid #cacaca;">';                                                     
                                                              echo '<p>Íconos especiales para fechas importantes del año.</p>';

                                                                 echo '<div class="img-galeria"><img src="'.           $imagen_referencial[0].'" class="img-responsive">';
                                                                echo '</div></div>';   
                                                            
                                            }                                      

                                                  ?>   
                                </div>             

                                   	  	<?php do_action("woocommerce_tm_epo_fields"); ?>
                                

                             </div>  <!--  fin de Izquierda -->       



                            <!-- Derecha -->
                             <div class="col-md-6 col-sm-6 col-xs-6 blanco-der">
                                  <div class="notif-cont"> 
                                            <i class="fa fa-calendar"></i><span class="notificacion"></span><span class="cs">FOTOCALENDARIOS SELECCIONADOS</span>    
                                  </div>

                                  <h4 class="text-left">ELIGE EL TAMAÑO</h4>
                                  <p>Puedes seleccionar más de un tamaño.</p>


                                  <?php //wc_get_template_part( 'content', 'product' ); ?>

                                   
                                   <div class="variacion_producto"> </div>
                                  <?php
                                        //tipos  de agendas
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
