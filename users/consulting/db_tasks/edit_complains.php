<?php

require_once '../../../functions/conndb.php';
require_once '../../../functions/func_consulting.php';
//session_start();

$doctor_id = $_SESSION['uid'];
@$patient_id = $_SESSION['patient_id'];
$complain = $_POST['edit_complains'];
$history_complains = $_POST['edit_history_complains'];
$complain_id = $_SESSION['complain_id'];


$complains = implode(",", array_unique($complain));


//echo $complains = implode(',',array_unique(explode(',', $complain)));
//$_SESSION['complains'] = $complains;

if( isset($doctor_id) && isset($complain_id) && isset($complains)){

	if(!empty($doctor_id) && !empty($complain_id) && !empty($complains)){

		edit_complains($complain_id, $complains, $doctor_id,$history_complains);

	} 

	$_SESSION['ac_tab'] = 3;

}	else{
	$_SESSION['ac_tab'] = 3;

	$_SESSION['comp_err']="<div class='alert alert-danger alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-check'></i></div>
								<strong>Warning!</strong> Please choose a patient or Insert a complain!
							 </div>";

	//echo $doctor_id, $patient_id, $complains;
	header("Location: ../treat_patient");
}





