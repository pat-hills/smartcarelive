<?php
//this file deletes any entry entered by recieving the id of the complain
require_once '../../../functions/conndb.php';
require_once '../../../functions/func_constant.php';
session_start();
global $connection;
$del_id=$_GET['id'];

$sql = "SELECT drug_code FROM `tbl_precribtion` WHERE id='".$del_id."'";
	$query_run = mysqli_query($connection,$sql);
	$rows = mysqli_fetch_assoc($query_run);
	$drug_code = $rows['drug_code'];

	$sqldrug_code="DELETE FROM drug2depenseinfo WHERE drug_codes='".$drug_code."'";
	$a=mysqli_query($connection,$sqldrug_code);
	
    $sql="DELETE FROM tbl_precribtion WHERE id='".$del_id."'";

    $a=mysqli_query($connection,$sql);
$_SESSION['ac_tab']=7;
$_SESSION['presc_err']="<div class='alert alert-warning alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-warning'></i></div>
								<strong>Info!</strong> Drug prescribtion has been removed !
							 </div>";
header("Location: ../treat_patient");


?>