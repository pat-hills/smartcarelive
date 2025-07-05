<?php


require '../../functions/conndb.php';
require '../../functions/func_common.php';


// Auto suggetion
$html = '';
if(isset($_POST['patient_name']) && strlen($_POST['patient_name']))
{
  $patients = find_walk_in_patient_by_name($_POST['patient_name']);
  if($patients){
     foreach ($patients as $patient): 
        $html .= "<a href = '../lab/tasks/set_patient_walk_in_patient_edit?walk_code=$patient[walk_code]&patient_id=$patient[id]' class=\"list-group-item\">";
        $html .= $patient['full_name']." ( Patient's Contact: ) ".$patient['contact'];
        $html .= "</a>";
      endforeach;
   } else {

     $html .= '<li onClick=\"fill(\''.addslashes().'\')\" class=\"list-group-item\">';
     $html .= 'Not found';
     $html .= "</li>";

   }

   echo json_encode($html);
}




?>