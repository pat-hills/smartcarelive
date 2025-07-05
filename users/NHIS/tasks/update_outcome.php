<?php
require_once "../../../functions/func_nhis.php";

if(!empty($_POST['outcome']) and !empty($_POST['outcome_code'])){
$outcome = $_POST['outcome'];
$outcome_code = $_POST['outcome_code'];
if(updateNHIS_Outcome($outcome,$outcome_code)){
echo true;die();
}else{
echo false;die();
}

}else{
echo false;
}




?>