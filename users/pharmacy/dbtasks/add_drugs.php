<?php
//////////////////////////////////////
require_once '../../../functions/func_pharmacy.php';
require_once '../../../functions/conndb.php';
session_start();
/////////////////////////////////////

$drug_name= $_POST['dname'];
$drug_code = $_POST['dcode'];
//$nhis = $_POST['nhis'];
$expdate = $_POST['expdate'];
$qty = $_POST['qty'];
$type = $_POST['type'];
$price = $_POST['price'];
//$gdrg = $_POST['gdrg'];
$reorderlevel = $_POST['reorderlevel'];
$manu = $_POST['manu'];

echo $drug_name."<br />";
echo $drug_code."<br />";
//echo $nhis."<br />";
echo $expdate."<br />";
echo $qty."<br />";
echo $type."<br />";
echo $price."<br />";
//echo $gdrg."<br />";
echo $reorderlevel."<br />";
echo $manu."<br />";



if(isset($drug_name)&& isset($expdate) && isset($qty) && isset($type) && isset($price) && isset($reorderlevel)){
	
	$_SESSION['add_drug']="<div class='alert alert-success alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-check'></i></div>
								<strong>Info!</strong> New Drug Added !
							 </div>";
	add_drug($drug_name,$expdate,$qty,$type,$price,$reorderlevel,$drug_code,$manu);
	header("Location: ../add_drug");
	
}else{
	$_SESSION['add_drug']="<div class='alert alert-warning alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-check'></i></div>
								<strong>Warning!</strong> All fields are required!
							 </div>";
	
	header("Location: ../add_drug");
}





?>