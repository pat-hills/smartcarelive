<?php

    require '../../../functions/conndb.php';
    require '../../../functions/func_lab.php';
    session_start(); 
    

    if(isset($_SESSION['patient_id'])){
        $patient_id = $_SESSION['patient_id'];
    }
    if(isset($_SESSION['request_code'])){
        $request_code = $_SESSION['request_code'];
    }
   
    $lab_staff_id = $_SESSION['uid'];
    $hb = $_POST['hb'];
    $sickling = $_POST['sickling'];
    $pcv = $_POST['pcv'];
    $retics = $_POST['retics'];
    $t_wbc_count = $_POST['t_wbc_count'];
    $hb_electrophoresis = $_POST['hb_electrophoresis'];
    $neutrophils = $_POST['neutrophils'];
    $esr = $_POST['esr'];
    $lymphocytes = $_POST['lymphocytes'];
    $g6pd = $_POST['g6pd'];
    $monocytes = $_POST['monocytes'];
    $blood_group = $_POST['blood_group'];
    $eosinophils = $_POST['eosinophils'];
    $fbs = $_POST['fbs'];
    $malaria_parasites = $_POST['malaria_parasites'];
    $basophils = $_POST['basophils'];
    $mid_hash = $_POST['mid_hash'];
    $mid_percent = $_POST['mid_percent'];
    $rbs = $_POST['rbs'];

    if(empty($hb)||empty($sickling)||empty($pcv)||empty($retics)||empty($t_wbc_count)||empty($hb_electrophoresis)||empty($neutrophils)||empty($esr)
    ||empty($lymphocytes)||empty($g6pd)||empty($monocytes)||empty($blood_group)||empty($eosinophils)||empty($fbs)||empty($malaria_parasites)||empty($basophils)
    ||empty($mid_hash)||empty($mid_percent)||empty($rbs)){
        echo "Parameters cannot be empty. Thank you";
    }else{

//https://stackoverflow.com/questions/33591662/form-submission-using-jquery-confirm


    if(!isset($request_code) && !isset($patient_id)){

        echo "Sorry Failed To Process Medical Test Results";

    }elseif(check_patient_monitor_lab_request_code($patient_id,$request_code)){

        echo "Patient Request Exist And Processed! Please View Results To Verify. Thank You.";

    }
    else{

        $inserted = insert_haematology($request_code, $patient_id, $lab_staff_id, $hb, $pcv, $t_wbc_count, $neutrophils, $lymphocytes, $monocytes,
        $eosinophils, $malaria_parasites, $basophils, $mid_hash, $mid_percent, $sickling, $retics, $hb_electrophoresis, $esr, $g6pd, $blood_group, $fbs, $rbs);

if($inserted){
echo "Haematology results has been recorded succesfully";

}else {
echo " Sorry Haematology results could not be recorded";
}

    }
    
    
}
    
    
