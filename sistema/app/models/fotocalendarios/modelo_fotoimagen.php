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

      $this->modulo = 'f';
        $current_user = wp_get_current_user();
        $this->id_user = $current_user->id;
      

    }






///////////////////////////////////////////////cargador de Imagenes/////////////////////////////////////////
///////////////////////////////////////////////cargador de Imagenes/////////////////////////////////////////
///////////////////////////////////////////////cargador de Imagenes/////////////////////////////////////////



         
   public function leer_todasimagenes($data){
            
            //$this->db->select("CONCAT('uid_','".date('d')."','".date('m')."','".date('Y')."','_','".$data['id_diseno']."','".$data['id_tamano']."','".$data['consecutivo']."',i.ano,i.mes) uid_imagen", false);
            $this->db->select('id'); 
            $this->db->select('"'.$data["id_session"].'" id_session', false); 
            $this->db->select($data["id_diseno"].' id_diseno', false);         
            $this->db->select($data["id_tamano"].' id_tamano', false);         
            $this->db->select($data["id_tamano"].' variation_id', false);         



            $this->db->select($data["consecutivo"].' consecutivo', false);         
            
            $this->db->select('i.ano, i.mes, i.uid_imagen');         
            //$this->db->select('LENGTH(i.mes) mas', false);  

            $this->db->select("( CASE WHEN LENGTH(i.mes) > 1 THEN i.mes ELSE CONCAT('0',i.mes) END ) AS mas", FALSE);
            
            //$this->db->select("CONCAT('orig_',".$data['id_diseno'].",'_',".$data['id_tamano'].",'_',".$data['consecutivo'].",'_',i.ano,'_',i.mes,SUBSTRING(i.original, POSITION('"."."."' IN i.original)) ) original", false);
            //$this->db->select("CONCAT('rec_',".$data['id_diseno'].",'_',".$data['id_tamano'].",'_',".$data['consecutivo'].",'_',i.ano,'_',i.mes,SUBSTRING(i.recorte, POSITION('"."."."' IN i.recorte)) ) recorte", false);


            $this->db->select("original", false);
            $this->db->select("recorte", false);

            $this->db->select('"'.$this->modulo.'" modulo', false);         
            $this->db->select($this->id_user.' id_user', false);
            


            
            
              $this->db->from($this->fotocalendario_imagenes.' As i');

            $where = '(
                            (
                              (( i.id_session =  "'.$data['id_session'].'" )  OR  ( i.id_user =  '.$this->id_user.' ) ) AND
                              ( i.id_diseno =  '.$data['id_diseno'].' ) AND
                              ( i.id_tamano =  '.$data['id_tamano'].' ) AND 
                              ( i.modulo =  "'.$this->modulo.'" )  AND                       
                              ( i.consecutivo =  '.$data['consecutivo'].' ) 

                             )
                  )';   
          
          $this->db->order_by('mas'  ,'ASC');
            
            $this->db->where($where);
            $result = $this->db->get();

            if ($result->num_rows() > 0) {
                  $objeto = $result->result();
                  return $objeto;
                                  

            } else {
              return false;  
            }
            

    }  



 public function actualizar_todasimagenes( $data ){

          
          if ($data['datos'])  {  //si existen datos para guardar
            foreach ($data['datos'] as $key => $valor) {
                  
                    
                    $this->db->set('mes', $valor['mes']);  
                    $where = '(
                                ( i.id =  '.$valor['identificador'].' ) 
                    )';   

                    $this->db->where($where);
                    $this->db->update($this->fotocalendario_imagenes.' As i');
                    

            }    
         } 

          return true;
  }





/////////////////////////////////////////////    
    /////////////////////////////////////////////
////////////////////////////Agregar/////////////////////////////
     
//ok
     public function anadir_imagenes2($data){
          $this->db->set('id_session', $data['id_session']);

          $this->db->set('id_diseno', $data['id_diseno']);  
          $this->db->set('id_tamano', $data['id_tamano']);  
          $this->db->set('variation_id', $data['id_tamano']);  
          $this->db->set('consecutivo', $data['consecutivo']);  

          $this->db->set('modulo', $this->modulo);  
          $this->db->set('id_user', $this->id_user);  

          $this->db->set('uid_imagen', $data['uid_imagen']);  
          

          $this->db->set('ano', $data['ano']);  
          $this->db->set('mes', $data['mes']);  
          
          $this->db->set('original', $data['original']);  
          $this->db->set('recorte', $data['recorte']);  //'rec_'.substr($data['nombre'], 5)

          
          $this->db->insert($this->fotocalendario_imagenes);
          
          if ($this->db->affected_rows() > 0){
                    return TRUE;
          } else {
              return FALSE;
          }
          $result->free_result();
     }

 //ok     
      public function anadir_imagenes_original2($data){
             $this->db->set('id_session', $data['id_session']);  

             $this->db->set('id_diseno', $data['id_diseno']);  
             $this->db->set('id_tamano', $data['id_tamano']);  
             $this->db->set('variation_id', $data['id_tamano']);  
             $this->db->set('consecutivo', $data['consecutivo']);  

             $this->db->set('modulo', $this->modulo);  
             $this->db->set('id_user', $this->id_user);  


             $this->db->set('uid_imagen', $data['uid_imagen']);  
                 $this->db->set('nombre', $data['original']);
           $this->db->set('tipo_archivo', $data['tipo_archivo']);   
                   //$this->db->set('tipo', $data['tipo']);        //
                    $this->db->set('ext', '.'.$data['ext']);   
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

     public function anadir_imagenes_recorte2($data){
         
             $this->db->set('id_session', $data['id_session']);  
             
             $this->db->set('id_diseno', $data['id_diseno']);  
             $this->db->set('id_tamano', $data['id_tamano']);  
             $this->db->set('variation_id', $data['id_tamano']);  
             $this->db->set('consecutivo', $data['consecutivo']);  

             $this->db->set('modulo', $this->modulo);  
             $this->db->set('id_user', $this->id_user);  

             $this->db->set('uid_imagen', $data['uid_imagen']);  
             $this->db->set('nombre', $data['recorte']);   //'rec_'.substr($data['nombre'], 5)


              $this->db->set('aspectRatio', 1);  
              $this->db->set('left', $data['ancho']);  
              $this->db->set('naturalHeight', $data['alto']);  
              $this->db->set('naturalWidth', $data['ancho']);  
              $this->db->set('rotate', 0);  
              $this->db->set('scaleX', 0);  
              $this->db->set('scaleY', 0);  
              $this->db->set('top', 0);  



              $this->db->set('width', $data['ancho']);  
              $this->db->set('cleft', $data['ancho']);  
              $this->db->set('ctop', 0);  
              $this->db->set('cheight', $data['alto']);  
              $this->db->set('cwidth', $data['ancho']);  
              $this->db->set('cnaturalWidth', $data['ancho']);  
              $this->db->set('cnaturalHeight', $data['alto']);  



              $this->db->set('dx', 0);  
              $this->db->set('dy', 0);  
              $this->db->set('dwidth', $data['ancho']);  
              $this->db->set('dheight', $data['alto']);  
              $this->db->set('drotate', 1);  
              $this->db->set('dscaleX', 1);  
              $this->db->set('bleft', 0.5 );  
              $this->db->set('btop', 0);  
              $this->db->set('bwidth', $data['ancho']);  
              $this->db->set('bheight', $data['alto']);  


/*
 //aspectRatio`, `height`, `left`, `naturalHeight`, `naturalWidth`, `rotate`, `scaleX`, `scaleY`, `top`, 
aspectRatio =1;  
left =0;
naturalHeight =ancho; //300 alto
naturalWidth =alto;  //300 ancho
rotate =0;
scaleX =0;
scaleY =0;
top =0;

//`width`, `cleft`, `ctop`, `cheight`, `cwidth`, `cnaturalWidth`, `cnaturalHeight`,
//300, 300, 0, 300, 300, 300, 300,
width= ancho;
cleft =ancho;
ctop =0;
cheight =alto;
cwidth =ancho;
cnaturalWidth =ancho;
cnaturalHeight =alto;

//dx`, `dy`, `dwidth`, `dheight`, `drotate`, `dscaleX`, `dscaleY`, `bleft`, `btop`, `bwidth`, `bheight`, 
//0, 0, 300, 300, 0, 1, 1, 0.5, 0, 300, 300, 
dx =0; 
dy=0; 
dwidth =ancho; 
dheight=alto;
drotate = 0;
dscaleX=1;
dscaleY=1;
bleft = 0.5 
btop =0;
bwidth=ancho; 
bheight=alto;

*/

  
  /*       
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
*/


          $this->db->insert($this->fotocalendario_imagenes_recorte);
            
            if ($this->db->affected_rows() > 0){
                    return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();
      } 

///////////////////////////////////////////////cargador de Imagenes/////////////////////////////////////////
///////////////////////////////////////////////cargador de Imagenes/////////////////////////////////////////
///////////////////////////////////////////////cargador de Imagenes/////////////////////////////////////////



 //OK 1- correo logueo
   public function correo_logueo($data){
              $this->db->select("id, id_session, id_diseno, id_tamano, consecutivo, correo,  nombre_diseno,descripcion_tamano, nombre_tamano,  imagen_diseno, imagen_tamano,  fecha_mac");                
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
                          ( id_tamano =  '.$data['id_tamano'].' ) AND
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
          $this->db->set('id_tamano', $data['id_tamano']);  
          $this->db->set('variation_id', $data['id_tamano']);  
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
             $this->db->set('id_tamano', $data['id_tamano']);  
             $this->db->set('variation_id', $data['id_tamano']);  
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
             $this->db->set('id_tamano', $data['id_tamano']);  
             $this->db->set('variation_id', $data['id_tamano']);  
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
            $this->db->select("i.id, i.id_session, i.id_diseno,i.id_tamano,i.consecutivo, i.uid_imagen, i.ano, i.mes");         
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
                          ( i.id_tamano =  '.$data['id_tamano'].' ) AND
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
                          ( id_tamano =  '.$data['id_tamano'].' ) AND
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