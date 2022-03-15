<?php 

$newpath = preg_replace('/wp-content.*$/', '', __DIR__);
require_once($newpath.'/wp-load.php');

require_once STAUTAS_PLUGIN_DIR . 'model/User.php';
require_once STAUTAS_PLUGIN_DIR . 'model/Company.php';



class UserDB {


  function createAdminUser($companyId, $username, $password, $email, $fname, $lname, $role){
    global $wpdb;
    $table_name = $wpdb->prefix . 'stautas_user_admin_data';
    $userid = $this->insertWPUser($username, $password, $email, $fname, $lname, $role);
    $wpdb->query("insert into wp_stautas_user_admin_data (UserID_FK, Company_FK) VALUES ($userid, $companyId);"); 
    return $wpdb->insert_id;
  }






  function getUserByWPId($id){
    global $wpdb;
    $result = $wpdb->get_results( "SELECT * FROM wp_stautas_user_admin_data where UserID_FK = $id" );
    if(empty($result)){
      $result = $wpdb->get_results( "SELECT * FROM wp_stautas_user_employee_data where UserID_FK = $id" );
    }
    $user = new User();
    $user = $this->buildUserObject($result);
    return $user;
  }








    function createEmployeeUser($parrentId, $companyId, $username, $password, $email, $fname, $lname, $role){
    global $wpdb;
    $table_name = $wpdb->prefix . 'stautas_user_employee_data';
    $userid = $this->insertWPUser($username, $password, $email, $fname, $lname, $role);
    $wpdb->query("insert into $table_name (UserID_FK, ParrentID_FK, Company_FK) VALUES ($userid, $parrentId, $companyId);"); 
  }










  function getAllSubUsersByCompany($companyID){
    global $wpdb;
    $result = $wpdb->get_results ( "SELECT * FROM wp_stautas_user_employee_data where Company_FK = $companyID" );
    $usersArray = $this->buildUserObjects($result);
    return $usersArray;
  }







  function countUsersInCompany($companyID){
    global $wpdb;
    $result = $wpdb->get_results ( "SELECT COUNT(ID) AS NumberOfUsers FROM wp_stautas_user_employee_data where Company_FK = $companyID" );
    return $result[0]->NumberOfUsers;
  }







  function buildUserObjects($result){

    $userArray = array();
    foreach ( $result as $value ) {
      $wpUser = $this->getWPUserById($value->UserID_FK);
      $user = new User();
      $user->userID = $value->ID;
      $user->display_name = $wpUser->display_name;
      $user->username = $wpUser->user_login;

      array_push($userArray, $user);
    }
    return $userArray;
  }







  function getAdminUserInCompany($companyID){
    global $wpdb;
    $result = $wpdb->get_results ( "SELECT * FROM wp_stautas_user_admin_data where Company_FK = $companyID" );
    $adminUser = new User();
    $adminUser = $this->buildUserObject($result);
    return $adminUser;
  }








    function buildUserObject($result){
      $user = new User();
      
      foreach ( $result as $value ) {
        $wpUser = $this->getWPUserById($value->UserID_FK);
        $userdata = get_userdata( $value->UserID_FK );
        $user->userID = $value->ID;
        $user->companyFK = $value->Company_FK;
        $user->display_name = $wpUser->display_name;
        $user->username = $wpUser->user_login;
        $user->fname = $userdata->first_name;
        $user->lname = $userdata->last_name;
        $user->email = $userdata->user_email;
      }
      return $user;
    }








    function getWPUserById($userId){
      return get_user_by('ID', $userId);
    }









    function insertWPUser($username, $password, $email, $fname, $lname, $role){
      $path = preg_replace('/wp-content.*$/', '', __DIR__);
      require_once($path.'/wp-load.php');

      $user_id = wp_insert_user( array(
        'user_login' => $username,
        'user_pass' => $password,
        'user_email' => $email,
        'first_name' => $fname,
        'last_name' => $lname,
        'display_name' => $fname . " " . $lname,
        'role' => $role
      ));

      return $user_id;
    }

}

?>