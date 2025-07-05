<?php
session_start();
//receiving form data from patient registration page

require_once '../../../functions/conndb.php';
require_once '../../../functions/func_common.php';
require_once '../../../functions/func_lab.php';
require_once '../../../functions/func_constant.php';


$patient_id = $_SESSION['patient_id'];
$request_code = $_SESSION['request_code'];
$lab_staff_id = $_SESSION['uid'];
$lab_no = $_POST['lab_no'];

//$is_exist = false;





if(isset($_POST['urine_re'])){

	
    $appearance = $_POST['appearance'];
    $colour = $_POST['colour'];
    $specific_gravity = $_POST['specific_gravity'];
    $ph = $_POST['ph'];
    $protein = $_POST['protein'];
    $glucose = $_POST['glucose'];
    $ketones = $_POST['ketones'];
    $blood = $_POST['blood'];
    $nitrite = $_POST['nitrite'];
    $bilirubin = $_POST['bilirubin'];
    $urobilinogen = $_POST['urobilinogen'];

	//MISCROSCOPY
	$epithelial_cell = $_POST['epithelial_cell'];
	$rbcs = $_POST['rbcs'];
	$crystals = $_POST['crystals'];
	$t_vaginals = $_POST['t_vaginals'];
	$ova = $_POST['ova'];
	$wbc_cast = $_POST['wbc_cast'];
	$pus_cell = $_POST['pus_cell'];
	$t_vaginals = $_POST['t_vaginals'];
	$yeast_like_cells = $_POST['yeast_like_cells'];
	$s_haemoglobin = $_POST['s_haemoglobin'];
	$bacteria = $_POST['bacteria'];
	$leukocytes = $_POST['leukocytes'];
	$Spermatozoa = $_POST['Spermatozoa'];
	$commentsurine = $_POST['commentsurine'];
	$others = $_POST['others'];
	$others_value = $_POST['others_value'];



	$check_insert_urine_re = check_insert_urine_re($lab_staff_id,$patient_id);

	if($check_insert_urine_re){
      $is_exist = true;
	
	}else{
		$is_exist = false;
	}

		//$inserted = insert_urine_re($request_code, $patient_id, $lab_staff_id, $appearance, $colour, $specific_gravity, $ph, $protein, $glucose,$ketones, $blood, $nitrite, $bilirubin, $urobilinogen);
		$inserted = insert_urine_re($request_code, $patient_id, $lab_staff_id, $appearance, $colour, $specific_gravity, $ph, $protein, $glucose,
		$ketones, $blood, $nitrite, $bilirubin, $urobilinogen,$epithelial_cell,$pus_cell,$rbcs,$wbc_cast,$crystals,$ova,$t_vaginals
		,$bacteria,$yeast_like_cells,$s_haemoglobin,$leukocytes,$Spermatozoa,$commentsurine,$others,$others_value,$is_exist);
		if($inserted){
 
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Patient Lab Request Submitted And Sent! </strong> 
			 </div>
			 ";				
					
				}else {
			
					
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Failed To Process And Send Lab Results! </strong> 
			 </div>
			 ";				
}}

 

if(isset($_POST['lft'])){

	$S_BILIRUBIN_conjugated = "";
	 
    $S_BILIRUBIN_Total = $_POST['S_BILIRUBIN_Total'];

   if(IS_LFT_DIRECT == false){
	$S_BILIRUBIN_conjugated = $_POST['S_BILIRUBIN_conjugated'];
   }
   


    $S_ALKALINE_PHOSPHATASE = $_POST['S_ALKALINE_PHOSPHATASE'];
    $S_g_GLUTAMYL_TRANSFERASE = $_POST['S_g_GLUTAMYL_TRANSFERASE'];
    $S_TOTAL_PROTEIN = $_POST['S_TOTAL_PROTEIN'];
    $S_AST_GOT = $_POST['S_AST_GOT'];
	$S_ALT_GPT = $_POST['S_ALT_GPT'];
    $S_ALBUMIN = $_POST['S_ALBUMIN']; 
	$S_ALBUMIN = $_POST['S_ALBUMIN']; 
	$S_BILIRUBIN_DIRECT = $_POST['S_BILIRUBIN_DIRECT']; 
//S_BILIRUBIN_DIRECT

	$check_insert_lft = check_insert_lft($lab_staff_id,$patient_id);

	if($check_insert_lft){
    $is_exist = true;
		
	}else{
		$is_exist = false;
	}
  
		$inserted =  insert_lft($request_code, $patient_id, $lab_staff_id, $S_BILIRUBIN_Total, $S_BILIRUBIN_conjugated, $S_ALKALINE_PHOSPHATASE, $S_g_GLUTAMYL_TRANSFERASE, $S_ALT_GPT, 
		$S_AST_GOT,$S_TOTAL_PROTEIN, $S_ALBUMIN,$S_BILIRUBIN_DIRECT,$is_exist);
		
		if($inserted){
 
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Patient Lab Request Submitted And Sent! </strong> 
			 </div>
			 ";				
					
				}else {
			
					
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Failed To Process And Send Lab Results! </strong> 
			 </div>
			 ";				
					 
}}

//HVSRE

if(isset($_POST['HVSRE'])){


 var_dump($_POST);

 print($_POST);

 echo($_POST);

	 
	 
    $ep_cell = $_POST['ep_cell'];
    $pus_cell = $_POST['pus_cell'];

    $rbcs = $_POST['rbcs'];

    $t_vaginalis = $_POST['t_vaginalis'];
    $bacteria = $_POST['bacteria'];
	$yeast_like_cells = $_POST['yeast_like_cells']; 
//S_BILIRUBIN_DIRECT

	$check_insert_hvsre_re = check_insert_hvsre_re($lab_staff_id,$patient_id);

	

	if($check_insert_hvsre_re){
    $is_exist = true;
		
	}else{
		$is_exist = false;
	}
	
		$inserted =  insert_hvsre($request_code, $patient_id, $lab_staff_id, $ep_cell, $pus_cell, $rbcs, $t_vaginalis, $bacteria, $yeast_like_cells,$is_exist);
		
		if($inserted){
 
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Patient Lab Request Submitted And Sent! </strong> 
			 </div>
			 ";				
					
				}else {
			
					
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Failed To Process And Send Lab Results! </strong> 
			 </div>
			 ";				
					 
}}




//HVSRE

if(isset($_POST['stool_re'])){

	 
    $macroscopy = $_POST['macroscopy'];
    $microscopy = $_POST['microscopy']; 


	$check_stool_re = check_stool_re($lab_staff_id,$patient_id);

	if($check_stool_re){
		$is_exist = true;
	}else{
		$is_exist = false;
	}
		$inserted =  insert_stool_re($request_code, $patient_id, $lab_staff_id, $macroscopy, $microscopy,$is_exist);
		
		if($inserted){
 
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Patient Lab Request Submitted And Sent! </strong> 
			 </div>
			 ";				
					
				}else {
			
					
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Failed To Process And Send Lab Results! </strong> 
			 </div>
			 ";	 }}

if(isset($_POST['Widal'])){

	 
    $s_typhi_o = $_POST['s_typhi_o'];
    $s_typhi_h = $_POST['s_typhi_h']; 
	$comment = $_POST['commentw'];

	

	$check_widal_re = check_widal_re($lab_staff_id,$patient_id);

	if($check_widal_re){

		$is_exist = true;
	}else{
		$is_exist = false;
	}
		
//   $_SESSION['err_msg'] = "
//  <div class='alert alert-info alert-white rounded'>
// 		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
// 		<div class='icon'><i class='fa fa-times-circle'></i></div>
// 		<strong> Patient Lab Request Already Processed By You! </strong> 
//  </div>
//  ";
	
 // else{

	//$is_exist = false;
		$inserted =  insert_widal_test($request_code, $patient_id, $lab_staff_id, $s_typhi_o, $s_typhi_h,$comment,$is_exist);
		
		if($inserted){
 
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Patient Lab Processed Successfully! </strong> 
			 </div>
			 ";				
					
				}else {
			
					
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Failed To Process And Send Lab Results! </strong> 
			 </div>
			 ";				
					 
				}

	}
      




if(isset($_POST['Typhoid'])){

	 
    $IgM = $_POST['IgM'];
    $IgG = $_POST['IgG']; 
	$comment = $_POST['comment'];

	$check_typhoid_re = check_typhoid_re($lab_staff_id,$patient_id);

	if($check_typhoid_re){
$is_exist = true;
	
	}else{
$is_exist = false;
	}
  
		$inserted =  insert_typoid_test($request_code, $patient_id, $lab_staff_id, $IgG, $IgM, $comment,$is_exist);
		
		if($inserted){
 
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Patient Lab Request Submitted And Sent! </strong> 
			 </div>
			 ";				
					
				}else {
			
					
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Failed To Process And Send Lab Results! </strong> 
			 </div>
			 ";				
					 
				}
      
}


if(isset($_POST['BUE&CR'])){

	 
    $SODIUM = $_POST['SODIUM'];
    $POTASSIUM = $_POST['POTASSIUM']; 
	$CHLORIDE = $_POST['CHLORIDE'];
	$S_UREA = $_POST['S_UREA'];
	//$CHLORIDE = $_POST['CHLORIDE'];
	$S_CREATININE = $_POST['S_CREATININE'];

	$check_bue_cr_ = check_bue_cr_($lab_staff_id,$patient_id);

	if($check_bue_cr_){
      $is_exist = true;
	}else{
		$is_exist = false;
	}
 
		$inserted =  insert_bue_cr($request_code, $patient_id, $lab_staff_id, $SODIUM, $POTASSIUM, $CHLORIDE, $S_UREA,$S_CREATININE,$is_exist);
		
		if($inserted){
 
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Patient Lab Request Submitted And Sent! </strong> 
			 </div>
			 ";				
					
				}else {
			
					
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Failed To Process And Send Lab Results! </strong> 
			 </div>
			 ";				
					 
				}
      
}




if(isset($_POST['UREA&CREATINE'])){

	  
	$S_UREA = $_POST['S_UREA']; 
	$S_CREATININE = $_POST['S_CREATININE'];

	$check_urea_creatine_ = check_urea_creatine_($lab_staff_id,$patient_id);

	if($check_urea_creatine_){
$is_exist = true;
	}else{
$is_exist = false;
	}
 
		$inserted =  insert_urea_creatine($request_code, $patient_id, $lab_staff_id, $S_UREA,$S_CREATININE,$is_exist);
		
		if($inserted){
 
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Patient Lab Request Submitted And Sent! </strong> 
			 </div>
			 ";				
					
				}else {
			
					
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Failed To Process And Send Lab Results! </strong> 
			 </div>
			 ";				
					 
				}

	}



if(isset($_POST['ELECTROLYTES'])){

	 
    $SODIUM = $_POST['SODIUM_electrolytes'];
    $POTASSIUM = $_POST['POTASSIUM_electrolytes']; 
	$CHLORIDE = $_POST['CHLORIDE_electrolytes'];  

	$check_elec_tro_lytes_ = check_elec_tro_lytes_($lab_staff_id,$patient_id);

	if($check_elec_tro_lytes_){
        $is_exist = true;
	}else{
		$is_exist = false;
	}
  
		$inserted =  insert_elec_tro_lytes($request_code, $patient_id, $lab_staff_id, $SODIUM, $POTASSIUM, $CHLORIDE,$is_exist);
		
		if($inserted){
 
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Patient Lab Request Submitted And Sent! </strong> 
			 </div>
			 ";				
					
				}else {
			
					
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Failed To Process And Send Lab Results! </strong> 
			 </div>
			 ";				
		 

	}
      
}

if(isset($_POST['TYROID_FUNCTION_TEST'])){

	 
    $F_T_3 = $_POST['F_T_3'];
    $F_T_4 = $_POST['F_T_4']; 
	$T_S_H = $_POST['T_S_H'];  


	$CRP_LEVEL_value = str_replace(' ','',$T_S_H);

	$CRP_LEVEL_value_operator = $CRP_LEVEL_value[0];

	if($CRP_LEVEL_value_operator == ">" || $CRP_LEVEL_value_operator =="<"){

		$TSH_lev = substr_replace($CRP_LEVEL_value," ",1, -strlen($CRP_LEVEL_value));
	}else{
		$TSH_lev = $CRP_LEVEL_value;
	}


	$check_tyroid_func = check_tyroid_func($lab_staff_id,$patient_id);

	if($check_tyroid_func){
        $is_exist = true;
	}else{
		$is_exist = false;
	}
  
		$inserted =  insert_tyroid_func($request_code, $patient_id, $lab_staff_id, $F_T_3, $F_T_4, $TSH_lev,$is_exist);
		
		if($inserted){
 
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Patient Lab Request Submitted And Sent! </strong> 
			 </div>
			 ";				
					
				}else {
			
					
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Failed To Process And Send Lab Results! </strong> 
			 </div>
			 ";				
		 

	}
      
}



if(isset($_POST['HB_ELECTROPHORESIS'])){

	 
    $GENOTYPE_STATUS = $_POST['GENOTYPE_STATUS'];
    $SICKLING_STATUS = $_POST['SICKLING_STATUS'];  

	$check_hb_electrophoresis = check_hb_electrophoresis($lab_staff_id,$patient_id);

	if($check_hb_electrophoresis){
        $is_exist = true;
	}else{
		$is_exist = false;
	}
  
		$inserted =  insert_hb_electrophoresis($request_code, $patient_id, $lab_staff_id, $SICKLING_STATUS, $GENOTYPE_STATUS,$is_exist);
		
		if($inserted){
 
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Patient Lab Request Submitted And Sent! </strong> 
			 </div>
			 ";				
					
				}else {
			
					
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Failed To Process And Send Lab Results! </strong> 
			 </div>
			 ";				
		 

	}
      
}




if(isset($_POST['BLOOD_FILM_FOR_MALARIA'])){

	 
    $BLOOD_FILMS_STATUS = $_POST['BLOOD_FILMS_STATUS']; 

	$check_blood_film_malaria = check_blood_film_malaria($lab_staff_id,$patient_id);

	if($check_blood_film_malaria){
        $is_exist = true;
	}else{
		$is_exist = false;
	}
  
		$inserted =  insert_blood_film_malaria($request_code, $patient_id, $lab_staff_id, $BLOOD_FILMS_STATUS,"",$is_exist);
		
		if($inserted){
 
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Patient Lab Request Submitted And Sent! </strong> 
			 </div>
			 ";				
					
				}else {
			
					
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Failed To Process And Send Lab Results! </strong> 
			 </div>
			 ";				
		 

	}
      
}


if(isset($_POST['lipid_profile'])){

	 
    $TOTAL_CHOLESTEROL = $_POST['TOTAL_CHOLESTEROL'];
    $TRIGLYCERIDES = $_POST['TRIGLYCERIDES']; 
	$HDL_CHOLESTEROL = $_POST['HDL_CHOLESTEROL'];
	$LDL_CHOLESTEROL = $_POST['LDL_CHOLESTEROL']; 
	$CORONARY_RISK = $_POST['CORONARY_RISK']; 
//CORONARY_RISK
	$check_lipid_profile_ = check_lipid_profile_($lab_staff_id,$patient_id);

	if($check_lipid_profile_){
       $is_exist = true;
	}else{
		$is_exist = false;

	}

  
		$inserted =  insert_lipid_profile($request_code, $patient_id, $lab_staff_id, $TOTAL_CHOLESTEROL, $TRIGLYCERIDES, $HDL_CHOLESTEROL, $LDL_CHOLESTEROL,$CORONARY_RISK,$is_exist);
		
		if($inserted){
 
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Patient Lab Request Submitted And Sent! </strong> 
			 </div>
			 ";				
					
				}else {
			
					
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Failed To Process And Send Lab Results! </strong> 
			 </div>
			 ";				
					 
				}

	}



if(isset($_POST['FBS'])){

	 
    $BLOOD_FBS = $_POST['BLOOD_FBS'];
   // $BLOOD_RBS = $_POST['BLOOD_RBS'];  

	$check_blood_fbs_ = check_blood_fbs_($lab_staff_id,$patient_id);

	if($check_blood_fbs_){

		$is_exist = true;

	}else{
     $is_exist = false;
	}
 
		$inserted =  insert_blood_fbs($request_code, $patient_id, $lab_staff_id, $BLOOD_FBS,$is_exist);		
		if($inserted){
 
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Patient Lab Request Submitted And Sent! </strong> 
			 </div>
			 ";				
					
				}else {
			
					
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Failed To Process And Send Lab Results! </strong> 
			 </div>
			 ";				
					 
				}
      
}


if(isset($_POST['RBS'])){

	 
    $RBS_LEVEL = $_POST['RBS_LEVEL'];
   // $BLOOD_RBS = $_POST['BLOOD_RBS'];  

	$check_blood_rbs_ = check_blood_rbs_($lab_staff_id,$patient_id);

	if($check_blood_rbs_){

		$is_exist = true;

	}else{
     $is_exist = false;
	}
 
		$inserted =  insert_blood_rbs($request_code, $patient_id, $lab_staff_id, $RBS_LEVEL,$is_exist);		
		if($inserted){
 
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Patient Lab Request Submitted And Sent! </strong> 
			 </div>
			 ";				
					
				}else {
			
					
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Failed To Process And Send Lab Results! </strong> 
			 </div>
			 ";				
					 
				}
      
}

if(isset($_POST['2HPP'])){

	 
    $fasting = $_POST['fasting'];
    $first_hour = $_POST['1st_hour']; 
	$second_hour = $_POST['2nd_hour'];   

	$check_2hpp = check_2hpp($lab_staff_id,$patient_id);

	if($check_2hpp){

		$is_exist = true;

	}else{
     $is_exist = false;
	}
 
		$inserted =  insert_2hpp($request_code, $patient_id, $lab_staff_id, $fasting,$first_hour,$second_hour,$is_exist);		
		if($inserted){
 
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Patient Lab Request Submitted And Sent! </strong> 
			 </div>
			 ";				
					
				}else {
			
					
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Failed To Process And Send Lab Results! </strong> 
			 </div>
			 ";				
					 
				}
      
}

if(isset($_POST['EFGR'])){

	 
    $egfrvalue = $_POST['egfrvalue'];
    $egfrvalueComment = $_POST['egfrvalueComment']; 

	$check_efgr = check_efgr($lab_staff_id,$patient_id);

	if($check_efgr){

		$is_exist = true;

	}else{
     $is_exist = false;
	}
 
		$inserted =  insert_efgr($request_code, $patient_id, $lab_staff_id, $egfrvalue,$egfrvalueComment,$is_exist);		
		if($inserted){
 
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Patient Lab Request Submitted And Sent! </strong> 
			 </div>
			 ";				
					
				}else {
			
					
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Failed To Process And Send Lab Results! </strong> 
			 </div>
			 ";				
					 
				}
      
}


if(isset($_POST['Malaria'])){

	 
    $Malaria = $_POST['Malaria'];
    $malaria_status = $_POST['malaria_status']; 
	$comment = $_POST['comment_malaria'];

	$check_malaria_re = check_malaria_re($lab_staff_id,$patient_id);

	if($check_malaria_re){

		$is_exist = true;
	}else{
		$is_exist = false;
	}
 
		$inserted =  insert_general_test($request_code,$patient_id,$lab_staff_id,$Malaria,$malaria_status,$comment,$is_exist);
		
		if($inserted){
 
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Patient Lab Request Submitted And Sent! </strong> 
			 </div>
			 ";				
					
				}else {
			
					
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Failed To Process And Send Lab Results! </strong> 
			 </div>
			 ";				
					 
				}

	}
      




if(isset($_POST['G6PD'])){

  $comment = "";
    $G6PD = $_POST['G6PD'];
    $g6pd_status = $_POST['g6pd_status'];  

	$check_gpd_re = check_gpd_re($lab_staff_id,$patient_id);

	if($check_gpd_re){
		$is_exist = true;

	}else{
       $is_exist = false;
	}
   
		$inserted =  insert_general_test($request_code,$patient_id,$lab_staff_id,$G6PD,$g6pd_status,$comment,$is_exist);
		
		if($inserted){
 
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Patient Lab Request Submitted And Sent! </strong> 
			 </div>
			 ";				
					
				}else {
			
					
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Failed To Process And Send Lab Results! </strong> 
			 </div>
			 ";	}
}





if(isset($_POST['HepatitisB'])){

	 
    $HepatitisB = $_POST['HepatitisB'];
    $HepatitisB_Status = $_POST['HepatitisB_Status']; 
	$comment = $_POST['commentb'];

	$check_hepatitisB_re = check_hepatitisB_re($lab_staff_id,$patient_id);

	if($check_hepatitisB_re){

		$is_exist = true;
	}else{
		$is_exist = false;
	}
  
		$inserted =  insert_general_test($request_code,$patient_id,$lab_staff_id,$HepatitisB,$HepatitisB_Status,$comment,$is_exist);
		
		if($inserted){
 
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Patient Lab Request Submitted And Sent! </strong> 
			 </div>
			 ";				
					
				}else {
			
					
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Failed To Process And Send Lab Results! </strong> 
			 </div>
			 ";				
					 
				}

	}
      








if(isset($_POST['HCV'])){

	 
    $HCV = $_POST['HCV'];
    $HCV_status = $_POST['HCV_STATUS']; 
	$comment = $_POST['comment_HCV'];

	$check_HCV_re = check_HCV_re($lab_staff_id,$patient_id);

	if($check_HCV_re){
		$is_exist = true;

	}else{
		$is_exist = false;

	}
 
		$inserted =  insert_general_test($request_code,$patient_id,$lab_staff_id,$HCV,$HCV_status,$comment,$is_exist);
		
		if($inserted){
 
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Patient Lab Request Submitted And Sent! </strong> 
			 </div>
			 ";				
					
				}else {
			
					
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Failed To Process And Send Lab Results! </strong> 
			 </div>
			 ";				}
}




if(isset($_POST['SPT'])){

	 
    $SPT = $_POST['SPT'];
    $SPT_STATUS = $_POST['SPT_STATUS']; 
	$comment = $_POST['comment'];

	$check_SPT_re = check_SPT_re($lab_staff_id,$patient_id);

	if($check_SPT_re){

		
  $_SESSION['err_msg'] = "
 <div class='alert alert-info alert-white rounded'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
		<div class='icon'><i class='fa fa-times-circle'></i></div>
		<strong> Patient Lab Request Already Processed By You! </strong> 
 </div>
 ";
	}
  else{
		$inserted =  insert_general_test($request_code,$patient_id,$lab_staff_id,$SPT,$SPT_STATUS,$comment);
		
		if($inserted){
 
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Patient Lab Request Submitted And Sent! </strong> 
			 </div>
			 ";				
					
				}else {
			
					
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Failed To Process And Send Lab Results! </strong> 
			 </div>
			 ";				
					 
				}

	}
      
}






// if(isset($_POST['RETRO_SCREEN'])){

	 
//     $RETRO_SCREEN = $_POST['RETRO_SCREEN'];
//     $RETRO_SCREEN_STATUS = $_POST['RETRO_SCREEN_STATUS']; 
// 	$comment = $_POST['comment'];

// 	$check_RETRO_SCREEN_STATUS_re = check_RETRO_SCREEN_STATUS_re($lab_staff_id,$patient_id);

// 	if($check_RETRO_SCREEN_STATUS_re){

		
//   $_SESSION['err_msg'] = "
//  <div class='alert alert-info alert-white rounded'>
// 		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
// 		<div class='icon'><i class='fa fa-times-circle'></i></div>
// 		<strong> Patient Lab Request Already Processed By You! </strong> 
//  </div>
//  ";
// 	}
//   else{
// 		$inserted =  insert_general_test($request_code,$patient_id,$lab_staff_id,$RETRO_SCREEN,$RETRO_SCREEN_STATUS,$comment);
		
// 		if($inserted){
 
// 			$_SESSION['err_msg'] = "
// 			<div class='alert alert-info alert-white rounded'>
// 					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
// 					<div class='icon'><i class='fa fa-times-circle'></i></div>
// 					<strong> Patient Lab Request Submitted And Sent! </strong> 
// 			 </div>
// 			 ";				
					
// 				}else {
			
					
// 			$_SESSION['err_msg'] = "
// 			<div class='alert alert-info alert-white rounded'>
// 					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
// 					<div class='icon'><i class='fa fa-times-circle'></i></div>
// 					<strong> Failed To Process And Send Lab Results! </strong> 
// 			 </div>
// 			 ";				
					 
// 				}

// 	}
      
// }




 

if(isset($_POST['RETRO_SCREEN'])){


	 
    $RETRO_SCREEN = $_POST['RETRO_SCREEN'];
    $RETRO_SCREEN_STATUS = $_POST['RETRO_SCREEN_STATUS']; 
	$comment = $_POST['comment'];

	$check_RETRO_SCREEN_STATUS_re = check_RETRO_SCREEN_STATUS_re($lab_staff_id,$patient_id);

	if($check_RETRO_SCREEN_STATUS_re){
		$is_exist = true;

	}else{
		$is_exist = false;

	}


	$inserted =  insert_general_test($request_code,$patient_id,$lab_staff_id,$RETRO_SCREEN,$RETRO_SCREEN_STATUS,$comment,$is_exist);
		
	if($inserted){

		$_SESSION['err_msg'] = "
		<div class='alert alert-info alert-white rounded'>
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
				<div class='icon'><i class='fa fa-times-circle'></i></div>
				<strong> Patient Lab Request Submitted And Sent! </strong> 
		 </div>
		 ";				
				
			}else {
		
				
		$_SESSION['err_msg'] = "
		<div class='alert alert-info alert-white rounded'>
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
				<div class='icon'><i class='fa fa-times-circle'></i></div>
				<strong> Failed To Process And Send Lab Results! </strong> 
		 </div>
		 ";				}

 


      
}




if(isset($_POST['H_PYLORI_SERUM'])){

	 
    $H_PYLORI_SERUM = $_POST['H_PYLORI_SERUM'];
    $H_PYLORI_SERUM_STATUS = $_POST['H_PYLORI_SERUM_STATUS']; 
	//$comment = $_POST['comment'];
	$comment = "";

	$check_pylori_re = check_pylori_re($lab_staff_id,$patient_id);

	if($check_pylori_re){
		$is_exist = true;

	}else{
$is_exist = false;
	}
 
		$inserted =  insert_general_test($request_code,$patient_id,$lab_staff_id,$H_PYLORI_SERUM,$H_PYLORI_SERUM_STATUS,$comment,$is_exist);
		
		if($inserted){
 
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Patient Lab Request Submitted And Sent! </strong> 
			 </div>
			 ";				
					
				}else {
			
					
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Failed To Process And Send Lab Results! </strong> 
			 </div>
			 ";				
		}
 
}

if(isset($_POST['H_PYLORI_STOOL'])){

	 
    $H_PYLORI_STOOL = $_POST['H_PYLORI_STOOL'];
    $H_PYLORI_STOOL_STATUS = $_POST['H_PYLORI_STOOL_STATUS']; 
	//$comment = $_POST['comment'];
	$comment = "";

	$check_pylori_stool = check_pylori_stool($lab_staff_id,$patient_id);

	if($check_pylori_stool){
		$is_exist = true;

	}else{
$is_exist = false;
	}
 
		$inserted =  insert_general_test($request_code,$patient_id,$lab_staff_id,$H_PYLORI_STOOL,$H_PYLORI_STOOL_STATUS,$comment,$is_exist);
		
		if($inserted){
 
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Patient Lab Request Submitted And Sent! </strong> 
			 </div>
			 ";				
					
				}else {
			
					
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Failed To Process And Send Lab Results! </strong> 
			 </div>
			 ";				
		}
 
}







if(isset($_POST['GLYCATED_HAEMOGLOBIN'])){

	 
    $GLYCATED_HAEMOGLOBIN_value = $_POST['GLYCATED_HAEMOGLOBIN_value'];
	$GLYCATED_HAEMOGLOBIN_EVALUATION = $_POST['GLYCATED_HAEMOGLOBIN_EVALUATION'];
   //GLYCATED_HAEMOGLOBIN_EVALUATION

	$check_glycated_haemoglobin_ = check_glycated_haemoglobin_($lab_staff_id,$patient_id);

	if($check_glycated_haemoglobin_){
      $is_exist = true;
	}else{
		$is_exist = false;
	}
  
		$inserted =  insert_glycated_haemore( $request_code, $patient_id, $lab_staff_id, $GLYCATED_HAEMOGLOBIN_value,$GLYCATED_HAEMOGLOBIN_EVALUATION,$is_exist );
		
		if($inserted){
 
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Patient Lab Request Submitted And Sent! </strong> 
			 </div>
			 ";				
					
				}else {
			
					
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Failed To Process And Send Lab Results! </strong> 
			 </div>
			 ";				
					 
				}
      
}

//HAEMOGLOBIN_LEVEL

if(isset($_POST['HAEMOGLOBIN_LEVEL'])){

	 
    $HAEMOGLOBIN_LEVEL_value = $_POST['HAEMOGLOBIN_LEVEL_value'];
   

	$check_level_haemoglobin_ = check_level_haemoglobin_($lab_staff_id,$patient_id);

	if($check_level_haemoglobin_){

		$is_exist = true;
 
	}else{
		$is_exist = false;

	}
  
		$inserted =  insert_level_haemore( $request_code, $patient_id, $lab_staff_id, $HAEMOGLOBIN_LEVEL_value,$is_exist );
		
		if($inserted){
 
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Patient Lab Request Submitted And Sent! </strong> 
			 </div>
			 ";				
					
				}else {
			
					
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Failed To Process And Send Lab Results! </strong> 
			 </div>
			 ";				
					 
	}}



if(isset($_POST['PROSTATE_SPECIFIC_ANTIGEN'])){

	 
    $CRP_LEVEL_value = $_POST['PROSTATE_SPECIFIC_ANTIGEN_LEVEL'];
	$PSA_EVALUATION = $_POST['PSA_EVALUATION'];

//	$psa_lev = factor_operations($PROSTATE_SPECIFIC_ANTIGEN_LEVEL);


	$CRP_LEVEL_value = str_replace(' ','',$CRP_LEVEL_value);

	$CRP_LEVEL_value_operator = $CRP_LEVEL_value[0];

	if($CRP_LEVEL_value_operator == ">" || $CRP_LEVEL_value_operator =="<"){

		$psa_lev = substr_replace($CRP_LEVEL_value," ",1, -strlen($CRP_LEVEL_value));
	}else{
		$psa_lev = $CRP_LEVEL_value;
	}




	$check_psa_ = check_psa_($lab_staff_id,$patient_id);

	if($check_psa_){

		$is_exist = true;
   }else{
	   $is_exist = false;
   }
		$inserted =  insert_psa_( $request_code, $patient_id, $lab_staff_id, $psa_lev,$PSA_EVALUATION,$is_exist );
		
		if($inserted){
 
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Patient Lab Request Submitted And Sent! </strong> 
			 </div>
			 ";				
					
				}else {
			
					
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Failed To Process And Send Lab Results! </strong> 
			 </div>
			 ";				
	}}








if(isset($_POST['FBC'])){

	$basophils ="";
	$eosinophils = "";
	$monocytes= "";
	$neutrophils = "";
	$retics = "";

	//insert_fbc($request_code, $patient_id, $lab_staff_id, $WBC, $Lymphocytes_hash, $mid_hash, $gran_hash, $Lymphocytes_percent, 
           //        $mid_percent,$gran_percent, $RBC,$HGB,$HCT,$MCV,$MCH,$MCHC,$RDW_CV,$RDW_SD,$PLT,$MPV,$PDW,$PCT,$neutrophils,$monocytes,$eosinophils,$basophils,$retics)

    $FBC = $_POST['FBC'];
	$WBC = $_POST['wbc'];
	$Lymphocytes_hash = $_POST['Lymphocytes_hash'];
	$mid_hash = $_POST['Mid_hash'];
	$gran_hash = $_POST['Gran_hash'];
	$Lymphocytes_percent = $_POST['Lymphocytes_percent'];
	$mid_percent = $_POST['Mid_percent'];
	$gran_percent = $_POST['Gran_percent'];
	$RBC = $_POST['RBC'];
	$HGB = $_POST['HGB'];
	$HCT = $_POST['HCT'];
	$MCV = $_POST['MCV'];
	$hcm_lab = $_POST['hcm_lab'];
	$MCHC = $_POST['MCHC'];
	$RDW_CV = $_POST['RDW_CV'];
	$RDW_SD = $_POST['RDW_SD'];
	$PLT = $_POST['PLT'];
	$MPV = $_POST['MPV'];
	$PDW = $_POST['PDW'];
	$PCT = $_POST['PCT'];
	$P_LCR = $_POST['P_LCR'];


if(IS_LAB_TYPE_OTHER_PARTY_MACHINE == false){

	$basophils = $_POST['basophils'];
	$eosinophils = $_POST['eosinophils'];
	$monocytes = $_POST['Monocytes'];
	$neutrophils = $_POST['Neutrophils'];
	$retics = $_POST['retics'];

}

	


    

	$check_FBC_ = check_FBC_($lab_staff_id, $patient_id);

	if($check_FBC_){

		$is_exist = true;
	}else{
		$is_exist = false;
	}
		
	$inserted = insert_fbc($request_code, $patient_id, $lab_staff_id, $WBC, $Lymphocytes_hash, $mid_hash, $gran_hash, $Lymphocytes_percent, 
	$mid_percent,$gran_percent, $RBC,$HGB,$HCT,$MCV,$hcm_lab,$MCHC,$RDW_CV,$RDW_SD,$PLT,$MPV,$PDW,$PCT,$P_LCR,$neutrophils,$monocytes,$eosinophils,$basophils,$retics,$is_exist);
		
		if($inserted){
 
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Patient Lab Request Submitted And Sent! </strong> 
			 </div>
			 ";				
					
				}else {
			
					
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Failed To Process And Send Lab Results! </strong> 
			 </div>
			 ";				
					 
				}}


if(isset($_POST['SICKLING'])){

	 
    $SICKLING = $_POST['SICKLING'];
    $SICKLING_STATUS = $_POST['SICKLING_STATUS']; 
	$comment = $_POST['comment_SICKLING'];

	$check_sickling_re = check_sickling_re($lab_staff_id,$patient_id);

			if($check_sickling_re){
		$is_exist = true;
			}else{
		$is_exist = false;	
		}
 
		$inserted =  insert_general_test($request_code,$patient_id,$lab_staff_id,$SICKLING,$SICKLING_STATUS,$comment,$is_exist);
		
		if($inserted){
 
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Patient Lab Request Submitted And Sent! </strong> 
			 </div>
			 ";				
					
				}else {
			
					
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Failed To Process And Send Lab Results! </strong> 
			 </div>
			 ";				
					 
				}
      
}



if(isset($_POST['SYPHILLIS'])){

	 
    $SICKLING = $_POST['SYPHILLIS'];
    $SYPHILLIS_STATUS = $_POST['SYPHILLIS_STATUS']; 
	$comment = $_POST['comment_SYPHILLIS'];

	$checkcheck_SYPHILLIS_re_HCV_re = check_SYPHILLIS_re($lab_staff_id,$patient_id);

	if($checkcheck_SYPHILLIS_re_HCV_re){
		$is_exist = true;

	}else{
$is_exist = false;
	}
  
		$inserted =  insert_general_test($request_code,$patient_id,$lab_staff_id,$SICKLING,$SYPHILLIS_STATUS,$comment,$is_exist);
		
		if($inserted){
 
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Patient Lab Request Submitted And Sent! </strong> 
			 </div>
			 ";				
					
				}else {
			
					
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Failed To Process And Send Lab Results! </strong> 
			 </div>
			 ";				
					 
				}
      
}



if(isset($_POST['GONORRHEA'])){

	 
    $SICKLING = $_POST['GONORRHEA'];
    $SYPHILLIS_STATUS = $_POST['GONORRHEA_STATUS']; 
	$comment = $_POST['comment_GONORRHEA'];

	$checkcheck_SYPHILLIS_re_HCV_re = check_GONORRHEA_re($lab_staff_id,$patient_id);

	if($checkcheck_SYPHILLIS_re_HCV_re){
		$is_exist = true;

	}else{
$is_exist = false;
	}
  
		$inserted =  insert_general_test($request_code,$patient_id,$lab_staff_id,$SICKLING,$SYPHILLIS_STATUS,$comment,$is_exist);
		
		if($inserted){
 
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Patient Lab Request Submitted And Sent! </strong> 
			 </div>
			 ";				
					
				}else {
			
					
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Failed To Process And Send Lab Results! </strong> 
			 </div>
			 ";				
					 
				}
      
}






if(isset($_POST['GENOTYPE'])){

	 
    $GENOTYPE = $_POST['GENOTYPE'];
    $GENOTYPE_STATUS = $_POST['GENOTYPE_STATUS']; 
	$comment = $_POST['comment_GENOTYPE'];

	$check_GENOTYPE_re = check_GENOTYPE_re($lab_staff_id,$patient_id);

	if($check_GENOTYPE_re){

		$is_exist = true;

	}else{

		$is_exist = false;
	}
  
		$inserted =  insert_general_test($request_code,$patient_id,$lab_staff_id,$GENOTYPE,$GENOTYPE_STATUS,$comment,$is_exist);
		
		if($inserted){
 
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Patient Lab Request Submitted And Sent! </strong> 
			 </div>
			 ";				
					
				}else {
			
					
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Failed To Process And Send Lab Results! </strong> 
			 </div>
			 ";				
					 
				}
      
}





if(isset($_POST['PROSTATE_SPECIFIC_ANTIGEN'])){

	 
   // $PROSTATE_SPECIFIC_ANTIGEN = $_POST['PROSTATE_SPECIFIC_ANTIGEN'];
    $PROSTATE_SPECIFIC_ANTIGEN_LEVEL = $_POST['PROSTATE_SPECIFIC_ANTIGEN_LEVEL']; 
	$PSA_EVALUATION = $_POST['PSA_EVALUATION'];

	$check_psa_ = check_psa_($lab_staff_id,$patient_id);

	if($check_psa_){
      $is_exist = true;
	}else{
		$is_exist = false;
	}
  
		$inserted =  insert_psa_($request_code, $patient_id, $lab_staff_id, $PROSTATE_SPECIFIC_ANTIGEN_LEVEL,$PSA_EVALUATION,$is_exist);
		
		if($inserted){
 
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Patient Lab Request Submitted And Sent! </strong> 
			 </div>
			 ";				
					
				}else {
			
					
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Failed To Process And Send Lab Results! </strong> 
			 </div>
			 ";				

	}
      
}





if(isset($_POST['HEPATITIS_B_PROFILE'])){

	  
	 $HBsAg = $_POST['HBsAg'];
	 $HBsAb = $_POST['HBsAb']; 
	 $HBeAg = $_POST['HBeAg'];  
	 $HBeAb = $_POST['HBeAb'];  
	 $HBcAb = $_POST['HBcAb'];  
	 $comment_hepatitisB_profile = $_POST['comment_hepatitisB_profile'];  

	  //comment_hepatitisB_profile
 
	 $check_hepatitisB_profile = check_hepatitisB_profile($lab_staff_id,$patient_id);
 
	 if($check_hepatitisB_profile){
		 $is_exist = true; 
	 }else{
		 $is_exist = false;
	 } 
		 $inserted =  insert_hepatitis_b_profile($request_code, $patient_id, $lab_staff_id, $HBsAg,$HBsAb,$HBeAg,$HBeAb,$HBcAb,$comment_hepatitisB_profile,$is_exist);
		 
		 if($inserted){
  
			 $_SESSION['err_msg'] = "
			 <div class='alert alert-info alert-white rounded'>
					 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					 <div class='icon'><i class='fa fa-times-circle'></i></div>
					 <strong> Patient Lab Request Submitted And Sent! </strong> 
			  </div>
			  ";				
					 
				 }else {
			 
					 
			 $_SESSION['err_msg'] = "
			 <div class='alert alert-info alert-white rounded'>
					 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					 <div class='icon'><i class='fa fa-times-circle'></i></div>
					 <strong> Failed To Process And Send Lab Results! </strong> 
			  </div>
			  ";				
					  
				 }
 
	 
	   
 }

//NEW ADDED TODAY NOVEM 15

 
if(isset($_POST['HIV_I'])){

	 
    $HIV_I = $_POST['HIV_I'];
    $HIV_I_STATUS = $_POST['HIV_I_STATUS']; 
	$comment = $_POST['comment'];

	$check_hiv_re = check_hiv_i__re($lab_staff_id,$patient_id);

	if($check_hiv_re){

		
  $_SESSION['err_msg'] = "
 <div class='alert alert-info alert-white rounded'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
		<div class='icon'><i class='fa fa-times-circle'></i></div>
		<strong> Patient Lab Request Already Processed By You! </strong> 
 </div>
 ";
	}
  else{
		$inserted =  insert_general_test($request_code,$patient_id,$lab_staff_id,$HIV_I,$HIV_I_STATUS,$comment);
		
		if($inserted){
 
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Patient Lab Request Submitted And Sent! </strong> 
			 </div>
			 ";				
					
				}else {
			
					
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Failed To Process And Send Lab Results! </strong> 
			 </div>
			 ";				
					 
				}

	}
      
}



if(isset($_POST['HIV_II'])){

	 
    $HIV_II = $_POST['HIV_II'];
    $HIV_II_STATUS = $_POST['HIV_II_STATUS']; 
	$comment = $_POST['comment'];

	$check_hiv_ii__re = check_hiv_ii__re($lab_staff_id,$patient_id);

	if($check_hiv_ii__re){

		
  $_SESSION['err_msg'] = "
 <div class='alert alert-info alert-white rounded'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
		<div class='icon'><i class='fa fa-times-circle'></i></div>
		<strong> Patient Lab Request Already Processed By You! </strong> 
 </div>
 ";
	}
  else{
		$inserted =  insert_general_test($request_code,$patient_id,$lab_staff_id,$HIV_II,$HIV_II_STATUS,$comment);
		
		if($inserted){
 
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Patient Lab Request Submitted And Sent! </strong> 
			 </div>
			 ";				
					
				}else {
			
					
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Failed To Process And Send Lab Results! </strong> 
			 </div>
			 ";				
					 
				}

	}
      
}


if(isset($_POST['HIV_III'])){

	 
    $HIV_III = $_POST['HIV_III'];
    $HIV_III_STATUS = $_POST['HIV_III_STATUS']; 
	$comment_HIV_III_STATUS = $_POST['comment_HIV_III_STATUS'];

	$check_hiv_iii__re = check_hiv_iii__re($lab_staff_id,$patient_id);

	if($check_hiv_iii__re){

		$is_exist = true;

	}else{
     $is_exist = false;

	}
 
		$inserted =  insert_general_test($request_code,$patient_id,$lab_staff_id,$HIV_III,$HIV_III_STATUS,$comment_HIV_III_STATUS,$is_exist);
		
		if($inserted){
 
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Patient Lab Request Submitted And Sent! </strong> 
			 </div>
			 ";				
					
				}else {
			
					
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Failed To Process And Send Lab Results! </strong> 
			 </div>
			 ";				
					 
				}}



if(isset($_POST['SERUM_PREGNANCY_TEST'])){

	 
    $SERUM_PREGNANCY_TEST = $_POST['SERUM_PREGNANCY_TEST'];
    $SERUM_PREGNANCY_TEST_STATUS = $_POST['SERUM_PREGNANCY_TEST_STATUS']; 
	$comment = $_POST['comment_SERUM_PREGNANCY_TEST'];

	$check_serum_preg_test = check_serum_preg_test($lab_staff_id,$patient_id);

	if($check_serum_preg_test){
    $is_exist = true;
	}else{
		$is_exist = false;
	}
  
		$inserted =  insert_general_test($request_code,$patient_id,$lab_staff_id,$SERUM_PREGNANCY_TEST,$SERUM_PREGNANCY_TEST_STATUS,$comment,$is_exist);
		
		if($inserted){
 
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Patient Lab Request Submitted And Sent! </strong> 
			 </div>
			 ";				
					
				}else {
			
					
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Failed To Process And Send Lab Results! </strong> 
			 </div>
			 ";				
					 
				}}




if(isset($_POST['URINE_PREGNANCY_TEST'])){

	 
    $URINE_PREGNANCY_TEST = $_POST['URINE_PREGNANCY_TEST'];
    $URINE_PREGNANCY_TEST_STATUS = $_POST['URINE_PREGNANCY_TEST_STATUS']; 
	$comment = $_POST['URINE_PREGNANCY_TESTcomment'];

	$check_urine_preg_test = check_urine_preg_test($lab_staff_id,$patient_id);

	if($check_urine_preg_test){

		$is_exist = true;

	}else{

		$is_exist = false;
	}
		$inserted =  insert_general_test($request_code,$patient_id,$lab_staff_id,$URINE_PREGNANCY_TEST,$URINE_PREGNANCY_TEST_STATUS,$comment,$is_exist);
		
		if($inserted){
 
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Patient Lab Request Submitted And Sent! </strong> 
			 </div>
			 ";				
					
				}else {
			
					
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Failed To Process And Send Lab Results! </strong> 
			 </div>
			 ";				
					 
				}}

				if(isset($_POST['COVID_9_ANTIGEN_test'])){

	 
					$COVID_9_ANTIGEN_test = $_POST['COVID_9_ANTIGEN_test'];
					$COVID_9_ANTIGEN_STATUS = $_POST['COVID_9_ANTIGEN_STATUS']; 
					$get_covid_19Tcomment = $_POST['get_covid_19Tcomment'];
				
					$check_covid_19 = check_covid_19($lab_staff_id,$patient_id);
				
					if($check_covid_19){
				
						$is_exist = true;
				
					}else{
				
						$is_exist = false;
					}
						$inserted =  insert_general_test($request_code,$patient_id,$lab_staff_id,$COVID_9_ANTIGEN_test,$COVID_9_ANTIGEN_STATUS,$get_covid_19Tcomment,$is_exist);
						
						if($inserted){
				 
							$_SESSION['err_msg'] = "
							<div class='alert alert-info alert-white rounded'>
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
									<div class='icon'><i class='fa fa-times-circle'></i></div>
									<strong> Patient Lab Request Submitted And Sent! </strong> 
							 </div>
							 ";				
									
								}else {
							
									
							$_SESSION['err_msg'] = "
							<div class='alert alert-info alert-white rounded'>
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
									<div class='icon'><i class='fa fa-times-circle'></i></div>
									<strong> Failed To Process And Send Lab Results! </strong> 
							 </div>
							 ";				
									 
								}}


if(isset($_POST['ESR_LEVEL'])){

	 
    $ESR_LEVEL_value = $_POST['ESR_LEVEL_value'];
   

	$check_level_esr_ = check_level_esr_($lab_staff_id,$patient_id);

	if($check_level_esr_){
		$is_exist = true;

	}else{
$is_exist = false;
	}
 
		$inserted =  insert_level_esr( $request_code, $patient_id, $lab_staff_id, $ESR_LEVEL_value,$is_exist );
		
		if($inserted){
 
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Patient Lab Request Submitted And Sent! </strong> 
			 </div>
			 ";				
					
				}else {
			
					
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Failed To Process And Send Lab Results! </strong> 
			 </div>
			 ";				
					 
		}}

		if(isset($_POST['OGTT'])){

	 
			$OGTT_LEVEL_value = $_POST['GLUCOSE_LEVEL'];
		   
		
			$check_level_glucose_ = check_level_glucose_($lab_staff_id,$patient_id);
		
			if($check_level_glucose_){
				$is_exist = true;
		
			}else{
		$is_exist = false;
			}
		 
				$inserted =  insert_level_glucose( $request_code, $patient_id, $lab_staff_id, $OGTT_LEVEL_value,$is_exist );
				
				if($inserted){
		 
					$_SESSION['err_msg'] = "
					<div class='alert alert-info alert-white rounded'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
							<div class='icon'><i class='fa fa-times-circle'></i></div>
							<strong> Patient Lab Request Submitted And Sent! </strong> 
					 </div>
					 ";				
							
						}else {
					
							
					$_SESSION['err_msg'] = "
					<div class='alert alert-info alert-white rounded'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
							<div class='icon'><i class='fa fa-times-circle'></i></div>
							<strong> Failed To Process And Send Lab Results! </strong> 
					 </div>
					 ";				
							 
				}}



if(isset($_POST['CRP_LEVEL'])){

	 
    $CRP_LEVEL_value = $_POST['CRP_LEVEL_value'];
	$CRP_EVALUATION = $_POST['CRP_EVALUATION'];

	$CRP_LEVEL_value = str_replace(' ','',$CRP_LEVEL_value);

	$CRP_LEVEL_value_operator = $CRP_LEVEL_value[0];

	if($CRP_LEVEL_value_operator == ">" || $CRP_LEVEL_value_operator =="<"){

		$CRP_LEVEL_value_ON_OPERATION = substr_replace($CRP_LEVEL_value," ",1, -strlen($CRP_LEVEL_value));
	}else{
		$CRP_LEVEL_value_ON_OPERATION = $CRP_LEVEL_value;
	}
   

	$check_level_crp_ = check_level_crp_($lab_staff_id,$patient_id);

	if($check_level_crp_){
		$is_exist = true;

	}else {
		$is_exist = false;
		
	}
  
		$inserted =  insert_level_crp( $request_code, $patient_id, $lab_staff_id, $CRP_LEVEL_value_ON_OPERATION,$CRP_EVALUATION,$is_exist );
		
		if($inserted){
 
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Patient Lab Request Submitted And Sent! </strong> 
			 </div>
			 ";				
					
				}else {
			
					
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Failed To Process And Send Lab Results! </strong> 
			 </div>
			 ";				
					 
}}



if(isset($_POST['BLOOD_GROUP'])){

	 
    $BLOOD_GROUP_value = $_POST['BLOOD_GROUP_value'];

  
   

	$check_level_blood_ = check_level_blood_($lab_staff_id,$patient_id);

	if($check_level_blood_){
$is_exist = true;
	}else{
$is_exist  = false;
	}

 
		$inserted =  insert_blood_group( $request_code, $patient_id, $lab_staff_id, $BLOOD_GROUP_value,$is_exist );
		
		if($inserted){
 
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Patient Lab Request Submitted And Sent! </strong> 
			 </div>
			 ";				
					
				}else {
			
					
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Failed To Process And Send Lab Results! </strong> 
			 </div>
			 ";				
					 
				}
      
}



if(isset($_POST['URIC_ACID_LEVEL'])){

	 
    $URIC_ACID_LEVEL_value = $_POST['URIC_ACID_LEVEL_value'];
   

	$check_level_uric_acid_ = check_level_uric_acid_($lab_staff_id,$patient_id);

	if($check_level_uric_acid_){

		$is_exist = true;
	}else {
		# code...
		$is_exist = false;

	}
  
		$inserted =  insert_uric_acid( $request_code, $patient_id, $lab_staff_id, $URIC_ACID_LEVEL_value,$is_exist );
		
		if($inserted){
 
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Patient Lab Request Submitted And Sent! </strong> 
			 </div>
			 ";				
					
				}else {
			
					
			$_SESSION['err_msg'] = "
			<div class='alert alert-info alert-white rounded'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='icon'><i class='fa fa-times-circle'></i></div>
					<strong> Failed To Process And Send Lab Results! </strong> 
			 </div>
			 ";				
					 
				}
      
}


 





if(isset($patient_id) && isset($request_code) && isset($lab_no) && isset($_POST['submit_lab_request'])){

	$status = 1;
	$view_status = 1;
	$processed_date = $date = date('Y-m-d');


	send_lab_results($patient_id, $request_code, $lab_staff_id, $status,$view_status, $processed_date,$lab_no);

	$_SESSION['saved_status'] = 1;

}elseif(isset($patient_id) && isset($request_code) && isset($lab_no) && isset($_POST['cancel_lab_request'])){

	$status = 0;
	$view_status = 0;
	$processed_date = $date = date('Y-m-d');


	send_lab_results($patient_id, $request_code, $lab_staff_id, $status,$view_status, $processed_date,$lab_no);

	$_SESSION['saved_status'] = 0;

	$_SESSION['err_msg_unsaved'] = "
	<div class='alert alert-info alert-white rounded'>
			<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
			<div class='icon'><i class='fa fa-times-circle'></i></div>
			<strong> Results Closed/Cancel To Be Submitted Later!!! </strong> 
	 </div>
	 ";				


}
 
//cancel_lab_request
 

 
	 	
									 

header("Location: ../view_lab_list");
?>