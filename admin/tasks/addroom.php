<?php

    require '../../functions/conndb.php';
    require '../../functions/func_common.php';
    require '../../functions/func_admin.php';
    session_start(); 
    
    
    if(isset($_POST['add_room'])){
        
        $length = 3;
        $chars = 'abcdefghijklmnopqrstuvwxyz1234567890';
        $rand = random_str($length, $chars);
        $room_name = $_POST['room_name'];

        $room_id = "room_" . $rand;
        $date_created = date('Y-m-d H:i:s');

        
        $inserted = add_room($room_name,$room_id,$date_created);
    
        if($inserted){
            //echo "Staff '".$firstname. "''/s account has been updated successfully";
            $_SESSION['successMsg'] = "Consulting Room added successfully";        
           header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            $_SESSION['errorMsg'] = "Consulting Room could not be added";
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
    }