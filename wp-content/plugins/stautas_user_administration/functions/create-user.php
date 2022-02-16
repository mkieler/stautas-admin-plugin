<?php 
$path = preg_replace('/wp-content.*$/', '', __DIR__);
require_once($path.'/wp-load.php');

  $username = $_POST['username'];
  $password = $_POST['password'];
  $email = $_POST['email'];


  echo $username . $password . $email;

         global $wpdb;     
  $table_name = $wpdb->prefix . 'stautas_users';         
  $wpdb->query("INSERT INTO $table_name (Username, Password, Email, Role) VALUES ('$username', '$password', '$email', 1);"); 

?>