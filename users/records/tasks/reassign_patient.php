<?php

require '../../../functions/conndb.php';
require '../../../functions/func_opd.php';
require '../../../functions/func_constant.php';
require '../../../functions/func_common.php';

session_start();

if (isset($_POST['update'])) {

    $height = "";
    $bmi = "";
    @$patient_id = $_SESSION['patient_id']; 
    $doctor_room = $_POST['doctor_room'];
    $exploded_data = explode("-",$doctor_room);
    $doctor_id = $exploded_data[0];
    
    $date = date('Y-m-d'); 

    
   
    $taken_by = $_SESSION['uid']; //opd staff here

   
   
    if (!empty($patient_id)) {
     
        $insert = reassign_patient_consultation($patient_id, $doctor_room, $doctor_id, $taken_by); 
        

 
     //var_dump($insert);
         if ($insert == TRUE) {

            

            $fullname = $_SESSION['surname']." ".$_SESSION['other_names'];

            //echo $_SERVER['HTTP_REFERER'];
            $_SESSION['err_msg'] = "<div class='alert alert-info alert-white rounded'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                <div class='icon'><i class='fa fa-times-circle'></i></div>
                <strong> $fullname Reassigned To A New Doctor! </strong> 
               </div>";
            header("Location: ../to_cashier_before_vitals"); 
          //  header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            $_SESSION['err_msg'] = "<div class='alert alert-warning alert-white rounded'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                  <div class='icon'><i class='fa fa-check'></i></div>
                  <strong>Failed To Reassign Patient </strong>
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

 