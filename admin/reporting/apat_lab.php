<?php
session_start();
if(!isset($_SESSION['uid'])){
  header("Location: ../../../index");
}

ob_start();

 require_once '../../functions/conndb.php';
 require_once '../../functions/func_search.php';
 require_once '../../functions/func_constant.php';
 require_once '../../functions/func_common.php';
 require_once '../../functions/func_accounts.php';
 //require_once '../../../functions/func_lab.php';
 require_once '../../tcpdf/tcpdf.php';

 
$institution_details = getInstitutionDetails();



$hospital_name = $institution_details['hospital_name'];
$telephone_1 = $institution_details['telephone_1'];
$telephone_2 = $institution_details['telephone_2'];
$telephone_3 = $institution_details['telephone_3'];
$postal_address = $institution_details['postal_address'];
$join_telephone = $telephone_1. " ".$telephone_2." ".$telephone_3." ";

$clinicLogo = "../../institution_images/clinic_logo.png";

//Getting the figures

$pageWrite = "";

$period = $_SESSION['period'];
$startDate = $_SESSION['startDate'];
$endDate = $_SESSION['endDate'];

if($period != null){
    $pageWrite = $period;
}else{
$pageWrite = " From ".date("F jS, Y", strtotime($startDate)). " To ".date("F jS, Y", strtotime($endDate));
}





$get_all_consultation = getLabsToday(TRUE);


 

 

  
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-8);
        // Set font
        $this->SetFont('helvetica', '', 8);
        // Page number
//        date_default_timezone_set("Africa/Accra");
//        $this->Cell(0, 10, date("d/m/Y h:i:sa") . " " . 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');

        $horizontalLine = "<hr />";
        $company = "<strong><em>Industrial Clinic</em></strong>";

        $this->writeHTML($horizontalLine, true, 0, true, 0);
        $this->writeHTML($company, true, 0, true, 0, 'R');
    }

}

$pdf = new MYPDF("", PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

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

// add a page
$pdf->AddPage();
$pdf->setJPEGQuality(75);

 
$heading = "<h4 style='color: #00193a' >" . $hospital_name . "</h4>";

$add = "<span>" . $postal_address . "</span><br />"
        . "<span>" . $join_telephone . "</span><br />"
        . "<span>" . "" . "</span>";

$pdf->Image($clinicLogo, 10, 21, 40, 21, '', '', '', true, 450, '', false, false, 0, false, false, false);

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


 
 

 

//if($_SESSION['revenueType']=="Consultation"){
//CONSULTATION

$pageTitle = "<strong>" . htmlentities( " " . "Labs Today " . strtoupper("")) . "</strong>";
$pdf->writeHTML($pageTitle, true, 0, true, 0, 'L');

$headingSpace = "<div></div>";
$pdf->writeHTML($headingSpace, true, 0, true, 0);

$tbl_head_title = '<table cellspacing = "0" cellpadding = "2" border = "1">';
$tbl_foot_title = '</table>';
$tbl_title = '';

$tbl_title .= '
<tbody>
      <tr style="background-color: #666; color: #fff;">
       <td style="text-align: left; width: 12%;"><strong>Patient ID</strong></td>
        
         <td style="text-align: left; width: 35%;"><strong>Patient Name</strong></td>
         <td style="text-align: left; width: 33%;"><strong>Lab Request</strong></td>
          <td style="text-align: left; width: 20%;"><strong>By</strong></td>
         
     
           
</tr>
</tbody>';

$pdf->writeHTML($tbl_head_title . $tbl_title . $tbl_foot_title, FALSE, false, true, false, '');

 

$total_tests = 0; // Initialize total tests count
while ($row = mysqli_fetch_array($get_all_consultation)) {
 
    $test_names = explode(',', $row['request_test_name']); // Assuming names are comma-separated
    $test_count = count($test_names); // Count the number of test names

    // Add to total test count
    $total_tests += $test_count;
    //$row_count++;
    $tbl_head_prduct = '<table cellspacing = "0" cellpadding = "2" border = "1">';
    $tbl_foot_prduct = '</table>';
    $tbl_body_prduct = '';
    $tbl_body_prduct .= '
    <tbody>
        <tr>
          <td style="width: 12%; text-align: left;">' . html_entity_decode(htmlentities($row["patient_id"],ENT_QUOTES),ENT_QUOTES) . '</td>
            <td style="width: 35%; text-align: left;">' . html_entity_decode(htmlentities(patient_name($row["patient_id"]),ENT_QUOTES),ENT_QUOTES) . '</td>
            <td style="width: 33%; text-align: left;">' . html_entity_decode(htmlentities($row["request_test_name"],ENT_QUOTES),ENT_QUOTES) . '</td>
             <td style="width: 20%; text-align: left;">' . html_entity_decode(htmlentities(doctor_name($row["doctor_id"]),ENT_QUOTES),ENT_QUOTES) . '</td>
        
        </tr>
    </tbody>';

    $pdf->writeHTML($tbl_head_prduct . $tbl_body_prduct . $tbl_foot_prduct, FALSE, false, true, false, '');
}

$headingSpace = "<div></div>";
$pdf->writeHTML($headingSpace, true, 0, true, 0);

$headingSpace = "<div></div>";
$pdf->writeHTML($headingSpace, true, 0, true, 0);

$tbl_head_prduct = '<table cellspacing = "0" cellpadding = "2" border = "1">';
$tbl_foot_prduct = '</table>';
$tbl_body_prduct = '';
$tbl_body_prduct .= '
<tbody>
   
 
<tr>
<td style="text-align: left; width: 80%;"><strong>TOTAL LIST OF LABS</strong></td>  
 <td style="text-align: left; width: 20%;">'. htmlentities("". $total_tests) . '</td>
</tr>
</tbody>';

$pdf->writeHTML($tbl_head_prduct . $tbl_body_prduct . $tbl_foot_prduct, FALSE, false, true, false, '');


//}


 

 




  
$pdf->lastPage();

ob_end_clean();

$pdf->Output();





