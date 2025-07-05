<?php

session_start();



$_SESSION['full_name'] = "";
$_SESSION['gender'] = "";
$_SESSION['dob'] = "";
$_SESSION['contact'] = "";




header("Location: ../all_walk_patients");

?>