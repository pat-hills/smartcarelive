<?php
//receiving post variables from the consult.php page...the patient session variable should
//have been set else redirect back to the page
require_once "../../../functions/conndb.php";
require_once "../../../functions/func_opd.php";
session_start();

$patient_id= $_SESSION['patient_id'];
$doctor_room = $_POST['doctor_room'];
$date = date('Y-m-d');
$consulting_code = consulting_code();
$service_code = service_code();
$staff_id = $_SESSION['uid'];
$service_type = $_POST['service_type'];
$service_package = $_POST['service_package'];
$attendance_type = $_POST['attendance_type'];
//echo $date;

//echo $patid." ".$service_type." ".$atten." ".$service_pkg." ".$con_room." ".$ass_doc;

$consult = go_consult($consulting_code, $patient_id, $doctor_room, $staff_id, $date);//function to insert patient details in consulting table

$services = insert_services($service_code, $patient_id, $service_type, $service_package, $attendance_type, $staff_id, $date);
/////////set consulting fee

if(($consult == 1) AND ($services == 1)){
	$_SESSION['err_msg'] = "<div class='alert alert-info alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-times-circle'></i></div>
								<strong> Patient Sent to Consulting Room! </strong> 
							 </div>";
	header("Location: ../consult.php"); 
} else {
	$_SESSION['err_msg'] = "<div class='alert alert-danger alert-white rounded'>
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
									<div class='icon'><i class='fa fa-check'></i></div>
									<strong>Patient was not sent to Consulting Room. Please make sure a Patient's ID is selected</strong>
								 </div>";
								 header("Location: ../consult.php");
}


?>