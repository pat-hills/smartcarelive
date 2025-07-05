<?php
require_once "../../../functions/func_nhis.php";

if(isset($_POST['servicea']) and isset($_POST['serviceb']) and isset($_POST['pharm'])){

$servicea = $_POST['servicea'];
$serviceb = $_POST['serviceb'];
$pharm = $_POST['pharm'];
if(NHIS_Services($servicea,$serviceb,$pharm)){
return true;
}else{
return false;
}


}







?>