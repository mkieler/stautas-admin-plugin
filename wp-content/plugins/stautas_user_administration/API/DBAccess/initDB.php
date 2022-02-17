<?php


$path = preg_replace('/wp-content.*$/', '', __DIR__);
require_once($path.'/wp-load.php');



function setUpDatabases() {
	initCompanyDatabase();
	initUserDatabase();
	initAdminUserDatabase();
	initSubUserDatabase();
}


function initCompanyDatabase(){
	global $wpdb;   
	$table_name = $wpdb->prefix . 'stautas_company';


	$wpdb->query("
		CREATE TABLE IF NOT EXISTS `wp_stautas_company` (
  		`ID` int(6) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  		`Name` varchar(30) NOT NULL,
  		`reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
		);
	"); 
}


function initUserDatabase(){
	global $wpdb;   
	$table_name = $wpdb->prefix . 'stautas_users';


	$wpdb->query("
		CREATE TABLE IF NOT EXISTS `wp_stautas_users` (
  		`ID` int(6) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  		`Username` varchar(30) NOT NULL,
  		`Company_FK`int(6) UNSIGNED DEFAULT NULL,
  		`Password` varchar(30) NOT NULL,
  		`Email` varchar(50) NOT NULL,
  		`Role` int(2) NOT NULL,
  		`reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
		FOREIGN KEY (Company_FK) REFERENCES wp_stautas_company(ID)
		);
	"); 
}



function initAdminUserDatabase(){
	global $wpdb;   
	$table_name = $wpdb->prefix . 'stautas_admin_users';


	$wpdb->query("
		CREATE TABLE IF NOT EXISTS `wp_stautas_admin_users` (
  		`ID` int(6) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  		`UserID_FK` int(6) UNSIGNED NOT NULL,
  		`reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  		FOREIGN KEY (UserID_FK) REFERENCES wp_stautas_users(ID)
		);
	"); 
}



function initSubUserDatabase(){
	global $wpdb;   
	$table_name = $wpdb->prefix . 'stautas_sub_users';


	$wpdb->query("
		CREATE TABLE IF NOT EXISTS `wp_stautas_sub_users` (
  		`ID` int(6) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  		`UserID_FK` int(6) UNSIGNED NOT NULL,
 		`ParrentUserID_FK` int(6) UNSIGNED NOT NULL,
  		`reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
   		FOREIGN KEY (UserID_FK) REFERENCES wp_stautas_users(ID)
		);
	"); 
}