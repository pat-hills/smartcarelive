<?php

    require '../../functions/conndb.php';
    require '../../functions/func_admin.php';
    require '../../functions/func_common.php';
    session_start(); 
    

    if(isset($_POST['add_complain'])){
        
        $complain = $_POST['complain'];
        $complain_category = $_POST['complain_category'];
        $r_code = $_POST['r_code'];
        $added_by = $_SESSION['uid'];
        $date_added = date('Y-m-d H:i:s');
        
        

        $inserted = add_complain($complain_category,$complain,$r_code, $added_by, $date_added);
    
        if($inserted){
           $url = explode('?', $_SERVER['HTTP_REFERER']);
        header('Location:' . $url[0] . '?a=7');
        } else {
           $url = explode('?', $_SERVER['HTTP_REFERER']);
        header('Location:' . $url[0] . '?a=8');
        }
    } 

