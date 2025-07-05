<?php

require_once "p_parts/heads/add_pat_head.php";
require_once "p_parts/navbar.php";
require_once "p_parts/sidebar.php";
require_once "tasks/send_to_cashier_before_vitals.php";
require_once "p_parts/foots/add_pat_foot.php";


//Assuming the Home link is clicked, set $_SESSION['indicator'] to empty

$_SESSION['indicator'] = "";

?>