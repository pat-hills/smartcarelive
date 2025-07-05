<?php
//this file deletes any entry entered by recieving the id of the complain
require_once '../../../functions/conndb.php';
global $connection;
session_start();
$del_id=$_GET['id'];

$sql="DELETE FROM tbl_patient_notes WHERE id='".$del_id."'";

$a=mysqli_query($connection,$sql);
$_SESSION['ac_tab']=13;
$_SESSION['notes_err']="<div class='alert alert-warning alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-warning'></i></div>
								<strong>Info!</strong> Change has taken effect !
							 </div>";
header("Location: ../treat_patient");


?>