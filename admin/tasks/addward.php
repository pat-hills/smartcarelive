<?php

    require '../../functions/conndb.php';
    require '../../functions/func_admin.php';
    require '../../functions/func_common.php';
    session_start(); 
    
    $activity = "Setup Ward To Hospital Records";
    $useraccess = "Login Page Url:/admin/add_ward/";
    require '../../functions/logging.php';


    if(isset($_POST['add_complain'])){
        //currentbeds
       
        $nameward = $_POST['nameward'];
        $nameward = strtoupper($nameward);
        $gender = $_POST['gender'];
        $service_department = $_POST['service_department'];
        $bedcapacity = $_POST['bedcapacity'];
        $currentbeds = $_POST['currentbeds'];
        $added_by = $_SESSION['uid'];
        $date_added = date('Y-m-d H:i:s');
        
        

        $inserted = add_ward($nameward,$gender,$service_department,$bedcapacity, $currentbeds, $added_by);
    
        if($inserted){
           $url = explode('?', $_SERVER['HTTP_REFERER']);
        header('Location:' . $url[0] . '?a=7');
        } else {
           $url = explode('?', $_SERVER['HTTP_REFERER']);
        header('Location:' . $url[0] . '?a=8');
        }
    } 

