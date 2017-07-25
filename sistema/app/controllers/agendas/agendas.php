<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class agendas extends CI_Controller {
	public function __construct(){ 
		parent::__construct();
		$this->load->model('agendas/modelo_fcalendario', 'modelo_fcalendario'); 
		$this->load->library(array('email')); 
        $this->load->library('Jquery_pagination');//-->la estrella del equipo		
	}


    //comienza aqui a mostrar el formulario

	public function index($id_categ='agendas',$pag='page', $cant=1){

			if ($id_categ=='page') {
				$cant=(int)$pag;
				$pag='page';
				$id_categ='agendas';
			}

			$data['pagina'] =$cant;
			$data['id_categ'] =$id_categ;
			$this->load->view( 'sitio/agendas/principal/principal',$data); 
	}	




	public function taxonomia_tipo_agendas(){  
		$datos['taxonomia_tipo_agendas']  =  $this->modelo_fcalendario->taxonomia_tipo_agendas( $data );
		echo json_encode($datos);
	}

	//http://www.todoexpertos.com/categorias/tecnologia-e-internet/bases-de-datos/mysql/respuestas/2485299/campo-para-guardar-descripciones-de-texto-largas


/*  Array ( [modelo] => este es agendas 
			[imagen_diseno] => http://tinbox.dev.com/wp-content/uploads/2016/02/thumb-2.jpg 
			[product_id] => 91
			[id_session] => 57320d84bd238fdb2695bc171eb2a816 
			[variaciones_producto] => Array ( 
				[0] => Array ( 
						[nombre_diseno] => este es agendas
						[nombre_variacion] => tip_agenda1 
						[descripcion_variacion] => tipo mi agenda2 
						[variation_id] => 215
						[imagen_variacion] => http://tinbox.dev.com/wp-content/uploads/2016/02/4_organizador-1.jpg 
						)

				[1] => Array ( [nombre_diseno] => este es agendas [nombre_variacion] => tip_agenda1 [descripcion_variacion] => tipo1 agenda [variation_id] => 215 [imagen_variacion] => http://tinbox.dev.com/wp-content/uploads/2016/02/1_cd-1.jpg ) ) 
				[descripcion_color] => azul )
*/
	public function guardar_info(){

		$data['id_session'] = $this->session->userdata('session_id');
		//color
		$data['tmcartepo']  =  json_encode( $this->input->post('datos')  );
		//variacions
		$data['producto'] =    json_encode( $this->input->post('prod')   );

		$producto =  json_decode(json_encode( $this->input->post('prod') ),true  );


		$data['id_diseno'] = $producto['product_id'];
		$data['nombre_diseno'] = $producto['modelo'];
		$data['imagen_diseno'] = $producto['imagen_diseno'];
		$data['descripcion_color'] = $producto['descripcion_color'];

		$data['logos'] = $producto['logos'];
		$data['longitud_nombre'] = $producto['longitud_nombre'];
		$data['longitud_texto'] = $producto['longitud_texto'];
        
	    foreach ($producto['variaciones_producto'] as $key => $value) {
	      	$data['variation_id'] = $value['variation_id'];
	      	$data['nombre_variacion'] = $value['nombre_variacion'];
	      	 $data['campo_variacion'] = $value['campo_variacion'];
	      	 
	      	
	      	$data['descripcion_variacion'] = $value['descripcion_variacion'];
	      	$data['imagen_variacion'] = $value['imagen_variacion'];
	      		  $data['image_link'] = $value['image_link'];
	      	$resultado  =  $this->modelo_fcalendario->agregar_disenos( $data );

	      	
    		
	    }     

	    //copiar de la tabla "logueo" -> identificador (resultado true)
	    $datos['resultado']  =  $this->modelo_fcalendario->actualizar_disenos_real( $data );
		echo json_encode($datos);


	}



//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////para mostrar la notificacion/////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
////////////////////////////////////////////////////////////////////////////////////////////////////////////// 


	//para presentar la cantidad de notificaciones
 	public function leer_marcados() {
		
		$data['id_session'] = $this->session->userdata('session_id');
		
		 //"id_session, consecutivo, id_diseno, variation_id" de "logueo_temporal"
		$datos['valores']  =  $this->modelo_fcalendario->leer_marcados( $data );
			//"true o false" : si hay existencia en "logueo_identificador" y "logueo_temporal"
		$datos['existencia']  =  $this->modelo_fcalendario->existencia( $data );
			//"true o false" : si hay existencia en "logueo_identificador" 
		$datos['existencia_fijo']  =  $this->modelo_fcalendario->existencia_fijo( $data );
				//"sumatoria" : "logueo_identificador" + "logueo_temporal"
		$datos['total_disenos']   = $this->modelo_fcalendario->total_disenos_completos( $data );
		
		echo json_encode($datos);

	}


	
	public function guardar_info_revise(){
		
		$data['tmcartepo']  =  json_encode( $this->input->post('datos')  );
		$_REQUEST = $data; 
		$producto =  json_decode(json_encode( $this->input->post('prod') ),true  );
		$product_id          = $producto['product_id']; 
	    $was_added_to_cart   = false;
    	$adding_to_cart      = wc_get_product( $product_id );		

	  	if ( ! $adding_to_cart ) {
	      return;
	    }

  		
  		$variations=Array ( 
            "[attribute_pa_variacion_agendas]" => $producto['pa_variacion_agendas'],
            "[attribute_pa_interior]" => $producto['pa_interior'],
            "[attribute_pa_num_hojas]" => $producto['pa_num_hojas']
          );


        WC()->cart->add_to_cart( $product_id, $producto['cantidad'], $producto['variation_id'], $variations );

		return $_REQUEST;

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