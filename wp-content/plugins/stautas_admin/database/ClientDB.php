<?php
$newpath = preg_replace('/wp-content.*$/', '', __DIR__);
require_once($newpath.'/wp-load.php');


require_once STAUTAS_PLUGIN_DIR . 'database/CompanyDB.php';
require_once STAUTAS_PLUGIN_DIR . 'database/UserDB.php';
require_once STAUTAS_PLUGIN_DIR . 'model/Company.php';
require_once STAUTAS_PLUGIN_DIR . 'model/User.php';
require_once STAUTAS_PLUGIN_DIR . 'model/Client.php';

class ClientDB {

function getAllClients(){
    $companyDB = new CompanyDB();
    $userDB = new UserDB();
    $companies = $companyDB->getAllCompanies();
    $clientArray = array();
    foreach ($companies as $value) {
      $client = new Client();
      $client->company = $value;
      $client->adminUser = $userDB->getAdminUserInCompany($client->company->companyID);
      $client->subUsers = $userDB->getAllSubUsersByCompany($client->company->companyID);
      $client->numOfUsers = $userDB->countUsersInCompany($client->company->companyID);

      array_push($clientArray, $client);
    }

    return $clientArray;
  }


  function getClientById($id){
    $companyDB = new CompanyDB();
    $userDB = new UserDB();
    $client = new Client();
    $client->company = $companyDB->getCompanyByID($id);
    if($client->company == null){
      $client = new Client();
      $client->company = new Company();
      $client->adminUser = new User();
      $client->subUsers = new User();
      $client->numOfUsers = 0;
      return $client;
    }
    $client->adminUser = $userDB->getAdminUserInCompany($client->company->companyID);
    $client->subUsers = $userDB->getAllSubUsersByCompany($client->company->companyID);
    $client->numOfUsers = $userDB->countUsersInCompany($client->company->companyID);

    return $client;
  }





  function createClient($companyname, $username, $password, $email, $fname, $lname, $role, $categoriesJson){
  	global $wpdb;
    $companyDB = new CompanyDB();
    $userDB = new UserDB();

    $wpdb->query( "START TRANSACTION" );
    
    $companyId = $companyDB->insertCompany($companyname, $categoriesJson);
    $userDB->createAdminUser($companyId, $username, $password, $email, $fname, $lname, $role);

    $wpdb->query( "COMMIT" );
  }
}

?>
