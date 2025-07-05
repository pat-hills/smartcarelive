<?php
require_once"conndb.php";


// function get_all_id(){//function to get all patients ID in the hospital
	
// 	$sql = "SELECT patient_id FROM tbl_patient_info";
// 	$query_run = mysql_query($sql);
// 	while($result=mysql_fetch_array($query_run)){
		
// 		echo "<option value=".$result['patient_id'].">".$result['patient_id']."</option>";
// 	}
// }

// function get_all_nid(){//function to get all National IDs in the hospital
	
// 	$sql = "SELECT national_id FROM tbl_patient_info";
// 	$query_run = mysql_query($sql);
// 	while($result=mysql_fetch_array($query_run)){
		
// 		echo "<option value=".$result['national_id'].">".$result['national_id']."</option>";
// 	}
// }

// function get_all_NHIS(){//function to get all National IDs in the hospital
	
// 	$sql = "SELECT membership_id FROM scheme";
// 	$query_run = mysql_query($sql);
// 	while($result=mysql_fetch_array($query_run)){
		
// 		echo "<option value=".$result['membership_id'].">".$result['membership_id']."</option>";
// 	}
// }

function no_image(){
    
    $path = "../../patients/no-image.png";
    return $path;
    
}

function patient_profile_picture($patientID){
    
    $path = "../../patients/".$patientID."/".$patientID.".png";

   if( file_exists($path)){
        return $path;
   } else {
      return $path = "../../patients/no-image.png";
   }
     
}

function profile_picture($staff_id){
    
    $path = "../staff/".$staff_id."/".$staff_id.".png";
    
    if(file_exists($path)){
        return $path;
    } else {
        return $path = "../staff/no-image.png";
    }
    
}

function staff_profile_picture($staff_id){
    
    $path = "../../staff/".$staff_id."/".$staff_id.".png";
    
    if(file_exists($path)){
        return $path;
    } else {
        return $path = "../../staff/no-image.png";
    }
    
}

function admin_profile_picture($staff_id){
        
    $path = "../staff/".$staff_id."/".$staff_id.".png";
    
    
    if(file_exists($path)){
        echo $path;
    } else {
        return $path = "../staff/no-image.png";
    }
}



function getInstitutionDetails() {
    global $connection;

    $query = "SELECT * ";
    $query .= "FROM institution_details ";
    $query .= "WHERE deleted = 'NO' ";
  //  $query .= "ORDER BY school_name ASC";
    $query_results = mysqli_query($connection, $query);
   // confirm_query($query_results);

    if ($institution = mysqli_fetch_assoc($query_results)) {
        return $institution;
    } else {
        return NULL;
    }
}

function get_staff_info($staff_id) {
    global $connection;
    //$sql = "SELECT * FROM tbl_staff, tbl_login WHERE staff_id = '".$staff_id."'";
    $sql = "SELECT * FROM tbl_staff, tbl_login WHERE tbl_staff.staff_id = tbl_login.userid AND tbl_staff.staff_id = '".$staff_id."'";
    $result = mysqli_query($connection,$sql);
    //$rows = mysql_num_rows($result);
   
    while( $row = mysqli_fetch_assoc($result)){
        
        return $row;
        
    }
} 

function patient_name($patient_id){
    global $connection;
    $sql = "SELECT surname,other_names FROM tbl_patient_info WHERE patient_id='".$patient_id."'";
    $result = mysqli_query($connection,$sql);
    while( $row = mysqli_fetch_assoc($result)){
        
        return $row['surname'] . " " . $row['other_names'];
        
    }
    
}

function patient_name_walk_in($patient_id){
    global $connection;
    $sql = "SELECT * FROM tbl_walk_in_patient WHERE walk_code='".$patient_id."'";
    $result = mysqli_query($connection,$sql);
    while( $row = mysqli_fetch_assoc($result)){
        
        return $row;
        
    }
    
}

function ward_name($ward_id){
	global $connection;
	$sql = "SELECT ward_name FROM tbl_ward WHERE id = '".$ward_id."' ";
	$query_run = mysqli_query($connection,$sql) or die(mysqli_error());
	 $diagnosis_name = $query_run->fetch_assoc();
	return $diagnosis_name['ward_name'];
}


function drug_name($drug_code){
	global $connection;
	$sql = "SELECT Name FROM tbl_drug_list WHERE drug_code = '".$drug_code."'";
	$query_run = mysqli_query($connection,$sql) or die(mysqli_error());
	$drug_name_rows = $query_run -> fetch_assoc();
	$d_name = $drug_name_rows['Name'];
	return $d_name;
}

function get_bio($patient_id){

	global $connection;
	
	$date = date('Y-m-d');

	$sql = "SELECT patient_id,bmi,date_taken,weight,height,blood_pressure_top,blood_pressure_down
	,temperature,taken_by,pulse,respiration,s_p_0_2,fbs,rbs from  
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



function get_patient_general_test_status($patient_id, $test_name){
    global $connection;

    // Correcting the query syntax
    $sql = "SELECT test_status FROM general_status_test WHERE patient_id = '".$patient_id."' 
    AND test_name = '".$test_name."'ORDER BY id DESC LIMIT 1";

    // Executing the query
    $query_run = mysqli_query($connection, $sql) or die(mysqli_error($connection));

    // Fetching the result
    if ($query_run && mysqli_num_rows($query_run) > 0) {
        $drug_name_rows = $query_run->fetch_assoc();
        return $drug_name_rows['test_status'];
    } else {
        // Handle case when no data is found
        return "N/A"; // or an appropriate value like "No data found"
    }
}




function cal_quantity_start($v1,$v2,$v3){

	$TotalTQ =0;
	$TotalDosege =0;
	
	if($v3 =='STAT'){
	  
	$TotalDosege =$v1 * $v2;
	
	} 
	
	
	 
	
	 $TotalTQ = $TotalDosege;
	
	 return $TotalTQ;
	
	
}



function cal_quantity($v1,$v2,$v3,$v4,$v5){

	$TotalTQ =0;
	$TotalDosege =0;
	$ts =0;
	
	if($v3 =='Hourly'||$v3=='6 Hour(s)'||$v3=='8 Hour(s)'||$v3=='12 Hour(s)'){
	  
	$TotalDosege =$v1 * $v2 * $v4; 
	
	}elseif($v3 =='Daily'){
	  $TotalDosege = $v1 * $v2 * $v4; 

	  // $qty =  cal_quantity($row['quantity'],$row['times'],$row['time_interval'],$row['duration'],$row['time_span']);
	  
	}elseif($v3 =='Weekly'){
	$TotalDosege =$v1 * $v2 *$v4; 
	}elseif($v3 =='Yearly'){
	 $TotalDosege = $v1 * $v2 * $v4; 
	}elseif($v3 =='Monthly'){
	 $TotalDosege = $v1 * $v2 *$v4; 
	}elseif($v3 =='NOCTE'){
		$TotalDosege = $v1 * $v2 *$v4; 
	}elseif($v3 =='MANE'){
		$TotalDosege = $v1 * $v2 *$v4; 
	}
    elseif($v3 =='STAT'){
		$TotalDosege = $v1 * $v2; 
	   }
	
	
	if($v5 =='Day(s)'){
	$ts=1; 
	}elseif($v5 =='Week(s)'){
	$ts = 7; 
	}elseif($v5 =='Month(s)'){
	$ts = 30; 
	}elseif($v5 =='Year(s)'){
	$ts = 365; 
	}else{
        $ts = 1; 
    }
	
	 $TotalTQ = $TotalDosege * $ts;   //*$ts;
	
	 return $TotalTQ;
	
	
}

function getPatientsName($patient_id){

	global $connection;

$theSQL = "SELECT surname,other_names FROM tbl_patient_info WHERE patient_id='".$patient_id."'
          ";
      $patientinfo = mysqli_query($connection,$theSQL); 
      if(mysqli_affected_rows($connection) >0){

      	while($theSelPatientInfo = mysqli_fetch_array($patientinfo)){
     return    $theSelPatientInfo['surname'].'&nbsp;'.$theSelPatientInfo['other_names'];

      	}


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

function get_prescribtion_doctor($patient_id, $doctor_id){

	global $connection;

	$date = date('Y-m-d');
	//$sql="SELECT doc_code FROM tbl_precribtion WHERE patient_id = '".$patient_id."'AND DATE(date_added) ='".$date."'";
	$sql="SELECT doc_code FROM tbl_precribtion WHERE patient_id = '".$patient_id."'";
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




function patient_phone($patient_id){
    global $connection;
    $sql = "SELECT phone FROM tbl_patient_info WHERE patient_id='".$patient_id."'";
    $result = mysqli_query($connection,$sql);


   // $result = mysqli_query($connection,$sql);
    $rows_results = $result->fetch_assoc();
   // @$name = mysql_result($result, 0, 'name');
    return $rows_results['phone'];
    
    // while( $row = mysqli_fetch_assoc($result)){
        
    //     return $row['surname'] . " " . $row['other_names'];
        
    // }
    
}


function logout(){
    unset($_SESSION);
    session_destroy();
}

function online($username){
    global $connection;
    $value = 1;
    $sql = "UPDATE tbl_login SET online = '".$value."' WHERE uname = '".$username."'";
    if( mysqli_query($connection,$sql) or die(mysqli_error()) ) {
        return TRUE;
    } else {
        return FALSE;
    }
    
}

function offline($username){
    global $connection;
    $value = 0;
    $sql = "UPDATE tbl_login SET online = '".$value."' WHERE uname = '".$username."'";
    if( mysqli_query($connection,$sql) or die(mysqli_error()) ) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function online_users(){

    global $connection;
    
    $value = 1;
    
    $sql = "SELECT tbl_login.userid, tbl_login.online, tbl_staff.staff_id, tbl_staff.firstName, tbl_staff.otherNames FROM tbl_login, tbl_staff 
            WHERE tbl_login.userid = tbl_staff.staff_id AND tbl_login.online = '".$value."'";
    
    $result = mysqli_query($connection,$sql);
    while( $row = mysqli_fetch_assoc($result)){
        
        echo "
            <div class='col-sm-6 col-md-4'>
                
                <div class='friend-widget info'>
                    <img src=" . profile_picture($row['staff_id']) . ">                   
                    <a href='update_staff_account.php?staff_id=".$row['staff_id']."'><h4>".ucfirst($row['firstName'])." ".ucfirst($row['otherNames'])."</a>
                    <p style='width: 20px; height: 20px; margin-left:90px;'><img src='../assets/images/state_online.png' alt='Status' /></p>
                </div>
                <div style='width: 20px; height: 20px;'></div>
            </div>
        ";
        
    }
    
}

function get_consulting_room($room_id){
    global $connection;
    $sql = "SELECT name FROM consulting_room WHERE room_id = '".$room_id."'";
    $result = mysqli_query($connection,$sql);
    $rows_results = $result->fetch_assoc();
   // @$name = mysql_result($result, 0, 'name');
    return $rows_results['name'];
}

function get_doctor($doctor_id){

    $sql = "SELECT staff_id, firstName, otherNames FROM tbl_staff WHERE staff_id = '".$doctor_id."'";
    $result = mysql_query($sql) or die(mysql_error());
    //$rows = mysql_num_rows($result);
   
    while( $row = mysql_fetch_assoc($result)){
        
        return $row;
        
    }
}

function doctor_name($patient_id){
    global $connection;
    $sql = "SELECT firstName,otherNames FROM tbl_staff WHERE staff_id='".$patient_id."'";
    $result = mysqli_query($connection,$sql);
    while( $row = mysqli_fetch_assoc($result)){
        
        return $row['firstName'] . " " . $row['otherNames'];
        
    }
    
}



// function get_claim_code() {
// 	global $connection;
	 

// 	$query = "SELECT claim_code FROM tbl_claim_tracker WHERE  deleted = 'NO' AND claim_status = 'PENDING' ORDER BY id DESC LIMIT 1";


// 	$query_results = mysqli_query($connection, $query);
 

// 	if ($row = mysqli_fetch_assoc($query_results)) {
// 		return $row['claim_code'];
// 	} else {
// 		return NULL;
// 	}
// }



function doctors_room(){ 
    global $connection;
    $sql = "SELECT room_id, doctor_id FROM doctors_room";

    $query_run = mysqli_query($connection,$sql);
    
    while($row=mysqli_fetch_array($query_run)){

        $doctor = get_staff_info($row['doctor_id']);
        $room = get_consulting_room($row['room_id']);
        $_SESSION['doctors_room_id'] = $row['room_id'];
        //echo "<option value=".$row['doctor_id'].">".$row['doctor_id']." ".$row['doctor_id']."</option>";
        echo "<option value=".$doctor['staff_id']."-".$row['room_id'].">Dr. ".$doctor['firstName']." ".$doctor['otherNames']." - ".$room."</option>";
    }
}


function get_doctors_room_by_id($doctor_id){ 
    global $connection;
    $sql = "SELECT room_id FROM doctors_room WHERE doctor_id = '".$doctor_id."'";

    $query_run = mysqli_query($connection,$sql);
    
    while($row=mysqli_fetch_array($query_run)){
 
       return $row['room_id'];

    }
}


function random_str($length, $chars = 'abcdefghijklmnopqrstuvwxyz1234567890') {

    for ($string = '', $char_length = strlen($chars)-1, $i = 0; $i < $length; $string .= $chars[mt_rand(0, $char_length)], ++$i);

    return $string;
}


function greetings(){

    $greetings = "";

    $time = date("H");
     
  
    if ($time < "12") {
        $greetings = "Hello";
    } else
   
    if ($time >= "12" && $time < "17") {
        $greetings = "Hello";
    } else{

        $greetings = "Hello";
    }
   
    //if ($time >= "17" && $time < "19") {
       
    //} 
    
    // else
     
    // if ($time >= "19") {
    //     $greetings = "Good night";
    // }

    return $greetings;
   
}

function timeago($timestamp) {
	$timestamp = strtotime($timestamp);	
	
	$strTime = array("second", "minute", "hour", "day", "month", "year");
	$length = array("60","60","24","30","12","10");

	$currentTime = time();
	if($currentTime >= $timestamp) {
		 $diff     = time() - $timestamp;
		 for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
		 $diff = $diff / $length[$i];
		 }

		 $diff = round($diff);
		 return $diff . " " . $strTime[$i] . "(s) ago ";
	}
 }


  function time_passed($timestamp){
      $diff = 0;
  
   
    $current_time   = time();
    $timestamp = strtotime($timestamp);
    $diff           = $current_time - $timestamp;
    
    //intervals in seconds
    $intervals      = array (
        'year' => 31556926, 'month' => 2629744, 'week' => 604800, 'day' => 86400, 'hour' => 3600, 'minute'=> 60
    );
    
    //now we just find the difference
    if ($diff == 0)
    {
        return 'just now';
    }    

    if ($diff < 60)
    {
        return $diff == 1 ? $diff . ' second ago' : $diff . ' seconds ago';
    }        

    if ($diff >= 60 && $diff < $intervals['hour'])
    {
        $diff = floor($diff/$intervals['minute']);
        return $diff == 1 ? $diff . ' minute ago' : $diff . ' minutes ago';
    }        

    if ($diff >= $intervals['hour'] && $diff < $intervals['day'])
    {
        $diff = floor($diff/$intervals['hour']);
        return $diff == 1 ? $diff . ' hour ago' : $diff . ' hours ago';
    }    

    if ($diff >= $intervals['day'] && $diff < $intervals['week'])
    {
        $diff = floor($diff/$intervals['day']);
        return $diff == 1 ? $diff . ' day ago' : $diff . ' days ago';
    }    

    if ($diff >= $intervals['week'] && $diff < $intervals['month'])
    {
        $diff = floor($diff/$intervals['week']);
        return $diff == 1 ? $diff . ' week ago' : $diff . ' weeks ago';
    }    

    if ($diff >= $intervals['month'] && $diff < $intervals['year'])
    {
        $diff = floor($diff/$intervals['month']);
        return $diff == 1 ? $diff . ' month ago' : $diff . ' months ago';
    }    

    if ($diff >= $intervals['year'])
    {
        $diff = floor($diff/$intervals['year']);
        return $diff == 1 ? $diff . ' year ago' : $diff . ' years ago';
    }
}


function _some_ego($time_ago){
    try {
        $cur_time 	= time();
        $time_ago = strtotime($time_ago);
$time_elapsed 	= $cur_time - $time_ago;
$seconds 	= $time_elapsed ;
$minutes 	= round($time_elapsed / 60 );
$hours 		= round($time_elapsed / 3600);
$days 		= round($time_elapsed / 86400 );
$weeks 		= round($time_elapsed / 604800);
$months 	= round($time_elapsed / 2600640 );
$years 		= round($time_elapsed / 31207680 );
// Seconds
if($seconds <= 60){
$ego  = "$seconds seconds ago";
}
//Minutes
else if($minutes <=60){
if($minutes==1){
 $ego  = "one minute ago";
}
else{
 $ego  = "$minutes minutes ago";
}
}
//Hours
else if($hours <=24){
if($hours==1){
 $ego  = "an hour ago";
}else{
 $ego  = "$hours hours ago";
}
}
//Days
else if($days <= 7){
if($days==1){
 $ego  = "yesterday";
}else{
 $ego  = "$days days ago";
}
}
//Weeks
else if($weeks <= 4.3){
if($weeks==1){
 $ego  = "a week ago";
}else{
 $ego  = "$weeks weeks ago";
}
}
//Months
else if($months <=12){
if($months==1){
 $ego  = "a month ago";
}else{
 $ego  = "$months months ago";
}
}
//Years
else{
if($years==1){
 $ego  ="one year ago";
}else{
 $ego  = "$years years ago";
}
}
return $ego;
}
catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
       }



       function get_all_patients_on_admission(){

        global $connection;
    
    //$date = date('Y-m-d');
    //	$user = $_SESSION['uid'];
    $sql = "SELECT * FROM ward_assignment WHERE status = 'ON ADMISSION' ORDER BY id DESC";
        
        if($query_run=mysqli_query($connection,$sql)){
        
        while($row = mysqli_fetch_array($query_run) ){

            $link = "";
    
           // $fullname = $row['surname']. " ".$row['other_names'];
            $pat_id = $row['patient_id'];
    
            $date_admitted = $row['date_added'];
            $doctor_id = $row['doctor_id'];
    
            $patient_name = patient_name($row['patient_id']);
    
            $date_time_stamp = time_passed($date_admitted);
    
            $ward_name = ward_name($row['ward_id']);
    
            $doctor = get_staff_info($doctor_id);
    
            $dr_fullname = " Dr. ".$doctor['firstName']." ".$doctor['otherNames']."";

            if($_SESSION['logged_in']==2){
                $link =  "<a onclick='return confirm(\"CLICK OK TO CONTINUE OR CANCEL...\")' class='label label-danger' href='tasks/set_patient_details_admission?id=$pat_id&date_admitted=".$date_admitted."&admitted_by=".$doctor_id." '><i class='fa fa-eye'></i></a>";
           
            }else{
                $link =  "<a onclick='return confirm(\"CLICK OK TO CONTINUE OR CANCEL...\")' class='label label-danger' href='tasks/set_patient_details?id=$pat_id&date_admitted=".$date_admitted."&admitted_by=".$doctor_id." '><i class='fa fa-eye'></i></a>";
            
            }
    
               
             
            echo"
                 <tr>						
                 <td>".$date_time_stamp."</td>
    
    
                 <td>".$patient_name."</td>
    
                 <td>".$ward_name."</td>
                    
                    <td>".$dr_fullname."</td>
                     
                     
    
    
                    <td>
                     
                         
                    $link
               
                    </td>
            
                    </tr>
            ";
            
        }
         
    } else{
        echo "string ".mysqli_error();
    }
    }



    function vitals_monitoring_($patient_id,$date_time_admitted){

        global $connection;
    
       // $new_date = date("Y-m-d H:i:s",strtotime($date_time_admitted));
    
        $new_date  = date("Y-m-d",strtotime($date_time_admitted));
        
    
        //$sql = "SELECT date_sent FROM tbl_consulting WHERE patient_id = '".$patient_id."'";
    
        $NULL = NULL;
    
        $sql = "SELECT id,weight,temperature,blood_pressure_top,blood_pressure_down,pulse,s_p_0_2,respiration,taken_by,comments,date_time_taken,date_time_admitted FROM tbl_patient_biovitals 
        WHERE patient_id ='".$patient_id."' AND date_time_taken != '".$NULL."' AND DATE( date_time_admitted ) = '".$new_date."' ";
        
    
        $result = mysqli_query($connection,$sql);
    
        if(mysqli_num_rows($result) >= 1){
    
            while ($patient_vitals = mysqli_fetch_assoc($result)) {
                //$date_sent_ = $row['date_sent'];

                $link = "";
    
                //$patient_vitals = get_patient_vitals_history($patient_id,$date_sent_);
    
                $names = get_staff_info($patient_vitals['taken_by']);
    
                $date_sent_ = $patient_vitals['date_time_taken'];
    
                $pat_id = $patient_vitals['id'];
    
                $fullname = $names['firstName']." ".$names['otherNames'];
    
                $date_time_stamp = time_passed($date_sent_);
    
                $full_pressure = $patient_vitals['blood_pressure_top']." / ".$patient_vitals['blood_pressure_down'];

                if($_SESSION['logged_in']==2){
                    $link =  "-";
               
                }else{
                    $link =  "<a onclick='return confirm(\"CLICK OK TO CONFIRM DELETION OR CANCEL TO PREVENT DELETION...\")' class='label label-danger' href='db_tasks/undo_vitals_monitoring?id=$pat_id'><i class='fa fa-times'></i></a>";
                
                }

    
                echo "<tr>
                <td>".$date_time_stamp."</td>
                 
                <td>".$patient_vitals['weight']."</td>
     
                <td>".$patient_vitals['temperature']."</td>
    
                <td>".$patient_vitals['pulse']."</td>
    
    
                <td>".$full_pressure."</td>
    
                <td>".$patient_vitals['s_p_0_2']."</td>
    
                <td>".$patient_vitals['respiration']."</td>
    
                <td>".$patient_vitals['comments']."</td>
                <td>".$fullname."</td>
    
                <td>
                     
                         
               $link
                </td>
        
                </tr>";
    
    
            }
        }
    
    }


    function get_patient_on_admission_prescribtion($patient_id,$by,$date){

        global $connection;
    
        $new_date  = date("Y-m-d",strtotime($date));
        $sql="SELECT * FROM tbl_precribtion WHERE patient_id = '".$patient_id."' AND doc_code = '".$by."' AND DATE( date_added ) = '".$new_date."'";
        
        if($query_run=mysqli_query($connection,$sql)){
        
        while($row = mysqli_fetch_array($query_run) ){
    
            $qty = 0;
    
            if(($row['time_interval']=="STAT"||$row['time_interval']=="START")){
                $qty = cal_quantity_start($row['quantity'],$row['times'],$row['time_interval']);
                $dosage =  $row['quantity']." X ".$row['times']." ".$row['time_interval'];
            }else{
    
                $dosage =  $row['quantity']." X ".$row['times']." ".$row['time_interval']." For ".$row['duration']." ".$row['time_span'];
    
            
    
            if($row['drug_qty']==""){
               $qty =  cal_quantity($row['quantity'],$row['times'],$row['time_interval'],$row['duration'],$row['time_span']);
            }else{
           $qty =  $row['drug_qty'];
            }
        }
            echo"
                 <tr>						
                    <td>".drug_name($row['drug_code'])."</td>
    
                    <td>".$qty."</td>
                    
                    <td>".$dosage."</td>
                    <td>".get_prescribtion_doctor($patient_id, $by)."</td>
                     
                </tr>
            ";
            
        }
         
    } else{
        echo "string ".mysqli_error();
    }
    }




    function drugs_monitoring_($patient_id,$date_time_admitted){

        global $connection;
    
       // $new_date = date("Y-m-d H:i:s",strtotime($date_time_admitted));
    
        $new_date  = date("Y-m-d",strtotime($date_time_admitted));
        
    
        //$sql = "SELECT date_sent FROM tbl_consulting WHERE patient_id = '".$patient_id."'";
    
        $NULL = NULL;
    
        $sql = "SELECT id,drug_code,staff_id,qty_given,comments,date_time_given FROM tbl_detain_patient_medications 
        WHERE patient_id ='".$patient_id."' AND DATE( date_time_admitted ) = '".$new_date."' ";
        
    
        $result = mysqli_query($connection,$sql);
    
        if(mysqli_num_rows($result) >= 1){
    
            while ($patient_drugs_given = mysqli_fetch_assoc($result)) {
                //$date_sent_ = $row['date_sent'];
    
                //$patient_vitals = get_patient_vitals_history($patient_id,$date_sent_);
    
                $names = get_staff_info($patient_drugs_given['staff_id']);
    
                $date_sent_ = $patient_drugs_given['date_time_given'];
    
                $pat_id = $patient_drugs_given['id'];
    
                $drug_name = drug_name($patient_drugs_given['drug_code']);
    
                $fullname = $names['firstName']." ".$names['otherNames'];
    
                $date_time_stamp = time_passed($date_sent_);


                if($_SESSION['logged_in']==2){
                    $link =  "-";
               
                }else{
                    $link =  "<a onclick='return confirm(\"CLICK OK TO CONFIRM DELETION OR CANCEL TO PREVENT DELETION...\")' class='label label-danger' href='db_tasks/undo_drugs_monitoring?id=$pat_id'><i class='fa fa-times'></i></a>";
                
                }
    
                //$full_pressure = $patient_vitals['blood_pressure_top']." / ".$patient_vitals['blood_pressure_down'];
    
                echo "<tr>
                <td>".$drug_name."</td>
                 
                <td>".$patient_drugs_given['qty_given']."</td>
     
                <td>".$fullname."</td>  
                <td>".$date_time_stamp."</td> 
    
                <td>".$patient_drugs_given['comments']."</td> 
    
                <td>
                     
                         
                $link
          
                </td>
        
                </tr>";
    
    
            }
        }
    
    }

    function get_patient_lab_request_historyy($patient_id,$date_taken){//patients id

        global $connection;
        
        //$date_taken = date('Y-m-d');
        //$time = date('Y-m-d');
        $sql = "SELECT request_test_name,request_code,patient_id,doctor_id FROM tbl_req_investigation WHERE patient_id ='".$patient_id."' AND requested_date ='".$date_taken."'";
        $query_run = mysqli_query($connection,$sql);
        while($row = mysqli_fetch_array($query_run) ){
             
            return $row;
    
        }
    }

    function get_patient_on_admission_investigations($patient_id){

        global $connection;
    
        $view_report_url  = "";

        $status = "ON ADMISSION";
        
    
        $sql = "SELECT DATE(date_added) AS date_added FROM ward_assignment WHERE patient_id = '".$patient_id."' AND status = '".$status."' ";
    
        $result = mysqli_query($connection,$sql);
    
        if(mysqli_num_rows($result) >= 1){
    
            while ($row = mysqli_fetch_assoc($result)) {
                $date_added = $row['date_added'];
    
                $patient_complains = get_patient_lab_request_historyy($patient_id,$date_added);
    
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
                    $view_report_url =  "<a target='_blank' href='tasks/p_v_r?lab_code=".$patient_complains['request_code']."&patient_id=".$patient_complains['patient_id']." '>" . "View Results" . "</a>";
    
                }
    
                
    
                echo "<tr>
                <td>".date('jS M, Y', strtotime("$date_added")).", ".date('l', strtotime("$date_added"))."</td>
                  
     
                <td>".$complains."</td>
     
    
                <td>".$fullname."</td>
    
                <td>".$view_report_url."</td>
    
     
        
                </tr>";
    
    
            }
        }
    
    }



function check_patient_visit_consultation($patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

	$query = "SELECT id FROM tbl_consulting WHERE  patient_id ='".$patient_id."' AND date_sent ='".$date_time_recorded."' ";


	$query_results = mysqli_query($connection, $query);

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows > 0){

        return true;
    }else{
        return false;
    }
 
 
}

function check_patient_vitals_consultation($patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

	$query = "SELECT id FROM tbl_patient_biovitals WHERE  patient_id ='".$patient_id."' AND date_taken ='".$date_time_recorded."' ";


	$query_results = mysqli_query($connection, $query);

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows > 0){

        return true;
    }else{
        return false;
    }
 
 
}


function check_patient_id($patient_id) {
	global $connection; 

	$query = "SELECT id FROM tbl_patient_info WHERE  patient_id ='".$patient_id."' ";


	$query_results = mysqli_query($connection, $query);

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
 
 
}

function check_patient_phone_number($patient_number) {
	global $connection; 

	$query = "SELECT id FROM tbl_patient_info WHERE phone ='".$patient_number."' ";


	$query_results = mysqli_query($connection, $query);

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows > 0){

        return true;
    }else{
        return false;
    }
 
 
}

function check_staff_phone_number($patient_number) {
	global $connection; 

	$query = "SELECT id FROM tbl_staff WHERE phone ='".$patient_number."' ";


	$query_results = mysqli_query($connection, $query);

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
 
 
}

function check_staff_user_name($uname) {
	global $connection; 

	$query = "SELECT id FROM tbl_login WHERE uname ='".$uname."' ";


	$query_results = mysqli_query($connection, $query);

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
 
 
}

function check_staff_email($email) {
	global $connection; 

	$query = "SELECT id FROM tbl_login WHERE email ='".$email."' ";


	$query_results = mysqli_query($connection, $query);

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
 
 
}


function check_insert_urine_re($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

	$query = "SELECT id FROM urine_re WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."' AND patient_id ='".$patient_id."' ";


	$query_results = mysqli_query($connection, $query);

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
 
 
}

function check_insert_hvsre_re($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

	$query = "SELECT id FROM tbl_hvsre WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."' AND patient_id ='".$patient_id."' ";


	$query_results = mysqli_query($connection, $query);

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
 
 
}


function check_insert_lft($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

	$query = "SELECT id FROM lft WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."' AND patient_id ='".$patient_id."' ";


	$query_results = mysqli_query($connection, $query);

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
 
 
}


function check_stool_re($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

	$query = "SELECT id FROM stool_re WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."' AND patient_id ='".$patient_id."' ";


	$query_results = mysqli_query($connection, $query);

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
 
 
}

function check_widal_re($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

	$query = "SELECT id FROM widal_test WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."' AND patient_id ='".$patient_id."' ";


	$query_results = mysqli_query($connection, $query) or die(mysqli_error());

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows > 0){

        return true;
    }else{
        return false;
    }
 
 
}



function check_typhoid_re($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

	$query = "SELECT id FROM typhoid_test WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."' AND patient_id ='".$patient_id."' ";


	$query_results = mysqli_query($connection, $query) or die(mysqli_error());

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
 
 
}

function check_malaria_re($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

    $test_name = "Malaria";

	$query = "SELECT id FROM general_status_test WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."' AND patient_id ='".$patient_id."' AND test_name ='".$test_name."' ";


	$query_results = mysqli_query($connection, $query) or die(mysqli_error());

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows > 0){

        return true;
    }else{
        return false;
    }
 
 
}

function check_gpd_re($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

    $test_name = "G6PD";

	$query = "SELECT id FROM general_status_test WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."' AND patient_id ='".$patient_id."' AND test_name ='".$test_name."' ";


	$query_results = mysqli_query($connection, $query) or die(mysqli_error());

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
 
 
}


function check_HCV_re($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

    $test_name = "HCV";

	$query = "SELECT id FROM general_status_test WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."' AND patient_id ='".$patient_id."' 
    AND test_name ='".$test_name."' ";


	$query_results = mysqli_query($connection, $query) or die(mysqli_error());

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
 
 
}


function check_SPT_re($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

    $test_name = "SPT";

	$query = "SELECT id FROM general_status_test WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."' AND patient_id ='".$patient_id."' 
    AND test_name ='".$test_name."' ";


	$query_results = mysqli_query($connection, $query) or die(mysqli_error());

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
 
 
}

function check_RETRO_SCREEN_STATUS_re($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

    $test_name = "RETRO SCREEN";

	$query = "SELECT id FROM general_status_test WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."' AND patient_id ='".$patient_id."' 
    AND test_name ='".$test_name."' ";


	$query_results = mysqli_query($connection, $query) or die(mysqli_error());

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
 
 
}

// $query = "SELECT id FROM tbl_req_investigation WHERE request_code ='".$request_code."' AND status ='0' AND view_status = '1' AND patient_id ='".$patient_id."' ";


// 	$query_results = mysqli_query($connection, $query) or die(mysqli_error());

//     $num_rows = mysqli_num_rows($query_results);

//     if($num_rows > 0){



   

function check_hepatitisB_re($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

    $test_name = "Hepatitis B";

	$query = "SELECT id FROM general_status_test WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."' AND patient_id ='".$patient_id."' AND test_name ='".$test_name."' ";


	$query_results = mysqli_query($connection, $query) or die(mysqli_error());

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows > 0){

        return true;
    }else{
        return false;
    }
}

function check_hiv_i__re($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

    $test_name = "HIV I";

	$query = "SELECT id FROM general_status_test WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."' AND patient_id ='".$patient_id."' AND test_name ='".$test_name."' ";


	$query_results = mysqli_query($connection, $query) or die(mysqli_error());

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
}

function check_hiv_ii__re($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

    $test_name = "HIV II";

	$query = "SELECT id FROM general_status_test WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."' AND patient_id ='".$patient_id."' AND test_name ='".$test_name."' ";


	$query_results = mysqli_query($connection, $query) or die(mysqli_error());

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
}

function check_hiv_iii__re($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

    $test_name = "HIV I&II";

	$query = "SELECT id FROM general_status_test WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."' AND patient_id ='".$patient_id."' AND test_name ='".$test_name."' ";


	$query_results = mysqli_query($connection, $query) or die(mysqli_error());

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
}

function check_urine_preg_test($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

    $test_name = "URINE PREGNANCY TEST(UPT)";

	$query = "SELECT id FROM general_status_test WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."' AND patient_id ='".$patient_id."' AND test_name ='".$test_name."' ";


	$query_results = mysqli_query($connection, $query) or die(mysqli_error());

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
}


function check_covid_19($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

    $test_name = "COVID-19 ANTIGEN";

	$query = "SELECT id FROM general_status_test WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."' AND patient_id ='".$patient_id."' AND test_name ='".$test_name."' ";


	$query_results = mysqli_query($connection, $query) or die(mysqli_error());

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
}



function check_serum_preg_test($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

    $test_name = "SERUM PREGNANCY TEST(SPT)";

	$query = "SELECT id FROM general_status_test WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."' AND patient_id ='".$patient_id."' AND test_name ='".$test_name."' ";


	$query_results = mysqli_query($connection, $query) or die(mysqli_error());

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
}






function check_hepatitisB_profile($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

   // $test_name = "Hepatitis B";

	$query = "SELECT id FROM hepatitis_b_profile WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."' AND patient_id ='".$patient_id."' ";


	$query_results = mysqli_query($connection, $query) or die(mysqli_error());

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
}



function check_pylori_re($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

    $test_name = "H.PYLORI(SERUM)";

	$query = "SELECT id FROM general_status_test WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."' AND patient_id ='".$patient_id."' AND test_name ='".$test_name."' ";


	$query_results = mysqli_query($connection, $query) or die(mysqli_error());

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
}

function check_pylori_stool($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

    $test_name = "H.PYLORI(STOOL)";

	$query = "SELECT id FROM general_status_test WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."' AND patient_id ='".$patient_id."' AND test_name ='".$test_name."' ";


	$query_results = mysqli_query($connection, $query) or die(mysqli_error());

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
}


function check_sickling_re($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	//$state = 1;//SYPHILLIS
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

    $test_name = "SICKLING";

	$query = "SELECT id FROM general_status_test WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."' AND patient_id ='".$patient_id."' AND test_name ='".$test_name."' ";


	$query_results = mysqli_query($connection, $query) or die(mysqli_error());

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
}

function check_SYPHILLIS_re($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	//$state = 1;//SYPHILLIS
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

    $test_name = "SYPHILLIS";

	$query = "SELECT id FROM general_status_test WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."' AND patient_id ='".$patient_id."' AND test_name ='".$test_name."' ";


	$query_results = mysqli_query($connection, $query) or die(mysqli_error());

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
}

function check_GONORRHEA_re($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	//$state = 1;//SYPHILLIS
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

    $test_name = "GONORRHEA";

	$query = "SELECT id FROM general_status_test WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."' AND patient_id ='".$patient_id."' AND test_name ='".$test_name."' ";


	$query_results = mysqli_query($connection, $query) or die(mysqli_error());

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
}

function check_GENOTYPE_re($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	//$state = 1;//SYPHILLIS
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

    $test_name = "GENOTYPE";

	$query = "SELECT id FROM general_status_test WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."' AND patient_id ='".$patient_id."' AND test_name ='".$test_name."' ";


	$query_results = mysqli_query($connection, $query) or die(mysqli_error());

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
}



function check_FBC_($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

	$query = "SELECT id FROM fbc WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."' AND patient_id ='".$patient_id."' ";


	$query_results = mysqli_query($connection, $query) or die(mysqli_error());

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
 
 
}


function check_bue_cr_($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

	$query = "SELECT id FROM bue_cr WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."' AND patient_id ='".$patient_id."' ";


	$query_results = mysqli_query($connection, $query) or die(mysqli_error());

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
 
 
}




function check_urea_creatine_($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

	$query = "SELECT id FROM urea_creatine WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."' AND patient_id ='".$patient_id."' ";


	$query_results = mysqli_query($connection, $query) or die(mysqli_error());

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
 
 
}

function check_elec_tro_lytes_($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

	$query = "SELECT id FROM elec_tro_lytes WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."' AND patient_id ='".$patient_id."' ";


	$query_results = mysqli_query($connection, $query) or die(mysqli_error());

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
 
 
}

function check_tyroid_func($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

	$query = "SELECT id FROM tbl_tyroid_function_test WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."' AND patient_id ='".$patient_id."' ";


	$query_results = mysqli_query($connection, $query) or die(mysqli_error());

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
 
 
}

function check_hb_electrophoresis($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

	$query = "SELECT id FROM tbl_hb_electrophoresis WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."' AND patient_id ='".$patient_id."' ";


	$query_results = mysqli_query($connection, $query) or die(mysqli_error());

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
 
 
}

function check_blood_film_malaria($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

	$query = "SELECT id FROM tbl_blood_film_malaria WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."' AND patient_id ='".$patient_id."' ";


	$query_results = mysqli_query($connection, $query) or die(mysqli_error());

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
 
 
}

function check_lipid_profile_($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

	$query = "SELECT id FROM lipid_profile WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."' AND patient_id ='".$patient_id."' ";


	$query_results = mysqli_query($connection, $query) or die(mysqli_error());

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
 
 
}


function check_blood_fbs_($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	$query = "SELECT id FROM fbs WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."' AND patient_id ='".$patient_id."' ";


	$query_results = mysqli_query($connection, $query) or die(mysqli_error());

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
 
 
}

function check_2hpp($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	$query = "SELECT id FROM 2_h_p_p WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."' AND patient_id ='".$patient_id."' ";


	$query_results = mysqli_query($connection, $query) or die(mysqli_error());

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
 
 
}

function check_efgr($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	$query = "SELECT id FROM tbl_efgr WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."' AND patient_id ='".$patient_id."' ";


	$query_results = mysqli_query($connection, $query) or die(mysqli_error());

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
 
 
}

function check_blood_rbs_($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

	$query = "SELECT id FROM tbl_rbs WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."' AND patient_id ='".$patient_id."' ";


	$query_results = mysqli_query($connection, $query) or die(mysqli_error());

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
 
 
}

function check_glycated_haemoglobin_($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

	$query = "SELECT id FROM glycated_haemoglobin WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."' AND patient_id ='".$patient_id."' ";


	$query_results = mysqli_query($connection, $query) or die(mysqli_error());

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
}

function check_level_haemoglobin_($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

	$query = "SELECT id FROM haemoglobin_level WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."' AND patient_id ='".$patient_id."' ";


	$query_results = mysqli_query($connection, $query) or die(mysqli_error());

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
}


function check_level_esr_($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

	$query = "SELECT id FROM tbl_esr WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."' AND patient_id ='".$patient_id."' ";


	$query_results = mysqli_query($connection, $query) or die(mysqli_error());

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
}

function check_level_glucose_($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

	$query = "SELECT id FROM tbl_ogtt WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."' AND patient_id ='".$patient_id."' ";


	$query_results = mysqli_query($connection, $query) or die(mysqli_error());

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
}


function check_level_crp_($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

	$query = "SELECT id FROM tbl_crp WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."' AND patient_id ='".$patient_id."' ";


	$query_results = mysqli_query($connection, $query) or die(mysqli_error());

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
}

function check_level_blood_($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

	$query = "SELECT id FROM tbl_blood_group WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."' AND patient_id ='".$patient_id."' ";


	$query_results = mysqli_query($connection, $query) or die(mysqli_error());

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
}

function check_level_uric_acid_($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

	$query = "SELECT id FROM tbl_uric_acid WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."' AND patient_id ='".$patient_id."' ";


	$query_results = mysqli_query($connection, $query) or die(mysqli_error());

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
}



function check_psa_($staff_id,$patient_id) {
	global $connection;
	$date_time_recorded =  date("Y-m-d");

	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

	$query = "SELECT id FROM psa WHERE lab_staff_id ='".$staff_id."' AND date_submitted ='".$date_time_recorded."'
     AND patient_id ='".$patient_id."' ";


	$query_results = mysqli_query($connection, $query) or die(mysqli_error());

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
}


function factor_operations($value) {

    $CRP_LEVEL_value_ON_OPERATION = "";


    $CRP_LEVEL_value = $value;


    $CRP_LEVEL_value = str_replace(' ','',$CRP_LEVEL_value);

	$CRP_LEVEL_value_operator = $CRP_LEVEL_value[0];

	if($CRP_LEVEL_value_operator == ">" || $CRP_LEVEL_value_operator =="<"){

		$CRP_LEVEL_value_ON_OPERATION = substr_replace($CRP_LEVEL_value," ",1, -strlen($CRP_LEVEL_value));
	}else{
		$CRP_LEVEL_value_ON_OPERATION = $CRP_LEVEL_value;
	}

    return $CRP_LEVEL_value_ON_OPERATION;

}



function find_patient_by_name($patient_name){
    global $connection;
   // $p_name = remove_junk($connection->escape($patient_name));
    $query = "SELECT surname,other_names,patient_id,phone FROM tbl_patient_info WHERE surname like '%$patient_name%' OR other_names like '%$patient_name%' LIMIT 50";
    $query_results = mysqli_query($connection, $query) or die(mysqli_error());
    return $query_results;
     
  }


  function find_walk_in_patient_by_name($patient_name){
    global $connection;
   // $p_name = remove_junk($connection->escape($patient_name));
    $query = "SELECT id,walk_code,full_name,contact FROM tbl_walk_in_patient WHERE full_name like '%$patient_name%' LIMIT 50";
    $query_results = mysqli_query($connection, $query) or die(mysqli_error());
    return $query_results;
     
  }


function find_by_sql($sql)
{
  global $connection;
  $result = $connection->query($sql);
  $result_set = $connection->while_loop($result);
 return $result_set;
}


function remove_junk($str){
    $str = nl2br($str);
    $str = htmlspecialchars(strip_tags($str, ENT_QUOTES));
    return $str;
  }



function number_of_patients(){
    
}

function number_of_doctors(){
    
}