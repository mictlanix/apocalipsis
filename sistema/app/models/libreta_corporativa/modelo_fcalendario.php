<?php if(! defined('BASEPATH')) exit('No tienes permiso para acceder a este archivo');
  class modelo_fcalendario extends CI_Model{
    
    private $key_hash;
    private $timezone;
    function __construct(){
      parent::__construct();
      $this->load->database("default");
      $this->key_hash    = $_SERVER['HASH_ENCRYPT'];
      $this->timezone    = 'UM1';
      date_default_timezone_set('America/Mexico_City');   
      
        $this->termmeta = $this->db->dbprefix('woocommerce_termmeta');
           $this->posts = $this->db->dbprefix('posts');
        $this->terminos = $this->db->dbprefix('terms');

        $this->postmeta = $this->db->dbprefix('postmeta');

        $this->logueo_identificador    = $this->db->dbprefix('logueo_identificador');
        $this->logueo_temporal = $this->db->dbprefix('logueo_temporal');
        $this->sessiones = $this->db->dbprefix('sessions');

        $this->modulo = 'v';
        
        $current_user = wp_get_current_user();
        $this->id_user = $current_user->id;

    }


 public function agregar_disenos( $data ){
       
         $objeto_adicionales = '{"tmhasepo":1,"tmcartepo":'.(string)$data['tmcartepo'].',"tmsubscriptionfee":0,"tmcartfee":[]}';  
         $objeto_diseno = (string)$data['producto'];  


          $consecutivo = self::consecutivo_session($data['id_session']);
          $this->db->set('consecutivo', $consecutivo);  
          $this->db->set('objeto_diseno', $objeto_diseno);  
          $this->db->set('objeto_adicionales', $objeto_adicionales);  


          $this->db->set('id_session', $data['id_session']);  
          $this->db->set('modulo', $this->modulo);  

          $this->db->set('id_diseno', $data['id_diseno']);  
          $this->db->set('nombre_diseno', $data['nombre_diseno']);  
          $this->db->set('descripcion_tamano', $data['descripcion_tamano']);  
          $this->db->set('variation_id', $data['variation_id']);  
          $this->db->set('descripcion_interior', $data['descripcion_interior']);  

          $this->db->set('descripcion_adicionales', $data['descripcion_adicionales']);  
          $this->db->set('descripcion_num_hojas', $data['descripcion_num_hojas']);  

          $this->db->set('descripcion_color', $data['descripcion_color']);  


          
          $this->db->set('imagen_diseno', $data['imagen_diseno']);  
          $this->db->set('imagen_tamano', $data['imagen_tamano']);  
          $this->db->set('imagen_interior', $data['imagen_interior']);  
          $this->db->set('imagen_num_hojas', $data['imagen_num_hojas']);  
          $this->db->set('id_user', $this->id_user);  

          $this->db->set('logos', $data['logos']); 
          $this->db->set('image_link', $data['image_link']); 

    
          $this->db->insert($this->logueo_temporal); 

          return true;
  }



 public function actualizar_disenos_real( $data ){

          $this->db->select("variation_id, descripcion_interior,descripcion_adicionales, descripcion_color, descripcion_num_hojas, id_session, modulo, consecutivo, correo");         
          $this->db->select("id_diseno, variation_id, id_tamano, nombre_diseno, nombre_tamano, descripcion_tamano, imagen_diseno");         
          $this->db->select("imagen_tamano, fecha_mac, objeto_diseno, objeto_adicionales, imagen_interior, imagen_num_hojas,image_link,logos");   
          $this->db->select($this->id_user.' id_user', false);    
          
          $this->db->from($this->logueo_temporal);
          $this->db->where('id_session',$data['id_session']);
          $this->db->where('modulo',$this->modulo);

          $result = $this->db->get();
          $objeto = $result->result();

          //copiar a tabla "logueo_identificador"
          foreach ($objeto as $key => $value) {
            $this->db->insert($this->logueo_identificador, $value); 
          }              

          if ($result->num_rows() > 0) {
              $this->db->set( 'consecutivo', 'consecutivo+1', FALSE  );
              $this->db->where('session_id',$data['id_session']);
              $this->db->update($this->sessiones);
          }             


          $this->db->delete( $this->logueo_temporal, array('id_session' => $data['id_session'], 'modulo' => $this->modulo));
  
          return true;

  }





         public function consecutivo_session( $id ){
                  
                $this->db->select("s.consecutivo");         
                $this->db->from($this->sessiones.' As s');
                $this->db->where('s.session_id',$id);
                $result = $this->db->get( );
                    if ($result->num_rows() > 0)
                        return $result->row()->consecutivo+1;
                    else 
                        return FALSE;
                    $result->free_result();
         }    



//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////para mostrar la notificacion/////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
////////////////////////////////////////////////////////////////////////////////////////////////////////////// 


     public function leer_marcados( $data ){

          $this->db->select("t.id_session, t.consecutivo, t.id_diseno, t.variation_id");         
          $this->db->from($this->logueo_temporal.' As t');
          $this->db->where('t.id_session',$data['id_session']);
          $this->db->where('t.modulo' , $this->modulo);
          $resultado = $this->db->get( );
          if ($resultado->num_rows() > 0)
              return $resultado->result();
          else 
              return FALSE;
          $resultado->free_result();
     }     


     public function existencia( $data ){


          $this->db->select("t.id_session");         
          $this->db->from($this->logueo_temporal.' As t');
          $this->db->where('t.id_session',$data['id_session']);
          $this->db->where('t.modulo' , $this->modulo);

          $resultado_temporal = $this->db->get();

          $this->db->select("t.id_session");         
          $this->db->from($this->logueo_identificador.' As t');
          $this->db->where('t.id_session',$data['id_session']);
          $this->db->where('t.modulo' , $this->modulo);

          $resultado_fijo = $this->db->get();

          $cant= ( $resultado_temporal->num_rows() +  $resultado_fijo->num_rows() );

          if ($cant > 0)
              return TRUE;
          else 
              return FALSE;
          $resultado->free_result();

     }



  public function existencia_fijo( $data ){


          $this->db->select("t.id_session");         
          $this->db->from($this->logueo_identificador.' As t');
          $this->db->where('t.id_session',$data['id_session']);
          $this->db->where('t.modulo' , $this->modulo);
          $resultado_fijo = $this->db->get();


          $cant= ( $resultado_fijo->num_rows() );


          if ($cant > 0)
              return TRUE;
          else 
              return FALSE;
          $resultado->free_result();



     }



  public function total_disenos_completos( $data ){


          $this->db->select("t.id_session");         
          $this->db->from($this->logueo_temporal.' As t');
          $this->db->where('t.id_session',$data['id_session']);
          $this->db->where('t.modulo' , $this->modulo);

          $resultado_temporal = $this->db->get();

          $this->db->select("t.id_session");         
          $this->db->from($this->logueo_identificador.' As t');
          $this->db->where('t.id_session',$data['id_session']);
          $this->db->where('t.modulo' , $this->modulo);

          $resultado_fijo = $this->db->get();

          $cant= ( $resultado_temporal->num_rows() +  $resultado_fijo->num_rows() );

          if ($cant > 0)
              return $cant;
          else 
              return 0;
          $resultado->free_result();

     }




    
  } 


?>