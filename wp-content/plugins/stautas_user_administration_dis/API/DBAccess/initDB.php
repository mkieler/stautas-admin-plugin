<?php


$path = preg_replace('/wp-content.*$/', '', __DIR__);
require_once($path.'/wp-load.php');




initCompanyDatabase();
initAdminUserDatabase();
initSubUserDatabase();
initPluginSettingsDatabase();



function initCompanyDatabase(){
	global $wpdb;   
	$table_name = $wpdb->prefix . 'stautas_company';


	$wpdb->query("
		CREATE TABLE IF NOT EXISTS `wp_stautas_company` (
  		`ID` int(6) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  		`Name` varchar(30) NOT NULL,
  		`Product_categories_filter` TEXT,
  		`reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
		);
	"); 
}



function initAdminUserDatabase(){
	global $wpdb;   
	$table_name = $wpdb->prefix . 'stautas_admin_users';


	$wpdb->query("
		CREATE TABLE IF NOT EXISTS  wp_stautas_user_admin_data (
		ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		UserID_FK bigint(20) UNSIGNED NOT NULL,
		Company_FK INT(6) UNSIGNED NOT NULL,
		reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		FOREIGN KEY (UserID_FK) REFERENCES wp_users(ID),
		FOREIGN KEY (Company_FK) REFERENCES wp_stautas_company(ID)
		);
	"); 
}



function initSubUserDatabase(){
	global $wpdb;   
	$table_name = $wpdb->prefix . 'stautas_sub_users';


	$wpdb->query("
		CREATE TABLE IF NOT EXISTS  wp_stautas_user_employee_data (
		ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		UserID_FK bigint(20) UNSIGNED NOT NULL,
		ParrentID_FK INT(6) UNSIGNED NOT NULL,
		Company_FK INT(6) UNSIGNED NOT NULL,
		reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		FOREIGN KEY (UserID_FK) REFERENCES wp_users(ID),
		FOREIGN KEY (ParrentID_FK) REFERENCES wp_stautas_user_admin_data(ID),
		FOREIGN KEY (Company_FK) REFERENCES wp_stautas_company(ID)
		);
	"); 
}



function initPluginSettingsDatabase(){
	global $wpdb;   
	$table_name = $wpdb->prefix . 'stautas_settings';


	$wpdb->query("
		CREATE TABLE IF NOT EXISTS `wp_stautas_settings` (
  		`ID` int(6) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  		`login_redirect_url` TEXT,
  		`login_page_url` TEXT
		);
	"); 

	$wpdb->query("INSERT INTO wp_stautas_settings(ID) VALUES(1) ON DUPLICATE KEY UPDATE ID=1");
}