<?php

    require '../../../functions/conndb.php';
    require '../../../functions/func_lab.php';
    session_start(); 
    
    $patient_id = $_SESSION['patient_id'];
    //$patient_id = "try"; $request_code = $_SESSION['request_code'];
    //$request_code = "Try";
    $request_code = $_SESSION['request_code'];
    $lab_staff_id = "Try";
    
    if( isset($_FILES["pink_slip"]) && $_FILES["pink_slip"]["error"] == UPLOAD_ERR_OK){
        
      
        //$dir = dirname(__FILE__) . "/../../../patients/try/";
        
        //echo $upload_directory = $dir;
        
        $upload_directory = dirname(__FILE__) . patient_folder($patient_id);
        
        //echo is_dir($dir);
        //echo file_exists($dir);
            
        //check if this is an ajax request
        if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
            die();
        }
        
        //Is file size less than allowed size
        if($_FILES["pink_slip"]["size"] > 5242880){
            die("File size is too big");
        }
        
        //allowed file type Server side check
        switch(strtolower($_FILES['pink_slip']['type']))
        {
            //allowed file types
            case 'image/png': 
            case 'image/gif': 
            case 'image/jpeg': 
            case 'image/pjpeg':
            case 'application/pdf': 
            break;
            default:
            die('Unsupported File!'); //output error
        }
        
        echo $file_name = $_FILES['pink_slip']['name'];
        echo $file_ext = substr($file_name, strrpos($file_name, '.')); //get file extention
        $rand_num = rand(0, 9999999999);
        //echo $new_file_name =  $patient_id. $rand_num . $file_ext;
		$new_file_name =  date('Y-m-d') . $file_ext;
        
        if(move_uploaded_file($_FILES['pink_slip']['tmp_name'], $upload_directory . $new_file_name)){
            die('Success! File Uploaded');
        } else {
            die('error uploading File');   
        }
        
    } else {
        die('Something wrong with upload! Is "upload_max_filesize" set correctly?');
    }
    
    
   
    
    
    
    
