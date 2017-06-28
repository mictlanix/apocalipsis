<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<style type="text/css">
.btn {
  font-family: Arial;
  color: #ffffff;
  font-size: 20px;
  background: #3f88b8;
  padding: 10px 20px 10px 20px;
  text-decoration: none;
}

.btn:hover {
  background: #3cb0fd;
  background-image: -webkit-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -moz-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -ms-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -o-linear-gradient(top, #3cb0fd, #3498db);
  background-image: linear-gradient(to bottom, #3cb0fd, #3498db);
  text-decoration: none;
}
</style>


<?php 
get_header('sistema'); 
$this->load->view( 'sitio/agendas/fotocalendario/header' ); ?>
      
 <div class="container">

        
        
        <?php $this->load->view( 'sitio/agendas/fotocalendario/navbar_fotocalendario' ); ?>

     
        <?php $this->load->view( 'sitio/agendas/fotocalendario/slider' ); ?>
     

<?php 


  if (!isset($retorno)) {
        $retorno ="tinbox/fotocalendario";
    }

   if (isset($calendario->uid_fotocalendario))   {
      $uid_fotocalendario =$calendario->uid_fotocalendario;
   } else {
      $uid_fotocalendario ='';
   }

 //http://www.sanwebe.com/2012/06/ajax-file-upload-with-php-and-jquery    

 $attr = array('class' => 'form-horizontal', 'id'=>'form_validar_fotocalendario','name'=>$retorno,'method'=>'POST','autocomplete'=>'off','role'=>'form');
 echo form_open_multipart('agendas/validar_nuevo_fotocalendario', $attr);
 $meses = array('enero','febrero','marzo','abril','mayo','junio','julio', 'agosto','septiembre','octubre','noviembre','diciembre'); 
?>    


      <section class="col-md-9 col-md-offset-1 col-sm-9 col-xs-12">
<!-- variables ocultas q se arrastran entre secciones -->
<span style="display:none">
<input type="text" id="correo_activo" name="correo_activo" value="<?php echo $correo_activo; ?>" >
<input type="text" id="id_session" name="id_session" value="<?php echo $id_session; ?>" >
<input type="text" id="id_diseno" name="id_diseno" value="<?php echo $id_diseno; ?>" >
<input type="text" id="variation_id" name="variation_id" value="<?php echo $variation_id; ?>" >
<input type="text" id="consecutivo" name="consecutivo" value="<?php echo $consecutivo; ?>" >  
<input type="text" id="uid_fotocalendario" name="uid_fotocalendario" value="<?php echo $uid_fotocalendario; ?>" >
</span>

      <div id="foo"></div>
      <div class="alert" id="messages"></div>

            <div id="datos">
              
              <div class="row">  
                <div class="col-xs-12 col-md-12">
                      <h4 id="registros" class="form-control-static text-left">Registros</h4>
                      <h4 id="reutilizando" class="form-control-static text-left"><?php echo $reutilizando; ?></h4>
                </div>  
              </div> 

              <div class="row">  
                <div class="col-xs-12 col-md-12">
                      <h3 class="form-control-static text-left">Ingresa tus DATOS</h3>
                </div>  
              </div>  


        <div class="row" style="margin-bottom:30px">
        	     <div class="col-md-4 col-sm-4 col-xs-0"></div>
                  
                 <div class="col-md-2 col-sm-2 col-xs-4">
                 <span class="help-block">Copias</span>  
                  <?php 
                    
                    echo '<select name="id_copia" id="id_copia" class="form-control">';
                      for ($i = 1; $i <= 30; $i++) {
                        if($calendario->id_copia==$i){
                          echo '<option selected value="'.$i.'">'.$i.'</option>';
                        }  else {
                          echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                      } 
                    echo '</select>';
                 ?>
                    
                  </div>


                 

                  <div class="col-md-6 col-sm-6 col-xs-8">
                  	


<!-- Datos predictivos a reutilizar-->
      <span class="help-block">Reutiliza tus datos</span>                    
      <div class="form-group">
        
        <div class="col-sm-12 col-md-12">
            <input  type="text" name="editar_dato_reutilizar" id="editar_dato_reutilizar" idprodinven="1" class="form-control buscar_dato_reutilizar ttip" title="Campo predictivo. Escriba y seleccione tus datos a reutilizar." autocomplete="off" spellcheck="false" placeholder="Buscar datos a reutilizar...">
        </div>
      </div>
      
                  
                      
                      
                </div>




        </div>




<!-- campo predictivo de titulo -->            
            <div class="form-group">
              <div class="col-xs-12 col-md-12">
              <span class="help-block">Escriba su título:</span>
                <select id="titulo" name="titulo">
                  
                      <?php 
                          $personalizado = '';
                          
                          if ($listas_titulo) {
                            foreach ( $listas_titulo as $i => $lista ){ 
                               if  ($calendario->titulo==$lista->nombre) {
                                  $seleccionado='selected';
                                  $personalizado = $calendario->titulo;
                                } else {
                                  $seleccionado='';
                               }
                          
                          if ( (!isset($calendario->titulo)) && ($i==0) ) {
                              $seleccionado='selected';
                          } 
                         

                        ?>
                            <option value="<?php echo $lista->nombre; ?>" <?php echo $seleccionado; ?>><?php echo $lista->nombre; ?></option>                          
                       <?php } } 

                        
                        if ( (isset($calendario->titulo)) && ($personalizado == '') ) {                          
                          $seleccionado='selected';
                        } else {
                          $seleccionado='';
                        }  
                         ?>                       
                         <option <?php echo $seleccionado; ?> value="personalizado">Personalizado</option>
                </select>
              </div>

              <div class="col-xs-12 col-md-12">
              	<input class="form-control" value="<?php echo $calendario->titulo; ?>" type="text" id="otro" name="otro" style="display: <?php echo ( ( (isset($calendario->titulo)) && ($personalizado == '') ) ? '' : 'none'); ?>; margin-top:10px"/>
              	<span class="help-block"><span></span>Sólo aparecerá en la portada antes del nombre, ejemplo (Licenciada, Estimada, Sr. ...)</span>
              </div>              
            </div>
          
          


                <div class="form-group">
                  <div class="col-xs-12 col-md-12">
                      <?php 
                        $nomb_nom='';
                        if (isset($calendario->nombre)) 
                         {  $nomb_nom = $calendario->nombre;}
                      ?>
                      <input value="<?php echo  set_value('nombre',$nomb_nom); ?>" type="text" class="form-control" name="nombre" placeholder="Nombre">
                      <span class="help-block"><span></span>Lo más importante, pues lo que escribas personalizará la imagen de cada mes...</span>
                   </div> 
                </div>                      

                <div class="form-group">
                  <div class="col-xs-12 col-md-12">
                      <?php 
                        $nomb_nom='';
                        if (isset($calendario->apellidos)) 
                         {  $nomb_nom = $calendario->apellidos;}
                      ?>
                      <input value="<?php echo  set_value('apellidos',$nomb_nom); ?>" type="text" class="form-control" name="apellidos" placeholder="Apellidos">
                      <span class="help-block"><span></span>Sólo aparecerá en la portada junto al nombre...</span>
                   </div> 
                </div>                      


    <!-- para el nuevo texto-->
              <div class="row clearfix">
                  <div class="col-md-12">
                      <h3 class="form-control-static text-left mb-0">Texto en las Hojas (máximo 100 caracteres)</h3>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group" style="margin: 20px 0 10px">
                          
                          <input maxlength="100"  type="text" class="form-control" id="texto_pagina" placeholder="Mensaje de texto" value="<?php echo $calendario->texto_pagina; ?>">
                          

                     </div>
                     <p style="margin-bottom:20px">Escribe un pequeño mensaje para todas las hojas... ¿Qué te inspira?</p>
                </div>
              </div>

			<hr style="display:<?php echo ($datos[0]->logos=='' ? 'none': 'block' ) ?>" />
            

              <div id="interior" class="row" style="display:<?php echo ($datos[0]->logos=='' ? 'none': 'block' ) ?>">  
                  
                    <div class="col-xs-12 col-md-12">
                        <h3 class="form-control-static text-left">Agrega un logo (Opcional)</h3>
                    </div>  

               
          
         <!-- Imagen-->  
                

                  
                  <?php

                    if  (isset($calendario->logo)) { ?>
                          <input type="hidden" id="ca_logo" name="ca_logo" value="<?php echo $calendario->logo; ?>" >  
                  <?php          
                      if  ($calendario->logo=='') {
                       ?>
                             <div class="col-md-12 mb-20">
                                           <div class="img_logo" style="display:none;">
                                             <p class="mb-20">Su imagen adjunta actual es: </p>
                                                    <?php  
                                                            echo '<a target="_blank" href="" type="button">';
                                                                  echo '<img id="imag_logo" src="" border="0" style="width:250px; height:auto; margin:15px 0">';
                                                            echo '</a>';  
                                                      ?>
                                               <p class="mb-20">
                                                              <button type="button" class="btn btn-danger eliminar_imagen">Eliminar imagen <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>             
                                               </p>
                                               
                                               <hr>
                                               <p>Desea reemplazarlo por un archivo diferente?</p>
                                        </div>
                            </div> 
                      <?php
                        

                       

                      } else  { ?>  
             
             <div class="col-md-12 mb-20">
                           <div class="img_logo">
                             <p class="mb-20">Su imagen adjunta actual es: </p>
                             
                               
                                            <?php  
                                                  $nombre_fichero ='uploads/agendas/fotocalendario/'.$calendario->logo;

                                                  if (file_exists($nombre_fichero)) {
                                                    echo '<a target="_blank" href="'.base_url().$nombre_fichero.'" type="button">';
                                                          echo '<img id="imag_logo" src="'.base_url().$nombre_fichero.'" border="0" style="width:250px; height:auto; margin:15px 0">';
                                                    echo '</a>';  
                                                  } else {
                                                      
                                                    echo '<a target="_blank" href="'.base_url().'img/sinimagen.jpg'.'" type="button">';
                                                          echo '<img id="imag_logo" src="'.base_url().'img/sinimagen.jpg'.'" border="0" style="width:250px; height:auto; margin:15px 0">';
                                                      echo '</a>';    
                                                  }
                                              ?>


                               <p class="mb-20">
                                              <button type="button" class="btn btn-danger eliminar_imagen">Eliminar imagen <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>             
                               </p>
                               
                               <hr>
                               <p>Desea reemplazarlo por un archivo diferente?</p>
                        </div>
            </div> 
                      <?php     
                      }   
                      print '<br/>';
                      
                    }  else {
                        ?>
                             <div class="col-md-12 mb-20">
                                        <div class="img_logo" style="display:none;">
                                             <p class="mb-20">Su imagen adjunta actual es: </p>
                                                    <?php  
                                                            echo '<a target="_blank" href="" type="button">';
                                                                  echo '<img id="imag_logo" src="" border="0" style="width:250px; height:auto; margin:15px 0">';
                                                            echo '</a>';  
                                                      ?>
                                               <p class="mb-20">
                                                              <button type="button" class="btn btn-danger eliminar_imagen">Eliminar imagen <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>             
                                               </p>
                                               
                                               <hr>
                                               <p>Desea reemplazarlo por un archivo diferente?</p>
                                        </div>
                            </div> 
                      <?php

                    }
                       ?> 
                   
                   <div class="col-md-6">
                        <label for="logo"> <span class="btn continuar">Seleccionar imagen <span class="glyphicon glyphicon-picture" aria-hidden="true"></span></span></label>
                        <input style="visibility: hidden; position: absolute;" type="file" name="logo" id="logo" size="20">
                        <img style="max-width:50px;" id="output"/>
                        <span class="help-block">Peso máximo de imagen:1MB</span>  
                    
                    </div>
          <!-- Imagen--> 


        </div> <!-- row -->







        <div class="row">
          <div class="col-md-12">
                    <?php              
                      if  (isset($calendario->coleccion_id_logo)) {
                         $col_id_logo = explode(",",  substr($calendario->coleccion_id_logo,1,strlen($calendario->coleccion_id_logo)-2 ) );
                      } else {
                        $col_id_logo =array();
                      }   
                     ?>                

                      <?php foreach ($logos as $logo) { ?>
                            <div class="checkbox" style="display:<?php echo (strpos($datos[0]->logos, (string)$logo->id) === false) ? 'none': 'block'  ?>"  >
                                <label for="coleccion_id_logo" class="ttip" title="<?php echo $logo->tooltip; ?>">

                                    <?php   
                                          if (in_array($logo->id, $col_id_logo)) {$marca='checked';} else {$marca='';}
                                    ?>

                                  <input <?php echo $marca; ?> type="checkbox" value="<?php echo $logo->id; ?>" name="coleccion_id_logo[]" id="coleccion_id_logo[]"><?php echo $logo->nombre; ?> 

                                </label>
                            </div>
                      <?php } ?>
        </div>
                  <br/><br/><br/><br/>
                  <div class="col-md-12">
                  <!-- <span><b style="color:#000 !important;"><span class="req">*</span>Campos obligatorios</b></span>   -->

                  </div>
              </div> <!-- row -->

              
        
              










              
        <hr>
              <div id="cumpleano" class="row">

                <div class="col-xs-12 col-md-12">
                    <h3 class="form-control-static text-left">Indica la fecha de tu cumpleaños</h3>
                </div>   
                
                
                  
                  <div class="col-md-3 col-sm-3 col-xs-6">
                    
                  <?php 
                    
                    echo '<select name="id_mes" id="id_mes" class="form-control">';
                      for ($i = 1; $i <= 12; $i++) {
                        if($calendario->id_mes==$i){
                          echo '<option selected value="'.$i.'">'.$meses[$i-1].'</option>';
                        }  else {
                          echo '<option value="'.$i.'">'.$meses[$i-1].'</option>';
                        }
                      } 
                    echo '</select>';





                  ?>
                    <span class="help-block">Mes</span>
                  </div>

                  <div class="col-md-3 col-sm-3 col-xs-6" id="mesano">
                    
                  <?php 
                    $dia = 31; //es correcto es para enero siempre tiene 31 días

                    echo '<select name="id_dia" id="id_dia" class="form-control">';
                      for ($i = 1; $i <= $dia; $i++) {

                        if($calendario->id_dia==$i){
                          echo '<option selected value="'.$i.'">'.$i.'</option>';
                        }  else {
                          echo '<option value="'.$i.'">'.$i.'</option>';
                        }                        
                        
                      } 
                    echo '</select>';

                  ?>
                    <span class="help-block">Dia</span>
                  </div>

                  <div class="col-md-12">                  
                  <!--<span><b style="color:#000 !important;"><span class="req">*</span>Campos obligatorios</b></span>  -->
                </div>

                
              </div>
              
        <hr>

              <div id="festividades" class="row">
                <div class="col-md-12">
                      <h3 class="form-control-static text-left mb-0">Selecciona el tipo de festividades</h3>
                  </div>   
                <div class="col-xs-12 col-md-12">
                      <p class="form-control-static">
                        Selecciona la combinación de festividades religiosas de tu preferencia.
                      </p>
                  </div>          
                
                  
                   <div class="col-md-6 col-sm-6 col-xs-6">   
                    
                      <select name="id_festividad" id="id_festividad" class="form-control">
                          <!--<option value="-1">Ninguno</option> -->
                          <?php foreach ( $festividades as $festividad ){ ?>
                             <?php if($calendario->id_festividad==$festividad->id){ ?>
                                <option selected value="<?php echo $festividad->id; ?>"><?php echo $festividad->nombre; ?></option>
                             <?php } else { ?>   
                                <option value="<?php echo $festividad->id; ?>"><?php echo $festividad->nombre; ?></option>
                             <?php } ?>   
                          <?php } ?>
                      </select>

                  </div>
                
              </div>






            </div>
			<hr class="division">
            <div id="fechas_especiales">
              <div class="row">  
                 <div class="col-md-12">
                      <h3 class="form-control-static text-left mb-0">Agrega tus fechas especiales</h3>
                  </div>  
                </div>  


              <div class="row">  
                 <div class="col-md-12">
                      <p class="form-control-static">
                        Agrega las fechas que harán tu año especial y único.
                      </p>
                  </div>  
                </div>  

              <div id="anos" class="row">  
                
                  <label style="padding-top: 7px;" class="col-md-1 col-sm-3 col-xs-6 control-label">Año</label>
                  <div class="col-md-2 col-sm-9 col-xs-6 ">
                    
                  <?php 
                    $ano = date('Y');
                    echo '<select name="id_ano" id="id_ano" class="form-control">';
                      for ($i = $ano; $i <= $ano; $i++) {
                        echo '<option value="'.$i.'">'.$i.'</option>';
                      } 
                    echo '</select>';
                  ?>

                  </div>
                
              </div>


              <div id="mes" class="row">   
                <div class="col-md-4">
                      <p id="mes_mostrar" class="form-control-static">ENERO</p>
                </div>  

                <div class="col-md-3 col-md-offset-5">

                      <select name="id_lista" id="id_lista" class="form-control">
                          <option value="-1">Ninguno</option>
                          <?php  if ($listas) {
                                foreach ( $listas as $lista ){ 
                          ?>
                              <option value="<?php echo $lista->id; ?>" ubicacion="<?php echo $lista->ubicacion; ?>" ><?php echo $lista->nombre; ?></option>
                          <?php } } ?>
                      </select>
                      <span class="help-block">Reutilizar fechas especiales</span>
                      
                </div>  

                </div>  



              <div id="meses" class="row">  
                <div class="col-md-1 col-sm-2 col-xs-4"><a id="mes1" nmes="0" class="calendarioEventos-flecha1 botonMes" >Ene</a></div>                
                <div class="col-md-1 col-sm-2 col-xs-4"><a id="mes2" nmes="1" class="calendarioEventos-flecha1 botonMes" >Feb</a></div>                
                <div class="col-md-1 col-sm-2 col-xs-4"><a id="mes3" nmes="2" class="calendarioEventos-flecha1 botonMes" >Mar</a></div>
                <div class="col-md-1 col-sm-2 col-xs-4"><a id="mes4" nmes="3" class="calendarioEventos-flecha1 botonMes" >Abr</a></div>
                <div class="col-md-1 col-sm-2 col-xs-4"><a id="mes5" nmes="4" class="calendarioEventos-flecha1 botonMes" >May</a></div>
                <div class="col-md-1 col-sm-2 col-xs-4"><a id="mes6" nmes="5" class="calendarioEventos-flecha1 botonMes" >Jun</a></div>
                <div class="col-md-1 col-sm-2 col-xs-4"><a id="mes7" nmes="6" class="calendarioEventos-flecha1 botonMes" >Jul</a></div>
                <div class="col-md-1 col-sm-2 col-xs-4"><a id="mes8" nmes="7" class="calendarioEventos-flecha1 botonMes" >Ago</a></div>
                <div class="col-md-1 col-sm-2 col-xs-4"><a id="mes9" nmes="8" class="calendarioEventos-flecha1 botonMes" >Sep</a></div>
                <div class="col-md-1 col-sm-2 col-xs-4"><a id="mes10" nmes="9" class="calendarioEventos-flecha1 botonMes" >Oct</a></div>
                <div class="col-md-1 col-sm-2 col-xs-4"><a id="mes11" nmes="10" class="calendarioEventos-flecha1 botonMes" >Nov</a></div>
                <div class="col-md-1 col-sm-2 col-xs-4"><a id="mes12" nmes="11" class="calendarioEventos-flecha1 botonMes" >Dic</a></div>
                
            
              </div>

              <hr/> 


              

              <div class="row">
                <div class="col-md-12"> <!-- g6 first-->
                  <div id="almanaque" diaseleccionado="">

                  </div>
        </div>
        </div>

              <div class="row clearfix">
              	  <div class="col-md-12">
                      <h3 class="form-control-static text-left mb-0">Mensaje del mes (máximo 40 caracteres)</h3>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group" style="margin: 20px 0 10px">
                          
                          <input maxlength="40"  type="text" class="form-control" id="texto_mes" placeholder="Mensaje de texto">
                     </div>
                     <p style="margin-bottom:20px">Escribe un pequeño mensaje para el mes... ¿Qué te inspira?</p>
                </div>
              </div>

















              
    

            </div>

 
              <!-- boton de continuar--> 
              <div class="row"> 
                <div class="col-md-4 col-md-offset-8" style="margin-bottom:30px">
                  <input type="submit" id="cont_session3" class="btn btn-success btn-block" value="Continuar"/> 
                </div>
              </div>


    </section>  <!-- fin de section-->

<?php echo form_close(); ?>

</div>  <!-- fin del container-->


<!-- Modal pregunta -->

<div class="modal fade" id="modalPregunta" role="dialog" >  
  <div class="modal-dialog">
        <div class="modal-content">
            
            <?php $dato['correo_activo'] = $correo_activo; ?>
            <?php $this->load->view( 'sitio/agendas/fotocalendario/guardar_lista', $dato ); ?>

        </div>
    </div>
</div>  


<!-- Modal no lista-->

<div class="modal fade" id="modalsinLista" role="dialog" >  
  <div class="modal-dialog">
        <div class="modal-content">
            <?php $this->load->view( 'sitio/agendas/fotocalendario/singuardar_lista' ); ?>
        </div>
    </div>
</div>  



<!-- Modal -->
        
        <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog" >
          
            <!-- Modal content-->
            <div class="modal-content">
              
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title infoTitulo">Sólo 18 caracteres</h4>
              </div>
              
              <div class="modal-body">
                <textarea maxlength="18" class="contenido" rows="4" style="width:100%;"></textarea>
              </div>
              
              <div class="modal-footer">
                <button type="button" class="btn btn-default guardar_modal">Guardar</button>
              </div>               
             
            </div>
            
          </div>
        </div>



<?php $this->load->view( 'sitio/agendas/fotocalendario/footer' );
 get_footer('sistema'); 
?>

<style type="text/css">
  .selectize-control .selectize-input div.item {
    padding: 2px 6px !important;
    margin: 0 3px 3px 0 !important;
    color: #ffffff !important;
    cursor: pointer !important;
    background: #1da7ee !important;
    border: 1px solid #0073bb !important;
    border-radius: 4px !important;
}


a.remover {
    visibility:hidden !important;
}
a.remover.lleno {
    visibility:visible !important;
}

.twitter-typeahead{
     display: block !important;
}


</style>

<script type="text/javascript">
  $(document).ready(function() {
    $('.navbar-nav li:nth-child(5)').addClass('current-menu-item')
  });
</script>



