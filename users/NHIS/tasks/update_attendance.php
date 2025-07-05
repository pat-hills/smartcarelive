<?php
require_once "../../../functions/func_nhis.php";
if(!empty($_POST['Attendance']) and !empty($_POST['Specialitycode']) and !empty($_POST['attendance_code'])){
$Attendance = $_POST['Attendance'];
$Specialitycode = $_POST['Specialitycode'];
$attendance_code = $_POST['attendance_code'];
if(updateNHIS_attendance($Attendance,$Specialitycode,$attendance_code)){
echo true;die();
}else{
echo false;die();
}

}else{
echo false;die();
}




?>