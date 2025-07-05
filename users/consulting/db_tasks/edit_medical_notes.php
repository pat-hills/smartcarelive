<?php

require_once '../../../functions/conndb.php';
require_once '../../../functions/func_consulting.php';
//session_start();

$doctor_id = $_SESSION['uid'];
@$patient_id = $_SESSION['patient_id']; 
$edit_medical_exam = $_POST['edit_medical_exam'];
$exam_id = $_SESSION['medical_notes_id'];
 

 

if( isset($doctor_id) && isset($exam_id) && isset($edit_medical_exam)){

	if(!empty($doctor_id) && !empty($exam_id) && !empty($edit_medical_exam)){

		edit_medical_notes($exam_id,$doctor_id,$edit_medical_exam);

	} 

	$_SESSION['ac_tab'] = 13;

}	else{
	$_SESSION['ac_tab'] = 13;

	$_SESSION['notes_err']="<div class='alert alert-danger alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-check'></i></div>
								<strong>Warning!</strong> Please choose a patient or Insert An Examination!
							 </div>";

	//echo $doctor_id, $patient_id, $complains;
	header("Location: ../treat_patient");
}





