<?php
$path = preg_replace('/stautas_user_administration.*$/', '', __DIR__);
include_once($path . '/stautas_user_administration/API/DBAccess/ClientDB.php');



class ClientController {


  function getAllClients(){
    $clientDB = new ClientDB();
    return $clientDB->getAllClients();
  }






  function getClientById($id){
    $clientDB = new ClientDB();
    return $clientDB->getClientById($id);
  }







  function createClient($companyname, $username, $password, $email, $fname, $lname, $role, $categoriesJson){
    $clientDB = new ClientDB();
    $clientDB->createClient($companyname, $username, $password, $email, $fname, $lname, $role, $categoriesJson);
  }
}
?>