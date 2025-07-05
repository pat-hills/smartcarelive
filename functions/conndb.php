<?php

//error_reporting(0);

//require_once "func_constant.php";

$connection ="";

// if(IS_ON_PRODUCTION){

  $hostdb = "localhost";   
  $userdb = "root";   
  $passdb = "";   
  $namedb = "smart_care_live"; 
  
   
  $connection = new mysqli($hostdb, $userdb, $passdb, $namedb);
  
   
  if($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
  }



// else{

//   $hostdb = "localhost";   
//   $userdb = "taugscsf_sch2021";   
//   $passdb = "sch_2021_sch_2021";   
//   $namedb = "taugscsf_sch2021"; 
  
   
//   $connection = new mysqli($hostdb, $userdb, $passdb, $namedb);
  
   
//   if ($connection->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
//   }






?>