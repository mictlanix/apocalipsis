<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Fotorevise extends CI_Controller {
	public function __construct(){ 
		parent::__construct();
		
		$this->load->model('fotoagendas/modelo_revise', 'modelo_revise'); 
		$this->load->library(array('email')); 
        $this->load->library('Jquery_pagination');//-->la estrella del equipo		
	}

	  //ok **
    public function index($session){

    	    $data['id_session'] =  base64_decode($session);		

    	    if (isset($_POST['variation_id'])) {  //
    	    	
    	    	$data['id_diseno']   =  $_POST['id_diseno'];
    	    	$data['variation_id']   =  $_POST['variation_id'];
    	    	$data['consecutivo']   =  $_POST['consecutivo'];

    	    	$data['ano']   =  $_POST['ano'];

    	    }	else {

    	    	$data['id_diseno']   =  0;
    	    	$data['variation_id']   =  0;
    	    	$data['consecutivo'] =  0;

    	    	$data['ano'] =  date("Y");
    	    	
    	    }

		    $data['datos']       = $this->modelo_revise->revisa_activos( $data );
			$data['nombre_meses']    = $this->modelo_revise->mensaje_mes( $data );
		   $data['fechas_especiales']    = $this->modelo_revise->fechas_especiales( $data );		    
		   
    	   $this->load->view( 'sitio/fotoagendas/fotorevise/revise', $data );	

    }	
	


	public function eliminar_diseno_revise(){
		  $data['id_session']  = $this->input->post('id_session');
		
		$data['id_diseno']     = $this->input->post('id_diseno');
		$data['variation_id']     = $this->input->post('variation_id');
		$data['consecutivo']   = $this->input->post('consecutivo');

		$data['eliminacion'] = $this->modelo_revise->eliminar_diseno_revise($data);
		$data['total']           = $this->modelo_revise->total_disenos( $data );
		$data['total_disenos']   = $this->modelo_revise->total_disenos_completos( $data );
	
		echo json_encode($data);
	}





  //ok **
	public function activar_carrito(){
		$data['id_session']  = $this->input->post('id_session');
		
		$data['id_diseno']     = $this->input->post('id_diseno');
		$data['variation_id']     = $this->input->post('variation_id');
		$data['consecutivo']   = $this->input->post('consecutivo');
		
		$data['total']           = $this->modelo_revise->total_disenos( $data );
		$data['total_disenos']   = $this->modelo_revise->total_disenos_completos( $data );
	
	
		echo json_encode($data);
	}




	public function guardar_info_revise(){

		       $data['id_session']   = $this->input->post('id_session');
		        $data['id_diseno']   = $this->input->post('id_diseno');	
     	     $data['variation_id']   = $this->input->post('variation_id');	
     	      $data['consecutivo']   = $this->input->post('consecutivo');	
      	         $data['id_copia']   = $this->input->post('id_copia');	


	   

		$data['datos']       = $this->modelo_revise->leer_info_carrito( $data );			      	   		   
		
		$data['tmcartepo']  = htmlspecialchars( ($data['datos'][0]->objeto_adicionales) );	
		$data['tmcartepo']  =  json_decode(strval(html_entity_decode($data['tmcartepo'])),true);

		$data['cantidad']  = $data['datos'][0]->cantidad;	


		$_REQUEST = $data; 

		$objeto_diseno = htmlspecialchars( ($data['datos'][0]->objeto_diseno) );
		$producto = json_decode(strval(html_entity_decode($objeto_diseno)),true);
		
		$product_id          = $producto['product_id']; 
	    $was_added_to_cart   = false;
    	$adding_to_cart      = wc_get_product( $product_id );		

	  	if ( ! $adding_to_cart ) {
	      return;
	    }
		
		//print_r($data['datos']);
		//var_dump($producto['product_id']);
		
		$campo_variacion = $data['datos'][0]->campo_variacion;
		$nombre_variacion =  $data['datos'][0]->nombre_tamano;
		$variation_id =  $data['datos'][0]->variation_id;
		
		$variations = Array ( 
            $campo_variacion => $nombre_variacion,
           

          );

        WC()->cart->add_to_cart( $product_id, $data['cantidad'], $variation_id, $variations );

		$checar         = $this->modelo_revise->check_existente_fotocalendario( $data );
  
		if ($checar!=false) {   
			//datos del formulario	     	  
			 $this->modelo_revise->leer_info_identificador($data);
			 $this->modelo_revise->leer_info($data);

			 //eliminar todo lo q se pasó al carrito
			 $this->modelo_revise->eliminar_diseno_completo($data); 

		}	 

		$data['total']           = $this->modelo_revise->total_disenos( $data );
		$data['total_disenos']   = $this->modelo_revise->total_disenos_completos( $data );

		print_r($data['total_disenos']);
		echo json_encode($data);
	

	}



	public function guardar_historico_informacion(){ 

		       //$data['id']  		 = $this->input->post('identificador');
		       $data['id_session']   = $this->input->post('id_session');
		        $data['id_diseno']   = $this->input->post('id_diseno');	
     	        $data['variation_id']   = $this->input->post('variation_id');	
     	      $data['consecutivo']   = $this->input->post('consecutivo');	
		   
		  $checar         = $this->modelo_revise->check_existente_fotocalendario( $data );
  
		if ($checar!=false) {   

		//datos del formulario	     	
			 //copiar a "historico_logueo_identificador"
			 $this->modelo_revise->leer_info_identificador($data);

			 //copiar a "historico_fotocalendario_temporal"
			 $this->modelo_revise->leer_info($data);

			 //copiar a "historico_nombre_meses"
			 $this->modelo_revise->listames_info($data);

			 //copiar a "historico_fechas_especiales"
			 $this->modelo_revise->listadias_info($data);

		//imagenes
			 //copiar a "historico_fotocalendario_imagenes_original"
			 $imagenes = $this->modelo_revise->leer_imagenes_original($data);
			 //copiar a "historico_fotocalendario_imagenes_recorte"
			 $imagenes = $this->modelo_revise->leer_imagenes_recorte($data);
			 //copiar a "historico_fotocalendario_imagenes"
			 $imagenes = $this->modelo_revise->leer_imagenes($data); 

  	    //elimina todas las tablas de arriba pero sin "Historico_"
			 $imagenes = $this->modelo_revise->eliminar_diseno_completo($data); 




		}	 

		$data['total']           = $this->modelo_revise->total_disenos( $data );
		$data['total_disenos']   = $this->modelo_revise->total_disenos_completos( $data );

		echo json_encode($data);
	
		
	}
	

	public function anadir_carrito(){
		$data['id_session']  = $this->input->post('id_session');
		$data['datos']       = $this->modelo_revise->revisa_activos( $data );			      	   		   
		echo json_encode($data);

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