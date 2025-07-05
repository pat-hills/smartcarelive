<?php
require_once "../../../functions/func_nhis.php";

if(!empty($_POST['outcome'])){
$outcome = $_POST['outcome'];
if(NHIS_Outcome($outcome)){
echo true;die();
}else{
echo false;die();
}

}else{
echo false;
}




?>