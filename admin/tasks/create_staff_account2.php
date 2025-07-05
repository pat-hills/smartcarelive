<?php

    require '../../functions/conndb.php';
    require '../../functions/func_admin.php';
    //session_start(); 
    $staff_id ='2';
    $current_dir = dirname(__FILE__);
    $staffs_folder = $current_dir . '../../../staff/';
    
    $structure = '';
    if(file_exists($staffs_folder)){
        //mkdir($current_dir . '../../staff/' . $staff_id .'/');
        $staff_folder = $staffs_folder . $staff_id .'/';
        mkdir($staff_folder);   
        
    }