<?php
//this file receives the multiple investigation 
session_start();
require_once '../../../functions/conndb.php';
require_once '../../../functions/func_lab.php'; 

$activity = "Added Lab Walk In Investigations";
$useraccess = "Page Url:/users/labs/walk_in_labs";
require_once '../../../functions/logging.php';


$age_patient = "";
$investigation = $_POST['investigation'];
$remarks = $_POST['remarks'];
$phone = $_POST['phone'];
$y_d = $_POST['y_d'];
$dob = $_POST['dob'];
$sex = $_POST['sex'];
$fullname = $_POST['fullname'];
$source = $_POST['source_test'];
$source_name = $_POST['source_name'];
$lab_no = $_POST['lab_no'];
 

$lab_staff_id= $_SESSION['uid']; 
//$request_code = request_code();source_test//source_name

$requested_date = date('Y-m-d');
$requested_test = implode(",", $investigation);

if($y_d == "DAYS"){
	$age_patient = $dob / 365;
	$age_patient = round($age_patient,1);
}else{
	$age_patient = $dob;
}



//exit($_POST);



//$check_patient_visit_consultation = check_patient_visit_consultation($patient_id);

if(isset($investigation) && isset($lab_staff_id) && isset($requested_test)&& isset($dob) && isset($y_d)){

	
		
	
	if(!empty($investigation) && !empty($lab_staff_id) && !empty($requested_test) && !empty($dob) && !empty($y_d) ){

 

		request_walk_in_investigation($requested_test,$remarks,$phone,$age_patient,$sex,$fullname,$source,$source_name,$lab_staff_id,$lab_no);
	
	}
	 
	
}else{
	

	$_SESSION['inves_err']="<div class='alert alert-success alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-check'></i></div>
								<strong>Info!</strong> Failed To Added Walk In Request! Please Fill Form Accordingly.
							 </div>";
	

}


//$_SESSION['ac_tab']=4;

header("Location: ../walk_in_labs");
?>