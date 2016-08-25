<?php if(! defined('BASEPATH')) exit('No tienes permiso para acceder a este archivo');
  class modelo_borrar_datos extends CI_Model{
    
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


      $this->fotocalendario_imagenes    = $this->db->dbprefix('fotocalendario_imagenes');
      $this->fotocalendario_imagenes_original    = $this->db->dbprefix('fotocalendario_imagenes_original');
      $this->fotocalendario_imagenes_recorte    = $this->db->dbprefix('fotocalendario_imagenes_recorte');

      $this->logueo_identificador    = $this->db->dbprefix('logueo_identificador');

      //historicos
      $this->historico_fotocalendario_temporal    = $this->db->dbprefix('historico_fotocalendario_temporal');
      $this->historico_fechas_especiales    = $this->db->dbprefix('historico_fechas_especiales');
      $this->historico_nombre_meses    = $this->db->dbprefix('historico_nombre_meses');
      $this->historico_fotocalendario_imagenes    = $this->db->dbprefix('historico_fotocalendario_imagenes');
      $this->historico_fotocalendario_imagenes_original    = $this->db->dbprefix('historico_fotocalendario_imagenes_original');
      $this->historico_fotocalendario_imagenes_recorte    = $this->db->dbprefix('historico_fotocalendario_imagenes_recorte');
      $this->historico_logueo_identificador    = $this->db->dbprefix('historico_logueo_identificador');

      //historico lista
      $this->historico_fotocalendario_lista    = $this->db->dbprefix('historico_fotocalendario_lista');
      $this->historico_lista_nombre_meses    = $this->db->dbprefix('historico_lista_nombre_meses');
      $this->historico_lista_fechas_especiales    = $this->db->dbprefix('historico_lista_fechas_especiales');


      $this->sessions    = $this->db->dbprefix('sessions');

      $this->fotocalendario_lista    = $this->db->dbprefix('fotocalendario_lista');
      $this->lista_nombre_meses    = $this->db->dbprefix('lista_nombre_meses');
      $this->lista_fechas_especiales    = $this->db->dbprefix('lista_fechas_especiales');
      $this->logueo_temporal = $this->db->dbprefix('logueo_temporal');


      $this->modulo = 'f';

    }




    /////////////Lista de todos los diseños q estan hechos hasta el momento///////    
    public function completar_lista( $data ){

            $this->db->set( 'id_user', $data['id_user']);          
            $where = '(
                           ( id_session =  "'.$data['session_id'].'" ) 
                        )';   
            $this->db->where($where);
            $this->db->update($this->historico_fotocalendario_temporal);


            $this->db->set( 'id_user', $data['id_user']);          
            $this->db->where($where);
            $this->db->update($this->logueo_temporal );

            $this->db->set( 'id_user', $data['id_user']);          
            $this->db->where($where);
            $this->db->update($this->historico_fotocalendario_temporal);

            $this->db->set( 'id_user', $data['id_user']);          
            $this->db->where($where);
            $this->db->update($this->historico_fechas_especiales);

            $this->db->set( 'id_user', $data['id_user']);          
            $this->db->where($where);            
            $this->db->update($this->historico_nombre_meses);

            $this->db->set( 'id_user', $data['id_user']);          
            $this->db->where($where);            
            $this->db->update($this->historico_logueo_identificador );

            $this->db->set( 'id_user', $data['id_user']);          
            $this->db->where($where);            
            $this->db->update($this->historico_fotocalendario_imagenes );

            $this->db->set( 'id_user', $data['id_user']);          
            $this->db->where($where);            
            $this->db->update($this->historico_fotocalendario_imagenes_original );

            $this->db->set( 'id_user', $data['id_user']);          
            $this->db->where($where);            
            $this->db->update($this->historico_fotocalendario_imagenes_recorte );  

            $this->db->set( 'id_user', $data['id_user']);          
            $this->db->where($where);            
            $this->db->update($this->fotocalendario_lista );

            $this->db->set( 'id_user', $data['id_user']);          
            $this->db->where($where);            
            $this->db->update($this->lista_nombre_meses );

            $this->db->set( 'id_user', $data['id_user']);          
            $this->db->where($where);            
            $this->db->update($this->lista_fechas_especiales );        






            if ($this->db->affected_rows() > 0){
                    return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();
    }

    //cuando se elimina un diseño en particular
    public function eliminar_diseno_completo(  ){
       
        $this->db->empty_table( $this->fotocalendario_temporal);
      
        $this->db->empty_table( $this->fechas_especiales);
        $this->db->empty_table( $this->nombre_meses);
        $this->db->empty_table( $this->logueo_identificador );
        $this->db->empty_table( $this->logueo_temporal );
        
        $this->db->empty_table( $this->fotocalendario_imagenes );
        $this->db->empty_table( $this->fotocalendario_imagenes_original );
        $this->db->empty_table( $this->fotocalendario_imagenes_recorte );



        $this->db->empty_table( $this->sessions );

        //elimino lista
  


        $this->db->empty_table( $this->historico_fotocalendario_temporal);
        $this->db->empty_table( $this->historico_fechas_especiales);
        $this->db->empty_table( $this->historico_nombre_meses);
        $this->db->empty_table( $this->historico_logueo_identificador );
        $this->db->empty_table( $this->historico_fotocalendario_imagenes );
        $this->db->empty_table( $this->historico_fotocalendario_imagenes_original );
        $this->db->empty_table( $this->historico_fotocalendario_imagenes_recorte );        
        

  
        $this->db->empty_table( $this->fotocalendario_lista );
        $this->db->empty_table( $this->lista_nombre_meses );
        $this->db->empty_table( $this->lista_fechas_especiales );        
        
        return "todo fue eliminado";

    }


/*
        $this->db->empty_table( $this->fotocalendario_temporal, array( 'id_session' => $data['id_session'],  'id_tamano' => $data['id_tamano'],  'id_diseno' => $data['id_diseno'],   'consecutivo' => $data['consecutivo'], 'modulo' => $this->modulo ) );
        $this->db->empty_table( $this->fechas_especiales, array( 'id_session' => $data['id_session'],  'id_tamano' => $data['id_tamano'] ,  'id_diseno' => $data['id_diseno'],   'consecutivo' => $data['consecutivo'] , 'modulo' => $this->modulo ) );
        $this->db->empty_table( $this->nombre_meses, array( 'id_session' => $data['id_session'],  'id_tamano' => $data['id_tamano'] ,  'id_diseno' => $data['id_diseno'],   'consecutivo' => $data['consecutivo'] ) );
        $this->db->empty_table( $this->logueo_identificador, array( 'id_session' => $data['id_session'],  'id_tamano' => $data['id_tamano'] ,  'id_diseno' => $data['id_diseno'],   'consecutivo' => $data['consecutivo'] , 'modulo' => $this->modulo ) );
        
        $this->db->empty_table( $this->fotocalendario_imagenes, array( 'id_session' => $data['id_session'],  'id_diseno' => $data['id_tamano'] ,  'id_diseno' => $data['id_diseno'],   'consecutivo' => $data['consecutivo'] , 'modulo' => $this->modulo ) );
        $this->db->empty_table( $this->fotocalendario_imagenes_original, array( 'id_session' => $data['id_session'],  'id_tamano' => $data['id_tamano'] ,  'id_diseno' => $data['id_diseno'],   'consecutivo' => $data['consecutivo'] , 'modulo' => $this->modulo ) );
        $this->db->empty_table( $this->fotocalendario_imagenes_recorte, array( 'id_session' => $data['id_session'],  'id_tamano' => $data['id_tamano'] ,  'id_diseno' => $data['id_diseno'],   'consecutivo' => $data['consecutivo'] , 'modulo' => $this->modulo ) );


*/


    
  } 


?>