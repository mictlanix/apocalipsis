<?php if(! defined('BASEPATH')) exit('No tienes permiso para acceder a este archivo');
  class modelo_fotocalendario extends CI_Model{
    
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
      $this->catalogo_titulos     = $this->db->dbprefix('catalogo_titulos');
      
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

      $this->modulo = 'i';

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


   public function listas_titulo( ) {
              
            $this->db->select("t.id, t.nombre,t.tooltip ");         
            $this->db->from($this->catalogo_titulos.' As t');
            $result = $this->db->get(  );
                if ($result->num_rows() > 0)
                    return $result->result();
                else 
                    return FALSE;
                $result->free_result();
     }  
/////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////    


   //1- correo logueo
   //ok-
   public function correo_logueo($data){
              $this->db->select("id,variation_id, descripcion_interior,descripcion_adicionales, descripcion_color, descripcion_num_hojas, id_session, modulo, consecutivo, correo");         
              $this->db->select("id_diseno, variation_id, nombre_diseno, nombre_tamano, descripcion_tamano, imagen_diseno");         
              $this->db->select("imagen_tamano, fecha_mac, objeto_diseno, objeto_adicionales, imagen_interior, imagen_num_hojas");         

              
              $this->db->from($this->logueo_identificador);
              $where = '(
                          (
                            ( id_session =  "'.$data['id_session'].'" )  AND ( modulo =  "'.$this->modulo.'" )
                     
                           )
                )';   
              $this->db->where($where);
              $this->db->order_by('fecha_mac','ASC'); //por el orden en que se agreguen los tamaños
             
              $info = $this->db->get();
              if ($info->num_rows() > 0) {
                  return $info->result();
              }    
              else
                  return false;
              $info->free_result();
  } 



///////////////////Leer los datos sobre el calendario activo//////////////////////////
  //ok-
    public function fotocalendario_edicion($data){
            $this->db->select("id, id_session, consecutivo, id_diseno, variation_id");         
            $this->db->select("titulo, nombre, apellidos");         
            $this->db->select("id_mes, id_dia, id_copia, id_festividad, id_ano, id_lista, logo, coleccion_id_logo, fecha");         
            
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
            
            $info = $this->db->get();
            if ($info->num_rows() > 0) {
                return $info->row();
            }    
            else
                return false;
            $info->free_result();
    }

   ///////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////
    //OK-
     public function listado_logos( ){
              
            $this->db->select("l.id, l.nombre,l.tooltip ");         
            $this->db->from($this->catalogo_logo.' As l');
            $result = $this->db->get(  );
                if ($result->num_rows() > 0)
                    return $result->result();
                else 
                    return FALSE;
                $result->free_result();
     }  

  /////////////////**********OJO*********/////////////////////////////////////////////////////    
    /////////////OJO VER SI SE VA A RELACIONAR CON CORREO O CON SESSION///////    
    /////////////ESTA ES LA LISTA ASOCIADA AL USUARIO///////    
    //////////////////////////////////////////////////////////////////////////////////////////
    public function listado_listas($data){
            $this->db->select("l.id, l.id_session, l.variation_id,l.id_diseno,l.consecutivo, l.correo, l.nombre");         
            $this->db->from($this->fotocalendario_lista.' As l');
            $this->db->where('l.id_session',$data['id_session']);
            $this->db->where('l.modulo' , $this->modulo);

            $result = $this->db->get(  );
                if ($result->num_rows() > 0)
                    return $result->result();
                else 
                    return FALSE;
                $result->free_result();
    }  


    /////////////Lista de todos los diseños q estan hechos hasta el momento///////    
    //////////////////////////////////////////////////////////////////////////////////////////
     public function buscador_predictivo($data){
     
        $where = '(                     
                      (( t.id_session =  "'.$data['id_session'].'" )   OR  ( t.id_user =  '.$this->id_user.' ) )              
                      AND
                      ( ( t.nombre LIKE  "%'.$data['key'].'%" ) OR  ( t.apellidos LIKE  "%'.$data['key'].'%" ) )
                      
        )'; 


          $result = $this->db->query('

            select r.id,r.id_session, r.id_diseno,r.id_tamano,r.consecutivo, r.modulo,r.titulo,r.ubicacion from (
               select t.id,t.id_session, t.id_diseno,t.id_tamano,t.consecutivo,  t.modulo,
                CONCAT(
                   CASE  
                      WHEN t.modulo ="f" THEN "Fot.Cal. - "
                      WHEN t.modulo ="c" THEN "Cal. - "
                      WHEN t.modulo ="a" THEN "Agen. - "
                      WHEN t.modulo ="g" THEN "Fot.Agen. - "
                      WHEN t.modulo ="i" THEN "Fot.Lib. - "
                      WHEN t.modulo ="l" THEN "Lib. - "

                   ELSE ""
                   END,
                   " ",t.nombre," ",t.apellidos,". ") titulo,
                "v" ubicacion
                FROM  '.$this->fotocalendario_temporal.' t  where '.$where.'
           union
               select t.id,t.id_session, t.id_diseno,t.id_tamano,t.consecutivo,  t.modulo,
                CONCAT(
                   CASE  
                      WHEN t.modulo ="f" THEN "Fot.Cal. - "
                      WHEN t.modulo ="c" THEN "Cal. - "
                      WHEN t.modulo ="a" THEN "Agen. - "
                      WHEN t.modulo ="g" THEN "Fot.Agen. - "
                      WHEN t.modulo ="i" THEN "Fot.Lib. - "
                      WHEN t.modulo ="l" THEN "Lib. - "
                   ELSE ""
                   END,
                   " ",t.nombre," ",t.apellidos,". ") titulo,
                "h" ubicacion
                FROM  '.$this->historico_fotocalendario_temporal.' t  where '.$where.'        
            ) r  

            ');  

              if ($result->num_rows() > 0) {
                  foreach ($result->result() as $row) 
                      {
                            $dato[]= array(
                                       "value"=>$row->titulo." | ".$row->ubicacion,
                                       "key"=>$row->id, // value="2215"
                                       "session"=>$row->id_session,
                                       "diseno"=>$row->id_diseno,
                                       "tamano"=>$row->id_tamano,
                                       "consecutivo"=>$row->consecutivo,
                                       "modulo"=>$row->modulo,
                                       "ubicacion"=>$row->ubicacion,
                                        "titulo"=>$row->titulo,
                                       
                                    );
                      }
                      return json_encode($dato);
              }   
              else 
                 return False;
              $result->free_result();
      }    

    public function listado_todolistas($data){
        $where = '(                     
                      ( t.id_session =  "'.$data['id_session'].'" )   OR  ( t.id_user =  '.$this->id_user.' )               
        )';   

   $result = $this->db->query('

            select r.id,r.id_session, r.id_diseno,r.variation_id,r.consecutivo, r.modulo,r.titulo,r.ubicacion from (
               select t.id,t.id_session, t.id_diseno,t.variation_id,t.consecutivo,  t.modulo,
                CONCAT(
                   CASE  
                      WHEN t.modulo ="f" THEN "Fot.Cal.->"
                      WHEN t.modulo ="c" THEN "Cal.->"
                      WHEN t.modulo ="a" THEN "Agen.->"
                      WHEN t.modulo ="g" THEN "Fot.Agen.->"
                      WHEN t.modulo ="i" THEN "Fot.Lib.->"
                      WHEN t.modulo ="l" THEN "Lib.->"
                   ELSE ""
                   END,
                   " ",t.nombre," ",SUBSTRING(t.apellidos,1,1),". ",DATE_FORMAT((t.fecha_mac),"%d-%m-%Y %H:%i:%s")) titulo,
                "v" ubicacion
                FROM  '.$this->fotocalendario_temporal.' t  where '.$where.'
           union
               select t.id,t.id_session, t.id_diseno,t.variation_id,t.consecutivo,  t.modulo,
                CONCAT(
                   CASE  
                      WHEN t.modulo ="f" THEN "Fot.Cal.->"
                      WHEN t.modulo ="c" THEN "Cal.->"
                      WHEN t.modulo ="a" THEN "Agen.->"
                      WHEN t.modulo ="g" THEN "Fot.Agen.->"
                      WHEN t.modulo ="i" THEN "Fot.Lib.->"
                      WHEN t.modulo ="l" THEN "Lib.->"
                   ELSE ""
                   END,
                   " ",t.nombre," ",SUBSTRING(t.apellidos,1,1),". ",DATE_FORMAT((t.fecha_mac),"%d-%m-%Y %H:%i:%s")) titulo,
                "h" ubicacion
                FROM  '.$this->historico_fotocalendario_temporal.' t  where '.$where.'        
            ) r  

            ');  
         
                if ($result->num_rows() > 0)
                    return $result->result();
                else 
                    return FALSE;
                $result->free_result();

    }  


/////////////////////////////////eliminar la imagen del logo/////////////////////////////////////////////
     public function eliminar_logo_formulario($data){
             
            $this->db->set( 'logo', '');          
            //$this->db->set( 'coleccion_id_logo', $data['coleccion_id_logo'] );  
            $where = '(
                          (
                            ( m.id_session =  "'.$data['id_session'].'" ) AND
                            ( m.variation_id =  '.$data['variation_id'].' ) AND
                            ( m.id_diseno =  '.$data['id_diseno'].' ) AND
                            ( m.modulo =  "'.$this->modulo.'" ) AND
                            ( m.consecutivo =  '.$data['consecutivo'].' ) 
                           )
            )';   

            $this->db->where($where);
            
            $this->db->update($this->fotocalendario_temporal.' As m');

            if ($this->db->affected_rows() > 0){
                    return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();

     }








//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////

 public function calenda_activos($data){
            $this->db->select("variation_id, id_diseno, consecutivo");          //
            $this->db->from($this->fotocalendario_temporal);
            $where = '(
                        (
                          ( id_session =  "'.$data['id_session'].'" ) AND ( modulo =  "'.$this->modulo.'" )

                          
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



//////////////////////////////////////////////////////////////
 ////////////////Activar las previsualizaciones///////////////
 //////////////////////////////////////////////////////////////
//OK para activar "previsualizar" cuando ya estan las 12 imagenes

   //totales de tamaños para una session en especifico
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


 //correo logueo
 public function disenos_completos($data){

            $this->db->select("id_session,id_diseno,variation_id,consecutivo");         
            
            $this->db->select("COUNT(id_diseno) as cantidad",false); 


            $this->db->from($this->fotocalendario_imagenes);
            $where = '(
                        (
                          ( id_session =  "'.$data['id_session'].'" )   AND ( modulo =  "'.$this->modulo.'" )                        
                         )
            )';   
  
            $this->db->where($where);
            $this->db->group_by("id_session,id_diseno,variation_id,consecutivo");
            
            $info = $this->db->get();
            if ($info->num_rows() > 0) {
                return $info->result();
            }    
            else
                return false;
            $info->free_result();
 } 


 public function total_disenos_completos($data){
                  
                  $this->db->from($this->fotocalendario_temporal);
                  
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



        public function ultimo_elemento($data){

                    $this->db->select("id_session,id_diseno,variation_id,consecutivo");         

                    $this->db->from($this->logueo_identificador);
                    
                    $where = '(
                                (
                                  ( id_session =  "'.$data['id_session'].'" )   AND ( modulo =  "'.$this->modulo.'" )                        
                                )
                    )';   

                    $this->db->where($where);

                    $this->db->order_by('fecha_mac','DESC');             
                    $this->db->order_by('id','DESC');

                    $this->db->limit(1);
                    $info = $this->db->get();
                    if ($info->num_rows() > 0) {
                        return $info->row();
                    }    
                    else
                        return false;
                    $info->free_result();
         } 



//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////




    //cuando se elimina un diseño en particular
    public function eliminar_diseno_completo( $data ){
       
        $this->db->delete( $this->fotocalendario_temporal, array('id_session' => $data['id_session'],  'variation_id' => $data['variation_id'],  'id_diseno' => $data['id_diseno'],   'consecutivo' => $data['consecutivo'], 'modulo' => $this->modulo ) );
        $this->db->delete( $this->logueo_identificador, array('id_session' => $data['id_session'],  'variation_id' => $data['variation_id'],  'id_diseno' => $data['id_diseno'],   'consecutivo' => $data['consecutivo'], 'modulo' => $this->modulo ) );
        $this->db->delete( $this->fotocalendario_imagenes, array('id_session' => $data['id_session'],  'variation_id' => $data['variation_id'],  'id_diseno' => $data['id_diseno'],   'consecutivo' => $data['consecutivo'], 'modulo' => $this->modulo ) );
        $this->db->delete( $this->fotocalendario_imagenes_original,array('id_session' => $data['id_session'],  'variation_id' => $data['variation_id'],  'id_diseno' => $data['id_diseno'],   'consecutivo' => $data['consecutivo'], 'modulo' => $this->modulo ) );
        $this->db->delete( $this->fotocalendario_imagenes_recorte, array('id_session' => $data['id_session'],  'variation_id' => $data['variation_id'],  'id_diseno' => $data['id_diseno'],   'consecutivo' => $data['consecutivo'], 'modulo' => $this->modulo ) );


        return TRUE;

    }




//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////



//OK /////////////////checar si existe el dato q voy agregar//////////////////////////
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




//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////



//OK  //////////////////////////eliminar/////////////////////////////
    public function eliminar_fotocalendario( $data ){
        $this->db->delete( $this->fotocalendario_temporal, array( 'id_session' => $data['id_session'],  'variation_id' => $data['variation_id'],  'id_diseno' => $data['id_diseno'],   'consecutivo' => $data['consecutivo'] , 'modulo' => $this->modulo ) );
        if ( $this->db->affected_rows() > 0 ) return TRUE;
        else return FALSE;
    }


    public function eliminar_imagenes( $data ){
        $this->db->delete( $this->fotocalendario_imagenes, array( 'id_session' => $data['id_session'],  'variation_id' => $data['variation_id'],  'id_diseno' => $data['id_diseno'],   'consecutivo' => $data['consecutivo'], 'modulo' => $this->modulo ) );
        if ( $this->db->affected_rows() > 0 ) return TRUE;
        else return FALSE;
    }
    //ok
    public function eliminar_imagenes_original( $data ){
        $this->db->delete( $this->fotocalendario_imagenes_original, array( 'id_session' => $data['id_session'],  'variation_id' => $data['variation_id'],  'id_diseno' => $data['id_diseno'],   'consecutivo' => $data['consecutivo'], 'modulo' => $this->modulo ) );
        if ( $this->db->affected_rows() > 0 ) return TRUE;
        else return FALSE;
    }
    //ok
    public function eliminar_imagenes_recorte( $data ){
        $this->db->delete( $this->fotocalendario_imagenes_recorte, array( 'id_session' => $data['id_session'],  'variation_id' => $data['variation_id'],  'id_diseno' => $data['id_diseno'],   'consecutivo' => $data['consecutivo'], 'modulo' => $this->modulo ) );
        if ( $this->db->affected_rows() > 0 ) return TRUE;
        else return FALSE;
    }


//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////


    //OK Fotocalendario
     public function anadir_fotocalendario($data){
          
 
          $this->db->set( 'id_session', $data['id_session'] );  //

          $this->db->set( 'id_diseno', $data['id_diseno'] );  //
          $this->db->set( 'variation_id', $data['variation_id'] );  //
          $this->db->set( 'id_tamano', $data['variation_id'] );  //
          $this->db->set( 'consecutivo', $data['consecutivo'] );  //
          
          $this->db->set( 'titulo', $data['titulo'] );  
          $this->db->set( 'nombre', $data['nombre'] );  
          $this->db->set( 'apellidos', $data['apellidos'] );  

          $this->db->set( 'id_copia', $data['id_copia'] );  
          
          $this->db->set('modulo', $this->modulo);  
          $this->db->set('id_user', $this->id_user);  


          if  (isset($data['logo'])) {
                $this->db->set( 'logo', $data['logo']['file_name']);          
           }  
          $this->db->set( 'coleccion_id_logo', $data['coleccion_id_logo'] );                         

            $this->db->insert($this->fotocalendario_temporal);
            if ($this->db->affected_rows() > 0){
                    return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();
     }


//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function checar_existente_lista($data){
            $this->db->select("id_session, variation_id", FALSE);         
            
            if ($data['old_ubicacion']=='v') {
              $this->db->from($this->fotocalendario_temporal);  
            } else {
              $this->db->from($this->historico_fotocalendario_temporal);  
            }
            

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

     //fin de catalogos


    /////////////Lista de todos los diseños q estan hechos hasta el momento///////    
    //////////////////////////////////////////////////////////////////////////////////////////
    public function leer_info($data){
            
            

            $imagen = 'img_'.$data["id_session"].'_'.$data["id_diseno"].'_'.$data["variation_id"].'_'.$data["consecutivo"];
                      
            $this->db->select("( CASE WHEN (t.logo <> '') THEN  CONCAT('".$imagen."',SUBSTRING(t.logo, POSITION('"."."."' IN t.logo)) ) ELSE '' END ) logo",FALSE); 
            $this->db->select("( CASE WHEN (t.logo <> '') THEN  t.logo ELSE '' END ) logo_anterior",FALSE); 

            $this->db->select('"'.$data["id_session"].'" id_session', false);         
            $this->db->select($data["id_diseno"].' id_diseno', false);         
            $this->db->select($data["variation_id"].' variation_id', false);         
            $this->db->select($data["variation_id"].' id_tamano', false);         
            $this->db->select($data["consecutivo"].' consecutivo', false);         
            
            //$this->db->select('t.id_copia, t.titulo, t.nombre,  t.apellidos');   
            
            //campos que estaran limpios
            $this->db->select('1 id_copia', false);         
            $this->db->select('"" titulo', false);         
            $this->db->select('"" nombre', false);         
            $this->db->select('"" apellidos', false);


            $this->db->select('t.id_mes, t.id_dia, t.id_festividad, t.id_ano, t.id_lista');         

            $this->db->select('t.coleccion_id_logo,t.fecha');  

            $this->db->select('"'.$this->modulo.'" modulo', false);                
            $this->db->select($this->id_user.' id_user', false);

            
            if ($data['old_ubicacion']=='v') {
              $this->db->from($this->fotocalendario_temporal.' As t');
            } else {
              $this->db->from($this->historico_fotocalendario_temporal.' As t');
            }
            
            
            $this->db->where('t.id',$data['id']);
            //$this->db->where('t.modulo' , $this->modulo);

            $result = $this->db->get(  );
                if ($result->num_rows() > 0) {
                      $objeto = $result->result();
                      $this->db->delete( $this->fotocalendario_temporal, array('id_session' => $data['id_session'],  'variation_id' => $data['variation_id'],  'id_diseno' => $data['id_diseno'],   'consecutivo' => $data['consecutivo'], 'modulo' => $this->modulo ) );
                                            

                      //copiar "registros" a la misma tabla
                      $logo = $objeto[0]->logo_anterior; //->logo;
                      foreach ($objeto as $key => $value) {
                        $this->db->insert($this->fotocalendario_temporal, $value); 
                      }                  

                }
                    
                return $logo; //true;
                $result->free_result();
    }  



////////////////////////////copia de toda la lista////////////////////////////////////

public function leer_imagenes($data){
            
            $this->db->select("CONCAT('uid_','".date('d')."','".date('m')."','".date('Y')."','_','".$data['id_diseno']."','".$data['variation_id']."','".$data['consecutivo']."',i.ano,i.mes) uid_imagen", false);

            $this->db->select('"'.$data["id_session"].'" id_session', false); 
            $this->db->select($data["id_diseno"].' id_diseno', false);         
            $this->db->select($data["variation_id"].' variation_id', false);         
            $this->db->select($data["variation_id"].' id_tamano', false);         
            $this->db->select($data["consecutivo"].' consecutivo', false);         
            
            $this->db->select('i.ano, i.mes');         
            
            $this->db->select("CONCAT('orig_',".$data['id_diseno'].",'_',".$data['variation_id'].",'_',".$data['consecutivo'].",'_',i.ano,'_',i.mes,SUBSTRING(i.original, POSITION('"."."."' IN i.original)) ) original", false);
            $this->db->select("CONCAT('rec_',".$data['id_diseno'].",'_',".$data['variation_id'].",'_',".$data['consecutivo'].",'_',i.ano,'_',i.mes,SUBSTRING(i.recorte, POSITION('"."."."' IN i.recorte)) ) recorte", false);

            $this->db->select("original original_old", false);
            $this->db->select("recorte recorte_old", false);

            $this->db->select('"'.$this->modulo.'" modulo', false);         
            $this->db->select($this->id_user.' id_user', false);
            


            
            if ($data['old_ubicacion']=='v') {
              $this->db->from($this->fotocalendario_imagenes.' As i');
            } else {
              $this->db->from($this->historico_fotocalendario_imagenes.' As i');
            }   
            

            $where = '(
                            (
                              (( i.id_session =  "'.$data['id_session'].'" )  OR  ( i.id_user =  '.$this->id_user.' ) ) AND
                              ( i.id_diseno =  '.$data['old_id_diseno'].' ) AND
                              ( i.variation_id =  '.$data['old_variation_id'].' ) AND 
                              ( i.modulo =  "'.$data['old_modulo'].'" ) AND
                             
                              ( i.consecutivo =  '.$data['old_consecutivo'].' ) 

                             )
                  )';   
            
            $this->db->where($where);
            $result = $this->db->get();

            if ($result->num_rows() > 0) {
                  $objeto = $result->result();

                  //copiar "registros" a la misma tabla
                  foreach ($objeto as $llave => $registros) {
                                                //original
                            if ($registros->original_old!='') { //si hay imagenes
                                $fichero =   './uploads/'.$data['id_session'].'/'.$registros->original_old;

                                  if (file_exists($fichero)) {
                                  $nuevo_fichero    = './uploads/'.$data['id_session'].'/'.$registros->original;
                                  copy($fichero, $nuevo_fichero); 
                                  }
                            }
                                      //recorte
                            if ($registros->recorte_old!='') { //si hay imagenes
                                $fichero =   './uploads/'.$data['id_session'].'/'.$registros->recorte_old;

                                  if (file_exists($fichero)) {
                                  $nuevo_fichero    = './uploads/'.$data['id_session'].'/'.$registros->recorte;
                                  copy($fichero, $nuevo_fichero); 
                                  }
                            }
                            $this->db->insert($this->fotocalendario_imagenes, $registros); 
                  }                

            }
            return true;

    }  




 public function leer_imagenes_original($data){


            $this->db->select('"'.$data["id_session"].'" id_session', false); 
            $this->db->select($data["id_diseno"].' id_diseno', false);         
            $this->db->select($data["variation_id"].' variation_id', false);         
            $this->db->select($data["variation_id"].' id_tamano', false);         
            $this->db->select($data["consecutivo"].' consecutivo', false);  
            $this->db->select("CONCAT('uid_','".date('d')."','".date('m')."','".date('Y')."','_','".$data['id_diseno']."','".$data['variation_id']."','".$data['consecutivo']."',i.ano,i.mes) uid_imagen", false);
            $this->db->select("CONCAT('orig_',".$data['id_diseno'].",'_',".$data['variation_id'].",'_',".$data['consecutivo'].",'_',i.ano,'_',i.mes,SUBSTRING(i.original, POSITION('"."."."' IN i.original)) ) nombre", false);
            $this->db->select('o.tipo_archivo, o.tipo, o.ext, o.tamano, o.ancho, o.alto');         
            
            $this->db->select('"'.$this->modulo.'" modulo', false);         
            $this->db->select($this->id_user.' id_user', false);

            
            if ($data['old_ubicacion']=='v') {
              $this->db->from($this->fotocalendario_imagenes_original.' As o');
              $this->db->join($this->fotocalendario_imagenes.' As i', 'i.id_session = o.id_session and i.id_diseno = o.id_diseno and i.variation_id = o.variation_id and i.consecutivo =o.consecutivo and i.uid_imagen =o.uid_imagen');
            } else {
              $this->db->from($this->historico_fotocalendario_imagenes_original.' As o');
              $this->db->join($this->historico_fotocalendario_imagenes.' As i', 'i.id_session = o.id_session and i.id_diseno = o.id_diseno and i.variation_id = o.variation_id and i.consecutivo =o.consecutivo and i.uid_imagen =o.uid_imagen');
            }            

            $where = '(
                            (
                              (( o.id_session =  "'.$data['id_session'].'" )  OR  ( o.id_user =  '.$this->id_user.' ) ) AND
                              ( o.id_diseno =  '.$data['old_id_diseno'].' ) AND
                              ( o.variation_id =  '.$data['old_variation_id'].' ) AND     
                              ( o.modulo =  "'.$data['old_modulo'].'" ) AND
                         
                              ( o.consecutivo =  '.$data['old_consecutivo'].' ) 
                             )
                  )';   
            
            $this->db->where($where);
            $result = $this->db->get();




            if ($result->num_rows() > 0) {
                  $objeto = $result->result();

                  //copiar "registros" a la misma tabla
                  foreach ($objeto as $llave => $registros) {
                            $this->db->insert($this->fotocalendario_imagenes_original, $registros); 
                  }                

            }
            return true;


      }    





 public function leer_imagenes_recorte($data){

            $this->db->select('"'.$data["id_session"].'" id_session', false); 
            $this->db->select($data["id_diseno"].' id_diseno', false);         
            $this->db->select($data["variation_id"].' variation_id', false);         
            $this->db->select($data["variation_id"].' id_tamano', false);         
            $this->db->select($data["consecutivo"].' consecutivo', false);  
            
            $this->db->select('"'.$this->modulo.'" modulo', false);         
            $this->db->select($this->id_user.' id_user', false);

            $this->db->select("CONCAT('uid_','".date('d')."','".date('m')."','".date('Y')."','_','".$data['id_diseno']."','".$data['variation_id']."','".$data['consecutivo']."',i.ano,i.mes) uid_imagen", false);
            $this->db->select("CONCAT('rec_',".$data['id_diseno'].",'_',".$data['variation_id'].",'_',".$data['consecutivo'].",'_',i.ano,'_',i.mes,SUBSTRING(i.recorte, POSITION('"."."."' IN i.recorte)) ) nombre", false);
            
            

            $this->db->select('o.aspectRatio, o.height, o.left, o.naturalHeight, o.naturalWidth, o.rotate, o.scaleX, o.scaleY, o.top, o.width, o.cleft, o.ctop, o.cheight, o.cwidth, o.cnaturalWidth, o.cnaturalHeight, o.dx, o.dy, o.dwidth, o.dheight, o.drotate, o.dscaleX, o.dscaleY, o.bleft, o.btop, o.bwidth, o.bheight');         
       
           
            if ($data['old_ubicacion']=='v') {
              $this->db->from($this->fotocalendario_imagenes_recorte.' As o');
              $this->db->join($this->fotocalendario_imagenes.' As i', 'i.id_session = o.id_session and i.id_diseno = o.id_diseno and i.variation_id = o.variation_id and i.consecutivo =o.consecutivo and i.uid_imagen =o.uid_imagen');
            } else {
              $this->db->from($this->historico_fotocalendario_imagenes_recorte.' As o');
              $this->db->join($this->historico_fotocalendario_imagenes.' As i', 'i.id_session = o.id_session and i.id_diseno = o.id_diseno and i.variation_id = o.variation_id and i.consecutivo =o.consecutivo and i.uid_imagen =o.uid_imagen');
            }             

            $where = '(
                            (
                              (( o.id_session =  "'.$data['id_session'].'" )  OR  ( o.id_user =  '.$this->id_user.' ) ) AND
                              ( o.id_diseno =  '.$data['old_id_diseno'].' ) AND
                              ( o.variation_id =  '.$data['old_variation_id'].' ) AND      
                              ( o.modulo =  "'.$data['old_modulo'].'" ) AND
                        
                              ( o.consecutivo =  '.$data['old_consecutivo'].' ) 
                             )
                  )';   
            
            $this->db->where($where);
            $result = $this->db->get();




            if ($result->num_rows() > 0) {
                  $objeto = $result->result();

                  //copiar "registros" a la misma tabla
                  foreach ($objeto as $llave => $registros) {
                            $this->db->insert($this->fotocalendario_imagenes_recorte, $registros); 
                  }                

            }
            return true;


      }    






///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/////////////////////////////////Imagen//////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////

 public function elemento_imagen($data){
            $this->db->from($this->fotocalendario_imagenes);

            $where = '(
                        (
                          ( id_session =  "'.$data['id_session'].'" ) AND
                          ( variation_id =  '.$data['variation_id'].' ) AND
                          ( id_diseno =  '.$data['id_diseno'].' ) AND
                          ( modulo =  "'.$this->modulo.'" ) AND
                          ( mes =  '.$data['mes'].' )  AND

                          ( consecutivo =  '.$data['consecutivo'].' ) 
                         )
              )';   
  
            $this->db->where($where);
            
            $info = $this->db->get();
            if ($info->num_rows() > 0) {
                return 0;  
            }    
            else
                return 1; //significa q no existe hay q sumar 1 si hay imagen
            $info->free_result();
 } 


  public function cant_disenos_completos_unelmento($data){

            $this->db->select("id_session,id_diseno,variation_id,consecutivo");         
            
            $this->db->select("COUNT(id_diseno) as cantidad",false); 


            $this->db->from($this->fotocalendario_imagenes);

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
            $this->db->group_by("id_session,id_diseno,variation_id,consecutivo");
            
            $info = $this->db->get();
            if ($info->num_rows() > 0) {
                $fila= $info->row();
                return $fila->cantidad;
            }    
            else
                return 0;
            $info->free_result();
 } 

    
  } 



?>