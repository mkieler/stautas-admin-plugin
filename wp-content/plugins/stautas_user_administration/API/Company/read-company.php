<?php 
$path = preg_replace('/stautas_user_administration.*$/', '', __DIR__);



include_once($path . '/stautas_user_administration/API/Controller/CompanyController.php');
include_once($path . '/stautas_user_administration/API/Model/User.php');

$companyController = new CompanyController();
$companyArray = $companyController->getAllCompanies();



echo json_encode($companyArray);

?>