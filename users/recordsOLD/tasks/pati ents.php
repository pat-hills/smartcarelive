<?php 
//this file sets the patient details to be used by the records user in his/her module
//it calls two functions from the records functions file
//function 1 gets the right person by using the submitted form data and
//function 2 uses the result of function to set the patient details 
require_once '../../../functions/func_search.php';
require_once '../../../functions/conndb.php';
require_once '../../../functions/func_records.php';
session_start();
//recieving post vairable from multiple search form
$result = mysql_query("SELECT patient_id FROM tbl_patient_info");

$row = array();
$total_records = mysql_num_rows($result);

if($total_records >= 1){
  while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
    $json[] = $row;
  }
}

echo json_encode($json);