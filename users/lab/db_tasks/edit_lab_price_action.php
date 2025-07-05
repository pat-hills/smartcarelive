<?php
//this file receives the multiple investigation 
session_start();
require_once '../../../functions/conndb.php';
require_once '../../../functions/func_lab.php'; 

$activity = "Deleted/Edit Lab Price";
$useraccess = "Page Url:/users/labs/edit_labs";
require_once '../../../functions/logging.php';

 
$investigation = $_POST['investigation'];
$tariffs = $_POST['tariffs']; 

$lab_investigation_id = $_SESSION['Investigation_ID'];
 


if(isset($investigation)){


	if(isset($investigation) && isset($tariffs)){
		
	
		if(!empty($investigation) && !empty($tariffs)){
	
		 $UPATERECORED = update_investigation_price($lab_investigation_id,$investigation,$tariffs);
		
	
	
		 if($UPATERECORED){
			//get_patient_walk_in_details($walk_in_id,$walk_in_code);

			$_SESSION['err_msg_update']="<div class='alert alert-danger alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-check'></i></div>
								<strong>Warning!</strong> Investigation Record Updated Successfully!!!
							 </div>";

							 $_SESSION['Investigation_name'] = "";

							 $_SESSION['Investigation_price'] = "";
							
							 $_SESSION['Investigation_ID'] = "";
	
			header("Location: ../add_investigations");
	
		 }
	
	
		}
		 
		
	}

}



 
 





//$_SESSION['ac_tab']=4;


?>