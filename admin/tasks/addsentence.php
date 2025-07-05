<?php

    require '../../functions/conndb.php';
    require '../../functions/func_admin.php';
    session_start(); 
    

    if(isset($_POST['add_sentence'])){
        
        $sentence = $_POST['sentence'];
        $added_by = $_SESSION['uid'];
        $date_added = date('Y-m-d H:i:s');
       
        $inserted = add_sentence($sentence, $added_by, $date_added);
    
        if($inserted){
            //echo "Staff '".$firstname. "''/s account has been updated successfully";
            $_SESSION['successMsg'] = "Sentence added successfully";        
           header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            $_SESSION['errorMsg'] = "Sentence could not be added";
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
    } 

