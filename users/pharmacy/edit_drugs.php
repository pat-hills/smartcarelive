<?php
 if(!isset($_GET['code']) and empty($_GET['code'])){
header('Location:../update_drug.php'); die();
 }

require_once '../../functions/conndb.php';
require_once '../../functions/func_records.php';
require_once "p_parts/heads/update_pat_head.php";
require_once "p_parts/navbar.php";
require_once "p_parts/sidebar.php";
require_once "tasks/edit_drugs.php";
require_once "p_parts/foots/add_pat_foot.php";

?>