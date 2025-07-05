<?php 
//this file sets the patient details to be used by the records user in his/her module
//it calls two functions from the records functions file
//function 1 gets the right person by using the submited form data and
//function 2 uses the result of function to set the patient details 
require '../../../functions/conndb.php';
require '../../../functions/func_search.php';
require '../../../functions/func_lab.php';
session_start();

//recieving post vairable from multiple search form//request_code
 

@$patient_id = $_GET['patient_id']; 

@$request_code = $_GET['lab_code'];

 

if(isset($request_code) && !empty($request_code)){
	
	 
 
    update_notification_doctors_lab_view($patient_id,$request_code);

	
}  


echo "<script language='javascript'>window.location='p_v_r?lab_code=$request_code&patient_id=$patient_id'</script>";


//header("Location: ../conduct_test");
?>