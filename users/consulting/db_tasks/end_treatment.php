<?php
//this file receives the multiple investigation 
session_start();
require_once '../../../functions/conndb.php';
require_once '../../../functions/func_consulting.php';


$outcome = $_POST['outcome'];
$ward_id = $_POST['ward_id'];
$ward_assignment_code = $_POST['ward_assignment_code']; 

$doctor_id= $_SESSION['uid'];
$patient_id = $_SESSION['patient_id'];
$service_code = get_services($patient_id);
$date_updated = date('Y-m-d H:i:s');

if(isset($outcome) && isset($doctor_id) && isset($patient_id) && isset($date_updated)){

	//function to insert
	$inserted = treatment_outcome($patient_id,$doctor_id, $outcome, $service_code, $date_updated );
	$end = end_patient_admission_outcome($patient_id,$ward_assignment_code,$outcome,$doctor_id);

	//$number_of_beds_available = ward_available_bed($ward_id);
    // $increase_number = $number_of_beds_available + 1;

   // update_ward_available_bed($ward_id,$increase_number);

	
	if( $end && $inserted ){
	
		$_SESSION['end_err'] = "<div class='alert alert-success alert-white rounded'>
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
									<div class='icon'><i class='fa fa-check'></i></div>
									<strong>Patient's Treatment has been ended successfully</strong> 
								 </div>";
						

	} else {
		$_SESSION['end_err'] = "<div class='alert alert-danger alert-white rounded'>
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
									<div class='icon'><i class='fa fa-check'></i></div>
									<strong>Patient's Treatment could not end, please Inform Omar!</strong>
								 </div>";

	}
	
	//$_SESSION['ac_tab']=9;

	$_SESSION['ac_tab']=8;

	header("Location: ../treat_patient");

}else{
	
	$_SESSION['end_err']="<div class='alert alert-warning alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-check'></i></div>
								<strong>Info!</strong> Please search for a patient first !
							 </div>";
	

$_SESSION['ac_tab']=9;
	header("Location: ../treat_patient");
}


?>