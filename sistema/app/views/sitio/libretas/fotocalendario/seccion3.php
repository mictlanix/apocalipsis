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
$this->load->view( 'sitio/libretas/fotocalendario/header' ); ?>
      
 <div class="container">

        
        
        <?php $this->load->view( 'sitio/libretas/fotocalendario/navbar_fotocalendario' ); ?>

     
        <?php $this->load->view( 'sitio/libretas/fotocalendario/slider' ); ?>
     

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
 echo form_open_multipart('libretas/validar_nuevo_fotocalendario', $attr);
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
                  	<span class="help-block">Reutiliza tus datos</span>

					<!-- Datos predictivos a reutilizar-->
					      <div class="form-group">
					        
					        <div class="col-sm-12 col-md-12">
					            <input  type="text" name="editar_dato_reutilizar" id="editar_dato_reutilizar" idprodinven="1" class="form-control buscar_dato_reutilizar ttip" title="Campo predictivo. Escriba y seleccione tus datos a reutilizar." autocomplete="off" spellcheck="false" placeholder="Buscar datos a reutilizar...">
					        </div>
					      </div> 
                      
                </div>




        </div>



<!-- campo predictivo de titulo 
			<div class="row">  
                <div class="col-xs-12 col-md-12">
                      <h3 class="form-control-static text-left">Portada</h3>
                </div>  
             </div>

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


			<hr>

      -->

 <!-- para el nuevo nombre-->

              <div class="row clearfix">
                  <div class="col-md-12">
                      <h3 class="form-control-static text-left mb-0">Nombre y apellidos (máximo <?php echo $informacion[0]->longitud_nombre; ?>  caracteres)</h3>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group" style="margin: 20px 0 10px">
                          
                          <input maxlength="<?php echo $informacion[0]->longitud_nombre; ?>"  type="text" class="form-control" name="nombre" placeholder="Mensaje de texto" value="<?php echo $calendario->nombre; ?>">
                          

                     </div>
                     <p style="margin-bottom:20px">Escribe un pequeño mensaje para todas las hojas... ¿Qué te inspira?</p>
                </div>
              </div>      
            
<!-- 2da parte campo predictivo de titulo -->           

          <div class="checkbox" style="display:none;">
              <label for="coleccion_id_igual" class="ttip" title="Reutilizar datos de portada">

                  <?php   
                        if ($calendario->coleccion_id_igual=="1") {$marca='checked';} else {$marca='';}
                        if (!isset($calendario->coleccion_id_igual) ) {
                          $marca=$marca=''; //$marca=$marca='checked';
                        }
                        //print_r($calendario);
                        //die;
                  ?>

                <input <?php echo $marca; ?> type="checkbox" value="1" name="coleccion_id_igual" id="coleccion_id_igual"><?php echo "Reutilizar datos de portada"; //$logo->nombre; ?> 

              </label>
          </div>

          <!-- <div id="bloque2" style="display:<?php echo ( ( ($calendario->coleccion_id_igual=="0") || (!isset($calendario->coleccion_id_igual) ) )? 'block' : 'none'); ?>;">
          -->

          <div id="bloque2" style="display:none;">

            <div class="row">  
                <div class="col-xs-12 col-md-12">
                      <h3 class="form-control-static text-left">Interior</h3>
                </div>  
            </div>     

            <div class="form-group">
                <div class="col-xs-12 col-md-12">
                  <span class="help-block">Escriba su título:</span>
                  <select id="titulo_interior" name="titulo_interior">

                    <?php 
                    $personalizado = '';
                    if ($listas_titulo) {
                      foreach ( $listas_titulo as $i =>  $lista ){ 
                        if  ($calendario->titulo_interior==$lista->nombre) {
                          $seleccionado='selected';
                          $personalizado = $calendario->titulo_interior;
                        } else {
                          $seleccionado='';
                        }

                        if ( (!isset($calendario->titulo_interior)) && ($i==0) ) {
                              $seleccionado='selected';
                        }                         

                        ?>
                        <option value="<?php echo $lista->nombre; ?>" <?php echo $seleccionado; ?>><?php echo $lista->nombre; ?></option>                          
                        <?php } } 

                        
                        if ( (isset($calendario->titulo_interior)) && ($personalizado == '') ) {                            
                          $seleccionado='selected';
                        } else {
                          $seleccionado='';
                        }  
                        ?>                       
                        <option <?php echo $seleccionado; ?> value="personalizado">Personalizado</option>
                  </select>



               </div>

               <div class="col-xs-12 col-md-12">
                <input class="form-control" value="<?php echo $calendario->titulo_interior; ?>" type="text" id="otro_interior" name="otro_interior" style="display:<?php echo ( ( (isset($calendario->titulo_interior)) && ($personalizado == '') ) ? '' : 'none'); ?>; margin-top:10px"/>

                <span class="help-block"><span></span>Sólo aparecerá en la portada antes del nombre, ejemplo (Licenciada, Estimada, Sr. ...)</span>
               </div>              
            </div>
          



                <div class="form-group">
                  <div class="col-xs-12 col-md-12">
                      <?php 
                        $nomb_nom='';
                        if (isset($calendario->nombre_interior)) 
                         {  $nomb_nom = $calendario->nombre_interior;}
                      ?>
                      <input value="<?php echo  set_value('nombre_interior',$nomb_nom); ?>" type="text" class="form-control" name="nombre_interior" placeholder="Nombre">
                      <span class="help-block"><span></span>Lo más importante, pues lo que escribas personalizará la imagen de cada mes...</span>
                   </div> 
                </div>                      

                <div class="form-group">
                  <div class="col-xs-12 col-md-12">
                      <?php 
                        $nomb_nom='';
                        if (isset($calendario->apellidos_interior)) 
                         {  $nomb_nom = $calendario->apellidos_interior;}
                      ?>
                      <input value="<?php echo  set_value('apellidos_interior',$nomb_nom); ?>" type="text" class="form-control" name="apellidos_interior" placeholder="Apellidos">
                      <span class="help-block"><span></span>Sólo aparecerá en la portada junto al nombre...</span>
                   </div> 
                </div>  
            </div>                        

              <!-- para el nuevo texto-->
              <div class="row clearfix">
                  <div class="col-md-12">
                      <h3 class="form-control-static text-left mb-0">Texto en las Hojas (máximo <?php echo $informacion[0]->longitud_texto; ?> caracteres)</h3>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group" style="margin: 20px 0 10px">
                          
                          <input maxlength="<?php echo $informacion[0]->longitud_texto; ?>"  type="text" class="form-control" id="texto_pagina" placeholder="Mensaje de texto" value="<?php echo $calendario->texto_pagina; ?>">
                     </div>
                     <p style="margin-bottom:20px">Escribe un pequeño mensaje para todas las hojas... ¿Qué te inspira?</p>
                </div>
              </div>



      <hr style="display:<?php echo ($informacion[0]->logos=='' ? 'none': 'block' ) ?>" />
<!--fin de la 2da parte campo predictivo de titulo -->            


              <div id="interior" class="row" style="display:<?php echo ($informacion[0]->logos=='' ? 'none': 'block' ) ?>">  
                  
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
                                                  $nombre_fichero ='uploads/libretas/fotocalendario/'.$calendario->logo;

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
          <fieldset id="marca_logo" disabled>
            <div class="col-md-12">
                      <?php              
                        if  (isset($calendario->coleccion_id_logo)) {
                           $col_id_logo = explode(",",  substr($calendario->coleccion_id_logo,1,strlen($calendario->coleccion_id_logo)-2 ) );
                        } else {
                          $col_id_logo =array();
                        }   
                       ?>                

                        <?php foreach ($logos as $logo) { ?>
                              <div class="checkbox" style="display:<?php echo (strpos($informacion[0]->logos, (string)$logo->id) === false) ? 'none': 'block'  ?>"  >
                                  <label for="coleccion_id_logo" class="ttip" title="<?php echo $logo->tooltip; ?>">

                                      <?php   
                                            if (in_array($logo->id, $col_id_logo)) {$marca='checked';} else {$marca='';}
                                      ?>

                                    <input <?php echo $marca; ?> type="checkbox" value="<?php echo $logo->id; ?>" name="coleccion_id_logo[]" id="coleccion_id_logo[]"><?php echo $logo->nombre; ?> 

                                  </label>
                              </div>
                        <?php } ?>
          </div>
        </fieldset>
                  <br/><br/><br/><br/>
                  <div class="col-md-12">
                  	<!-- <span><b style="color:#000 !important;"><span class="req">*</span>Debes llenar al menos el nombre o el apellido</b></span>  -->
                  </div>
              </div> <!-- row -->

              
        <hr>
              
              
    

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
            <?php $this->load->view( 'sitio/libretas/fotocalendario/guardar_lista', $dato ); ?>

        </div>
    </div>
</div>  


<!-- Modal no lista-->

<div class="modal fade" id="modalsinLista" role="dialog" >  
  <div class="modal-dialog">
        <div class="modal-content">
            <?php $this->load->view( 'sitio/libretas/fotocalendario/singuardar_lista' ); ?>
        </div>
    </div>
</div>  




<?php $this->load->view( 'sitio/libretas/fotocalendario/footer' );
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
    $('.navbar-nav li:nth-child(4)').addClass('current-menu-item')
  });
</script>



