<?php
//this file receives the multiple investigation 
session_start();
require_once '../../../functions/conndb.php';
require_once '../../../functions/func_consulting.php';
require_once '../../../functions/func_common.php';

$activity = "Added Patient Scans To Searched Patient";
$useraccess = "Page Url:/users/consulting/treat_patient";
require_once '../../../functions/logging.php';


$investigation = $_POST['scans'];
$remarks = $_POST['remarks'];

$doctor_id= $_SESSION['uid'];
$patient_id = $_SESSION['patient_id'];
$request_code = request_code();

$requested_date = date('Y-m-d');
$requested_test = implode(",", $investigation);


$check_patient_visit_consultation = check_patient_visit_consultation($patient_id);

if(isset($investigation) && isset($doctor_id) && isset($patient_id) && isset($request_code) && isset($requested_test)){
		
	
	if(!empty($investigation) && !empty($doctor_id) && !empty($patient_id) && !empty($request_code) ){

		if($check_patient_visit_consultation){
			request_scans($patient_id,$request_code,$doctor_id,$requested_date,$requested_test,$remarks);
		}else{

			$_SESSION['scan_err']="<div class='alert alert-success alert-white rounded'>
			<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
			<div class='icon'><i class='fa fa-check'></i></div>
			<strong>Info!</strong> Please make sure patient vitals are taken and recorded for consultations! Thank you! </br> You can take one as medical doctor at the vitals tab.
		 </div>";
		}
		
	
	}
	
//	$_SESSION['ac_tab']=4;
	
}else{
	

	$_SESSION['scan_err']="<div class='alert alert-success alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-check'></i></div>
								<strong>Info!</strong> Please Select Patient From Notification Tray / Remove Scan If Already Recorded One!
							 </div>";
	

}


$_SESSION['ac_tab']=15;

header("Location: ../treat_patient");
?>