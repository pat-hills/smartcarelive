<?php 

    require '../../../functions/conndb.php';
    require '../../../functions/func_lab.php';
    session_start(); 
    global $connection;
    
    $patient_id = $_SESSION['patient_id'];
    $request_code = $_SESSION['request_code'];
    $lab_staff_id = $_SESSION['uid'];
    $macroscopy = $_POST['macroscopy'];
    $microscopy = $_POST['microscopy'];
    $curr_date = date('Y-m-d');
    
    //$inserted = insert_reference_ranges( $patient_id, $sodium, $potasium );
    $sql = "SELECT request_code, patient_id, lab_staff_id, date_submitted FROM stool_re WHERE request_code = '".$request_code."' AND patient_id = '".$patient_id."' 
            AND lab_staff_id = '".$lab_staff_id."' AND date_submitted = '".$curr_date."'";
        
    $result = mysqli_query($connection,$sql);
    $rows = mysqli_num_rows($result);
   
    if( $rows == 1){
         $updated = update_stool_re( $request_code, $patient_id, $lab_staff_id, $macroscopy, $microscopy );
        if($updated){
            echo "STOOL R/E results has been updated succesfully";  
        }else {
            echo "Sorry STOOL R/E results could not be updated";
        }
    }  else if( $rows == 0){
        $inserted = insert_stool_re( $request_code, $patient_id, $lab_staff_id, $macroscopy, $microscopy );
    
        if($inserted){
            echo "STOOL R/E results has been inserted succesfully";  
        }else {
            echo "Sorry STOOL R/E results could not be inserted";
        }
    }
    
    

