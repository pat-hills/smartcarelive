<?php
	require '../../functions/conndb.php';
    require '../../functions/func_common.php';
    require '../../functions/func_admin.php';
    session_start(); 

	global $connection,$error;

	$del_id = $_GET['id'];
	
	$sql="DELETE FROM tbl_investigations WHERE id='".$del_id."'";

	$remove_investigation = mysqli_query($connection,$sql);

	$error = 3;
	
//	 $url = explode('?', $_SERVER['HTTP_REFERER']);
        header('Location:' . "../add_investigations");