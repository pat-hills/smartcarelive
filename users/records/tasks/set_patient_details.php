<?php 
// //this file sets the patient details to be used by the records user in his/her module
// //it calls two functions from the records functions file
// //function 1 gets the right person by using the submited form data and
// //function 2 uses the result of function to set the patient details 
require '../../../functions/conndb.php';
require '../../../functions/func_search.php';
 session_start();

 

// //recieving post vairable from multiple search form

$search = $_GET['id'];

$date_admitted = $_GET['date_admitted'];

$admitted_by = $_GET['admitted_by'];

$_SESSION['admitted_by'] = $admitted_by;

$_SESSION['date_admitted'] = $date_admitted;

$filtered_search = search_pat_info($search);

get_pat_details($filtered_search);



// $validate_patient_on_search_consultation = check_patient_in_consultation_record($_SESSION['patient_id']);

// if($validate_patient_on_search_consultation){



//     $_SESSION['indicator'] = 0;

//     $status_check = check_patient_payment_before_vitals($_SESSION['patient_id']);
    
//     if($status_check == TRUE){
//         $message = "Paid Consultation";
//         $_SESSION['message'] = $message;
//     }else{
//         $message = "Payment Pending";
//         $_SESSION['message'] = $message;
//     }
    
//     header("Location: ../add_biovitals");

// }else{


//     $_SESSION['indicator'] = 5;

 
//     //header("Location: ../add_biovitals.php");
//         header("Location: ../to_cashier_before_vitals");

// }


header("Location: ../admission_monitoring");

?>