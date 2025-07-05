<?php
$response = 0;
if (isset($_GET['a']) && !empty($_GET["a"])) {
    $response = $_GET['a'];
}
?>
<body>



    <div class="container-fluid" id="pcont">
        <div class="page-head">
            <h2>Admin</h2>
            <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>

                <li class="active">Admin - Add Patients</li>
            </ol>
        </div>


        <div class="alert alert-info alert-white rounded" style="width:70%;margin-top:20px;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php if ($response == 2) { ?>
                <div class="icon"><i class="fa fa-save"></i></div>
                <strong>Info!</strong>&nbsp;
                <?php
                echo 'Upload Successful';
            } elseif ($response == 0) {
                ?>
                <div style="background: #00CC00" class="icon"><i class="fa fa-info-circle"></i></div>
                <strong>Info! </strong>&nbsp;

                <?php
                echo '1. Bulk Uploading of Patients Information <br/>';
            } else {
                ?>
                <div style="background: red " class="icon"><i class="fa fa-ban"></i></div>
                <strong>Error!</strong>&nbsp;
                <?php
                if ($response == 1) {
                    echo 'the file size must not be more than 1MB';
                } elseif ($response == 3) {
                    echo 'Unable to Upload';
                } elseif ($response == 4) {
                    echo 'Problem Uploading File';
                } elseif ($response == 5) {
                    echo 'Unable to upload the CSV file';
                }
                $response = 0;
            }
            ?>

        </div>


        <div class="col-sm-12 col-md-12" style="float:right;">
            <div class="block-flat ">
                <label style="color: dodgerblue">
                    1. Upload works with CSV Files <br/>
   2. The CSV file should contain at LEAST, columns like 
   patients, surname, other_names, sex, marital_status, occupation, phone, address, national_id, date_created, ppic, dob.
    </label>
                <form action="../users/upload_csv.php" method="post" enctype="multipart/form-data" >
                         <input class="btn-success  btn-lg" type="file"  name="csvFile" id="csvFile" value="Upload" 
                               accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" >
                        <input type="hidden" name="patients" value="1" >
                        <input type="submit" class="btn btn-success btn-s" value="Submit" name="submit" style="margin-top:20px;">
                        </form>
                        <label style="font-size:10px;color: #0063dc">Upload a CSV file (max size is 1MB)</label>
                     
            </div></div>


        <!---
        <div class="col-sm-12 col-md-12" style="float:right;margin-right:;">
<div class="block-flat">
 <form action="../users/upload_csv.php" method="post" enctype="multipart/form-data" >
<input type="file" name="csvFile" value="Upload" >
<input type="hidden" name="patients_family" value="1" >
<input type="submit" class="btn btn-success btn-xs" value="Submit" name="submit" style="margin-top:20px;">
 </form>
  <label style="font-size:10px;">Upload a CSV file (max size is 1MB)</label>
</div></div> ---->

    </div>



