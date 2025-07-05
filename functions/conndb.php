<?php

 

$connection ="";

 

  $hostdb = "52.91.29.65";   
  $userdb = "admin";   
  $passdb = "admin123";   
  $namedb = "smart_care_live"; 
  
   
  $connection = new mysqli($hostdb, $userdb, $passdb, $namedb);
  
   
  if($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
  }



 





?>