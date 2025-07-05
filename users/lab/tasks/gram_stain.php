<?php

    require '../../../functions/conndb.php';
    require '../../../functions/func_lab.php';
    session_start(); 
    
    $patient_id = $_SESSION['patient_id'];
    $request_code = $_SESSION['request_code'];
    $lab_staff_id =  $_SESSION['uid'];
    $gs_pus_cells = $_POST['gs_pus_cells'];
    $gs_ec = $_POST['gs_ec'];
    $gs_rbc = $_POST['gs_rbc'];
    $gs_organism_one = $_POST['gs_organism_one'];
    $gs_organism_two = $_POST['gs_organism_two'];
    
    $inserted = insert_gram_stain($request_code, $patient_id, $lab_staff_id, $gs_pus_cells, $gs_ec, $gs_rbc, $gs_organism_one, $gs_organism_two);
    
    if($inserted){
        echo "Gram Stain results has been inserted succesfully";
    }else {
        echo "Sorry Gram Stain results could not be inserted";
    }
    
    
