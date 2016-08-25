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
//get_header('sistema'); 

$this->load->view( 'sitio/micuenta/fotocalendario/header_fotocalendario' );

 ?>
      
 <div class="container">

        
     

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
 echo form_open_multipart('micuenta/validar_nuevo_fotocalendario', $attr);
?>    


      
      <section class="col-md-9 col-md-offset-1 col-sm-9 col-xs-12">
<!-- variables ocultas q se arrastran entre secciones -->
<span style="display:none">
<input type="text" id="id_session" name="id_session" value="<?php echo $id_session; ?>" >

  <!-- <input type="text" id="correo_activo" name="correo_activo" value="<?php echo $correo_activo; ?>" > 
      <input type="text" id="id_diseno" name="id_diseno" value="<?php echo $id_diseno; ?>" >
      <input type="text" id="id_tamano" name="id_tamano" value="<?php echo $id_tamano; ?>" >
      <input type="text" id="consecutivo" name="consecutivo" value="<?php echo $consecutivo; ?>" >  
      <input type="text" id="uid_fotocalendario" name="uid_fotocalendario" value="<?php echo $uid_fotocalendario; ?>" >
  -->

</span>

      <div id="foo"></div>

      <div class="alert" id="messages"></div>

            <div id="fechas_especiales">
              <div class="row">  
                 
                    <div class="col-md-12">
                      <h3 class="form-control-static text-left" style="margin-bottom:0px !important; margin-top:50px;">FECHAS ESPECIALES</h3>
                      <p class="form-control-static" style="margin-top:0px">
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


              <div id="mes" class="row" style="margin-top:30px">   
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
	                   <div class="form-group" style="margin: 20px 0 10px">
	                        <label for="texto_mes">Mensaje del mes (máximo 40 caracteres) </label>
	                        <input maxlength="40"  type="text" class="form-control" id="texto_mes" placeholder="Mensaje de texto">

	                   </div>
	                   <p style="margin-bottom:20px">Escribe un pequeño mensaje para el mes... ¿Qué te inspira?</p>
	              </div>
              </div>


              <div class="row"> 
                
                <!--
                <div class="col-md-4">
                  <a href="#" type="button" class="btn btn-danger btn-block guardar">Guardar Lista</a>
                </div>
                -->

                <div class="col-md-4 col-md-offset-8" style="margin-bottom:30px">
                  <input type="submit" id="cont_session3" class="btn btn-success btn-block" value="Guardar los Cambios"/> 

                  <!--
                    <a href="guardar_lista" class="btn btn-success btn-block" data-toggle="modal" data-target="#modalPregunta"></a>
                  -->    

                </div>

              </div>


          </div>

    </section>  <!-- fin de section-->

<?php echo form_close(); ?>

</div>  <!-- fin del container-->


<!-- Modal pregunta

<div class="modal fade bs-example-modal-lg" id="modalPregunta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
-->
<div class="modal fade" id="modalPregunta" role="dialog" >  
  <div class="modal-dialog">
        <div class="modal-content">
            
            <?php $dato['correo_activo'] = $correo_activo; ?>
            <?php $this->load->view( 'sitio/micuenta/fotocalendario/guardar_lista', $dato ); ?>

        </div>
    </div>
</div>  


<!-- Modal no lista-->

<div class="modal fade" id="modalsinLista" role="dialog" >  
  <div class="modal-dialog">
        <div class="modal-content">
            <?php $this->load->view( 'sitio/micuenta/fotocalendario/singuardar_lista' ); ?>
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


<?php 
$this->load->view( 'sitio/micuenta/fotocalendario/footer_fotocalendario' );
  //get_footer('sistema'); 
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
		$('.navbar-nav li:nth-child(3)').addClass('current-menu-item')
	});
</script>


