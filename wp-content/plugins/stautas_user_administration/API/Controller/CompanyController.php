<?php
$path = preg_replace('/stautas_user_administration.*$/', '', __DIR__);
include_once($path . '/stautas_user_administration/API/DBAccess/CompanyDB.php');
include_once($path . '/stautas_user_administration/API/Model/Company.php');


class CompanyController {


  function getAllCompanies(){
    $companyDB = new CompanyDB();
    return $companyDB->getAllCompanies();
  }
}
?>