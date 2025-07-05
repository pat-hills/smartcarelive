<?php

require '../../../functions/conndb.php';
require '../../../functions/func_opd.php';
require '../../../functions/func_constant.php';
//require '../../../functions/func_common.php';

session_start();

if (isset($_POST['update'])) {

    $height = "";
    $bmi = "";
    @$patient_id = $_SESSION['patient_id'];
    $weight = $_POST['weight'];
    $doctor_room = $_POST['doctor_room'];
    $exploded_data = explode("-",$doctor_room);
    $doc_tor_id = $exploded_data[0];
    $vitalID = $_POST['update'];
    $pulse = $_POST['pulse'];
    $spo2 = $_POST['spo2'];
    $respiration = $_POST['respiration'];
    $fbs = $_POST['fbs'];
    $rbs = $_POST['rbs'];
    $date = date('Y-m-d');
    $consulting_code = consulting_code();
    $service_code = service_code();

    
    $pressure_first = $_POST['pressure_first'];
    $pressure_second = $_POST['pressure_second'];
   // $_SESSION['service_code_vitals'] = $service_code;

   
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
     
        $insert = update_vitals($vitalID, $patient_id, $weight, $height, $bmi, $pressure_first,$pressure_second, $temperature,$pulse,$spo2,$respiration, $taken_by,$fbs,$rbs);
      //  $insert =  insert_bio_vitals($patient_id, $weight, $height, $bmi, $blood_pressure, $temperature, $taken_by);

      $check_patient_in_consult = check_patient_visit_consultation($patient_id);

      if(!$check_patient_in_consult){


        $consult = go_consult($consulting_code, $patient_id, $doctor_room,$doc_tor_id, $taken_by, $date); //function to insert patient details in consulting table

      }



        $services = insert_services($service_code, $patient_id, "out-patient", "all-inclusive", "Follow Up", $taken_by, $date);
        

 
//var_dump($insert);
        if ($insert == TRUE) {

            $_SESSION['message'] = "N/A";

            $_SESSION['indicator'] = 1; //use as indicator by mike
            $vitals = view_added_vitals($patient_id, $taken_by);
            $_SESSION['patient_id_vitals'] = $vitals['patient_id'];
            $_SESSION['weight'] = $vitals['weight'];
            $_SESSION['height'] = $vitals['height'];
            $_SESSION['bmi'] = $vitals['bmi'];
            $_SESSION['blood_pressure_top'] = $vitals['blood_pressure_top'];
            $_SESSION['blood_pressure_down'] = $vitals['blood_pressure_down'];
            $_SESSION['temperature'] = $vitals['temperature'];
            $_SESSION['pulse'] = $vitals['pulse'];
            $_SESSION['vitalID'] = $vitals['id'];

            $fullname = $_SESSION['surname']." ".$_SESSION['other_names'];

            //echo $_SERVER['HTTP_REFERER'];
            $_SESSION['err_msg'] = "<div class='alert alert-info alert-white rounded'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                <div class='icon'><i class='fa fa-times-circle'></i></div>
                <strong> $fullname Vitals Sent To Consulting Room! </strong> 
               </div>";
            header("Location: ../to_cashier_before_vitals"); 
          //  header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            $_SESSION['err_msg'] = "<div class='alert alert-warning alert-white rounded'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                  <div class='icon'><i class='fa fa-check'></i></div>
                  <strong>Failed To Update Patient Vitals</strong>
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

if (isset($_POST['add'])) {

    $height = "";
    $bmi = "";

    @$patient_id = $_SESSION['patient_id'];
    $weight = $_POST['weight'];
    
    $pressure_first = $_POST['pressure_first'];
    $pressure_second = $_POST['pressure_second'];
    $temperature = $_POST['temperature'];
    $pulse = $_POST['pulse'];
    $taken_by = $_SESSION['uid']; //opd staff here
    
    $spo2 = $_POST['spo2'];
    $respiration = $_POST['respiration'];
    $Fbs = $_POST['Fbs'];
    $Rbs = $_POST['Rbs'];


     if(IS_BMI == true) {
        $height = $_POST['height'];
        if ($height !== "") {
            $bmi = get_bmi($weight, $height);
        } else {
            $bmi = "";
        }

    } 



    if (!empty($patient_id)) {
        $vitalID = uniqid("VIT-"); 

        $check_patient_vitals_consultation = check_patient_vitals_consultation($patient_id);

        if(!$check_patient_vitals_consultation){

        $insert = insert_bio_vitals($patient_id, $weight, $height, $bmi, $pressure_first,$pressure_second, $temperature,$pulse,$spo2,$respiration, $taken_by,$Fbs,$Rbs);


        //var_dump($insert);
        if ($insert == 1) {

            $_SESSION['indicator'] = 1; //use as indicator by mike
            $vitals = view_added_vitals($patient_id, $taken_by);
            $_SESSION['patient_id_vitals'] = $vitals['patient_id'];
            $_SESSION['weight'] = $vitals['weight'];
            $_SESSION['height'] = $vitals['height'];
            $_SESSION['bmi'] = $vitals['bmi'];
            $_SESSION['vitalID'] = $vitals['id'];
            $_SESSION['blood_pressure_top'] = $vitals['blood_pressure_top'];
            $_SESSION['blood_pressure_down'] = $vitals['blood_pressure_down'];

            $_SESSION['temperature'] = $vitals['temperature'];
            $_SESSION['pulse'] = $vitals['pulse'];
            $_SESSION['s_p_0_2'] = $vitals['s_p_0_2'];
            $_SESSION['respiration'] = $vitals['respiration'];
            $_SESSION['fbs'] = $vitals['fbs'];
            $_SESSION['rbs'] = $vitals['rbs'];
            //echo $_SERVER['HTTP_REFERER'];
            $_SESSION['err_msg'] = "<div class='alert alert-info alert-white rounded'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                <div class='icon'><i class='fa fa-times-circle'></i></div>
                <strong> Patient's Vitals Taken, Please Confirm And Send To Consulting Room! </strong> 
               </div>";
            //header("Location: ../consult.php"); 
            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else if ($insert == 2) {
            $_SESSION['err_msg'] = "<div class='alert alert-warning alert-white rounded'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                  <div class='icon'><i class='fa fa-check'></i></div>
                  <strong>Patient's Bio Vitals has been taken already!</strong>
                 </div>";
            //header("Location: ../consult.php");
            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else if ($insert == 0) {
            $_SESSION['err_msg'] = "<div class='alert alert-danger alert-white rounded'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                  <div class='icon'><i class='fa fa-check'></i></div>
                  <strong>Patient's Bio Vitals was not inserted </strong>
                 </div>";
            //header("Location: ../consult.php");
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }

    }else{
        $_SESSION['err_msg'] = "<div class='alert alert-warning alert-white rounded'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                  <div class='icon'><i class='fa fa-check'></i></div>
                  <strong>Patient's Bio Vitals has been taken already!</strong>
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

 