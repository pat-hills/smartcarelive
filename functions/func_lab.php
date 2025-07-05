<?php

function lab_request($patient_id, $date) {
    global $connection;
   $payment_status = 1;
   $sql = "SELECT * FROM tbl_req_investigation WHERE patient_id = '".$patient_id."' AND DATE(requested_date) = '".$date."' AND payment_status='".$payment_status."'";
   
   $result = mysqli_query($connection,$sql);
   $rows = mysqli_num_rows($result);
   
   if( $rows == 1){
       while( $row = mysqli_fetch_assoc($result)){
           return $row;
       }
   } else if( $rows == 0){
       return FALSE;
   } 
}


function requesting_doctor($doctor_id){

    global $connection;
    
    $sql = "SELECT * FROM tbl_staff WHERE staff_id = '".$doctor_id."'";
    $result = mysqli_query($connection,$sql);
    $rows = mysqli_num_rows($result);
   
   if( $rows == 1){
       while( $row = mysqli_fetch_assoc($result)){
           return $row;
       }
   } else if( $rows == 0){
       return FALSE;
   }
}

function waiting_list($requested_date = FALSE){
    global $connection;
    
    //$date = date('Y-m-d');
	
    //$sql = "SELECT * FROM tbl_req_investigation WHERE status = '0' AND payment_status = '0' AND DATE(requested_date) = '".$date."'";
	if(!empty($requested_date)){
		$sql = "SELECT * FROM tbl_req_investigation WHERE status = '0' AND DATE(requested_date) = '".$requested_date."'";
	} else {
		$sql = "SELECT * FROM tbl_req_investigation WHERE status = '0' AND payment_status = '1' ORDER BY requested_date DESC";
	}
	
    $result = mysqli_query($connection,$sql);
    
    //echo $num_rows = mysql_num_rows($result);
   
    while( $row = mysqli_fetch_assoc($result)){
        $doctor = requesting_doctor($row['doctor_id']);
        echo "
            <div class='col-sm-6 col-md-4'>
                <div class='friend-widget'>
                    <img src='".patient_profile_picture($row['patient_id'])."'>
                    Patient: <a href='tasks/set_patient_details.php?patient_id=".$row['patient_id']."&date=".$row['requested_date']."'>" 
                    . patient_name($row['patient_id']) . "</a><br>
                    Doctor: ". $doctor['firstName'] ."  ". $doctor['otherNames']."
                    &nbsp;&nbsp;&nbsp;<p>Requested Date: ".$row['requested_date']."</p>
                </div>
            </div>
        ";
        
    }
}


function lab_test_single_selection($requested_date = FALSE){
    global $connection;
    
    $date = date('Y-m-d');
	
    //$sql = "SELECT * FROM tbl_req_investigation WHERE status = '0' AND payment_status = '0' AND DATE(requested_date) = '".$date."'";
	if(!empty($requested_date)){
		$sql = "SELECT * FROM tbl_req_investigation WHERE status = '0' AND DATE(requested_date) = '".$requested_date."'";
	} else {
		$sql = "SELECT * FROM tbl_req_investigation WHERE status = '0' AND payment_status = '1' ORDER BY requested_date DESC";
	}
	
    $result = mysqli_query($connection,$sql);
    
    //echo $num_rows = mysql_num_rows($result);
   
    while( $row = mysqli_fetch_assoc($result)){
       
        $_taken = get_staff_info($row['doctor_id']);
   
        $_taken = "Dr ". $_taken['firstName']." ".$_taken['otherNames'];

        $request_code = $row['request_code'];

        $date_sent_ = $row['requested_date'];

        $requested_lab_test = $row['request_test_name'];

        $patient_name = patient_name($row['patient_id']);

        $date_convert = date('jS M, Y', strtotime("$date_sent_")).", ".date('l', strtotime("$date_sent_"));

      //  $requested_lab_test = explode(',', $requested_lab_test);

      //  foreach($requested_lab_test as $singles){

          //  $lab_test_name = investigation_name($singles);

            echo "<tr>
            <td>".$date_convert."</td>

            <td>".$patient_name."</td>
 
          
             
            <td>".$requested_lab_test."</td>

            <td>".$_taken."</td>

            <td>.<a href='tasks/conduct_test?patient_id=".$row['patient_id']."&patient_name=".$patient_name."&test_names=".$requested_lab_test."&request_code=".$request_code." '>" 
            . "CONDUCT TEST". "</a>.</td>
 
    
            </tr>";
 
    }
}



function lab_test_single_selection_walk_in($requested_date = FALSE){
    global $connection;
    
    $date = date('Y-m-d');

//$_taken = "";


	
    //$sql = "SELECT * FROM tbl_req_investigation WHERE status = '0' AND payment_status = '0' AND DATE(requested_date) = '".$date."'";
	if(!empty($requested_date)){
		$sql = "SELECT * FROM tbl_walk_in_request_investigation WHERE lab_status = '0' AND DATE(date_requested) = '".$requested_date."'";
	} else {
		$sql = "SELECT * FROM tbl_walk_in_request_investigation WHERE lab_status = '0' ORDER BY date_requested DESC";
	}
	
    $result = mysqli_query($connection,$sql);
    
    //echo $num_rows = mysql_num_rows($result);
   
    while( $row = mysqli_fetch_assoc($result)){
       

        $_taken = $row['source_name'];

            if($_taken == null){
               
                $_taken = $row['source'];

            }
            
            // else{
            //     $_taken = $row['source_name'];
            // }
   
       // $_taken = "Dr ". $_taken['firstName']." ".$_taken['otherNames'];

        $request_code = $row['request_code'];

        $date_sent_ = $row['date_requested'];

        $requested_lab_test = $row['requested_test_names'];

        $id = $row['id'];
 


        $requested_test = $row['requested_test'];

        $patient_walk_in_records = patient_name_walk_in($row['walk_code']);

        $patient_name = $patient_walk_in_records['full_name'];

        $patient_age = $patient_walk_in_records['dob'];

        $date_convert = date('jS M, Y', strtotime("$date_sent_")).", ".date('l', strtotime("$date_sent_"));

      

            echo "<tr>
            <td>".$date_convert."</td>

            <td>".$patient_name."</td>
 
          
             
            <td>".$requested_lab_test."</td>

            <td>".$_taken."</td>

            <td><a href='tasks/conduct_test_walk_in?patient_id=".$row['walk_code']."&patient_name=".$patient_name."&test_names=".$requested_lab_test."&request_code=".$request_code."&id=".$id."&patient_age=".$patient_age." '>" 
            . "<i class='fa fa-bars'></i>". "</a>
 
            <a href='tasks/conduct_test_walk_in_edit?patient_id=".$row['walk_code']."&patient_name=".$patient_name."&test_names=".$requested_lab_test."&request_code=".$request_code."&requested_test=".$requested_test."&id=".$id."&patient_age=".$patient_age." '>" 
            . "<i class='fa fa-edit'></i>". "</a>

            <a onclick='return confirm(\"CLICK OK TO CONFIRM DELETION OR CANCEL TO PREVENT DELETION...\")' href='db_tasks/undo_walk_in.php?id=$id'><i class='fa fa-times'></i></a>
				

            </td>
    
            </tr>";
 
    }
}




function lab_test_single_selection_walk_in_exist($walk_code){
    global $connection;
    
    $date = date('Y-m-d');

//$_taken = "";


	
    //$sql = "SELECT * FROM tbl_req_investigation WHERE status = '0' AND payment_status = '0' AND DATE(requested_date) = '".$date."'";
	//if(!empty($requested_date)){
	//	$sql = "SELECT * FROM tbl_walk_in_request_investigation WHERE lab_status = '0' AND DATE(date_requested) = '".$requested_date."'";
	//} else {
		$sql = "SELECT * FROM tbl_walk_in_request_investigation WHERE lab_status = '0' AND walk_code ='".$walk_code."' ";
	//}
	
    $result = mysqli_query($connection,$sql);
    
    //echo $num_rows = mysql_num_rows($result);
   
    while( $row = mysqli_fetch_assoc($result)){
       

        $_taken = $row['source_name'];

            if($_taken == null){
               
                $_taken = $row['source'];

            }
            
            // else{
            //     $_taken = $row['source_name'];
            // }
   
       // $_taken = "Dr ". $_taken['firstName']." ".$_taken['otherNames'];

        $request_code = $row['request_code'];

        $date_sent_ = $row['date_requested'];

        $id = $row['id'];

        $requested_lab_test = $row['requested_test_names'];


        $requested_test = $row['requested_test'];

        $patient_walk_in_records = patient_name_walk_in($row['walk_code']);

        $patient_name = $patient_walk_in_records['full_name'];
        

        $date_convert = date('jS M, Y', strtotime("$date_sent_")).", ".date('l', strtotime("$date_sent_"));

        $exist = true;

      

            echo "<tr>
            <td>".$date_convert."</td>

            <td>".$patient_name."</td>
 
          
             
            <td>".$requested_lab_test."</td>

            <td>".$_taken."</td>

            <td><a href='tasks/conduct_test_walk_in?patient_id=".$row['walk_code']."&patient_name=".$patient_name."&test_names=".$requested_lab_test."&request_code=".$request_code."&exist=".$exist." '>" 
            . "<i class='fa fa-bars'></i>". "</a>

            <a href='tasks/conduct_test_walk_in_edit?patient_id=".$row['walk_code']."&patient_name=".$patient_name."&test_names=".$requested_lab_test."&request_code=".$request_code."&exist=".$exist."&requested_test=".$requested_test."&id=".$id." '>" 
            . "<i class='fa fa-edit'></i>". "</a>

            
            <a onclick='return confirm(\"CLICK OK TO CONFIRM DELETION OR CANCEL TO PREVENT DELETION...\")' href='db_tasks/undo_walk_in?patient_id=".$row['walk_code']."&patient_name=".$patient_name."&test_names=".$requested_lab_test."&request_code=".$request_code."&exist=".$exist."&requested_test=".$requested_test."&id=".$id." '>" 
            . "<i class='fa fa-times'></i>". "</a>




            
            </td>

            
 
    
            </tr>";
 
    }
}



function edit_investigations_walk_in($id, $request_code, $investigations, $lab_staff_id,$process = null){
    global $connection;


    $lab_status = 0;

  

   $investigation_code = explode(',',$investigations );

   $requested_test_names = get_investigation_name_($investigation_code);

 
   if($process != null && $process == true){
    $sql = "UPDATE tbl_walk_in_request_investigation SET requested_test = '".$investigations."' , requested_test_names = '".$requested_test_names."' , lab_status = '".$lab_status."'  WHERE id = '".$id."' AND lab_staff_id = '".$lab_staff_id."' AND request_code = '".$request_code."'  ";
   
   }else{
    $sql = "UPDATE tbl_walk_in_request_investigation SET requested_test = '".$investigations."' , requested_test_names = '".$requested_test_names."'  WHERE id = '".$id."' AND lab_staff_id = '".$lab_staff_id."' AND request_code = '".$request_code."' ";
  
   }
  
   
   
   $result_walk_in_update = mysqli_query($connection,$sql) or die(mysqli_error());
   if($result_walk_in_update){
      // sendInvestigationPayment2cashier($patient_id,$request_code,$doctor_id,$investigations);
       $_SESSION['err_msg'] = "<div class='alert alert-success alert-white rounded'>
                                   <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                                   <div class='icon'><i class='fa fa-check'></i></div>
                                   <strong>Walk In Investigation Updated</strong> 
                                </div>";
                       header("Location: ../walk_in_exist");	
   } else {
       $_SESSION['err_msg'] = "<div class='alert alert-danger alert-white rounded'>
                                   <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                                   <div class='icon'><i class='fa fa-check'></i></div>
                                   <strong>Walk In Lab Investigation Was Not Updated!</strong>
                                </div>";
                                header("Location: ../walk_in_exist");
   }
}


// $sql="UPDATE general_status_test SET  test_name = '".$test_name."', test_status = '".$status."',remarks = '".$comment."'  WHERE patient_id = '".$patient_id."' AND request_code = '".$request_code."' ";
// if(mysqli_query($connection,$sql) or die(mysqli_error())){
//     return TRUE;
// } else {
//     return FALSE;
// }


function update_inferences_by_code($patient_id,$request_code){
    global $connection;
    
   // $date = date('Y-m-d');
	
   
//$sql = "SELECT * FROM tbl_req_investigation WHERE status = '0' AND payment_status = '1' AND request_code = '".$request_code."'";

$sql="UPDATE tbl_req_investigation SET  status = '0'  WHERE patient_id = '".$patient_id."' AND request_code = '".$request_code."' ";
if(mysqli_query($connection,$sql) or die(mysqli_error())){
    return TRUE;
} else {
    return FALSE;
}
 
	
    
}







function get_labs_inferences_by_code($request_code,$edit = null){
    global $connection;
    
  //  $date = date('Y-m-d');

      if($edit != null && $request_code != null){
		$sql = "SELECT * FROM tbl_req_investigation WHERE status = '0' AND payment_status = '1' AND request_code = '".$request_code."'";

      }else{
        $sql = "SELECT * FROM tbl_req_investigation WHERE status = '0' AND payment_status = '1' AND request_code = '".$request_code."'";
      }
	
   
		
 
	
    $result = mysqli_query($connection,$sql);
    
    //echo $num_rows = mysql_num_rows($result);
   
    while( $row = mysqli_fetch_assoc($result)){
       
       return $row;
         
        
    }
}

function get_labs_inferences_walk_in_by_code($request_code,$edit = NULL){
    global $connection;
    
    //$date = date('Y-m-d');

     if($edit != null){

		$sql = "SELECT * FROM tbl_walk_in_request_investigation WHERE lab_status = '1' AND request_code = '".$request_code."'";
     }else{

		$sql = "SELECT * FROM tbl_walk_in_request_investigation WHERE lab_status = '0' AND request_code = '".$request_code."'";
     }
	
   
 
	
    $result = mysqli_query($connection,$sql);
    
    //echo $num_rows = mysql_num_rows($result);
   
    while( $row = mysqli_fetch_assoc($result)){
       
       return $row;
         
        
    }
}


function view_patient_lab_processed_today($request_code){
    global $connection;
    
    $date = date('Y-m-d');
    $processed_by = $_SESSION['uid'];
	
   
		$sql = "SELECT * FROM tbl_req_investigation WHERE status = '1' AND payment_status = '1' AND request_code = '".$request_code."' AND lab_staff_id = '".$processed_by."' ";
 
	
    $result = mysqli_query($connection,$sql);

    
    
    if(mysqli_num_rows($result) > 0){
        while( $row = mysqli_fetch_assoc($result)){
       
            return $row;
              
             
         }
    }else{
        $sql = "SELECT * FROM tbl_req_investigation WHERE status = '1' AND payment_status = '1' AND request_code = '".$request_code."' ";
 
	
        $result = mysqli_query($connection,$sql); 

        if(mysqli_num_rows($result) > 0){
            while( $row = mysqli_fetch_assoc($result)){
           
                return $row;
                  
                 
             }

    }
   
   
}}



function view_patient_lab_processed_today_walk_in($request_code){
    global $connection;
    
    $date = date('Y-m-d');
    $processed_by = $_SESSION['uid'];
	
   
		$sql = "SELECT * FROM tbl_walk_in_request_investigation WHERE lab_status = '1' AND request_code = '".$request_code."' AND lab_staff_id = '".$processed_by."' ";
 
	
    $result = mysqli_query($connection,$sql);

    
    
    if(mysqli_num_rows($result) > 0){
        while( $row = mysqli_fetch_assoc($result)){
       
            return $row;
              
             
         }
    } 
   
   
}



function pending_payments($requested_date = FALSE){

    global $connection;
    
    $date = date('Y-m-d');
	
	if(!empty($requested_date)){
	//	$sql = "SELECT * FROM tbl_req_investigation WHERE status = '0' AND DATE(requested_date) = '".$requested_date."'";
        $sql = "SELECT * FROM tbl_req_investigation WHERE status = '0' AND requested_date = '".$requested_date."' ORDER BY DESC requested_date";
	} else {
		//$sql = "SELECT * FROM tbl_req_investigation WHERE status = '0' AND payment_status = '1' AND DATE(requested_date) = '".$date."'";
        $sql = "SELECT * FROM tbl_req_investigation WHERE status = '0' AND payment_status = '0' ORDER BY  requested_date DESC";
	}
	
    $result = mysqli_query($connection,$sql);
    
    //echo $num_rows = mysql_num_rows($result);
   
    while( $row = mysqli_fetch_assoc($result)){
        $doctor = requesting_doctor($row['doctor_id']);
        echo "
            <div class='col-sm-6 col-md-4'>
                <div class='friend-widget'>
                    <img src='".patient_profile_picture($row['patient_id'])."'>
                    Patient: <i>" . patient_name($row['patient_id']) . "</i><br>
                    Doctor: ". $doctor['firstName'] ."  ". $doctor['otherNames']."
                    &nbsp;&nbsp;&nbsp;<p>Requested Date: ".$row['requested_date']."</p>
                </div>
            </div>
        ";
        
    }
}



function processed_results_walk_in_today(){

    global $connection;
    $date = date('Y-m-d');
    $processed_by = $_SESSION['uid'];
    $payment_status = 1;
    $_taken = "";
	
    $sql = "SELECT * FROM tbl_walk_in_request_investigation WHERE lab_status = 1 AND DATE(date_processed) = '".$date."' AND lab_staff_id = '".$processed_by."' ";
    $result = mysqli_query($connection,$sql);
    
    while( $row = mysqli_fetch_assoc($result)){
        $_taken = $row['source_name'];

        if($_taken==""){
               
            $_taken = $row['source'];
        }  

        $date_sent_ = $row['date_processed'];
         
        
        $date_convert = date('jS M, Y', strtotime("$date_sent_")).", ".date('l', strtotime("$date_sent_"));

        $patient_walk_in_records = patient_name_walk_in($row['walk_code']);

        $patient_name = $patient_walk_in_records['full_name'];

        //

    //    $patient_walk_in_records = patient_name_walk_in($row['walk_code']);

      //  $patient_name = $patient_walk_in_records['full_name'];

        $patient_age = $patient_walk_in_records['dob'];
        //
        

        $request_test_name = $row['requested_test_names'];


        if($request_test_name == "LFT,"){

            echo "
            <div class='col-sm-6 col-md-4'>
                <div class='friend-widget'>
                    <img src='".patient_profile_picture($row['walk_code'])."'>
 
                    Patient: <i>" . $patient_name. "</i><br>
                  
                    Source: ". $_taken."
                    <p>Processed Date: ".$date_convert."</p><br>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a target='_blank' href='tasks/p_v_r_wlkr?lab_code=".$row['request_code']."&patient_id=".$row['walk_code']."'>" . "<i class='fa fa-print'></i>" . "</a>     

                    <a onclick='return confirm(\"CLICK OK TO CONFIRM SELECTION OF PATIENT TO CONTINUE ...\")' 
                    href='tasks/conduct_test_walk_in.php?patient_id=".$row['walk_code']."&patient_name=".$patient_name."&test_names=".$request_test_name."&request_code=".$row['request_code']."&edit=true"."&lab_no=".$row['lab_no']." '>" ."<i class='fa fa-edit'></i>"."</a> 

             
                    <a onclick='return confirm(\"CLICK OK TO CONFIRM SELECTION OF PATIENT TO CONTINUE ...\")' 
                    href='tasks/conduct_test_walk_in_edit.php?patient_id=".$row['walk_code']."&patient_name=".$patient_name."&test_names=".$request_test_name."&request_code=".$row['request_code']."&processed=true"."&requested_test=".$row['requested_test']."&id=".$row['id']."&patient_age=".$patient_age." '>" ."<i class='fa fa-file'></i>"."</a> 
  
                     
                </div>
            </div>
        ";
            
        }else if($request_test_name == "Urine RE,"){
            echo "
            <div class='col-sm-6 col-md-4'>
                <div class='friend-widget'>
                    <img src='".patient_profile_picture($row['walk_code'])."'>
 
                    Patient: <i>" . $patient_name . "</i><br>
                  
                    Source: ". $_taken."
                    <p>Processed Date: ".$date_convert."</p><br>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a target='_blank' href='tasks/p_v_r_wlkr?lab_code=".$row['request_code']."&patient_id=".$row['walk_code']."'>" . "<i class='fa fa-print'></i>" . "</a>     

                    <a target='_blank' href='tasks/p_v_r_wlk?lab_code=".$row['request_code']."&patient_id=".$row['walk_code']."'>" . "<i class='fa fa-eye'></i>" . "</a>  
                     <a onclick='return confirm(\"CLICK OK TO CONFIRM SELECTION OF PATIENT TO CONTINUE ...\")' 
                     href='tasks/conduct_test_walk_in.php?patient_id=".$row['walk_code']."&patient_name=".$patient_name."&test_names=".$request_test_name."&request_code=".$row['request_code']."&edit=true"."&lab_no=".$row['lab_no']." '>" ."<i class='fa fa-edit'></i>"."</a> 
 

                     <a onclick='return confirm(\"CLICK OK TO CONFIRM SELECTION OF PATIENT TO CONTINUE ...\")' 
                     href='tasks/conduct_test_walk_in_edit.php?patient_id=".$row['walk_code']."&patient_name=".$patient_name."&test_names=".$request_test_name."&request_code=".$row['request_code']."&processed=true"."&requested_test=".$row['requested_test']."&id=".$row['id']."&patient_age=".$patient_age." '>" ."<i class='fa fa-file'></i>"."</a> 
   
                     
                </div>
            </div>
        ";

        }else if($request_test_name == "FBC,"){
            echo "
            <div class='col-sm-6 col-md-4'>
                <div class='friend-widget'>
                    <img src='".patient_profile_picture($row['walk_code'])."'>
 
                    Patient: <i>" . $patient_name . "</i><br>
                  
                    Source: ". $_taken."
                    <p>Processed Date: ".$date_convert."</p><br>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a target='_blank' href='tasks/p_v_r_wlkr?lab_code=".$row['request_code']."&patient_id=".$row['walk_code']."'>" . "<i class='fa fa-print'></i>" . "</a>    
                    
                    <a target='_blank' href='tasks/p_v_r_wlk?lab_code=".$row['request_code']."&patient_id=".$row['walk_code']."'>" . "<i class='fa fa-eye'></i>" . "</a>  

                     <a onclick='return confirm(\"CLICK OK TO CONFIRM SELECTION OF PATIENT TO CONTINUE ...\")' 
                     href='tasks/conduct_test_walk_in.php?patient_id=".$row['walk_code']."&patient_name=".$patient_name."&test_names=".$request_test_name."&request_code=".$row['request_code']."&edit=true"."&lab_no=".$row['lab_no']." '>" ."<i class='fa fa-edit'></i>"."</a> 
 
                     <a onclick='return confirm(\"CLICK OK TO CONFIRM SELECTION OF PATIENT TO CONTINUE ...\")' 
                     href='tasks/conduct_test_walk_in_edit.php?patient_id=".$row['walk_code']."&patient_name=".$patient_name."&test_names=".$request_test_name."&request_code=".$row['request_code']."&processed=true"."&requested_test=".$row['requested_test']."&id=".$row['id']."&patient_age=".$patient_age." '>" ."<i class='fa fa-file'></i>"."</a> 
   
                     
                </div>
            </div>
        ";

        }
        else{

            echo "
            <div class='col-sm-6 col-md-4'>
                <div class='friend-widget'>
                    <img src='".patient_profile_picture($row['walk_code'])."'>
 
                    Patient: <i>" . $patient_name . "</i><br>
                  
                    Source: ". $_taken."
                    <p>Processed Date: ".$date_convert."</p><br>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  
                  <a onclick='return confirm(\"CLICK OK TO CONFIRM SELECTION OF PATIENT TO CONTINUE ...\")' 
                  href='tasks/conduct_test_walk_in.php?patient_id=".$row['walk_code']."&patient_name=".$patient_name."&test_names=".$request_test_name."&request_code=".$row['request_code']."&edit=true"."&lab_no=".$row['lab_no']." '>" ."<i class='fa fa-edit'></i>"."</a> 


                  <a onclick='return confirm(\"CLICK OK TO CONFIRM SELECTION OF PATIENT TO CONTINUE ...\")' 
                  href='tasks/conduct_test_walk_in_edit.php?patient_id=".$row['walk_code']."&patient_name=".$patient_name."&test_names=".$request_test_name."&request_code=".$row['request_code']."&processed=true"."&requested_test=".$row['requested_test']."&id=".$row['id']."&patient_age=".$patient_age." '>" ."<i class='fa fa-file'></i>"."</a> 


                  <a target='_blank' href='tasks/p_v_r_wlkr?lab_code=".$row['request_code']."&patient_id=".$row['walk_code']."'>" . "<i class='fa fa-print'></i>" . "</a>     

                  <a target='_blank' href='tasks/p_v_r_wlk?lab_code=".$row['request_code']."&patient_id=".$row['walk_code']."'>" . "<i class='fa fa-eye'></i>" . "</a>  
                </div>
            </div>
        ";


//   <a href='tasks/conduct_test_walk_in_edit?patient_id=".$row['walk_code']."&patient_name=".$patient_name."&test_names=".$requested_lab_test."&request_code=".$request_code."&requested_test=".$requested_test."&id=".$id."&patient_age=".$patient_age." '>" 
//. "EDIT". "</a>

        }
        
    }
}




function processed_results_single_patient($patient_id){

    global $connection;
    $date = date('Y-m-d');
    $processed_by = $_SESSION['uid'];
    $payment_status = 1;
	
    $sql = "SELECT * FROM tbl_req_investigation WHERE status = 1 AND patient_id = '".$patient_id."' AND payment_status = '".$payment_status."' ";
    $result = mysqli_query($connection,$sql);
    
    while( $row = mysqli_fetch_assoc($result)){
        $doctor = requesting_doctor($row['doctor_id']);

        $date_sent_ = $row['processed_date'];

        $staff_info = get_staff_info($row['lab_staff_id']);
        $full_name_staff_lab = $staff_info['firstName']." ".$staff_info['otherNames'];
         
        
        $date_convert = date('jS M, Y', strtotime("$date_sent_")).", ".date('l', strtotime("$date_sent_"));
        

       // $request_test_name = $row['request_test_name'];


       
       
            echo "
            <div class='col-sm-6 col-md-4'>
                <div class='friend-widget'>
                    <img src='".patient_profile_picture($row['patient_id'])."'>
 
                    Patient: <i>" . patient_name($row['patient_id']) . "</i><br>
                  
                    Doctor: ". $doctor['firstName'] ."  ". $doctor['otherNames']."
                    <p>Processed Date: ".$date_convert."</p>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   
                   
                     
                    <a onclick='return confirm(\"CLICK OK TO CONFIRM SELECTION OF PATIENT TO CONTINUE ...\")' 
                    href='tasks/conduct_test.php?patient_id=".$row['patient_id']."&patient_name=".patient_name($row['patient_id'])."&test_names=".$row['request_test_name']."&request_code=".$row['request_code']."&edit=true"."&doc_id=".$row['doctor_id']."&lab_no=".$row['lab_no']." '>" ."<i class='fa fa-edit'></i>"."</a> 

                    <a target='_blank' href='tasks/p_v_rr?lab_code=".$row['request_code']."&patient_id=".$row['patient_id']."'>" . "<i class='fa fa-print'></i>" . "</a>

                    <a target='_blank' href='tasks/p_v_r?lab_code=".$row['request_code']."&patient_id=".$row['patient_id']."'>" . "<i class='fa fa-eye'></i>" . "</a>

                     <p style='margin-left: 60px'>Processed By: ".$full_name_staff_lab."</p>
                </div>
            </div>
        ";




     
        
    }
}



function processed_results_today(){

    global $connection;
    $date = date('Y-m-d');
    $processed_by = $_SESSION['uid'];
    $payment_status = 1;
	
    $sql = "SELECT * FROM tbl_req_investigation WHERE status = 1 AND processed_date = '".$date."' AND lab_staff_id = '".$processed_by."' AND payment_status = '".$payment_status."' ";
    $result = mysqli_query($connection,$sql);
    
    while( $row = mysqli_fetch_assoc($result)){
        $doctor = requesting_doctor($row['doctor_id']);
        $staff_info = get_staff_info($row['lab_staff_id']);
        $full_name_staff_lab = $staff_info['firstName']." ".$staff_info['otherNames'];

        $date_sent_ = $row['processed_date'];
         
        
        $date_convert = date('jS M, Y', strtotime("$date_sent_")).", ".date('l', strtotime("$date_sent_"));
        

       // $request_test_name = $row['request_test_name'];


      
        

            echo "
            <div class='col-sm-6 col-md-4'>
                <div class='friend-widget'>
                    <img src='".patient_profile_picture($row['patient_id'])."'>
 
                    Patient: <i>" . patient_name($row['patient_id']) . "</i><br>
                  
                    Doctor: ". $doctor['firstName'] ."  ". $doctor['otherNames']."
                    <p>Processed Date: ".$date_convert."</p>
                    

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   
                   
                     
                    <a onclick='return confirm(\"CLICK OK TO CONFIRM SELECTION OF PATIENT TO CONTINUE ...\")' 
                    href='tasks/conduct_test.php?patient_id=".$row['patient_id']."&patient_name=".patient_name($row['patient_id'])."&test_names=".$row['request_test_name']."&request_code=".$row['request_code']."&edit=true"."&doc_id=".$row['doctor_id']."&lab_no=".$row['lab_no']." '>" ."<i class='fa fa-edit'></i>"."</a> 

                    <a target='_blank' href='tasks/p_v_rr?lab_code=".$row['request_code']."&patient_id=".$row['patient_id']."'>" . "<i class='fa fa-print'></i>" . "</a>

                    <a target='_blank' href='tasks/p_v_r?lab_code=".$row['request_code']."&patient_id=".$row['patient_id']."'>" . "<i class='fa fa-eye'></i>" . "</a>

                    <p style='margin-left: 60px'>Processed By: ".$full_name_staff_lab."</p>
                </div>
            </div>
        ";




    
        
    }
}


function patient_investigation_name_by_code($request_code,$patient_id){
    global $connection;
	$sql = "SELECT request_test_name,requested_date,doctor_id,lab_no FROM tbl_req_investigation WHERE request_code = '".$request_code."' AND patient_id = '".$patient_id."' ";
	$query_run = mysqli_query($connection,$sql) or die(mysqli_error());
    $query_run_results = $query_run->fetch_assoc();
	//$investigation_name = $query_run_results['request_test_name'];
    return $query_run_results;
}

function last_thirty_days_results($process_date = FALSE){

    global $connection;

    //SELECT * FROM dt_table WHERE date BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 MONTH)  AND CURDATE();
	
	$date = date('Y-m-d');
    $processed_by = $_SESSION['uid'];
    
    $sql = "SELECT * FROM tbl_req_investigation WHERE status = 1 AND lab_staff_id = '".$processed_by."'  AND processed_date BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 MONTH) AND CURDATE() ORDER BY processed_date DESC ";
    $result = mysqli_query($connection,$sql);
    
    while( $row = mysqli_fetch_assoc($result)){
        $doctor = requesting_doctor($row['doctor_id']);

        $staff_info = get_staff_info($row['lab_staff_id']);
        $full_name_staff_lab = $staff_info['firstName']." ".$staff_info['otherNames'];

        $date_sent_ = $row['processed_date'];

       
         
        
        $date_convert = date('jS M, Y', strtotime("$date_sent_")).", ".date('l', strtotime("$date_sent_"));

     //   $request_test_name = $row['request_test_name'];

     

            echo "
            <div class='col-sm-6 col-md-4'>
                <div class='friend-widget'>
                    <img src='".patient_profile_picture($row['patient_id'])."'>
 
                    Patient: <i>" . patient_name($row['patient_id']) . "</i><br>
                  
                    Doctor: ". $doctor['firstName'] ."  ". $doctor['otherNames']."
                    <p>Processed Date: ".$date_convert."</p>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   
                   
                     
                    <a onclick='return confirm(\"CLICK OK TO CONFIRM SELECTION OF PATIENT TO CONTINUE ...\")' 
                    href='tasks/conduct_test.php?patient_id=".$row['patient_id']."&patient_name=".patient_name($row['patient_id'])."&test_names=".$row['request_test_name']."&request_code=".$row['request_code']."&edit=true"."&doc_id=".$row['doctor_id']."&lab_no=".$row['lab_no']." '>" ."<i class='fa fa-edit'></i>"."</a> 

                 
                    <a target='_blank' href='tasks/p_v_rr?lab_code=".$row['request_code']."&patient_id=".$row['patient_id']."'>" . "<i class='fa fa-print'></i>" . "</a>

                    <a target='_blank' href='tasks/p_v_r?lab_code=".$row['request_code']."&patient_id=".$row['patient_id']."'>" . "<i class='fa fa-eye'></i>" . "</a>

                    <p style='margin-left: 60px'>Processed By: ".$full_name_staff_lab."</p>
                </div>
            </div>
        ";

 
    }
}

function last_thirty_days_results_walk_in($process_date = FALSE){

    global $connection;

    //SELECT * FROM dt_table WHERE date BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 MONTH)  AND CURDATE();
	
	$date = date('Y-m-d');
    $user_id = $_SESSION['uid'];
    $sql = "SELECT * FROM tbl_walk_in_request_investigation WHERE lab_status = 1 AND lab_staff_id = '".$user_id."'  AND DATE(date_processed) BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 MONTH) AND CURDATE() ORDER BY date_processed DESC ";
    $result = mysqli_query($connection,$sql);
    
    while( $row = mysqli_fetch_assoc($result)){
      //  $doctor = requesting_doctor($row['doctor_id']);

        $date_sent_ = $row['date_processed'];

        $_taken = $row['source_name'];

        if($_taken==""){
               
            $_taken = $row['source'];
        }  
         
        
        $date_convert = date('jS M, Y', strtotime("$date_sent_")).", ".date('l', strtotime("$date_sent_"));

        $request_test_name = $row['requested_test_names'];

        $patient_walk_in_records = patient_name_walk_in($row['walk_code']);

        $patient_name = $patient_walk_in_records['full_name'];

        $patient_gender = $patient_walk_in_records['gender']; 
        

  
        
        
     

            echo "
            <div class='col-sm-6 col-md-4'>
                <div class='friend-widget'>
                    <img src='".patient_profile_picture($row['walk_code'])."'>
 
                    Patient: <i>" . $patient_name . "</i><br>
                  
                    Source: ".$_taken."
                    <p>Processed Date: ".$date_convert."</p><br>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     

                    <a onclick='return confirm(\"CLICK OK TO CONFIRM SELECTION OF PATIENT TO CONTINUE ...\")' 
                    href='tasks/conduct_test_walk_in.php?patient_id=".$row['walk_code']."&patient_name=".$patient_name."&test_names=".$request_test_name."&request_code=".$row['request_code']."&edit=true"."&lab_no=".$row['lab_no']." '>" ."<i class='fa fa-edit'></i>"."</a> 

                    <a target='_blank' href='tasks/p_v_r_wlkr?lab_code=".$row['request_code']."&patient_id=".$row['walk_code']."'>" . "<i class='fa fa-print'></i>" . "</a>  

                    <a target='_blank' href='tasks/p_v_r_wlk?lab_code=".$row['request_code']."&patient_id=".$row['walk_code']."'>" . "<i class='fa fa-eye'></i>" . "</a>  
                     
                </div>
            </div>
        ";

 
        
    }
}



function all_results_exist_results_walk_in($walk_code){

    global $connection;

    //SELECT * FROM dt_table WHERE date BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 MONTH)  AND CURDATE();
	
	$date = date('Y-m-d');
    $user_id = $_SESSION['uid'];
    $sql = "SELECT * FROM tbl_walk_in_request_investigation WHERE lab_status = 1 AND lab_staff_id = '".$user_id."'  AND walk_code = '".$walk_code."'  ORDER BY date_processed DESC ";
    $result = mysqli_query($connection,$sql);
    
    while( $row = mysqli_fetch_assoc($result)){
      //  $doctor = requesting_doctor($row['doctor_id']);

        $date_sent_ = $row['date_processed'];

        $_taken = $row['source_name'];

        if($_taken==""){
               
            $_taken = $row['source'];
        }  
         
        
        $date_convert = date('jS M, Y', strtotime("$date_sent_")).", ".date('l', strtotime("$date_sent_"));

        $request_test_name = $row['requested_test_names'];

        $patient_walk_in_records = patient_name_walk_in($row['walk_code']);

        $patient_name = $patient_walk_in_records['full_name'];

        $patient_gender = $patient_walk_in_records['gender'];

       // $_SESSION['patient_walk_in_name'] = $patient_name;

       // $_SESSION['patient_walk_gender'] = $patient_gender;

       // $request_test_name = $row['request_test_name'];
        

        if($request_test_name == "LFT,"){

            echo "
            <div class='col-sm-6 col-md-4'>
                <div class='friend-widget'>
                    <img src='".patient_profile_picture($row['walk_code'])."'>
 
                    Patient: <i>" . $patient_name . "</i><br>
                  
                    Source: ". $_taken."
                    <p>Processed Date: ".$date_convert."</p><br>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a target='_blank' href='tasks/p_v_r_wlkr?lab_code=".$row['request_code']."&patient_id=".$row['walk_code']."'>" . "<i class='fa fa-print'></i>" . "</a> 

                    <a target='_blank' href='tasks/p_v_r_wlk?lab_code=".$row['request_code']."&patient_id=".$row['walk_code']."'>" . "<i class='fa fa-eye'></i>" . "</a>    
                </div>
            </div>
        ";
            
        }else if($request_test_name == "Urine RE,"){
            echo "
            <div class='col-sm-6 col-md-4'>
                <div class='friend-widget'>
                    <img src='".patient_profile_picture($row['walk_code'])."'>
 
                    Patient: <i>" . $patient_name . "</i><br>
                  
                    Source: ". $_taken."
                    <p>Processed Date: ".$date_convert."</p><br>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a target='_blank' href='tasks/p_v_r_wlkr?lab_code=".$row['request_code']."&patient_id=".$row['walk_code']."'>" . "<i class='fa fa-print'></i>" . "</a> 

                    <a target='_blank' href='tasks/p_v_r_wlk?lab_code=".$row['request_code']."&patient_id=".$row['walk_code']."'>" . "<i class='fa fa-eye'></i>" . "</a>  
                     
                </div>
            </div>
        ";

        }else if($request_test_name == "FBC,"){
            echo "
            <div class='col-sm-6 col-md-4'>
                <div class='friend-widget'>
                    <img src='".patient_profile_picture($row['walk_code'])."'>
 
                    Patient: <i>" . $patient_name . "</i><br>
                  
                    Source: ".$_taken."
                    <p>Processed Date: ".$date_convert."</p><br>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a target='_blank' href='tasks/p_v_r_wlkr?lab_code=".$row['request_code']."&patient_id=".$row['walk_code']."'>" . "<i class='fa fa-print'></i>" . "</a> 

                    <a target='_blank' href='tasks/p_v_r_wlk?lab_code=".$row['request_code']."&patient_id=".$row['walk_code']."'>" . "<i class='fa fa-eye'></i>" . "</a>  
                     
                </div>
            </div>
        ";

        }
        
        
        else{

            echo "
            <div class='col-sm-6 col-md-4'>
                <div class='friend-widget'>
                    <img src='".patient_profile_picture($row['walk_code'])."'>
 
                    Patient: <i>" . $patient_name . "</i><br>
                  
                    Source: ".$_taken."
                    <p>Processed Date: ".$date_convert."</p><br>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a target='_blank' href='tasks/p_v_r_wlkr?lab_code=".$row['request_code']."&patient_id=".$row['walk_code']."'>" . "<i class='fa fa-print'></i>" . "</a> 

                    <a target='_blank' href='tasks/p_v_r_wlk?lab_code=".$row['request_code']."&patient_id=".$row['walk_code']."'>" . "<i class='fa fa-eye'></i>" . "</a>  

                     
                </div>
            </div>
        ";




        }
       

     
        
    }
}





function send_lab_results($patient_id, $request_code, $staff_id, $status,$view_status, $processed_date,$lab_no){

    global $connection;
    
    if($status == "1"){
        $sql = "UPDATE tbl_req_investigation SET processed_date = '".$processed_date."', lab_staff_id = '".$staff_id."', status = '".$status."',view_status = '".$view_status."', lab_no = '".$lab_no."' WHERE patient_id = '".$patient_id."' AND request_code = '".$request_code."'";
  
        if($query_run = mysqli_query($connection,$sql) or die(mysqli_error()) ){
            return TRUE;
         } else {
             return FALSE;
         }
    }else{
        //$status = 0;
        $sql = "UPDATE tbl_req_investigation SET processed_date = '".$processed_date."', lab_staff_id = '".$staff_id."', status = '".$status."',view_status = '".$view_status."', lab_no = '".$lab_no."' WHERE patient_id = '".$patient_id."' AND request_code = '".$request_code."'";
  
        if($query_run = mysqli_query($connection,$sql) or die(mysqli_error()) ){
            return TRUE;
         } else {
             return FALSE;
         }
    } 
     //view_status
   
}


function send_lab_results_walk_in($patient_id, $request_code, $staff_id, $status, $processed_date){

    global $connection;
    
    //$status = 1; 
    $sql = "UPDATE tbl_walk_in_request_investigation SET date_processed = '".$processed_date."', lab_staff_id = '".$staff_id."', lab_status = '".$status."' WHERE walk_code = '".$patient_id."' AND request_code = '".$request_code."'";
    
    if($query_run = mysqli_query($connection,$sql) or die(mysqli_error()) ){
       return TRUE;
    } else {
        return FALSE;
    }
}

/*
function get_age($dob){
    
    $age = date_diff(date_create('today'), date_create($dob))->y;
    
    if($age == date('Y')){
        return "0";
    } else {
        return $age;
    }
    
}*/



function insert_haematology($request_code, $patient_id, $lab_staff_id, $hb, $pcv, $t_wbc_count, $neutrophils, $lymphocytes, $monocytes,
                            $eosinophils, $malaria_parasites, $basophils, $mid_hash, $mid_percent, $sickling, $retics, $hb_electrophoresis, $esr, $g6pd, $blood_group, $fbs, $rbs){
    
    global $connection;
    
    $sql = "INSERT INTO haematology SET 
            request_code = '".$request_code."', 
            patient_id = '".$patient_id."', 
            lab_staff_id = '".$lab_staff_id."',
            hb = '".$hb."',
            pcv = '".$pcv."',
            t_wbc_count = '".$t_wbc_count."',
            neutrophils = '".$neutrophils."',
            lymphocytes = '".$lymphocytes."',
            monocytes = '".$monocytes."',
            eosinophils = '".$eosinophils."',
            malaria_parasites = '".$malaria_parasites."',    
            basophils = '".$basophils."',
            mid_hash = '".$mid_hash."',
            mid_percent = '".$mid_percent."',
            sickling = '".$sickling."',
            retics = '".$retics."',
            hb_electrophoresis = '".$hb_electrophoresis."',
            esr = '".$esr."',
            g6pd = '".$g6pd."',
            blood_group = '".$blood_group."',
            fbs = '".$fbs."',
            rbs = '".$rbs."',
            date_submitted = CURDATE()
            ";
            
            if($query_run = mysqli_query($connection,$sql) or die(mysqli_error())){
               return TRUE;
             } else {
                 return FALSE;
             }
}

function insert_urine_re($request_code, $patient_id, $lab_staff_id, $appearance, $colour, $specific_gravity, $ph, $protein, $glucose,
                         $ketones, $blood, $nitrite, $bilirubin, $urobilinogen,$epithelial_cell,$pus_cell,$rbcs,$wbc_cast,$crystals,$ova,$t_vaginals
                         ,$bacteria,$yeast_like_cells,$s_haemoglobin,$leukocytes,$Spermatozoa,$commentsurine,$others,$others_value,$is_exist){
    global $connection;

    $date = date('Y-m-d');
    
    if($is_exist == true){

        $sql="UPDATE urine_re SET  appearance = '".$appearance."', 
        colour = '".$colour."',
        specific_gravity = '".$specific_gravity."',
        ph = '".$ph."',
        protein = '".$protein."',
        glucose = '".$glucose."',
        ketones = '".$ketones."',
        blood = '".$blood."',
        nitrite = '".$nitrite."',
        bilirubin = '".$bilirubin."',
        urobilinogen = '".$urobilinogen."',
        epithelial_cell = '".$epithelial_cell."',
        pus_cell = '".$pus_cell."',
        rbcs = '".$rbcs."',
        wbc_cast = '".$wbc_cast."',
        crystals = '".$crystals."',
        ova = '".$ova."',
        t_vaginals = '".$t_vaginals."',
        bacteria = '".$bacteria."',
        yeast_like_cells = '".$yeast_like_cells."',
        s_haemoglobin = '".$s_haemoglobin."', 
        leukocytes = '".$leukocytes."',
        spermatozoa = '".$Spermatozoa."', 
        comments = '".$commentsurine."', 
        others = '".$others."', 
        others_value = '".$others_value."',  
        date_updated = '".$date."' WHERE patient_id = '".$patient_id."' AND request_code = '".$request_code."' ";
        if(mysqli_query($connection,$sql) or die(mysqli_error($connection))){
            return TRUE;
        } else {
            return FALSE;
        }

    }else{

        $sql = "INSERT INTO urine_re SET 
        request_code = '".$request_code."', 
        patient_id = '".$patient_id."',
        lab_staff_id = '".$lab_staff_id."', 
        appearance = '".$appearance."', 
        colour = '".$colour."',
        specific_gravity = '".$specific_gravity."',
        ph = '".$ph."',
        protein = '".$protein."',
        glucose = '".$glucose."',
        ketones = '".$ketones."',
        blood = '".$blood."',
        nitrite = '".$nitrite."',
        bilirubin = '".$bilirubin."',
        urobilinogen = '".$urobilinogen."',
        epithelial_cell = '".$epithelial_cell."',
        pus_cell = '".$pus_cell."',
        rbcs = '".$rbcs."',
        wbc_cast = '".$wbc_cast."',
        crystals = '".$crystals."',
        ova = '".$ova."',
        t_vaginals = '".$t_vaginals."',
        bacteria = '".$bacteria."',
        yeast_like_cells = '".$yeast_like_cells."',
        s_haemoglobin = '".$s_haemoglobin."', 
        leukocytes = '".$leukocytes."', 
        spermatozoa = '".$Spermatozoa."', 
        comments = '".$commentsurine."',
        others = '".$others."', 
        others_value = '".$others_value."',   
        date_submitted = CURDATE()
        ";
if($query_run = mysqli_query($connection,$sql) or die(mysqli_error()) ){
   return TRUE;
 } else {
     return FALSE;
 }
}}

function insert_hvsre($request_code, $patient_id, $lab_staff_id,$ep_cell,$pus_cell,$rbcs,$t_vaginalis,$bacteria,$yeast_like_cells,$is_exist){
    global $connection;

    $date = date('Y-m-d');

    
    
    if($is_exist == true){
        $sql="UPDATE tbl_hvsre SET  
        ep_cell = '".$ep_cell."', 
        pus_cell = '".$pus_cell."',
        rbcs = '".$rbcs."',
        t_vaginalis = '".$t_vaginalis."',
        bacteria = '".$bacteria."',
        yeast_like_cells = '".$yeast_like_cells."', 
        date_updated = '".$date."' WHERE patient_id = '".$patient_id."' AND request_code = '".$request_code."' ";
        if(mysqli_query($connection,$sql) or die(mysqli_error($connection))){
            return TRUE;
        } else {
            return FALSE;
        }

    }else{

     

        $sql = "INSERT INTO tbl_hvsre SET 
        request_code = '".$request_code."', 
        patient_id = '".$patient_id."',
        lab_staff_id = '".$lab_staff_id."', 
        ep_cell = '".$ep_cell."', 
        pus_cell = '".$pus_cell."',
        rbcs = '".$rbcs."',
        t_vaginalis = '".$t_vaginalis."',
        bacteria = '".$bacteria."',
        yeast_like_cells = '".$yeast_like_cells."', 
        date_submitted = CURDATE()
        ";


if($query_run = mysqli_query($connection,$sql) or die(mysqli_error()) ){
  
   return TRUE;
 } else {
     return FALSE;
 }
}}


function insert_lft($request_code, $patient_id, $lab_staff_id, $S_BILIRUBIN_Total, $S_BILIRUBIN_conjugated, $S_ALKALINE_PHOSPHATASE, $S_g_GLUTAMYL_TRANSFERASE, $S_ALT_GPT, 
                   $S_AST_GOT,$S_TOTAL_PROTEIN, $S_ALBUMIN,$S_BILIRUBIN_DIRECT,$is_exist){
    global $connection;
    $date = date('Y-m-d');

    if($is_exist == true){
        $sql="UPDATE lft SET  S_BILIRUBIN_Total = '".$S_BILIRUBIN_Total."', 
        S_BILIRUBIN_conjugated = '".$S_BILIRUBIN_conjugated."',
        S_ALKALINE_PHOSPHATASE = '".$S_ALKALINE_PHOSPHATASE."',
        S_g_GLUTAMYL_TRANSFERASE = '".$S_g_GLUTAMYL_TRANSFERASE."',
        S_ALT_GPT = '".$S_ALT_GPT."',
        S_AST_GOT = '".$S_AST_GOT."',
        S_TOTAL_PROTEIN = '".$S_TOTAL_PROTEIN."',
        S_ALBUMIN = '".$S_ALBUMIN."',
        S_BILIRUBIN_DIRECT = '".$S_BILIRUBIN_DIRECT."', 
        date_updated = '".$date."' WHERE patient_id = '".$patient_id."' AND request_code = '".$request_code."' ";
        if(mysqli_query($connection,$sql) or die(mysqli_error($connection))){
            return TRUE;
        } else {
            return FALSE;
        }


    }else{
        $sql = "INSERT INTO lft SET 
        request_code = '".$request_code."', 
        patient_id = '".$patient_id."',
        lab_staff_id = '".$lab_staff_id."', 
        S_BILIRUBIN_Total = '".$S_BILIRUBIN_Total."', 
        S_BILIRUBIN_conjugated = '".$S_BILIRUBIN_conjugated."',
        S_ALKALINE_PHOSPHATASE = '".$S_ALKALINE_PHOSPHATASE."',
        S_g_GLUTAMYL_TRANSFERASE = '".$S_g_GLUTAMYL_TRANSFERASE."',
        S_ALT_GPT = '".$S_ALT_GPT."',
        S_AST_GOT = '".$S_AST_GOT."',
        S_TOTAL_PROTEIN = '".$S_TOTAL_PROTEIN."',
        S_ALBUMIN = '".$S_ALBUMIN."', 
        S_BILIRUBIN_DIRECT = '".$S_BILIRUBIN_DIRECT."', 
        date_submitted = CURDATE()";
if($query_run = mysqli_query($connection,$sql) or die(mysqli_error()) ){
   return TRUE;
 } else {
     return FALSE;
 }

    }


   
}

function insert_lipid_profile($request_code, $patient_id, $lab_staff_id, $TOTAL_CHOLESTEROL, $TRIGLYCERIDES, $HDL_CHOLESTEROL, $LDL_CHOLESTEROL,$CORONARY_RISK,$is_exist){
    global $connection;
    $date = date('Y-m-d');

    if($is_exist == true){

        $sql="UPDATE lipid_profile SET  TOTAL_CHOLESTEROL = '".$TOTAL_CHOLESTEROL."', 
        TRIGLYCERIDES = '".$TRIGLYCERIDES."',
        HDL_CHOLESTEROL = '".$HDL_CHOLESTEROL."',
        LDL_CHOLESTEROL = '".$LDL_CHOLESTEROL."', 
        coronary_risk = '".$CORONARY_RISK."',
        date_updated = '".$date."' WHERE patient_id = '".$patient_id."' AND request_code = '".$request_code."' ";
        if(mysqli_query($connection,$sql) or die(mysqli_error($connection))){
            return TRUE;
        } else {
            return FALSE;
        }
    }else{

        $sql = "INSERT INTO lipid_profile SET 
        request_code = '".$request_code."', 
        patient_id = '".$patient_id."',
        lab_staff_id = '".$lab_staff_id."', 
        TOTAL_CHOLESTEROL = '".$TOTAL_CHOLESTEROL."', 
        TRIGLYCERIDES = '".$TRIGLYCERIDES."',
        HDL_CHOLESTEROL = '".$HDL_CHOLESTEROL."',
        LDL_CHOLESTEROL = '".$LDL_CHOLESTEROL."', 
        coronary_risk = '".$CORONARY_RISK."', 
        date_submitted = CURDATE()";
if($query_run = mysqli_query($connection,$sql) or die(mysqli_error()) ){
   return TRUE;
 } else {
     return FALSE;
 }


    }

   
}

function insert_bue_cr($request_code, $patient_id, $lab_staff_id, $SODIUM, $POTASSIUM, $CHLORIDE, $S_UREA,$S_CREATININE,$is_exist){
    global $connection;
    $date = date("Y-m-d");
    if($is_exist == true){
        $sql="UPDATE bue_cr SET SODIUM = '".$SODIUM."', 
        POTASSIUM = '".$POTASSIUM."',
        CHLORIDE = '".$CHLORIDE."',
        S_UREA = '".$S_UREA."', 
        S_CREATININE = '".$S_CREATININE."', 
        date_updated = '".$date."' WHERE patient_id = '".$patient_id."' AND request_code = '".$request_code."' ";   

        if($query_run = mysqli_query($connection,$sql) or die(mysqli_error()) ){
            return TRUE;
          } else {
              return FALSE;
          }

    }else{
        $sql = "INSERT INTO bue_cr SET 
        request_code = '".$request_code."', 
        patient_id = '".$patient_id."',
        lab_staff_id = '".$lab_staff_id."', 
        SODIUM = '".$SODIUM."', 
        POTASSIUM = '".$POTASSIUM."',
        CHLORIDE = '".$CHLORIDE."',
        S_UREA = '".$S_UREA."', 
        S_CREATININE = '".$S_CREATININE."', 
        date_submitted = CURDATE()";
if($query_run = mysqli_query($connection,$sql) or die(mysqli_error()) ){
   return TRUE;
 } else {
     return FALSE;
 }

    }
    
}

function insert_urea_creatine($request_code, $patient_id, $lab_staff_id, $S_UREA,$S_CREATININE,$is_exist){
    global $connection;
    $date = date("Y-m-d");

    if($is_exist == true){

        $sql="UPDATE urea_creatine SET  S_UREA = '".$S_UREA."', 
        S_CREATININE = '".$S_CREATININE."', 
        date_updated = '".$date."' WHERE patient_id = '".$patient_id."' AND request_code = '".$request_code."' ";
        if(mysqli_query($connection,$sql) or die(mysqli_error($connection))){
            return TRUE;
        } else {
            return FALSE;
        }

    }else{

        $sql = "INSERT INTO urea_creatine SET 
        request_code = '".$request_code."', 
        patient_id = '".$patient_id."',
        lab_staff_id = '".$lab_staff_id."', 
        S_UREA = '".$S_UREA."', 
        S_CREATININE = '".$S_CREATININE."', 
        date_submitted = CURDATE()";
if($query_run = mysqli_query($connection,$sql) or die(mysqli_error()) ){
   return TRUE;
 } else {
     return FALSE;
 }

    }

   
}

function insert_elec_tro_lytes($request_code, $patient_id, $lab_staff_id, $SODIUM, $POTASSIUM, $CHLORIDE,$is_exist){
    global $connection;
    $date = date('Y-m-d');
    if($is_exist == true){
        $sql="UPDATE elec_tro_lytes SET  SODIUM = '".$SODIUM."', 
        POTASSIUM = '".$POTASSIUM."',
        CHLORIDE = '".$CHLORIDE."', 
        date_updated = '".$date."' WHERE patient_id = '".$patient_id."' AND request_code = '".$request_code."' ";
        if(mysqli_query($connection,$sql) or die(mysqli_error($connection))){
            return TRUE;
        } else {
            return FALSE;
        }


    }else{

        $sql = "INSERT INTO elec_tro_lytes SET 
        request_code = '".$request_code."', 
        patient_id = '".$patient_id."',
        lab_staff_id = '".$lab_staff_id."', 
        SODIUM = '".$SODIUM."', 
        POTASSIUM = '".$POTASSIUM."',
        CHLORIDE = '".$CHLORIDE."', 
        date_submitted = CURDATE()";
if($query_run = mysqli_query($connection,$sql) or die(mysqli_error()) ){
   return TRUE;
 } else {
     return FALSE;
 }

    }
  
}

// $F_T_3 = $_POST['F_T_3'];
// $F_T_4 = $_POST['F_T_4']; 
// $T_S_H = $_POST['T_S_H'];  

function insert_tyroid_func($request_code, $patient_id, $lab_staff_id, $F_T_3, $F_T_4, $T_S_H,$is_exist){
    global $connection;
    $date = date('Y-m-d');
    if($is_exist == true){
        $sql="UPDATE tbl_tyroid_function_test SET  F_T_3 = '".$F_T_3."', 
        F_T_4 = '".$F_T_4."',
        T_S_H = '".$T_S_H."', 
        date_updated = '".$date."' WHERE patient_id = '".$patient_id."' AND request_code = '".$request_code."' ";
        if(mysqli_query($connection,$sql) or die(mysqli_error($connection))){
            return TRUE;
        } else {
            return FALSE;
        }


    }else{

        $sql = "INSERT INTO tbl_tyroid_function_test SET 
        request_code = '".$request_code."', 
        patient_id = '".$patient_id."',
        lab_staff_id = '".$lab_staff_id."', 
        F_T_3 = '".$F_T_3."', 
        F_T_4 = '".$F_T_4."',
        T_S_H = '".$T_S_H."', 
        date_submitted = CURDATE()";
if($query_run = mysqli_query($connection,$sql) or die(mysqli_error()) ){
   return TRUE;
 } else {
     return FALSE;
 }

    }
  
}


function insert_hb_electrophoresis($request_code, $patient_id, $lab_staff_id, $SICKLING, $GENOTYPE,$is_exist){
    global $connection;
    $date = date('Y-m-d');
    if($is_exist == true){
        $sql="UPDATE tbl_hb_electrophoresis SET  SICKLING = '".$SICKLING."', 
        GENOTYPE = '".$GENOTYPE."', 
        date_updated = '".$date."' WHERE patient_id = '".$patient_id."' AND request_code = '".$request_code."' ";
        if(mysqli_query($connection,$sql) or die(mysqli_error($connection))){
            return TRUE;
        } else {
            return FALSE;
        }


    }else{

        $sql = "INSERT INTO tbl_hb_electrophoresis SET 
        request_code = '".$request_code."', 
        patient_id = '".$patient_id."',
        lab_staff_id = '".$lab_staff_id."', 
        SICKLING = '".$SICKLING."', 
        GENOTYPE = '".$GENOTYPE."', 
        date_submitted = CURDATE()";
if($query_run = mysqli_query($connection,$sql) or die(mysqli_error()) ){
   return TRUE;
 } else {
     return FALSE;
 }

    }
  
}

function insert_blood_film_malaria($request_code, $patient_id, $lab_staff_id, $film_status, $film_status_count,$is_exist){
    global $connection;
    $date = date('Y-m-d');
    if($is_exist == true){
        $sql="UPDATE tbl_blood_film_malaria SET  film_status = '".$film_status."', 
        film_status_count = '".$film_status_count."', 
        date_updated = '".$date."' WHERE patient_id = '".$patient_id."' AND request_code = '".$request_code."' ";
        if(mysqli_query($connection,$sql) or die(mysqli_error($connection))){
            return TRUE;
        } else {
            return FALSE;
        }


    }else{

        $sql = "INSERT INTO tbl_blood_film_malaria SET 
        request_code = '".$request_code."', 
        patient_id = '".$patient_id."',
        lab_staff_id = '".$lab_staff_id."', 
        film_status = '".$film_status."', 
        film_status_count = '".$film_status_count."', 
        date_submitted = CURDATE()";
if($query_run = mysqli_query($connection,$sql) or die(mysqli_error()) ){
   return TRUE;
 } else {
     return FALSE;
 }

    }
  
}


function insert_fbc($request_code, $patient_id, $lab_staff_id, $WBC, $Lymphocytes_hash, $mid_hash, $gran_hash, $Lymphocytes_percent, 
                   $mid_percent,$gran_percent, $RBC,$HGB,$HCT,$MCV,$MCH,$MCHC,$RDW_CV,$RDW_SD,$PLT,$MPV,$PDW,$PCT,$P_LCR,$neutrophils,$monocytes,$eosinophils,$basophils,$retics,$is_exist){
    global $connection;

    $date = date("Y-m-d");

    if($is_exist == true){


        $sql="UPDATE fbc SET  WBC = '".$WBC."', 
        Lymphocytes_hash = '".$Lymphocytes_hash."',
        mid_hash = '".$mid_hash."',
        gran_hash = '".$gran_hash."',
        Lymphocytes_percent = '".$Lymphocytes_percent."',
        mid_percent = '".$mid_percent."',
        gran_percent = '".$gran_percent."',
        RBC = '".$RBC."',
        HGB = '".$HGB."',
        HCT = '".$HCT."',
        MCV = '".$MCV."',
        MCHC = '".$MCHC."',
        RDW_CV = '".$RDW_CV."',
        RDW_SD = '".$RDW_SD."',
        PLT = '".$PLT."',
        MPV = '".$MPV."',
        PDW = '".$PDW."',
        PCT = '".$PCT."',
        P_LCR = '".$P_LCR."',
        neutrophils = '".$neutrophils."',
        monocytes = '".$monocytes."',
        eosinophils = '".$eosinophils."', 
        basophils = '".$basophils."',
        retics = '".$retics."',  
        date_updated = '".$date."' WHERE patient_id = '".$patient_id."' AND request_code = '".$request_code."' ";
        if(mysqli_query($connection,$sql) or die(mysqli_error($connection))){
            return TRUE;
        } else {
            return FALSE;
        }


    }else{

        $sql = "INSERT INTO fbc SET 
        request_code = '".$request_code."', 
        patient_id = '".$patient_id."',
        lab_staff_id = '".$lab_staff_id."', 
        WBC = '".$WBC."', 
        Lymphocytes_hash = '".$Lymphocytes_hash."',
        mid_hash = '".$mid_hash."',
        gran_hash = '".$gran_hash."',
        Lymphocytes_percent = '".$Lymphocytes_percent."',
        mid_percent = '".$mid_percent."',
        gran_percent = '".$gran_percent."',
        RBC = '".$RBC."', 
        HGB = '".$HGB."',
        HCT = '".$HCT."',
        MCV = '".$MCV."',
        MCH = '".$MCH."',
        MCHC = '".$MCHC."',
        RDW_CV = '".$RDW_CV."',
        RDW_SD = '".$RDW_SD."',
        PLT = '".$PLT."',
        MPV = '".$MPV."',
        PDW = '".$PDW."',
        PCT = '".$PCT."',
        P_LCR = '".$P_LCR."',
        neutrophils = '".$neutrophils."',
        monocytes = '".$monocytes."',
        eosinophils = '".$eosinophils."',
        basophils = '".$basophils."',
        retics = '".$retics."',
        date_submitted = CURDATE()";
if($query_run = mysqli_query($connection,$sql) or die(mysqli_error()) ){
   return TRUE;
 } else {
     return FALSE;
 }

    }

 
}


function insert_blood_fbs($request_code, $patient_id, $lab_staff_id, $blood_fbs,$is_exist){
    global $connection;
    $date = date('Y-m-d');

    if($is_exist == true){
        $sql="UPDATE fbs SET  blood_fbs = '".$blood_fbs."', 
        date_updated = '".$date."' WHERE patient_id = '".$patient_id."' AND request_code = '".$request_code."' ";
        if(mysqli_query($connection,$sql) or die(mysqli_error($connection))){
            return TRUE;
        } else {
            return FALSE;
        }
    }else{

        $sql = "INSERT INTO fbs SET 
        request_code = '".$request_code."', 
        patient_id = '".$patient_id."',
        lab_staff_id = '".$lab_staff_id."', 
        blood_fbs = '".$blood_fbs."', 
        date_submitted = CURDATE()";
if($query_run = mysqli_query($connection,$sql) or die(mysqli_error()) ){
   return TRUE;
 } else {
     return FALSE;
 }


    }


  
}

function insert_blood_rbs($request_code, $patient_id, $lab_staff_id, $blood_fbs,$is_exist){
    global $connection;
    $date = date('Y-m-d');

    if($is_exist == true){
        $sql="UPDATE tbl_rbs SET  RBS_LEVEL = '".$blood_fbs."', 
        date_updated = '".$date."' WHERE patient_id = '".$patient_id."' AND request_code = '".$request_code."' ";
        if(mysqli_query($connection,$sql) or die(mysqli_error($connection))){
            return TRUE;
        } else {
            return FALSE;
        }
    }else{

        $sql = "INSERT INTO tbl_rbs SET 
        request_code = '".$request_code."', 
        patient_id = '".$patient_id."',
        lab_staff_id = '".$lab_staff_id."', 
        RBS_LEVEL = '".$blood_fbs."', 
        date_submitted = CURDATE()";
if($query_run = mysqli_query($connection,$sql) or die(mysqli_error()) ){
   return TRUE;
 } else {
     return FALSE;
 }}
}

function insert_efgr($request_code, $patient_id, $lab_staff_id, $efgr_value,$comment,$is_exist){
    global $connection;
    $date = date('Y-m-d');

    if($is_exist == true){
        $sql="UPDATE tbl_efgr SET  egfr_value = '".$efgr_value."', comment = '".$comment."',
        date_updated = '".$date."' WHERE patient_id = '".$patient_id."' AND request_code = '".$request_code."' ";
        if(mysqli_query($connection,$sql) or die(mysqli_error($connection))){
            return TRUE;
        } else {
            return FALSE;
        }
    }else{

        $sql = "INSERT INTO tbl_efgr SET 
        request_code = '".$request_code."', 
        patient_id = '".$patient_id."',
        lab_staff_id = '".$lab_staff_id."', 
        egfr_value = '".$efgr_value."', 
         comment = '".$comment."', 
        date_submitted = CURDATE()";
if($query_run = mysqli_query($connection,$sql) or die(mysqli_error()) ){
   return TRUE;
 } else {
     return FALSE;
 }}
}

function insert_2hpp($request_code, $patient_id, $lab_staff_id, $fasting,$first_hour,$second_hour,$is_exist){
    global $connection;
    $date = date('Y-m-d');

    if($is_exist == true){
        $sql="UPDATE 2_h_p_p SET  fasting = '".$fasting."',1st_hour = '".$first_hour."',2nd_hour = '".$second_hour."', 
        date_updated = '".$date."' WHERE patient_id = '".$patient_id."' AND request_code = '".$request_code."' ";
        if(mysqli_query($connection,$sql) or die(mysqli_error($connection))){
            return TRUE;
        } else {
            return FALSE;
        }
    }else{

        $sql = "INSERT INTO 2_h_p_p SET 
        request_code = '".$request_code."', 
        patient_id = '".$patient_id."',
        lab_staff_id = '".$lab_staff_id."', 
        fasting = '".$fasting."', 
        1st_hour = '".$first_hour."', 
        2nd_hour = '".$second_hour."', 
        date_submitted = CURDATE()";
if($query_run = mysqli_query($connection,$sql) or die(mysqli_error()) ){
   return TRUE;
 } else {
     return FALSE;
 }}
}



function insert_psa_($request_code, $patient_id, $lab_staff_id, $psa_lev,$PSA_EVALUATION,$is_exist){
    global $connection;
    $date = date("Y-m-d");

    if($is_exist == true){
        $sql="UPDATE psa SET  psa_lev = '".$psa_lev."',  evaluation = '".$PSA_EVALUATION."',
        date_updated = '".$date."' WHERE patient_id = '".$patient_id."' AND request_code = '".$request_code."' ";
        if(mysqli_query($connection,$sql) or die(mysqli_error($connection))){
            return TRUE;
        } else {
            return FALSE;
        }


    }else{

        $sql = "INSERT INTO psa SET 
        request_code = '".$request_code."', 
        patient_id = '".$patient_id."',
        lab_staff_id = '".$lab_staff_id."', 
        psa_lev = '".$psa_lev."',
        evaluation = '".$PSA_EVALUATION."',
        date_submitted = CURDATE()";
if($query_run = mysqli_query($connection,$sql) or die(mysqli_error()) ){
   return TRUE;
 } else {
     return FALSE;
 }

    }

    
}



function insert_stool_re( $request_code, $patient_id, $lab_staff_id, $macroscopy, $microscopy,$is_exist ){

    global $connection;
    $date = date("Y-m-d");

    if($is_exist == true){

        $sql="UPDATE stool_re SET  macroscopy = '".$macroscopy."', microscopy = '".$microscopy."',date_updated = '".$date."' WHERE patient_id = '".$patient_id."' AND request_code = '".$request_code."' ";
        if(mysqli_query($connection,$sql) or die(mysqli_error($connection))){
            return TRUE;
        } else {
            return FALSE;
        }

    }else{


        $sql = "INSERT into stool_re SET request_code = '".$request_code."', patient_id = '".$patient_id."', lab_staff_id = '".$lab_staff_id."', macroscopy  = '".$macroscopy."', microscopy = '".$microscopy."', date_submitted = CURDATE()";
    
        if($query_run = mysqli_query($connection,$sql) ){
          return TRUE;
        } else {
            return FALSE;
        }
   


    }
    
     
}

function insert_glycated_haemore( $request_code, $patient_id, $lab_staff_id, $GLYCATED_HAEMOGLOBIN,$evaluation,$is_exist ){

    global $connection;

    $date = date('Y-m-d');

    if($is_exist == true){

        $sql="UPDATE glycated_haemoglobin SET  GLYCATED_HAEMOGLOBIN = '".$GLYCATED_HAEMOGLOBIN."',date_updated = '".$date."',evaluation = '".$evaluation."' WHERE patient_id = '".$patient_id."' AND request_code = '".$request_code."' ";
        if(mysqli_query($connection,$sql) or die(mysqli_error($connection))){
            return TRUE;
        } else {
            return FALSE;
        }


    }else{

        $sql = "INSERT into glycated_haemoglobin SET request_code = '".$request_code."', patient_id = '".$patient_id."', lab_staff_id = '".$lab_staff_id."',
        GLYCATED_HAEMOGLOBIN  = '".$GLYCATED_HAEMOGLOBIN."',evaluation  = '".$evaluation."' , date_submitted = CURDATE()";
        
         if($query_run = mysqli_query($connection,$sql) ){
           return TRUE;
         } else {
             return FALSE;
         }

    }
    
   
     
}

function insert_level_haemore( $request_code, $patient_id, $lab_staff_id, $hae_lev,$is_exist ){

    global $connection;
    $date = date('Y-m-d');

    if($is_exist == true){

        $sql="UPDATE haemoglobin_level SET  hae_lev = '".$hae_lev."',date_updated = '".$date."' WHERE patient_id = '".$patient_id."' AND request_code = '".$request_code."' ";
        if(mysqli_query($connection,$sql) or die(mysqli_error($connection))){
            return TRUE;
        } else {
            return FALSE;
        }

    }else{

        $sql = "INSERT into haemoglobin_level SET request_code = '".$request_code."', patient_id = '".$patient_id."', lab_staff_id = '".$lab_staff_id."',
        hae_lev  = '".$hae_lev."', date_submitted = CURDATE()";
        
         if($query_run = mysqli_query($connection,$sql) ){
           return TRUE;
         } else {
             return FALSE;
         }

    }
    
     
}

function insert_level_esr( $request_code, $patient_id, $lab_staff_id, $ESR_LEVEL,$is_exist ){

    global $connection;
    $date = date('Y-m-d');

    if($is_exist == true){
        $sql="UPDATE tbl_esr SET  ESR_LEVEL = '".$ESR_LEVEL."',date_updated = '".$date."' WHERE patient_id = '".$patient_id."' AND request_code = '".$request_code."' ";
        if(mysqli_query($connection,$sql) or die(mysqli_error($connection))){
            return TRUE;
        } else {
            return FALSE;
        }


    }else{

        $sql = "INSERT into tbl_esr SET request_code = '".$request_code."', patient_id = '".$patient_id."', lab_staff_id = '".$lab_staff_id."',
        ESR_LEVEL  = '".$ESR_LEVEL."', date_submitted = CURDATE()";
        
         if($query_run = mysqli_query($connection,$sql) ){
           return TRUE;
         } else {
             return FALSE;
         }

    }
    
  
     
}

function insert_level_glucose( $request_code, $patient_id, $lab_staff_id, $GLUCOSE_LEVEL,$is_exist ){

    global $connection;
    $date = date('Y-m-d');

    if($is_exist == true){
        $sql="UPDATE tbl_ogtt SET  GLUCOSE_LEVEL = '".$GLUCOSE_LEVEL."',date_updated = '".$date."' WHERE patient_id = '".$patient_id."' AND request_code = '".$request_code."' ";
        if(mysqli_query($connection,$sql) or die(mysqli_error($connection))){
            return TRUE;
        } else {
            return FALSE;
        }


    }else{

        $sql = "INSERT into tbl_ogtt SET request_code = '".$request_code."', patient_id = '".$patient_id."', lab_staff_id = '".$lab_staff_id."',
        GLUCOSE_LEVEL  = '".$GLUCOSE_LEVEL."', date_submitted = CURDATE()";
        
         if($query_run = mysqli_query($connection,$sql) ){
           return TRUE;
         } else {
             return FALSE;
         }

    }
    
  
     
}

function insert_level_crp( $request_code, $patient_id, $lab_staff_id, $CRP_LEVEL_value,$evaluation,$is_exist ){

    global $connection;
    $date = date("Y-m-d");

    if($is_exist == true){

        $sql="UPDATE tbl_crp SET  CRP_LEVEL = '".$CRP_LEVEL_value."',evaluation = '".$evaluation."' ,date_updated = '".$date."' WHERE patient_id = '".$patient_id."' AND request_code = '".$request_code."' ";
        if(mysqli_query($connection,$sql) or die(mysqli_error($connection))){
            return TRUE;
        } else {
            return FALSE;
        }


    }else{

        $sql = "INSERT into tbl_crp SET request_code = '".$request_code."', patient_id = '".$patient_id."', lab_staff_id = '".$lab_staff_id."',
        CRP_LEVEL  = '".$CRP_LEVEL_value."',evaluation  = '".$evaluation."', date_submitted = CURDATE()";
        
         if($query_run = mysqli_query($connection,$sql) ){
           return TRUE;
         } else {
             return FALSE;
         }

    }
    

     
}

function insert_blood_group( $request_code, $patient_id, $lab_staff_id, $blood_group_val,$is_exist ){

    global $connection;
    $date = date("Y-m-d");

   // var_dump($blood_group_val);

    if($is_exist == true){

        $sql="UPDATE tbl_blood_group SET  BLOOD_TYPE = '".$blood_group_val."' ,date_updated = '".$date."' WHERE patient_id = '".$patient_id."' AND request_code = '".$request_code."' ";
        if(mysqli_query($connection,$sql) or die(mysqli_error($connection))){
            return TRUE;
        } else {
            return FALSE;
        }

    }else{

        $sql = "INSERT into tbl_blood_group SET request_code = '".$request_code."', patient_id = '".$patient_id."', lab_staff_id = '".$lab_staff_id."',
        BLOOD_TYPE  = '".$blood_group_val."', date_submitted = CURDATE()";
        
         if($query_run = mysqli_query($connection,$sql) ){
           return TRUE;
         } else {
             return FALSE;
         }

    }
    

     
}

function insert_uric_acid( $request_code, $patient_id, $lab_staff_id, $URIC_ACID_LEVEL,$is_exist ){

    global $connection;
    $date = date("Y-m-d");

    if($is_exist == true){
        $sql="UPDATE tbl_uric_acid SET  URIC_ACID_LEVEL = '".$URIC_ACID_LEVEL."' ,date_updated = '".$date."' WHERE patient_id = '".$patient_id."' AND request_code = '".$request_code."' ";
        if(mysqli_query($connection,$sql) or die(mysqli_error($connection))){
            return TRUE;
        } else {
            return FALSE;
        }


    }else{


        $sql = "INSERT into tbl_uric_acid SET request_code = '".$request_code."', patient_id = '".$patient_id."', lab_staff_id = '".$lab_staff_id."',
        URIC_ACID_LEVEL  = '".$URIC_ACID_LEVEL."', date_submitted = CURDATE()";
        
         if($query_run = mysqli_query($connection,$sql) ){
           return TRUE;
         } else {
             return FALSE;
         }
    
    }
    
     
}

function update_stool_re( $request_code, $patient_id, $lab_staff_id, $macroscopy, $microscopy ){

    global $connection;
    
    $sql = "UPDATE stool_re SET request_code = '".$request_code."', patient_id = '".$patient_id."', lab_staff_id = '".$lab_staff_id."', macroscopy  = '".$macroscopy."', microscopy = '".$microscopy."', date_updated = CURDATE()";
    
     if(  $query_run = mysqli_query($connection,$sql) ){
       return TRUE;
     } else {
         return FALSE;
     }
     
}

function insert_hvs_wet_prep($request_code, $patient_id, $lab_staff_id, $hvs_pus_cells, $hvs_ec, $hvs_rbc, $hvs_organism_one, $hvs_organism_two){

    global $connection;
    
    $sql = "INSERT INTO hvs_wet_prep SET 
            request_code = '".$request_code."', 
            patient_id = '".$patient_id."', 
            lab_staff_id = '".$lab_staff_id."', 
            hvs_pus_cells = '".$hvs_pus_cells."',
            hvs_ec = '".$hvs_ec."',
            hvs_rbc = '".$hvs_rbc."',
            hvs_organism_one = '".$hvs_organism_one."',
            hvs_organism_two = '".$hvs_organism_two."',
            date_submitted = CURDATE()";
    
    if(  $query_run = mysqli_query($connection,$sql) or die(mysqli_error()) ){
       return TRUE;
     } else {
         return FALSE;
     }
}

function insert_gram_stain($request_code, $patient_id, $lab_staff_id, $gs_pus_cells, $gs_ec, $gs_rbc, $gs_organism_one, $gs_organism_two){

    global $connection;
    
    $sql = "INSERT INTO gram_stain SET 
            request_code = '".$request_code."', 
            patient_id = '".$patient_id."', 
            lab_staff_id = '".$lab_staff_id."', 
            gs_pus_cells = '".$gs_pus_cells."',
            gs_ec = '".$gs_ec."',
            gs_rbc = '".$gs_rbc."',
            gs_organism_one = '".$gs_organism_one."',
            gs_organism_two = '".$gs_organism_two."',
            date_submitted = CURDATE()";
    
    if($query_run = mysqli_query($connection,$sql) or die(mysqli_error()) ){
       return TRUE;
     } else {
         return FALSE;
     }
}

function insert_general_microbiology($request_code, $patient_id, $lab_staff_id, $pus_cells, $rbcs, $epith_cells, $t_vaginalis, $bacteriodes, 
                                            $yeast_cells, $s_h_masoni, $crystals, $casts, $blood_filming, $hbsag, $vdrl_kahn, $urine_preg_test){
    global $connection;
    
    $sql = "INSERT INTO general_microbiology SET 
            request_code = '".$request_code."', 
            patient_id = '".$patient_id."', 
            lab_staff_id = '".$lab_staff_id."',
            pus_cells = '".$pus_cells."',
            rbcs = '".$rbcs."',
            epith_cells = '".$epith_cells."',
            t_vaginalis = '".$t_vaginalis."',
            bacteriodes = '".$bacteriodes."',
            yeast_cells = '".$yeast_cells."',
            s_h_masoni = '".$s_h_masoni."',
            crystals = '".$crystals."',
            casts = '".$casts."',
            blood_filming = '".$blood_filming."',
            hbsag = '".$hbsag."',
            vdrl_kahn = '".$vdrl_kahn."',
            urine_preg_test = '".$urine_preg_test."',
            date_submitted = CURDATE()
            ";
           
            if(  $query_run = mysqli_query($connection,$sql) or die(mysqli_error())){
               return TRUE;
             } else {
                 return FALSE;
             }
}

function insert_widal_test($request_code, $patient_id, $lab_staff_id, $s_typhi_o, $s_typhi_h, $comment,$is_exist){

         global $connection;

         $date = date('Y-m-d');

         if($is_exist==true){
            $sql="UPDATE widal_test SET  s_typhi_o = '".$s_typhi_o."', s_typhi_h = '".$s_typhi_h."',comment = '".$comment."',date_updated = '".$date."' WHERE patient_id = '".$patient_id."' AND request_code = '".$request_code."' ";
            if(mysqli_query($connection,$sql) or die(mysqli_error($connection))){
                return TRUE;
            } else {
                return FALSE;
            }


         }else{

            $sql = "INSERT INTO widal_test SET 
            request_code = '".$request_code."', 
            patient_id = '".$patient_id."', 
            lab_staff_id = '".$lab_staff_id."',
            s_typhi_o = '".$s_typhi_o."',
            s_typhi_h = '".$s_typhi_h."',
            comment = '".$comment."',
            date_submitted = CURDATE()
            ";
           
            if($query_run = mysqli_query($connection,$sql) or die(mysqli_error())){
               return TRUE;
             } else {
                 return FALSE;
             }


         }
    
  
}

function insert_typoid_test($request_code, $patient_id, $lab_staff_id, $IgG, $IgM, $comment,$is_exist){

    global $connection;

    $date = date('Y-m-d');

    if($is_exist == true){
        $sql="UPDATE typhoid_test SET  IgG = '".$IgG."', IgM = '".$IgM."',comment = '".$comment."',date_updated = '".$date."' WHERE patient_id = '".$patient_id."' AND request_code = '".$request_code."' ";
        if(mysqli_query($connection,$sql) or die(mysqli_error($connection))){
            return TRUE;
        } else {
            return FALSE;
        }


    }else{

        $sql = "INSERT INTO typhoid_test SET 
       request_code = '".$request_code."', 
       patient_id = '".$patient_id."', 
       lab_staff_id = '".$lab_staff_id."',
       IgG = '".$IgG."',
       IgM = '".$IgM."',
       comment = '".$comment."',
       date_submitted = CURDATE()
       ";
      
       if($query_run = mysqli_query($connection,$sql) or die(mysqli_error())){
          return TRUE;
        } else {
            return FALSE;
        }

    }


}

function insert_general_test($request_code,$patient_id,$lab_staff_id,$test_name,$status,$comment=null,$is_exist){

    global $connection;

    $date = date('Y-m-d');

    if($is_exist){

        $sql="UPDATE general_status_test SET   test_status = '".$status."',remarks = '".$comment."',date_updated = '".$date."'  WHERE patient_id = '".$patient_id."' AND request_code = '".$request_code."' AND test_name = '".$test_name."' ";
        if(mysqli_query($connection,$sql) or die(mysqli_error())){
            return TRUE;
        } else {
            return FALSE;
        }


    }else{

        $sql = "INSERT INTO general_status_test SET request_code = '".$request_code."',patient_id = '".$patient_id."',lab_staff_id = '".$lab_staff_id."',test_name = '".$test_name."',test_status = '".$status."', remarks = '".$comment."', date_submitted = CURDATE() ";       
      
        if($query_run = mysqli_query($connection,$sql) or die(mysqli_error())){
           return TRUE;
         } else {
             return FALSE;
         }

    }



     
}

function insert_skin_snip($request_code, $patient_id, $lab_staff_id, $remarks){

    global $connection;
    
    $sql = "INSERT INTO skin_snip SET 
            request_code = '".$request_code."', 
            patient_id = '".$patient_id."', 
            lab_staff_id = '".$lab_staff_id."',
            remarks = '".$remarks."',
            date_submitted = CURDATE()
            ";
           
            if($query_run = mysqli_query($connection,$sql) or die(mysqli_error() )){
               return TRUE;
             } else {
                 return FALSE;
             }
}


function insert_hepatitis_b_profile($request_code, $patient_id, $lab_staff_id, $HBsAg,$HBsAb,$HBeAg,$HBeAb,$HBcAb,$comments,$is_exist){

    global $connection;
    $date = date("Y-m-d");

    if($is_exist == true){

        $sql="UPDATE hepatitis_b_profile SET  HBsAg = '".$HBsAg."', 
        HBsAb = '".$HBsAb."',
        HBeAg = '".$HBeAg."',
        HBeAb = '".$HBeAb."',
        HBcAb = '".$HBcAb."',
        comments = '".$comments."', 
        date_updated = '".$date."' WHERE patient_id = '".$patient_id."' AND request_code = '".$request_code."' ";
        if(mysqli_query($connection,$sql) or die(mysqli_error($connection))){
            return TRUE;
        } else {
            return FALSE;
        }


    }else{

        $sql = "INSERT INTO hepatitis_b_profile SET 
        request_code = '".$request_code."', 
        patient_id = '".$patient_id."', 
        lab_staff_id = '".$lab_staff_id."',
        HBsAg = '".$HBsAg."',
        HBsAb = '".$HBsAb."',
        HBeAg = '".$HBeAg."',
        HBeAb = '".$HBeAb."',
        HBcAb = '".$HBcAb."', 
        comments = '".$comments."',
        date_submitted = CURDATE()
        ";
       
        if($query_run = mysqli_query($connection,$sql) or die(mysqli_error() )){
           return TRUE;
         } else {
             return FALSE;
         }

    }
    
   
}

function patient_folder($patient_id){
    
    $lab_results_folder = "lab_results/"; 
    $patient_folder_path = "/../../../patients/" . $patient_id . '/' . $lab_results_folder;
    
    $structure = "/../../../patients/" . $patient_id . '/';
    
    if( file_exists($patient_folder_path)){
        return $patient_folder_path;        
    } else {
        //mkdir($structure, 0777, TRUE);
        
        if(mkdir($structure . '/' .$lab_results_folder, 0777, TRUE)){
            return $patient_folder_path = "/../../../patients/" . $patient_id . '/' .$lab_results_folder;
        }
    }
}

//All Lab results functions
function get_haematology($patientID,$requestCode){//function to get current patient lab report

    global $connection;
				
	$sql = "SELECT distinct hb,pcv,t_wbc_count,neutrophils,lymphocytes,monocytes
	,eosinophils,basophils,sickling,retics,hb_electrophoresis,esr,g6pd
	,blood_group,fbs,rbs,malaria_parasites from  
	haematology WHERE patient_id='".$patientID."'AND request_code='".$requestCode."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
		while($see=mysqli_fetch_array($query_run)){

            return $see;

			// $_SESSION['hb']=$see['hb'];
			// $_SESSION['pcv']=$see['pcv'];
			// $_SESSION['t_wbc_count']=$see['t_wbc_count'];
			// $_SESSION['neutrophils']=$see['neutrophils'];
			// $_SESSION['lymphocytes']=$see['lymphocytes'];
			// $_SESSION['monocytes']=$see['monocytes'];
			// $_SESSION['eosinophils']=$see['eosinophils'];
			// $_SESSION['basophils']=$see['basophils'];
			// $_SESSION['sickling']=$see['sickling'];
			// $_SESSION['retics']=$see['retics'];
			// $_SESSION['hb_elec']=$see['hb_electrophoresis'];
			// $_SESSION['esr']=$see['esr'];
			// $_SESSION['g6pd']=$see['g6pd'];
			// $_SESSION['blood_group']=$see['blood_group'];
			// $_SESSION['fbs']=$see['fbs'];
			// $_SESSION['rbs']=$see['rbs'];
            // $_SESSION['malaria_parasites']=$see['malaria_parasites'];
		}
	}
}


// epithelial_cell VARCHAR(128) NULL, 
// pus_cell VARCHAR(128) NULL, 
// rbcs VARCHAR(128) NULL, 
// wbc_cast VARCHAR(128) NULL, 
// crystals VARCHAR(128) NULL, 
// ova VARCHAR(128)  NULL, 
// t_vaginals VARCHAR(128) NULL, 
// bacteria VARCHAR(128)  NULL, 
// yeast_like_cells VARCHAR(128) NULL, 
// s_haemoglobin VARCHAR(128) NOT NULL

function urine_re($patientID,$requestCode){
    global $connection;
	$sql = "SELECT distinct appearance,colour,specific_gravity,ph,protein,glucose
	,ketones,blood,nitrite,bilirubin,urobilinogen,bacteria,s_haemoglobin,yeast_like_cells,crystals,t_vaginals,ova,epithelial_cell,pus_cell, rbcs,wbc_cast,leukocytes,comments,spermatozoa,others,others_value from  
	urine_re  WHERE patient_id='".$patientID."'AND request_code='".$requestCode."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){


        return $see;
 
		
}}}


function get_lft_results($patientID,$requestCode){
    global $connection;
	$sql = "SELECT distinct S_BILIRUBIN_Total,S_BILIRUBIN_conjugated,S_ALKALINE_PHOSPHATASE,S_g_GLUTAMYL_TRANSFERASE,S_ALT_GPT,S_AST_GOT
	,S_TOTAL_PROTEIN,S_ALBUMIN,S_BILIRUBIN_DIRECT from lft  WHERE patient_id='".$patientID."'AND request_code='".$requestCode."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){


        return $see;
 
		
}}}

function get_HVSRE_results($patientID,$requestCode){
    global $connection;
	$sql = "SELECT distinct ep_cell,pus_cell,rbcs,t_vaginalis,bacteria,yeast_like_cells
	from tbl_hvsre  WHERE patient_id='".$patientID."'AND request_code='".$requestCode."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){


        return $see;
 
		
}}}


function get_lipid_profile_results($patientID,$requestCode){
    global $connection;
	$sql = "SELECT distinct TOTAL_CHOLESTEROL,TRIGLYCERIDES,HDL_CHOLESTEROL,LDL_CHOLESTEROL,coronary_risk from lipid_profile  WHERE patient_id='".$patientID."'AND 
    request_code='".$requestCode."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){


        return $see;
 
		
}}}

 

function get_bue_cr_results($patientID,$requestCode){
    global $connection;
	$sql = "SELECT SODIUM,POTASSIUM,CHLORIDE,S_UREA,S_CREATININE from bue_cr  WHERE patient_id='".$patientID."'AND 
    request_code='".$requestCode."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){

        return $see;		
}}}


function get_urea_creatine_results($patientID,$requestCode){
    global $connection;
	$sql = "SELECT S_UREA,S_CREATININE from urea_creatine  WHERE patient_id='".$patientID."'AND 
    request_code='".$requestCode."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){

        return $see;		
}}}

function get_elec_tro_lytes_results($patientID,$requestCode){
    global $connection;
	$sql = "SELECT SODIUM,POTASSIUM,CHLORIDE from elec_tro_lytes  WHERE patient_id='".$patientID."'AND 
    request_code='".$requestCode."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){

        return $see;		
}}}


function get_tyroid_func_results($patientID,$requestCode){
    global $connection;
	$sql = "SELECT F_T_3,F_T_4,T_S_H from tbl_tyroid_function_test  WHERE patient_id='".$patientID."'AND 
    request_code='".$requestCode."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){

        return $see;		
}}}


function get_hb_electrophoresis($patientID,$requestCode){
    global $connection;
	$sql = "SELECT SICKLING,GENOTYPE from tbl_hb_electrophoresis  WHERE patient_id='".$patientID."'AND 
    request_code='".$requestCode."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){

        return $see;		
}}}


function get_blood_film_for_malaria($patientID,$requestCode){
    global $connection;
	$sql = "SELECT film_status,film_status_count from tbl_blood_film_malaria  WHERE patient_id='".$patientID."'AND 
    request_code='".$requestCode."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){

        return $see;		
}}}



function get_fbs_results($patientID,$requestCode){
    global $connection;
	$sql = "SELECT blood_fbs,blood_rbs from fbs  WHERE patient_id='".$patientID."'AND 
    request_code='".$requestCode."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){
        return $see;		
}}}
function get_ogtt_results($patientID,$requestCode){
    global $connection;
	$sql = "SELECT GLUCOSE_LEVEL from tbl_ogtt  WHERE patient_id='".$patientID."'AND 
    request_code='".$requestCode."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){
        return $see;		
}}}


function get_rbs_results($patientID,$requestCode){
    global $connection;
	$sql = "SELECT RBS_LEVEL from tbl_rbs  WHERE patient_id='".$patientID."'AND 
    request_code='".$requestCode."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){
        return $see;		
}}}

function get_efgr_results($patientID,$requestCode){
    global $connection;
	$sql = "SELECT egfr_value,comment from tbl_efgr  WHERE patient_id='".$patientID."'AND 
    request_code='".$requestCode."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){
        return $see;		
}}}

function get_2HPP_results($patientID,$requestCode){
    global $connection;
	$sql = "SELECT fasting,1st_hour,2nd_hour from 2_h_p_p  WHERE patient_id='".$patientID."'AND 
    request_code='".$requestCode."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){
        return $see;		
}}}


 

function get_FBC_results($patientID,$requestCode){
    global $connection;
	$sql = "SELECT distinct WBC,Lymphocytes_hash,mid_hash,gran_hash,Lymphocytes_percent,mid_percent,gran_percent,RBC,HGB,HCT,MCV,MCH,MCHC,RDW_CV,RDW_SD,PLT,MPV,PDW,
     PCT,P_LCR,neutrophils,monocytes,eosinophils,basophils,retics  from fbc  WHERE patient_id='".$patientID."'AND request_code='".$requestCode."' ORDER BY id DESC LIMIT 1";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){


        return $see;
 
		
}}}


function hepatitis_B($patientID,$requestCode){
    global $connection;
    $test_name = "Hepatitis B";
	$sql = "SELECT distinct test_name, test_status,remarks from  
	general_status_test  WHERE patient_id='".$patientID."' AND request_code='".$requestCode."' AND test_name ='".$test_name."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){


        return $see;
 
		
}}}

function hiv_i_get($patientID,$requestCode){
    global $connection;
    $test_name = "HIV I";
	$sql = "SELECT distinct test_name, test_status from  
	general_status_test  WHERE patient_id='".$patientID."' AND request_code='".$requestCode."' AND test_name ='".$test_name."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){


        return $see;
 
		
}}}

function hiv_ii_get($patientID,$requestCode){
    global $connection;
    $test_name = "HIV II";
	$sql = "SELECT distinct test_name, test_status from  
	general_status_test  WHERE patient_id='".$patientID."' AND request_code='".$requestCode."' AND test_name ='".$test_name."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){


        return $see;
 
		
}}}

function hiv_i_ii_get($patientID,$requestCode){
    global $connection;
    $test_name = "HIV I&II";
	$sql = "SELECT distinct test_name, test_status,remarks from  
	general_status_test  WHERE patient_id='".$patientID."' AND request_code='".$requestCode."' AND test_name ='".$test_name."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){


        return $see;
 
		
}}}



function get_urine_preg($patientID,$requestCode){
    global $connection;
    $test_name = "URINE PREGNANCY TEST(UPT)";
	$sql = "SELECT distinct test_name, test_status,remarks from  
	general_status_test  WHERE patient_id='".$patientID."' AND request_code='".$requestCode."' AND test_name ='".$test_name."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){


        return $see;
 
		
}}}

function get_covid_19($patientID,$requestCode){
    global $connection;
    $test_name = "COVID-19 ANTIGEN";
	$sql = "SELECT distinct test_name, test_status,remarks from  
	general_status_test  WHERE patient_id='".$patientID."' AND request_code='".$requestCode."' AND test_name ='".$test_name."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){


        return $see;
 
		
}}}


function get_serum_preg($patientID,$requestCode){
    global $connection;
    $test_name = "SERUM PREGNANCY TEST(SPT)";
	$sql = "SELECT distinct test_name, test_status,remarks from  
	general_status_test  WHERE patient_id='".$patientID."' AND request_code='".$requestCode."' AND test_name ='".$test_name."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){


        return $see;
 
		
}}}



function hepatitis_B_profile($patientID,$requestCode){
    global $connection;
  //  $test_name = "Hepatitis B";
	$sql = "SELECT distinct HBsAg, HBsAb,HBeAg,HBeAb,HBcAb,comments from  
	hepatitis_b_profile  WHERE patient_id='".$patientID."' AND request_code='".$requestCode."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){


        return $see;
 
		
}}}

function get_gpd($patientID,$requestCode){
    global $connection;
    $test_name = "G6PD";
	$sql = "SELECT distinct test_name, test_status from  
	general_status_test  WHERE patient_id='".$patientID."' AND request_code='".$requestCode."' AND test_name ='".$test_name."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){


        return $see;
 
		
}}}


function SPT_test($patientID,$requestCode){
    global $connection;
    $test_name = "SPT";
	$sql = "SELECT distinct test_name, test_status from  
	general_status_test  WHERE patient_id='".$patientID."' AND request_code='".$requestCode."' AND test_name ='".$test_name."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){


        return $see;
 
		
}}}


function MALARIA_test($patientID,$requestCode){
    global $connection;
    $test_name = "Malaria";
	$sql = "SELECT distinct test_name, test_status,remarks from  
	general_status_test  WHERE patient_id='".$patientID."' AND request_code='".$requestCode."' AND test_name ='".$test_name."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){


        return $see;
 
		
}}}


function COVID_19_ANTIGEN_test($patientID,$requestCode){
    global $connection;
    $test_name = "COVID-19 ANTIGEN";
	$sql = "SELECT distinct test_name, test_status,remarks from  
	general_status_test  WHERE patient_id='".$patientID."' AND request_code='".$requestCode."' AND test_name ='".$test_name."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){


        return $see;
 
		
}}}


function HCV_test($patientID,$requestCode){
    global $connection;
    $test_name = "HCV";
	$sql = "SELECT distinct test_name, test_status,remarks from  
	general_status_test  WHERE patient_id='".$patientID."' AND request_code='".$requestCode."' AND test_name ='".$test_name."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){


        return $see;
 
		
}}}

function RETRO_SCREEN_test($patientID,$requestCode){
    global $connection;
    $test_name = "RETRO SCREEN";
	$sql = "SELECT distinct test_name, test_status from  
	general_status_test  WHERE patient_id='".$patientID."' AND request_code='".$requestCode."' AND test_name ='".$test_name."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){


        return $see;
 
		
}}}


function SICKLING_TEST($patientID,$requestCode){
    global $connection;
    $test_name = "SICKLING";
	$sql = "SELECT distinct test_name, test_status,remarks from  
	general_status_test  WHERE patient_id='".$patientID."' AND request_code='".$requestCode."' AND test_name ='".$test_name."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){


        return $see;
 
		
}}}

function SYPHILLIS_TEST($patientID,$requestCode){
    global $connection;
    $test_name = "SYPHILLIS";
	$sql = "SELECT distinct test_name, test_status,remarks from  
	general_status_test  WHERE patient_id='".$patientID."' AND request_code='".$requestCode."' AND test_name ='".$test_name."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){


        return $see;
 
		
}}}

function GONORRHEA_TEST($patientID,$requestCode){
    global $connection;
    $test_name = "GONORRHEA";
	$sql = "SELECT distinct test_name, test_status,remarks from  
	general_status_test  WHERE patient_id='".$patientID."' AND request_code='".$requestCode."' AND test_name ='".$test_name."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){


        return $see;
 
		
}}}

//H.PYLORI(SERUM)



function GENOTYPE_TEST($patientID,$requestCode){
    global $connection;
    $test_name = "GENOTYPE";
	$sql = "SELECT distinct test_name, test_status,remarks from  
	general_status_test  WHERE patient_id='".$patientID."' AND request_code='".$requestCode."' AND test_name ='".$test_name."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){


        return $see;
 
		
}}}

function H_PYLORI_SERUM__TEST($patientID,$requestCode){
    global $connection;
    $test_name = "H.PYLORI(SERUM)";
	$sql = "SELECT distinct test_name, test_status from  
	general_status_test  WHERE patient_id='".$patientID."' AND request_code='".$requestCode."' AND test_name ='".$test_name."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){


        return $see;
 
		
}}}



function H_PYLORI_STOOL__TEST($patientID,$requestCode){
    global $connection;
    $test_name = "H.PYLORI(STOOL)";
	$sql = "SELECT distinct test_name, test_status from  
	general_status_test  WHERE patient_id='".$patientID."' AND request_code='".$requestCode."' AND test_name ='".$test_name."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){


        return $see;
 
		
}}}


function Typhoid_test($patientID,$requestCode){
    global $connection;
   // $test_name = "RETRO SCREEN";
	$sql = "SELECT distinct IgG, IgM,comment from typhoid_test  WHERE patient_id='".$patientID."' AND request_code='".$requestCode."' ORDER BY id DESC LIMIT 1";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){


        return $see;
 
		
}}}


function Widal_test($patientID,$requestCode){
    global $connection;
   // $test_name = "RETRO SCREEN";
	$sql = "SELECT distinct s_typhi_o, s_typhi_h,comment from widal_test  WHERE patient_id='".$patientID."' AND request_code='".$requestCode."' ORDER BY id DESC LIMIT 1";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){


        return $see;
 
		
}}}

//glycated_haemoglobin

function stool_re($patientID,$requestCode){
    global $connection;
		$sql = "SELECT distinct macroscopy,microscopy from  
	stool_re WHERE patient_id='".$patientID."'AND request_code='".$requestCode."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){
           return $see;
		
}
	}
}

function glycated_haemoglobin($patientID,$requestCode){
    global $connection;
    $sql = "SELECT GLYCATED_HAEMOGLOBIN,evaluation from glycated_haemoglobin WHERE patient_id='".$patientID."'AND request_code='".$requestCode."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){
           return $see;
		
}
	}
}

function level_haemoglobin($patientID,$requestCode){
    global $connection;
    $sql = "SELECT hae_lev from haemoglobin_level WHERE patient_id='".$patientID."'AND request_code='".$requestCode."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){
           return $see;
		
}
	}
}

function get_level_esr($patientID,$requestCode){
    global $connection;
    $sql = "SELECT ESR_LEVEL from tbl_esr WHERE patient_id='".$patientID."'AND request_code='".$requestCode."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){
           return $see;
		
}
	}
}

function get_blood($patientID,$requestCode){
    global $connection;
    $sql = "SELECT BLOOD_TYPE from tbl_blood_group WHERE patient_id='".$patientID."'AND request_code='".$requestCode."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){
           return $see;
		
}
	}
}


function get_level_crp($patientID,$requestCode){
    global $connection;
    $sql = "SELECT CRP_LEVEL,evaluation from tbl_crp WHERE patient_id='".$patientID."' AND request_code='".$requestCode."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_assoc($query_run)){
           return $see;
		
}
	}
}

function get_level_URIC_ACID($patientID,$requestCode){
    global $connection;
    $sql = "SELECT URIC_ACID_LEVEL from tbl_uric_acid WHERE patient_id='".$patientID."'AND request_code='".$requestCode."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){
           return $see;
		
}
	}
}

function psa_results($patientID,$requestCode){
    global $connection;
    $sql = "SELECT psa_lev,evaluation from psa WHERE patient_id='".$patientID."'AND request_code='".$requestCode."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){
           return $see;
		
}
	}
}

function get_tyroid_func($patientID,$requestCode){
    global $connection;
	$sql = "SELECT F_T_3,F_T_4,T_S_H from tbl_tyroid_function_test  WHERE patient_id='".$patientID."'AND 
    request_code='".$requestCode."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){
        return $see;		
}}}


function hvs_wet_prep($patientID,$requestCode){

    global $connection;
		
		$sql = "SELECT distinct hvs_pus_cells,hvs_ec,hvs_rbc,hvs_organism_one,
		hvs_organism_two from  
		hvs_wet_prep WHERE patient_id='".$patientID."'AND request_code='".$requestCode."' ORDER BY id DESC LIMIT 1  
		";
		$query_run=mysqli_query($connection,$sql);
		$answer = mysqli_num_rows($query_run);
		if($answer ===1){
		while($see=mysqli_fetch_array($query_run)){

			$_SESSION['hvs_pus_cells']=$see['hvs_pus_cells'];
			$_SESSION['hvs_ec']=$see['hvs_ec'];
			$_SESSION['hvs_rbc']=$see['hvs_rbc'];
			$_SESSION['hvs_organism_one']=$see['hvs_organism_one'];
			$_SESSION['hvs_organism_two']=$see['hvs_organism_two'];
			
		}
	}
}
			
function gram_stain($patientID,$requestCode){

    global $connection;
		
	$sql = "SELECT distinct gs_pus_cells,gs_ec,gs_rbc,gs_organism_one,
	gs_organism_two from  
	gram_stain WHERE patient_id='".$patientID."'AND request_code='".$requestCode."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
	while($see=mysqli_fetch_array($query_run)){

		$_SESSION['gs_pus']=$see['gs_pus_cells'];
		$_SESSION['gs_ec']=$see['gs_ec'];
		$_SESSION['gs_rbc']=$see['gs_rbc'];
		$_SESSION['gs_org_1']=$see['gs_organism_one'];
		$_SESSION['gs_org_2']=$see['gs_organism_two'];
		
}	
	}
}

function general_microbiology($patientID,$requestCode){
    global $connection;
	$sql = "SELECT distinct pus_cells,rbcs,epith_cells,t_vaginalis,
	bacteriodes,yeast_cells,s_h_masoni,crystals,casts,blood_filming,
	hbsag,vdrl_kahn,urine_preg_test FROM  
	general_microbiology  WHERE patient_id='".$patientID."'AND request_code='".$requestCode."' ORDER BY id DESC LIMIT 1  
	";
		$query_run=mysqli_query($connection,$sql);
        $answer = mysqli_num_rows($query_run);
        if($answer ===1){
            while($see=mysqli_fetch_array($query_run)){

                return $see;
 
}	
	}
	
}

// function widal_test($patientID,$requestCode){

//     global $connection;
		
// 	$sql = "SELECT distinct s_typhi_o,s_typhi_h
// 	 from  
// 	widal_test WHERE patient_id='".$patientID."'AND request_code='".$requestCode."' ORDER BY id DESC LIMIT 1  
// 	";
// 	$query_run=mysqli_query($connection,$sql);
// 	$answer = mysqli_num_rows($query_run);
// 	if($answer ===1){
// 	while($see=mysqli_fetch_array($query_run)){

// 		$_SESSION['s_typhi_o']=$see['s_typhi_o'];
// 		$_SESSION['s_typhi_h']=$see['s_typhi_h'];
		
// }	
// }
// }


function skin_snip($patientID,$requestCode){

    global $connection;
		
	$sql = "SELECT distinct remarks
	 from  
	skin_snip WHERE patient_id='".$patientID."'AND request_code='".$requestCode."' ORDER BY id DESC LIMIT 1  
	";
	$query_run=mysqli_query($connection,$sql);
	$answer = mysqli_num_rows($query_run);
	if($answer ===1){
		while($see=mysqli_fetch_array($query_run)){
			$_SESSION['remarks']=$see['remarks'];
		}		
	}
}



//CHECKING IF REQUESTCODE EXIST TO PREVENT DUPLICATE OF LAB CODE


function check_patient_monitor_lab_request_code($patient_id,$request_code) {
	global $connection;
	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

	$query = "SELECT id FROM haematology WHERE  patient_id ='".$patient_id."' AND request_code ='".$request_code."' ";


	$query_results = mysqli_query($connection, $query);

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
 
 
}




function check_if_lab_results_is_submitted($patient_id,$request_code,$status,$lab_staff_id) {
	global $connection;
	//$state = 1;
	//$patient_id = mysqli_real_escape_string($connection, $patient_id);

	$query = "SELECT id FROM tbl_req_investigation WHERE  patient_id ='".$patient_id."' AND request_code ='".$request_code."' AND lab_staff_id ='".$lab_staff_id."' AND status ='".$status."' ";


	$query_results = mysqli_query($connection, $query);

    $num_rows = mysqli_num_rows($query_results);

    if($num_rows == 1){

        return true;
    }else{
        return false;
    }
 
 
}


//LAB NOTIFICATIONS PROCEDURES


function total_notification_waiting_patients_lab(){
	global $connection;
	$date = date('Y-m-d');
//	$user = $_SESSION['uid'];
	$sql = "SELECT COUNT(id) as total_notification_waiting_patients_lab FROM `tbl_req_investigation` WHERE requested_date = '".$date."' AND status = '0' 
    AND payment_status = '1' AND view_status = '0' ";
	$query_run = mysqli_query($connection,$sql);
	$rows = mysqli_fetch_assoc($query_run);
	$count = $rows['total_notification_waiting_patients_lab'];

	return $count;
	
}







function list_total_notification_waiting_patients_lab(){

	global $connection;

	$date = date('Y-m-d');
	//$user = $_SESSION['uid'];
	$sql = "SELECT patient_id,date_sent_ago,request_code,request_test_name FROM `tbl_req_investigation` WHERE requested_date = '".$date."' AND status = '0'
     AND payment_status = '1' AND view_status = '0' ";
	
	if($query_run=mysqli_query($connection,$sql)){

	if(mysqli_num_rows($query_run) > 0){
	
	while($row = mysqli_fetch_array($query_run) ){

		$date_time_stamp = time_passed($row['date_sent_ago']);

		$patient_name = patient_name($row['patient_id']);

        $request_code = $row['request_code'];

        $requested_lab_test = $row['request_test_name'];

        //

       // $request_code = $row['request_code'];

       // $date_sent_ = $row['requested_date'];

      //  $requested_lab_test = $row['request_test_name'];
 
    //  <td>.<a href='tasks/conduct_test?patient_id=".$row['patient_id']."&patient_name=".$patient_name."&test_names=".$requested_lab_test."
    //&request_code=".$request_code." '>" 
//. "CONDUCT TEST". "</a>.</td>

        //
 		
		echo" 						 

				<li>  <a onclick='return confirm(\"CLICK OK TO CONFIRM SELECTION OF PATIENT TO CONTINUE ...\")' 
                 href='tasks/conduct_test.php?patient_id=".$row['patient_id']."&patient_name=".$patient_name."&test_names=".$requested_lab_test."&request_code=".$request_code."      '>" 
				. $patient_name .", About "."$date_time_stamp". "</a>   </li> <li class='divider'></li>
				 		 	 
		";
		
	}}else{

		echo "No Incoming Patient, Feel Free To Relax A Bit!!! Or Keep An Eye On Some Records Today!!!";
	}

} else{
	echo "string ".mysqli_error();
}
}



function update_notification_waiting_patients_lab_view($patient_id,$request_code){
	global $connection;
	$viewed_state = 1;
	$user_id = $_SESSION['uid'];
	//$date = date('Y-m-d H:i:s');
	$sql="UPDATE tbl_req_investigation SET  view_status = '".$viewed_state."', view_status_by = '".$user_id."'  WHERE patient_id = '".$patient_id."' AND 
    request_code = '".$request_code."' ";
	if(mysqli_query($connection,$sql) or die(mysqli_error())){
		return TRUE;
	} else {
		return FALSE;
	}
}

function update_notification_doctors_lab_view($patient_id,$request_code){
	global $connection;
	$viewed_state = 1;
	$user_id = $_SESSION['uid'];
	//$date = date('Y-m-d H:i:s');
	$sql="UPDATE tbl_req_investigation SET  view_status_doc = '".$viewed_state."', view_status_doc_by = '".$user_id."'  WHERE patient_id = '".$patient_id."' AND 
    request_code = '".$request_code."' ";
	if(mysqli_query($connection,$sql) or die(mysqli_error())){
		return TRUE;
	} else {
		return FALSE;
	}
}

//this function would change the view status once lab edits the  report so doctor can view again
function re_update_notification_doctors_lab_view_on_edit($patient_id,$request_code,$doctor_id){
	global $connection;
	$viewed_state = 0;
	$user_id = $_SESSION['uid'];
	//$date = date('Y-m-d H:i:s');
	$sql="UPDATE tbl_req_investigation SET  view_status_doc = '".$viewed_state."',status = '".$viewed_state."'  WHERE patient_id = '".$patient_id."' AND 
    request_code = '".$request_code."' AND doctor_id = '".$doctor_id."'  ";
	if(mysqli_query($connection,$sql) or die(mysqli_error())){
		return TRUE;
	} else {
		return FALSE;
	}
}


// DUPLICATED CODE NEEDS TO BE RECTIFIED

//investigation requests table list view function
function list_investigations(){
	global $connection;
	//$sql = "SELECT * FROM tbl_investigations";
	$sql = "SELECT investigation_code, Investigations FROM tbl_investigations";
	$query_run = mysqli_query($connection,$sql);

	while($row = mysqli_fetch_array($query_run) ){
 		
		echo "<option value=".$row['investigation_code'].">".$row['Investigations']."</option>";
	}
	
}


function investigation_name($investigation_code){
    global $connection;
	$sql = "SELECT Investigations FROM tbl_investigations WHERE investigation_code = '".$investigation_code."'";
	$query_run = mysqli_query($connection,$sql) or die(mysqli_error());
    $query_run_results = $query_run->fetch_assoc();
	$investigation_name = trim($query_run_results['Investigations']);
    return $investigation_name;
}

function get_investigation_name($investigation_code){
	foreach ($investigation_code as $investigations) {
		
		echo $investigation_name = investigation_name($investigations) . ", ";

	}
}


function get_investigation_name_($investigation_code){
	$string = "";
	foreach ($investigation_code as $investigations) {		
		 $investigation_name = investigation_name($investigations);

		 $string .= $investigation_name.',';
		// return $investigation_name;
	}

	return $string;
}


function request_code(){
	$string ="WLKLAB";
	$year = substr(date('Y'), -2);
    $length = 12;
    $rand = random_code($length);
	return $request_code = $string . $year . $rand;
}


function random_code($length){
    $rand = 0;
     /* Only select from letters and numbers that are readable - no 0 or O etc..*/
    $characters = "23456789ABCDEFHJKLMNPRTVWXYZ";
 
   for ($p = 0; $p < $length; $p++) 
   {
       $rand .= $characters[mt_rand(0, strlen($characters)-1)];
   }

   return $rand;
}



// DUPLICATED CODE NEEDS TO BE 

 

//



function request_walk_in_investigation($requested_test,$remarks,$phone,$dob,$sex,$fullname,$source,$source_name,$lab_staff_id,$lab_no){

  

	global $connection;

    $random_walk_in_code = (time()+ rand(1,1000));


    $request_code = request_code();

	@$_SESSION['request_code'] = $request_code;

    $request_code = @$_SESSION['request_code'];
	
	$date_taken = date('Y-m-d');

	$now = date('Y-m-d H:i:s');



    //CHECKING FOR PHONE NUMBER OF WALKED PATIENT
//     $sql_PHONE = "SELECT id FROM tbl_walk_in_patient WHERE contact = '".$phone."' ";

// 	$result = mysqli_query($connection,$sql_PHONE);

// 	$num_rows = mysqli_num_rows($result);

//     if($num_rows > 0 ){

//         $_SESSION['inves_err']="<div class='alert alert-success alert-white rounded'>
//         <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
//         <div class='icon'><i class='fa fa-check'></i></div>
//         <strong>Info!</strong> Walk In Patient Already Exist. Kindly Search And Conduct The Test!!!!
//      </div>";

// header("Location: ../walk_in_labs");

//     }
    
   // else {


	$investigation_code = explode(',',$requested_test );

	$requested_test_names = get_investigation_name_($investigation_code);

	
	$sql = "SELECT id FROM tbl_walk_in_request_investigation WHERE request_code = '".$request_code."' AND walk_code = '".$random_walk_in_code."' AND DATE(date_requested) = '".$date_taken."'";

	$result = mysqli_query($connection,$sql);

	$num_rows = mysqli_num_rows($result);

    //var_dump($num_rows);

	if($num_rows == 0){

		$sql = "INSERT INTO tbl_walk_in_request_investigation (walk_code,request_code,source,source_name,lab_description,requested_test,requested_test_names,date_requested,lab_staff_id,lab_no)
		VALUES ('".$random_walk_in_code."','".$request_code."','".$source."','".$source_name."','".$remarks."','".$requested_test."','".$requested_test_names."','".$now."','".$lab_staff_id."','".$lab_no."')";
		
        $sql2 = "INSERT INTO tbl_walk_in_patient (walk_code,full_name,gender,dob,contact,date_created)
		VALUES ('".$random_walk_in_code."','".$fullname."','".$sex."','".$dob."','".$phone."','".$date_taken."')";
		
		$derye = mysqli_query($connection,$sql);

        if($derye){
         mysqli_query($connection,$sql2);
        }
 
		
		$_SESSION['inves_err']="<div class='alert alert-success alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-check'></i></div>
								<strong>Info!</strong> New Walk In Investigation Added!
							 </div>";
		
		
		header("Location: ../walk_in_labs");

	} else if($num_rows >= 1) {
		$_SESSION['inves_err']="<div class='alert alert-success alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-check'></i></div>
								<strong>Info!</strong> Failed To Added Walk In Request! Something Went Wrong!!!.
							 </div>";
		
		header("Location: ../walk_in_labs");
	}	


//}
}





function request_exist_walk_in_investigation($requested_test,$remarks,$patient_walk_in_code,$source,$source_name,$lab_staff_id,$lab_no){

	global $connection;
 


    $request_code = request_code();

	@$_SESSION['request_code'] = $request_code;

    $request_code = @$_SESSION['request_code'];
	
	$date_taken = date('Y-m-d');

	$now = date('Y-m-d H:i:s');





	$investigation_code = explode(',',$requested_test );

	$requested_test_names = get_investigation_name_($investigation_code);

	
	//$sql = "SELECT id FROM tbl_walk_in_request_investigation WHERE lab_no = '".$lab_no."' AND walk_code = '".$patient_walk_in_code."' AND DATE(date_requested) = '".$date_taken."'";

	//$result = mysqli_query($connection,$sql);

//	$num_rows = mysqli_num_rows($result);

	//if($num_rows == 0){

		$sql = "INSERT INTO tbl_walk_in_request_investigation (walk_code,request_code,source,source_name,lab_description,requested_test,requested_test_names,date_requested,lab_staff_id,lab_no)
		VALUES ('".$patient_walk_in_code."','".$request_code."','".$source."','".$source_name."','".$remarks."','".$requested_test."','".$requested_test_names."','".$now."','".$lab_staff_id."','".$lab_no."')";
		
       
		
	  mysqli_query($connection,$sql);

      
 
		
		$_SESSION['inves_err_exist']="<div class='alert alert-success alert-white rounded'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<div class='icon'><i class='fa fa-check'></i></div>
								<strong>Info!</strong> New Walk In Investigation Added!
							 </div>";
		
		
		header("Location: ../walk_in_exist");

	// } else if($num_rows >= 1) {
	// 	$_SESSION['inves_err_exist']="<div class='alert alert-success alert-white rounded'>
	// 							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
	// 							<div class='icon'><i class='fa fa-check'></i></div>
	// 							<strong>Info!</strong> Failed To Add Walk In Request! Walk In Record Is Added Already Today!!!.
	// 						 </div>";
		
		
    //                          header("Location: ../walk_in_exist");
	// }	


//}
}


function get_all_walk_in_patients(){

	global $connection;

//$date = date('Y-m-d');
//	$user = $_SESSION['uid'];
	$sql="SELECT id,full_name,gender,dob,contact FROM tbl_walk_in_patient ORDER BY date_created DESC ";
	
	if($query_run=mysqli_query($connection,$sql)){
	
	while($row = mysqli_fetch_array($query_run) ){

       // $fullname = $row['surname']. " ".$row['other_names'];
        $pat_id = $row['id'];
 		
		echo"
			 <tr>						
             <td>".$row['id']."</td>


             <td>".$row['full_name']."</td>

             <td>".$row['gender']."</td>
				
				<td>".$row['dob']."</td>
				 
				<td>".$row['contact']."</td>


                <td>
				 
					 
                <a onclick='return confirm(\"CLICK OK TO CONTINUE OR CANCEL...\")' class='label label-danger' href='tasks/set_update_patient_details?id=$pat_id'><i class='fa fa-edit'></i></a>
            </td>
        
                </tr>
		";
		
	}
	 
} else{
	echo "string ".mysqli_error();
}
}




function get_patient_walk_in_details($patient_id, $walk_code){

	global $connection;
//	$view_status = 0;
//	$today = date('Y-m-d');

	$sql = "SELECT full_name,gender,dob,contact FROM tbl_walk_in_patient WHERE id = '".$patient_id."' AND walk_code = '".$walk_code."' ";
	$query_run = mysqli_query($connection,$sql) or die(mysqli_error());

	$row = $query_run->fetch_assoc();

	@$full_name = $row['full_name'];
	@$gender = $row['gender'];
	@$dob = $row['dob']; 
    @$contact = $row['contact']; 

	//$doctor = get_staff_info($doctor_id);

	//$_SESSION['doctor_full_name'] = "Dr. ".$doctor['firstName']." ".$doctor['otherNames']."";
	
	$_SESSION['full_name'] = $full_name;
	$_SESSION['gender'] = $gender;
	$_SESSION['dob'] = $dob;
    $_SESSION['contact'] = $contact;
	

}

function update_patient_walk_in_details($patient_id,$walk_code,$full_name,$gender,$dob,$contact){
    global $connection;
    
   // $date = date('Y-m-d');
	
   
//$sql = "SELECT * FROM tbl_req_investigation WHERE status = '0' AND payment_status = '1' AND request_code = '".$request_code."'";

$sql="UPDATE tbl_walk_in_patient SET  full_name = '".$full_name."', gender = '".$gender."',dob = '".$dob."',contact = '".$contact."'  WHERE id = '".$patient_id."' AND walk_code = '".$walk_code."' ";
if(mysqli_query($connection,$sql) or die(mysqli_error())){
    return TRUE;
} else {
    return FALSE;
}
 
	
    
}



function delete_patient_walk_in_details($patient_id,$walk_code){
    global $connection;
    
   // $date = date('Y-m-d');
	
   
//$sql = "SELECT * FROM tbl_req_investigation WHERE status = '0' AND payment_status = '1' AND request_code = '".$request_code."'";

$sql="DELETE FROM tbl_walk_in_patient WHERE id='".$patient_id."' AND walk_code='".$walk_code."' ";
if(mysqli_query($connection,$sql) or die(mysqli_error())){
    return TRUE;
} else {
    return FALSE;
}
 
	
    
}


function listprice_investigations() {
    global $connection;
    $sql = "SELECT Investigations,Tarriffs,investigation_code,ID FROM tbl_investigations";
    $query_run = mysqli_query($connection,$sql);

    while ($row = mysqli_fetch_array($query_run)) {
        echo"
			 <tr>						
				<td>" . $row['Investigations'] . "</td>
				 
				<td>" . $row['Tarriffs'] . " </td>
				<td>" . $row['investigation_code'] . " </td>
			  
				<td class='text-center'><a onclick='return confirm(\"CLICK OK TO CONFIRM EDIT OR CANCEL TO PREVENT EDIT...\")' class='label label-danger' href='db_tasks/edit_lab.php?id=" . $row['ID'] . "'><i class='fa fa-pencil'></i></a></td>
			</tr>
		";
    }
}

function get_investigation_price($id){
    global $connection;
	//$sql = "SELECT request_test_name,requested_date,doctor_id,lab_no FROM tbl_req_investigation WHERE request_code = '".$request_code."' AND patient_id = '".$patient_id."' ";
    $sql = "SELECT Investigations,Tarriffs,investigation_code,ID FROM tbl_investigations WHERE ID = '".$id."'";
	$query_run = mysqli_query($connection,$sql) or die(mysqli_error());
    $query_run_results = $query_run->fetch_assoc();
	//$investigation_name = $query_run_results['request_test_name'];
    return $query_run_results;
}


function update_investigation_price($ID,$INVES_NAME,$INVES_PRICE){
    global $connection;
    
   // $date = date('Y-m-d');
	
   
//$sql = "SELECT * FROM tbl_req_investigation WHERE status = '0' AND payment_status = '1' AND request_code = '".$request_code."'";

$sql="UPDATE tbl_investigations SET  Investigations = '".$INVES_NAME."', Tarriffs = '".$INVES_PRICE."'  WHERE ID = '".$ID."' ";
if(mysqli_query($connection,$sql) or die(mysqli_error())){
    return TRUE;
} else {
    return FALSE;
}
 
	
    
}



