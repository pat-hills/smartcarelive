<?php
require_once '../../../functions/func_consulting.php';
if(isset($_GET['code']) and !empty($_GET['code'])){
$drugcode = $_GET['code'];
//delete drug 

 if(deleteDrug($drugcode) == false){
 header('Location:../view_drugs.php?message=unable to delete drug'); die();
 }else{
 header('Location:../view_drugs.php'); die();
 
 }
 
 
}else{

header('Location:../view_drugs.php'); die();

}

?>