<?php
//this file deletes any entry entered by receiving the id of the complain
require_once '../../../functions/conndb.php';
session_start();
$del_id=$_GET['id'];

$sql="DELETE FROM tbl_diagnosis WHERE id='".$del_id."'";

$a=mysql_query($sql);
$_SESSION['ac_tab']=6;
$_SESSION['diag_err']="<div class='alert alert-warning alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-warning'></i></div>
								<strong>Info!</strong> Diagnosis has been removed !
							 </div>";
header("Location: ../treat_patient");

?>