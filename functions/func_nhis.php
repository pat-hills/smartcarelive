<?php
@session_start();
//require_once 'conndb.php';
//require_once 'func_consulting.php';

//,scheme scheme.membership_id,tbl_patient_info.date_created
function getAllpatientstoClaim(){
	global $connection;
$theSQL = 'SELECT tbl_patient_info.surname,tbl_patient_info.other_names,tbl_patient_info.date_created,
				   scheme.membership_id,scheme.sub_metro,tbl_patient_info.patient_id,tbl_consulting.date_sent
		   FROM tbl_patient_info,scheme,tbl_consulting
		   WHERE tbl_patient_info.patient_id = scheme.patient_id
		   AND tbl_consulting.patient_id=scheme.patient_id
		   GROUP BY tbl_consulting.patient_id
		   ORDER BY date_created DESC
		  ';
		 $thePatients = mysqli_query($connection,$theSQL);
		 if(mysqli_affected_rows($connection) >0){
		 	while ($Patient= mysqli_fetch_array($thePatients)) {

				$patient_claim_consultation = get_patient_consultation_amount_claim($Patient['patient_id'],$Patient['date_sent']);
				$amount_claim_consultation = $patient_claim_consultation["consultationAmount"];
				$drugs_claim = get_patient_drugs_amount_claim($Patient['patient_id'],$Patient['date_sent']);
				$amount_drugs_claim = $drugs_claim['drugAmount'];
				$claim_lab = get_patient_investigation_amount_claim($Patient['patient_id'],$Patient['date_sent']);
				$labAmount = $claim_lab['labAmount'];

				$total_claim = $amount_claim_consultation + $amount_drugs_claim + $labAmount;
		 		
                echo '<tr class="odd gradeX">
					<td><img style="width:50px;height:50px;" src="'.patient_profile_picture($Patient['patient_id']).'"></td>
					<td>'.$Patient['surname']."&nbsp;".$Patient['other_names'].'</td>
					<td>'.$Patient['membership_id'].'</td>
					<td>'.$Patient['sub_metro'].'</td>
					<td>'.date("F jS, Y", strtotime($Patient['date_sent'])).'</td>
					<td>'.number_format($amount_claim_consultation, 2, ".", ",").'</td>
					<td>'.number_format($amount_drugs_claim, 2, ".", ",").'</td>
					<td>'.number_format($labAmount, 2, ".", ",").'</td>
					<td>'."PENDING".'</td>
					<td>'.number_format($total_claim, 2, ".", ",").'</td>
				  
				   <td> ';
         //if(getPatientsNHISstate($Patient['patient_id']) == true){
         //}else{
echo'<button data-toggle="modal" data-target="#mod-patient"  id="'.$Patient['patient_id'].'" class="btn btn-primary get4model"><i class="fa fa-eye"></i>View</button>
';

         //}

							 
	echo' </td></tr>';

////<button type="button" class="btn btn-success"><i class="fa fa-check-circle"></i>Done</button>


		 	}

		 }else{
		 	return false;
		 }


}

 


function get_patient_consultation_amount_claim($patient_id, $date) {
	global $connection;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

	$query = "SELECT SUM(amount) AS consultationAmount FROM consultingpayment2cashier WHERE patient_id = '".$patient_id."' AND date_added = '".$date."'  "; 


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


function count_patient__consultation_times($patient_id, $claim_code) {
	global $connection;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

	$query = "SELECT COUNT(patient_id) AS consultationCount FROM consultingpayment2cashier WHERE patient_id = '".$patient_id."' AND claim_code = '".$claim_code."'  "; 


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

function get_patient_data_details($patient_id) {
	global $connection;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

	$query = "SELECT * FROM tbl_patient_info WHERE patient_id = '".$patient_id."'  "; 


	$query_results = mysqli_query($connection, $query);
	 

	if ($row = mysqli_fetch_assoc($query_results)) {
		return $row;
	} else {
		return NULL;
	}
}


function get_patient_data_scheme($patient_id) {
	global $connection;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

	$query = "SELECT * FROM scheme WHERE patient_id = '".$patient_id."'  "; 


	$query_results = mysqli_query($connection, $query);
	 

	if ($row = mysqli_fetch_assoc($query_results)) {
		return $row;
	} else {
		return NULL;
	}
}


function get_patient_drugs_amount_claim($patient_id, $claim_code) {
	global $connection;
	$state = 2;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

	$query = "SELECT SUM(amount) AS drugAmount FROM drug2depenseinfo WHERE patient_id = '".$patient_id."' AND claim_code = '".$claim_code."'  
	AND state = '".$state."'  "; 


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

function get_patient_investigation_amount_claim($patient_id, $claim_code) {
	global $connection;
	$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

	$query = "SELECT SUM(amount) AS labAmount FROM investigation_payemnt2_cashier WHERE patient_id = '".$patient_id."' AND claim_code = '".$claim_code."'
	AND state = '".$state."'  "; 


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





//claim_format : CLAIM/0933/JULY/2021



function tbl_claim_tracker() {
    global $connection;
    $sql = "SELECT id,claim_code,claim_status,date_created FROM tbl_claim_tracker";
    $query_run = mysqli_query($connection,$sql);

    while ($row = mysqli_fetch_array($query_run)) {
        //$doctor = staff_info($row['doctor_id']);
        echo"
			 <tr>						
				<td>" . $row['claim_code'] . "</td>
				<td>" . $row['claim_status'] . " </td>
				<td>" . date("F jS, Y", strtotime($row['date_created'])) . " </td>
				<td><a onclick='return confirm(\"CLICK OK TO CONFIRM REDEEM OF CLAIM.\")' 
				class='label label-danger' href='tasks/#.php?id=" . $row['id'] . "'><i class='fa fa-money'></i></a></td>
			
				</tr>
		";
    }
}


function claims_membership() {
    global $connection;
    $sql = "SELECT claim_code,patient_id,date_added FROM claimsmonitor ORDER BY date_added asc";
    $query_run = mysqli_query($connection,$sql);

    while ($row = mysqli_fetch_array($query_run)) {
        //$doctor = staff_info($row['doctor_id']);
        echo"
			 <tr>						
				<td>" . $row['patient_id'] . "</td>
				<td>" . $row['claim_code'] . " </td>
				<td>" . date("F jS, Y", strtotime($row['date_added'])) . " </td>
				</tr>
		";
    }
}

function load_claims_membership($claim_code) {
    global $connection;
    $sql = "SELECT claim_code,patient_id,date_added FROM claimsmonitor WHERE claim_code =  '".$claim_code."' ";
    $query_run = mysqli_query($connection,$sql);

    while ($row = mysqli_fetch_array($query_run)) {
        //$doctor = staff_info($row['doctor_id']); date("F jS, Y", strtotime($row['date_added']))
        echo"
			 <tr>						
				<td>" . $row['patient_id'] . "</td>
				<td>" . $row['claim_code'] . " </td>
				<td>" . date("F jS, Y", strtotime($row['date_added'])) . " </td>
				</tr>
		";
    }
}

///get consultation Fees

function getTheConsultingFees(){
	global $connection;
// if(isNHIS($patient_id) == true){

// //get the fees  
// return 0.00;

// }else{

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




function generate_claims_membership($claim_code) {
    global $connection;
    $sql = "SELECT claim_code,patient_id,date_added FROM claimsmonitor WHERE claim_code =  '".$claim_code."' ";
    $query_run = mysqli_query($connection,$sql);

    if($query_run != null){
		return $query_run;
	}else{

		return null;
	}
	

}

function get_claims_investigation_membership($patient_id,$claim_code) {
    global $connection;
    $sql = "SELECT * FROM investigation_payemnt2_cashier WHERE claim_code =  '".$claim_code."' AND patient_id =  '".$patient_id."'  ";
    $query_run = mysqli_query($connection,$sql);

    if($query_run != null){
		return $query_run;
	}else{

		return null;
	}
	

}

function get_investigation_name_nhis($investigation_code){
	$string = "";
	foreach ($investigation_code as $investigations) {		
		 $investigation_name = investigation_name_nhis($investigations);

		 $string .= $investigation_name.',';
		// return $investigation_name;
	}

	return $string;
}

function investigation_name_nhis($investigation_code){
	global $connection;
	$sql = "SELECT Investigations FROM tbl_investigations WHERE investigation_code = '".$investigation_code."'";
	$query_run = mysqli_query($connection,$sql) or die(mysqli_error());
	$query_rows_investigations = $query_run->fetch_assoc();
    $investigation_name = $query_rows_investigations['Investigations'];
	return $investigation_name;
}

function get_drug_name_nhis($drug_code){
	$string = "";
	$drug_code = explode(',', $drug_code);
	foreach ($drug_code as $drugs) {		
		 $drug_name = drug_name_nhis($drugs);

		 $string .= $drug_name.',';
		// return $investigation_name;
	}

	return $string;
}



function drug_name_nhis($drug_code){
	global $connection;
	$sql = "SELECT Name FROM tbl_drug_list WHERE drug_code = '".$drug_code."'";
	$query_run = mysqli_query($connection,$sql) or die(mysqli_error());
	$drug_name_rows = $query_run -> fetch_assoc();
	$diagnosis_name = $drug_name_rows['Name'];
	return $diagnosis_name;
}


function get_investigation_names_by_request_code($investigation_code){
	global $connection;
	$sql = "SELECT request_test_name FROM tbl_req_investigation WHERE request_code = '".$investigation_code."'";
	$query_run = mysqli_query($connection,$sql) or die(mysqli_error());
	$query_rows_investigations = $query_run->fetch_assoc();
    $investigation_name = $query_rows_investigations['request_test_name'];
	return $investigation_name;
}



function get_claims_drug_membership($patient_id,$claim_code) {
    global $connection;
    $sql = "SELECT * FROM drug2depenseinfo WHERE claim_code =  '".$claim_code."' AND patient_id =  '".$patient_id."'  ";
    $query_run = mysqli_query($connection,$sql);

    if($query_run != null){
		return $query_run;
	}else{

		return null;
	}
	

}


function get_claims_consultation_membership($patient_id,$claim_code) {
    global $connection;
    $sql = "SELECT * FROM consultingpayment2cashier WHERE claim_code =  '".$claim_code."' AND patient_id =  '".$patient_id."'  ";
    $query_run = mysqli_query($connection,$sql);

    if($query_run != null){
		return $query_run;
	}else{

		return null;
	}
	

}





function list_claims_providers(){

	global $connection;

	$sql= "SELECT DISTINCT(sub_metro) FROM scheme";

	$query_run = mysqli_query($connection,$sql);
	while($result=mysqli_fetch_assoc($query_run)){
		
		echo "<option value=".$result['sub_metro'].">".$result['sub_metro']."</option>";
	}

}

function list_claims_code_(){

	global $connection;

	$sql= "SELECT claim_code FROM tbl_claim_tracker";

	$query_run = mysqli_query($connection,$sql);
	while($result=mysqli_fetch_assoc($query_run)){
		
		echo "<option value=".$result['claim_code'].">".$result['claim_code']."</option>";
	}

}


function get_patient_investigations_for_claims($patient_id,$date){//patients id

	global $connection;
	$status = 1; //this status is also used for payment status
	//$lab_test = "";

	//$date = date('Y-m-d');
	//$payment_status = 1;//mike was checking if the patient paid for the lab
	$sql="SELECT requested_test FROM tbl_req_investigation WHERE patient_id= '".$patient_id."' AND DATE(requested_date) = '".$date."' AND DATE(processed_date) = '".$date."' 
	AND status ='".$status."' AND payment_status ='".$status."' "; 
	$query_run=mysqli_query($connection,$sql);
	
	while($row = mysqli_fetch_array($query_run) ){
 		
	return $row;

	}

	 

}

function claim_request_investiagtions($patient,$date){

	$investigation_row = get_patient_investigations_for_claims($patient,$date); 

	$investigation_code = explode(',', $investigation_row['requested_test']);


	$a = get_investigation_name_for_claim($investigation_code);

	 return $a;
	 

}


function generate_patients_claim_report($start_date_patient_claim_report,$end_date_patient_claim_report,$claim_provider){

	global $connection;


	if(empty($start_date_patient_claim_report) && empty($end_date_patient_claim_report) && !empty($claim_provider)){
		
	if($claim_provider == "All"){
		$theSQL = 'SELECT tbl_patient_info.surname,tbl_patient_info.other_names,tbl_patient_info.date_created,
		scheme.membership_id,scheme.sub_metro,tbl_patient_info.patient_id,tbl_consulting.date_sent
FROM tbl_patient_info,scheme,tbl_consulting
WHERE tbl_patient_info.patient_id = scheme.patient_id
AND tbl_consulting.patient_id=scheme.patient_id
GROUP BY tbl_consulting.patient_id
ORDER BY date_created DESC
';

	}else{
		$theSQL = 'SELECT tbl_patient_info.surname,tbl_patient_info.other_names,tbl_patient_info.date_created,
		scheme.membership_id,scheme.sub_metro,tbl_patient_info.patient_id,tbl_consulting.date_sent
FROM tbl_patient_info,scheme,tbl_consulting
WHERE tbl_patient_info.patient_id = scheme.patient_id
AND tbl_consulting.patient_id=scheme.patient_id
GROUP BY tbl_consulting.patient_id
ORDER BY date_created DESC
';

	}

	}



			 $thePatients = mysqli_query($connection,$theSQL);




 $row_cnt = mysqli_num_rows($thePatients);



	if($row_cnt > 0){
   $_SESSION['count_rows'] = $row_cnt;
	return $thePatients;
	//mysqli_free_result($a);
	}else{
		$_SESSION['count_rows'] = 0;
	   return null;
	}

}







function genSquareBoxes($variable,$numberofBoxes,$width,$height){
$theWidth;
$theHeight;
//set default width
$defaultWidth = '5px';
//default hieght	
$defaultheight = '5px';

if(empty($width) and empty($height)){
$theWidth = $defaultWidth;
$theHeight = defaultheight;
}else{
$theWidth = $width;
$theHeight =$height;

}


$theBoxes ='';
//if the variable is empty generate the boxes only
	if(empty($variable))
	{
for($count=0;$count <= $numberofBoxes;$count ++){
	   $theBoxes .='<input type="text" style="width:'.$theWidth.';height:'.$theHeight.';">';
	   }
	   return $theBoxes;

	}else{


$theBoxes = '';
	$theStringResult  ='';
//get array from the string
$theArrayOfTheString = str_split($variable);
$thesize = sizeof($theArrayOfTheString);


//loop through 
foreach($theArrayOfTheString as $getTheString){
	//join each loop with the square boxes
	$theStringResult .='<input type="text" value="'.strtoupper($getTheString).'" style="width:'.$theWidth.';height:'.$theHeight.';">'; 
}
//return square boxes with values
//check for xtra boxes
if($numberofBoxes >= $thesize){
//add boxes
//loop with the difference of the two

$theDiff = $numberofBoxes - $thesize;
 $theDiff;
       for($count=0;$count <= $theDiff;$count ++){
	   $theBoxes .= '<input type="text" style="width:'.$theWidth.';height:'.$theHeight.';">';
	   }
	return $theStringResult .$theBoxes;
}else{
	return $theStringResult;
}



}

}


function genSquareBoxes4date($thedate,$width,$height){
$theWidth;
$theHeight;
//set default width
$defaultWidth = '5px';
//default hieght	
$defaultheight = '5px';

if(empty($width) and empty($height)){
$theWidth = $defaultWidth;
$theHeight = defaultheight;
}else{
$theWidth = $width;
$theHeight =$height;

}


if(empty($thedate)){
return '<input type="text" value="" style="width:'.$theWidth.';height:'.$theHeight.';"><input type="text" value="" style="width:'.$theWidth.';height:'.$theHeight.';"><input type="text" value="/" style="width:'.$theWidth.';height:'.$theHeight.';text-align:center"><input type="text" value="" style="width:'.$theWidth.';height:'.$theHeight.';text-align:center">
<input type="text" value="" style="width:'.$theWidth.';height:'.$theHeight.';"><input type="text" value="/" style="width:'.$theWidth.';height:'.$theHeight.';"><input type="text" value="" style="width:'.$theWidth.';height:'.$theHeight.';text-align:center">
<input type="text" value="" style="width:'.$theWidth.';height:'.$theHeight.';"><input type="text" value="" style="width:'.$theWidth.';height:'.$theHeight.';"><input type="text" value="" style="width:'.$theWidth.';height:'.$theHeight.';text-align:center">';

}

	
$getTheMonth = '';
$getTheday= '';
$getTheyr =''; 
 $month = date('m',strtotime($thedate));
////////////month/////////////////////////////////////////////////////
$slipedMount = str_split($month);
foreach($slipedMount as $getDate){
$getTheMonth  .='<input type="text" value="'.$getDate.'" style="width:'.$theWidth.';height:'.$theHeight.';20px;">';
}
  $getTheMonth;

//////////////////day///////////////////////////////////////////////
 $day =  date('d',strtotime($thedate));
 

////////////month/////////////////////////////////////////////////////
$slipedday = str_split($day);
foreach($slipedday as $getday){
$getTheday  .='<input type="text" value="'.$getday.'" style="width:'.$theWidth.';height:'.$theHeight.';">';
}
  $getTheday;

 
////////////year/////////////////////////////////////////////////////
  $year =  date('Y',strtotime($thedate));
 $slipedyr = str_split($year);
foreach($slipedyr as $getyr){
$getTheyr  .='<input type="text" value="'.$getyr.'" style="width:'.$theWidth.';height:'.$theHeight.';">';
}
$getTheyr;

 return $getTheday.'<input type="text" value="/" style="width:'.$theWidth.';height:'.$theHeight.';">'.$getTheMonth
		.'<input type="text" value="/" style="width:'.$theWidth.';height:'.$theHeight.';">'.$getTheyr;
 
 
}


function getPatiensPersonalInfo4Claims($patient_id){
	global $connection;
$theSQL = "SELECT surname,other_names,dob,sex FROM tbl_patient_info WHERE patient_id='".$patient_id."' ";
     $patientPersonalinfo =  mysqli_query($connection,$theSQL);
     if(mysqli_affected_rows($connection) >0){
       while( $theInfo = mysqli_fetch_array($patientPersonalinfo)){

		 return $thePatientInfo = array('surname' =>$theInfo['surname'] ,
									   'othernames' =>$theInfo['other_names'] ,
									   'dob' => $theInfo['dob'],
									   'sex' => $theInfo['sex']
									    );
		
       }
     		}else{return false;}


}

function calPatientAge($dob){
$age = date_create($dob)->diff(date_create('today'))->y;
return $age;
}

function getNHISinfo($patient_id){
	global $connection;
	$the_query =  "SELECT membership_id,serial_number,sub_metro FROM scheme WHERE patient_id='".$patient_id."'";
$patientdata = mysqli_query($connection,$the_query);
if(mysqli_affected_rows($connection) >0){
while($patientNHISdata =mysqli_fetch_array($patientdata)){

	return $theData = array('membership_id' =>$patientNHISdata['membership_id'] , 
                            'serial_number'=>$patientNHISdata['serial_number'],
                            'sub_metro'=>$patientNHISdata['sub_metro']
					);

}
}else{return false;}

}

function getGender($sex){
if($sex == 'Male'){
	return '
<p><input checked="true" type="checkbox" style="width:10px;height:5px;font-size:1.5em;"> Male</p>
<p><input type="checkbox" style="width:10px;height:5px;font-size:1.5em;"> Female</p>';
}else
if($sex == 'Female'){
return '<p><input  type="checkbox" style="width:10px;height:5px;font-size:1.5em;"> Male</p>
<p><input type="checkbox" checked="true" style="width:10px;height:5px;font-size:1.5em"> Female</p>';

}

}


function get_service_code($length=8) {
 $string = 0;
   /* Only select from letters and numbers that are readable - no 0 or O etc..*/
   $characters = "23456789ABCDEFHJKLMNPRTVWXYZ";
 
   for ($p = 0; $p < $length; $p++) 
   {
       $string .= $characters[mt_rand(0, strlen($characters)-1)];
   }
 
   return $string;
 }


 function NHIS_Services($servicea,$serviceb,$pharm){
$default_state = 1;
$theSql = "INSERT INTO nhis_service_type 
		  (service_A,service_B,service_code,date_added,patient_id,staff_id,pharm,state) 
		  VALUES 
		  ('".$servicea."','".$serviceb."','".get_service_code()."','".date('Y-m-d')."',
		  	'".$_SESSION["patient_id"]."','".$_SESSION['uid']."','".$pharm."','".$default_state."')
		  ";
		  mysql_query($theSql);
		 
		  if(mysql_affected_rows >0){
		  echo true; die();
		  }else{
		  echo false; die();
		  }
}



function updateNHIS_Services($servicea,$serviceb,$pharm,$service_code)
{
$theSql = "UPDATE nhis_service_type SET 
		  service_A ='".$servicea."',
		  service_B ='".$serviceb."',
		  date_added ='".date('Y-m-d')."',
		  staff_id = '".$_SESSION['uid']."',
		  pharm ='".$pharm."'  
		  WHERE patient_id='".$_SESSION["patient_id"]."' 
		  AND service_code='".$service_code."'
		  ";
		  mysql_query($theSql);
		 
		  if(mysql_affected_rows >0){
		  echo true; die();
		  }else{
		  echo false; die();
		  }



}


function getPatientsNHISservicedata($patient_id){
	$default_state = 1;
$theSQL ="SELECT * FROM nhis_service_type WHERE patient_id='".$patient_id."' AND state='".$default_state."'  ";
$theservicedata = mysql_query($theSQL);
if(mysql_affected_rows() >0){
while($getServices = mysql_fetch_array($theservicedata)){
 return $aLLservices = array('service_A' =>$getServices['service_A'] , 
 							'service_B' =>$getServices['service_B'] , 
 							'service_code' =>$getServices['service_code'] , 
 							'pharm' =>$getServices['pharm'],
 							'state' =>$getServices['state']  
 							
 							);

}


}else{
	return false;
}


}


function getPatientsNHISstate($patient_id){
	$defaultState = 1;
mysql_query('SELECT state FROM nhis_service_type WHERE patient_id="'.$patient_id.'" AND state="'.$defaultState.'" ');
if(mysql_affected_rows() >0){
return true;
}else{
return false;
}

}


function get_outcome_code($length=8) {
 $string = 0;
   /* Only select from letters and numbers that are readable - no 0 or O etc..*/
   $characters = "23456789ABCDEFHJKLMNPRTVWXYZ";
 
   for ($p = 0; $p < $length; $p++) 
   {
       $string .= $characters[mt_rand(0, strlen($characters)-1)];
   }
 
   return $string;
 }


function NHIS_Outcome($theOutCome){
$outcome_code  = get_outcome_code();
mysql_query('INSERT INTO nhis_outcome 
			(outcome,staff_id,patient_id,date_added,outcome_code) 
			 VALUES 
			 ("'.$theOutCome.'","'.$_SESSION['uid'].'","'.$_SESSION['patient_id'].'","'.date('Y-m-d').'","'.$outcome_code.'")
			');

if(mysql_affected_rows() >0){
 return true;
}else{
	return false;
}

}

function get_NHIS_outcome($patient_id){
$patientsOutcome  = mysql_query("SELECT outcome,date_added,outcome_code FROM nhis_outcome WHERE patient_id='".$patient_id."' ");
if(mysql_affected_rows() >0){
while( $theOutcome = mysql_fetch_array($patientsOutcome)){
	return $getOutcome = array('outcome' =>$theOutcome['outcome'],
								'outcome_code'=>$theOutcome['outcome_code'],
								'date_added'=>$theOutcome['date_added']
							   );

}


}else{
	return false;
}



}

function updateNHIS_Outcome($outcome,$outcome_code){
mysql_query("UPDATE nhis_outcome SET outcome='".$outcome."' WHERE patient_id='".$_SESSION['patient_id']."' AND outcome_code='".$outcome_code."'  ");
if(mysql_affected_rows() >0){
	return true;
}else{
	return false;
}
}

function get_attendance_code($length=8)
{
$string = 0;
   /* Only select from letters and numbers that are readable - no 0 or O etc..*/
   $characters = "23456789ABCDEFHJKLMNPRTVWXYZ";
 
   for ($p = 0; $p < $length; $p++) 
   {
       $string .= $characters[mt_rand(0, strlen($characters)-1)];
   }
 
   return $string;

}


function visit_code($length=8)
{
$string = 0;
   /* Only select from letters and numbers that are readable - no 0 or O etc..*/
   $characters = "23456789ABCDEFHJKLMNPRTVWXYZ";
 
   for ($p = 0; $p < $length; $p++) 
   {
       $string .= $characters[mt_rand(0, strlen($characters)-1)];
   }
 
   return $string;


}


function NHIS_attendance($Attendance,$Specialitycode){
	$attendance_code = get_attendance_code();
mysql_query('INSERT INTO NHIS_attendance
			(attendace_mode,staff_id,patient_id,date_added,attendance_code,speciality_code)
			VALUES
			("'.$Attendance.'","'.$_SESSION['uid'].'","'.$_SESSION['patient_id'].'","'.date('Y-m-d').'","'.$attendance_code.'","'.$Specialitycode.'")

			');

if(mysql_affected_rows() >0){
	return true;
}else{
	return false;
}

}


function get_Patients_nhis_attendance($patient_code){
$theAttendance = mysql_query(" SELECT attendace_mode,attendance_code,speciality_code 
								FROM NHIS_attendance 
								WHERE patient_id='".$patient_code."'

							");
if(mysql_affected_rows() >0){
while( $getTheAttendance = mysql_fetch_array($theAttendance)){
 return $attendance = array('attendace_mode' =>$getTheAttendance['attendace_mode'], 
 							'attendance_code' =>$getTheAttendance['attendance_code'],
 							'speciality_code' =>$getTheAttendance['speciality_code']
 							);

}
}else{
return false;
}

}

function updateNHIS_attendance($Attendance,$Specialitycode,$attendance_code){
mysql_query(" UPDATE NHIS_attendance SET attendace_mode='".$Attendance."',speciality_code='".$Specialitycode."'
			   WHERE  patient_id='".$_SESSION['patient_id']."' AND attendance_code='".$attendance_code."'
			");
if(mysql_affected_rows() >0){
	return true;
}else{
	return false;
}

}


function NHIS_DateProvision($v1,$v2,$v3,$v4,$duOfsp){
	$visit_code = visit_code();
mysql_query("INSERT INTO NHIS_dateofProvision
			(visit1,visit2,visit3,visit4,durationOfSpell,visit_code,staff_id,date_added,patient_id)
			VALUES
			('".$v1."','".$v2."','".$v3."','".$v4."','".$duOfsp."','".$visit_code."','".$_SESSION['uid']."','".date('Y-m-d')."','".$_SESSION['patient_id']."')

			");

if(mysql_affected_rows() >0){

	return true;
}else{
	return false;
}

}

function updateNHIS_DateProvision($v1,$v2,$v3,$v4,$duOfsp,$visitcode){
	
mysql_query("UPDATE  NHIS_dateofProvision SET
			visit1='".$v1."',visit2='".$v2."',visit3='".$v3."',visit4='".$v4."',
			durationOfSpell='".$duOfsp."' 
			WHERE patient_id='".$_SESSION['patient_id']."' AND visit_code='".$visitcode."'
			
			");

if(mysql_affected_rows() >0){

	return true;
}else{
	return false;
}

}

function get_nhis_dateProvision($patient_id){
$provisionDate = mysql_query("SELECT visit1,visit2,visit3,visit4,durationOfSpell,visit_code,date_added
							  FROM NHIS_dateofProvision
							  WHERE patient_id='".$patient_id."' 
							 ");

if(mysql_affected_rows() >0){
while(  $getDates= mysql_fetch_array($provisionDate)){
return $thedates = array('visit1' =>$getDates['visit1'] ,
							 'visit2' =>$getDates['visit2'] ,
							 'visit3' =>$getDates['visit3'] ,
							 'visit4' =>$getDates['visit4'] ,	
							 'durationOfSpell' =>$getDates['durationOfSpell'] ,
							 'visit_code' =>$getDates['visit_code'],	
							 'date_added' =>$getDates['date_added']
							 );

}
	

}else{
return false;
}


}


/*function get_nhis_medicine4cliam($patient_id){
mysql_query("SELECT drug_code,FROM WHERE patient_id='".$patient_id."' ")

}*/

function getAllPatientsClaims($patient_id){
	global $connection;
	$the_query = "SELECT date_sent,patient_id,consulting_code 
	FROM tbl_consulting 
	WHERE patient_id='".$patient_id."' 
";
$allHistory = mysqli_query($connection,$the_query);
if(mysqli_affected_rows($connection) >0)
{
	
while ( $getHistro = mysqli_fetch_array($allHistory)) {
	 echo '<tr>';
	echo '<td>'.$getHistro["date_sent"].'</td>';
if(checkTheStateOfaClaimForm($patient_id,$getHistro["date_sent"])){
	echo' <td> <span class="badge badge-danger">Done</span>
		  </td>';
}else{
	echo' <td> <span class="badge badge-success">active</span>
          </td>';
}
		if(checkTheStateOfaClaimForm($patient_id,$getHistro["date_sent"])){
		echo '<td><button class="btn btn-danger"><i class="fa fa-ban">Done</i></button>
							 </td>';
		}else{
			
			echo '<td><a href="claims.php?code='.$getHistro['consulting_code'].'" class="btn btn-success"><i class="fa fa-eye">View</i></a>
							 </td>';
		}

		 	
	
echo '</tr>';
}

}else{

	return false;
}


}





function getPatientsClaimData($patient_id){
	global $connection;
	$the_query = "SELECT date_sent,patient_id,consulting_code 
	FROM tbl_consulting 
	WHERE date_sent > date_sub(
		  (SELECT max(date_sent) FROM tbl_consulting),
		  INTERVAL 3 month
							  )
	AND patient_id='".$patient_id."' 

";
$patientsdata = mysqli_query($connection,$the_query);
if(mysqli_affected_rows($connection) >0){
//create session incase the user will watch previous data
	
	echo '<div class="block-flat">
						<div class="header">							
							<h3>Visit History<span style="font-size:12px;">(for the past three month still today)</span></h3>
						</div>
						<div class="content" id="'.$patient_id.'"">
							<div class="list-group">
							<a href"#" class="list-group-item active">Date of Visit<span class="badge">State</span></a>
		';
while ( $alldata = mysqli_fetch_array($patientsdata)) {
$_SESSION['pid_4previous'] = $patient_id;
	$_SESSION['pdate_4previous'] = $alldata['date_sent'];
    if(checkTheStateOfaClaimForm($patient_id,$alldata['date_sent'])){
				
echo '<a href="#" class="list-group-item">'.date('d F, Y',strtotime($alldata['date_sent'])).' 
		   <span class="badge badge-danger">Done</span></a>';
              }else{
echo '
		 <a href="claims.php?code='.$alldata['consulting_code'].'" class="list-group-item">'.date('d F, Y',strtotime($alldata['date_sent'])).' 
		   <span class="badge badge-success">active</span></a>
							 					  
					';

              }






		  				 
}

echo '</div></div></div>';

}else{
	return false;
}

}

function get_patients_id_and_dateseen($consulting_code){
	global $connection;
	$the_query = "SELECT patient_id,date_sent FROM tbl_consulting WHERE consulting_code='".$consulting_code."' ";
	$thepatientid = mysqli_query($connection,$the_query);
	if(mysqli_affected_rows($connection) >0){

while($theid = mysqli_fetch_array($thepatientid)){
	return $getId_data = array('patient_id' =>$theid['patient_id'] ,
							   'date_seen' =>$theid['date_sent']  );
}

	}else{
		return false;
	}
}


function removeTheCommasFromTheCode($thecodes){

    $getTheArrayOfCodes = explode(',', $thecodes);
    foreach ($getTheArrayOfCodes as $thecode) {
    	return $thecode;
    }
}


function getTheSchemeCode($patient_id){
$theSubmetro =  mysql_query("SELECT sub_metro FROM scheme WHERE patient_id='".$patient_id."' LIMIT 0,1" );
if(mysql_affected_rows() >0){

	while ($schemeCode = mysql_fetch_array($theSubmetro)) {
		return $schemeCode['sub_metro'];
	}
}else{
	return false;
}

}


function monthOfClaim($thedate,$width,$height){

$theWidth;
$theHeight;
//set default width
$defaultWidth = '5px';
//default hieght	
$defaultheight = '5px';

if(empty($width) and empty($height)){
$theWidth = $defaultWidth;
$theHeight = defaultheight;
}else{
$theWidth = $width;
$theHeight =$height;

}


if(empty($thedate)){
return '<input type="text" value="" style="width:'.$theWidth.';height:'.$theHeight.';"><input type="text" value="" style="width:'.$theWidth.';height:'.$theHeight.';"><input type="text" value="/" style="width:'.$theWidth.';height:'.$theHeight.';text-align:center"><input type="text" value="" style="width:'.$theWidth.';height:'.$theHeight.';text-align:center">
<input type="text" value="" style="width:'.$theWidth.';height:'.$theHeight.';"><input type="text" value="/" style="width:'.$theWidth.';height:'.$theHeight.';"><input type="text" value="" style="width:'.$theWidth.';height:'.$theHeight.';text-align:center">
<input type="text" value="" style="width:'.$theWidth.';height:'.$theHeight.';"><input type="text" value="" style="width:'.$theWidth.';height:'.$theHeight.';"><input type="text" value="" style="width:'.$theWidth.';height:'.$theHeight.';text-align:center">';

}

	
$getTheMonth = '';
$getTheday= '';
$getTheyr =''; 
 $month = date('m',strtotime($thedate));
////////////month/////////////////////////////////////////////////////
$slipedMount = str_split($month);
foreach($slipedMount as $getDate){
$getTheMonth  .='<input type="text" value="'.$getDate.'" style="width:'.$theWidth.';height:'.$theHeight.';20px;">';
}
  $getTheMonth;

//////////////////day///////////////////////////////////////////////
 $day =  date('d',strtotime($thedate));
 

////////////month/////////////////////////////////////////////////////
$slipedday = str_split($day);
foreach($slipedday as $getday){
$getTheday  .='<input type="text" value="" style="width:'.$theWidth.';height:'.$theHeight.';">';
}
  $getTheday;

 
////////////year/////////////////////////////////////////////////////
  $year =  date('Y',strtotime($thedate));
 $slipedyr = str_split($year);
foreach($slipedyr as $getyr){
$getTheyr  .='<input type="text" value="'.$getyr.'" style="width:'.$theWidth.';height:'.$theHeight.';">';
}
$getTheyr;

 return $getTheday.'<input type="text" value="/" style="width:'.$theWidth.';height:'.$theHeight.';">'.$getTheMonth
		.'<input type="text" value="/" style="width:'.$theWidth.';height:'.$theHeight.';">'.$getTheyr;
 





}

function getHealthInsuranceOfficersName($staffId){
	global $connection;
	$the_query = "SELECT firstName,otherNames FROM tbl_staff WHERE staff_id='".$staffId."' LIMIT 0,1 ";
$getStaffName = mysqli_query($connection,$the_query);
if(mysqli_affected_rows($connection) >0){
	while ( $theNames = mysqli_fetch_array($getStaffName)) {
		return $theNames['firstName'] .'&nbsp;'.$theNames['otherNames'];
	}
}else{
	return false;
}


}



function getPatientsDiagnosis($patient_id,$date_sean){
	$nhisState = 1;
$theDiag  = mysql_query("SELECT tbl_diagnosis.diagnosis,
								tbl_diagnosis_list.name,tbl_diagnosis_list.gdrg,tbl_diagnosis_list.icd10 
						 FROM tbl_diagnosis
						 JOIN tbl_diagnosis_list
						 ON tbl_diagnosis.diagnosis=tbl_diagnosis_list.diagonisis_code 
						 WHERE tbl_diagnosis.patient_id='".$patient_id." 
						 AND tbl_diagnosis.date_added='".$date_sean."' 
						 AND nhis.tbl_diagnosis_list='".$nhisState."'
						 ");
if(mysql_affected_rows() >0){
while( $getTheDiag = mysql_fetch_array($theDiag))
{
 return $theDiadNo = array('name' =>$getTheDiag['name'] ,
   							 'gdrg' =>$getTheDiag['gdrg'] ,
   							 'icd10' =>$getTheDiag['icd10'] 	
   							 );
}

}else{
	return false;
}

}

function settings_code($length=8){
$string = 0;
   /* Only select from letters and numbers that are readable - no 0 or O etc..*/
   $characters = "23456789ABCDEFHJKLMNPRTVWXYZ";
 
   for ($p = 0; $p < $length; $p++) 
   {
       $string .= $characters[mt_rand(0, strlen($characters)-1)];
   }
 
   return $string;


}

function saveSetings($staffid,$hicode){
$settings_code =  settings_code();
mysql_query("INSERT INTO tbl_nhis_settings (date_added,settings_code,staff_id,hicode) 
			VALUES ('".date('Y-m-d')."','".$settings_code."','".$staffid."','".$hicode."')
			");
if(mysql_affected_rows() >0){

return true;
}else{
	return false;
}

}

function getToEditSettings(){
$theSettings = mysql_query("SELECT * FROM tbl_nhis_settings");
if(mysql_affected_rows() >0){
while($getSettings = mysql_fetch_array($theSettings)){
return $allsettings = array('settings_code' =>$getSettings['settings_code'] ,
							'hicode' =>$getSettings['hicode'] ,
							 );
}
}else{
	return false;
}

}
function getHIcode(){
$theHicode = mysql_query("SELECT hicode FROM tbl_nhis_settings");
if(mysql_affected_rows() >0){
while($getTheHiCode = mysql_fetch_array($theHicode)){
    return $getTheHiCode['hicode']; 
}

}else{
	return false;
}

}

function EditSetings($staff_id,$hicode,$securitycode){

	mysql_query("UPDATE tbl_nhis_settings SET
				 hicode='".$hicode."' WHERE settings_code='".$securitycode."'
				 AND staff_id='".$staff_id."'
				");
	if(mysql_affected_rows() >0){

		return true;
	}else{
		return false;
	}
}

function claim_code($length=8){
$string = 0;
   /* Only select from letters and numbers that are readable - no 0 or O etc..*/
   $characters = "23456789ABCDEFHJKLMNPRTVWXYZ";
 
   for ($p = 0; $p < $length; $p++) 
   {
       $string .= $characters[mt_rand(0, strlen($characters)-1)];
   }
 
   return $string;
}


function form_code($length=10){
$string = 0;
   /* Only select from letters and numbers that are readable - no 0 or O etc..*/
   $characters = "23456789ABCDEFHJKLMNPRTVWXYZ";
 
   for ($p = 0; $p < $length; $p++) 
   {
       $string .= $characters[mt_rand(0, strlen($characters)-1)];
   }
 
   return $string;
}

function barcode($length=13){
$string = 0;
   /* Only select from letters and numbers that are readable - no 0 or O etc..*/
   $characters = "23456789ABCDEFHJKLMNPRTVWXYZ";
 
   for ($p = 0; $p < $length; $p++) 
   {
       $string .= $characters[mt_rand(0, strlen($characters)-1)];
   }
 
   return $string;

}


function monitorClaimForm($patient_id){

//check if its already here
$patientsCliam = mysql_query("SELECT claim_code FROM claimsmonitor 
			 WHERE patient_id='".$patient_id."' 
			 AND date_added='".date('Y-m-d')."' 
			");
if(mysql_affected_rows() >0){
return false;
}else{


	//generate security codes
$state = 1;
mysql_query("INSERT INTO claimsmonitor (date_added,staff_id,claim_code,form_code,barcode,patient_id,state) 
			 VALUES ('".date('Y-m-d')."','".$_SESSION['uid']."','".claim_code()."','".form_code()."','".barcode()."',
			 	'".$patient_id."','".$state."')
			");

			if(mysql_affected_rows() >0){
				return true;
			}else{
				return false;
			}	
}
}

function checkTheStateOfaClaimForm($patient_id,$date_added){
	global $connection;
	$the_query = "SELECT state FROM claimsmonitor WHERE patient_id='".$patient_id."' AND date_added='".$date_added."' ";
$state = mysqli_query($connection,$the_query);
if(mysqli_affected_rows($connection) >0){
	return true; //dont show editable field
}else{
	return false; //show editable feilds
}

}


function getFormCode($patient_id){
	$formcode = mysql_query("SELECT form_code FROM claimsmonitor WHERE patient_id='".$patient_id."' ");
	
	if(mysql_affected_rows() >0){
while($getTheFormCoded  = mysql_fetch_array($formcode)){

	return $getTheFormCoded['form_code'];
}
	}else{
		return false;
	}
}


function getPatientsServicesInfo($patient_id,$date_seen){

	global $connection;
	$the_query = "SELECT *  
	FROM patients_services 
	WHERE patient_id = '".$patient_id."'
	AND date_added='".$date_seen."'
   ";

$serviceInfo = mysqli_query($connection,$the_query);
		  
		   if(mysqli_affected_rows($connection) >0){  
		   
		     while($theServiceData = mysqli_fetch_array($serviceInfo)){
			 return array('service_type'=>$theServiceData['service_type'],
						  'service_package'=>$theServiceData['service_package'],
						  'attendance_type'=>$theServiceData['attendance_type'],
						  'outcome'=>$theServiceData['outcome'],
						   'pharmacy'=>$theServiceData['pharmacy'],
							'service_code'=>$theServiceData['service_code'],
							'Speciality_Code'=>$theServiceData['Speciality_Code']							
						  );
			 }
		   }else{
		   return false;
		   }
}

function generateBarcode(){


// The arguments are R, G, and B for color.
$colorFront = new BCGColor(0, 0, 0);
$colorBack = new BCGColor(255, 255, 255);
//$font = new BCGFontFile('class/font/Arial.ttf', 18);

$code = new BCGcode39(); // Or another class name from the manual
$code->setScale(2); // Resolution
$code->setThickness(30); // Thickness
$code->setForegroundColor($colorFont); // Color of bars
$code->setBackgroundColor($colorBack); // Color of spaces
$code->setFont($font); // Font (or 0)
$code->parse('HELLO'); // Text

$drawing = new BCGDrawing('', $colorBack);
$drawing->setBarcode($code);
$drawing->draw();
header('Content-Type: image/png');
$drawing->finish(BCGDrawing::IMG_FORMAT_PNG);



}


?>