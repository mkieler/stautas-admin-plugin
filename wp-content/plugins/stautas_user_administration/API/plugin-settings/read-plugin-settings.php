<?php
$path = preg_replace('/wp-content.*$/', '', __DIR__);
require_once($path.'/wp-load.php');



  global $wpdb;     
  $table_name = $wpdb->prefix . 'stautas_settings';         
  

  $result = $wpdb->get_results("SELECT * FROM `wp_stautas_settings`"); 

  echo json_encode($result[0]); 
?>