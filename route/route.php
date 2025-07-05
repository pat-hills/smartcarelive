<?php
//this file helps send each user to the correct landing page

require_once "../functions/conndb.php";
require_once "../functions/login.php";

if($_POST['changePass']){


if (isset($_POST['pass'])){
	//initiate branching by function call
	$pass=$_POST['pass'];
	$usertype=$_POST['usertype'];
	$userid=$_POST['userid'];
	
	if(changePassword($pass,$userid))
   {
   
   switch($usertype){
   case 1:
   	header("Location: ../admin/");
   break;exit();
   case 2:
   	header("Location: ../users/consulting/");
   break;exit();
   case 3:
   	header("Location: ../users/opd/");
   break;exit();
   case 4:
   	header("Location: ../users/cashier/");
   break;exit();
   case 5:
  header("Location: ../users/records/");
   break;exit();
    case 6:
header("Location: ../users/pharmacy/");
   break;exit();
    case 7:
header("Location: ../users/lab/");
   break;exit();
    case 8:
 header("Location: ../users/NHIS/");
   break;exit();
   case 9:
      header("Location: ../users/acc/");
        break;exit();
   
   }

   }else{
     header("Location: " . $_SERVER['HTTP_REFERER']);exit();
    
   }	
}else{
echo 'fgdsg';
}








}else{


if (isset($_POST['uname']) && isset($_POST['pass'])){
	//initiate branching by function call
	$a=$_POST['uname'];
	$b=$_POST['pass'];
	
	login($a,$b);	
}

}
?>