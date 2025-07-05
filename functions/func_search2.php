<?php
//this file handles searches in the system

function get_pat_details($a){//recieves only patient id to initiate query
	
	//search with patient id
	if(isset($a)){
	$query = "SELECT * FROM tbl_patient_info WHERE patient_id='".$a."'";
	
	if($result = mysql_query($query)){
		
		if($answer = mysql_num_rows($result)){
			
			
			while($tinz=mysql_fetch_array($result)){
		
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
}//end of while loop
		  }
	}
	
	}
		

}//end of function get patient details



//multiple search query 
function search_pat_info($search){
	//search query if patient id is entered
	
	$query = "SELECT patient_id FROM tbl_patient_info WHERE patient_id = '".$search."'";
	
	$a= mysql_query($query);
	$b=mysql_num_rows($a);
	
	
	if ($b==1){
		$c = mysql_result($a,0, 'patient_id');
		
		return $c;
		
	}else{
		//search query if nhis id is inserted
	
	$query = "SELECT patient_id FROM scheme WHERE membership_id = '".$search."'";
	
	$a= mysql_query($query) or die(mysql_error());
			
	$b=mysql_num_rows($a);
	
	if ($b==1){
		$c = mysql_result($a,0, 'patient_id');
		echo "second query initiating<br />";
		return $c;

	}	else{
		//seach query if national_id is inerted
		$query = "SELECT patient_id FROM tbl_patient_info WHERE national_id = '".$search."'";
	
	$a= mysql_query($query) or die(mysql_error());
	$b=mysql_num_rows($a);
	
	if ($b==1){
		$c = mysql_result($a,0, 'patient_id');
		echo "third query initiating<br />";
		return $c;

	}
	}
	
	
		} 
		
	}
///////////////Age function


function get_age($dob){
	
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
	$sql = "SELECT * FROM `tbl_staff` WHERE occupation='doctor'";
	
	$query_run = mysql_query($sql);
	
	while($see=mysql_fetch_array($query_run)){
		
		echo "<option value=".$see['staff_id'].">".$see['firstName']." ".$see['otherNames']."</option>";
	}
	
	
}




?>