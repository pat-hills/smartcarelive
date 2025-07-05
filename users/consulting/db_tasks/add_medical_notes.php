<?php

require_once '../../../functions/conndb.php';
require_once '../../../functions/func_consulting.php';
require_once '../../../functions/func_common.php';
//session_start();

$activity = "Added Medical Examination To Searched Patient";
$useraccess = "Page Url:/users/consulting/treat_patient";
require_once '../../../functions/logging.php';


$doctor_id = $_SESSION['uid'];
@$patient_id = $_SESSION['patient_id'];
//$complain = $_POST['complains'];
$patient_medical_examination = $_POST['patient_medical_examination'];
//history_complains
 

$check_patient_visit_consultation = check_patient_visit_consultation($patient_id);

if( isset($doctor_id) && isset($patient_id) && isset($patient_medical_examination)){

	if(!empty($doctor_id) && !empty($patient_id) && !empty($patient_medical_examination)){

		if($check_patient_visit_consultation){
			patient_medical_notes($patient_id,$doctor_id,$patient_medical_examination);
		}else{

			$_SESSION['notes_err']="<div class='alert alert-success alert-white rounded'>
			<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
			<div class='icon'><i class='fa fa-check'></i></div>
			<strong>Info!</strong> Please make sure patient vitals are taken and recorded for consultations! Thank you! </br> You can take one as medical doctor at the vitals tab.
		 </div>";
	

		}



	} 

   //	$_SESSION['ac_tab'] = 3;

}	else{


	$_SESSION['notes_err']="<div class='alert alert-danger alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-check'></i></div>
								<strong>Warning!</strong> Please choose a patient or Insert an examination!
							 </div>";

	//echo $doctor_id, $patient_id, $complains;

}



$_SESSION['ac_tab'] = 13;

header("Location: ../treat_patient");

?>