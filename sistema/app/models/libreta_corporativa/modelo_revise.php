<?php if(! defined('BASEPATH')) exit('No tienes permiso para acceder a este archivo');
class modelo_revise extends CI_Model{
    
    private $key_hash;
    private $timezone;
    
    function __construct(){
      parent::__construct();
      $this->load->database("default");
      $this->key_hash    = $_SERVER['HASH_ENCRYPT']; //tex emcri
      $this->timezone    = 'UM1';
      date_default_timezone_set('America/Mexico_City');   
      $this->catalogo_logo           = $this->db->dbprefix('catalogo_logo');
      $this->catalogo_festividad     = $this->db->dbprefix('catalogo_festividad');
      
      //uid_fotocalendario
      $this->fotocalendario_temporal    = $this->db->dbprefix('fotocalendario_temporal');
      $this->fechas_especiales    = $this->db->dbprefix('fechas_especiales');
      $this->nombre_meses    = $this->db->dbprefix('nombre_meses');
      //uid_lista
      $this->fotocalendario_lista    = $this->db->dbprefix('fotocalendario_lista');
      $this->lista_nombre_meses    = $this->db->dbprefix('lista_nombre_meses');
      $this->lista_fechas_especiales    = $this->db->dbprefix('lista_fechas_especiales');

      //historico lista
      $this->historico_fotocalendario_lista    = $this->db->dbprefix('historico_fotocalendario_lista');
      $this->historico_lista_nombre_meses    = $this->db->dbprefix('historico_lista_nombre_meses');
      $this->historico_lista_fechas_especiales    = $this->db->dbprefix('historico_lista_fechas_especiales');

      $this->logueo_identificador    = $this->db->dbprefix('logueo_identificador');
      $this->modulo = 'v';


      //historicos
      $this->historico_fotocalendario_temporal    = $this->db->dbprefix('historico_fotocalendario_temporal');
      $this->historico_fechas_especiales    = $this->db->dbprefix('historico_fechas_especiales');
      $this->historico_nombre_meses    = $this->db->dbprefix('historico_nombre_meses');
      $this->historico_fotocalendario_imagenes    = $this->db->dbprefix('historico_fotocalendario_imagenes');
      $this->historico_fotocalendario_imagenes_original    = $this->db->dbprefix('historico_fotocalendario_imagenes_original');
      $this->historico_fotocalendario_imagenes_recorte    = $this->db->dbprefix('historico_fotocalendario_imagenes_recorte');
      $this->historico_logueo_identificador    = $this->db->dbprefix('historico_logueo_identificador');



    }





    public function leer_info_carrito($data){

           
          $this->db->select('l.id id_old', false);                
          $this->db->select('l.variation_id, l.descripcion_interior, l.descripcion_num_hojas, l.id_session, l.modulo, l.consecutivo, l.correo');                
          $this->db->select('l.id_diseno, l.id_tamano, l.nombre_diseno, l.nombre_tamano, l.descripcion_tamano, l.imagen_diseno, l.imagen_tamano');                
          $this->db->select('l.fecha_mac, l.objeto_diseno, l.objeto_adicionales, l.imagen_interior, l.imagen_num_hojas, l.descripcion_color');                
          $this->db->select('l.descripcion_adicionales');  
          $this->db->select('id_copia cantidad');              
          $this->db->select('t.coleccion_id_logo');              
          

          $this->db->from($this->logueo_identificador.' As l');
          $this->db->join($this->fotocalendario_temporal.' As t', 't.id_session = l.id_session and t.id_diseno = l.id_diseno and t.variation_id = l.variation_id and t.consecutivo =l.consecutivo');
            
          $where = '(
                      (
                        ( l.id_session =  "'.$data['id_session'].'" ) AND
                        ( l.variation_id =  '.$data['variation_id'].' ) AND
                        ( l.id_diseno =  '.$data['id_diseno'].' ) AND
                        ( l.modulo =  "'.$this->modulo.'" ) AND
                        ( l.consecutivo =  '.$data['consecutivo'].' )
                       )
            )';   
  
            $this->db->where($where);
            

            $result = $this->db->get(  );
                if ($result->num_rows() > 0) {
                      return $result->result();
                      

                }
                    
                return true;
                $result->free_result();
    }  



    //correo logueo
    //ok **
    public function revisa_activos($data){
                  
          $this->db->distinct("t.id_session");         
          $this->db->select("t.id_session,t.id_diseno,t.variation_id,l.nombre_tamano,l.descripcion_tamano,l.imagen_diseno,l.imagen_tamano,t.consecutivo");         
          $this->db->select("l.nombre_diseno,l.descripcion_interior,l.descripcion_adicionales,l.descripcion_color,l.descripcion_num_hojas");         

          $this->db->select('id_copia cantidad, l.image_link');

          $this->db->select("t.titulo, t.nombre, t.apellidos");         
          $this->db->select("t.titulo_interior, t.nombre_interior, t.apellidos_interior");         
          $this->db->select("t.id_mes, t.id_dia, t.id_festividad, t.id_ano, t.id_lista, t.logo, t.coleccion_id_logo, t.fecha");  

            $this->db->select("t.texto_pagina");       

          $this->db->from($this->fotocalendario_temporal.' As t');
          $this->db->join($this->logueo_identificador.' As l', 't.id_session = l.id_session and t.id_diseno = l.id_diseno and t.variation_id = l.variation_id and t.consecutivo =l.consecutivo');

          $where = '(
                      (
                        ( t.id_session =  "'.$data['id_session'].'" ) AND ( t.modulo =  "'.$this->modulo.'" ) 
                       )
          )';   

          $this->db->where($where);
          
          $info = $this->db->get();
          if ($info->num_rows() > 0) {
              return $info->result();
          }    
          else
              return false;
          $info->free_result();
    }


      // cuando se elimina un diseño
      public function eliminar_diseno_revise( $data ){

          $this->db->delete( $this->fotocalendario_temporal, array( 'id_session' => $data['id_session'],  'variation_id' => $data['variation_id'],  'id_diseno' => $data['id_diseno'],   'consecutivo' => $data['consecutivo'], 'modulo' => $this->modulo ) );
          $this->db->delete( $this->logueo_identificador, array( 'id_session' => $data['id_session'],  'variation_id' => $data['variation_id'] ,  'id_diseno' => $data['id_diseno'],   'consecutivo' => $data['consecutivo'], 'modulo' => $this->modulo ) );
          
          return TRUE;
      }

      //ok **
      public function total_disenos($data){
                  $this->db->from($this->logueo_identificador);
                  $where = '(
                              (
                                ( id_session =  "'.$data['id_session'].'" )  AND ( modulo =  "'.$this->modulo.'" )                       
                               )
                    )';   
                  $this->db->where($where);
                  
                  $info = $this->db->get();

                  if ($info->num_rows() > 0) {
                      return $info->num_rows();
                  }    
                  else
                      return false;
                  $info->free_result();
      } 

    //ok **
      public function total_disenos_completos($data){

                  $this->db->select("id_session,id_diseno,variation_id,consecutivo");                           
                  $this->db->from($this->fotocalendario_temporal); //fotocalendario_imagenes
                  
                  $where = '(
                              (
                                ( id_session =  "'.$data['id_session'].'" )  AND ( modulo =  "'.$this->modulo.'" )                         
                               )
                  )';   

                  $this->db->where($where);
                  $this->db->group_by("id_session,id_diseno,variation_id,consecutivo");
                  
                  $info = $this->db->get();
                  if ($info->num_rows() > 0) {
                      return $info->num_rows();
                  }    
                  else
                      return false;
                  $info->free_result();
      } 
    




////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////Guardar historico del carrito///////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////

   public function check_existente_fotocalendario($data){
            $this->db->select("id_session, variation_id", FALSE);         
            
              $this->db->from($this->fotocalendario_temporal);  
            

            $where = '(
                        (
                          ( id_session =  "'.$data['id_session'].'" ) AND
                          ( variation_id =  '.$data['variation_id'].' ) AND
                          ( id_diseno =  '.$data['id_diseno'].' ) AND
                          ( consecutivo =  '.$data['consecutivo'].' ) 
                         )
              )';   
  
            $this->db->where($where);
            
            $info = $this->db->get();
            if ($info->num_rows() > 0) {
                $fila = $info->row(); 
                return $fila->id_session;
            }    
            else
                return false;
            $info->free_result();
    } 


    




    /////////////Lista de todos los diseños q estan hechos hasta el momento///////    
    //////////////////////////////////////////////////////////////////////////////////////////
    public function leer_info_identificador($data){
  
          $this->db->select('id id_old', false);                
          $this->db->select('variation_id, descripcion_interior, descripcion_num_hojas, id_session, modulo,id_user, consecutivo, correo');                
          $this->db->select('id_diseno, id_tamano, nombre_diseno, nombre_tamano, descripcion_tamano, imagen_diseno, imagen_tamano');                
          $this->db->select('fecha_mac, objeto_diseno, objeto_adicionales, imagen_interior, imagen_num_hojas, descripcion_color');                
          $this->db->select('descripcion_adicionales');                



            $this->db->from($this->logueo_identificador);
            
            $where = '(
                        (
                          ( id_session =  "'.$data['id_session'].'" ) AND
                          ( variation_id =  '.$data['variation_id'].' ) AND
                          ( id_diseno =  '.$data['id_diseno'].' ) AND
                          ( modulo =  "'.$this->modulo.'" ) AND
                          ( consecutivo =  '.$data['consecutivo'].' )
                         )
              )';   
  
            $this->db->where($where);
            

            $result = $this->db->get(  );
                if ($result->num_rows() > 0) {
                      $objeto = $result->result();
                      //copiar "registros" a la tabla historico

                      foreach ($objeto as $key => $value) {
                        $this->db->insert($this->historico_logueo_identificador, $value); 
                      }                  

                }
                    
                return true;
                $result->free_result();
    }  


    public function leer_info($data){
          
            $this->db->select('id id_old', false);                
            $this->db->select('id_session, modulo,id_user, aaa, consecutivo, cantDiseno, movposicion, id_diseno'); 
            $this->db->select('id_tamano, id_copia, titulo, nombre, apellidos, id_mes, id_dia, id_festividad');
            $this->db->select('id_ano, id_lista, logo, coleccion_id_logo, fecha, ip_address, user_agent, fecha_mac, variation_id');
            $this->db->select('descripcion_color, descripcion_adicionales');

            $this->db->from($this->fotocalendario_temporal);
            
            $where = '(
                        (
                          ( id_session =  "'.$data['id_session'].'" ) AND
                          ( variation_id =  '.$data['variation_id'].' ) AND
                          ( id_diseno =  '.$data['id_diseno'].' ) AND
                          ( modulo =  "'.$this->modulo.'" ) AND
                          ( consecutivo =  '.$data['consecutivo'].' )
                         )
              )';   
  
            $this->db->where($where);
            

            $result = $this->db->get(  );
                if ($result->num_rows() > 0) {
                      $objeto = $result->result();
                      //copiar "registros" a la tabla historico

                      foreach ($objeto as $key => $value) {
                        $this->db->insert($this->historico_fotocalendario_temporal, $value); 
                      }                  

                }
                    
                return true;
                $result->free_result();
    }  




    public function eliminar_diseno_completo( $data ){
       
        $this->db->delete( $this->fotocalendario_temporal, array( 'id_session' => $data['id_session'],  'variation_id' => $data['variation_id'],  'id_diseno' => $data['id_diseno'],   'consecutivo' => $data['consecutivo'], 'modulo' => $this->modulo ) );
        $this->db->delete( $this->logueo_identificador, array( 'id_session' => $data['id_session'],  'variation_id' => $data['variation_id'] ,  'id_diseno' => $data['id_diseno'],   'consecutivo' => $data['consecutivo'] , 'modulo' => $this->modulo ) );
        
        return TRUE;

    }




} 


?>