<?php

 

$connection ="";

 

  $hostdb = "localhost";   
  $userdb = "root";   
  $passdb = "";   
  $namedb = "smart_care_live"; 
  
   
  $connection = new mysqli($hostdb, $userdb, $passdb, $namedb);
  
   
  if($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
  }



 





?>