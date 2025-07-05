<?php 
//this file sets the patient details to be used by the records user in his/her module
//it calls two functions from the records functions file
//function 1 gets the right person by using the submitted form data and
//function 2 uses the result of function to set the patient details 

@session_start();

 
$activity = "Searched For Patient Details To Get History Of All Medical Lab Tests";
$useraccess = "Page Url:/users/consulting/treat_patient";
require_once '../../../functions/logging.php';

 

$search = $_GET['patient_id'];
$contact = $_GET['contact'];
$surname = $_GET['surname'];
$othernames = $_GET['othernames'];

//$filtered_search = search_pat_info($search);
//$request_code = select_request_code($filtered_search);

//$get_pat_details = get_pat_details($filtered_search);

if(!empty($search) && !empty($contact)){

//update_notification_waiting_patient_to_view($search);




//$_SESSION['ac_tab']=1;
$_SESSION['patient_id'] = $search;
$_SESSION['patient_contact'] = $contact;
$_SESSION['patient_fullname'] = $surname." ".$othernames;
header("Location: ../patient_results_search");

}

?>