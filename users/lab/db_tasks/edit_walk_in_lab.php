<?php

require_once '../../../functions/conndb.php';
require_once '../../../functions/func_lab.php';
session_start();
 
$investigation = $_POST['edit_investigations'];

$request_code = $_SESSION['request_code'];

$user_id = $_SESSION['uid'];

$patient_id = $_SESSION['patient_id'];

$id = $_SESSION['id'];


$process = $_SESSION['processed'];

$investigations = implode(",", array_unique($investigation));
 

 

if( isset($user_id) && isset($id) && isset($investigations) && isset($request_code)){

	if(!empty($user_id) && !empty($id) && !empty($investigations) && !empty($request_code)){

		edit_investigations_walk_in($id, $request_code, $investigations, $user_id,$process);

	} 

	//$_SESSION['ac_tab'] = 12;

}	else{
//	$_SESSION['ac_tab'] = 12;

	$_SESSION['err_msg']="<div class='alert alert-danger alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-check'></i></div>
								<strong>Warning!</strong> Please Select A Walk In Lab To Edit!!!
							 </div>";

	//echo $doctor_id, $patient_id, $complains;

}


	 	
if($_SESSION['exist']){

	header("Location: ../walk_in_exist");
}else{


	header("Location: ../walk_in_labs");
}	


//header("Location: ../walk_in_exist");


