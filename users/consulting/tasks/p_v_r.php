<?php

session_start();
if(!isset($_SESSION['uid'])){
  header("Location: ../../../index");
}


//ini_set('display_errors', 0);



ob_start();


require_once '../../../functions/conndb.php';
require_once '../../../functions/func_search.php';
require_once '../../../functions/func_constant.php';
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
     
       // $company = "<i><em>Software by SmartCareAid.com, Mobile: 024-998-5804 / 026-764-2898</em></i>";

 
       // $space = "<p></p>";

     //   $md_image_sign_url = "../../../institution_images/md_signature.jpg";

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

     
       // $this->writeHTML($company, true, 0, true, 0, 'L');
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
    
    
   // $pdf->Image($schoolLogo, 5, 7, 40, 21, '', '', '', true, 450, '', false, false, 0, false, false, false);

   $pdf->Image($schoolLogo, 10, 21, 40, 21, '', '', '', true, 450, '', false, false, 0, false, false, false);
    
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


  //STARTING OF PROCESSING

 
if(investigation_name($lab_test)== "Urine RE"){

  //$pdf->AddPage();
//$pdf->setPage(2);

$pdf->AddPage();

  $get_urine_re = urine_re($patient_id,$lab_code);


$tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
$tbl_foot_description = '</table>';
$tbl_description = '';
$TestHeader = "Urine RE";

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
     <td style="width: 50%;"><b>Test</b></td> 
     <td style="width: 50%;"><b>Results</b></td>
    
      
     
    
  </tr>
</tbody>';

$pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

 
         
  
    $tbl_head_item = '<table cellspacing = "1" cellpadding = "0" border = "0">';
    $tbl_foot_item = '</table>';
    $tbl_item = '';
  
    $tbl_item .= '
    <tbody>

      <tr style="color: #000;">
         <td style="width: 50%;">'."Urine Appearance".'</td> 
         <td style="width: 50%;">'.$get_urine_re['appearance'].'</td>
         
      </tr>


      <tr style="color: #000;">
      <td style="width: 50%;">'."Colour".'</td> 
      <td style="width: 50%;">'.$get_urine_re['colour'].'</td>
     </tr>

     
     <tr style="color: #000;">
     <td style="width: 50%;">'."Specific gravity".'</td> 
     <td style="width: 50%;">'.$get_urine_re['specific_gravity'].'</td>  
    </tr>

    
    <tr style="color: #000;">
    <td style="width: 50%;">'."pH".'</td> 
    <td style="width: 50%;">'.$get_urine_re['ph'].'</td>
      
   </tr>


   <tr style="color: #000;">
   <td style="width: 50%;">'."Protein".'</td> 
   <td style="width: 50%;">'.$get_urine_re['protein'].'</td>
  </tr>


  
  <tr style="color: #000;">
  <td style="width: 50%;">'."Glucose".'</td> 
  <td style="width: 50%;">'.$get_urine_re['glucose'].'</td>
    
 </tr>


 
 <tr style="color: #000;">
 <td style="width: 50%;">'."Ketones".'</td> 
 <td style="width: 50%;">'.$get_urine_re['ketones'].'</td>
  
</tr>


<tr style="color: #000;">
<td style="width: 50%;">'."Blood".'</td> 
<td style="width: 50%;">'.$get_urine_re['blood'].'</td>
     
</tr>

<tr style="color: #000;">
<td style="width: 50%;">'."Nitrite".'</td> 
<td style="width: 50%;">'.$get_urine_re['nitrite'].'</td>
   
</tr>

<tr style="color: #000;">
<td style="width: 50%;">'."Bilirubin".'</td> 
<td style="width: 50%;">'.$get_urine_re['bilirubin'].'</td>
 
</tr>


<tr style="color: #000;">
<td style="width: 50%;">'."Urobilinogen".'</td> 
<td style="width: 50%;">'.$get_urine_re['urobilinogen'].'</td>

</tr>

<tr style="color: #000;">
<td style="width: 50%;">'."Leukocytes".'</td> 
<td style="width: 50%;">'.$get_urine_re['leukocytes'].'</td>
    
</tr>


<tr style="color: #000;">
<td style="width: 40%;">'."".'</td>  
</tr>

<tr style="color: #000;">
<td style="width: 40%;">'."<b>Microscopy</b>".'</td>  
</tr>

<tr style="color: #000;">
<td style="width: 40%;">'."".'</td>  
</tr>

<tr style="color: #000;">
<td style="width: 50%;">'."Epithelial cell".'</td> 
<td style="width: 50%;">'.$get_urine_re['epithelial_cell'].'</td>
   
</tr>

<tr style="color: #000;">
<td style="width: 50%;">'."Pus cell".'</td> 
<td style="width: 50%;">'.$get_urine_re['pus_cell'].'</td>
 
</tr>
<tr style="color: #000;">
<td style="width: 50%;">'."Rbcs".'</td> 
<td style="width: 50%;">'.$get_urine_re['rbcs'].'</td>
   
</tr>
<tr style="color: #000;">
<td style="width: 50%;">'."Casts".'</td> 
<td style="width: 50%;">'.$get_urine_re['wbc_cast'].'</td>
   
</tr>
<tr style="color: #000;">
<td style="width: 50%;">'."Crystals".'</td> 
<td style="width: 50%;">'.$get_urine_re['crystals'].'</td>
 
</tr>
 
<tr style="color: #000;">
<td style="width: 50%;">'."T vaginals".'</td> 
<td style="width: 50%;">'.$get_urine_re['t_vaginals'].'</td>
    
</tr>
<tr style="color: #000;">
<td style="width: 50%;">'."Bacteria".'</td> 
<td style="width: 50%;">'.$get_urine_re['bacteria'].'</td>
    
</tr>
<tr style="color: #000;">
<td style="width: 50%;">'."Yeast like ells".'</td> 
<td style="width: 50%;">'.$get_urine_re['yeast_like_cells'].'</td>
  
</tr>
<tr style="color: #000;">
<td style="width: 50%;">'."S haematobium".'</td> 
<td style="width: 50%;">'.$get_urine_re['s_haemoglobin'].'</td>
  
</tr>

<tr style="color: #000;">
<td style="width: 50%;">'."Spermatozoa".'</td> 
<td style="width: 50%;">'.$get_urine_re['spermatozoa'].'</td>
  
</tr>


<tr style="color: #000;">
<td style="width: 40%;">'."".'</td>  
</tr>

<tr style="color: #000;">
<td style="width: 40%;">'."<b>Others</b>".'</td>  
</tr>

<tr style="color: #000;">
<td style="width: 40%;">'."".'</td>  
</tr>



<tr style="color: #000;">
<td style="width: 50%;">'.$get_urine_re['others'].'</td> 
<td style="width: 50%;">'.$get_urine_re['others_value'].'</td>
  
</tr>


<tr style="color: #000;">
<td style="width: 50%;">'."".'</td>  
</tr>


<tr style="color: #000;">
<td style="width: 50%;">'. "<strong>"."Comments"."</strong>" .'</td>  
</tr>

<tr style="color: #000;">
<td style="width: 100%;">'.$get_urine_re['comments'].'</td>  
</tr>

<tr style="color: #000;">
<td style="width: 50%;">'."".'</td>  
</tr>



    </tbody>';
  
    $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

    $space = "<p></p>";

    $pdf->writeHTML($space, true, 0, true, 0);
    
$pdf->writeHTML($divSaparateLine, true, 0, true, 0);

   }

   //HVSRE


 
   if(investigation_name($lab_test)== "HVSRE"){

    //$pdf->AddPage();
  //$pdf->setPage(2);
  
  $pdf->AddPage();
  
    $get_HVSRE_results = get_HVSRE_results($patient_id,$lab_code);
  
  
  $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
  $tbl_foot_description = '</table>';
  $tbl_description = '';
  $TestHeader = "High Vaginal Swab (HVS) R/E";
  
  $tbl_description .= '
      <tbody>
        <tr style="color: #000;">
            
           <td style="width: 100%;">' . "<strong>".$TestHeader."</strong>" . '</td>
           
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
       <td style="width: 20%;"><b>Unit</b></td>
      
        
       
      
    </tr>
  </tbody>';
  
  $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');
  
   
           
    
      $tbl_head_item = '<table cellspacing = "1" cellpadding = "0" border = "0">';
      $tbl_foot_item = '</table>';
      $tbl_item = '';
    
      $tbl_item .= '
      <tbody>

        
  <tr style="color: #000;">
  <td style="width: 40%;">'."<b>Microscopy</b>".'</td>  
  </tr>
  
        <tr style="color: #000;">
           <td style="width: 40%;">'."E.P Cell".'</td> 
           <td style="width: 40%;">'.$get_HVSRE_results['ep_cell'].'</td>
           <td style="width: 20%;">'."HP/F".'</td> 
           
        </tr>
  
  
        <tr style="color: #000;">
        <td style="width: 40%;">'."Pus Cell".'</td> 
        <td style="width: 40%;">'.$get_HVSRE_results['pus_cell'].'</td>
        <td style="width: 20%;">'."HP/F".'</td> 
       </tr>
  
       
       <tr style="color: #000;">
       <td style="width: 40%;">'."Rbcs".'</td> 
       <td style="width: 40%;">'.$get_HVSRE_results['rbcs'].'</td>  
       <td style="width: 20%;">'."HP/F".'</td> 
      </tr>
  
      
      <tr style="color: #000;">
      <td style="width: 40%;">'."T Vaginalis".'</td> 
      <td style="width: 40%;">'.$get_HVSRE_results['t_vaginalis'].'</td>
      <td style="width: 20%;">'."HP/F".'</td> 
        
     </tr>
  
  
     <tr style="color: #000;">
     <td style="width: 40%;">'."Bacteria".'</td> 
     <td style="width: 40%;">'.$get_HVSRE_results['bacteria'].'</td>
     <td style="width: 20%;">'."HP/F".'</td> 
    </tr>
  
  
    
    <tr style="color: #000;">
    <td style="width: 40%;">'."Yeast Like Cells".'</td> 
    <td style="width: 40%;">'.$get_HVSRE_results['yeast_like_cells'].'</td>
    <td style="width: 20%;">'."HP/F".'</td> 
      
   </tr>
  
      </tbody>';
    
      $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');
  
      $space = "<p></p>";
  
      $pdf->writeHTML($space, true, 0, true, 0);
      
  $pdf->writeHTML($divSaparateLine, true, 0, true, 0);
  
     }

   //HVSRE

   //Starting LFT PROCESSING



   elseif(investigation_name($lab_test)== "LFT"){



    $pdf->AddPage();
    

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
  $TestHeader = "LFT";
  
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
     
     elseif(investigation_name($lab_test)== "FBC"){
      $pdf->AddPage();

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
      $P_LCR_RESULTS;
      


 

  
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

      if(PROJECT_MDNA == true){

        if($age >= 13 && ($gender == "Female" || $gender == "Male")){
          if($Lymphocytes_percent >= 20.0 && $Lymphocytes_percent <=40.0){
            $Lymphocytes_percent_RESULTS = "";
          }elseif($Lymphocytes_percent < 20.00){
            $Lymphocytes_percent_RESULTS = "L";
          }else {
            $Lymphocytes_percent_RESULTS = "<b>H</b>";
          }
          $ref_range_Lymphocytes_percent = "20.0 - 40.0";
        }else{
  
          if($Lymphocytes_percent >= 20.0 && $Lymphocytes_percent <= 60.0){
            $Lymphocytes_percent_RESULTS = "";
          }elseif($Lymphocytes_percent < 20.0){
            $Lymphocytes_percent_RESULTS = "L";
          }else {
            $Lymphocytes_percent_RESULTS = "<b>H</b>";
          }
          $ref_range_Lymphocytes_percent = "20.0 - 60.0";
        }

      }else{

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

      }


   
    


      //	              0.030 – 0.150 

      if(PROJECT_MDNA == true){

        if($mid_percent >= 3.0 && $mid_percent <= 15.0){
          $mid_percent_RESULTS = "";
        }elseif($mid_percent < 3.0){
          $mid_percent_RESULTS = "L";
        }else {
          $mid_percent_RESULTS = "<b>H</b>";
        }
  
  
        //3.50 – 5.20 
        if($gran_percent >= 50.0 && $gran_percent <= 70.0){
          $gran_percent_RESULTS = "";
        }elseif($gran_percent < 50.0){
          $gran_percent_RESULTS = "L";
        }else {
          $gran_percent_RESULTS = "<b>H</b>";
        }

      }else{

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

      }


  


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


    if(PROJECT_MDNA == true){
      if($age >= 13 && $gender =="Male"){

        if($HCT >= 40.0 && $HCT <= 54.0){
          $HCT_RESULTS = "";
        }elseif($HCT < 40.0){
          $HCT_RESULTS = "L";
        }else {
          $HCT_RESULTS = "<b>H</b>";
        }
        $ref_range_HCT = "40.0 - 54.0";
      }elseif ($age >= 13 && $gender =="Female"){
  
        if($HCT >= 37.0 && $HCT <= 47.0){
          $HCT_RESULTS = "";
        }elseif($HCT < 37.0){
          $HCT_RESULTS = "L";
        }else {
          $HCT_RESULTS = "<b>H</b>";
        }
        $ref_range_HCT = "37.0 - 47.0";
      }else{
  
        if($HCT >= 35.0 && $HCT <= 49.0){
          $HCT_RESULTS = "";
        }elseif($HCT < 35.0){
          $HCT_RESULTS = "L";
        }else {
          $HCT_RESULTS = "<b>H</b>";
        }
        $ref_range_HCT = "35.0 - 49.0";
      }

    }else{
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

      if(PROJECT_MDNA==true){


        if($RDW_CV >= 11.0 && $RDW_CV <= 16.0){
          $RDW_CV_RESULTS = "";
        }elseif($RDW_CV < 11.0){
          $RDW_CV_RESULTS = "L";
        }else {
          $RDW_CV_RESULTS = "<b>H</b>";
        }


        $P_LCR = $get_FBC_results['P_LCR'];
        if($P_LCR >= 11.0 && $P_LCR <= 45.0){
          $P_LCR_RESULTS = "";
        }elseif($P_LCR < 11.0){
          $P_LCR_RESULTS = "L";
        }else {
          $P_LCR_RESULTS = "<b>H</b>";
        }

        $P_LCR_UNIT = "%";
        $P_LCR_NAME = "P-LCR";
        $P_LCR_RANGE = "11.0 - 45.0";







      }else{
        if($RDW_CV >= 0.11 && $RDW_CV <= 0.16){
          $RDW_CV_RESULTS = "";
        }elseif($RDW_CV < 0.11){
          $RDW_CV_RESULTS = "L";
        }else {
          $RDW_CV_RESULTS = "<b>H</b>";
        }

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
    $TestHeader = "FBC";
    
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


     

     <tr style="color: #000;">
     <td style="width: 32%;">'."$P_LCR_NAME".'</td> 
     <td style="width: 18%;">'.$P_LCR.'</td>
     <td style="width: 10%;">'.$P_LCR_UNIT.'</td>
     <td style="width: 20%;">'.$P_LCR_RESULTS.'</td>
     <td style="width: 20%;">'."$P_LCR_RANGE".'</td> 
     </tr>
 

        </tbody>';

        
      
        $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');
    
        $space = "<p></p>";
    
       $pdf->writeHTML($space, true, 0, true, 0);
        
    $pdf->writeHTML($divSaparateLine, true, 0, true, 0);
    
       }

       elseif(investigation_name($lab_test)== "LIPID PROFILE"){
 

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
      
      $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
      $tbl_foot_description = '</table>';
      $tbl_description = '';
      $TestHeader = "LIPID PROFILE";
      
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


            <tr style="color: #000;">
            <td style="width: 32%;">'."CORONARY RISK".'</td> 
            <td style="width: 18%;">'.$coronary_risk.'</td>
            <td style="width: 10%;">'.'mmol/l'.'</td>
            <td style="width: 20%;">'.$coronary_risk_RESULTS.'</td>
            <td style="width: 20%;">'." 3.0 - 5.0 ".'</td> 
            </tr>
  
          </tbody>';
  
          
        
          $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');
      
          $space = "<p></p>";
      
          $pdf->writeHTML($space, true, 0, true, 0);
          
      $pdf->writeHTML($divSaparateLine, true, 0, true, 0);
      
         }

         elseif(investigation_name($lab_test)== "ELECTROLYTES"){
 

          $get_electrolytes_results = get_elec_tro_lytes_results($patient_id,$lab_code);
      
          $SODIUM = $get_electrolytes_results['SODIUM'];
          $POTASSIUM = $get_electrolytes_results['POTASSIUM'];
          $CHLORIDE = $get_electrolytes_results['CHLORIDE'];
         // $S_UREA = $get_electrolytes_results['S_UREA'];
          
         // $S_CREATININE = $get_electrolytes_results['S_CREATININE'];
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
  
          // if($S_UREA >= 1.7 && $S_UREA <= 8.3){
          //   $S_UREA_RESULTS = "";
          // }elseif($S_UREA < 1.7){
          //   $S_UREA_RESULTS = "L";
          // }else {
          //   $S_UREA_RESULTS = "<b>H</b>";
          // }


          // if($S_CREATININE >= 53 && $S_CREATININE <= 97){
          //   $S_CREATININE_RESULTS = "";
          // }elseif($S_CREATININE < 53){
          //   $S_CREATININE_RESULTS = "L";
          // }else {
          //   $S_CREATININE_RESULTS = "<b>H</b>";
          // }
        
        $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
        $tbl_foot_description = '</table>';
        $tbl_description = '';
        $TestHeader = "ELECTROLYTES";
        
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
                 <td style="width: 32%;">'."SODIUM (Na+)".'</td> 
                 <td style="width: 18%;">'.$SODIUM.'</td>
                 <td style="width: 10%;">'.'mmol/l'.'</td>
                 <td style="width: 20%;">'.$SODIUM_RESULTS.'</td>
                 <td style="width: 20%;">'." 135 - 145 ".'</td> 
              </tr>
        
              <tr style="color: #000;">
              <td style="width: 32%;">'."POTASSIUM (K+)".'</td> 
              <td style="width: 18%;">'.$POTASSIUM.'</td>
              <td style="width: 10%;">'.'mmol/l'.'</td>
              <td style="width: 20%;">'.$POTASSIUM_RESULTS.'</td>
              <td style="width: 20%;">'." 3.5 - 5.5 ".'</td> 
              </tr>
    
              <tr style="color: #000;">
              <td style="width: 32%;">'."CHLORIDE (Cl-)".'</td> 
              <td style="width: 18%;">'.$CHLORIDE.'</td>
              <td style="width: 10%;">'.'mmol/l'.'</td>
              <td style="width: 20%;">'.$CHLORIDE_RESULTS.'</td>
              <td style="width: 20%;">'." 98 - 108 ".'</td> 
              </tr>
    
               
    
              

            
             
    
            </tbody>';
    
            
          
            $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');
        
            $space = "<p></p>";
        
            $pdf->writeHTML($space, true, 0, true, 0);
            
       $pdf->writeHTML($divSaparateLine, true, 0, true, 0);
        
           }


           //TYROID FUNC

           elseif(investigation_name($lab_test)== "TYROID FUNCTION TEST"){
 
            //F_T_3,F_T_4,T_S_H

            $get_tyroid_func_results = get_tyroid_func_results($patient_id,$lab_code);
        
            $F_T_3 = $get_tyroid_func_results['F_T_3'];
            $F_T_4 = $get_tyroid_func_results['F_T_4'];
            $T_S_H = $get_tyroid_func_results['T_S_H'];
           // $S_UREA = $get_electrolytes_results['S_UREA'];
            
           // $S_CREATININE = $get_electrolytes_results['S_CREATININE'];
            //S_CREATININE
             
      
      
      
        
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
    
            // if($S_UREA >= 1.7 && $S_UREA <= 8.3){
            //   $S_UREA_RESULTS = "";
            // }elseif($S_UREA < 1.7){
            //   $S_UREA_RESULTS = "L";
            // }else {
            //   $S_UREA_RESULTS = "<b>H</b>";
            // }
  
  
            // if($S_CREATININE >= 53 && $S_CREATININE <= 97){
            //   $S_CREATININE_RESULTS = "";
            // }elseif($S_CREATININE < 53){
            //   $S_CREATININE_RESULTS = "L";
            // }else {
            //   $S_CREATININE_RESULTS = "<b>H</b>";
            // }
          
          $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
          $tbl_foot_description = '</table>';
          $tbl_description = '';
          $TestHeader = "TYROID FUNCTION";
          
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
                   <td style="width: 32%;">'."TRI-IODO THYRONINE (FT3)".'</td> 
                   <td style="width: 18%;">'.$F_T_3.'</td>
                   <td style="width: 10%;">'.'pmol/L'.'</td>
                   <td style="width: 20%;">'.$F_T_3_RESULTS.'</td>
                   <td style="width: 20%;">'." 2.0 - 7.0 ".'</td> 
                </tr>
          
                <tr style="color: #000;">
                <td style="width: 32%;">'."THYROXINE (FT4)".'</td> 
                <td style="width: 18%;">'.$F_T_4.'</td>
                <td style="width: 10%;">'.'pmol/L'.'</td>
                <td style="width: 20%;">'.$F_T_4_RESULTS.'</td>
                <td style="width: 20%;">'." 9.0 - 24.0 ".'</td> 
                </tr>
      
                <tr style="color: #000;">
                <td style="width: 32%;">'."TYROID STIMULATING HORMONE".'</td> 
                <td style="width: 18%;">'.$T_S_H.'</td>
                <td style="width: 10%;">'.'mlU/L'.'</td>
                <td style="width: 20%;">'.$T_S_H_RESULTS.'</td>
                <td style="width: 20%;">'." 0.3 - 4.2 ".'</td> 
                </tr>
      
                 
      
                
  
              
               
      
              </tbody>';
      
              
            
              $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');
          
           //   $space = "<p></p>";
          
           //   $pdf->writeHTML($space, true, 0, true, 0);
              
      


         $space = "<p></p>";
    
         $pdf->writeHTML($space, true, 0, true, 0);
    
    
         
      $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
      $tbl_foot_description = '</table>';
      $tbl_description = '';
      $TestHeader = "Interpretation";
      
      $tbl_description .= '
          <tbody>
            <tr style="color: #000;">
                
               <td style="width: 25%; text-align: left;">' . "<strong>".$TestHeader."</strong>" . '</td>
               
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
          <td style="">
          
          Isolated high TSH especially in the range of 4.7 - 15 mlU/ml is commonly associated with physiological  & Biological TSH variability
           
           </td>    
       </tr>
     </tbody>';
     
     $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');
     
     $space = "<p></p>";
     
     $pdf->writeHTML($space, true, 0, true, 0);
    
       
         $tbl_head_item = '<table cellspacing = "1" cellpadding = "0" border = "0">';
         $tbl_foot_item = '</table>';
         $tbl_item = '';
       
         $tbl_item .= '
         <tbody>
    
         <tr style="color: #000;"> 
          <td style="">
          
         Subclinical Autoimmune Hypothyroidism
          
          </td>
      
         </tr>
  
          </tbody>';
    
          
    
         $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');
    
         $space = "<p></p>";
     
         $pdf->writeHTML($space, true, 0, true, 0);
         
       //  $pdf->writeHTML($divSaparateLine, true, 0, true, 0);


         $tbl_head_item = '<table cellspacing = "1" cellpadding = "0" border = "0">';
     $tbl_foot_item = '</table>';
     $tbl_item = '';
     
     $tbl_item .= '
     <tbody>
       <tr style="color: #000;">
          <td style="">

        Intermittent T4 therapy for Hypothyroidism
           
           </td>    
       </tr>
     </tbody>';
     
     $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

     $space = "<p></p>";
     
     $pdf->writeHTML($space, true, 0, true, 0);

     $tbl_head_item = '<table cellspacing = "1" cellpadding = "0" border = "0">';
     $tbl_foot_item = '</table>';
     $tbl_item = '';
     
     $tbl_item .= '
     <tbody>
       <tr style="color: #000;">
          <td style="">

           Recovery phase after Non-Thyroidal illness Low TSH. Especially in the range of 0.1 to 0.4 often seen in the elderly & associated with non-thyroidal illness
           
           </td>    
       </tr>
     </tbody>';
     
     $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');



     $space = "<p></p>";
     
     $pdf->writeHTML($space, true, 0, true, 0);

     $tbl_head_item = '<table cellspacing = "1" cellpadding = "0" border = "0">';
     $tbl_foot_item = '</table>';
     $tbl_item = '';
     
     $tbl_item .= '
     <tbody>
       <tr style="color: #000;">
          <td style="">
          
          Subclinical Hyperthyroidism
           </td>    
       </tr>
     </tbody>';
     
     $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

     $space = "<p></p>";
     
     $pdf->writeHTML($space, true, 0, true, 0);

     $tbl_head_item = '<table cellspacing = "1" cellpadding = "0" border = "0">';
     $tbl_foot_item = '</table>';
     $tbl_item = '';
     
     $tbl_item .= '
     <tbody>
       <tr style="color: #000;">
          <td style="">
          
          Thyroxine ingestion
           </td>    
       </tr>
     </tbody>';
     
     $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

     $pdf->writeHTML($divSaparateLine, true, 0, true, 0);
          
             }  
             elseif(investigation_name($lab_test)== "COVID-19 ANTIGEN"){
           
           
               $get_COVID_19_ANTIGEN_test = COVID_19_ANTIGEN_test($patient_id,$lab_code);
           
           
               $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
               $tbl_foot_description = '</table>';
               $tbl_description = '';
               $TestHeader = "COVID-19 ANTIGEN";
               
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
                <td style="width: 40%;">'." COVID-19 ANTIGEN ".'</td> 
                <td style="width: 40%;">'.$get_COVID_19_ANTIGEN_test['test_status'].'</td>
                <td style="width: 20%;">'."_".'</td> 
             </tr>
           
             </tbody>';
             
               $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');
           
               $space = "<p></p>";
           
               $pdf->writeHTML($space, true, 0, true, 0);
               
           $pdf->writeHTML($divSaparateLine, true, 0, true, 0);
             
             }


           //TYROID FUNC


           elseif(investigation_name($lab_test)== "BUE&CR"){
 

            $get_bue_cr_results = get_bue_cr_results($patient_id,$lab_code);
        
            $SODIUM = $get_bue_cr_results['SODIUM'];
            $POTASSIUM = $get_bue_cr_results['POTASSIUM'];
            $CHLORIDE = $get_bue_cr_results['CHLORIDE'];
            $S_UREA = $get_bue_cr_results['S_UREA'];
            
            $S_CREATININE = $get_bue_cr_results['S_CREATININE'];
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
          $TestHeader = "BUE&CR";
          
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
                   <td style="width: 32%;">'."SODIUM (Na+)".'</td> 
                   <td style="width: 18%;">'.$SODIUM.'</td>
                   <td style="width: 10%;">'.'mmol/l'.'</td>
                   <td style="width: 20%;">'.$SODIUM_RESULTS.'</td>
                   <td style="width: 20%;">'." 135 - 145 ".'</td> 
                </tr>
          
                <tr style="color: #000;">
                <td style="width: 32%;">'."POTASSIUM (K+)".'</td> 
                <td style="width: 18%;">'.$POTASSIUM.'</td>
                <td style="width: 10%;">'.'mmol/l'.'</td>
                <td style="width: 20%;">'.$POTASSIUM_RESULTS.'</td>
                <td style="width: 20%;">'." 3.5 - 5.5 ".'</td> 
                </tr>
      
                <tr style="color: #000;">
                <td style="width: 32%;">'."CHLORIDE (Cl-)".'</td> 
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
          
              $space = "<p></p>";
          
              $pdf->writeHTML($space, true, 0, true, 0);
              
         $pdf->writeHTML($divSaparateLine, true, 0, true, 0);
          
             }


             elseif(investigation_name($lab_test)== "UREA&CREATINE"){
 

              $get_urea_creatine_results = get_urea_creatine_results($patient_id,$lab_code);
          
              
              $S_UREA = $get_urea_creatine_results['S_UREA'];
              
              $S_CREATININE = $get_urea_creatine_results['S_CREATININE'];
              //S_CREATININE
               
        
        
         
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
            
            $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
            $tbl_foot_description = '</table>';
            $tbl_description = '';
            $TestHeader = "UREA&CREATINE";
            
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
            
                $space = "<p></p>";
            
                $pdf->writeHTML($space, true, 0, true, 0);
                
           $pdf->writeHTML($divSaparateLine, true, 0, true, 0);
            
               }

           elseif(investigation_name($lab_test)== "FBS"){
 

            $get_fbs_results = get_fbs_results($patient_id,$lab_code);
        
            $blood_fbs = $get_fbs_results['blood_fbs'];
            //$blood_rbs = $get_fbs_results['blood_rbs']; 
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

            // if($blood_rbs <= 10){
            //   $blood_rbsRESULTS = "";
            // }else {
            //   $blood_rbsRESULTS = "<b>H</b>";
            // }
    
          
    
           
          
          $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
          $tbl_foot_description = '</table>';
          $tbl_description = '';
          $TestHeader = "FBS";
          
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

               
          
                
  
              
               
              </tbody>';
      
              
            
              $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');
          
              $space = "<p></p>";
          
              $pdf->writeHTML($space, true, 0, true, 0);
              
          $pdf->writeHTML($divSaparateLine, true, 0, true, 0);
          
             }


             elseif(investigation_name($lab_test)== "RBS"){
 

              $get_rbs_results = get_rbs_results($patient_id,$lab_code);
          
              $blood_rbs = $get_rbs_results['RBS_LEVEL'];
              //$blood_rbs = $get_fbs_results['blood_rbs']; 
              //S_CREATININE
               
        
        
        
          
              $blood_rbsRESULTS; 
             // $blood_fbs_RESULTS;
              
          
              // if($blood_fbs >= 3.3 && $blood_fbs <= 6.3){
              //   $blood_fbs_RESULTS = "";
              // }elseif($blood_fbs < 3.3){
              //   $blood_fbs_RESULTS = "L";
              // }else {
              //   $blood_fbs_RESULTS = "<b>H</b>";
              // }
  
              if($blood_rbs <= 10){
                $blood_rbsRESULTS = "";
              }else {
                $blood_rbsRESULTS = "<b>H</b>";
              }
      
            
      
             
            
            $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
            $tbl_foot_description = '</table>';
            $tbl_description = '';
            $TestHeader = "FBS";
            
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
                <td style="width: 32%;">'."BLOOD RBS".'</td> 
                <td style="width: 18%;">'.$blood_rbs.'</td>
                <td style="width: 10%;">'.'mmol/l'.'</td>
                <td style="width: 20%;">'.$blood_rbsRESULTS.'</td>
                <td style="width: 15%;">'." < 10 ".'</td>   
                </tr>
  
                 
            
                  
    
                
                 
                </tbody>';
        
                
              
                $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');
            
                $space = "<p></p>";
            
                $pdf->writeHTML($space, true, 0, true, 0);
                
            $pdf->writeHTML($divSaparateLine, true, 0, true, 0);
            
               }             elseif(investigation_name($lab_test)== "EGFR"){
 

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
        
              $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
              $tbl_foot_description = '</table>';
              $tbl_description = '';
              $TestHeader = "EGFR";
              
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
                   <td style="width: 32%;"><b>eGFR Value (mL/min/1.73m²)</b></td> 
                   <td style="width: 18%;"><b>Stage</b></td>
                   <td style="width: 20%;"><b>Flag</b></td>
                   <td style="width: 30%;"><b>Description</b></td>
                    
                   
                  
                </tr>
              </tbody>';
              
              $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');
              
               
                  
          
                
                  $tbl_head_item = '<table cellspacing = "1" cellpadding = "0" border = "0">';
                  $tbl_foot_item = '</table>';
                  $tbl_item = '';
                
                  $tbl_item .= '
                  <tbody>
              
                  <tr style="color: #000;">
                  <td style="width: 32%;">'.$egfr_value.'</td> 
                  <td style="width: 18%;">'.$stage.'</td>
                  <td style="width: 20%;">'.$flag.'</td>
                  <td style="width: 30%;">'.$description.'</td> 
                  </tr>
                  </tbody>';
          
                  
                
                  $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');
              
                  $space = "<p></p>";
              
                  $pdf->writeHTML($space, true, 0, true, 0);
                  
              $pdf->writeHTML($divSaparateLine, true, 0, true, 0);
              
                 } elseif(investigation_name($lab_test)== "OGTT"){
 

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
          
                $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
                $tbl_foot_description = '</table>';
                $tbl_description = '';
                $TestHeader = "OGTT";
                
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
                    <td style="width: 32%;">'."FASTING".'</td> 
                    <td style="width: 18%;">'.$fasting.'</td>
                    <td style="width: 10%;">'.'mg/dl'.'</td>
                    <td style="width: 20%;">'.$fastingResults.'</td>
                    <td style="width: 15%;">'."Less than 140 : Normal"."<br>"."Between 140-199 : Prediabetes"."<br>"."Greater than 200 : Diabetes".'</td>   
                    </tr>
                     <tr style="color: #000;">
                    <td style="width: 32%;">'."1ST HOUR".'</td> 
                    <td style="width: 18%;">'.$first_hour.'</td>
                    <td style="width: 10%;">'.'mmol/l'.'</td>
                    <td style="width: 20%;">'.$hppRESULTS.'</td>
                    <td style="width: 15%;">'."< 10".'</td>   
                    </tr>

                       <tr style="color: #000;">
                    <td style="width: 32%;">'."2ND HOUR".'</td> 
                    <td style="width: 18%;">'.$second_hour.'</td>
                    <td style="width: 10%;">'.'mmol/l'.'</td>
                    <td style="width: 20%;">'.$hppRESULTS.'</td>
                    <td style="width: 15%;">'."< 10".'</td>   
                    </tr>
                    </tbody>';
            
                    
                  
                    $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');
                
                    $space = "<p></p>";
                
                    $pdf->writeHTML($space, true, 0, true, 0);
                    
                $pdf->writeHTML($divSaparateLine, true, 0, true, 0);
                
                   }  



   elseif(investigation_name($lab_test)== "Hepatitis B"){


    $get_hepatitis_B = hepatitis_B($patient_id,$lab_code);


    $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
    $tbl_foot_description = '</table>';
    $tbl_description = '';
    $TestHeader = "Hepatitis B";
    
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
     <td style="width: 40%;">'." HBsAg ".'</td> 
     <td style="width: 40%;">'.$get_hepatitis_B['test_status'].'</td>
     <td style="width: 20%;">'."_".'</td> 
  </tr>

  </tbody>';
  
    $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

    $space = "<p></p>";

   $pdf->writeHTML($space, true, 0, true, 0);
    
$pdf->writeHTML($divSaparateLine, true, 0, true, 0);
  
  }


  elseif(investigation_name($lab_test)== "HIV I"){


    $hiv_i_get = hiv_i_get($patient_id,$lab_code);


    $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
    $tbl_foot_description = '</table>';
    $tbl_description = '';
    $TestHeader = "HIV I";
    
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
     <td style="width: 40%;">'."HIV I".'</td> 
     <td style="width: 40%;">'.$hiv_i_get['test_status'].'</td>
     <td style="width: 20%;">'."_".'</td> 
  </tr>

  </tbody>';
  
    $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

    $space = "<p></p>";

   $pdf->writeHTML($space, true, 0, true, 0);
    
$pdf->writeHTML($divSaparateLine, true, 0, true, 0);
  
  }

  
  elseif(investigation_name($lab_test)== "HIV II"){


    $hiv_ii_get = hiv_ii_get($patient_id,$lab_code);


    $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
    $tbl_foot_description = '</table>';
    $tbl_description = '';
    $TestHeader = "HIV I";
    
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
     <td style="width: 40%;">'."HIV II".'</td> 
     <td style="width: 40%;">'.$hiv_ii_get['test_status'].'</td>
     <td style="width: 20%;">'."_".'</td> 
  </tr>

  </tbody>';
  
    $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

    $space = "<p></p>";

   $pdf->writeHTML($space, true, 0, true, 0);
    
$pdf->writeHTML($divSaparateLine, true, 0, true, 0);
  
  }



  elseif(investigation_name($lab_test)== "HIV I&II"){


    $hiv_i_ii_get = hiv_i_ii_get($patient_id,$lab_code);


    $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
    $tbl_foot_description = '</table>';
    $tbl_description = '';
    $TestHeader = "HIV I&II";
    
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
     <td style="width: 40%;">'."HIV I&II".'</td> 
     <td style="width: 40%;">'.$hiv_i_ii_get['test_status'].'</td>
     <td style="width: 20%;">'."_".'</td> 
  </tr>

  </tbody>';
  
    $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

    $space = "<p></p>";

   $pdf->writeHTML($space, true, 0, true, 0);
    
$pdf->writeHTML($divSaparateLine, true, 0, true, 0);
  
  }



  
  elseif(investigation_name($lab_test)== "URINE PREGNANCY TEST(UPT)"){


    $get_urine_preg = get_urine_preg($patient_id,$lab_code);


    $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
    $tbl_foot_description = '</table>';
    $tbl_description = '';
    $TestHeader = "URINE PREGNANCY TEST(UPT)";
    
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
     <td style="width: 40%;">'."URINE PREGNANCY TEST(UPT)".'</td> 
     <td style="width: 40%;">'.$get_urine_preg['test_status'].'</td>
     <td style="width: 20%;">'."_".'</td> 
  </tr>

  </tbody>';
  
    $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

    $space = "<p></p>";

   $pdf->writeHTML($space, true, 0, true, 0);
    
$pdf->writeHTML($divSaparateLine, true, 0, true, 0);
  
  }


  
  
  elseif(investigation_name($lab_test)== "SERUM PREGNANCY TEST(SPT)"){


    $get_serum_preg = get_serum_preg($patient_id,$lab_code);


    $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
    $tbl_foot_description = '</table>';
    $tbl_description = '';
    $TestHeader = "SERUM PREGNANCY TEST(SPT)";
    
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
     <td style="width: 40%;">'."SERUM PREGNANCY TEST(SPT)".'</td> 
     <td style="width: 40%;">'.$get_serum_preg['test_status'].'</td>
     <td style="width: 20%;">'."_".'</td> 
  </tr>

  </tbody>';
  
    $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

    $space = "<p></p>";

   $pdf->writeHTML($space, true, 0, true, 0);
    
$pdf->writeHTML($divSaparateLine, true, 0, true, 0);
  
  }


  elseif(investigation_name($lab_test)== "G6PD"){


    $get_gpd = get_gpd($patient_id,$lab_code);


    $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
    $tbl_foot_description = '</table>';
    $tbl_description = '';
    $TestHeader = "G6PD";
    
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
     <td style="width: 40%;">'." G6PD ".'</td> 
     <td style="width: 40%;">'.$get_gpd['test_status'].'</td>
     <td style="width: 20%;">'."_".'</td> 
  </tr>

  </tbody>';
  
    $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

    $space = "<p></p>";

    $pdf->writeHTML($space, true, 0, true, 0);
    
$pdf->writeHTML($divSaparateLine, true, 0, true, 0);
  
  }


  
  elseif(investigation_name($lab_test)== "Malaria"){


    $get_MALARIA_test= MALARIA_test($patient_id,$lab_code);


    $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
    $tbl_foot_description = '</table>';
    $tbl_description = '';
    $TestHeader = "Malaria RDT";
    
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
     <td style="width: 40%;">'." Malaria RDT ".'</td> 
     <td style="width: 40%;">'.$get_MALARIA_test['test_status'].'</td>
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
    $TestHeader = "HCV";
    
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
     <td style="width: 40%;">'." HCV ".'</td> 
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
    $TestHeader = "SPT";
    
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
    $TestHeader = "RETRO SCREEN";
    
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
    $TestHeader = "Typhoid";
    
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
    $TestHeader = "Widal";
    
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
    $TestHeader = "Stool RE";
    
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

    $glycated_haemoglobin_value = $glycated_haemoglobin['GLYCATED_HAEMOGLOBIN'];

    $glycated_haemoglobin_evaluation = $glycated_haemoglobin['evaluation'];
    //S_CREATININE
     




    // $glycated_haemoglobinRESULTS;  
    

    // if($glycated_haemoglobin >= 3.4 && $glycated_haemoglobin <= 6.5){
    //   $glycated_haemoglobinRESULTS = "";
    // }elseif($glycated_haemoglobin < 3.4){
    //   $glycated_haemoglobinRESULTS = "L";
    // }else {
    //   $glycated_haemoglobinRESULTS = "<b>H</b>";
    // }

    

  

   
  
  $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
  $tbl_foot_description = '</table>';
  $tbl_description = '';
  $TestHeader = "GLYCATED HAEMOGLOBIN";
  
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
           <td style="width: 32%;">'."GLYCATED HAEMOGLOBIN".'</td> 
           <td style="width: 18%;">'.$glycated_haemoglobin_value.'</td>
           <td style="width: 10%;">'.'%'.'</td>
           <td style="width: 20%;">'.$glycated_haemoglobin_evaluation.'</td>
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
            
           <td style="width: 25%; text-align: left;">' . "<strong>".$TestHeader."</strong>" . '</td>
           
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
      <td style="width: 70%;">'."Poor control & Need Treat".'</td>
     </tr>

       

     
      
     </tbody>';

     
   
   //  $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

     $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

     $space = "<p></p>";
 
     $pdf->writeHTML($space, true, 0, true, 0);
     
     $pdf->writeHTML($divSaparateLine, true, 0, true, 0);
  
     }


     //hb profile



     elseif(investigation_name($lab_test)== "HEPATITIS B PROFILE"){
 
      $pdf->AddPage();
      $hepatitis_B_profile = hepatitis_B_profile($patient_id,$lab_code);
  
      $HBsAg = $hepatitis_B_profile['HBsAg'];
      $HBsAb = $hepatitis_B_profile['HBsAb'];
      $HBeAg = $hepatitis_B_profile['HBeAg'];
      $HBeAb = $hepatitis_B_profile['HBeAb'];
      $HBcAb = $hepatitis_B_profile['HBcAb']; 
      $comments = $hepatitis_B_profile['comments']; 
       
    $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
    $tbl_foot_description = '</table>';
    $tbl_description = '';
    $TestHeader = "HEPATITIS B PROFILE";
    
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
          
         
        
      </tr>
    </tbody>';
    
    $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');
    
     
        
  
      
        $tbl_head_item = '<table cellspacing = "1" cellpadding = "0" border = "0">';
        $tbl_foot_item = '</table>';
        $tbl_item = '';
      
        $tbl_item .= '
        <tbody>
    
          <tr style="color: #000;">
             <td style="width: 32%;">'."HBsAg".'</td> 
             <td style="width: 18%;">'.$HBsAg.'</td> 
          </tr>
          
          <tr style="color: #000;">
          <td style="width: 32%;">'."HBsAb".'</td> 
          <td style="width: 18%;">'.$HBsAb.'</td> 
         </tr> 


         <tr style="color: #000;">
         <td style="width: 32%;">'."HBeAg".'</td> 
         <td style="width: 18%;">'.$HBeAg.'</td> 
        </tr>
        
        
        <tr style="color: #000;">
        <td style="width: 32%;">'."HBeAb".'</td> 
        <td style="width: 18%;">'.$HBeAb.'</td> 
       </tr> 



       <tr style="color: #000;">
       <td style="width: 32%;">'."HBcAb".'</td> 
       <td style="width: 18%;">'.$HBcAb.'</td> 
      </tr> 




      <tr style="color: #000;">
<td style="width: 40%;">'."".'</td>  
</tr>

<tr style="color: #000;">
<td style="width: 40%;">'. "<strong>"."Comments"."</strong>" .'</td>  
</tr>

<tr style="color: #000;">
<td style="width: 100%;">'.$comments.'</td>  
</tr>

<tr style="color: #000;">
<td style="width: 40%;">'."".'</td>  
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
              
             <td style="width: 25%; text-align: left;">' . "<strong>".$TestHeader."</strong>" . '</td>
             
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
        <td style=""><b>HBsAg(Surface Antigen) </b></td> 
        <td style=""><b>Anti- HBs(Surface Antibody)</b></td>
        <td style=""><b>HBeAg (Envelope Antigen) </b></td> 
        <td style=""><b>Anti-HBe (Envelope Antibody)</b></td>
        <td style=""><b>Anti- HBc (Core Antibody) </b></td> 
        <td style=""><b>Interpretation</b></td>
         
        
       
     </tr>
   </tbody>';
   
   $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');
   
     
  
     
       $tbl_head_item = '<table cellspacing = "1" cellpadding = "0" border = "0">';
       $tbl_foot_item = '</table>';
       $tbl_item = '';
     
       $tbl_item .= '
       <tbody>
  
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
        <td style=""><b>+ </b></td> 
        <td style=""><b>+</b></td>
        <td style=""><b>+ </b></td> 
        <td style="">Early phase of Acute infection</td>
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
   
        
  
         
  
       
        
       </tbody>';
  
       
     
     //  $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');
  
       $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');
  
       $space = "<p></p>";
   
       $pdf->writeHTML($space, true, 0, true, 0);
       
       $pdf->writeHTML($divSaparateLine, true, 0, true, 0);
    
       }



     //hb profile



  
  
     elseif(investigation_name($lab_test)== "PROSTATE SPECIFIC ANTIGEN"){
 

      $psa_results = psa_results($patient_id,$lab_code);
  
      $psa_results_value = $psa_results['psa_lev'];

      $evaluation_psa = $psa_results['evaluation'];
      //S_CREATININE
       
  
  
  
  
     // $psa_level_RESULTS;  
      
  
      // if($psa_results >= 0.0 && $psa_results <= 4.0){
      //   $psa_level_RESULTS = "";
      // }elseif($psa_results < 0.0){
      //   $psa_level_RESULTS = "L";
      // }else {
      //   $psa_level_RESULTS = "<b>H</b>";
      // }
  
      
  
    
  
     
    
    $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
    $tbl_foot_description = '</table>';
    $tbl_description = '';
    $TestHeader = "PSA";
    
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
             <td style="width: 18%;">'.$psa_results_value.'</td>
             <td style="width: 10%;">'.'ng/ml'.'</td>
             <td style="width: 20%;">'.$evaluation_psa.'</td>
             <td style="width: 20%;">'." 0.0 - 4.0 ".'</td> 
          </tr> 
         
        </tbody>';
  
        
      
        $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');
    
      //  $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

        $space = "<p></p>";
    
        $pdf->writeHTML($space, true, 0, true, 0);
        
    $pdf->writeHTML($divSaparateLine, true, 0, true, 0);
  
}



elseif(investigation_name($lab_test)== "HAEMOGLOBIN LEVEL"){
 

  $level_haemoglobin = level_haemoglobin($patient_id,$lab_code);

  $level_haemoglobin = $level_haemoglobin['hae_lev'];
  //S_CREATININE
   




  $level_haemoglobin_RESULTS;  
  

  if($level_haemoglobin >= 11.0 && $level_haemoglobin <= 15.0){
    $level_haemoglobin_RESULTS = "";
  }elseif($level_haemoglobin < 11.0){
    $level_haemoglobin_RESULTS = "L";
  }else {
    $level_haemoglobin_RESULTS = "<b>H</b>";
  }

  



 

$tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
$tbl_foot_description = '</table>';
$tbl_description = '';
$TestHeader = "HAEMOGLOBIN LEVEL";

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
         <td style="width: 32%;">'."HAEMOGLOBIN LEVEL".'</td> 
         <td style="width: 18%;">'.$level_haemoglobin.'</td>
         <td style="width: 10%;">'.'g/dl'.'</td>
         <td style="width: 20%;">'.$level_haemoglobin_RESULTS.'</td>
         <td style="width: 20%;">'.""."<br>"."Male : 12 - 16"."<br>"."Female : 11 - 15".'</td> 
      </tr> 
     
    </tbody>';

    
  
  //  $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

  $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

  $space = "<p></p>";

  $pdf->writeHTML($space, true, 0, true, 0);
  
$pdf->writeHTML($divSaparateLine, true, 0, true, 0);

}









elseif(investigation_name($lab_test)== "ESR"){
 

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
 

$tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
$tbl_foot_description = '</table>';
$tbl_description = '';
$TestHeader = "ESR";

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
         <td style="width: 32%;">'."ESR RESULT".'</td> 
         <td style="width: 18%;">'.$get_level_esr_VAL.'</td>
         <td style="width: 10%;">'.'mm/hr'.'</td>
         <td style="width: 20%;">'.$ESR_RESULTS.'</td>
         <td style="width: 20%;">'."Children : 0 - 10"."<br>"."Male : 0 - 15"."<br>"."Female : 0 - 20".'</td> 
      </tr> 
     
    </tbody>';

    
  
  //  $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

  $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

  $space = "<p></p>";

  $pdf->writeHTML($space, true, 0, true, 0);
  
$pdf->writeHTML($divSaparateLine, true, 0, true, 0);

}

//OGTT
elseif(investigation_name($lab_test)== "OGTT"){
 

  $get_ogtt_results = get_ogtt_results($patient_id,$lab_code);

  

  $get_level_glucose_VAL = $get_ogtt_results['GLUCOSE_LEVEL'];

  

  $GLUCOSE_RESULTS;  
  

  if($get_level_glucose_VAL  < 140.0){
    $GLUCOSE_RESULTS = "Normal";
  }elseif($get_level_glucose_VAL >= 140.0 && $get_level_glucose_VAL <= 199.0){
    $GLUCOSE_RESULTS = "Prediabetes";
  }else {
    $GLUCOSE_RESULTS = "<b>Diabetes</b>";
  }
 

$tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
$tbl_foot_description = '</table>';
$tbl_description = '';
$TestHeader = "OGTT";

$tbl_description .= '
    <tbody>
      <tr style="color: #000;">
          
         <td style="width: 100%; text-align: left;">' . "<strong>".$TestHeader."</strong>" . '</td>
         
      </tr>
    </tbody>';

$pdf->writeHTML($tbl_head_description . $tbl_foot_description, FALSE, false, true, false, '');
 


$tbl_head_item = '<table cellspacing = "1" cellpadding = "0" border = "0">';
$tbl_foot_item = '</table>';
$tbl_item = '';

$tbl_item .= '
<tbody>
  <tr style="color: #000;">
     <td style="width: 20%;"><b>Test</b></td> 
     <td style="width: 20%;"><b>Results</b></td>
     <td style="width: 20%;"><b>Unit</b></td>
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
         <td style="width: 20%;">'."OGTT".'</td> 
         <td style="width: 20%;">'.$get_level_glucose_VAL.'</td>
         <td style="width: 20%;">'.'mg/dL'.'</td>
         <td style="width: 20%;">'.$GLUCOSE_RESULTS.'</td>
         <td style="width: 20%;">'."Less than 140 : Normal"."<br>"."Between 140-199 : Prediabetes"."<br>"."Greater than 200 : Diabetes".'</td> 
      </tr> 
     
    </tbody>';

    
  
  //  $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

  $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

  

  $space = "<p></p>";

  $pdf->writeHTML($space, true, 0, true, 0);
  
$pdf->writeHTML($divSaparateLine, true, 0, true, 0);

}

//ENDOGTT



elseif(investigation_name($lab_test)== "BLOOD GROUP"){
 

  $get_blood = get_blood($patient_id,$lab_code);

  $get_blood = $get_blood['BLOOD_TYPE'];
  //S_CREATININE
 

$tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
$tbl_foot_description = '</table>';
$tbl_description = '';
$TestHeader = "BLOOD GROUP";

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
      
     
    
  </tr>
</tbody>';

$pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

 
    

  
    $tbl_head_item = '<table cellspacing = "1" cellpadding = "0" border = "0">';
    $tbl_foot_item = '</table>';
    $tbl_item = '';
  
    $tbl_item .= '
    <tbody>

      <tr style="color: #000;">
         <td style="width: 32%;">'."BLOOD GROUP RESULT".'</td> 
         <td style="width: 18%;">'.$get_blood.'</td> 
      </tr> 
     
    </tbody>';

    
  
  //  $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

  $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

  $space = "<p></p>";

  $pdf->writeHTML($space, true, 0, true, 0);
  
$pdf->writeHTML($divSaparateLine, true, 0, true, 0);

}


elseif(investigation_name($lab_test)== "URIC ACID"){
 

  $get_level_URIC_ACID = get_level_URIC_ACID($patient_id,$lab_code);

  $get_level_URIC_ACID = $get_level_URIC_ACID['URIC_ACID_LEVEL'];
  //high


  if($get_level_URIC_ACID >= 140 && $get_level_URIC_ACID <= 340){
    $URIC_RESULTS = "";
  }elseif($get_level_URIC_ACID < 140){
    $URIC_RESULTS = "L";
  }else {
    $URIC_RESULTS = "<b>H</b>";
  }


  //low

$tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
$tbl_foot_description = '</table>';
$tbl_description = '';
$TestHeader = "URIC ACID";

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
         <td style="width: 32%;">'."URIC ACID RESULT".'</td> 
         <td style="width: 18%;">'.$get_level_URIC_ACID.'</td>
         <td style="width: 10%;">'.'mg/l'.'</td>
         <td style="width: 20%;">'.$URIC_RESULTS.'</td>
         <td style="width: 20%;">'."140 - 340".'</td> 
      </tr> 
     
    </tbody>';

    
  
  //  $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

  $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

  $space = "<p></p>";

  $pdf->writeHTML($space, true, 0, true, 0);
  
$pdf->writeHTML($divSaparateLine, true, 0, true, 0);

}

elseif(investigation_name($lab_test)== "CRP"){
 

  $get_level_crp = get_level_crp($patient_id,$lab_code);

  $CRP_LEVEL = $get_level_crp['CRP_LEVEL'];
  $evaluation_crp = $get_level_crp['evaluation'];
  //S_CREATININE

$tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
$tbl_foot_description = '</table>';
$tbl_description = '';
$TestHeader = "CRP";

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
         <td style="width: 32%;">'."CRP RESULT".'</td> 
         <td style="width: 18%;">'.$CRP_LEVEL.'</td>
         <td style="width: 10%;">'.'mg/l'.'</td>
         <td style="width: 20%;">'.$evaluation_crp.'</td>
         <td style="width: 20%;">'."0 - 10".'</td> 
      </tr> 
     
    </tbody>';

    
  
  //  $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

  $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

  $space = "<p></p>";

  $pdf->writeHTML($space, true, 0, true, 0);
  
$pdf->writeHTML($divSaparateLine, true, 0, true, 0);

}





     
  
  elseif(investigation_name($lab_test)== "SICKLING"){


    $SICKLING_TEST = SICKLING_TEST($patient_id,$lab_code);


    $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
    $tbl_foot_description = '</table>';
    $tbl_description = '';
    $TestHeader = "SICKLING";
    
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
    $TestHeader = "SYPHILLIS";
    
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
     <td style="width: 40%;">'." SYPHILLIS ".'</td> 
     <td style="width: 40%;">'.$SYPHILLIS_TEST['test_status'].'</td>
     <td style="width: 20%;">'."_".'</td> 
  </tr>

  </tbody>';
  
    $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

    $space = "<p></p>";

    $pdf->writeHTML($space, true, 0, true, 0);
    
$pdf->writeHTML($divSaparateLine, true, 0, true, 0);
  
  }

  
  elseif(investigation_name($lab_test)== "GONORRHEA"){


    $GONORRHEA_TEST = GONORRHEA_TEST($patient_id,$lab_code);


    $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
    $tbl_foot_description = '</table>';
    $tbl_description = '';
    $TestHeader = "GONORRHEA";
    
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
     <td style="width: 40%;">'." GONORRHEA ".'</td> 
     <td style="width: 40%;">'.$GONORRHEA_TEST['test_status'].'</td>
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
    $TestHeader = "H.PYLORI(SERUM)";
    
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
     <td style="width: 40%;">'."H.PYLORI(SERUM)".'</td> 
     <td style="width: 40%;">'.$H_PYLORI_SERUM__TEST['test_status'].'</td>
     <td style="width: 20%;">'."_".'</td> 
  </tr>

  </tbody>';
  
    $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

    $space = "<p></p>";

    $pdf->writeHTML($space, true, 0, true, 0);
    
$pdf->writeHTML($divSaparateLine, true, 0, true, 0);
  
  }

  elseif(investigation_name($lab_test)== "H.PYLORI(STOOL)"){


    $H_PYLORI_STOOL__TEST = H_PYLORI_STOOL__TEST($patient_id,$lab_code);


    $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
    $tbl_foot_description = '</table>';
    $tbl_description = '';
    $TestHeader = "H.PYLORI(STOOL)";
    
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
     <td style="width: 40%;">'."H.PYLORI(STOOL)".'</td> 
     <td style="width: 40%;">'.$H_PYLORI_STOOL__TEST['test_status'].'</td>
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
    $TestHeader = "GENOTYPE";
    
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




  

  elseif(investigation_name($lab_test)== "HB ELECTROPHORESIS"){


    $get_hb_electrophoresis = get_hb_electrophoresis($patient_id,$lab_code);


    $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
    $tbl_foot_description = '</table>';
    $tbl_description = '';
    $TestHeader = "HB ELECTROPHORESIS";
    
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
     <td style="width: 40%;">'.$get_hb_electrophoresis['SICKLING'].'</td>
     <td style="width: 20%;">'."_".'</td> 
  </tr>


  <tr style="color: #000;">
  <td style="width: 40%;">'."GENOTYPE ".'</td> 
  <td style="width: 40%;">'.$get_hb_electrophoresis['GENOTYPE'].'</td>
  <td style="width: 20%;">'."_".'</td> 
</tr>

  </tbody>';
  
    $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

    $space = "<p></p>";

    $pdf->writeHTML($space, true, 0, true, 0);
    
$pdf->writeHTML($divSaparateLine, true, 0, true, 0);
  
  }



  

  elseif(investigation_name($lab_test)== "BLOOD FILM FOR MALARIA"){


    $get_blood_film_for_malaria = get_blood_film_for_malaria($patient_id,$lab_code);


    $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
    $tbl_foot_description = '</table>';
    $tbl_description = '';
    $TestHeader = "BLOOD FILM FOR MALARIA";
    
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
     <td style="width: 40%;">'."BLOOD FILM FOR MALARIA ".'</td> 
     <td style="width: 40%;">'.$get_blood_film_for_malaria['film_status'].'</td>
     <td style="width: 20%;">'."_".'</td> 
  </tr>

 

  </tbody>';
  
    $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

    $space = "<p></p>";

    $pdf->writeHTML($space, true, 0, true, 0);
    
$pdf->writeHTML($divSaparateLine, true, 0, true, 0);
  
  }






//ENDING OF PROCESSING


  
  
  }


$pdf->lastPage();

ob_end_clean();

$pdf->Output();





