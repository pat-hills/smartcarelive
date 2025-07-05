<?php
//this file deletes any entry entered by recieving the id of the complain
require_once '../../../functions/conndb.php';
require_once "../../../functions/func_opd.php";
session_start();

$del_id = $_GET['id'];
$patient_id= $_SESSION['patient_id'];

$sql="DELETE FROM tbl_consulting WHERE id='".$del_id."'";

$remove_consulting = mysql_query($sql);
$remove_services = remove_services($patient_id);

$_SESSION['err_msg']="<div class='alert alert-warning alert-white rounded'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
						<div class='icon'><i class='fa fa-warning'></i></div>
						<strong>Info!</strong> Consulting has been Cancelled !
					 </div>";
							 

header("Location: ../consult.php");

?>