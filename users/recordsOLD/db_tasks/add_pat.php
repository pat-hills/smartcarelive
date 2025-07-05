<?php
//receiving form data from patient registration page
require_once '../../../functions/func_records.php';
require_once '../../../functions/conndb.php';
require_once '../../../functions/func_constant.php';
/////////////////////////////
session_start();

$surname = $_POST['sname'];
$other_names = $_POST['onames'];
$sex = $_POST['sex'];
$marital_stat = $_POST['mstats'];/////////Personal Info POST DATA
$occupation = $_POST['occu'];
$dob = $_POST['dob'];
$phone = $_POST['phone'];
$address = $_POST['add'];
$national_id = $_POST['nid'];
$pat_email = $_POST['pat_email'];

$sms_format = "233".substr($phone, 1);

//patient id generation

//$patient_id=patient_id();

per_info($surname,$other_names,$sex,$marital_stat,$occupation,$phone,$address,$national_id,$sms_format,$pat_email,$dob); //personal info insert function



$patient_id = $_SESSION['patient_id'];
///////////////////////////////
/*
$epilepsy = $_POST['epilepsy'];
$sicklecell = $_POST['sicklecell'];
$diabetes = $_POST['diabetes'];   ////////////Medical Info Form Data
$allergies = $_POST['allergies'];
$hypertension = $_POST['hypertension'];
$other = $_POST['o_dia'];
$bg = $_POST['bg'];


med_info($patient_id,$epilepsy,$hypertension,$diabetes,$bg,$sicklecell,$allergies,$other); //medical info inser function
*/
//Get patient_id session from per_info function
//And give it to patient_id variable






$relation = $_POST['relationship']; 
$famphone = $_POST['famphone'];
//$fambg = $_POST['fambg'];
$famname= $_POST['famname'];//////////Family Info Form Data
$famsex = $_POST['famgen'];
//$fdob = $_POST['fdob'];
$famaddress = $_POST['famaddress'];

//fam_info($patient_id,$famname,$famsex,$famaddress,$relation,$famphone,$fdob);
fam_info($patient_id,$famname,$famsex,$famaddress,$relation,$famphone);




if(IS_INSUARANCE_PACKAGE == true){


	$name_of_insurer = "";
	
	$scheme =$_POST['scheme'];
	$sub_metro =$_POST['sub_metro'];////////////Scheme Info Form Data
	$membership_id = $_POST['membership_id'];
	$serial_number =$_POST['serial_number'];
	$name_private =$_POST['name_private'];
	
	if($scheme=="Private" && !empty($name_private)){
	$name_of_insurer = $name_private;
	}else{
		$name_of_insurer = $sub_metro;
	}
	
	scheme_details($patient_id, $membership_id, $serial_number,$scheme, $name_of_insurer);//scheme details insert function
	
	}



///////Personal folder creation////////

$path ="../../../patients/".$patient_id;

$mode = 0777;
$type='true';
pat_folder_main($path,$mode,$type);


$path ="../../../patients/".$patient_id."/scanXray";//////scans and xray

pat_folder_scan($path,$mode,$type);

$path ="../../../patients/".$patient_id."/oldFolder";

pat_folder_ofold($path,$mode,$type);

$path ="../../../patients/".$patient_id."/lab_results";

pat_lab_result($path,$mode,$type);

///patient photo upload
/*
$exten = array ('image/pjeg', 'image/PJEG',  'image/jpeg','image/JPEG', 'image/JPG','image/jpg', 'image/X-PNG', 'image/PNG','image/png', 
'image/gif','image/GIF', 'image/bmp' );
//checking file format
if(in_array(@$_FILES['ppic']['type'], $exten)){
	
	//checking file size
	echo "right extension found";
	$fsize = @$_FILES['ppic']['size'];
	if($fsize < 2097152){
$exten = ".jpg";
@$image_file= $patid.$exten;

echo $image_file;

$path = "../../../patients/".$patid."";
move_uploaded_file($_FILES['ppic']['tmp_name'], $path."/".$image_file);//moving picture into folder

$real_path = $path."/".$image_file;
echo "successful ".$real_path;

	}else{
		//image file too big
		$_SESSION['err_msg'] = "<div class='alert alert-warning alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-times-circle'></i></div>
								<strong>Invalid!</strong> Maximum image file size exceeded!
							 </div>";
									
									
									header("Location: ../add_patient.php");
	}
}else{
	//unsupported file uploaded...redirect back to registration page
		$_SESSION['err_msg'] = "<div class='alert alert-warning alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-times-circle'></i></div>
								<strong>Invalid!</strong> Unsupported image file selected for patient picture!
							 </div>";
									
									
									header("Location: ../add_patient.php");
	
}

*/
//successful patient registration//redirecting to registered patient page.

$_SESSION['err_msg'] = "
						<div class='alert alert-info alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-times-circle'></i></div>
								<strong> New Patient has been Registered Successfully! </strong> 
					 	</div>
					 	";					 	
									
$_SESSION['new_pat_id'] = $patient_id;

header("Location: ../view_patient");
?>