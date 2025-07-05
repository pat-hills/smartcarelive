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



$staff_id = $_SESSION['uid']; 
$lab_code =  $_GET['lab_code'];
$patient_id = $_GET['patient_id'];


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


$patient_details = get_patient_data_details($patient_id);
$age = get_age_pdf($patient_details['dob']);
$fullname = $patient_details['surname']." ".$patient_details['other_names'];
$gender = $patient_details['sex'];

$request_test = patient_investigation_name_by_code($lab_code,$patient_id);


$date_sent_ = $request_test['requested_date'];
$lab_no = $request_test['lab_no'];

if($lab_no == null){
  $lab_no = $lab_code;
}
    
   
$date_convert = date('jS M, Y', strtotime("$date_sent_")).", ".date('l', strtotime("$date_sent_"));

$staff_id = get_staff_info($request_test['doctor_id']);

$requested_by = "Dr, ". $staff_id['firstName']." ".$staff_id['otherNames'];


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
  <link href="../../../asset/css/bootstrap.min.css" rel="stylesheet" />	  
	<link rel="stylesheet" href="../../../assets/fonts/font-awesome-4/css/font-awesome.min.css">
<!--   
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
<style>

.table tbody tr:hover td,
.table tbody tr:hover th {
  background-color: transparent;
}


.table-striped tbody tr:nth-child(odd):hover td {
   background-color: #F9F9F9;
}

.table td, .table th {
  padding: 0.75mm;
    vertical-align: top;
    font-size: large; 
    
    font-weight: 500;
}

.table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #dee2e6;
    font-size: x-large;
}

 
img {
    vertical-align: middle;
    border-style: none;
    width: auto;
    height: 100px;
}

.h4, h4 {
    font-size: 1.5rem;
    font-weight: bold;
}
 

</style>

</head>

<body class="">

<?php 






?>

 
<div class="row">
                        <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <div class="card-header p-4">
                                     <a class="pt-2 d-inline-block" href="#"><img src="<?php echo $schoolLogo ?>" /></a>
                                   
                                    <div class="float-right"> <h2 class="mb-0"><?php echo $hospital_name; ?></h2>
                                    <div class="float-right"> <h4 class="mb-0"><?php echo $postal_address; ?></h4>
                                    <h4 class="mb-0"> <?php echo $join_telephone ?></h4></div>

                                    
                                </div>

</br>

<?php 
                                
                                $className ='<div style="width:auto; background-color:grey;margin-top: 40px">'.'<b>'. '<strong style="color:#fff; font-size:20px;text-align:center;margin-left:500px;">'. htmlentities("Patient Lab Report") . '</strong>'.'</b>'.'</div>';
                            
                                echo $className
                                ?>
                                <?php 
                                
                                $divSaparate = '<div style="width:auto; background-color:#cff1ff; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;margin-top: 30px">'.'</div>';
                                echo $divSaparate;
                                
                                ?>
                                <br>
                                <div class="card-body">
                                    <div class="row mb-4">
                                        <div class="col-sm-6">
                                            <!-- <h5 class="mb-3">Patient Information:</h5>                                             -->
                                            <h6 style="font-weight:bolder;margin:5px; border-bottom:1.5px solid #ddd;padding-bottom:3px;font-size:large" class="text-dark mb-1">Name: <?php echo $fullname; ?></h6>
                                         
                                            <div style="font-weight:bolder;margin:5px; border-bottom:1.5px solid #ddd;padding-bottom:3px;font-size:large">Patient ID: <?php echo $patient_id; ?></div>
                                            <div style="font-weight:bolder;margin:5px; border-bottom:1.5px solid #ddd;padding-bottom:3px;font-size:large">Gender,Age: <?php echo $gender.", ".$age." year(s)"; ?></div>
                                            <div style="font-weight:bolder;margin:5px; border-bottom:1.5px solid #ddd;padding-bottom:3px;font-size:large">Request test(s): <?php echo $request_test['request_test_name']; ?></div>
                                            <div style="font-weight:bolder;margin:5px; border-bottom:1.5px solid #ddd;padding-bottom:3px;font-size:large">Request date: <?php echo $date_convert ?></div>
                                            <div style="font-weight:bolder;margin:5px; border-bottom:1.5px solid #ddd;padding-bottom:3px;font-size:large">Lab No: <?php echo $lab_no ?></div>
                                        </div>

                                        <!-- <div class="col-sm-6">
                                            <h5 class="mb-3">Medical Lab Information:</h5>
                                            <h6 class="text-dark mb-1">Anthony K. Friel</h6>                                            
                                            <div>478 Collins Avenue</div>
                                            <div>Canal Winchester, OH 43110</div>
                                            <div>Email: info@anthonyk.com</div>
                                            <div>Phone: +614-837-8483</div>
                                        </div> -->
                                    </div>


                                    <?php foreach ($get_lab_requests_to_view as $lab_test) { ?>    
                                   

                                      <?php if (investigation_name($lab_test) == "Urine RE") { ?>

                                    <div class="table-responsive-sm">
                                        <table class="table table-striped">


                                        <div class="header">							
                                <h4><?php echo investigation_name($lab_test)." "; 
                               $get_urine_re = urine_re($patient_id,$lab_code);

                                
                                ?></h4>
                                </div>
                                            <thead>
                                             
                                                <tr>
                                                    <th class="center">Test</th>
                                                   
                                                    <th>Results</th>
                                                    <!-- <th class="right">Reference</th>  -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                   
                                                    <td class="left strong">Urine Appearance</td>
                                                    <td class="left"><?php echo $get_urine_re['appearance'] ?></td>
                                                    <!-- <td class="right">-</td>  -->
                                                </tr>

                                                <tr>
                                                   
                                                   <td class="left strong">Colour</td>
                                                   <td class="left"><?php echo $get_urine_re['colour'] ?></td>
                                                   <!-- <td class="right">-</td>  -->
                                               </tr>


                                               <tr>
                                                   
                                                   <td class="left strong">Specific gravity</td>
                                                   <td class="left"><?php echo $get_urine_re['specific_gravity'] ?></td>
                                                   <!-- <td class="right">-</td>  -->
                                               </tr>


                                               <tr>
                                                   
                                                   <td class="left strong">pH</td>
                                                   <td class="left"><?php echo $get_urine_re['ph'] ?></td>
                                                   <!-- <td class="right">-</td>  -->
                                               </tr>

                                               <tr>
                                                   
                                                   <td class="left strong">Protein</td>
                                                   <td class="left"><?php echo $get_urine_re['protein'] ?></td>
                                                   <!-- <td class="right">-</td>  -->
                                               </tr>

                                               <tr>
                                                   
                                                   <td class="left strong">Glucose</td>
                                                   <td class="left"><?php echo $get_urine_re['glucose'] ?></td>
                                                   <!-- <td class="right">-</td>  -->
                                               </tr>
                                                 
                                                 
                                               <tr>
                                                   
                                                   <td class="left strong">Ketones</td>
                                                   <td class="left"><?php echo $get_urine_re['ketones'] ?></td>
                                                   <!-- <td class="right">-</td>  -->
                                               </tr>


                                               <tr>
                                                   
                                                   <td class="left strong">Blood</td>
                                                   <td class="left"><?php echo $get_urine_re['blood'] ?></td>
                                                   <!-- <td class="right">-</td>  -->
                                               </tr>

                                               <tr>
                                                   
                                                   <td class="left strong">Nitrite</td>
                                                   <td class="left"><?php echo $get_urine_re['nitrite'] ?></td>
                                                   <!-- <td class="right">-</td>  -->
                                               </tr>

                                               <tr>
                                                   
                                                   <td class="left strong">Bilirubin</td>
                                                   <td class="left"><?php echo $get_urine_re['bilirubin'] ?></td>
                                                   <!-- <td class="right">-</td>  -->
                                               </tr>

                                               <tr>
                                                   
                                                   <td class="left strong">Urobilinogen</td>
                                                   <td class="left"><?php echo $get_urine_re['urobilinogen'] ?></td>
                                                   <!-- <td class="right">-</td>  -->
                                               </tr>

                                               <tr>
                                                   
                                                   <td class="left strong">Leukocytes</td>
                                                   <td class="left"><?php echo $get_urine_re['leukocytes'] ?></td>
                                                   <!-- <td class="right">-</td>  -->
                                               </tr>

                                               <tr>
                                                   
                                                   <td class=""></td> 
                                                   
                                               </tr>


                                               
                                               <tr>
                                                   
                                                   <td class=""><b>Microscopy</b></td> 

                                                   <td class=""><b></b></td> 

                                                   <td class=""><b>Unit</b></td> 
                                                   
                                               </tr>


                                               
                                               <tr>
                                                   
                                                   <td class=""></td> 
                                                   
                                               </tr>


                                              


                                               <tr>
                                                   
                                                   <td class="left strong">Epithelial Cell</td>
                                                   <td class="left"><?php echo $get_urine_re['epithelial_cell'] ?></td>
                                                   <td class="right">HP/F</td> 
                                               </tr>

                                               
                                               <tr>
                                                   
                                                   <td class="left strong">Pus_cell</td>
                                                   <td class="left"><?php echo $get_urine_re['pus_cell'] ?></td>
                                                   <td class="right">HP/F</td> 
                                               </tr>


                                               <tr>
                                                   
                                                   <td class="left strong">Rbcs</td>
                                                   <td class="left"><?php echo $get_urine_re['rbcs'] ?></td>
                                                   <td class="right">HP/F</td> 
                                               </tr>


                                               <tr>
                                                   <td class="left strong">Wbc cast</td>
                                                   <td class="left"><?php echo $get_urine_re['wbc_cast'] ?></td>
                                                   <!-- <td class="right">-</td>  -->
                                               </tr>

                                               <tr>
                                                   <td class="left strong">Crystals</td>
                                                   <td class="left"><?php echo $get_urine_re['crystals'] ?></td>
                                                   <!-- <td class="right">-</td>  -->
                                               </tr>


                                               <tr>
                                                   <td class="left strong">Ova</td>
                                                   <td class="left"><?php echo $get_urine_re['ova'] ?></td>
                                                   <!-- <td class="right">-</td>  -->
                                               </tr>

                                               <tr>
                                                   <td class="left strong">T vaginals</td>
                                                   <td class="left"><?php echo $get_urine_re['t_vaginals'] ?></td>
                                                   <!-- <td class="right">-</td>  -->
                                               </tr>

                                               <tr>
                                                   <td class="left strong">Bacteria</td>
                                                   <td class="left"><?php echo $get_urine_re['bacteria'] ?></td>
                                                   <!-- <td class="right">-</td>  -->
                                               </tr>

                                               <tr>
                                                   <td class="left strong">Yeast like cells</td>
                                                   <td class="left"><?php echo $get_urine_re['yeast_like_cells'] ?></td>
                                                   <!-- <td class="right">-</td>  -->
                                               </tr>


                                               <tr>
                                                   <td class="left strong">S haematobium</td>
                                                   <td class="left"><?php echo $get_urine_re['s_haemoglobin'] ?></td>
                                                   <!-- <td class="right">-</td>  -->
                                               </tr>

                                               <tr>
                                                   <td class="left strong">Spermatozoa</td>
                                                   <td class="left"><?php echo $get_urine_re['spermatozoa'] ?></td>
                                                   <!-- <td class="right">-</td>  -->
                                               </tr>

                                               <tr>
                                                 <td>

                                               
                                                   
</td>
                                               </tr>

                                               <?php if (($get_urine_re['others'] != null) && ($get_urine_re['others_value'] != null)) { ?>
                                               <tr>
                                                   
                                                   <td class=""><b>Others</b></td> 

                                                   <td class=""><b></b></td> 

                                                   
                                                   
                                               </tr>


                                               
                                               <tr>
                                                   
                                                   <td class=""></td> 
                                                   
                                               </tr>


                                               <tr>
                                                   <td class="left strong"><?php echo $get_urine_re['others'] ?></td>
                                                   <td class="left"><?php echo $get_urine_re['others_value'] ?></td>
                                                   
                                               </tr>

                                               <?php } 

?>
                                            
                                            

                                               <tr>
                                                 <td>

                                               <i>Comments</i>
                                                   
</td>
                                               </tr>
</br>
                                               
                                               <tr>
                                               <td>
                                               <?php echo $get_urine_re['comments'] ?>
                                               
                                               </td>  
                                             
                                              
                                              </tr> 


                                                 
                                                
                                                
                                            </tbody>
                                        </table>
                                    </div>

                                    <?php 
                                
                               
                                $divSaparateLine = '<div style="width:auto; background-color:#cff1ff; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
                                                           echo $divSaparateLine
                                                           ?>

                                    <?php }

else if (investigation_name($lab_test) == "LFT") {
    ?>


<div class="table-responsive-sm">
                                        <table class="table table-striped">


                                        <div class="header">							
                                <h4><?php echo investigation_name($lab_test)." "; 

                               $DIRECT_LFT_STATUS;
                               $get_lft_results = get_lft_results($patient_id,$lab_code);

                               $S_BILIRUBIN_Total = $get_lft_results['S_BILIRUBIN_Total'];


                               if(IS_LFT_DIRECT == true){
                                 
                              
                                 $DIRECT_LFT_STATUS = $get_lft_results['S_BILIRUBIN_DIRECT'];
                               }else{
                           
                                 $DIRECT_LFT_STATUS = $get_lft_results['S_BILIRUBIN_conjugated'];
                               }
                           
                              // $S_BILIRUBIN_conjugated = $get_lft_results['S_BILIRUBIN_conjugated'];
                           
                               $S_ALKALINE_PHOSPHATASE = $get_lft_results['S_ALKALINE_PHOSPHATASE'];
                               $S_g_GLUTAMYL_TRANSFERASE = $get_lft_results['S_g_GLUTAMYL_TRANSFERASE'];
                               $S_ALT_GPT = $get_lft_results['S_ALT_GPT'];
                               $S_AST_GOT = $get_lft_results['S_AST_GOT'];
                               $S_TOTAL_PROTEIN = $get_lft_results['S_TOTAL_PROTEIN'];
                               $S_ALBUMIN = $get_lft_results['S_ALBUMIN'];
                           
                               $S_BILIRUBIN_Total_RESULTS;
                               $S_BILIRUBIN_conjugated_RESULTS;
                               $S_ALKALINE_PHOSPHATASE_RESULTS;
                               $S_g_GLUTAMYL_TRANSFERASE_RESULTS;
                               $S_ALT_GPT_RESULTS;
                               $S_AST_GOT_RESULTS;
                               $S_TOTAL_PROTEIN_RESULTS;
                               $S_ALBUMIN_RESULTS;
                           
                               if($S_BILIRUBIN_Total >= 2 && $S_BILIRUBIN_Total <= 21){
                                 $S_BILIRUBIN_Total_RESULTS = "";
                               }elseif($S_BILIRUBIN_Total < 2){
                                 $S_BILIRUBIN_Total_RESULTS = "L";
                               }else {
                                 $S_BILIRUBIN_Total_RESULTS = "<b>H</b>";
                               }
                           
                           
                               if($DIRECT_LFT_STATUS <=10.2){
                                 $S_BILIRUBIN_conjugated_RESULTS = "";
                               }else{
                                 $S_BILIRUBIN_conjugated_RESULTS = "<b>H</b>";
                               }
                           
                               if($S_ALKALINE_PHOSPHATASE >= 80 && $S_ALKALINE_PHOSPHATASE <= 306){
                                 $S_ALKALINE_PHOSPHATASE_RESULTS = "";
                               }elseif($S_ALKALINE_PHOSPHATASE < 80){
                                 $S_ALKALINE_PHOSPHATASE_RESULTS = "L";
                               }else {
                                 $S_ALKALINE_PHOSPHATASE_RESULTS = "<b>H</b>";
                               }
                           
                               if($S_g_GLUTAMYL_TRANSFERASE >= 11 && $S_g_GLUTAMYL_TRANSFERASE <= 61){
                                 $S_g_GLUTAMYL_TRANSFERASE_RESULTS = "";
                               }elseif($S_g_GLUTAMYL_TRANSFERASE < 11){
                                 $S_g_GLUTAMYL_TRANSFERASE_RESULTS ="L";
                               }else {
                                 $S_g_GLUTAMYL_TRANSFERASE_RESULTS = "H";
                               }
                           
                           
                               if($S_ALT_GPT >= 0 && $S_ALT_GPT <= 42){
                                 $S_ALT_GPT_RESULTS = "";
                               }elseif($S_ALT_GPT < 42){
                                 $S_ALT_GPT_RESULTS = "L";
                               }else {
                                 $S_ALT_GPT_RESULTS = "<b>H</b>";
                               }
                           
                           
                               if($S_AST_GOT >= 0 && $S_AST_GOT <= 37){
                                 $S_AST_GOT_RESULTS = "";
                               }elseif($S_AST_GOT < 0){
                                 $S_AST_GOT_RESULTS = "L";
                               }else {
                                 $S_AST_GOT_RESULTS = "<b>H</b>";
                               }
                           
                               if($S_TOTAL_PROTEIN >= 60 && $S_TOTAL_PROTEIN <= 80){
                                 $S_TOTAL_PROTEIN_RESULTS = "";
                               }elseif($S_TOTAL_PROTEIN < 60){
                                 $S_TOTAL_PROTEIN_RESULTS = "L";
                               }else {
                                 $S_TOTAL_PROTEIN_RESULTS = "H";
                               }
                           
                           
                               if($S_ALBUMIN >= 37 && $S_ALBUMIN <= 53){
                                 $S_ALBUMIN_RESULTS = "";
                               }elseif($S_ALBUMIN < 37){
                                 $S_ALBUMIN_RESULTS ="L";
                               }else {
                                 $S_ALBUMIN_RESULTS = "H";
                               }
                           
                           
                           

                                
                                ?></h4>
                                </div>
                                            <thead>
                                             
                                                <tr>
                                                    <th class="center">Test</th>
                                                   
                                                    <th>Results</th>
                                                    <th class="right">Unit</th> 
                                                    <th class="right">Evaluation</th> 
                                                    <th class="right">Reference</th> 
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                   
                                                    <td class="left strong">S-BILIRUBIN (Total)</td>
                                                    <td class="left"><?php echo $S_BILIRUBIN_Total ?></td>
                                                    <td class="right"> umol/L </td> 
                                                    <td class="right"> <?php echo $S_BILIRUBIN_Total_RESULTS ?> </td> 
                                                    <td class="right"> 2.0 - 21.0 </td>
                                                </tr>

                                                <tr>
                                                   
                                                    <td class="left strong">S-BILIRUBIN DIRECT</td>
                                                    <td class="left"><?php echo $DIRECT_LFT_STATUS ?></td>
                                                    <td class="right"> umol/L </td> 
                                                    <td class="right"> <?php echo $S_BILIRUBIN_conjugated_RESULTS ?> </td> 
                                                    <td class="right">   <  10.2 </td>
                                                  
                                               </tr>


                                               <tr>
                                                    <td class="left strong">S-ALKALINE PHOSPHATASE</td>
                                                    <td class="left"><?php echo $S_ALKALINE_PHOSPHATASE ?></td>
                                                    <td class="right"> IU/L </td> 
                                                    <td class="right"> <?php echo $S_ALKALINE_PHOSPHATASE_RESULTS ?> </td> 
                                                    <td class="right">   80 - 306 </td>
                                                   
                                               </tr>


                                               <tr>
                                                
                                               
                                                    <td class="left strong">S-ALT (GPT)</td>
                                                    <td class="left"><?php echo $S_ALT_GPT ?></td>
                                                    <td class="right"> IU/L </td> 
                                                    <td class="right"> <?php echo $S_ALT_GPT_RESULTS ?> </td> 
                                                    <td class="right">   < 42    </td>
                                               
                                               </tr>

                                               <tr>
                                                    <td class="left strong">S-AST (GOT)</td>
                                                    <td class="left"><?php echo $S_AST_GOT ?></td>
                                                    <td class="right"> IU/L </td> 
                                                    <td class="right"> <?php echo $S_AST_GOT_RESULTS ?> </td> 
                                                    <td class="right">   < 37    </td> 
                                                   
                                               </tr>

                                               <tr>
                                               <td class="left strong">S-TOTAL PROTEIN</td>
                                                    <td class="left"><?php echo $S_TOTAL_PROTEIN ?></td>
                                                    <td class="right"> g/L </td> 
                                                    <td class="right"> <?php echo $S_TOTAL_PROTEIN_RESULTS ?> </td> 
                                                    <td class="right">   60 - 80    </td> 
                                                   
                                               </tr>
                                                 
                                                 
                                               <tr>
                                               <td class="left strong">S-ALBUMIN</td>
                                                    <td class="left"><?php echo $S_ALBUMIN ?></td>
                                                    <td class="right"> g/L </td> 
                                                    <td class="right"> <?php echo $S_ALBUMIN_RESULTS ?> </td> 
                                                    <td class="right">   37.0 - 53.0    </td> 
                                               </tr>
                                                
                                                
                                            </tbody>
                                        </table>
                                    </div>

 
                                    <?php 
                                
                               
                                $divSaparateLine = '<div style="width:auto; background-color:#cff1ff; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
                                                           echo $divSaparateLine
                                                           ?>
                             <?php }

else if (investigation_name($lab_test) == "FBC") {
    ?>


<div class="table-responsive-sm">
                                        <table class="table table-striped">


                                        <div class="header">							
                                <h4><?php echo investigation_name($lab_test)." "; 

$get_FBC_results = get_FBC_results($patient_id,$lab_code);
  
$WBC = $get_FBC_results['WBC'];
$Lymphocytes_hash = $get_FBC_results['Lymphocytes_hash'];
$mid_hash = $get_FBC_results['mid_hash'];
$gran_hash = $get_FBC_results['gran_hash'];
$Lymphocytes_percent = $get_FBC_results['Lymphocytes_percent'];
$mid_percent = $get_FBC_results['mid_percent'];
$gran_percent = $get_FBC_results['gran_percent'];
$RBC = $get_FBC_results['RBC'];
$HGB = $get_FBC_results['HGB'];
$HCT = $get_FBC_results['HCT'];
$MCV = $get_FBC_results['MCV'];
$MCH = $get_FBC_results['MCH'];
$MCHC = $get_FBC_results['MCHC'];
$RDW_CV = $get_FBC_results['RDW_CV'];
$RDW_SD = $get_FBC_results['RDW_SD'];
$PLT = $get_FBC_results['PLT'];
$MPV = $get_FBC_results['MPV'];
$PDW = $get_FBC_results['PDW'];
$PCT = $get_FBC_results['PCT'];
$neutrophils = $get_FBC_results['neutrophils'];
$monocytes = $get_FBC_results['monocytes'];
$eosinophils = $get_FBC_results['eosinophils'];
$basophils = $get_FBC_results['basophils'];
$retics = $get_FBC_results['retics'];


$WBC_RESULTS; 
$Lymphocytes_hash_RESULTS;
$mid_hash_RESULTS;
$gran_hash_RESULTS;
$Lymphocytes_percent_RESULTS;
$mid_percent_RESULTS;
$gran_percent_RESULTS;
$RBC_RESULTS;
$HGB_RESULTS;
$HCT_RESULTS;
$MCV_RESULTS;
$MCHC_RESULTS;
$RDW_CV_RESULTS;
$RDW_SD_RESULTS;
$PLT_RESULTS;
$MPV_RESULTS;
$PDW_RESULTS;
$PCT_RESULTS;




  
      // if($WBC >= 4 && $WBC <= 12){
      //   $WBC_RESULTS = "";
      // }elseif($WBC < 4){
      //   $WBC_RESULTS = "L";
      // }else {
      //   $WBC_RESULTS = "<b>H</b>";
      // }

//       WBC Adult Male / Adult Female
//              - 4.0 - 10.0
// Child  - 4.0 - 12 .0

if($age >= 13 && ($gender == "Female" || $gender == "Male")){
    if($WBC >= 4.0 && $WBC <=10.0){
      $WBC_RESULTS = "";
    }elseif($WBC < 4.0){
      $WBC_RESULTS = "L";
    }else {
      $WBC_RESULTS = "<b>H</b>";
    }
    $ref_range_WBC = "4.0 - 10.0 x 10^9/µL";
  }else{
  
  
   
    if($WBC >= 4 && $WBC <= 12){
      $WBC_RESULTS = "";
    }elseif($WBC < 4){
      $WBC_RESULTS = "L";
    }else {
      $WBC_RESULTS = "<b>H</b>";
    }
  
  
    $ref_range_WBC = "4.0 - 12.0 x 10^9/µL";
  
  
  }
  
  
  
        // Lymph# Adult Male / Adult Female
        //         0.8 - 4.0
        //          Child
        //          0.8 - 7.0
  
  
        if($age >= 13 && ($gender == "Female" || $gender == "Male")){
          if($Lymphocytes_hash >= 0.80 && $Lymphocytes_hash <=4.0){
            $Lymphocytes_hash_RESULTS = "";
          }elseif($Lymphocytes_hash < 0.80){
            $Lymphocytes_hash_RESULTS = "L";
          }else {
            $Lymphocytes_hash_RESULTS = "<b>H</b>";
          }
          $ref_range_Lymphocytes_hash = "0.8 - 4.0 x 10^9/µL";
        }else{
  
  
          if($Lymphocytes_hash >= 0.8 && $Lymphocytes_hash <= 7){
            $Lymphocytes_hash_RESULTS = "";
          }elseif($Lymphocytes_hash < 0.8){
            $Lymphocytes_hash_RESULTS = "L";
          }else {
            $Lymphocytes_hash_RESULTS = "<b>H</b>";
          }
          $ref_range_Lymphocytes_hash = "0.8 - 7.0 x 10^9/µL";
        }
      
  
  
  
       
  
  
  
        if($mid_hash >= 0.10 && $mid_hash <= 1.50){
          $mid_hash_RESULTS = "";
        }elseif($mid_hash < 0.10){
          $mid_hash_RESULTS = "L";
        }else {
          $mid_hash_RESULTS = "<b>H</b>";
        }
  
        // if($gran_hash >= 2 && $gran_hash <= 8){
        //   $gran_hash_RESULTS = "";
        // }elseif($gran_hash < 2){
        //   $gran_hash_RESULTS = "L";
        // }else {
        //   $gran_hash_RESULTS = "<b>H</b>";
        // }
  
        // Adult Male / Adult Female
        // Gran#    2.0 - 7.0
        //               Child
        //               2.0 - 8.0
  
        if($age >= 13 && ($gender == "Female" || $gender == "Male")){
          if($gran_hash >= 2.0 && $gran_hash <=7.0){
            $gran_hash_RESULTS = "";
          }elseif($gran_hash < 2.0){
            $gran_hash_RESULTS = "L";
          }else {
            $gran_hash_RESULTS = "<b>H</b>";
          }
          $ref_range_gran_hash = "2.0 - 7.0 x 10^9/µL";
        }else{
  
          if($gran_hash >= 2 && $gran_hash <= 8){
            $gran_hash_RESULTS = "";
          }elseif($gran_hash < 2){
            $gran_hash_RESULTS = "L";
          }else {
            $gran_hash_RESULTS = "<b>H</b>";
          }
          $ref_range_gran_hash = "2.0 - 8.0 x 10^9/µL";
        }
  
  
        // if($Lymphocytes_percent >= 0.20 && $Lymphocytes_percent <= 0.60){
        //   $Lymphocytes_percent_RESULTS = "";
        // }elseif($Lymphocytes_percent < 0.20){
        //   $Lymphocytes_percent_RESULTS = "L";
        // }else {
        //   $Lymphocytes_percent_RESULTS = "<b>H</b>";
        // }
        // Lymph% - Child
        //          -0.200 - 0.600
        //           Adult Male
        //         - 0.200 - 0.400
        //          Adult Female
        //         -0.200 - 0.400
  
  
        if($age >= 13 && ($gender == "Female" || $gender == "Male")){
          if($Lymphocytes_percent >= 0.20 && $Lymphocytes_percent <=0.40){
            $Lymphocytes_percent_RESULTS = "";
          }elseif($Lymphocytes_percent < 0.20){
            $Lymphocytes_percent_RESULTS = "L";
          }else {
            $Lymphocytes_percent_RESULTS = "<b>H</b>";
          }
          $ref_range_Lymphocytes_percent = "0.200 - 0.400";
        }else{
  
          if($Lymphocytes_percent >= 0.20 && $Lymphocytes_percent <= 0.60){
            $Lymphocytes_percent_RESULTS = "";
          }elseif($Lymphocytes_percent < 0.20){
            $Lymphocytes_percent_RESULTS = "L";
          }else {
            $Lymphocytes_percent_RESULTS = "<b>H</b>";
          }
          $ref_range_Lymphocytes_percent = "0.200 - 0.600";
        }
      
  
  
        //	              0.030 – 0.150 
  
  
        if($mid_percent >= 0.030 && $mid_percent <= 0.150){
          $mid_percent_RESULTS = "";
        }elseif($mid_percent < 0.030){
          $mid_percent_RESULTS = "L";
        }else {
          $mid_percent_RESULTS = "<b>H</b>";
        }
  
  
        //3.50 – 5.20 
        if($gran_percent >= 0.500 && $gran_percent <= 0.700){
          $gran_percent_RESULTS = "";
        }elseif($gran_percent < 0.500){
          $gran_percent_RESULTS = "L";
        }else {
          $gran_percent_RESULTS = "<b>H</b>";
        }
  
  
        // if($RBC >= 3.50 && $RBC <= 5.20){
        //   $RBC_RESULTS = "";
        // }elseif($RBC < 3.50){
        //   $RBC_RESULTS = "L";
        // }else {
        //   $RBC_RESULTS = "<b>H</b>";
        // }
  
        // RBC  - Adult Male
        //   -  4.00 - 5.50
        //   - Adult Female
        //   - 3.50 - 5.00
        //   - Child
        //  -  3.50 - 5.20
  
  
        if($age >= 13 && $gender =="Male"){
  
          if($RBC >= 4.0 && $RBC <= 5.50){
            $RBC_RESULTS = "";
          }elseif($RBC < 4.0){
            $RBC_RESULTS = "L";
          }else {
            $RBC_RESULTS = "<b>H</b>";
          }
          $ref_range_RBC = "4.0 – 5.50 x 10^12/µL";
        }elseif ($age >= 13 && $gender =="Female"){
    
          if($RBC >= 3.50 && $RBC <= 5.00){
            $RBC_RESULTS = "";
          }elseif($RBC < 3.50){
            $RBC_RESULTS = "L";
          }else {
            $RBC_RESULTS = "<b>H</b>";
          }
          $ref_range_RBC = "3.50 – 5.0 x 10^12/µL";
        }else{
  
    
          if($RBC >= 3.50 && $RBC <= 5.20){
            $RBC_RESULTS = "";
          }elseif($RBC < 3.50){
            $RBC_RESULTS = "L";
          }else {
            $RBC_RESULTS = "<b>H</b>";
          }
  
          $ref_range_RBC = "3.50 – 5.20 x 10^12/µL";
        }
  
  
        // HGB - Adult Male
        //    - 12.0 - 16.0
        //    -  Child
        //    -  12.0 - 16.0
        //     - Adult Female
        //     - 11.0 - 15.0
  
  
  
        
        // if($HGB >= 12.0 && $HGB <= 16.0){
        //   $HGB_RESULTS = "";
        // }elseif($HGB < 12.0){
        //   $HGB_RESULTS = "L";
        // }else {
        //   $HGB_RESULTS = "H";
        // }
  
        if($age >= 13 && $gender =="Male"){
  
          if($HGB >= 12.0 && $HGB <= 16.0){
            $HGB_RESULTS = "";
          }elseif($HGB < 12.0){
            $HGB_RESULTS = "L";
          }else {
            $HGB_RESULTS = "<b>H</b>";
          }
          $ref_range_HGB = "12.0 - 16.0 g/dL";
        }elseif ($age >= 13 && $gender =="Female"){
    
          if($HGB >= 11.0 && $HGB <= 15.0){
            $HGB_RESULTS = "";
          }elseif($HGB < 11.0){
            $HGB_RESULTS = "L";
          }else {
            $HGB_RESULTS = "<b>H</b>";
          }
          $ref_range_HGB = "11.0 - 15.0 g/dL";
        }else{
  
    
          if($HGB >= 12.0 && $HGB <= 16.0){
            $HGB_RESULTS = "";
          }elseif($HGB < 12.0){
            $HGB_RESULTS = "L";
          }else {
            $HGB_RESULTS = "H";
          }
          $ref_range_HGB = "12.0 - 16.0 g/dL";
        }
  
  
  
        //if($age >= 13 && ($gender == "Female" || $gender == "Male")){
          // $ref_range = "310 - 370 g/L";
      //VALIDATING HCT ADULT MALE
  
      // HCT - Adult Male
      //     - 0.400 -0.540
      //    - Adult Female
      //    - 0.370 - 0.470
      //   -Child
      //   - 0.350 - 0.490
  
  
      if($age >= 13 && $gender =="Male"){
  
        if($HCT >= 0.40 && $HCT <= 0.54){
          $HCT_RESULTS = "";
        }elseif($HCT < 0.40){
          $HCT_RESULTS = "L";
        }else {
          $HCT_RESULTS = "<b>H</b>";
        }
        $ref_range_HCT = "0.400 - 0.540";
      }elseif ($age >= 13 && $gender =="Female"){
  
        if($HCT >= 0.37 && $HCT <= 0.47){
          $HCT_RESULTS = "";
        }elseif($HCT < 0.37){
          $HCT_RESULTS = "L";
        }else {
          $HCT_RESULTS = "<b>H</b>";
        }
        $ref_range_HCT = "0.370 - 0.470";
      }else{
  
        if($HCT >= 0.35 && $HCT <= 0.49){
          $HCT_RESULTS = "";
        }elseif($HCT < 0.35){
          $HCT_RESULTS = "L";
        }else {
          $HCT_RESULTS = "<b>H</b>";
        }
        $ref_range_HCT = "0.350 - 0.490";
      }
  
      
  
        if($MCV >= 80 && $MCV <= 100){
          $MCV_RESULTS = "";
        }elseif($MCV < 80){
          $MCV_RESULTS = "L";
        }else {
          $MCV_RESULTS = "<b>H</b>";
        }
  
        if($MCH >= 27.0 && $MCH <= 34.0){
          $MCH_RESULTS = "";
        }elseif($MCH < 27.0){
          $MCH_RESULTS = "L";
        }else {
          $MCH_RESULTS = "<b>H</b>";
        }
  
        //validation mchc for a adults males and females and child
        if($age >= 13 && ($gender == "Female" || $gender == "Male")){
          if($MCHC >= 320 && $MCHC <=360){
            $MCHC_RESULTS = "";
          }elseif($MCHC < 320){
            $MCHC_RESULTS = "L";
          }else {
            $MCHC_RESULTS = "<b>H</b>";
          }
          $ref_range = "320 - 360 g/L";
        }else{
  
          if($MCHC >= 310 && $MCHC <= 370){
            $MCHC_RESULTS = "";
          }elseif($MCHC < 310){
            $MCHC_RESULTS = "L";
          }else {
            $MCHC_RESULTS = "<b>H</b>";
          }
  
          $ref_range = "310 - 370 g/L";
  
        }
      
  
        if($RDW_CV >= 0.11 && $RDW_CV <= 0.16){
          $RDW_CV_RESULTS = "";
        }elseif($RDW_CV < 0.11){
          $RDW_CV_RESULTS = "L";
        }else {
          $RDW_CV_RESULTS = "<b>H</b>";
        }
  
  
        if($RDW_SD >= 35 && $RDW_SD <= 56){
          $RDW_SD_RESULTS = "";
        }elseif($RDW_SD < 35){
          $RDW_SD_RESULTS = "L";
        }else {
          $RDW_SD_RESULTS = "<b>H</b>";
        }
  
  
        if($PLT >= 100 && $PLT <= 300){
          $PLT_RESULTS = "";
        }elseif($PLT < 100){
          $PLT_RESULTS = "L";
        }else {
          $PLT_RESULTS = "<b>H</b>";
        }
  
        if($MPV >= 6.5 && $MPV <= 12){
          $MPV_RESULTS = "";
        }elseif($PLT < 6.5){
          $MPV_RESULTS = "L";
        }else {
          $MPV_RESULTS = "<b>H</b>";
        }
  
        if($PDW >= 15 && $PDW <= 17){
          $PDW_RESULTS = "";
        }elseif($PDW < 15){
          $PDW_RESULTS = "L";
        }else {
          $PDW_RESULTS = "<b>H</b>";
        }
  
        //1.08 – 2.82 mL/L
  
        if($PCT >= 1.08 && $PCT <= 2.82){
          $PCT_RESULTS = "";
        }elseif($PCT < 1.08){
          $PCT_RESULTS = "L";
        }else {
          $PCT_RESULTS = "<b>H</b>";
        }
    
    
     
    
    


                                
                                ?></h4>
                                </div>
                                            <thead>
                                             
                                                <tr>
                                                    <th class="center">Test</th>
                                                   
                                                    <th>Results</th>
                                                    <th class="right">Unit</th> 
                                                    <th class="right">Evaluation</th> 
                                                    <th class="right">Reference</th> 
                                                </tr>
                                            </thead>
                                            <tbody>

                                            
                                                <tr>
                                                   
                                                    <td class="left strong">WHITE BLOOD CELLS (WBC)</td>
                                                    <td class="left"><?php echo $WBC ?></td>
                                                    <td class="right"> µL </td> 
                                                    <td class="right"> <?php echo $WBC_RESULTS ?> </td> 
                                                    <td class="right"> <?php echo $ref_range_WBC ?> </td>
                                                </tr>

                                                <tr>
                                                   
                                                    <td class="left strong">Lymphocytes #</td>
                                                    <td class="left"><?php echo $Lymphocytes_hash ?></td>
                                                    <td class="right"> µL </td> 
                                                    <td class="right"> <?php echo $Lymphocytes_hash_RESULTS ?> </td> 
                                                    <td class="right"> <?php echo $ref_range_Lymphocytes_hash ?> </td>
                                                  
                                               </tr>


                                               <!-- <tr>
                                               <td class="left strong">Lymphocytes #</td>
                                                    <td class="left"><?php // echo $Lymphocytes_hash ?></td>
                                                    <td class="right"> µL </td> 
                                                    <td class="right"> <?php //echo $Lymphocytes_hash_RESULTS ?> </td> 
                                                    <td class="right"> <?php //echo $ref_range_Lymphocytes_hash ?> </td>
                                                   
                                               </tr>
 -->

                                               <tr>
                                                
                                               
                                                    <td class="left strong">Mid#</td>
                                                    <td class="left"><?php echo $mid_hash ?></td>
                                                    <td class="right"> µL </td> 
                                                    <td class="right"> <?php echo $mid_hash_RESULTS ?> </td> 
                                                    <td class="right">  0.1 – 1.5 </td>
                                               
                                               </tr>

                                               <tr>
                                               <td class="left strong">Gran#</td>
                                                    <td class="left"><?php echo $gran_hash ?></td>
                                                    <td class="right"> µL </td> 
                                                    <td class="right"> <?php echo $gran_hash_RESULTS ?> </td> 
                                                    <td class="right"> <?php echo $ref_range_gran_hash ?> </td>
                                                   
                                               </tr>

                                               <tr>
                                               <td class="left strong">%Lymphocytes</td>
                                                    <td class="left"><?php echo $Lymphocytes_percent ?></td>
                                                    <td class="right"> µL </td> 
                                                    <td class="right"> <?php echo $Lymphocytes_percent_RESULTS ?> </td> 
                                                    <td class="right"> <?php echo $ref_range_Lymphocytes_percent ?> </td>
                                               </tr>
                                                 
                                                 
                                               <tr>
                                                    <td class="left strong">%Mid</td>
                                                    <td class="left"><?php echo $mid_percent ?></td>
                                                    <td class="right"> % </td> 
                                                    <td class="right"> <?php echo $mid_percent_RESULTS ?> </td> 
                                                    <td class="right">  0.030 – 0.150%   </td> 
                                               </tr>



                                               <tr>
                                                    <td class="left strong">%Gran</td>
                                                    <td class="left"><?php echo $gran_percent ?></td>
                                                    <td class="right"> % </td> 
                                                    <td class="right"> <?php echo $gran_percent_RESULTS ?> </td> 
                                                    <td class="right">  0.500 – 0.700%  </td> 
                                               </tr>


                                               <tr>
                                                    <td class="left strong">RBC</td>
                                                    <td class="left"><?php echo $RBC ?></td>
                                                    <td class="right"> µL </td> 
                                                    <td class="right"> <?php echo $RBC_RESULTS ?> </td> 
                                                    <td class="right">  <?php echo $ref_range_RBC ?> </td> 
                                               </tr>


                                               <tr>
                                                    <td class="left strong">HGB</td>
                                                    <td class="left"><?php echo $HGB ?></td>
                                                    <td class="right"> g/dL </td> 
                                                    <td class="right"> <?php echo $HGB_RESULTS ?> </td> 
                                                    <td class="right">  <?php echo $ref_range_HGB ?> </td> 
                                               </tr>

                                               <tr>
                                                    <td class="left strong">HCT</td>
                                                    <td class="left"><?php echo $HCT ?></td>
                                                    <td class="right"> % </td> 
                                                    <td class="right"> <?php echo $HCT_RESULTS ?> </td> 
                                                    <td class="right">  <?php echo $ref_range_HCT ?> </td> 
                                               </tr>


                                               <tr>
                                                    <td class="left strong">MCV</td>
                                                    <td class="left"><?php echo $MCV ?></td>
                                                    <td class="right"> fL </td> 
                                                    <td class="right"> <?php echo $MCV_RESULTS ?> </td> 
                                                    <td class="right">  80 – 100 fL </td> 
                                               </tr>

                                               <tr>
                                                    <td class="left strong">MCH</td>
                                                    <td class="left"><?php echo $MCH ?></td>
                                                    <td class="right"> pg </td> 
                                                    <td class="right"> <?php echo $MCH_RESULTS ?> </td> 
                                                    <td class="right">  27.0 - 34.0 </td> 
                                               </tr>

                                               <tr>
                                                    <td class="left strong">MCHC</td>
                                                    <td class="left"><?php echo $MCHC ?></td>
                                                    <td class="right"> g/dL </td> 
                                                    <td class="right"> <?php echo $MCHC_RESULTS ?> </td> 
                                                    <td class="right">  <?php echo $ref_range ?> </td> 
                                               </tr>


                                               <tr>
                                                    <td class="left strong">RDW-CV</td>
                                                    <td class="left"><?php echo $RDW_CV ?></td>
                                                    <td class="right"> % </td> 
                                                    <td class="right"> <?php echo $RDW_CV_RESULTS ?> </td> 
                                                    <td class="right">   0.11 – 0.16% </td> 
                                               </tr>

                                               <tr>
                                                    <td class="left strong">RDW-SD</td>
                                                    <td class="left"><?php echo $RDW_SD ?></td>
                                                    <td class="right"> fL </td> 
                                                    <td class="right"> <?php echo $RDW_SD_RESULTS ?> </td> 
                                                    <td class="right">   35.0 – 56 .0fL </td> 
                                               </tr>

                                               <tr>
                                                    <td class="left strong">PLT</td>
                                                    <td class="left"><?php echo $PLT ?></td>
                                                    <td class="right"> µL </td> 
                                                    <td class="right"> <?php echo $PLT_RESULTS ?> </td> 
                                                    <td class="right">   100 – 300 x 10^3/µL </td> 
                                               </tr>

                                               <tr>
                                                    <td class="left strong">MPV</td>
                                                    <td class="left"><?php echo $MPV ?></td>
                                                    <td class="right"> fL </td> 
                                                    <td class="right"> <?php echo $MPV_RESULTS ?> </td> 
                                                    <td class="right">   6.5 – 12.0fL</td> 
                                               </tr>

                                               <tr>
                                                    <td class="left strong">PDW</td>
                                                    <td class="left"><?php echo $PDW ?></td>
                                                    <td class="right"> fL </td> 
                                                    <td class="right"> <?php echo $PDW_RESULTS ?> </td> 
                                                    <td class="right">  15.0 – 17.0fL </td> 
                                               </tr>


                                               <tr>
                                                    <td class="left strong">PCT</td>
                                                    <td class="left"><?php echo $PCT ?></td>
                                                    <td class="right"> mL/L </td> 
                                                    <td class="right"> <?php echo $PCT_RESULTS ?> </td> 
                                                    <td class="right">  1.08 – 2.82 mL/L </td> 
                                               </tr>
                                                
                                                
                                            </tbody>
                                        </table>
                                    </div>

 
                                    <?php 
                                
                               
                                $divSaparateLine = '<div style="width:auto; background-color:#cff1ff; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
                                                           echo $divSaparateLine
                                                           ?>
                             <?php }

                             else if (investigation_name($lab_test) == "LIPID PROFILE") {
                                ?>
                            
                            
                            <div class="table-responsive-sm">
                                                                    <table class="table table-striped">
                            
                            
                                                                    <div class="header">							
                                                            <h4><?php echo investigation_name($lab_test)." "; 
                            
                            $get_lipid_profile_results = get_lipid_profile_results($patient_id,$lab_code);
    
                            $TOTAL_CHOLESTEROL = $get_lipid_profile_results['TOTAL_CHOLESTEROL'];
                            $TRIGLYCERIDES = $get_lipid_profile_results['TRIGLYCERIDES'];
                            $HDL_CHOLESTEROL = $get_lipid_profile_results['HDL_CHOLESTEROL'];
                            $LDL_CHOLESTEROL = $get_lipid_profile_results['LDL_CHOLESTEROL'];
                            $coronary_risk = $get_lipid_profile_results['coronary_risk'];



                            
    
        $TOTAL_CHOLESTEROL_RESULTS; 
        $TRIGLYCERIDES_RESULTS;
        $HDL_CHOLESTEROL_RESULTS; 
        $LDL_CHOLESTEROL_RESULTS;
        $coronary_risk_RESULTS;

         
  
    
        if($TOTAL_CHOLESTEROL >= 2.64 && $TOTAL_CHOLESTEROL <= 5.20){
          $TOTAL_CHOLESTEROL_RESULTS = "";
        }elseif($TOTAL_CHOLESTEROL < 2.64){
          $TOTAL_CHOLESTEROL_RESULTS = "L";
        }else {
          $TOTAL_CHOLESTEROL_RESULTS = "<b>H</b>";
        }

        if($TRIGLYCERIDES >= 0.39 && $TRIGLYCERIDES <= 1.71){
          $TRIGLYCERIDES_RESULTS = "";
        }elseif($TRIGLYCERIDES < 0.39){
          $TRIGLYCERIDES_RESULTS = "L";
        }else {
          $TRIGLYCERIDES_RESULTS = "<b>H</b>";
        }


        if($HDL_CHOLESTEROL >= 1.03 && $HDL_CHOLESTEROL <= 2.52){
          $HDL_CHOLESTEROL_RESULTS = "";
        }elseif($HDL_CHOLESTEROL < 1.03){
          $HDL_CHOLESTEROL_RESULTS = "L";
        }else {
          $HDL_CHOLESTEROL_RESULTS = "<b>H</b>";
        }

        if($LDL_CHOLESTEROL >= 1.07 && $LDL_CHOLESTEROL <= 3.34){
          $LDL_CHOLESTEROL_RESULTS = "";
        }elseif($LDL_CHOLESTEROL < 1.03){
          $LDL_CHOLESTEROL_RESULTS = "L";
        }else {
          $LDL_CHOLESTEROL_RESULTS = "<b>H</b>";
        }


        if($coronary_risk >= 3.0 && $coronary_risk <= 5.0){
          $coronary_risk_RESULTS = "";
        }elseif($coronary_risk < 3){
          $coronary_risk_RESULTS = "L";
        }else {
          $coronary_risk_RESULTS = "<b>H</b>";
        }
                            
                            
                                                            
                                                            ?></h4>
                                                            </div>
                                                                        <thead>
                                                                         
                                                                            <tr>
                                                                                <th class="center">Test</th>
                                                                               
                                                                                <th>Results</th>
                                                                                <th class="right">Unit</th> 
                                                                                <th class="right">Evaluation</th> 
                                                                                <th class="right">Reference</th> 
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                               
                                                                                <td class="left strong">TOTAL-CHOLESTEROL</td>
                                                                                <td class="left"><?php echo $TOTAL_CHOLESTEROL ?></td>
                                                                                <td class="right"> mmol/l </td> 
                                                                                <td class="right"> <?php echo $TOTAL_CHOLESTEROL_RESULTS ?> </td> 
                                                                                <td class="right">  2.64 - 5.20 </td>
                                                                            </tr>
                            
                                                                            <tr>
                                                                               
                                                                            <td class="left strong">TRIGLYCERIDES</td>
                                                                                <td class="left"><?php echo $TRIGLYCERIDES ?></td>
                                                                                <td class="right"> mmol/l </td> 
                                                                                <td class="right"> <?php echo $TRIGLYCERIDES_RESULTS ?> </td> 
                                                                                <td class="right">  0.39 - 1.71 </td>
                                                                              
                                                                           </tr>
                            
                            
                                                                           <tr>
                                                                           <td class="left strong">HDL CHOLESTEROL</td>
                                                                                <td class="left"><?php echo $HDL_CHOLESTEROL ?></td>
                                                                                <td class="right"> mmol/l </td> 
                                                                                <td class="right"> <?php echo $HDL_CHOLESTEROL_RESULTS ?> </td> 
                                                                                <td class="right">  1.03 - 2.52 </td>
                                                                               
                                                                           </tr>
                            
                            
                                                                           <tr>
                                                                            
                                                                           
                                                                           <td class="left strong">LDL CHOLESTEROL</td>
                                                                                <td class="left"><?php echo $LDL_CHOLESTEROL ?></td>
                                                                                <td class="right"> mmol/l </td> 
                                                                                <td class="right"> <?php echo $LDL_CHOLESTEROL_RESULTS ?> </td> 
                                                                                <td class="right"> 1.07 - 3.34  </td>
                                                                           
                                                                           </tr>
                            
                                                                           <tr>
                                                                           <td class="left strong">CORONARY RISK</td>
                                                                                <td class="left"><?php echo $coronary_risk ?></td>
                                                                                <td class="right"> mmol/l </td> 
                                                                                <td class="right"> <?php echo $coronary_risk_RESULTS ?> </td> 
                                                                                <td class="right"> 3.0 - 5.0   </td>
                                                                               
                                                                           </tr>
                             
                              
                                                                            
                                                                            
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                            
                                                                <?php 
                                
                               
                                $divSaparateLine = '<div style="width:auto; background-color:#cff1ff; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
                                                           echo $divSaparateLine
                                                           ?>
                            
                                                         <?php }
                                                             else if (investigation_name($lab_test) == "ELECTROLYTES") {
                                                                ?>
                                                            
                                                            
                                                            <div class="table-responsive-sm">
                                                                                                    <table class="table table-striped">
                                                            
                                                            
                                                                                                    <div class="header">							
                                                                                            <h4><?php echo investigation_name($lab_test)." "; 
                                                            
                                                            $get_electrolytes_results = get_elec_tro_lytes_results($patient_id,$lab_code);
      
                                                            $SODIUM = $get_electrolytes_results['SODIUM'];
                                                            $POTASSIUM = $get_electrolytes_results['POTASSIUM'];
                                                            $CHLORIDE = $get_electrolytes_results['CHLORIDE'];
                                
                                
                                
                                                                                                                
                                                                                        
                                                        
                                                            $SODIUM_RESULTS; 
                                                            $POTASSIUM_RESULTS;
                                                            $CHLORIDE_RESULTS; 
                                                            $S_UREA_RESULTS;
                                                            $S_CREATININE_RESULTS;
                                                                                    
                                                                                            
                                                            if($SODIUM >= 135 && $SODIUM <= 145){
                                                                $SODIUM_RESULTS = "";
                                                            }elseif($SODIUM < 135){
                                                                $SODIUM_RESULTS = "L";
                                                            }else {
                                                                $SODIUM_RESULTS = "<b>H</b>";
                                                            }
                                                    
                                                            if($POTASSIUM >= 3.5 && $POTASSIUM <= 5.5){
                                                                $POTASSIUM_RESULTS = "";
                                                            }elseif($POTASSIUM < 3.5){
                                                                $POTASSIUM_RESULTS = "L";
                                                            }else {
                                                                $POTASSIUM_RESULTS = "<b>H</b>";
                                                            }
                                                    
                                                    
                                                            if($CHLORIDE >= 98 && $CHLORIDE <= 108){
                                                                $CHLORIDE_RESULTS = "";
                                                            }elseif($CHLORIDE < 98){
                                                                $CHLORIDE_RESULTS = "L";
                                                            }else {
                                                                $CHLORIDE_RESULTS = "<b>H</b>";
                                                            }
                                                                
                                                                                                                
                                                                                                                                                
                                                                                            ?></h4>
                                                                                            </div>
                                                                                                        <thead>
                                                                                                         
                                                                                                            <tr>
                                                                                                                <th class="center">Test</th>
                                                                                                               
                                                                                                                <th>Results</th>
                                                                                                                <th class="right">Unit</th> 
                                                                                                                <th class="right">Evaluation</th> 
                                                                                                                <th class="right">Reference</th> 
                                                                                                            </tr>
                                                                                                        </thead>
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                               
                                                                                                                <td class="left strong">SODIUM (Na+)</td>
                                                                                                                <td class="left"><?php echo $SODIUM ?></td>
                                                                                                                <td class="right"> mmol/l </td> 
                                                                                                                <td class="right"> <?php echo $SODIUM_RESULTS ?> </td> 
                                                                                                                <td class="right">  135 - 145 </td>
                                                                                                            </tr>
                                                            
                                                                                                            <tr>
                                                                                                               
                                                                                                            <td class="left strong">POTASSIUM (K+)</td>
                                                                                                                <td class="left"><?php echo $POTASSIUM ?></td>
                                                                                                                <td class="right"> mmol/l </td> 
                                                                                                                <td class="right"> <?php echo $POTASSIUM_RESULTS ?> </td> 
                                                                                                                <td class="right">  3.5 - 5.5 </td>
                                                                                                              
                                                                                                           </tr>
                                                            
                                                            
                                                                                                           <tr>
                                                                                                           <td class="left strong">CHLORIDE (Cl-)</td>
                                                                                                                <td class="left"><?php echo $CHLORIDE ?></td>
                                                                                                                <td class="right"> mmol/l </td> 
                                                                                                                <td class="right"> <?php echo $CHLORIDE_RESULTS ?> </td> 
                                                                                                                <td class="right">  98 - 108 </td>
                                                                                                               
                                                                                                           </tr>
                                                            
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                </div>
                                                            
                                                                                                <?php 
                                
                               
                                $divSaparateLine = '<div style="width:auto; background-color:#cff1ff; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
                                                           echo $divSaparateLine
                                                           ?>
                                                            
                                                                                         <?php }


else if (investigation_name($lab_test) == "TYROID FUNCTION ") {
  ?>


<div class="table-responsive-sm">
                                      <table class="table table-striped">


                                      <div class="header">							
                              <h4><?php echo investigation_name($lab_test)." "; 

$get_tyroid_func_results = get_tyroid_func_results($patient_id,$lab_code);
        
$F_T_3 = $get_tyroid_func_results['F_T_3'];
$F_T_4 = $get_tyroid_func_results['F_T_4'];
$T_S_H = $get_tyroid_func_results['T_S_H'];



                                                  
                          
$$F_T_3_RESULTS; 
$$F_T_4_RESULTS; 
$T_S_H_RESULTS; 

 


if($F_T_3 >= 2.0 && $F_T_3 <= 7.0){
  $F_T_3_RESULTS = "";
}elseif($F_T_3 < 2.0){
  $F_T_3_RESULTS = "L";
}else {
  $F_T_3_RESULTS = "<b>H</b>";
}

if($F_T_4 >= 9.0 && $F_T_4 <= 24.0){
  $F_T_4_RESULTS = "";
}elseif($F_T_4 < 9.0){
  $F_T_4_RESULTS = "L";
}else {
  $F_T_4_RESULTS = "<b>H</b>";
}


if($T_S_H >= 0.3 && $T_S_H <= 4.2){
  $T_S_H_RESULTS = "";
}elseif($T_S_H < 0.3){
  $T_S_H_RESULTS = "L";
}else {
  $T_S_H_RESULTS = "<b>H</b>";
}
  
                                                  
                                                                                  
                              ?></h4>
                              </div>
                                          <thead>
                                           
                                              <tr>
                                                  <th class="center">Test</th>
                                                 
                                                  <th>Results</th>
                                                  <th class="right">Unit</th> 
                                                  <th class="right">Evaluation</th> 
                                                  <th class="right">Reference</th> 
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr>
                                                 
                                                  <td class="left strong">TRI-IODO THYRONINE (FT3)</td>
                                                  <td class="left"><?php echo $F_T_3 ?></td>
                                                  <td class="right"> pmol/L </td> 
                                                  <td class="right"> <?php echo $F_T_3_RESULTS ?> </td> 
                                                  <td class="right">  2.0 - 7.0 </td>
                                              </tr>

                                              <tr>
                                                 
                                              <td class="left strong">THYROXINE (FT4)</td>
                                                  <td class="left"><?php echo $F_T_4 ?></td>
                                                  <td class="right"> pmol/L </td> 
                                                  <td class="right"> <?php echo $F_T_4_RESULTS ?> </td> 
                                                  <td class="right">  9.0 - 24.0 </td>
                                                
                                             </tr>


                                             <tr>
                                             <td class="left strong">TYROID STIMULATING HORMONE</td>
                                                  <td class="left"><?php echo $T_S_H ?></td>
                                                  <td class="right"> mlU/L </td> 
                                                  <td class="right"> <?php echo $T_S_H_RESULTS ?> </td> 
                                                  <td class="right">  0.3 - 4.2 </td>
                                                 
                                             </tr>


                                             <tr>
                                                   
                                                   <td class=""></td> 
                                                   
                                               </tr>


                                               
                                               <tr>
                                                   
                                                   <td class="">Interpretation</td> 
                                                   
                                               </tr>


                                               
                                               <tr>
                                                   
                                                   <td class=""></td> 
                                                   
                                               </tr>


                                               <tr style="color: #000;">
                                               <td style="">

                                                 <b>
                                                 Isolated high TSH especially in the range of 4.7 - 15 mlU/ml is commonly associated with physiological  & Biological TSH variability
</b>
                                                </td> 
                                               </tr>

                                               <tr style="color: #000;">
                                               <td style="">

                                                 <b>
                                                 Subclinical Autoimmune Hypothyroidism  
                                                </b>
                                                
                                                </td> 
                                               </tr>

                                               <tr style="color: #000;">
                                               <td style="">

                                                 <b>
                                                 Intermittent T4 therapy for Hypothyroidism
                                                 </b>
                                                
                                                </td> 
                                               </tr>


                                               <tr style="color: #000;">
                                               <td style="">

                                                 <b>
                                                   
                                                 Recovery phase after Non-Thyroidal illness Low TSH. Especially in the range of 0.1 to 0.4 often seen in the elderly & associated with non-thyroidal illness
                                                 </b>
                                                
                                                </td> 
                                               </tr>


                                               <tr style="color: #000;">
                                               <td style="">

                                                 <b>
                                                   
                                                 Subclinical Hyperthyroidism
                                                 </b>
                                                
                                                </td> 
                                               </tr>

                                               <tr style="color: #000;">
                                               <td style="">

                                                 <b>
                                                   
                                                 Thyroxine ingestion
                                                 </b>
                                                
                                                </td> 
                                               </tr>



                                            
     

                                          </tbody>
                                      </table>
                                  </div>

                                  <?php 
                                
                               
                                $divSaparateLine = '<div style="width:auto; background-color:#cff1ff; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
                                                           echo $divSaparateLine
                                                           ?>

                           <?php }

else if (investigation_name($lab_test) == "BUE&CR") {
    ?>


<div class="table-responsive-sm">
                                        <table class="table table-striped">


                                        <div class="header">							
                                <h4><?php echo investigation_name($lab_test)." "; 

$get_bue_cr_results = get_bue_cr_results($patient_id,$lab_code);
        
$SODIUM = $get_bue_cr_results['SODIUM'];
$POTASSIUM = $get_bue_cr_results['POTASSIUM'];
$CHLORIDE = $get_bue_cr_results['CHLORIDE'];
$S_UREA = $get_bue_cr_results['S_UREA'];

$S_CREATININE = $get_bue_cr_results['S_CREATININE'];


                                                    
                            
$SODIUM_RESULTS; 
$POTASSIUM_RESULTS;
$CHLORIDE_RESULTS; 
$S_UREA_RESULTS;
$S_CREATININE_RESULTS;


                        
                                
if($SODIUM >= 135 && $SODIUM <= 145){
    $SODIUM_RESULTS = "";
  }elseif($SODIUM < 135){
    $SODIUM_RESULTS = "L";
  }else {
    $SODIUM_RESULTS = "<b>H</b>";
  }

  if($POTASSIUM >= 3.5 && $POTASSIUM <= 5.5){
    $POTASSIUM_RESULTS = "";
  }elseif($POTASSIUM < 3.5){
    $POTASSIUM_RESULTS = "L";
  }else {
    $POTASSIUM_RESULTS = "<b>H</b>";
  }


  if($CHLORIDE >= 98 && $CHLORIDE <= 108){
    $CHLORIDE_RESULTS = "";
  }elseif($CHLORIDE < 98){
    $CHLORIDE_RESULTS = "L";
  }else {
    $CHLORIDE_RESULTS = "<b>H</b>";
  }

  if($S_UREA >= 1.7 && $S_UREA <= 8.3){
    $S_UREA_RESULTS = "";
  }elseif($S_UREA < 1.7){
    $S_UREA_RESULTS = "L";
  }else {
    $S_UREA_RESULTS = "<b>H</b>";
  }


  if($S_CREATININE >= 53 && $S_CREATININE <= 97){
    $S_CREATININE_RESULTS = "";
  }elseif($S_CREATININE < 53){
    $S_CREATININE_RESULTS = "L";
  }else {
    $S_CREATININE_RESULTS = "<b>H</b>";
  }
    
                                                    
                                                                                    
                                ?></h4>
                                </div>
                                            <thead>
                                             
                                                <tr>
                                                    <th class="center">Test</th>
                                                   
                                                    <th>Results</th>
                                                    <th class="right">Unit</th> 
                                                    <th class="right">Evaluation</th> 
                                                    <th class="right">Reference</th> 
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                   
                                                    <td class="left strong">SODIUM (Na+)</td>
                                                    <td class="left"><?php echo $SODIUM ?></td>
                                                    <td class="right"> mmol/l </td> 
                                                    <td class="right"> <?php echo $SODIUM_RESULTS ?> </td> 
                                                    <td class="right">  135 - 145 </td>
                                                </tr>

                                                <tr>
                                                   
                                                <td class="left strong">POTASSIUM (K+)</td>
                                                    <td class="left"><?php echo $POTASSIUM ?></td>
                                                    <td class="right"> mmol/l </td> 
                                                    <td class="right"> <?php echo $POTASSIUM_RESULTS ?> </td> 
                                                    <td class="right">  3.5 - 5.5 </td>
                                                  
                                               </tr>


                                               <tr>
                                               <td class="left strong">CHLORIDE (Cl-)</td>
                                                    <td class="left"><?php echo $CHLORIDE ?></td>
                                                    <td class="right"> mmol/l </td> 
                                                    <td class="right"> <?php echo $CHLORIDE_RESULTS ?> </td> 
                                                    <td class="right">  98 - 108 </td>
                                                   
                                               </tr>

                                               <tr>
                                               <td class="left strong">S-UREA</td>
                                                    <td class="left"><?php echo $S_UREA ?></td>
                                                    <td class="right"> mmol/l </td> 
                                                    <td class="right"> <?php echo $S_UREA_RESULTS ?> </td> 
                                                    <td class="right">  1.7 - 8.3</td>
                                                   
                                               </tr>


                                               <tr>
                                               <td class="left strong">S-CREATININE</td>
                                                    <td class="left"><?php echo $S_CREATININE ?></td>
                                                    <td class="right"> mmol/l </td> 
                                                    <td class="right"> <?php echo $S_CREATININE_RESULTS ?> </td> 
                                                    <td class="right">  53.0 - 97.0 </td>
                                                   
                                               </tr>

                                            </tbody>
                                        </table>
                                    </div>

 
                                    <?php 
                                
                               
                                $divSaparateLine = '<div style="width:auto; background-color:#cff1ff; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
                                                           echo $divSaparateLine
                                                           ?>
                             <?php }

else if (investigation_name($lab_test) == "UREA&CREATINE") {
    ?>


<div class="table-responsive-sm">
                                        <table class="table table-striped">


                                        <div class="header">							
                                <h4><?php echo investigation_name($lab_test)." "; 

$get_urea_creatine_results = get_urea_creatine_results($patient_id,$lab_code);
          
              
$S_UREA = $get_urea_creatine_results['S_UREA'];

$S_CREATININE = $get_urea_creatine_results['S_CREATININE'];


                                                    
                            

$S_UREA_RESULTS;
$S_CREATININE_RESULTS;




 
if($S_UREA >= 1.7 && $S_UREA <= 8.3){
    $S_UREA_RESULTS = "";
  }elseif($S_UREA < 1.7){
    $S_UREA_RESULTS = "L";
  }else {
    $S_UREA_RESULTS = "<b>H</b>";
  }


  if($S_CREATININE >= 53 && $S_CREATININE <= 97){
    $S_CREATININE_RESULTS = "";
  }elseif($S_CREATININE < 53){
    $S_CREATININE_RESULTS = "L";
  }else {
    $S_CREATININE_RESULTS = "<b>H</b>";
  }                                            
                                                                                    
                                ?></h4>
                                </div>
                                            <thead>
                                             
                                                <tr>
                                                    <th class="center">Test</th>
                                                   
                                                    <th>Results</th>
                                                    <th class="right">Unit</th> 
                                                    <th class="right">Evaluation</th> 
                                                    <th class="right">Reference</th> 
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                   
                                                    <td class="left strong">S-UREA</td>
                                                    <td class="left"><?php echo $S_UREA ?></td>
                                                    <td class="right"> mmol/l </td> 
                                                    <td class="right"> <?php echo $S_UREA_RESULTS ?> </td> 
                                                    <td class="right">  1.7 - 8.3 </td>
                                                </tr>

                                                <tr>
                                                   
                                                <td class="left strong">S-CREATININE</td>
                                                    <td class="left"><?php echo $S_CREATININE ?></td>
                                                    <td class="right"> mmol/l </td> 
                                                    <td class="right"> <?php echo $S_CREATININE_RESULTS ?> </td> 
                                                    <td class="right">  53.0 - 97.0 </td>
                                                  
                                               </tr>



                                            </tbody>
                                        </table>
                                    </div>

                                    <?php 
                                
                               
                                $divSaparateLine = '<div style="width:auto; background-color:#cff1ff; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
                                                           echo $divSaparateLine
                                                           ?>

                             <?php }
                                                             
                                                             else if (investigation_name($lab_test) == "FBS") {
                                                                ?>
                                                            
                                                            
                                                            <div class="table-responsive-sm">
                                                                                                    <table class="table table-striped">
                                                            
                                                            
                                                                                                    <div class="header">							
                                                                                            <h4><?php echo investigation_name($lab_test)." "; 
                                                            
                                                            $get_fbs_results = get_fbs_results($patient_id,$lab_code);
        
                                                            $blood_fbs = $get_fbs_results['blood_fbs'];
                                                                      
                                                                           
                                                            
                                                            
        
                                                                $blood_rbsRESULTS; 
                                                                $blood_fbs_RESULTS;
                                                            
                                                            
                                                            
                                                            
                                                             
                                                                if($blood_fbs >= 3.3 && $blood_fbs <= 6.3){
                                                                    $blood_fbs_RESULTS = "";
                                                                  }elseif($blood_fbs < 3.3){
                                                                    $blood_fbs_RESULTS = "L";
                                                                  }else {
                                                                    $blood_fbs_RESULTS = "<b>H</b>";
                                                                  }                                          
                                                                                                                                                
                                                                                            ?></h4>
                                                                                            </div>
                                                                                                        <thead>
                                                                                                         
                                                                                                            <tr>
                                                                                                                <th class="center">Test</th>
                                                                                                               
                                                                                                                <th>Results</th>
                                                                                                                <th class="right">Unit</th> 
                                                                                                                <th class="right">Evaluation</th> 
                                                                                                                <th class="right">Reference</th> 
                                                                                                            </tr>
                                                                                                        </thead>
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                               
                                                                                                                <td class="left strong">BLOOD FBS</td>
                                                                                                                <td class="left"><?php echo $blood_fbs ?></td>
                                                                                                                <td class="right"> mmol/l </td> 
                                                                                                                <td class="right"> <?php echo $blood_fbs_RESULTS ?> </td> 
                                                                                                                <td class="right">   3.3 - 6.3 </td>
                                                                                                            </tr>
                                                            
                                                                                                           
                                                            
                                                            
                                                            
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                </div>
                                                            
                                                                                                <?php 
                                
                               
                                $divSaparateLine = '<div style="width:auto; background-color:#cff1ff; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
                                                           echo $divSaparateLine
                                                           ?>
                                                            
                                                                                         <?php }


else if (investigation_name($lab_test) == "RBS") {
    ?>


<div class="table-responsive-sm">
                                        <table class="table table-striped">


                                        <div class="header">							
                                <h4><?php echo investigation_name($lab_test)." "; 

$get_rbs_results = get_rbs_results($patient_id,$lab_code);
          
$blood_rbs = $get_rbs_results['RBS_LEVEL'];
          
               


$blood_rbsRESULTS; 

if($blood_rbs <= 10){
    $blood_rbsRESULTS = "";
  }else {
    $blood_rbsRESULTS = "<b>H</b>";
  }




 
    if($blood_fbs >= 3.3 && $blood_fbs <= 6.3){
        $blood_fbs_RESULTS = "";
      }elseif($blood_fbs < 3.3){
        $blood_fbs_RESULTS = "L";
      }else {
        $blood_fbs_RESULTS = "<b>H</b>";
      }                                          
                                                                                    
                                ?></h4>
                                </div>
                                            <thead>
                                             
                                                <tr>
                                                    <th class="center">Test</th>
                                                   
                                                    <th>Results</th>
                                                    <th class="right">Unit</th> 
                                                    <th class="right">Evaluation</th> 
                                                    <th class="right">Reference</th> 
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                   
                                                    <td class="left strong">BLOOD RBS</td>
                                                    <td class="left"><?php echo $blood_rbs ?></td>
                                                    <td class="right"> mmol/l </td> 
                                                    <td class="right"> <?php echo $blood_rbsRESULTS ?> </td> 
                                                    <td class="right">  < 10 </td>
                                                </tr>

                                               



                                            </tbody>
                                        </table>
                                    </div>

 
                                    <?php 
                                
                               
                                $divSaparateLine = '<div style="width:auto; background-color:#cff1ff; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
                                                           echo $divSaparateLine
                                                           ?>
                             <?php }else if (investigation_name($lab_test) == "EGFR") {
  ?>


<div class="table-responsive-sm">
                                      <table class="table table-striped">


                                      <div class="header">							
                              <h4><?php echo investigation_name($lab_test)." "; 

$get_efgr_results = get_efgr_results($patient_id,$lab_code);
        
$egfr_value = $get_efgr_results['egfr_value'];
$egfr_comment = !empty($get_efgr_results['comment']) ? $get_efgr_results['comment'] : 'N/A';


$stage;
$flag;
$description;

if ($egfr_value >= 90){
  $stage = "Stage 1 (Normal)";
  $flag = "Normal";
  $description = "Normal kidney function";

}else if ($egfr_value >= 60){

  $stage = "Stage 2 (Mild)";
  $flag = "Mild Decline";
  $description = "Mild reduction, monitor if needed";

}else if ($egfr_value >= 45){
  $stage = "Stage 3a (Moderate)";
  $flag = "Moderate Decline";
  $description = "Moderate reduction, monitor closely";

}else if ($egfr_value >= 30){
  $stage = "Stage 3b (Moderate)";
  $flag = "Moderate-Severe";
  $description = "May need specialist care";

}else if ($egfr_value >= 15){
  $stage = "Stage 4 (Severe)";
  $flag = "Severe Decline";
  $description = "Likely needs nephrologist follow-up";

}else{

  $stage = "Stage 5 (Failure)";
  $flag = "Kidney Failure";
  $description = "Needs dialysis/transplant eval";

}      
    ?></h4>
                              </div>
                                          <thead>
                                           
                                              <tr>
                                                  <th class="center">eGFR Value (mL/min/1.73m²)</th>
                                                 
                                                  <th>Stage</th>
                                                  <th class="right">Flag</th> 
                                                  <th class="right">Description</th> 
                                                   
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr>
                                                 
                                                  <td class="left strong"><?php echo $egfr_value ?></td>
                                                  <td class="left"><?php echo $stage ?></td>
                                                  <td class="right"> <?php echo $flag ?></td> 
                                                  <td class="right"> <?php echo $description ?> </td> 
                              
                                              </tr>

                                              <tr>
                                                 
                                                 <td class="left strong"></td>
                                                 <td class="left"></td>
                                                 <td class="right"> Comments: </td> 
                                                 <td class="right"> <?php echo $egfr_comment ?> </td> 
                             
                                             </tr>


                                             



                                          </tbody>
                                      </table>
                                  </div>

                                  <?php 
                              
                             
                              $divSaparateLine = '<div style="width:auto; background-color:#cff1ff; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
                                                         echo $divSaparateLine
                                                         ?>

                           <?php }

else if (investigation_name($lab_test) == "OGTT") {
  ?>


<div class="table-responsive-sm">
                                      <table class="table table-striped">


                                      <div class="header">							
                              <h4><?php echo investigation_name($lab_test)." "; 

$get_2HPP_results = get_2HPP_results($patient_id,$lab_code);
        
$fasting = $get_2HPP_results['fasting'];
$first_hour = $get_2HPP_results['1st_hour'];
$second_hour = $get_2HPP_results['2nd_hour'];
        
             
$hppRESULTS; 
$fastingResults;

if($first_hour <= 10 || $second_hour <= 10){
  $hppRESULTS = "";
}else {
  $hppRESULTS = "<b>H</b>";
}

if($fasting  < 140.0){
  $fastingResults = "Normal";
}elseif($fasting >= 140.0 && $fasting <= 199.0){
  $fastingResults = "Prediabetes";
}else {
  $fastingResults = "<b>Diabetes</b>";
}
                                                                                  
                              ?></h4>
                              </div>
                                          <thead>
                                           
                                              <tr>
                                                  <th class="center">Test</th>
                                                 
                                                  <th>Results</th>
                                                  <th class="right">Unit</th> 
                                                  <th class="right">Evaluation</th> 
                                                  <th class="right">Reference</th> 
                                              </tr>
                                          </thead>
                                          <tbody>
                                          <tr>
                                                 
                                                 <td class="left strong">FASTING</td>
                                                 <td class="left"><?php echo $fasting ?></td>
                                                 <td class="right"> mg/dl </td> 
                                                 <td class="right"> <?php echo $fastingResults ?> </td> 
                                                 <td class="right"> Less than 140 : Normal <br> Between 140-199 : Prediabetes <br> Greater than 200 : Diabetes </td>
                                             </tr>
                                              <tr>
                                                 
                                                  <td class="left strong">1ST HOUR</td>
                                                  <td class="left"><?php echo $first_hour ?></td>
                                                  <td class="right"> mmol/l </td> 
                                                  <td class="right"> <?php echo $hppRESULTS ?> </td> 
                                                  <td class="right">  < 10 </td>
                                              </tr>

                                              <tr>
                                                 
                                                 <td class="left strong">2ND HOUR</td>
                                                 <td class="left"><?php echo $second_hour ?></td>
                                                 <td class="right"> mmol/l </td> 
                                                 <td class="right"> <?php echo $hppRESULTS ?> </td> 
                                                 <td class="right">  < 10 </td>
                                             </tr>

                                             

                                             



                                          </tbody>
                                      </table>
                                  </div>

                                  <?php 
                              
                             
                              $divSaparateLine = '<div style="width:auto; background-color:#cff1ff; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
                                                         echo $divSaparateLine
                                                         ?>

                           <?php }



else if (investigation_name($lab_test) == "Hepatitis B") {
    ?>


<div class="table-responsive-sm">
                                        <table class="table table-striped">


                                        <div class="header">							
                                <h4><?php echo investigation_name($lab_test)." "; 

$get_hepatitis_B = hepatitis_B($patient_id,$lab_code);
          
 
                                                                    
                                ?></h4>
                                </div>
                                            <thead>
                                             
                                                <tr>
                                                    <th class="center">Test</th>
                                                   
                                                    <th>Results</th>
                                                  
                                                 
                                                    <th class="right">Reference</th> 
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                   
                                                    <td class="left strong"> HBsAg </td>
                                                    <td class="left"><?php echo $get_hepatitis_B['test_status'] ?></td>
                                                  
                                             
                                                    <td class="right">  - </td>
                                                </tr>

                                               



                                            </tbody>
                                        </table>
                                    </div>

 
                                    <?php 
                                
                               
                                $divSaparateLine = '<div style="width:auto; background-color:#cff1ff; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
                                                           echo $divSaparateLine
                                                           ?>
                             <?php }

                             
else if (investigation_name($lab_test) == "HIV I&II") {
    ?>


<div class="table-responsive-sm">
                                        <table class="table table-striped">


                                        <div class="header">							
                                <h4><?php echo investigation_name($lab_test)." "; 

$hiv_i_ii_get = hiv_i_ii_get($patient_id,$lab_code);
          
 
                                                                    
                                ?></h4>
                                </div>
                                            <thead>
                                             
                                                <tr>
                                                    <th class="center">Test</th>
                                                   
                                                    <th>Results</th>
                                                  
                                                  
                                                    <th class="right">Reference</th> 
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                   
                                                    <td class="left strong"> HIV I&II  </td>
                                                    <td class="left"><?php echo $hiv_i_ii_get['test_status'] ?></td>
                                                  
                                             
                                                    <td class="right">  - </td>
                                                </tr>

                                               



                                            </tbody>
                                        </table>
                                    </div>

 
                                    <?php 
                                
                               
                                $divSaparateLine = '<div style="width:auto; background-color:#cff1ff; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
                                                           echo $divSaparateLine
                                                           ?>
                             <?php }


                             
else if (investigation_name($lab_test) == "URINE PREGNANCY TEST(UPT)") {
    ?>


<div class="table-responsive-sm">
                                        <table class="table table-striped">


                                        <div class="header">							
                                <h4><?php echo investigation_name($lab_test)." "; 

$get_urine_preg = get_urine_preg($patient_id,$lab_code);
          
 
                                                                    
                                ?></h4>
                                </div>
                                            <thead>
                                             
                                                <tr>
                                                    <th class="center">Test</th>
                                                   
                                                    <th>Results</th>
                                                  
                                                 
                                                    <th class="right">Reference</th> 
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                   
                                                    <td class="left strong"> URINE PREGNANCY TEST(UPT)  </td>
                                                    <td class="left"><?php echo $get_urine_preg['test_status'] ?></td>
                                                  
                                             
                                                    <td class="right">  - </td>
                                                </tr>

                                               



                                            </tbody>
                                        </table>
                                    </div>

 
                                    <?php 
                                
                               
                                $divSaparateLine = '<div style="width:auto; background-color:#cff1ff; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
                                                           echo $divSaparateLine
                                                           ?>
                             <?php }


else if (investigation_name($lab_test) == "SERUM PREGNANCY TEST(SPT)") {
    ?>


<div class="table-responsive-sm">
                                        <table class="table table-striped">


                                        <div class="header">							
                                <h4><?php echo investigation_name($lab_test)." "; 

$get_serum_preg = get_serum_preg($patient_id,$lab_code);
          
 
                                                                    
                                ?></h4>
                                </div>
                                            <thead>
                                             
                                                <tr>
                                                    <th class="center">Test</th>
                                                   
                                                    <th>Results</th>
                                                  
                                                    
                                                    <th class="right">Reference</th> 
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                   
                                                    <td class="left strong"> SERUM PREGNANCY TEST(SPT)  </td>
                                                    <td class="left"><?php echo $get_serum_preg['test_status'] ?></td>
                                                  
                                             
                                                    <td class="right">  - </td>
                                                </tr>

                                               



                                            </tbody>
                                        </table>
                                    </div>

 
                                    <?php 
                                
                               
                                $divSaparateLine = '<div style="width:auto; background-color:#cff1ff; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
                                                           echo $divSaparateLine
                                                           ?>
                             <?php }

                             
else if (investigation_name($lab_test) == "G6PD") {
    ?>


<div class="table-responsive-sm">
                                        <table class="table table-striped">


                                        <div class="header">							
                                <h4><?php echo investigation_name($lab_test)." "; 

$get_gpd = get_gpd($patient_id,$lab_code);
          
 
                                                                    
                                ?></h4>
                                </div>
                                            <thead>
                                             
                                                <tr>
                                                    <th class="center">Test</th>
                                                   
                                                    <th>Results</th>
                                                  
                                                   
                                                    <th class="right">Reference</th> 
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                   
                                                    <td class="left strong"> G6PD </td>
                                                    <td class="left"><?php echo $get_gpd['test_status'] ?></td>
                                                  
                                             
                                                    <td class="right">-</td>
                                                </tr>

                                               



                                            </tbody>
                                        </table>
                                    </div>

 
                                    <?php 
                                
                               
                                $divSaparateLine = '<div style="width:auto; background-color:#cff1ff; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
                                                           echo $divSaparateLine
                                                           ?>
                             <?php }

else if (investigation_name($lab_test) == "Malaria") {
  ?>


<div class="table-responsive-sm">
                                      <table class="table table-striped">


                                      <div class="header">							
                              <h4><?php echo investigation_name($lab_test)." "; 

$get_MALARIA_test= MALARIA_test($patient_id,$lab_code);
        

                                                                  
                              ?></h4>
                              </div>
                                          <thead>
                                           
                                              <tr>
                                                  <th class="center">Test</th>
                                                 
                                                  <th>Results</th>
                                                
                                                  
                                                  <th class="right">Reference</th> 
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr>
                                                 
                                                  <td class="left strong"> Malaria RDT </td>
                                                  <td class="left"><?php echo $get_MALARIA_test['test_status'] ?></td>
                                                  
                                           
                                                  <td class="right">-</td>
                                              </tr>

                                             



                                          </tbody>
                                      </table>
                                  </div>


                                  <?php 
                                
                               
                                $divSaparateLine = '<div style="width:auto; background-color:#cff1ff; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
                                                           echo $divSaparateLine
                                                           ?>
                           <?php }



else if (investigation_name($lab_test) == "COVID-19 ANTIGEN") {
  ?>


<div class="table-responsive-sm">
                                      <table class="table table-striped">


                                      <div class="header">							
                              <h4><?php echo investigation_name($lab_test)." "; 

$get_covid_19= get_covid_19($patient_id,$lab_code);
        

                                                                  
                              ?></h4>
                              </div>
                                          <thead>
                                           
                                              <tr>
                                                  <th class="center">Test</th>
                                                 
                                                  <th>Results</th>
                                                
                                                  
                                                  <th class="right">Reference</th> 
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr>
                                                 
                                                  <td class="left strong"> COVID-19 ANTIGEN </td>
                                                  <td class="left"><?php echo $get_covid_19['test_status'] ?></td>
                                                  
                                           
                                                  <td class="right">-</td>
                                              </tr>

                                             



                                          </tbody>
                                      </table>
                                  </div>

                                  <?php 
                                
                               
                                $divSaparateLine = '<div style="width:auto; background-color:#cff1ff; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
                                                           echo $divSaparateLine
                                                           ?>

                           <?php }
                                                                                                       
                                                                                                       else if (investigation_name($lab_test) == "HCV") {
                                                                                                        ?>
                                                                                                      
                                                                                                      
                                                                                                      <div class="table-responsive-sm">
                                                                                                                                            <table class="table table-striped">
                                                                                                      
                                                                                                      
                                                                                                                                            <div class="header">							
                                                                                                                                    <h4><?php echo investigation_name($lab_test)." "; 
                                                                                                      
                                                                                                      $HCV_test = HCV_test($patient_id,$lab_code);
                                                                                                              
                                                                                                      
                                                                                                                                                                        
                                                                                                                                    ?></h4>
                                                                                                                                    </div>
                                                                                                                                                <thead>
                                                                                                                                                 
                                                                                                                                                    <tr>
                                                                                                                                                        <th class="center">Test</th>
                                                                                                                                                       
                                                                                                                                                        <th>Results</th>
                                                                                                                                                      
                                                                                                                                                        
                                                                                                                                                        <th class="right">Reference</th> 
                                                                                                                                                    </tr>
                                                                                                                                                </thead>
                                                                                                                                                <tbody>
                                                                                                                                                    <tr>
                                                                                                                                                       
                                                                                                                                                        <td class="left strong"> HCV </td>
                                                                                                                                                        <td class="left"><?php echo $HCV_test['test_status'] ?></td>
                                                                                                                                                        
                                                                                                                                                 
                                                                                                                                                        <td class="right">-</td>
                                                                                                                                                    </tr>
                                                                                                      
                                                                                                                                                   
                                                                                                      
                                                                                                      
                                                                                                      
                                                                                                                                                </tbody>
                                                                                                                                            </table>
                                                                                                                                        </div>
                                                                                                      
                                                                                                      
                                                                                                                                        <?php 
                                
                               
                                $divSaparateLine = '<div style="width:auto; background-color:#cff1ff; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
                                                           echo $divSaparateLine
                                                           ?>
                                                                                                                                 <?php }
                              else if (investigation_name($lab_test) == "SPT") {
                                ?>
                              
                              
                              <div class="table-responsive-sm">
                                                                    <table class="table table-striped">
                              
                              
                                                                    <div class="header">							
                                                            <h4><?php echo investigation_name($lab_test)." "; 
                              
                              $SPT_test = SPT_test($patient_id,$lab_code);
                                      
                              
                                                                                                
                                                            ?></h4>
                                                            </div>
                                                                        <thead>
                                                                         
                                                                            <tr>
                                                                                <th class="center">Test</th>
                                                                               
                                                                                <th>Results</th>
                                                                              
                                                                                
                                                                                <th class="right">Reference</th> 
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                               
                                                                                <td class="left strong"> SPT </td>
                                                                                <td class="left"><?php echo $SPT_test['test_status'] ?></td>
                                                                                
                                                                         
                                                                                <td class="right">-</td>
                                                                            </tr>
                              
                                                                           
                              
                              
                              
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                              
                                                                <?php 
                                
                               
                                $divSaparateLine = '<div style="width:auto; background-color:#cff1ff; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
                                                           echo $divSaparateLine
                                                           ?>
                              
                                                         <?php }

else if (investigation_name($lab_test) == "RETRO SCREEN") {
  ?>


<div class="table-responsive-sm">
                                      <table class="table table-striped">


                                      <div class="header">							
                              <h4><?php echo investigation_name($lab_test)." "; 

$RETRO_SCREEN_test = RETRO_SCREEN_test($patient_id,$lab_code);
        

                                                                  
                              ?></h4>
                              </div>
                                          <thead>
                                           
                                              <tr>
                                                  <th class="center">Test</th>
                                                 
                                                  <th>Results</th>
                                                
                                                  
                                                  <th class="right">Reference</th> 
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr>
                                                 
                                                  <td class="left strong"> RETRO SCREEN </td>
                                                  <td class="left"><?php echo $RETRO_SCREEN_test['test_status'] ?></td>
                                                  
                                           
                                                  <td class="right">-</td>
                                              </tr>

                                             



                                          </tbody>
                                      </table>
                                  </div>


                                  <?php 
                                
                               
                                $divSaparateLine = '<div style="width:auto; background-color:#cff1ff; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
                                                           echo $divSaparateLine
                                                           ?>
                           <?php }

                                                         

else if (investigation_name($lab_test) == "Typhoid") {
  ?>


<div class="table-responsive-sm">
                                      <table class="table table-striped">


                                      <div class="header">							
                              <h4><?php echo investigation_name($lab_test)." "; 

$Typhoid_test = Typhoid_test($patient_id,$lab_code);
        

                                                                  
                              ?></h4>
                              </div>
                                          <thead>
                                           
                                              <tr>
                                                  <th class="center">Test</th>
                                                 
                                                  <th>Results</th>
                                                
                                                  
                                                  <th class="right">Reference</th> 
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr>
                                                 
                                                  <td class="left strong"> IgG </td>
                                                  <td class="left"><?php echo $Typhoid_test['IgG'] ?></td>
                                                  
                                           
                                                  <td class="right">-</td>
                                              </tr>



                                              <tr>
                                                 
                                                 <td class="left strong"> IgM </td>
                                                 <td class="left"><?php echo $Typhoid_test['IgM'] ?></td>
                                                 
                                          
                                                 <td class="right">-</td>
                                             </tr>

                                             



                                          </tbody>
                                      </table>
                                  </div>


                                  <?php 
                                
                               
                                $divSaparateLine = '<div style="width:auto; background-color:#cff1ff; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
                                                           echo $divSaparateLine
                                                           ?>
                           <?php }


else if (investigation_name($lab_test) == "Widal") {
  ?>


<div class="table-responsive-sm">
                                      <table class="table table-striped">


                                      <div class="header">							
                              <h4><?php echo investigation_name($lab_test)." "; 

$Widal_test = Widal_test($patient_id,$lab_code);
        

                                                                  
                              ?></h4>
                              </div>
                                          <thead>
                                           
                                              <tr>
                                                  <th class="center">Test</th>
                                                 
                                                  <th>Results</th>
                                                
                                                  
                                                  <th class="right">Reference</th> 
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr>
                                                 
                                                  <td class="left strong"> S typhi 'O' </td>
                                                  <td class="left"><?php echo $Widal_test['s_typhi_o'] ?></td>
                                                  
                                           
                                                  <td class="right">-</td>
                                              </tr>



                                              <tr>
                                                 
                                                 <td class="left strong"> S typhi 'H' </td>
                                                 <td class="left"><?php echo $Widal_test['s_typhi_h'] ?></td>
                                                 
                                          
                                                 <td class="right">-</td>
                                             </tr>

                                             



                                          </tbody>
                                      </table>
                                  </div>

                                  <?php 
                                
                               
                                $divSaparateLine = '<div style="width:auto; background-color:#cff1ff; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
                                                           echo $divSaparateLine
                                                           ?>

                           <?php }


else if (investigation_name($lab_test) == "Stool RE") {
  ?>


<div class="table-responsive-sm">
                                      <table class="table table-striped">


                                      <div class="header">							
                              <h4><?php echo investigation_name($lab_test)." "; 

$stool_re = stool_re($patient_id,$lab_code);
        

                                                                  
                              ?></h4>
                              </div>
                                          <thead>
                                           
                                              <tr>
                                                  <th class="center">Test</th>
                                                 
                                                  <th>Results</th>
                                                
                                                  
                                                  <th class="right">Reference</th> 
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr>
                                                 
                                                  <td class="left strong"> Macroscopy </td>
                                                  <td class="left"><?php echo $stool_re['macroscopy'] ?></td>
                                                  
                                           
                                                  <td class="right">-</td>
                                              </tr>



                                              <tr>
                                                 
                                                 <td class="left strong"> Microscopy </td>
                                                 <td class="left"><?php echo $stool_re['microscopy'] ?></td>
                                                 
                                          
                                                 <td class="right">-</td>
                                             </tr>

                                             



                                          </tbody>
                                      </table>
                                  </div>


                                  <?php 
                                
                               
                                $divSaparateLine = '<div style="width:auto; background-color:#cff1ff; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
                                                           echo $divSaparateLine
                                                           ?>
                           <?php }



else if (investigation_name($lab_test) == "GLYCATED HAEMOGLOBIN") {
  ?>


<div class="table-responsive-sm">
                                      <table class="table table-striped">


                                      <div class="header">							
                              <h4><?php echo investigation_name($lab_test)." "; 
 $glycated_haemoglobin = glycated_haemoglobin($patient_id,$lab_code);
 $glycated_haemoglobin_value = $glycated_haemoglobin['GLYCATED_HAEMOGLOBIN'];

 $glycated_haemoglobin_evaluation = $glycated_haemoglobin['evaluation'];
        

                                                                  
                              ?></h4>
                              </div>
                                          <thead>
                                           
                                              <tr>
                                                  <th class="center">Test</th>
                                                 
                                                  <th>Results</th>
                                                  <th class="right">Unit</th> 
                                                  <th class="right">Flag</th>
                                                  <th class="right">Reference</th> 
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr>
                                                 
                                                  <td class="left strong"> GLYCATED HAEMOGLOBIN </td>
                                                  <td class="left"><?php echo $glycated_haemoglobin_value ?></td>
                                                  <td class="right"> % </td>
                                                  <td class="left"><?php echo $glycated_haemoglobin_evaluation ?></td>
                                                  <td class="left strong"> 3.4 - 6.5 </td>
                                              </tr>




                                              <tr>
                                                   
                                                   <td class=""></td> 
                                                   
                                               </tr>


                                               
                                               <tr>
                                                   
                                                   <td class="">Interpretation</td> 
                                                   
                                               </tr>


                                               
                                               <tr>
                                                   
                                                   <td class=""></td> 
                                                   
                                               </tr>


                                               <tr>
                                                 <td>HBA1c Value</td>
                                                 <td>Interpretation</td>
                                               </tr>


                                               <tr>
                                                 <td>3.4 - 6.0%</td>
                                                 <td>Normal Value / Non Diabetic</td>
                                               </tr>


                                               <tr>
                                                 <td>6.1 - 7%</td>
                                                 <td>Well Controlled</td>
                                               </tr>


                                               <tr>
                                                 <td>7.1 - 8%</td>
                                                 <td>Fair Controlled</td>
                                               </tr>


                                               <tr>
                                                 <td> > 8</td>
                                                 <td>Poor control & Need Treat</td>
                                               </tr>



 

                                          </tbody>
                                      </table>
                                  </div>


                                  <?php 
                                
                               
                                $divSaparateLine = '<div style="width:auto; background-color:#cff1ff; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
                                                           echo $divSaparateLine
                                                           ?>
                           <?php }

                           
else if (investigation_name($lab_test) == "HEPATITIS B PROFILE") {
  ?>


<div class="table-responsive-sm">
                                      <table class="table table-striped">


                                      <div class="header">							
                              <h4><?php echo investigation_name($lab_test)." "; 
   $hepatitis_B_profile = hepatitis_B_profile($patient_id,$lab_code);

   $HBsAg = $hepatitis_B_profile['HBsAg'];
   $HBsAb = $hepatitis_B_profile['HBsAb'];
   $HBeAg = $hepatitis_B_profile['HBeAg'];
   $HBeAb = $hepatitis_B_profile['HBeAb'];
   $HBcAb = $hepatitis_B_profile['HBcAb']; 
   $comments = $hepatitis_B_profile['comments']; 
        

                                                                  
                              ?></h4>
                              </div>
                                          <thead>
                                           
                                              <tr>
                                                  <th class="center">Test</th>
                                                 

                                                  <td></td> 
                                                  <td></td> 
                                                  <td></td> 
                                              
                                                  <th>Results</th>
                                                  
                                               
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr>
                                                 
                                                  <td class="left strong"> HBsAg </td>


                                                  <td class="left"></td> 
                                                  <td class="left"></td> 
                                                  <td class="left"></td> 
                                                  <td class="left"><?php echo $HBsAg ?></td> 

                                              </tr>

                                              <tr>
                                                 
                                                 <td class="left strong"> HBsAb </td>

                                                 <td class="left"></td> 
                                                 
                                                 <td class="left"></td> 
                                                  <td class="left"></td> 

                                                 <td class="left"><?php echo $HBsAb ?></td> 
                                                 
                                             </tr>

                                             <tr>
                                                 
                                                 <td class="left strong"> HBeAg </td>
                                                 <td class="left"></td> 
                                                 
                                                 <td class="left"></td> 
                                                  <td class="left"></td> 
                                                 <td class="left"><?php echo $HBeAg ?></td> 
                                                 
                                             </tr>

                                             <tr>
                                                 
                                                 <td class="left strong"> HBeAb </td>
                                                 <td class="left"></td> 
                                                 
                                                 <td class="left"></td> 
                                                  <td class="left"></td> 
                                                 <td class="left"><?php echo $HBeAb ?></td> 
                                                 
                                             </tr>


                                             <tr>
                                                 
                                                 <td class="left strong"> HBcAb </td>
                                                 <td class="left"></td> 
                                                 
                                                 <td class="left"></td> 
                                                  <td class="left"></td> 
                                                 <td class="left"><?php echo $HBcAb ?></td> 
                                                 
                                             </tr>




                                              <tr>
                                                   
                                                   <td class=""></td> 
                                                   
                                               </tr>

                                               <tr>
                                                 <td>

                                               Comments
                                                   
</td>
                                               </tr>
</br>
                                               
                                               <tr>
                                               <td>
                                               <?php echo $comments ?>
                                               
                                               </td>  
                                             
                                              
                                              </tr> 

                                               <tr>
                                                   
                                                   <td class=""></td> 
                                                   
                                               </tr>


                                               
                                               <tr>
                                                   
                                                   <td class="">Interpretation</td> 
                                                   
                                               </tr>


                                               
                                               <tr>
                                                   
                                                   <td class=""></td> 
                                                   
                                               </tr>


                                               <tr style="color: #000;">
                                               <td style=""><b>HBsAg(Surface Antigen) </b></td> 
                                                <td style=""><b>Anti- HBs(Surface Antibody)</b></td>
                                                <td style=""><b>HBeAg (Envelope Antigen) </b></td> 
                                                <td style=""><b>Anti-HBe (Envelope Antibody)</b></td>
                                                <td style=""><b>Anti- HBc (Core Antibody) </b></td> 
                                                <td style=""><b>Interpretation</b></td>
                                               </tr>


                                               <tr>
                                                
                                               <tr style="color: #000;">
                                               <td style=""><b>- </b></td> 
                                              <td style=""><b>-</b></td>
                                              <td style=""><b>- </b></td> 
                                              <td style=""><b>-</b></td>
                                              <td style=""><b>- </b></td> 
                                              <td style="">No past infection, No immunity</td>

                                               </tr>


                                            
                                               <tr style="color: #000;">
       <td style=""><b> + </b></td> 
        <td style=""><b>-</b></td>
        <td style=""><b>- </b></td> 
        <td style=""><b>+</b></td>
        <td style=""><b>+ </b></td> 
        <td style="">Latent phase of Acute Infection. No active viral replication</td>
       </tr>

       <tr style="color: #000;">
       <td style=""><b> - </b></td> 
        <td style=""><b>+/-</b></td>
        <td style=""><b>- </b></td> 
        <td style=""><b>+/-</b></td>
        <td style=""><b>+ </b></td> 
        <td style="">Recovery from Hepatitis B with Immunity</td>
       </tr>


       <tr style="color: #000;">
       <td style=""><b> - </b></td> 
        <td style=""><b>+</b></td>
        <td style=""><b>- </b></td> 
        <td style=""><b>+/-</b></td>
        <td style=""><b>- </b></td> 
        <td style="">Successful, Vaccination, No past Infection</td>
       </tr>


       <tr style="color: #000;">
       <td style=""><b> + </b></td> 
        <td style=""><b>-</b></td>
        <td style=""><b>+ </b></td> 
        <td style=""><b>-</b></td>
        <td style=""><b>+ </b></td> 
        <td style="">Chronic Infection with active replication, Hepatitis B carrier.</td>
       </tr>


       <tr style="color: #000;">
       <td style=""><b> + </b></td> 
        <td style=""><b>-</b></td>
        <td style=""><b>- </b></td> 
        <td style=""><b>-</b></td>
        <td style=""><b>+ </b></td> 
        <td style="">Chronic Infection with Inactive Replication.</td>
       </tr>

 


                                              



 

                                          </tbody>
                                      </table>
                                  </div>


                                  <?php 
                                
                               
                                $divSaparateLine = '<div style="width:auto; background-color:#cff1ff; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
                                                           echo $divSaparateLine
                                                           ?>
                           <?php }

else if (investigation_name($lab_test) == "PROSTATE SPECIFIC ANTIGEN") {
  ?>


<div class="table-responsive-sm">
                                      <table class="table table-striped">


                                      <div class="header">							
                              <h4><?php echo investigation_name($lab_test)." "; 

$psa_results = psa_results($patient_id,$lab_code);
  
$psa_results_value = $psa_results['psa_lev'];

$evaluation_psa = $psa_results['evaluation'];
        

                                                                  
                              ?></h4>
                              </div>
                                          <thead>
                                           
                                              <tr>
                                                  <th class="center">Test</th>
                                                 
                                                  <th>Results</th>
                                                
                                                  <th>Unit</th>
                                                  <th>Flag</th>
                                                  <th class="right">Reference</th> 
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr>
                                                 
                                                  <td class="left strong"> PSA LEVEL </td>
                                                  <td class="left"><?php echo $psa_results_value ?></td>
                                                  <td class="right">ng/ml</td>
                                                  <td class="left"><?php echo $evaluation_psa ?></td>
                                                  <td class="right">0.0 - 4.0</td>
                                              </tr>


                                          </tbody>
                                      </table>
                                  </div>


                                  <?php 
                                
                               
                                $divSaparateLine = '<div style="width:auto; background-color:#cff1ff; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
                                                           echo $divSaparateLine
                                                           ?>
                           <?php }

else if (investigation_name($lab_test) == "HAEMOGLOBIN LEVEL") {
  ?>


<div class="table-responsive-sm">
                                      <table class="table table-striped">


                                      <div class="header">							
                              <h4><?php echo investigation_name($lab_test)." "; 

$level_haemoglobin = level_haemoglobin($patient_id,$lab_code);

$level_haemoglobin = $level_haemoglobin['hae_lev'];

$level_haemoglobin_RESULTS;  
  

  if($level_haemoglobin >= 11.0 && $level_haemoglobin <= 15.0){
    $level_haemoglobin_RESULTS = "";
  }elseif($level_haemoglobin < 11.0){
    $level_haemoglobin_RESULTS = "L";
  }else {
    $level_haemoglobin_RESULTS = "<b>H</b>";
  }

  

        

                                                                  
                              ?></h4>
                              </div>
                                          <thead>
                                           
                                              <tr>
                                                  <th class="center">Test</th>
                                                 
                                                  <th>Results</th>
                                                
                                                  <th>Unit</th>
                                                  <th>Flag</th>
                                                  <th class="right">Reference</th> 
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr>
                                                 
                                                  <td class="left strong"> HAEMOGLOBIN LEVEL </td>
                                                  <td class="left"><?php echo $level_haemoglobin ?></td>
                                                  <td class="right">g/dl</td>
                                                  <td class="left"><?php echo $level_haemoglobin_RESULTS ?></td>
                                                  <td class="right"><br>Male : 12 - 16<br>Female : 11 - 15</td>
                                              </tr>


 


                                          </tbody>
                                      </table>
                                  </div>


                                  <?php 
                                
                               
                                $divSaparateLine = '<div style="width:auto; background-color:#cff1ff; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
                                                           echo $divSaparateLine
                                                           ?>
                           <?php }

else if (investigation_name($lab_test) == "ESR") {
  ?>


<div class="table-responsive-sm">
                                      <table class="table table-striped">


                                      <div class="header">							
                              <h4><?php echo investigation_name($lab_test)." "; 


$get_level_esr = get_level_esr($patient_id,$lab_code);

$get_level_esr_VAL = $get_level_esr['ESR_LEVEL'];
//S_CREATININE

$ESR_RESULTS;  


if($get_level_esr_VAL >= 0 && $get_level_esr_VAL <= 30.0){
  $ESR_RESULTS = "";
}elseif($get_level_esr_VAL < 0){
  $ESR_RESULTS = "L";
}else {
  $ESR_RESULTS = "<b>H</b>";
}

        

                                                                  
                              ?></h4>
                              </div>
                                          <thead>
                                           
                                              <tr>
                                                  <th class="center">Test</th>
                                                 
                                                  <th>Results</th>
                                                
                                                  <th>Unit</th>
                                                  <th>Flag</th>
                                                  <th class="right">Reference</th> 
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr>
                                                 
                                                  <td class="left strong"> ESR RESULTS </td>
                                                  <td class="left"><?php echo $get_level_esr_VAL ?></td>
                                                  <td class="right">mm/hr</td>
                                                  <td class="left"><?php echo $ESR_RESULTS ?></td>
                                                  <td class="right">Children : 0 - 10 <br> Male : 0 - 15 <br> Female : 0 - 20</td>
                                              </tr>


 


                                          </tbody>
                                      </table>
                                  </div>


                                  <?php 
                                
                               
                                $divSaparateLine = '<div style="width:auto; background-color:#cff1ff; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
                                                           echo $divSaparateLine
                                                           ?>
                           <?php }

else if (investigation_name($lab_test) == "BLOOD GROUP") {
  ?>


<div class="table-responsive-sm">
                                      <table class="table table-striped">


                                      <div class="header">							
                              <h4><?php echo investigation_name($lab_test)." "; 

$get_blood = get_blood($patient_id,$lab_code);

$get_blood = $get_blood['BLOOD_TYPE'];
//S_CREATININE
   

 
        

                                                                  
                              ?></h4>
                              </div>
                                          <thead>
                                           
                                              <tr>
                                                  <th class="center">Test</th>
                                                 
                                                  <th>Results</th>
                                                 
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr>
                                                 
                                                  <td class="left strong"> BLOOD GROUP RESULT </td>
                                                  <td class="left"><?php echo $get_blood ?></td> 
                                              </tr>


 


                                          </tbody>
                                      </table>
                                  </div>


                                  <?php 
                                
                               
                                $divSaparateLine = '<div style="width:auto; background-color:#cff1ff; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
                                                           echo $divSaparateLine
                                                           ?>
                           <?php }

else if (investigation_name($lab_test) == "URIC ACID") {
  ?>


<div class="table-responsive-sm">
                                      <table class="table table-striped">


                                      <div class="header">							
                              <h4><?php echo investigation_name($lab_test)." "; 

$get_level_URIC_ACID = get_level_URIC_ACID($patient_id,$lab_code);

$get_level_URIC_ACID = $get_level_URIC_ACID['URIC_ACID_LEVEL'];
//S_CREATININE
   
if($get_level_URIC_ACID >= 140 && $get_level_URIC_ACID <= 340){
  $URIC_RESULTS = "";
}elseif($get_level_URIC_ACID < 140){
  $URIC_RESULTS = "L";
}else {
  $URIC_RESULTS = "<b>H</b>";
}
 
        

                                                                  
                              ?></h4>
                              </div>
                                          <thead>
                                           
                                              <tr>
                                                  <th class="center">Test</th>
                                                 
                                                  <th>Results</th>
                                                  <th>Unit</th>
                                                  <th>Flag</th>
                                                  <th>Reference</th>
                                                 
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr>
                                                 
                                                  <td class="left strong"> URIC ACID RESULT </td>
                                                  <td class="left"><?php echo $get_level_URIC_ACID ?></td> 
                                                  <td class="left">mg/l</td> 
                                                  <td class="left"><?php echo $URIC_RESULTS ?></td> 
                                                  <td class="left">140 - 340</td> 
                                              </tr>


 


                                          </tbody>
                                      </table>
                                  </div>


                                  <?php 
                                
                               
                                $divSaparateLine = '<div style="width:auto; background-color:#cff1ff; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
                                                           echo $divSaparateLine
                                                           ?>
                           <?php }

else if (investigation_name($lab_test) == "CRP") {
  ?>


<div class="table-responsive-sm">
                                      <table class="table table-striped">


                                      <div class="header">							
                              <h4><?php echo investigation_name($lab_test)." "; 


$get_level_crp = get_level_crp($patient_id,$lab_code);

$CRP_LEVEL = $get_level_crp['CRP_LEVEL'];
$evaluation_crp = $get_level_crp['evaluation'];
 
        

                                                                  
                              ?></h4>
                              </div>
                                          <thead>
                                           
                                              <tr>
                                                  <th class="center">Test</th>
                                                 
                                                  <th>Results</th>
                                                  <th>Unit</th>
                                                  <th>Flag</th>
                                                  <th>Reference</th>
                                                 
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr>
                                                 
                                                  <td class="left strong"> CRP RESULT </td>
                                                  <td class="left"><?php echo $CRP_LEVEL ?></td> 
                                                  <td class="left">mg/l</td> 
                                                  <td class="left"><?php echo $evaluation_crp ?></td> 
                                                  <td class="left"> 0 - 10 </td> 
                                              </tr>


 


                                          </tbody>
                                      </table>
                                  </div>


                                  <?php 
                                
                               
                                $divSaparateLine = '<div style="width:auto; background-color:#cff1ff; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
                                                           echo $divSaparateLine
                                                           ?>
                           <?php }


else if (investigation_name($lab_test) == "SICKLING") {
  ?>


<div class="table-responsive-sm">
                                      <table class="table table-striped">


                                      <div class="header">							
                              <h4><?php echo investigation_name($lab_test)." "; 

$SICKLING_TEST = SICKLING_TEST($patient_id,$lab_code);
        

                                                                  
                              ?></h4>
                              </div>
                                          <thead>
                                           
                                              <tr>
                                                  <th class="center">Test</th>
                                                 
                                                  <th>Results</th>
                                                
                                                  
                                                  <th class="right">Reference</th> 
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr>
                                                 
                                                  <td class="left strong"> SICKLING </td>
                                                  <td class="left"><?php echo $SICKLING_TEST['test_status'] ?></td>
                                                  
                                           
                                                  <td class="right">-</td>
                                              </tr>

                                             



                                          </tbody>
                                      </table>
                                  </div>


                                  <?php 
                                
                               
                                $divSaparateLine = '<div style="width:auto; background-color:#cff1ff; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
                                                           echo $divSaparateLine
                                                           ?>
                           <?php }

else if (investigation_name($lab_test) == "SYPHILLIS") {
  ?>


<div class="table-responsive-sm">
                                      <table class="table table-striped">


                                      <div class="header">							
                              <h4><?php echo "SYPHILLIS "; 
$SYPHILLIS_TEST = SYPHILLIS_TEST($patient_id,$lab_code);
        

                                                                  
                              ?></h4>
                              </div>
                                          <thead>
                                           
                                              <tr>
                                                  <th class="center">Test</th>
                                                 
                                                  <th>Results</th>
                                                
                                                  
                                                  <th class="right">Reference</th> 
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr>
                                                 
                                                  <td class="left strong"> SYPHILLIS </td>
                                                  <td class="left"><?php echo $SYPHILLIS_TEST['test_status'] ?></td>
                                                  
                                           
                                                  <td class="right">-</td>
                                              </tr>

                                             



                                          </tbody>
                                      </table>
                                  </div>


                                  <?php 
                                
                               
                                $divSaparateLine = '<div style="width:auto; background-color:#cff1ff; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
                                                           echo $divSaparateLine
                                                           ?>
                           <?php }

                           
else if (investigation_name($lab_test) == "H.PYLORI(SERUM)") {
  ?>


<div class="table-responsive-sm">
                                      <table class="table table-striped">


                                      <div class="header">							
                              <h4><?php echo "H.PYLORI(SERUM)"; 
$H_PYLORI_SERUM__TEST = H_PYLORI_SERUM__TEST($patient_id,$lab_code);
        

                                                                  
                              ?></h4>
                              </div>
                                          <thead>
                                           
                                              <tr>
                                                  <th class="center">Test</th>
                                                 
                                                  <th>Results</th>
                                                
                                                  
                                                  <th class="right">Reference</th> 
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr>
                                                 
                                                  <td class="left strong"> H.PYLORI(SERUM) TEST </td>
                                                  <td class="left"><?php echo $H_PYLORI_SERUM__TEST['test_status'] ?></td>
                                                  
                                           
                                                  <td class="right">-</td>
                                              </tr>

                                             



                                          </tbody>
                                      </table>
                                  </div>


                                  <?php 
                                
                               
                                $divSaparateLine = '<div style="width:auto; background-color:#cff1ff; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
                                                           echo $divSaparateLine
                                                           ?>
                           <?php }

else if (investigation_name($lab_test) == "H.PYLORI(STOOL)") {
  ?>


<div class="table-responsive-sm">
                                      <table class="table table-striped">


                                      <div class="header">							
                              <h4><?php echo "H.PYLORI(STOOL)"; 
$H_PYLORI_STOOL__TEST = H_PYLORI_STOOL__TEST($patient_id,$lab_code);
        

                                                                  
                              ?></h4>
                              </div>
                                          <thead>
                                           
                                              <tr>
                                                  <th class="center">Test</th>
                                                 
                                                  <th>Results</th>
                                                
                                                  
                                                  <th class="right">Reference</th> 
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr>
                                                 
                                                  <td class="left strong"> H.PYLORI(STOOL) </td>
                                                  <td class="left"><?php echo $H_PYLORI_STOOL__TEST['test_status'] ?></td>
                                                  
                                           
                                                  <td class="right">-</td>
                                              </tr>

                                             



                                          </tbody>
                                      </table>
                                  </div>


                                  <?php 
                                
                               
                                $divSaparateLine = '<div style="width:auto; background-color:#cff1ff; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
                                                           echo $divSaparateLine
                                                           ?>
                           <?php }         

else if (investigation_name($lab_test) == "GENOTYPE") {
  ?>


<div class="table-responsive-sm">
                                      <table class="table table-striped">


                                      <div class="header">							
                              <h4><?php echo "GENOTYPE"; 
$GENOTYPE_TEST = GENOTYPE_TEST($patient_id,$lab_code);
        

                                                                  
                              ?></h4>
                              </div>
                                          <thead>
                                           
                                              <tr>
                                                  <th class="center">Test</th>
                                                 
                                                  <th>Results</th>
                                                
                                                  
                                                  <th class="right">Reference</th> 
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr>
                                                 
                                                  <td class="left strong"> GENOTYPE </td>
                                                  <td class="left"><?php echo $GENOTYPE_TEST['test_status'] ?></td>
                                                  
                                           
                                                  <td class="right">-</td>
                                              </tr>

                                             



                                          </tbody>
                                      </table>
                                  </div>


                                  <?php 
                                
                               
                                $divSaparateLine = '<div style="width:auto; background-color:#cff1ff; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
                                                           echo $divSaparateLine
                                                           ?>
                           <?php }



else if (investigation_name($lab_test) == "HB ELECTROPHORESIS") {
  ?>


<div class="table-responsive-sm">
                                      <table class="table table-striped">


                                      <div class="header">							
                              <h4><?php echo "HB ELECTROPHORESIS"; 

$get_hb_electrophoresis = get_hb_electrophoresis($patient_id,$lab_code);
        

                                                                  
                              ?></h4>
                              </div>
                                          <thead>
                                           
                                              <tr>
                                                  <th class="center">Test</th>
                                                 
                                                  <th>Results</th>
                                                
                                                  
                                                  <th class="right">Reference</th> 
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr>
                                                 
                                                  <td class="left strong"> SICKLING </td>
                                                  <td class="left"><?php echo $get_hb_electrophoresis['SICKLING'] ?></td>
                                                  
                                           
                                                  <td class="right">-</td>
                                              </tr>


                                              <tr>
                                                 
                                                 <td class="left strong"> GENOTYPE </td>
                                                 <td class="left"><?php echo $get_hb_electrophoresis['GENOTYPE'] ?></td>
                                                 
                                          
                                                 <td class="right">-</td>
                                             </tr>

                                             



                                          </tbody>
                                      </table>
                                  </div>

                                  <?php 
                                
                               
                                $divSaparateLine = '<div style="width:auto; background-color:#cff1ff; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
                                                           echo $divSaparateLine
                                                           ?>

                           <?php }

else if (investigation_name($lab_test) == "BLOOD FILM FOR MALARIA") {
  ?>


<div class="table-responsive-sm">
                                      <table class="table table-striped">


                                      <div class="header">							
                              <h4><?php echo "BLOOD FILM FOR MALARIA"; 

$get_blood_film_for_malaria = get_blood_film_for_malaria($patient_id,$lab_code);
        

                                                                  
                              ?></h4>
                              </div>
                                          <thead>
                                           
                                              <tr>
                                                  <th class="center">Test</th>
                                                 
                                                  <th>Results</th>
                                                
                                                  
                                                  <th class="right">Reference</th> 
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr>
                                                 
                                                  <td class="left strong"> BLOOD FILM FOR MALARIA </td>
                                                  <td class="left"><?php echo $get_blood_film_for_malaria['film_status'] ?></td>
                                                  
                                           
                                                  <td class="right">-</td>
                                              </tr>


                                             

                                             



                                          </tbody>
                                      </table>
                                  </div>

                                  <?php 
                                
                               
                                $divSaparateLine = '<div style="width:auto; background-color:#cff1ff; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
                                                           echo $divSaparateLine
                                                           ?>

                           <?php }
                               
                             ?>

                                    
                                    


                                    <?php }


      
      
      
      
      
      
      
?>


                                </div>



                           
                                   
                                <div class="float-right">
                                    <p class="mb-0">..........................................</p>
                                    <p class="mb-0"><h5>Biomedical Scienstist</h5></p>
                                </div>

 
<br/>
                               

                                <div style="margin-top: 40px;" class="card-footer bg-white">
                                    <p class="mb-0">Hospital software by smartcareaid.com, Mobile: 024-998-5804 / 026-764-2898</p>
                                    <button onclick="window.print()"><i class='fa fa-print'></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
 
 
 
</body>

<!-- 
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->



</html>
