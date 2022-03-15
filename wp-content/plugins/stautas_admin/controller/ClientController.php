<?php
require_once STAUTAS_PLUGIN_DIR . 'database/ClientDB.php';



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