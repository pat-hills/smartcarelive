<?php
//this file deletes any entry entered by recieving the id of the complain
require_once '../../../functions/conndb.php';
require_once '../../../functions/func_consulting.php';
@session_start();
$del_id=$_GET['id'];
global $connection;

$sql="DELETE FROM tbl_req_scan WHERE id='".$del_id."'";

$remove_investigation =mysqli_query($connection,$sql);

if($remove_investigation){
 
$_SESSION['ac_tab']=15;
$_SESSION['allergy_err']="<div class='alert alert-warning alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-warning'></i></div>
								<strong>Info!</strong> Patient Scan Remove!
							 </div>";
							 
header("Location: ../treat_patient");
}
?>