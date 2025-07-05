<?php
header('Content-Type: application/json');

require_once '../../../functions/conndb.php';
session_start();

global $connection;
#Pie Chart
 
   $patient_id = $_SESSION['patient_id']; 

   $date_time_admitted = $_SESSION['date_admitted'];

   
   //$dbcon = con_con(); 

   $new_date  = date("Y-m-d",strtotime($date_time_admitted));
	

   //$sql = "SELECT date_sent FROM tbl_consulting WHERE patient_id = '".$patient_id."'";
 
     $NULL = NULL;
 
     $query = "SELECT weight,temperature,pulse,date_time_taken FROM tbl_patient_biovitals 
     WHERE patient_id ='".$patient_id."' AND date_time_taken != '".$NULL."' AND DATE( date_time_admitted ) = '".$new_date."' ORDER BY date_time_taken ";

   
 // $query = "SELECT date_taken,weight,temperature,pulse FROM tbl_patient_biovitals WHERE patient_id = '$user_id' ORDER BY date_taken";

   $result = mysqli_query($connection,$query);
    

  $data = array();
foreach ($result as $row) {
	$data[] = $row;
}
 

echo json_encode($data);
         
         
 
        
            


 

       