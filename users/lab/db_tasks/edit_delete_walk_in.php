<?php
//this file receives the multiple investigation 
session_start();
require_once '../../../functions/conndb.php';
require_once '../../../functions/func_lab.php'; 

$activity = "Deleted/Edit Lab Walk In Patient";
$useraccess = "Page Url:/users/labs/walk_in_labs";
require_once '../../../functions/logging.php';

 
$fullname = $_POST['fullname'];
$walk_in_code = $_POST['walk_in_code'];
$walk_in_id = $_POST['walk_in_id'];  
$gender = $_POST['gender'];
$age = $_POST['age'];
$contact = $_POST['contact'];


$update_personal_info = $_POST['update_personal_info'];
$delete_personal_info = $_POST['delete_personal_info'];


if(isset($update_personal_info)){


	if(isset($walk_in_code) && isset($walk_in_id)){
		
	
		if(!empty($walk_in_code) && !empty($walk_in_id)){
	
		 $UPATERECORED = update_patient_walk_in_details($walk_in_id,$walk_in_code,$fullname,$gender,$age,$contact);
		
	
	
		 if($UPATERECORED){
			get_patient_walk_in_details($walk_in_id,$walk_in_code);

			$_SESSION['err_msg_update']="<div class='alert alert-danger alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-check'></i></div>
								<strong>Warning!</strong> Walk In Patient Records Updated Successfully!!!
							 </div>";
	
			header("Location: ../walk_in_edit_review");
	
		 }
	
	
		}
		 
		
	}

}




if(isset($delete_personal_info)){


	if(isset($walk_in_code) && isset($walk_in_id)){
		
	
		if(!empty($walk_in_code) && !empty($walk_in_id)){

			get_patient_walk_in_details($walk_in_id,$walk_in_code);
	
		 $UPATERECOREDDelete = delete_patient_walk_in_details($walk_in_id,$walk_in_code);
		
	
	
		 if($UPATERECOREDDelete){
			//get_patient_walk_in_details($walk_in_id,$walk_in_code);


			$_SESSION['err_msg_delete']="<div class='alert alert-danger alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-check'></i></div>
								<strong>Warning!</strong> Walk In Patient Records Deleted Successfully!!!
							 </div>";
	
			header("Location: ../walk_in_edit_review");
	
		 }
	
	
		}
		 
		
	}

}
 





//$_SESSION['ac_tab']=4;


?>