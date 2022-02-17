<?php 
$path = preg_replace('/wp-content.*$/', '', __DIR__);
require_once($path.'/wp-load.php');

  $companyname = $_POST['company-name'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $email = $_POST['email'];


  echo $username . $password . $email;

         global $wpdb;     
  $table_name = $wpdb->prefix . 'stautas_users';         
  

  $wpdb->query("insert into wp_stautas_company (Name) VALUES ('$companyname');"); 
  $companyID = $wpdb->insert_id;
  $wpdb->query("INSERT INTO `wp_stautas_users` (`Username`, `Company_FK`, `Password`, `Email`, `Role`) VALUES ('$username', $companyID, '$password', '$email', 1);"); 
  $userID = $wpdb->insert_id;
  $wpdb->query("insert into wp_stautas_admin_users (UserID_FK) VALUES ($userID);"); 
  $adminUserID = $wpdb->insert_id;
  $wpdb->query("insert into wp_stautas_sub_users (UserID_FK, ParrentUserID_FK) VALUES ($userID, $adminUserID);"); 

?>