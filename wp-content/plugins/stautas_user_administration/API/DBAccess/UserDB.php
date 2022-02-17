<?php 

$newpath = preg_replace('/wp-content.*$/', '', __DIR__);
require_once($newpath.'/wp-load.php');

include_once(WP_PLUGIN_DIR . '/stautas_user_administration/API/Model/User.php');
include_once(WP_PLUGIN_DIR . '/stautas_user_administration/API/Model/Company.php');



class UserDB {


  function getAllUsers(){
    global $wpdb;
    $result = $wpdb->get_results ( "SELECT * FROM wp_stautas_users" );
    $usersArray = $this->buildUserObjects($result);
    return $usersArray;
  }





  function buildUserObjects($result){
    $userArray = array();
    foreach ( $result as $value ) {
      $companyDB = new CompanyDB();
      $company = $companyDB->getCompanyById($value->Company_FK);
      $user = new User();
      $user->userID = $value->ID;
      $user->username = $value->Username;
      $user->company = $company;
      $user->email = $value->Email;
      $user->role = $value->Role;
      array_push($userArray, $user);
    }
    return $userArray;
  }



  function getAdminUserInCompany($companyID){
    global $wpdb;
    $result = $wpdb->get_results ( "SELECT * FROM wp_stautas_users where Company_FK = $companyID AND Role = 1" );
    $adminUser = $this->buildUserObject($result);
    return $adminUser;
  }





  function buildUserObject($result){
      $value = $result[0];
      $user = new User();
      $user->userID = $value->ID;
      $user->username = $value->Username;
      $user->email = $value->Email;
      $user->role = $value->Role;

    return $user;
  }
}

?>