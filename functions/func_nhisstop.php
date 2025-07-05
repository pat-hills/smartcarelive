<?php
@session_start();
require_once 'conndb.php';

//,scheme scheme.membership_id,tbl_patient_info.date_created
function getAllpatientstoClaim(){
$theSQL = 'SELECT tbl_patient_info.surname,tbl_patient_info.other_names,tbl_patient_info.date_created,
				   scheme.membership_id,tbl_patient_info.patient_id
		   FROM tbl_patient_info,scheme,tbl_consulting
		   WHERE tbl_patient_info.patient_id = scheme.patient_id
		   AND tbl_consulting.patient_id=scheme.patient_id
		   GROUP BY tbl_consulting.patient_id
		   ORDER BY date_created DESC
		  ';
		 $thePatients = mysql_query($theSQL);
		 if(mysql_affected_rows() >0){
		 	while ($Patient= mysql_fetch_array($thePatients)) {
		 		
    echo '<tr class="odd gradeX">
					<td>'.$Patient['surname']."&nbsp;".$Patient['other_names'].'</td>
					<td>'.$Patient['membership_id'].'</td>
				 
				   <td> ';
         //if(getPatientsNHISstate($Patient['patient_id']) == true){
         //}else{
echo'<button data-modal="md-superScaled"  id="'.$Patient['patient_id'].'" class="btn btn-primary md-trigger get4model"><i class="fa fa-spinner"></i>Process</button>
';

         //}

							 
	echo' </td></tr>';

////<button type="button" class="btn btn-success"><i class="fa fa-check-circle"></i>Done</button>


		 	}

		 }else{
		 	return false;
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
$theSQL = "SELECT surname,other_names,dob,sex FROM tbl_patient_info WHERE patient_id='".$patient_id."' ";
     $patientPersonalinfo =  mysql_query($theSQL);
     if(mysql_affected_rows() >0){
       while( $theInfo = mysql_fetch_array($patientPersonalinfo)){

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
$patientdata = mysql_query("SELECT membership_id,serial_number,sub_metro FROM scheme WHERE patient_id='".$patient_id."'");
if(mysql_affected_rows() >0){
while($patientNHISdata =mysql_fetch_array($patientdata)){

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


function getPatientsClaimData($patient_id){ 
$patientsdata = mysql_query("SELECT date_sent,patient_id,consulting_code FROM tbl_consulting WHERE patient_id='".$patient_id."' 

			");
if(mysql_affected_rows() >0){

	echo '<div class="block-flat">
						<div class="header">							
							<h3>Linked Items</h3>
						</div>
						<div class="content">
							<div class="list-group">
							<a href"#" class="list-group-item active">Date of Visit<span class="badge">State</span></a>
		';
while ( $alldata = mysql_fetch_array($patientsdata)) {


				echo '
		 <a href="claims.php?code='.$alldata['consulting_code'].'" class="list-group-item">'.date('d F, Y',strtotime($alldata['date_sent'])).' <span class="badge">active</span></a>
							 					  
					';







		  				 
}

echo '</div></div></div>';

}else{
	return false;
}

}

function get_patients_id_and_dateseen($consulting_code){
	$thepatientid = mysql_query("SELECT patient_id,date_sent FROM tbl_consulting WHERE consulting_code='".$consulting_code."' ");
	if(mysql_affected_rows() >0){

while($theid = mysql_fetch_array($thepatientid)){
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
$getStaffName = mysql_query("SELECT firstName,otherNames FROM tbl_staff WHERE staff_id='".$staffId."' LIMIT 0,1 ");
if(mysql_affected_rows() >0){
	while ( $theNames = mysql_fetch_array($getStaffName)) {
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




?>