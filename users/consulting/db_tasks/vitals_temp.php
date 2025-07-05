<?php
header('Content-Type: application/json');

require_once '../../../functions/conndb.php';
session_start();

global $connection;
#Pie Chart
 
   $user_id = $_SESSION['patient_id']; 
   //$dbcon = con_con(); 

   
  $query = "SELECT date_taken,weight,temperature,pulse FROM tbl_patient_biovitals WHERE patient_id = '$user_id' ORDER BY date_taken";

   $result = mysqli_query($connection,$query);
    

  $data = array();
foreach ($result as $row) {
	$data[] = $row;
}
 

echo json_encode($data);
         
         
 
        
            


 

       