<?php 
// //this file sets the patient details to be used by the records user in his/her module
// //it calls two functions from the records functions file
// //function 1 gets the right person by using the submited form data and
// //function 2 uses the result of function to set the patient details 
require '../../../functions/conndb.php';
require '../../../functions/func_opd.php';
 session_start();

 

// //recieving post vairable from multiple search form

$search = $_GET['patient_id'];
$_SESSION['patient_id'] = $search;
$request_code = $_GET['request_code'];
$flag = $_GET['flag'];


if(isset($request_code) && $request_code == "DR"){
    update_list_total_notification_waiting_from_Doctor($search);
 }

 


header("Location: ../view_drug_req");

?>