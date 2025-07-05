<?php

session_start(); 

    require '../../../functions/conndb.php';
    require '../../../functions/func_accounts.php'; 
   
    
    
    if(isset($_POST['add_acc'])){
        
       
        $item_name = strtoupper($_POST['item']);
        $amt = strtoupper($_POST['amt']);

        

        
        $inserted = add_recordings($item_name,$amt);
    
        if($inserted){
            //echo "Staff '".$firstname. "''/s account has been updated successfully";
            $_SESSION['successMsg'] = "Expense amount added successfully";        
           header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            $_SESSION['errorMsg'] = "Expense amount could not be added";
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
    }