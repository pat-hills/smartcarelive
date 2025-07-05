<?php

require_once ('../../../functions/conndb.php');


if(isset($_POST['dcode']) && isset($_POST['nhis']) &&
isset($_POST['expdate']) && isset($_POST['qty']) && isset($_POST['dname']) && isset($_POST['price']) && isset($_POST['type'])){
$code=$_POST['dcode'];
$nhis=$_POST['nhis'];
$expdate=$_POST['expdate'];
$qty=$_POST['qty'];
$price=$_POST['price'];
$type=$_POST['type'];
$name=$_POST['dname'];



$sql="UPDATE tbl_drug_list SET drug_code='".$code."',Name='".$name."',scheme_info='".$nhis."',
Expiry_date='".$expdate."',quantity='".$qty."',type='".$type."',price='".$price."'
WHERE drug_code='".$code."'";

if($update_query=mysql_query($sql)){
	$_SESSION['err_msg'] = "<div class='alert alert-info alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-times-circle'></i></div>
								<strong>Success!</strong> Patient medical information updated. Please refresh page to see results!
							 </div>";
	header("Location: ../update_drug.php");

}else{
	echo "error ".mysql_error();
}
}else{
	echo "values not";
}//end of if statement



?>


