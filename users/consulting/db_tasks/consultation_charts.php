<?php
header('Content-Type: application/json');

require_once '../../../functions/conndb.php';
session_start();

global $connection;
#Pie Chart
 
   $uid = $_SESSION['uid']; 
   $dateview = 1;
   //$dbcon = con_con(); 

   
 // $query = "SELECT date_taken,weight,temperature,pulse FROM tbl_patient_biovitals WHERE patient_id = '$user_id' ORDER BY date_taken";

 $query = "SELECT COUNT(patient_id) AS totalPatients,date_sent FROM tbl_consulting WHERE doctor_id = '".$uid."' AND view_state = '".$dateview."' AND date_sent BETWEEN DATE_SUB(CURDATE(), INTERVAL 21 DAY) AND CURDATE() GROUP BY date_sent ";
   

   $result = mysqli_query($connection,$query);
    

  $data = array();
foreach ($result as $row) {
	$data[] = $row;
}
 

echo json_encode($data);
         
         
 
        
            


 

       