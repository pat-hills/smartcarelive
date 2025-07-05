<?php
session_start();

$patient_id = $_SESSION['patient_id'];

$img = $_POST['imgBase64'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
//$file = UPLOAD_DIR . uniqid() . '.png';
$file = $patient_id ."/". $patient_id . '.png';
$success = file_put_contents($file, $data);

if($success){
	echo "Picture uploaded with ID ". $patient_id;
}