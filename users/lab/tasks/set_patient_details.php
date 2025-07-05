<?php 
//this file sets the patient details to be used by the records user in his/her module
//it calls two functions from the records functions file
//function 1 gets the right person by using the submited form data and
//function 2 uses the result of function to set the patient details 
require '../../../functions/conndb.php';
require '../../../functions/func_search.php';
require '../../../functions/func_lab.php';
session_start();

//recieving post vairable from multiple search form
@$search = $_POST['get_details'];

@$get_patient_id = $_GET['patient_id'];

@$get_date = $_GET['date'];

if(empty($get_date)){
	$date = date('Y-m-d');
	$get_date = $date;
}

if(isset($get_patient_id) && !empty($get_patient_id) && isset($get_date)){
	
	//if(isset($get_date) && !empty($get_date)){
		
	//} else {
	
		$filtered_search = search_pat_info($get_patient_id);	

		get_pat_details($filtered_search);
		//Get patient_id session from the function above
		$patient_id = $_SESSION['patient_id'];
		//$date = date('Y-m-d');
		  
		//This function call gets all lab request details
		$lab_request = lab_request($patient_id, $get_date);
		//var_dump($lab_request);
		//die('get');
		$doctor_id = $lab_request['doctor_id'];
		$requesting_doctor = requesting_doctor($doctor_id); 
		  
		//Session details
		//$_SESSION['request_code'] = 
		$_SESSION['full_name'] = $requesting_doctor['firstName'] .' '. $requesting_doctor['otherNames'];
		$_SESSION['request_code'] = $lab_request['request_code'];
		$_SESSION['doctor_id'] = $lab_request['doctor_id'];
		$_SESSION['requested_test'] = $lab_request['requested_test'];
		$_SESSION['remarks'] = $lab_request['remarks'];
		$_SESSION['requested_date'] = $lab_request['requested_date'];
		//Redirect to lab test page
		header("Location: ../lab_test");
	//}
	
} else if(isset($search) && !empty($search)){
	
	$filtered_search = search_pat_info($search);

	get_pat_details($filtered_search);
	//Get patient_id session from the function above
	$patient_id = $_SESSION['patient_id'];
	$date = date('Y-m-d');
	
	//This function call gets all lab request details
	$lab_request = lab_request($patient_id, $date);
	$doctor_id = $lab_request['doctor_id'];
	$requesting_doctor = requesting_doctor($doctor_id); 
	  
	//Session details   
	//$_SESSION['request_code'] = 
	$_SESSION['full_name'] = $requesting_doctor['firstName'] .' '. $requesting_doctor['otherNames'];
	$_SESSION['request_code'] = $lab_request['request_code'];
	$_SESSION['doctor_id'] = $lab_request['doctor_id'];
	$_SESSION['requested_test'] = $lab_request['requested_test'];
	$_SESSION['remarks'] = $lab_request['remarks'];
	$_SESSION['requested_date'] = $lab_request['requested_date'];
	//Redirect to lab test page
	header("Location: ../lab_test");
}	

?>