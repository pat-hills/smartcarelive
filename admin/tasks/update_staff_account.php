<?php

require '../../functions/conndb.php';
require '../../functions/func_admin.php';
session_start();

$user_id = $_SESSION['get_staff_id'];
$user_type = $_POST['user_type'];
$username = $_POST['username'];
$firstname = $_POST['firstname'];
$othernames = $_POST['othernames'];
$gender = $_POST['gender'];
$dob = $_POST['dob'];
$occupation = $_POST['occupation'];
$phone_number = $_POST['phone_number'];
$email = $_POST['email'];
$address = $_POST['address'];
$url = $_POST['url'];
$password = $_POST['password'];
$ifnotpassword = $_POST['ifnotpassword'];


if ($password == "#######"){
$updated = update_staff_account($user_id, $user_type, $username,$ifnotpassword, $firstname, $othernames, $gender, $dob, $occupation, $phone_number, $email, $address);
}  else { 
$updated = update_staff_account($user_id, $user_type, $username,md5($password), $firstname, $othernames, $gender, $dob, $occupation, $phone_number, $email, $address);
}
if ($updated) {
    //echo "Staff '".$firstname. "''/s account has been updated successfully";
    $_SESSION['successMsg'] = "Staff '" . $firstname . "'s account has been updated successfully";
    if (!empty($url)) {

        header("Location: " . $url);
    } else {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
} else {
    $_SESSION['errorMsg'] = "Sorry account could not be updated";
    if (!empty($url)) {

        header("Location: " . $url);
    } else {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}
    
    