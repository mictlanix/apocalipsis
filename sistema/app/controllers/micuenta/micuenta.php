<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Micuenta extends CI_Controller {
	public function __construct(){ 
		parent::__construct();
		
		$this->load->model('fotocalendarios/modelo_micuenta', 'modelo_fotocalendario'); 
		$this->load->model('fotocalendarios/modelo_borrar_datos', 'modelo_borrar_datos'); 
		$this->load->library(array('email')); 
        $this->load->library('Jquery_pagination');//-->la estrella del equipo		
	}

///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////

	//OK comienza aqui a mostrar el formulario

public function index() {
		$session = base64_encode($this->session->userdata('session_id'));
		$data['id_session'] = base64_decode($session);		
		$data['correo_activo']   = 'no';
		$data['listas'] = $this->modelo_fotocalendario->listado_listas($data);
		$this->load->view( 'sitio/micuenta/fotocalendario/seccion3', $data );
}

	//estrategas.calendarioEvento.js lo llama para cargar la lista elegida
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
	

	//view "seccion3.php"(hace submit) y "sistema.js" lo invoca
	//OK valida aqui el continuar "Haber si al menos tiene titulo"
	public function validar_nuevo_fotocalendario(){
	       echo true;
	
	}	



	 //OK Aqui si no hubo lista a guardar pasa al formulario de imagen
	
	function noguardar_lista() {
	            echo true;
	}    

	//OK
	function guardar_lista() {
		
		  //este es en caso de que se necesite guardar la lista	
		 $this->form_validation->set_rules('nombre_lista', 'Nombre', 'trim|required|min_length[3]|max_lenght[180]|xss_clean');

 		 if ($this->form_validation->run() === TRUE){
	          //generar uid
 		 	  $data['id_session']   = $this->input->post('id_session');

 		 	  //dias y meses
    		  $data['listadias']   =  json_decode(stripslashes($this->input->post('listadias')),true);
		      $data['nombre_mes']   = json_decode(stripslashes($this->input->post('nombre_mes')),true);

		      //el nombre de la lista y el correo
		      $data['nombre_lista']   = $this->input->post('nombre_lista');
		      $data['correo_lista']   = $this->input->post('correo_lista');

	          $data             =   $this->security->xss_clean($data);  
	          //lista

	          $data['id_lista']          = $this->modelo_fotocalendario->anadir_lista( $data );
	          $guardar          = $this->modelo_fotocalendario->anadir_lista_listadias( $data );
	          $guardar          = $this->modelo_fotocalendario->anadir_lista_nombre_mes( $data );
          


	          if ( $guardar !== FALSE ){
	            echo true;
	          } else {
	            echo '<span class="error"><b>E01</b> - La nueva lista no pudo ser agregada</span>';
	          }

	      } else {      
	        echo validation_errors('<span class="error">','</span>');
	      }
	  	  
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
		//if ( ! preg_match( '/^[A-Za-zÁÉÍÓÚáéíóúÑñ \s]/', $str ) ){
		if ( ! preg_match( $regex, $str ) ){			
			$this->form_validation->set_message( 'nombre_valido','<b class="requerido">*</b> La información introducida en <b>%s</b> no es válida.' );
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