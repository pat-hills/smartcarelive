<?php

require '../../../functions/conndb.php';
require '../../../functions/func_opd.php';

session_start();

if (isset($_POST['update'])) {

    @$patient_id = $_SESSION['patient_id'];
  
    $date = date('Y-m-d');
    $consulting_code = consulting_code();
    $service_code = service_code(); 

  
    $taken_by = $_SESSION['uid']; //opd staff here
   
   
    if (!empty($patient_id)) {

       // die($taken_by);
     
      //  $insert = update_vitals($vitalID, $patient_id, $weight, $height, $bmi, $blood_pressure, $temperature, $taken_by);
      //  $insert =  insert_bio_vitals($patient_id, $weight, $height, $bmi, $blood_pressure, $temperature, $taken_by);
        $go_cashier = go_cashier($consulting_code, $patient_id, $taken_by, $date); //function to insert patient details in consulting table
       // $go_cashier = go_cashier($consulting_code, $patient_id, $taken_by, $date); //function to insert patient details in consulting table
       
        // $services = insert_services($service_code, $patient_id, "out-patient", "all-inclusive", "Follow Up", $taken_by, $date);
        

 

        if ($go_cashier == TRUE) {

            $_SESSION['indicator'] = ""; 

            //echo $_SERVER['HTTP_REFERER'];
            $_SESSION['err_msg'] = "<div class='alert alert-info alert-white rounded'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                <div class='icon'><i class='fa fa-times-circle'></i></div>
                <strong> Patient Sent To Cashier For Consultation Payment</strong> 
               </div>";
           // header("Location: ../add_biovitals"); 
            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            $_SESSION['err_msg'] = "<div class='alert alert-warning alert-white rounded'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                  <div class='icon'><i class='fa fa-check'></i></div>
                  <strong>Sending To Cashier Failed!!!</strong>
                 </div>";
            //header("Location: ../consult.php");
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
    } else {

        $_SESSION['err_msg'] = "<div class='alert alert-danger alert-white rounded'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                  <div class='icon'><i class='fa fa-check'></i></div>
                  <strong>Patient's ID not selected </strong>
                 </div>";
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}

////////////////////////////////////////////////////////////////////////////////

 