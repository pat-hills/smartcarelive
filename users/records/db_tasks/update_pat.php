<?php

    require_once '../../../functions/conndb.php';
    require_once '../../../functions/func_records.php';
    session_start(); 
   

    if( isset($_POST['update_scheme_info']) ){
        //patient_id
        $patient_id = $_POST['patient_id'];
		$surname = $_POST['sname'];
$other_names = $_POST['onames'];
$sex = $_POST['sex'];
$marital_stat = $_POST['mstats'];/////////Personal Info POST DATA
$occupation = $_POST['occu'];
$dob = $_POST['dob'];
$phone = $_POST['phone'];
$address = $_POST['add'];
$national_id = $_POST['nid']; 

$relation = $_POST['relationship']; 
$famphone = $_POST['famphone'];
$famname= $_POST['famname'];
$famsex = $_POST['famgen'];
$famaddress = $_POST['famaddress'];

$blood_group = "";

$scheme =$_POST['insurance_companies']; 
$membership_id = $_POST['MembershipID']; 
$patientsscheme = $_POST['patientsscheme']; 

$blood_group = $_POST['blood_group'];

$r_h = $_POST['r_h'];
 
$sickling = $_POST['sickling'];

$g6pd = $_POST['g6pd'];

$requestCode = uniqid();

$lab_staff_id = $_SESSION['uid'];







        //$membership_id = $_POST['membership_id'];
        
        
        $update_personal_info = update_personal_info($patient_id, $surname, $other_names, $sex, $marital_stat, $occupation, $phone, $address, $national_id, $dob);   

		$update_family_info = update_family_info($patient_id, $famname, $famsex, $famaddress, $relation, $blood_group, $famphone);   
       
        if($patientsscheme=="Yes" && !empty($patientsscheme)){
            $update_scheme = update_scheme($patient_id,$membership_id,$scheme);
         
        }elseif($patientsscheme=="Add" && !empty($patientsscheme)){
            
            $update_scheme = scheme_details($patient_id,$membership_id,$scheme);

           // die($patientsscheme);
        }

        if($r_h){
	$generalTest = "RH";
	insert_general_test($requestCode,$patient_id,$lab_staff_id,$generalTest,$r_h,$comment=null);
}

if($sickling){
	$generalTest = "Sickling";
	insert_general_test($requestCode,$patient_id,$lab_staff_id,$generalTest,$sickling,$comment=null);
}


if($g6pd){
	$generalTest="G6PD";
	insert_general_test($requestCode,$patient_id,$lab_staff_id,$generalTest,$g6pd,$comment=null);
}

if($blood_group){
	$generalTest = "BLOOD GROUP";
	insert_general_test($requestCode,$patient_id,$lab_staff_id,$generalTest,$blood_group,$comment=null);
}
		
		if($update_personal_info && $update_family_info){
        //echo "Staff '".$firstname. "''/s account has been updated successfully";
            $_SESSION['successMsg'] = "Patient's info has been updated successfully";  
               
			header("Location: ../view_all_patients");
        } else {
            $_SESSION['successMsg'] = "Sorry Patient's info  could not be updated";
            
            //echo "Sorry account could not be updated";
			header("Location: ../view_all_patients");
        }
    
    }
    
    