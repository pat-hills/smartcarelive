<?php

    require_once '../../../functions/conndb.php';
    require_once '../../../functions/func_records.php';
    session_start(); 
    
    if( isset($_POST['update_scheme_info']) ){
        
        $patient_id = $_SESSION['patient_id'];
        $membership_id = $_POST['membership_id'];
        $serial_number = $_POST['serial_number'];
        $scheme = $_POST['scheme'];
        $sub_metro = $_POST['sub_metro'];
        
        
        $id_exists = select_patient_scheme_id($patient_id);

        if($id_exists){
            $updated = update_patient_scheme($patient_id, $membership_id, $serial_number, $scheme, $sub_metro);   
           if($updated){
            //echo "Staff '".$firstname. "''/s account has been updated successfully";
                $_SESSION['successMsg'] = "Scheme info has been updated successfully";  
                   
                header("Location: " . $_SERVER['HTTP_REFERER']);
                //header("Location: ../../update_patient.php");
            } else {
                $_SESSION['errorMsg'] = "Sorry Scheme info could not be updated";
                
                //echo "Sorry account could not be updated";
                header("Location: " . $_SERVER['HTTP_REFERER']);
                //header("Location: ../../update_patient.php");
            }
        } else {
            
            if(!empty($scheme)) {
                $inserted = insert_patient_scheme($patient_id, $membership_id, $serial_number, $scheme, $sub_metro); 
                if($inserted){
                //echo "Staff '".$firstname. "''/s account has been updated successfully";
                    $_SESSION['successMsg'] = "Scheme info has been updated successfully";  
                       
                    header("Location: " . $_SERVER['HTTP_REFERER']);
                } else {
                    $_SESSION['errorMsg'] = "Sorry Scheme info could not be updated";
                    
                    //echo "Sorry account could not be updated";
                    header("Location: " . $_SERVER['HTTP_REFERER']);
                }
            } else {
                    $_SESSION['errorMsg'] = "Sorry Scheme info could not be updated, Please Select or Specify a scheme";
                    
                    //echo "Sorry account could not be updated";
                    header("Location: " . $_SERVER['HTTP_REFERER']);
                }

            
        }
    }
    
    