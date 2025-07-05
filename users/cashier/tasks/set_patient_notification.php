<?php 
//this file sets the patient details to be used by the records user in his/her module
//it calls two functions from the records functions file
//function 1 gets the right person by using the submited form data and
//function 2 uses the result of function to set the patient details 
require '../../../functions/conndb.php';
require '../../../functions/func_search.php';
require '../../../functions/func_cashier.php';
session_start();

//recieving post vairable from multiple search form//

$search = $_GET['patient_id'];

//$test_names = $_GET['test_names'];

$request_code = $_GET['request_code'];

$flag = $_GET['flag'];
$_SESSION['flag'] = $flag;
$_SESSION['request_code'] = $request_code;

 $filtered_search = search_pat_info($search);

 get_pat_details($filtered_search);


//Get patient_id session from the function above
 $patient_id = $_SESSION['patient_id'];
$date = date('Y-m-d');

$stuff_id = @$_SESSION['uid'];


 
 

if(!empty($flag)&&isset($flag)&&$flag=="REVERSE"){

    update_notification_reverse($search,$request_code);

    investigation_payment_status($search,$stuff_id,$request_code);
}

   



//Session details
//$_SESSION['request_code'] = 
//$_SESSION['amount'] = $payment['total_cost'];
//$_SESSION['transcode'] = $payment['transcode'];
 //$_SESSION['state'] = $payment['state'];
 //unset($_SESSION['showPrintBtn']);


header("Location: ../pendingPayment");

?>