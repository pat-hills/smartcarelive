<?php
//receiving post variables from the consult.php page...the patient session variable should
//have been set else redirect back to the page
require_once "../../../functions/conndb.php";
require_once "../../../functions/func_records.php";
session_start();

$patient_id= $_SESSION['patient_id'];
$service_type = $_POST['service_type'];
$attendance_type = $_POST['attendance_type'];
$service_package = $_POST['service_package'];
$room_id = $_POST['con_room'];
$doctor_id = $_POST['doctor'];
$date = date('Y-m-d');
//echo $date;

//echo $patid." ".$service_type." ".$atten." ".$service_pkg." ".$con_room." ".$ass_doc;

go_consult($patient_id, $doctor_id, $date, $service_type, $attendance_type, $service_package,$room_id);//function to insert patient details in consulting table

/////////set consulting fee



$_SESSION['err_msg'] = "<div class='alert alert-info alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-times-circle'></i></div>
								<strong>Info!</strong> Patient Sent to Consulting Room!
							 </div>";
header("Location: ../consult.php"); 
?>