<?php

    require '../../functions/conndb.php';
    require '../../functions/func_admin.php';
    require '../../functions/func_common.php';
    session_start(); 
    
    
    $user_id = generate_staff_id();
    $user_type = $_POST['user_type'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $confirm_password = md5($_POST['confirm_password']);
    $firstname = $_POST['firstname'];
    $othernames = $_POST['othernames'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
  //  $occupation = $_POST['occupation'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    if($user_type == 1){
        $occupation = "Admin";
    }elseif($user_type == 2){
        $occupation = "Doctor Of Consulting";
    }elseif($user_type == 3){
        $occupation = "OPD / Records";
    }elseif($user_type == 4){
        $occupation = "Cashier";
    }elseif ($user_type == 5){
        $occupation = "Records";
    }elseif($user_type == 6){
        $occupation = "Pharmacy";
    }elseif($user_type == 7){
        $occupation = "Lab";

    }elseif($user_type == 9){
        $occupation = "Accounts";

    }
    else{
        $occupation = "Insuarance";
    }

    $check_staff_phone_number = check_staff_phone_number($phone_number);

    $check_staff_user_name = check_staff_user_name($username);

   // $check_staff_email = check_staff_email($email);

    if(!$check_staff_phone_number && !$check_staff_user_name){

        $inserted = create_staff_account($user_id, $user_type, $username, $password, $firstname, $othernames, $gender, $dob, $occupation, $phone_number, $email, $address);
    
        if($inserted){ 
            create_dir($user_id);
            $_SESSION['successMsg'] = "Staff '".$firstname. "'s account has been created successfully";        
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }else {
           
            $_SESSION['errorMsg'] = "Sorry account could not be created";
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }

    }else{

        $_SESSION['successMsg'] = "Duplicate entry of '".$phone_number. "' or '".$username. "' or '".$email. "' already exist!";        
        header("Location: " . $_SERVER['HTTP_REFERER']);

    }
    
  
    
    function create_dir($staff_id){
    
    
        $current_dir = dirname(__FILE__);
        $staffs_folder = $current_dir . '../../../staff/';
        
        $structure = '';
        if(file_exists($staffs_folder)){
            //mkdir($current_dir . '../../staff/' . $staff_id .'/');
            $staff_folder = $staffs_folder . $staff_id .'/';
            mkdir($staff_folder);   
            
        }
   
    }