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

      $this->modulo = 'v';

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



/////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////    

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
     
   //1- correo logueo
   //ok-
   public function correo_logueo($data){
              $this->db->select("id,variation_id, descripcion_interior,descripcion_adicionales, descripcion_color, descripcion_num_hojas, id_session, modulo, consecutivo, correo, image_link,logos,longitud_nombre,longitud_texto");
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
            $this->db->select("titulo, nombre, apellidos,titulo_interior, nombre_interior, apellidos_interior,coleccion_id_igual");         
            $this->db->select("id_mes, id_dia, id_copia, id_festividad, id_ano, id_lista, logo, coleccion_id_logo, fecha");         

            $this->db->select("texto_pagina");  
            
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



    public function info_activo($data){
        $this->db->select("logos,longitud_nombre,longitud_texto");
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
        $info = $this->db->get();
        if ($info->num_rows() > 0) {
            return $info->result();
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
                      (( t.id_session =  "'.$data['id_session'].'" )  OR ((t.id_user =  '.$this->id_user.') 
                      AND (t.id_user <>0)) )              
                      AND
                      ( ( t.nombre LIKE  "%'.$data['key'].'%" ) OR  ( t.apellidos LIKE  "%'.$data['key'].'%" ) )
        )'; 

          $result = $this->db->query('
            select r.id,r.id_session, r.id_diseno,r.variation_id,r.consecutivo, r.modulo,r.titulo,r.ubicacion from (
               select t.id,t.id_session, t.id_diseno,t.variation_id,t.consecutivo,  t.modulo,
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
               select t.id,t.id_session, t.id_diseno,t.variation_id,t.consecutivo,  t.modulo,
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
                                       "variacion"=>$row->variation_id,
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
                      ( t.id_session =  "'.$data['id_session'].'" )    OR ((t.id_user =  '.$this->id_user.') 
                      AND (t.id_user <>0))                                
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
          $this->db->set( 'texto_pagina', $data['texto_pagina'] );  

           if (($data['coleccion_id_igual']!="1")) { //sino marco
              
              $this->db->set( 'titulo_interior', $data['titulo_interior'] );  
              $this->db->set( 'nombre_interior', $data['nombre_interior'] );  
              $this->db->set( 'apellidos_interior', $data['apellidos_interior'] );  
            } else { //si marco
              $this->db->set( 'coleccion_id_igual', $data['coleccion_id_igual'] );  
              $this->db->set( 'titulo_interior', $data['titulo'] );  
              $this->db->set( 'nombre_interior', $data['nombre'] );  
              $this->db->set( 'apellidos_interior', $data['apellidos'] );  

            }



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
            
            //$this->db->select("SUBSTRING(t.logo, POSITION('.' IN t.logo) ) aaa"); 

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

            $this->db->select('"" coleccion_id_igual', false);         
            $this->db->select('"" titulo_interior', false);         
            $this->db->select('"" nombre_interior', false);         
            $this->db->select('"" apellidos_interior', false);




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
                        //print_r($value);
                        $this->db->insert($this->fotocalendario_temporal, $value); 
                      }                  

                }
                    
                return $logo; //true;
                $result->free_result();
    }  


    
  } 



?>