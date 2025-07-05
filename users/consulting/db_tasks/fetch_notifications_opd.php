<?php
header('Content-Type: application/json');

require_once '../../../functions/conndb.php';
require_once "../../../functions/func_common.php";
session_start();

global $connection;

$user_id = $_SESSION['uid'];
$date = date('Y-m-d');

//$view = $_POST['view'];

$view =  "";


  // $con = mysqli_connect("localhost", "root", "", "notif");
  if($view != '')
  {
   $viewed_state = 1;

	//$date = date('Y-m-d H:i:s');
	$update_query="UPDATE tbl_consulting SET  view_state = '".$viewed_state."' WHERE patient_id = '".$patient_id."' AND doctor_id = '".$user_id."' ";

     //$update_query = "UPDATE comments SET comment_status = 1 WHERE comment_status=0";
     mysqli_query($connection, $update_query);
  }

  $query = "SELECT patient_id,date_sent_ago,date_sent FROM `tbl_consulting` WHERE date_sent = '".$date."' AND 
  doctor_id = '".$user_id."' AND view_state = '0' ";
  $result = mysqli_query($connection, $query);
  $output = '';
  if(mysqli_num_rows($result) > 0)
  {
  while($row = mysqli_fetch_array($result))
  {
   $patient_name = patient_name($row['patient_id']);

   $date_time_stamp = time_passed($row['date_sent_ago']);
    $output .= "<li>  <a onclick='return confirm(\"CLICK OK TO CONFIRM SELECTION OF PATIENT TO CONTINUE CONSULTATION...\")'  href='tasks/set_patient_details.php?patient_id=".$row['patient_id']."'>" 
				. $patient_name .", About "."$date_time_stamp". "</a>   </li> <li class='divider'></li>";
  }
  }
  else{
      $output .= '<li><a href="#" class="text-bold text-italic">No Incoming Notification</a></li>';
  }


//$user = $_SESSION['uid'];
	$sql = "SELECT COUNT(id) as total_notification_waiting_patients FROM `tbl_consulting` WHERE date_sent = '".$date."' AND 
	doctor_id = '".$user_id."' AND view_state = '0' ";
	$query_run = mysqli_query($connection,$sql);
	$rows = mysqli_fetch_assoc($query_run);
	$count = $rows['total_notification_waiting_patients'];

  $data = array(
     'notification' => $output,
     'unseen_notification'  => $count
  );
  echo json_encode($data);
  




   

  ?>
         
         
 
        
            


 

       