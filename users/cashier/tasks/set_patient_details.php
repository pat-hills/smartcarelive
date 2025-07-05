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


//This function call gets all lab request details

$payment = getPatPayDetails($patient_id,$date);

////////////////////////////////////////////////////////////////

if(!empty($search) && empty($request_code)){

    update_notification_waiting_consulting_patients_from_opd($search);
    }

if(!empty($flag)&&isset($flag)&&$flag=="DOCTOR_TO_CASH"){

    update_notification_waiting_patients_cashier_view($search,$request_code);
}

if(!empty($flag)&& isset($flag)&&$flag=="PHARMA_TO_CASH"){

    update_notification_waiting_patients_drug2depenseinfo($search);
}   



//Session details
//$_SESSION['request_code'] = 
$_SESSION['amount'] = $payment['total_cost'];
$_SESSION['transcode'] = $payment['transcode'];
 $_SESSION['state'] = $payment['state'];
 unset($_SESSION['showPrintBtn']);


header("Location: ../add_payment");

?>