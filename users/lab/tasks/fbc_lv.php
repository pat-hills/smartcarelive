<?php

session_start();
if(!isset($_SESSION['uid'])){
  header("Location: ../../../index");
}


//ini_set('display_errors', 0);



ob_start();


require_once '../../../functions/conndb.php';
require_once '../../../functions/func_search.php';
//require_once '../../../functions/func_consulting.php';
require_once '../../../functions/func_common.php';
require_once '../../../functions/func_nhis.php';
require_once '../../../functions/func_lab.php';
require_once '../../../tcpdf/tcpdf.php';


$staff_id = $_SESSION['uid']; 
$lab_code =  $_GET['lab_code'];
$patient_id = $_GET['patient_id'];
//$provider =  $_SESSION['claim_provider']; ;

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

  

class MYPDF extends TCPDF {

    //Page header
    var $top_margin = 20;
    public function Header() {
       // set top margin to style pages 2, 3..
       //title goes here
       $this->top_margin = $this->GetY() + 5; // padding for second page
        
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-20);
        // Set font
        $this->SetFont('helvetica', '', 9);
        // Page number
//        date_default_timezone_set("Africa/Accra");
//        $this->Cell(0, 10, date("d/m/Y h:i:sa") . " " . 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');

//$takeNote = "<strong><u>DECLARATION:</u></strong>";
         $divSaparatefoot = '<div style="width:auto; background-color:mintcream; height:5px;  border-bottom:3px solid #ddd;padding-bottom:33px;">'.'</div>';
    
       // $horizontalLine = "<hr style=background:burlywood; height: 5px; />";
        $space = "<p></p>";
      //  $msg = "<strong>I declare</strong>  <strong></strong>, this is a true and valid claim for the said patient for the duration. <br/> Anything else renders this report invalid.";
        //$info = "2. All fees must be paid on or before the <strong>re-opening date</strong>.";
     
        $company = "<strong><em>Software by SmartCareAid.com, Mobile: 024-998-5804 / 026-764-2898</em></strong>";

 
       // $space = "<p></p>";

     //   $md_image_sign_url = "../../../institution_images/md_signature.jpg";

      //  $getSignatureURL = "../" . $getSignatureName["signature_url"];


       

        
       

        //$this->writeHTML($divSaparatefoot, true, 0, true, 0);
       // $this->writeHTML($takeNote, true, 0, true, 0);
       // $this->writeHTML($space, true, 0, true, 0);
       // $this->writeHTML($msg, true, 0, true, 0);
       // $this->writeHTML($info, true, 0, true, 0);
        //$this->writeHTML($space, true, 0, true, 0);


      // $this->Image($md_image_sign_url, 153, 265, 55, 35, '', '', '', true, 150, '', false, false, 0, false, false, false);

       $tbl_head_sign = '<table cellspacing = "0" cellpadding = "0" border = "0">';
       $tbl_foot_sign = '</table>';
       $tbl_sign = '';

       $tbl_sign .= '
       <tbody>
         <tr>
            <td style="width: 100%; text-align: right;">' . "........................................................" . '</td>
         </tr>
         
         <tr>
            <td style="width: 100%; text-align: right;">' . "<strong>Biomedical Scienstist</strong>" . '</td>
         </tr>
       </tbody>';

       $this->writeHTML($tbl_head_sign . $tbl_sign . $tbl_foot_sign, FALSE, false, true, false, '');

     
        $this->writeHTML($company, true, 0, true, 0, 'R');
    }

}

$pdf = new MYPDF("", PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);



// $pdf ->setPage("");

//$pdf->setPageOrientation(Portrait,TRUE,99);
 
// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . "/lang/eng.php")) {
    require_once(dirname(__FILE__) . "/lang/eng.php");
    $pdf->setLanguageArray($l);
}

// set font
$pdf->SetFont('times', '', 11);

   
     $pdf->AddPage();
    $pdf->startPageGroup();
   
    $pdf->setJPEGQuality(75); 

    ///STARTING THE PROCESSING OF CLAIMS

 

    ////ENDING THE PROCESS

   
 
 
  
    $schoolLogo = "../../../institution_images/clinic_logo.png";

    $heading = "<h1 style='color: #00193a' >" . $hospital_name . "</h1>";
    
    $add = "<span>" . $postal_address . "</span><br />"
            . "<span>" . $join_telephone . "</span>";
    
    
    $pdf->Image($schoolLogo, 5, 7, 40, 21, '', '', '', true, 450, '', false, false, 0, false, false, false);
    
    $sik_head_heading = '<table cellspacing = "0" cellpadding = "5">';
    $sik_foot_heading = '</table>';
    $sik_heading = '';
    
    $sik_heading .= '
    <tbody>
           
          <tr >
          
                  <td style="text-align: center;  color: #666;" colspan="4"></td>
        <td style="text-align: left; color: #666;" colspan="4">' . $heading . '</td>
                 <td style="text-align: left;  color: #666;" colspan="4">' . $add . '</td>
          </tr >
    </tbody>' .
            '<hr style="color: #666"/>';
    
    
    $pdf->writeHTML($sik_head_heading . $sik_heading . $sik_foot_heading, true, false, true, false, '');

    $className ='<div style="width:auto; background-color:grey;">'.'<b>'. '<strong style="color:#fff; font-size:12px">'. htmlentities("Patient Lab Report") . '</strong>'.'</b>'.'</div>';
    $pdf->writeHTML($className, true, 0, true, 0, 'C');
    // $horizontalLineII = '<hr style="">'.'</hr>';
    
    $divSaparate = '<div style="width:auto; background-color:#cff1ff; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
    $pdf->writeHTML($divSaparate);
     
     //$pdf->writeHTML($horizontalLineII);
    $headingSpace = "<div></div>";
    $pdf->writeHTML($headingSpace, true, 0, true, 0);

    //$horizontalLine = "<hr style='background-color:burlywood; height: 5px;'>"."</hr>";
    
     $divSaparateLine = '<div style="width:auto; background-color:#cff1ff; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';

     $divSaparateLine2 = '<div style="width:auto; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
    
 
     $patient_details = get_patient_data_details($patient_id);
     $fullname = $patient_details['surname']." ".$patient_details['other_names'];
     $gender = $patient_details['sex'];
     $age = get_age_pdf($patient_details['dob']);

     $request_test = patient_investigation_name_by_code($lab_code,$patient_id);

     
     $date_sent_ = $request_test['requested_date'];
         
        
     $date_convert = date('jS M, Y', strtotime("$date_sent_")).", ".date('l', strtotime("$date_sent_"));

     $staff_id = get_staff_info($request_test['doctor_id']);

     $requested_by = "Dr, ". $staff_id['firstName']." ".$staff_id['otherNames'];
    
   // $pdf ->setPage($getStudentData);

    $tbl_head_title = '<table cellspacing = "10" cellpadding = "0" border = "0">';
    $tbl_foot_title = '</table>';
    $tbl_title = '';

    $tbl_title .= '
    <tbody>
     
    <tr style="color: #000;">
    <td style="text-align: left; width: 15%"><strong>Name:</strong></td>
    <td style="text-align: left;  font-weight:bold;margin:5px; border-bottom:1.5px solid #ddd;padding-bottom:3px;">' .$fullname.'</td>
    </tr>

    <tr style="color: #000;">
    <td style="text-align: left; width: 15%;"><strong>Patient ID:</strong></td>
    <td style="text-align: left;  font-weight:bold;margin:5px; border-bottom:1.5px solid #ddd;padding-bottom:3px;">' .$patient_id.'</td>
 </tr>

 <tr style="color: #000;">
 <td style="text-align: left; width: 15%;"><strong>Gender:</strong></td>
 <td style="text-align: left;  font-weight:bold;margin:5px; border-bottom:1.5px solid #ddd;padding-bottom:3px;">' .$gender.'</td>
</tr>
 
<tr style="color: #000;">
<td style="text-align: left; width: 15%;"><strong>Request test(s):</strong></td>
<td style="text-align: left;  font-weight:bold;margin:5px; border-bottom:1.5px solid #ddd;padding-bottom:3px;">' .$request_test['request_test_name'].'</td>
</tr>

<tr style="color: #000;">
<td style="text-align: left; width: 15%;"><strong>Request date:</strong></td>
<td style="text-align: left;  font-weight:bold;margin:5px; border-bottom:1.5px solid #ddd;padding-bottom:3px;">' .$date_convert.'</td>
</tr>

<tr style="color: #000;">
<td style="text-align: left; width: 15%;"><strong>Requested by:</strong></td>
<td style="text-align: left;  font-weight:bold;margin:5px; border-bottom:1.5px solid #ddd;padding-bottom:3px;">' .$requested_by.'</td>
</tr>

<tr style="color: #000;">
<td style="text-align: left; width: 15%;"><strong>Lab code:</strong></td>
<td style="text-align: left;  font-weight:bold;margin:5px; border-bottom:1.5px solid #ddd;padding-bottom:3px;">' .$lab_code.'</td>
</tr>

    </tbody>';

    $pdf->writeHTML($tbl_head_title . $tbl_title . $tbl_foot_title, FALSE, false, true, false, '');

    $pdf->writeHTML($divSaparateLine, true, 0, true, 0);


    //FOR EACH SHOULD START FROM HERE

    
foreach ($get_lab_requests_to_view as $lab_test) {

 
if(investigation_name($lab_test)== "FBC"){
     // $pdf->AddPage();

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
  
  
   
  
  
     
  
   
      
      
  
    
    
    $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
    $tbl_foot_description = '</table>';
    $tbl_description = '';
    $TestHeader = "FBC Test";
    
    $tbl_description .= '
        <tbody>
          <tr style="color: #000;">
              
             <td style="width: 25%; text-align: left;">' . "<strong>".$TestHeader."</strong>" . '</td>
             
          </tr>
        </tbody>';
    
    $pdf->writeHTML($tbl_head_description . $tbl_description . $tbl_foot_description, FALSE, false, true, false, '');
     
    
    
    $tbl_head_item = '<table cellspacing = "1" cellpadding = "0" border = "0">';
    $tbl_foot_item = '</table>';
    $tbl_item = '';
    
    $tbl_item .= '
    <tbody>
      <tr style="color: #000;">
         <td style="width: 32%;"><b>Test</b></td> 
         <td style="width: 18%;"><b>Results</b></td>
         <td style="width: 10%;"><b>Unit</b></td>
         <td style="width: 20%;"><b>Evaluation</b></td>
         <td style="width: 20%;"><b>Reference</b></td>
          
         
        
      </tr>
    </tbody>';
    
    $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');
    
     
        

      
        $tbl_head_item = '<table cellspacing = "1" cellpadding = "0" border = "0">';
        $tbl_foot_item = '</table>';
        $tbl_item = '';
      
        $tbl_item .= '
        <tbody>
    
          <tr style="color: #000;">
             <td style="width: 32%;">'."WHITE BLOOD CELLS (WBC)".'</td> 
             <td style="width: 18%;">'.$WBC.'</td>
             <td style="width: 10%;">'.'µL'.'</td>
             <td style="width: 20%;">'.$WBC_RESULTS.'</td>
             <td style="width: 20%;">'.$ref_range_WBC.'</td> 
          </tr>
    
          <tr style="color: #000;">
          <td style="width: 32%;">'."Lymphocytes #".'</td> 
          <td style="width: 18%;">'.$Lymphocytes_hash.'</td>
          <td style="width: 10%;">'.'µL'.'</td>
          <td style="width: 20%;">'.$Lymphocytes_hash_RESULTS.'</td>
          <td style="width: 20%;">'.$ref_range_Lymphocytes_hash.'</td> 
          </tr>

          <tr style="color: #000;">
          <td style="width: 32%;">'."Mid#".'</td> 
          <td style="width: 18%;">'.$mid_hash.'</td>
          <td style="width: 10%;">'.'µL'.'</td>
          <td style="width: 20%;">'.$mid_hash_RESULTS.'</td>
          <td style="width: 20%;">'."0.10 – 1.50 x 10^9/µL".'</td> 
          </tr>

           

          <tr style="color: #000;">
          <td style="width: 32%;">'."Gran#".'</td> 
          <td style="width: 18%;">'.$gran_hash.'</td>
          <td style="width: 10%;">'.'µL'.'</td>
          <td style="width: 20%;">'.$gran_hash_RESULTS.'</td>
          <td style="width: 20%;">'.$ref_range_gran_hash.'</td> 
          </tr>

          <tr style="color: #000;">
          <td style="width: 32%;">'."%Lymphocytes".'</td> 
          <td style="width: 18%;">'.$Lymphocytes_percent.'</td>
          <td style="width: 10%;">'.'µL'.'</td>
          <td style="width: 20%;">'.$Lymphocytes_percent_RESULTS.'</td>
          <td style="width: 20%;">'.$ref_range_Lymphocytes_percent.'</td> 
          </tr>

          <tr style="color: #000;">
          <td style="width: 32%;">'."%Mid".'</td> 
          <td style="width: 18%;">'.$mid_percent.'</td>
          <td style="width: 10%;">'.'%'.'</td>
          <td style="width: 20%;">'.$mid_percent_RESULTS.'</td>
          <td style="width: 20%;">'."0.030 – 0.150%".'</td> 
          </tr>

          
          <tr style="color: #000;">
          <td style="width: 32%;">'."%Gran".'</td> 
          <td style="width: 18%;">'.$gran_percent.'</td>
          <td style="width: 10%;">'.'%'.'</td>
          <td style="width: 20%;">'.$gran_percent_RESULTS.'</td>
          <td style="width: 20%;">'."0.500 – 0.700%".'</td> 
          </tr>


          
          <tr style="color: #000;">
          <td style="width: 32%;">'."RBC".'</td> 
          <td style="width: 18%;">'.$RBC.'</td>
          <td style="width: 10%;">'.'µL'.'</td>
          <td style="width: 20%;">'.$RBC_RESULTS.'</td>
          <td style="width: 20%;">'.$ref_range_RBC.'</td> 
          </tr>


                    
          <tr style="color: #000;">
          <td style="width: 32%;">'."HGB".'</td> 
          <td style="width: 18%;">'.$HGB.'</td>
          <td style="width: 10%;">'.'g/dL'.'</td>
          <td style="width: 20%;">'.$HGB_RESULTS.'</td>
          <td style="width: 20%;">'.$ref_range_HGB.'</td> 
          </tr>

          <tr style="color: #000;">
          <td style="width: 32%;">'."HCT".'</td> 
          <td style="width: 18%;">'.$HCT.'</td>
          <td style="width: 10%;">'.'%'.'</td>
          <td style="width: 20%;">'.$HCT_RESULTS.'</td>
          <td style="width: 20%;">'.$ref_range_HCT.'</td> 
          </tr>

          <tr style="color: #000;">
          <td style="width: 32%;">'."MCV".'</td> 
          <td style="width: 18%;">'.$MCV.'</td>
          <td style="width: 10%;">'.'fL'.'</td>
          <td style="width: 20%;">'.$MCV_RESULTS.'</td>
          <td style="width: 20%;">'."80 – 100 fL".'</td> 
          </tr>

          <tr style="color: #000;">
          <td style="width: 32%;">'."MCH".'</td> 
          <td style="width: 18%;">'.$MCH.'</td>
          <td style="width: 10%;">'.'pg'.'</td>
          <td style="width: 20%;">'.$MCH_RESULTS.'</td>
          <td style="width: 20%;">'."27.0 - 34.0".'</td> 
          </tr>

          <tr style="color: #000;">
          <td style="width: 32%;">'."MCHC".'</td> 
          <td style="width: 18%;">'.$MCHC.'</td>
          <td style="width: 10%;">'.'g/dL'.'</td>
          <td style="width: 20%;">'.$MCHC_RESULTS.'</td>
          <td style="width: 20%;">'.$ref_range.'</td> 
          </tr>


          <tr style="color: #000;">
          <td style="width: 32%;">'."RDW-CV".'</td> 
          <td style="width: 18%;">'.$RDW_CV.'</td>
          <td style="width: 10%;">'.'%'.'</td>
          <td style="width: 20%;">'.$RDW_CV_RESULTS.'</td>
          <td style="width: 20%;">'."0.11 – 0.16%".'</td> 
          </tr>


          <tr style="color: #000;">
          <td style="width: 32%;">'."RDW-SD".'</td> 
          <td style="width: 18%;">'.$RDW_SD.'</td>
          <td style="width: 10%;">'.'fL'.'</td>
          <td style="width: 20%;">'.$RDW_SD_RESULTS.'</td>
          <td style="width: 20%;">'."35.0 – 56 .0fL".'</td> 
          </tr>



          <tr style="color: #000;">
          <td style="width: 32%;">'."PLT".'</td> 
          <td style="width: 18%;">'.$PLT.'</td>
          <td style="width: 10%;">'.'µL'.'</td>
          <td style="width: 20%;">'.$PLT_RESULTS.'</td>
          <td style="width: 20%;">'."100 – 300 x 10^3/µL".'</td> 
          </tr>

          <tr style="color: #000;">
          <td style="width: 32%;">'."MPV".'</td> 
          <td style="width: 18%;">'.$MPV.'</td>
          <td style="width: 10%;">'.'fL'.'</td>
          <td style="width: 20%;">'.$MPV_RESULTS.'</td>
          <td style="width: 20%;">'."6.5 – 12.0fL".'</td> 
          </tr>

          <tr style="color: #000;">
          <td style="width: 32%;">'."PDW".'</td> 
          <td style="width: 18%;">'.$PDW.'</td>
          <td style="width: 10%;">'.'fL'.'</td>
          <td style="width: 20%;">'.$PDW_RESULTS.'</td>
          <td style="width: 20%;">'."15.0 – 17.0fL".'</td> 
          </tr>


          <tr style="color: #000;">
          <td style="width: 32%;">'."PCT".'</td> 
          <td style="width: 18%;">'.$PCT.'</td>
          <td style="width: 10%;">'.'mL/L'.'</td>
          <td style="width: 20%;">'.$PCT_RESULTS.'</td>
          <td style="width: 20%;">'."1.08 – 2.82 mL/L".'</td> 
          </tr>
 

        </tbody>';

        
      
        $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');
    
     //  $space = "<p></p>";
    
       // $pdf->writeHTML($space, true, 0, true, 0);
        
    $pdf->writeHTML($divSaparateLine, true, 0, true, 0);
    
       }

     





  
  
  }


$pdf->lastPage();

ob_end_clean();

$pdf->Output();





