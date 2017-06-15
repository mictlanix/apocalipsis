<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'tinbox_db_2017');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'root');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', 'root');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'h$=X=V@F}w9C(]cAdRJL}ZXKIg )) !A+wxO>O.<9LcGA $VsM|%N}A]+p(vhv1:');
define('SECURE_AUTH_KEY', 'tbzkB<4+BbhxCdPed-<}:$u9Pl:7G+Nbu=4%1Xo9xk:@pd|HXM6}.x>C05r}qS8B');
define('LOGGED_IN_KEY', '3=AH_Loy07w+lo+&Lo)/IyRkX(az$YT#(.e[5|QrMY3Z^ngp*BH4JKh6rka4NLvW');
define('NONCE_KEY', '-nNfFF{#o>_iu0!e#_ih[)2y}j%d&8I#V.m|-|z}c|[|DP=Z ADP9a/Vo2g2XiVZ');
define('AUTH_SALT', 'uAd3-e`(+OZdLTya;Cs4Ch;!J8_Ahg+27J<-5wr[H~S*z%K8b6 1viHTJ|K}a+K2');
define('SECURE_AUTH_SALT', 'es1.lUB6vJo1)-Hu(GF[$8S4NwRh`Rn|p2JnY c,Zx~=dK@`wv#Q7@0+([&jvok!');
define('LOGGED_IN_SALT', ')o#H(dJhKVcjWFgxfCmBu1UDRIf2O+[Np>.f /<j,S0D!8[~s)r*ya:~;Y?jJEiO');
define('NONCE_SALT', '+T{K wgu,vhqR2n<eoMK)i*y+[=`hZ}J^2yY0n#yIyl}e0$[<^/=^HPUR].-tQ0U');

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'tinbox_';


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */

define('WPLANG', 'es_ES');
define('WP_DEBUG', false);
define('WP_POST_REVISIONS', false);
define('FS_METHOD', 'direct');

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

