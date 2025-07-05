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

    //    $md_image_sign_url = "../../../institution_images/md_signature.jpg";

      //  $getSignatureURL = "../" . $getSignatureName["signature_url"];


       

        
       

        //$this->writeHTML($divSaparatefoot, true, 0, true, 0);
       // $this->writeHTML($takeNote, true, 0, true, 0);
       // $this->writeHTML($space, true, 0, true, 0);
       // $this->writeHTML($msg, true, 0, true, 0);
       // $this->writeHTML($info, true, 0, true, 0);
        //$this->writeHTML($space, true, 0, true, 0);


     //  $this->Image($md_image_sign_url, 153, 265, 55, 35, '', '', '', true, 150, '', false, false, 0, false, false, false);

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
     $lab_no = $request_test['lab_no'];

     if($lab_no == null){
       $lab_no = $lab_code;
     }
         
        
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
 
 <td style="text-align: left; width: 15%;"><strong>Gender,Age:</strong></td>
 <td style="text-align: left;  font-weight:bold;margin:5px; border-bottom:1.5px solid #ddd;padding-bottom:3px;">' .$gender.", ".$age." year(s)".'</td>
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
<td style="text-align: left; width: 15%;"><strong>Lab No.:</strong></td>
<td style="text-align: left;  font-weight:bold;margin:5px; border-bottom:1.5px solid #ddd;padding-bottom:3px;">' .$lab_no.'</td>
</tr>

    </tbody>';

    $pdf->writeHTML($tbl_head_title . $tbl_title . $tbl_foot_title, FALSE, false, true, false, '');

    $pdf->writeHTML($divSaparateLine, true, 0, true, 0);


    //FOR EACH SHOULD START FROM HERE

    
foreach ($get_lab_requests_to_view as $lab_test) {

 
 

   //Starting LFT PROCESSING



   if(investigation_name($lab_test)== "LFT"){


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
           <td style="width: 15%;">'." 2.0 - 21.0 ".'</td> 
        </tr>
  
  
        <tr style="color: #000;">
        <td style="width: 32%;">'."S-BILIRUBIN DIRECT".'</td> 
        <td style="width: 18%;">'.$DIRECT_LFT_STATUS.'</td>
        <td style="width: 15%;">'.'umol/L'.'</td>
        <td style="width: 20%;">'.$S_BILIRUBIN_conjugated_RESULTS.'</td>
        <td style="width: 15%;">'."  <"."  10.2 ".'</td>     
       </tr>
  
       
       <tr style="color: #000;">
       <td style="width: 32%;">'."S-ALKALINE PHOSPHATASE".'</td> 
       <td style="width: 18%;">'.$S_ALKALINE_PHOSPHATASE.'</td>
       <td style="width: 15%;">'.'IU/L'.'</td>
       <td style="width: 20%;">'.$S_ALKALINE_PHOSPHATASE_RESULTS.'</td>
       <td style="width: 15%;">'." 80 - 306 ".'</td>     
      </tr>
  
      
      <tr style="color: #000;">
      <td style="width: 32%;">'."S-g-GLUTAMYL TRANSFERASE".'</td> 
      <td style="width: 18%;">'.$S_g_GLUTAMYL_TRANSFERASE.'</td>
      <td style="width: 15%;">'.'IU/L'.'</td>
      <td style="width: 20%;">'.$S_g_GLUTAMYL_TRANSFERASE_RESULTS.'</td>
      <td style="width: 15%;">'." 11 - 61 ".'</td>     
     </tr>
  
  
     <tr style="color: #000;">
     <td style="width: 32%;">'."S-ALT (GPT) ".'</td> 
     <td style="width: 18%;">'.$S_ALT_GPT.'</td>
     <td style="width: 15%;">'.'IU/L'.'</td>
     <td style="width: 20%;">'.$S_ALT_GPT_RESULTS.'</td>
     <td style="width: 15%;">'."  <"."  42 ".'</td>     
    </tr>
  
  
    
    <tr style="color: #000;">
    <td style="width: 32%;">'."S-AST (GOT)".'</td> 
    <td style="width: 18%;">'.$S_AST_GOT.'</td>
    <td style="width: 15%;">'.'IU/L'.'</td>
    <td style="width: 20%;">'.$S_AST_GOT_RESULTS.'</td>
    <td style="width: 15%;">'."  <"."  37 ".'</td>        
   </tr>
  
  
   
   <tr style="color: #000;">
   <td style="width: 32%;">'."S-TOTAL PROTEIN".'</td> 
   <td style="width: 18%;">'.$S_TOTAL_PROTEIN.'</td>
   <td style="width: 15%;">'.'g/L'.'</td>
   <td style="width: 20%;">'.$S_TOTAL_PROTEIN_RESULTS.'</td>
   <td style="width: 15%;">'." 60 - 80 ".'</td>     
  </tr>
  
  
  <tr style="color: #000;">
  <td style="width: 32%;">'."S-ALBUMIN".'</td> 
  <td style="width: 18%;">'.$S_ALBUMIN.'</td>
  <td style="width: 15%;">'.'g/L'.'</td>
  <td style="width: 20%;">'.$S_ALBUMIN_RESULTS.'</td>
  <td style="width: 15%;">'." 37.0 - 53.0 ".'</td>     
  </tr>
  
  
   
  
   
  
      </tbody>';
    
      $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

  
  
      $space = "<p></p>";
  
    $pdf->writeHTML($space, true, 0, true, 0);
      
  $pdf->writeHTML($divSaparateLine, true, 0, true, 0);






}
     
     



  
  
  }


$pdf->lastPage();

ob_end_clean();

$pdf->Output();





