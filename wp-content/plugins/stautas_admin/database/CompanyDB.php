<?php
$newpath = preg_replace('/wp-content.*$/', '', __DIR__);
require_once $newpath.'/wp-load.php';

require_once STAUTAS_PLUGIN_DIR . 'model/Company.php';
require_once STAUTAS_PLUGIN_DIR . 'model/User.php';
require_once STAUTAS_PLUGIN_DIR . 'database/UserDB.php';




class CompanyDB {

  function getAllCompanies(){
    global $wpdb;
    $result = $wpdb->get_results ( "SELECT * FROM wp_stautas_company" );
    $usersArray = $this->buildCompanyObjects($result);
    return $usersArray;
  }






  function getCompanyByID($id){
    global $wpdb;
    $result = $wpdb->get_results ( "SELECT * FROM wp_stautas_company WHERE id = $id" );
    $usersArray = $this->buildCompanyObjects($result);
    if($usersArray != null){
      return $usersArray[0];
    }
  }






  function buildCompanyObjects($result){
    $companyArray = array();
    foreach ( $result as $value ) {
      $company = new Company();
      $company->companyID = $value->ID;
      $company->name = $value->Name;
      $company->categoriesToShow = json_decode($value->Product_categories_filter);
      array_push($companyArray, $company);
    }
    if(count($companyArray) != 0){
      return $companyArray;
    }

  }









  function insertCompany($companyname, $categoriesJson){
    global $wpdb;     
    $table_name = $wpdb->prefix . 'stautas_company';         
    
    $wpdb->query("insert into $table_name (Name, Product_categories_filter) VALUES ('$companyname', '$categoriesJson');"); 
    return $wpdb->insert_id;
  }
}

?>