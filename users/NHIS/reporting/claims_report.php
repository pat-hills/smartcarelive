<?php

session_start();
if(!isset($_SESSION['uid'])){
  header("Location: ../../../index.php");
}


//ini_set('display_errors', 0);



ob_start();


require_once '../../../functions/conndb.php';
require_once '../../../functions/func_search.php';
require_once '../../../functions/func_consulting.php';
require_once '../../../functions/func_common.php';
require_once '../../../functions/func_nhis.php';
require_once '../../../tcpdf/tcpdf.php';


$staff_id = $_SESSION['uid']; 
$claim_code =      $_SESSION['claim_code'];
//$provider =  $_SESSION['claim_provider']; ;




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
        $this->SetY(-40);
        // Set font
        $this->SetFont('helvetica', '', 9);
        // Page number
//        date_default_timezone_set("Africa/Accra");
//        $this->Cell(0, 10, date("d/m/Y h:i:sa") . " " . 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');

        $takeNote = "<strong><u>DECLARATION:</u></strong>";
         $divSaparatefoot = '<div style="width:auto; background-color:mintcream; height:25px;  border-bottom:3px solid #ddd;padding-bottom:3px;">'.'</div>';
    
       // $horizontalLine = "<hr style=background:burlywood; height: 5px; />";
        $space = "<p></p>";
        $msg = "<strong>I declare</strong>  <strong></strong>, this is a true and valid claim for the said patient for the duration. <br/> Anything else renders this report invalid.";
        //$info = "2. All fees must be paid on or before the <strong>re-opening date</strong>.";
     
        $company = "<strong><em>Software by SmartCareAid.com, Mobile: 024-998-5804 / 026-764-2898</em></strong>";

 
        $space = "<p></p>";

        $md_image_sign_url = "../../../institution_images/md_signature.jpg";

      //  $getSignatureURL = "../" . $getSignatureName["signature_url"];


       

        
       

        $this->writeHTML($divSaparatefoot, true, 0, true, 0);
        $this->writeHTML($takeNote, true, 0, true, 0);
        $this->writeHTML($space, true, 0, true, 0);
        $this->writeHTML($msg, true, 0, true, 0);
       // $this->writeHTML($info, true, 0, true, 0);
        $this->writeHTML($space, true, 0, true, 0);


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
            <td style="width: 100%; text-align: right;">' . "<strong>MD, SmartCareAid.com</strong>" . '</td>
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

$generate_claims_membership = generate_claims_membership($claim_code);
foreach ($generate_claims_membership as $value) {
   
     $pdf->AddPage();
    $pdf->startPageGroup();
   
    $pdf->setJPEGQuality(75); 

    ///STARTING THE PROCESSING OF CLAIMS


    $consultation_fees = getTheConsultingFees();

    $patient_claim_consultation = count_patient__consultation_times($value['patient_id'],$value['claim_code']);
				$count_claim_consultation = $patient_claim_consultation["consultationCount"];

    $overal_amount_consultation = $count_claim_consultation * $consultation_fees;
			$drugs_claim = get_patient_drugs_amount_claim($value['patient_id'],$value['claim_code']);
				$amount_drugs_claim = $drugs_claim['drugAmount'];
				$claim_lab = get_patient_investigation_amount_claim($value['patient_id'],$value['claim_code']);
				$labAmount = $claim_lab['labAmount'];

                if($labAmount){
                    $Heahder = "Investigations Conducted:";
                    $moneyLabAmount = $labAmount;
                    
                }else{
                    $Heahder = "No Investigations Conducted";
                    $moneyLabAmount = "---";
                }

              
        
				$total_claim = $overal_amount_consultation + $labAmount + $amount_drugs_claim;

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

    $className ='<div style="width:auto; background-color:grey;">'.'<b>'. '<strong style="color:#fff; font-size:12px">'. htmlentities("Patient Claim Report") . '</strong>'.'</b>'.'</div>';
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
    
 
     $patient_details = get_patient_data_details($value['patient_id']);
     $fullname = $patient_details['surname']." ".$patient_details['other_names'];
     $gender = $patient_details['sex'];
     $patient_scheme = get_patient_data_scheme($value['patient_id']);
     $scheme_name = $patient_scheme['sub_metro'];
     $scheme = $patient_scheme['scheme'];
    
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
    <td style="text-align: left;  font-weight:bold;margin:5px; border-bottom:1.5px solid #ddd;padding-bottom:3px;">' .$value['patient_id'].'</td>
 </tr>

 <tr style="color: #000;">
 <td style="text-align: left; width: 15%;"><strong>Gender:</strong></td>
 <td style="text-align: left;  font-weight:bold;margin:5px; border-bottom:1.5px solid #ddd;padding-bottom:3px;">' .$gender.'</td>
</tr>

<tr style="color: #000;">
<td style="text-align: left; width: 15%;"><strong> Provider:</strong></td>
<td style="text-align: left;  font-weight:bold;margin:5px; border-bottom:1.5px solid #ddd;padding-bottom:3px;">' .$scheme_name.'</td>
</tr>

<tr style="color: #000;">
<td style="text-align: left; width: 15%;"><strong>Type:</strong></td>
<td style="text-align: left;  font-weight:bold;margin:5px; border-bottom:1.5px solid #ddd;padding-bottom:3px;">' .$scheme.'</td>
</tr>

<tr style="color: #000;">
<td style="text-align: left; width: 15%;"><strong>Claim code:</strong></td>
<td style="text-align: left;  font-weight:bold;margin:5px; border-bottom:1.5px solid #ddd;padding-bottom:3px;">' .$value['claim_code'].'</td>
</tr>

    </tbody>';

    $pdf->writeHTML($tbl_head_title . $tbl_title . $tbl_foot_title, FALSE, false, true, false, '');

    $pdf->writeHTML($divSaparateLine, true, 0, true, 0);

   // $patient_lab_request_claims = claim_request_investiagtions($value["patient_id"], $value['date_sent']);

  //  $investigations_header = "";

    // if(empty($patient_lab_request_claims)){
    //     $investigations_header = "No Investigations conducted";
    // }else{
    //     $investigations_header = "Investigations Conducted";
    // }

//    list of bill items

$tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
$tbl_foot_description = '</table>';
$tbl_description = '';
$HeahderConsultation = "Consultations";

$tbl_description .= '
    <tbody>
      <tr style="color: #000;">
          
         <td style="width: 25%; text-align: left;">' . "<strong>".$HeahderConsultation."</strong>" . '</td>
         
      </tr>
    </tbody>';

$pdf->writeHTML($tbl_head_description . $tbl_description . $tbl_foot_description, FALSE, false, true, false, '');

$get_claims_consultation_membership = get_claims_consultation_membership($value['patient_id'],$claim_code);


$tbl_head_item = '<table cellspacing = "1" cellpadding = "0" border = "0">';
$tbl_foot_item = '</table>';
$tbl_item = '';

$tbl_item .= '
<tbody>
  <tr style="color: #000;">
     <td style="width: 20%;">Consult code</td> 
     <td style="width: 40%;">Transcode code</td>
     <td style="width: 20%;">Date</td>
     <td style="width: 20%;">Amount</td>
     
    
  </tr>
</tbody>';

$pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

if($get_claims_consultation_membership){

  foreach ($get_claims_consultation_membership as $claims_consultation) {
         
  
    $tbl_head_item = '<table cellspacing = "1" cellpadding = "0" border = "0">';
    $tbl_foot_item = '</table>';
    $tbl_item = '';
  
    $tbl_item .= '
    <tbody>
      <tr style="color: #000;">
         <td style="width: 20%;">'.$claims_consultation['consulting_code'].'</td> 
         <td style="width: 40%;">'.$claims_consultation['transaction_code'].'</td>
         <td style="width: 20%;">'.date("F jS, Y", strtotime($claims_consultation['date_added'])).'</td>
         <td style="width: 20%;">'.number_format( $consultation_fees, 2, ".", ",").'</td>
         
        
      </tr>
    </tbody>';
  
    $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');
   }
  
  
  }

  ///START - SUB-TOTAL FOR CONSULTION

$tbl_head_item = '<table cellspacing = "1" cellpadding = "0" border = "0">';
$tbl_foot_item = '</table>';
$tbl_item = '';

$tbl_item .= '
<tbody>
  <tr style="color: #000;">
     <td style="width: 20%;"></td>
     <td style="width: 20%;"></td>
     <td style="width: 20%;"></td>
     <td style="width: 20%;"><strong>Sub Total</strong></td>
     <td style="width: 20%;"><strong>'.number_format($overal_amount_consultation, 2, ".", ",").'</strong></td>
     
    
  </tr>
</tbody>';

$pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

///END - SUB-TOTAL FOR CONSULTION
//  }

$pdf->writeHTML($divSaparateLine2, true, 0, true, 0);


///begin here




    $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
    $tbl_foot_description = '</table>';
    $tbl_description = '';

    $tbl_description .= '
        <tbody>
          <tr style="color: #000;">
              
             <td style="width: 25%; text-align: left;">' . "<strong>".$Heahder."</strong>" . '</td>
             
          </tr>
        </tbody>';

    $pdf->writeHTML($tbl_head_description . $tbl_description . $tbl_foot_description, FALSE, false, true, false, '');

    
    if($labAmount){

    $get_claims_investigation_membership = get_claims_investigation_membership($value['patient_id'],$claim_code);

   

    
   
   
  // if($get_claims_investigation_membership){

//foreach ($get_claims_investigation_membership as $claims_investigation) {
       

        $tbl_head_item = '<table cellspacing = "1" cellpadding = "0" border = "0">';
        $tbl_foot_item = '</table>';
        $tbl_item = '';

        $tbl_item .= '
        <tbody>
          <tr style="color: #000;">
             <td style="width: 40%;">Test name(s)</td>
            
             <td style="width: 20%;">Transcode code</td>
             <td style="width: 20%;">Date</td>
             <td style="width: 20%;">Amount</td>
             
            
          </tr>
        </tbody>';

        $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');
  //  }

   
//}

   if($get_claims_investigation_membership){

foreach ($get_claims_investigation_membership as $claims_investigation) {
       

  $tbl_head_item = '<table cellspacing = "1" cellpadding = "0" border = "0">';
  $tbl_foot_item = '</table>';
  $tbl_item = '';

  $tbl_item .= '
  <tbody> 
    <tr style="color: #000;">
       <td style="width: 40%;">'.get_investigation_names_by_request_code($claims_investigation['request_code']).'</td>
      
       <td style="width: 20%;">'.$claims_investigation['transaction_code'].'</td>
       <td style="width: 20%;">'.date("F jS, Y", strtotime($claims_investigation['date_added'])).'</td>
       <td style="width: 20%;">'.number_format($claims_investigation['amount'], 2, ".", ",").'</td>
       
      
    </tr>
  </tbody>';

  $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');
 }


}

///START - SUB-TOTAL FOR LAB

$tbl_head_item = '<table cellspacing = "1" cellpadding = "0" border = "0">';
$tbl_foot_item = '</table>';
$tbl_item = '';

$tbl_item .= '
<tbody>
  <tr style="color: #000;">
     <td style="width: 20%;"></td>
     <td style="width: 20%;"></td>
     <td style="width: 20%;"></td>
     <td style="width: 20%;"><strong>Sub Total</strong></td>
     <td style="width: 20%;"><strong>'.number_format($labAmount, 2, ".", ",").'</strong></td>
     
    
  </tr>
</tbody>';

$pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

///END - SUB-TOTAL FOR LAB

///end here

}
   

    $pdf->writeHTML($divSaparateLine2, true, 0, true, 0);

 

    
    $tbl_head_description = '<table cellspacing = "2" cellpadding = "5" border = "0">';
    $tbl_foot_description = '</table>';
    $tbl_description = '';
    $HeahderDrugs = "Drugs";
    
    $tbl_description .= '
        <tbody>
          <tr style="color: #000;">
              
             <td style="width: 25%; text-align: left;">' . "<strong>".$HeahderDrugs."</strong>" . '</td>
             
          </tr>
        </tbody>';
    
    $pdf->writeHTML($tbl_head_description . $tbl_description . $tbl_foot_description, FALSE, false, true, false, '');


    $tbl_head_item = '<table cellspacing = "1" cellpadding = "0" border = "0">';
$tbl_foot_item = '</table>';
$tbl_item = '';

$tbl_item .= '
<tbody>
  <tr style="color: #000;">
     <td style="width: 20%;">Date</td>
     <td style="width: 40%;">Drug(s)</td>
     <td style="width: 20%;">Qty(s)</td> 
     <td style="width: 20%;">Amount</td>
     
    
  </tr>
</tbody>';

$pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');
    
 
    $get_claims_drug_membership = get_claims_drug_membership($value['patient_id'],$claim_code);



    
   if($get_claims_drug_membership){

    foreach ($get_claims_drug_membership as $claims_drug) {
           
    
      $tbl_head_item = '<table cellspacing = "1" cellpadding = "0" border = "0">';
      $tbl_foot_item = '</table>';
      $tbl_item = '';
    
      $tbl_item .= '
      <tbody>
        <tr style="color: #000;">
        <td style="width: 20%;">'.date("F jS, Y", strtotime($claims_drug['date_added'])).'</td>
           <td style="width: 40%;">'.get_drug_name_nhis($claims_drug['drug_codes']).'</td>
           <td style="width: 20%;">'.$claims_drug['quantity'].'</td>
          
           <td style="width: 20%;">'.number_format($claims_drug['amount'], 2, ".", ",").'</td>
           
          
        </tr>
      </tbody>';
    
      $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');
     }
    
    
    }


  ///START - SUB-TOTAL FOR DRUGS

$tbl_head_item = '<table cellspacing = "1" cellpadding = "0" border = "0">';
$tbl_foot_item = '</table>';
$tbl_item = '';

$tbl_item .= '
<tbody>
  <tr style="color: #000;">
    
     <td style="width: 20%;"></td>
     <td style="width: 20%;"></td>
     <td style="width: 20%;"></td>
     <td style="width: 20%;"><strong>Sub Total</strong></td>
     <td style="width: 20%;"><strong>'.number_format($amount_drugs_claim, 2, ".", ",").'</strong></td>
     
    
  </tr>
</tbody>';

$pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');

///END - SUB-TOTAL FOR DRUGS  

//$pdf ->commitTransaction();
//$pdf ->SetAutoPageBreak(TRUE, 100);
  
$pdf->writeHTML($divSaparateLine2, true, 0, true, 0);

  ///START - SUB-TOTAL FOR GRAND TOTAL

  $tbl_head_item = '<table cellspacing = "1" cellpadding = "0" border = "0">';
  $tbl_foot_item = '</table>';
  $tbl_item = '';
  
  $tbl_item .= '
  <tbody>
    <tr style="color: #000;">
      
       <td style="width: 20%;"></td>
       <td style="width: 20%;"></td>
       <td style="width: 20%;"></td>
       <td style="width: 20%;"><strong> Grand Total </strong></td>
       <td style="width: 20%;"><strong>'.number_format($total_claim, 2, ".", ",").'</strong></td>
       
      
    </tr>
  </tbody>';
  
  $pdf->writeHTML($tbl_head_item . $tbl_item . $tbl_foot_item, FALSE, false, true, false, '');
  
  ///END - SUB-TOTAL FOR GRAND TOTAL  
    
}



$pdf->lastPage();

ob_end_clean();

$pdf->Output();





