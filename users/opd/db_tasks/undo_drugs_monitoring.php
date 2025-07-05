<?php
//this file deletes any entry entered by recieving the id of the complain
require_once '../../../functions/conndb.php';

$activity = "Remove Patient Drug From Monitoring Tray";
$useraccess = "Page Url:/users/opd/admission_monitoring";
require_once '../../../functions/logging.php';
global $connection;
session_start();
$del_id=$_GET['id'];

$patient_id = @$_SESSION['patient_id'];

$sql="DELETE FROM tbl_detain_patient_medications WHERE id='".$del_id."' AND patient_id ='".$patient_id."'";

$a=mysqli_query($connection,$sql);
//$_SESSION['ac_tab']=3;
$_SESSION['comp_err']="<div class='alert alert-warning alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-warning'></i></div>
								<strong>Info!</strong> Patient Drug Removed!
							 </div>";
header("Location: ../admission_monitoring");


?>