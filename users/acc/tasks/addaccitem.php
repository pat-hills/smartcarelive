<?php

session_start(); 

    require '../../../functions/conndb.php';
    require '../../../functions/func_accounts.php'; 
   
    
    
    if(isset($_POST['add_acc'])){
        
       
        $item_name = strtoupper($_POST['item_name']);

        

        
        $inserted = add_expenses_items($item_name);
    
        if($inserted){
            //echo "Staff '".$firstname. "''/s account has been updated successfully";
            $_SESSION['successMsg'] = "Expense item added successfully";        
           header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            $_SESSION['errorMsg'] = "Expense item could not be added";
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
    }