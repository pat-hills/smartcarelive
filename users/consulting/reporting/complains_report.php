<?php

session_start();

ob_start();



require_once '../../../functions/conndb.php';
require_once '../../../functions/func_search.php';
require_once '../../../functions/func_consulting.php';
require_once '../../../functions/func_common.php';
require_once '../../../tcpdf/tcpdf.php';

$staff_id = $_SESSION['uid'];
$start_date = $_SESSION['start_date_complains_report'];
$end_date = $_SESSION['end_date_complains_report'];
$complain = $_SESSION['select_complains_report'];
$gender = $_SESSION['gender_complains_report'];


$name_of_complain = complains_name($complain);



$institution_details = getInstitutionDetails();


$hospital_name = $institution_details['hospital_name'];
$telephone_1 = $institution_details['telephone_1'];
$telephone_2 = $institution_details['telephone_2'];
$telephone_3 = $institution_details['telephone_3'];
$postal_address = $institution_details['postal_address'];
$join_telephone = $telephone_1. " ".$telephone_2." ".$telephone_3." ";
//$company_address = settings('company_address');
//$footer = $hospital_name;
global $connection;
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-6);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
//        date_default_timezone_set("Africa/Accra");
//        $this->Cell(0, 12, date("d/m/Y h:i:sa") . " " . 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');

        $horizontalLine = "<hr />";

        $footer = $horizontalLine;

//        $this->writeHTML($horizontalLine, true, 0, true, 0);
        $this->writeHTML($footer, true, 0, true, 0, 'R');
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



$topic = '<strong > <label style="color: #666">  List Of Patients With '. '<i style="color:red;">' .$name_of_complain. '</i>' .' Complains Generated On ' . strtoupper(date("F j, Y")) . '</label></strong>';
$pdf->writeHTML($topic, true, 0, true, 0, 'C');

$headingSpace = "<div></div>";
$pdf->writeHTML($headingSpace, true, 0, true, 0);

$sik_head_title = '<table  style="background-color: #666; border-color: #fff; color:#fff" cellspacing = "5" cellpadding = "0" >';
$sik_foot_title = '</table>';
$sik_head_prduct = '';

$sik_head_prduct .= '
            <thead><tr style="background-color: #666; color: #fff;">
         <td style="text-align: left;"><strong>#</strong></td>
         <td style="text-align: left;"><strong>Patient name & number</strong></td>
         <td style="text-align: center;"><strong>Date seen</strong></td>
          
      </tr>' .
        ' </thead>';


$pdf->writeHTML($sik_head_title . $sik_head_prduct . $sik_foot_title, FALSE, false, true, false, '');

$i = 1;


$result = search_complains_reports($staff_id,$start_date,$end_date,$complain,$gender);
$i = 0;
while ($row = mysqli_fetch_array($result)) {
    $i ++;
	 
        $patient_name = $row['surname']." ".$row['other_names'];
 $patient_phone = $row['phone'];
	$name = ucwords(strtolower($patient_name));  
    $date_convert = date("F jS, Y", strtotime($row['date_taken'])); 
    $sik_head_prduct = '<table style="border-color: #666; color:#666" cellspacing = "2" cellpadding = "0" >';
    $sik_foot_prduct = '</table>';
    $sik_body_prduct = '';

    $sik_body_prduct .= '<thead>' .
            '<tr>' .
            '<td style="text-align: left;">' . $i . '</td>' .
            '<td style="text-align: left; ">' . $name.' - '.$patient_phone . '</td>' .
            '<td style="text-align: center; ">' . $date_convert  . '</td>' . 
            '</tr>
            </thead>';

    $pdf->writeHTML($sik_head_prduct . $sik_body_prduct . $sik_foot_prduct, FALSE, false, true, false, '');
}


$pdf->writeHTML($headingSpace, true, 0, true, 0);

$pdf->lastPage();

ob_end_clean();
//$activity = "printed Report on All Deposits made";
//require_once '../functions/logging.php';
$pdf->Output();





