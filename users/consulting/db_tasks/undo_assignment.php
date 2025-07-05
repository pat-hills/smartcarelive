<?php
//this file deletes any entry entered by receiving the id of the complain
require_once '../../../functions/conndb.php';
require_once '../../../functions/func_consulting.php';
//session_start();
global $connection;
$del_id=$_GET['id'];
$ward_id=$_GET['ward_id'];

$patient_id = $_SESSION['patient_id'];
$service_code = get_services($patient_id);
$service_type = "out-patient";



$number_of_beds_available = ward_available_bed($ward_id);
$increase_number = $number_of_beds_available + 1;

update_ward_available_bed($ward_id,$increase_number);

$sql="DELETE FROM ward_assignment WHERE id='".$del_id."'";

$remove_assignment =mysqli_query($connection,$sql);

$update_service = update_in_patient($service_type, $patient_id, $service_code);
$_SESSION['ac_tab']=8;
$_SESSION['ward_err']="<div class='alert alert-warning alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-warning'></i></div>
								<strong>Info!</strong> Ward assignment has been cancelled !
							 </div>";
header("Location: ../treat_patient");

?>