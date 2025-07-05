<?php 
//this file sets the patient details to be used by the records user in his/her module
//it calls two functions from the records functions file
//function 1 gets the right person by using the submitted form data and
//function 2 uses the result of function to set the patient details 

@session_start();

require_once '../../../functions/conndb.php';
require_once '../../../functions/func_search.php';
require_once '../../../functions/func_consulting.php';

$activity = "Searched For Patient Details";
$useraccess = "Page Url:/users/consulting/treat_patient";
require_once '../../../functions/logging.php';

 

$search = $_GET['patient_id'];

//$_SESSION['patient_']

$filtered_search = search_pat_info($search);
$request_code = select_request_code($filtered_search);

$get_pat_details = get_pat_details($filtered_search);

 

if(!empty($search)){

update_notification_waiting_patient_to_view($search);
}



$_SESSION['ac_tab']=1;
$_SESSION['request_code'] = $request_code;
header("Location: ../treat_patient");

?>