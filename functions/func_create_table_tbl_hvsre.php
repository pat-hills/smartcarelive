<?php
require_once"conndb.php";

global $connection;




//new table hvsre

$tbl_create_hvsre = "CREATE TABLE IF NOT EXISTS tbl_hvsre (
   id INT(11) NOT NULL AUTO_INCREMENT,
   request_code  VARCHAR(128) NOT NULL,
   patient_id  VARCHAR(128) NOT NULL,
   lab_staff_id VARCHAR(128) NOT NULL, 
   ep_cell VARCHAR(128) NULL,  
   pus_cell VARCHAR(128) NULL, 
   rbcs VARCHAR(128) NULL, 
   t_vaginalis VARCHAR(128) NULL, 
   bacteria VARCHAR(128) NULL, 
   yeast_like_cells VARCHAR(128) NULL, 
   date_submitted DATE NOT NULL,
   date_updated DATE NULL,
   PRIMARY KEY (id)
  )";
$query_41 = mysqli_query($connection, $tbl_create_hvsre);
if ($query_41 === TRUE) {
echo "<h3>tbl_hvsre table created OK :) </h3>"; 
} else {
echo "<h3 style='color:red'>tbl_hvsre table NOT created,Something went wrong :( </h3>"; 
}