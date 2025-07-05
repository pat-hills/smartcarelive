<?php
@session_start(); 

require '../../../functions/conndb.php';
require '../../../functions/func_opd.php';
//require '../../../functions/func_common.php';
require '../../../functions/func_constant.php';

if(isset($_POST['add'])) {
    

    $height = "";
    $bmi = "";
    
    
    @$patient_id = $_SESSION['patient_id'];
    $weight = $_POST['weight'];
   // $height = $_POST['height'];
    $blood_pressure_first = $_POST['pressure_first'];
    $blood_pressure_second = $_POST['pressure_second'];
    $temperature = $_POST['temperature'];
    $pulse = $_POST['pulse'];
    $s_p_0_2 = $_POST['s_p_0_2'];
    $respiration = $_POST['respiration'];
    $fbs = $_POST['fbs'];
    $rbs = $_POST['rbs'];
    $taken_by = $_SESSION['uid'];//opd staff here
    
    
    
    if(IS_BMI == true) {
        $height = $_POST['height'];
        if ($height !== "") {
            $bmi = get_bmi($weight, $height);
        } else {
            $bmi = "";
        }

    } 
    //getting doctors room by id
    $get_doctors_room_by_id =get_doctors_room_by_id($taken_by);

    //getting the status of consultation of patient
    $status_consultation = "";

   // $date_time_recorded =  date("Y-m-d");

    $check_patient_visit_consultation = check_patient_visit_consultation($patient_id);

    if($check_patient_visit_consultation){
        $status_consultation = 1;
    }else{
        $status_consultation = 0;
    }
    
    if(!empty($patient_id)){
       
       $update = update_bio_vitals($patient_id, $weight, $height, $bmi, $blood_pressure_first,$blood_pressure_second, $temperature,$pulse,$s_p_0_2,$respiration,$fbs,$rbs,$taken_by,$get_doctors_room_by_id,$status_consultation);
       
      if($update){
          
           //$vitals = view_added_vitals($patient_id,  $taken_by);
          // $_SESSION['weight'] = $vitals['weight'];
          // $_SESSION['height'] = $vitals['height'];
          // $_SESSION['bmi'] = $vitals['bmi'];
          // $_SESSION['blood_pressure_top'] = $vitals['blood_pressure_top'];
         //  $_SESSION['blood_pressure_down'] = $vitals['blood_pressure_down'];

         //   $_SESSION['temperature'] = $vitals['temperature'];
          //echo $_SERVER['HTTP_REFERER'];
           $_SESSION['ac_tab'] = 2;
          header("Location: " . $_SERVER['HTTP_REFERER']);
          
      // } 
    }
    else {
       $_SESSION['ac_tab'] = 2;
        header("Location: " . $_SERVER['HTTP_REFERER']);
        //echo $_SERVER['PHP_SELF'];
        //header("Location: " . $_SERVER['PHP_SELF']);
    }
    
    
}

}