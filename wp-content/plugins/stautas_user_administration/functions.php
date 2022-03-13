<?php
$path = preg_replace('/wp-content.*$/', '', __DIR__);
require_once($path.'/wp-load.php');
require_once($path.'wp-includes/pluggable.php');
require_once($path.'wp-includes/link-template.php');




add_action( 'template_redirect', 'login_page_functions' );
function login_page_functions(){
	$pluginName = '/stautas_user_administration';
	$plugin_settings_json = file_get_contents(plugins_url() . $pluginName . '/API/plugin-settings/read-plugin-settings.php');
	$plugin_settings = json_decode($plugin_settings_json);
	

	if($_SERVER['REQUEST_URI'] == $plugin_settings->login_page_url && is_user_logged_in()){
		wp_redirect(site_url(). $plugin_settings->login_redirect_url);
		exit;
	}
}






add_action( 'wp_login_failed', 'my_front_end_login_fail' );  // hook failed login

function my_front_end_login_fail( $username ) {
   $referrer = $_SERVER['HTTP_REFERER'];  // where did the post submission come from?
   // if there's a valid referrer, and it's not the default log-in screen
   if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') ) {
      wp_redirect( $referrer . '?login=failed' );  // let's append some information (login=failed) to the URL for the theme to use
      exit;
   }
}



add_action( 'wp_head', 'login_js' );
function login_js(){
	$pluginName = '/stautas_user_administration';
	$plugin_settings_json = file_get_contents(plugins_url() . $pluginName . '/API/plugin-settings/read-plugin-settings.php');
	$plugin_settings = json_decode($plugin_settings_json);
	

	$url = str_replace( '?' . $_SERVER['QUERY_STRING'], '', $_SERVER['REQUEST_URI'] );

	if($url == $plugin_settings->login_page_url){
		wp_enqueue_script( 'login-js', $GLOBALS["plugin_url"] . 'assets/js/login.js', false, false );
		wp_enqueue_style( 'login-css', $GLOBALS["plugin_url"] . 'assets/style/login.css', false, false );
	}
}



?>