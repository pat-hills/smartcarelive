<?php
require_once "../../../functions/func_nhis.php";
//if(!empty($_POST['v1']) or !empty($_POST['v2']) or !empty($_POST['v3']) or !empty($_POST['v4']) or !empty($_POST['duOfsp'])){
$v1 = $_POST['v1'];
$v2 = $_POST['v2'];
$v3 = $_POST['v3'];
$v4 = $_POST['v4'];
$duOfsp = $_POST['duOfsp'];
$visitcode = $_POST['visitcode'];



if(updateNHIS_DateProvision($v1,$v2,$v3,$v4,$duOfsp,$visitcode)){
echo true;die();
}else{
echo false;die();
}

//}else{
//echo false;die();
//}




?>