<?php

    require_once '../../../functions/conndb.php';
    require_once '../../../functions/func_records.php';
    session_start(); 
   

    if( isset($_POST['update_personal_info']) ){
        
        $patient_id = $_SESSION['patient_id'];
        $surname = $_POST['surname'];
        $other_names = $_POST['other_names'];
        $sex = $_POST['sex'];
        $marital_stat = $_POST['marital_stat'];
        $occupation = $_POST['occupation'];
        $phone = $_POST['phone'];
        $dob = $_POST['dob'];
        $national_id = $_POST['national_id'];
        $address = $_POST['address'];
        //$membership_id = $_POST['membership_id'];
        
        
        $updated = update_personal_info($patient_id, $surname, $other_names, $sex, $marital_stat, $occupation, $phone, $address, $national_id, $dob);   
       if($updated){
        //echo "Staff '".$firstname. "''/s account has been updated successfully";
            $_SESSION['successMsg'] = "Patient's info has been updated successfully";  
               
            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            $_SESSION['errorMsg'] = "Sorry Patient's info  could not be updated";
            
            //echo "Sorry account could not be updated";
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
    
    }
    
    