<?php


require '../../functions/conndb.php';
require '../../functions/func_common.php';


// Auto suggetion
$html = '';
if(isset($_POST['patient_name']) && strlen($_POST['patient_name']))
{
  $patients = find_patient_by_name($_POST['patient_name']);
  if($patients){
     foreach ($patients as $patient): 
      $html .= "<a href = '../lab/tasks/set_patient_search_results_patient?patient_id=$patient[patient_id]&contact=$patient[phone]&surname=$patient[surname]&othernames=$patient[other_names]' class=\"list-group-item\">";
      $html .= $patient['surname']." ".$patient['other_names']." ( Patient's Contact: ) ".$patient['phone'];
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