<?php
//require_once"func_nhis.php";
//This is the functions for the OPD staff

//Get patient info

//Insert patient bio vitals go_cashier
require_once"func_common.php";
//require_once "func_constant.php";
require_once __DIR__ . '/../class.Queue.php';



function getMyPatientHistory($startDate,$endDate){
	global $connection;

	$sql = "";
	 
	$date = date('Y-m-d');
    $user_id = $_SESSION['uid'];

	if(empty($startDate) && empty($endDate)){
        $sql = "SELECT * FROM tbl_patient_biovitals WHERE date_taken = '".$date."' AND taken_by = '".$user_id."' ";
	
    }

    if(!empty($startDate) && empty($endDate)){
        $sql = "SELECT * FROM tbl_patient_biovitals WHERE date_taken = '".$startDate."' AND taken_by = '".$user_id."' ";
	
    }

    if(!empty($startDate) && !empty($endDate)){
       // $sql = "SELECT * FROM tbl_consulting WHERE date_sent BETWEEN '$startDate' AND '$endDate'"; 
		$sql = "SELECT * FROM tbl_patient_biovitals WHERE date_taken >= '$startDate' AND date_taken <= '$endDate'  AND taken_by = '".$user_id."' ";
	   
    }
    
	 
    $query_run = mysqli_query($connection,$sql) or die(mysqli_error());
    	
	while($row = mysqli_fetch_array($query_run) ){

        $label_vitals = "Temperature (°C): ".$row['temperature']." 
        Blood Pressure (mmHg): ".$row['blood_pressure_top']." / ".$row['blood_pressure_top'].
        " Weight(Kg): ".$row['weight'].
        " Pulse: ".$row['pulse'].
        " Height(m): ".$row['height'].
        " SpO2: ".$row['s_p_0_2'].
        " Respiration: ".$row['respiration'];
        echo"
        <tr>						
        <td>".$row['patient_id']."</td>
    
    
           <td>".getPatientsName($row['patient_id'])."</td>
            

           <td>".$label_vitals."</td>

		    <td>".date("F j, Y",strtotime($row['date_taken']))."</td>
     
       </tr>
    ";
		
	}
}



function view_added_vitals($patient_id, $taken_by){
    global $connection;
    $sql = "SELECT * FROM tbl_patient_biovitals WHERE patient_id = '".$patient_id."' AND taken_by = '".$taken_by."' ORDER BY date_taken DESC LIMIT 1";
    $result = mysqli_query($connection,$sql) or die(mysqli_error());
    $rows = mysqli_num_rows($result) or die(mysqli_error());
    
    if($rows == 1){
        
        while( $row = mysqli_fetch_assoc($result) ){
            return $row;
        }
        
    } else if($rows == 0){
        echo "No";
    }
    
}


function reassign_patient_consultation($patient_id, $doctor_room, $doctor_id, $staff_id){
    global $connection;
    $now_date = date("Y-m-d");
$query  = "UPDATE tbl_consulting  SET 
			doctor_room ='".$doctor_room."', 
			doctor_id = '".$doctor_id."'
			WHERE patient_id='".$patient_id."' AND date_sent = '".$now_date."' AND staff_id = '".$staff_id."'";
$query_results = mysqli_query($connection,$query);
		
		if($query_results){
		return true;
		}else{
		return false;
		}

}


function update_vitals($vitalID,$patient_id, $weight, $height, $bmi, $pressure_first,$pressure_second, $temperature,$pulse,$s_p_0_2,$respiration, $taken_by,$fbs,$rbs){
    global $connection;
    $now_date = date("Y-m-d");
$query  = "UPDATE tbl_patient_biovitals  SET 
			weight ='".$weight."', 
			height = '".$height."',
			bmi = '".$bmi."', 
			blood_pressure_top='".$pressure_first."', 
            blood_pressure_down='".$pressure_second."',
			temperature ='".$temperature."',
            s_p_0_2 ='".$s_p_0_2."',
            respiration ='".$respiration."',
            fbs ='".$fbs."',
            rbs ='".$rbs."'
			WHERE patient_id='".$patient_id."' AND date_taken = '".$now_date."'";
$query_results = mysqli_query($connection,$query);
		
		if($query_results){
		return true;
		}else{
		return false;
		}

}



function get_bmi($weight, $height){
    
   // $meters = ($height / 100);
    $meters = $height;
    $meters_squared = $meters * $meters;
    $bmi = ($weight / $meters_squared);
    
    return $bmi; 
}


function insert_drugs_on_admission($drug_name,$patient_id,$taken_by,$qty,$comments,$date_time_admitted){

    global $connection;

    $date = date('Y-m-d H:i:s');
    $date2 = date('Y-m-d');
    $sql = "INSERT into tbl_detain_patient_medications (drug_code, patient_id, staff_id, qty_given, date_time_given,comments,date_time_admitted) 
        VALUES ('".$drug_name."', '".$patient_id."', '".$taken_by."', '".$qty."', '".$date."', '".$comments."', '".$date_time_admitted."')";
  

    
 
     
       
  if(  $query_run = mysqli_query($connection,$sql) or die(mysqli_error($connection)) ){
            return TRUE;
         } else {
            return FALSE;
         }
     
    
}

function insert_bio_vitals( $patient_id, $weight, $height, $bmi, $blood_pressure_top,$blood_pressure_down, $temperature,$pulse,$s_p_0_2,$respiration,$taken_by,$Fbs,$Rbs,$on_admission_status=NULL,$comments = NULL,$date_admitted = NULL){

    global $connection;

    $date = date('Y-m-d H:i:s');
    $date2 = date('Y-m-d');

    if($on_admission_status != null){

      //  $comments = "COMMENTS";

        $sql = "INSERT into tbl_patient_biovitals (patient_id, weight, height, bmi, blood_pressure_top,blood_pressure_down, temperature,pulse,s_p_0_2,respiration,taken_by, date_taken,fbs,rbs,date_time_taken,comments,date_time_admitted) 
        VALUES ('".$patient_id."', '".$weight."', '".$height."', '".$bmi."', '".$blood_pressure_top."', '".$blood_pressure_down."', '".$temperature."','".$pulse."','".$s_p_0_2."','".$respiration."', '".$taken_by."','".$date."','".$Fbs."','".$Rbs."','".$date."','".$comments."','".$date_admitted."')";
  

    }else{

        $sql = "INSERT into tbl_patient_biovitals (patient_id, weight, height, bmi, blood_pressure_top,blood_pressure_down, temperature,pulse,s_p_0_2,respiration,taken_by, date_taken,fbs,rbs) 
        VALUES ('".$patient_id."', '".$weight."', '".$height."', '".$bmi."', '".$blood_pressure_top."', '".$blood_pressure_down."', '".$temperature."','".$pulse."','".$s_p_0_2."','".$respiration."', '".$taken_by."','".$date."','".$Fbs."','".$Rbs."')";
  

    }
 
     
       
  if(  $query_run = mysqli_query($connection,$sql) or die(mysqli_error($connection)) ){

       if (IS_RABBITMQ) {
    //require_once __DIR__ . '/../class.Queue.php';

    try {
        $queue = new Queue(
            RABBITMQ_HOST,
            RABBITMQ_PORT,
            RABBITMQ_USERNAME,
            RABBITMQ_PASSWORD
        );

        $queue->publish('notifications', [
            'type' => 'email',
            'email' => $email,
            'patient_id' => $patient_id,
            'message' => sprintf(
                "Dear patient, your vitals have been recorded:\nBP: %s/%s mmHg\nTemp: %s °C\nPulse: %s bpm\nSpO₂: %s%%\n",
                $blood_pressure_top,
                $blood_pressure_down,
                $temperature,
                $pulse,
                $s_p_0_2
            )
        ]);

        $queue->close();
    } catch (Exception $e) {
        error_log("RabbitMQ publish error: " . $e->getMessage());
    }
}
            return TRUE;
         } else {
            return FALSE;
         }
     
    
}

function update_bio_vitals($patient_id, $weight, $height, $bmi, $blood_pressure_top,$blood_pressure_down, $temperature,$pulse,$s_p_0_2,$respiration,$fbs,$rbs,$taken_by,$get_doctors_room_by_id,$status_consultation){

    global $connection;

    $date_taken = date('Y-m-d H:i:s');
    $date2 = date('Y-m-d');

    $email = "pathills2013@gmail.com"; // This should be fetched from the patient's record // Just a test for RabbitMQ

    $sql = "SELECT id FROM tbl_patient_biovitals WHERE patient_id = '".$patient_id."' AND date_taken = '".$date2."'";

    $result = mysqli_query($connection,$sql);
    $num_rows = mysqli_num_rows($result);

    if($num_rows > 0){
        
        $sql = "UPDATE tbl_patient_biovitals SET patient_id = '".$patient_id."', weight = '".$weight."', height = '".$height."', bmi = '".$bmi."', blood_pressure_top = '".$blood_pressure_top."', blood_pressure_down = '".$blood_pressure_down."', temperature = '".$temperature."', 
        pulse = '".$pulse."',s_p_0_2 = '".$s_p_0_2."',respiration = '".$respiration."',fbs = '".$fbs."',rbs = '".$rbs."', taken_by = '".$taken_by."', date_taken = '".$date_taken."' 
                WHERE patient_id = '".$patient_id."' AND date_taken = '".$date2."'";
        
        if($query_run = mysqli_query($connection,$sql) ){

            // If the update is successful, send a notification to RabbitMQ

            // Prepare message data for RabbitMQ
       if (IS_RABBITMQ) {
    //require_once __DIR__ . '/../class.Queue.php';

    try {
        $queue = new Queue(
            RABBITMQ_HOST,
            RABBITMQ_PORT,
            RABBITMQ_USERNAME,
            RABBITMQ_PASSWORD
        );

        $queue->publish('notifications', [
            'type' => 'email',
            'email' => $email,
            'patient_id' => $patient_id,
            'message' => sprintf(
                "Dear patient, your vitals have been recorded:\nBP: %s/%s mmHg\nTemp: %s °C\nPulse: %s bpm\nSpO₂: %s%%\n",
                $blood_pressure_top,
                $blood_pressure_down,
                $temperature,
                $pulse,
                $s_p_0_2
            )
        ]);

        $queue->close();
    } catch (Exception $e) {
        error_log("RabbitMQ publish error: " . $e->getMessage());
    }
}

            return TRUE;
         } else {
            return FALSE;
         }

    } else if($num_rows == 0) {
        
        $sql = "INSERT into tbl_patient_biovitals (patient_id, weight, height, bmi, blood_pressure_top,blood_pressure_down,temperature,pulse,s_p_0_2,respiration,fbs,rbs,taken_by, date_taken)
         VALUES ('".$patient_id."', '".$weight."', '".$height."', '".$bmi."', '".$blood_pressure_top."','".$blood_pressure_down."',  '".$temperature."' , '".$pulse."','".$s_p_0_2."','".$respiration."','".$fbs."','".$rbs."', 
         '".$taken_by."', '".$date_taken."')";
        if($query_run = mysqli_query($connection,$sql) ){

            $consulting_code = consulting_code();

            if($status_consultation == "0"){
                go_consult($consulting_code, $patient_id, $get_doctors_room_by_id,$taken_by, $taken_by, $date2);
            }
               if (IS_RABBITMQ) {
   // require_once __DIR__ . '/../class.Queue.php';

    try {
        $queue = new Queue(
            RABBITMQ_HOST,
            RABBITMQ_PORT,
            RABBITMQ_USERNAME,
            RABBITMQ_PASSWORD
        );

        $queue->publish('notifications', [
            'type' => 'email',
            'email' => $email,
            'patient_id' => $patient_id,
            'message' => sprintf(
                "Dear patient, your vitals have been recorded:\nBP: %s/%s mmHg\nTemp: %s °C\nPulse: %s bpm\nSpO₂: %s%%\n",
                $blood_pressure_top,
                $blood_pressure_down,
                $temperature,
                $pulse,
                $s_p_0_2
            )
        ]);

        $queue->close();
    } catch (Exception $e) {
        error_log("RabbitMQ publish error: " . $e->getMessage());
    }
}
            return TRUE;
         } else {
            return FALSE;
         }
        
    }
    
}

function go_cashier($consulting_code, $patient_id, $staff_id, $date){

    global $connection;
    
   // var_dump($consulting_code);
 
		//fix by mike
		//to start billing patients after sent to consulting_code
		if(send_patients_consultingFees($patient_id,$consulting_code,$staff_id)){return true;}else{return false;}
                      
       
//    }   
}

function go_consult($consulting_code, $patient_id, $doctor_room,$doctor_id, $staff_id, $date){

    global $connection;

    $date_sent_ago  = date('Y-m-d H:i:s');
    
//    if(!empty($patient_id) && !empty($doctor_room) && !empty($staff_id) && !empty($date)){
        $sql = "INSERT INTO tbl_consulting (consulting_code, patient_id, doctor_room,doctor_id, staff_id, date_sent,date_sent_ago) 
        VALUES ('".$consulting_code."', '".$patient_id."','".$doctor_room."','".$doctor_id."','".$staff_id."','".$date."','".$date_sent_ago."')";
        
        if($query_run = mysqli_query($connection,$sql) or die(mysqli_error())){
		 
                      
        return TRUE; 
            
        }else{
            return FALSE;
        }
//    }   
}
 
 function getTheConsultingFees($patient_id){
     global $connection;
 if(isNHIS($patient_id) == true){
 
 //get the fees  
 return 0.00;
 
 }else{

 $theFee_query = "SELECT nonNHIS_tarrifs FROM consulting_fees_settings LIMIT 0,1";
 $results_fee = mysqli_query($connection,$theFee_query);

 $row_results_fee = $results_fee->fetch_assoc();

 $amount_tariffs = $row_results_fee['nonNHIS_tarrifs'];

 return $amount_tariffs;

//  if(mysqli_num_rows($results_fee) >0){
//    while( $fees= mysqli_fetch_array($results_fee)){
//    return $fees['nonNHIS_tarrifs'];
//    }
//  }else{
//  return 0.00;
//  }
 
 
 
 }
 
 }
 
 function transaction_code($length=8){
 $string = 0;
   /* Only select from letters and numbers that are readable - no 0 or O etc..*/
   $characters = "23456789ABCDEFHJKLMNPRTVWXYZ";
 
   for ($p = 0; $p < $length; $p++) 
   {
       $string .= $characters[mt_rand(0, strlen($characters)-1)];
   }
 
   return $string;
}
 
 
function isNHIS($patient_id)
{
    global $connection;
$nhis = 'nhis';
$private = 'Private';
  $query = "SELECT scheme FROM scheme WHERE patient_id ='".$patient_id."' AND  scheme='".$private."'  LIMIT 0,1 ";
  $query_results = mysqli_query($connection,$query);
  if(mysqli_num_rows($query_results) >0){
  return true;//patient is nhis
  }else{
  return false;//patient is not
  }
}

function send_patients_consultingFees($patient_id,$consulting_code,$staff_id){

    global $connection;

    //CLAIM/8484/JULY/2021

    $new_month = date('m');
    $new_year = date('Y');
    $new_code = gen_verification_code();

    $transaction_code = transaction_code();

    $month_name = getMonthString($new_month);

    $new_code_for_claim = "CLAIM"."/".$new_month."/".$month_name."/".$new_year;

//get amount
   // $consultingid = uniqid("DEP-");
     $theAmount = getTheConsultingFees($patient_id);

    // die($theAmount);
     $claim_code = get_claim_code();
    // $new_code = '00000';
     if($claim_code == null){
        $query1 = "INSERT INTO tbl_claim_tracker(claim_code,date_created) 
        VALUES ('".$new_code_for_claim."','".date('Y-m-d')."')";
        $query_run1 = mysqli_query($connection,$query1);
        if($query_run1){
        return  true;
        }else{
        return false;
        }
     }else{

        $r_claim_code = $claim_code;
      //  $explode_code = explode("/",$r_claim_code);
      //  $month_part_code = $explode_code[2];
      //  $month_number_convert = getMonthNumber($month_part_code);
       // $year_part_code = $explode_code[3];

       // if($month_number_convert != $new_month || $year_part_code != $new_year){
        if($r_claim_code != $new_code_for_claim){
            $query2 = "INSERT INTO tbl_claim_tracker(claim_code,date_created) 
            VALUES ('".$new_code_for_claim."','".date('Y-m-d')."')";
            $query_run2 = mysqli_query($connection,$query2);
            if($query_run2){
            return  true;
            }else{
            return false;
            } 
        }
     }
     if($theAmount == 0 ){
         $state =1; //clearing the patient consultation because of insuarance package
        $query_claim = "INSERT INTO consultingpayment2cashier(amount,state,patient_id,date_added,transaction_code,staff_id,consulting_code,claim_code) 
        VALUES ('".$theAmount."','".$state."','".$patient_id."','".date('Y-m-d')."','".$transaction_code."','".$staff_id."','".$consulting_code."','".$new_code_for_claim."')";
   

   ////also insert into cashier payment table for transaction code to reflect and later to updated and confirm by cashier

   $query_transcode = "INSERT INTO cashier_payment(transcode,patient_id,payment_state,date_added) 
   VALUES ('".$transaction_code."','".$patient_id."','".$state."','".date('Y-m-d')."')";
////also insert into cashier payment table for transaction code to reflect and later to updated and confirm by cashier

 //We check if patient is claims_monitor_tracker

 $verify_patient_claim_code = check_patient_monitor_claim_code($patient_id,$new_code_for_claim);

 if(!$verify_patient_claim_code){

    $query_4_monitory =  "INSERT INTO claimsmonitor(date_added,claim_code,patient_id) 
    VALUES ('".date('Y-m-d')."','".$new_code_for_claim."','".$patient_id."')";

 }

 $query_run_claim = mysqli_query($connection,$query_claim);
 if($query_run_claim){
     mysqli_query($connection,$query_4_monitory);
     mysqli_query($connection,$query_transcode);
 return  true;
 }else{
 return false;
 }
 


}else{
    //  die($theAmount);
       $state = 0;
    
        $query = "INSERT INTO consultingpayment2cashier(amount,state,patient_id,date_added,transaction_code,staff_id,consulting_code) 
        VALUES ('".$theAmount."','".$state."','".$patient_id."','".date('Y-m-d')."','".$transaction_code."','".$staff_id."','".$consulting_code."')"; 
     
           $query_run = mysqli_query($connection,$query);
			if($query_run){
               // mysqli_query($connection,$query_4_monitory);
			return  true;
			}else{
			return false;
			}
        }

}

function getMonthString($m){
    if($m==1){
        return "January";
    }else if($m==2){
        return "February";
    }else if($m==3){
        return "March";
    }else if($m==4){
        return "April";
    }else if($m==5){
        return "May";
    }else if($m==6){
        return "June";
    }else if($m==7){
        return "July";
    }else if($m==8){
        return "August";
    }else if($m==9){
        return "September";
    }else if($m==10){
        return "October";
    }else if($m==11){
        return "November";
    }else if($m==12){
        return "December";
    }
}


function getMonthNumber($m){
    if($m=="January"){
        return "1";
    }else if($m=="February"){
        return "2";
    }else if($m=="March"){
        return "3";
    }else if($m=="April"){
        return "4";
    }else if($m=="May"){
        return "5";
    }else if($m=="June"){
        return "6";
    }else if($m=="July"){
        return "7";
    }else if($m=="August"){
        return "8";
    }else if($m=="September"){
        return "9";
    }else if($m=="October"){
        return "10";
    }else if($m=="November"){
        return "11";
    }else if($m=="December"){
        return "12";
    }
}





function get_all_patients_opd(){

	global $connection;

//$date = date('Y-m-d');
//	$user = $_SESSION['uid'];
	$sql="SELECT patient_id,surname,other_names,phone,address FROM tbl_patient_info ORDER BY date_created DESC ";
	
	if($query_run=mysqli_query($connection,$sql)){
	
	while($row = mysqli_fetch_array($query_run) ){

       // $fullname = $row['surname']. " ".$row['other_names'];
        $pat_id = $row['patient_id'];
 		
		echo"
			 <tr>						
             <td>".$row['patient_id']."</td>


             <td>".$row['surname']."</td>

             <td>".$row['other_names']."</td>
				
				<td>".$row['phone']."</td>
				 
				<td>".$row['address']."</td>


                <td>
				 
					 
                <a onclick='return confirm(\"CLICK OK TO CONTINUE OR CANCEL...\")' class='label label-danger' href='tasks/set_update_patient_details?id=$pat_id'><i class='fa fa-edit'></i></a>
            </td>
        
                </tr>
		";
		
	}
	 
} else{
	echo "string ".mysqli_error();
}
}




function patient_on_admission_medications(){ 
    global $connection;

    $patient_id = $_SESSION['patient_id'];
    $by = $_SESSION['admitted_by'];
    $date = $_SESSION['date_admitted'];

    $new_date  = date("Y-m-d",strtotime($date));
 
    $sql="SELECT drug_code FROM tbl_precribtion WHERE patient_id = '".$patient_id."' AND doc_code = '".$by."' AND DATE( date_added ) = '".$new_date."' ";

    $query_run = mysqli_query($connection,$sql);
    
    while($row=mysqli_fetch_array($query_run)){
 
        $drug_name = drug_name($row['drug_code']);
        $drug_code = $row['drug_code'];
        //echo "<option value=".$row['doctor_id'].">".$row['doctor_id']." ".$row['doctor_id']."</option>";
        echo "<option value=".$drug_code.">".$drug_name."</option>";
    }
}

function insurance_companies(){ 
    global $connection;
 
    $sql="SELECT * FROM insurance_companies ";

    $query_run = mysqli_query($connection,$sql);
    
    while($row=mysqli_fetch_array($query_run)){
 
        $name =  $row['name'];
       
        //echo "<option value=".$row['doctor_id'].">".$row['doctor_id']." ".$row['doctor_id']."</option>";
        echo "<option value=".$name.">".$name."</option>";
    }
}





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


function check_patient_monitor_claim_code($patient_id,$claim_code) {
	global $connection;
	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

	$query = "SELECT id FROM claimsmonitor WHERE  patient_id ='".$patient_id."' AND claim_code ='".$claim_code."' ";


	$query_results = mysqli_query($connection, $query);

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
 
 
}



 function gen_verification_code(){
	$six_digit_random_number = mt_rand(1000, 9999);
	
	return $six_digit_random_number;
  }

function insert_services($service_code, $patient_id, $service_type, $service_package, $attendance_type, $staff_id, $date){

    global $connection;
	
	if(!empty($service_code) && !empty($patient_id) && !empty($staff_id) && !empty($date)){
        $sql = "INSERT INTO patients_services SET service_code = '".$service_code."', patient_id = '".$patient_id."', service_type = '".$service_type."', service_package = '".$service_package."',
         attendance_type = '".$attendance_type."', staff_id ='".$staff_id."', date_added = '".$date."'";
        
        if($query_run = mysqli_query($connection,$sql) or die(mysqli_error())){
                    
        return TRUE;
            
        }else{
            return FALSE;
        }
    } 
}

function remove_services($patient_id){
	$date = date('Y-m-d'); 
	if(!empty($patient_id) && !empty($date)){
        $sql="DELETE FROM patients_services WHERE patient_id = '".$patient_id."' AND DATE(date_added) = '".$date."'";
		$query_run=mysql_query($sql);
        
        if($query_run = mysql_query($sql)){
                    
        return TRUE;
            
        }else{
            return FALSE;
        }
    } 
}

function get_consult($patient_id){//patients id

    $date=date('Y-m-d');
    
    $sql="SELECT * FROM tbl_consulting WHERE patient_id = '".$patient_id."' and date_sent = '".$date."'";
    $result = mysql_query($sql);

    while($row = mysql_fetch_array($result)){
       
        return $row;
    }
}

function get_services($patient_id){//patients id

    global $connection;

    $date = date('Y-m-d');
    
   // $sql="SELECT * FROM patients_services WHERE patient_id = '".$patient_id."' and DATE(date_added) = '".$date."'";
    $sql="SELECT * FROM patients_services WHERE patient_id = '".$patient_id."' ORDER BY DESC LIMIT 1 ";
    $result = mysqli_query($connection,$sql);

    while($row = mysqli_fetch_array($result)){
       
        return $row;
    }
}

function consulting_code(){
    
    $string = 'CON';
    $year = date('y');
    $length = 5;

    $rand = random_code($length);
   
   //return $rand;
    return $string . $year . $rand;
}

function service_code(){
    
    $string = 'SEV';
    $year = date('y');
    $length = 5;

    $rand = random_code($length);
   
   //return $rand;
    return $string . $year . $rand;
}

//consulting_code();

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



//LAB NOTIFICATIONS PROCEDURES


function total_notification_lab_request_from_doctor(){
	global $connection;
	$date = date('Y-m-d');
//	$user = $_SESSION['uid'];
	$sql = "SELECT COUNT(id) as total_notification_lab_request_from_doctor FROM `tbl_req_investigation` WHERE requested_date = '".$date."' AND status = '0' 
    AND payment_status = '1' AND view_opd_status = '0' ";
	$query_run = mysqli_query($connection,$sql);
	$rows = mysqli_fetch_assoc($query_run);
	$count = $rows['total_notification_lab_request_from_doctor'];

	return $count;
	
}

function total_notification_waiting_consulting_patients_from_cashier(){
	global $connection;
	$date = date('Y-m-d');
	//$user = $_SESSION['uid'];
	$sql = "SELECT COUNT(id) as total_notification_waiting_consulting_patients_from_opd FROM `consultingpayment2cashier` WHERE date_added = '".$date."' 
    AND cashier_view_state = '1' AND state = '1' AND opd_view_state = '0' ";
	$query_run = mysqli_query($connection,$sql);
	$rows = mysqli_fetch_assoc($query_run);
	$count = $rows['total_notification_waiting_consulting_patients_from_opd'];

	return $count;
	
}




function list_total_notification_lab_request_from_doctor(){

	global $connection;

	$date = date('Y-m-d');
	//$user = $_SESSION['uid'];
	$sql = "SELECT patient_id,date_sent_ago,request_code,request_test_name FROM `tbl_req_investigation` WHERE requested_date = '".$date."' AND status = '0'
     AND payment_status = '1' AND view_opd_status = '0' ";
	
	if($query_run=mysqli_query($connection,$sql)){

	if(mysqli_num_rows($query_run) > 0){
	
	while($row = mysqli_fetch_array($query_run) ){

		$date_time_stamp = time_passed($row['date_sent_ago']);

		$patient_name = patient_name($row['patient_id']);

        $request_code = $row['request_code'];

        $requested_lab_test = $row['request_test_name'];

       
 		
		echo" 						 

				<li>  <a onclick='return confirm(\"CLICK OK TO CONFIRM SELECTION OF PATIENT TO CONTINUE ...\")' 
                 href='tasks/conduct_test.php?patient_id=".$row['patient_id']."&patient_name=".$patient_name."&test_names=".$requested_lab_test."&request_code=".$request_code."      '>" 
				. $patient_name .", About "."$date_time_stamp". "</a>   </li> <li class='divider'></li>
				 		 	 
		";
		
	}}else{

		echo "";
	}

} else{
	echo "string ".mysqli_error();
}
}

function list_total_notification_waiting_consulting_patients_from_cashier(){

	global $connection;

	$date = date('Y-m-d');
	//$user = $_SESSION['uid'];
	$sql = "SELECT patient_id,date_added FROM `consultingpayment2cashier` WHERE date_added = '".$date."' 
    AND cashier_view_state = '1' AND state = '1' AND opd_view_state = '0'  ";
	
	if($query_run=mysqli_query($connection,$sql)){

	if(mysqli_num_rows($query_run) > 0){
	
	while($row = mysqli_fetch_array($query_run) ){

		//$date_time_stamp = time_passed($row['date_added']);

		$patient_name = patient_name($row['patient_id']);
 		
		echo" 						 

				<li>  <a onclick='return confirm(\"CLICK OK TO CONFIRM SELECTION OF PATIENT TO CONTINUE CONSULTATION...\")'  href='tasks/set_patient_details_cashier.php?patient_id=".$row['patient_id']."'>" 
				. $patient_name ." "."". "</a>   </li> <li class='divider'></li>		 
			 
		";
		
	}}else{

		echo "";
	}

} else{
	echo "string ".mysqli_error();
}
}


function update_notification_lab_request_from_doctor($patient_id,$request_code){
	global $connection;
	$viewed_state = 1;
	$user_id = $_SESSION['uid'];
	//$date = date('Y-m-d H:i:s');
	$sql="UPDATE tbl_req_investigation SET  view_opd_status = '".$viewed_state."', view_opd_status_by = '".$user_id."'  WHERE patient_id = '".$patient_id."' AND 
    request_code = '".$request_code."' ";
	if(mysqli_query($connection,$sql) or die(mysqli_error())){
		return TRUE;
	} else {
		return FALSE;
	}
}


function patient_investigation_total_amount($request_code,$patient_id){
    global $connection;
	$sql = "SELECT amount FROM investigation_payemnt2_cashier WHERE request_code = '".$request_code."' AND patient_id = '".$patient_id."' ";
	$query_run = mysqli_query($connection,$sql) or die(mysqli_error());
    $query_run_results = $query_run->fetch_assoc();
	$investigation_name_amount = $query_run_results['amount'];
    return $investigation_name_amount;
}


function patient_investigation_details_view($request_code,$patient_id){
    global $connection;
	$sql = "SELECT patient_id,request_code,request_test_name,doctor_id,request_code FROM tbl_req_investigation WHERE request_code = '".$request_code."' AND patient_id = '".$patient_id."' ";
	$query_run = mysqli_query($connection,$sql) or die(mysqli_error());
    $row = $query_run->fetch_assoc();

    echo"
    <tr>						
    <td>".$row['patient_id']."</td>


       <td>".patient_name_opd($row['patient_id'])."</td>
       
       <td>".doctor_name_opd($row['doctor_id'])."</td>
        
       <td>".$row['request_test_name']."</td>

       <td>".number_format(patient_investigation_total_amount($row['request_code'],$row['patient_id']), 2, '.', ',')."</td>
   </tr>
";
	 
}

function patient_drugs_details_view($patient_id){
    global $connection;
    $date = date('Y-m-d');
    $user_id = $_SESSION['uid'];
    if($patient_id != null){
        $sql = "SELECT * FROM tbl_precribtion WHERE DATE(date_added) = '".$date."' AND patient_id = '".$patient_id."'AND opd_view_by = '".$user_id."' ";
	
    }
	$sql = "SELECT * FROM tbl_precribtion WHERE DATE(date_added) = '".$date."' AND opd_view_by = '".$user_id."' ";
	
    $query_run = mysqli_query($connection,$sql) or die(mysqli_error());
    	
	while($row = mysqli_fetch_array($query_run) ){

        if($row['time_interval']=="START"){
			$label_dosage = $row['quantity']." X ".$row['times']." ".$row['rate']."
		 ".$row['time_interval']."(s) ";
		}else{
			$label_dosage = $row['quantity']." X ".$row['times']." ".$row['rate']."
		 ".$row['time_interval']."(s)&nbsp; For ".$row['duration']."&nbsp;".$row['time_span'];
		}

        echo"
        <tr>						
        <td>".$row['patient_id']."</td>
    
    
           <td>".patient_name_opd($row['patient_id'])."</td>
           
           <td>".doctor_name_opd($row['doc_code'])."</td>
            
          <td>".drug_name($row['drug_code'])."</td>

           <td>".$label_dosage."</td>
     
       </tr>
    ";
		
	}	 
}


//OPD TO SEE DRUGS

function total_notification_waiting_from_Doctor_opd(){
	global $connection;
	$date = date('Y-m-d');
	//$user = $_SESSION['uid'];
	$sql = "SELECT COUNT(DISTINCT(patient_id)) as total_notification_waiting_from_Doctor FROM `tbl_precribtion` WHERE DATE(date_added) = '".$date."' AND opd_view = '0' AND state = '0' ";
	$query_run = mysqli_query($connection,$sql);
	$rows = mysqli_fetch_assoc($query_run);
	$count = $rows['total_notification_waiting_from_Doctor'];

	return $count;
	
}

function list_total_notification_waiting_from_Doctor(){

	global $connection;

	$date = date('Y-m-d');
	//$user = $_SESSION['uid'];
	$sql = "SELECT DISTINCT patient_id FROM `tbl_precribtion` WHERE DATE(date_added) = '".$date."' AND opd_view = '0' AND state = '0'  ";
	
	if($query_run=mysqli_query($connection,$sql)){

	if(mysqli_num_rows($query_run) > 0){
	
	while($row = mysqli_fetch_array($query_run) ){

		//$date_time_stamp = time_passed($row['date_added']);

		$patient_name = patient_name_opd($row['patient_id']);

		$request_code = "DR";
 		
		echo" 						 

				<li>  <a onclick='return confirm(\"CLICK OK TO CONFIRM SELECTION OF PATIENT TO CONTINUE CONSULTATION...\")'  href='tasks/set_patient_details_pharm.php?patient_id=".$row['patient_id']."&request_code=".$request_code." '>" 
				. $patient_name ." "."". "</a>   </li> <li class='divider'></li>		 
			 
		";
		
	}}else{

		echo "";
	}

} else{
	echo "string ".mysqli_error();
}
}

function update_list_total_notification_waiting_from_Doctor($patient_id){
	global $connection;
	$viewed_state = 1;
	$user_id = $_SESSION['uid'];
	$date = date('Y-m-d');
	$sql="UPDATE `tbl_precribtion` SET opd_view = '".$viewed_state."', opd_view_by = '".$user_id."' WHERE patient_id = '".$patient_id."' AND DATE(date_added) = '".$date."'  ";
	if(mysqli_query($connection,$sql) or die(mysqli_error())){
		return TRUE;
	} else {
		return FALSE;
	}
}

//DUPPLICATE CODES CHECK


function doctor_name_opd($patient_id){
    global $connection;
    $sql = "SELECT firstName,otherNames FROM tbl_staff WHERE staff_id='".$patient_id."'";
    $result = mysqli_query($connection,$sql);
    while( $row = mysqli_fetch_assoc($result)){
        
        return $row['firstName'] . " " . $row['otherNames'];
        
    }
    
}



function patient_name_opd($patient_id){
    global $connection;
    $sql = "SELECT surname,other_names FROM tbl_patient_info WHERE patient_id='".$patient_id."'";
    $result = mysqli_query($connection,$sql);
    while( $row = mysqli_fetch_assoc($result)){
        
        return $row['surname'] . " " . $row['other_names'];
        
    }
    
}


