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
    public function Header() {
        
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

        $md_image_sign_url = "../../../institution_images/md_signature.jpg";

      //  $getSignatureURL = "../" . $getSignatureName["signature_url"];


       

        
       

        //$this->writeHTML($divSaparatefoot, true, 0, true, 0);
       // $this->writeHTML($takeNote, true, 0, true, 0);
       // $this->writeHTML($space, true, 0, true, 0);
       // $this->writeHTML($msg, true, 0, true, 0);
       // $this->writeHTML($info, true, 0, true, 0);
        //$this->writeHTML($space, true, 0, true, 0);


       $this->Image($md_image_sign_url, 153, 265, 55, 35, '', '', '', true, 150, '', false, false, 0, false, false, false);

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

   
 
 
  
    $schoolLogo = "../../../institution_images/logo.png";

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
    
    $divSaparate = '<div style="width:auto; background-color:mintcream; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
    $pdf->writeHTML($divSaparate);
     
     //$pdf->writeHTML($horizontalLineII);
    $headingSpace = "<div></div>";
    $pdf->writeHTML($headingSpace, true, 0, true, 0);

    //$horizontalLine = "<hr style='background-color:burlywood; height: 5px;'>"."</hr>";
    
     $divSaparateLine = '<div style="width:auto; background-color:mintcream; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';

     $divSaparateLine2 = '<div style="width:auto; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
    
 
     $patient_details = get_patient_data_details($patient_id);
     $fullname = $patient_details['surname']." ".$patient_details['other_names'];
     $gender = $patient_details['sex'];

     $request_test = patient_investigation_name_by_code($lab_code,$patient_id);

     
     $date_sent_ = $request_test['requested_date'];
         
        
     $date_convert = date('jS M, Y', strtotime("$date_sent_")).", ".date('l', strtotime("$date_sent_"));


     if($_SESSION['uid'] == $request_test['doctor_id']){
       $requested_by = "You";
     }else{
      $staff_id = get_staff_info($request_test['doctor_id']);

      $requested_by = "Dr, ". $staff_id['firstName']." ".$staff_id['otherNames'];

     }

    
    
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

 
if(investigation_name($lab_test)== "Urine RE"){

  $get_urine_re = urine_re($patient_id,$lab_code);


$tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
$tbl_foot_description = '</table>';
$tbl_description = '';
$TestHeader = "Urine RE Test";

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
     <td style="width: 40%;"><b>Test</b></td> 
     <td style="width: 40%;"><b>Results</b></td>
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
         <td style="width: 40%;">'."Urine Appearance".'</td> 
         <td style="width: 40%;">'.$get_urine_re['appearance'].'</td>
         <td style="width: 20%;">'."_".'</td> 
      </tr>


      <tr style="color: #000;">
      <td style="width: 40%;">'."Colour".'</td> 
      <td style="width: 40%;">'.$get_urine_re['colour'].'</td>
      <td style="width: 20%;">'."_".'</td>     
     </tr>

     
     <tr style="color: #000;">
     <td style="width: 40%;">'."Specific gravity".'</td> 
     <td style="width: 40%;">'.$get_urine_re['specific_gravity'].'</td>
     <td style="width: 20%;">'."_".'</td>     
    </tr>

    
    <tr style="color: #000;">
    <td style="width: 40%;">'."pH".'</td> 
    <td style="width: 40%;">'.$get_urine_re['ph'].'</td>
    <td style="width: 20%;">'."_".'</td>     
   </tr>


   <tr style="color: #000;">
   <td style="width: 40%;">'."Protein".'</td> 
   <td style="width: 40%;">'.$get_urine_re['protein'].'</td>
   <td style="width: 20%;">'."_".'</td>     
  </tr>


  
  <tr style="color: #000;">
  <td style="width: 40%;">'."Glucose".'</td> 
  <td style="width: 40%;">'.$get_urine_re['glucose'].'</td>
  <td style="width: 20%;">'."_".'</td>     
 </tr>


 
 <tr style="color: #000;">
 <td style="width: 40%;">'."Ketones".'</td> 
 <td style="width: 40%;">'.$get_urine_re['ketones'].'</td>
 <td style="width: 20%;">'."_".'</td>     
</tr>


<tr style="color: #000;">
<td style="width: 40%;">'."Blood".'</td> 
<td style="width: 40%;">'.$get_urine_re['blood'].'</td>
<td style="width: 20%;">'."_".'</td>     
</tr>

<tr style="color: #000;">
<td style="width: 40%;">'."Nitrite".'</td> 
<td style="width: 40%;">'.$get_urine_re['nitrite'].'</td>
<td style="width: 20%;">'."_".'</td>     
</tr>

<tr style="color: #000;">
<td style="width: 40%;">'."Bilirubin".'</td> 
<td style="width: 40%;">'.$get_urine_re['bilirubin'].'</td>
<td style="width: 20%;">'."_".'</td>     
</tr>


<tr style="color: #000;">
<td style="width: 40%;">'."Urobilinogen".'</td> 
<td style="width: 40%;">'.$get_urine_re['urobilinogen'].'</td>
<td style="width: 20%;">'."_".'</td>     
</tr>


    </tbody>';
  
    $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

    $space = "<p></p>";

    $pdf->writeHTML($space, true, 0, true, 0);
    
$pdf->writeHTML($divSaparateLine, true, 0, true, 0);

   }

   //Starting LFT PROCESSING



   elseif(investigation_name($lab_test)== "LFT"){

    $get_lft_results = get_lft_results($patient_id,$lab_code);

    $S_BILIRUBIN_Total = $get_lft_results['S_BILIRUBIN_Total'];
    $S_BILIRUBIN_conjugated = $get_lft_results['S_BILIRUBIN_conjugated'];
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

    if($S_BILIRUBIN_Total >= 3.42 && $S_BILIRUBIN_Total <= 20.5){
      $S_BILIRUBIN_Total_RESULTS = "";
    }elseif($S_BILIRUBIN_Total < 3.42){
      $S_BILIRUBIN_Total_RESULTS = "<b>L<b/>";
    }else {
      $S_BILIRUBIN_Total_RESULTS = "<b>H</b>";
    }


    if($S_BILIRUBIN_conjugated <=5){
      $S_BILIRUBIN_conjugated_RESULTS = "";
    }else{
      $S_BILIRUBIN_conjugated_RESULTS = "<b>H</b>";
    }

    if($S_ALKALINE_PHOSPHATASE >= 40 && $S_ALKALINE_PHOSPHATASE <= 130){
      $S_ALKALINE_PHOSPHATASE_RESULTS = "";
    }elseif($S_BILIRUBIN_Total < 40){
      $S_ALKALINE_PHOSPHATASE_RESULTS = "<b>L<b/>";
    }else {
      $S_ALKALINE_PHOSPHATASE_RESULTS = "<b>H</b>";
    }

    if($S_g_GLUTAMYL_TRANSFERASE <=55){
      $S_g_GLUTAMYL_TRANSFERASE_RESULTS = "";
    }else{
      $S_g_GLUTAMYL_TRANSFERASE_RESULTS = "<b>H</b>";
    }


    if($S_ALT_GPT >= 0 && $S_ALT_GPT <= 41){
      $S_ALT_GPT_RESULTS = "";
    }elseif($S_ALT_GPT < 41){
      $S_ALT_GPT_RESULTS = "<b>L<b/>";
    }else {
      $S_ALT_GPT_RESULTS = "<b>H</b>";
    }


    if($S_AST_GOT >= 0 && $S_AST_GOT <= 40){
      $S_AST_GOT_RESULTS = "";
    }elseif($S_AST_GOT < 0){
      $S_AST_GOT_RESULTS = "<b>L<b/>";
    }else {
      $S_AST_GOT_RESULTS = "<b>H</b>";
    }

    if($S_TOTAL_PROTEIN >= 64 && $S_TOTAL_PROTEIN <= 83){
      $S_TOTAL_PROTEIN_RESULTS = "";
    }elseif($S_TOTAL_PROTEIN < 64){
      $S_TOTAL_PROTEIN_RESULTS = "L";
    }else {
      $S_TOTAL_PROTEIN_RESULTS = "H";
    }


    if($S_ALBUMIN >= 39.7 && $S_ALBUMIN <= 49.5){
      $S_ALBUMIN_RESULTS = "";
    }elseif($S_ALBUMIN < 39.7){
      $S_ALBUMIN_RESULTS ="L";
    }else {
      $S_ALBUMIN_RESULTS = "H";
    }



  
  
  $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
  $tbl_foot_description = '</table>';
  $tbl_description = '';
  $TestHeader = "LFT Test";
  
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
       <td style="width: 15%;"><b>Unit</b></td>
       <td style="width: 20%;"><b>Evaluation</b></td>
       <td style="width: 15%;"><b>Reference</b></td>
        
       
      
    </tr>
  </tbody>';
  
  $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');
  
   
           
    
      $tbl_head_item = '<table cellspacing = "1" cellpadding = "0" border = "0">';
      $tbl_foot_item = '</table>';
      $tbl_item = '';
    
      $tbl_item .= '
      <tbody>
  
        <tr style="color: #000;">
           <td style="width: 32%;">'."S-BILIRUBIN (Total)".'</td> 
           <td style="width: 18%;">'.$S_BILIRUBIN_Total.'</td>
           <td style="width: 15%;">'.'umol/L'.'</td>
           <td style="width: 20%;">'.$S_BILIRUBIN_Total_RESULTS.'</td>
           <td style="width: 15%;">'." 3.42 - 20.5 ".'</td> 
        </tr>
  
  
        <tr style="color: #000;">
        <td style="width: 32%;">'."S-BILIRUBIN conjugated".'</td> 
        <td style="width: 18%;">'.$S_BILIRUBIN_conjugated.'</td>
        <td style="width: 15%;">'.'umol/L'.'</td>
        <td style="width: 20%;">'.$S_BILIRUBIN_conjugated_RESULTS.'</td>
        <td style="width: 15%;">'." < 5 ".'</td>     
       </tr>
  
       
       <tr style="color: #000;">
       <td style="width: 32%;">'."S-ALKALINE PHOSPHATASE".'</td> 
       <td style="width: 18%;">'.$S_ALKALINE_PHOSPHATASE.'</td>
       <td style="width: 15%;">'.'IU/L'.'</td>
       <td style="width: 20%;">'.$S_ALKALINE_PHOSPHATASE_RESULTS.'</td>
       <td style="width: 15%;">'." 40 - 130 ".'</td>     
      </tr>
  
      
      <tr style="color: #000;">
      <td style="width: 32%;">'."S-g-GLUTAMYL TRANSFERASE".'</td> 
      <td style="width: 18%;">'.$S_g_GLUTAMYL_TRANSFERASE.'</td>
      <td style="width: 15%;">'.'IU/L'.'</td>
      <td style="width: 20%;">'.$S_g_GLUTAMYL_TRANSFERASE_RESULTS.'</td>
      <td style="width: 15%;">'." < 55 ".'</td>     
     </tr>
  
  
     <tr style="color: #000;">
     <td style="width: 32%;">'."S-ALT (GPT) ".'</td> 
     <td style="width: 18%;">'.$S_ALT_GPT.'</td>
     <td style="width: 15%;">'.'IU/L'.'</td>
     <td style="width: 20%;">'.$S_ALT_GPT_RESULTS.'</td>
     <td style="width: 15%;">'." 0 - 41 ".'</td>     
    </tr>
  
  
    
    <tr style="color: #000;">
    <td style="width: 32%;">'."S-AST (GOT)".'</td> 
    <td style="width: 18%;">'.$S_AST_GOT.'</td>
    <td style="width: 15%;">'.'IU/L'.'</td>
    <td style="width: 20%;">'.$S_AST_GOT_RESULTS.'</td>
    <td style="width: 15%;">'." 0 - 40 ".'</td>     
   </tr>
  
  
   
   <tr style="color: #000;">
   <td style="width: 32%;">'."S-TOTAL PROTEIN".'</td> 
   <td style="width: 18%;">'.$S_TOTAL_PROTEIN.'</td>
   <td style="width: 15%;">'.'g/L'.'</td>
   <td style="width: 20%;">'.$S_TOTAL_PROTEIN_RESULTS.'</td>
   <td style="width: 15%;">'." 64 - 83 ".'</td>     
  </tr>
  
  
  <tr style="color: #000;">
  <td style="width: 32%;">'."S-ALBUMIN".'</td> 
  <td style="width: 18%;">'.$S_ALBUMIN.'</td>
  <td style="width: 15%;">'.'g/L'.'</td>
  <td style="width: 20%;">'.$S_ALBUMIN_RESULTS.'</td>
  <td style="width: 15%;">'." 39.7 - 49.5 ".'</td>     
  </tr>
  
  
   
  
   
  
      </tbody>';
    
      $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');
  
      $space = "<p></p>";
  
      $pdf->writeHTML($space, true, 0, true, 0);
      
  $pdf->writeHTML($divSaparateLine, true, 0, true, 0);
  
     }
     
     elseif(investigation_name($lab_test)== "FBC"){
 

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

  
      if($WBC >= 4 && $WBC <= 12){
        $WBC_RESULTS = "";
      }elseif($WBC < 4){
        $WBC_RESULTS = "<b>L<b/>";
      }else {
        $WBC_RESULTS = "<b>H</b>";
      }

      if($Lymphocytes_hash >= 0.8 && $Lymphocytes_hash <= 7){
        $Lymphocytes_hash_RESULTS = "";
      }elseif($Lymphocytes_hash < 0.8){
        $Lymphocytes_hash_RESULTS = "<b>L<b/>";
      }else {
        $Lymphocytes_hash_RESULTS = "<b>H</b>";
      }

      if($mid_hash >= 0.10 && $mid_hash <= 1.50){
        $mid_hash_RESULTS = "";
      }elseif($mid_hash < 0.10){
        $mid_hash_RESULTS = "<b>L<b/>";
      }else {
        $mid_hash_RESULTS = "<b>H</b>";
      }

      if($gran_hash >= 2 && $gran_hash <= 8){
        $gran_hash_RESULTS = "";
      }elseif($gran_hash < 2){
        $gran_hash_RESULTS = "<b>L<b/>";
      }else {
        $gran_hash_RESULTS = "<b>H</b>";
      }

      if($Lymphocytes_percent >= 0.20 && $Lymphocytes_percent <= 0.60){
        $Lymphocytes_percent_RESULTS = "";
      }elseif($Lymphocytes_percent < 0.20){
        $Lymphocytes_percent_RESULTS = "<b>L<b/>";
      }else {
        $Lymphocytes_percent_RESULTS = "<b>H</b>";
      }

      //	              0.030 – 0.150 


      if($mid_percent >= 0.030 && $mid_percent <= 0.150){
        $mid_percent_RESULTS = "";
      }elseif($mid_percent < 0.030){
        $mid_percent_RESULTS = "<b>L<b/>";
      }else {
        $mid_percent_RESULTS = "<b>H</b>";
      }


      //3.50 – 5.20 
      if($gran_percent >= 0.500 && $gran_percent <= 0.700){
        $gran_percent_RESULTS = "";
      }elseif($gran_percent < 0.500){
        $gran_percent_RESULTS = "<b>L<b/>";
      }else {
        $gran_percent_RESULTS = "<b>H</b>";
      }


      if($RBC >= 3.50 && $RBC <= 5.20){
        $RBC_RESULTS = "";
      }elseif($RBC < 3.50){
        $RBC_RESULTS = "<b>L<b/>";
      }else {
        $RBC_RESULTS = "<b>H</b>";
      }


      
      if($HGB >= 12.0 && $HGB <= 16.0){
        $HGB_RESULTS = "";
      }elseif($HGB < 12.0){
        $HGB_RESULTS = "L";
      }else {
        $HGB_RESULTS = "H";
      }


      
      if($HCT >= 0.35 && $HCT <= 0.49){
        $HCT_RESULTS = "";
      }elseif($HCT < 0.35){
        $HCT_RESULTS = "<b>L<b/>";
      }else {
        $HCT_RESULTS = "<b>H</b>";
      }

      if($MCV >= 80 && $MCV <= 100){
        $MCV_RESULTS = "";
      }elseif($MCV < 80){
        $MCV_RESULTS = "L";
      }else {
        $MCV_RESULTS = "<b>H</b>";
      }

      if($MCHC >= 310 && $MCHC <= 370){
        $MCHC_RESULTS = "";
      }elseif($MCHC < 310){
        $MCHC_RESULTS = "L";
      }else {
        $MCHC_RESULTS = "<b>H</b>";
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
             <td style="width: 20%;">'."4.0 – 12 x 10^9/µL (Child)<br/>4.0 – 12 x 10^9/µL (Adult)".'</td> 
          </tr>
    
          <tr style="color: #000;">
          <td style="width: 32%;">'."Lymphocytes #".'</td> 
          <td style="width: 18%;">'.$Lymphocytes_hash.'</td>
          <td style="width: 10%;">'.'µL'.'</td>
          <td style="width: 20%;">'.$Lymphocytes_hash_RESULTS.'</td>
          <td style="width: 20%;">'."0.8 –7 x 10^9/µL".'</td> 
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
          <td style="width: 20%;">'."2.0 – 8.0 x 10^9/µL".'</td> 
          </tr>

          <tr style="color: #000;">
          <td style="width: 32%;">'."%Lymphocytes".'</td> 
          <td style="width: 18%;">'.$Lymphocytes_percent.'</td>
          <td style="width: 10%;">'.'µL'.'</td>
          <td style="width: 20%;">'.$Lymphocytes_percent_RESULTS.'</td>
          <td style="width: 20%;">'."0.20 – 0.60".'</td> 
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
          <td style="width: 20%;">'."3.50 – 5.20 x 10^12/µL".'</td> 
          </tr>


                    
          <tr style="color: #000;">
          <td style="width: 32%;">'."HGB".'</td> 
          <td style="width: 18%;">'.$HGB.'</td>
          <td style="width: 10%;">'.'g/dL'.'</td>
          <td style="width: 20%;">'.$HGB_RESULTS.'</td>
          <td style="width: 20%;">'."12.0 – 16.0 g/dL".'</td> 
          </tr>

          <tr style="color: #000;">
          <td style="width: 32%;">'."HCT".'</td> 
          <td style="width: 18%;">'.$HCT.'</td>
          <td style="width: 10%;">'.'%'.'</td>
          <td style="width: 20%;">'.$HCT_RESULTS.'</td>
          <td style="width: 20%;">'."0.35 – 0.49%".'</td> 
          </tr>

          <tr style="color: #000;">
          <td style="width: 32%;">'."MCV".'</td> 
          <td style="width: 18%;">'.$MCV.'</td>
          <td style="width: 10%;">'.'fL'.'</td>
          <td style="width: 20%;">'.$MCV_RESULTS.'</td>
          <td style="width: 20%;">'."80 – 100 fL".'</td> 
          </tr>

          <tr style="color: #000;">
          <td style="width: 32%;">'."MCHC".'</td> 
          <td style="width: 18%;">'.$MCHC.'</td>
          <td style="width: 10%;">'.'g/dL'.'</td>
          <td style="width: 20%;">'.$MCHC_RESULTS.'</td>
          <td style="width: 20%;">'."310 – 370 g/dL".'</td> 
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
    
     //   $space = "<p></p>";
    
     //   $pdf->writeHTML($space, true, 0, true, 0);
        
   // $pdf->writeHTML($divSaparateLine, true, 0, true, 0);
    
       }

       elseif(investigation_name($lab_test)== "LIPID PROFILE"){
 

        $get_lipid_profile_results = get_lipid_profile_results($patient_id,$lab_code);
    
        $TOTAL_CHOLESTEROL = $get_lipid_profile_results['TOTAL_CHOLESTEROL'];
        $TRIGLYCERIDES = $get_lipid_profile_results['TRIGLYCERIDES'];
        $HDL_CHOLESTEROL = $get_lipid_profile_results['HDL_CHOLESTEROL'];
        $LDL_CHOLESTEROL = $get_lipid_profile_results['LDL_CHOLESTEROL'];
         
  
  
  
    
        $TOTAL_CHOLESTEROL_RESULTS; 
        $TRIGLYCERIDES_RESULTS;
        $HDL_CHOLESTEROL_RESULTS; 
        $LDL_CHOLESTEROL_RESULTS;

         
  
    
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
      
      $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
      $tbl_foot_description = '</table>';
      $tbl_description = '';
      $TestHeader = "LIPID PROFILE Test";
      
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
               <td style="width: 32%;">'."TOTAL-CHOLESTEROL".'</td> 
               <td style="width: 18%;">'.$TOTAL_CHOLESTEROL.'</td>
               <td style="width: 10%;">'.'mmol/l'.'</td>
               <td style="width: 20%;">'.$TOTAL_CHOLESTEROL_RESULTS.'</td>
               <td style="width: 20%;">'." 2.64 - 5.20 ".'</td> 
            </tr>
      
            <tr style="color: #000;">
            <td style="width: 32%;">'."TRIGLYCERIDES".'</td> 
            <td style="width: 18%;">'.$TRIGLYCERIDES.'</td>
            <td style="width: 10%;">'.'mmol/l'.'</td>
            <td style="width: 20%;">'.$TRIGLYCERIDES_RESULTS.'</td>
            <td style="width: 20%;">'." 0.39 - 1.71 ".'</td> 
            </tr>
  
            <tr style="color: #000;">
            <td style="width: 32%;">'."HDL CHOLESTEROL".'</td> 
            <td style="width: 18%;">'.$HDL_CHOLESTEROL.'</td>
            <td style="width: 10%;">'.'mmol/l'.'</td>
            <td style="width: 20%;">'.$HDL_CHOLESTEROL_RESULTS.'</td>
            <td style="width: 20%;">'." 1.03 - 2.52 ".'</td> 
            </tr>
  
             
  
            <tr style="color: #000;">
            <td style="width: 32%;">'."LDL CHOLESTEROL".'</td> 
            <td style="width: 18%;">'.$LDL_CHOLESTEROL.'</td>
            <td style="width: 10%;">'.'mmol/l'.'</td>
            <td style="width: 20%;">'.$LDL_CHOLESTEROL_RESULTS.'</td>
            <td style="width: 20%;">'." 1.07 - 3.34 ".'</td> 
            </tr>
  
          </tbody>';
  
          
        
          $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');
      
       //   $space = "<p></p>";
      
       //   $pdf->writeHTML($space, true, 0, true, 0);
          
     // $pdf->writeHTML($divSaparateLine, true, 0, true, 0);
      
         }

         elseif(investigation_name($lab_test)== "ELECTROLYTES"){
 

          $get_electrolytes_results = get_electrolytes_results($patient_id,$lab_code);
      
          $SODIUM = $get_electrolytes_results['SODIUM'];
          $POTASSIUM = $get_electrolytes_results['POTASSIUM'];
          $CHLORIDE = $get_electrolytes_results['CHLORIDE'];
          $S_UREA = $get_electrolytes_results['S_UREA'];
          
          $S_CREATININE = $get_electrolytes_results['S_CREATININE'];
          //S_CREATININE
           
    
    
    
      
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
        
        $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
        $tbl_foot_description = '</table>';
        $tbl_description = '';
        $TestHeader = "ELECTROLYTES Test";
        
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
                 <td style="width: 32%;">'."SODIUM (Na⁺)".'</td> 
                 <td style="width: 18%;">'.$SODIUM.'</td>
                 <td style="width: 10%;">'.'mmol/l'.'</td>
                 <td style="width: 20%;">'.$SODIUM_RESULTS.'</td>
                 <td style="width: 20%;">'." 135 - 145 ".'</td> 
              </tr>
        
              <tr style="color: #000;">
              <td style="width: 32%;">'."POTASSIUM (K⁺)".'</td> 
              <td style="width: 18%;">'.$POTASSIUM.'</td>
              <td style="width: 10%;">'.'mmol/l'.'</td>
              <td style="width: 20%;">'.$POTASSIUM_RESULTS.'</td>
              <td style="width: 20%;">'." 3.5 - 5.5 ".'</td> 
              </tr>
    
              <tr style="color: #000;">
              <td style="width: 32%;">'."CHLORIDE (Cl⁻)".'</td> 
              <td style="width: 18%;">'.$CHLORIDE.'</td>
              <td style="width: 10%;">'.'mmol/l'.'</td>
              <td style="width: 20%;">'.$CHLORIDE_RESULTS.'</td>
              <td style="width: 20%;">'." 98 - 108 ".'</td> 
              </tr>
    
               
    
              <tr style="color: #000;">
              <td style="width: 32%;">'."S-UREA".'</td> 
              <td style="width: 18%;">'.$S_UREA.'</td>
              <td style="width: 10%;">'.'mmol/l'.'</td>
              <td style="width: 20%;">'.$S_UREA_RESULTS.'</td>
              <td style="width: 20%;">'." 1.7 - 8.3 ".'</td> 
              </tr>

            
              <tr style="color: #000;">
              <td style="width: 32%;">'."S-CREATININE".'</td> 
              <td style="width: 18%;">'.$S_CREATININE.'</td>
              <td style="width: 10%;">'.'mmol/l'.'</td>
              <td style="width: 20%;">'.$S_CREATININE_RESULTS.'</td>
              <td style="width: 20%;">'." 53.0 - 97.0 ".'</td> 
              </tr>
    
            </tbody>';
    
            
          
            $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');
        
         //   $space = "<p></p>";
        
         //   $pdf->writeHTML($space, true, 0, true, 0);
            
       // $pdf->writeHTML($divSaparateLine, true, 0, true, 0);
        
           }

           elseif(investigation_name($lab_test)== "FBS"){
 

            $get_fbs_results = get_fbs_results($patient_id,$lab_code);
        
            $blood_fbs = $get_fbs_results['blood_fbs'];
            $blood_rbs = $get_fbs_results['blood_rbs']; 
            //S_CREATININE
             
      
      
      
        
            $blood_rbsRESULTS; 
            $blood_fbs_RESULTS;
            
        
            if($blood_fbs >= 3.3 && $blood_fbs <= 6.3){
              $blood_fbs_RESULTS = "";
            }elseif($blood_fbs < 3.3){
              $blood_fbs_RESULTS = "L";
            }else {
              $blood_fbs_RESULTS = "<b>H</b>";
            }

            if($blood_rbs <= 10){
              $blood_rbsRESULTS = "";
            }else {
              $blood_rbsRESULTS = "<b>H</b>";
            }
    
          
    
           
          
          $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
          $tbl_foot_description = '</table>';
          $tbl_description = '';
          $TestHeader = "FBS Test";
          
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
                   <td style="width: 32%;">'."BLOOD FBS".'</td> 
                   <td style="width: 18%;">'.$blood_fbs.'</td>
                   <td style="width: 10%;">'.'mmol/l'.'</td>
                   <td style="width: 20%;">'.$blood_fbs_RESULTS.'</td>
                   <td style="width: 20%;">'." 3.3 - 6.3 ".'</td> 
                </tr>

                <tr style="color: #000;">
                <td style="width: 32%;">'."BLOOD RBS".'</td> 
                <td style="width: 18%;">'.$blood_rbs.'</td>
                <td style="width: 10%;">'.'mmol/l'.'</td>
                <td style="width: 20%;">'.$blood_rbsRESULTS.'</td>
                <td style="width: 15%;">'." < 10 ".'</td>   
             </tr>
          
                
  
              
               
              </tbody>';
      
              
            
              $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');
          
           //   $space = "<p></p>";
          
           //   $pdf->writeHTML($space, true, 0, true, 0);
              
         // $pdf->writeHTML($divSaparateLine, true, 0, true, 0);
          
             }

   elseif(investigation_name($lab_test)== "Hepatitis B"){


    $get_hepatitis_B = hepatitis_B($patient_id,$lab_code);


    $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
    $tbl_foot_description = '</table>';
    $tbl_description = '';
    $TestHeader = "Hepatitis B Test";
    
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
     <td style="width: 40%;"><b>Test</b></td> 
     <td style="width: 40%;"><b>Results</b></td>
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
     <td style="width: 40%;">'."HB Screen".'</td> 
     <td style="width: 40%;">'.$get_hepatitis_B['test_status'].'</td>
     <td style="width: 20%;">'."_".'</td> 
  </tr>

  </tbody>';
  
    $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

    $space = "<p></p>";

    $pdf->writeHTML($space, true, 0, true, 0);
    
$pdf->writeHTML($divSaparateLine, true, 0, true, 0);
  
  }



  
  
  elseif(investigation_name($lab_test)== "HCV"){


    $HCV_test = HCV_test($patient_id,$lab_code);


    $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
    $tbl_foot_description = '</table>';
    $tbl_description = '';
    $TestHeader = "HCV Test";
    
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
     <td style="width: 40%;"><b>Test</b></td> 
     <td style="width: 40%;"><b>Results</b></td>
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
     <td style="width: 40%;">'."HCV".'</td> 
     <td style="width: 40%;">'.$HCV_test['test_status'].'</td>
     <td style="width: 20%;">'."_".'</td> 
  </tr>

  </tbody>';
  
    $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

    $space = "<p></p>";

    $pdf->writeHTML($space, true, 0, true, 0);
    
$pdf->writeHTML($divSaparateLine, true, 0, true, 0);
  
  }




  
  
  elseif(investigation_name($lab_test)== "SPT"){


    $SPT_test = SPT_test($patient_id,$lab_code);


    $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
    $tbl_foot_description = '</table>';
    $tbl_description = '';
    $TestHeader = "SPT Test";
    
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
     <td style="width: 40%;"><b>Test</b></td> 
     <td style="width: 40%;"><b>Results</b></td>
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
     <td style="width: 40%;">'."SPT".'</td> 
     <td style="width: 40%;">'.$SPT_test['test_status'].'</td>
     <td style="width: 20%;">'."_".'</td> 
  </tr>

  </tbody>';
  
    $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

    $space = "<p></p>";

    $pdf->writeHTML($space, true, 0, true, 0);
    
$pdf->writeHTML($divSaparateLine, true, 0, true, 0);
  
  }



  
  
  elseif(investigation_name($lab_test)== "RETRO SCREEN"){


    $RETRO_SCREEN_test = RETRO_SCREEN_test($patient_id,$lab_code);


    $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
    $tbl_foot_description = '</table>';
    $tbl_description = '';
    $TestHeader = "RETRO SCREEN Test";
    
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
     <td style="width: 40%;"><b>Test</b></td> 
     <td style="width: 40%;"><b>Results</b></td>
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
     <td style="width: 40%;">'."RETRO SCREEN".'</td> 
     <td style="width: 40%;">'.$RETRO_SCREEN_test['test_status'].'</td>
     <td style="width: 20%;">'."_".'</td> 
  </tr>

  </tbody>';
  
    $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

    $space = "<p></p>";

    $pdf->writeHTML($space, true, 0, true, 0);
    
$pdf->writeHTML($divSaparateLine, true, 0, true, 0);
  
  }


  
  
  
  
  elseif(investigation_name($lab_test)== "Typhoid"){


    $Typhoid_test = Typhoid_test($patient_id,$lab_code);


    $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
    $tbl_foot_description = '</table>';
    $tbl_description = '';
    $TestHeader = "Typhoid Test";
    
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
     <td style="width: 40%;"><b>Test</b></td> 
     <td style="width: 40%;"><b>Results</b></td>
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
     <td style="width: 40%;">'."IgG".'</td> 
     <td style="width: 40%;">'.$Typhoid_test['IgG'].'</td>
     <td style="width: 20%;">'."_".'</td> 
  </tr>

  <tr style="color: #000;">
  <td style="width: 40%;">'."IgM".'</td> 
  <td style="width: 40%;">'.$Typhoid_test['IgM'].'</td>
  <td style="width: 20%;">'."_".'</td> 
</tr>

  </tbody>';
  
    $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

    $space = "<p></p>";

    $pdf->writeHTML($space, true, 0, true, 0);
    
$pdf->writeHTML($divSaparateLine, true, 0, true, 0);
  
  }




  
  elseif(investigation_name($lab_test)== "Widal"){


    $Widal_test = Widal_test($patient_id,$lab_code);


    $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
    $tbl_foot_description = '</table>';
    $tbl_description = '';
    $TestHeader = "Widal Test";
    
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
     <td style="width: 40%;"><b>Test</b></td> 
     <td style="width: 40%;"><b>Results</b></td>
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
     <td style="width: 40%;">'."S typhi 'O'".'</td> 
     <td style="width: 40%;">'.$Widal_test['s_typhi_o'].'</td>
     <td style="width: 20%;">'."_".'</td> 
  </tr>

  <tr style="color: #000;">
  <td style="width: 40%;">'."S typhi 'H'".'</td> 
  <td style="width: 40%;">'.$Widal_test['s_typhi_h'].'</td>
  <td style="width: 20%;">'."_".'</td> 
</tr>

  </tbody>';
  
    $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

    $space = "<p></p>";

    $pdf->writeHTML($space, true, 0, true, 0);
    
$pdf->writeHTML($divSaparateLine, true, 0, true, 0);
  
  }



  
  
  elseif(investigation_name($lab_test)== "Stool RE"){


    $stool_re = stool_re($patient_id,$lab_code);


    $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
    $tbl_foot_description = '</table>';
    $tbl_description = '';
    $TestHeader = "Stool Re Test";
    
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
     <td style="width: 40%;"><b>Test</b></td> 
     <td style="width: 40%;"><b>Results</b></td>
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
     <td style="width: 40%;">'."Macroscopy".'</td> 
     <td style="width: 40%;">'.$stool_re['macroscopy'].'</td>
     <td style="width: 20%;">'."_".'</td> 
  </tr>

  <tr style="color: #000;">
  <td style="width: 40%;">'."Microscopy".'</td> 
  <td style="width: 40%;">'.$stool_re['microscopy'].'</td>
  <td style="width: 20%;">'."_".'</td> 
</tr>

  </tbody>';
  
    $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

    $space = "<p></p>";

    $pdf->writeHTML($space, true, 0, true, 0);
    
$pdf->writeHTML($divSaparateLine, true, 0, true, 0);
  
  }




  

  elseif(investigation_name($lab_test)== "GLYCATED HAEMOGLOBIN"){
 

    $glycated_haemoglobin = glycated_haemoglobin($patient_id,$lab_code);

    $glycated_haemoglobin = $glycated_haemoglobin['GLYCATED_HAEMOGLOBIN'];
    //S_CREATININE
     




    $glycated_haemoglobinRESULTS;  
    

    if($glycated_haemoglobin >= 3.4 && $glycated_haemoglobin <= 6.5){
      $glycated_haemoglobinRESULTS = "";
    }elseif($glycated_haemoglobinRESULTS < 3.4){
      $glycated_haemoglobinRESULTS = "L";
    }else {
      $glycated_haemoglobinRESULTS = "<b>H</b>";
    }

    

  

   
  
  $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
  $tbl_foot_description = '</table>';
  $tbl_description = '';
  $TestHeader = "GLYCATED HAEMOGLOBIN Test";
  
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
       <td style="width: 20%;"><b>Flag</b></td>
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
           <td style="width: 32%;">'."GLYCATED HAEMOGLOBIN".'</td> 
           <td style="width: 18%;">'.$glycated_haemoglobin.'</td>
           <td style="width: 10%;">'.'%'.'</td>
           <td style="width: 20%;">'.$glycated_haemoglobinRESULTS.'</td>
           <td style="width: 20%;">'." 3.4 - 6.5 ".'</td> 
        </tr>

        
  
        

      
       
      </tbody>';

      
    
      $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');
  
     $space = "<p></p>";
  
     $pdf->writeHTML($space, true, 0, true, 0);


     
  $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
  $tbl_foot_description = '</table>';
  $tbl_description = '';
  $TestHeader = "Interpretation";
  
  $tbl_description .= '
      <tbody>
        <tr style="color: #000;">
            
           <td style="width: 100%; text-align: left;">' . "<strong>".$TestHeader."</strong>" . '</td>
           
        </tr>
      </tbody>';
  
  $pdf->writeHTML($tbl_head_description . $tbl_description . $tbl_foot_description, FALSE, false, true, false, '');
   
      
 // $pdf->writeHTML($divSaparateLine, true, 0, true, 0);



 
 $tbl_head_item = '<table cellspacing = "1" cellpadding = "0" border = "0">';
 $tbl_foot_item = '</table>';
 $tbl_item = '';
 
 $tbl_item .= '
 <tbody>
   <tr style="color: #000;">
      <td style="width: 30%;"><b>HBA1c Value </b></td> 
      <td style="width: 70%;"><b>Interpretation</b></td>
       
      
     
   </tr>
 </tbody>';
 
 $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');
 
   

   
     $tbl_head_item = '<table cellspacing = "1" cellpadding = "0" border = "0">';
     $tbl_foot_item = '</table>';
     $tbl_item = '';
   
     $tbl_item .= '
     <tbody>

     <tr style="color: #000;">
     <td style="width: 30%;">'."3.4 - 6.0%".'</td> 
     <td style="width: 70%;">'."Normal Value / Non Diabetic".'</td>
  </tr>
 
       <tr style="color: #000;">
          <td style="width: 30%;">'."6.1 - 7%".'</td> 
          <td style="width: 70%;">'."Well Controlled".'</td>
       </tr>

       
       <tr style="color: #000;">
       <td style="width: 30%;">'."7.1 - 8%".'</td> 
       <td style="width: 70%;">'."Fair Controlled".'</td>
      </tr>


      <tr style="color: #000;">
      <td style="width: 30%;">'.">8".'</td> 
      <td style="width: 70%;">'."Poor control & Need Treatment".'</td>
     </tr>

       

     
      
     </tbody>';

     
   
     $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');
  
     }



         
  
  elseif(investigation_name($lab_test)== "SICKLING"){


    $SICKLING_TEST = SICKLING_TEST($patient_id,$lab_code);


    $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
    $tbl_foot_description = '</table>';
    $tbl_description = '';
    $TestHeader = "SICKLING Test";
    
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
     <td style="width: 40%;"><b>Test</b></td> 
     <td style="width: 40%;"><b>Results</b></td>
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
     <td style="width: 40%;">'."SICKLING ".'</td> 
     <td style="width: 40%;">'.$SICKLING_TEST['test_status'].'</td>
     <td style="width: 20%;">'."_".'</td> 
  </tr>

  </tbody>';
  
    $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

    $space = "<p></p>";

    $pdf->writeHTML($space, true, 0, true, 0);
    
$pdf->writeHTML($divSaparateLine, true, 0, true, 0);
  
  }



  
  
  elseif(investigation_name($lab_test)== "SYPHILLIS"){


    $SYPHILLIS_TEST = SYPHILLIS_TEST($patient_id,$lab_code);


    $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
    $tbl_foot_description = '</table>';
    $tbl_description = '';
    $TestHeader = "SYPHILLIS Test";
    
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
     <td style="width: 40%;"><b>Test</b></td> 
     <td style="width: 40%;"><b>Results</b></td>
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
     <td style="width: 40%;">'."SYPHILLIS TEST ".'</td> 
     <td style="width: 40%;">'.$SYPHILLIS_TEST['test_status'].'</td>
     <td style="width: 20%;">'."_".'</td> 
  </tr>

  </tbody>';
  
    $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

    $space = "<p></p>";

    $pdf->writeHTML($space, true, 0, true, 0);
    
$pdf->writeHTML($divSaparateLine, true, 0, true, 0);
  
  }



  elseif(investigation_name($lab_test)== "GENOTYPE"){


    $GENOTYPE_TEST = GENOTYPE_TEST($patient_id,$lab_code);


    $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
    $tbl_foot_description = '</table>';
    $tbl_description = '';
    $TestHeader = "GENOTYPE Test";
    
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
     <td style="width: 40%;"><b>Test</b></td> 
     <td style="width: 40%;"><b>Results</b></td>
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
     <td style="width: 40%;">'."GENOTYPE ".'</td> 
     <td style="width: 40%;">'.$GENOTYPE_TEST['test_status'].'</td>
     <td style="width: 20%;">'."_".'</td> 
  </tr>

  </tbody>';
  
    $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

    $space = "<p></p>";

    $pdf->writeHTML($space, true, 0, true, 0);
    
$pdf->writeHTML($divSaparateLine, true, 0, true, 0);
  
  }


    
  
  elseif(investigation_name($lab_test)== "H.PYLORI(SERUM)"){


    $H_PYLORI_SERUM__TEST = H_PYLORI_SERUM__TEST($patient_id,$lab_code);


    $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
    $tbl_foot_description = '</table>';
    $tbl_description = '';
    $TestHeader = "H.PYLORI(SERUM) Test";
    
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
     <td style="width: 40%;"><b>Test</b></td> 
     <td style="width: 40%;"><b>Results</b></td>
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
     <td style="width: 40%;">'."H.PYLORI(SERUM) TEST ".'</td> 
     <td style="width: 40%;">'.$H_PYLORI_SERUM__TEST['test_status'].'</td>
     <td style="width: 20%;">'."_".'</td> 
  </tr>

  </tbody>';
  
    $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

    $space = "<p></p>";

    $pdf->writeHTML($space, true, 0, true, 0);
    
$pdf->writeHTML($divSaparateLine, true, 0, true, 0);
  
  }


  
  
  elseif(investigation_name($lab_test)== "PROSTATE SPECIFIC ANTIGEN"){
 

    $psa_results = psa_results($patient_id,$lab_code);

    $psa_results = $psa_results['psa_lev'];
    //S_CREATININE
     




    $psa_level_RESULTS;  
    

    if($psa_results >= 0.0 && $psa_results <= 4.0){
      $psa_level_RESULTS = "";
    }elseif($psa_level_RESULTS < 0.0){
      $psa_level_RESULTS = "L";
    }else {
      $psa_level_RESULTS = "<b>H</b>";
    }

    

  

   
  
  $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
  $tbl_foot_description = '</table>';
  $tbl_description = '';
  $TestHeader = "PSA Test";
  
  $tbl_description .= '
      <tbody>
        <tr style="color: #000;">
            
           <td style="width: 100%; text-align: left;">' . "<strong>".$TestHeader."</strong>" . '</td>
           
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
       <td style="width: 20%;"><b>Flag</b></td>
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
           <td style="width: 32%;">'."PSA LEVEL".'</td> 
           <td style="width: 18%;">'.$psa_results.'</td>
           <td style="width: 10%;">'.'ng/ml'.'</td>
           <td style="width: 20%;">'.$psa_level_RESULTS.'</td>
           <td style="width: 20%;">'." 0.0 - 4.0 ".'</td> 
        </tr> 
       
      </tbody>';

      
    
      $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');
  
     $space = "<p></p>";
  
     $pdf->writeHTML($space, true, 0, true, 0);


   

 
  
     }



















  
  
  }


$pdf->lastPage();

ob_end_clean();

$pdf->Output();





