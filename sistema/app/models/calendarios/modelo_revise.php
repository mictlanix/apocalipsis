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
      $this->modulo = 'c';


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
             $this->db->select('id id_old', false);            
            
              $this->db->from($this->logueo_identificador);  
            

            $where = '(
                        (
                          ( id_session =  "'.$data['id_session'].'" ) AND
                          ( id_tamano =  '.$data['id_tamano'].' ) AND
                          ( id_diseno =  '.$data['id_diseno'].' ) AND
                           (modulo =  "'.$this->modulo.'" ) AND
                          ( consecutivo =  '.$data['consecutivo'].' ) 
                          
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
    public function fechas_especiales($data){
            
            $this->db->select("m.id_tamano, m.id_diseno, m.consecutivo, m.ano ,m.dia ,m.valor");         
            $this->db->select("m.mes+1 mes", false);         
            

            $this->db->from($this->fotocalendario_temporal.' As t');

            $this->db->join($this->fechas_especiales.' As m', 't.id_session = m.id_session and t.id_diseno = m.id_diseno and t.id_tamano = m.id_tamano and t.consecutivo =m.consecutivo and t.modulo =m.modulo');


           $where = '(
                        (
                          ( t.id_session =  "'.$data['id_session'].'" ) AND ( t.modulo =  "'.$this->modulo.'" )
                         )
            )'; 

            $this->db->where($where);
            $this->db->order_by('m.dia','asc');
            $this->db->order_by('m.mes','asc');
            $result = $this->db->get();
                if ($result->num_rows() > 0)
                    return $result->result();
                else 
                    return FALSE;
                $result->free_result();
    }   
    //correo logueo
    public function mensaje_mes($data){
            
            $this->db->select("m.id_tamano, m.id_diseno, m.consecutivo, m.ano, m.mes,  m.valor");         

            $this->db->from($this->fotocalendario_temporal.' As t');
            $this->db->join($this->nombre_meses.' As m', 't.id_session = m.id_session and t.id_diseno = m.id_diseno and t.id_tamano = m.id_tamano and t.consecutivo =m.consecutivo and t.modulo =m.modulo');



           $where = '(
                        (
                          ( t.id_session =  "'.$data['id_session'].'" ) AND ( t.modulo =  "'.$this->modulo.'" )
                         )
            )'; 

            $this->db->where($where);
            $this->db->order_by('m.mes','asc');
            $result = $this->db->get();
                if ($result->num_rows() > 0)
                    return $result->result();
                else 
                    return FALSE;
                $result->free_result();
    }   

    //correo logueo
    //ok **
    public function revisa_activos($data){
                  
          $this->db->distinct("t.id_session");         
          $this->db->select("t.id_session,t.id_diseno,t.id_tamano,l.nombre_tamano,l.descripcion_tamano,l.imagen_diseno,l.imagen_tamano,l.nombre_diseno, t.consecutivo");         
          
          $this->db->select('id_copia cantidad, l.image_link');

          $this->db->select("t.titulo, t.nombre, t.apellidos");         
          $this->db->select("t.id_mes, t.id_dia, t.id_festividad, t.id_ano, t.id_lista, t.logo, t.coleccion_id_logo, t.fecha");         

          $this->db->from($this->fotocalendario_temporal.' As t');
          $this->db->join($this->logueo_identificador.' As l', 't.id_session = l.id_session and t.id_diseno = l.id_diseno and t.id_tamano = l.id_tamano and t.consecutivo =l.consecutivo');

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

          $this->db->delete( $this->fotocalendario_temporal, array( 'id_session' => $data['id_session'],  'id_tamano' => $data['id_tamano'],  'id_diseno' => $data['id_diseno'],   'consecutivo' => $data['consecutivo'], 'modulo' => $this->modulo ) );
          $this->db->delete( $this->fechas_especiales, array( 'id_session' => $data['id_session'],  'id_tamano' => $data['id_tamano'] ,  'id_diseno' => $data['id_diseno'],   'consecutivo' => $data['consecutivo'], 'modulo' => $this->modulo ) );
          $this->db->delete( $this->nombre_meses, array( 'id_session' => $data['id_session'],  'id_tamano' => $data['id_tamano'] ,  'id_diseno' => $data['id_diseno'],   'consecutivo' => $data['consecutivo'], 'modulo' => $this->modulo ) );
          $this->db->delete( $this->logueo_identificador, array( 'id_session' => $data['id_session'],  'id_tamano' => $data['id_tamano'] ,  'id_diseno' => $data['id_diseno'],   'consecutivo' => $data['consecutivo'], 'modulo' => $this->modulo ) );
          
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

                  $this->db->select("id_session,id_diseno,id_tamano,consecutivo");                           
                  $this->db->from($this->fotocalendario_temporal); //fotocalendario_imagenes
                  
                  $where = '(
                              (
                                ( id_session =  "'.$data['id_session'].'" )  AND ( modulo =  "'.$this->modulo.'" )                         
                               )
                  )';   

                  $this->db->where($where);
                  $this->db->group_by("id_session,id_diseno,id_tamano,consecutivo");
                  
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
            $this->db->select("id_session, id_tamano", FALSE);         
            
              $this->db->from($this->fotocalendario_temporal);  
            

            $where = '(
                        (
                          ( id_session =  "'.$data['id_session'].'" ) AND
                          ( id_tamano =  '.$data['id_tamano'].' ) AND
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
            $this->db->select('id_session, modulo,id_user, consecutivo, correo, id_diseno, id_tamano');                
            $this->db->select('nombre_diseno, nombre_tamano, descripcion_tamano, imagen_diseno, imagen_tamano');                


            $this->db->from($this->logueo_identificador);
            
            $where = '(
                        (
                          ( id_session =  "'.$data['id_session'].'" ) AND
                          ( id_tamano =  '.$data['id_tamano'].' ) AND
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
            $this->db->select('id_session, modulo, id_user, aaa, consecutivo, cantDiseno, movposicion, id_diseno, id_tamano, id_copia, titulo, nombre, apellidos');                
            $this->db->select('id_mes, id_dia, id_festividad, id_ano, id_lista, logo, coleccion_id_logo, fecha, ip_address, user_agent');                


            $this->db->from($this->fotocalendario_temporal);
            
            $where = '(
                        (
                          ( id_session =  "'.$data['id_session'].'" ) AND
                          ( id_tamano =  '.$data['id_tamano'].' ) AND
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


 public function listadias_info($data){

       
            $this->db->select('id id_old', false);                
            $this->db->select('id_session, modulo,id_user, consecutivo, id_diseno, id_tamano');                
            $this->db->select('ano, mes, dia, valor, id_usuario');                

            $this->db->from($this->fechas_especiales);
            
            $where = '(
                        (
                          ( id_session =  "'.$data['id_session'].'" ) AND
                          ( id_tamano =  '.$data['id_tamano'].' ) AND
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
                        $this->db->insert($this->historico_fechas_especiales, $value); 
                      }                  

                }
                    
                return true;
                $result->free_result();
    }


// OK
 public function listames_info($data){

            $this->db->select('id id_old', false);                
            $this->db->select('id_session, modulo,id_user, consecutivo, id_diseno');                
            $this->db->select('id_tamano, ano, mes, valor, id_usuario');                

            $this->db->from($this->nombre_meses);
            
            $where = '(
                        (
                          ( id_session =  "'.$data['id_session'].'" ) AND
                          ( id_tamano =  '.$data['id_tamano'].' ) AND
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
                        $this->db->insert($this->historico_nombre_meses, $value); 
                      }                  

                }
                    
                return true;
                $result->free_result();
    }            


    public function eliminar_diseno_completo( $data ){
       
        $this->db->delete( $this->fotocalendario_temporal, array( 'id_session' => $data['id_session'],  'id_tamano' => $data['id_tamano'],  'id_diseno' => $data['id_diseno'],   'consecutivo' => $data['consecutivo'], 'modulo' => $this->modulo ) );
        $this->db->delete( $this->fechas_especiales, array( 'id_session' => $data['id_session'],  'id_tamano' => $data['id_tamano'] ,  'id_diseno' => $data['id_diseno'],   'consecutivo' => $data['consecutivo'] , 'modulo' => $this->modulo ) );
        $this->db->delete( $this->nombre_meses, array( 'id_session' => $data['id_session'],  'id_tamano' => $data['id_tamano'] ,  'id_diseno' => $data['id_diseno'],   'consecutivo' => $data['consecutivo'] ) );
        $this->db->delete( $this->logueo_identificador, array( 'id_session' => $data['id_session'],  'id_tamano' => $data['id_tamano'] ,  'id_diseno' => $data['id_diseno'],   'consecutivo' => $data['consecutivo'] , 'modulo' => $this->modulo ) );
        
        return TRUE;

    }




} 


?>