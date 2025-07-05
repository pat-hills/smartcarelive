<?php

    require '../../../functions/conndb.php';
    require '../../../functions/func_lab.php';
    session_start(); 
    
    //$patient_id = $_SESSION['patient_id'];
   // $request_code = $_SESSION['request_code'];


    if(isset($_SESSION['patient_id'])){
        $patient_id = $_SESSION['patient_id'];
    }
    if(isset($_SESSION['request_code'])){
        $request_code = $_SESSION['request_code'];
    }


    
    $lab_staff_id = $_SESSION['uid'];
    $status = $_POST['status'];
    $processed_date = date('Y-m-d');


    if(!isset($request_code) && !isset($patient_id)){

        echo "Sorry Failed To Submit Medical Results";

    }elseif(check_if_lab_results_is_submitted($patient_id,$request_code,$status,$lab_staff_id)){

        echo "Have already submitted lab results with code, ".$request_code." and patient ID ".$patient_id;

    }
    else{
    
    $submitted = send_lab_results($patient_id, $request_code, $lab_staff_id, $status, $processed_date);
    
    if($submitted){

        $_SESSION['PAS'] = "Processed And Sent";
        $_SESSION['PAT_ID'] = $patient_id;
        $_SESSION['PROCESSED_DATE'] = $processed_date;
        echo $patient_id.", ". "Lab Results has been submitted successfully";
        
    }else {
        $_SESSION['PAS'] = "Failed To Process And Send Lab Results";
        echo "Sorry Lab Results not processed or sent!";
    }

   // header("Location: ../lab_test.php");
    
}
