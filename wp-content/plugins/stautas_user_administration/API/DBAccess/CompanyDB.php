<?php
$newpath = preg_replace('/wp-content.*$/', '', __DIR__);
require_once($newpath.'/wp-load.php');

include_once(WP_PLUGIN_DIR . '/stautas_user_administration/API/Model/Company.php');
include_once(WP_PLUGIN_DIR . '/stautas_user_administration/API/Model/User.php');
include_once(WP_PLUGIN_DIR . '/stautas_user_administration/API/DBAccess/UserDB.php');




class CompanyDB {


  function getCompanyById($id){
    global $wpdb;
    $result = $wpdb->get_results ( "SELECT * FROM wp_stautas_company where ID = $id" );
    $company = $this->buildCompanyObject($result);
    return $company;
  }

  function getAmountOfUsersInCompany($companyID){
    global $wpdb;
    $result = $wpdb->get_results ( "SELECT COUNT(ID) AS NumberOfUsers FROM wp_stautas_users where Company_FK = $companyID;" );
    $numberOfUsers = $result[0]->NumberOfUsers;
    return $numberOfUsers;
  }


  function buildCompanyObject($result){
      $value = $result[0];
      $company = new Company();
      $company->companyID = $value->ID;
      $company->name = $value->Name;
      $company->numOfUsers = $this->getAmountOfUsersInCompany($value->ID);

    return $company;
  }


  function getAllCompanies(){
    global $wpdb;
    $result = $wpdb->get_results ( "SELECT * FROM wp_stautas_company" );
    $usersArray = $this->buildUserObjects($result);
    return $usersArray;
  }


  function buildUserObjects($result){
    $companyArray = array();
    foreach ( $result as $value ) {
      $userDB = new UserDB();
      $company = new Company();
      $company->companyID = $value->ID;
      $company->name = $value->Name;
      $company->adminUser = $userDB->getAdminUserInCompany($value->ID);

      $company->numOfUsers = $this->getAmountOfUsersInCompany($value->ID);
      array_push($companyArray, $company);
    }
    return $companyArray;
  }
}

?>