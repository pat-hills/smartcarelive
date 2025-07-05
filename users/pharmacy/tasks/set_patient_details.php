<?php 
//this file sets the patient details to be used by the pharmacy user in his/her module
//it calls two functions from the records functions file
//function 1 gets the right person by using the submitted form data and
//function 2 uses the result of function to set the patient details 
require_once '../../../functions/func_search.php';
require_once '../../../functions/conndb.php';
require_once '../../../functions/func_pharmacy.php';
session_start();
//recieving post vairable from multiple search form

$search = $_GET['patient_id'];
$request_code = $_GET['request_code'];
$flag = $_GET['flag'];

$filtered_search = search_pat_info($search);

get_pat_details($filtered_search);

if(isset($request_code) && $request_code == "DR"){
   update_list_total_notification_waiting_from_Doctor($search);
}


if(isset($flag) && $flag == "CASH_TO_PHARMA"){
    update_notification_waiting_patients_drug2depenseinfoFRMCASHIER($search);
}


header("Location: ../dispense");

?>