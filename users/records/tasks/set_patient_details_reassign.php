<?php 


//this file sets the patient details to be used by the records user in his/her module
//it calls two functions from the records functions file
//function 1 gets the right person by using the submited form data and
//function 2 uses the result of function to set the patient details 
require '../../../functions/conndb.php';
require '../../../functions/func_search.php';
require '../../../functions/func_common.php';

session_start();


global $payment_before_consulation;



$payment_before_consulation = '';
//recieving post vairable from multiple search form
//TO-CASHIER


$search = $_GET['patient_id'];
 

$filtered_search = search_pat_info($search);

get_pat_details($filtered_search);




get_patient_assign_consultation($search);



   // $payment_before_consulation = 0;


$doctor = get_staff_info($_SESSION['doctor_id']);

$_SESSION['doctor_fullname'] = " Dr. ".$doctor['firstName']." ".$doctor['otherNames']."";

header("Location: ../patient_reassignment");

 





 



?>