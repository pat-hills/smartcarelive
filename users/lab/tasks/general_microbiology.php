<?php

    require '../../../functions/conndb.php';
    require '../../../functions/func_lab.php';
    session_start(); 
    
    $patient_id = $_SESSION['patient_id'];
    $request_code = $_SESSION['request_code'];
    $lab_staff_id = $_SESSION['uid'];
    $pus_cells = $_POST['pus_cells'];
    $rbcs = $_POST['rbcs'];
    $epith_cells = $_POST['epith_cells'];
    $t_vaginalis = $_POST['t_vaginalis'];
    $bacteriodes = $_POST['bacteriodes'];
    $yeast_cells = $_POST['yeast_cells'];
    $s_h_masoni = $_POST['s_h_masoni'];
    $crystals = $_POST['crystals'];
    $casts = $_POST['casts'];
    $blood_filming = $_POST['blood_filming'];
    $hbsag = $_POST['hbsag'];
    $vdrl_kahn = $_POST['vdrl_kahn'];
    $urine_preg_test = $_POST['urine_preg_test'];
   
    
    
    $inserted = insert_general_microbiology($request_code, $patient_id, $lab_staff_id, $pus_cells, $rbcs, $epith_cells, $t_vaginalis, $bacteriodes, $yeast_cells,
                                            $s_h_masoni, $crystals, $casts, $blood_filming, $hbsag, $vdrl_kahn, $urine_preg_test);
    
    if($inserted){
        echo "General Microbiology results has been inserted succesfully";
        
    }else {
        echo " Sorry General Microbiology results could not be inserted";
    }
    
    
