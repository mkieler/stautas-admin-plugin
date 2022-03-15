<?php



/**
 * Load css in header
 */
function load_custom_wp_admin_style($hook) {
	if (str_contains($hook, 'stautas-admin')) {
		wp_enqueue_style( 'stautas_plugin_style', STAUTAS_PLUGIN_URI . 'style.css' );
		wp_enqueue_style( 'stautas_all_clients_style', STAUTAS_PLUGIN_URI . 'assets/style/all-clients.css' );
		wp_enqueue_style( 'create-client-style', STAUTAS_PLUGIN_URI . 'assets/style/create-client.css' );
	}	
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );

wp_enqueue_style( 'ajax_post_message_style', STAUTAS_PLUGIN_URI . 'assets/style/ajax-post-message.css' );
wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css' );
wp_enqueue_style( 'loading-screen-style', STAUTAS_PLUGIN_URI . 'assets/style/loading-screen.css' );




/**
 * load critical scripts in header
 */
wp_enqueue_script( 'create-client-ajax', STAUTAS_PLUGIN_URI . '/assets/js/create-client-ajax.js', array( 'jquery' ), false, false );
wp_enqueue_script( 'create-sub-client-ajax', STAUTAS_PLUGIN_URI . '/assets/js/create-sub-client-ajax.js', array( 'jquery' ), false, false );


if (is_admin()) {
wp_enqueue_script( 'stautas_admin_navigation', STAUTAS_PLUGIN_URI . 'assets/js/navigation.js', false, false );
wp_enqueue_script( 'settings-ajax', STAUTAS_PLUGIN_URI . '/assets/js/settings-ajax.js', array( 'jquery' ), false, false );
wp_enqueue_script( 'toggle-password', STAUTAS_PLUGIN_URI . 'assets/js/togglepassword.js', false, false );

	wp_deregister_script('jquery');
	wp_register_script('jquery', ("https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"), false);
	wp_enqueue_script('jquery');
}









/*
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
*/





add_action( 'wp_login_failed', 'my_front_end_login_fail' );  // hook failed login

function my_front_end_login_fail( $username ) {
   $referrer = $_SERVER['HTTP_REFERER'];  // where did the post submission come from?
   // if there's a valid referrer, and it's not the default log-in screen
   if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') ) {
      wp_redirect( $referrer . '?login=failed' );  // let's append some information (login=failed) to the URL for the theme to use
      exit;
   }
}


/*
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
*/


?>