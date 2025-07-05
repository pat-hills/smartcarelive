<?php
require_once "../../../functions/func_nhis.php";
 
if(!empty($_POST['Attendance']) and !empty($_POST['Specialitycode']) ){
$Attendance = $_POST['Attendance'];
$Specialitycode = $_POST['Specialitycode'];

if(NHIS_attendance($Attendance,$Specialitycode)){
echo true;die();
}else{
echo false;die();
}

}else{
echo false;
}




?>