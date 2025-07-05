<?php
$patient_id = $_GET['patient_id'];
if(isset($_GET['patient_id'])){
	
	header("Location: tasks/set_patient_details.php?patient_id=".$patient_id."");
	
} else {
	
	header("Location: view_lab_list.php");
}