<?php
//receiving form data from patient registration page
require_once '../../../functions/func_records.php';
require_once '../../../functions/conndb.php';
require_once '../../../functions/func_constant.php';
require_once '../../../functions/func_common.php';
/////////////////////////////
session_start();

$lab_staff_id = $_SESSION['uid'];

$generalTest = "";
$surname = $_POST['sname'];
$other_names = $_POST['onames'];
$sex = $_POST['sex'];
$marital_stat = $_POST['mstats'];/////////Personal Info POST DATA
$occupation = $_POST['occu'];
$dob = $_POST['dob'];
$phone = $_POST['phone'];
$address = $_POST['add'];
$national_id = $_POST['nid'];
$pat_email = $_POST['pat_email'];

$blood_group = $_POST['blood_group'];

$r_h = $_POST['r_h'];
 
$sickling = $_POST['sickling'];

$g6pd = $_POST['g6pd'];


$sms_format = "233".substr($phone, 1);

$requestCode = uniqid();

//$check_phone = check_patient_phone_number($phone);

//$check_phone = false;

 
// if($check_phone == true){

// 	$_SESSION['err_msg'] = "
// 	<div class='alert alert-info alert-white rounded'>
// 			<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
// 			<div class='icon'><i class='fa fa-times-circle'></i></div>
// 			<strong>Phone number record already exist! </strong> 
// 	 </div>
// 	 ";	

// 	 header("Location: ../add_patient");

// }else{



$per_info = per_info($surname,$other_names,$sex,$marital_stat,$occupation,$phone,$address,$national_id,$sms_format,$pat_email,$dob); //personal info insert function

if($per_info){


	
$patient_id = $_SESSION['patient_id'];


$relation = $_POST['relationship']; 
$famphone = $_POST['famphone'];
$famname= $_POST['famname'];
$famsex = $_POST['famgen'];
$famaddress = $_POST['famaddress'];
 
fam_info($patient_id,$famname,$famsex,$famaddress,$relation,$famphone);

if($r_h){
	$generalTest = "RH";
	insert_general_test($requestCode,$patient_id,$lab_staff_id,$generalTest,$r_h,$comment=null,false);
}

if($sickling){
	$generalTest = "Sickling";
	insert_general_test($requestCode,$patient_id,$lab_staff_id,$generalTest,$sickling,$comment=null,false);
}


if($g6pd){
	$generalTest="G6PD";
	insert_general_test($requestCode,$patient_id,$lab_staff_id,$generalTest,$g6pd,$comment=null,false);
}

if($blood_group){
	$generalTest = "BLOOD GROUP";
	insert_general_test($requestCode,$patient_id,$lab_staff_id,$generalTest,$blood_group,$comment=null,false);
}




if(IS_INSUARANCE_PACKAGE == true){


	$name_of_insurer = "";
	
	$scheme =$_POST['insurance_companies']; 
	$membership_id = $_POST['MembershipID']; 
	$patientsscheme = $_POST['patientsscheme']; 
	
	if($patientsscheme=="Yes" && !empty($patientsscheme)){
		scheme_details($patient_id, $membership_id,$scheme);//scheme details insert function
	 
	}
	
}

 

$path ="../../../patients/".$patient_id;

$mode = 0777;
$type='true';
pat_folder_main($path,$mode,$type);


$path ="../../../patients/".$patient_id."/scanXray";//////scans and xray

pat_folder_scan($path,$mode,$type);

$path ="../../../patients/".$patient_id."/oldFolder";

pat_folder_ofold($path,$mode,$type);

$path ="../../../patients/".$patient_id."/lab_results";

pat_lab_result($path,$mode,$type);
 

$_SESSION['err_msg'] = "
						<div class='alert alert-info alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-times-circle'></i></div>
								<strong> New Patient has been Registered Successfully! </strong> 
					 	</div>
					 	";					 	
									
$_SESSION['new_pat_id'] = $patient_id;


header("Location: ../view_patient");

}else{

	$_SESSION['err_msg'] = "
	<div class='alert alert-info alert-white rounded'>
			<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
			<div class='icon'><i class='fa fa-times-circle'></i></div>
			<strong>Failed To Register Patient! Please Try Again </strong> 
	 </div>
	 ";	



	 
header("Location: ../add_patient");

}


//}


?>