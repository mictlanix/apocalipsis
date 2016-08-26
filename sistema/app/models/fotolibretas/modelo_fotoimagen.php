<?php if(! defined('BASEPATH')) exit('No tienes permiso para acceder a este archivo');
  class modelo_fotoimagen extends CI_Model{
    
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

      $this->modulo = 'i';
              $current_user = wp_get_current_user();
        $this->id_user = $current_user->id;


    }



 //OK 1- correo logueo
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



///////////////////////////////////////////////////////////////////////////////////////////////
///////////////////Tratamiento de imagen////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
///////////////////checar si existe el dato de IMAGEN q voy agregar//////////////////////////
  //ok
    public function check_existente_imagen($data){
            $this->db->select("uid_imagen", FALSE);         
            $this->db->from($this->fotocalendario_imagenes);

            $where = '(
                        (
                                                   
                          ( id_session =  "'.$data['id_session'].'" ) AND
                          ( id_diseno =  '.$data['id_diseno'].' ) AND
                          ( variation_id =  '.$data['variation_id'].' ) AND
                          ( consecutivo =  '.$data['consecutivo'].' ) AND
                          ( modulo =  "'.$this->modulo.'" ) AND

                          ( ano =  "'.$data['ano'].'" ) AND
                          ( mes =  "'.$data['mes'].'" ) AND
                          ( original =  "'.$data['nombre'].'" )                           
                          
                          
                         )
              )';   
  
            $this->db->where($where);
            
            $info = $this->db->get();
            if ($info->num_rows() > 0) {
                $fila = $info->row(); 
                return $fila->uid_imagen;
            }    
            else
                return false;
            $info->free_result();
    } 
    /////////////////////////////////////////////    
    /////////////////////////////////////////////
////////////////////////////eliminar/////////////////////////////
    //ok
    public function eliminar_imagenes( $data ){
        $this->db->delete( $this->fotocalendario_imagenes, array( 'uid_imagen' => $data, 'modulo' => $this->modulo ) );
        if ( $this->db->affected_rows() > 0 ) return TRUE;
        else return FALSE;
    }
    //ok
    public function eliminar_imagenes_original( $data ){
        $this->db->delete( $this->fotocalendario_imagenes_original, array( 'uid_imagen' => $data, 'modulo' => $this->modulo ) );
        if ( $this->db->affected_rows() > 0 ) return TRUE;
        else return FALSE;
    }
    //ok
    public function eliminar_imagenes_recorte( $data ){
        $this->db->delete( $this->fotocalendario_imagenes_recorte, array( 'uid_imagen' => $data, 'modulo' => $this->modulo ) );
        if ( $this->db->affected_rows() > 0 ) return TRUE;
        else return FALSE;
    }
/////////////////////////////////////////////    
    /////////////////////////////////////////////
////////////////////////////Agregar/////////////////////////////
     
//ok
     public function anadir_imagenes($data){
          $this->db->set('id_session', $data['id_session']);

          $this->db->set('id_diseno', $data['id_diseno']);  
          $this->db->set('variation_id', $data['variation_id']);  
          $this->db->set('id_tamano', $data['variation_id']);  
          $this->db->set('consecutivo', $data['consecutivo']);  

          $this->db->set('modulo', $this->modulo);  
          $this->db->set('id_user', $this->id_user);  

          $this->db->set('uid_imagen', $data['uid_imagen']);  
          

          $this->db->set('ano', $data['ano']);  
          $this->db->set('mes', $data['mes']);  
          
          $this->db->set('original', $data['nombre']);  
          $this->db->set('recorte', 'rec_'.substr($data['nombre'], 5));  




          
          $this->db->insert($this->fotocalendario_imagenes);
          
          if ($this->db->affected_rows() > 0){
                    return TRUE;
          } else {
              return FALSE;
          }
          $result->free_result();
     }

 //ok     
      public function anadir_imagenes_original($data){
             $this->db->set('id_session', $data['id_session']);  

             $this->db->set('id_diseno', $data['id_diseno']);  
             $this->db->set('variation_id', $data['variation_id']);  
             $this->db->set('id_tamano', $data['variation_id']);  
             $this->db->set('consecutivo', $data['consecutivo']);  

             $this->db->set('modulo', $this->modulo);  
             $this->db->set('id_user', $this->id_user);  


             $this->db->set('uid_imagen', $data['uid_imagen']);  
                 $this->db->set('nombre', $data['nombre']);
           $this->db->set('tipo_archivo', $data['tipo_archivo']);  
                   $this->db->set('tipo', $data['tipo']);  
                    $this->db->set('ext', $data['ext']);   
                 $this->db->set('tamano', $data['tamano']);  
                  $this->db->set('ancho', $data['ancho']);   
                   $this->db->set('alto', $data['alto']);  
                 $this->db->insert($this->fotocalendario_imagenes_original);
           
            if ($this->db->affected_rows() > 0){
                    return TRUE;
                } else {
                    return FALSE;
            }
            $result->free_result();
      }       
     
        
     //ok 

     public function anadir_imagenes_recorte($data){
         
             $this->db->set('id_session', $data['id_session']);  
             
             $this->db->set('id_diseno', $data['id_diseno']);  
             $this->db->set('variation_id', $data['variation_id']);  
             $this->db->set('id_tamano', $data['variation_id']);  
             $this->db->set('consecutivo', $data['consecutivo']);  

             $this->db->set('modulo', $this->modulo);  
             $this->db->set('id_user', $this->id_user);  

             $this->db->set('uid_imagen', $data['uid_imagen']);  
             //$this->db->set('nombre', 'recorte_'.$data['nombre']);  
             $this->db->set('nombre', 'rec_'.substr($data['nombre'], 5));  

         
          foreach ($data['datoimagen'] as $llave => $valor) {
                 $this->db->set( $llave, $valor );  
          } 
          foreach ($data['datocanvas'] as $llave => $valor) {
                 $this->db->set( 'c'.$llave, $valor );  
          } 

          foreach ($data['datos'] as $llave => $valor) {
                 $this->db->set( 'd'.$llave, $valor );  
          } 

          foreach ($data['datocropbox'] as $llave => $valor) {
                 $this->db->set( 'b'.$llave, $valor );  
          } 



          $this->db->insert($this->fotocalendario_imagenes_recorte);
            
            if ($this->db->affected_rows() > 0){
                    return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();
      } 
     

     //OK fin de la lista
    public function buscar_imagen($data){
            $this->db->select("i.id, i.id_session, i.id_diseno,i.variation_id,i.consecutivo, i.uid_imagen, i.ano, i.mes");         
            $this->db->select("o.nombre original, o.tipo_archivo, o.tipo, o.ext, o.tamano, o.ancho, o.alto");         
            $this->db->select("r.nombre recorte, r.aspectRatio, r.height, r.left, r.naturalHeight, r.naturalWidth, r.rotate, r.scaleX, r.scaleY, r.top, r.width");         
            $this->db->select("r.cwidth, r.cheight, r.cnaturalWidth, r.cnaturalHeight,  r.cleft, r.ctop");         
            $this->db->select("r.dx, r.dy, r.dwidth, r.dheight, r.drotate, r.dscaleX, r.dscaleY");         
            $this->db->select("r.bleft, r.btop, r.bwidth, r.bheight");  

            $this->db->select('"'.$this->modulo.'" modulo', false);                
            


            $this->db->from($this->fotocalendario_imagenes.' As i');
            $this->db->join($this->fotocalendario_imagenes_original.' As o', 'i.uid_imagen = o.uid_imagen','LEFT');
            $this->db->join($this->fotocalendario_imagenes_recorte.' As r', 'i.uid_imagen = r.uid_imagen','LEFT');

            $where = '(
                        (
                          ( i.id_session =  "'.$data['id_session'].'" ) AND
                          ( i.id_diseno =  '.$data['id_diseno'].' ) AND
                          ( i.variation_id =  '.$data['variation_id'].' ) AND
                          ( i.consecutivo =  '.$data['consecutivo'].' ) AND
                          ( i.modulo =  "'.$this->modulo.'" ) AND
                          ( i.ano =  "'.$data['ano'].'" ) AND
                          ( i.mes =  "'.$data['mes'].'" ) 
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




    //ok
  public function revisar_imagenes( $data ){

            $this->db->select("id", FALSE);         
            $this->db->from($this->fotocalendario_imagenes);
    
            $where = '(
                        (
                          ( id_session =  "'.$data['id_session'].'" ) AND
                          ( id_diseno =  '.$data['id_diseno'].' ) AND
                          ( variation_id =  '.$data['variation_id'].' ) AND
                          ( consecutivo =  '.$data['consecutivo'].' ) AND
                          ( modulo =  "'.$this->modulo.'" ) AND
                          ( ano =  "'.$data['ano'].'" ) 
                         )
              )';   
  
            $this->db->where($where);
            
            $info = $this->db->get();
            return $info->num_rows();

    }     
      




} 


?>    