<?php
//////////////////////////////////////
require_once '../../../functions/func_consulting.php';
require_once '../../../functions/conndb.php';
session_start();
/////////////////////////////////////

$drug_name= $_POST['dname'];

//$nhis = $_POST['nhis'];
$expdate = $_POST['expdate'];

echo $drug_name."<br />";
 
//echo $nhis."<br />";
echo $expdate."<br />";



if(isset($drug_name)&& isset($expdate)){
	
	$_SESSION['add_drug']="<div class='alert alert-success alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-check'></i></div>
								<strong>Info!</strong> New Drug Added !
							 </div>";
							 add_drug($drug_name,$expdate);
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