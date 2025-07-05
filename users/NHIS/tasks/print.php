<?php
require_once '../../functions/MPDF/mpdf.php';
require_once "../../functions/func_nhis.php";

//require_once '../functions/class/BCGFontFile.php';
//require_once('../../functions/BCGColor.php');
//require_once('../../functions/BCGDrawing.php');
//require_once('../../functions/BCGcode128.barcode.php');
//require_once('../../functions/BCGFont.php');

//generateBarcode();die();
$mpdf= new mPDF('', 'A4', 0, '', 15.7, 12.7, 14, 12.7, 18, 18);

global $this_patients_id,$the_totalMedicine,$theDateSeen,$TotalDiagnosisAmount,$Selected_service_type;

				$patients_consulting_code = $_GET['code']; 
				$thePatientid = get_patients_id_and_dateseen($patients_consulting_code);
			    if(!empty($thePatientid['patient_id'])){
				
				  $this_patients_id = $thePatientid['patient_id'];
				  $theDateSeen = $thePatientid['date_seen'];
				
		//before print a form make sure to terminate and also generate codes for the form
if(monitorClaimForm($this_patients_id) == false)
{header('location:patients.php?message=unable to generate security features'); }		  
				  
				$theUsersdata  = getPatiensPersonalInfo4Claims($thePatientid['patient_id']);
				if(empty($theUsersdata)){header('location:patients.php');die();}
				$nhisdata  	   = getNHISinfo($thePatientid['patient_id']);
				if(empty($nhisdata)){header('location:patients.php');die();}
			 				
				}else{
				//no patient code available so redirect them from here
				header('location:patients.php');die();
				}

			
$mpdf->SetFooter('NHIS claim form, form no.'.getFormCode($this_patients_id).' ,'.date('d F Y Hi :a').' ');	
	?>

<?php 
$mpdf->WriteHTML('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<style type="text/css">
.label-primary {
  background-color: #000000;
  color:#ffffff;
 
}
.label {

  font-weight: 600;
  margin-bottom: 7px;
}
.pushRight{float:left;margin-left:200px;margin-top:30px;display:block;}
</style>');

$mpdf->WriteHTML('</head>
<body>
<div><img src="nhis.jpg" style="width:100px;height:100px;float:left;margin-bottom:-100px;"></div>
<table width="100%" border="0" style="text-align:center;">
  <tr>
    <td style="font-size:16px;"><p>NATIONAL HEALTH INSURANCE SCHEME </p>
    <p>TAFO GOVERNMENT HOSPITAL</p></td>
  </tr>
</table>

<div class="pushRight"><span class="label label-primary">1</span>&nbsp;HI Code/TN:'.genSquareBoxes(getHIcode(),15,15).'</div>

<table width="100%" height="50" border="1" style="margin-top:70px;padding:20px;border-collapse:collapse;font-size:10px;">
  <tr>
    <td><p> Important: The form should be completed in CAPITAL LETTERS using a BLACK or DARK blue ballpoint/fountain pen.Characters and marks used should be similar in the style to the following: </p>
  
	<p>'.genSquareBoxes('ABCDEFGHIJKLMNOPQRSTUVWXZY123456789',34,10,10).'</p></td>
  </tr>
</table>

<div style="float:left;margin-left:360px;margin-top:10px;"><span class="label label-primary">3</span>&nbsp;Month of Claim&nbsp;'.monthOfClaim($theDateSeen,8,8).'</div>
<div style="float:left;margin-left:0px;margin-top:-25px;"><span class="label label-primary">2</span>&nbsp;Scheme Code *'.genSquareBoxes(getTheSchemeCode($this_patients_id),2,15,15).'</div>
<hr>

<div style="float:left;margin-left:-3px;margin-top:5px;"><span class="label label-primary">4</span>&nbsp;Surname *&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.genSquareBoxes($theUsersdata['surname'],18,15,15).'</div>
<br>
<div style="float:left;margin-left:-3px;margin-top:5px;"><span class="label label-primary">5</span>&nbsp;Other Names&nbsp;'.genSquareBoxes($theUsersdata['othernames'],18,15,15).'</div>

<div style="width:120px;height:20px;float:left;margin-left:580px;border: 1px solid #000000;margin-top:-75px;padding:2px;">
'.getGender($theUsersdata['sex']).'
</div>

<div style="float:left;margin-left:-3px;margin-top:px;"><span class="label label-primary">6</span>&nbsp;Date of Birth&nbsp;'.genSquareBoxes4date($theUsersdata['dob'],10,10).'</div>
<div style="float:left;margin-left:300px;margin-top:-20px;"><span class="label label-primary">7</span>&nbsp;Age&nbsp;'.genSquareBoxes(calPatientAge(date('d-M-Y',strtotime($theUsersdata['dob']))),2,10,10).'</div>
<div style="float:left;margin-left:400px;margin-top:-20px;"><span class="label label-primary">8</span>&nbsp;Member Number&nbsp;'.genSquareBoxes($nhisdata['membership_id'],7,10,10).'</div>


<div style="float:left;margin-left:-8px;margin-top:-0px;"><span class="label label-primary">10</span>&nbsp;<div style="width:20px;margin-top:-15px;margin-left:-10px;">Hospital</div> Reocord No&nbsp;<div style="margin-top:-30px;margin-left:90px;">'.genSquareBoxes($_SESSION['patient_id'],10,10,10).'</div></div>
<div style="float:left;margin-left:300px;margin-top:-20px;"><span class="label label-primary">11</span>&nbsp;Card Serial Number&nbsp;'.genSquareBoxes($nhisdata['serial_number'],12,10,10).'</div>
<hr>
SERVICE PROVIDED (to be filled-in by all health care providers) ');

$theService  = getPatientsServicesInfo($this_patients_id,$theDateSeen);
$mpdf->WriteHTML('<div style="width:100%;">
<span class="label label-primary">12</span>
');

if($theService['service_type'] == 'Outpatients'){
$Selected_service_type = 1;
if($theService['pharmacy'] ==1){
$mpdf->WriteHTML('<div style="width:45%;border: 1px solid #000000;padding:10px;">
(a)Select only one<div style="width:200px;"><p>
<input type="checkbox" checked="true" style="width:20px">Outpatients
<input type="checkbox" style="width:10px;">in-patient</p>
<input type="checkbox" style="width:10px;">Diagnostics</div><div style="float:right;width:100px;height:100px;margin-top:-100px;border-left: 1px solid #000000;padding:5px;"><input type="checkbox" checked="true" style="margin-top:4000px;">Pharmacy
');
}elseif($theService['pharmacy'] ==0){
$mpdf->WriteHTML('<div style="width:45%;border: 1px solid #000000;padding:10px;">
(a)Select only one<div style="width:200px;"><p>
<input type="checkbox" checked="true" style="width:20px">Outpatients
<input type="checkbox" style="width:10px;">in-patient</p>
<input type="checkbox" style="width:10px;">Diagnostics</div><div style="float:right;width:100px;height:100px;margin-top:-100px;border-left: 1px solid #000000;padding:5px;"><input type="checkbox" style="width:10px;margin-top:4000px;">Pharmacy
'); }
$mpdf->WriteHTML('</div>
</div>');
}elseif($theService['service_type'] == 'in-patient'){
$Selected_service_type = 2;
if($theService['pharmacy'] ==1){
$mpdf->WriteHTML('<div style="width:45%;border: 1px solid #000000;padding:10px;">
(a)Select only one<div style="width:200px;"><p><input type="checkbox" style="width:10px;">Outpatients
<input type="checkbox" checked="true" style="width:20px;height:20px;">in-patient</p>
<input type="checkbox" style="width:10px;">Diagnostics</div><div style="float:right;width:100px;height:100px;margin-top:-100px;border-left: 1px solid #000000;padding:5px;"><input type="checkbox" checked="true" style="width:10px;margin-top:4000px;">Pharmacy</div></div>
');
}elseif($theService['pharmacy'] ==0){

$mpdf->WriteHTML('<div style="width:45%;border: 1px solid #000000;padding:10px;">
(a)Select only one<div style="width:200px;"><p><input type="checkbox" style="width:10px;">Outpatients
<input type="checkbox" checked="true" style="width:20px;height:20px;">in-patient</p>
<input type="checkbox" style="width:10px;">Diagnostics</div><div style="float:right;width:100px;height:100px;margin-top:-100px;border-left: 1px solid #000000;padding:5px;"><input type="checkbox" style="width:10px;margin-top:4000px;">Pharmacy</div></div>
'); 
}


}elseif($theService['service_type'] == 'Diagnostics'){
$Selected_service_type = 3;
if($theService['pharmacy'] ==1){
$mpdf->WriteHTML('<div style="width:45%;border: 1px solid #000000;padding:10px;">
(a)Select only one<div style="width:200px;"><p><input type="checkbox" style="width:10px;">Outpatients
<input type="checkbox" style="width:10px;">in-patient</p>
<input type="checkbox" checked="true" style="width:10px;">Diagnostics</div><div style="float:right;width:100px;height:100px;margin-top:-100px;border-left: 1px solid #000000;padding:5px;">
<input type="checkbox" checked="true" style="width:10px;margin-top:4000px;">Pharmacy
</div>
</div>'); }

if($theService['pharmacy'] ==0){
$mpdf->WriteHTML('<div style="width:45%;border: 1px solid #000000;padding:10px;">
(a)Select only one<div style="width:200px;"><p><input type="checkbox" style="width:10px;">Outpatients
<input type="checkbox" style="width:10px;">in-patient</p>
<input type="checkbox" checked="true" style="width:10px;">Diagnostics</div><div style="float:right;width:100px;height:100px;margin-top:-100px;border-left: 1px solid #000000;padding:5px;">
<input type="checkbox" style="width:10px;margin-top:4000px;">Pharmacy
</div>
</div>');
}
}

if($theService['service_package'] == 'All inclusive'){
$mpdf->WriteHTML('
<div style="width:45%;border: 1px solid #000000;padding:10px;margin-left:0px;">
<span class="label label-primary">13</span>(b)
<input type="checkbox" checked="true" style="width:10px;">&nbsp;&nbsp;All inclusive&nbsp;&nbsp;
<input type="checkbox" style="width:10px;">&nbsp;&nbsp;Unbundled
</div>');

}elseif($theService['service_package'] == 'Unbundled'){
$mpdf->WriteHTML('
<div style="width:45%;border: 1px solid #000000;padding:10px;margin-left:0px;">
<span class="label label-primary">13</span>(b)
<input type="checkbox" style="width:10px;">&nbsp;&nbsp;All inclusive&nbsp;&nbsp;
<input type="checkbox" checked="true" style="width:10px;">&nbsp;&nbsp;Unbundled
</div>');

}

//$outcome = get_NHIS_outcome($this_patients_id);
if($theService['outcome'] == 'Discharged'){
$mpdf->WriteHTML('<span class="label label-primary">14</span>Outcome
<div style="width:45%;border: 1px solid #000000;padding:10px;margin-left:0px;">
<p>
<input type="checkbox" checked="true" style="width:10px;">&nbsp;&nbsp;Discharged&nbsp;&nbsp;
<input type="checkbox" style="width:10px;">&nbsp;&nbsp;Died
<input type="checkbox" style="width:10px;">&nbsp;&nbsp;Transferred Out</p>
<input type="checkbox" style="width:10px;">&nbsp;<span style="font-size:10px;">Absconded/Discharged against medical advice</span>
</div>');
}elseif($theService['outcome'] == 'Died'){
$mpdf->WriteHTML('<span class="label label-primary">14</span>Outcome
<div style="width:45%;border: 1px solid #000000;padding:10px;margin-left:0px;">
<p>
<input type="checkbox" style="width:10px;">&nbsp;&nbsp;Discharged&nbsp;&nbsp;
<input type="checkbox" checked="true" style="width:10px;">&nbsp;&nbsp;Died
<input type="checkbox" style="width:10px;">&nbsp;&nbsp;Transferred Out</p>
<input type="checkbox" style="width:10px;">&nbsp;<span style="font-size:10px;">Absconded/Discharged against medical advice</span>
</div>');
}
elseif($theService['outcome'] == 'Transferred Out'){
$mpdf->WriteHTML('<span class="label label-primary">14</span>Outcome
<div style="width:45%;border: 1px solid #000000;padding:10px;margin-left:0px;">
<p>
<input type="checkbox" style="width:10px;">&nbsp;&nbsp;Discharged&nbsp;&nbsp;
<input type="checkbox" style="width:10px;">&nbsp;&nbsp;Died
<input type="checkbox" checked="true" style="width:10px;">&nbsp;&nbsp;Transferred Out</p>
<input type="checkbox" style="width:10px;">&nbsp;<span style="font-size:10px;">Absconded/Discharged against medical advice</span>
</div>');
}
elseif($theService['outcome'] == 'Absconded/Discharged'){
$mpdf->WriteHTML('<span class="label label-primary">14</span>Outcome
<div style="width:40%;border: 1px solid #000000;padding:10px;margin-left:0px;">
<p>
<input type="checkbox" style="width:10px;">&nbsp;&nbsp;Discharged&nbsp;&nbsp;
<input type="checkbox" style="width:10px;">&nbsp;&nbsp;Died
<input type="checkbox" style="width:10px;">&nbsp;&nbsp;Transferred Out</p>
<input type="checkbox" checked="true" style="width:10px;">&nbsp;<span style="font-size:10px;">Absconded/Discharged against medical advice</span>
</div>');
}

$getTheDates = get_nhis_dateProvision($this_patients_id);

$mpdf->WriteHTML('<div style="width:48%;border: 1px solid #000000;float:right;margin-right:2px;margin-top:-230px;height:250px;padding:10px;">
<p>1st Visit/Admission'.genSquareBoxes4date($getTheDates['visit1'],10,10).'</p4>
<p>2nd Visit/Discharge'.genSquareBoxes4date($getTheDates['visit2'],10,10).'</p>
<p>3rd Visit'.genSquareBoxes4date($getTheDates['visit3'],10,10).'</p>
<p>4th Visit'.genSquareBoxes4date($getTheDates['visit4'],10,10).'</p>
Duration of spell(days)'.genSquareBoxes($getTheDates['durationOfSpell'],3,10,10).'
<br><br><br><br>
</div>

</div> ');

//$getAttendace = get_Patients_nhis_attendance($this_patients_id);
if($theService['attendance_type'] == 'chronic-follow-up'){
$mpdf->WriteHTML('<div style="width:100%;border: 1px solid #000000;padding:10px;margin-left:0px;margin-top:10px;">
<p style="margin-top:-10px;"><span class="label label-primary">15</span>Type of Attendance</p>

<input type="checkbox" checked="true" style="width:10px;">&nbsp;&nbsp;Chronic Follow-up&nbsp;&nbsp;
<input type="checkbox" style="width:10px;">&nbsp;&nbsp;Emergency/Acute episode
<span class="label label-primary">16</span>
&nbsp;Speciality code:'.genSquareBoxes($theService['Speciality_Code'],2,10,10).'
</div>');

}elseif($theService['attendance_type'] == 'Emergency/Acute-episode'){
$mpdf->WriteHTML('<div style="width:100%;border: 1px solid #000000;padding:10px;margin-left:0px;margin-top:10px;">
<p style="margin-top:-10px;"><span class="label label-primary">15</span>Type of Attendance</p>

<input type="checkbox" style="width:10px;">&nbsp;&nbsp;Chronic Follow-up&nbsp;&nbsp;
<input type="checkbox" checked="true" style="width:10px;">&nbsp;&nbsp;Emergency/Acute episode
<span class="label label-primary">16</span>
&nbsp;Speciality code:'.genSquareBoxes($theService['Speciality_Code'],2,10,10).'
</div>');

}

$mpdf->WriteHTML('<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>');

$mpdf->WriteHTML('<p><span class="label label-primary">20</span>PROCEDURES(S)&nbsp;(<span style="font-size:10px;">to be filled-in by health care providers who have provided out or in-patient services</span>)</p>

<div style="float:left;margin-left:-2px;margin-top:-0px;"><span class="label label-primary">18</span>&nbsp;<div style="width:50px;margin-top:-15px;font-size:10px;margin-left:20px;">Physician/Clinician</div><span style="font-size:10px;">Name</span> &nbsp;<div style="margin-top:-50px;margin-left:100px;"><input type="text" style="width:200px;margin-top:300px;"></div></div>
<div style="float:left;margin-left:320px;margin-top:-20px;"><span class="label label-primary">19</span>&nbsp;Physician/Clinician ID&nbsp;'.genSquareBoxes('',10,5,5).'</div>

<table width="100%" border="1"  style="margin-top:60px;border-collapse:collapse;">
  <tr>
    <th scope="col" width="2%"></th>
    <th scope="col" width="43%">Description</th>
    <th scope="col" width="25%">Date</th>
    <th scope="col" width="15%">G-DRG</th>
  </tr>
  <tr>
    <td>1</td>
    <td></td>
    <td>'.genSquareBoxes4date('',10,10).'</td>
    <td>'.genSquareBoxes('',6,10,10).'</td>
  </tr>
  
 
</table>


<p><span class="label label-primary">21</span>DIAGNOSIS(ES)&nbsp;(<span style="font-size:10px;">to be filled-in by health care providers who have provided out or in-patient services</span>)</p>

<table width="100%" border="1" style="border-collapse:collapse;">
  <tr>
    <th scope="col" width="2%"></th>
    <th scope="col" width="50%">Description</th>
    <th scope="col" width="20%">ICD-10</th>
    <th scope="col" width="20%">G-DRG</th>
  
  ');
  		
$nhisState = 1;
$diagNumbering = 1;
$theDiag  = mysql_query("SELECT diagnosis FROM tbl_diagnosis WHERE patient_id='".$_SESSION['patient_id']."'
						 AND date_added='".$_SESSION['dateSeen']."'
						
						");
					
if(mysql_affected_rows() >0){
while( $getTheDiag = mysql_fetch_array($theDiag))
{
		$getThediaCodes = explode(',',$getTheDiag['diagnosis']);
								foreach ($getThediaCodes as $diagonisisCode) {

$theName = mysql_query("SELECT tarrifs,name,gdrg,icd10 FROM tbl_diagnosis_list WHERE diagnosis_code='".$diagonisisCode."' 
						AND nhis='".$nhisState."'	
						") ;
	   
	   if(mysql_affected_rows() >0){
	   while($getOtherInfo = mysql_fetch_array($theName)){
	
  $Totalsum4Diagonisis += $getOtherInfo['tarrifs'];
    $mpdf->WriteHTML(' <tr> <td>'.$diagNumbering.'</td>
    <td>'.$getOtherInfo['name'].'</td>
    <td>'.genSquareBoxes($getOtherInfo['icd10'],4,15,15).'</td>
    <td>'.genSquareBoxes($getOtherInfo['gdrg'],6,15,15).'</td>
					   </tr>
					 ');
 $diagNumbering++;  }}}} } 
  $TotalDiagnosisAmount = $Totalsum4Diagonisis;
$mpdf->WriteHTML('
</table>

<p><span class="label label-primary">22</span>INVESTIGATIONS&nbsp;(<span style="font-size:10px;">to be filled-in by health care providers who have providing diagnostics services only</span>)</p>
<table width="100%" border="1" style="border-collapse:collapse;">
  <tr>
    <th scope="col" width="2%"></th>
    <th scope="col" width="33%">Description</th>
	<th scope="col" width="15%">Unit Price</th>
    <th scope="col" width="30%">Date</th>
    <th scope="col" width="25%">G-DRG</th>
  
  ');
  
  $invNumbering = 1;
	$getTotalofInvestigation = 0;
	$patientsInvestData =  mysql_query("SELECT requested_date,requested_test 
										FROM tbl_req_investigation
										WHERE patient_id='".$_SESSION['patient_id']."'
										AND requested_date='".$_SESSION['dateSeen']."'
									   ");
									 
			if(mysql_affected_rows() >0){ 
			while( $thedata = mysql_fetch_array($patientsInvestData) ){
			//remove the comma from the requested_test
			        //$investigationcode = removeTheCommasFromTheCode($thedata['requested_test']);
					$getTheArrayOfCodes = explode(',', $thedata['requested_test']);
								foreach ($getTheArrayOfCodes as $thecode) {
				
					
					
					$theInfoOfInvs = mysql_query("SELECT Investigations,Tarriffs,gdrgcode
												 FROM tbl_investigations 
												 WHERE investigation_code='".$thecode."' 
												
												");
								if(mysql_affected_rows() > 0){
								while($investigation_info = mysql_fetch_array($theInfoOfInvs))
								{ 
		
  
  
  
 
  $mpdf->WriteHTML('  
  <tr>
  <td>'.$invNumbering.'</td>
    <td>'.$investigation_info['Investigations'].'</td>
	<td>'.genSquareBoxes($investigation_info['Tarriffs'],4,8,8).'</td>
    <td>'.genSquareBoxes4date($thedata['requested_date'],8,8).'</td>
    <td>'.genSquareBoxes($investigation_info['gdrgcode'],6,13,13).'</td>
	</tr>
  ');
   $totalAfterInvAmount += $investigation_info['Tarriffs'];
  $invNumbering++;  }}}} }
  
  $totalInvestigation = $totalAfterInvAmount;
  $mpdf->WriteHTML(' 
</table> 

<p><span class="label label-primary">23</span>MEDICINES&nbsp;(<span style="font-size:10px;">to be filled-in by health care providers who have dispensed medicines</span>)</p>
<table width="100%" border="1" style="border-collapse:collapse;">
  <tr>
	<th scope="col" width="2%"></th>
    <th scope="col" width="35%">Description</th>
	<th scope="col" width="20%">Price</th>
    <th scope="col" width="10%">Qty</th>
	 <th scope="col" width="10%">Total cost</th>
    <th scope="col" width="25%">Code</th>
  ');
   $nhis_state = 1;
$numbering = 1;
$theDrugCodes  = mysql_query("SELECT * FROM  despensed_drugs
							  WHERE patient_id='".$_SESSION['patient_id']."' 
							  AND date_added='".$_SESSION['dateSeen']."'
							 ");
						
if(mysql_affected_rows() >0){

	while($theDrugsdata = mysql_fetch_array($theDrugCodes)){
	
 $theNames  =  mysql_query("SELECT Name,price,gdrg
			 FROM tbl_drug_list WHERE drug_code='".$theDrugsdata['drug_code']."' 
			 AND NHIS='".$nhis_state."' ");
			 if(mysql_affected_rows() >0){
			 while($getName = mysql_fetch_array($theNames)){
	
  $totalOfallTheDrugs = $theDrugsdata['quantity'] * $getName['price'];
  
  $mpdf->WriteHTML(' <tr> <td>'.$numbering.'</td>
						<td>'.$getName['Name'].'</td>
						 <td>'.genSquareBoxes($getName['price'],5,8,8).'</td>
						<td>'.genSquareBoxes($theDrugsdata['quantity'],2,8,8).'</td>
						<td>'.$totalOfallTheDrugs.'</td>
						<td>'.genSquareBoxes($getName['gdrg'],8,8,8).'</td>
					  </tr> ');
					  $afterTotalMedicineAmount += $totalOfallTheDrugs;
					  $numbering++;  }}}}
     $the_totalMedicine  = $afterTotalMedicineAmount;

  $mpdf->WriteHTML(' </table>
<div style="width:100%;">
<p><span class="label label-primary">24</span>CLIENT CLAIM SUMMARY&nbsp;</p>
<div style="width:70%;">
<table width="100%" border="1" style="border-collapse:collapse;">
  <tr>
    <th scope="col">Type of service</th>
    <th scope="col">G-DRG/Code</th>
    <th scope="col">Tariff Amount</th>
  </tr>
  <tr>');
  
  //determine which should hold the investigations
  //get the service type
 
	if($Selected_service_type == 1){
	$InpatientTarrif ="";
	$InpatientDgrgcode ='';//not yet known
	$Outpatienttarrif = $TotalDiagnosisAmount;//for only diagnosis
	$OutpatientDgrgcode ='';//not yet known
	
	}elseif($Selected_service_type = 2){
	 $InpatientTarrif =$TotalDiagnosisAmount;//for only diagnosis
	
	$InpatientDgrgcode ='';//not yet known
	$Outpatienttarrif = "";
	$OutpatientDgrgcode ='';//not yet known
	
	}elseif($Selected_service_type = 3){
	}
  $mpdf->WriteHTML('  <td>In-patient</td>
    <td>'.genSquareBoxes($InpatientDgrgcode,6,10,10).'</td>
    <td>'.genSquareBoxes($InpatientTarrif,6,10,10).'</td>
  </tr>
  <tr>
    <td>Out-patient</td>
    <td>'.genSquareBoxes($Outpatienttarrif,6,10,10).'</td>
    <td>'.genSquareBoxes($OutpatientDgrgcode,6,10,10).'</td>
  </tr>
  <tr>
    <td>Investigations</td>
    <td></td>
    <td>'.genSquareBoxes($totalAfterInvAmount,6,10,10).'</td>
  </tr>
  <tr>
    <td>Pharmacy</td>
    <td></td>
    <td>'.genSquareBoxes($the_totalMedicine,6,10,10).'</td>
  </tr>
</table> ');

$GetTotal4HNIS =$the_totalMedicine + $totalInvestigation + $InpatientTarrif + $Outpatienttarrif;
$mpdf->WriteHTML('<h4>TOTAL</h4> <div style="float:left;margin-left:310px;margin-top:-40px;">'.genSquareBoxes($GetTotal4HNIS,6,10,10).'</div>
</div>

<div style="float:left;margin-left:520px;margin-top:-200px;">
Name
<p><input type="text" id="PaulAutoAjustMike" value="'.getHealthInsuranceOfficersName($_SESSION['uid']).'" style="width:300px;"></p>
Signature
<p><input type="text" style="width:300px;height:70px;">
(<span style="font-size:10px;">Health Facility Insurance Officer</span>)
</p>
</div>
</div>

<div id="barcodeHolder"></div>
<p>&nbsp;</p> 
</body>
</html>
');

ob_clean();
$mpdf->Output();
exit;


?>
