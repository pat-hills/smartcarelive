<?php


global $dignosis_response;
    require '../../functions/conndb.php';
    require '../../functions/func_admin.php';
    session_start(); 
    

    if(isset($_POST['add_diagnosis'])){
        
        $diagnosis = $_POST['diagnosis'];
        $added_by = $_SESSION['uid'];
        $date_added = date('Y-m-d H:i:s');
	///	$gdrg = $_POST['gdrg'];
		//$icd10 = $_POST['icd10'];
	//	$nhis = $_POST['nhis'];
	//	$tariffs = $_POST['tariffs'];
       
       $inserted = add_diagnosis($diagnosis, $added_by, $date_added);
    
        if($inserted){
            //echo "Staff '".$firstname. "''/s account has been updated successfully";
        $dignosis_response  = 6;
 
        } else {
            $dignosis_response  = 7;

        }
    }

    header('Location:' . "../add_diagnosis");
    



