<?php
//this file deletes any entry entered by recieving the id of the complain
require_once '../../../functions/conndb.php';
require_once '../../../functions/func_lab.php';
@session_start();
$del_id=$_GET['id'];
$exist=$_GET['exist'];
global $connection;


$get_investigation = get_investigation_price($del_id);

//$sql="DELETE FROM tbl_walk_in_request_investigation WHERE id='".$del_id."'";

//$remove_investigation =mysqli_query($connection,$sql);

if($get_investigation){
 
//$_SESSION['ac_tab']=10;
$_SESSION['err_msg']="<div class='alert alert-warning alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-warning'></i></div>
								<strong>Info!</strong> Walk In Removed!
							 </div>";
							 
 $Investigation_name = $get_investigation['Investigations'];
 $Investigation_price = $get_investigation['Tarriffs'];

 $Investigation_ID = $get_investigation['ID'];

 $_SESSION['Investigation_name'] = $Investigation_name;

 $_SESSION['Investigation_price'] = $Investigation_price;

 $_SESSION['Investigation_ID'] = $Investigation_ID;


	header("Location: ../add_investigations");
 	

}
?>