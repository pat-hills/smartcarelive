<?php 
//this file sets the patient details to be used by the pharmacy user in his/her module
//it calls two functions from the records functions file
//function 1 gets the right person by using the submitted form data and
//function 2 uses the result of function to set the patient details 
require_once '../../../functions/func_search.php';
require_once '../../../functions/conndb.php';
session_start();
//recieving post vairable from multiple search form

$search = $_POST['get_details'];

$filtered_search = search_drug_info($search);
 $filtered_search;
get_drug_details($filtered_search);

header("Location: ../update_drug.php");

?>