<?php

    require '../../../functions/conndb.php';
    require '../../../functions/func_lab.php';
    session_start(); 
    
    $patient_id = $_SESSION['patient_id'];
    $request_code = $_SESSION['request_code'];
    $lab_staff_id = $_SESSION['uid'];
    $s_typhi_o = $_POST['s_typhi_o'];
    $s_typhi_h = $_POST['s_typhi_h'];
    $comment = $_POST['comment'];
    
    $inserted = insert_widal_test($request_code, $patient_id, $lab_staff_id, $s_typhi_o, $s_typhi_h, $comment);
    
    if($inserted){
        echo "Widal Test results has been inserted succesfully";
        
    }else {
        echo "Sorry Widal Test results could not be inserted";
    }
    
    
