<?php 
session_start();
if(!isset($_SESSION['uid'])){
  header("Location: ../../../index");
}



require_once '../../../functions/conndb.php';
require_once '../../../functions/func_search.php';
require_once '../../../functions/func_constant.php';
require_once '../../../functions/func_common.php';
require_once '../../../functions/func_nhis.php';
require_once '../../../functions/func_lab.php';




$view_patient_lab_processed_today = view_patient_lab_processed_today($lab_code);

$get_lab_requests_to_view = $view_patient_lab_processed_today['requested_test'];

$get_lab_requests_to_view = explode(',', $get_lab_requests_to_view);




$institution_details = getInstitutionDetails();



$hospital_name = $institution_details['hospital_name'];
$telephone_1 = $institution_details['telephone_1'];
$telephone_2 = $institution_details['telephone_2'];
$telephone_3 = $institution_details['telephone_3'];
$postal_address = $institution_details['postal_address'];
$join_telephone = $telephone_1. " ".$telephone_2." ".$telephone_3." ";


$schoolLogo = "../../../institution_images/clinic_logo.png";


?>

<!DOCTYPE html>
<html lang="en">
    
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="assets/images/favicon.png">

	<title>SmartCareAid | LAB </title>
	<!--<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,800' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Raleway:300,200,100' rel='stylesheet' type='text/css'>-->

	<!-- Bootstrap core CSS -->
	<!-- <link href="assets/js/bootstrap/dist/css/bootstrap.css" rel="stylesheet">

	<link rel="stylesheet" href="assets/fonts/font-awesome-4/css/font-awesome.min.css"> -->

	<!-- Custom styles for this template -->
  <link href="../../../assets/css/bootstrap.min.css" rel="stylesheet" />	  

<!--   
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
<style>

 

</style>

</head>

<body class="">

<?php 






?>

 
<div class="row">
                        <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <div class="card-header p-4">
                                     <a class="pt-2 d-inline-block" href="#"><img src="<?php echo $schoolLogo ?>" width="50" height="50"/></a>
                                   
                                    <div class="float-right"> <h3 class="mb-0">Invoice #1</h3>
                                    Date: 3 Dec, 2020</div>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-4">
                                        <div class="col-sm-6">
                                            <h5 class="mb-3">From:</h5>                                            
                                            <h3 class="text-dark mb-1">Gerald A. Garcia</h3>
                                         
                                            <div>2546 Penn Street</div>
                                            <div>Sikeston, MO 63801</div>
                                            <div>Email: info@gerald.com.pl</div>
                                            <div>Phone: +573-282-9117</div>
                                        </div>
                                        <div class="col-sm-6">
                                            <h5 class="mb-3">To:</h5>
                                            <h3 class="text-dark mb-1">Anthony K. Friel</h3>                                            
                                            <div>478 Collins Avenue</div>
                                            <div>Canal Winchester, OH 43110</div>
                                            <div>Email: info@anthonyk.com</div>
                                            <div>Phone: +614-837-8483</div>
                                        </div>
                                    </div>


                                    <?php foreach ($get_lab_requests_to_view as $lab_test) { ?>    
                                   

                                      <?php if (investigation_name($lab_test) == "Urine RE") { ?>

                                    <div class="table-responsive-sm">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="center">Urine Re</th>
                                                    <th>Test</th>
                                                    <th>Results</th>
                                                    <th class="right">Reference</th>
                                                    <th class="center">Qty</th>
                                                    <th class="right">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="center">1</td>
                                                    <td class="left strong">Origin License</td>
                                                    <td class="left">Extended License</td>
                                                    <td class="right">$1500,00</td>
                                                    <td class="center">1</td>
                                                    <td class="right">$1500,00</td>
                                                </tr>
                                                <tr>
                                                    <td class="center">2</td>
                                                    <td class="left">Custom Services</td>
                                                    <td class="left">Instalation and Customization (cost per hour)</td>
                                                    <td class="right">$110,00</td>
                                                    <td class="center">20</td>
                                                    <td class="right">$22.000,00</td>
                                                </tr>
                                                <tr>
                                                    <td class="center">3</td>
                                                    <td class="left">Hosting</td>
                                                    <td class="left">1 year subcription</td>
                                                    <td class="right">$309,00</td>
                                                    <td class="center">1</td>
                                                    <td class="right">$309,00</td>
                                                </tr>
                                                <tr>
                                                    <td class="center">4</td>
                                                    <td class="left">Platinum Support</td>
                                                    <td class="left">1 year subcription 24/7</td>
                                                    <td class="right">$5.000,00</td>
                                                    <td class="center">1</td>
                                                    <td class="right">$5.000,00</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- <div class="row">
                                        <div class="col-lg-4 col-sm-5">
                                        </div>
                                        <div class="col-lg-4 col-sm-5 ml-auto">
                                            <table class="table table-clear">
                                                <tbody>
                                                    <tr>
                                                        <td class="left">
                                                            <strong class="text-dark">Subtotal</strong>
                                                        </td>
                                                        <td class="right">$28,809,00</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="left">
                                                            <strong class="text-dark">Discount (20%)</strong>
                                                        </td>
                                                        <td class="right">$5,761,00</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="left">
                                                            <strong class="text-dark">VAT (10%)</strong>
                                                        </td>
                                                        <td class="right">$2,304,00</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="left">
                                                            <strong class="text-dark">Total</strong>
                                                        </td>
                                                        <td class="right">
                                                            <strong class="text-dark">$20,744,00</strong>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div> -->

                                    <?php } 

                                    ?>

                                    
                                    


                                    <?php }


      
      
      
      
      
      
      
?>


                                </div>
                                <div class="card-footer bg-white">
                                    <p class="mb-0">2983 Glenview Drive Corpus Christi, TX 78476</p>
                                    <button onclick="window.print()">Print this page</button>
                                </div>
                            </div>
                        </div>
                    </div>
 
 
 
</body>

<!-- 
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->



</html>
