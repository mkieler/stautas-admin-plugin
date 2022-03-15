<?php
/*
Plugin Name: Stautas Administration
Author URI: https://mkieler.com/
Author: Mattias M Kieler
Description: Custom plugin developed for stautas to manage userroles and custom functionality
Version: 1.0
*/




if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/**
 * Set constants.
 */
define( 'STAUTAS_PLUGIN_FILE', __FILE__ ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedConstantFound
define( 'STAUTAS_PLUGIN_BASE', plugin_basename( STAUTAS_PLUGIN_FILE ) ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedConstantFound
define( 'STAUTAS_PLUGIN_DIR', plugin_dir_path( STAUTAS_PLUGIN_FILE ) ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedConstantFound
define( 'STAUTAS_PLUGIN_URI', plugins_url( '/', STAUTAS_PLUGIN_FILE ) ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedConstantFound


session_start();


//$tmpName = $_FILES['csv']['tmp_name'];
//$csvAsArray = array_map('str_getcsv', file($tmpName));

//print_r($csvAsArray);




//on plugin activiation create db tables if they doesn't exists
register_activation_hook( __FILE__, 'myPluginCreateTable');
function myPluginCreateTable() {
	$contents = file_get_contents(STAUTAS_PLUGIN_URI . "API/DBAccess/initDB.php");
}



// add admin menues
add_action("admin_menu", "includeAdminMenuFiles");
function includeAdminMenuFiles(){
	//include files	
	include_once( STAUTAS_PLUGIN_DIR . '/set-admin-pages.php' );
}



/*
include_once( STAUTAS_PLUGIN_DIR . '/register-elementor-tags.php' );
*/


//functions to be run everywhere
include_once( STAUTAS_PLUGIN_DIR . '/functions.php' );





//shortcodes to be run everywhere
include_once( STAUTAS_PLUGIN_DIR . '/shortcodes.php' );












add_filter( 'theme_page_templates', 'pt_add_page_template_to_dropdown' );
function pt_add_page_template_to_dropdown( $templates )
{
   $templates[str_replace("\\","/", STAUTAS_PLUGIN_DIR) . '/templates/userpanel-template.php'] = __( 'Brukerpanel', 'text-domain' );


   return $templates;
}



add_filter( 'template_include', 'pt_change_page_template', 99 );
function pt_change_page_template($template){ 
    $userpanel_template = str_replace("\\","/", STAUTAS_PLUGIN_DIR) . '/templates/userpanel-template.php';


    if (is_page()) {
        $meta = get_post_meta(get_the_ID());
	
        if (!empty($meta['_wp_page_template'][0]) && $meta['_wp_page_template'][0] == $userpanel_template) {
            $template = $meta['_wp_page_template'][0];
        }
    }

    return $template;
}




function login_setup($user_login, WP_User $WPuser ) {
    if(checkIfStautasAdmin($WPuser) || checkIfStautasEmployee($WPuser)){
    	createSessions($WPuser);
    }
}
add_action('wp_login', 'login_setup', 10, 2);


/*
function setSession(){
	if(is_user_logged_in()){
		$user = wp_get_current_user();
		//if(checkIfStautasAdmin($user) || checkIfStautasEmployee($user)){
			if (!isset($_SESSION['stautas-session-created'])) {
				createSessions($user);
			} else if (time() - $_SESSION['stautas-session-created'] > 60) {
				// session started more than 30 minutes ago
				//session_regenerate_id(true);    // change session ID for the current session and invalidate old session ID
				createSessions($user);  // update creation time
			}
		//}
	}
}
add_action('wp_head', 'setSession', 10, 2);


function createSessions($WPuser){
    //$WPuser = wp_get_current_user();


	$user_json = file_get_contents(plugins_url() . '/stautas_user_administration/API/User/read-user.php?id=' . $WPuser->ID);
	$user = json_decode($user_json);

	$client_json = file_get_contents(plugins_url() . '/stautas_user_administration/API/Clients/read-clients.php?id=' . $user->companyFK);
	$client = json_decode($client_json);


	$_SESSION['stautas-session-created'] = time();
    $_SESSION["stautas-user"] = $user;
    $_SESSION["stautas-client"] = $client;
}

*/

function checkIfStautasAdmin(WP_User $user){
	if ( in_array( 'client_admin', (array) $user->roles ) ) {
    	return true;
	}
	else{
		return false;
	}
}



function checkIfStautasEmployee(WP_User $user){
	if ( in_array( 'client_sub_user', (array) $user->roles ) ) {
    	return true;
	}
	else{
		return false;
	}
}








function register_userpanel_menu() {
	register_nav_menus(
		array(
		  'user-panel-admin-menu' => __( 'Brukerpanel admin menu' ),
		  'user-panel-employee-menu' => __( 'Brukerpanel ansat menu' ),
		)
    );
}
add_action( 'init', 'register_userpanel_menu' );


?>