<?php
require_once "../../../functions/func_nhis.php";

if(isset($_POST['servicea']) and isset($_POST['serviceb']) and isset($_POST['pharm'])
and isset($_POST['service_code'])
){

$servicea = $_POST['servicea'];
$serviceb = $_POST['serviceb'];
$pharm = $_POST['pharm'];
$service_code = $_POST['service_code'];

if(updateNHIS_Services($servicea,$serviceb,$pharm,$service_code)){
return true;
}else{
return false;
}


}
?>