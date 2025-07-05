<?php
	require '../../functions/conndb.php';
    require '../../functions/func_common.php';
    require '../../functions/func_admin.php';
    session_start(); 

	global $connection;

	$del_id = $_GET['id'];
	
	$sql="DELETE FROM tbl_ward WHERE id='".$del_id."'";

	$remove_investigation = mysqli_query($connection,$sql);
	
	 $url = explode('?', $_SERVER['HTTP_REFERER']);
        header('Location:' . $url[0] . '?a=6');