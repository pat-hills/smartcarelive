<?php
require_once '../../../functions/func_cashier.php';
//invest_transcode

//check what type of payment
if(!empty($_POST['transcode']) and !empty($_POST['patient_id'])){
$transcode = $_POST['transcode'];
$patient_id = $_POST['patient_id'];
$paymentstate = $_POST['paymentstate'];

//set session for array transcode for easy printing
$_SESSION['transcode2print']  = $transcode;


if(processesPayment($patient_id,$transcode,$paymentstate) )
{
	
header("Location: ../add_payment.php?message=success");
die();

}else{

header("Location: ../add_payment.php?message=unable to process payment");
die();

}

}else{
header("Location: ../add_payment.php?message=unable to process payment");
die();
}

?>