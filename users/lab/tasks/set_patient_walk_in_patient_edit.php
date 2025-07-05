<?php 
//this file sets the patient details to be used by the records user in his/her module
//it calls two functions from the records functions file
//function 1 gets the right person by using the submitted form data and
//function 2 uses the result of function to set the patient details 


require '../../../functions/conndb.php';
require '../../../functions/func_lab.php';
 session_start();

 

 
$activity = "Searched For Walk In Patient Details To Edit Or Delete";
$useraccess = "Page Url:/users/consulting/all_walk_patients";
require_once '../../../functions/logging.php';

 

$patient_id = $_GET['patient_id'];
$walk_code = $_GET['walk_code'];
//$name = $_GET['name'];

//$filtered_search = search_pat_info($search);
//$request_code = select_request_code($filtered_search);

//$get_pat_details = get_pat_details($filtered_search);

if(!empty($walk_code) && !empty($patient_id)){

get_patient_walk_in_details($patient_id,$walk_code);




//$_SESSION['ac_tab']=1;
$_SESSION['walk_in_code'] = $walk_code;
$_SESSION['patient_id'] = $patient_id; 
header("Location: ../all_walk_patients");

}

?>