<?php

session_start();

ob_start();



require_once '../../../functions/conndb.php';
require_once '../../../functions/func_search.php';
require_once '../../../functions/func_consulting.php';
require_once '../../../functions/func_common.php';
require_once '../../../tcpdf/tcpdf.php';

$staff_id = $_SESSION['uid'];
$period_report = $_SESSION['period_report'];

$category_type = $_SESSION['category']; 


 



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

$topic = '<strong > <label style="color: #666">'. '<i style="">' .$period_report." "."$category_type". "'s revenue report generated on ". '</i>' .' ' . strtoupper(date("F j, Y")) . '</label></strong>';
$pdf->writeHTML($topic, true, 0, true, 0, 'C');

$headingSpace = "<div></div>";
$pdf->writeHTML($headingSpace, true, 0, true, 0);



////////////////////////////////// LISTING AND REPORTING ON CONSULTATIONS PAYMENTS///////////////////////////////////////////////////

$result = search_cashier_payment_period_option($staff_id,$period_report);
$result_investigation = search_cashier_payment_period_option_investigation($staff_id,$period_report);
$result_drug_dispensed = search_cashier_drugs_dispensed_payment_period_option($staff_id,$period_report);
$amount_total = search_cashier_payment_period_option_sum_amount($staff_id,$period_report);
$amount_total_fmt = number_format($amount_total, 2, '.', ',');



//amount_total_investigation
$amount_total_investigation = search_cashier_investigation_payment_period_option_sum_amount($staff_id,$period_report);
$amount_total_fmt_investigation = number_format($amount_total_investigation, 2, '.', ',');



//amount_total_drugs_received
$amount_total_drug = search_cashier_payment_drug_period_option_sum_amount($staff_id,$period_report);
$amount_total_fmt_drug = number_format($amount_total_drug, 2, '.', ',');




$overallTotal = number_format($amount_total + $amount_total_investigation + $amount_total_drug, 2, '.', ',');

if($category_type == "Consultation"){


$topic2 = '<strong > <label style="color: #666"> Consultation Payments Received </label></strong>';
$pdf->writeHTML($topic2, true, 0, true, 0, 'L');

$pdf->writeHTML($headingSpace, true, 0, true, 0);
$sik_head_title = '<table  style="background-color: #666; border-color: #fff; color:#fff" cellspacing = "5" cellpadding = "0" >';
$sik_foot_title = '</table>';
$sik_head_prduct = '';

$sik_head_prduct .= '
            <thead><tr style="background-color: #666; color: #fff;">
         <td style="text-align: left;"><strong>#</strong></td>
         <td style="text-align: left;"><strong>Date recorded</strong></td>
         <td style="text-align: left;"><strong>Transaction #</strong></td>
         <td style="text-align: left;"><strong>Amount(GH&cent;)</strong></td>
          
      </tr>' .
        ' </thead>';


$pdf->writeHTML($sik_head_title . $sik_head_prduct . $sik_foot_title, FALSE, false, true, false, '');

//$i = 1;





$i = 0;
while ($row = mysqli_fetch_array($result)) {
    $i ++;
	 
    
    $date_convert = date("F jS, Y", strtotime($row['date_added'])); 
    $transaction_codes = $row['transaction_code'];
    $amount_fmt = number_format($row['amount'], 2, '.', ',');
    $sik_head_prduct = '<table style="border-color: #666; color:#666" cellspacing = "2" cellpadding = "0" >';
    $sik_foot_prduct = '</table>';
    $sik_body_prduct = '';

    $sik_body_prduct .= '<thead>' .
            '<tr>' .
            '<td style="text-align: left;">' . $i . '</td>' .
            '<td style="text-align: left; ">' . $date_convert.'</td>' .
            '<td style="text-align: left; ">' . $transaction_codes  . '</td>' . 
            '<td style="text-align: left; ">' . $amount_fmt  . '</td>' . 
            '</tr>
            </thead>';

    $pdf->writeHTML($sik_head_prduct . $sik_body_prduct . $sik_foot_prduct, FALSE, false, true, false, '');
}


 



 

$sik_head_prduct = '<table style="border-color: #666; color:#666" cellspacing = "2" cellpadding = "0" >';
$sik_foot_prduct = '</table>';
$sik_body_prduct = '';

$sik_body_prduct .= '<thead>' .
        '<tr>' .
        '<td style="text-align: left;">' . "" . '</td>' .
        '<td style="text-align: left; ">' . "".'</td>' .
        '<td style="text-align: left; ">' . "<strong>Sub Total:</strong>"  . '</td>' . 
        '<td style="text-align: left; ">' . $amount_total_fmt  . '</td>' . 
        '</tr>
        </thead>';

$pdf->writeHTML($sik_head_prduct . $sik_body_prduct . $sik_foot_prduct, FALSE, false, true, false, '');



$pdf->writeHTML($headingSpace, true, 0, true, 0);
$pdf->writeHTML($headingSpace, true, 0, true, 0);

}elseif($category_type == "Investigation"){


////////////////////////////////// LISTING AND REPORTING INVESTIGATIONS PAYMENTS///////////////////////////////////////////////////



$topic3 = '<strong > <label style="color: #666"> Investigations Payments Received </label></strong>';
$pdf->writeHTML($topic3, true, 0, true, 0, 'L');

$pdf->writeHTML($headingSpace, true, 0, true, 0);

$ii = 0;
$sik_head_title_invs = '<table  style="background-color: #666; border-color: #fff; color:#fff" cellspacing = "5" cellpadding = "0" >';
$sik_foot_title_ivs = '</table>';
$sik_head_prduct_ivs = '';

$sik_head_prduct_ivs .= '
            <thead><tr style="background-color: #666; color: #fff;">
         <td style="text-align: left;"><strong>#</strong></td>
         <td style="text-align: left;"><strong>Date recorded</strong></td>
         <td style="text-align: left;"><strong>Transaction #</strong></td>
         <td style="text-align: left;"><strong>Amount(GH&cent;)</strong></td>
          
      </tr>' .
        ' </thead>';


$pdf->writeHTML($sik_head_title_invs . $sik_head_prduct_ivs . $sik_foot_title_ivs, FALSE, false, true, false, '');

while ($row1 = mysqli_fetch_array($result_investigation)) {
        $ii ++;
             
        
        $date_convert = date("F jS, Y", strtotime($row1['date_added'])); 
        $transaction_codes = $row1['transaction_code'];
        $amount_fmt = number_format($row1['amount'], 2, '.', ',');
        $sik_head_prduct = '<table style="border-color: #666; color:#666" cellspacing = "2" cellpadding = "0" >';
        $sik_foot_prduct = '</table>';
        $sik_body_prduct = '';
    
        $sik_body_prduct .= '<thead>' .
                '<tr>' .
                '<td style="text-align: left;">' . $ii . '</td>' .
                '<td style="text-align: left; ">' . $date_convert.'</td>' .
                '<td style="text-align: left; ">' . $transaction_codes  . '</td>' . 
                '<td style="text-align: left; ">' . $amount_fmt  . '</td>' . 
                '</tr>
                </thead>';
    
        $pdf->writeHTML($sik_head_prduct . $sik_body_prduct . $sik_foot_prduct, FALSE, false, true, false, '');
    }

    
$sik_head_prduct_v = '<table style="border-color: #666; color:#666" cellspacing = "2" cellpadding = "0" >';
$sik_foot_prduct_v = '</table>';
$sik_body_prduct_v = '';

$sik_body_prduct_v .= '<thead>' .
        '<tr>' .
        '<td style="text-align: left;">' . "" . '</td>' .
        '<td style="text-align: left; ">' . "".'</td>' .
        '<td style="text-align: left; ">' . "<strong>Sub Total:</strong>"  . '</td>' . 
        '<td style="text-align: left; ">' . $amount_total_fmt_investigation  . '</td>' . 
        '</tr>
        </thead>';

$pdf->writeHTML($sik_head_prduct_v . $sik_body_prduct_v . $sik_foot_prduct_v, FALSE, false, true, false, '');

$pdf->writeHTML($headingSpace, true, 0, true, 0);
$pdf->writeHTML($headingSpace, true, 0, true, 0);

}elseif($category_type == "Drugs"){

////////////////////////////////// LISTING AND REPORTING ON DRUG DISPENSATION PAYMENTS///////////////////////////////////////////////////

$topic4 = '<strong > <label style="color: #666"> Drug Dispensed Payments Received </label></strong>';
$pdf->writeHTML($topic4, true, 0, true, 0, 'L');

$pdf->writeHTML($headingSpace, true, 0, true, 0);


$iii = 0;
$sik_head_title_dg = '<table  style="background-color: #666; border-color: #fff; color:#fff" cellspacing = "5" cellpadding = "0" >';
$sik_foot_title_dg = '</table>';
$sik_head_prduct_dg = '';

$sik_head_prduct_dg .= '
            <thead><tr style="background-color: #666; color: #fff;">
         <td style="text-align: left;"><strong>#</strong></td>
         <td style="text-align: left;"><strong>Date recorded</strong></td>
         <td style="text-align: left;"><strong>Transaction #</strong></td>
         <td style="text-align: left;"><strong>Amount(GH&cent;)</strong></td>
          
      </tr>' .
        ' </thead>';


$pdf->writeHTML($sik_head_title_dg . $sik_head_prduct_dg . $sik_foot_title_dg, FALSE, false, true, false, '');



while ($row2 = mysqli_fetch_array($result_drug_dispensed)) {
        $iii ++;
             
        
        $date_convert = date("F jS, Y", strtotime($row2['date_added'])); 
        $transaction_codes = $row2['transcode'];
        $amount_fmt = number_format($row2['amount'], 2, '.', ',');
        $sik_head_prduct = '<table style="border-color: #666; color:#666" cellspacing = "2" cellpadding = "0" >';
        $sik_foot_prduct = '</table>';
        $sik_body_prduct = '';
    
        $sik_body_prduct .= '<thead>' .
                '<tr>' .
                '<td style="text-align: left;">' . $iii . '</td>' .
                '<td style="text-align: left; ">' . $date_convert.'</td>' .
                '<td style="text-align: left; ">' . $transaction_codes  . '</td>' . 
                '<td style="text-align: left; ">' . $amount_fmt  . '</td>' . 
                '</tr>
                </thead>';
    
        $pdf->writeHTML($sik_head_prduct . $sik_body_prduct . $sik_foot_prduct, FALSE, false, true, false, '');
    }



    $sik_head_prduct_v = '<table style="border-color: #666; color:#666" cellspacing = "2" cellpadding = "0" >';
$sik_foot_prduct_v = '</table>';
$sik_body_prduct_v = '';

$sik_body_prduct_v .= '<thead>' .
        '<tr>' .
        '<td style="text-align: left;">' . "" . '</td>' .
        '<td style="text-align: left; ">' . "".'</td>' .
        '<td style="text-align: left; ">' . "<strong>Sub Total:</strong>"  . '</td>' . 
        '<td style="text-align: left; ">' . $amount_total_fmt_drug  . '</td>' . 
        '</tr>
        </thead>';

$pdf->writeHTML($sik_head_prduct_v . $sik_body_prduct_v . $sik_foot_prduct_v, FALSE, false, true, false, '');

}else{


        

$topic2 = '<strong > <label style="color: #666"> Consultation Payments Received </label></strong>';
$pdf->writeHTML($topic2, true, 0, true, 0, 'L');

$pdf->writeHTML($headingSpace, true, 0, true, 0);
$sik_head_title = '<table  style="background-color: #666; border-color: #fff; color:#fff" cellspacing = "5" cellpadding = "0" >';
$sik_foot_title = '</table>';
$sik_head_prduct = '';

$sik_head_prduct .= '
            <thead><tr style="background-color: #666; color: #fff;">
         <td style="text-align: left;"><strong>#</strong></td>
         <td style="text-align: left;"><strong>Date recorded</strong></td>
         <td style="text-align: left;"><strong>Transaction #</strong></td>
         <td style="text-align: left;"><strong>Amount(GH&cent;)</strong></td>
          
      </tr>' .
        ' </thead>';


$pdf->writeHTML($sik_head_title . $sik_head_prduct . $sik_foot_title, FALSE, false, true, false, '');

//$i = 1;





$i = 0;
while ($row = mysqli_fetch_array($result)) {
    $i ++;
	 
    
    $date_convert = date("F jS, Y", strtotime($row['date_added'])); 
    $transaction_codes = $row['transaction_code'];
    $amount_fmt = number_format($row['amount'], 2, '.', ',');
    $sik_head_prduct = '<table style="border-color: #666; color:#666" cellspacing = "2" cellpadding = "0" >';
    $sik_foot_prduct = '</table>';
    $sik_body_prduct = '';

    $sik_body_prduct .= '<thead>' .
            '<tr>' .
            '<td style="text-align: left;">' . $i . '</td>' .
            '<td style="text-align: left; ">' . $date_convert.'</td>' .
            '<td style="text-align: left; ">' . $transaction_codes  . '</td>' . 
            '<td style="text-align: left; ">' . $amount_fmt  . '</td>' . 
            '</tr>
            </thead>';

    $pdf->writeHTML($sik_head_prduct . $sik_body_prduct . $sik_foot_prduct, FALSE, false, true, false, '');
}


 



 

$sik_head_prduct = '<table style="border-color: #666; color:#666" cellspacing = "2" cellpadding = "0" >';
$sik_foot_prduct = '</table>';
$sik_body_prduct = '';

$sik_body_prduct .= '<thead>' .
        '<tr>' .
        '<td style="text-align: left;">' . "" . '</td>' .
        '<td style="text-align: left; ">' . "".'</td>' .
        '<td style="text-align: left; ">' . "<strong>Sub Total:</strong>"  . '</td>' . 
        '<td style="text-align: left; ">' . $amount_total_fmt  . '</td>' . 
        '</tr>
        </thead>';

$pdf->writeHTML($sik_head_prduct . $sik_body_prduct . $sik_foot_prduct, FALSE, false, true, false, '');



$pdf->writeHTML($headingSpace, true, 0, true, 0);
$pdf->writeHTML($headingSpace, true, 0, true, 0);




$topic3 = '<strong > <label style="color: #666"> Investigations Payments Received </label></strong>';
$pdf->writeHTML($topic3, true, 0, true, 0, 'L');

$pdf->writeHTML($headingSpace, true, 0, true, 0);

$ii = 0;
$sik_head_title_invs = '<table  style="background-color: #666; border-color: #fff; color:#fff" cellspacing = "5" cellpadding = "0" >';
$sik_foot_title_ivs = '</table>';
$sik_head_prduct_ivs = '';

$sik_head_prduct_ivs .= '
            <thead><tr style="background-color: #666; color: #fff;">
         <td style="text-align: left;"><strong>#</strong></td>
         <td style="text-align: left;"><strong>Date recorded</strong></td>
         <td style="text-align: left;"><strong>Transaction #</strong></td>
         <td style="text-align: left;"><strong>Amount(GH&cent;)</strong></td>
          
      </tr>' .
        ' </thead>';


$pdf->writeHTML($sik_head_title_invs . $sik_head_prduct_ivs . $sik_foot_title_ivs, FALSE, false, true, false, '');

while ($row1 = mysqli_fetch_array($result_investigation)) {
        $ii ++;
             
        
        $date_convert = date("F jS, Y", strtotime($row1['date_added'])); 
        $transaction_codes = $row1['transaction_code'];
        $amount_fmt = number_format($row1['amount'], 2, '.', ',');
        $sik_head_prduct = '<table style="border-color: #666; color:#666" cellspacing = "2" cellpadding = "0" >';
        $sik_foot_prduct = '</table>';
        $sik_body_prduct = '';
    
        $sik_body_prduct .= '<thead>' .
                '<tr>' .
                '<td style="text-align: left;">' . $ii . '</td>' .
                '<td style="text-align: left; ">' . $date_convert.'</td>' .
                '<td style="text-align: left; ">' . $transaction_codes  . '</td>' . 
                '<td style="text-align: left; ">' . $amount_fmt  . '</td>' . 
                '</tr>
                </thead>';
    
        $pdf->writeHTML($sik_head_prduct . $sik_body_prduct . $sik_foot_prduct, FALSE, false, true, false, '');
    }

    
$sik_head_prduct_v = '<table style="border-color: #666; color:#666" cellspacing = "2" cellpadding = "0" >';
$sik_foot_prduct_v = '</table>';
$sik_body_prduct_v = '';

$sik_body_prduct_v .= '<thead>' .
        '<tr>' .
        '<td style="text-align: left;">' . "" . '</td>' .
        '<td style="text-align: left; ">' . "".'</td>' .
        '<td style="text-align: left; ">' . "<strong>Sub Total:</strong>"  . '</td>' . 
        '<td style="text-align: left; ">' . $amount_total_fmt_investigation  . '</td>' . 
        '</tr>
        </thead>';

$pdf->writeHTML($sik_head_prduct_v . $sik_body_prduct_v . $sik_foot_prduct_v, FALSE, false, true, false, '');

$pdf->writeHTML($headingSpace, true, 0, true, 0);
$pdf->writeHTML($headingSpace, true, 0, true, 0);





$topic4 = '<strong > <label style="color: #666"> Drug Dispensed Payments Received </label></strong>';
$pdf->writeHTML($topic4, true, 0, true, 0, 'L');

$pdf->writeHTML($headingSpace, true, 0, true, 0);


$iii = 0;
$sik_head_title_dg = '<table  style="background-color: #666; border-color: #fff; color:#fff" cellspacing = "5" cellpadding = "0" >';
$sik_foot_title_dg = '</table>';
$sik_head_prduct_dg = '';

$sik_head_prduct_dg .= '
            <thead><tr style="background-color: #666; color: #fff;">
         <td style="text-align: left;"><strong>#</strong></td>
         <td style="text-align: left;"><strong>Date recorded</strong></td>
         <td style="text-align: left;"><strong>Transaction #</strong></td>
         <td style="text-align: left;"><strong>Amount(GH&cent;)</strong></td>
          
      </tr>' .
        ' </thead>';


$pdf->writeHTML($sik_head_title_dg . $sik_head_prduct_dg . $sik_foot_title_dg, FALSE, false, true, false, '');



while ($row2 = mysqli_fetch_array($result_drug_dispensed)) {
        $iii ++;
             
        
        $date_convert = date("F jS, Y", strtotime($row2['date_added'])); 
        $transaction_codes = $row2['transcode'];
        $amount_fmt = number_format($row2['amount'], 2, '.', ',');
        $sik_head_prduct = '<table style="border-color: #666; color:#666" cellspacing = "2" cellpadding = "0" >';
        $sik_foot_prduct = '</table>';
        $sik_body_prduct = '';
    
        $sik_body_prduct .= '<thead>' .
                '<tr>' .
                '<td style="text-align: left;">' . $iii . '</td>' .
                '<td style="text-align: left; ">' . $date_convert.'</td>' .
                '<td style="text-align: left; ">' . $transaction_codes  . '</td>' . 
                '<td style="text-align: left; ">' . $amount_fmt  . '</td>' . 
                '</tr>
                </thead>';
    
        $pdf->writeHTML($sik_head_prduct . $sik_body_prduct . $sik_foot_prduct, FALSE, false, true, false, '');
    }



    $sik_head_prduct_v = '<table style="border-color: #666; color:#666" cellspacing = "2" cellpadding = "0" >';
$sik_foot_prduct_v = '</table>';
$sik_body_prduct_v = '';

$sik_body_prduct_v .= '<thead>' .
        '<tr>' .
        '<td style="text-align: left;">' . "" . '</td>' .
        '<td style="text-align: left; ">' . "".'</td>' .
        '<td style="text-align: left; ">' . "<strong>Sub Total:</strong>"  . '</td>' . 
        '<td style="text-align: left; ">' . $amount_total_fmt_drug  . '</td>' . 
        '</tr>
        </thead>';

$pdf->writeHTML($sik_head_prduct_v . $sik_body_prduct_v . $sik_foot_prduct_v, FALSE, false, true, false, '');






$line_space =  '<hr style="color: #666; height:3px;"/>';


$pdf->writeHTML($line_space, true, 0, true, 0);

$sik_head_prduct_v_total = '<table style="" cellspacing = "" cellpadding = "" >';
$sik_foot_prduct_v_total = '</table>';
$sik_body_prduct_v_total = '';

$sik_body_prduct_v_total .= '<thead>' .
        '<tr>' .
        '<td style="text-align: left;">' . "" . '</td>' .
        '<td style="text-align: left; ">' . "".'</td>' .
        '<td style="text-align: left; ">' . "<strong>Total:</strong>"  . '</td>' . 
        '<td style="text-align: left; ">' ."<strong>". $overallTotal  ."</strong>". '</td>' . 
        '</tr>
        </thead>';

$pdf->writeHTML($sik_head_prduct_v_total . $sik_body_prduct_v_total . $sik_foot_prduct_v_total, FALSE, false, true, false, '');

    
$pdf->writeHTML($line_space, true, 0, true, 0);   



}







 

$pdf->lastPage();

ob_end_clean();
//$activity = "printed Report on All Deposits made";
//require_once '../functions/logging.php';
$pdf->Output();





