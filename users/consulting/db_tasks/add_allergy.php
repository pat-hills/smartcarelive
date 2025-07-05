<?php
//this file receives the multiple investigation 
session_start();
require_once '../../../functions/conndb.php';
require_once '../../../functions/func_consulting.php';

require_once '../../../functions/func_common.php';


$activity = "Added Red Flag(allergy) To Searched Patient";
$useraccess = "Page Url:/users/consulting/treat_patient";
require_once '../../../functions/logging.php';


$allergy = $_POST['allergy'];
$description = $_POST['description'];

$doctor_id= $_SESSION['uid'];
$patient_id = $_SESSION['patient_id'];
//$request_code = request_code();

$requested_date = date('Y-m-d'); 

$check_patient_visit_consultation = check_patient_visit_consultation($patient_id);

if(isset($allergy)&& isset($description)&& isset($doctor_id) && isset($patient_id)){
		
	
	if(!empty($allergy) && !empty($doctor_id) && !empty($patient_id) && !empty($description)){

	 
		
      if($check_patient_visit_consultation){

		add_patient_allergies($patient_id,$doctor_id,$allergy,$description,$requested_date);


	  }else{


		$_SESSION['allergy_err']="<div class='alert alert-success alert-white rounded'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
		<div class='icon'><i class='fa fa-check'></i></div>
		<strong>Info!</strong> Please make sure patient vitals are taken and recorded for consultations! Thank you! </br> You can take one as medical doctor at the vitals tab.
	 </div>";

	  }

	}
	
	//$_SESSION['ac_tab']=10;
	
}else{
	

	$_SESSION['allergy_err']="<div class='alert alert-success alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-check'></i></div>
								<strong>Info!</strong> Please select patient from search box above!
							 </div>";
	
	
}

$_SESSION['ac_tab']=10;

header("Location: ../treat_patient");
?>