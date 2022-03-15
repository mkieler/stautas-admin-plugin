<?php 


$path = preg_replace('/stautas_user_administration.*$/', '', __DIR__);
include_once($path . '/stautas_user_administration/API/Controller/UserController.php');



$client;
if(isset($_GET['id'])){
  $clientID = $_GET['id'];
  $pluginName = '/stautas_user_administration';
  $client_json = file_get_contents(plugins_url() . $pluginName . '/API/Clients/read-clients.php?id=' . $clientID);
  $client = json_decode($client_json);
}


$fname = $_POST['fname'];
$lname = $_POST['lname'];
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$role = 'client_sub_user';


$userController = new UserController();
$userController->createEmployeeUser($client->adminUser->userID, $client->company->companyID, $username, $password, $email, $fname, $lname, $role);
?>