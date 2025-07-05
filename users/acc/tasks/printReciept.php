<?php
require_once '../../../functions/func_cashier.php';
require_once '../../../functions/MPDF/mpdf.php';
session_start();
$theTranscodes =  $_SESSION['transcode2print'];
print_r($theTranscodes);die();
$mpdf=new mPDF(); 
if(!empty($theTranscodes)){  ?>

<?php
///...............drug receipt......./////////////////////
$mpdf->WriteHTML('
<table>
								<thead>
									<tr>
										<th style="width:50%;">Drug Name</th>
										
										<th style="width:50%;">Amount (GHS)</th>
									</tr>
								</thead>
								<tbody> 
				');
	$getTheInfo  =get_receipt_info_4rmTranscode($_SESSION['transcode']);
			

	//remove commas from the codes
   
	 
			?>
			
		
               							
					
	
	<?php $mpdf->WriteHTML('</td></tr>'); ?>								
<?php $mpdf->WriteHTML('</tbody></table>
<br><br><br><br><br>
Total :
					  '); 
?>
					  
					  
					  
<?php ob_clean();
$mpdf->Output();
exit;
?>



<?php

}else{
header("Location: ../add_payment.php?message=error printing receipt ");
die();
}





?>