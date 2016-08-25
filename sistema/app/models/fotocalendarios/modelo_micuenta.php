<?php if(! defined('BASEPATH')) exit('No tienes permiso para acceder a este archivo');
  class modelo_micuenta extends CI_Model{
    
    private $key_hash;
    private $timezone;
    function __construct(){
      parent::__construct();
      $this->load->database("default");
      $this->key_hash    = $_SERVER['HASH_ENCRYPT'];
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
      $this->fotocalendario_imagenes    = $this->db->dbprefix('fotocalendario_imagenes');
      $this->fotocalendario_imagenes_original    = $this->db->dbprefix('fotocalendario_imagenes_original');
      $this->fotocalendario_imagenes_recorte    = $this->db->dbprefix('fotocalendario_imagenes_recorte');

      //historico lista
      $this->historico_fotocalendario_lista    = $this->db->dbprefix('historico_fotocalendario_lista');
      $this->historico_lista_nombre_meses    = $this->db->dbprefix('historico_lista_nombre_meses');
      $this->historico_lista_fechas_especiales    = $this->db->dbprefix('historico_lista_fechas_especiales');
    

      $this->logueo_identificador    = $this->db->dbprefix('logueo_identificador');

      $this->modulo = 'f';

      //historicos
      $this->historico_fotocalendario_temporal    = $this->db->dbprefix('historico_fotocalendario_temporal');
      $this->historico_fechas_especiales    = $this->db->dbprefix('historico_fechas_especiales');
      $this->historico_nombre_meses    = $this->db->dbprefix('historico_nombre_meses');
      $this->historico_fotocalendario_imagenes    = $this->db->dbprefix('historico_fotocalendario_imagenes');
      $this->historico_fotocalendario_imagenes_original    = $this->db->dbprefix('historico_fotocalendario_imagenes_original');
      $this->historico_fotocalendario_imagenes_recorte    = $this->db->dbprefix('historico_fotocalendario_imagenes_recorte');
      $this->historico_logueo_identificador    = $this->db->dbprefix('historico_logueo_identificador');

        $current_user = wp_get_current_user();
        $this->id_user = $current_user->id;

    }


////////////////////////////// añadir la lista de día/////////////////////////////////    
//////////////////////////////////////////////////////////////////////////////////////////
   //listas
     public function anadir_lista($data){
           $this->db->set( 'id_session', $data['id_session'] );  
          
           $this->db->set( 'id_tamano', 0 ); 
           $this->db->set( 'variation_id', 0 );  
           $this->db->set( 'id_diseno', 0 );  
           $this->db->set( 'consecutivo', 0 ); 

           $this->db->set('modulo', $this->modulo);  
           $this->db->set('id_user', $this->id_user);  

           $this->db->set( 'nombre', $data['nombre_lista'] );  
           $this->db->set( 'correo', $data['correo_lista'] );   //+1
           $this->db->insert($this->fotocalendario_lista);
          
          if ($this->db->affected_rows() > 0){
                    return $this->db->insert_id();
                } else {
                    return FALSE;
                }
                $result->free_result();
     }

      public function anadir_lista_listadias($data){
          foreach ($data['listadias'] as $llave => $valor) {
               $this->db->set( 'id_session', $data['id_session'] );  

               $this->db->set( 'id_tamano', 0 ); 
               $this->db->set( 'variation_id', 0 );  
               $this->db->set( 'id_diseno', 0 );  
               $this->db->set( 'consecutivo', 0 ); 

               $this->db->set('modulo', $this->modulo);  
               $this->db->set('id_user', $this->id_user);  


               $this->db->set( 'ano', $valor['ano'] );  
               $this->db->set( 'mes', $valor['mes'] );   
               $this->db->set( 'dia', $valor['dia'] );  
               $this->db->set( 'valor', $valor['valor'] );  

               $this->db->set( 'id_lista', $data['id_lista'] );  

               $this->db->insert($this->lista_fechas_especiales);
            } 
            
            if ($this->db->affected_rows() > 0){
                    return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();
      }       
     
     public function anadir_lista_nombre_mes($data){
         
          foreach ($data['nombre_mes'] as $llave => $valor) {
            if (isset($valor['ano'])) {
                 $this->db->set( 'id_session', $data['id_session'] );  

                 $this->db->set( 'id_tamano', 0 ); 
                 $this->db->set( 'variation_id', 0 );  
                 $this->db->set( 'id_diseno', 0 );  
                 $this->db->set( 'consecutivo', 0 ); 

                 $this->db->set('modulo', $this->modulo);  
                 $this->db->set('id_user', $this->id_user);  

                 $this->db->set( 'ano', $valor['ano'] );  
                 $this->db->set( 'mes', $valor['mes'] );  //+1
                 $this->db->set( 'valor', $valor['valor'] );  
                 
                 $this->db->set( 'id_lista', $data['id_lista'] );  

                 $this->db->insert($this->lista_nombre_meses);
             }    
            } 
            
            if ($this->db->affected_rows() > 0){
                    return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();
      } 



   //////////////////////////////Fin de añadir la lista de día/////////////////////////////////    
    //////////////////////////////////////////////////////////////////////////////////////////
 





  

    /////////////////**********OJO*********/////////////////////////////////////////////////////    
    /////////////OJO VER SI SE VA A RELACIONAR CON CORREO O CON SESSION///////    
    /////////////ESTA ES LA LISTA ASOCIADA AL USUARIO///////    
    //////////////////////////////////////////////////////////////////////////////////////////
    public function listado_listas($data){

          $where = '(                     
                          ( l.id_session =  "'.$data['id_session'].'" )   OR  ( l.id_user =  '.$this->id_user.' )                                
            )';   


       $result = $this->db->query('

            select r.id, r.id_session, r.id_tamano,r.id_diseno,r.consecutivo, r.correo, r.nombre, r.titulo, r.ubicacion from (
               select l.id, l.id_session, l.id_tamano,l.id_diseno,l.consecutivo, l.correo, l.nombre,
                CONCAT(
                   CASE  
                      WHEN l.modulo ="f" THEN "Fot.Cal.->"
                      WHEN l.modulo ="c" THEN "Cal.->"
                      WHEN l.modulo ="a" THEN "Agen.->"
                      WHEN l.modulo ="g" THEN "Fot.Agen.->"
                      WHEN l.modulo ="i" THEN "Fot.Lib.->"
                      WHEN l.modulo ="l" THEN "Lib.->"
                   ELSE ""
                   END,
                   " ",". ",DATE_FORMAT((l.fecha_mac),"%d-%m-%Y %H:%i:%s")) titulo,
                "v" ubicacion
                FROM  '.$this->fotocalendario_lista.' l  where '.$where.'
           union
               select l.id, l.id_session, l.id_tamano,l.id_diseno,l.consecutivo, l.correo, l.nombre,
                CONCAT(
                   CASE  
                      WHEN l.modulo ="f" THEN "Fot.Cal.->"
                      WHEN l.modulo ="c" THEN "Cal.->"
                      WHEN l.modulo ="a" THEN "Agen.->"
                      WHEN l.modulo ="g" THEN "Fot.Agen.->"
                      WHEN l.modulo ="i" THEN "Fot.Lib.->"
                      WHEN l.modulo ="l" THEN "Lib.->"
                   ELSE ""
                   END,
                   " ",". ",DATE_FORMAT((l.fecha_mac),"%d-%m-%Y %H:%i:%s")) titulo,
                "h" ubicacion
                FROM  '.$this->historico_fotocalendario_lista.' l  where '.$where.'        
            ) r  

            ');  


                if ($result->num_rows() > 0)
                    return $result->result();
                else 
                    return FALSE;
                $result->free_result();



        

    }  




//////////////////////////////////////////////////////////////
 ////////////////FIN de Activar las previsualizaciones///////////////
 //////////////////////////////////////////////////////////////
 

 
  //OK  //arreglar con correo  
  public function listadias_cambiar($data){
            $this->db->select("l.id, l.id_session, l.correo, l.nombre");         
            $this->db->select("d.ano, d.mes, d.dia, d.valor, d.id_diseno,d.id_tamano,d.consecutivo");  

            if ($data['ubicacion_old']=='v') {
              $this->db->from($this->fotocalendario_lista.' As l');
              $this->db->join($this->lista_fechas_especiales.' As d', 'l.id = d.id_lista','LEFT');
            } else {
              $this->db->from($this->historico_fotocalendario_lista.' As l');
              $this->db->join($this->historico_lista_fechas_especiales.' As d', 'l.id = d.id_lista','LEFT');
            }            

            $where = '(
                      (
                        ( ( l.id_session =  "'.$data['id_session'].'" )   OR  ( l.id_user =  '.$this->id_user.' )  ) AND 
                        ( l.id =  '.$data['id_lista'].' )  
                       )
            )';   



      $this->db->where($where);
            $result = $this->db->get(  );
                if ($result->num_rows() > 0)
                    return $result->result();
                else 
                    return FALSE;
                $result->free_result();
    } 

    //OK           
 public function listames_cambiar($data){
            $this->db->select("l.id, l.id_session, l.correo, l.nombre");         
            $this->db->select("m.ano, m.mes,  m.valor, m.id_diseno,m.id_tamano,m.consecutivo");         
               


            if ($data['ubicacion_old']=='v') {
              $this->db->from($this->fotocalendario_lista.' As l');
              $this->db->join($this->lista_nombre_meses.' As m', 'l.id = m.id_lista','LEFT');
            } else {
              $this->db->from($this->historico_fotocalendario_lista.' As l');
              $this->db->join($this->historico_lista_nombre_meses.' As m', 'l.id = m.id_lista','LEFT');
            }            

            $where = '(
                      (
                        ( ( l.id_session =  "'.$data['id_session'].'" )   OR  ( l.id_user =  '.$this->id_user.' )  ) AND 
                        ( l.id =  '.$data['id_lista'].' )  
                       )
            )';   





            $this->db->where($where);
            $result = $this->db->get(  );
                if ($result->num_rows() > 0)
                    return $result->result();
                else 
                    return FALSE;
                $result->free_result();
    }             
    ///////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////
  




    public function checar_existente_lista($data){
            $this->db->select("id_session, id_tamano", FALSE);         
            
            if ($data['old_ubicacion']=='v') {
              $this->db->from($this->fotocalendario_temporal);  
            } else {
              $this->db->from($this->historico_fotocalendario_temporal);  
            }
            

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







     


    
  } 


?>