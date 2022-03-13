<?php
$path = preg_replace('/stautas_user_administration.*$/', '', __DIR__);
include_once($path . '/stautas_user_administration/API/Controller/ClientController.php');



$companyname = $_POST['company-name'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$role = 'client_admin';


$categoriesSelected = $_POST['categories'];
$categoriesJson = json_encode(array_keys($categoriesSelected)); 



$clientController = new ClientController();
$clientController->createClient($companyname, $username, $password, $email, $fname, $lname, $role, $categoriesJson);


?>