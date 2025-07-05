<?php
session_start();
require_once "../../../functions/conndb.php";
require_once '../../../functions/MPDF/mpdf.php';
$mpdf=new mPDF(); 
$drugstoprint = $_SESSION['drugstoprint'];
$outOfStockDrugs = $_SESSION['outOfStockDrugs'];


foreach( $drugstoprint as $getDrugs){


//get drug names
$theQuery = "SELECT Name FROM tbl_drug_list WHERE drug_code='".$getDrugs."' ";
$drugnames = mysql_query($theQuery);

if(mysql_affected_rows() >0)
{
  while($names = mysql_fetch_array($drugnames)){
  	$mpdf->WriteHTML('<strong>'.$names['Name'].'</strong><br>');
  
  }
}else{
echo 'yaawa';
}

}



 //ob_clean();
//$mpdf->Output();
exit;











?>