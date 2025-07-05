<?php

require_once 'conndb.php';
require_once 'func_common.php';
require_once 'func_constant.php';



//add new drugs to system

function add_drug($drug_name,$expdate,$qty,$type,$price,$reorderlevel,$product_code,$manu){

	global $connection;
	//generate drugcode not product code
	$drug_code = get_transcode();
	$state = 0;
	
	//add_drug($drug_code,$drug_name,$expdate,$qty,$type,$price,$reorderlevel,product_code);
	$sql="INSERT INTO tbl_drug_list (drug_code,Name,Expiry_date,quantity,type,price,reorderlevel,product_code,date_added,state,manu)
	VALUES ('".$drug_code."','".$drug_name."','".$expdate."','".$qty."','".$type."','".$price."','".$reorderlevel."','".$product_code."','".date('Y-m-d')."','".$state."','".$manu."')";
	
	mysqli_query($connection,$sql);
	
	
}

function add_drug_csv($names){

	global $connection; 
	
	$sql="INSERT INTO tbl_drug_list (Name)
	VALUES ('".$name."')";
	
	mysqli_query($connection,$sql);
	
	
}

//function to get prescribed drug to a particular patient

function NHIS_State($drug_code){

	global $connection;

$theSql = "SELECT NHIS FROM tbl_drug_list WHERE drug_code='".$drug_code."'";
	$theSch = mysqli_query($connection,$theSql);
	
	if(!empty($theSch)){
		$record = $theSch->fetch_assoc();

		$nhis = $record['NHIS'];

		return $nhis;
			//while($theDrugSch=mysqli_fetch_array($theSch)){
            //return $theDrugSch['NHIS'];

        
	}else{
		return false;
	}

}


function isNHIS($patient_id)
{
    global $connection;
$nhis = 'nhis';
$private = 'Private';
  $query = "SELECT scheme FROM scheme WHERE patient_id='".$patient_id."' AND  scheme='".$nhis."' OR scheme='".$private."'  LIMIT 0,1 ";
  $query_results = mysqli_query($connection,$query);
  if(mysqli_num_rows($query_results) >0){
  return true;//patient is nhis
  }else{
  return false;//patient is not
  }
}





function getDrugPrices($drug_code){

	global $connection;

	//get the price of the drug from the drug table
	$theSql = "SELECT price FROM tbl_drug_list WHERE drug_code='".$drug_code."'";
	$thePrice = mysqli_query($connection,$theSql);
	
	if(!empty($thePrice)){
			while($theDrugPrice=mysqli_fetch_array($thePrice)){

	//check wheather the drug is covered by a scheme or not
				//if it return 1 = NHIS
				//if it return 2 = momentum
				//if it return 0 = none

	//check if not out off stock
	          if(checkifNotOutofStock($drug_code) == true){

	          	if(NHIS_State($drug_code)  == 1){
					return 1;
		}else{
					return $theDrugPrice['price']; 
				}

	          }else{
	          	 return 'OUTSK';

	          }			
				
            

        }
	}else{
		return false;
	}


}


function getDrugName($drug_code){
	global $connection;
	$theSql = "SELECT name FROM tbl_drug_list WHERE drug_code='".$drug_code."'";
	$theName = mysqli_query($connection,$theSql);
	
	if(!empty($theName)){

		$records = $theName->fetch_assoc();

		$drugName = $records['name'];

		return $drugName;
			//while($theDrugName=mysql_fetch_array($theName)){
            //return $theDrugName['name']; }
	}else{
		return false;
	}

}


function removeDrug(){


}

function checkifNotOutofStock($drugcode){

	global $connection;

$theSql = "SELECT quantity FROM tbl_drug_list WHERE drug_code='".$drugcode."'";
	$outoffstock = mysqli_query($connection,$theSql);

	$get_quantity = $outoffstock->fetch_assoc();

	$data_quantity = $get_quantity['quantity'];

	if($data_quantity == 0 or $data_quantity < 0 ){
		return false;
	}else{
		return true;
	}
		// while($see=mysqli_fetch_array($outoffstock)){

		// 	if($see['quantity']  == 0 or $see['quantity']  <0 ){

		// 		return false;//drug is out of stock
		// 	}else{
		// 		return true;//drug is avaliable 
		// 	}
			
		// }

}


function checkifUserHasPaid($patientID){
	global $connection;
$the_state = 2;
	$theSQL = "SELECT state FROM drug2depenseinfo WHERE
			   state='".$the_state."'
			   AND patient_id = '".$patientID."'
			   AND date_added='".date('Y-m-d')."'	
			  ";
		$updates = mysqli_query($connection,$theSQL);	  
			  if(mysqli_affected_rows($connection) >0 ){
			  	return true;
			  }else{
			  	return false;
			  }

}

function checkifAlreadyDespensed($drugcode, $patientID)
{
    global $connection;

    $theSQL = "SELECT id FROM despensed_drugs 
               WHERE patient_id = '$patientID' 
               AND drug_code = '$drugcode' 
               AND date_added = '" . date('Y-m-d') . "'";

    $query_run = mysqli_query($connection, $theSQL);

    if (mysqli_num_rows($query_run) > 0) {
        return true; // Already dispensed
    } else {
        return false; // Not yet dispensed
    }
}





function getPatientsDrugs($patientID){
global $theDrugQty,$connection;
$_SESSION['hideButton'] = 1;

	$CurrentDate =date('Y-m-d');
	$state = 2;

	if (isNHIS($patientID)) {
		// Fetch all drug codes for the patient
		$sql = "SELECT drug_codes,quantity FROM drug2depenseinfo 
				WHERE patient_id = '$patientID' 
				AND date_added = '$CurrentDate' 
				AND state = '$state'";
	
		$query_run = mysqli_query($connection, $sql);
	
		while ($see = mysqli_fetch_array($query_run)) {
			$drug_code = $see['drug_codes'];
			$quantity = $see['quantity'];
	
			// Check if not already dispensed
			//if (!checkifAlreadyDespensed($drug_code, $patientID)) {
	
				// Get the drug name
				$name_query = "SELECT Name FROM tbl_drug_list WHERE drug_code = '$drug_code'";
				$name_result = mysqli_query($connection, $name_query);
	
				if ($name = mysqli_fetch_assoc($name_result)) {
					echo "<tr>";
					echo "<td style='width:75%'>{$name['Name']}</td>";
					echo "<td style='width:25%'>
							<a onclick='return confirm(\"CLICK OK TO CONFIRM ACTION...\")' 
							href='tasks/despenseDrug.php?drugcode={$drug_code}&qty={$quantity}' 
							class='btn btn-primary'>Dispense Drug</a>
						  </td>";
					echo "</tr>";
				}
			//}
		}
	}
	else{
$sql="SELECT drug_codes,quantity FROM drug2depenseinfo WHERE patient_id=
	'".$patientID."'AND date_added='".$CurrentDate."' AND state='".$state."' ";
	$query_run = mysqli_query($connection,$sql);
	while($see=mysqli_fetch_array($query_run)){ 


$theCode = explode(',', $see['drug_codes']);
$quantity = explode(',', $see['quantity']);

$theSizeOfCode = sizeof($theCode);
for($i=0; $i < $theSizeOfCode;$i++){

	//check if already dispensed
	if(checkifAlreadyDespensed($theCode[$i],$patientID) == false){
$sql="SELECT Name FROM tbl_drug_list WHERE drug_code='".$theCode[$i]."'";
		$query_run = mysqli_query($connection,$sql);
	while($name=mysqli_fetch_array($query_run)){

echo "<tr>
<td style='width:75%'>".$name['Name']."</td>";
echo "<td style='width:25%'><a <a onclick='return confirm(\"CLICK OK TO CONFIRM ACTION...\")' href='tasks/despenseDrug.php?drugcode=".$theCode[$i]."&qty=".$quantity[$i]."' class='btn btn-primary'>Dispense Drug</a></td>";
echo "<tr>";
				
}
}
}
}
	}

}


// function cal_quantity($v1,$v2,$v3,$v4,$v5){

// $TotalTQ =0;
// $TotalDosege =0;

// if($v3 =='Hourly'){
  
// $TotalDosege =$v1 * $v2 * $v4; 

// }elseif($v3 =='Daily'){
//   $TotalDosege = $v1 * $v2 * $v4; 
  
// }elseif($v3 =='Weekly'){
// $TotalDosege =$v2 *$v4; 
// }elseif($v3 =='Yearly'){
//  $TotalDosege = $v1 * $v2 * $v4; 
// }elseif($v3 =='Monthly'){
//  $TotalDosege = $v1 * $v2 *$v4; 
// }


// if($v5 =='Day(s)'){
// $ts=1; 
// }elseif($v5 =='Week(s)'){
// $ts = 7; 
// }elseif($v5 =='Month(s)'){
// $ts = 30; 
// }elseif($v5 =='Year(s)'){
// $ts = 365; 
// }

//  $TotalTQ = $TotalDosege * $ts;   

//  return $TotalTQ;



// }


function gettotalPrice($price,$quantiy){

$getTotal = 0;
if($price == 'free'){
$getTotal = 0.00;
}else{
$getTotal = $price * $quantiy;
}
	return $getTotal;

}



function get_prescribtion($patientID){


global $totalHolder,$get_drugcodes,$hideButton,$qty,$connection;
		   $totalHolder = 0;
		   $get_drugcodes = 0;
		    $CurrentDate = date('Y-m-d');
	//unset($_SESSION['emptyTableIndicator']); //unset the error container


if(checkifUserHasPaid($patientID) ==true){ 
//put depense code here
//hide some buttons when on this conditions
	$_SESSION['hideButton'] = 1;
	$hideButton = $_SESSION['hideButton'];

//display drag to dispense
	 getPatientsDrugs($patientID);
	  
 
}else{
	$_SESSION['hideButton'] = 0;
//kill button hide
	//unset($_SESSION['hideButton']);
	
$state =0;
	$sql="SELECT * FROM tbl_precribtion WHERE patient_id='".$patientID."' AND DATE(date_added) ='".$CurrentDate."'  ";
	
	$query_run = mysqli_query($connection,$sql);
	if(mysqli_affected_rows($connection) >0){ 

//unset the table censorer
	unset($_SESSION['hidethetbl']);

	while($see=mysqli_fetch_array($query_run)){ 

		if(getDrugPrices($see['drug_code'])==1){
			$message = "<i style='color:red'>(NHIS COVER.)</i>";
		}else{
			$message = "";
		}

		if($see['time_interval']=="START"||$see['time_interval']=="STAT"){
			$label_dosage = $see['quantity'].$see['strength']." X ".$see['times']." ".$see['rate']."
		 ".$see['time_interval']."(s) ";
		}else{
			$label_dosage = $see['quantity'].$see['strength']." X ".$see['times']." ".$see['rate']."
		 ".$see['time_interval']."(s)&nbsp; For ".$see['duration']."&nbsp;".$see['time_span'];
		}
	
echo"<tr  class='checked_drug'>
<td style='font-size:15px; '><span class='label label-primary'>".getDrugName($see['drug_code'])."</span></td>
       
        

		<td><strong class='badge badge-success'>".$label_dosage."</strong></td>";

		 $qty = 0;

		 if($see['drug_qty']==""){
			$qty =  cal_quantity($see['quantity'],$see['times'],$see['time_interval'],$see['duration'],$see['time_span']);
		 }else{
		$qty =  $see['drug_qty'];
		 }
		 
		

		echo" <td id='".$see['drug_code']."' class='text-center'>".$qty."</td>
<td id='".getDrugPrices($see['drug_code'])."'class='".$see['drug_code']." ' style='font-size:15px;width:10%;text-align:center'>".getDrugPrices($see['drug_code'])." "." $message"."</td>";

if(getDrugPrices($see['drug_code']) != "OUTSK"){
	$the_total = getDrugPrices($see['drug_code']) * $qty;
	$_SESSION['total_amount_check'] = $the_total;
}else{
	$the_total = 0;
	$_SESSION['total_amount_check'] = $the_total;
}


echo "<td id='".$the_total."'  style='font-size:15px;text-align:center'>".$the_total."</td>";

echo "<td id='".""."'  style='font-size:15px;text-align:center'>".$see['pres_comment']."</td>";

echo '<td>';

if(checkIfoutOfStock($see['drug_code']) == false){

echo "<td>
      
	   <input  style='display:none' type='text' name='checked_drug[]' class='code' value='".$see['drug_code']."' id='".$see['drug_code']."'>
	   
	   </td>";
echo "<td><input  class='".$see['drug_code']."' style='display:none' type='number' name='selqty[]' readonly value='".$qty."' id='".$see['drug_code']."'>
  <input  class='".$see['drug_code']."' style='display:none' type='number' name='remainqty[]' value='' id='".$see['drug_code']."'>
	   </td>";
//echo "<input checked id='".$the_total."' class='walter icheck' type='checkbox' name='checked_drug[]' value='".$see['drug_code']."' />";      
}


echo "</tr>";

  //remove NHIA drugs out

           $totalHolder += $the_total;
           //$get_drugcodes .= $see['drug_code'].',';
	}
}else{
//show message that no prescribption for user
	$_SESSION['hidethetbl'] = 1;
}
} }




function checkIfoutOfStock($drugcode){
	global $connection;
	$thedrugcodes = array();
	$checker = 0;
	//return type is true: meaning the quantity available is either 
	//less than or is equal to zero
	//so hide check box 
$theSQL  ='SELECT quantity,drug_code FROM tbl_drug_list WHERE drug_code="'.$drugcode.'" ';
		 $thequanty= mysqli_query($connection,$theSQL);
		 if(mysqli_affected_rows($connection) >0){
      while($theTotalQant= mysqli_fetch_array($thequanty))
      {
      	if($theTotalQant['quantity'] <= 0 ){
      //set the outof stock incase we need to print the drugs
      		$thedrugcodes[] = $theTotalQant['drug_code'];
               //set Out of stock drugs
			  $_SESSION['outOfStockDrugs'] = $theTotalQant['drug_code'];
      }else{

      		return false;
      	}
      	
      }


       $_SESSION['drug_codeOutofStock'] = $thedrugcodes;
            return true;


		 }else{

		 	return false;
		 }

}


function calculateDrug($drugcode){
	global $connection;
//get the price of the drug from the drug table
	$theSql = "SELECT price,NHIS,quantity FROM tbl_drug_list WHERE drug_code='".$drugcode."'";
	$thePrice = mysqli_query($connection,$theSql);
		while($see=mysqli_fetch_array($thePrice)){
			//check if not out of stock
if(checkifNotOutofStock($drugcode) == true){

	if($see['NHIS']  ==1){

				return 0;
			}else{
				return $see['price']; 
			}

}else{

	return 0;
}
			
			
		}


}




function get_requesting_doctor($doc_id){

	global $connection;
	
$sql="SELECT * FROM tbl_staff WHERE staff_id='".$doc_id."'";
$query_run = mysqli_query($connection,$sql);
	while($see=mysqli_fetch_array($query_run)){

		$_SESSION['fname']=$see['firstName'];
		$_SESSION['oname']=$see['otherNames'];
		

	}
}

function get_drug_id(){//function to get all National IDs in the hospital
	
	$sql = "SELECT drug_code FROM tbl_drug_list";
	$query_run = mysql_query($sql);
	while($result=mysql_fetch_array($query_run)){
		
		echo "<option value=".$result['drug_code'].">".$result['drug_code']."</option>";
	}
}
function get_drug_name(){//function to get all National IDs in the hospital
	
	$sql = "SELECT Name FROM tbl_drug_list";
	$query_run = mysql_query($sql);
	while($result=mysql_fetch_array($query_run)){
		
		echo "<option value=".$result['Name'].">".$result['Name']."</option>";
	}
}

function nhis_drug_update($a){
	if($a==0){
		$_SESSION['nhis_yes']="Checked=''";
		$_SESSION['nhis_no']="";
	}
	if($a==1){
		$_SESSION['nhis_no']="Checked=''";
		$_SESSION['nhis_yes']="";
	}
}

function get_claim_code() {
	global $connection;
	 

	$query = "SELECT claim_code FROM tbl_claim_tracker WHERE  deleted = 'NO' AND claim_status = 'PENDING' ORDER BY id DESC LIMIT 1";


	$query_results = mysqli_query($connection, $query);
 

	if ($row = mysqli_fetch_assoc($query_results)) {
		return $row['claim_code'];
	} else {
		return NULL;
	}
}



/*function get_transcode(){

return 'mer';

}
*/
function sendCashier($uid,$patient_id,$seldrugcodes,$totalcost,$qty){

	global $connection;

 $theTrans= get_transcode();
 $get_claim_code = get_claim_code();
 $state = "";
 $insurance_patient_scheme =isNHIS($patient_id);
 if($insurance_patient_scheme){
	$state = 2;
	$theSql = "INSERT INTO drug2depenseinfo
	(patient_id,staff_id,drug_codes,amount,transcode,date_added,state,quantity,claim_code)
	VALUES
	('".$patient_id."','".$uid."',
	'".$seldrugcodes."','".$totalcost."','".$theTrans."','".date('Y-m-d')."',
	'".$state."','".$qty."','".$get_claim_code."'
	)";	 
 }else{

	$state = 1;
	$theSql = "INSERT INTO drug2depenseinfo
	(patient_id,staff_id,drug_codes,amount,transcode,date_added,state,quantity)
	VALUES
	('".$patient_id."','".$uid."',
	'".$seldrugcodes."','".$totalcost."','".$theTrans."','".date('Y-m-d')."',
	'".$state."','".$qty."'
	)";
 }
	//submit the db

   $theresults = mysqli_query($connection,$theSql);
 
      if($theresults){

//update the state in the transaction table
      	//state one means pending
      	if(update_prescriptionState($state,$patient_id) == true){
  			
      		return TRUE;

      	}else{
      		return FALSE;
      	}

      	
      } else{
      	return FALSE;
      }
}

function get_transcode($length=8) {
 $string = 0;
   /* Only select from letters and numbers that are readable - no 0 or O etc..*/
   $characters = "23456789ABCDEFHJKLMNPRTVWXYZ";
 
   for ($p = 0; $p < $length; $p++) 
   {
       $string .= $characters[mt_rand(0, strlen($characters)-1)];
   }
 
   return $string;
 }


 function update_prescriptionState($state,$patient_id){

	global $connection;
 	$today = date('Y-m-d');
 	$theSql = "UPDATE tbl_precribtion  SET
 				   	state='".$state."'
 			WHERE patient_id='".$patient_id."'
 			AND date_added ='".$today."'  	   		
 		   ";
 	 $theresults = mysqli_query($connection,$theSql);

      if($theresults){

      	return TRUE;
      } else{
      	return FALSE;
      }


 }

 function pharmActionButton($patient_id){
	 global $connection;
 	//determine which button to show
 	//get the prescribption state
 	$today = date('Y-m-d');
 	$theSql = "SELECT state 
 			   FROM drug2depenseinfo  
 			   WHERE patient_id='".$patient_id."'
 			   AND date_added ='".$today."'  	   		
 		   ";
 	 $theresults = mysqli_query($connection,$theSql);
 	 if($theresults){
 	 if(mysqli_affected_rows($connection)){

 	 while($pre_state=mysqli_fetch_array($theresults)){

 	 	if($pre_state['state'] ==1){
//echo "<button style='float:right;' disabled class='btn btn-primary'><i class='fa fa-asterisk'>&nbsp;Pendding</i></button>";

							echo '<div class="progress progress-striped active" style="width:40%;">
								  <div class="progress-bar progress-bar-success" style="width: 100%;font-size:15px;">Patient Drug Is Being Processed For Dispense...</div>
								  </div>
								';
return;
 	 	}elseif($pre_state['state'] ==2){
echo "<button style='float:right;' disabled class='btn btn-primary'>Dispensed</button>";
return;
 	 	}else{
echo "<input type='submit' name='SendToCashier'disabled value='Send To Cashier' style='float:right;' class='btn btn-primary senddata'>";
return; 
 	 	}
			}
}else{
echo "<input type='submit' name='SendToCashier' disabled  value='Send To Cashier' style='float:right;' class='btn btn-primary senddata'>";


}

}else{
echo "<input type='submit' name='SendToCashier'disabled  value='Send To Cashier' style='float:right;' class='btn btn-primary'>";


}
 
}


function joinSelectedDrugCodes($checked_drug){
	$theJoinedCodes = implode(',',$checked_drug);
	return $theJoinedCodes;

}


function add_to_depense_db($staff_id,$patient_id,$drugcode,$qty){
	global $connection;
$theQsl = "INSERT INTO despensed_drugs
			(patient_id,staff_id,drug_code,date_added,quantity)
				VALUES
			('".$patient_id."','".$staff_id."','".$drugcode."','".date('Y-m-d')."','".$qty."')
		  ";
		  $afterInsertion  =mysqli_query($connection,$theQsl);
		  if(mysqli_affected_rows($connection)){
		  	return true;
		  }else{
		  	return false;
		  }


}

function getTheCurrentValue($drugcode){

	global $connection;

$query = "SELECT quantity FROM tbl_drug_list WHERE drug_code='".$drugcode."' ";
$getQuantity  = mysqli_query($connection,$query);

if(mysqli_affected_rows($connection) >0){

	$rows_quantity = $getQuantity->fetch_assoc();

	$got_quantity = $rows_quantity['quantity'];

	return $got_quantity;
	// while ($thequantity = mysql_fetch_array($getQuantity) ){
	// 	return  $thequantity['quantity'];
	// }
}
}

function UpdateDrugQuantity($drugcode,$qty)
{

	global $connection;

//get the current quantity 
//and do the substraction
$date = date('Y-m-d H:i:s');
	 $theValue = getTheCurrentValue($drugcode);
	 //if is zero dont subsrtack
	 if($theValue == 0 || empty($theValue)){
$value_after_cal = 0;
	 }else{
$value_after_cal = $theValue - $qty;//substrack one from the intial val
}
	$theSQL = "UPDATE tbl_drug_list 
			   SET quantity=".$value_after_cal."
			   WHERE drug_code='".$drugcode."'
			   ";
		$afterInsertion  =mysqli_query($connection,$theSQL);
		  if(mysqli_affected_rows($connection)){
		  	return true;
		  }else{
		  	return false;
		  }

}

function getTimeRemainingToExpire($thedate){

//check if expired
	 $today = strtotime(date('Y-m-d'));
	 $date = strtotime($thedate);


	if($thedate == $today or $date  < $today){
return '<strong style="color:red;">Expired</strong>';

	}else{


		$remaining = $date - time();

		//$remaining will be the number of seconds remaining. Then you can divide that number to get the number of days, hours, minutes, etc.
		$days_remaining = floor($remaining / 86400);
		//$hours_remaining = floor(($remaining % 86400) / 3600);
		return 	$days_remaining .'&nbsp;Days left' ;
	}

}



function getAllavailableDrugs(){
	global $connection;
$theSQL = "SELECT Name,quantity,price,Expiry_date,drug_code,reorderlevel FROM tbl_drug_list WHERE state = 0";
$thedrugs = mysqli_query($connection,$theSQL);
if(mysqli_affected_rows($connection) >0){
    while($allthedrugs  =mysqli_fetch_array($thedrugs)){

   $drug_code = $allthedrugs['drug_code'];
   $reorderlevel =  $allthedrugs['reorderlevel'];
   $quantity = $allthedrugs['quantity'];
   $flag = "";
   if($quantity <= $reorderlevel){
	 $flag = "Yes";
   }else{
	$flag = "No";
   }

	 

  echo "<tr class=''>
		<td>".$allthedrugs["Name"]."</td>
		<td>".$allthedrugs["quantity"]."</td>
		<td>".$flag."</td>
		<td>".number_format($allthedrugs["price"],2)."</td>
		  
		 
 	    <td>".getTimeRemainingToExpire($allthedrugs["Expiry_date"])."</td>
	   
		
			<td>
<a onclick='return confirm(\"CLICK OK TO CONFIRM DELETION OR CANCEL TO PREVENT DELETION...\")' href='tasks/deleteDrugs.php?code=$drug_code' type='button' class='btn btn-danger'><i class='fa fa-trash-o'></i></a>
<a href='edit_drugs.php?code=$drug_code' type='button' class='btn btn-success'><i class='fa fa-edit'></i></a>
<a href='topup_drugs.php?code=$drug_code' type='button' class='btn btn-primary'><i class='fa fa-plus'></i></a>
			</td>
		</tr>";




    }

}else{
	return false;
}

								
}



function deleteDrug($drug_code){
	global $connection;
$theSQL = "UPDATE  tbl_drug_list SET state = 1 WHERE drug_code='".$drug_code."'
          ";
          mysqli_query($connection,$theSQL);
          if(mysqli_affected_rows($connection) >0){
            return true;

          }else{

          	return false;

          }

}



function getDrugToEdit($drugcode){

	global $connection;

$theSQL = "SELECT * FROM tbl_drug_list WHERE drug_code='".$drugcode."'
		  ";
		   $thedrugs = mysqli_query($connection,$theSQL);
		   if(mysqli_affected_rows($connection) >0){
		   	while($thedrugdata = mysqli_fetch_array($thedrugs)){
           


    echo '<div class="form-group">
              <label>Drug Code</label> <input value="'.$thedrugdata['product_code'].'" placeholder="Drug code" name="dcode" class="form-control" type="text">
            </div>
            <input type="hidden" name="drugcode" value="'.$thedrugdata['drug_code'].'">
            <div class="form-group"> 
              <label>Name</label> <input value="'.$thedrugdata['Name'].'" placeholder="Drug Name" class="form-control" name="dname" required="" type="text">
            </div> 
            <div class="form-group">
                 
                             
             
                <div class="form-group">
                  <label class="control-label">Expiry Date</label>
                 
                    <input type="date" value="'.$thedrugdata['Expiry_date'].'" class="form-control" name="expdate">
                  </div>
                 
                 <div class="form-group">
                  <label class="control-label">Quantity</label>
                   <input type="number" value="'.$thedrugdata['quantity'].'" name="qty" class="form-control" placeholder="Quantity">
                 
                </div>
                 <div class="form-group">
                  <label class="control-label">Cost</label>
                   <input type="text" name="price" value="'.$thedrugdata['price'].'" class="form-control" placeholder="GHs">
                 
                </div>
                <div class="form-group">
                 
                    <label>Drug Type</label>
                    
                    <select class="form-control" name="type" required="">
                       <optgroup label="type">
                       <option value="'.$thedrugdata['type'].'">'.$thedrugdata['type'].'</option>
                       		<option value="null" disabled="">select type</option>
                           <option value="tablets">Tablets</option>
                           <option value="amples">Amples</option>
                           <option value="capsules">Capsules</option>
                           <option value="sachets">Sachets</option>       
                           <option value="syrups">Syrups</option>
                           <option value="suppositories">Suppositories</option>
                           <option value="grams">Grams</option>
                           <option value="vial">Vial</option>
                           <option value="tubes">Tubes</option>
                        
                        
                       </optgroup>
                    </select>
                  </div> 
				  
				  <div class="form-group">
                  <label class="control-label">Manufacturer</label>
                   <input type="text" name="manu" value="'.$thedrugdata['manu'].'" class="form-control" placeholder="Manufacturer">
                 
                </div>
				 
				  ';
                   }
             }else{

header('Location:update_drug.php'); die();

             }
}

function getDrugToUp($drugcode){

	global $connection;

$theSQL = "SELECT * FROM tbl_drug_list WHERE drug_code='".$drugcode."'
		  ";
		   $thedrugs = mysqli_query($connection,$theSQL);
		   if(mysqli_affected_rows($connection) >0){
		   	while($thedrugdata = mysqli_fetch_array($thedrugs)){
           


    echo '<div class="form-group">
            <input value="'.$thedrugdata['quantity'].'" placeholder="Drug code" name="quantity" class="form-control" type="hidden">
            </div>
            <input type="hidden" name="drugcode" value="'.$thedrugdata['drug_code'].'">
            <div class="form-group"> 
              <label>Name</label> <input value="'.$thedrugdata['Name'].'" placeholder="Drug Name" class="form-control" name="dname" readonly required="" type="text">
            </div> 
			 <div class="form-group"> 
              <label>Quantity Remaining</label> <input value="'.$thedrugdata['quantity'].'" placeholder="Drug Name" class="form-control" name="remain" readonly required="" type="text">
            </div> 
            <div class="form-group">
               
                
				  
				  <div class="form-group">
                  <label class="control-label">Top Up Quantity</label>
                   <input type="text" name="topup" value="" autocomplete="off" class="form-control" placeholder="Enter Quantity To Top Up">
                 
                </div>
				 
				  ';
                   }
             }else{

header('Location:update_drug.php'); die();

             }
}

function update_drug_details($dname,$dcode,$expdate,$qty,$price,$type,$drugcode,$manu)
  {

	global $connection;

$thesql = 'UPDATE tbl_drug_list SET 
		 Name = "'.$dname.'",
		 product_code = "'.$dcode.'",
		 Expiry_date = "'.$expdate.'",
		 quantity = "'.$qty.'",
		 price = "'.$price.'",
		 type = "'.$type.'",
		 manu = "'.$manu.'"
		 WHERE drug_code="'.$drugcode.'"
	   ';
	mysqli_query($connection,$thesql);

	if(mysqli_affected_rows($connection) >0){
		return true;
	}else{
		return false;
	}

  }

  function topup_drug_details($drugcode,$topup)
  {

	global $connection;

$thesql = 'UPDATE tbl_drug_list SET 
		 quantity = "'.$topup.'"
		 WHERE drug_code="'.$drugcode.'"
	   ';
	mysqli_query($connection,$thesql);

	if(mysqli_affected_rows($connection) >0){
		return true;
	}else{
		return false;
	}

  }






function getDrugServed($arrayOfdrugs){
	global $connection;
	$allthenames = '';
$theCode = explode(',', $arrayOfdrugs);
///get the names
foreach ($theCode as $drugcodes) {

	$the_query = "SELECT Name FROM tbl_drug_list WHERE drug_code='".$drugcodes."' ";
	 //names from db
	 $thenames = mysqli_query($connection,$the_query);
	 if(mysqli_affected_rows($connection) >0){
while( $names = mysqli_fetch_array($thenames)){
     $allthenames .=$names['Name'] .',';  
}

	 
}

// else{
// 			return null;
// 	 }




}

return $allthenames;

}

function getAllPharmWorkDown($startDate,$endDate){
	global $connection;

	$sql = "";
	 
	$date = date('Y-m-d');
    $user_id = $_SESSION['uid'];

	if(empty($startDate) && empty($endDate)){
        $sql = "SELECT * FROM tbl_precribtion WHERE DATE(date_added) = '".$date."' AND pharma_view_doc_by = '".$user_id."' AND pharma_view_doc ='1' ";
	
    }

    if(!empty($startDate) && empty($endDate)){
		$sql = "SELECT * FROM tbl_precribtion WHERE DATE(date_added) = '".$startDate."' AND pharma_view_doc_by = '".$user_id."' AND pharma_view_doc ='1' ";
	
    }

    if(!empty($startDate) && !empty($endDate)){
       // $sql = "SELECT * FROM tbl_consulting WHERE date_sent BETWEEN '$startDate' AND '$endDate'"; 
		$sql = "SELECT * FROM tbl_precribtion WHERE DATE(date_added) >= '$startDate' AND DATE(date_added) <= '$endDate'  AND pharma_view_doc_by = '".$user_id."' AND pharma_view_doc ='1' ";
	   
    }
    
	//$sql = "SELECT * FROM tbl_precribtion WHERE DATE(date_added) = '".$date."' AND pharma_view_doc_by = '".$user_id."' AND pharma_view_doc ='1' ";
	
    $query_run = mysqli_query($connection,$sql) or die(mysqli_error());
    	
	while($row = mysqli_fetch_array($query_run) ){

        if($row['time_interval']=="STAT"||$row['time_interval']=="START"){
			$label_dosage = $row['quantity']." X ".$row['times']." ".$row['rate']."
		 ".$row['time_interval']."(s) ";
		}else{
			$label_dosage = $row['quantity']." X ".$row['times']." ".$row['rate']."
		 ".$row['time_interval']."(s)&nbsp; For ".$row['duration']."&nbsp;".$row['time_span'];
		}

        echo"
        <tr>						
        <td>".$row['patient_id']."</td>
    
    
           <td>".getPatientsName($row['patient_id'])."</td>
            
          <td>".drug_name($row['drug_code'])."</td>

           <td>".$label_dosage."</td>

		   <td>".$row['pres_comment']."</td>

		    <td>".date("F j, Y, g:i a",strtotime($row['date_added']))."</td>
     
       </tr>
    ";
		
	}	
// $theSQL ='SELECT * FROM 
// 		  drug2depenseinfo 
// 		  WHERE staff_id="'.$staff_id.'" AND date_added="'.$today.'" ';
// $theCashierReport = mysqli_query($connection,$theSQL);
// if(mysqli_affected_rows($connection) >0)
// {
// 	while( $thereports = mysqli_fetch_array($theCashierReport))
// 	{
// 		echo '<tr class="odd gradeX">
// 			  <td>'. getPatientsName($thereports['patient_id']).'</td>
// 				  <td>'. $thereports['date_added'].'</td>
// 				  <td>'. getDrugServed($thereports['drug_codes']).'</td>	

// 			</tr>';

// 	}	


// }else{

// return false;
// }

}

function total_notification_waiting_from_Doctor(){
	global $connection;
	$date = date('Y-m-d');
	//$user = $_SESSION['uid'];
	$sql = "SELECT COUNT(DISTINCT(patient_id)) as total_notification_waiting_from_Doctor FROM `tbl_precribtion` WHERE DATE(date_added) = '".$date."' AND pharma_view_doc = '0' AND state = '0' ";
	$query_run = mysqli_query($connection,$sql);
	$rows = mysqli_fetch_assoc($query_run);
	$count = $rows['total_notification_waiting_from_Doctor'];

	return $count;
	
}

function total_notification_waiting_patients_drug2depenseinfoFRMCASHIER(){
	global $connection;
	$date = date('Y-m-d');
//	$user = $_SESSION['uid'];
	$sql = "SELECT COUNT(DISTINCT(patient_id)) as total_notification_waiting_patients_drug2depenseinfoFRMCASHIER FROM `drug2depenseinfo`
	 WHERE date_added = '".$date."' AND state = '2' AND cash_view_pharma = '1' AND pharma_view_cashier = '0'";
	$query_run = mysqli_query($connection,$sql);
	$rows = mysqli_fetch_assoc($query_run);
	$count = $rows['total_notification_waiting_patients_drug2depenseinfoFRMCASHIER'];
	return $count;
}


function list_total_notification_waiting_from_Doctor(){

	global $connection;

	$date = date('Y-m-d');
	//$user = $_SESSION['uid'];
	$sql = "SELECT DISTINCT patient_id FROM `tbl_precribtion` WHERE DATE(date_added) = '".$date."' AND pharma_view_doc = '0' AND state = '0'  ";
	
	if($query_run=mysqli_query($connection,$sql)){

	if(mysqli_num_rows($query_run) > 0){
	
	while($row = mysqli_fetch_array($query_run) ){

		//$date_time_stamp = time_passed($row['date_added']);

		$patient_name = patient_name($row['patient_id']);

		$request_code = "DR";
 		
		echo" 						 

				<li>  <a onclick='return confirm(\"CLICK OK TO CONFIRM SELECTION OF PATIENT TO CONTINUE CONSULTATION...\")'  href='tasks/set_patient_details.php?patient_id=".$row['patient_id']."&request_code=".$request_code." '>" 
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
	$sql="UPDATE `tbl_precribtion` SET pharma_view_doc = '".$viewed_state."', pharma_view_doc_by = '".$user_id."' WHERE patient_id = '".$patient_id."' AND DATE(date_added) = '".$date."'  ";
	if(mysqli_query($connection,$sql) or die(mysqli_error())){
		return TRUE;
	} else {
		return FALSE;
	}
}

function list_total_notification_waiting_patients_drug2depenseinfoFRMCASHIER(){

	global $connection;

	$date = date('Y-m-d');
	//$user = $_SESSION['uid'];
	$sql = "SELECT DISTINCT patient_id FROM `drug2depenseinfo` WHERE date_added = '".$date."' AND state = '2' AND cash_view_pharma = '1' AND pharma_view_cashier = '0' ";
	
	if($query_run=mysqli_query($connection,$sql)){

	if(mysqli_num_rows($query_run) > 0){
	
	while($row = mysqli_fetch_array($query_run) ){

		//$date_time_stamp = time_passed($row['date_sent_ago']);

		$patient_name = patient_name($row['patient_id']);

        $flag = "CASH_TO_PHARMA";

		echo" <li>  <a onclick='return confirm(\"CLICK OK TO CONFIRM SELECTION OF PATIENT TO CONTINUE ...\")' 
                 href='tasks/set_patient_details.php?patient_id=".$row['patient_id']."&flag=".$flag." '>" 
				. $patient_name ." "."". "</a>   </li> <li class='divider'></li> ";
		
	}}else{

		echo "";
	}

} else{
	echo "string ".mysqli_error();
}
}

function update_notification_waiting_patients_drug2depenseinfoFRMCASHIER($patient_id){
	global $connection;
	$viewed_state = 1;
	$user_id = $_SESSION['uid'];
	$date = date('Y-m-d');
	$sql="UPDATE drug2depenseinfo SET pharma_view_cashier = '".$viewed_state."' WHERE patient_id = '".$patient_id."' AND state = '2'
	 AND date_added = '".$date."' AND cash_view_pharma = '1' ";
	if(mysqli_query($connection,$sql) or die(mysqli_error())){
		return TRUE;
	} else {
		return FALSE;
	}
}


function getPatientsWithNoPrescriptionRows($targetDate = null) {
    if ($targetDate === null) {
        $targetDate = date("Y-m-d");
    }

	global $connection;

    $query = "
        SELECT p.patient_id, p.surname, p.other_names, s.membership_id, s.scheme, c.date_sent,  r.request_test_name
        FROM tbl_patient_info p
        INNER JOIN scheme s ON p.patient_id = s.patient_id
        INNER JOIN tbl_consulting c ON p.patient_id = c.patient_id
        INNER JOIN tbl_req_investigation r 
            ON p.patient_id = r.patient_id 
            AND DATE(r.requested_date) = DATE(c.date_sent)
        LEFT JOIN tbl_precribtion pr 
            ON p.patient_id = pr.patient_id 
            AND DATE(pr.date_added) = DATE(c.date_sent)
        WHERE pr.patient_id IS NULL
        AND DATE(c.date_sent) = ?
    ";

    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "s", $targetDate);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['patient_id']}</td>
                    <td>{$row['surname']}</td>
                    <td>{$row['other_names']}</td>
                    <td>{$row['scheme']}</td>
					  <td>{$row['request_test_name']}</td>
                    <td>" . date("F j, Y", strtotime($row['date_sent'])) . "</td>
                  </tr>";
        }
    } else {
        echo "N/A";
    }
}

function getPatientsScansWithNoPrescriptionRows($targetDate = null) {
    if ($targetDate === null) {
        $targetDate = date("Y-m-d");
    }

	global $connection;

    $query = "
        SELECT p.patient_id, p.surname, p.other_names, s.membership_id, s.scheme, c.date_sent,  r.request_test_name
        FROM tbl_patient_info p
        INNER JOIN scheme s ON p.patient_id = s.patient_id
        INNER JOIN tbl_consulting c ON p.patient_id = c.patient_id
        INNER JOIN tbl_req_scan r 
            ON p.patient_id = r.patient_id 
            AND DATE(r.requested_date) = DATE(c.date_sent)
        LEFT JOIN tbl_precribtion pr 
            ON p.patient_id = pr.patient_id 
            AND DATE(pr.date_added) = DATE(c.date_sent)
        WHERE pr.patient_id IS NULL
        AND DATE(c.date_sent) = ?
    ";

    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "s", $targetDate);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['patient_id']}</td>
                    <td>{$row['surname']}</td>
                    <td>{$row['other_names']}</td>
                    <td>{$row['scheme']}</td>
					  <td>{$row['request_test_name']}</td>
                    <td>" . date("F j, Y", strtotime($row['date_sent'])) . "</td>
                  </tr>";
        }
    } else {
        echo "N/A";
    }
}


function countPatientsWithNoPrescription($targetDate = null) {
    
	global $connection;
	if ($targetDate === null) {
        $targetDate = date("Y-m-d");
    }

    $query = "
        SELECT COUNT(DISTINCT p.patient_id) AS total
        FROM tbl_patient_info p
        INNER JOIN scheme s ON p.patient_id = s.patient_id
        INNER JOIN tbl_consulting c ON p.patient_id = c.patient_id
        INNER JOIN tbl_req_investigation r 
            ON p.patient_id = r.patient_id 
            AND DATE(r.requested_date) = DATE(c.date_sent)
        LEFT JOIN tbl_precribtion pr 
            ON p.patient_id = pr.patient_id 
            AND DATE(pr.date_added) = DATE(c.date_sent)
        WHERE pr.patient_id IS NULL
        AND DATE(c.date_sent) = ?
    ";

    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "s", $targetDate);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        return (int)$row['total'];
    }

    return 0;
}


function countScanPatientsWithNoPrescription($targetDate = null) {
    
	global $connection;
	if ($targetDate === null) {
        $targetDate = date("Y-m-d");
    }

    $query = "
        SELECT COUNT(DISTINCT p.patient_id) AS total
        FROM tbl_patient_info p
        INNER JOIN scheme s ON p.patient_id = s.patient_id
        INNER JOIN tbl_consulting c ON p.patient_id = c.patient_id
        INNER JOIN tbl_req_scan r 
            ON p.patient_id = r.patient_id 
            AND DATE(r.requested_date) = DATE(c.date_sent)
        LEFT JOIN tbl_precribtion pr 
            ON p.patient_id = pr.patient_id 
            AND DATE(pr.date_added) = DATE(c.date_sent)
        WHERE pr.patient_id IS NULL
        AND DATE(c.date_sent) = ?
    ";

    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "s", $targetDate);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        return (int)$row['total'];
    }

    return 0;
}





?>