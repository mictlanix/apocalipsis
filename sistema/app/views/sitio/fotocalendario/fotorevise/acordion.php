<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $nom_mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");?>
<div class="col-md-12">
  <?php 
  $i=0;
             if ($datos) {
              foreach ($datos as $dato) { 
                $i++;
  ?>
                        
       <div class="panel-group" class="" 
                id="accordion<?php echo $dato->id_diseno; ?>" 
                tamano="<?php echo $dato->id_tamano; ?>"
                consecutivo="<?php echo $dato->consecutivo; ?>"
                role="tablist" aria-multiselectable="true">
          
          <div class="panel panel-default miacordion desc">

            <!--titulo  -->
            <div class="panel-heading" role="tab" 
                        id="<?php echo $dato->id_tamano; ?>"
                    tamano="<?php echo $dato->id_tamano; ?>"
                consecutivo="<?php echo $dato->consecutivo; ?>" >

              <h4 class="panel-title">

                        <div class="row">                       

                           <div class="col-md-4 col-sm-3 col-xs-4 mb-10 detalle">
                              <div>                          
                                 <img src="<?php echo $dato->imagen_diseno; ?>" style="border:1px solid #c1c1c1; width:100%">
                                 <img src="<?php echo $dato->image_link; ?>" style="border:1px solid #c1c1c1; width:100%">
                              </div>                           
                           		
                             	<div>
                                 <?php echo '<b>Nombre:</b><br>'.$dato->nombre_diseno.'<br>'.'<b>Tamaño:</b><br>'.$dato->descripcion_tamano; ?>
                            	</div>
                            </div>                              

							

							<div class="col-md-8 col-sm-9 col-xs-8 ">

	                            <div class="col-md-4 col-sm-4 col-xs-12 mb-10">
	                               <button value="<?php echo $dato->id_diseno; ?>" 
	                                              tamano="<?php echo $dato->id_tamano; ?>"
	                                              consecutivo="<?php echo $dato->consecutivo; ?>"
	                                type="button" class="editar_slider btn btn-success btn-block ttip" title="este es el tooltip."><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>Editar</button>
	                            </div>                              
                                                         

	                            <div class="col-md-4 col-sm-4 col-xs-12 mb-10">
	                               <button value="<?php echo $dato->id_diseno; ?>" 
	                                              tamano="<?php echo $dato->id_tamano; ?>"
	                                              consecutivo="<?php echo $dato->consecutivo; ?>"
	                                     type="button" class="eliminar_slider btn btn-danger btn-block ttip" title="este es el tooltip."><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>Eliminar</button>
	                            </div>

	                            <div class="col-md-4 col-sm-4 col-xs-12 mb-10">
	                               <button  disabled
	                               				  value="<?php echo $dato->id_diseno; ?>" 
	                                              tamano="<?php echo $dato->id_tamano; ?>"
	                                              consecutivo="<?php echo $dato->consecutivo; ?>"
	                                              cantidad="<?php echo $dato->cantidad; ?>"
	                                              nombre="<?php echo $dato->nombre_tamano; ?>"
	                                              checando="check<?php echo $dato->id_diseno.$dato->id_tamano.$dato->consecutivo; ?>"
	                                			  type="button" marcado="no" class="agregar_carrito btn btn-default btn-block ttip" title="este es el tooltip."><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
	                                			  Agregar al carrito
	                                </button>
	                            </div> 


								<div class="col-md-12 col-sm-12 col-xs-12">
									<hr>
								</div>
								 


	                            <div class="col-md-12 col-sm-12 text-right">                               

	                                <form class="ac-custom ac-checkbox ac-checkmark" autocomplete="off">
					                	<ul>
					                		<li>
					                			<input class="checando" id="check<?php echo $dato->id_diseno.$dato->id_tamano.$dato->consecutivo; ?>" name="check<?php echo $dato->id_diseno.$dato->id_tamano.$dato->consecutivo; ?>" type="checkbox"><label for="cb6">He revisado mis datos e información</label>
					                		</li>
					                	<ul>
					                </form>

	                            </div>
	                           

	                			<div class="col-md-12 col-sm-12 col-xs-12">
									<hr>
								</div>

	                			<div class="col-md-4 col-md-offset-8 col-sm-4 col-sm-offset-8 text-right">
	                				<button role="button" data-toggle="collapse" 
					                        data-parent="#accordion<?php echo $dato->id_diseno.$dato->id_tamano.$dato->consecutivo; ?>" 
					                        href="#colapsa<?php echo $dato->id_diseno.$dato->id_tamano.$dato->consecutivo; ?>" 
					                        aria-expanded="true" 
					                        aria-controls="colapsa<?php echo $dato->id_diseno.$dato->id_tamano.$dato->consecutivo; ?>"
					                        class="agregar_carrito btn btn-warning btn-block">
					                        <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
					                        Ver características
					                </button> 
	                			</div>

                			</div>




                        </div> <!--  <div class="row"> -->




                
              </h4>
            </div> <!--class="panel-heading" role="tab"  -->



            <!--contenido -->

            <?php if  ( (($id_diseno=="undefined")) && ($i==1) ) {  ?>  
                  <div id="colapsa<?php echo $dato->id_diseno.$dato->id_tamano.$dato->consecutivo; ?>" class="panel-collapse collapse-in" role="tabpanel" aria-labelledby="<?php echo $dato->id_diseno.$dato->id_tamano.$dato->consecutivo; ?>">                
            <?php } elseif   (($dato->id_diseno==$id_diseno) and ($dato->id_tamano==$id_tamano)  and ($dato->consecutivo==$consecutivo)  )   { ?>            
                  <div id="colapsa<?php echo $dato->id_diseno.$dato->id_tamano.$dato->consecutivo; ?>" class="panel-collapse collapse-in" role="tabpanel" aria-labelledby="<?php echo $dato->id_diseno.$dato->id_tamano.$dato->consecutivo; ?>">
            <?php } else { ?>    
                  <div id="colapsa<?php echo $dato->id_diseno.$dato->id_tamano.$dato->consecutivo; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="<?php echo $dato->id_diseno.$dato->id_tamano.$dato->consecutivo; ?>"> 
            <?php } ?>    

                          <div class="panel-body">
                        <div class="row">              
                             <div class="col-md-3 col-sm-3 col-xs-12">
                                                <h4 class="text-left">Generales</h4>
                                                <p><b>Número de Copias:</b> <?php echo $dato->cantidad; ?></p>
                                                <p><b>Título: </b><?php echo $dato->titulo; ?></p>                                    
                                                <p><b>Nombre: </b><?php echo $dato->nombre; ?></p>                                    
                                                <p><b>Apellido: </b><?php echo $dato->apellidos; ?></p>                                    
                                                <p><b>Cumpleaños: </b><?php echo str_pad($dato->id_dia, 2, "0", STR_PAD_LEFT).'/'.str_pad($dato->id_mes, 2, "0", STR_PAD_LEFT).'/'.date("Y"); ?></p>
            								</div>

            								<div class="col-md-3 col-sm-3 col-xs-12">
                                                <!-- estas son las "FECHAS ESPECIALES" -->
                                                 <?php if ($fechas_especiales) {
                                                     echo '<h4 class="text-left">FECHAS ESPECIALES</h4>';
                                                      foreach ($fechas_especiales as $fechas) { 
                                                        if   (($dato->id_diseno==$fechas->id_diseno) and ($dato->id_tamano==$fechas->id_tamano)  and  ($dato->consecutivo==$fechas->consecutivo)  )   
                                                        { 
                                                            
                                                              echo '<p>';
                                                              echo '<b>'.str_pad($fechas->dia, 2, "0", STR_PAD_LEFT).'/'.str_pad($fechas->mes, 2, "0", STR_PAD_LEFT).'/'.str_pad($fechas->ano, 4, "20", STR_PAD_LEFT).':</b>  '.$fechas->valor;
                                                          	  echo '</p>';
                                                          }
                                                      }}
                                                 ?>       
            								</div>
                          
            					
                      			<div class="col-md-3 col-sm-3 col-xs-12">
                                                 <!-- estos son los "MENSAJE DEL MES" -->
                                                 <?php if ($nombre_meses) {
                                                     echo '<h4 class="text-left">MENSAJE DEL MES</h4>';
                                                      foreach ($nombre_meses as $mes) { 
                                                        if   (($dato->id_diseno==$mes->id_diseno) and ($dato->id_tamano==$mes->id_tamano)  and 
                                                          ($dato->consecutivo==$mes->consecutivo)  )   { 
                                                            
                                                            echo '<p>';
                                                            echo '<b>'.$nom_mes[$mes->mes].':</b> '.$mes->valor;
                                                            echo '</p>';
                                                          }
                                                      }}
                                                 ?>       
            								</div>

                            <div class="col-md-3"  style="display:<?php echo ($informacion[0]->logo == "")  ? 'none': 'block'  ?>" >
                                  <h4 class="text-left">Logo</h4>
                                  <?php if ($informacion[0]->logo != "") { ?>
                                      <img src="<?php echo base_url().'uploads/fotocalendario/fotocalendario/'.$informacion[0]->logo; ?>" style="border:1px solid #c1c1c1; width:30%">
                                  <?php } ?>
                                  
                                  <p style="display:<?php echo (strpos($informacion[0]->coleccion_id_logo, "1") === false) ? 'none': 'block'  ?>"> Portada</p>
                                  <p style="display:<?php echo (strpos($informacion[0]->coleccion_id_logo, "2") === false) ? 'none': 'block'  ?>"> Interior</p>
                            </div>                  

               
            


            </div> <!-- ROW -->


             </div>

        </div>

          




       </div> <!--<div class="panel panel-default miacordion desc"> -->
	
	</div>  <!-- <div class="panel-group" -->
  <?php } }?>   
          
   
   </div>  <!--col-12 -->


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
             

<!-- Modal eliminar tamaño-->

<div class="modal fade" id="modaleliminar_tamano" role="dialog" >  
    <div class="modal-dialog">
        <div class="modal-content">
            <?php $this->load->view( 'sitio/fotocalendario/fotorevise/modaleliminar_tamano' ); ?>
        </div>
    </div>
</div>  
