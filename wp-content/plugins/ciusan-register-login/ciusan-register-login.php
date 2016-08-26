<?php 
/*
Plugin Name: Ciusan Register Login
Plugin URI: http://plugin.ciusan.com/134/ciusan-register-login/
Description: Showing login, register or lost password form modal popup with ajax.
Author: Dannie Herdyawan
Version: 2.1
Author URI: http://www.ciusan.com/
*/

/*
   _____                                                 ___  ___
  /\  __'\                           __                 /\  \/\  \
  \ \ \/\ \     __      ___     ___ /\_\     __         \ \  \_\  \
   \ \ \ \ \  /'__`\  /' _ `\ /` _ `\/\ \  /'__'\        \ \   __  \
    \ \ \_\ \/\ \L\.\_/\ \/\ \/\ \/\ \ \ \/\  __/    ___  \ \  \ \  \
     \ \____/\ \__/.\_\ \_\ \_\ \_\ \_\ \_\ \____\  /\__\  \ \__\/\__\
      \/___/  \/__/\/_/\/_/\/_/\/_/\/_/\/_/\/____/  \/__/   \/__/\/__/

*/
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
require ('functions.php');
if(!function_exists('ciusan_admin__head')){
	function ciusan_admin__head(){
	wp_register_style('ciusan', plugin_dir_url( __FILE__ ).'assets/css/ciusan.css');
		wp_enqueue_style('ciusan');
	wp_register_script('ciusan', plugin_dir_url( __FILE__ ).'assets/js/ciusan.js');
		wp_enqueue_script('ciusan');
	}
}
function crl_admin__menu(){
	global $menu;
	$main_menu_exists = false;
	foreach ($menu as $key => $value) {
		if($value[2] == 'ciusan-plugin'){
			$main_menu_exists = true;
		}
	}
	if(!$main_menu_exists){
		$ciusan_menu_icon = plugin_dir_url( __FILE__ ).'assets/img/ciusan.png';
		add_object_page(null, 'Ciusan Plugin', null, 'ciusan-plugin', 'ciusan-plugin', $ciusan_menu_icon);
		add_submenu_page('ciusan-plugin', 'Submit a Donation', 'Submit a Donation', 0, 'ciusan-submit-donation', 'ciusan_submit_donation');
	}
	add_submenu_page('ciusan-plugin', 'Register Login', 'Register Login', 1, 'ciusan-register-login','ciusan_register_login');
}
function crl_admin_init(){
	// Create admin menu and page.
	add_action( 'admin_menu' , 'crl_admin__menu');
	// Enable admin scripts and styles
	if(function_exists(ciusan_admin__head)){
		add_action( 'admin_enqueue_scripts' , 'ciusan_admin__head');
	}
} add_action('init', 'crl_admin_init');
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
function ciusan_register_login(){ 
	echo '<div class="wrap"><h2>Ciusan Register Login</h2>';
	if (isset($_POST['save'])) {
		$options['login_title']				= trim($_POST['login_title'],'{}');
		$options['register_title']			= trim($_POST['register_title'],'{}');
		$options['forgot_password_title']	= trim($_POST['forgot_password_title'],'{}');
		$options['button_login']			= trim($_POST['button_login'],'{}');
		$options['button_register']			= trim($_POST['button_register'],'{}');
		$options['button_forgot_password']	= trim($_POST['button_forgot_password'],'{}');
		$options['button_class']			= trim($_POST['button_class'],'{}');
		$options['login_redirect_URL']		= trim($_POST['login_redirect_URL'],'{}');
		$options['register_redirect_URL']	= trim($_POST['register_redirect_URL'],'{}');
		$options['Google_Site_Key']			= trim($_POST['Google_Site_Key'],'{}');
		$options['Google_Secret_Key']		= trim($_POST['Google_Secret_Key'],'{}');
		update_option('ciusan_register_login', $options);
		// Show a message to say we've done something
		echo '<div class="updated ciusan-success-messages"><p><strong>'. __("Settings saved.", "Ciusan").'</strong></p></div>';
	} else {
		$options = get_option('ciusan_register_login_option');
	}
	require ('admin_menu.php');
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
function ajax_auth_init(){ global $options; $options = get_option('ciusan_register_login');
wp_register_style('ciusan-register-login', plugin_dir_url( __FILE__ ).'assets/css/ciusan-register-login.css');
wp_enqueue_style('ciusan-register-login');
wp_register_script('validate-script', plugin_dir_url( __FILE__ ).'assets/js/jquery.validate.js', array('jquery'));
    wp_enqueue_script('validate-script');
    wp_register_script('google-recaptcha', 'https://www.google.com/recaptcha/api.js');
    wp_enqueue_script('google-recaptcha');
    wp_register_script('ciusan-register-login', plugin_dir_url( __FILE__ ).'assets/js/ciusan-register-login.js', array('jquery'));
    wp_enqueue_script('ciusan-register-login');
	    wp_localize_script( 'ciusan-register-login', 'ajax_auth_object', array(
	        'ajaxurl'			=> admin_url( 'admin-ajax.php' ),
			'redirecturl'		=> isset($options['login_redirect_URL']) ? $options['login_redirect_URL'] : home_url(),
			'register_redirect'	=> isset($options['register_redirect_URL']) ? $options['register_redirect_URL'] : home_url(),
        	'loadingmessage'	=> __('Enviando información, por favor espere...')
    	));

    // Enable the user with no privileges to run ajax_login() in AJAX
    add_action( 'wp_ajax_nopriv_ajaxlogin', 'ajax_login' );
// Enable the user with no privileges to run ajax_register() in AJAX
add_action( 'wp_ajax_nopriv_ajaxregister', 'ajax_register' );
}
 
// Execute the action only if the user isn't logged in
    add_action('init', 'ajax_auth_init');
  
// Execute the action only if the user isn't logged in
//if (!is_user_logged_in()) {
    add_action('init', 'ajax_auth_init');
//}
  
function ajax_login(){

    // First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-login-nonce', 'security' );

    // Nonce is checked, get the POST data and sign user on
  	// Call auth_user_login
	auth_user_login($_POST['username'], $_POST['password'], 'Login'); 
	
    die();
}

function ajax_register(){ global $options; $options = get_option('ciusan_register_login');

   /* nuestro codigo  "comentando recaptcha evita verificacion"
    // First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-register-nonce', 'security' );

	$recaptcha = $_POST['recaptcha'];
	if(!empty($recaptcha)){
		$google_url = "https://www.google.com/recaptcha/api/siteverify";
		$secret = $options['Google_Secret_Key'];
		$ip = $_SERVER['REMOTE_ADDR'];
		$url = $google_url."?secret=".$secret."&response=".$recaptcha."&remoteip=".$ip;
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_TIMEOUT, 10);
		curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");
		$results = curl_exec($curl);
		curl_close($curl);
		$res= json_decode($results, true);
		if(!$res['success']){
			echo json_encode(array('loggedin'=>false, 'message'=>__('reCAPTCHA invalid')));
			die();
		}
	}else{
		echo json_encode(array('loggedin'=>false, 'message'=>__('Please enter reCAPTCHA')));
		die();
	}
	*/
		
    // Nonce is checked, get the POST data and sign user on
    $info = array();
  	$info['user_nicename'] = $info['nickname'] = $info['display_name'] = $info['first_name'] = $info['user_login'] = sanitize_user($_POST['username']) ;
    $info['user_pass'] = sanitize_text_field($_POST['password']);
	$info['user_email'] = sanitize_email( $_POST['email']);
	
	// Register the user
    $user_register = wp_insert_user( $info );
 	if ( is_wp_error($user_register) ){	
		$error  = $user_register->get_error_codes()	;
		
		if(in_array('empty_user_login', $error))
			echo json_encode(array('loggedin'=>false, 'message'=>__($user_register->get_error_message('empty_user_login'))));
		elseif(in_array('existing_user_login',$error))
			echo json_encode(array('loggedin'=>false, 'message'=>__('Este usuario ya esta registrado.')));
		elseif(in_array('existing_user_email',$error))
        echo json_encode(array('loggedin'=>false, 'message'=>__('Este email ya esta registrado.')));
    } else {
	  auth_user_login($info['nickname'], $info['user_pass'], 'Registrando');    //Registration    
    }

    die();
}

function auth_user_login($user_login, $password, $login)
{
	$info = array();
    $info['user_login'] = $user_login;
    $info['user_password'] = $password;
    $info['remember'] = true;
	
	$user_signon = wp_signon( $info, false );
    if ( is_wp_error($user_signon) ){
		echo json_encode(array('loggedin'=>false, 'message'=>__('Error de usuario o contraseña.')));
    } else {
		wp_set_current_user($user_signon->ID); 
        echo json_encode(array('loggedin'=>true, 'message'=>__($login.' Correcto, entrando...')));
    }
	
	die();
}

function ajax_forgotPassword(){
	 
	// First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-forgot-nonce', 'security' );
	
	global $wpdb;
	
	$account = $_POST['user_login'];
	
	if( empty( $account ) ) {
		$error = 'Ingresa tu usuario o email.';
	} else {
		if(is_email( $account )) {
			if( email_exists($account) ) 
				$get_by = 'email';
			else	
				$error = 'Este email no se encuentra registrado.';			
		}
		else if (validate_username( $account )) {
			if( username_exists($account) ) 
				$get_by = 'login';
			else	
				$error = 'Este usuario no se encuentra registrado.';				
		}
		else
			$error = 'Usuario o email invalido.';		
	}	
	
	if(empty ($error)) {
		// lets generate our new password
		//$random_password = wp_generate_password( 12, false );
		$random_password = wp_generate_password();

			
		// Get user data by field and data, fields are id, slug, email and login
		$user = get_user_by( $get_by, $account );
			
		$update_user = wp_update_user( array ( 'ID' => $user->ID, 'user_pass' => $random_password ) );
			
		// if  update user return true then lets send user an email containing the new password
		if( $update_user ) {
			
			$from = get_option('admin_email'); // Set whatever you want like mail@yourdomain.com
			
			if(!(isset($from) && is_email($from))) {		
				$sitename = strtolower( $_SERVER['SERVER_NAME'] );
				if ( substr( $sitename, 0, 4 ) == 'www.' ) {
					$sitename = substr( $sitename, 4 );					
				}
				$from = 'do-not-reply@'.$sitename; 
			}
			
			$to = $user->user_email;
			$subject = 'Tu nueva contraseña';
			$sender = 'From: '.get_option('name').' <'.$from.'>' . "\r\n";
			
			$message = 'Tu nueva contraseña es: '.$random_password;
				
			$headers[] = 'MIME-Version: 1.0' . "\r\n";
			$headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers[] = "X-Mailer: PHP \r\n";
			$headers[] = $sender;
				
			$mail = wp_mail( $to, $subject, $message, $headers );
			if( $mail ) 
				$success = 'Revisa tu email para tu nueva contraseña.';
			else
				$error = 'No ha sido posible enviar correo, intentelo nuevamente.';						
		} else {
			$error = 'Algo salió mal, intentelo nuevamente.';
		}
	}
	
	if( ! empty( $error ) )
		//echo '<div class="error_login"><strong>ERROR:</strong> '. $error .'</div>';
		echo json_encode(array('loggedin'=>false, 'message'=>__($error)));
			
	if( ! empty( $success ) )
		//echo '<div class="updated"> '. $success .'</div>';
		echo json_encode(array('loggedin'=>false, 'message'=>__($success)));
				
	die();
}

function ciusan_login_form() {global $options; $options = get_option('ciusan_register_login'); ?>
<form id="login" class="crl-ajax-auth" action="login" method="post">
	<h1><?php if($options['login_title']){echo $options['login_title'];}else{echo'Entrar';}?></h1>
	<hr />
	<p class="status"></p>  
	<?php wp_nonce_field('ajax-login-nonce', 'security'); ?>  
	<div for="username"><span class="label">Username</span>
	<div style="float:right;"><a id="pop_signup" style="cursor:pointer;color:#B4B2B2;">Crea una cuenta</a></div>
	<input id="username" type="text" class="required" name="username" placeholder="Nombre de usuario"></div>
	<div for="password"><span class="label">Password</span>
	<input id="password" type="password" class="required" name="password" placeholder="Contraseña"></div>
	<input class="<?php if($options['button_class']){echo $options['button_class'];}else{echo 'button';};?>" type="submit" value="<?php if ($options['button_login']){echo $options['button_login'];}else{echo 'Entrar';};?>" name="login">
	<a id="pop_forgot" class="text-link"  href="<?php echo wp_lostpassword_url(); ?>">Recuperar contraseña</a>
	<a class="close" href="">(cerrar)</a>    
</form>

<form id="register" class="crl-ajax-auth"  action="register" method="post">
	<h1><?php if($options['register_title']){echo $options['register_title'];}else{echo'Crea una cuenta';}?></h1>
	<hr />
    <p class="status"></p>
    <?php wp_nonce_field('ajax-register-nonce', 'signonsecurity'); ?>         
    <div for="signonname"><span class="label">Username</span>
    <input id="signonname" type="text" name="signonname" class="required" placeholder="Usuario"></div>
    <div for="email"><span class="label">Email</span>
    <input id="email" type="text" class="required email" name="email" placeholder="Email"></div>
    <div for="signonpassword"><span class="label">Password</span>
    <input id="signonpassword" type="password" class="required" name="signonpassword" placeholder="Ingresa contraseña"></div>
    <div for="password2"><span class="label">Confirm Password</span>
    <input type="password" id="password2" class="required" name="password2" placeholder="Repite contraseña"></div>
	<div class="g-recaptcha" data-sitekey="<?php echo $options['Google_Site_Key']; ?>" style="display:block;"></div>
    <input class="<?php if($options['button_class']){echo $options['button_class'];}else{echo 'button';};?>" type="submit" value="<?php if ($options['button_register']){echo $options['button_register'];}else{echo 'Registrarse';};?>" name="register">
	<a id="pop_login" class="text-link" style="cursor:pointer">Entrar</a>
    <a class="close" href="">(cerrar)</a>
</form>

<form id="forgot_password" class="crl-ajax-auth" action="forgot_password" method="post">
	<h1><?php if($options['forgot_password_title']){echo $options['forgot_password_title'];}else{echo'Recuperar contraseña';}?></h1>
    <hr />
    <p class="status"></p>
    <?php wp_nonce_field('ajax-forgot-nonce', 'forgotsecurity'); ?>  
    <div for="user_login"><span class="label">Username or Email</span>
    <input id="user_login" type="text" class="required" name="user_login" placeholder="Nombre de usuario o email"></div>
	<input class="<?php if($options['button_class']){echo $options['button_class'];}else{echo 'button';};?>" type="submit" value="<?php if ($options['button_forgot_password']){echo $options['button_forgot_password'];}else{echo 'Obtener contraseña';};?>" name="forgot_password">
	<a class="close" style="cursor:pointer">(cerrar)</a>    
</form>
<?php } 
add_action("wp_footer", "ciusan_login_form");


function ciusan_login() {
	if (!is_user_logged_in()){
		//return '<a id="show_login" style="cursor:pointer">Login</a>';
		///nuestro codigo
		$output = '<a id="show_login" style="cursor:pointer" >Entrar</a>';
		///fin de nuestro codigo

		return $output;

	}
} add_shortcode('ciusan_login', 'ciusan_login');

function ciusan_register() {
	if (!is_user_logged_in()){
		return '<a id="show_signup" style="cursor:pointer">Crea una cuenta?</a>';
	}
} add_shortcode('ciusan_register', 'ciusan_register');

function ciusan_logout($atts, $content = null) {
	if (is_user_logged_in()){
		extract( shortcode_atts( array(
			'redirect' => 'default'
		), $atts ) );
		switch ($redirect) {
			case 'default':
			$output = '<a href="'.wp_logout_url().'">Logout</a>';
			break;
			case 'current':
			$output = '<a href="'.wp_logout_url(get_permalink()).'">Logout</a>';
			break;
			case 'home':
			$output = '<a href="'.wp_logout_url(home_url()).'">Logout</a>';
			break;
		}
		
		///nuestro codigo
		//$output = '<a href="'.wp_logout_url("http://tinbox.dev.com/sistema/fotocalendario/").'">Logout</a>';
		$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$output = '<a href="'.wp_logout_url($actual_link).'">Salir</a>';
		///fin de nuestro codigo

		return $output;
	}
} add_shortcode('ciusan_logout', 'ciusan_logout');
?>
