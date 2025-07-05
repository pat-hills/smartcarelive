<?php
//this file receives the multiple investigation 
session_start();
require_once '../../../functions/conndb.php';
require_once '../../../functions/func_consulting.php';
//require_once '../../../functions/func_opd.php';
require_once '../../../functions/func_common.php';

$activity = "Assigned Ward To Searched Patient";
$useraccess = "Page Url:/users/consulting/treat_patient";
require_once '../../../functions/logging.php';



$ward_code = $_POST['ward'];
$comments = $_POST['comment'];

$doctor_id= $_SESSION['uid'];
$patient_id = $_SESSION['patient_id'];
//$service_code =  $_SESSION['service_code_vitals'];
$service_type = "in-patient";
$date_added = date('Y-m-d H:i:s');

$check_patient_visit_consultation = check_patient_visit_consultation($patient_id);



if(isset($ward_code) && isset($doctor_id) && isset($patient_id)){


	if($check_patient_visit_consultation){
		
	

	$service_code = get_services($patient_id);
//$service_code = $service_code_['service_code'];
$_SESSION['service_code_vitals'] = $service_code;

$number_of_beds_available = ward_available_bed($ward_code);
$decrease_number = $number_of_beds_available - 1;

	//function to insert
	$inserted = ward_assignment($ward_code, $patient_id, $doctor_id, $comments, $date_added);
	$updated = update_out_patient($service_type, $patient_id, $service_code);
	update_ward_available_bed($ward_code,$decrease_number);
	if( $inserted && $updated ){
		$_SESSION['ward_err'] = "<div class='alert alert-success alert-white rounded'>
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
									<div class='icon'><i class='fa fa-check'></i></div>
									<strong>Ward Assigned</strong> 
								 </div>";
						

	} else {
		$_SESSION['ward_err'] = "<div class='alert alert-danger alert-white rounded'>
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
									<div class='icon'><i class='fa fa-check'></i></div>
									<strong>Ward was not assigned!</strong>
								 </div>";

	}
	 

}else{
	


							 $_SESSION['ward_err']="<div class='alert alert-success alert-white rounded'>
							 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
							 <div class='icon'><i class='fa fa-check'></i></div>
							 <strong>Info!</strong> Please make sure patient vitals are taken and recorded for consultations! Thank you! </br> You can take one as medical doctor at the vitals tab.
						  </div>";						 
	


}
}else{


	
	$_SESSION['ward_err']="<div class='alert alert-warning alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-check'></i></div>
								<strong>Info!</strong> Please search for a patient first or make sure patient has been assigned to a Doctor!
							 </div>";
	
}


$_SESSION['ac_tab']=8;
header("Location: ../treat_patient");

?>