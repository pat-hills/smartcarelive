<?php
//this file handles searches in the system

function get_pat_details($patient_id){//recieves only patient id to initiate query
	global $connection;
	//search with patient id
	if(isset($patient_id)){
		$query = "SELECT patient_id,surname,other_names,sex,occupation,dob,marital_stat,phone,address,national_id FROM tbl_patient_info WHERE patient_id='".$patient_id."'";
		
		if($result = mysqli_query($connection,$query)){
			
			if($answer = mysqli_num_rows($result) > 0){
				
				
				while($tinz=mysqli_fetch_array($result)){
			
	            	$_SESSION['patient_id']=$tinz['patient_id'];
	            	$_SESSION['surname']=$tinz['surname'];
	            	$_SESSION['other_names']=$tinz['other_names'];
	            	$_SESSION['sex']=$tinz['sex'];
	            	$_SESSION['marital_stat']=$tinz['marital_stat'];
	            	$_SESSION['occupation']=$tinz['occupation'];
	            	$_SESSION['phone']=$tinz['phone'];
	            	$_SESSION['address']=$tinz['address'];
	                $_SESSION['national_id']=$tinz['national_id'];
	            	$_SESSION['dob'] = $tinz['dob'];
					//$_SESSION['sms_contact'] = $tinz['sms_contact'];
				//	$_SESSION['email_contact'] = $tinz['email_contact'];
					//$_SESSION['phone'] = $tinz['phone'];
	            }//end of while loop
			}
		}

		patient_scheme($patient_id);
		$date_added = date('Y-m-d');
		patient_service_code($patient_id, $date_added);
	
	}
		

}//end of function get patient details

// function get_patient_general_test($patient_id, $test_name) {
//     global $connection; // Use the global database connection variable

//     // Use a prepared statement to avoid SQL injection
//     $stmt = $connection->prepare(
//         "SELECT test_status 
//          FROM general_status_test 
//          WHERE patient_id = ? AND test_name = ? 
//          LIMIT 1"
//     );
//     $stmt->bind_param("is", $patient_id, $test_name); // "i" for integer, "s" for string
//     $stmt->execute();
//     $result = $stmt->get_result();

//     var_dump($patient_id, $test_name);
//       // Debug the values being passed to the query
//       //error_log("Patient ID: $patient_id, Test Name: $test_name");

//     // Check if the query returned a row
//     if ($result->num_rows > 0) {
//         $row = $result->fetch_assoc();
//         return $row['test_status']; // Return the test_status column value
//     } else {
//         return "N/A"; // Return null if no record is found
//     }
// }



function get_pat_family_details($patient_id){//recieves only patient id to initiate query
	global $connection;
	//search with patient id
	if(isset($patient_id)){
		$query = "SELECT patient_id,f_Name,f_relation,f_Phone,f_Sex,f_Address FROM tbl_pat_family_info WHERE patient_id='".$patient_id."'";
		
		if($result = mysqli_query($connection,$query)){
			
			if($answer = mysqli_num_rows($result) > 0){
				
				
				while($tinz=mysqli_fetch_array($result)){
			
	            	$_SESSION['patient_id']=$tinz['patient_id'];
	            	$_SESSION['f_Name']=$tinz['f_Name'];
	            	$_SESSION['f_relation']=$tinz['f_relation'];
	            	$_SESSION['f_Phone']=$tinz['f_Phone'];
	            	$_SESSION['f_Sex']=$tinz['f_Sex'];
	            	$_SESSION['f_Address']=$tinz['f_Address'];  
	            }//end of while loop
			}
		}
 
	
	}
		

}//end of function get patient details


//Checking if patient has paid consulting

function check_patient_payment_before_vitals($patient_id) {
	global $connection;
	$state = 1;
    $amount = 0;
    $today = date('Y-m-d');
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

	$query = "SELECT id FROM consultingpayment2cashier WHERE  patient_id ='".$patient_id."' AND date_added ='".$today."' AND state ='".$state."' ";


	$query_results = mysqli_query($connection, $query);

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows > 0){

        return true;
    }else{
        return false;
    }
 
 
}

function update_notification_waiting_consulting_patients_from_cashier($patient_id){
	global $connection;
	$viewed_state = 1;
	$user_id = $_SESSION['uid'];
	//$date = date('Y-m-d H:i:s');
	$sql="UPDATE consultingpayment2cashier SET opd_view_state = '".$viewed_state."' WHERE patient_id = '".$patient_id."' AND
     cashier_view_state = '1' AND state = '1' AND staff_id = '".$user_id."' ";
	if(mysqli_query($connection,$sql) or die(mysqli_error())){
		return TRUE;
	} else {
		return FALSE;
	}
}


function check_patient_in_consultationpayment_record($patient_id) {
	global $connection;
	$state = 1;
    $amount = 0;
    $today = date('Y-m-d');
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

	$query = "SELECT id FROM consultingpayment2cashier WHERE  patient_id ='".$patient_id."' AND date_added ='".$today."' ";


	$query_results = mysqli_query($connection, $query);

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows > 0){

        return true;
    }else{
        return false;
    }
 
 
}

function get_patient_assign_consultation($patient_id){

	global $connection;
	$view_status = 0;
	$today = date('Y-m-d');

	$sql = "SELECT doctor_room,doctor_id,date_sent FROM tbl_consulting WHERE patient_id = '".$patient_id."' AND date_sent = '".$today."' AND view_state = '".$view_status."'";
	$query_run = mysqli_query($connection,$sql);

	$row = $query_run->fetch_assoc();

	@$doctor_room = $row['doctor_room'];
	@$doctor_id = $row['doctor_id'];
	@$date_sent = $row['date_sent']; 

	//$doctor = get_staff_info($doctor_id);

	//$_SESSION['doctor_full_name'] = "Dr. ".$doctor['firstName']." ".$doctor['otherNames']."";
	
	$_SESSION['doctor_room'] = $doctor_room;
	$_SESSION['doctor_id'] = $doctor_id;
	$_SESSION['date_sent'] = $date_sent;
	

}






//multiple search query 
function search_pat_info($search){
	global $connection;
	//search query if patient id is entered
	
	$query = "SELECT patient_id FROM tbl_patient_info WHERE patient_id = '".$search."'";
	
	$a= mysqli_query($connection,$query);
	$b=mysqli_num_rows($a);
	
	
	if ($b==1){
		$c = $a ->fetch_assoc();
		
		return $c['patient_id'];
		
	}else{
		//search query if nhis id is inserted
	
	$query = "SELECT patient_id FROM scheme WHERE membership_id = '".$search."'";
	
	$a= mysqli_query($connection,$query);
			
	$b=mysqli_num_rows($a);
	
	if ($b==1){
		$c = $a ->fetch_assoc();
		echo "second query initiating<br />";
		return $c['patient_id'];

	}	else{
		//seach query if national_id is inerted
		$query = "SELECT patient_id FROM tbl_patient_info WHERE national_id = '".$search."'";
	
	$a= mysqli_query($connection,$query);
	$b=mysqli_num_rows($a);
	
	if ($b==1){
		$c = $a ->fetch_assoc();
		echo "third query initiating<br />";
		return $c['patient_id'];

	}
	}
	
	
		} 
		
	}
///////////////Age function
function patient_scheme($patient_id){

	global $connection;

	$sql = "SELECT membership_id, scheme FROM scheme WHERE patient_id = '".$patient_id."'";
	$query_run = mysqli_query($connection,$sql);

	$row = $query_run->fetch_assoc();

	@$membership_id = $row['membership_id'];
	@$scheme = $row['scheme']; 
	
	$_SESSION['membership_id'] = $membership_id;
	$_SESSION['scheme'] = $scheme; 
	

}


function get_pat_email_sms($patient_id){

	global $connection;

	$sql = "SELECT sms_contact,email_contact,surname,other_names FROM tbl_patient_info WHERE patient_id = '".$patient_id."'";
	$query_run = mysqli_query($connection,$sql);

	$row = $query_run->fetch_assoc();

	@$sms_contact = $row['sms_contact'];
	@$email_contact = $row['email_contact'];
	@$fullname = $row['surname']." ".$row['other_names'];  
	
	$_SESSION['sms_contact'] = $sms_contact;
	$_SESSION['email_contact'] = $email_contact; 
	$_SESSION['fullname'] = $fullname; 
	

}


function update_patient_sent_review_notification($patient_id,$advance_date,$message,$date_sms_sent){
	global $connection;

//	$tomorrowUnix = strtotime("+1 day");

$status = "YES";
 
//$tomorrowDate = date("Y-m-d", $tomorrowUnix);
	//$date = date('Y-m-d');
	$sql = "UPDATE tbl_patient_review SET is_sms_sent = '".$status."' , sms_content = '".$message."' , date_sms_sent = '".$date_sms_sent."' WHERE patient_id = '".$patient_id."' AND date_to_be_seen = '".$advance_date."' ";
	if(mysqli_query($connection,$sql) or die(mysqli_error())){
		return TRUE;
	} else {
		return FALSE;
	}
}

function patient_service_code($patient_id, $date_added){

	global $connection;
	
	$sql = "SELECT service_code,date_added FROM patients_services WHERE patient_id = '".$patient_id."' AND DATE( date_added ) = '".$date_added."'";
	$query_run = mysqli_query($connection,$sql);

	$rows_record = $query_run->fetch_assoc();

	@$service_code = $rows_record['service_code'];
	@$date_added = $rows_record['date_added'];
	
	$_SESSION['service_code'] = $service_code;
	$_SESSION['date_added'] = $date_added;

}

function get_submetro($code)
{
	global $connection;
	$sql = "SELECT name FROM submetro_list WHERE code = '".$code."'";
	$result = mysqli_query($connection,$sql);
	$rows = $result->fetch_assoc();
	@$name = $rows['name'];
	return $name;
}


function get_age_pdf($dob){

	$age = "";
	
	$age=date_diff(date_create('today'),date_create($dob))->y;
	if($age==date('Y')){
		return "0";
	}else{
		return $age;
	}
}

function get_age($dob){

	$age = "";
	
	$age=date_diff(date_create('today'),date_create($dob))->y;
	if($age==date('Y')){
		echo "0";
	}else{
	echo $age;
	}
}
//////////////////Consulting room search
function con_room(){
	$sql = "SELECT * FROM `consulting_room`";
	
	$query_run = mysql_query($sql);
	
	while($see=mysql_fetch_array($query_run)){
		
		echo "<option value=".$see['room_id'].">".$see['name']."</option>";
	}
	
	
}

////////////function to search doctors


function get_doctors(){
	global $connection;
	$sql = "Select tbl_staff.staff_id, tbl_staff.firstName, tbl_staff.otherNames FROM tbl_login, tbl_staff WHERE tbl_login.userid = tbl_staff.staff_id AND tbl_login.acc_lvl = 2";
	
	$query_run = mysqli_query($connection,$sql);
	
	while($row=mysqli_fetch_array($query_run)){
		
		echo "<option value=".$row['staff_id'].">".$row['firstName']." ".$row['otherNames']."</option>";
	}
	
}




///////////////////////////////////////////////////////////////////////SEARCH PARAMETERS FUNCTIONS QUERIES




//This function controls tabs @ doctor's side
function set_tabs_reporting_doc_users($setter){

	switch ($setter) {
		case '1':
			# code...
		$_SESSION['patients']='active';
		$_SESSION['complains']='';
		$_SESSION['diagnosis']='';
	//	$_SESSION['investigations']='';
		//$_SESSION['medical_history']=''; 
			break;
		case '2':
			# code...
		
		$_SESSION['patients']='';
		$_SESSION['complains']='active';
		$_SESSION['diagnosis']='';
	//	$_SESSION['investigations']=''; 
		$_SESSION['medical_history']=''; 
			break;
		case '3':
			# code...
	
			$_SESSION['patients']='';
		$_SESSION['complains']='';
		$_SESSION['diagnosis']='active';
		//$_SESSION['investigations']=''; 
	//	$_SESSION['medical_history']=''; 
			break;
	 
		 
			 
			
		default:
			# code...
			$_SESSION['patients']='active';
			$_SESSION['complains']='';
			$_SESSION['diagnosis']='';
			//$_SESSION['investigations']=''; 
		//	$_SESSION['medical_history']=''; 
			break;
	}
	
	
	
	}



	function set_tabs_reporting_cashier_users($setter){

		switch ($setter) {
			case '1':
				# code...
			$_SESSION['period']='active';
			$_SESSION['range']=''; 
				break;
			case '2':
				# code...
			
			$_SESSION['period']='';
			$_SESSION['range']='active'; 
				break;
			 
		  
			default:
				# code...
				$_SESSION['period']='active';
				$_SESSION['range']=''; 
				//$_SESSION['investigations']=''; 
			//	$_SESSION['medical_history']=''; 
				break;
		}
		
		
		
		}



function search_consulting_patient_reports($staff_id,$start_date,$end_date,$gender){
	global $connection, $rows_count;

	$search = false;
	if(empty($start_date) && empty($end_date) && !empty($gender)){

		if($gender == "All"){
		$query = "SELECT * FROM tbl_consulting JOIN tbl_patient_info ON tbl_consulting.patient_id = tbl_patient_info.patient_id WHERE doctor_id = '".$staff_id."' ";

		}elseif ($gender == "Male") {
			$query = "SELECT * FROM tbl_consulting JOIN tbl_patient_info ON tbl_consulting.patient_id = tbl_patient_info.patient_id WHERE doctor_id = '".$staff_id."' AND tbl_patient_info.sex = 'Male' ";
		}elseif($gender == "Female"){
			$query = "SELECT * FROM tbl_consulting JOIN tbl_patient_info ON tbl_consulting.patient_id = tbl_patient_info.patient_id WHERE doctor_id = '".$staff_id."' AND tbl_patient_info.sex = 'Female' ";
		}

	 }
	 
	elseif(empty($start_date) && !empty($end_date) && !empty($gender)){

		if($gender == "All"){
			$query = "SELECT * FROM tbl_consulting JOIN tbl_patient_info ON tbl_consulting.patient_id = tbl_patient_info.patient_id WHERE doctor_id = '".$staff_id."' AND date_sent = '".$end_date."' ";
	
			}elseif ($gender == "Male") {
				$query = "SELECT * FROM tbl_consulting JOIN tbl_patient_info ON tbl_consulting.patient_id = tbl_patient_info.patient_id WHERE doctor_id = '".$staff_id."' AND tbl_patient_info.sex = 'Male' AND date_sent = '".$end_date."' ";
			}elseif($gender == "Female"){
				$query = "SELECT * FROM tbl_consulting JOIN tbl_patient_info ON tbl_consulting.patient_id = tbl_patient_info.patient_id WHERE doctor_id = '".$staff_id."' AND tbl_patient_info.sex = 'Female' AND date_sent = '".$end_date."' ";
			}

        
	 }elseif(!empty($start_date) && empty($end_date) && !empty($gender)){

		if($gender == "All"){
			$query = "SELECT * FROM tbl_consulting JOIN tbl_patient_info ON tbl_consulting.patient_id = tbl_patient_info.patient_id WHERE doctor_id = '".$staff_id."' AND date_sent = '".$start_date."' ";
	
			}elseif ($gender == "Male") {
				$query = "SELECT * FROM tbl_consulting JOIN tbl_patient_info ON tbl_consulting.patient_id = tbl_patient_info.patient_id WHERE doctor_id = '".$staff_id."' AND tbl_patient_info.sex = 'Male' AND date_sent = '".$start_date."' ";
			}elseif($gender == "Female"){
				$query = "SELECT * FROM tbl_consulting JOIN tbl_patient_info ON tbl_consulting.patient_id = tbl_patient_info.patient_id WHERE doctor_id = '".$staff_id."' AND tbl_patient_info.sex = 'Female' AND date_sent = '".$start_date."' ";
			}

        
	 }elseif(!empty($start_date) && !empty($end_date) && !empty($gender)){


		if($gender == "All"){
			$query = "SELECT * FROM tbl_consulting JOIN tbl_patient_info ON tbl_consulting.patient_id = tbl_patient_info.patient_id WHERE doctor_id = '".$staff_id."'
			 AND date_sent BETWEEN  '".$start_date."' AND '".$end_date."'  ";
	
			}elseif ($gender == "Male") {
				$query = "SELECT * FROM tbl_consulting JOIN tbl_patient_info ON tbl_consulting.patient_id = tbl_patient_info.patient_id WHERE doctor_id = '".$staff_id."'
				 AND tbl_patient_info.sex = 'Male' AND date_sent BETWEEN  '".$start_date."' AND '".$end_date."' ";
			}elseif($gender == "Female"){
				$query = "SELECT * FROM tbl_consulting JOIN tbl_patient_info ON tbl_consulting.patient_id = tbl_patient_info.patient_id WHERE doctor_id = '".$staff_id."'
				 AND tbl_patient_info.sex = 'Female' AND date_sent BETWEEN  '".$start_date."' AND '".$end_date."' ";
			}



	 }


	 
	 $a= mysqli_query($connection,$query);


	 $row_cnt = mysqli_num_rows($a);



	if($row_cnt > 0){
   $_SESSION['count_rows'] = $row_cnt;
	return $a;
	//mysqli_free_result($a);
	}else{
		$_SESSION['count_rows'] = 0;
	   return null;
	}

}







function search_complains_reports($staff_id,$start_date,$end_date,$complain,$gender){
	global $connection;

	$search = false;
	if(empty($start_date) && empty($end_date) && !empty($complain) && !empty($gender)){

		$complain_fmt = '%'.$complain.'%';

		if($gender == "All"){
		$query = "SELECT * FROM tbl_tmp_complain JOIN tbl_patient_info ON tbl_tmp_complain.patient_id = tbl_patient_info.patient_id WHERE doctor_id = '".$staff_id."' AND complain LIKE '".$complain_fmt."' ";

		}elseif ($gender == "Male") {
			$query = "SELECT * FROM tbl_tmp_complain JOIN tbl_patient_info ON tbl_tmp_complain.patient_id = tbl_patient_info.patient_id WHERE doctor_id = '".$staff_id."' AND complain LIKE '".$complain_fmt."' AND tbl_patient_info.sex = 'Male'  ";
		}elseif($gender == "Female"){
			$query = "SELECT * FROM tbl_tmp_complain JOIN tbl_patient_info ON tbl_tmp_complain.patient_id = tbl_patient_info.patient_id WHERE doctor_id = '".$staff_id."' AND complain LIKE '".$complain_fmt."' AND tbl_patient_info.sex = 'Female' ";
		}

	 }

	 
	 
	// elseif(empty($start_date) && !empty($end_date) && !empty($gender)){

	// 	if($gender == "All"){
	// 		$query = "SELECT * FROM tbl_consulting JOIN tbl_patient_info ON tbl_consulting.patient_id = tbl_patient_info.patient_id WHERE doctor_id = '".$staff_id."' AND date_sent = '".$end_date."' ";
	
	// 		}elseif ($gender == "Male") {
	// 			$query = "SELECT * FROM tbl_consulting JOIN tbl_patient_info ON tbl_consulting.patient_id = tbl_patient_info.patient_id WHERE doctor_id = '".$staff_id."' AND tbl_patient_info.sex = 'Male' AND date_sent = '".$end_date."' ";
	// 		}elseif($gender == "Female"){
	// 			$query = "SELECT * FROM tbl_consulting JOIN tbl_patient_info ON tbl_consulting.patient_id = tbl_patient_info.patient_id WHERE doctor_id = '".$staff_id."' AND tbl_patient_info.sex = 'Female' AND date_sent = '".$end_date."' ";
	// 		}

        
	//  }elseif(!empty($start_date) && empty($end_date) && !empty($gender)){

	// 	if($gender == "All"){
	// 		$query = "SELECT * FROM tbl_consulting JOIN tbl_patient_info ON tbl_consulting.patient_id = tbl_patient_info.patient_id WHERE doctor_id = '".$staff_id."' AND date_sent = '".$start_date."' ";
	
	// 		}elseif ($gender == "Male") {
	// 			$query = "SELECT * FROM tbl_consulting JOIN tbl_patient_info ON tbl_consulting.patient_id = tbl_patient_info.patient_id WHERE doctor_id = '".$staff_id."' AND tbl_patient_info.sex = 'Male' AND date_sent = '".$start_date."' ";
	// 		}elseif($gender == "Female"){
	// 			$query = "SELECT * FROM tbl_consulting JOIN tbl_patient_info ON tbl_consulting.patient_id = tbl_patient_info.patient_id WHERE doctor_id = '".$staff_id."' AND tbl_patient_info.sex = 'Female' AND date_sent = '".$start_date."' ";
	// 		}

        
	//  }elseif(!empty($start_date) && !empty($end_date) && !empty($gender)){


	// 	if($gender == "All"){
	// 		$query = "SELECT * FROM tbl_consulting JOIN tbl_patient_info ON tbl_consulting.patient_id = tbl_patient_info.patient_id WHERE doctor_id = '".$staff_id."'
	// 		 AND date_sent BETWEEN  '".$start_date."' AND '".$end_date."'  ";
	
	// 		}elseif ($gender == "Male") {
	// 			$query = "SELECT * FROM tbl_consulting JOIN tbl_patient_info ON tbl_consulting.patient_id = tbl_patient_info.patient_id WHERE doctor_id = '".$staff_id."'
	// 			 AND tbl_patient_info.sex = 'Male' AND date_sent BETWEEN  '".$start_date."' AND '".$end_date."' ";
	// 		}elseif($gender == "Female"){
	// 			$query = "SELECT * FROM tbl_consulting JOIN tbl_patient_info ON tbl_consulting.patient_id = tbl_patient_info.patient_id WHERE doctor_id = '".$staff_id."'
	// 			 AND tbl_patient_info.sex = 'Female' AND date_sent BETWEEN  '".$start_date."' AND '".$end_date."' ";
	// 		}



	//  }


	 
	 $a= mysqli_query($connection,$query);


	 $row_cnt = mysqli_num_rows($a);



	if($row_cnt > 0){
   $_SESSION['count_complain_rows'] = $row_cnt;
	return $a;
	//mysqli_free_result($a);
	}else{
		$_SESSION['count_complain_rows'] = 0;
	   return null;
	}

}






function search_diagnosis_reports($staff_id,$start_date,$end_date,$start_age,$end_age,$diagnosis,$gender){
global $connection;

	

	 if(empty($start_date) && empty($end_date) && ($start_age =="--------------------") && ($end_age=="--------------------") && !empty($diagnosis) && !empty($gender) ){

	 	$complain_fmt = '%'.$diagnosis.'%';

	 	if($gender == "All"){

		//$query = "SELECT * FROM tbl_diagnosis WHERE doc_id =  '".$staff_id."' ";

	 		$query = "SELECT * FROM tbl_diagnosis JOIN tbl_patient_info ON tbl_diagnosis.patient_id = tbl_patient_info.patient_id WHERE doc_id = '".$staff_id."' AND diagnosis LIKE '".$complain_fmt."' ";

	 	}elseif ($gender == "Male") {
			$query = "SELECT * FROM tbl_diagnosis JOIN tbl_patient_info ON tbl_diagnosis.patient_id = tbl_patient_info.patient_id WHERE doc_id = '".$staff_id."' AND diagnosis LIKE '".$complain_fmt."'
			 AND tbl_patient_info.sex = 'Male'  ";
		}elseif($gender == "Female"){
			$query = "SELECT * FROM tbl_diagnosis JOIN tbl_patient_info ON tbl_diagnosis.patient_id = tbl_patient_info.patient_id WHERE doc_id = '".$staff_id."' AND diagnosis LIKE '".$complain_fmt."'
			 AND tbl_patient_info.sex = 'Female' ";
		}

	  }elseif(empty($start_date) && empty($end_date) && ($start_age =="--------------------") && ($end_age != "--------------------") && !empty($diagnosis) && !empty($gender) ){


		$complain_fmt = '%'.$diagnosis.'%';

		$current_year = date('Y');

		$processed_patient_year = $current_year - $end_age;

		if($gender == "All"){

	   //$query = "SELECT * FROM tbl_diagnosis WHERE doc_id =  '".$staff_id."' ";

			$query = "SELECT * FROM tbl_diagnosis JOIN tbl_patient_info ON tbl_diagnosis.patient_id = tbl_patient_info.patient_id WHERE doc_id = '".$staff_id."' AND diagnosis LIKE '".$complain_fmt."' 
			AND YEAR(tbl_patient_info.dob) = '".$processed_patient_year."'  ";

		}elseif ($gender == "Male") {
		   $query = "SELECT * FROM tbl_diagnosis JOIN tbl_patient_info ON tbl_diagnosis.patient_id = tbl_patient_info.patient_id WHERE doc_id = '".$staff_id."' AND diagnosis LIKE '".$complain_fmt."'
			AND tbl_patient_info.sex = 'Male' AND YEAR(tbl_patient_info.dob) = '".$processed_patient_year."'  ";
	   }elseif($gender == "Female"){
		   $query = "SELECT * FROM tbl_diagnosis JOIN tbl_patient_info ON tbl_diagnosis.patient_id = tbl_patient_info.patient_id WHERE doc_id = '".$staff_id."' AND diagnosis LIKE '".$complain_fmt."'
			AND tbl_patient_info.sex = 'Female' YEAR(tbl_patient_info.dob) = '".$processed_patient_year."' ";
	   }

		

	  }elseif(empty($start_date) && empty($end_date) && ($start_age !="--------------------") && ($end_age == "--------------------") && !empty($diagnosis) && !empty($gender) ){


		$complain_fmt = '%'.$diagnosis.'%';

		$current_year = date('Y');

		$processed_patient_year = $current_year - $start_age;

		if($gender == "All"){

	   //$query = "SELECT * FROM tbl_diagnosis WHERE doc_id =  '".$staff_id."' ";

			$query = "SELECT * FROM tbl_diagnosis JOIN tbl_patient_info ON tbl_diagnosis.patient_id = tbl_patient_info.patient_id WHERE doc_id = '".$staff_id."' AND diagnosis LIKE '".$complain_fmt."' 
			AND YEAR(tbl_patient_info.dob) = '".$processed_patient_year."'  ";

		}elseif ($gender == "Male") {
		   $query = "SELECT * FROM tbl_diagnosis JOIN tbl_patient_info ON tbl_diagnosis.patient_id = tbl_patient_info.patient_id WHERE doc_id = '".$staff_id."' AND diagnosis LIKE '".$complain_fmt."'
			AND tbl_patient_info.sex = 'Male' AND YEAR(tbl_patient_info.dob) = '".$processed_patient_year."'  ";
	   }elseif($gender == "Female"){
		   $query = "SELECT * FROM tbl_diagnosis JOIN tbl_patient_info ON tbl_diagnosis.patient_id = tbl_patient_info.patient_id WHERE doc_id = '".$staff_id."' AND diagnosis LIKE '".$complain_fmt."'
			AND tbl_patient_info.sex = 'Female' YEAR(tbl_patient_info.dob) = '".$processed_patient_year."' ";
	   }

		

	  }elseif(empty($start_date) && empty($end_date) && ($start_age != "--------------------") && ($end_age != "--------------------") && !empty($diagnosis) && !empty($gender) ){


		$complain_fmt = '%'.$diagnosis.'%';

		$current_year = date('Y');

		$processed_patient_year_end = $current_year - $end_age;
		$processed_patient_year_start = $current_year - $start_age;

		if($gender == "All"){

	   //$query = "SELECT * FROM tbl_diagnosis WHERE doc_id =  '".$staff_id."' ";

			$query = "SELECT * FROM tbl_diagnosis JOIN tbl_patient_info ON tbl_diagnosis.patient_id = tbl_patient_info.patient_id WHERE doc_id = '".$staff_id."' AND diagnosis LIKE '".$complain_fmt."' 
			AND YEAR(tbl_patient_info.dob) BETWEEN '".$processed_patient_year_start."' AND '".$processed_patient_year_end."'   ";

		}elseif ($gender == "Male") {
		   $query = "SELECT * FROM tbl_diagnosis JOIN tbl_patient_info ON tbl_diagnosis.patient_id = tbl_patient_info.patient_id WHERE doc_id = '".$staff_id."' AND diagnosis LIKE '".$complain_fmt."'
			AND tbl_patient_info.sex = 'Male' AND YEAR(tbl_patient_info.dob) BETWEEN '".$processed_patient_year_start."' AND '".$processed_patient_year_end."'    ";
	   }elseif($gender == "Female"){
		   $query = "SELECT * FROM tbl_diagnosis JOIN tbl_patient_info ON tbl_diagnosis.patient_id = tbl_patient_info.patient_id WHERE doc_id = '".$staff_id."' AND diagnosis LIKE '".$complain_fmt."'
			AND tbl_patient_info.sex = 'Female' AND  YEAR(tbl_patient_info.dob) BETWEEN '".$processed_patient_year_start."' AND '".$processed_patient_year_end."'    ";
	   }

		

	  }elseif(empty($start_date) && !empty($end_date) && ($start_age != "--------------------") && ($end_age != "--------------------") && !empty($diagnosis) && !empty($gender) ){


		$complain_fmt = '%'.$diagnosis.'%';

		$current_year = date('Y');

		$processed_patient_year_end = $current_year - $end_age;
		$processed_patient_year_start = $current_year - $start_age;

		if($gender == "All"){

	   //$query = "SELECT * FROM tbl_diagnosis WHERE doc_id =  '".$staff_id."' ";

			$query = "SELECT * FROM tbl_diagnosis JOIN tbl_patient_info ON tbl_diagnosis.patient_id = tbl_patient_info.patient_id WHERE doc_id = '".$staff_id."' AND diagnosis LIKE '".$complain_fmt."' 
			AND YEAR(tbl_patient_info.dob) BETWEEN '".$processed_patient_year_start."' AND '".$processed_patient_year_end."' AND DATE(date_added) = '".$end_date."'    ";

		}elseif ($gender == "Male") {
		   $query = "SELECT * FROM tbl_diagnosis JOIN tbl_patient_info ON tbl_diagnosis.patient_id = tbl_patient_info.patient_id WHERE doc_id = '".$staff_id."' AND diagnosis LIKE '".$complain_fmt."'
			AND tbl_patient_info.sex = 'Male' AND YEAR(tbl_patient_info.dob) BETWEEN '".$processed_patient_year_start."' AND '".$processed_patient_year_end."' AND DATE(date_added) = '".$end_date."'    ";
	   }elseif($gender == "Female"){
		   $query = "SELECT * FROM tbl_diagnosis JOIN tbl_patient_info ON tbl_diagnosis.patient_id = tbl_patient_info.patient_id WHERE doc_id = '".$staff_id."' AND diagnosis LIKE '".$complain_fmt."'
			AND tbl_patient_info.sex = 'Female' AND  YEAR(tbl_patient_info.dob) BETWEEN '".$processed_patient_year_start."' AND '".$processed_patient_year_end."' AND DATE(date_added) = '".$end_date."'   ";
	   }

		

	  }elseif(!empty($start_date) && !empty($end_date) && ($start_age != "--------------------") && ($end_age != "--------------------") && !empty($diagnosis) && !empty($gender) ){


		$complain_fmt = '%'.$diagnosis.'%';

		$current_year = date('Y');

		$processed_patient_year_end = $current_year - $end_age;
		$processed_patient_year_start = $current_year - $start_age;

		if($gender == "All"){

	   //$query = "SELECT * FROM tbl_diagnosis WHERE doc_id =  '".$staff_id."' ";

			$query = "SELECT * FROM tbl_diagnosis JOIN tbl_patient_info ON tbl_diagnosis.patient_id = tbl_patient_info.patient_id WHERE doc_id = '".$staff_id."' AND diagnosis LIKE '".$complain_fmt."' 
			AND YEAR(tbl_patient_info.dob) BETWEEN '".$processed_patient_year_start."' AND '".$processed_patient_year_end."' AND DATE(date_added) BETWEEN '".$start_date."' AND  '".$end_date."'    ";

		}elseif ($gender == "Male") {
		   $query = "SELECT * FROM tbl_diagnosis JOIN tbl_patient_info ON tbl_diagnosis.patient_id = tbl_patient_info.patient_id WHERE doc_id = '".$staff_id."' AND diagnosis LIKE '".$complain_fmt."'
			AND tbl_patient_info.sex = 'Male' AND YEAR(tbl_patient_info.dob) BETWEEN '".$processed_patient_year_start."' AND '".$processed_patient_year_end."' AND DATE(date_added) BETWEEN '".$start_date."'
			 AND  '".$end_date."' ";
	   }elseif($gender == "Female"){
		   $query = "SELECT * FROM tbl_diagnosis JOIN tbl_patient_info ON tbl_diagnosis.patient_id = tbl_patient_info.patient_id WHERE doc_id = '".$staff_id."' AND diagnosis LIKE '".$complain_fmt."'
			AND tbl_patient_info.sex = 'Female' AND  YEAR(tbl_patient_info.dob) BETWEEN '".$processed_patient_year_start."' AND '".$processed_patient_year_end."' AND DATE(date_added) BETWEEN '".$start_date."' 
			AND  '".$end_date."' ";
	   }

		

	  }

	 
	 
	// elseif(empty($start_date) && !empty($end_date) && !empty($gender)){

	// 	if($gender == "All"){
	// 		$query = "SELECT * FROM tbl_consulting JOIN tbl_patient_info ON tbl_consulting.patient_id = tbl_patient_info.patient_id WHERE doctor_id = '".$staff_id."' AND date_sent = '".$end_date."' ";
	
	// 		}elseif ($gender == "Male") {
	// 			$query = "SELECT * FROM tbl_consulting JOIN tbl_patient_info ON tbl_consulting.patient_id = tbl_patient_info.patient_id WHERE doctor_id = '".$staff_id."' AND tbl_patient_info.sex = 'Male' AND date_sent = '".$end_date."' ";
	// 		}elseif($gender == "Female"){
	// 			$query = "SELECT * FROM tbl_consulting JOIN tbl_patient_info ON tbl_consulting.patient_id = tbl_patient_info.patient_id WHERE doctor_id = '".$staff_id."' AND tbl_patient_info.sex = 'Female' AND date_sent = '".$end_date."' ";
	// 		}

        
	//  }elseif(!empty($start_date) && empty($end_date) && !empty($gender)){

	// 	if($gender == "All"){
	// 		$query = "SELECT * FROM tbl_consulting JOIN tbl_patient_info ON tbl_consulting.patient_id = tbl_patient_info.patient_id WHERE doctor_id = '".$staff_id."' AND date_sent = '".$start_date."' ";
	
	// 		}elseif ($gender == "Male") {
	// 			$query = "SELECT * FROM tbl_consulting JOIN tbl_patient_info ON tbl_consulting.patient_id = tbl_patient_info.patient_id WHERE doctor_id = '".$staff_id."' AND tbl_patient_info.sex = 'Male' AND date_sent = '".$start_date."' ";
	// 		}elseif($gender == "Female"){
	// 			$query = "SELECT * FROM tbl_consulting JOIN tbl_patient_info ON tbl_consulting.patient_id = tbl_patient_info.patient_id WHERE doctor_id = '".$staff_id."' AND tbl_patient_info.sex = 'Female' AND date_sent = '".$start_date."' ";
	// 		}

        
	//  }elseif(!empty($start_date) && !empty($end_date) && !empty($gender)){


	// 	if($gender == "All"){
	// 		$query = "SELECT * FROM tbl_consulting JOIN tbl_patient_info ON tbl_consulting.patient_id = tbl_patient_info.patient_id WHERE doctor_id = '".$staff_id."'
	// 		 AND date_sent BETWEEN  '".$start_date."' AND '".$end_date."'  ";
	
	// 		}elseif ($gender == "Male") {
	// 			$query = "SELECT * FROM tbl_consulting JOIN tbl_patient_info ON tbl_consulting.patient_id = tbl_patient_info.patient_id WHERE doctor_id = '".$staff_id."'
	// 			 AND tbl_patient_info.sex = 'Male' AND date_sent BETWEEN  '".$start_date."' AND '".$end_date."' ";
	// 		}elseif($gender == "Female"){
	// 			$query = "SELECT * FROM tbl_consulting JOIN tbl_patient_info ON tbl_consulting.patient_id = tbl_patient_info.patient_id WHERE doctor_id = '".$staff_id."'
	// 			 AND tbl_patient_info.sex = 'Female' AND date_sent BETWEEN  '".$start_date."' AND '".$end_date."' ";
	// 		}



	//  }


	 
	 $a= mysqli_query($connection,$query);


	 $row_cnt = mysqli_num_rows($a);



	if($row_cnt > 0){
   $_SESSION['count_diagnosis_rows'] = $row_cnt;
	return $a;
	//mysqli_free_result($a);
	}else{
		$_SESSION['count_diagnosis_rows'] = 0;
	   return null;
	}

}








function search_medical_history_reports($staff_id,$start_date,$end_date,$category,$gender){
	global $connection;

	$search = false;
	if(empty($start_date) && empty($end_date) && ($gender != "--------------------") && ($category != "--------------------")){

	//	$complain_fmt = '%'.$complain.'%';

		if($gender == "All" && $category =="Complains"){
		
		$_SESSION['medical_history_category'] = "Complains";
		$query = "SELECT * FROM tbl_tmp_complain JOIN tbl_patient_info ON tbl_tmp_complain.patient_id = tbl_patient_info.patient_id WHERE doctor_id = '".$staff_id."' ";

		}elseif ($gender == "Male" && $category == "Complains") {
			$query = "SELECT * FROM tbl_tmp_complain JOIN tbl_patient_info ON tbl_tmp_complain.patient_id = tbl_patient_info.patient_id WHERE doctor_id = '".$staff_id."' AND tbl_patient_info.sex = 'Male'  ";
		}elseif($gender == "Female" && $category == "Complains"){
			$query = "SELECT * FROM tbl_tmp_complain JOIN tbl_patient_info ON tbl_tmp_complain.patient_id = tbl_patient_info.patient_id WHERE doctor_id = '".$staff_id."' AND tbl_patient_info.sex = 'Female' ";
		}

	 }

	  
	 
	 $a= mysqli_query($connection,$query);


	 $row_cnt = mysqli_num_rows($a);



	if($row_cnt > 0){
   $_SESSION['count_medical_history_rows'] = $row_cnt;
	return $a;
	//mysqli_free_result($a);
	}else{
		$_SESSION['count_medical_history_rows'] = 0;
	   return null;
	}

}






function search_cashier_payment_period_option($staff_id,$period_option){
	global $connection;


//	$query = "SELECT * FROM consultingpayment2cashier ";

	//$search = false;
	 if($period_option != "--------------------"){

	 

	 	if($period_option == "Yesterday"){

	 		$yesterday = date("Y-m-d", strtotime("yesterday"));
		
	 	$query = "SELECT * FROM consultingpayment2cashier  WHERE staff_id = '".$staff_id."' AND date_added =  '".$yesterday."' ";

	 	}elseif ($period_option == "Today") {
			$date_today = date('Y-m-d');
			$query = "SELECT * FROM consultingpayment2cashier  WHERE staff_id = '".$staff_id."' AND date_added = '".$date_today."' ";
		}
	elseif($period_option == "This-Week"){
		$lastWeek = date("Y-m-d", strtotime("-7 days"));
		echo $lastWeek;
			$query = "SELECT * FROM consultingpayment2cashier  WHERE staff_id = '".$staff_id."' AND date_added = '".$lastWeek."' ";
	 	}
	elseif($period_option == "This-Month"){
		$lastMonth = date("Y-m-d", strtotime("-1 month"));
	 		$query = "SELECT * FROM consultingpayment2cashier  WHERE staff_id = '".$staff_id."' AND date_added = '".$lastMonth."' ";
		} 

	  }

	  
	 
	 $a= mysqli_query($connection,$query);


	 $row_cnt = mysqli_num_rows($a);



	if($row_cnt > 0){
   $_SESSION['count_payment_consult_rows'] = $row_cnt;
	return $a;
	//mysqli_free_result($a);
	}else{
		$_SESSION['count_payment_consult_rows'] = 0;
	   return null;
	}

}







function search_cashier_drugs_dispensed_payment_period_option($staff_id,$period_option){
	global $connection;


//	$query = "SELECT * FROM consultingpayment2cashier ";

	//$search = false;
	 if($period_option != "--------------------"){

	 

	 	if($period_option == "Yesterday"){

	 		$yesterday = date("Y-m-d", strtotime("yesterday"));
		
	 	$query = "SELECT * FROM drug2depenseinfo  WHERE staff_id = '".$staff_id."' AND date_added =  '".$yesterday."' ";

	 	}elseif ($period_option == "Today") {
			$date_today = date('Y-m-d');
			$query = "SELECT * FROM drug2depenseinfo  WHERE staff_id = '".$staff_id."' AND date_added = '".$date_today."' ";
		}
	elseif($period_option == "This-Week"){
		$lastWeek = date("Y-m-d", strtotime("-7 days"));
		echo $lastWeek;
			$query = "SELECT * FROM drug2depenseinfo  WHERE staff_id = '".$staff_id."' AND date_added = '".$lastWeek."' ";
	 	}
	elseif($period_option == "This-Month"){
		$lastMonth = date("Y-m-d", strtotime("-1 month"));
	 		$query = "SELECT * FROM drug2depenseinfo  WHERE staff_id = '".$staff_id."' AND date_added = '".$lastMonth."' ";
		} 

	  }

	  
	 
	 $a= mysqli_query($connection,$query);


	 $row_cnt = mysqli_num_rows($a);



	if($row_cnt > 0){
   $_SESSION['count_payment_drug_consult_rows'] = $row_cnt;
	return $a;
	//mysqli_free_result($a);
	}else{
		$_SESSION['count_payment_drug_consult_rows'] = 0;
	   return null;
	}

}








function search_cashier_payment_period_option_investigation($staff_id,$period_option){
	global $connection;


//	$query = "SELECT * FROM consultingpayment2cashier//drug2depenseinfo ";

	//$search = false;
	 if($period_option != "--------------------"){

	 

	 	if($period_option == "Yesterday"){

	 		$yesterday = date("Y-m-d", strtotime("yesterday"));
		
	 	$query = "SELECT * FROM investigation_payemnt2_cashier  WHERE date_added =  '".$yesterday."' ";

	 	}elseif ($period_option == "Today") {
			$date_today = date('Y-m-d');
			$query = "SELECT * FROM investigation_payemnt2_cashier WHERE date_added = '".$date_today."' ";
		}
	elseif($period_option == "This-Week"){
		$lastWeek = date("Y-m-d", strtotime("-7 days"));
		//echo $lastWeek;
			$query = "SELECT * FROM investigation_payemnt2_cashier WHERE date_added = '".$lastWeek."' ";
	 	}
	elseif($period_option == "This-Month"){
		$lastMonth = date("Y-m-d", strtotime("-1 month"));
	 		$query = "SELECT * FROM investigation_payemnt2_cashier  WHERE date_added = '".$lastMonth."' ";
		} 

	  }

	  
	 
	 $a= mysqli_query($connection,$query);


	 $row_cnt = mysqli_num_rows($a);



	if($row_cnt > 0){
   $_SESSION['count_payment_investigation_rows'] = $row_cnt;
	return $a;
	//mysqli_free_result($a);
	}else{
		$_SESSION['count_payment_investigation_rows'] = 0;
	   return null;
	}

}








function search_cashier_payment_period_option_sum_amount($staff_id,$period_option){
	global $connection;


    //	$query = "SELECT * FROM consultingpayment2cashier ";

	//$search = false;
	 if($period_option != "--------------------"){

	 

	 	if($period_option == "Yesterday"){

	 		$yesterday = date("Y-m-d", strtotime("yesterday"));
		
	 	$query = "SELECT SUM(amount) FROM consultingpayment2cashier  WHERE staff_id = '".$staff_id."' AND date_added =  '".$yesterday."' ";

	 	}elseif ($period_option == "Today") {
			$date_today = date('Y-m-d');
			$query = "SELECT SUM(amount) FROM consultingpayment2cashier  WHERE staff_id = '".$staff_id."' AND date_added = '".$date_today."' ";
		}
	elseif($period_option == "This-Week"){
		$lastWeek = date("Y-m-d", strtotime("-7 days"));
		echo $lastWeek;
			$query = "SELECT SUM(amount) FROM consultingpayment2cashier  WHERE staff_id = '".$staff_id."' AND date_added = '".$lastWeek."' ";
	 	}
	elseif($period_option == "This-Month"){
		$lastMonth = date("Y-m-d", strtotime("-1 month"));
	 		$query = "SELECT SUM(amount) FROM consultingpayment2cashier  WHERE staff_id = '".$staff_id."' AND date_added = '".$lastMonth."' ";
		} 

	  }

	  
	 
	 $getAmount= mysqli_query($connection,$query);

	 if(mysqli_affected_rows($connection) > 0){
		while($thePatients = mysqli_fetch_array($getAmount)){
		
			return  $thePatients['SUM(amount)'];
		}
		
		}else{
		return 0;
		}

}




function search_cashier_investigation_payment_period_option_sum_amount($staff_id,$period_option){
	global $connection;


    //	$query = "SELECT * FROM consultingpayment2cashier ";

	//$search = false;
	 if($period_option != "--------------------"){

	 

	 	if($period_option == "Yesterday"){

	 		$yesterday = date("Y-m-d", strtotime("yesterday"));
		
	 	$query = "SELECT SUM(amount) FROM investigation_payemnt2_cashier  WHERE  date_added =  '".$yesterday."' ";

	 	}elseif ($period_option == "Today") {
			$date_today = date('Y-m-d');
			$query = "SELECT SUM(amount) FROM investigation_payemnt2_cashier  WHERE  date_added = '".$date_today."' ";
		}
	elseif($period_option == "This-Week"){
		$lastWeek = date("Y-m-d", strtotime("-7 days"));
		echo $lastWeek;
			$query = "SELECT SUM(amount) FROM investigation_payemnt2_cashier  WHERE   date_added = '".$lastWeek."' ";
	 	}
	elseif($period_option == "This-Month"){
		$lastMonth = date("Y-m-d", strtotime("-1 month"));
	 		$query = "SELECT SUM(amount) FROM investigation_payemnt2_cashier  WHERE  date_added = '".$lastMonth."' ";
		} 

	  }

	  
	 
	 $getAmount= mysqli_query($connection,$query);

	 if(mysqli_affected_rows($connection) > 0){
		while($thePatients = mysqli_fetch_array($getAmount)){
		
			return  $thePatients['SUM(amount)'];
		}
		
		}else{
		return 0;
		}

}






function search_cashier_payment_drug_period_option_sum_amount($staff_id,$period_option){
	global $connection;


    //	$query = "SELECT * FROM consultingpayment2cashier ";

	//$search = false;
	 if($period_option != "--------------------"){

	 

	 	if($period_option == "Yesterday"){

	 		$yesterday = date("Y-m-d", strtotime("yesterday"));
		
	 	$query = "SELECT SUM(amount) FROM drug2depenseinfo  WHERE staff_id = '".$staff_id."' AND date_added =  '".$yesterday."' ";

	 	}elseif ($period_option == "Today") {
			$date_today = date('Y-m-d');
			$query = "SELECT SUM(amount) FROM drug2depenseinfo  WHERE staff_id = '".$staff_id."' AND date_added = '".$date_today."' ";
		}
	elseif($period_option == "This-Week"){
		$lastWeek = date("Y-m-d", strtotime("-7 days"));
		echo $lastWeek;
			$query = "SELECT SUM(amount) FROM drug2depenseinfo  WHERE staff_id = '".$staff_id."' AND date_added = '".$lastWeek."' ";
	 	}
	elseif($period_option == "This-Month"){
		$lastMonth = date("Y-m-d", strtotime("-1 month"));
	 		$query = "SELECT SUM(amount) FROM drug2depenseinfo  WHERE staff_id = '".$staff_id."' AND date_added = '".$lastMonth."' ";
		} 

	  }

	  
	 
	 $getAmount= mysqli_query($connection,$query);

	 if(mysqli_affected_rows($connection) > 0){
		while($thePatients = mysqli_fetch_array($getAmount)){
		
			return  $thePatients['SUM(amount)'];
		}
		
		}else{
		return 0;
		}

}



//////// RANGE SELECTION FOR CASHIER REVENUE REPORTS   /////////////////////////////////////







function search_cashier_payment_range_option($staff_id,$start,$end){
	global $connection;
	 if(!empty($start) && !empty($end)){
		
	$query = "SELECT * FROM consultingpayment2cashier  WHERE staff_id = '".$staff_id."' AND date_added BETWEEN '".$start."' AND '".$end."' ";	 	 

	}elseif(!empty($start) && empty($end)){
	$query = "SELECT * FROM consultingpayment2cashier  WHERE staff_id = '".$staff_id."' AND date_added = '".$start."' ";
	}else{
		$query = "SELECT * FROM consultingpayment2cashier  WHERE staff_id = '".$staff_id."' AND date_added = '".$end."' ";
	}

	  
	 
	 $a= mysqli_query($connection,$query);


	 $row_cnt = mysqli_num_rows($a);



	if($row_cnt > 0){
   $_SESSION['count_payment_range_consult_rows'] = $row_cnt;
	return $a;
	//mysqli_free_result($a);
	}else{
		$_SESSION['count_payment_range_consult_rows'] = 0;
	   return null;
	}

}



function search_cashier_payment_range_option_invest($staff_id,$start,$end){
	global $connection;
	 if(!empty($start) && !empty($end)){
		
	$query = "SELECT * FROM investigation_payemnt2_cashier  WHERE date_added BETWEEN '".$start."' AND '".$end."' ";	 	 

	}elseif(!empty($start) && empty($end)){
	$query = "SELECT * FROM investigation_payemnt2_cashier  WHERE  date_added = '".$start."' ";
	}else{
		$query = "SELECT * FROM investigation_payemnt2_cashier  WHERE  date_added = '".$end."' ";
	}

	  
	 
	 $a= mysqli_query($connection,$query);


	 $row_cnt = mysqli_num_rows($a);



	if($row_cnt > 0){
   $_SESSION['count_payment_range_inv_consult_rows'] = $row_cnt;
	return $a;
	//mysqli_free_result($a);
	}else{
		$_SESSION['count_payment_range_inv_consult_rows'] = 0;
	   return null;
	}

}



function search_cashier_payment_range_option_drg($staff_id,$start,$end){
	global $connection;
	 if(!empty($start) && !empty($end)){
		
	$query = "SELECT * FROM drug2depenseinfo  WHERE staff_id = '".$staff_id."' AND date_added BETWEEN '".$start."' AND '".$end."' ";	 	 

	}elseif(!empty($start) && empty($end)){
	$query = "SELECT * FROM drug2depenseinfo  WHERE staff_id = '".$staff_id."' AND date_added = '".$start."' ";
	}else{
		$query = "SELECT * FROM drug2depenseinfo  WHERE staff_id = '".$staff_id."' AND date_added = '".$end."' ";
	}

	  
	 
	 $a= mysqli_query($connection,$query);


	 $row_cnt = mysqli_num_rows($a);



	if($row_cnt > 0){
   $_SESSION['count_payment_range_drg_consult_rows'] = $row_cnt;
	return $a;
	//mysqli_free_result($a);
	}else{
		$_SESSION['count_payment_range_drg_consult_rows'] = 0;
	   return null;
	}

}







function search_cashier_payment_range_option_amount_drug($staff_id,$start,$end){
	global $connection;
	 if(!empty($start) && !empty($end)){
		
	$query = "SELECT SUM(amount) FROM drug2depenseinfo  WHERE staff_id = '".$staff_id."' AND date_added BETWEEN '".$start."' AND '".$end."' ";	 	 

	}elseif(!empty($start) && empty($end)){
	$query = "SELECT SUM(amount) FROM drug2depenseinfo  WHERE staff_id = '".$staff_id."' AND date_added = '".$start."' ";
	}else{
		$query = "SELECT SUM(amount) FROM drug2depenseinfo  WHERE staff_id = '".$staff_id."' AND date_added = '".$end."' ";
	}

	  
	 
	$getAmount= mysqli_query($connection,$query);

	if(mysqli_affected_rows($connection) > 0){
	   while($thePatients = mysqli_fetch_array($getAmount)){
	   
		   return  $thePatients['SUM(amount)'];
	   }
	   
	   }else{
	   return 0;
	   }

}



function search_cashier_payment_range_option_amount_investigation($staff_id,$start,$end){
	global $connection;
	 if(!empty($start) && !empty($end)){
		
	$query = "SELECT SUM(amount) FROM investigation_payemnt2_cashier  WHERE date_added BETWEEN '".$start."' AND '".$end."' ";	 	 

	}elseif(!empty($start) && empty($end)){
	$query = "SELECT SUM(amount) FROM investigation_payemnt2_cashier  WHERE date_added = '".$start."' ";
	}else{
		$query = "SELECT SUM(amount) FROM investigation_payemnt2_cashier  WHERE date_added = '".$end."' ";
	}

	  
	 
	$getAmount= mysqli_query($connection,$query);

	if(mysqli_affected_rows($connection) > 0){
	   while($thePatients = mysqli_fetch_array($getAmount)){
	   
		   return  $thePatients['SUM(amount)'];
	   }
	   
	   }else{
	   return 0;
	   }

}




function search_cashier_payment_range_option_amount($staff_id,$start,$end){
	global $connection;
	 if(!empty($start) && !empty($end)){
		
	$query = "SELECT SUM(amount) FROM consultingpayment2cashier  WHERE staff_id = '".$staff_id."' AND date_added BETWEEN '".$start."' AND '".$end."' ";	 	 

	}elseif(!empty($start) && empty($end)){
	$query = "SELECT SUM(amount) FROM consultingpayment2cashier  WHERE staff_id = '".$staff_id."' AND date_added = '".$start."' ";
	}else{
		$query = "SELECT SUM(amount) FROM consultingpayment2cashier  WHERE staff_id = '".$staff_id."' AND date_added = '".$end."' ";
	}

	  
	 
	$getAmount= mysqli_query($connection,$query);

	if(mysqli_affected_rows($connection) > 0){
	   while($thePatients = mysqli_fetch_array($getAmount)){
	   
		   return  $thePatients['SUM(amount)'];
	   }
	   
	   }else{
	   return 0;
	   }

}


function patient_age_opd($patient_id){
    global $connection;
    $sql = "SELECT dob FROM tbl_patient_info WHERE patient_id='".$patient_id."'";
    $query_run = mysqli_query($connection,$sql);
    $query_run_results = $query_run->fetch_assoc();
	$dob = $query_run_results['dob'];
    return $dob;
    
}
















?>