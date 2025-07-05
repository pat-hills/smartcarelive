<?php
	include "../../../functions/func_nhis.php";
if(!empty($_POST['hicode']))
{
$hicode = $_POST['hicode'];
if(saveSetings($_SESSION['uid'],$hicode)){

header('location:../settings.php?message=saved');exit();
}else{
header('location:../settings.php?message=unable to save');exit();
}


}

?>