<?php

    require '../../../functions/conndb.php';
    require '../../../functions/func_lab.php';
    session_start(); 
    
    $patient_id = $_SESSION['patient_id'];
    $request_code = $_SESSION['request_code'];
    $lab_staff_id = $_SESSION['uid'];
    $remarks= $_POST['remarks'];
   
    $inserted = insert_skin_snip($request_code, $patient_id, $lab_staff_id, $remarks);
    
    if($inserted){
        echo "Skin snip Test results has been inserted succesfully";
        
    }else {
        echo "Sorry Skin snip Test results could not be inserted";
    }
    
    
