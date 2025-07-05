<?php

    require '../../../functions/conndb.php';
    require '../../../functions/func_lab.php';
    session_start(); 
    
    $patient_id = $_SESSION['patient_id'];
    $request_code = $_SESSION['request_code'];
    $lab_staff_id = $_SESSION['uid'];
    $appearance = $_POST['appearance'];
    $colour = $_POST['colour'];
    $specific_gravity = $_POST['specific_gravity'];
    $ph = $_POST['ph'];
    $protein = $_POST['protein'];
    $glucose = $_POST['glucose'];
    $ketones = $_POST['ketones'];
    $blood = $_POST['blood'];
    $nitrite = $_POST['nitrite'];
    $bilirubin = $_POST['bilirubin'];
    $urobilinogen = $_POST['urobilinogen'];
    
   
    $inserted = insert_urine_re($request_code, $patient_id, $lab_staff_id, $appearance, $colour, $specific_gravity, $ph, $protein, $glucose,
                                            $ketones, $blood, $nitrite, $bilirubin, $urobilinogen);
    
    if($inserted){
        echo "Urine R/E results has been inserted succesfully";
        
    }else {
        echo " Sorry Urine R/E results could not be inserted";
    }
    
    
