<?php 
@session_start();

 require_once '../../../functions/conndb.php';
 require_once '../../../functions/func_search.php';
 require_once '../../../functions/func_consulting.php';


$staff_id = $_SESSION['uid'];


//recieving post vairable from multiple search form



if (isset($_POST['Defined_Period_Options'])) {
    $period_report = $_POST['period_report']; 
    $category = $_POST['category']; 

    $_SESSION['period_report'] = $period_report; 

    $_SESSION['category'] = $category; 


    search_cashier_payment_period_option($staff_id,$period_report);

    search_cashier_payment_period_option_investigation($staff_id,$period_report);

    search_cashier_drugs_dispensed_payment_period_option($staff_id,$period_report);

 


    $_SESSION['current_active_tab'] = 1; 

  header("Location: ../cashier_report");

}




if (isset($_POST['Date_Range_Option'])) {
  $start_date_cash = $_POST['start_date_cash'];
  $end_date_cash = $_POST['end_date_cash']; 


  $_SESSION['start_date_cash'] = $start_date_cash;
  $_SESSION['end_date_cash'] = $end_date_cash; 


search_cashier_payment_range_option($staff_id,$start_date_cash,$end_date_cash);
search_cashier_payment_range_option_invest($staff_id,$start_date_cash,$end_date_cash);
search_cashier_payment_range_option_drg($staff_id,$start_date_cash,$end_date_cash);


  $_SESSION['current_active_tab'] = 2;
  
  //window.open('../../reporting/consulting_patients?cnno=".$cnno."&copies=".$nocopy."', '_blank')
//   echo "<script type=\"text/javascript\">
//  window.open('../../reporting/consulting_patients', '_blank')
//   </script>";//Print_Patient_Diagnosis_Report

header("Location: ../cashier_report");

}





?>