<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/


///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////Disenos//////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////




$route['fotocalendario/guardar_tamanos']							= 'fotocalendario/fcalendario/guardar_tamanos';
$route['fotocalendario/leer_marcados']								= 'fotocalendario/fcalendario/leer_marcados';

$route['fotocalendario/actualizar_disenos']						= 'fotocalendario/fcalendario/actualizar_disenos';


///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////Cuenta del usuario//////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////


//$route['micuenta/borrardatos']								= 'micuenta/micuenta/borrardatos';
//$route['micuenta/completar_lista']								= 'micuenta/micuenta/completar_lista';

$route['micuenta']												= 'micuenta/micuenta/index';
$route['micuenta/completar_lista']								= 'micuenta/micuenta/completar_lista';
$route['micuenta/leer_lista']									= 'micuenta/micuenta/leer_lista';
$route['micuenta/diseno_lista']									= 'micuenta/micuenta/diseno_lista';

$route['micuenta/validar_nuevo_fotocalendario']									= 'micuenta/micuenta/validar_nuevo_fotocalendario';

$route['micuenta/guardar_lista']							= 'micuenta/micuenta/guardar_lista';
$route['micuenta/noguardar_lista']							= 'micuenta/micuenta/noguardar_lista';



///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////fotocalendario//////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////


$route['fotocalendario/validacion_comprimir']							= 'fotocalendario/fotocalendario/validacion_comprimir';

$route['fotocalendario/fotocalendario/(:any)']							= 'fotocalendario/fotocalendario/index/$1';
$route['fotocalendario/validar_nuevo_fotocalendario']				= 'fotocalendario/fotocalendario/validar_nuevo_fotocalendario';

$route['fotocalendario/guardar_lista']							= 'fotocalendario/fotocalendario/guardar_lista';
$route['fotocalendario/noguardar_lista']							= 'fotocalendario/fotocalendario/noguardar_lista';


$route['fotocalendario/leer_lista']							= 'fotocalendario/fotocalendario/leer_lista';
$route['fotocalendario/diseno_lista']							= 'fotocalendario/fotocalendario/diseno_lista';

$route['fotocalendario/calenda_activos']							= 'fotocalendario/fotocalendario/calenda_activos';

$route['fotocalendario/eliminar_diseno_completo']							= 'fotocalendario/fotocalendario/eliminar_diseno_completo';
$route['fotocalendario/disenos_completos']									= 'fotocalendario/fotocalendario/disenos_completos';

$route['fotocalendario/cargar_informacion']								= 'fotocalendario/fotocalendario/cargar_informacion';


$route['fotocalendario/eliminar_logo_formulario']								= 'fotocalendario/fotocalendario/eliminar_logo_formulario';

$route['fotocalendario/borrardatos']								= 'fotocalendario/fotocalendario/borrardatos';
$route['fotocalendario/completar_lista']								= 'fotocalendario/fotocalendario/completar_lista';

$route['fotocalendario/buscador_predictivo']								= 'fotocalendario/fotocalendario/buscador_predictivo';


///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////carga de libreria de Imagen//////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////


$route['fotocalendario/fotocarga/(:any)']							 = 'fotocalendario/fotocarga/index/$1';
$route['fotocalendario/imagen_encontrada']							 = 'fotocalendario/fotocarga/imagen_encontrada';
$route['fotocalendario/guardar_imagen']							     = 'fotocalendario/fotocarga/guardar_imagen';
$route['fotocalendario/upload']									     = 'fotocalendario/fotocarga/upload';
$route['fotocalendario/buscarimagen']								 = 'fotocalendario/fotocarga/buscarimagen';
$route['fotocalendario/revisar_imagenes']							 = 'fotocalendario/fotocarga/revisar_imagenes';


///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////Imagen//////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////


$route['fotocalendario/fotoimagen/(:any)']							 = 'fotocalendario/fotoimagen/index/$1';
$route['fotocalendario/imagen_encontrada']							 = 'fotocalendario/fotoimagen/imagen_encontrada';
$route['fotocalendario/guardar_imagen']							     = 'fotocalendario/fotoimagen/guardar_imagen';
$route['fotocalendario/upload']									     = 'fotocalendario/fotoimagen/upload';
$route['fotocalendario/buscarimagen']								 = 'fotocalendario/fotoimagen/buscarimagen';
$route['fotocalendario/revisar_imagenes']							 = 'fotocalendario/fotoimagen/revisar_imagenes';

$route['fotocalendario/leer_todasimagenes']							 = 'fotocalendario/fotoimagen/leer_todasimagenes';
$route['fotocalendario/actualizar_todasimagenes']							 = 'fotocalendario/fotoimagen/actualizar_todasimagenes';
$route['fotocalendario/eliminar_unaimagen']							 = 'fotocalendario/fotoimagen/eliminar_unaimagen';
$route['fotocalendario/guardar_imagenes']							 = 'fotocalendario/fotoimagen/guardar_imagenes';


///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////Revise//////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////


$route['fotocalendario/fotorevise/(:any)']							= 'fotocalendario/fotorevise/index/$1';

$route['fotocalendario/eliminar_diseno_revise']					= 'fotocalendario/fotorevise/eliminar_diseno_revise';
$route['fotocalendario/activar_carrito']							= 'fotocalendario/fotorevise/activar_carrito';

$route['fotocalendario/anadir_carrito']							= 'fotocalendario/fotorevise/anadir_carrito';

$route['fotocalendario/guardar_historico_informacion']				= 'fotocalendario/fotorevise/guardar_historico_informacion';


//$route['default_controller']	 		= 'fotocalendario/fcalendario';
//$route['404_override'] 					= 'fotocalendario/fcalendario';

$route['default_controller']	 		= 'fotocalendario/fcalendario/index/$1/$2';
$route['fotocalendario/(:any)/(:any)']	 		= 'fotocalendario/fcalendario/index/$1/$2';





///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////Usuarios/////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////

//$route['default_controller']	 		= 'Main';
//$route['404_override'] 					= '';
$route['login']							= 'main/login';
$route['forgot']						= 'main/forgot';
$route['session']						= 'main/session';
$route['historicoaccesos']              = 'main/historicoaccesos';


$route['usuarios']						= 'main/listado_usuarios';
$route['procesando_usuarios']    		= 'main/procesando_usuarios';
$route['nuevo_usuario']                 = 'main/nuevo_usuario';
$route['validar_nuevo_usuario']         = 'main/validar_nuevo_usuario';
$route['eliminar_usuario/(:any)/(:any)']		= 'main/eliminar_usuario/$1/$2';
$route['validando_eliminar_usuario']    = 'main/validando_eliminar_usuario';
$route['actualizar_perfil']		         = 'main/actualizar_perfil';
$route['editar_usuario/(:any)']			= 'main/actualizar_perfil/$1';
$route['validacion_edicion_usuario']    = 'main/validacion_edicion_usuario';

$route['validar_login']					= 'main/validar_login';
$route['validar_recuperar_password']	= 'main/validar_recuperar_password';
$route['salir']							= 'main/logout';

//$route['procesando_home']    			= 'main/procesando_home';
//$route['procesando_inicio']    			= 'main/procesando_inicio';
//$route['cargar_dependencia']    		= 'main/cargar_dependencia';





///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
////////////////Listado de todos los catalogos/////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
$route['catalogos']						= 'catalogos/listado_catalogos';

//equipo
$route['equipos']					     = 'catalogos/listado_equipos';
$route['procesando_cat_equipos']    		= 'catalogos/procesando_cat_equipos';

$route['nuevo_equipo']                  = 'catalogos/nuevo_equipo';
$route['validar_nuevo_equipo']          = 'catalogos/validar_nuevo_equipo';

$route['editar_equipo/(:any)']			 = 'catalogos/editar_equipo/$1';
$route['validacion_edicion_equipo']     = 'catalogos/validacion_edicion_equipo';

$route['eliminar_equipo/(:any)/(:any)'] = 'catalogos/eliminar_equipo/$1/$2';
$route['validar_eliminar_equipo']    	 = 'catalogos/validar_eliminar_equipo';


//tecnico
$route['tecnicos']              = 'catalogos/listado_tecnicos';
$route['procesando_cat_tecnicos']        = 'catalogos/procesando_cat_tecnicos';

$route['nuevo_tecnico']                  = 'catalogos/nuevo_tecnico';
$route['validar_nuevo_tecnico']          = 'catalogos/validar_nuevo_tecnico';

$route['editar_tecnico/(:any)']       = 'catalogos/editar_tecnico/$1';
$route['validacion_edicion_tecnico']     = 'catalogos/validacion_edicion_tecnico';

$route['eliminar_tecnico/(:any)/(:any)'] = 'catalogos/eliminar_tecnico/$1/$2';
$route['validar_eliminar_tecnico']      = 'catalogos/validar_eliminar_tecnico';





//estatu
$route['estatus']					     = 'catalogos/listado_estatus';
$route['procesando_cat_estatus']        = 'catalogos/procesando_cat_estatus';

$route['nuevo_estatu']                  = 'catalogos/nuevo_estatu';
$route['validar_nuevo_estatu']          = 'catalogos/validar_nuevo_estatu';

$route['editar_estatu/(:any)']			 = 'catalogos/editar_estatu/$1';
$route['validacion_edicion_estatu']     = 'catalogos/validacion_edicion_estatu';

$route['eliminar_estatu/(:any)/(:any)'] = 'catalogos/eliminar_estatu/$1/$2';
$route['validar_eliminar_estatu']    	 = 'catalogos/validar_eliminar_estatu';





///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
//////////////////////////////////////Clientes/////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////

//clientes
$route['clientes']					         = 'clientes/listado_clientes';
$route['procesando_clientes']    		     = 'clientes/procesando_clientes';

$route['nuevo_cliente']                      = 'clientes/nuevo_cliente';
$route['validar_nuevo_cliente']              = 'clientes/validar_nuevo_cliente';


$route['detalles_cliente/(:any)']			 = 'clientes/detalles_cliente/$1';
$route['validacion_detalles_cliente']        = 'clientes/validacion_detalles_cliente';



$route['orden/(:any)']					 	= 'clientes/orden/$1';
$route['validar_nuevo_orden']              	= 'clientes/validar_nuevo_orden';
$route['validar_editar_orden']              	= 'clientes/validar_editar_orden';


$route['reingreso/(:any)']					= 'clientes/reingreso/$1';
$route['validar_reingreso']              	= 'clientes/validar_reingreso';


$route['cliente/(:any)']					 	= 'clientes/cliente/$1';
$route['validar_editar_cliente']              	= 'clientes/validar_editar_cliente';

$route['eliminar_cliente/(:any)/(:any)/(:any)'] 	= 'clientes/eliminar_cliente/$1/$2/$3';
$route['validar_eliminar_cliente'] 	= 'clientes/validar_eliminar_cliente';


///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
//////////////////////////////////////Historico de orden////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////



$route['procesando_historico_orden']    		     = 'clientes/procesando_historico_orden';

///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
//////////////////////////////////////Historico de orden////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////


$route['imprimir_reportes']    		     = 'informes/imprimir_reportes';
$route['imprimir_detalle']    		     = 'informes/imprimir_detalle';







///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////Calendarios//////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////





$route['calendarios/guardar_tamanos']							= 'calendarios/calendarios/guardar_tamanos';
$route['calendarios/leer_marcados']								= 'calendarios/calendarios/leer_marcados';
$route['calendarios/actualizar_disenos']						= 'calendarios/calendarios/actualizar_disenos';

$route['calendarios/taxonomia_tamano']						= 'calendarios/calendarios/taxonomia_tamano';





///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////fotocalendario de calendarios//////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////

$route['calendarios/diseno_lista']							= 'calendarios/fotocalendario/diseno_lista';


$route['calendarios/validacion_comprimir']							= 'calendarios/fotocalendario/validacion_comprimir';

$route['calendarios/fotocalendario/(:any)']							= 'calendarios/fotocalendario/index/$1';
$route['calendarios/validar_nuevo_fotocalendario']				= 'calendarios/fotocalendario/validar_nuevo_fotocalendario';

$route['calendarios/guardar_lista']							= 'calendarios/fotocalendario/guardar_lista';
$route['calendarios/noguardar_lista']							= 'calendarios/fotocalendario/noguardar_lista';


$route['calendarios/leer_lista']							= 'calendarios/fotocalendario/leer_lista';

$route['calendarios/calenda_activos']							= 'calendarios/fotocalendario/calenda_activos';

$route['calendarios/eliminar_diseno_completo']							= 'calendarios/fotocalendario/eliminar_diseno_completo';
$route['calendarios/disenos_completos']									= 'calendarios/fotocalendario/disenos_completos';

$route['calendarios/cargar_informacion']								= 'calendarios/fotocalendario/cargar_informacion';

$route['calendarios/eliminar_logo_formulario']							= 'calendarios/fotocalendario/eliminar_logo_formulario';
$route['calendarios/buscador_predictivo']								= 'calendarios/fotocalendario/buscador_predictivo';



///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////Revise//////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////


$route['calendarios/fotorevise/(:any)']							= 'calendarios/fotorevise/index/$1';

$route['calendarios/eliminar_diseno_revise']					= 'calendarios/fotorevise/eliminar_diseno_revise';
$route['calendarios/activar_carrito']							= 'calendarios/fotorevise/activar_carrito';

$route['calendarios/anadir_carrito']							= 'calendarios/fotorevise/anadir_carrito';

$route['calendarios/guardar_historico_informacion']				= 'calendarios/fotorevise/guardar_historico_informacion';

//$route['calendarios']	 		= 'calendarios/calendarios/index';
//$route['calendarios/(:any)']	 		= 'calendarios/calendarios/index/$1';
$route['calendarios']	 		= 'calendarios/calendarios/index/$1/$2';
$route['calendarios/(:any)/(:any)']	 		= 'calendarios/calendarios/index/$1/$2';


///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////agendas//////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////


//$route['agendas']	 		= 'agendas/agendas/index';





$route['agendas/guardar_tamanos']							= 'agendas/agendas/guardar_tamanos';
$route['agendas/leer_marcados']								= 'agendas/agendas/leer_marcados';
$route['agendas/actualizar_disenos']						= 'agendas/agendas/actualizar_disenos';


$route['agendas/guardar_info']								= 'agendas/agendas/guardar_info';

$route['agendas/taxonomia_tipo_agendas']						= 'agendas/agendas/taxonomia_tipo_agendas';





///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////fotocalendario de agendas//////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////

$route['agendas/diseno_lista']							= 'agendas/fotocalendario/diseno_lista';


$route['agendas/validacion_comprimir']							= 'agendas/fotocalendario/validacion_comprimir';

$route['agendas/fotocalendario/(:any)']							= 'agendas/fotocalendario/index/$1';
$route['agendas/validar_nuevo_fotocalendario']				= 'agendas/fotocalendario/validar_nuevo_fotocalendario';

$route['agendas/guardar_lista']							= 'agendas/fotocalendario/guardar_lista';
$route['agendas/noguardar_lista']							= 'agendas/fotocalendario/noguardar_lista';


$route['agendas/leer_lista']							= 'agendas/fotocalendario/leer_lista';

$route['agendas/calenda_activos']							= 'agendas/fotocalendario/calenda_activos';

$route['agendas/eliminar_diseno_completo']							= 'agendas/fotocalendario/eliminar_diseno_completo';
$route['agendas/disenos_completos']									= 'agendas/fotocalendario/disenos_completos';

$route['agendas/cargar_informacion']								= 'agendas/fotocalendario/cargar_informacion';
$route['agendas/eliminar_logo_formulario']							= 'agendas/fotocalendario/eliminar_logo_agendas';
$route['agendas/buscador_predictivo']								= 'agendas/fotocalendario/buscador_predictivo';



///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////Revise//////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////


$route['agendas/fotorevise/(:any)']						= 'agendas/fotorevise/index/$1';
$route['agendas/eliminar_diseno_revise']					= 'agendas/fotorevise/eliminar_diseno_revise';
$route['agendas/activar_carrito']							= 'agendas/fotorevise/activar_carrito';
$route['agendas/anadir_carrito']							= 'agendas/fotorevise/anadir_carrito';
$route['agendas/guardar_historico_informacion']			= 'agendas/fotorevise/guardar_historico_informacion';


$route['agendas/guardar_info_revise']						= 'agendas/fotorevise/guardar_info_revise';



$route['agendas']	 		= 'agendas/agendas/index/agendas';
$route['agendas/(:any)']	 		= 'agendas/agendas/index/$1';
$route['agendas/(:any)/(:any)/(:any)']	 		= 'agendas/agendas/index/$1/$2';


///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////libretas//////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////




$route['libretas/guardar_tamanos']							= 'libretas/libretas/guardar_tamanos';
$route['libretas/leer_marcados']								= 'libretas/libretas/leer_marcados';
$route['libretas/actualizar_disenos']						= 'libretas/libretas/actualizar_disenos';

$route['libretas/guardar_info']								= 'libretas/libretas/guardar_info';







///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////fotocalendario de libretas//////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////

$route['libretas/diseno_lista']							= 'libretas/fotocalendario/diseno_lista';


$route['libretas/validacion_comprimir']							= 'libretas/fotocalendario/validacion_comprimir';

$route['libretas/fotocalendario/(:any)']							= 'libretas/fotocalendario/index/$1';

$route['libretas/validar_nuevo_fotocalendario']				= 'libretas/fotocalendario/validar_nuevo_fotocalendario';

$route['libretas/guardar_lista']							= 'libretas/fotocalendario/guardar_lista';
$route['libretas/noguardar_lista']							= 'libretas/fotocalendario/noguardar_lista';


$route['libretas/leer_lista']							= 'libretas/fotocalendario/leer_lista';

$route['libretas/calenda_activos']							= 'libretas/fotocalendario/calenda_activos';

$route['libretas/eliminar_diseno_completo']							= 'libretas/fotocalendario/eliminar_diseno_completo';
$route['libretas/disenos_completos']									= 'libretas/fotocalendario/disenos_completos';

$route['libretas/cargar_informacion']								= 'libretas/fotocalendario/cargar_informacion';
$route['libretas/eliminar_logo_formulario']							= 'libretas/fotocalendario/eliminar_logo_libretas';
$route['libretas/buscador_predictivo']								= 'libretas/fotocalendario/buscador_predictivo';


///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////Revise//////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////


$route['libretas/fotorevise/(:any)']						= 'libretas/fotorevise/index/$1';
$route['libretas/eliminar_diseno_revise']					= 'libretas/fotorevise/eliminar_diseno_revise';
$route['libretas/activar_carrito']							= 'libretas/fotorevise/activar_carrito';
$route['libretas/anadir_carrito']							= 'libretas/fotorevise/anadir_carrito';
$route['libretas/guardar_historico_informacion']			= 'libretas/fotorevise/guardar_historico_informacion';


$route['libretas/guardar_info_revise']						= 'libretas/fotorevise/guardar_info_revise';


$route['libretas']	 		= 'libretas/libretas/index/libretas';
$route['libretas/(:any)']	 		= 'libretas/libretas/index/$1';
$route['libretas/(:any)/(:any)/(:any)']	 		= 'libretas/libretas/index/$1/$2';






//http://tinbox.dev.com/sistema/libreta_corporativa/
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////libreta_corporativa//////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
$route['libreta_corporativa/guardar_tamanos']							= 'libreta_corporativa/libreta_corporativa/guardar_tamanos';
$route['libreta_corporativa/leer_marcados']								= 'libreta_corporativa/libreta_corporativa/leer_marcados';
$route['libreta_corporativa/actualizar_disenos']						= 'libreta_corporativa/libreta_corporativa/actualizar_disenos';
$route['libreta_corporativa/guardar_info']								= 'libreta_corporativa/libreta_corporativa/guardar_info';
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////fotocalendario de libreta_corporativa//////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////

$route['libreta_corporativa/diseno_lista']							= 'libreta_corporativa/fotocalendario/diseno_lista';
$route['libreta_corporativa/validacion_comprimir']							= 'libreta_corporativa/fotocalendario/validacion_comprimir';
$route['libreta_corporativa/fotocalendario/(:any)']							= 'libreta_corporativa/fotocalendario/index/$1';
$route['libreta_corporativa/validar_nuevo_fotocalendario']				= 'libreta_corporativa/fotocalendario/validar_nuevo_fotocalendario';
$route['libreta_corporativa/guardar_lista']							= 'libreta_corporativa/fotocalendario/guardar_lista';
$route['libreta_corporativa/noguardar_lista']							= 'libreta_corporativa/fotocalendario/noguardar_lista';
$route['libreta_corporativa/leer_lista']							= 'libreta_corporativa/fotocalendario/leer_lista';
$route['libreta_corporativa/calenda_activos']							= 'libreta_corporativa/fotocalendario/calenda_activos';
$route['libreta_corporativa/eliminar_diseno_completo']							= 'libreta_corporativa/fotocalendario/eliminar_diseno_completo';
$route['libreta_corporativa/disenos_completos']									= 'libreta_corporativa/fotocalendario/disenos_completos';
$route['libreta_corporativa/cargar_informacion']								= 'libreta_corporativa/fotocalendario/cargar_informacion';
$route['libreta_corporativa/eliminar_logo_formulario']							= 'libreta_corporativa/fotocalendario/eliminar_logo_libretas';
$route['libreta_corporativa/buscador_predictivo']								= 'libreta_corporativa/fotocalendario/buscador_predictivo';
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////Revise//////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
$route['libreta_corporativa/fotorevise/(:any)']						= 'libreta_corporativa/fotorevise/index/$1';
$route['libreta_corporativa/eliminar_diseno_revise']					= 'libreta_corporativa/fotorevise/eliminar_diseno_revise';
$route['libreta_corporativa/activar_carrito']							= 'libreta_corporativa/fotorevise/activar_carrito';
$route['libreta_corporativa/anadir_carrito']							= 'libreta_corporativa/fotorevise/anadir_carrito';
$route['libreta_corporativa/guardar_historico_informacion']			= 'libreta_corporativa/fotorevise/guardar_historico_informacion';
$route['libreta_corporativa/guardar_info_revise']						= 'libreta_corporativa/fotorevise/guardar_info_revise';
$route['libreta_corporativa']	 		= 'libreta_corporativa/libreta_corporativa/index/libreta_corporativa';
$route['libreta_corporativa/(:any)']	 		= 'libreta_corporativa/libreta_corporativa/index/$1';
$route['libreta_corporativa/(:any)/(:any)/(:any)']	 		= 'libreta_corporativa/libreta_corporativa/index/$1/$2';

/* End of file routes.php */
/* Location: ./application/config/routes.php */
