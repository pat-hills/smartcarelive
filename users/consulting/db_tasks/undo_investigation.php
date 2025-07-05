<?php
//this file deletes any entry entered by recieving the id of the complain
require_once '../../../functions/conndb.php';
require_once '../../../functions/func_consulting.php';
@session_start();
$del_id=$_GET['id'];
global $connection;
@$patient_id = $_SESSION['patient_id'];
$request_code = select_request_code($patient_id);

$sql="DELETE FROM tbl_req_investigation WHERE id='".$del_id."'";

$remove_investigation =mysqli_query($connection,$sql);

if($remove_investigation){

remove_investigation_payment($patient_id, $request_code);

}
$_SESSION['ac_tab']=4;
$_SESSION['inves_err']="<div class='alert alert-warning alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-warning'></i></div>
								<strong>Info!</strong> Change has taken effect !
							 </div>";
header("Location: ../treat_patient");

?>