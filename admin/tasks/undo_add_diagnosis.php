<?php
	require '../../functions/conndb.php';
    require '../../functions/func_common.php';
    require '../../functions/func_admin.php';
    session_start(); 

	global $connection;

	$del_id = $_GET['id'];
	
	$sql="DELETE FROM tbl_diagnosis_list WHERE id='".$del_id."'";

	$remove_diagnosis = mysqli_query($connection,$sql);
	
	header('Location:' . "../add_diagnosis");