<?php 
$path = preg_replace('/stautas_user_administration.*$/', '', __DIR__);
include_once($path . '/stautas_user_administration/API/Controller/ClientController.php');



if(isset($_GET['id'])) :
	$clientID = $_GET['id'];
	$clientController = new ClientController();
	$client = $clientController->getClientById($clientID);


	echo json_encode($client);



else : 
	$clientController = new ClientController();
	$clientArray = $clientController->getAllClients();



	echo json_encode($clientArray);

endif;




?>