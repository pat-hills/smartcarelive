<?php

require_once '../../../functions/conndb.php';
require_once '../../../functions/func_consulting.php';
//session_start();

$doctor_id = $_SESSION['uid'];
@$patient_id = $_SESSION['patient_id'];
$investigation = $_POST['edit_investigations'];
$request_code = select_request_code($patient_id);
$investigation_id = $_SESSION['investigation_id'];

$investigations = implode(",", array_unique($investigation));

$check_if_lab_technician_not_working_on_lab = check_if_lab_technician_not_working_on_lab($request_code,$patient_id);

if( isset($doctor_id) && isset($investigation_id) && isset($investigations)){

	if(!empty($doctor_id) && !empty($investigation_id) && !empty($investigations)){
		//edit_investigations($investigation_id, $investigations, $doctor_id);


	
		if(!$check_if_lab_technician_not_working_on_lab == null){

			//var_dump($check_if_lab_technician_not_working_on_lab);
			$status_ = $check_if_lab_technician_not_working_on_lab['status'];
			$view_status_ = $check_if_lab_technician_not_working_on_lab['view_status'];

			if($status_ == "0" && $view_status_ == "0"){
				edit_investigations($investigation_id, $patient_id, $request_code, $investigations, $doctor_id);

				$_SESSION['inves_err']="<div class='alert alert-danger alert-white rounded'>
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
				<div class='icon'><i class='fa fa-check'></i></div>
				<strong>Warning!</strong> Lab Request Resent / Edited Successfully!
			 </div>";

			}elseif($status_ == "1" && $view_status_ == "1"){
				edit_investigations($investigation_id, $patient_id, $request_code, $investigations, $doctor_id);

				re_update_notification_waiting_patients_lab_view_on_re_submint($patient_id,$request_code);
				$_SESSION['inves_err']="<div class='alert alert-danger alert-white rounded'>
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
				<div class='icon'><i class='fa fa-check'></i></div>
				<strong>Warning!</strong> Lab Request Resent For Reworked On. Thank You!
			 </div>";
			}elseif($status_ == "0" && $view_status_ == "1"){
				$_SESSION['inves_err']="<div class='alert alert-danger alert-white rounded'>
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
				<div class='icon'><i class='fa fa-check'></i></div>
				<strong>Warning!</strong> Lab Request Is Currently Worked On, Please Wait For Submission And You Can Resubmit Back If Needed. Thank You!
			 </div>";

			 header("Location: ../treat_patient");

			}

			
		}else{

			$_SESSION['inves_err']="<div class='alert alert-danger alert-white rounded'>
			<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
			<div class='icon'><i class='fa fa-check'></i></div>
			<strong>Warning!</strong> Something Went Wrong On Request!
		 </div>";

		 header("Location: ../treat_patient");

		}
	} 

	$_SESSION['ac_tab'] = 4;

}	else {
	$_SESSION['ac_tab'] = 4;

	$_SESSION['inves_err']="<div class='alert alert-danger alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-check'></i></div>
								<strong>Warning!</strong> Please choose a patient or Insert an investigations!
							 </div>";

	//echo $doctor_id, $patient_id, $complains;

	
	header("Location: ../treat_patient");
} 
