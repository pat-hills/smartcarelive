<?php 
@session_start();

 require_once '../../../functions/conndb.php';
 require_once '../../../functions/func_nhis.php'; 


$staff_id = $_SESSION['uid'];


//recieving post vairable from multiple search form



if (isset($_POST['Print_Patient_Claims_Report'])) {
    $start_date_patient_claim_report = $_POST['start_date_patient_claim_report'];
    $end_date_patient_claim_report = $_POST['end_date_patient_claim_report'];
    $claim_provider = $_POST['claim_provider'];


    $_SESSION['Start_date'] = $start_date_patient_claim_report;
    $_SESSION['End_date'] = $end_date_patient_claim_report;
    $_SESSION['claim_provider'] = $claim_provider;


    generate_patients_claim_report($start_date_patient_claim_report,$end_date_patient_claim_report,$claim_provider);


  //  $_SESSION['current_active_tab'] = 1;
    


  header("Location: ../claims_report");

}










?>