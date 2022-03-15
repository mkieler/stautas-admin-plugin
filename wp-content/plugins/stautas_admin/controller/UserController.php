<?php 
require_once STAUTAS_PLUGIN_DIR . 'database/UserDB.php';



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