<?php
//this file receives the multiple investigation 
require_once '../../../functions/conndb.php';
require_once '../../../functions/func_consulting.php';
require_once '../../../functions/func_common.php';

$activity = "Prescribed Drugs To Searched Patient";
$useraccess = "Page Url:/users/consulting/treat_patient";
require_once '../../../functions/logging.php';



$drug=$_POST['drug'];
$drug_qty=$_POST['drug_qty'];
$pres_comment=$_POST['pres_comment'];
$quantity=$_POST['quantity'];
$times = $_POST['times'];
$strenght = $_POST['strenght'];
$time_interval=$_POST['time_interval'];
$duration = $_POST['duration'];
$date = date('Y-m-d H:i:s');

$doc_id =$_SESSION['uid'];
$pid = $_SESSION['patient_id'];
$time_span = $_POST['time_span'];
//$_SESSION['ac_tab']=7;

$check_patient_visit_consultation = check_patient_visit_consultation($pid);

if(!empty($pid) && !empty($drug) && !empty($quantity) && !empty($times)  && !empty($time_interval)){

	//function to insert

	if($check_patient_visit_consultation){
		$inserted = add_prescribtion($drug,$doc_id,$pid,$times,$time_interval,$date,$duration,$quantity,$time_span,$drug_qty,$pres_comment,$strenght);
		if( $inserted){
			$_SESSION['presc_err']="<div class='alert alert-success alert-white rounded'>
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
									<div class='icon'><i class='fa fa-check'></i></div>
									<strong>Info!</strong> Drug has prescribed successfully !
								 </div>";
	
		} else {
			$_SESSION['presc_err']="<div class='alert alert-danger alert-white rounded'>
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
									<div class='icon'><i class='fa fa-check'></i></div>
									<strong style='color:red'>Info!</strong>Failed To Prescribe Drug! Drug Already Prescribed!!!
								 </div>";
	
		}
	}else{

		$_SESSION['presc_err']="<div class='alert alert-success alert-white rounded'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
		<div class='icon'><i class='fa fa-check'></i></div>
		<strong>Info!</strong> Please make sure patient vitals are taken and recorded for consultations! Thank you! </br> You can take one as medical doctor at the vitals tab.
	 </div>";

	}

	
	
	
	
//$_SESSION['ac_tab']=7;

	//header("Location: ../treat_patient");

}else{
	
	$_SESSION['presc_err']="<div class='alert alert-warning alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-check'></i></div>
								<strong>Info!</strong> Please search for a patient first and make sure all dosages are recorded accordingly. Thank you!
							 </div>";
	


}

$_SESSION['ac_tab']=7;
header("Location: ../treat_patient");
?>