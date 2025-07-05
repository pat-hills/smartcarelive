<?php 
@session_start();

 require_once '../../../functions/conndb.php';
 require_once '../../../functions/func_search.php';
 require_once '../../../functions/func_consulting.php';


$staff_id = $_SESSION['uid'];


//recieving post vairable from multiple search form



if (isset($_POST['Print_Patient_Consulting_Report'])) {
    $start_date_patient_consulting_report = $_POST['start_date_patient_consulting_report'];
    $end_date_patient_consulting_report = $_POST['end_date_patient_consulting_report'];
    $gender_patient_consulting_report = $_POST['gender_patient_consulting_report'];


    $_SESSION['Start_date'] = $start_date_patient_consulting_report;
    $_SESSION['End_date'] = $end_date_patient_consulting_report;
    $_SESSION['gender'] = $gender_patient_consulting_report;


    search_consulting_patient_reports($staff_id,$start_date_patient_consulting_report,$end_date_patient_consulting_report,$gender_patient_consulting_report);


    $_SESSION['current_active_tab'] = 1;
    
    //window.open('../../reporting/consulting_patients?cnno=".$cnno."&copies=".$nocopy."', '_blank')
  //   echo "<script type=\"text/javascript\">
  //  window.open('../../reporting/consulting_patients', '_blank')
  //   </script>";

  header("Location: ../medical_reporting");

}




if (isset($_POST['Print_Patient_Complains_Report'])) {
  $start_date_complains_report = $_POST['start_date_complains_report'];
  $end_date_complains_report = $_POST['end_date_complains_report'];
  $select_complains_report = $_POST['select_complains_report'];
  $gender_complains_report = $_POST['gender_complains_report'];


  $_SESSION['start_date_complains_report'] = $start_date_complains_report;
  $_SESSION['end_date_complains_report'] = $end_date_complains_report;
  $_SESSION['select_complains_report'] = $select_complains_report;
  $_SESSION['gender_complains_report'] = $gender_complains_report;


  search_complains_reports($staff_id,$start_date_complains_report,$end_date_complains_report,$select_complains_report,$gender_complains_report);


  $_SESSION['current_active_tab'] = 2;
  
  //window.open('../../reporting/consulting_patients?cnno=".$cnno."&copies=".$nocopy."', '_blank')
//   echo "<script type=\"text/javascript\">
//  window.open('../../reporting/consulting_patients', '_blank')
//   </script>";//Print_Patient_Diagnosis_Report

header("Location: ../medical_reporting");

}





if (isset($_POST['Print_Patient_Diagnosis_Report'])) {
  //end_age_report
  $start_date_diagnosis_report = $_POST['start_date_diagnosis_report'];
  $end_date_diagnosis_report = $_POST['end_date_diagnosis_report'];
  $select_diagnosis_report = $_POST['select_diagnosis_report'];
  $start_age_report = $_POST['start_age_report'];
  $end_age_report = $_POST['end_age_report'];
  $gender_diagnosis_report = $_POST['gender_diagnosis_report'];


  $_SESSION['start_date_diagnosis_report'] = $start_date_diagnosis_report;
  $_SESSION['end_date_diagnosis_report'] = $end_date_diagnosis_report;
  $_SESSION['select_diagnosis_report'] = $select_diagnosis_report;
  $_SESSION['start_age_report'] = $start_age_report;
  $_SESSION['end_age_report'] = $end_age_report;
  $_SESSION['gender_diagnosis_report'] = $gender_diagnosis_report; 


  search_diagnosis_reports($staff_id,$start_date_diagnosis_report,$end_date_diagnosis_report,$start_age_report,$end_age_report,$select_diagnosis_report,$gender_diagnosis_report);

 //search_diagnosis_reports($staff_id,$gender_diagnosis_report);
  $_SESSION['current_active_tab'] = 3;
  
  //window.open('../../reporting/consulting_patients?cnno=".$cnno."&copies=".$nocopy."', '_blank')
//   echo "<script type=\"text/javascript\">
//  window.open('../../reporting/consulting_patients', '_blank')
//   </script>";//Print_Patient_Diagnosis_Report

header("Location: ../medical_reporting");

}





if (isset($_POST['Print_Patient_Medical_History_Report'])) {
  $start_date_medical_history_report = $_POST['start_date_medical_history_report'];
  $end_date_medical_history_report = $_POST['end_date_medical_history_report'];
  $gender_medical_history_report = $_POST['gender_medical_history_report']; 
  $category_medical_history_report = $_POST['category_medical_history_report']; 


  $_SESSION['start_date_medical_history_report'] = $start_date_medical_history_report;
  $_SESSION['end_date_medical_history_report'] = $end_date_medical_history_report;
  $_SESSION['gender_medical_history_report'] = $gender_medical_history_report; 
  $_SESSION['category_medical_history_report'] = $category_medical_history_report; 


  search_medical_history_reports($staff_id,$start_date_medical_history_report,$end_date_medical_history_report,$category_medical_history_report,$gender_medical_history_report);

 


  $_SESSION['current_active_tab'] = 4;
  
  //window.open('../../reporting/consulting_patients?cnno=".$cnno."&copies=".$nocopy."', '_blank')
//   echo "<script type=\"text/javascript\">
//  window.open('../../reporting/consulting_patients', '_blank')
//   </script>";//Print_Patient_Diagnosis_Report

header("Location: ../medical_reporting");

}









?>