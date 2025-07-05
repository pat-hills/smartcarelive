<?php

session_start();
 



require_once '../../../functions/conndb.php';
require_once '../../../functions/func_search.php';
require_once '../../../functions/func_consulting.php';
require_once '../../../functions/func_common.php'; 


//review here


global $connection;
 

$time = "9:45 AM";
$current_date = date("Y-m-d");

 

$headers = 'From:SmartCareAid<care@SmartCareAid.com>';  

$sql = "SELECT patient_id,id,date_to_be_seen,staff_id,is_sms_sent FROM tbl_patient_review WHERE is_sms_sent = 'NO' ORDER BY 
  date_to_be_seen ASC LIMIT 1";
	$result = mysqli_query($connection,$sql);

	if(mysqli_num_rows($result) > 0){

		while ($row = mysqli_fetch_array($result)) {

			$prev_date_b4_review_date = date('Y-m-d', strtotime('-1 day', strtotime($row['date_to_be_seen'])));

			//we need to add another one day to the previous to update it
			//$advance_review_date = date('Y-m-d', strtotime('+1 day', strtotime($row['date_to_be_seen'])));

			$advance_review_date = date('Y-m-d', strtotime('+1 day', strtotime($prev_date_b4_review_date)));
			//$advance_review_date = $row['date_to_be_seen'];
			

			if( $prev_date_b4_review_date == $current_date ){

				//getting patient details
			get_pat_email_sms($row['patient_id']); 

           

			$doctor = get_staff_info($row['staff_id']);

        	$dr_fullname =  $doctor['firstName'] . " " . $doctor['otherNames']; 
			$subject = 'Upcoming appointment with Dr. '.$dr_fullname." at ".$time;


			//date('jS F, Y', strtotime($ward['date_added']))
			$row_convert_date = date('jS F, Y', strtotime($row['date_to_be_seen']));

			$message = trim("Dear ". strtoupper($_SESSION['fullname'] ). ", \n This is a reminder of your upcoming appointment with Dr. " . $dr_fullname ." at SmartCareAid ". " on " . $row_convert_date. " ".$time. " \n Thank you.");
 
			$mail =  mail($_SESSION['email_contact'], $subject, $message, $headers);

			if($mail){
 			//function to update review when sent //“/home/taugscsf/sch2021.SmartCareAid.com”:

			 //php /home/taugscsf/sch2021.SmartCareAid.com/users/consulting/cron_job_notifications/send_review_notifications.php
 
			update_patient_sent_review_notification($row['patient_id'],$advance_review_date,$message,$current_date);
			}
 

			}else{
				echo "Not ready";
				exit();
			}

			
			
		

		}

	}