<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Fotocalendario extends CI_Controller {
	public function __construct(){ 
		parent::__construct();
		
		$this->load->model('libretas/modelo_fotocalendario', 'modelo_fotocalendario'); 
		$this->load->library(array('email')); 
        $this->load->library('Jquery_pagination');//-->la estrella del equipo		
	}

////////////////////////************BUSCAR DATOS PREDICTIVOS****************/////////////////////////////

  public function buscador_predictivo(){


       $data['key']=$_GET['key'];
       $data['nombre']=$_GET['nombre'];
       $data['id_session']=$_GET['id_session'];
       
       
       switch ($data['nombre']) {
	        case 'editar_dato_reutilizar':

	            $busqueda = $this->modelo_fotocalendario->buscador_predictivo($data); //prod d inventario
	          break;
       }
       

       echo $busqueda;

    
  }


public function eliminar_logo_libretas() {

	$data['id_session']   = $this->input->post('id_session');
	$data['id_diseno']   = $this->input->post('id_diseno');
	$data['variation_id']   = $this->input->post('variation_id');
	$data['consecutivo']   = $this->input->post('consecutivo');
	$data['datos'] = $this->modelo_fotocalendario->eliminar_logo_formulario($data);

   	echo json_encode($data);

}	
///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////

	//OK comienza aqui a mostrar el formulario
	public function index($session) {

		$data['id_session'] = base64_decode($session);	
		$data['datos'] = $this->modelo_fotocalendario->correo_logueo($data);

		if ($data['datos']){
		 	   $data['cantDiseno_original'] = count($data['datos']);
		 	          $data['cantDiseno']   = count($data['datos']);
		 	      
		 	      			// 1- si tocaron continuar
		 	      if (isset($_POST['variation_id'])) {  
						 foreach ($data['datos'] as $llave => $valor) {
					          	if (  ($valor->variation_id == $_POST['variation_id']) and 
					          		  ($valor->id_diseno == $_POST['id_diseno']) and 
					          		  ($valor->consecutivo == $_POST['consecutivo'])  
					          		){
					          		$id_registro= $llave+1; //llave es el nuemero de registro 0..n
					          	}	
				          } 
			 	      		//en funcion del elemento posicionado  pasado debo buscar el siguiente
			  	 	     //$data['posicionDiseno']   = $data['datos'][$id_registro]->variation_id; // borrar en el futuro
			  	 	     	
			  	 	     	  
			  	 	     	  $data['id_diseno']   = $data['datos'][$id_registro]->id_diseno; 
			  	 	     	  $data['variation_id']   = $data['datos'][$id_registro]->variation_id; 
			  	 	        $data['consecutivo']   = $data['datos'][$id_registro]->consecutivo; 


			  	 	        //2- cuando se "refresque" o sea llamado por "primera vez"	
				 	      } else {  
					 	      //$data['posicionDiseno']  = $data['datos'][0]->variation_id; //borrar en el futuro
					 	      $data['id_diseno']       = $data['datos'][0]->id_diseno; 
					 	      $data['variation_id']    = $data['datos'][0]->variation_id; 
					 	      $data['consecutivo']     = $data['datos'][0]->consecutivo;
				 	      }

					
				 	       //3- especificamente para la edicion "checar este"
						  if (isset($_POST['id_edicion_variacion'])) {  
						  		 //$data['posicionDiseno']   = $_POST['id_edicion_variacion'];
						  		 	  $data['variation_id']   = $_POST['id_edicion_variacion'];
						  		 	  $data['id_diseno']   = $_POST['id_edicion_diseno'];
						  		    $data['consecutivo']   = $_POST['id_edicion_consecutivo'];
						  }

						  $data['reutilizando'] = '';
						  if (isset($_POST['reutilizando'])) {  
						  		$data['reutilizando'] = $_POST['reutilizando'];
						  }	
						  


			      
			      $data['array_eliminar'] = '';
			      $data['correo_activo']   = $data['datos'][0]->correo;
			
			   //catalogos
			   
			   $data['logos'] = $this->modelo_fotocalendario->listado_logos();		 	   

				//Leer los datos sobre el calendario activo
				$data['calendario']      = $this->modelo_fotocalendario->fotocalendario_edicion( $data );

				//para mostrar las listas asociada a este usuario
				$data['listas'] = $this->modelo_fotocalendario->listado_listas($data);

				$data['listas_todo'] = $this->modelo_fotocalendario->listado_todolistas($data);
				$data['listas_titulo'] = $this->modelo_fotocalendario->listas_titulo($data);
				
				$this->load->view( 'sitio/libretas/fotocalendario/seccion3', $data );
		} 	
	}




//*ok
public function calenda_activos() {

	$data['id_session']    = $this->input->post('id_session');
	$data['variation_id']     = $this->input->post('variation_id');
	$data['id_diseno']     = $this->input->post('id_diseno');
	$data['consecutivo']   = $this->input->post('consecutivo');
	
	          $data['datos'] = $this->modelo_fotocalendario->calenda_activos($data);
	$data['total']           = $this->modelo_fotocalendario->total_disenos( $data );
	$data['total_disenos']   = $this->modelo_fotocalendario->total_disenos_completos( $data );



    $cale_activo = array();
    if ($data['datos'] != false)  {     
         foreach( (json_decode(json_encode($data['datos']))) as $clave =>$valor ) {
              array_push($cale_activo,array('variation_id' => $valor->variation_id, 'id_diseno' => $valor->id_diseno, 'consecutivo' => $valor->consecutivo) );  
       }
    } 

	echo json_encode($cale_activo);

}





//OK elimina un diseño especifico
public function eliminar_diseno_completo(){

	$data['id_session']    	= $this->input->post('id_session');
	$data['variation_id']   	= $this->input->post('variation_id');
	$data['id_diseno']   	= $this->input->post('id_diseno');
	$data['consecutivo']    = $this->input->post('consecutivo');
	 
	$data['eliminacion'] = $this->modelo_fotocalendario->eliminar_diseno_completo($data);
	echo json_encode($data);
}





	//OK para activar "previsualizar" cuando ya estan las 12 imagenes
public function disenos_completos(){

	$data['id_session']   = $this->input->post('id_session');
	
				$data['total'] = $this->modelo_fotocalendario->total_disenos($data);
		$data['total_disenos'] = $this->modelo_fotocalendario->total_disenos_completos($data);
	  $data['ultimo_elemento'] = $this->modelo_fotocalendario->ultimo_elemento($data);

		
	$todo = array (
	    //"cale_activo" => $cale_activo,
		    		"total"  => $data['total'],
		    "total_disenos"  => $data['total_disenos'],
	      "ultimo_elemento"  => $data['ultimo_elemento']
    );              
 
   echo json_encode($todo);   

}


	
	//OK valida aqui el continuar "Haber si al menos tiene titulo"
    
    //*ok
	public function validar_nuevo_fotocalendario(){
	
	      $data['nombre']   =   $this->input->post('nombre');		          
	      $data['apellidos']   =   $this->input->post('apellidos');		          

	      $novalida = FALSE;
	      if  ( (empty($data['nombre']))  && (empty($data['apellidos'])) ) {
				$this->form_validation->set_rules('nombre', 'Nombre', 'trim|callback_nombre_valido|max_lenght[180]|xss_clean');	      	
	      } else {
	      	$novalida = TRUE;
	      }

		
	      if ( ($this->form_validation->run() === TRUE) || ($novalida === TRUE) ) {
	            echo true;
	      } else {      
	        echo validation_errors('<span class="error">','</span>');
	      }
	
	}	



	 //OK Aqui si no hubo lista a guardar pasa al formulario de imagen
	
	function noguardar_lista() {

		print_r($this->input->post('texto_pagina'));
		die;

	          $data['id_session']   = $this->input->post('id_session');
 			  $data['variation_id']   =   $this->input->post('variation_id');	
	          $data['id_diseno']   =   $this->input->post('id_diseno');	
	          $data['consecutivo']   =   $this->input->post('consecutivo');		          
 		 	  
 		 	  if (!empty($_FILES)) {
		          $config_adjunto['upload_path']    = './uploads/libretas/fotocalendario/';
		          $config_adjunto['allowed_types']  = 'jpg|png|gif|jpeg';
		          $config_adjunto['max_size']     = '20480';
		          $config_adjunto['file_name']    = 'img_'.$data['id_session'].'_'.$data['id_diseno'].'_'.$data['variation_id'].'_'.$data['consecutivo'];
		          $config_adjunto['overwrite']    = true;
		          $this->load->library('upload', $config_adjunto);
		          //$this->upload->do_upload(); 
					foreach ($_FILES as $key => $value) {
					    if ($this->upload->do_upload($key)) {
								$data['logo'] = $this->upload->data();		
						} else {
							$data['logo']['file_name'] =$this->input->post('ca_logo');
						}					  	
					} 	          
		          
		      }   

		      //datos personales
		      $data['otro']   = $this->input->post('otro');
		      $data['titulo']   = $this->input->post('titulo');
		      if ($data['titulo'] == 'personalizado') {
		      	$data['titulo'] = $data['otro'];
		      }
		      
		      $data['nombre']   = $this->input->post('nombre');
		      $data['apellidos']   = $this->input->post('apellidos');
		      

		      $data['otro_interior']   = $this->input->post('otro_interior');
		      $data['titulo_interior']   = $this->input->post('titulo_interior');
		      if ($data['titulo_interior'] == 'personalizado') {
		      	$data['titulo_interior'] = $data['otro_interior'];
		      }
		      
		      $data['coleccion_id_igual']   = $this->input->post('coleccion_id_igual');

		      $data['nombre_interior']   = $this->input->post('nombre_interior');
		      $data['apellidos_interior']   = $this->input->post('apellidos_interior');

		      $data['coleccion_id_logo'] =  json_encode($this->input->post('coleccion_id_logo'));
		      $data['id_copia']   		 = $this->input->post('id_copia');

	          $data             =   $this->security->xss_clean($data);  
	          $data['checar']          = $this->modelo_fotocalendario->check_existente_fotocalendario( $data );
				
			   //si existe ya registros borrarlos para crear nuevo		          
	          if ($data['checar']!=false) {
		          $eliminar          = $this->modelo_fotocalendario->eliminar_fotocalendario( $data );
	          }

	          $guardar          = $this->modelo_fotocalendario->anadir_fotocalendario( $data );
	          if ( $guardar !== FALSE ){
	            echo true;
	          } else {
	            echo '<span class="error"><b>E01</b> - El nuevo fotocalendario no pudo ser agregado</span>';
	          }
	
	}    


	


	public function cargar_informacion(){ 

		       $data['id']  		 = $this->input->post('identificador');
		       $data['id_session']   = $this->input->post('id_session');

     	        $data['variation_id']   = $this->input->post('variation_id');	
     	        $data['id_diseno']   = $this->input->post('id_diseno');	
     	      $data['consecutivo']   = $this->input->post('consecutivo');	

     	    $data['old_id_diseno']   = $this->input->post('old_id_diseno');	
      	    $data['old_variation_id']   = $this->input->post('old_variation_id');	
     	  $data['old_consecutivo']   = $this->input->post('old_consecutivo');	
     	  $data['old_modulo']       = $this->input->post('old_modulo');	
     	  $data['old_ubicacion']   = $this->input->post('old_ubicacion');	

		   
		  $checar         = $this->modelo_fotocalendario->checar_existente_lista( $data );
		   //si existe ya registros borrarlos para crear nuevo		          
  

          if ($checar!=false) {
			 //datos del formulario
	          $eliminar          = $this->modelo_fotocalendario->eliminar_fotocalendario( $data );
  			

          }

			//datos del formulario	     	  
			 $logo = $this->modelo_fotocalendario->leer_info($data);
		 
		
			  $modulo = 'fotocalendario/fotocalendario'; 
	     

	     	  switch ($data['old_modulo']) {
		     	  	case 'f':
		     	  		  $modulo = 'fotocalendario/fotocalendario';
		     	  		break;
		     	  	case 'c':
		     	  		  $modulo = 'calendarios/fotocalendario';
		     	  		break;
		     	  	case 'l':
		     	  		  $modulo = 'libretas/fotocalendario';
		     	  		break;
		     	  	case 'a':
		     	  		  $modulo = 'agendas/fotocalendario';
		     	  		break;
		     	  	case 'g':
		     	  		  $modulo = 'fotoagendas/fotocalendario';
		     	  		break;
		     	  	case 'i':
		     	  		  $modulo = 'fotolibretas/fotocalendario';
		     	  		break;
	     	  }
		

			if ($logo!='') { //si hay imagen de logo 

				 $ext = substr($logo,strrpos($logo,"."));
			     $fichero    = './uploads/'.$modulo.'/'.$logo;
			      if (file_exists($fichero)) {
						$nuevo_fichero    = './uploads/libretas/fotocalendario/img_'.$data['id_session'].'_'.$data['id_diseno'].'_'.$data['variation_id'].'_'.$data['consecutivo'].$ext;
						copy($fichero, $nuevo_fichero);	
			      }
			}		

			
		   echo true;	 
	}
	
	
/////////////////validaciones/////////////////////////////////////////	
	public function valid_cero($str)
	{
		
		 $regex = "/^([-0])*$/ix";
		if ( preg_match( $regex, $str ) ){			
			$this->form_validation->set_message( 'valid_cero','<b class="requerido">*</b> El <b>%s</b> no puede ser cero.' );
			return FALSE;
		} else {
			return TRUE;
		}

	}
	
	function nombre_valido( $str ){
		 $regex = "/^([A-Za-z ñáéíóúÑÁÉÍÓÚ]{2,60})$/i";
		
		if ( ! preg_match( $regex, $str ) ){			
			$this->form_validation->set_message( 'nombre_valido','<b class="requerido">*</b> Debes llenar al menos el <b>nombre</b> o el <b>apellido</b>.' );
			return FALSE;
		} else {
			return TRUE;
		}
	}
	function valid_phone( $str ){
		if ( $str ) {
			if ( ! preg_match( '/\([0-9]\)| |[0-9]/', $str ) ){
				$this->form_validation->set_message( 'valid_phone', '<b class="requerido">*</b> El <b>%s</b> no tiene un formato válido.' );
				return FALSE;
			} else {
				return TRUE;
			}
		}
	}
	function valid_option( $str ){
		if ($str == 0) {
			$this->form_validation->set_message('valid_option', '<b class="requerido">*</b> Es necesario que selecciones una <b>%s</b>.');
			return FALSE;
		} else {
			return TRUE;
		}
	}
	function valid_date( $str ){
		$arr = explode('-', $str);
		if ( count($arr) == 3 ){
			$d = $arr[0];
			$m = $arr[1];
			$y = $arr[2];
			if ( is_numeric( $m ) && is_numeric( $d ) && is_numeric( $y ) ){
				return checkdate($m, $d, $y);
			} else {
				$this->form_validation->set_message('valid_date', '<b class="requerido">*</b> El campo <b>%s</b> debe tener una fecha válida con el formato DD-MM-YYYY.');
				return FALSE;
			}
		} else {
			$this->form_validation->set_message('valid_date', '<b class="requerido">*</b> El campo <b>%s</b> debe tener una fecha válida con el formato DD/MM/YYYY.');
			return FALSE;
		}
	}
	public function valid_email($str)
	{
		return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
	}
////////////////////////////////////////////////////////////////
	//salida del sistema
	public function logout(){
		$this->session->sess_destroy();
		redirect('');
	}	
}
/* End of file main.php */
/* Location: ./app/controllers/main.php */