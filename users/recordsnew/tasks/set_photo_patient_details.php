<?php 
//this file sets the patient details to be used by the records user in his/her module
//it calls two functions from the records functions file
//function 1 gets the right person by using the submitted form data and
//function 2 uses the result of function to set the patient's ID for upload
require_once '../../../functions/func_search.php';
require_once '../../../functions/conndb.php';
require_once '../../../functions/func_records.php';
session_start();
//recieving post vairable from multiple search form

$search = $_POST['get_details'];

$filtered_search = search_pat_info($search);

get_pat_details($filtered_search);

//get_patient_info($filtered_search);

//patient_family_info($filtered_search);

//patient_scheme_info($filtered_search);

header("Location: ../take_picture.php");

?>