<?php



@session_start();
require_once"conndb.php";
require_once"func_constant.php";
require_once"func_common.php";


//All functions for bio vitals
// function get_vitals($patientID){

// 	$sql = "SELECT * FROM tbl_med_info WHERE patient_id='".$patientID."'";
// 	$query_run = mysql_query($sql);
// 	while($see=mysql_fetch_array($query_run)){

// 		$_SESSION['epilepsy']=$see['epilepsy'];
// 		$_SESSION['hyper']=$see['hypertension'];
// 		$_SESSION['diabetes']=$see['diabetes'];
// 		$_SESSION['bg']=$see['blood_group'];
// 		$_SESSION['sickle_cell']=$see['sickle_cell'];
// 		$_SESSION['allergies']=$see['allergies'];
// 		$_SESSION['other']=$see['other'];

// 	}
// }
 


function get_bio($patient_id){

	global $connection;
	
	$date = date('Y-m-d');

	$sql = "SELECT patient_id,bmi,date_taken,weight,height,blood_pressure_top,blood_pressure_down
	,temperature,taken_by,pulse,respiration,s_p_0_2 from  
	tbl_patient_biovitals WHERE patient_id = '".$patient_id."' AND DATE( date_taken ) = '".$date."'  
	";
	$query_run = mysqli_query($connection,$sql);
	while($row=mysqli_fetch_assoc($query_run)){
		
		/*$_SESSION['weight']=$row['weight'];
		$_SESSION['height']=$row['height'];
		$_SESSION['bmi']=$row['bmi'];
		$_SESSION['blood_pressure']=$row['blood_pressure'];
		$_SESSION['temperature']=$row['temperature'];
		$_SESSION['taken_by']=$row['taken_by'];
		$_SESSION['date_taken']=$row['date_taken'];
		*/
		return $row;
		
	}
}

function get_bio_last_visit($patient_id){

	global $connection;
	
	$date = date('Y-m-d');

	$sql = " SELECT id,patient_id,bmi,date_taken,weight,height,blood_pressure_top,blood_pressure_down,temperature ,pulse,respiration,s_p_0_2,taken_by FROM (SELECT id,patient_id,bmi,date_taken,weight,height,blood_pressure_top,blood_pressure_down,temperature ,pulse,s_p_0_2,respiration, taken_by from tbl_patient_biovitals WHERE patient_id = '".$patient_id."' 
	 ORDER BY id DESC LIMIT 2 ) tbl_patient_biovitals ORDER BY id LIMIT 1 ";
	$query_run = mysqli_query($connection,$sql);
	while($row=mysqli_fetch_assoc($query_run)){
		
		/*$_SESSION['weight']=$row['weight'];
		$_SESSION['height']=$row['height'];
		$_SESSION['bmi']=$row['bmi'];
		$_SESSION['blood_pressure']=$row['blood_pressure'];
		$_SESSION['temperature']=$row['temperature'];
		$_SESSION['taken_by']=$row['taken_by'];
		$_SESSION['date_taken']=$row['date_taken'];
		*/
		return $row;
		
	}
}

function bio_vitals($patient_id, $date){

	global $connection;

	//$sql = "SELECT *, DATE(date_taken) as date_taken  FROM `tbl_patient_biovitals` FROM tbl_consulting WHERE patient_id = '".$patient_id."'";
	$sql = "SELECT * FROM  tbl_patient_biovitals WHERE patient_id = '".$patient_id."' AND DATE( date_taken ) = '".$date."'";
	$result = mysqli_query($connection,$sql);

	if(mysqli_num_rows($result) >= 1){

		while ($row = mysqli_fetch_assoc($result)) {
			
			return $row;

		}

	}
}

//Functions for Patient's Medical History
function set_epilepsy($a){//receives the epilepsy session variable from get_vitals()

	switch ($a) {
		case '0':
			# code...
		echo'No';

			break;
	case '1':
			# code...
		echo'Yes';
			break;
		
		default:
			# code...
		echo "Not Tested";
			break;
	}

}

function set_hyper($a){//receives the hypertension session variable from get_vitals()

	switch ($a) {
		case '0':
			# code...
		echo'No';

			break;
	case '1':
			# code...
		echo'Yes';
			break;
		
		default:
			# code...
		echo "Not Tested";
			break;
	}

}

function set_diabetes($a){//receives the diabetes session variable from get_vitals()

	switch ($a) {
		case '0':
			# code...
		echo'No';

			break;
	case '1':
			# code...
		echo'Yes';
			break;
		
		default:
			# code...
		echo "Not Tested";
			break;
	}

}

function set_sickle($a){//receives the sickle session variable from get_vitals()

	switch ($a) {
		case '0':
			# code...
		echo'No';

			break;
	case '1':
			# code...
		echo'Yes';
			break;
		
		default:
			# code...
		echo "Not Tested";
			break;
	}

}

function set_allergies($a){//receives the allergies session variable from get_vitals()

	switch ($a) {
		case '0':
			# code...
		echo'No';

			break;
	case '1':
			# code...
		echo'Yes';
			break;
		
		default:
			# code...
		echo "Not Tested";
			break;
	}

}



//This function controls tabs @ doctor's side
function set_tabs($setter){

switch ($setter) {
	case '1':
		# code...
	$_SESSION['per_tab']='active';
	$_SESSION['vit_tab']='';
	$_SESSION['red_flag']='';
	$_SESSION['reviews']='';
	$_SESSION['comp_tab']='';
	$_SESSION['inves_tab']='';
//	$_SESSION['procedure_tab']='';
	$_SESSION['dia_tab']='';
	$_SESSION['drug_tab']='';
	$_SESSION['ward_tab']='';
	$_SESSION['outcome_tab']='';
	$_SESSION['onexamination_tab']='';
		break;
	case '2':
		# code...
	
	$_SESSION['per_tab']='';
	$_SESSION['vit_tab']='active';
	$_SESSION['red_flag']='';
	$_SESSION['reviews']='';
	$_SESSION['comp_tab']='';
	$_SESSION['inves_tab']='';
//	$_SESSION['procedure_tab']='';
	$_SESSION['dia_tab']='';
	$_SESSION['drug_tab']='';
	$_SESSION['ward_tab']='';
	$_SESSION['outcome_tab']='';
	$_SESSION['onexamination_tab']='';
		break;
	case '3':
		# code...

	$_SESSION['per_tab']='';
	$_SESSION['vit_tab']='';
	$_SESSION['comp_tab']='active';
	$_SESSION['red_flag']='';
	$_SESSION['reviews']='';
	$_SESSION['inves_tab']='';
//	$_SESSION['procedure_tab']='';
	$_SESSION['dia_tab']='';
	$_SESSION['drug_tab']='';
	$_SESSION['ward_tab']='';
	$_SESSION['outcome_tab']='';
	$_SESSION['onexamination_tab']='';
		break;
	case '4':
		# code...

	$_SESSION['per_tab']='';
	$_SESSION['vit_tab']='';
	$_SESSION['comp_tab']='';
	$_SESSION['inves_tab']='active';
	$_SESSION['red_flag']='';
	$_SESSION['reviews']='';
//	$_SESSION['procedure_tab']='';
	$_SESSION['dia_tab']='';
	$_SESSION['drug_tab']='';
	$_SESSION['ward_tab']='';
	$_SESSION['outcome_tab']='';
	$_SESSION['onexamination_tab']='';
	
		break;
	case '5':
		# code...
	
	$_SESSION['per_tab']='';
	$_SESSION['vit_tab']='';
	$_SESSION['comp_tab']='';
	$_SESSION['inves_tab']='';
	//$_SESSION['procedure_tab']='active';
	$_SESSION['dia_tab']='';
	$_SESSION['red_flag']='';
	$_SESSION['reviews']='';
	$_SESSION['drug_tab']='';
	$_SESSION['ward_tab']='';
	$_SESSION['outcome_tab']='';
	$_SESSION['onexamination_tab']='';
		break;
		case '6':
		# code...
	$_SESSION['per_tab']='';
	$_SESSION['vit_tab']='';
	$_SESSION['comp_tab']='';
	$_SESSION['inves_tab']='';
	//$_SESSION['procedure_tab']='';
	$_SESSION['dia_tab']='active';
	$_SESSION['red_flag']='';
	$_SESSION['reviews']='';
	$_SESSION['drug_tab']='';
	$_SESSION['ward_tab']='';
	$_SESSION['outcome_tab']='';
	$_SESSION['onexamination_tab']='';
		break;
	case '7':
		# code...
	
	$_SESSION['per_tab']='';
	$_SESSION['vit_tab']='';
	$_SESSION['comp_tab']='';
	$_SESSION['inves_tab']='';
//	$_SESSION['procedure_tab']='';
	$_SESSION['dia_tab']='';
	$_SESSION['drug_tab']='active';
	$_SESSION['red_flag']='';
	$_SESSION['reviews']='';
	$_SESSION['ward_tab']='';
	$_SESSION['outcome_tab']='';
	$_SESSION['onexamination_tab']='';
		break;

	case '8':
		# code...

	$_SESSION['per_tab']='';
	$_SESSION['vit_tab']='';
	$_SESSION['comp_tab']='';
	$_SESSION['inves_tab']='';
	$_SESSION['procedure_tab']='';
	$_SESSION['dia_tab']='';
	$_SESSION['drug_tab']='';
	$_SESSION['ward_tab']='active';
	$_SESSION['red_flag']='';
	$_SESSION['reviews']='';
	$_SESSION['outcome_tab']='';
	$_SESSION['onexamination_tab']='';
		break;	
	case '9':
		# code...
	
	$_SESSION['per_tab']='';
	$_SESSION['vit_tab']='';
	$_SESSION['comp_tab']='';
	$_SESSION['inves_tab']='';
//$_SESSION['procedure_tab']='';
	$_SESSION['dia_tab']='';
	$_SESSION['drug_tab']='';
	$_SESSION['ward_tab']='';
	$_SESSION['outcome_tab']='active';
	$_SESSION['red_flag']='';
	$_SESSION['reviews']='';
	$_SESSION['onexamination_tab']='';
		break;	
	case '10':
		# code...
	
	$_SESSION['per_tab']='';
	$_SESSION['vit_tab']='';
	$_SESSION['comp_tab']='';
	$_SESSION['inves_tab']='';
//	$_SESSION['procedure_tab']='';
	$_SESSION['dia_tab']='';
	$_SESSION['drug_tab']='';
	$_SESSION['ward_tab']='';
	$_SESSION['outcome_tab']='';
	$_SESSION['red_flag']='active';
	$_SESSION['reviews']='';
	$_SESSION['onexamination_tab']='';
		break;	



		case '11':
			# code...
		
		$_SESSION['per_tab']='';
		$_SESSION['vit_tab']='';
		$_SESSION['comp_tab']='';
		$_SESSION['inves_tab']='';
	//	$_SESSION['procedure_tab']='';
		$_SESSION['dia_tab']='';
		$_SESSION['drug_tab']='';
		$_SESSION['ward_tab']='';
		$_SESSION['outcome_tab']='';
		$_SESSION['red_flag']='';
	$_SESSION['reviews']='active';
	$_SESSION['onexamination_tab']='';
			break;

			case '12':
				# code...
			
			$_SESSION['per_tab']='';
			$_SESSION['vit_tab']='';
			$_SESSION['comp_tab']='';
			$_SESSION['inves_tab']='';
		//	$_SESSION['procedure_tab']='';
			$_SESSION['dia_tab']='';
			$_SESSION['drug_tab']='';
			$_SESSION['ward_tab']='';
			$_SESSION['outcome_tab']='';
			$_SESSION['red_flag']='';
		$_SESSION['reviews']='';
		$_SESSION['onexamination_tab']='active';
				break;
		
	default:
		# code...
	$_SESSION['per_tab']='active';
	$_SESSION['vit_tab']='';
	$_SESSION['comp_tab']='';
	$_SESSION['inves_tab']='';
	//$_SESSION['procedure_tab']='';
	$_SESSION['dia_tab']='';
	$_SESSION['drug_tab']='';
	$_SESSION['ward_tab']='';
	$_SESSION['outcome_tab']='';
		break;
}



}

/*
* All complains functions 
*/

//this function selects a patients complains using patient ID and date
//It is used to show patients history 
function complains($patient_id, $date){

	global $connection;

	$sql = "SELECT * FROM  tbl_tmp_complain WHERE patient_id = '".$patient_id."' AND DATE( date_taken ) = '".$date."'";
	$result = mysqli_query($connection,$sql);

	if(mysqli_num_rows($result) >= 1){

		while ($row = mysqli_fetch_assoc($result)) {
			
			return $row;

		}

	}
}

//This function lists all complains
function list_complains(){
	global $connection;
	$sql = "SELECT complain_code, complain FROM complains";
	$query_run = mysqli_query($connection,$sql);

	while($row = mysqli_fetch_array($query_run) ){
 		
		echo "<option value=".$row['complain_code'].">".$row['complain']."</option>";
	}
}

function complains_name($complain_code){
	global $connection;
	$sql = "SELECT complain FROM complains WHERE complain_code = '".$complain_code."'";
	$query_run = mysqli_query($connection,$sql) or die(mysqli_error());
	$complain_name = $query_run -> fetch_assoc();
	return $complain_name['complain'];
}



function complains_name_print($diagnosis_code){
	global $connection;
	$data_diagnoses = array();
	$complain_code = explode(',', $diagnosis_code);
	foreach ($complain_code as $codes){
	$sql = "SELECT complain FROM complains WHERE complain_code = '".$codes."'";
	$query_run = mysqli_query($connection,$sql) or die(mysqli_error());
	$complain_name = $query_run -> fetch_assoc();
	$complains = $complain_name['complain'];

	array_push($data_diagnoses,$complains);

	}

	return $data_diagnoses;
	
}



function get_complains_name($complain_code){

	
	foreach ($complain_code as $complains) {
		
		echo $complain_name = complains_name($complains) . ", ";

	}

	//print_r($complain_code);

}



function get_complains_name_print($complain_code){


	//$complain_code = explode(',', $complain_code);

	
	foreach ($complain_code as $complains) {
		
	 complains_name($complains) . ", ";

	}

	//print_r($complain_code);

}

//function to get patient complains and fill table at complains (doc's page)
function get_complains($patient_id){//patients id

	global $connection;
	
	$date_taken = date('Y-m-d');
	//$time = date('Y-m-d');
	$sql = "SELECT * FROM tbl_tmp_complain WHERE patient_id ='".$patient_id."' AND date_taken ='".$date_taken."'";
	$query_run = mysqli_query($connection,$sql);
	while($row = mysqli_fetch_array($query_run) ){
 		
		return $row;

	}
}

function get_examination($patient_id){//patients id

	global $connection;
	
	$date_taken = date('Y-m-d');
	//$time = date('Y-m-d');
	$sql = "SELECT * FROM tbl_patient_examination WHERE patient_id ='".$patient_id."' AND DATE (date_time_taken) ='".$date_taken."'";
	$query_run = mysqli_query($connection,$sql);
	while($row = mysqli_fetch_array($query_run) ){
 		
		return $row;

	}
}


function get_services($patient_id){//patients id

    global $connection;

  //  $date = date('Y-m-d');
    
   // $sql="SELECT * FROM patients_services WHERE patient_id = '".$patient_id."' and DATE(date_added) = '".$date."'";
    $sql="SELECT service_code FROM patients_services WHERE patient_id = '".$patient_id."' ORDER BY id DESC LIMIT 1 ";
    $result = mysqli_query($connection,$sql);

	$result_row = $result->fetch_assoc();

	$patient_code_services = $result_row['service_code'];

   	return $patient_code_services;
}



function get_selected_complains($patient_id){
	global $connection;
	$date_taken = date('Y-m-d');
	//$time = date('Y-m-d');
	$sql = "SELECT complain FROM tbl_tmp_complain WHERE patient_id = '".$patient_id."' AND date_taken = '".$date_taken."'";
	$query_run = mysqli_query($connection,$sql) or die(mysqli_error());

	$complain_rows = $query_run->fetch_assoc();

 	$complain = $complain_rows['complain'];
	 
 	return $arrs = explode(',', $complain);

}

//Patient Complains entry
function patient_complains($doctor_id, $patient_id ,$complains,$history_complains){ // 

	global $connection;

	$date_taken = date('Y-m-d');
	$time = date('H:i:s');
	//$todays_date = date('Y-m-d');

	$sql = "SELECT id FROM tbl_tmp_complain WHERE patient_id = '".$patient_id."' AND date_taken = '".$date_taken."'";

	$result = mysqli_query($connection,$sql);

	$num_rows = mysqli_num_rows($result);

	if($num_rows == 0){
		
		$sql = "INSERT INTO tbl_tmp_complain (patient_id, complain,history_complain, doctor_id,  date_taken, time) 
		VALUES('".$patient_id."','".$complains."','".$history_complains."', '".$doctor_id."', '".$date_taken."', '".$time."')";

		$result = mysqli_query($connection,$sql);

		$_SESSION['comp_err'] = "<div class='alert alert-success alert-white rounded'>
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
									<div class='icon'><i class='fa fa-check'></i></div>
									<strong>Info!</strong> New Complain Added !
								 </div>";
						header("Location: ../treat_patient");		 
	} else if($num_rows >= 1){

		//return FALSE;
		$_SESSION['comp_err'] = "<div class='alert alert-danger alert-white rounded'>
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
									<div class='icon'><i class='fa fa-check'></i></div>
									<strong>Warning!</strong> Edit Patient's Complain for new change!
								 </div>";
								 header("Location: ../treat_patient");
		
	}

}


//Patient Complains entry
function patient_examination($patient_id,$doctor_id,$patient_medical_exam){ // 

	global $connection;

	$now = date('Y-m-d H:i:s');

	$date_taken = date('Y-m-d');
 

	$sql = "SELECT id FROM tbl_patient_examination WHERE patient_id = '".$patient_id."' AND DATE(date_time_taken) = '".$date_taken."'";

	$result = mysqli_query($connection,$sql);

	$num_rows = mysqli_num_rows($result);

	if($num_rows == 0){
		
		$sql = "INSERT INTO tbl_patient_examination (patient_id, doctor_id,date_time_taken, medical_examination) 
		VALUES('".$patient_id."','".$doctor_id."', '".$now."', '".$patient_medical_exam."')";

		$result = mysqli_query($connection,$sql);

		$_SESSION['exam_err'] = "<div class='alert alert-success alert-white rounded'>
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
									<div class='icon'><i class='fa fa-check'></i></div>
									<strong>Info!</strong> New Medical Examination Added !
								 </div>";
						header("Location: ../treat_patient");		 
	} else if($num_rows >= 1){

		//return FALSE;
		$_SESSION['exam_err'] = "<div class='alert alert-danger alert-white rounded'>
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
									<div class='icon'><i class='fa fa-check'></i></div>
									<strong>Warning!</strong> Edit Patient's Examination for new change!
								 </div>";
								 header("Location: ../treat_patient");
		
	}

}

//	edit_complains($exam_id, $doctor_id,$edit_medical_exam);

function edit_examination($exam_id,$doctor_id,$edit_medical_exam){
	global $connection;
	$sql = "UPDATE tbl_patient_examination SET medical_examination = '".$edit_medical_exam."' , doctor_id = '".$doctor_id."'  WHERE id = '".$exam_id."'";

	if($result = mysqli_query($connection,$sql)){
		$_SESSION['exam_err'] = "<div class='alert alert-success alert-white rounded'>
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
									<div class='icon'><i class='fa fa-check'></i></div>
									<strong>Examination Updated</strong> 
								 </div>";
						header("Location: ../treat_patient");	
	} else {
		$_SESSION['exam_err'] = "<div class='alert alert-danger alert-white rounded'>
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
									<div class='icon'><i class='fa fa-check'></i></div>
									<strong>Examination was not updated!</strong>
								 </div>";
								 header("Location: ../treat_patient");
	}
}


function edit_complains($id, $complains, $doctor_id,$edit_history_complains){
	global $connection;
	$sql = "UPDATE tbl_tmp_complain SET complain = '".$complains."' , doctor_id = '".$doctor_id."' , history_complain = '".$edit_history_complains."'  WHERE id = '".$id."'";

	if($result = mysqli_query($connection,$sql)){
		$_SESSION['comp_err'] = "<div class='alert alert-success alert-white rounded'>
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
									<div class='icon'><i class='fa fa-check'></i></div>
									<strong>Complain Updated</strong> 
								 </div>";
						header("Location: ../treat_patient");	
	} else {
		$_SESSION['comp_err'] = "<div class='alert alert-danger alert-white rounded'>
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
									<div class='icon'><i class='fa fa-check'></i></div>
									<strong>Complain was not updated!</strong>
								 </div>";
								 header("Location: ../treat_patient");
	}
}


/*
* All functions for Investigations
*/
function request_code(){
	$string ="LAB";
	$year = substr(date('Y'), -2);
    $length = 6;
    $rand = random_code($length);
	return $request_code = $string . $year . $rand;
}

function transaction_code($length =8){
$string = 0;
   /* Only select from letters and numbers that are readable - no 0 or O etc..*/
   $characters = "23456789ABCDEFHJKLMNPRTVWXYZ";
 
   for ($p = 0; $p < $length; $p++) 
   {
       $string .= $characters[mt_rand(0, strlen($characters)-1)];
   }
 
   return $string;
}

function getInvesTarrifs($codes){

global $connection;

$ourmoni = "SELECT Tarriffs FROM tbl_investigations WHERE investigation_code ='".$codes."'";

$ourmoni_query = mysqli_query($connection,$ourmoni);

var_dump($ourmoni_query);
						
if(mysqli_num_rows($ourmoni_query) >0){


$tarriff = $ourmoni_query->fetch_assoc();

return $tarriff['Tarriffs'];
//while($getTheMoni = mysqli_fetch_array($ourmoni)){
//	var_dump($getTheMoni);
//	var_dump($getTheMoni['Tarriffs']);
//	echo ($getTheMoni['Tarriffs']);
//return $getTheMoni['Tarriffs'];
//}


}
}

function loopNgetMeThecodes($requested_test){
//global $connection;
 $getAmont = 0;
 $theinvestigationcodes = explode(',',$requested_test);
 foreach($theinvestigationcodes as $getTheCode){
 $getAmont +=  getInvesTarrifs($getTheCode);
 //echo $getAmont;
 //return $getAmont;
 }
 return $getAmont;
 }
 
function investigation_payment($patient_id, $request_code){
	global $connection;
	$date_added = date('Y-m-d');
	$sql = "SELECT patient_id FROM investigation_payemnt2_cashier WHERE patient_id = '".$patient_id."' AND request_code = '".$request_code."' AND 
	date_added = '".$date_added."'";
	$result = mysqli_query($connection,$sql) or die(mysqli_error()); 
    
    $rows = mysqli_num_rows($result); 

    if($rows == 0 ) {
    	return 0;
    } else if($rows == 1 ) {
    	return 1;
    }
}

function is_nhis_patient($patient_id) {	
	global $connection;

	// Check if a record exists for the given patient_id
	$sql = "SELECT 1 FROM scheme WHERE patient_id = '".$patient_id."' LIMIT 1";
	$query_run = mysqli_query($connection, $sql) or die(mysqli_error($connection));

	// Return true if a record is found, false otherwise
	return mysqli_num_rows($query_run) > 0;
}


///DUPLICATION OF CODES///THIS CODE NEEDS TO BE CALLED ONCE AS IS IN func_opd

function get_claim_code() {
	global $connection;
	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

	$query = "SELECT claim_code FROM tbl_claim_tracker WHERE  deleted = 'NO' AND claim_status = 'PENDING' ORDER BY id DESC LIMIT 1";


	$query_results = mysqli_query($connection, $query);
	//$query_run = mysqli_query($connection,$sql) or die(mysqli_error());
	//confirm_query($query_results);

//        return $query_results;

	if ($row = mysqli_fetch_assoc($query_results)) {
		return $row['claim_code'];
	} else {
		return NULL;
	}
}


function sendInvestigationPayment2cashier($patient_id,$request_code,$doctor_id,$requested_test){
global $connection;
$amount = 0;
//$claim_code = get_claim_code();
//sum up of all the tarrifs
$amount = loopNgetMeThecodes($requested_test);

//var_dump($amount);
$transaction_code = transaction_code();


if(IS_CASHIER_AVAILABE == true){

	if(is_nhis_patient($patient_id)){
		$state = 1;
		$claim_code = get_claim_code();
	} else {
		$state = 0;
		$claim_code = "";
	}

}else{
	$state = 1;
	$claim_code = "";

}


	
//get amount out of the codes
$exists = investigation_payment($patient_id, $request_code);

	if($exists){
	
		$sql = "UPDATE investigation_payemnt2_cashier SET patient_id = '".$patient_id."',doctor_id = '".$doctor_id."',date_added = '".date('Y-m-d')."',
			amount = '".$amount."',transaction_code = '".$transaction_code."',request_code = '".$request_code."', state = '".$state."', claim_code = '".$claim_code."' WHERE patient_id = '".$patient_id."' AND request_code = '".$request_code."'";
		$sql_query = mysqli_query($connection,$sql);	
			
		if($sql_query){
			return true;
		} else{
			return false;
		}
		
	} else {
		$sql = "INSERT INTO investigation_payemnt2_cashier SET patient_id = '".$patient_id."',doctor_id = '".$doctor_id."',date_added = '".date('Y-m-d')."',
			amount = '".$amount."',transaction_code = '".$transaction_code."',request_code = '".$request_code."',state = '".$state."', claim_code = '".$claim_code."'";
		$insert_query = mysqli_query($connection,$sql);	
			
		if($insert_query){
			return true;
		} else{
			return false;
		}
	}
}
	
function select_request_code($patient_id) {

	global $connection;
	
	$date_added = date('Y-m-d');
	$sql = "SELECT request_code FROM tbl_req_investigation WHERE patient_id = '".$patient_id."' AND DATE(requested_date) = '".$date_added."'";

	$result = mysqli_query($connection,$sql) or die(mysqli_error());
	
	$row = mysqli_num_rows($result); 

    if($row == 0 ) {
    	return FALSE;
    } else if($row == 1 ) {
		$rows_code = $result->fetch_assoc();

		return $rows_code['request_code'];
    	//return $request_code = mysql_result($result, 0, 'request_code');
    }
	//var_dump($query_run);
	//return $request_code = mysql_result($query_run, 0, 'request_code');
} 

function investigation_amount($patient_id, $request_code) {

	global $connection;
	
	//$date_added = date('Y-m-d');
	$sql = "SELECT amount FROM investigation_payemnt2_cashier WHERE patient_id = '".$patient_id."' AND request_code = '".$request_code."'";

	$result = mysqli_query($connection,$sql) or die(mysqli_error());
	
	$row = mysqli_num_rows($result); 

    if($row == 0 ) {
    	return FALSE;
    } else if($row == 1 ) {
		$query_row_amount = $result->fetch_assoc();
    	 $amount = $query_row_amount['amount'];
		return $amount;
    }
} 

//add patient allergies


function add_patient_allergies($patient_id,$doctor_id,$allergy,$description,$requested_date){

	global $connection;

	//@$_SESSION['request_code'] = $request_code;
	
	//$date_taken = date('Y-m-d');
	
	//$time = date('H:i:s');
	 
 
	//if($num_rows == 0){

		$sql = "INSERT INTO tbl_patient_red_flag (patient_id,staff_id,name_of_allergy,summary_of_allergy,date_recorded)
		VALUES ('".$patient_id."','".$doctor_id."','".$allergy."','".$description."','".$requested_date."')";
		
		 $allergy_query = mysqli_query($connection,$sql);


		 if($allergy_query){

			$_SESSION['allergy_err']="<div class='alert alert-success alert-white rounded'>
			<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
			<div class='icon'><i class='fa fa-check'></i></div>
			<strong>Info!</strong> New Allergy Added!
		 </div>";


		 header("Location: ../treat_patient");

		 }else{

			$_SESSION['allergy_err']="<div class='alert alert-success alert-white rounded'>
			<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
			<div class='icon'><i class='fa fa-check'></i></div>
			<strong>Info!</strong> Please select patient from search box above !
		 </div>";

header("Location: ../treat_patient");
			 
		 }

 	
}


//patient revies or next visits

function add_patient_reviews($patient_id,$doctor_id,$reviewed_date,$comments){

	global $connection;

	//@$_SESSION['request_code'] = $request_code;
	
	$date_taken = date('Y-m-d');
	
	//$time = date('H:i:s');
	 
 
	//if($num_rows == 0){

		$sql = "INSERT INTO tbl_patient_review (patient_id,staff_id,date_seen,date_to_be_seen,comments)
		VALUES ('".$patient_id."','".$doctor_id."','".$date_taken."','".$reviewed_date."','".$comments."')";
		
		 $review_query = mysqli_query($connection,$sql);


		 if($review_query){

			$_SESSION['review_err']="<div class='alert alert-success alert-white rounded'>
			<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
			<div class='icon'><i class='fa fa-check'></i></div>
			<strong>Info!</strong> Patient Scheduled Recorded!
		 </div>";


		 header("Location: ../treat_patient");

		 }else{

			$_SESSION['review_err']="<div class='alert alert-success alert-white rounded'>
			<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
			<div class='icon'><i class='fa fa-check'></i></div>
			<strong>Info!</strong> Please select patient from search box above !
		 </div>";

header("Location: ../treat_patient");
			 
		 }

 	
}



function get_patient_allergies($patient_id){

	global $connection;

	$sql = "SELECT * FROM  tbl_patient_red_flag WHERE patient_id = '".$patient_id."'";
	$result = mysqli_query($connection,$sql);

	if(mysqli_num_rows($result) >= 1){

		while ($row = mysqli_fetch_array($result)) {

			$id = $row['id'];

			if ($_SESSION['uid'] == $row['staff_id']) {
				$recorded_by = "You";
			} else {

				$doctor = get_staff_info($row['staff_id']);
				$recorded_by = $doctor['firstName'] . " " . $doctor['otherNames'];
			}
			
			echo"<tr>
				<td>".$row['name_of_allergy']."</td>
									
				<td>".$row['summary_of_allergy']."</td>
					<td>".$recorded_by."</td>
					<td>".date('jS F, Y', strtotime($row['date_recorded']))."</td>
					<td class='text-center'>
				 
					 
					<a onclick='return confirm(\"CLICK OK TO CONFIRM DELETION OR CANCEL TO PREVENT DELETION...\")' class='label label-danger' href='db_tasks/undo_allergies.php?id=$id'><i class='fa fa-times'></i></a>
				</td>
			</tr>
		";

		}

	}
}



function get_patient_reviews($patient_id){

	global $connection;

	$sql = "SELECT id, date_to_be_seen, staff_id,is_sms_sent FROM  tbl_patient_review WHERE patient_id = '".$patient_id."'";
	$result = mysqli_query($connection,$sql);

	if(mysqli_num_rows($result) >= 1){

		while ($row = mysqli_fetch_array($result)) {

			$id = $row['id'];

			if ($_SESSION['uid'] == $row['staff_id']) {
				$recorded_by = "You";
			} else {

				$doctor = get_staff_info($row['staff_id']);
				$recorded_by = $doctor['firstName'] . " " . $doctor['otherNames'];
			}
			
			echo"<tr>
				<td>".$recorded_by."</td>

				<td>".date('jS F, Y', strtotime($row['date_to_be_seen']))."</td>
									
				<td>".$row['is_sms_sent']."</td>
				 
				 
					<td class='text-center'>
				 
					 
					<a onclick='return confirm(Are you sure you want to remove allergry?)' class='label label-danger' href='db_tasks/undo_reviews.php?id=$id'><i class='fa fa-times'></i></a>
				</td>
			</tr>
		";

		}

	}
}

	
function request_investigation($patient_id,$request_code,$doctor_id,$requested_date,$requested_test,$remarks){

 
	global $connection;

	@$_SESSION['request_code'] = $request_code;
	
	$date_taken = date('Y-m-d');

	$now = date('Y-m-d H:i:s');


	$investigation_code = explode(',',$requested_test );

	$requested_test_names = get_investigation_name_($investigation_code);
	
	//$time = date('H:i:s');

	 
	if(IS_CASHIER_AVAILABE == true){
	
		if(is_nhis_patient($patient_id)){
			 
			$payment_status = 1;
		} else {
			 
			$payment_status = 0;
		}	


	}else{
		$payment_status = 1;
	}
	
	
	$sql = "SELECT id FROM tbl_req_investigation WHERE patient_id = '".$patient_id."' AND DATE(requested_date) = '".$date_taken."'";

	$result = mysqli_query($connection,$sql);

	$num_rows = mysqli_num_rows($result);

	if($num_rows == 0){

		$sql = "INSERT INTO tbl_req_investigation (patient_id,request_code,doctor_id,requested_date,date_sent_ago,requested_test,request_test_name,remarks, payment_status)
		VALUES ('".$patient_id."','".$request_code."','".$doctor_id."','".$requested_date."','".$now."','".$requested_test."','".$requested_test_names."','".$remarks."','".$payment_status."')";
		
		mysqli_query($connection,$sql);

		sendInvestigationPayment2cashier($patient_id,$request_code,$doctor_id,$requested_test);
		
		$_SESSION['inves_err']="<div class='alert alert-success alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-check'></i></div>
								<strong>Info!</strong> New Investigation requested !
							 </div>";
		
		
		header("Location: ../treat_patient");

	} else if($num_rows >= 1) {
		$_SESSION['inves_err']="<div class='alert alert-success alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-check'></i></div>
								<strong>Info!</strong> Please Select Patient From Notification Tray / Edit Request If Already Recorded One!
							 </div>";
		
		header("Location: ../treat_patient");
	}	
}

function investigation_name($investigation_code){
	global $connection;
	$sql = "SELECT Investigations FROM tbl_investigations WHERE investigation_code = '".$investigation_code."'";
	$query_run = mysqli_query($connection,$sql) or die(mysqli_error());
	$query_rows_investigations = $query_run->fetch_assoc();
    $investigation_name = $query_rows_investigations['Investigations'];
	return $investigation_name;
}

function get_investigation_name_($investigation_code){
	$string = "";
	foreach ($investigation_code as $investigations) {		
		 $investigation_name = investigation_name($investigations);

		 $string .= $investigation_name.',';
		// return $investigation_name;
	}

	return $string;
}

function get_investigation_name($investigation_code){
	foreach ($investigation_code as $investigations) {		
		echo $investigation_name = investigation_name($investigations) . ", ";
	}
}

function get_investigation_name_for_claim($investigation_code){
	$a = array();
	foreach ($investigation_code as $investigations) {		
	//	$investigation_name = investigation_name($investigations) . ", ";

	   array_push($a,investigation_name($investigations));
	}

	return $a;
}
//investigation requests table list view function

function get_investigations($patient_id){//patients id

	global $connection;

	$date = date('Y-m-d');
	//$payment_status = 1;//mike was checking if the patient paid for the lab
	//$sql="SELECT * FROM tbl_req_investigation WHERE patient_id='".$patient_id."'AND DATE(requested_date) ='".$date."' AND payment_status='".$payment_status."' ";
	$sql="SELECT * FROM tbl_req_investigation WHERE patient_id='".$patient_id."'AND DATE(requested_date) ='".$date."'";
	
	$query_run=mysqli_query($connection,$sql);
	
	while($row = mysqli_fetch_array($query_run) ){
 		
		return $row;

	}
	
	 
}

function get_selected_investigations($patient_id){

	global $connection;
	
	$date_taken = date('Y-m-d');
	//$time = date('Y-m-d');
	$sql = "SELECT 	requested_test FROM tbl_req_investigation WHERE patient_id = '".$patient_id."' AND DATE(requested_date) = '".$date_taken."'";
	$query_run = mysqli_query($connection,$sql) or die(mysqli_error());

 	$investigation_record = $query_run-> fetch_assoc();

	$invest_test = $investigation_record['requested_test'];
	 
 	return $arrs = explode(',', $invest_test);
}

function get_inves_his($a){//patients id

	//$date=date('Y-m-d');

	global $connection;
	
	$sql="SELECT * FROM tbl_req_investigation WHERE patient_id='".$a."'";
	$query_run=mysqli_query($connection,$sql);


	while($see=mysqli_fetch_array($query_run)){

		$invest=$see['req_name'];
		$id = $see['id'];
		$req_code =$see['request_code'];
		$doc = $see['doctor_id'];
		$date = $see['requested_date'];
    	echo"<tr>
				<td>$date</td>
				<td>$invest</td>
				<td>by $doc</td>
			</tr>
		";
	}
}

function investigations($patient_id, $date){

	global $connection;

	$sql = "SELECT * FROM  tbl_req_investigation WHERE patient_id = '".$patient_id."' AND DATE( requested_date ) = '".$date."'";
	$result = mysqli_query($connection,$sql);

	if(mysqli_num_rows($result) >= 1){

		while ($row = mysqli_fetch_assoc($result)) {
			
			return $row;

		}

	}
}

function edit_investigations($id, $patient_id, $request_code, $investigations, $doctor_id){
     global $connection;

	@$_SESSION['request_code'] = $request_code;

	$investigation_code = explode(',',$investigations );

	$requested_test_names = get_investigation_name_($investigation_code);

	if(IS_CASHIER_AVAILABE == true){
	
		if(is_nhis_patient($patient_id)){
			$payment_status = 1;
		} else {
			$payment_status = 0;
		}	


	}else{
		$payment_status = 1;
	}
	
	// if(is_nhis_patient($patient_id)){
	// 	$payment_status = 1;
	// } else {
	// 	$payment_status = 0;
	// }
	
	$sql = "UPDATE tbl_req_investigation SET requested_test = '".$investigations."' , request_test_name = '".$requested_test_names."' , doctor_id = '".$doctor_id."' , payment_status = '".$payment_status."' WHERE id = '".$id."'";
	
	if($result = mysqli_query($connection,$sql)){
		sendInvestigationPayment2cashier($patient_id,$request_code,$doctor_id,$investigations);
		$_SESSION['comp_err'] = "<div class='alert alert-success alert-white rounded'>
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
									<div class='icon'><i class='fa fa-check'></i></div>
									<strong>Investigation Updated</strong> 
								 </div>";
						header("Location: ../treat_patient");	
	} else {
		$_SESSION['comp_err'] = "<div class='alert alert-danger alert-white rounded'>
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
									<div class='icon'><i class='fa fa-check'></i></div>
									<strong>Investigation was not updated!</strong>
								 </div>";
								 header("Location: ../treat_patient");
	}
}
//investigation requests table list view function
function list_investigations(){
	global $connection;
	//$sql = "SELECT * FROM tbl_investigations";
	$sql = "SELECT investigation_code, Investigations FROM tbl_investigations";
	$query_run = mysqli_query($connection,$sql);

	while($row = mysqli_fetch_array($query_run) ){
 		
		echo "<option value=".$row['investigation_code'].">".$row['Investigations']."</option>";
	}
	
}

//Remove patient's payment at cashiers end
function remove_investigation_payment($patient_id, $request_code){
	global $connection;
	
	$sql = "DELETE FROM investigation_payemnt2_cashier WHERE patient_id = '".$patient_id."' AND request_code = '".$request_code."'";
	//$query_run = mysql_query($sql);
	if(mysqli_query($connection,$sql) or die(mysqli_error())){
		return TRUE;
	} else {
		return FALSE;
	}
}


function date_history($patient_id){

	global $connection;
	

	$sql = "SELECT * FROM tbl_consulting WHERE patient_id = '".$patient_id."'";

	$result = mysqli_query($connection,$sql);

	if(mysqli_num_rows($result) >= 1){

		while ($row = mysqli_fetch_assoc($result)) {


			
			// extract($row);
			 $doctor_room = explode('-', $row['doctor_room']);
			 @$doctor = doctor($doctor_room[0]);
			 @$room = consulting_room($doctor_room[1]);
			 $date_sent_ = $row['date_sent'];
 
			echo "
				<tr class='gradeA'>
					<td>".date('jS M, Y', strtotime("$date_sent_"))."</td>
					<td>".date('l', strtotime("$date_sent_"))."</td>
					<td>".$doctor['firstName']." ".$doctor['otherNames']."</td>
					
					<td>{$room}</td>
					<td class='center'><div class='btn-group'><a class='btn btn-default btn-xs' href='history.php?date={$date_sent_}' data-original-title='View History' data-toggle='tooltip'><i class='fa fa-eye'></i></a></div> </td>
				</tr>
			";
		}

	}
}


//LOADING PATIENT SUMMARY

function get_complains_history($patient_id,$date_taken){//patients id

	global $connection;
	
	//$date_taken = date('Y-m-d');
	//$time = date('Y-m-d');
	$sql = "SELECT * FROM tbl_tmp_complain WHERE patient_id ='".$patient_id."' AND date_taken ='".$date_taken."'";
	$query_run = mysqli_query($connection,$sql);
	while($row = mysqli_fetch_array($query_run) ){
 		
		return $row;

	}
}


function get_patient_vitals_history($patient_id,$date_taken){//patients id

	global $connection;
	
	//$date_taken = date('Y-m-d');
	//$time = date('Y-m-d');
	$sql = "SELECT weight,temperature,blood_pressure_top,blood_pressure_down,pulse,taken_by FROM tbl_patient_biovitals WHERE patient_id ='".$patient_id."' AND date_taken ='".$date_taken."'";
	$query_run = mysqli_query($connection,$sql);
	while($row = mysqli_fetch_array($query_run) ){
 		
		return $row;

	}
}

function get_patient_lab_request_history($patient_id,$date_taken){//patients id

	global $connection;
	
	//$date_taken = date('Y-m-d');
	//$time = date('Y-m-d');
	$sql = "SELECT request_test_name,doctor_id FROM tbl_req_investigation WHERE patient_id ='".$patient_id."' AND requested_date ='".$date_taken."'";
	$query_run = mysqli_query($connection,$sql);
	while($row = mysqli_fetch_array($query_run) ){
 		
		return $row;

	}
}

function get_patient_medical_examination_history($patient_id,$date_taken){//patients id

	global $connection;
	
	//$date_taken = date('Y-m-d');
	//$time = date('Y-m-d');
	$sql = "SELECT medical_examination,doctor_id FROM tbl_patient_examination WHERE patient_id ='".$patient_id."' AND DATE(date_time_taken) ='".$date_taken."'";
	$query_run = mysqli_query($connection,$sql);
	while($row = mysqli_fetch_array($query_run) ){
 		
		return $row;

	}
}


function get_patient_prescription_history($patient_id,$date_taken){//patients id

	global $connection;
	
	//$date_taken = date('Y-m-d');
	//$time = date('Y-m-d');

//	$dosage =  $pres['quantity']." X ".$pres['times']." ".$pres['time_interval']." For ".$pres['duration']." ".$pres['time_span'];

//	$drug_quantity = $pres['drug_qty'];

//	$doctor = doctor($pres['doc_code']);

	$sql = "SELECT quantity,times,time_interval,duration,time_span,drug_qty,doc_code,drug_code FROM  tbl_precribtion WHERE patient_id = '".$patient_id."' AND DATE( date_added ) = '".$date_taken."'";
//	$sql = "SELECT * FROM tbl_req_investigation WHERE patient_id ='".$patient_id."' AND requested_date ='".$date_taken."'";
	$query_run = mysqli_query($connection,$sql);
	if($row = mysqli_num_rows($query_run) > 0 ){
 		
		return $query_run;

	}else{
		return FALSE;
	}
}
 


function date_history_($patient_id){

	global $connection;


	$complains = "";
	$diagnosis_names = "";
	$string_prescription = "";
	$prescribed_name = "";
	

	$sql = "SELECT doctor_room,date_sent FROM tbl_consulting WHERE patient_id = '".$patient_id."'";

	$result = mysqli_query($connection,$sql);

	if(mysqli_num_rows($result) >= 1){

		while ($row = mysqli_fetch_assoc($result)) {


			
			// extract($row);
			 $doctor_room = explode('-', $row['doctor_room']);
			 @$doctor = doctor($doctor_room[0]);
			 @$room = consulting_room($doctor_room[1]);
			 $date_sent_ = $row['date_sent'];

			 $patient_vitals = get_patient_vitals_history($patient_id,$date_sent_);

			 if($patient_vitals != null){

				$vital_taken_by = get_staff_info($patient_vitals['taken_by']);
   
				$names_of_vitals_taken = $vital_taken_by['firstName']." ".$vital_taken_by['otherNames'];
   
				$vitals = "Weight: ".$patient_vitals['weight'].", Temperature: ".$patient_vitals['temperature'].", Pulse: ".$patient_vitals['pulse'].", 
				Pressure: ".$patient_vitals['blood_pressure_top']." / ".$patient_vitals['blood_pressure_down']."<br/>"."Taken By: ".$names_of_vitals_taken;
			 }else{

                $vitals = "-";
			 }

			
			 $patient_complains = get_complains_history($patient_id,$date_sent_);

			 if($patient_complains != null){

				$complains_codes = $patient_complains['complain'];
				$history_complain = $patient_complains['history_complain'];

				$complains = get_complains_name_($complains_codes);
   
				$complains_taken_by = $patient_complains['doctor_id'];
   
				if($complains_taken_by == $_SESSION['uid']){
				   $complains_taken_by = "Recorded By: ". "You";
				}else{
   
   
				   
				   $complains_taken_by = get_staff_info($complains_taken_by);
   
				   $complains_taken_by = "Recorded By: ". $complains_taken_by['firstName']." ".$complains_taken_by['otherNames'];
   
				}
   

			 }else{

                   $complain = "-";
				   $complains_taken_by = "-";
			 }




			 $patient_examination = get_patient_medical_examination_history($patient_id,$date_sent_);

			 $diagnosis = diagnosis($patient_id,$date_sent_);


			 if($diagnosis != null){

				$dia_codes = $diagnosis['diagnosis'];


				$diagnosis_names = get_diagnosis_name_($dia_codes);
   
				$diagnosis_taken = $diagnosis['doc_id'];
   
				if($diagnosis_taken == $_SESSION['uid']){
				   $diagnosis_taken = "Recorded by: ". "You";
				}else{
   
   
				   
				   $diagnosis_taken = get_staff_info($diagnosis_taken);
   
				   $diagnosis_taken = "Recorded by: ". $diagnosis_taken['firstName']." ".$diagnosis_taken['otherNames'];
   
				}

			 }else{

				$diagnosis_names = "-";

				$diagnosis_taken = "-";



			 }

		


			 $prescription = get_patient_prescription_history($patient_id,$date_sent_);

			 if($prescription){

				$dosage = "";

				$drug_quantity = "";
   
				$pres_by = "";
   
				foreach ($prescription as $pres) {
   
				   //<td>".$row['quantity']." X ".$row['times']." ".$row['time_interval']." For ".$row['duration']." ".$row['time_span']."</td>
   
				   $dosage =  $pres['quantity']." X ".$pres['times']." ".$pres['time_interval']." For ".$pres['duration']." ".$pres['time_span'];
   
				//   $drug_quantity = $pres['drug_qty'];


				   if($pres['drug_qty']==""){
					$drug_quantity =  cal_quantity($pres['quantity'],$pres['times'],$pres['time_interval'],$pres['duration'],$pres['time_span']);
				 }else{
				$drug_quantity =  $pres['drug_qty'];
				 }

   
				   $doctor = doctor($pres['doc_code']);
   
				   if($pres['doc_code']==$_SESSION['uid']){
					   $prescribed_name = "Prescribed By: " ."You";
				   }else{
					   $prescribed_name = "Prescribed By: ". $doctor['firstName'] ." ". $doctor['otherNames'];
				   }
   
				   $string_prescription .= drug_name($pres['drug_code'])."($drug_quantity)"." Dosage: "."$dosage".','.'<br/>';	
   
				}


			 }else{

				$string_prescription = "";
				$prescribed_name = "";

			 }

			



			 
			 if($patient_examination){
				if($patient_examination['doctor_id'] == $_SESSION['uid']){
					$patient_taken_by = "You";
				 }else{
	
	
					
					$patient_taken_by = get_staff_info($patient_examination['doctor_id']);
	
					$patient_taken_by = $patient_taken_by['firstName']." ".$patient_taken_by['otherNames'];
	
				 }
				$patient_exams = $patient_examination['medical_examination']."<br/>"."Taken by: ".$patient_taken_by;
			 }else{
				 $patient_exams = "-";
			 }

			
 
			echo "<tr>
					<td>".date('jS M, Y', strtotime("$date_sent_")).", ".date('l', strtotime("$date_sent_"))."</td>
					 
				    <td>".$vitals."</td>

					<td>".$complains."<br/>".$history_complain." "." ".$complains_taken_by."</td>


					<td>".$patient_exams."</td>

					<td>".$diagnosis_names."<br/>"." ".$diagnosis_taken."</td>


					<td>".$string_prescription."<br/>"." ".$prescribed_name."</td>
			
					</tr>";
		}

	}
}



function vitals_history_($patient_id){

	global $connection;
	

	$sql = "SELECT date_sent FROM tbl_consulting WHERE patient_id = '".$patient_id."'";

	$result = mysqli_query($connection,$sql);

	if(mysqli_num_rows($result) >= 1){

		while ($row = mysqli_fetch_assoc($result)) {
			$date_sent_ = $row['date_sent'];

			$patient_vitals = get_patient_vitals_history($patient_id,$date_sent_);

			$names = get_staff_info($patient_vitals['taken_by']);

			$fullname = $names['firstName']." ".$names['otherNames'];

			$full_pressure = $patient_vitals['blood_pressure_top']." / ".$patient_vitals['blood_pressure_down'];

			echo "<tr>
			<td>".date('jS M, Y', strtotime("$date_sent_")).", ".date('l', strtotime("$date_sent_"))."</td>
			 
			<td>".$patient_vitals['weight']."</td>
 
			<td>".$patient_vitals['temperature']."</td>

			<td>".$patient_vitals['pulse']."</td>


			<td>".$full_pressure."</td>
			<td>".$fullname."</td>

 
	
			</tr>";


		}
	}

}



function complains_history_($patient_id){

	global $connection;
	

	$sql = "SELECT date_sent FROM tbl_consulting WHERE patient_id = '".$patient_id."'";

	$result = mysqli_query($connection,$sql);

	if(mysqli_num_rows($result) >= 1){

		while ($row = mysqli_fetch_assoc($result)) {
			$date_sent_ = $row['date_sent'];

			$patient_complains = get_complains_history($patient_id,$date_sent_);

			$medical_examination = $patient_complains['history_complain'];

			if($_SESSION['uid'] == $patient_complains['doctor_id']){
				$fullname = "You";
			}else{

				$names = get_staff_info($patient_complains['doctor_id']);

				$fullname = $names['firstName']." ".$names['otherNames'];
			}

			$complains = get_complains_name_($patient_complains['complain']);

			

			echo "<tr>
			<td>".date('jS M, Y', strtotime("$date_sent_")).", ".date('l', strtotime("$date_sent_"))."</td>
			  
 
			<td>".$complains."<b/>".$medical_examination."</td>
 

			<td>".$fullname."</td>

 
	
			</tr>";


		}
	}

}


function investigations_history_($patient_id){

	global $connection;
	

	$sql = "SELECT date_sent FROM tbl_consulting WHERE patient_id = '".$patient_id."'";

	$result = mysqli_query($connection,$sql);

	if(mysqli_num_rows($result) >= 1){

		while ($row = mysqli_fetch_assoc($result)) {
			$date_sent_ = $row['date_sent'];

			$patient_complains = get_patient_lab_request_history($patient_id,$date_sent_);

			if($_SESSION['uid'] == $patient_complains['doctor_id']){
				$fullname = "You";
			}else{

				$names = get_staff_info($patient_complains['doctor_id']);

				$fullname = $names['firstName']." ".$names['otherNames'];
			}

			$complains = $patient_complains['request_test_name'];

			if($complains == null){
				$complains = "-";
			}else{
				$complains = $complains;

			}

			

			echo "<tr>
			<td>".date('jS M, Y', strtotime("$date_sent_")).", ".date('l', strtotime("$date_sent_"))."</td>
			  
 
			<td>".$complains."</td>
 

			<td>".$fullname."</td>

 
	
			</tr>";


		}
	}

}


function examination_history_($patient_id){

	global $connection;
	

	$sql = "SELECT date_sent FROM tbl_consulting WHERE patient_id = '".$patient_id."'";

	$result = mysqli_query($connection,$sql);

	if(mysqli_num_rows($result) >= 1){

		while ($row = mysqli_fetch_assoc($result)) {
			$date_sent_ = $row['date_sent'];

			$patient_examination = get_patient_medical_examination_history($patient_id,$date_sent_);

			if($_SESSION['uid'] == $patient_examination['doctor_id']){
				$fullname = "You";
			}else{

				$names = get_staff_info($patient_examination['doctor_id']);

				$fullname = $names['firstName']." ".$names['otherNames'];
			}

			$medical_examination = $patient_examination['medical_examination'];

			if($medical_examination == null){
				$medical_examination = "-";
			}else{
				$medical_examination = $medical_examination;

			}

			

			echo "<tr>
			<td>".date('jS M, Y', strtotime("$date_sent_")).", ".date('l', strtotime("$date_sent_"))."</td>
			  
 
			<td>".$medical_examination."</td>
 

			<td>".$fullname."</td>

 
	
			</tr>";


		}
	}

}




function diagnosis_history_($patient_id){

	global $connection;
	

	$sql = "SELECT date_sent FROM tbl_consulting WHERE patient_id = '".$patient_id."'";

	$result = mysqli_query($connection,$sql);

	if(mysqli_num_rows($result) >= 1){

		while ($row = mysqli_fetch_assoc($result)) {
			$date_sent_ = $row['date_sent'];

			$patient_complains = diagnosis($patient_id,$date_sent_);

			if($_SESSION['uid'] == $patient_complains['doc_id']){
				$fullname = "You";
			}else{

				$names = get_staff_info($patient_complains['doc_id']);

				$fullname = $names['firstName']." ".$names['otherNames'];
			}

			$complains = $patient_complains['diagnosis'];

			$diag = get_diagnosis_name_($complains);

			if($complains == null){
				$diag = "-";
			}else{
				$diag = $diag;
			}

			

			echo "<tr>
			<td>".date('jS M, Y', strtotime("$date_sent_")).", ".date('l', strtotime("$date_sent_"))."</td>
			  
 
			<td>".$diag."</td>
 

			<td>".$fullname."</td>

 
	
			</tr>";


		}
	}

}




function prescription_history_($patient_id){

	global $connection;


	$string_prescription = "";
	$prescribed_name = "";
	$drug_quantity =  "";
	

	$sql = "SELECT date_sent FROM tbl_consulting WHERE patient_id = '".$patient_id."'";

	$result = mysqli_query($connection,$sql);

	if(mysqli_num_rows($result) >= 1){

		while ($row = mysqli_fetch_assoc($result)) {
			$date_sent_ = $row['date_sent'];

			$prescription = get_patient_prescription_history($patient_id,$date_sent_);

			if($prescription){

				foreach ($prescription as $pres) {

					//<td>".$row['quantity']." X ".$row['times']." ".$row['time_interval']." For ".$row['duration']." ".$row['time_span']."</td>
	
					$dosage =  $pres['quantity']." X ".$pres['times']." ".$pres['time_interval']." For ".$pres['duration']." ".$pres['time_span'];
	
					if($pres['drug_qty']==""){
						$drug_quantity =  cal_quantity($pres['quantity'],$pres['times'],$pres['time_interval'],$pres['duration'],$pres['time_span']);
					 }else{
					$drug_quantity =  $pres['drug_qty'];
					 }
	
					$doctor = doctor($pres['doc_code']);
	
					if($pres['doc_code']==$_SESSION['uid']){
						$prescribed_name = "Prescribed By: ". "You";
					}else{
						$prescribed_name ="Prescrubed By: ". $doctor['firstName'] ." ". $doctor['otherNames'];
					}
	
					
	
					// if($doc_code == $doctor_id){
					// 	return "You";
					// } else {
					// 	$doctor = doctor($doctor_id);
					// 	return $doctor['firstName'] ." ". $doctor['otherNames'];
					// }
	
					$string_prescription .= drug_name($pres['drug_code'])."($drug_quantity)"." Dosage: "."$dosage".','.'<br/>';	
	
				 }

			}else{

				$string_prescription = "";
				$prescribed_name = "";

			}

			

			
 
			

			echo "<tr>
			<td>".date('jS M, Y', strtotime("$date_sent_")).", ".date('l', strtotime("$date_sent_"))."</td>
			  
 
			<td>".$string_prescription."<br/>"." ".$prescribed_name."</td>

 

 
	
			</tr>";
			}

		}
	}




function get_complains_name_($complain_code){
	$string = "";
	$complain_code = explode(',', $complain_code);
	foreach ($complain_code as $complains) {		
		 $complain_name = complains_name($complains);

		 $string .= $complain_name.',';
		// return $investigation_name;
	}

	return $string;
}

function get_diagnosis_name_($complain_code){
	$string = "";
	$complain_code = explode(',', $complain_code);
	foreach ($complain_code as $complains) {		
		 $complain_name = diagnosis_name($complains);

		 $string .= $complain_name.',';
		// return $investigation_name;
	}

	return $string;
}


function load_patient_history_summary($patient_id){
	global $connection;

	$row_Per_Page = 3;

	$theSQL = "SELECT * FROM tbl_patient_info,tbl_consulting,tbl_tmp_complain WHERE
	 tbl_patient_info.patient_id = tbl_consulting.patient_id 
	 AND tbl_consulting.date_sent = tbl_tmp_complain.date_taken 
	AND tbl_patient_info.patient_id = '".$patient_id."' ";

$thePatientsSummaryHistory = mysqli_query($connection,$theSQL);

if(mysqli_affected_rows($connection) >0){
	while ($Patient= mysqli_fetch_array($thePatientsSummaryHistory)) {

		$date_sent_ = $Patient['date_sent'];

	//	$patient_vitals = "Weight: ". $Patient['weight']." "."Temperature: ". $Patient['temperature'];

	//	$complain_code = explode(',', $Patient['complain']);
  
		echo "
		<tr>
			<td>".date('jS M, Y', strtotime("$date_sent_"))."</td>


			<td></td>
			 
			<td>".get_complains_name_($Patient['complain'])."</td>
			
			 
			</tr>
	"; 


	 
	}
 

}else{
	return false;
}


}

function doctor($doctor_id){

	global $connection;

    $sql = "SELECT tbl_staff.staff_id, tbl_staff.firstName, tbl_staff.otherNames FROM tbl_staff WHERE tbl_staff.staff_id = '".$doctor_id."' ";
    $result = mysqli_query($connection,$sql);
    //$rows = mysql_num_rows($result);
   
    while( $row = mysqli_fetch_assoc($result)){
        
        return $row;
        
    }
}

function consulting_room($room_id){
	global $connection;
    $sql = "SELECT name FROM consulting_room WHERE room_id = '".$room_id."'";
    $result = mysqli_query($connection,$sql);
	$results_name = $result->fetch_assoc();
    $name = $results_name['name'];
    return $name;
}


function diagnosis($patient_id, $date){

	global $connection;

	$sql = "SELECT diagnosis,doc_id FROM  tbl_diagnosis WHERE patient_id = '".$patient_id."' AND DATE( date_added ) = '".$date."'";
	$result = mysqli_query($connection,$sql);

	if(mysqli_num_rows($result) >= 1){

		while ($row = mysqli_fetch_assoc($result)) {
			
			return $row;

		}

	}
}


//function to add new diagnosis
function add_new_diagnosis($name,$added_by){
	global $connection;
	$date_added = date('Y-m-d H:i:s');
	$diagnosis_code = diagnosis_code();
	$sql = "INSERT INTO tbl_diagnosis_list (name,added_by,date_added, diagnosis_code) VALUES 
	('".$name."','".$added_by."','".$date_added."','".$diagnosis_code."')";

	mysqli_query($connection,$sql);

}

function add_complain($complain, $added_by) {

    global $connection;

	$category = "Other";
	$date_added = date('Y-m-d H:i:s');
    $complain_code = "C".diagnosis_code();
    $sql = "INSERT INTO complains SET complain_code = '" . $complain_code . "', category = '" . $category . "', complain = '" . $complain . "', added_by = '" . $added_by . "', date_added = '" . $date_added . "'";

    if (mysqli_query($connection,$sql)) {
        return TRUE;
    } else {
        return FALSE;
    }
}
//function to add patient diagnosis
function add_pat_diag($patient_id,$doc_id,$diagnosis){

	global $connection;

	$date_added = date('Y-m-d');
	
	

	$sql = "SELECT * FROM tbl_diagnosis WHERE patient_id = '".$patient_id."' AND DATE(date_added) = '".$date_added."'";

	$result = mysqli_query($connection,$sql);

	$num_rows = mysqli_num_rows($result);

	if($num_rows == 0){

		$sql= "INSERT INTO tbl_diagnosis (patient_id,doc_id,diagnosis,date_added) VALUES
		('".$patient_id."','".$doc_id."','".$diagnosis."','".$date_added."')";

		mysqli_query($connection,$sql);
		
		$_SESSION['diag_err']="<div class='alert alert-success alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-check'></i></div>
								<strong>Info!  Diagnosis added to Patient's folder !</strong>
							 </div>";
		

		header("Location: ../treat_patient.php");

	} else if($num_rows >= 1) {

		$_SESSION['diag_err']="<div class='alert alert-warning alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-check'></i></div>
								<strong>Info!  Edit Diagnosis if change is needed.</strong>
							 </div>";
		

		header("Location: ../treat_patient.php");

	}
}
//function to get diagnosis
function list_diagnosis(){

	global $connection;

	$sql= "SELECT * FROM tbl_diagnosis_list";

	$query_run = mysqli_query($connection,$sql);
	while($result=mysqli_fetch_assoc($query_run)){
		
		echo "<option value=".$result['diagnosis_code'].">".$result['name']."</option>";
	}

}


function list_wards(){

	global $connection;

	$sql= "SELECT id,ward_name,service_department,gender_ward_type FROM tbl_ward WHERE available_bed > 0";

	$query_run = mysqli_query($connection,$sql);
	while($result=mysqli_fetch_assoc($query_run)){
		
		echo "<option value=".$result['id'].">"."(".$result['ward_name'].",".$result['service_department']." ".",".$result['gender_ward_type'].")"."</option>";
	}

}

function diagnosis_name($diagnosis_code){
	global $connection;
	$sql = "SELECT name FROM tbl_diagnosis_list WHERE diagnosis_code = '".$diagnosis_code."'";
	$query_run = mysqli_query($connection,$sql) or die(mysqli_error());
	 $diagnosis_name = $query_run->fetch_assoc();
	return $diagnosis_name['name'];
}

function get_diagnosis_name($diagnosis_code){
	foreach ($diagnosis_code as $diagnosis) {
		
		echo $diagnosis_name = diagnosis_name($diagnosis) . ", ";

	}
}

function get_selected_diagnosis($patient_id){

	global $connection;
	
	$date_added = date('Y-m-d');
	//$time = date('Y-m-d');
	$sql = "SELECT 	diagnosis FROM tbl_diagnosis WHERE patient_id = '".$patient_id."' AND DATE(date_added) = '".$date_added."'";
	$query_run = mysqli_query($connection,$sql) or die(mysqli_error());

 	$diagnosis_records = $query_run->fetch_assoc();

	$diagnosis = $diagnosis_records['diagnosis'];
	 
 	return $arrs = explode(',', $diagnosis);
}


function edit_diagnosis($id, $diagnose, $doctor_id){

	global $connection;
	$sql = "UPDATE tbl_diagnosis  SET diagnosis = '".$diagnose."' , doc_id = '".$doctor_id."'  WHERE id = '".$id."'";

	if($result = mysqli_query($connection,$sql)){
		$_SESSION['comp_err'] = "<div class='alert alert-success alert-white rounded'>
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
									<div class='icon'><i class='fa fa-check'></i></div>
									<strong>Investigation Updated</strong> 
								 </div>";
						header("Location: ../treat_patient.php");	
	} else {
		$_SESSION['comp_err'] = "<div class='alert alert-danger alert-white rounded'>
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
									<div class='icon'><i class='fa fa-check'></i></div>
									<strong>Investigation was not updated!</strong>
								 </div>";
								 header("Location: ../treat_patient.php");
	}


}

//function to get diagnosis added by doctor to patient
function get_diagnosis($patient_id){//patients id

	global $connection;

	//$date=date('d/m/Y');
	$date = date('Y-m-d');
	
	$sql="SELECT  * FROM tbl_diagnosis WHERE patient_id = '".$patient_id."' AND DATE(date_added) = '".$date."'";
	$query_run=mysqli_query($connection,$sql) or die(mysqli_error());

	while($row = mysqli_fetch_array($query_run)){
		return $row;
	}
	
}

//All Prescribtion functions
function prescribtion($patient_id, $date){
	global $connection;
	$sql = "SELECT tbl_precribtion.*, despensed_drugs.staff_id FROM tbl_precribtion, despensed_drugs WHERE tbl_precribtion.drug_code = despensed_drugs.drug_code AND 
	tbl_precribtion.patient_id = '".$patient_id."'  AND despensed_drugs.date_added = '".$date."'";
	
	$result = mysqli_query($connection,$sql) or die(mysqli_error());

	if(mysqli_num_rows($result) >= 1){

		while ($rows = mysqli_fetch_assoc($result)) {
			
			/*echo "
				<tr class='gradeA'>
					<td>{$drug_code}</td>
					<td>{$dosage}</td>
					<td>{$doc_code}</td>
					<td>{$staff_id}</td>
				</tr>
			";*/
			
			echo "
				<tr>
					<td>".$rows['drug_code']."</td>
				</tr>
			";
		}

	}
}

//function to add prescribtion by doctor
function add_prescribtion($drug,$doc_id,$pid,$dosage,$times,$rate,$time_interval,$date,$duration,$quantity,$time_span,$drug_qty,$pres_comment){

	global $connection;

	 

	$date_added = date('Y-m-d');
	
	

	$sql_check_prescription = "SELECT drug_code FROM tbl_precribtion WHERE patient_id = '".$pid."' AND DATE(date_added) = '".$date_added."' AND drug_code  = '".$drug."'";

	$result_check = mysqli_query($connection,$sql_check_prescription);

	$num_rows = mysqli_num_rows($result_check);

	if($num_rows >= 1){

		return FALSE;
	}else{

    $sql="INSERT INTO tbl_precribtion (drug_code,doc_code,patient_id,dosage,times,rate,time_interval,date_added,duration,quantity,time_span,drug_qty,pres_comment)
	VALUES ('".$drug."','".$doc_id."','".$pid."','".$dosage."','".$times."','".$rate."','".$time_interval."','".$date."','".$duration."','".$quantity."','".$time_span."','".$drug_qty."','".$pres_comment."')";
	
	if(mysqli_query($connection,$sql) or die(mysqli_error())){
		return TRUE;
	} else {
		return FALSE;
	}

	}
		
	
		
}

function list_drugs(){
	global $connection;

	$sql= "SELECT drug_code,Name FROM tbl_drug_list WHERE quantity > 0";

	$query_run = mysqli_query($connection,$sql);
	while($result=mysqli_fetch_array($query_run)){

		
		
		echo "<option value=".$result['drug_code'].">".$result['Name']."</option>";
	}
	
}


function drug_name($drug_code){
	global $connection;
	$sql = "SELECT Name FROM tbl_drug_list WHERE drug_code = '".$drug_code."'";
	$query_run = mysqli_query($connection,$sql) or die(mysqli_error());
	$drug_name_rows = $query_run -> fetch_assoc();
	$diagnosis_name = $drug_name_rows['Name'];
	return $diagnosis_name;
}

//this function retrieve prescribtion given to patient by doctor

function get_prescribtion_doctor($patient_id, $doctor_id){

	global $connection;

	$date = date('Y-m-d');
	$sql="SELECT doc_code FROM tbl_precribtion WHERE patient_id = '".$patient_id."'AND DATE(date_added) ='".$date."'";
	
	$query_run = mysqli_query($connection,$sql) or die(mysqli_error());

	$query_code_run = $query_run->fetch_assoc();

	$doc_code = $query_code_run['doc_code'];
	
	if($doc_code == $doctor_id){
		return "You";
	} else {
		$doctor = doctor($doctor_id);
		return $doctor['firstName'] ." ". $doctor['otherNames'];
	}
	
}



function cal_quantity($v1,$v2,$v3,$v4,$v5){

	$TotalTQ =0;
	$TotalDosege =0;
	
	if($v3 =='Hourly'){
	  
	$TotalDosege =$v1 * $v2 * $v4; 
	
	}elseif($v3 =='Daily'){
	  $TotalDosege = $v1 * $v2 * $v4; 
	  
	}elseif($v3 =='Weekly'){
	$TotalDosege =$v2 *$v4; 
	}elseif($v3 =='Yearly'){
	 $TotalDosege = $v1 * $v2 * $v4; 
	}elseif($v3 =='Monthly'){
	 $TotalDosege = $v1 * $v2 *$v4; 
	}
	
	
	if($v5 =='Day(s)'){
	$ts=1; 
	}elseif($v5 =='Week(s)'){
	$ts = 7; 
	}elseif($v5 =='Month(s)'){
	$ts = 30; 
	}elseif($v5 =='Year(s)'){
	$ts = 365; 
	}
	
	 $TotalTQ = $TotalDosege * $ts;   //*$ts;
	
	 return $TotalTQ;
	
	
}

//echo get_prescribtion_doctor('PAT1400', 'THstaff7');

function get_prescribtion($patient_id){

	global $connection;

	$date = date('Y-m-d');
	$sql="SELECT * FROM tbl_precribtion WHERE patient_id = '".$patient_id."'AND DATE(date_added) ='".$date."'";
	
	if($query_run=mysqli_query($connection,$sql)){
	
	while($row = mysqli_fetch_array($query_run) ){

		$qty = 0;

		if($row['drug_qty']==""){
		   $qty =  cal_quantity($row['quantity'],$row['times'],$row['time_interval'],$row['duration'],$row['time_span']);
		}else{
	   $qty =  $row['drug_qty'];
		}
 		
		echo"
			 <tr>						
				<td>".drug_name($row['drug_code'])."</td>

				<td>".$qty."</td>
				
				<td>".$row['quantity']." X ".$row['times']." ".$row['time_interval']." For ".$row['duration']." ".$row['time_span']."</td>
				<td>".get_prescribtion_doctor($patient_id, @$_SESSION['uid'])."</td>
				<td class='text-center'><a class='label label-danger' href='db_tasks/undo_prescribe.php?id=".$row['id']."'><i class='fa fa-times'></i></a></td>
			</tr>
		";
		
	}
	/*while($see=mysql_fetch_array($query_run)){
		$id = $see['id'];
		$name=$see['drug_code'];
		$dosage = $see['dosage'];
		$times = $see['times'];
		$rate = $see['rate'];
		$time=$see['time_interval'];
    echo"

     <tr>						
		<td>$name</td>
		
		<td>$dosage / $times times $rate $time</td>
		<td>".@$_SESSION['uid']."</td>
		<td class='text-center'><a class='label label-danger' href='db_tasks/undo_prescribe.php?id=$id'><i class='fa fa-times'></i></a></td>
	</tr>
";
	}*/
} else{
	echo "string ".mysqli_error();
}
}



//echo get_prescribtion_doctor('PAT1400', 'THstaff7');

function get_audit_trail(){

	global $connection;

	$date = date('Y-m-d');
	$user = $_SESSION['uid'];
	$sql="SELECT log_time_stamp,activity,user_page_accessed FROM audit_trail WHERE user = '".$user."' ORDER BY log_time_stamp desc ";
	
	if($query_run=mysqli_query($connection,$sql)){
	
	while($row = mysqli_fetch_array($query_run) ){
 		
		echo"
			 <tr>						
				<td>".date("F jS, Y g:i A", strtotime($row['log_time_stamp']))."</td>

				<td>".$row['activity']."</td>
				
				<td>".$row['user_page_accessed']."</td>
				 
				 
			</tr>
		";
		
	}} else{
	echo "string ".mysqli_error();
}
}

function ward_assignment($ward_code, $patient_id, $doctor_id, $comments, $date_added){
	global $connection;
	$date_time = $date = date('Y-m-d H:i:s');
	$ward_assignment_id = md5(uniqid($date_time, true));
	$sql="INSERT INTO ward_assignment (ward_id,ward_assignment_id, patient_id, doctor_id, comments, date_added)
	VALUES ('".$ward_code."','".$ward_assignment_id."','".$patient_id."','".$doctor_id."','".$comments."','".$date_added."')";
	
	if(mysqli_query($connection,$sql) or die(mysqli_error())){
		return TRUE;
	} else {
		return FALSE;
	}
}

function get_patient_on_admission($patient_id) {
	global $connection;
	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

	$query = "SELECT * FROM ward_assignment WHERE  patient_id = '".$patient_id."' AND status = 'ON ADMISSION' ORDER BY id DESC LIMIT 1";


	$query_results = mysqli_query($connection, $query);
	//$query_run = mysqli_query($connection,$sql) or die(mysqli_error());
	//confirm_query($query_results);

//        return $query_results;

	if ($row = mysqli_fetch_assoc($query_results)) {
		return $row;
	} else {
		return NULL;
	}
}

function end_patient_admission_outcome($patient_id,$ward_assignment_id, $outcome,$updated_by ){

	global $connection;

$date_updated = date('Y-m-d H:i:s');
	
//	$sql="UPDATE ward_assignment SET status = '".$outcome."' , outcome_doctor_id = '".$updated_by."' , date_of_outcome = '".$date_updated."'
	//WHERE patient_id = '".$patient_id."' AND ward_assignment_id = '".$ward_assignment_id."'";

	$sql="UPDATE ward_assignment SET status = '".$outcome."' ,outcome_doctor_id = '".$updated_by."',date_of_outcome = '".$date_updated."' WHERE patient_id = '".$patient_id."' AND ward_assignment_id = '".$ward_assignment_id."' ";
	
	if(mysqli_query($connection,$sql) or die(mysqli_error())){
		return TRUE;
	} else {
		return FALSE;
	}
}


function ward_name($ward_id){
	global $connection;
	$sql = "SELECT ward_name FROM tbl_ward WHERE id = '".$ward_id."' ";
	$query_run = mysqli_query($connection,$sql) or die(mysqli_error());
	 $diagnosis_name = $query_run->fetch_assoc();
	return $diagnosis_name['ward_name'];
}


function ward_available_bed($ward_id){
	global $connection;
	$sql = "SELECT available_bed FROM tbl_ward WHERE id = '".$ward_id."'";
	$query_run = mysqli_query($connection,$sql) or die(mysqli_error());
	 $diagnosis_name = $query_run->fetch_assoc();
	return $diagnosis_name['available_bed'];
}


function update_ward_available_bed($ward_id,$number_available){
	global $connection;
	//$date = date('Y-m-d H:i:s');
	$sql="UPDATE tbl_ward SET  available_bed = '".$number_available."' WHERE id = '".$ward_id."'";
	if(mysqli_query($connection,$sql) or die(mysqli_error())){
		return TRUE;
	} else {
		return FALSE;
	}
}

function get_ward_assignment($patient_id){

	global $connection;
	
	$date = date('Y-m-d');
	
	$sql="SELECT  * FROM ward_assignment WHERE patient_id = '".$patient_id."'";
	$query_run=mysqli_query($connection,$sql);

	while ($row = mysqli_fetch_array($query_run)) {
		if ($_SESSION['uid'] == $row['doctor_id']) {
			$recorded_by = "You";
		} else {

			$doctor = get_staff_info($row['doctor_id']);
			$recorded_by = $doctor['firstName'] . " " . $doctor['otherNames'];
		}

		$date_of_outcome = $row['date_of_outcome'];
		if($date_of_outcome == null){
			$date_of_outcome = "Not yet";
		}else{
			$date_of_outcome = $date_of_outcome;
		}


		if ($_SESSION['uid'] == $row['outcome_doctor_id']) {
			$outcome_by = "You";
		} elseif($row['outcome_doctor_id']==null) {
$outcome_by = "N/A";
			
		}else {
			# code...
			$doctorC = get_staff_info($row['doctor_id']);
			$outcome_by = $doctorC['firstName'] . " " . $doctor['otherNames'];
		}

		if($row['outcome_doctor_id']==null && $row['date_of_outcome']== null){
			$last_column = "
		
			<a onclick='return confirm(\"CLICK OK TO CONFIRM DELETION OR CANCEL TO PREVENT DELETION...\")'
					 class='label label-danger' href='db_tasks/undo_assignment.php?id=" . $row['id'] ."&ward_id=".$row['ward_id']. "'><i class='fa fa-times'></i></a>
				
			";
		}else {
			# code...
			$last_column = "No Action";
		}

		


        echo"
			 <tr>						
				<td>" . ward_name($row['ward_id']) . "</td> "
               . "<td>" . $row['comments'] . " </td>
               <td>" . date('jS F, Y', strtotime($row['date_added'])) . "</td>
               <td>" . $recorded_by . "</td>
			   <td>" . $row['status'] . "</td> 
			     <td>" . $date_of_outcome . "</td>
				 <td>" . $outcome_by . "</td>
			
				 
            
				 <td>" . $last_column . "</td>
                </tr>
		";
    }
}

function update_out_patient($service_type, $patient_id, $service_code){
	global $connection;
	//$date = date('Y-m-d H:i:s');
	$sql="UPDATE patients_services SET  service_type = '".$service_type."' WHERE patient_id = '".$patient_id."' AND service_code = '".$service_code."'";
	if(mysqli_query($connection,$sql) or die(mysqli_error())){
		return TRUE;
	} else {
		return FALSE;
	}
}

function update_in_patient($service_type, $patient_id, $service_code){
	global $connection;
	//$date = date('Y-m-d H:i:s');
	$sql="UPDATE patients_services SET  service_type = '".$service_type."' WHERE patient_id = '".$patient_id."' AND service_code = '".$service_code."'";
	if(mysqli_query($connection,$sql) or die(mysqli_error())){
		return TRUE;
	} else {
		return FALSE;
	}
}

function treatment_outcome($patient_id,$doctor_id, $outcome, $service_code, $date_updated ){

	global $connection;
	
	$sql="UPDATE patients_services SET doctor_id = '".$doctor_id."' , outcome = '".$outcome."' , date_updated = '".$date_updated."'
	WHERE patient_id = '".$patient_id."' AND service_code = '".$service_code."'";
	
	if(mysqli_query($connection,$sql) or die(mysqli_error())){
		return TRUE;
	} else {
		return FALSE;
	}
}

//NOTIFICATION METHODS FOR INCOMING PATIENTS


function total_notification_waiting_patients(){
	global $connection;
	$date = date('Y-m-d');
	$user = $_SESSION['uid'];
	$sql = "SELECT COUNT(*) as total_notification_waiting_patients FROM `tbl_consulting` WHERE date_sent = '".$date."' AND 
	doctor_id = '".$user."' AND view_state = '0' ";
	$query_run = mysqli_query($connection,$sql);
	$rows = mysqli_fetch_assoc($query_run);
	$count = $rows['total_notification_waiting_patients'];

	return $count;
	
}

function total_notification_processed_lab_to_doctor(){
	global $connection;
	$date = date('Y-m-d');
	$user_dco = $_SESSION['uid'];
	$sql = "SELECT COUNT(id) as total_notification_processed_lab_to_doctor FROM `tbl_req_investigation` WHERE requested_date = '".$date."' AND status = '1' 
    AND payment_status = '1' AND view_status_doc = '0' AND doctor_id = '".$user_dco."' ";
	$query_run = mysqli_query($connection,$sql);
	$rows = mysqli_fetch_assoc($query_run);
	$count = $rows['total_notification_processed_lab_to_doctor'];

	return $count;
	
}

function list_total_notification_processed_lab_to_doctor(){

	global $connection;

	$date = date('Y-m-d');

    $user_dco = $_SESSION['uid'];
	$sql = "SELECT * FROM `tbl_req_investigation` WHERE requested_date = '".$date."' AND status = '1'  AND payment_status = '1' AND view_status_doc = '0' AND doctor_id = '".$user_dco."' ";
	
	if($query_run=mysqli_query($connection,$sql)){

	if(mysqli_num_rows($query_run) > 0){
	
	while($row = mysqli_fetch_array($query_run) ){

		$date_time_stamp = time_passed($row['date_sent_ago']);

		$patient_name = patient_name($row['patient_id']);

        $request_code = $row['request_code'];

        $requested_lab_test = $row['request_test_name'];

        //

       // $request_code = $row['request_code'];

       // $date_sent_ = $row['requested_date'];

      //  $requested_lab_test = $row['request_test_name'];
 
    //  <td>.<a href='tasks/conduct_test?patient_id=".$row['patient_id']."&patient_name=".$patient_name."&test_names=".$requested_lab_test."
    //&request_code=".$request_code." '>" 
//. "CONDUCT TEST". "</a>.</td>

        //
 		
		echo" 						 

				<li>  <a onclick='return confirm(\"CLICK OK TO CONFIRM SELECTION OF PATIENT TO CONTINUE ...\")' 
                 href='tasks/p_v_r?lab_code=".$row['request_code']."&patient_id=".$row['patient_id']." '>" 
				. $patient_name .", About "."$date_time_stamp". "</a>   </li> <li class='divider'>
				
				
				
				</li>
				 		 	 
		";
		
	}}else{

		echo "No Incoming Patients From LAB";
	}

} else{
	echo "string ".mysqli_error();
}
}




function list_total_notification_waiting_patients(){

	global $connection;

	$date = date('Y-m-d');
	$user = $_SESSION['uid'];
	$sql = "SELECT patient_id,date_sent_ago,date_sent FROM `tbl_consulting` WHERE date_sent = '".$date."' AND 
	doctor_id = '".$user."' AND view_state = '0' ";
	
	if($query_run=mysqli_query($connection,$sql)){

	if(mysqli_num_rows($query_run) > 0){
	
	while($row = mysqli_fetch_array($query_run) ){

		$date_time_stamp = time_passed($row['date_sent_ago']);

		$patient_name = patient_name($row['patient_id']);
 		
		echo" 						 

				<li>  <a onclick='return confirm(\"CLICK OK TO CONFIRM SELECTION OF PATIENT TO CONTINUE CONSULTATION...\")'  href='tasks/set_patient_details.php?patient_id=".$row['patient_id']."'>" 
				. $patient_name .", About "."$date_time_stamp". "</a>   </li> <li class='divider'></li>
				 
				 
				 
			 
		";
		
	}}else{

		echo "No Incoming Patient, Feel Free To Relax A Bit!!! Or Keep An Eye On Reviews Scheduled For The Day!!!";
	}

} else{
	echo "string ".mysqli_error();
}
}


function update_notification_waiting_patient_to_view($patient_id){
	global $connection;
	$viewed_state = 1;
	$user_id = $_SESSION['uid'];
	//$date = date('Y-m-d H:i:s');
	$sql="UPDATE tbl_consulting SET  view_state = '".$viewed_state."' WHERE patient_id = '".$patient_id."' AND doctor_id = '".$user_id."' ";
	if(mysqli_query($connection,$sql) or die(mysqli_error())){
		return TRUE;
	} else {
		return FALSE;
	}
}









// function check_patient_visit_consultation($patient_id) {
// 	global $connection;
// 	$date_sent =  date("Y-m-d");

// 	//$state = 1;
// 	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

// 	$query = "SELECT id FROM tbl_consulting WHERE  patient_id ='".$patient_id."' AND date_sent ='".$date_sent."' ";


// 	$query_results = mysqli_query($connection, $query);

//     $num_rows = mysqli_num_rows($query_results);

//     if($num_rows == 1){

//         return true;
//     }else{
//         return false;
//     }
 
 
// }

//All Lab results functions
function get_haematology($patientID,$requestCode){//function to get current patient lab report

	global $connection;
				
	$sql = "SELECT distinct hb,pcv,t_wbc_count,neutrophils,lymphocytes,monocytes
	,eosinophils,basophils,sickling,retics,hb_electrophoresis,esr,g6pd
	,blood_group,fbs,rbs,malaria_parasites from  
	haematology WHERE patient_id='".$patientID."'AND request_code='".$requestCode."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
		while($see=mysqli_fetch_array($query_run)){

			$_SESSION['hb']=$see['hb'];
			$_SESSION['pcv']=$see['pcv'];
			$_SESSION['t_wbc_count']=$see['t_wbc_count'];
			$_SESSION['neutrophils']=$see['neutrophils'];
			$_SESSION['lymphocytes']=$see['lymphocytes'];
			$_SESSION['monocytes']=$see['monocytes'];
			$_SESSION['eosinophils']=$see['eosinophils'];
			$_SESSION['basophils']=$see['basophils'];
			$_SESSION['sickling']=$see['sickling'];
			$_SESSION['retics']=$see['retics'];
			$_SESSION['hb_elec']=$see['hb_electrophoresis'];
			$_SESSION['esr']=$see['esr'];
			$_SESSION['g6pd']=$see['g6pd'];
			$_SESSION['blood_group']=$see['blood_group'];
			$_SESSION['fbs']=$see['fbs'];
			$_SESSION['rbs']=$see['rbs'];
			$_SESSION['malaria_parasites']=$see['malaria_parasites'];
		}
	}
}

function urine_re($patientID,$requestCode){
	global $connection;
	$sql = "SELECT distinct appearance,colour,specific_gravity,ph,protein,glucose
	,ketones,blood,nitrite,bilirubin,urobilinogen from  
	urine_re  WHERE patient_id='".$patientID."'AND request_code='".$requestCode."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){

		$_SESSION['app']=$see['appearance'];
		$_SESSION['colour']=$see['colour'];
		$_SESSION['spec_g']=$see['specific_gravity'];
		$_SESSION['ph']=$see['ph'];
		$_SESSION['protein']=$see['protein'];
		$_SESSION['glucose']=$see['glucose'];
		$_SESSION['ketones']=$see['ketones'];
		$_SESSION['blood']=$see['blood'];
		$_SESSION['nitrite']=$see['nitrite'];
		$_SESSION['bilirubin']=$see['bilirubin'];
		$_SESSION['urobilinogen']=$see['urobilinogen'];
		
}
	}
}

function stool_re($patientID,$requestCode){
	global $connection;
		$sql = "SELECT distinct macroscopy,microscopy from  
	stool_re WHERE patient_id='".$patientID."'AND request_code='".$requestCode."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){

		$_SESSION['macroscopy']=$see['macroscopy'];
		$_SESSION['microscopy']=$see['microscopy'];
		
}
	}
}


function hvs_wet_prep($patientID,$requestCode){

	global $connection;
		
		$sql = "SELECT distinct hvs_pus_cells,hvs_ec,hvs_rbc,hvs_organism_one,
		hvs_organism_two from  
		hvs_wet_prep WHERE patient_id='".$patientID."'AND request_code='".$requestCode."' ORDER BY id DESC LIMIT 1  
		";
		$query_run=mysqli_query($connection,$sql);
		$answer = mysqli_num_rows($query_run);
		if($answer ===1){
		while($see=mysqli_fetch_array($query_run)){

			$_SESSION['hvs_pus_cells']=$see['hvs_pus_cells'];
			$_SESSION['hvs_ec']=$see['hvs_ec'];
			$_SESSION['hvs_rbc']=$see['hvs_rbc'];
			$_SESSION['hvs_organism_one']=$see['hvs_organism_one'];
			$_SESSION['hvs_organism_two']=$see['hvs_organism_two'];
			
		}
	}
}
			
function gram_stain($patientID,$requestCode){

	global $connection;
		
	$sql = "SELECT distinct gs_pus_cells,gs_ec,gs_rbc,gs_organism_one,
	gs_organism_two from  
	gram_stain WHERE patient_id='".$patientID."'AND request_code='".$requestCode."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){

		$_SESSION['gs_pus']=$see['gs_pus_cells'];
		$_SESSION['gs_ec']=$see['gs_ec'];
		$_SESSION['gs_rbc']=$see['gs_rbc'];
		$_SESSION['gs_org_1']=$see['gs_organism_one'];
		$_SESSION['gs_org_2']=$see['gs_organism_two'];
		
}	
	}
}

function general_microbiology($patientID,$requestCode){
	global $connection;
	$sql = "SELECT distinct pus_cells,rbcs,epith_cells,t_vaginalis,
	bacteriodes,yeast_cells,s_h_masoni,crystals,casts,blood_filming,
	hbsag,vdrl_kahn,urine_preg_test,status FROM  
	general_microbiology  WHERE patient_id='".$patientID."'AND request_code='".$requestCode."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	@$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){

		$_SESSION['pus_cells']=$see['pus_cells'];
		$_SESSION['rbcs']=$see['rbcs'];
		$_SESSION['epith_cells']=$see['epith_cells'];
		$_SESSION['t_vaginalis']=$see['t_vaginalis'];
		$_SESSION['bacteriodes']=$see['bacteriodes'];
		$_SESSION['yeast_cells']=$see['yeast_cells'];
		$_SESSION['s_h_masoni']=$see['s_h_masoni'];
		$_SESSION['crystals']=$see['crystals'];
		$_SESSION['casts']=$see['casts'];
		$_SESSION['blood_filming']=$see['blood_filming'];
		$_SESSION['hepavirus']=$see['hbsag'];
		$_SESSION['vdrl_kahn']=$see['vdrl_kahn'];
		$_SESSION['urine_preg']=$see['urine_preg_test'];
	//	$_SESSION['status']=$see['status'];
}	
	}
	
}

function widal_test($patientID,$requestCode){

	global $connection;
		
	$sql = "SELECT distinct s_typhi_o,s_typhi_h
	 from  
	widal_test WHERE patient_id='".$patientID."'AND request_code='".$requestCode."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){

		$_SESSION['s_typhi_o']=$see['s_typhi_o'];
		$_SESSION['s_typhi_h']=$see['s_typhi_h'];
		
}	
}
}


function skin_snip($patientID,$requestCode){

	global $connection;
		
	$sql = "SELECT distinct remarks
	 from  
	skin_snip WHERE patient_id='".$patientID."'AND request_code='".$requestCode."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
		while($see=mysqli_fetch_array($query_run)){
			$_SESSION['remarks']=$see['remarks'];
		}		
	}
}

function diagnosis_code(){
    $string = 'D';
    //$year = date('y');
    $length = 6;

    $rand = random_code($length);
   
   //return $rand;
    return $string  . $rand;
}

function random_code($length){
    $rand = 0;
     /* Only select from letters and numbers that are readable - no 0 or O etc..*/
    $characters = "23456789ABCDEFHJKLMNPRTVWXYZ";
 
   for ($p = 0; $p < $length; $p++) 
   {
       $rand .= $characters[mt_rand(0, strlen($characters)-1)];
   }

   return $rand;
}
?>