<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $nom_mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");?>
<div class="col-md-12"> 
  <?php 
             if ($datos) {
              foreach ($datos as $dato) { 
  ?>
                       
       <div class="panel-group" class="" 
                id="accordion<?php echo $dato->id_diseno; ?>" 
                variacion="<?php echo $dato->variation_id; ?>"
                consecutivo="<?php echo $dato->consecutivo; ?>"
                role="tablist" aria-multiselectable="true">
          
          <div class="panel panel-default miacordion desc">

            <!--titulo  -->
            <div class="panel-heading" role="tab" 
                        id="<?php echo $dato->variation_id; ?>"
                    variacion="<?php echo $dato->variation_id; ?>"
                consecutivo="<?php echo $dato->consecutivo; ?>" >

              <h4 class="panel-title">
                <a role="button" data-toggle="collapse" 
                        data-parent="#accordion<?php echo $dato->id_diseno.$dato->variation_id.$dato->consecutivo; ?>" 
                        href="#colapsa<?php echo $dato->id_diseno.$dato->variation_id.$dato->consecutivo; ?>" 
                        aria-expanded="true" 
                        aria-controls="colapsa<?php echo $dato->id_diseno.$dato->variation_id.$dato->consecutivo; ?>">
                        
                        <div class="row">
                           <div class="col-md-4 col-sm-3 col-xs-8 mb-10 detalle">
                           		<div>                          
                                <?php 
                                  echo '<img src="'.$dato->imagen_diseno.'" style="border:1px solid #c1c1c1; width:100%">';
                                 ?>
                             	</div>
                             	<div>
                                 <?php //echo '<b>Modelo:</b><br>'.$dato->id_diseno.'<br>'.'<b>Tamaño:</b><br>'.$dato->descripcion_variacion; ?>
                                 <p><b>Modelo:</b></p>
	                              <p><?php echo $dato->nombre_diseno; ?></p>                      
	                              <p><b>Tamaño:</b></p>
	                              <p><?php echo $dato->descripcion_tamano; ?></p>                      
	                              <p><b>Interior:</b></p>
	                              <p><?php echo $dato->descripcion_interior; ?></p>
	                              <p><b>Núm Hojas:</b></p>
	                              <p><?php echo $dato->descripcion_num_hojas; ?></p>                      
								  <p><b>Color:</b></p>
	                              <p><?php echo $dato->descripcion_color; ?></p>
	                              <p><b>Adicionales:</b></p>
	                              <p><?php echo $dato->descripcion_adicionales; ?></p>
                            	</div>



                                 
                            </div>                              



                            <div class="col-md-2 col-sm-4 col-xs-12 mb-10">
                               <button value="<?php echo $dato->id_diseno; ?>" 
                                              variacion="<?php echo $dato->variation_id; ?>"
                                              consecutivo="<?php echo $dato->consecutivo; ?>"
                                type="button" class="editar_slider btn btn-success btn-block ttip" title="este es el tooltip."><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>Editar</button>
                            </div>                              


                            <div class="col-md-2 col-sm-4 col-xs-12 mb-10">
                               <button value="<?php echo $dato->id_diseno; ?>" 
                                              variacion="<?php echo $dato->variation_id; ?>"
                                              consecutivo="<?php echo $dato->consecutivo; ?>"
                                type="button" class="previo_slider btn btn-info btn-block ttip" title="este es el tooltip."><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>Previsualizar</button>
                            </div>

                            <div class="col-md-2 col-sm-4 col-xs-12 mb-10">
                               <button value="<?php echo $dato->id_diseno; ?>" 
                                              variacion="<?php echo $dato->variation_id; ?>"
                                              consecutivo="<?php echo $dato->consecutivo; ?>"
                                     type="button" class="eliminar_slider btn btn-danger btn-block ttip" title="este es el tooltip."><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>Eliminar</button>
                            </div> 

                            <div class="col-md-2 col-sm-4 col-xs-12 mb-10">
                               <button disabled value="<?php echo $dato->id_diseno; ?>" 
                                              variacion="<?php echo $dato->variation_id; ?>"
                                              consecutivo="<?php echo $dato->consecutivo; ?>"
                                              cantidad="<?php echo $dato->cantidad; ?>"
                                              nombre="<?php echo $dato->nombre_variacion; ?>"
                                              checando="check<?php echo $dato->id_diseno.$dato->variation_id.$dato->consecutivo; ?>"
                                type="button" marcado="no" class="agregar_carrito btn btn-default btn-block ttip" title="este es el tooltip."><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Agregar al carrito</button>
                            </div>


                        </div> <!--  <div class="row"> -->

                </a>
              </h4>
            </div> <!--class="panel-heading" role="tab"  -->


            <!--contenido -->


            <?php if  ( (($id_diseno=="undefined")) && ($i==1) ) {  ?>  
                  <div id="colapsa<?php echo $dato->id_diseno.$dato->variation_id.$dato->consecutivo; ?>" class="panel-collapse collapse-in" role="tabpanel" aria-labelledby="<?php echo $dato->id_diseno.$dato->variation_id.$dato->consecutivo; ?>">
            <?php } elseif   (($dato->id_diseno==$id_diseno) and ($dato->variation_id==$variation_id)  and ($dato->consecutivo==$consecutivo)  )   { ?>            
                  <div id="colapsa<?php echo $dato->id_diseno.$dato->variation_id.$dato->consecutivo; ?>" class="panel-collapse collapse-in" role="tabpanel" aria-labelledby="<?php echo $dato->id_diseno.$dato->variation_id.$dato->consecutivo; ?>">
            <?php } else { ?>    
                  <div id="colapsa<?php echo $dato->id_diseno.$dato->variation_id.$dato->consecutivo; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="<?php echo $dato->id_diseno.$dato->variation_id.$dato->consecutivo; ?>"> 
            <?php } ?>    

                          <div class="panel-body">
                          	<div class="row">
                          		<div class="col-md-3"> 
                                    <h4 class="text-left">Generales</h4>
                                    <p><b>Número de Copias:</b> <?php echo $dato->cantidad; ?></p>
                                    <p><b>Título:</b> <?php echo $dato->titulo; ?></p>
                                    <p><b>Nombre:</b> <?php echo $dato->nombre; ?></p>
                                    <p><b>Apellido:</b> <?php echo $dato->apellidos; ?></p>
                                </div>     
								
								<div class="col-md-3"></div>
								<div class="col-md-3"></div>
                             
                          
                              <div class="col-md-3">  
                              
                                          <form class="ac-custom ac-checkbox ac-checkmark" autocomplete="off">
                                                <ul>
                                                  <li>
                                                    <input class="checando" id="check<?php echo $dato->id_diseno.$dato->variation_id.$dato->consecutivo; ?>" name="check<?php echo $dato->id_diseno.$dato->variation_id.$dato->consecutivo; ?>" type="checkbox"><label for="cb6">He revisado mis datos e información</label></li>
                                                <ul>
                                            </form>

                                      
                              </div> 

                            </div> <!-- row -->


                          </div>

                 </div>

          




       </div> <!--<div class="panel panel-default miacordion desc"> -->
</div>  <!--panel panel-default miacordion desc"> -->
  <?php } }?>   
          
   
   </div>  <!--col-12 -->


<div class="container">
           <div class="row" style="clear:both">
                 <div class="col-md-10">  
                    <!--
                    <div class="checkbox">
                      <label for="coleccion_id_operaciones" class="ttip" title="He revisado mis datos e información">
                                <input disabled type="checkbox"  value="" name="chequeo_dato" id="chequeo_dato" >
                                He revisado mis datos e información
                      </label>
                    </div>
                    -->
                </div>    

                <div class="row">
                    <div class="col-md-10"></div>
                    <div class="col-md-2">
                          <!-- <button id="guardar" type="button" class="btn btn-success continuar">continuar<span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></button>-->
                          
                    </div>
                </div> 
           </div>    
          <br/>
</div>           

<!-- Modal eliminar tamaño-->

<div class="modal fade" id="modaleliminar_variacion" role="dialog" >  
  <div class="modal-dialog">
        <div class="modal-content">
            <?php $this->load->view( 'sitio/fotolibretas/fotorevise/modaleliminar_variacion' ); ?>
        </div>
    </div>
</div>  
