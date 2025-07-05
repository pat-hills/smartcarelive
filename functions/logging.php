<?php
//session_start();
require_once 'conndb.php';
global $connection;
if (isset($_SESSION['uid'])) {

    $userphone = $_SESSION['uid'];
   // $username = $_SESSION['username'];
//$useraccess = $_SESSION['access'];
   // $loggedincode = $_SESSION['loggedincode'];

   // $_SESSION['dbcode'] = "";

    $logtime = gmdate(" H:i:s", time());
    $logdate = date("F j, Y");
    $logid = $userphone . $logdate . uniqid();

    $logquery = "INSERT INTO  audit_trail SET"
            . " log_date = '$logdate', log_time = '$logtime', "
            . " log_id = '$logid', user = '$userphone', "
            . "activity = '$activity', user_page_accessed = '$useraccess', deleted = 'NO' ";
    mysqli_query($connection, $logquery) or die(mysqli_error($connection));

  

 
}else{
     header('location:' . 'index');
}