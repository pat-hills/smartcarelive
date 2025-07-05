<?php
 
 require_once "func_common.php";

function total_pat(){

	global $connection;
	
	$sql = "SELECT COUNT(*) as total_pat FROM `tbl_patient_info`";
	$query_run = mysqli_query($connection,$sql);
	$rows = mysqli_fetch_assoc($query_run);
	echo $rows['total_pat'];
	
}
function total_staff(){
	global $connection;
	
	$sql = "SELECT COUNT(*) as total_staff FROM `tbl_staff`";
	$query_run = mysqli_query($connection,$sql);
	$rows = mysqli_fetch_assoc($query_run);
	echo $rows['total_staff'];
	
}

//function to get patients subscribed to NHIS
function total_nhis(){
	global $connection;
	$sql = "SELECT COUNT(*) as total_nhis FROM `scheme_info`";
	$query_run = mysqli_query($connection,$sql);
	$rows = mysqli_fetch_assoc($query_run);
	echo $rows['total_nhis'];
	
}

//function to get total male patients
function total_males(){
	global $connection;
	$sql = "SELECT COUNT(*) as total_males FROM `tbl_patient_info` WHERE sex ='male'";
	$query_run = mysqli_query($connection,$sql);
	$rows = mysqli_fetch_assoc($query_run);
	echo $rows['total_males'];
	
}

//function to get total female patients
function total_females(){
	global $connection;
	$sql = "SELECT COUNT(*) as total_females FROM `tbl_patient_info` WHERE sex ='female'";
	$query_run = mysqli_query($connection,$sql);
	$rows = mysqli_fetch_assoc($query_run);
	echo $rows['total_females'];
	
}

//function to get total visits today
function total_visits(){
	global $connection;
	$date = date('Y-m-d');
	$sql = "SELECT COUNT(*) as total_visits FROM `tbl_consulting` WHERE date_sent = '".$date."'";
	$query_run = mysqli_query($connection,$sql);
	$rows = mysqli_fetch_assoc($query_run);
	echo $rows['total_visits'];
	
}

////REPORTS FOR ADMIN

 

////REPORTS FOR ADMIN

//function to get total doctor's logged in today
function total_docs(){
	global $connection;
	$sql = "SELECT COUNT(*) as total_doc FROM `tbl_staff` WHERE occupation ='Doctor or Consulting'";
	$query_run = mysqli_query($connection,$sql);
	$rows = mysqli_fetch_assoc($query_run);
	echo $rows['total_doc'];
	
}



//personal info function...Patients Registration

function check_date(){
	global $connection;
	
	$id = "1";
	$sql = "SELECT date_check from patient_id_check where id = '".$id."'";
	$query_run = mysqli_query($connection,$sql);
	$result=$query_run->fetch_assoc();
	return $result['date_check'];	
}
function reset_check_counter(){
    global $connection;
	$resetdate = 00;
    $currentYear = date('y');
	$get_date_check = check_date();
	
	if($get_date_check < $currentYear){
	
		$get_date_check = $resetdate; //To validate database issues
	}else if($get_date_check > $currentYear){

		$get_date_check = $resetdate; //To validate database issues
	}
          
	if( $currentYear > $get_date_check){
	
		//Reset Counter
		$default_number = 1000;
		$id = "1";
		$sql = "UPDATE patient_id_check SET counter = '".$default_number."', date_check = '".$currentYear."' WHERE id = '".$id."'";
		$query_run = mysqli_query($connection,$sql);
		//$result=mysql_result($query_run, 0, 'date_check');
		//return $result;	
	}
	
}

function check_counter(){
	global $connection;
	$id = "1";
	$sql = "SELECT counter from patient_id_check where id = '".$id."'";
	$query_run = mysqli_query($connection, $sql);
	$result = $query_run->fetch_assoc();
	return $result['counter'];	
}	

function generate_patients_id(){
	reset_check_counter();
	$patient_counter = check_counter();
	$year = date('y');
	return "PAT" . $year . $patient_counter;
}


function update_check_counter($old_value){
	global $connection;
	$id = "1";
	 $old_value = $old_value + 1;
	
	$sql = "UPDATE patient_id_check SET counter = '".$old_value."' WHERE id = '".$id."'";
	$query_run = mysqli_query($connection,$sql);
	if($query_run){
		return TRUE;
	}else{
		return FALSE;
	}
}



function per_info($surname,$other_names,$sex,$marital_stat,$occupation,$phone,$address,$national_id,$sms_format,$pat_email,$dob){
	global $connection;
	@session_start();
	$created_by = $_SESSION['uid'];
	$date = date('Y-m-d H:i:s');
	$patient_id = generate_patients_id();
	

	$check_patient_id = check_patient_id($patient_id);

	if(!$check_patient_id){

		$insert = "INSERT INTO tbl_patient_info 
	(patient_id,surname,other_names,sex,marital_stat,occupation,phone,address,national_id,sms_contact,email_contact, date_created,created_by, dob) VALUES 
    ('".$patient_id."','".$surname."','".$other_names."','".$sex."','".$marital_stat."','".$occupation."','".$phone."','".$address."','".$national_id."','".$sms_format."','".$pat_email."','".$date."','".$created_by."','".$dob."')";
	
	if($query_run = mysqli_query($connection,$insert)){
	$old_value = check_counter();
	update_check_counter($old_value);
	
	$_SESSION['patient_id'] = $patient_id;
	return true;
	}else{
		echo "no ".mysqli_error();
                return false;
	}

	}else{

		return false;
	}
	
	


	
}


//medical info function
function med_info($a,$b,$c,$d,$e,$f,$g,$h){

	global $connection;
	
	$insert ="INSERT INTO tbl_med_info (patient_id,epilepsy,hypertension,diabetes,blood_group,sickle_cell,allergies,other)
	VALUES
	('".$a."','".$b."','".$c."','".$d."','".$e."','".$f."','".$g."','".$h."')";
	
	if($query_run = mysqli_query($insert)){
				
	echo "yes";
		
	}else{
		echo "no ".mysqli_error();
	}
}

//scheme details function
// function scheme_details($patient_id, $membership_id,$scheme){
// global $connection;
// $insert = "INSERT INTO scheme (patient_id, membership_id, scheme)
// VALUES('".$patient_id."','".$membership_id."','".$scheme."')";
// 	if($query_run = mysqli_query($connection,$insert)){
				
// 	echo "yes";
		
// 	}else{
// 		echo "no ".mysqli_error();
// 	}
// }

function scheme_details($patient_id, $membership_id, $scheme) {
    global $connection;

    // First, check if the patient_id already exists
    $check_sql = "SELECT id FROM scheme WHERE patient_id = ?";
    $stmt = mysqli_prepare($connection, $check_sql);
    mysqli_stmt_bind_param($stmt, "s", $patient_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        // Patient exists – perform an update
        $update_sql = "UPDATE scheme SET membership_id = ?, scheme = ? WHERE patient_id = ?";
        $update_stmt = mysqli_prepare($connection, $update_sql);
        mysqli_stmt_bind_param($update_stmt, "sss", $membership_id, $scheme, $patient_id);

        if (mysqli_stmt_execute($update_stmt)) {
            echo "updated";
        } else {
            echo "update error: " . mysqli_error($connection);
        }

        mysqli_stmt_close($update_stmt);
    } else {
        // Patient does not exist – insert new
        $insert_sql = "INSERT INTO scheme (patient_id, membership_id, scheme) VALUES (?, ?, ?)";
        $insert_stmt = mysqli_prepare($connection, $insert_sql);
        mysqli_stmt_bind_param($insert_stmt, "sss", $patient_id, $membership_id, $scheme);

        if (mysqli_stmt_execute($insert_stmt)) {
            echo "inserted";
        } else {
            echo "insert error: " . mysqli_error($connection);
        }

        mysqli_stmt_close($insert_stmt);
    }

    mysqli_stmt_close($stmt);
}





//make registered main patient's folder

function pat_folder_main($a,$b,$c){
					
		if(!is_dir($a)){
		mkdir($a,$b,$c);
		}
}

function pat_folder_scan($a,$b,$c){//lab and scan folder creation.
					
		if(!is_dir($a)){
		mkdir($a,$b,$c);
		}
}


function pat_folder_ofold($a,$b,$c){//old folders scanned images
					
		if(!is_dir($a)){
		mkdir($a,$b,$c);
		}
}

function pat_lab_result($a,$b,$c){//lab folders for results upload(pink sheet)
					
		if(!is_dir($a)){
		mkdir($a,$b,$c);
		}
}

/*
function get_all_id(){//function to get all patients ID in the hospital
	
	$sql = "SELECT patient_id FROM tbl_patient_info";
	$query_run = mysql_query($sql);
	while($result=mysql_fetch_array($query_run)){
		
		echo "<option value=".$result['patient_id'].">".$result['patient_id']."</option>";
	}
}
function get_all_nid(){//function to get all National IDs in the hospital
	
	$sql = "SELECT national_id FROM tbl_patient_info";
	$query_run = mysql_query($sql);
	while($result=mysql_fetch_array($query_run)){
		
		echo "<option value=".$result['national_id'].">".$result['national_id']."</option>";
	}
}

function get_all_NHIS(){//function to get all National IDs in the hospital
	
	$sql = "SELECT sch_id FROM scheme_info";
	$query_run = mysql_query($sql);
	while($result=mysql_fetch_array($query_run)){
		
		echo "<option value=".$result['sch_id'].">".$result['sch_id']."</option>";
	}
}

function patient_profile_picture($patientID){
	
	$path = "../../patients/".$patientID."/".$patientID.".jpg";
	echo $path;
}

*/

function go_consult($patient_id, $doctor_id, $date,$service_type, $attendance_type, $service_package,$room_id){
	$sql = "INSERT INTO tbl_consulting (patient_id,doctor_id, date_sent, service_type, attendance_type, service_package,con_room) 
	VALUES ('".$patient_id."','".$doctor_id."','".$date."','".$service_type."', '".$attendance_type."','".$service_package."','".$room_id."')";
	
	if($query_run = mysql_query($sql)  or die(mysql_error())){
				
	echo "yes";
		
	}else{
		echo "no ".mysql_error();
	}
}

function get_submetro_list(){//function to get all sub metro list

	global $connection;
	
	$sql = "SELECT * FROM submetro_list";
	$query_run = mysqli_query($connection,$sql);
	while($result=mysqli_fetch_array($query_run)){
		echo "<option value=".$result['code'].">".$result['name']." (Code: ".$result['code'].")</option>";
	}
}

function select_submetro($code){
	global $connection;
	$sql = "SELECT * FROM submetro_list WHERE code = '".$code."'";
	$query_run = mysqli_query($connection,$sql);
	while($result=mysqli_fetch_array($query_run)){
		
		//echo "<option value=".$result['code'].">".$result['name']." (Code: ".$result['code'].")</option>";
		return $result;
	}
}


//function to get all patient update date into forms
function get_patient_info($patientID){
	global $connection;
	//search with patient id
	if(isset($patientID)){
		$query = "SELECT * FROM tbl_patient_info WHERE patient_id='".$patientID."'";
	
		if($result = mysqli_query($connection,$query)){
			
			while($row = mysqli_fetch_assoc($result)){
		
				/*$_SESSION['patient_id']=$tinz['patient_id'];
				$_SESSION['surname']=$tinz['surname'];
				$_SESSION['other_names']=$tinz['other_names'];
				$_SESSION['sex']=$tinz['sex'];
				$_SESSION['marital_stat']=$tinz['marital_stat'];
				$_SESSION['occupation']=$tinz['occupation'];
				$_SESSION['phone']=$tinz['phone'];
				$_SESSION['address']=$tinz['address'];
				$_SESSION['national_id']=$tinz['national_id'];
				$_SESSION['dob'] = $tinz['dob'];*/
				return $row;

			}//end of while loop
			
		} 
	}
}

function patient_medical_info_update($patientID){//recieves only patient id to initiate query
	
	$query = "SELECT * FROM tbl_med_info WHERE patient_id='".$patientID."'";
	
	if($result = mysql_query($query)){
		
		if($answer = mysql_num_rows($result)){
			
			
			while($tinz=mysql_fetch_array($result)){
		
	
				$_SESSION['epilepsy']=$tinz['epilepsy'];
				$_SESSION['hypertension']=$tinz['hypertension'];
				$_SESSION['diabetes']=$tinz['diabetes'];
				$_SESSION['blood_group']=$tinz['blood_group'];
				$_SESSION['sickle_cell']=$tinz['sickle_cell'];
				$_SESSION['allergies']=$tinz['allergies'];
				$_SESSION['other']=$tinz['other'];
				
			}//end of while loop
		}
	}	
}//end of function get patient update details

function get_patient_scheme_info($patientID){
	global $connection;
	//search with patient id
	if(isset($patientID)){
		$query = "SELECT * FROM scheme WHERE patient_id='".$patientID."'";
		
		if($result = mysqli_query($connection,$query)){
			
			if($answer = mysqli_num_rows($result)){
				
				
				while($tinz = mysqli_fetch_array($result)){

					$_SESSION['scheme']=$tinz['scheme'];
					$_SESSION['membership_id']=$tinz['membership_id'];
				 
				}//end of while loop
			}
		}
	}
}



function select_patient_scheme_id($patient_id){
	global $connection;
	$sql = "SELECT patient_id FROM scheme WHERE patient_id = '".$patient_id."'";

	$result = mysqli_query($connection,$sql) or die(mysqli_error()); 
    
    $rows = mysqli_num_rows($result); 

    if($rows == 0 ) {
    	return 0;
    } else if($rows == 1 ) {
    	return 1;
    }
    
}

function update_patient_scheme($patient_id, $membership_id, $serial_number, $scheme, $sub_metro){
	global $connection;
	 $date = date('Y-m-d H:i:s');
	
     $sql = "UPDATE scheme SET membership_id = '".$membership_id."' , serial_number = '".$serial_number."', scheme = '".$scheme."', sub_metro = '".$sub_metro."', date_updated = '".$date."' WHERE patient_id = '".$patient_id."'";

    if(mysqli_query($connection,$sql) or die(mysqli_error())){
        
		return TRUE;
        
    } else {
		return FALSE;
    }        
}

function update_personal_info($patient_id, $surname, $other_names, $sex, $marital_stat, $occupation, $phone, $address, $national_id, $dob){

	global $connection;
	
	$sql = "UPDATE tbl_patient_info SET surname = '".$surname."' , other_names = '".$other_names."', sex = '".$sex."', marital_stat = '".$marital_stat."', occupation = '".$occupation."', phone = '".$phone."', 
	address = '".$address."', national_id = '".$national_id."', dob = '".$dob."' WHERE patient_id = '".$patient_id."'";

    if(mysqli_query($connection,$sql) or die(mysqli_error())){
        
		return TRUE;
        
    } else {
		return FALSE;
    }      
}

function update_scheme($patient_id, $membership_id, $scheme){

	global $connection;
	
	$sql = "UPDATE scheme SET membership_id = '".$membership_id."' , scheme = '".$scheme."' WHERE patient_id = '".$patient_id."'";

    if(mysqli_query($connection,$sql) or die(mysqli_error())){
        
		return TRUE;
        
    } else {
		return FALSE;
    }      
}

//family info function
function fam_info($patient_id,$fullname,$sex,$address,$relationship,$phone){
	global $connection;
	$insert = "INSERT INTO tbl_pat_family_info (patient_id,f_Name,f_Sex,f_Address,f_relation, f_Phone) VALUES
	 ('".$patient_id."','".$fullname."','".$sex."','".$address."','".$relationship."','".$phone."')";	
	if($query_run = mysqli_query($connection,$insert)){		
		return TRUE;	
	}else{
		return FALSE;
		//echo "no ".mysql_error();
	}
}

function insert_general_test($request_code,$patient_id,$lab_staff_id,$test_name,$status,$comment=null){

    global $connection;

    $date = date('Y-m-d');

    // if($is_exist){

    //     $sql="UPDATE general_status_test SET   test_status = '".$status."',remarks = '".$comment."',date_updated = '".$date."'  WHERE patient_id = '".$patient_id."' AND request_code = '".$request_code."' AND test_name = '".$test_name."' ";
    //     if(mysqli_query($connection,$sql) or die(mysqli_error())){
    //         return TRUE;
    //     } else {
    //         return FALSE;
    //     }


    // }else{
	    
	    

        $sql = "INSERT INTO general_status_test SET request_code = '".$request_code."',patient_id = '".$patient_id."',lab_staff_id = '".$lab_staff_id."',test_name = '".$test_name."',test_status = '".$status."', remarks = '".$comment."', date_submitted = CURDATE() ";       
      
        if($query_run = mysqli_query($connection,$sql) or die(mysqli_error())){
           return TRUE;
         } else {
             return FALSE;
         }

   // }



     
}

function search_patient_id($patient_id, $table){

	global $connection;
	
	$sql = "SELECT patient_id FROM ".$table." WHERE patient_id = '".$patient_id."'";
	$result = mysqli_query($connection,$sql) or die(mysqli_error()); 
    
    $rows = mysqli_num_rows($result); 

    if($rows == 0 ) {
    	return 0;
    } else if($rows == 1 ) {
    	return 1;
    }
	
}

function update_family_info($patient_id, $fullname, $sex, $address, $relationship, $blood_group, $phone){

	global $connection;
	
	//$table = "tbl_pat_family_info";
	$exists = search_patient_id($patient_id, "tbl_pat_family_info");
	
	if($exists){
		
		//die('exists');
		$sql = "UPDATE tbl_pat_family_info SET f_Name = '".$fullname."' , f_Sex = '".$sex."', f_Address = '".$address."', f_relation = '".$relationship."', f_blood_group = '".$blood_group."', f_phone = '".$phone."'
				WHERE patient_id = '".$patient_id."'";
				
		if(mysqli_query($connection,$sql) or die(mysqli_error())){
			return TRUE;
		} else {
			return FALSE;
		}
		
	} else {
		//die('does not');
		$inserted = fam_info($patient_id,$fullname,$sex,$address,$relationship,$phone);
		if($inserted){
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	      
}

function get_patient_family_info($patientID){
	global $connection;
	//search with patient id
	if(isset($patientID)){
		$query = "SELECT * FROM tbl_pat_family_info WHERE patient_id='".$patientID."'";
		
		if($result = mysqli_query($connection,$query)){
			
			while($row = mysqli_fetch_assoc($result)){
		
				/*$_SESSION['patient_id']=$tinz['patient_id'];
				$_SESSION['surname']=$tinz['surname'];
				$_SESSION['other_names']=$tinz['other_names'];
				$_SESSION['sex']=$tinz['sex'];
				$_SESSION['marital_stat']=$tinz['marital_stat'];
				$_SESSION['occupation']=$tinz['occupation'];
				$_SESSION['phone']=$tinz['phone'];
				$_SESSION['address']=$tinz['address'];
				$_SESSION['national_id']=$tinz['national_id'];
				$_SESSION['dob'] = $tinz['dob'];*/
				return $row;

			}//end of while loop
			
		} 
	}
}

function insert_patient_scheme($patient_id, $membership_id, $serial_number, $scheme, $sub_metro){

	global $connection;
    
	$date = date('Y-m-d H:i:s');
    $sql = "INSERT INTO scheme SET patient_id = '".$patient_id."', membership_id = '".$membership_id."' , serial_number = '".$serial_number."', scheme = '".$scheme."', sub_metro = '".$sub_metro."', date_added = '".$date."'";
    
	    if(mysqli_query($connection,$sql)){
	         return TRUE;  
	    }  else {
	        return FALSE;
	    }         
	    
}

function patients_list(){
	
	global $connection;

	//$sql = "SELECT tbl_patient_info.id,tbl_patient_info.patient_id, tbl_patient_info.surname,tbl_patient_info.other_names,tbl_patient_info.phone, scheme.membership_id FROM tbl_patient_info, scheme WHERE tbl_patient_info.patient_id = scheme.patient_id OR scheme.patient_id = NULL ORDER BY tbl_patient_info.id ASC";
	$sql = "SELECT tbl_patient_info.patient_id, tbl_patient_info.surname,tbl_patient_info.other_names,tbl_patient_info.phone, tbl_patient_info.address FROM tbl_patient_info ORDER BY tbl_patient_info.id ASC";

	$result = mysqli_query($connection,$sql) or die(mysqli_error());

		while ($row = mysqli_fetch_assoc($result)) {
			
			extract($row);
		
			echo "
				<tr>
					<td>{$patient_id}</td>
					<td>{$surname} {$other_names}</td>
					<td>{$phone}</td>
					<td>{$address}</td>
					<td class='center'><div class='btn-group'><button class='btn btn-default btn-xs' type='button'>Actions</button><button data-toggle='dropdown' class='btn btn-xs btn-primary dropdown-toggle' type='button'><span class='caret'></span><span class='sr-only'>Toggle Dropdown</span></button><ul role='menu' class='dropdown-menu pull-right'><li><a href='#'>Profile</a></li><li><a href='#'>Reports</a></li><li><a href='#'>Medical History</a></li><li class='divider'></li><li><a href='#'>Delete</a></li></ul></div> </td>
				</tr>
			";
		}

	
}

//function to select radio buttons
function set_med_info(){

switch (@$_SESSION['epilepsy']) {
	case '0':
		# code...
		
	$_SESSION['epilepsyYes'] = "";
	$_SESSION['epilepsyNo'] ="Checked=''";
		break;

	case '1':
		# code...
	$_SESSION['epilepsyYes'] = "Checked=''";
	$_SESSION['epilepsyNo'] ="";
		break;
	
	default:
		# code...
		break;
}

switch (@$_SESSION['hypertension']) {
	case '0':
		# code...
	$_SESSION['hyperYes']="";
	$_SESSION['hyperNo']="Checked=''";
		break;
	case '1':
		# code...
	$_SESSION['hyperYes']="Checked=''";
	$_SESSION['hyperNo']="";
		break;
	
	default:
		# code...
		break;
}

switch (@$_SESSION['diabetes']) {
	case '0':
		# code...
	$_SESSION['diaYes']="";
	$_SESSION['diaNo']="Checked=''";
		break;
	case '1':
		# code...
	$_SESSION['diaYes']="Checked=''";
	$_SESSION['diaNo']="";
		break;
	
	default:
		# code...
		break;
}


switch (@$_SESSION['sickle_cell']) {
	case '0':
		# code...
	$_SESSION['sickleYes']="";
	$_SESSION['sickleNo']="Checked='true'";
		break;
	case '1':
		# code...
	$_SESSION['sickleYes']="Checked='true'";
	$_SESSION['sickleNo']="";
		break;
	
	default:
		# code...
		break;
}
switch (@$_SESSION['allergies']) {
	case '0':
		# code...
	$_SESSION['allergiesYes']="";
	$_SESSION['allergiesNo']="Checked='true'";
		break;
	case '1':
		# code...
	$_SESSION['allergiesYes']="Checked='true'";
	$_SESSION['allergiesNo']="";
		break;
	
	default:
		# code...
		break;
}
}

//function to get scheme info
function get_upt_scheme_info($patientID){

$query = "SELECT * FROM tbl_nhis_scheme WHERE pat_id='".$patientID."'";
	
	if($result = mysql_query($query)){
		
		if($answer = mysql_num_rows($result)){
			
			while($tinz=mysql_fetch_array($result)){
		
	
	$_SESSION['mem_id']=$tinz['membership_id'];
	$_SESSION['serial_num']=$tinz['serial_num'];
	$_SESSION['nhis_code']=$tinz['nhis_code'];
	
}//end of while loop

	}
	}

}
?>