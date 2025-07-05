<?php

    require '../../../functions/conndb.php';
    require '../../../functions/func_lab.php';
    session_start(); 
    
    $patient_id = $_SESSION['patient_id'];
    $request_code = $_SESSION['request_code'];
    $lab_staff_id = "Try";
    $hvs_pus_cells = $_POST['hvs_pus_cells'];
    $hvs_ec = $_POST['hvs_ec'];
    $hvs_rbc = $_POST['hvs_rbc'];
    $hvs_organism_one = $_POST['hvs_organism_one'];
    $hvs_organism_two = $_POST['hvs_organism_two'];
    
    $inserted = insert_hvs_wet_prep($request_code, $patient_id, $lab_staff_id, $hvs_pus_cells, $hvs_ec, $hvs_rbc, $hvs_organism_one, $hvs_organism_two);
    
    if($inserted){
        echo "HVS(WET PREP) results has been inserted succesfully";
        
    }else {
        echo " Sorry HVS(WET PREP) results could not be inserted";
    }
    
    
