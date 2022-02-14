<?php 
$path = preg_replace('/wp-content.*$/', '', __DIR__);
require_once($path.'/wp-load.php');

  $username = $_POST['username'];
  $password = $_POST['password'];
  $email = $_POST['email'];


  echo $username . $password . $email;

	wp_create_user( $username, $password, $email );
?>