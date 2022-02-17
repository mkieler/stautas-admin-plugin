<?php
/*
Plugin Name: Stautas Custom User Administration
Author URI: https://mkieler.com/
Author: Mattias M Kieler
Description: Custom plugin developed for stautas to manage userroles and custom functionality
Version: 1.0
*/





register_activation_hook( __FILE__, 'myPluginCreateTable');

function myPluginCreateTable() {
	$plugin_path = plugin_dir_path( __FILE__ );
	include( $plugin_path . 'API/DBAccess/initDB.php');

	setUpDatabases();
}

add_action("admin_menu", "addMenu");


function addMenu()
{
	add_role( "client_admin", "Klient admin" );
	add_menu_page("Stautas Admin", "Stautas Admin", 4, "stautas-admin", "stautasAdmin" );
	add_submenu_page("stautas-admin", "Ny klient", "Ny klient", 4, "stautas-create-company", "stautasCreateCompany");
	add_submenu_page("stautas-admin", "Alle klienter", "Alle klienter", 4, "stautas-all-companies", "stautasAllCompanies");
    add_submenu_page("stautas-all-company", 'Bruger detaljer','Bruger detaljer', 4, 'stautas-company-detail', 'stautasCompanyDetails');
    add_submenu_page("stautas-admin", 'Indstillinger','Indstillinger', 4, 'stautas-settings', 'stautasSettings');
}


function stautasAdmin(){
	$plugin_url = plugin_dir_url( __FILE__ );
	wp_enqueue_style( 'stautas_plugin_style', $plugin_url . 'style.css' );
	$plugin_path = plugin_dir_path( __FILE__ );
	include( $plugin_path . 'pages/admin-page.php');
}



function stautasCreateCompany()
{
  	$plugin_url = plugin_dir_url( __FILE__ );
	$plugin_path = plugin_dir_path( __FILE__ );
	wp_enqueue_style( 'stautas_plugin_style', $plugin_url . 'style.css' );
	include( $plugin_path . 'pages/create-company.php');
}


function stautasAllCompanies()
{
  	$plugin_url = plugin_dir_url( __FILE__ );
	$plugin_path = plugin_dir_path( __FILE__ );
	wp_enqueue_style( 'stautas_plugin_style', $plugin_url . 'style.css' );
	include( $plugin_path . 'pages/all-companies.php');
}




function stautasCompanyDetails()
{
  	$plugin_url = plugin_dir_url( __FILE__ );
	$plugin_path = plugin_dir_path( __FILE__ );
	wp_enqueue_style( 'stautas_plugin_style', $plugin_url . 'style.css' );
	include( $plugin_path . 'pages/company-detail.php');
}



function stautasSettings()
{
  	$plugin_url = plugin_dir_url( __FILE__ );
	$plugin_path = plugin_dir_path( __FILE__ );
	wp_enqueue_style( 'stautas_plugin_style', $plugin_url . 'style.css' );
	include( $plugin_path . 'pages/settings.php');
}




?>