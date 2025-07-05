<?php 


//this file sets the patient details to be used by the records user in his/her module
//it calls two functions from the records functions file
//function 1 gets the right person by using the submited form data and
//function 2 uses the result of function to set the patient details 
require '../../../functions/conndb.php';
require '../../../functions/func_search.php';
require '../../../functions/func_constant.php';

session_start();


global $payment_before_consulation;



$payment_before_consulation = '';
//recieving post vairable from multiple search form
//TO-CASHIER


$search = $_GET['patient_id'];
 

$filtered_search = search_pat_info($search);

get_pat_details($filtered_search);




if(PAYMENT_BEFORE_CONSULTATION == true){

    $validate_patient_on_consultation_payment = check_patient_in_consultationpayment_record($_SESSION['patient_id']);

    if($validate_patient_on_consultation_payment){

        $check_patient_status = check_patient_payment_before_vitals($search);

        if($check_patient_status){

            $message = "Paid Consultation";
            $_SESSION['message'] = $message;
          $payment_before_consulation = 1;

          update_notification_waiting_consulting_patients_from_cashier($search);

          
        header("Location: ../add_biovitals");

        }else{
            $message = "Payment-Pending";
            $_SESSION['message'] = $message;

            $_SESSION['indicator'] = 5;
            header("Location: ../to_cashier_before_vitals");

        }

        //$_SESSION['membership_id'] = $membership_id;
	//$_SESSION['scheme'] = $scheme; 
    }else if(isset($_SESSION['scheme']) && $_SESSION['scheme'] != null){
        $message = "Paid Consultation";
        $_SESSION['message'] = $message;
      $payment_before_consulation = 1;
       update_notification_waiting_consulting_patients_from_cashier($search);
      header("Location: ../add_biovitals");
    }
    else{
      $_SESSION['indicator'] = 5;

      $message = "";
      $_SESSION['message'] = $message;

      header("Location: ../to_cashier_before_vitals");


    }


}else{



    $payment_before_consulation = 0;

    header("Location: ../add_biovitals");

}





 



?>