<?php
session_start();
require_once "../../../functions/func_pharmacy.php";
     

	 
if (isset($_POST['patient_id']) AND isset($_POST['checked_drug']) AND isset($_SESSION['uid']) AND isset($_POST["remainqty"])
){

///generate transcode
/////////////////////////////////////////////////////////
				if(isset($_POST['print'])){
				
			  //get all the drug codes to print
			  $remainqty = $_POST['remainqty'];
			   $checked_drug = $_POST['checked_drug'];
				//$_SESSION['drugstoprint'] = $checked_drug;
				
					  echo $remainqty = joinSelectedDrugCodes($remainqty);die();	
				$checked_drug = joinSelectedDrugCodes($checked_drug);						 
			  
				//redirect to print
					header('location:print_drugs.php');
					exit();
					
					
					}
					
					if(isset($_POST['SendToCashier'])){

///////////////////////////////////////////////////////



					 $checked_drug = $_POST['checked_drug'];
					 $selqty = $_POST['selqty'];
					 //print_r($checked_drug);die();

					 $seldrugcodes = joinSelectedDrugCodes($checked_drug);
					  $selqty = joinSelectedDrugCodes($selqty);
					 
						$total_cost = $_POST['totalcost'];
					 $patient_id = $_POST['patient_id'];
					 $uid = @$_SESSION['uid'];
					 	

 if(sendCashier($uid,$patient_id,$seldrugcodes,$total_cost,$selqty)){

	header('Location:'.$_SERVER['HTTP_REFERER']); exit();
 }else{
 	
	header('Location:'.$_SERVER['HTTP_REFERER']);	exit();
      }


}//killed printing

}else{

header('Location:'.$_SERVER['HTTP_REFERER']);
exit();
}




//////////////////////////////////////




?>