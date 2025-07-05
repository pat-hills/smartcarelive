<?php
require_once"conndb.php";

global $connection;




//new table hvsre

$alter_tbl_fbc_add_p_lcr = "ALTER TABLE  `fbc` ADD
 (
    
  
   P_LCR VARCHAR(128)
 
 );";

$query_34 = mysqli_query($connection, $alter_tbl_fbc_add_p_lcr);
if ($query_34 === TRUE) {
echo "<h3>FBC ALTERED :) </h3>"; 
} else {
echo "<h3 style='color:red'>FBC table NOT ALTERED,Something went wrong, Either column(s) exist / Operation error!!! :) </h3>"; 
}