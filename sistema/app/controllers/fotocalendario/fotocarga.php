<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Fotocarga extends CI_Controller {
	public function __construct(){ 
		parent::__construct();
		
		$this->load->model('fotocalendarios/modelo_fotocarga', 'modelo_fotocarga'); 
		$this->load->model('fotocalendarios/modelo_fotocalendario', 'modelo_fotocalendario'); 
		$this->load->library(array('email')); 
        $this->load->library('Jquery_pagination');//-->la estrella del equipo		
	}


	//ok
	public function index($session) {

		$data['id_session'] = base64_decode($session);
		
		  $data['datos'] = $this->modelo_fotocarga->correo_logueo($data);

		 //1- cuando es llamado 
		if (isset($_POST['id_diseno'])) {
				//$data['id_diseno']   = $_POST['id_tamano']; // el diseño que se va activar
				$data['id_diseno']     = $_POST['id_diseno']; // el diseño que se va activar
				$data['id_tamano']     = $_POST['id_tamano']; // el diseño que se va activar
				$data['consecutivo']   = $_POST['consecutivo']; // el diseño que se va activar

				$data['ano']  		 = $_POST['ano'];  //en que año
				$data['mes']  		 = $_POST['mes'];  //y en q mes
		  //2- para recoger el 1er diseño si refresca	
		} else { 
			$data['datos'] = $this->modelo_fotocarga->correo_logueo($data);

		
				 if ($data['datos']){
			      	  $data['id_diseno']    = $data['datos'][0]->id_diseno; //1; //leer el 1er tamaño
			      	  $data['id_tamano']    = $data['datos'][0]->id_tamano;
			      	  $data['consecutivo']    = $data['datos'][0]->consecutivo;

    	        	  $data['ano'] = date("Y");
			  		  $data['mes'] = 0; //date("m")-1; mes actual

			     } 	  


		}

		if  ($data['datos'] ) {
			$this->load->view( 'sitio/fotocalendario/fotocarga/carga',$data );	
			
			//$this->load->view( 'sitio/fotocalendario/fotocarga/ancla',$data );	
			//anchor('foo', 'sadsa', $data)

		} else {
			redirect('');

		}
		
	}


	

	
	
	
/////////////////validaciones/////////////////////////////////////////	
	public function valid_cero($str) {
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
	public function valid_email($str) {
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