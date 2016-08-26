<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Fcalendario extends CI_Controller {
	public function __construct(){ 
		parent::__construct();
		$this->load->model('fotocalendarios/modelo_fcalendario', 'modelo_fcalendario'); 
		$this->load->library(array('email')); 
        $this->load->library('Jquery_pagination');//-->la estrella del equipo		
	}


	public function index(){
			$this->load->view( 'sitio/fotocalendario/principal/principal'); 

	}	



	//new: solo se agrego id_variation a  leer_marcados
	public function leer_marcados(){  
		$data['id_session'] = $this->session->userdata('session_id');
		$datos['valores']  =  $this->modelo_fcalendario->leer_marcados( $data );
		$datos['existencia']  =  $this->modelo_fcalendario->existencia( $data );
		$datos['existencia_fijo']  =  $this->modelo_fcalendario->existencia_fijo( $data );
		$datos['total_disenos']   = $this->modelo_fcalendario->total_disenos_completos( $data );
		echo json_encode($datos);

	}


	
	//este no va a existir
	public function guardar_tamanos(){

		$data['id_session'] = $this->session->userdata('session_id');
		//variacions de cada producto
		$data['producto'] =    json_encode( $this->input->post('prod')   );
		$producto =  json_decode(json_encode( $this->input->post('prod') ),true  );


		$data['id_diseno'] = $producto['product_id'];
		$data['nombre_diseno'] = $producto['modelo'];
		$data['imagen_diseno'] = $producto['imagen_diseno'];
        
	    foreach ($producto['variaciones_producto'] as $key => $value) {
	      	$data['variation_id'] = $value['variation_id'];
	      	$data['nombre_variacion'] = $value['nombre_variacion'];
	      	$data['campo_variacion'] = $value['campo_variacion'];
	      	 
	      	
	      	$data['descripcion_variacion'] = $value['descripcion_variacion'];
	      	$data['imagen_variacion'] = $value['imagen_variacion'];
	      	$resultado  =  $this->modelo_fcalendario->agregar_disenos( $data );
	  
	    }     
	    //copiar de la tabla "logueo" -> identificador (resultado true)
	    $datos['resultado']  =  $this->modelo_fcalendario->actualizar_disenos_real( $data );
		echo json_encode($datos);	    


	}	



	public function actualizar_disenos(){
		
		$data['id_session'] = $this->session->userdata('session_id');
		$data['datos']  = (object)($this->input->post('datos'));

		$datos['valores']  =  $this->modelo_fcalendario->agregar_disenos( $data );
		$datos['resultado']  =  $this->modelo_fcalendario->actualizar_disenos( $data );

		echo json_encode($datos);

	}








/////////////////validaciones/////////////////////////////////////////	
	public function valid_cero($str)
	{
		return (  preg_match("/^(0)$/ix", $str)) ? FALSE : TRUE;
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