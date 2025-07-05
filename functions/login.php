<?php
session_start();
require 'conndb.php';
require 'func_common.php';



function login($username, $password){
	global $connection;
	//$db = con_con();
	$password=md5($password);
	$query = "SELECT * FROM tbl_login WHERE uname ='".$username."'AND pass = '".$password."' LIMIT 0,1";
	
	if ($query_run = mysqli_query($connection,$query)){
		$answer = mysqli_num_rows($query_run);
		
		if($answer == 1){//loggin in the user if username and id exists
		//$result = mysqli_result($query_run,0, 'acc_lvl');
		$row = $query_run->fetch_assoc();
		$result = $row['acc_lvl'];
		
switch ($result) {
	case '1':
	
		//performing small htaccess with session.
			$_SESSION['logged_in'] = 1;
			//$userid = mysqli_result($query_run,0, 'userid');
           // $username = mysqli_result($query_run,0, 'uname');
			$userid = $row['userid'];
            $username = $row['uname'];
			online($username);
			$_SESSION['uid'] = $userid;
            $_SESSION['username'] = $username;

			$activity = "Logged In";
			$useraccess = "Login Page Url:/Index/";
			
			require_once "logging.php";
			header("Location: ../admin/");
			echo "1";
		break;
	case '2':
	
	//check if user has changed the default password
	
	
	
		//performing small htaccess with session.
			$_SESSION['logged_in'] = 2;
			// $userid = mysqli_result($query_run,0, 'userid');
            // $username = mysqli_result($query_run,0, 'uname');
			$userid = $row['userid'];
            $username = $row['uname'];
			online($username);
			$_SESSION['uid'] = $userid;
            $_SESSION['username'] = $username;
			 $state = $row['state'];
	
			if($state == 0){
	
	//redirect user to change password page
	header('location:../change_password.php?usertype=2&user='.$username.'&userid='.$userid.' ');exit();
	}

	$activity = "Logged In";
	$useraccess = "Login Page Url:/Index/";
	
	require_once "logging.php";
			
			
			
			header("Location: ../users/consulting/");
			//echo "2";
		break;
		
		case '3':
		$_SESSION['logged_in'] = 3;
			// $userid = mysqli_result($query_run,0, 'userid');
            // $username = mysqli_result($query_run,0, 'uname');
			$userid = $row['userid'];
            $username = $row['uname'];
			online($username);
			$_SESSION['uid'] = $userid;
            $_SESSION['username'] = $username;
			$state = $row['state'];
			if($state == 0){
	
	//redirect user to change password page
	header('location:../change_password.php?usertype=3&user='.$username.'&userid='.$userid.' ');exit();
	}
	$activity = "Logged In";
	$useraccess = "Login Page Url:/Index/";
	
	require_once "logging.php";
	
			header("Location: ../users/opd/");
			//echo "3";
		break;
		
		case '4':
		$_SESSION['logged_in'] = 4;
			// $userid = mysqli_result($query_run,0, 'userid');
            // $username = mysqli_result($query_run,0, 'uname');
			$userid = $row['userid'];
            $username = $row['uname'];
			online($username);
			$_SESSION['uid'] = $userid;
            $_SESSION['username'] = $username;
			$state = $row['state'];
			if($state == 0){
	
	//redirect user to change password page
	header('location:../change_password.php?usertype=4&user='.$username.'&userid='.$userid.' ');exit();
	}

	$activity = "Logged In";
	$useraccess = "Login Page Url:/Index/";
	
	require_once "logging.php";
			header("Location: ../users/cashier/");
			//echo "4";
		break;
		
		case '5':
		$_SESSION['logged_in'] = 5;
			// $userid = mysqli_result($query_run,0, 'userid');
            // $username = mysqli_result($query_run,0, 'uname');
			$userid = $row['userid'];
            $username = $row['uname'];
			online($username);
			$_SESSION['uid'] = $userid;
            $_SESSION['username'] = $username;
			$state = $row['state'];
			if($state == 0){
	
	//redirect user to change password page
	header('location:../change_password.php?usertype=5&user='.$username.'&userid='.$userid.' ');exit();
	}
			header("Location: ../users/records/");
			//echo "4";
		break;
		case '6':
		$_SESSION['logged_in'] = 6;
			// $userid = mysqli_result($query_run,0, 'userid');
            // $username = mysqli_result($query_run,0, 'uname');
			$userid = $row['userid'];
            $username = $row['uname'];
			online($username);
			$_SESSION['uid'] = $userid;
            $_SESSION['username'] = $username;
			$state = $row['state'];
			if($state == 0){
	
	//redirect user to change password page
	header('location:../change_password.php?usertype=6&user='.$username.'&userid='.$userid.' ');exit();
	}

	$activity = "Logged In";
	$useraccess = "Login Page Url:/Index/";
	
	require_once "logging.php";
			header("Location: ../users/pharmacy/");
			//echo "6";
		break;
		case '7':
		$_SESSION['logged_in'] = 7;
			// $userid = mysqli_result($query_run,0, 'userid');
            // $username = mysqli_result($query_run,0, 'uname');
			$userid = $row['userid'];
            $username = $row['uname'];
			online($username);
			$_SESSION['uid'] = $userid;
            $_SESSION['username'] = $username;
			$state = $row['state'];
			if($state == 0){
	
	//redirect user to change password page
	header('location:../change_password.php?usertype=7&user='.$username.'&userid='.$userid.' ');exit();
	}
	$activity = "Logged In";
	$useraccess = "Login Page Url:/Index/";
	
	require_once "logging.php";
			header("Location: ../users/lab/");
			//echo "3";
		break;
		case '8':
		$_SESSION['logged_in'] = 8;
		$userid = $row['userid'];
		$username = $row['uname'];
			online($username);
			$_SESSION['uid'] = $userid;
            $_SESSION['username'] = $username;
			$state = $row['state'];
			if($state == 0){
	
	//redirect user to change password page
	header('location:../change_password.php?usertype=8&user='.$username.'&userid='.$userid.' ');exit();
	}

	$activity = "Logged In";
	$useraccess = "Login Page Url:/Index/";
	
	require_once "logging.php";
			header("Location: ../users/NHIS/");
			//echo "3";
		break;

		case '9':
			$_SESSION['logged_in'] = 9;
			$userid = $row['userid'];
			$username = $row['uname'];
				online($username);
				$_SESSION['uid'] = $userid;
				$_SESSION['username'] = $username;
				$state = $row['state'];
				if($state == 0){
		
		//redirect user to change password page
		header('location:../change_password.php?usertype=8&user='.$username.'&userid='.$userid.' ');exit();
		}
	
		$activity = "Logged In";
		$useraccess = "Login Page Url:/Index/";
		
		require_once "logging.php";
				header("Location: ../users/acc/");
				//echo "3";
			break;
	default:
			$_SESSION['err_msg'] = "<div class='alert alert-warning alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-times-circle'></i></div>
								<strong>Invalid!</strong> Username and Password Combination!
							 </div>";
									
									
			header("Location: ../index.php");
				
		break;
}

	
}else{
	$_SESSION['err_msg'] = "<div class='alert alert-warning alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-times-circle'></i></div>
								<strong>Warning!</strong> Your credentials does not exist!
							 </div>";
									
									
		header("Location: ../index.php");
}
}else{
		//mysql query run error
		echo "Error in executing query ".mysqli_error();
		
	}

}

function changePassword($pass,$userid){

global $connection;

$state = 1;

$query = "UPDATE tbl_login SET pass='".md5($pass)."',state=".$state." WHERE userid='".$userid."'";
$run_query = mysqli_query($connection,$query);
if($run_query){
return true;
}else{
return false;
}


}



?>