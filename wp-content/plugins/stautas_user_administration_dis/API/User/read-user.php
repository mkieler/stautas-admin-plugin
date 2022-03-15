<?php 
$path = preg_replace('/stautas_user_administration.*$/', '', __DIR__);
include_once($path . '/stautas_user_administration/API/Controller/UserController.php');



if(isset($_GET['id'])) :
	$userID = $_GET['id'];
	$userController = new UserController();
	$user = $userController->getUserByWPId($userID);


	echo json_encode($user);

endif;




?>