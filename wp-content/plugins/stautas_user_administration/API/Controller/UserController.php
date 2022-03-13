<?php 
$path = preg_replace('/stautas_user_administration.*$/', '', __DIR__);
include_once($path . '/stautas_user_administration/API/DBAccess/UserDB.php');



class UserController {

	function createEmployeeUser($parrentId, $companyId, $username, $password, $email, $fname, $lname, $role){
		$userDB = new UserDB();
    	$userDB->createEmployeeUser($parrentId, $companyId, $username, $password, $email, $fname, $lname, $role);
	}

	function getUserByWPId($id){
		$userDB = new UserDB();
    	return $userDB->getUserByWPId($id);
	}

}

?>