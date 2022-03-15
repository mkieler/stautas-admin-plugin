<?php
/*
Plugin Name: Stautas Admin
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







/**
 * If database tables doesn't exists, create them on plugin activation
 */
function initDatabaseTables() {
	require_once STAUTAS_PLUGIN_DIR . 'database/initDB.php';
}
register_activation_hook( __FILE__, 'initDatabaseTables');



/** 
 * require controllers
 */
require_once STAUTAS_PLUGIN_DIR . 'controller/ClientController.php';
require_once STAUTAS_PLUGIN_DIR . 'controller/UserController.php';





/**
 *  sets admin pages
 */
function setAdminPages(){
	//include files	
	require_once STAUTAS_PLUGIN_DIR . 'view/admin/set-admin-pages.php' ;
}
add_action("admin_menu", "setAdminPages");






/*

require_once STAUTAS_PLUGIN_DIR . '/register-elementor-tags.php' ;

*/


//functions to be run everywhere
require_once STAUTAS_PLUGIN_DIR . 'includes/functions.php' ;





//shortcodes to be run everywhere
require_once STAUTAS_PLUGIN_DIR . 'includes/shortcodes.php' ;















add_filter( 'theme_page_templates', 'pt_add_page_template_to_dropdown' );
function pt_add_page_template_to_dropdown( $templates )
{
   $templates[str_replace("\\","/", STAUTAS_PLUGIN_DIR) . 'view/templates/userpanel-template.php'] = __( 'Brukerpanel', 'text-domain' );


   return $templates;
}



add_filter( 'template_include', 'pt_change_page_template', 99 );
function pt_change_page_template($template){ 
    $userpanel_template = str_replace("\\","/", STAUTAS_PLUGIN_DIR) . 'view/templates/userpanel-template.php';


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

    }
}
add_action('wp_login', 'login_setup', 10, 2);






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






//$tmpName = $_FILES['csv']['tmp_name'];
//$csvAsArray = array_map('str_getcsv', file($tmpName));

//print_r($csvAsArray);
?>