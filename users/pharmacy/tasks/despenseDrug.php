<?php
session_start();
require_once '../../../functions/func_pharmacy.php';

$_SESSION['hideButton'] = 1;
$drugcode = $_GET['drugcode'];
$qty = $_GET['qty'];
//$qty_depensed = $_GET['qty_depensed'];
if(!empty($drugcode) and !empty($qty)){
//add to depense db and 
	$patient_id = $_SESSION['patient_id'];
if(add_to_depense_db($_SESSION['uid'],$patient_id,$drugcode,$qty))
{
//reduce the number of quantity in db
	if(UpdateDrugQuantity($drugcode,$qty))
	{

		
		header('Location:'.$_SERVER['HTTP_REFERER']);
		//header("Location: ../tasks/despense.php");
die();

	}else{

		header('Location:'.$_SERVER['HTTP_REFERER']);
die();

	}

}else{
	header('Location:'.$_SERVER['HTTP_REFERER']);
die();

}



//return solution	










}else{

	echo "Cannot Process Action";

}


?>