<?php

include_once '../functions/conndb.php';
include_once '../functions/getcsv.php';
include_once '../functions/func_pharmacy.php';
include_once '../functions/func_admin.php';
include_once '../functions/func_records.php';
session_start();

global $connection;

$target_dir = "../csv_uploads/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$uploadOk = 1;

$staff_id = $_SESSION['uid'];


//$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image

if (isset($_POST["import"])) {

    if ($_FILES["file"]["size"] > 100000000) {
        $url = explode('?', $_SERVER['HTTP_REFERER']);
        header('Location:' . $url[0] . '?a=1');
    }



    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {


//$fileName = $_FILES["file"]["tmp_name"];
        $file = fopen($target_file, "r");

        $i = 0;

        $importData_arr = array();
                    
        while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
          $num = count($data);

          for ($c=0; $c < $num; $c++) {
             $importData_arr[$i][] = mysqli_real_escape_string($connection, $data[$c]);
          }
          $i++;
        }
        fclose($file);


        $skip = 0;
        // insert import data
        foreach($importData_arr as $data){
           if($skip != 0){
              $drug_code = $data[0];
             // $fname = $data[1];
              $drug_name = $data[2];
             // $email = $data[3];

              // Checking duplicate entry
            //  $sql = "select count(*) as allcount from user where username='" . $username . "' and fname='" . $fname . "' and  lname='" . $lname . "' and email='" . $email . "' ";

            //  $retrieve_data = mysqli_query($con,$sql);
            //  $row = mysqli_fetch_array($retrieve_data);
            //  $count = $row['allcount'];

            //  if($count == 0){
                 // Insert record
                 $insert_query = "insert into tbl_drug_list(drug_code,Name) values('".$drug_code."','".$drug_name."')";
                 mysqli_query($connection,$insert_query);
             // }
           }
           $skip ++;
        }
        $newtargetfile = $target_file;
        if (file_exists($newtargetfile)) {
           unlink($newtargetfile);
        }

       
 
             

            }
        



        //$sql="INSERT INTO tbl_drug_list (drug_code,Name,Expiry_date,quantity,price)


       // $data = array('productname');
        //$path = $target_file;
        //$csv_array = get_csv_assoc_array($path, $data);

        // foreach ($csv_array as $theCsv) {

            
        //     $Name = $theCsv['productname']; 
            

        //     if (add_drug_csv($Name)) {
        //         $_SESSION['upload_message'] = 'upload successful';
        //         header('Location:' . $_SERVER['HTTP_REFERER']);
        //     } else {
        //         $_SESSION['upload_message'] = 'unable to upload';
        //         header('Location:' . $_SERVER['HTTP_REFERER']);
        //     }
        // }
         

          
            $url = explode('?', $_SERVER['HTTP_REFERER']);
            header('Location:' . $url[0] . '?a=4');
        }
      else {

        $url = explode('?', $_SERVER['HTTP_REFERER']);
        header('Location:' . $url[0] . '?a=5');
    }




?>