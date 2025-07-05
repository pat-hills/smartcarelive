<?php
require '../../../functions/func_pharmacy.php';
require '../../../functions/func_common.php';
 //header('Content-type: application/text');

 /*  $drugcode = $_POST['drugcode'];
   $patient_id = $_POST['patient_id'];
   $totalcost = $_POST['totalcost'];
   $seldrugcodes = $_POST['seldrugcodes'];
   $uid = $_POST['uid']; */
   
   
   $drugcode = "ddd";
   $patient_id = "ddd";
   $totalcost = "ddd";
   $seldrugcodes = "ddd";
   $uid = "ddd";
   
   
   
   if(!empty($drugcode) AND !empty( $patient_id) 
  AND !empty($totalcost) AND !empty( $seldrugcodes) AND !empty($uid)){
   if(sendCashier($uid,$patient_id,$seldrugcodes,$totalcost)){
   echo json_encode(array('flag'=>1));
  die();
   }else{
    echo json_encode(array('flag'=>0));
  die();  }
  
  }else{
  echo json_encode(array('flag'=>0));
  die(); }
   
   
   
  
   
  
  
  

?>