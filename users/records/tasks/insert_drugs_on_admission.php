<?php

require '../../../functions/conndb.php';
require '../../../functions/func_opd.php';
require '../../../functions/func_constant.php';
//require '../../../functions/func_common.php';

session_start();

if (isset($_POST['add'])) {

    $height = "";
    $bmi = "";
    @$patient_id = $_SESSION['patient_id'];
    $drug = $_POST['drug'];   

    $comments = $_POST['comments'];

    $quantity = $_POST['quantity'];
 
    $taken_by = $_SESSION['uid']; //opd staff here

    $date_time_admitted = $_SESSION['date_admitted'];

    
   
    if (!empty($patient_id)) {
     
        $insert = insert_drugs_on_admission($drug,$patient_id,$taken_by,$quantity,$comments,$date_time_admitted);
      
        if ($insert == TRUE) {
 
            

            $fullname = $_SESSION['surname']." ".$_SESSION['other_names'];

            //echo $_SERVER['HTTP_REFERER'];
            $_SESSION['err_msg_admission'] = "<div class='alert alert-info alert-white rounded'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                <div class='icon'><i class='fa fa-times-circle'></i></div>
                <strong> $fullname Drugs Given! </strong> 
               </div>";
            header("Location: ../admission_monitoring"); 
          //  header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            $_SESSION['err_msg_admission'] = "<div class='alert alert-warning alert-white rounded'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                  <div class='icon'><i class='fa fa-check'></i></div>
                  <strong>Failed To Give Patient Drugs</strong>
                 </div>";
            //header("Location: ../consult.php");
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
    } else {

        $_SESSION['err_msg_admission'] = "<div class='alert alert-danger alert-white rounded'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                  <div class='icon'><i class='fa fa-check'></i></div>
                  <strong>Patient's ID not selected </strong>
                 </div>";
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}

////////////////////////////////////////////////////////////////////////////////

 

 