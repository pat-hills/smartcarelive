<?php

require_once ('../../../functions/conndb.php');
session_start();
$patientID=$_SESSION['patient_id'];
if(isset($_POST['epilepsy']) && isset($_POST['sicklecell']) &&
isset($_POST['diabetes']) && isset($_POST['allergies']) && isset($_POST['hypertension']) && isset($_POST['other']) && isset($_POST['blood_group'])){
$epilepsy=$_POST['epilepsy'];
$sicklecell=$_POST['sicklecell'];
$allergies=$_POST['allergies'];
$hypertension=$_POST['hypertension'];
$other=$_POST['other'];
$blood_group=$_POST['blood_group'];
$diabetes = $_POST['diabetes'];


$sql="UPDATE tbl_med_info SET epilepsy='".$epilepsy."',hypertension='".$hypertension."',diabetes='".$diabetes."',
blood_group='".$blood_group."',sickle_cell='".$sicklecell."',allergies='".$allergies."',other='".$other."'
WHERE patient_id='".$patientID."'";

if($update_query=mysql_query($sql)){
	$_SESSION['err_msg'] = "<div class='alert alert-info alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-times-circle'></i></div>
								<strong>Success!</strong> Patient medical information updated. Please refresh page to see results!
							 </div>";
	header("Location: ../update_patient.php");

}else{
	echo "error ".mysql_error();
}
}else{
	echo "values not";
}//end of if statement



?>