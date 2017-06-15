<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
      <aside class="col-md-2 col-sm-3 col-xs-12">
      
          <h4 class="form-control-static">TUS CALENDARIOS</h4>
           

                     
          <?php 
             if ($datos) {
              $ant_cons = -1;
              $ant_diseno = -1;


              foreach ($datos as $llave => $dato) { 
                //print_r($llave+1);
                  if (($dato->consecutivo != $ant_cons) or ($dato->id_diseno != $ant_diseno)) {
                        
                        if (( $ant_cons!=-1) ) {
                          //echo '=========== <br/>';
                            ?>    
                                </div>
                                 
                            <?php      
                        }  

                        $ant_cons = $dato->consecutivo;
                        $ant_diseno = $dato->id_diseno;
                        //print_r('-----------------');
                    ?>    
                        <div class="row cuadromio" value="<?php echo $dato->id_tamano; ?>" diseno="<?php echo $dato->id_diseno; ?>" consecutivo="<?php echo $dato->consecutivo; ?>">
                    <?php      
                        echo '<img src="'.$dato->imagen_diseno.'" style="border:1px solid #c1c1c1; width:100%">'; 
                       
                  }
          ?>
                  
                  <div class="row cuadro_slider bloque" posicion="<?php echo $llave+1;?>" value="<?php echo $dato->id_tamano; ?>" diseno="<?php echo $dato->id_diseno; ?>" consecutivo="<?php echo $dato->consecutivo; ?>">
            						<div class="col-md-12" style="margin-bottom:15px">
                  						<?php 
                                     if ($dato->image_link) {
                                        echo '<img src="'.$dato->image_link.'" style="border:1px solid #c1c1c1; width:100%">';
                                     } else {
                                        echo '<img src="'.$dato->imagen_diseno.'" style="border:1px solid #c1c1c1; width:100%">'; 
                                     }

                               ?>
                  						<p><b>Modelo:</b></p>
                  						<p>                   
                              <?php echo $dato->nombre_diseno; ?>
                              </p>                      
                              <?php //echo $dato->id_tamano; ?>
                              <p><b>Tamaño:</b></p>
                              <p>                     
                              <?php echo $dato->descripcion_tamano; ?>
                              </p>                      
                              <?php //echo $dato->consecutivo; ?>
                        </div> 
						
                        <div class="col-md-4 col-sm-4 col-xs-4 text-center">
                           <button disabled  value="<?php echo $dato->id_tamano; ?>" diseno="<?php echo $dato->id_diseno; ?>" consecutivo="<?php echo $dato->consecutivo; ?>"  type="button" class="editar_slider btn btn-success ttip" title="Editar"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
                        </div>                              
						
						            <div class="col-md-4 col-sm-4 col-xs-4 text-center">
                           <button disabled value="<?php echo $dato->id_tamano; ?>" diseno="<?php echo $dato->id_diseno; ?>" consecutivo="<?php echo $dato->consecutivo; ?>" type="button" class="previo_slider btn btn-info ttip" title="Previsualizar"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button>
                        </div>  

                        <div class="col-md-4 col-sm-4 col-xs-4 text-center">
                           <button value="<?php echo $dato->id_tamano; ?>" diseno="<?php echo $dato->id_diseno; ?>" consecutivo="<?php echo $dato->consecutivo; ?>" type="button" class="eliminar_slider btn btn-danger ttip" title="Eliminar"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                        </div>      

                      
                  </div>


          <?php 
            }  //fin del foreach
            //echo '=========== <br/>';
          ?>    
              </div>
             
          <?php      
          } //fin del if
          ?>
                             
       </aside>   



      <!-- Modal no lista-->

      <div class="modal fade" id="modaleliminar_tamano" role="dialog" >  
        <div class="modal-dialog">
              <div class="modal-content">

                  <?php $this->load->view( 'sitio/calendarios/fotocalendario/modaleliminar_tamano' ); ?>
              </div>
          </div>
      </div>  




