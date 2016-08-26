<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class libretas extends CI_Controller {
	public function __construct(){ 
		parent::__construct();
		$this->load->model('libretas/modelo_fcalendario', 'modelo_fcalendario'); 
		$this->load->library(array('email')); 
        $this->load->library('Jquery_pagination');//-->la estrella del equipo		
	}


//comienza aqui a mostrar el formulario
	public function index(){
		$session_id = $this->session->userdata('session_id');
		//print_r($session_id);
		 $this->load->view( 'sitio/principal/lib/woocommerce-api' ); 
		 
		 $options = array(
			'debug'           => true,
			'return_as_array' => false,
			'validate_url'    => false,
			'timeout'         => 30,
			'ssl_verify'      => false,
		);

			try {


				$client = new WC_API_Client( get_site_url(), 'ck_1b17ffab9e4c51def72a9bc5f56bf1115f5367a7', 'cs_041111c09cb4161c30ccf554229cf5e8eadc5efa', $options );					


			    $categorias = ( ($client->products->get_categories()) );

			    $datos['las_categorias_productos'] = $categorias->product_categories;

			                  $datos['productos']= ( $client->products->get() );

			                  $datos['categoria_activa']='libretas';
		
			} catch ( WC_API_Client_Exception $e ) {

			    echo $e->getMessage() . PHP_EOL;
			    echo $e->getCode() . PHP_EOL;

			    if ( $e instanceof WC_API_Client_HTTP_Exception ) {

			        print_r( $e->get_request() );
			        print_r( $e->get_response() );
			    }
			}


			$this->load->view( 'sitio/libretas/principal/principal',$datos ); 
		

	}	

	public function guardar_tamanos(){
		
		$data['id_session'] = $this->session->userdata('session_id');
		$data['datos']  = (object)($this->input->post('datos'));
					
		$datos['valores']  =  $this->modelo_fcalendario->eliminar_diseno_tamano( $data );
		$datos['existencia']  =  $this->modelo_fcalendario->existencia( $data );
		$datos['existencia_fijo']  =  $this->modelo_fcalendario->existencia_fijo( $data );

		echo json_encode($datos);

	}

	public function actualizar_disenos(){
		
		$data['id_session'] = $this->session->userdata('session_id');
		$data['datos']  = (object)($this->input->post('datos'));
		$datos['valores']  =  $this->modelo_fcalendario->eliminar_diseno_tamano( $data );
		$datos['resultado']  =  $this->modelo_fcalendario->actualizar_disenos( $data );
		echo json_encode($datos);

	}





	public function leer_marcados(){
		
		$data['id_session'] = $this->session->userdata('session_id');
		
		$datos['valores']  =  $this->modelo_fcalendario->leer_marcados( $data );
		$datos['existencia']  =  $this->modelo_fcalendario->existencia( $data );
		$datos['existencia_fijo']  =  $this->modelo_fcalendario->existencia_fijo( $data );
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