<?php
/*
Plugin Name: Stautas Custom User Administration
Author URI: https://mkieler.com/
Author: Mattias M Kieler
Description: Custom plugin developed for stautas to manage userroles and custom functionality
Version: 1.0
*/





add_action("admin_menu", "addMenu");


function addMenu()
{
	add_role( "client_admin", "Klient admin" );
	add_menu_page("Stautas Admin", "Stautas Admin", 4, "stautas-admin", "stautasAdmin" );
	add_submenu_page("stautas-admin", "Ny klient", "Ny klient", 4, "stautas-create-user", "stautasCreateUser");
	add_submenu_page("stautas-admin", "Alle klienter", "Alle klienter", 4, "stautas-all-users", "stautasAllUsers");
    add_submenu_page("stautas-all-users", 'Bruger detaljer','Bruger detaljer', 4, 'stautas-user-detail', 'stautasUserDetails');
}


function stautasAdmin(){
	$plugin_url = plugin_dir_url( __FILE__ );
	wp_enqueue_style( 'stautas_plugin_style', $plugin_url . 'style.css' );
	$plugin_path = plugin_dir_path( __FILE__ );
	include( $plugin_path . 'pages/admin-page.php');
}



function stautasCreateUser()
{
  	$plugin_url = plugin_dir_url( __FILE__ );
	$plugin_path = plugin_dir_path( __FILE__ );
	wp_enqueue_style( 'stautas_plugin_style', $plugin_url . 'style.css' );
	include( $plugin_path . 'pages/create-user.php');
}


function stautasAllUsers()
{
  	$plugin_url = plugin_dir_url( __FILE__ );
	$plugin_path = plugin_dir_path( __FILE__ );
	wp_enqueue_style( 'stautas_plugin_style', $plugin_url . 'style.css' );
	include( $plugin_path . 'pages/all-users.php');
}




function stautasUserDetails()
{
  	$plugin_url = plugin_dir_url( __FILE__ );
	$plugin_path = plugin_dir_path( __FILE__ );
	wp_enqueue_style( 'stautas_plugin_style', $plugin_url . 'style.css' );
	include( $plugin_path . 'pages/user-detail.php');
}




?>