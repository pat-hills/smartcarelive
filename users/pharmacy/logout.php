<?php

require '../../functions/conndb.php';
require '../../functions/func_common.php';
//require '../../functions/func_lab.php';
session_start();

$staff_id = $_SESSION['uid'];
//$staff_info = get_staff_info($staff_id);

if( isset($_SESSION['uid']) ){
    
    offline($_SESSION['username']);
    logout();
    header("Location: ../../index");
    
} else {
    header("Location: ../../index");
}

?>