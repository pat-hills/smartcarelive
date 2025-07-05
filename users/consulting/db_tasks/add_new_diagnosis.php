<?php
//this file receives the multiple investigation 
require_once '../../../functions/conndb.php';
require_once '../../../functions/func_consulting.php';

session_start();


$activity = "Added New Diagnosis To List";
$useraccess = "Page Url:/users/consulting/treat_patient";
require_once '../../../functions/logging.php';

$a=$_POST['new_diag'];
$doc_id =$_SESSION['uid'];


if(isset($a)&& isset($doc_id)){
		
	$_SESSION['ac_tab']=6;
	add_new_diagnosis($a,$doc_id);
	$_SESSION['diag_err']="<div class='alert alert-success alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-check'></i></div>
								<strong>Info!</strong> New Diagnosis Added to System !
							 </div>";
header("Location: ../treat_patient");
}else{
	$_SESSION['ac_tab']=6;
	$_SESSION['diag_err']="<div class='alert alert-danger alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-check'></i></div>
								<strong>Warning!</strong>  You need to log into the system!
							 </div>";
header("Location: ../treat_patient");
}





?>