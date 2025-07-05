<?php
require_once "../../../functions/func_nhis.php";
$Patientid = $_POST['patient_id'] ;
$thedata=  getPatientsClaimData($Patientid);
if($thedata){
echo $thedata;die();
}else{
echo  false;die();
}


?>