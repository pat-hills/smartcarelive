<?php
	include "../../../functions/func_nhis.php";
if(!empty($_POST['hicode']) and !empty($_POST['securitycode']))
{
$hicode = $_POST['hicode'];
$securitycode = $_POST['securitycode'];
if(EditSetings($_SESSION['uid'],$hicode,$securitycode)){

header('location:../settings.php?message=updated');exit();
}else{
header('location:../settings.php?message=noting to update');exit();
}


}else{
header('location:../settings.php?message=fill the form');exit();
}

?>