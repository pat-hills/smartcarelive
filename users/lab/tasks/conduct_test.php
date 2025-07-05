<?php 
//this file sets the patient details to be used by the records user in his/her module
//it calls two functions from the records functions file
//function 1 gets the right person by using the submited form data and
//function 2 uses the result of function to set the patient details 
require '../../../functions/conndb.php';
require '../../../functions/func_search.php';
require '../../../functions/func_lab.php'; 

session_start();

//recieving post vairable from multiple search form//request_code
@$patient_name = $_GET['patient_name'];

@$patient_id = $_GET['patient_id'];

@$test_names = $_GET['test_names'];

@$request_code = $_GET['request_code'];

@$edit = $_GET['edit'];

@$doc_id = $_GET['doc_id'];

@$lab_no = $_GET['lab_no'];

$dob = patient_age_opd($patient_id);

 

if(isset($patient_name) && !empty($patient_name) && isset($request_code) && !empty($request_code)){
	
	 

    $_SESSION['patient_name']= $patient_name;
    $_SESSION['patient_id']= $patient_id;
    $_SESSION['test_names']= $test_names;
    $_SESSION['request_code']= $request_code;

    $_SESSION['edit'] = $edit;

    
    $_SESSION['lab_no'] = $lab_no;

    $_SESSION['dob'] = $dob;
 

    if(!$edit){

        
    update_notification_waiting_patients_lab_view($patient_id,$request_code);

    }else{
        re_update_notification_doctors_lab_view_on_edit($patient_id,$request_code,$doc_id);
    }
		
	//}

    // if($edit == true){
    //     update_inferences_by_code($patient_id,$request_code);
    // }
	
}  


header("Location: ../conduct_test");
?>