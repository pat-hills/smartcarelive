<?php
//this file receives the multiple investigation 
require_once '../../../functions/conndb.php';
require_once '../../../functions/func_consulting.php';
require_once '../../../functions/func_common.php';
session_start();

$activity = "Diagnosed Searched Patient";
$useraccess = "Page Url:/users/consulting/treat_patient";
require_once '../../../functions/logging.php';

$a=$_POST['pat_diag'];
$diagnosis = implode(",", $a);
$date = date('Y/m/d');
$_SESSION['ac_tab']=6;
$doc_id =$_SESSION['uid'];
$pid = $_SESSION['patient_id'];

$check_patient_visit_consultation = check_patient_visit_consultation($pid);

if(!empty($diagnosis) && !empty($pid)){

if($check_patient_visit_consultation){

	add_pat_diag($pid,$doc_id,$diagnosis,$date);
}else{
	$_SESSION['diag_err']="<div class='alert alert-success alert-white rounded'>
	<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
	<div class='icon'><i class='fa fa-check'></i></div>
	<strong>Info!</strong> Please make sure patient vitals are taken and recorded for consultations! Thank you! </br> You can take one as medical doctor at the vitals tab.
 </div>";
}
//$_SESSION['ac_tab']=6;
	
}else{
	
	$_SESSION['diag_err']="<div class='alert alert-warning alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-check'></i></div>
								<strong>Please add Diagnosis or Select a Patient's ID!</strong> 
							 </div>";


}

$_SESSION['ac_tab']=6;

header("Location: ../treat_patient");
?>