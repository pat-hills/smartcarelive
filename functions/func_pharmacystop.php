<?php

require_once 'conndb.php';
//add new drugs to system

function add_drug($a,$b,$c,$d,$e,$f,$g,$gdrg,$manu){
	//generate drugcode not product code
	$drug_code = get_transcode();
	
	$sql="INSERT INTO tbl_drug_list (drug_code,Name,NHIS,Expiry_date,quantity,type,price,gdrg,manufacture,product_code)
	VALUES ('".$drug_code."','".$b."','".$c."','".$d."','".$e."','".$f."','".$g."','".$gdrg."','".$manu."','".$a."')";
	
	mysql_query($sql);
	
	
}

//function to get prescribed drug to a particular patient

function NHIS_State($drug_code){

$theSql = "SELECT NHIS FROM tbl_drug_list WHERE drug_code='".$drug_code."'";
	$theSch = mysql_query($theSql);
	
	if(!empty($theSch)){
			while($theDrugSch=mysql_fetch_array($theSch)){
            return $theDrugSch['NHIS'];

        }
	}else{
		return false;
	}

}





function getDrugPrices($drug_code){

	//get the price of the drug from the drug table
	$theSql = "SELECT price FROM tbl_drug_list WHERE drug_code='".$drug_code."'";
	$thePrice = mysql_query($theSql);
	
	if(!empty($thePrice)){
			while($theDrugPrice=mysql_fetch_array($thePrice)){

	//check wheather the drug is covered by a scheme or not
				//if it return 1 = NHIS
				//if it return 2 = momentum
				//if it return 0 = none

	//check if not out off stock
	          if(checkifNotOutofStock($drug_code) == true){

	          	if(NHIS_State($drug_code)  == 1){
					return 'free';
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
	$theSql = "SELECT name FROM tbl_drug_list WHERE drug_code='".$drug_code."'";
	$theName = mysql_query($theSql);
	
	if(!empty($theName)){
			while($theDrugName=mysql_fetch_array($theName)){
            return $theDrugName['name']; }
	}else{
		return false;
	}

}


function removeDrug(){


}

function checkifNotOutofStock($drugcode){

$theSql = "SELECT quantity FROM tbl_drug_list WHERE drug_code='".$drugcode."'";
	$outoffstock = mysql_query($theSql);
		while($see=mysql_fetch_array($outoffstock)){

			if($see['quantity']  == 0 or $see['quantity']  <0 ){

				return false;//drug is out of stock
			}else{
				return true;//drug is avaliable 
			}
			
		}

}


function checkifUserHasPaid($patientID){
$the_state = 2;
	$theSQL = "SELECT state FROM drug2depenseinfo WHERE
			   state='".$the_state."'
			   AND patient_id = '".$patientID."'
			   AND date_added='".date('Y-m-d')."'	
			  ";
		$updates = mysql_query($theSQL);	  
			  if(mysql_affected_rows() >0 ){
			  	return true;
			  }else{
			  	return false;
			  }

}

function checkifAlreadyDespensed($drugcode,$patientID)
{
$theSQL = "SELECT id FROM despensed_drugs WHERE patient_id='".$patientID."'
			AND staff_id='".$_SESSION['uid']."'
			AND drug_code ='".$drugcode."'
			AND date_added='".date('Y-m-d')."'
		  ";
		  $query_run = mysql_query($theSQL);

		  if(mysql_affected_rows()){
		  	

		  	return true;
		  }else{
		  	return false;
		  }

}

function getPatientsDrugs($patientID){
	$CurrentDate =date('Y-m-d');
	$state = 2;
$sql="SELECT drug_codes FROM drug2depenseinfo WHERE patient_id=
	'".$patientID."'AND date_added='".$CurrentDate."' AND state='".$state."' ";
	$query_run = mysql_query($sql);
	while($see=mysql_fetch_array($query_run)){ 


$theCode = explode(',', $see['drug_codes']);

		//for ($i=0; $i < $theCode ; $i++) { 
foreach ($theCode as $aCode){
	
	//check if already dispensed
	if(checkifAlreadyDespensed($aCode,$patientID) == false){
$sql="SELECT Name FROM tbl_drug_list WHERE drug_code='".$aCode."'";
		$query_run = mysql_query($sql);
	while($name=mysql_fetch_array($query_run)){ 
	echo "<tr>
 <td>".$name['Name']."</td>";
  echo "<td><a href='tasks/despenseDrug.php?drugcode=".$aCode."' class='btn btn-primary'>Depense</a></td>";
 	echo "<tr>";
      
}
}
}
}
}



function get_prescribtion($patientID,$CurrentDate){

global $totalHolder,$get_drugcodes,$hideButton;
		   $totalHolder = 0;
		   $get_drugcodes = 0;
	//unset($_SESSION['emptyTableIndicator']); //unset the error container


if(checkifUserHasPaid($patientID) ==true){
//put depense code here
//hide some buttons when on this conditions
	$_SESSION['hideButton'] = 1;
	$hideButton = $_SESSION['hideButton'];

//display drag to dispense
	 getPatientsDrugs($patientID);
	  
 
}else{
//kill button hide
	unset($_SESSION['hideButton']);
$state =0;
	$sql="SELECT * FROM tbl_precribtion WHERE patient_id=
	'".$patientID."'AND date_added='".$CurrentDate."'
		
	";
	
	$query_run = mysql_query($sql);

if(mysql_affected_rows() >0){
	while($see=mysql_fetch_array($query_run)){ 
echo"<tr  class='checked_drug'>
<td>".getDrugName($see['drug_code'])."</td>
		<td class='color-success'>".$see['quantity']." X ".$see['times']." Every ".$see['rate']."
		 ".$see['time_interval']."(s)&nbsp; For ".$see['duration']."&nbsp;Day(s)</td>
		 
<td>".getDrugPrices($see['drug_code'])."</td>";

echo '<td>';
if(checkIfoutOfStock($see['drug_code']) == false){
echo "<input checked id='".getDrugPrices($see['drug_code'])."'' class='drugcheck' type='checkbox' name='checked_drug[]' value='".$see['drug_code']."' />";
}
echo "</td>
</tr>";

  //remove NHIA drugs out

           $totalHolder += calculateDrug($see['drug_code']);
           //$get_drugcodes .= $see['drug_code'].',';
	}
}else{

     //show message that no prescribption for user
	@$_SESSION['hidethetbl'] = 1;


}




}

}

function checkIfoutOfStock($drugcode){
	$thedrugcodes = array();
	$checker = 0;
	//return type is true: meaning the quantity available is either 
	//less than or is equal to zero
	//so hide check box 
$theSQL  ='SELECT quantity,drug_code FROM tbl_drug_list WHERE drug_code="'.$drugcode.'" ';
		 $thequanty= mysql_query($theSQL);
		 if(mysql_affected_rows() >0){
      while($theTotalQant= mysql_fetch_array($thequanty))
      {
      	if($theTotalQant['quantity'] <= 0 ){
      //set the outof stock incase we need to print the drugs
      		$thedrugcodes[] = $theTotalQant['drug_code'];
     
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
//get the price of the drug from the drug table
	$theSql = "SELECT price,NHIS,quantity FROM tbl_drug_list WHERE drug_code='".$drugcode."'";
	$thePrice = mysql_query($theSql);
		while($see=mysql_fetch_array($thePrice)){
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
	
$sql="SELECT * FROM tbl_staff WHERE staff_id='".$doc_id."'";
$query_run = mysql_query($sql);
	while($see=mysql_fetch_array($query_run)){

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

/*function get_transcode(){

return 'mer';

}
*/
function sendCashier($uid,$patient_id,$seldrugcodes,$totalcost){

 $theTrans= get_transcode();
 $state = 1;
	//submit the db
$theSql = "INSERT INTO drug2depenseinfo
		  (patient_id,staff_id,drug_codes,amount,transcode,date_added,state)
		  VALUES
		  ('".$patient_id."','".$uid."',
		  '".$seldrugcodes."','".$totalcost."','".$theTrans."','".date('Y-m-d')."',
		  '".$state."'
		  )";
   $theresults = mysql_query($theSql);
 
      if($theresults){

//update the state in the transaction table
      	//state one means pending
      	if(update_prescriptionState(1,$patient_id) == true){
  			
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
 	$today = date('Y-m-d');
 	$theSql = "UPDATE tbl_precribtion  SET
 				   	state='".$state."'
 			WHERE patient_id='".$patient_id."'
 			AND date_added ='".$today."'  	   		
 		   ";
 	 $theresults = mysql_query($theSql);

      if($theresults){

      	return TRUE;
      } else{
      	return FALSE;
      }


 }

 function pharmActionButton($patient_id){
 	//determine which button to show
 	//get the prescribption state
 	$today = date('Y-m-d');
 	$theSql = "SELECT state 
 			   FROM drug2depenseinfo  
 			   WHERE patient_id='".$patient_id."'
 			   AND date_added ='".$today."'  	   		
 		   ";
 	 $theresults = mysql_query($theSql);
 	 if($theresults){
 	 if(mysql_affected_rows()){

 	 while($pre_state=mysql_fetch_array($theresults)){

 	 	if($pre_state['state'] ==1){
echo "<input style='float:right;' disabled class='btn btn-primary' value='pending'>";
return;
 	 	}elseif($pre_state['state'] ==2){
echo "<button style='float:right;' class='btn btn-primary'>Dispensed</button>";
return;
 	 	}else{
echo "<input type='submit' value='Send' style='float:right;' class='btn btn-primary senddata'>";
return; 
 	 	}
			}
}else{
echo "<input type='submit' value='Send' style='float:right;' class='btn btn-primary senddata'>";


}

}else{
echo "<input type='submit' value='Send' style='float:right;' class='btn btn-primary'>";


}
 
}


function joinSelectedDrugCodes($checked_drug){
	$theJoinedCodes = implode(',',$checked_drug);
	return $theJoinedCodes;

}


function add_to_depense_db($staff_id,$patient_id,$drugcode){
$theQsl = "INSERT INTO despensed_drugs
			(patient_id,staff_id,drug_code,date_added)
				VALUES
			('".$patient_id."','".$staff_id."','".$drugcode."','".date('Y-m-d')."')
		  ";
		  $afterInsertion  =mysql_query($theQsl);
		  if(mysql_affected_rows()){
		  	return true;
		  }else{
		  	return false;
		  }


}

function getTheCurrentValue($drugcode){

$query = "SELECT quantity FROM tbl_drug_list WHERE drug_code='".$drugcode."' ";
$getQuantity  = mysql_query($query);

if(mysql_affected_rows() >0){
	while ($thequantity = mysql_fetch_array($getQuantity) ){
		return  $thequantity['quantity'];
	}
}
}

function UpdateDrugQuantity($drugcode)
{

//get the current quantity 
//and do the substraction
	 $theValue = getTheCurrentValue($drugcode);
	 //if is zero dont subsrtack
	 if($theValue == 0 or empty($theValue)){
$value_after_cal = 0;
	 }else{
$value_after_cal = $theValue - 1;//substrack one from the intial val
}
	$theSQL = "UPDATE tbl_drug_list 
			   SET quantity=".$value_after_cal."
			   WHERE drug_code='".$drugcode."'
			   ";
		$afterInsertion  =mysql_query($theSQL);
		  if(mysql_affected_rows()){
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
$theSQL = "SELECT * FROM tbl_drug_list";
$thedrugs = mysql_query($theSQL);
if(mysql_affected_rows() >0){
    while($allthedrugs  =mysql_fetch_array($thedrugs)){

  echo '<tr class="odd gradeX">
		<td>'.$allthedrugs["Name"].'</td>
		<td>'.$allthedrugs["gdrg"].'</td>
		<td>'.$allthedrugs["manufacture"].'</td>
	    <td>'.getTimeRemainingToExpire($allthedrugs["Expiry_date"]).'</td>
	    <td>'.$allthedrugs["date_added"].'</td>
		
			<td>
<a href="tasks/deleteDrugs.php?code='.$allthedrugs["drug_code"].'" type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
<a href="edit_drugs.php?code='.$allthedrugs["drug_code"].'" type="button" class="btn btn-success"><i class="fa fa-edit"></i></a>
			</td>
		</tr>';




    }

}else{
	return false;
}

								
}



function deleteDrug($drug_code){
$theSQL = "DELETE FROM tbl_drug_list WHERE drug_code='".$drug_code."'
          ";
          mysql_query($theSQL);
          if(mysql_affected_rows() >0){
            return true;

          }else{

          	return false;

          }

}



function getDrugToEdit($drugcode){

$theSQL = "SELECT * FROM tbl_drug_list WHERE drug_code='".$drugcode."'
		  ";
		   $thedrugs = mysql_query($theSQL);
		   if(mysql_affected_rows() >0){
		   	while($thedrugdata = mysql_fetch_array($thedrugs)){
           


echo '<div class="form-group">
              <label>Drug Code</label> <input value="'.$thedrugdata['product_code'].'" placeholder="Drug code" name="dcode" class="form-control" type="text">
            </div>
            <input type="hidden" name="drugcode" value="'.$thedrugdata['drug_code'].'">
            <div class="form-group"> 
              <label>Name</label> <input value="'.$thedrugdata['Name'].'" placeholder="Drug Name" class="form-control" name="dname" required="" type="text">
            </div> 
            <div class="form-group">
                  <label class="col-sm-3 control-label">G-DRG Code</label>
                 
                    <input type="text" value="'.$thedrugdata['gdrg'].'" class="form-control" name="gdrg">
                  </div>
                             
                <div class="form-group">
                  <label class="col-sm-6 control-label">NHIS Drug?</label>
                  
                    Yes <input type="radio" name="nhis" value="1">
                    No <input type="radio" name="nhis" value="0" checked="">
                  
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Expiry Date</label>
                 
                    <input type="date" value="'.$thedrugdata['Expiry_date'].'" class="form-control" name="expdate">
                  </div>
                 
                 <div class="form-group">
                  <label class="col-sm-3 control-label">Quantity</label>
                   <input type="number" value="'.$thedrugdata['quantity'].'" name="qty" class="form-control" placeholder="Quantity">
                 
                </div>
                 <div class="form-group">
                  <label class="col-sm-3 control-label">Unit Price</label>
                   <input type="text" name="price" value="'.$thedrugdata['price'].'" class="form-control" placeholder="GHs">
                 
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Manufacture</label>
                 
                    <input type="text" value="'.$thedrugdata['manufacture'].'" class="form-control" name="manufacture">
                  </div>
                <div class="form-group">
                  <div class="col-sm-6">
                    <label class="control-label">Drug Type</label>
                    
                    <select class="select2 col-sm-5" name="type" required="">
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
                  </div> ';
                   }
             }else{

header('Location:update_drug.php'); die();

             }
}

function update_drug_details($dname,$dcode,$gdrg,$nhis,$expdate,$qty,$price,$manufacture,$type,$drugcode)
  {

$thesql = 'UPDATE tbl_drug_list SET 
		 Name = "'.$dname.'",
		 product_code = "'.$dcode.'",
		 gdrg = "'.$gdrg.'",
		 NHIS = "'.$nhis.'",
		 Expiry_date = "'.$expdate.'",
		 quantity = "'.$qty.'",
		 price = "'.$price.'",
		 manufacture = "'.$manufacture.'",
		 type = "'.$type.'"
		 WHERE drug_code="'.$drugcode.'"
	   ';
	mysql_query($thesql);

	if(mysql_affected_rows() >0){
		return true;
	}else{
		return false;
	}

  }




function getPatientsName($patient_id){

$theSQL = "SELECT surname,other_names FROM tbl_patient_info WHERE patient_id='".$patient_id."'
          ";
      $patientinfo = mysql_query($theSQL); 
      if(mysql_affected_rows() >0){

      	while($theSelPatientInfo = mysql_fetch_array($patientinfo)){
     return    $theSelPatientInfo['surname'].'&nbsp;'.$theSelPatientInfo['other_names'];

      	}


      }  



}

function getDrugServed($arrayOfdrugs){
	$allthenames = '';
$theCode = explode(',', $arrayOfdrugs);
///get the names
foreach ($theCode as $drugcodes) {
	 //names from db
	 $thenames = mysql_query("SELECT Name FROM tbl_drug_list WHERE drug_code='".$drugcodes."' ");
	 if(mysql_affected_rows() >0){
while( $names = mysql_fetch_array($thenames)){
     $allthenames .=$names['Name'] .',';  
}

	 }else{

	 }




}

return $allthenames;

}

function getAllPharmWorkDown($staff_id){
$theSQL ='SELECT * FROM 
		  drug2depenseinfo 
		  WHERE staff_id="'.$staff_id.'" 
         ';
$theCashierReport = mysql_query($theSQL);
if(mysql_affected_rows() >0)
{
	while( $thereports = mysql_fetch_array($theCashierReport))
	{
		echo '<tr class="odd gradeX">
			  <td>'. getPatientsName($thereports['patient_id']).'</td>
				  <td>'. $thereports['date_added'].'</td>
				  <td>'. getDrugServed($thereports['drug_codes']).'</td>	

			</tr>';

	}	


}else{

return false;
}

}


?>