<?php
@session_start();
require_once 'conndb.php';
require_once "func_constant.php";
require_once "func_common.php";

function gen_payment_code($length=10) {
 $string = 0;
   /* Only select from letters and numbers that are readable - no 0 or O etc..*/
   $characters = "23456789ABCDEFHJKLMNPRTVWXYZ";
 
   for ($p = 0; $p < $length; $p++) 
   {
       $string .= $characters[mt_rand(0, strlen($characters)-1)];
   }
 
   return $string;
 }



function getPatPayDetails($patient_id,$date){
	global $connection;
	$state = 0; //default state

	$theSQL = "SELECT * 
				FROM drug2depenseinfo
				WHERE patient_id='".$patient_id."'
				AND date_added='".$date."'
				
			  ";
	$paymentdata = mysqli_query($connection,$theSQL);
	if(mysqli_num_rows($paymentdata) >0 ){

while($paymentinfo = mysqli_fetch_array($paymentdata)){

      return $paymentinfo;

}

}else{
		return false;die();
	}


}

function updatePaymentState($transcode,$cashier_id)
{
global $connection;
$the_state = 1;
	$theSQL = "UPDATE drug2depenseinfo SET
			   state='".$the_state."', cashier_id='".$cashier_id."'
			   WHERE transcode = '".$transcode."'	
			  ";
		$updates = mysqli_query($connection,$theSQL);	  
			  if(mysqli_affected_rows($connection) >0 ){
			  	return true;
			  }else{
			  	return false;
			  }
}



function checkIfthePatHasPaid4Service($transcode){
	global $connection;
$thissql = "SELECT transcode 
			FROM cashier_payment
			WHERE transcode='".$transcode."'
			AND date_added='".date('Y-m-d')."'
			";
			 $theresult =  mysqli_query($connection,$thissql);
			 if(mysqli_affected_rows($connection) > 0){
			 		
			 		return true;


			 }else{

			 			return false;
			 }


}


function processesPayment($patient_id,$transcode,$paymentstate){

	global $connection;

	//since it contains more that one transcode loop thru them
	global $feedbacks;
 	$feedbacks = '';
	 $pat_fullname = $_SESSION['surname']." ".$_SESSION['other_names'];
	 $pat_contact = 	$_SESSION['sms_contact'];

foreach ($transcode as $getTheTranscode) {
/*if(checkIfAlreadyPaid($getTheTranscode) == true){
header("Location: ../add_payment.php?message=Patients has already paid");
die();
} */

if(empty($getTheTranscode)){return false;}

	$paymentcode = gen_payment_code();
	$payment_state =1;//paid
	$stuff_id = @$_SESSION['uid']; 
	$today = date('Y-m-d');

	$theSQL ="INSERT INTO cashier_payment
	(transcode,paymentCode,patient_id,payment_state,staff_id,date_added)
			   VALUES
	('".$getTheTranscode."','".$paymentcode."','".$patient_id."','".$payment_state."','".$stuff_id."',
		'".$today."')";
	mysqli_query($connection,$theSQL);

	if(mysqli_affected_rows($connection) >0){

		//processesPayment

		if($_SESSION['flag'] != null && $_SESSION['flag']=="DOCTOR_TO_CASH" && $_SESSION['request_code'] != null){	
	updateLabStatus($patient_id,$stuff_id);
	investigation_payment_status($patient_id,$stuff_id,$_SESSION['request_code']);
		}
     

	update_consulting_payment($patient_id,$stuff_id);
	//update the drug2depenseinfo table
	//	updatePaymentState($getTheTranscode,$stuff_id);

	
	if($_SESSION['flag'] != null && $_SESSION['flag']=="PHARMA_TO_CASH"){
		updateDrugDepense($patient_id,$stuff_id);
	}
	

		//update_cashier_consultations_for_Insuarance_patients_payment($patient_id,$stuff_id,$paymentcode);
	//	send_patient_recovery_sms($pat_fullname,$pat_contact);
	   //indicate payment for print button
	   $_SESSION['showPrintBtn'] = 1; 
	$feedbacks =true;
	}
	else{ $feedbacks = false; }

}//killed loop

//send_patient_recovery_sms($pat_fullname,$pat_contact);
return $feedbacks;

}

function send_patient_recovery_sms($patient_fullname,$patient_number){
	$strUserName = "linu-mndbutik";
	$strPassword = "Pat123@@";
	$strMessageType = "0";
	$strDlr = "1";
	//$strMobile = $sms_format_1;
	$Sender = "SmtCHosp";
	$message = trim("Dear ". strtoupper($patient_fullname). ", \n May good health envelop you, you will be completely healthy and smiling once again. " . "\n"."".
	 "Wishing you full and speedy recovery\n" ." \n Thank you."."  \n". "MD, SmartCareAid". "");
	
	 $url = "http://rslr.connectbind.com" . "/bulksms/bulksms?username=" . $strUserName . "&password=" . $strPassword . "&type=" . $strMessageType . "&dlr=" 
	 . $strDlr . "&destination=" . $patient_number . "&source=" . $Sender . "&message=" . $message . "";
	 
	 
   $url = preg_replace("/ /", "%20", $url);
   $output = file_get_contents($url);
	 
	 
		
	 
	// print_r($output);
   
   
   
	 //  if($output){  
	   //}
}

// function update_consulting_payment($patient_id,$cashier_id)
// {
// global $connection;
// $payment_state = 1;
// $the_statement = "UPDATE tbl_consulting SET payment_state='".$payment_state."',cashier_id='".$cashier_id."' WHERE patient_id='".$patient_id."' and date_sent='".date('Y-m-d')."'";
// mysqli_query($connection,$the_statement);

// if(mysqli_affected_rows($connection) >0){
// return true;
// }else{
// return false;
// }

// }


function update_consulting_payment($patient_id,$cashier_id)
{
global $connection;
$payment_state = 1;
$the_statement = "UPDATE consultingpayment2cashier SET state='".$payment_state."',cashier_id='".$cashier_id."' WHERE patient_id='".$patient_id."' ";
mysqli_query($connection,$the_statement);

if(mysqli_affected_rows($connection) >0){
return true;
}else{
return false;
}

}

function update_cashier_consultations_for_Insuarance_patients_payment($patient_id,$cashier_id,$payment_code)
{
global $connection;
$payment_state = 1;
$the_statement = "UPDATE cashier_payment SET paymentCode='".$payment_code."',staff_id='".$cashier_id."' WHERE patient_id='".$patient_id."' AND date_added='".date('Y-m-d')."'";
mysqli_query($connection,$the_statement);

if(mysqli_affected_rows($connection) >0){
return true;
}else{
return false;
}

}

function updateLabStatus($patient_id,$cashier_id)
{
	global $connection;
$status_state = 1;
$today =date('Y-m-d'); 
$sql_statement ="UPDATE tbl_req_investigation SET
payment_status='".$status_state."',cashier_id='".$cashier_id."'
WHERE patient_id='".$patient_id."'
AND requested_date ='".$today."'
";
 mysqli_query($connection,$sql_statement); 
			if(mysqli_affected_rows($connection) >0){
		//WE NEED TO GET THE LAB CODE HERE TO GO AND ALSO UPDATE investigation_payemnt2_cashier for the CASHIER AS PAYMENT CONFIRMATION
			return true;
			}else{
			return false;
			}
}


function get_lab_code($cashier_id,$patient_id) {
	global $connection;

	$today =date('Y-m-d'); 
	$status_state = 1;
	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

	$query = "SELECT request_code FROM tbl_req_investigation WHERE  patient_id='".$patient_id."' AND requested_date='".$today."'
	AND payment_status='".$status_state."'
	AND cashier_id='".$cashier_id."'
	ORDER BY id DESC LIMIT 1";


	$query_results = mysqli_query($connection, $query);
	//$query_run = mysqli_query($connection,$sql) or die(mysqli_error());
	//confirm_query($query_results);

//        return $query_results;

	if ($row = mysqli_fetch_assoc($query_results)) {
		return $row['request_code'];
	} else {
		return NULL;
	}
}


function get_check_trans_code_investigation($transcode) {
	global $connection;
	$today =date('Y-m-d'); 
	$status_state = 0;
	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

	$query = "SELECT transaction_code FROM investigation_payemnt2_cashier WHERE  date_added='".$today."' AND state='".$status_state."'";

	$query_results = mysqli_query($connection, $query);

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
	 

}

function investigation_payment_status($patient_id,$cashier_id,$lab_request_code)
{
	global $connection;
$status_state = 1;
$today =date('Y-m-d'); 
$sql_statement ="UPDATE investigation_payemnt2_cashier SET
state='".$status_state."',cashier_id='".$cashier_id."'
WHERE patient_id='".$patient_id."'
AND date_added ='".$today."'
AND request_code ='".$lab_request_code."'
";
 mysqli_query($connection,$sql_statement); 
			if(mysqli_affected_rows($connection) >0){
		//WE NEED TO GET THE LAB CODE HERE TO GO AND ALSO UPDATE investigation_payemnt2_cashier for the CASHIER AS PAYMENT CONFIRMATION
			return true;
			}else{
			return false;
			}
}

function updateDrugDepense($patient_id,$cashier_id){
	global $connection;
 	$state =2;
 	$today =date('Y-m-d'); 
$theSql = "UPDATE drug2depenseinfo  SET
 				   	state='".$state."',	cashier_id='".$cashier_id."'
 			WHERE patient_id='".$patient_id."'
 			AND date_added ='".$today."'  	   		
 		   ";
 		    $theresults = mysqli_query($connection,$theSql);
 		    if($theresults){
 		    	return true;
 		    }else{
 		    	return false;
 		    }

 }

function checkIfAlreadyPaid($transcode){
	$state = 1;
	$today = date('Y-m-d');

	$theSQL = "SELECT transcode 
				FROM cashier_payment 
				WHERE transcode='".$transcode."' 
				AND payment_state='".$state."'
				AND date_added='".$today."'
			  ";
	$checker = mysql_query($theSQL);
if($checker){
	if(mysql_affected_rows() >0){

	return true;
	}else{
	
	return false;	
	}
	

}else{
	
	return false;
}
}


function get_receipt_info_4rmTranscode($transcode){
//get drug code first
	$theSQL = "SELECT drug_codes
				FROM drug2depenseinfo 
				WHERE transcode='".$transcode."'
			  ";
	 $names = mysql_query($theSQL);
if($names){
if(mysql_affected_rows() >0){
while ($getName = mysql_fetch_array($names)) {
	return $getName['drug_codes'];
	//return get_drugs_details_with_code($getName['drug_codes']);
}
}
}

}

function calculateTotalToPay($inv,$cons,$drug,$proce){

	$total = $inv + $cons + $drug + $proce;
	
	return $total;
}

function get_investigation_payment($patient_id){

	global $connection;
$dateAdded = date('Y-m-d');
$state = 0;
$theSQL  ="SELECT transaction_code,amount 
			FROM investigation_payemnt2_cashier 
			WHERE patient_id='".$patient_id."'
			AND date_added='".$dateAdded."'
			AND state='".$state."'
			";
	$theInvestigationPaymentInfo = mysqli_query($connection,$theSQL);

	if(mysqli_affected_rows($connection) >0){
	
			while($thePaymentInfo = mysqli_fetch_array($theInvestigationPaymentInfo)){
		
  return array('transaction_code'=>$thePaymentInfo['transaction_code'],'amount'=>$thePaymentInfo['amount']);
				//put trasaction code for investigation into section

		//$_SESSION['invest_transcode'] =$thePaymentInfo['transaction_code'] ;
		
				 //$thePaymentInfo['amount'];

			}
	}else{
			return 0;
	}


}


function getConsultingPayment($patient_id){
	global $connection;
$state = 0;
$dateAdded = date('Y-m-d');
$theSQL  ="SELECT transaction_code,amount 
			FROM consultingpayment2cashier 
			WHERE patient_id='".$patient_id."'
			AND date_added='".$dateAdded."'
			AND state='".$state."'
			";
	$theConsultPaymentInfo = mysqli_query($connection,$theSQL);

	if(mysqli_affected_rows($connection)){
			while($thePaymentInfo = mysqli_fetch_array($theConsultPaymentInfo)){

				//put trasaction code for investigation into section

		$_SESSION['consult_transcode'] =$thePaymentInfo['transaction_code'] ;
		
				return $thePaymentInfo['amount'];

			}
	}else{
			return 0;
	}


}


function get_drug_payment($patient_id){
	global $connection;
	$run_statement = "SELECT amount,transcode,state FROM drug2depenseinfo WHERE patient_id='".$patient_id."' AND date_added='".date('Y-m-d')."' ";
$theamunt = mysqli_query($connection,$run_statement);
if(mysqli_affected_rows($connection) >0){
while($getAmount = mysqli_fetch_array($theamunt)){

   return $drugamount = array('amount'=>$getAmount['amount'],'transcode'=>$getAmount['transcode']);
}
}else{return 0;}


}



// function getPatientsName($patient_id){
// 	global $connection;

// $theSQL = "SELECT surname,other_names FROM tbl_patient_info WHERE patient_id='".$patient_id."'
//           ";
//       $patientinfo = mysqli_query($connection,$theSQL); 
//       if(mysqli_affected_rows($connection) >0){

//       	while($theSelPatientInfo = mysqli_fetch_array($patientinfo)){
//      return    $theSelPatientInfo['surname'].'&nbsp;'.$theSelPatientInfo['other_names'];

//       	}


//       }  



// }


function getAllReport($staff_id){

// switch($duration){
// case 1: $selDuration ='week'; break;
// case 2: $selDuration ='month';break;
// case 3: $selDuration ='year';break;
// case 4: $selDuration ='day';break;
// }

global $cashiersTotal,$connection;
$cashiersTotal = 0;
$getTotalCollectedBytheCashier = 0;
$date = date("Y-m-d");
//$theSQL ='SELECT *FROM cashier_payment WHERE  date_added > date_sub((SELECT max(date_added) FROM cashier_payment),INTERVAL 1 '.$selDuration.'AND staff_id="'.$staff_id.'" GROUP BY patient_id';
$theSQL ='SELECT transcode,patient_id,date_added FROM cashier_payment WHERE  date_added = "'.$date.'" AND staff_id="'.$staff_id.'"';
$theCashierReport = mysqli_query($connection,$theSQL);
if(mysqli_affected_rows($connection) >0)
{
	while($thereports = mysqli_fetch_array($theCashierReport))
	{

		echo '<tr class="odd gradeX">
			  <td><a   href="#" class="badge badge-primary" style="font-size:13px;">'. getPatientsName($thereports['patient_id']).'<a></td>
				  <td>'.date("F jS, Y", strtotime($thereports['date_added'])) .'</td>
				  <td>'.$thereports['transcode'].'</td>	
				  <td>'.number_format(getAmount($thereports['transcode']),2).'</td>	

			</tr>';
			 
	$getTotalCollectedBytheCashier  +=  getAmount($thereports['transcode']);

	}	
  $cashiersTotal = number_format($getTotalCollectedBytheCashier,2);
}else{
return false;
}

}

function getReportDailyConsultationList(){

	// switch($duration){
	// case 1: $selDuration ='week'; break;
	// case 2: $selDuration ='month';break;
	// case 3: $selDuration ='year';break;
	// case 4: $selDuration ='day';break;
	// }
	
	global $cashiersTotal,$connection;
	$cashiersTotal = 0;
	$getTotalCollectedBytheCashier = 0;
	$state = 1;
	$stuff_id = @$_SESSION['uid']; 
	$date = date("Y-m-d");
	$theSQL ='SELECT patient_id,date_added,amount,item FROM consultingpayment2cashier WHERE  date_added = "'.$date.'" AND cashier_id="'.$stuff_id.'" AND state="'.$state.'" ';
	$theCashierReport = mysqli_query($connection,$theSQL);
	if(mysqli_affected_rows($connection) >0)
	{
		while($thereports = mysqli_fetch_array($theCashierReport))
		{
	
			echo '<tr class="odd gradeX">
				  <td><a   href="#" class="badge badge-primary" style="font-size:13px;">'. getPatientsName($thereports['patient_id']).'<a></td>
					  <td>'.date("F jS, Y", strtotime($thereports['date_added'])) .'</td>
					 
					  <td>'.number_format(($thereports['amount']),2).'</td>	
					   <td>'.$thereports['item'].'</td>	
	
				</tr>';
				 
		//$getTotalCollectedBytheCashier  +=  getAmount($thereports['transcode']);
	
		}	
	//  $cashiersTotal = number_format($getTotalCollectedBytheCashier,2);
	}else{
	return false;
	}
	
	}

	function getReportPendingInvestigationList() {
		global $cashiersTotal, $connection;
		$cashiersTotal = 0;
		$getTotalCollectedBytheCashier = 0;
		$state = 1;
		$stuff_id = @$_SESSION['uid'];
		$date = date("Y-m-d");
		$cashier_view_status = 1;
		$payment_status = 0;
	
		$theSQL = 'SELECT patient_id, requested_date, request_test_name,request_code FROM tbl_req_investigation 
				   WHERE requested_date = "' . $date . '" 
				   AND cashier_view_status = "' . $cashier_view_status . '" 
				   AND payment_status = "' . $payment_status . '"';
		
		$theCashierReport = mysqli_query($connection, $theSQL);
	
		if (mysqli_num_rows($theCashierReport) > 0) {
			while ($thereports = mysqli_fetch_array($theCashierReport)) {
				$patient_id = $thereports['patient_id'];
				$requested_date = $thereports['requested_date'];
				$test_name = $thereports['request_test_name'];
				$patient_name = getPatientsName($patient_id);
				$request_code =  $thereports['request_code']; // define this properly if needed
				$flag = "REVERSE";         // define this properly if needed
				$date_time_stamp = ""; // define this properly if needed
	
				echo '<tr class="odd gradeX">
						<td><a href="#" class="badge badge-primary" style="font-size:13px;">' . $patient_name . '</a></td>
						<td>' . date("F jS, Y", strtotime($requested_date)) . '</td>
						<td>' . $test_name . '</td>
						<td>
							<a 
								onclick="return confirm(\'CLICK OK TO CONFIRM SELECTION OF PATIENT TO CONTINUE ...\')" 
								href="tasks/set_patient_notification.php?patient_id=' . $patient_id . '&request_code=' . $request_code . '&flag=' . $flag . '">
								' . "SEND TO LAB" . ' ' . "" . '
							</a>
						</td>
					  </tr>';
			}
		} else {
			return false;
		}
	}

	function countPendingInvestigations() {
		global $connection;
		$date = date("Y-m-d");
		$cashier_view_status = 1;
		$payment_status = 0;
	
		$sql = 'SELECT COUNT(*) as total FROM tbl_req_investigation 
				WHERE requested_date = "' . $date . '" 
				AND cashier_view_status = "' . $cashier_view_status . '" 
				AND payment_status = "' . $payment_status . '"';
		
		$result = mysqli_query($connection, $sql);
		$row = mysqli_fetch_assoc($result);
		
		return $row['total'];
	}
	
	

		function getReportDailyDrugDispenseList(){

			// switch($duration){
			// case 1: $selDuration ='week'; break;
			// case 2: $selDuration ='month';break;
			// case 3: $selDuration ='year';break;
			// case 4: $selDuration ='day';break;
			// }
			
			global $cashiersTotal,$connection;
			$cashiersTotal = 0;
			$getTotalCollectedBytheCashier = 0;
			$state = 2;
			$stuff_id = @$_SESSION['uid']; 
			$date = date("Y-m-d");
			$theSQL ='SELECT patient_id,date_added,amount,item FROM drug2depenseinfo WHERE  date_added = "'.$date.'" AND cashier_id="'.$stuff_id.'" AND state="'.$state.'" ';
			$theCashierReport = mysqli_query($connection,$theSQL);
			if(mysqli_affected_rows($connection) >0)
			{
				while($thereports = mysqli_fetch_array($theCashierReport))
				{
			
					echo '<tr class="odd gradeX">
						  <td><a   href="#" class="badge badge-primary" style="font-size:13px;">'. getPatientsName($thereports['patient_id']).'<a></td>
							  <td>'.date("F jS, Y", strtotime($thereports['date_added'])) .'</td>
							 
							  <td>'.number_format(($thereports['amount']),2).'</td>	
							   <td>'.$thereports['item'].'</td>	
			
						</tr>';
						 
				//$getTotalCollectedBytheCashier  +=  getAmount($thereports['transcode']);
			
				}	
			//  $cashiersTotal = number_format($getTotalCollectedBytheCashier,2);
			}else{
			return false;
			}
			
			}

function getTotalDrugsAmount($transcode,$duration){

	global $connection;

	$the_statement = "SELECT SUM(amount) FROM drug2depenseinfo WHERE transcode='".$transcode."' ";

$getAmount  = mysqli_query($connection,$the_statement);
if(mysqli_affected_rows($connection) > 0){
while($thePatients = mysqli_fetch_array($getAmount)){
	
	return $thePatients['SUM(amount)'];
}

}else{
return 0;
}

}

function getTotalInvestigatioAmount($transcode,$duration)
{//echo $transcode;die();

	global $connection;

	$the_statement = "SELECT SUM(amount) FROM investigation_payemnt2_cashier WHERE transaction_code='".$transcode."' ";

$getAmount  = mysqli_query($connection,$the_statement);
if(mysqli_affected_rows($connection) > 0){
while($thePatients = mysqli_fetch_array($getAmount)){

	return  $thePatients['SUM(amount)'];
}

}else{
return 0;
}

}

function getConsultingAmount($transcode,$duration){
	global $connection;
	$the_statement = "SELECT SUM(amount) FROM consultingpayment2cashier WHERE transaction_code='".$transcode."' ";
$getAmount  = mysqli_query($connection,$the_statement);
if(mysqli_affected_rows($connection) > 0){
while($thePatients = mysqli_fetch_array($getAmount)){

	return  $thePatients['SUM(amount)'];
}

}else{
return 0;
}
}


function getAmount($transcode){
return getTotalInvestigatioAmount($transcode,"") + getTotalDrugsAmount($transcode,'') + getConsultingAmount($transcode,'');
//return   getConsultingAmount($transcode,'');
}


function get_Patients_investigation_payment4details($date,$patient_id){
global $connection;
$state = 0;
$theSQL  ="SELECT sum(amount) 
			FROM investigation_payemnt2_cashier 
			WHERE patient_id='".$patient_id."'
			AND date_added='".$date."'
			";
	$theInvestigationPaymentInfo = mysqli_query($connection,$theSQL);

	if(mysqli_affected_rows($connection) >0){
	
			while($thePaymentInfo = mysqli_fetch_array($theInvestigationPaymentInfo)){
		
					return   $thePaymentInfo['sum(amount)'];
			}
	}else{
			return 0;
	}


}

function get_Patients_drugs_payment4details($date,$patient_id){
global $connection;
$state = 0;
$theSQL  ="SELECT sum(amount)
			FROM drug2depenseinfo 
			WHERE patient_id='".$patient_id."'
			AND date_added='".$date."'
			";
	$theDrugsPaymentInfo = mysqli_query($connection,$theSQL);

	if(mysqli_affected_rows($connection) >0){
	
			while($thePaymentInfo = mysqli_fetch_array($theDrugsPaymentInfo)){
		
					return   $thePaymentInfo['sum(amount)'];
			}
	}else{
			return 0;
	}


}

function getReportDailyInvestigationList(){

	// switch($duration){
	// case 1: $selDuration ='week'; break;
	// case 2: $selDuration ='month';break;
	// case 3: $selDuration ='year';break;
	// case 4: $selDuration ='day';break;
	// }
	
	global $cashiersTotal,$connection;
	$cashiersTotal = 0;
	$getTotalCollectedBytheCashier = 0;
	$state = 1;
	$stuff_id = @$_SESSION['uid']; 
	$date = date("Y-m-d");
	$theSQL ='SELECT patient_id,date_added,amount,item FROM investigation_payemnt2_cashier WHERE  date_added = "'.$date.'" AND cashier_id="'.$stuff_id.'" AND state="'.$state.'" ';
	$theCashierReport = mysqli_query($connection,$theSQL);
	if(mysqli_affected_rows($connection) >0)
	{
		while($thereports = mysqli_fetch_array($theCashierReport))
		{
	
			echo '<tr class="odd gradeX">
				  <td><a   href="#" class="badge badge-primary" style="font-size:13px;">'. getPatientsName($thereports['patient_id']).'<a></td>
					  <td>'.date("F jS, Y", strtotime($thereports['date_added'])) .'</td>
					 
					  <td>'.number_format(($thereports['amount']),2).'</td>	
					   <td>'.$thereports['item'].'</td>	
	
				</tr>';
				 
		//$getTotalCollectedBytheCashier  +=  getAmount($thereports['transcode']);
	
		}	
	//  $cashiersTotal = number_format($getTotalCollectedBytheCashier,2);
	}else{
	return false;
	}
	
	}

function get_Patients_consulting_payment4details($date,$patient_id){
global $connection;
$state = 0;
$theSQL  ="SELECT sum(amount) 
			FROM consultingpayment2cashier 
			WHERE patient_id='".$patient_id."'
			AND date_added='".$date."'
			";
	$theconsultingPaymentInfo = mysqli_query($connection,$theSQL);

	if(mysqli_affected_rows($connection) >0){
	
			while($thePaymentInfo = mysqli_fetch_array($theconsultingPaymentInfo)){
		
					return   $thePaymentInfo['sum(amount)'];
			}
	}else{
			return 0;
	}
}


//NOTIFICATIONS FOR CASHIER



function total_notification_waiting_consulting_patients_from_opd(){
	global $connection;
	$date = date('Y-m-d');
	//$user = $_SESSION['uid'];
	$sql = "SELECT COUNT(id) as total_notification_waiting_consulting_patients_from_opd FROM `consultingpayment2cashier` WHERE date_added = '".$date."' AND cashier_view_state = '0' AND state = '0' ";
	$query_run = mysqli_query($connection,$sql);
	$rows = mysqli_fetch_assoc($query_run);
	$count = $rows['total_notification_waiting_consulting_patients_from_opd'];

	return $count;
	
}


function list_total_notification_waiting_consulting_patients_from_opd(){

	global $connection;

	$date = date('Y-m-d');
	//$user = $_SESSION['uid'];
	$sql = "SELECT patient_id,date_added FROM `consultingpayment2cashier` WHERE date_added = '".$date."' AND cashier_view_state = '0' AND state = '0'  ";
	
	if($query_run=mysqli_query($connection,$sql)){

	if(mysqli_num_rows($query_run) > 0){
	
	while($row = mysqli_fetch_array($query_run) ){

		//$date_time_stamp = time_passed($row['date_added']);

		$patient_name = patient_name($row['patient_id']);
 		
		echo" 						 

				<li>  <a onclick='return confirm(\"CLICK OK TO CONFIRM SELECTION OF PATIENT TO CONTINUE CONSULTATION...\")'  href='tasks/set_patient_details.php?patient_id=".$row['patient_id']."'>" 
				. $patient_name ." "." ". "</a>   </li> <li class='divider'></li>		 
			 
		";
		
	}}else{

		echo "";
	}

} else{
	echo "string ".mysqli_error();
}
}

function update_notification_waiting_consulting_patients_from_opd($patient_id){
	global $connection;
	$viewed_state = 1;
	//$user_id = $_SESSION['uid'];
	//$date = date('Y-m-d H:i:s');
	$sql="UPDATE consultingpayment2cashier SET cashier_view_state = '".$viewed_state."' WHERE patient_id = '".$patient_id."' ";
	if(mysqli_query($connection,$sql) or die(mysqli_error())){
		return TRUE;
	} else {
		return FALSE;
	}
}


//LAB REQUEST NOTIFICATIONS

function total_notification_waiting_patients_lab_fromDoctor(){
	global $connection;
	$date = date('Y-m-d');
//	$user = $_SESSION['uid'];
	$sql = "SELECT COUNT(id) as total_notification_waiting_patients_lab_fromDoctor FROM `tbl_req_investigation` WHERE requested_date = '".$date."' AND status = '0' 
    AND payment_status = '0' AND cashier_view_status = '0' ";
	$query_run = mysqli_query($connection,$sql);
	$rows = mysqli_fetch_assoc($query_run);
	$count = $rows['total_notification_waiting_patients_lab_fromDoctor'];

	return $count;
	
}

function list_total_notification_waiting_patients_lab_fromDoctor(){

	global $connection;

	$date = date('Y-m-d');
	//$user = $_SESSION['uid'];
	$sql = "SELECT patient_id,date_sent_ago,request_code,request_test_name FROM `tbl_req_investigation` WHERE requested_date = '".$date."' AND status = '0'
     AND payment_status = '0' AND cashier_view_status = '0' ";
	
	if($query_run=mysqli_query($connection,$sql)){

	if(mysqli_num_rows($query_run) > 0){
	
	while($row = mysqli_fetch_array($query_run) ){

		$date_time_stamp = time_passed($row['date_sent_ago']);

		$patient_name = patient_name($row['patient_id']);

        $request_code = $row['request_code'];

        $requested_lab_test = $row['request_test_name'];

		$flag = "DOCTOR_TO_CASH";

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
                 href='tasks/set_patient_details.php?patient_id=".$row['patient_id']."&request_code=".$request_code."&flag=".$flag." '>" 
				. $patient_name .", About "."$date_time_stamp". "</a>   </li> <li class='divider'></li>
				 		 	 
		";
		
	}}else{

		echo "";
	}

} else{
	echo "string ".mysqli_error();
}
}


function update_notification_waiting_patients_cashier_view($patient_id,$request_code){
	global $connection;
	$viewed_state = 1;
	$user_id = $_SESSION['uid'];
	//$date = date('Y-m-d H:i:s');
	$sql="UPDATE tbl_req_investigation SET  cashier_view_status = '".$viewed_state."', cashier_view_by = '".$user_id."'  WHERE patient_id = '".$patient_id."' AND 
    request_code = '".$request_code."' ";
	if(mysqli_query($connection,$sql) or die(mysqli_error())){
		return TRUE;
	} else {
		return FALSE;
	}
}

function update_notification_reverse($patient_id,$request_code){
	global $connection;
	$viewed_state = 1;
	$payment_status = 1;
	$user_id = $_SESSION['uid'];
	//$date = date('Y-m-d H:i:s');
	$sql="UPDATE tbl_req_investigation SET payment_status = '".$payment_status."'  WHERE patient_id = '".$patient_id."' AND 
    request_code = '".$request_code."' ";
	if(mysqli_query($connection,$sql) or die(mysqli_error())){
		return TRUE;
	} else {
		return FALSE;
	}
}


function list_total_notification_waiting_patients_drug2depenseinfo(){

	global $connection;

	$date = date('Y-m-d');
	//$user = $_SESSION['uid'];
	$sql = "SELECT patient_id FROM `drug2depenseinfo` WHERE date_added = '".$date."' AND state = '1' AND cash_view_pharma = '0' ";
	
	if($query_run=mysqli_query($connection,$sql)){

	if(mysqli_num_rows($query_run) > 0){
	
	while($row = mysqli_fetch_array($query_run) ){

		//$date_time_stamp = time_passed($row['date_sent_ago']);

		$patient_name = patient_name($row['patient_id']);

        $request_code = "PHARMA_TO_CASH";

		echo" <li>  <a onclick='return confirm(\"CLICK OK TO CONFIRM SELECTION OF PATIENT TO CONTINUE ...\")' 
                 href='tasks/set_patient_details.php?patient_id=".$row['patient_id']."&flag=".$request_code." '>" 
				. $patient_name ." "."". "</a>   </li> <li class='divider'></li> ";
		
	}}else{

		echo "";
	}

} else{
	echo "string ".mysqli_error();
}
}


function total_notification_waiting_patients_drug2depenseinfo(){
	global $connection;
	$date = date('Y-m-d');
//	$user = $_SESSION['uid'];
	$sql = "SELECT COUNT(id) as total_notification_waiting_patients_drug2depenseinfo FROM `drug2depenseinfo`
	 WHERE date_added = '".$date."' AND state = '1' AND cash_view_pharma = '0' ";
	$query_run = mysqli_query($connection,$sql);
	$rows = mysqli_fetch_assoc($query_run);
	$count = $rows['total_notification_waiting_patients_drug2depenseinfo'];
	return $count;
}


function update_notification_waiting_patients_drug2depenseinfo($patient_id){
	global $connection;
	$viewed_state = 1;
	$user_id = $_SESSION['uid'];
	$date = date('Y-m-d');
	$sql="UPDATE drug2depenseinfo SET cash_view_pharma = '".$viewed_state."' WHERE patient_id = '".$patient_id."' AND state = '1' AND date_added = '".$date."' ";
	if(mysqli_query($connection,$sql) or die(mysqli_error())){
		return TRUE;
	} else {
		return FALSE;
	}
}



?>