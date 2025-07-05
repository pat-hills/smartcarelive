<?php
require_once '../../../functions/func_pharmacy.php';
if(isset($_GET['code']) and !empty($_GET['code'])){
$drugcode = $_GET['code'];
//delete drug 

 if(deleteDrug($drugcode) == false){
 header('Location:../update_drug.php?message=unable to delete drug'); die();
 }else{
 header('Location:../update_drug.php'); die();
 
 }
 
 
}else{

header('Location:../update_drug.php'); die();

}

?>