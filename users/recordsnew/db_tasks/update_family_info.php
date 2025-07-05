<?php

    require_once '../../../functions/conndb.php';
    require_once '../../../functions/func_records.php';
    session_start(); 
   

    if( isset($_POST['update_family_info']) ){
        
        $patient_id = $_SESSION['patient_id'];
        $fullname = $_POST['fullname'];
        $sex = $_POST['gender'];
        $address = $_POST['f_address'];
        $relationship = $_POST['f_relation'];
        $blood_group = $_POST['blood_group'];
        $phone = $_POST['phone'];
        //$dob = $_POST['f_dob'];
        
        
        $updated = update_family_info($patient_id, $fullname, $sex, $address, $relationship, $blood_group, $phone);   
       if($updated){
        //echo "Staff '".$firstname. "''/s account has been updated successfully";
            $_SESSION['successMsg'] = "Patient's Family info has been updated successfully";  
               
            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            $_SESSION['errorMsg'] = "Sorry Patient's Family info  could not be updated";
            
            //echo "Sorry account could not be updated";
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
    
    }
    
    