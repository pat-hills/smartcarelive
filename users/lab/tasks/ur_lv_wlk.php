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

$view_patient_lab_processed_today = view_patient_lab_processed_today_walk_in($lab_code);

$get_lab_requests_to_view = $view_patient_lab_processed_today['requested_test'];

 
$patient_walk_in_records = patient_name_walk_in($patient_id);
$full_name =$patient_walk_in_records['full_name'];
$gender = $patient_walk_in_records['gender'];
//$age = $patient_walk_in_records['dob'];



$source_name = $view_patient_lab_processed_today['source_name'];

$lab_no = $view_patient_lab_processed_today['lab_no'];

if($source_name == ""){
  $source_name = $view_patient_lab_processed_today['source'];
}

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

    //    $md_image_sign_url = "../../../institution_images/md_signature.jpg";

      //  $getSignatureURL = "../" . $getSignatureName["signature_url"];


       

        
       

        //$this->writeHTML($divSaparatefoot, true, 0, true, 0);
       // $this->writeHTML($takeNote, true, 0, true, 0);
       // $this->writeHTML($space, true, 0, true, 0);
       // $this->writeHTML($msg, true, 0, true, 0);
       // $this->writeHTML($info, true, 0, true, 0);
        //$this->writeHTML($space, true, 0, true, 0);


    //   $this->Image($md_image_sign_url, 153, 265, 55, 35, '', '', '', true, 150, '', false, false, 0, false, false, false);

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
    
 
     //$patient_details = get_patient_data_details($patient_id);
     //$fullname = $patient_details['surname']." ".$patient_details['other_names'];
     //$gender = $patient_details['sex'];

     //$request_test = patient_investigation_name_by_code($lab_code,$patient_id);

     
     $date_sent_ = $view_patient_lab_processed_today['date_requested'];
         
        
     $date_convert = date('jS M, Y', strtotime("$date_sent_")).", ".date('l', strtotime("$date_sent_"));

//$staff_id = get_staff_info($request_test['doctor_id']);

    // $requested_by = "Dr, ". $staff_id['firstName']." ".$staff_id['otherNames'];
    
   // $pdf ->setPage($getStudentData);

    $tbl_head_title = '<table cellspacing = "10" cellpadding = "0" border = "0">';
    $tbl_foot_title = '</table>';
    $tbl_title = '';

    $tbl_title .= '
    <tbody>
     
    <tr style="color: #000;">
    <td style="text-align: left; width: 15%"><strong>Name:</strong></td>
    <td style="text-align: left;  font-weight:bold;margin:5px; border-bottom:1.5px solid #ddd;padding-bottom:3px;">' .$full_name.'</td>
    </tr>

 

 <tr style="color: #000;">
 <td style="text-align: left; width: 15%;"><strong>Gender:</strong></td>
 <td style="text-align: left;  font-weight:bold;margin:5px; border-bottom:1.5px solid #ddd;padding-bottom:3px;">' .$gender.'</td>
</tr>
 
<tr style="color: #000;">
<td style="text-align: left; width: 15%;"><strong>Request test(s):</strong></td>
<td style="text-align: left;  font-weight:bold;margin:5px; border-bottom:1.5px solid #ddd;padding-bottom:3px;">' .$view_patient_lab_processed_today['requested_test_names'].'</td>
</tr>

<tr style="color: #000;">
<td style="text-align: left; width: 15%;"><strong>Request date:</strong></td>
<td style="text-align: left;  font-weight:bold;margin:5px; border-bottom:1.5px solid #ddd;padding-bottom:3px;">' .$date_convert.'</td>
</tr>

<tr style="color: #000;">
<td style="text-align: left; width: 15%;"><strong>Requested by:</strong></td>
<td style="text-align: left;  font-weight:bold;margin:5px; border-bottom:1.5px solid #ddd;padding-bottom:3px;">' .$source_name.'</td>
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

 
if(investigation_name($lab_test)== "Urine RE"){

 // $pdf->AddPage();
//$pdf->setPage(2);

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

<tr style="color: #000;">
<td style="width: 40%;">'."Leukocytes".'</td> 
<td style="width: 40%;">'.$get_urine_re['leukocytes'].'</td>
<td style="width: 20%;">'."_".'</td>     
</tr>


<tr style="color: #000;">
<td style="width: 40%;">'."".'</td>  
</tr>

<tr style="color: #000;">
<td style="width: 40%;">'."Microscopy".'</td>  
</tr>

<tr style="color: #000;">
<td style="width: 40%;">'."".'</td>  
</tr>

<tr style="color: #000;">
<td style="width: 40%;">'."Epithelial cell".'</td> 
<td style="width: 40%;">'.$get_urine_re['epithelial_cell'].'</td>
<td style="width: 20%;">'."_".'</td>     
</tr>

<tr style="color: #000;">
<td style="width: 40%;">'."Pus cell".'</td> 
<td style="width: 40%;">'.$get_urine_re['pus_cell'].'</td>
<td style="width: 20%;">'."_".'</td>     
</tr>
<tr style="color: #000;">
<td style="width: 40%;">'."Rbcs".'</td> 
<td style="width: 40%;">'.$get_urine_re['rbcs'].'</td>
<td style="width: 20%;">'."_".'</td>     
</tr>
<tr style="color: #000;">
<td style="width: 40%;">'."Wbc cast".'</td> 
<td style="width: 40%;">'.$get_urine_re['wbc_cast'].'</td>
<td style="width: 20%;">'."_".'</td>     
</tr>
<tr style="color: #000;">
<td style="width: 40%;">'."Crystals".'</td> 
<td style="width: 40%;">'.$get_urine_re['crystals'].'</td>
<td style="width: 20%;">'."_".'</td>     
</tr>
<tr style="color: #000;">
<td style="width: 40%;">'."Ova".'</td> 
<td style="width: 40%;">'.$get_urine_re['ova'].'</td>
<td style="width: 20%;">'."_".'</td>     
</tr>
<tr style="color: #000;">
<td style="width: 40%;">'."T vaginals".'</td> 
<td style="width: 40%;">'.$get_urine_re['t_vaginals'].'</td>
<td style="width: 20%;">'."_".'</td>     
</tr>
<tr style="color: #000;">
<td style="width: 40%;">'."Bacteria".'</td> 
<td style="width: 40%;">'.$get_urine_re['bacteria'].'</td>
<td style="width: 20%;">'."_".'</td>     
</tr>
<tr style="color: #000;">
<td style="width: 40%;">'."Yeast like ells".'</td> 
<td style="width: 40%;">'.$get_urine_re['yeast_like_cells'].'</td>
<td style="width: 20%;">'."_".'</td>     
</tr>


<tr style="color: #000;">
<td style="width: 40%;">'."S haematobium".'</td> 
<td style="width: 40%;">'.$get_urine_re['s_haemoglobin'].'</td>
<td style="width: 20%;">'."_".'</td>     
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





