<?php

require_once '../../../functions/conndb.php';
require_once '../../../functions/func_consulting.php';
//session_start();

 $doctor_id = $_SESSION['uid'];
 @$patient_id = $_SESSION['patient_id'];
	$diagnosis = $_POST['edit_diagnosis'];
 $diagnosis_id = $_SESSION['diagnosis_id'];

$diagnose = implode(",", array_unique($diagnosis));


if( isset($doctor_id) && isset($diagnosis_id) && isset($diagnosis)){

	if(!empty($doctor_id) && !empty($diagnosis_id) && !empty($diagnosis)){

		edit_diagnosis($diagnosis_id, $diagnose, $doctor_id);

	} 

	$_SESSION['ac_tab'] = 6;

}	else{
	$_SESSION['ac_tab'] = 6;

	$_SESSION['diag_err']="<div class='alert alert-danger alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-check'></i></div>
								<strong>Warning!</strong> Please choose a patient or Insert a diagnosis!
							 </div>";

	//echo $doctor_id, $patient_id, $complains;
	header("Location: ../treat_patient");
} 





