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

        $this->modulo = 'c';
        $current_user = wp_get_current_user();
        $this->id_user = $current_user->id;

    }


public function icono_especial($data){

  $result = $this->db->query(
          'select p.guid 
            from '.$this->postmeta.' AS pmeta
            INNER JOIN '.$this->posts.' AS p ON pmeta.meta_value = p.id
            where ( ( pmeta.post_id ='.$data["id"].' ) AND ( pmeta.meta_key =  "'.$data['campo'].'" ) )
          ');


              if ( $result->num_rows() > 0 )  {
                         return $result->row();
              }   else {
                      return "false";
                      $result->free_result();
              }  
          

}

       //correo logueo
       public function imagen_atributo($data){
  
          $result = $this->db->query(
          'select post.guid,termino.name 
            from '.$this->terminos.' AS termino
            INNER JOIN '.$this->termmeta.' AS tmeta ON tmeta.woocommerce_term_id = termino.term_id
            INNER JOIN '.$this->posts.' AS post ON post.id = tmeta.meta_value
            where ( (tmeta.meta_key ="pa_tamanos_swatches_id_photo")  AND    (termino.slug="'.$data['slug'].'" ) )
          ');



              if ( $result->num_rows() > 0 )  {
                         return $result->result();
              }   else {
                      return "false";
                      $result->free_result();
              }

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


//new
 public function agregar_disenos( $data ){
       
          $objeto_diseno = (string)$data['producto'];  
          $consecutivo = self::consecutivo_session($data['id_session']);

          $this->db->set('objeto_diseno', $objeto_diseno);  
          $this->db->set('id_session', $data['id_session']);  
          $this->db->set('id_user', $this->id_user); 
          $this->db->set('modulo', $this->modulo); 
          $this->db->set('consecutivo', $consecutivo);  //ver
           //`correo` varchar(50) DEFAULT 'no', 
          $this->db->set('correo', 'no');  //ver

          $this->db->set('id_diseno', $data['id_diseno']);  
          $this->db->set('variation_id', $data['variation_id']);  
          $this->db->set('id_tamano', $data['variation_id']);  

          $this->db->set('nombre_diseno', $data['nombre_diseno']);  
          $this->db->set('nombre_tamano', $data['nombre_variacion']); 

          $this->db->set('descripcion_tamano', $data['descripcion_variacion']);  
          $this->db->set('imagen_diseno', $data['imagen_diseno']);  
          $this->db->set('imagen_tamano', $data['imagen_variacion']);     
          $this->db->set('campo_variacion', $data['campo_variacion']); 

          $this->db->insert($this->logueo_temporal); 

          return true;
  }


//new
 public function actualizar_disenos_real( $data ){

          

          $this->db->select("objeto_diseno, id_session");         
          $this->db->select($this->id_user.' id_user', false);  
          $this->db->select("modulo, consecutivo, correo");         
          $this->db->select("id_diseno, variation_id, id_tamano, nombre_diseno, nombre_tamano,  descripcion_tamano, imagen_diseno,imagen_tamano,campo_variacion");         
          $this->db->select("fecha_mac");         

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

  
  
  






 public function agregar_disenos_old( $data ){

          $consecutivo = self::consecutivo_session($data['id_session']);
         
          if ($data['datos'])  {  //si existen datos para guardar
          foreach ($data['datos'] as $key => $value) {
            
            if ($value)  {  
              foreach ($value as $key1 => $value1) {
                
                $this->db->set('consecutivo', $consecutivo);   //el consecutivo actual
                 $this->db->set($key1, $value1);       //OJO aqui es donde estan todos
                 $this->db->set('id_user', $this->id_user);   //el id_user que esta trabajando
                 $this->db->set('modulo', $this->modulo);     //el modulo
               } 
              $this->db->insert($this->logueo_temporal);
            }  

          }    
         } 
          


          return true;
  }




 public function actualizar_disenos_old( $data ){

          $this->db->select("t.id_session, t.consecutivo, t.correo, t.id_diseno, t.id_tamano, t.variation_id, t.nombre_diseno, t.nombre_tamano,t.descripcion_tamano,t.imagen_diseno, t.imagen_tamano, t.fecha_mac");         
          
          $this->db->select('"'.$this->modulo.'" modulo', false);         
          $this->db->select($this->id_user.' id_user', false);    
          
          $this->db->from($this->logueo_temporal.' AS t');
          $this->db->where('t.id_session',$data['id_session']);
          $this->db->where('t.modulo' , $this->modulo);

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



          //cuando se elimina un diseño
        public function eliminar_diseno_tamano( $data ){
          $consecutivo = self::consecutivo_session($data['id_session']);
          //elimina datos anteriores que esten en "logueo_temporal"
          $this->db->delete( $this->logueo_temporal, array('id_session' => $data['id_session'], 'modulo' => $this->modulo));
           
          if ($data['datos'])  {  //si existen datos para guardar
          foreach ($data['datos'] as $key => $value) {
            
            if ($value)  {  
              foreach ($value as $key1 => $value1) {
                
                $this->db->set('consecutivo', $consecutivo);  
                 $this->db->set($key1, $value1);  
                 $this->db->set('id_user', $this->id_user);  
                 $this->db->set('modulo', $this->modulo);  
               } 
              $this->db->insert($this->logueo_temporal);
            }  

          }    
         } 
          

         //valores devueltos para marcar nuevamente
        $this->db->select("t.id_session, t.consecutivo, t.id_diseno, t.id_tamano");         
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





   

     public function leer_marcados( $data ){

          $this->db->select("t.id_session, t.consecutivo, t.id_diseno, t.id_tamano, t.id_tamano variation_id");         
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