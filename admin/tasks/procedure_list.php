<?php

require '../../functions/conndb.php';
require '../../functions/func_admin.php';
session_start();


if (isset($_POST['add_procedure'])) {

    $procedure = $_POST['procedure'];
    $gdrgcode = $_POST['gdrgcode'];
    $tariffs = $_POST['tariffs'];
     $nhis = $_POST['nhis'];
    $category = $_POST['category'];

    $inserted = add_procedure($procedure, $category, $tariffs, $gdrgcode, $nhis);

    if ($inserted) { 
        $url = explode('?', $_SERVER['HTTP_REFERER']);
        header('Location:' . $url[0] . '?a=7');
    } else {
        $url = explode('?', $_SERVER['HTTP_REFERER']);
        header('Location:' . $url[0] . '?a=8');
    }
} 

