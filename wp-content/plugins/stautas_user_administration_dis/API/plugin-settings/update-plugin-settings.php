<?php 
$path = preg_replace('/wp-content.*$/', '', __DIR__);
require_once($path.'/wp-load.php');

  $login_redirect_url = $_POST['login-redirect-url'];
  $login_page_url = $_POST['login-page-url'];


         global $wpdb;     
  $table_name = $wpdb->prefix . 'stautas_settings';         
  

  $wpdb->query("UPDATE $table_name SET login_redirect_url = '$login_redirect_url', login_page_url = '$login_page_url'  WHERE id = 1;"); 
  



?>