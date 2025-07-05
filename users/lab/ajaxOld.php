<?php


require_once "p_parts/navbar.php";


// Auto suggetion
$html = '';
if(isset($_POST['patient_name']) && strlen($_POST['patient_name']))
{
  $patients = find_patient_by_name($_POST['patient_name']);
  if($patients){
     foreach ($patients as $patient):
        $html .= "<a href = 'add.php?name=$patient[surname]' class=\"list-group-item\">";
        $html .= $patient['surname'];
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