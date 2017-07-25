<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Fotocalendario extends CI_Controller {
	public function __construct(){ 
		parent::__construct();
		
		$this->load->model('calendarios/modelo_fotocalendario', 'modelo_fotocalendario'); 
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


public function eliminar_logo_formulario() {

	$data['id_session']   = $this->input->post('id_session');
	$data['id_diseno']   = $this->input->post('id_diseno');
	$data['id_tamano']   = $this->input->post('id_tamano');
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
		 	      if (isset($_POST['id_tamano'])) {  
						 foreach ($data['datos'] as $llave => $valor) {
					          	if (  ($valor->id_tamano == $_POST['id_tamano']) and 
					          		  ($valor->id_diseno == $_POST['id_diseno']) and 
					          		  ($valor->consecutivo == $_POST['consecutivo'])  
					          		){
					          		$id_registro= $llave+1; //llave es el nuemero de registro 0..n
					          	}	
				          } 
			 	      		//en funcion del elemento posicionado  pasado debo buscar el siguiente
			  	 	     //$data['posicionDiseno']   = $data['datos'][$id_registro]->id_tamano; // borrar en el futuro
			  	 	     	
			  	 	     	  
			  	 	     	  $data['id_diseno']   = $data['datos'][$id_registro]->id_diseno; 
			  	 	     	  $data['id_tamano']   = $data['datos'][$id_registro]->id_tamano; 
			  	 	        $data['consecutivo']   = $data['datos'][$id_registro]->consecutivo; 


			  	 	        //2- cuando se "refresque" o sea llamado por "primera vez"	
				 	      } else {  
					 	      //$data['posicionDiseno']  = $data['datos'][0]->id_tamano; //borrar en el futuro
					 	      $data['id_diseno']       = $data['datos'][0]->id_diseno; 
					 	      $data['id_tamano']       = $data['datos'][0]->id_tamano; 
					 	      $data['consecutivo']     = $data['datos'][0]->consecutivo;
				 	      }

					
				 	       //3- especificamente para la edicion "checar este"
						  if (isset($_POST['id_edicion_tamano'])) {  
						  		 //$data['posicionDiseno']   = $_POST['id_edicion_tamano'];
						  		 	  $data['id_tamano']   = $_POST['id_edicion_tamano'];
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
			   $data['festividades'] = $this->modelo_fotocalendario->listado_festividades();
			   $data['logos'] = $this->modelo_fotocalendario->listado_logos();		 	   

			//Leer los datos sobre el calendario activo
			$data['calendario']       = $this->modelo_fotocalendario->fotocalendario_edicion( $data );
			$data['informacion']      = $this->modelo_fotocalendario->info_activo($data);

			//para mostrar las listas asociada a este usuario
			     $data['listas'] = $this->modelo_fotocalendario->listado_listas($data);

			$data['listas_todo'] = $this->modelo_fotocalendario->listado_todolistas($data);
			$data['listas_titulo'] = $this->modelo_fotocalendario->listas_titulo($data);
			
			$this->load->view( 'sitio/calendarios/fotocalendario/seccion3', $data );
		} 	
	}

//OK
public function calenda_activos() {

	$data['id_session']    = $this->input->post('id_session');
	$data['id_tamano']     = $this->input->post('id_tamano');
	$data['id_diseno']     = $this->input->post('id_diseno');
	$data['consecutivo']   = $this->input->post('consecutivo');
	
	$data['datos'] = $this->modelo_fotocalendario->calenda_activos($data);

	$data['total']           = $this->modelo_fotocalendario->total_disenos( $data );
	$data['total_disenos']   = $this->modelo_fotocalendario->total_disenos_completos( $data );



    $cale_activo = array();
    if ($data['datos'] != false)  {     
         foreach( (json_decode(json_encode($data['datos']))) as $clave =>$valor ) {
              array_push($cale_activo,array('id_tamano' => $valor->id_tamano, 'id_diseno' => $valor->id_diseno, 'consecutivo' => $valor->consecutivo) );  
       }
    } 

	echo json_encode($cale_activo);

}




//OK elimina un diseño especifico
public function eliminar_diseno_completo(){

	$data['id_session']    	= $this->input->post('id_session');
	$data['id_tamano']   	= $this->input->post('id_tamano');
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

	/*
	$data['datos'] = $this->modelo_fotocalendario->disenos_completos($data);
    $cale_activo = array();
    if ($data['datos'] != false)  {     
         foreach( (json_decode(json_encode($data['datos']))) as $clave =>$valor ) {
              array_push($cale_activo,array('id_tamano' => $valor->id_tamano,'id_diseno' => $valor->id_diseno,'consecutivo' => $valor->consecutivo, 'cantidad' => $valor->cantidad));  
       }
    } */
	
	$todo = array (
	    //"cale_activo" => $cale_activo,
	    "total"  => $data['total'],
	    "total_disenos"  => $data['total_disenos'],
        "ultimo_elemento"  =>$data['ultimo_elemento']
    );              
 
   echo json_encode($todo);   


}


	
	//OK valida aqui el continuar "Haber si al menos tiene titulo"


	public function validar_nuevo_fotocalendario(){
	
		  //$this->form_validation->set_rules( 'id_mes', 'Mes de cumpleaños', 'trim|required|callback_valid_cero|xss_clean');
		  $this->form_validation->set_rules( 'id_dia', 'Día de cumpleaños', 'trim|required|callback_valid_cero|xss_clean');

	      if ( ($this->form_validation->run() === TRUE) || ($novalida === TRUE) ) {
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
			
	      } else {      
	        echo validation_errors('<span class="error">','</span>');
	      }


	}	
	
	



	 //OK Aqui si no hubo lista a guardar pasa al formulario de imagen
	
	function noguardar_lista() {

	          $data['id_session']   = $this->input->post('id_session');

 			  $data['id_tamano']   =   $this->input->post('id_tamano');	
	          $data['id_diseno']   =   $this->input->post('id_diseno');	
	          $data['consecutivo']   =   $this->input->post('consecutivo');		          
 		 	  
 		 	  if (!empty($_FILES)) {
		          $config_adjunto['upload_path']    = './uploads/calendarios/fotocalendario/';
		          $config_adjunto['allowed_types']  = 'jpg|png|gif|jpeg';
		          $config_adjunto['max_size']     = '20480';
		          $config_adjunto['file_name']    = 'img_'.$data['id_session'].'_'.$data['id_diseno'].'_'.$data['id_tamano'].'_'.$data['consecutivo'];
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


	          //el true al final es para convertirlo a Array de lo contrario será objeto
	          // array creado con todos los "Dias y meses de el tamaño activo"
        	  //$data['listadias']   = json_encode($this->input->post('listadias'),true);
		      //$data['nombre_mes']   = json_encode($this->input->post('nombre_mes'),true);

		      //$data['listadias']   =  json_decode(json_encode(array(stripslashes($this->input->post('listadias')))),true);
		      //$data['nombre_mes']   = json_decode(json_encode(array(stripslashes($this->input->post('nombre_mes')))),true);

		      $data['listadias']   =  json_decode(stripslashes($this->input->post('listadias')),true);
		      $data['nombre_mes']   = json_decode(stripslashes($this->input->post('nombre_mes')),true);

		      //print_r($data['listadias']);
		      //die;

		      //datos personales
		      $data['otro']   = $this->input->post('otro');
		      $data['titulo']   = $this->input->post('titulo');
		      if ($data['titulo'] == 'personalizado') {
		      	$data['titulo'] = $data['otro'];
		      }
		      

		      $data['nombre']   = $this->input->post('nombre');
		      $data['apellidos']   = $this->input->post('apellidos');
		      
		      $data['coleccion_id_logo'] =  json_encode($this->input->post('coleccion_id_logo'));
		      $data['id_copia']   		 = $this->input->post('id_copia');
		      $data['id_dia']   		 = $this->input->post('id_dia');
		      $data['id_mes']  			 = $this->input->post('id_mes');
		      $data['id_festividad']     = $this->input->post('id_festividad');

	          $data             =   $this->security->xss_clean($data);  
	          $data['checar']          = $this->modelo_fotocalendario->check_existente_fotocalendario( $data );
				
			   //si existe ya registros borrarlos para crear nuevo		          
	          if ($data['checar']!=false) {
	          	  
	        	  $eliminar          = $this->modelo_fotocalendario->eliminar_nombre_mes( $data );
		          $eliminar          = $this->modelo_fotocalendario->eliminar_listadias( $data );
		          $eliminar          = $this->modelo_fotocalendario->eliminar_fotocalendario( $data );
	          }

	          $guardar          = $this->modelo_fotocalendario->anadir_nombre_mes( $data );
	          $guardar          = $this->modelo_fotocalendario->anadir_listadias( $data );
	          $guardar          = $this->modelo_fotocalendario->anadir_fotocalendario( $data );
	          if ( $guardar !== FALSE ){
	            echo true;
	          } else {
	            echo '<span class="error"><b>E01</b> - El nuevo fotocalendario no pudo ser agregado</span>';
	          }
	
	}    

	//OK
	function guardar_lista() {
		
		  //este es en caso de que se necesite guardar la lista	
		  $this->form_validation->set_rules('nombre_lista', 'Nombre', 'trim|required|min_length[3]|max_lenght[180]|xss_clean');
		  //$this->form_validation->set_rules( 'correo_lista', 'Correo', 'trim|required|valid_email|xss_clean');
		  //$this->form_validation->set_rules( 'id_mes', 'Mes de cumpleaños', 'trim|required|callback_valid_cero|xss_clean');
		  $this->form_validation->set_rules( 'id_dia', 'Día de cumpleaños', 'trim|required|callback_valid_cero|xss_clean');

 		 if ($this->form_validation->run() === TRUE){
	          //generar uid
 		 	  $data['id_session']   = $this->input->post('id_session');

		      $data['id_tamano']   =   $this->input->post('id_tamano');	
	          $data['id_diseno']   =   $this->input->post('id_diseno');	
	          $data['consecutivo']   =   $this->input->post('consecutivo');	

 		 	  if (!empty($_FILES)) {
		          $config_adjunto['upload_path']    = './uploads/calendarios/fotocalendario/';
		          $config_adjunto['allowed_types']  = 'jpg|png|gif|jpeg';
		          $config_adjunto['max_size']     = '20480';
		          
		          $config_adjunto['file_name']    = 'img_'.$data['id_session'].'_'.$data['id_diseno'].'_'.$data['id_tamano'].'_'.$data['consecutivo'];
		          $config_adjunto['overwrite']    = true;
		          $this->load->library('upload', $config_adjunto);
					foreach ($_FILES as $key => $value) {
					    if ($this->upload->do_upload($key)) {
								$data['logo'] = $this->upload->data();		
						} else {
							$data['logo']['file_name'] =$this->input->post('ca_logo');
						}					  	
					} 	          
		       }    

	          //el true al final es para convertirlo a Array de lo contrario será objeto
	          // array creado con todos los "Dias y meses de el tamaño activo"
        	  //$data['listadias']   = json_decode($this->input->post('listadias'),true);
		      //$data['nombre_mes']   = json_decode($this->input->post('nombre_mes'),true);

    		  $data['listadias']   =  json_decode(stripslashes($this->input->post('listadias')),true);
		      $data['nombre_mes']   = json_decode(stripslashes($this->input->post('nombre_mes')),true);


		      //este es en caso de que se necesite guardar la lista
		      $data['nombre_lista']   = $this->input->post('nombre_lista');
		      $data['correo_lista']   = $this->input->post('correo_lista');
		      

		      //datos personales
		      $data['otro']   = $this->input->post('otro');
		      $data['titulo']   = $this->input->post('titulo');
		      if ($data['titulo'] == 'personalizado') {
		      	$data['titulo'] = $data['otro'];
		      }

		      
		      $data['nombre']   = $this->input->post('nombre');
		      $data['apellidos']   = $this->input->post('apellidos');
		      //$data['logo']   =  'prueba.jpg'; // $this->input->post('logo');
		      $data['coleccion_id_logo']   =  json_encode($this->input->post('coleccion_id_logo'));
		      
		      $data['id_copia']   		 = $this->input->post('id_copia');
		      $data['id_dia']   = $this->input->post('id_dia');
		      $data['id_mes']   = $this->input->post('id_mes');
		      $data['id_festividad']   = $this->input->post('id_festividad');
	          $data             =   $this->security->xss_clean($data);  
	          //lista

	          $data['id_lista']          = $this->modelo_fotocalendario->anadir_lista( $data );

	          $guardar          = $this->modelo_fotocalendario->anadir_lista_listadias( $data );
	          $guardar          = $this->modelo_fotocalendario->anadir_lista_nombre_mes( $data );
	         


  			 $data['checar']          = $this->modelo_fotocalendario->check_existente_fotocalendario( $data );
				
			   //si existe ya registros borrarlos para crear nuevo		          
	          if ($data['checar']!=false) {
	          	  
	        	  $eliminar          = $this->modelo_fotocalendario->eliminar_nombre_mes( $data );
		          $eliminar          = $this->modelo_fotocalendario->eliminar_listadias( $data );
		          $eliminar          = $this->modelo_fotocalendario->eliminar_fotocalendario( $data );
	          }

	          //fotocalendario
	          $guardar          = $this->modelo_fotocalendario->anadir_nombre_mes( $data );
	          $guardar          = $this->modelo_fotocalendario->anadir_listadias( $data );
	          $guardar          = $this->modelo_fotocalendario->anadir_fotocalendario( $data );
	          if ( $guardar !== FALSE ){
	            echo true;
	          } else {
	            echo '<span class="error"><b>E01</b> - El nuevo fotocalendario no pudo ser agregado</span>';
	          }
	      } else {      
	        echo validation_errors('<span class="error">','</span>');
	      }
	  	  
	}    

	public function diseno_lista(){
		
         	  //$data['id_session']   = base64_decode($this->input->post('id_session'));	
         	  $data['id_session']   = ($this->input->post('id_session'));	
         	  $data['id_tamano']   = $this->input->post('id_tamano');	
         	  $data['id_diseno']   = $this->input->post('id_diseno');	
         	  $data['consecutivo']   = $this->input->post('consecutivo');	

         	  
     	      $dato['listas_dia'] = $this->modelo_fotocalendario->listadias_fcalendario($data);
      		  $dato['list_mes'] = $this->modelo_fotocalendario->listames_fcalendario($data);
		      	   
		      	   
				    $list_dia = array();
				    if ($dato['listas_dia'] != false)  {     
				         foreach( (json_decode(json_encode($dato['listas_dia']))) as $clave =>$valor ) {
				              array_push($list_dia,array('ano' => $valor->ano, 'mes' => $valor->mes, 'dia' => $valor->dia,'valor' => $valor->valor,
				              							'id_tamano' => $valor->id_tamano,'id_diseno' => $valor->id_diseno,'consecutivo' => $valor->consecutivo));  
													
													

				       }
				    } 
				    
				    //127JGsB469

				    $list_mes = array();
				    if ($dato['list_mes'] != false)  {     
				         foreach( (json_decode(json_encode($dato['list_mes']))) as $clave =>$valor ) {
				              array_push($list_mes,array('ano' => $valor->ano, 'mes' => $valor->mes,'valor' => $valor->valor,
				              							'id_tamano' => $valor->id_tamano,'id_diseno' => $valor->id_diseno,'consecutivo' => $valor->consecutivo));  
				       }
				    } 
				    
              $todo = array (
                "list_dia" => $list_dia,
                "list_mes"  => $list_mes
	          );              
             
             echo json_encode($todo);    
	}

	public function leer_lista(){
		
         	  $data['correo_activo']   = $this->input->post('correo_activo');
		      	   $data['id_lista']   = $this->input->post('id_lista');
		      	   $data['id_session']   = $this->input->post('id_session');
		      	   $data['ubicacion_old']   = $this->input->post('ubicacion_old');
		      	   
		      	   $dato['listas_dia'] = $this->modelo_fotocalendario->listadias_cambiar($data);
		      	   $dato['list_mes'] = $this->modelo_fotocalendario->listames_cambiar($data);
				    $list_dia = array();
				    if ($dato['listas_dia'] != false)  {     
				         foreach( (json_decode(json_encode($dato['listas_dia']))) as $clave =>$valor ) {
				              array_push($list_dia,array('ano' => $valor->ano, 'mes' => $valor->mes, 'dia' => $valor->dia,'valor' => $valor->valor,
				              							'id_tamano' => $valor->id_tamano,'id_diseno' => $valor->id_diseno,'consecutivo' => $valor->consecutivo));    
				       }
				    } 
				    //127JGsB469
				    $list_mes = array();
				    if ($dato['list_mes'] != false)  {     
				         foreach( (json_decode(json_encode($dato['list_mes']))) as $clave =>$valor ) {
				              array_push($list_mes,array('ano' => $valor->ano, 'mes' => $valor->mes,'valor' => $valor->valor,
				              							'id_tamano' => $valor->id_tamano,'id_diseno' => $valor->id_diseno,'consecutivo' => $valor->consecutivo));  
				       }
				    } 
              $todo = array (
                "list_dia" => $list_dia,
                "list_mes"  => $list_mes
	          );              
             
             echo json_encode($todo);    

	}
	


	public function cargar_informacion(){ 

		       $data['id']  		 = $this->input->post('identificador');
		       $data['id_session']   = $this->input->post('id_session');

     	        $data['id_tamano']   = $this->input->post('id_tamano');	
     	        $data['id_diseno']   = $this->input->post('id_diseno');	
     	      $data['consecutivo']   = $this->input->post('consecutivo');	

     	    $data['old_id_diseno']   = $this->input->post('old_id_diseno');	
      	    $data['old_id_tamano']   = $this->input->post('old_id_tamano');	
     	  $data['old_consecutivo']   = $this->input->post('old_consecutivo');	
     	  $data['old_modulo']   = $this->input->post('old_modulo');	
     	  $data['old_ubicacion']   = $this->input->post('old_ubicacion');	




		  $checar         = $this->modelo_fotocalendario->checar_existente_lista( $data );
		   //si existe ya registros borrarlos para crear nuevo		          
  

          if ($checar!=false) {
			 //datos del formulario
        	  //$eliminar          = $this->modelo_fotocalendario->eliminar_nombre_mes( $data );
	          //$eliminar          = $this->modelo_fotocalendario->eliminar_listadias( $data );
	          $eliminar          = $this->modelo_fotocalendario->eliminar_fotocalendario( $data );
  			
          }

			//datos del formulario	     	  
			 $logo = $this->modelo_fotocalendario->leer_info($data);
			 //$this->modelo_fotocalendario->listames_info($data);
			 //$this->modelo_fotocalendario->listadias_info($data);

		 
		
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
						$nuevo_fichero    = './uploads/calendarios/fotocalendario/img_'.$data['id_session'].'_'.$data['id_diseno'].'_'.$data['id_tamano'].'_'.$data['consecutivo'].$ext;
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