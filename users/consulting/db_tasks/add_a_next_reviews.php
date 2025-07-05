<?php
//this file receives the multiple investigation 
session_start();
require_once '../../../functions/conndb.php';
require_once '../../../functions/func_consulting.php';

require_once '../../../functions/func_common.php';

$activity = "Scheduled Review Of Searched Patient";
$useraccess = "Page Url:/users/consulting/treat_patient";
require_once '../../../functions/logging.php';



$dov = $_POST['dov'];
$remarks = $_POST['remarks'];

$doctor_id= $_SESSION['uid'];
$patient_id = $_SESSION['patient_id'];
//$request_code = request_code();

$requested_date = date('Y-m-d');

$check_patient_visit_consultation = check_patient_visit_consultation($patient_id);

if(isset($dov)&& isset($doctor_id) && isset($patient_id)){
		
	
	if(!empty($dov) && !empty($doctor_id) && !empty($patient_id)){

		if($dov <= $requested_date){
			
	$_SESSION['review_err']="<div class='alert alert-success alert-white rounded'>
	<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
	<div class='icon'><i class='fa fa-check'></i></div>
	<strong>Info!</strong> Please select a future date for review!
 </div>";
		}else{

		if($check_patient_visit_consultation){
			add_patient_reviews($patient_id,$doctor_id,$dov,$remarks);
		}else{

			$_SESSION['review_err']="<div class='alert alert-success alert-white rounded'>
	<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
	<div class='icon'><i class='fa fa-check'></i></div>
	<strong>Info!</strong> Please make sure patient vitals are taken and recorded for consultations! Thank you! </br> You can take one as medical doctor at the vitals tab.
 </div>";
		}
		
	}
		
	}else{

		$_SESSION['review_err']="<div class='alert alert-success alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-check'></i></div>
								<strong>Info!</strong> Please select date for patient review!
							 </div>";
		
	}
	
//	$_SESSION['ac_tab']=11;
	
}else{


	$_SESSION['review_err']="<div class='alert alert-success alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-check'></i></div>
								<strong>Info!</strong> Please select patient from search box above!
							 </div>";
	

}

$_SESSION['ac_tab']=11;

header("Location: ../treat_patient");
?>