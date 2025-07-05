<?php
	require '../../functions/conndb.php';
    require '../../functions/func_common.php';
    require '../../functions/func_admin.php';
    session_start();
	
	global $connection;

	$del_id = $_GET['id'];
	
	$sql="DELETE FROM doctors_room WHERE id='".$del_id."'";

	$remove_doctor_assign = mysqli_query($connection,$sql);
	
	$_SESSION['errorMsg']="Consulting has been Cancelled !";
	
	header("Location: ../assign_room.php");