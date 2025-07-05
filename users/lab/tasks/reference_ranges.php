<?php 

 require '../../../functions/conndb.php';
 require '../../../functions/func_lab.php';

if( isset($_POST['ref_ranges'] ) ) {
	
    $patient_id = 'PAT21212';
    $sodium = $_POST['sodium'];
    $potasium = $_POST['potasium'];

    //$inserted = insert_reference_ranges( $patient_id, $sodium, $potasium );
    
    $inserted = insert_reference_ranges( $patient_id, $sodium, $potasium );
    
    if($inserted){
        echo "Inserted succesfully";
        
    }
}
