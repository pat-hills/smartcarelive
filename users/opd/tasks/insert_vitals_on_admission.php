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
    $weight = $_POST['weight'];  
    $pulse = $_POST['pulse'];
    $spo2 = $_POST['s_p_0_2'];
    $respiration = $_POST['respiration'];
    $on_admission_status = $_POST['on_admission_status'];
    $fbs = $_POST['fbs'];
    $rbs = $_POST['rbs'];  

    $date_admitted = $_SESSION['date_admitted'] ;

    $comments = $_POST['comments'];

    
    $pressure_first = $_POST['pressure_first'];
    $pressure_second = $_POST['pressure_second']; 

   
    $temperature = $_POST['temperature'];
    $taken_by = $_SESSION['uid']; //opd staff here

    if(IS_BMI == true) {
        $height = $_POST['height'];
        if ($height !== "") {
            $bmi = get_bmi($weight, $height);
        } else {
            $bmi = "";
        }

    } 
   
    if (!empty($patient_id)) {
     
        $insert = insert_bio_vitals($patient_id, $weight, $height, $bmi, $pressure_first,$pressure_second, $temperature,$pulse,$spo2,$respiration, $taken_by,$fbs,$rbs,$on_admission_status,$comments,$date_admitted);
      
        if ($insert == TRUE) {
 
            

            $fullname = $_SESSION['surname']." ".$_SESSION['other_names'];

            //echo $_SERVER['HTTP_REFERER'];
            $_SESSION['err_msg_admission'] = "<div class='alert alert-info alert-white rounded'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                <div class='icon'><i class='fa fa-times-circle'></i></div>
               
                <strong> $fullname Vitals taken! </strong> 
               </div>";
            header("Location: ../admission_monitoring"); 
          //  header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            $_SESSION['err_msg_admission'] = "<div class='alert alert-warning alert-white rounded'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                  <div class='icon'><i class='fa fa-check'></i></div>
                  <strong>Failed To Take Patient Vitals</strong>
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

 

 