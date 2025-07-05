<?php

    require '../../functions/conndb.php';
    require '../../functions/func_common.php';
    require '../../functions/func_admin.php';
    session_start(); 
    
    
    if(isset($_POST['assign'])){

        global $connection;
        
        $room_id = $_POST['room'];
        $doctor_id = $_POST['doctor'];
		$shift = $_POST['shift'];
        $assigned_by = $_SESSION['uid'];
       
//          $checking = "select * from doctors_room where room_id = '".$room_id."' and shift = '".$shift."' ";
//      $result = mysqli_query($connection,$checking) or die(mysqli_error());

//     if( $row = mysqli_fetch_assoc($result)){
        
//                 $checking1 = "select * from tbl_staff where staff_id = '".$row['doctor_id']."' ";
//  $result1 = mysqli_query($connection,$checking1) or die(mysql_error());

//     if( $row1 = mysqli_fetch_assoc($result1)){
        
        
//         $_SESSION['errorMsg'] = "Doctor ".$row1['firstName']." ".$row1['otherNames']." has already been assigned to the Same Room and Same Shift";
               
//     }
//                    header("Location: " . $_SERVER['HTTP_REFERER']);
 
//     }

   // else{
        
        
        
        $inserted = assign_room($room_id,$doctor_id, $shift, $assigned_by);
    
        if($inserted){
            //echo "Staff '".$firstname. "''/s account has been updated successfully";
            $_SESSION['successMsg'] = "Doctor assigned to Consulting Room successfully";        
           header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            $_SESSION['errorMsg'] = "Doctor could not be assigned to Consulting Room";
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
  //  }
    }