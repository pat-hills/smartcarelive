<?php

//require '../functions/conndb.php';
 

function add_expenses_items($name) {

    global $connection;

    $user_id = $_SESSION['uid'];
	$date = date('Y-m-d');
    $type = "Expense";


    $sql = "INSERT INTO account_items SET acc_name = '" . $name . "', account_type = '" . $type . "', date_reg = '" . $date . "', created_by = '" . $user_id . "' ";

    if (mysqli_query($connection,$sql)) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function add_recordings($name,$amt) {

    global $connection;

    $user_id = $_SESSION['uid'];
	$date = date('Y-m-d');
    $type = "Expense";


    $sql = "INSERT INTO income_exp SET acc_name = '" . $name . "', acc_amt = '" . $amt . "', date_reg = '" . $date . "', created_by = '" . $user_id . "' ";

    if (mysqli_query($connection,$sql)) {
        return TRUE;
    } else {
        return FALSE;
    }
}


function list_expense_items() {
    global $connection;
    $sql = "SELECT * FROM account_items";
    $query_run = mysqli_query($connection,$sql);

    while ($row = mysqli_fetch_array($query_run)) {
        //$doctor = staff_info($row['doctor_id']);
        echo"
			 <tr>						
				<td>" . $row['acc_name'] . "</td>
				<td>" . $row['date_reg'] . " </td>
				<td class='text-center'><a onclick='return confirm(\"CLICK OK TO CONFIRM DELETION OR CANCEL TO PREVENT DELETION...\")' class='label label-danger' href='tasks/undo_add_room.php?id=" . $row['id'] . "'><i class='fa fa-times'></i></a></td>
			
                </tr>
		";
    }
}

function select_expense_items() {
    global $connection;
    
    $sql = "SELECT * FROM account_items WHERE deleted = 'NO'";

    $result = mysqli_query($connection,$sql) or die(mysqli_error());

    while ($row = mysqli_fetch_assoc($result)) {

        echo "
            <option value='" . $row['acc_name'] . "'>" . $row['acc_name'] . "</option>
        ";
    }
}

function list_expense_recordings() {
    global $connection;
    $sql = "SELECT id, date_reg, acc_name, acc_amt FROM income_exp WHERE deleted = 'NO'";
;
    $query_run = mysqli_query($connection,$sql);

    while ($row = mysqli_fetch_array($query_run)) {
        //$doctor = staff_info($row['doctor_id']);
        echo"
			 <tr>		
             <td>" . $row['date_reg'] . " </td>				
				<td>" . $row['acc_name'] . "</td>
				<td>" . $row['acc_amt'] . " </td>
				<td class='text-center'><a onclick='return confirm(\"CLICK OK TO CONFIRM DELETION OR CANCEL TO PREVENT DELETION...\")' class='label label-danger' href='tasks/undo_add_room.php?id=" . $row['id'] . "'><i class='fa fa-times'></i></a></td>
			
                </tr>
		";
    }
}


//EXPENSE LOAD REPORT

function load_expense_report($period,$startDate,$endDate) {

   
    global $connection;
    $sql = "";
    
    
    if($period=="Daily"){
        $date = date('Y-m-d');
        $sql = "SELECT id, date_reg, acc_name, SUM(acc_amt) as total_amount FROM income_exp WHERE deleted = 'NO' AND date_reg > DATE_SUB(NOW(), INTERVAL 1 DAY) GROUP BY acc_name, date_reg ";
       
         
    }
    if($period=="Weekly"){
        $sql = "SELECT id, date_reg, acc_name,  SUM(acc_amt) as total_amount FROM income_exp WHERE deleted = 'NO' AND date_reg > DATE_SUB(NOW(), INTERVAL 1 WEEK) GROUP BY acc_name, date_reg ";
         
    }
    if($period=="Monthly"){
        $sql = "SELECT id, date_reg, acc_name,  SUM(acc_amt) as total_amount  FROM income_exp WHERE deleted = 'NO' AND date_reg > DATE_SUB(NOW(), INTERVAL 1 MONTH) GROUP BY acc_name, date_reg ";
         
    }
    if($period=="Yearly"){
        $sql = "SELECT id, date_reg, acc_name,  SUM(acc_amt) as total_amount FROM income_exp WHERE deleted = 'NO' AND date_reg > DATE_SUB(NOW(), INTERVAL 1 YEAR) GROUP BY acc_name, date_reg ";
         
    }

    if($period=="" && !empty($startDate) && !empty($endDate)){
        $sql = "SELECT id, date_reg, acc_name, SUM(acc_amt) as total_amount FROM income_exp WHERE date_reg >= '".$startDate."' AND date_reg <= '".$endDate."' AND deleted = 'NO' GROUP BY acc_name,date_reg ";
    }
   
    $query_run = mysqli_query($connection,$sql);
  
    if($query_run){
        return $query_run;
    }
       
}

function load_sum_expense_report($period,$startDate,$endDate) {
    global $connection;
    $sql = "";
    if($period=="Daily"){
        $date = date('Y-m-d');
        $sql = "SELECT SUM(acc_amt) FROM income_exp WHERE deleted = 'NO' AND date_reg > DATE_SUB(NOW(), INTERVAL 1 DAY) ";
         
    }
    if($period=="Weekly"){
        $sql = "SELECT SUM(acc_amt) FROM income_exp WHERE deleted = 'NO' AND date_reg > DATE_SUB(NOW(), INTERVAL 1 WEEK) ";
    }
    if($period=="Monthly"){
        $sql = "SELECT SUM(acc_amt) FROM income_exp WHERE deleted = 'NO' AND date_reg > DATE_SUB(NOW(), INTERVAL 1 MONTH) ";
    }
    if($period=="Yearly"){
        $sql = "SELECT SUM(acc_amt) FROM income_exp WHERE deleted = 'NO' AND date_reg > DATE_SUB(NOW(), INTERVAL 1 YEAR) ";
    }

    if($period=="" && !empty($startDate) && !empty($endDate)){
        $sql = "SELECT  SUM(acc_amt) FROM income_exp WHERE date_reg >= '".$startDate."' AND date_reg <= '".$endDate."' AND deleted = 'NO' ";
    }
   
    $getAmount  = mysqli_query($connection,$sql);
   
    while($thePatients = mysqli_fetch_array($getAmount)){
    
        return  $thePatients['SUM(acc_amt)'];
    }
}

//END OF EXPENSE LOAD REPORT



//CONSULTATION LOAD REPORT

function load_consultation_report($period,$startDate,$endDate) {
    global $connection;
    $item = "CONSULTATION";
    $cashier_id = @$_SESSION['uid']; 
    $logged_in = @$_SESSION['logged_in']; 
    $sql = "";
    if($period=="Daily"){
        $date = date('Y-m-d');
        if($logged_in=="4"){
            $sql = "SELECT id, date_added,item, SUM(amount) as total_amount FROM consultingpayment2cashier WHERE state = 1 AND cashier_id = '$cashier_id' AND  date_added > DATE_SUB(NOW(), INTERVAL 1 DAY) GROUP BY item, date_added ";
       
        }else{
            $sql = "SELECT id, date_added,item, SUM(amount) as total_amount FROM consultingpayment2cashier WHERE state = 1 AND  date_added > DATE_SUB(NOW(), INTERVAL 1 DAY) GROUP BY item, date_added ";
       
        }
         
    }
    if($period=="Weekly"){
        if($logged_in == "4"){
            $sql = "SELECT id, date_added,item, SUM(amount) as total_amount FROM consultingpayment2cashier WHERE state = 1 AND cashier_id = '$cashier_id' AND date_added > DATE_SUB(NOW(), INTERVAL 1 WEEK) GROUP BY item, date_added ";
    
        }else{
            $sql = "SELECT id, date_added,item, SUM(amount) as total_amount FROM consultingpayment2cashier WHERE state = 1 AND date_added > DATE_SUB(NOW(), INTERVAL 1 WEEK) GROUP BY item, date_added ";
    
        }
        
    }
    if($period=="Monthly"){
        if($logged_in == "4"){
            $sql = "SELECT id, date_added,item, SUM(amount) as total_amount FROM consultingpayment2cashier WHERE state = 1 AND cashier_id = '$cashier_id' AND date_added > DATE_SUB(NOW(), INTERVAL 1 MONTH) GROUP BY item, date_added ";
    
        }else{
            $sql = "SELECT id, date_added,item, SUM(amount) as total_amount FROM consultingpayment2cashier WHERE state = 1 AND date_added > DATE_SUB(NOW(), INTERVAL 1 MONTH) GROUP BY item, date_added ";
    
        }
        
    }
    if($period=="Yearly"){
        if($logged_in == "4"){
            $sql = "SELECT id, date_added,item, SUM(amount) as total_amount FROM consultingpayment2cashier WHERE state = 1 AND cashier_id = '$cashier_id' AND date_added > DATE_SUB(NOW(), INTERVAL 1 YEAR) GROUP BY item, date_added ";
    
        }else{
            $sql = "SELECT id, date_added,item, SUM(amount) as total_amount FROM consultingpayment2cashier WHERE state = 1 AND date_added > DATE_SUB(NOW(), INTERVAL 1 YEAR) GROUP BY item, date_added ";
    
        }
    }
    if($period=="" && !empty($startDate) && !empty($endDate)){
        if($logged_in == "4"){
            $sql = "SELECT id, date_added, item, SUM(amount) as total_amount FROM consultingpayment2cashier WHERE state = 1 AND cashier_id = '$cashier_id' AND date_added >= '".$startDate."' AND date_added <= '".$endDate."' GROUP BY item,date_added ";
    
        }else{
            $sql = "SELECT id, date_added, item, SUM(amount) as total_amount FROM consultingpayment2cashier WHERE state = 1 AND date_added >= '".$startDate."' AND date_added <= '".$endDate."' GROUP BY item,date_added ";
    
        }
    }
   
    $query_run = mysqli_query($connection,$sql);
  
    if($query_run){
        return $query_run;
    }

}

function load_sum_consultation_report($period,$startDate,$endDate) {

    global $connection;
    $sql = "";
    $cashier_id = @$_SESSION['uid']; 
    $logged_in = @$_SESSION['logged_in']; 
    if($period=="Daily"){
        $date = date('Y-m-d');
        if($logged_in == "4"){
            $sql = "SELECT SUM(amount) FROM consultingpayment2cashier WHERE state = 1 AND  cashier_id = '$cashier_id' AND  date_added > DATE_SUB(NOW(), INTERVAL 1 DAY) ";     
    
        }else{
            $sql = "SELECT SUM(amount) FROM consultingpayment2cashier WHERE state = 1 AND  date_added > DATE_SUB(NOW(), INTERVAL 1 DAY) ";     
    
        }
    }
    if($period=="Weekly"){
        if($logged_in == "4"){
            $sql = "SELECT SUM(amount) FROM consultingpayment2cashier WHERE state = 1 AND cashier_id = '$cashier_id' AND  date_added > DATE_SUB(NOW(), INTERVAL 1 WEEK) ";
    
        }else{
            $sql = "SELECT SUM(amount) FROM consultingpayment2cashier WHERE state = 1 AND  date_added > DATE_SUB(NOW(), INTERVAL 1 WEEK) ";
    
        }
    }
    if($period=="Monthly"){
        if($logged_in == "4"){
            $sql = "SELECT SUM(amount) FROM consultingpayment2cashier WHERE state = 1 AND cashier_id = '$cashier_id' AND  date_added > DATE_SUB(NOW(), INTERVAL 1 MONTH) ";
    
        }else{
            $sql = "SELECT SUM(amount) FROM consultingpayment2cashier WHERE state = 1 AND date_added > DATE_SUB(NOW(), INTERVAL 1 MONTH) ";
    
        }
    }
    if($period=="Yearly"){
        if($logged_in == "4"){
            $sql = "SELECT SUM(amount) FROM consultingpayment2cashier WHERE state = 1 AND cashier_id = '$cashier_id' AND  date_added > DATE_SUB(NOW(), INTERVAL 1 YEAR) ";
  
        }else{
            $sql = "SELECT SUM(amount) FROM consultingpayment2cashier WHERE state = 1 AND  date_added > DATE_SUB(NOW(), INTERVAL 1 YEAR) ";
  
        }
         }

    if($period=="" && !empty($startDate) && !empty($endDate)){
        if($logged_in == "4"){
            $sql = "SELECT  SUM(amount) FROM consultingpayment2cashier WHERE state = 1 AND cashier_id = '$cashier_id' AND date_added >= '".$startDate."' AND date_added <= '".$endDate."' ";
    
        }else{
            $sql = "SELECT  SUM(amount) FROM consultingpayment2cashier WHERE state = 1 AND date_added >= '".$startDate."' AND date_added <= '".$endDate."' ";
    
        }
    }
   
    $getAmount  = mysqli_query($connection,$sql);
     
    while($thePatients = mysqli_fetch_array($getAmount)){
    
        return  $thePatients['SUM(amount)'];
    }
    
    
}

//END OF CONSULTATION LOAD REPORT



//LABORATORY LOAD OF REPORT

function load_laboratory_report($period,$startDate,$endDate) {
    global $connection;
    $item = "INVESTIGATIONS";
    $cashier_id = @$_SESSION['uid']; 
    $logged_in = @$_SESSION['logged_in']; 
    $sql = "";
    if($period=="Daily"){
        $date = date('Y-m-d');
       if($logged_in == "4"){
        $sql = "SELECT id, date_added, SUM(amount) as total_amount,item FROM investigation_payemnt2_cashier WHERE date_added > DATE_SUB(NOW(), INTERVAL 1 DAY) AND state = '1'AND cashier_id = '$cashier_id' GROUP BY item,date_added ";
        
       }else {
        # code...
        $sql = "SELECT id, date_added, SUM(amount) as total_amount,item FROM investigation_payemnt2_cashier WHERE date_added > DATE_SUB(NOW(), INTERVAL 1 DAY) AND state = '1' GROUP BY item,date_added ";
        
       } 
    }
    if($period=="Weekly"){
        if($logged_in == "4"){
            $sql = "SELECT id, date_added, SUM(amount) as total_amount,item FROM investigation_payemnt2_cashier WHERE date_added > DATE_SUB(NOW(), INTERVAL 1 WEEK) AND state = '1' AND cashier_id = '$cashier_id'  GROUP BY item,date_added ";
  
        }else{
            $sql = "SELECT id, date_added, SUM(amount) as total_amount,item FROM investigation_payemnt2_cashier WHERE date_added > DATE_SUB(NOW(), INTERVAL 1 WEEK) AND state = '1'  GROUP BY item,date_added ";
  
        }
         }
    if($period=="Monthly"){
        if($logged_in == "4"){
            $sql = "SELECT id, date_added, SUM(amount) as total_amount,item FROM investigation_payemnt2_cashier WHERE date_added > DATE_SUB(NOW(), INTERVAL 1 MONTH) AND state = '1' AND cashier_id = '$cashier_id' GROUP BY item,date_added";
    
        }else{
            $sql = "SELECT id, date_added, SUM(amount) as total_amount,item FROM investigation_payemnt2_cashier WHERE date_added > DATE_SUB(NOW(), INTERVAL 1 MONTH) AND state = '1' GROUP BY item,date_added";
    
        }
    }
    if($period=="Yearly"){
        if($logged_in == "4"){
            $sql = "SELECT id, date_added, SUM(amount) as total_amount,item FROM investigation_payemnt2_cashier WHERE date_added > DATE_SUB(NOW(), INTERVAL 1 YEAR) AND state = '1' AND cashier_id = '$cashier_id'  GROUP BY item,date_added";
    
        }else{
            $sql = "SELECT id, date_added, SUM(amount) as total_amount,item FROM investigation_payemnt2_cashier WHERE date_added > DATE_SUB(NOW(), INTERVAL 1 YEAR) AND state = '1'  GROUP BY item,date_added";
    
        }
    }

    if($period=="" && !empty($startDate) && !empty($endDate)){
      if($logged_in == "4"){
        $sql = "SELECT id, date_added, item, SUM(amount) as total_amount FROM investigation_payemnt2_cashier WHERE date_added >= '".$startDate."' AND date_added <= '".$endDate."' AND state = '1' AND cashier_id = '$cashier_id'  GROUP BY item,date_added ";
    
      }else{
        $sql = "SELECT id, date_added, item, SUM(amount) as total_amount FROM investigation_payemnt2_cashier WHERE date_added >= '".$startDate."' AND date_added <= '".$endDate."' AND state = '1'  GROUP BY item,date_added ";
    
      }
    }
   
    $query_run = mysqli_query($connection,$sql);
  
    if($query_run){
        return $query_run;
    }


    
}

function load_sum_laboratory_report($period,$startDate,$endDate) {
    global $connection;
    $sql = "";
    $cashier_id = @$_SESSION['uid']; 
    $logged_in = @$_SESSION['logged_in']; 
    if($period=="Daily"){
        $date = date('Y-m-d');
        if($logged_in=="4"){
            $sql = "SELECT SUM(amount) FROM investigation_payemnt2_cashier WHERE  date_added > DATE_SUB(NOW(), INTERVAL 1 DAY) AND state = '1' AND cashier_id = '$cashier_id' ";    
    
        }else{
            $sql = "SELECT SUM(amount) FROM investigation_payemnt2_cashier WHERE  date_added > DATE_SUB(NOW(), INTERVAL 1 DAY) AND state = '1' ";    
    
        }
    }
    if($period=="Weekly"){
        if($logged_in=="4"){
            $sql = "SELECT SUM(amount) FROM investigation_payemnt2_cashier WHERE  date_added > DATE_SUB(NOW(), INTERVAL 1 WEEK) AND state = '1' AND cashier_id = '$cashier_id' ";
    
        }else{
            $sql = "SELECT SUM(amount) FROM investigation_payemnt2_cashier WHERE  date_added > DATE_SUB(NOW(), INTERVAL 1 WEEK) AND state = '1'";
    
        }
    }
    if($period=="Monthly"){
        if($logged_in == "4"){
            $sql = "SELECT SUM(amount) FROM investigation_payemnt2_cashier WHERE  date_added > DATE_SUB(NOW(), INTERVAL 1 MONTH) AND state = '1' AND cashier_id = '$cashier_id' ";
    
        }else{
            $sql = "SELECT SUM(amount) FROM investigation_payemnt2_cashier WHERE  date_added > DATE_SUB(NOW(), INTERVAL 1 MONTH) AND state = '1'";
    
        }
    }
    if($period=="Yearly"){
        if($logged_in == "4"){
            $sql = "SELECT SUM(amount) FROM investigation_payemnt2_cashier WHERE  date_added > DATE_SUB(NOW(), INTERVAL 1 YEAR) AND state = '1' AND cashier_id = '$cashier_id'";
    
        }else{
            $sql = "SELECT SUM(amount) FROM investigation_payemnt2_cashier WHERE  date_added > DATE_SUB(NOW(), INTERVAL 1 YEAR) AND state = '1'";
    
        }
    }

    if($period=="" && !empty($startDate) && !empty($endDate)){
        if($logged_in == "4"){
            $sql = "SELECT  SUM(amount) FROM investigation_payemnt2_cashier WHERE date_added >= '".$startDate."' AND date_added <= '".$endDate."' AND cashier_id = '$cashier_id' ";
    
        }else{
            $sql = "SELECT  SUM(amount) FROM investigation_payemnt2_cashier WHERE date_added >= '".$startDate."' AND date_added <= '".$endDate."' ";
    
        }
    }
    
   
    $getAmount  = mysqli_query($connection,$sql);
   
    while($thePatients = mysqli_fetch_array($getAmount)){
    
        return  $thePatients['SUM(amount)'];
    } 
}

//END OF LABORATORY LOAD OF REPORT



//LABORATORY LOAD OF REPORT

function load_drugs_report($period,$startDate,$endDate) {
    global $connection;
    $item = "MEDICATIONS";
    $sql = "";
    $cashier_id = @$_SESSION['uid']; 
    $logged_in = @$_SESSION['logged_in']; 
    if($period=="Daily"){
        $date = date('Y-m-d');
          if($logged_in == "4"){
            $sql = "SELECT id, date_added,item, SUM(amount) as total_amount FROM drug2depenseinfo WHERE date_added > DATE_SUB(NOW(), INTERVAL 1 DAY) AND state = '2' AND cashier_id = '$cashier_id'  GROUP BY item,date_added ";
        
          }else{
            $sql = "SELECT id, date_added,item, SUM(amount) as total_amount FROM drug2depenseinfo WHERE date_added > DATE_SUB(NOW(), INTERVAL 1 DAY) AND state = '2'  GROUP BY item,date_added ";
        
          }
        
    }
    if($period=="Weekly"){
        if($logged_in == "4"){
            $sql = "SELECT id, date_added, item, SUM(amount) as total_amount FROM drug2depenseinfo WHERE date_added > DATE_SUB(NOW(), INTERVAL 1 WEEK) AND state = '2' AND cashier_id = '$cashier_id'  GROUP BY item,date_added ";
    
        }else{
            $sql = "SELECT id, date_added, item, SUM(amount) as total_amount FROM drug2depenseinfo WHERE date_added > DATE_SUB(NOW(), INTERVAL 1 WEEK) AND state = '2'  GROUP BY item,date_added ";
    
        }
    }
    if($period=="Monthly"){
       if($logged_in =="4"){
        $sql = "SELECT id, date_added, item, SUM(amount) as total_amount FROM drug2depenseinfo WHERE date_added > DATE_SUB(NOW(), INTERVAL 1 MONTH) AND state = '2' AND cashier_id = '$cashier_id'  GROUP BY item,date_added ";
    
       }else{
        $sql = "SELECT id, date_added, item, SUM(amount) as total_amount FROM drug2depenseinfo WHERE date_added > DATE_SUB(NOW(), INTERVAL 1 MONTH) AND state = '2'  GROUP BY item,date_added ";
    
       }

    }
    if($period=="Yearly"){
        if($logged_in == "4"){
            $sql = "SELECT id, date_added, item, SUM(amount) as total_amount FROM drug2depenseinfo WHERE date_added > DATE_SUB(NOW(), INTERVAL 1 YEAR) AND state = '2' AND cashier_id = '$cashier_id'  GROUP BY item,date_added ";
    
        }else{
            $sql = "SELECT id, date_added, item, SUM(amount) as total_amount FROM drug2depenseinfo WHERE date_added > DATE_SUB(NOW(), INTERVAL 1 YEAR) AND state = '2'  GROUP BY item,date_added ";
    
        }
    }

    if($period=="" && !empty($startDate) && !empty($endDate)){
        if($logged_in =="4"){
            $sql = "SELECT id, date_added, item, SUM(amount) as total_amount FROM drug2depenseinfo WHERE date_added >= '".$startDate."' AND date_added <= '".$endDate."' AND state = '2' AND cashier_id = '$cashier_id'  GROUP BY item,date_added ";
    
        }else{
            $sql = "SELECT id, date_added, item, SUM(amount) as total_amount FROM drug2depenseinfo WHERE date_added >= '".$startDate."' AND date_added <= '".$endDate."' AND state = '2'  GROUP BY item,date_added ";
    
        }
    }
    
   
    $query_run = mysqli_query($connection,$sql);
  
    if($query_run){
        return $query_run;
    }


  
}

function load_sum_drugs_report($period,$startDate,$endDate) {
    global $connection;
    $sql = "";
    $cashier_id = @$_SESSION['uid']; 
    $logged_in = @$_SESSION['logged_in']; 
    if($period=="Daily"){
        $date = date('Y-m-d');
        if($logged_in == "4"){
            $sql = "SELECT SUM(amount) FROM drug2depenseinfo WHERE  date_added > DATE_SUB(NOW(), INTERVAL 1 DAY) AND state = '2' AND cashier_id = '$cashier_id'";    
    
        }else{
            $sql = "SELECT SUM(amount) FROM drug2depenseinfo WHERE  date_added > DATE_SUB(NOW(), INTERVAL 1 DAY) AND state = '2' ";    
    
        }
    }
    if($period=="Weekly"){
     if($logged_in == "4"){
        $sql = "SELECT SUM(amount) FROM drug2depenseinfo WHERE  date_added > DATE_SUB(NOW(), INTERVAL 1 WEEK) AND state = '2' AND cashier_id = '$cashier_id'";
    
     }else{
        $sql = "SELECT SUM(amount) FROM drug2depenseinfo WHERE  date_added > DATE_SUB(NOW(), INTERVAL 1 WEEK) AND state = '2'";
    
     }
    }
    if($period=="Monthly"){
        if($logged_in == "4"){
            $sql = "SELECT SUM(amount) FROM drug2depenseinfo WHERE  date_added > DATE_SUB(NOW(), INTERVAL 1 MONTH) AND state = '2' AND cashier_id = '$cashier_id'";
    
        }else{
            $sql = "SELECT SUM(amount) FROM drug2depenseinfo WHERE  date_added > DATE_SUB(NOW(), INTERVAL 1 MONTH) AND state = '2'";
    
        }
   }
    if($period=="Yearly"){
        if($logged_in == "4"){
            $sql = "SELECT SUM(amount) FROM drug2depenseinfo WHERE  date_added > DATE_SUB(NOW(), INTERVAL 1 YEAR) AND state = '2' AND cashier_id = '$cashier_id'";
    
        }else{
            $sql = "SELECT SUM(amount) FROM drug2depenseinfo WHERE  date_added > DATE_SUB(NOW(), INTERVAL 1 YEAR) AND state = '2'";
    
        }
    }

    
    if($period=="" && !empty($startDate) && !empty($endDate)){
        if($logged_in == "4"){
            $sql = "SELECT  SUM(amount) FROM drug2depenseinfo WHERE date_added >= '".$startDate."' AND date_added <= '".$endDate."' AND state = '2' AND cashier_id = '$cashier_id' ";
    
        }else{
            $sql = "SELECT  SUM(amount) FROM drug2depenseinfo WHERE date_added >= '".$startDate."' AND date_added <= '".$endDate."' AND state = '2' ";
    
        }
    }
    
   
    $getAmount  = mysqli_query($connection,$sql);
    
    while($thePatients = mysqli_fetch_array($getAmount)){
    
        return  $thePatients['SUM(amount)'];
    } 
}

//END OF LABORATORY LOAD OF REPORT




////REPORTS FOR ADMIN

function date_range_consultation($startDate,$endDate,$ClientType){
	global $connection;

   $sql = "";

   //$date = date('Y-m-d'); 

    if(empty($startDate) && empty($endDate) && !empty($ClientType)){
        if($ClientType == "INSURANCE-CLIENT"){
            $sql = "SELECT c.*, s.membership_id, s.scheme 
        FROM tbl_consulting c
        INNER JOIN scheme s ON c.patient_id = s.patient_id
        WHERE c.date_sent = '".$startDate."'";
            
        }else{

            $sql = "SELECT c.* 
FROM tbl_consulting c
WHERE c.patient_id NOT IN (
    SELECT patient_id FROM scheme
)
AND c.date_sent = '".$startDate."' ";


        }
       // $sql = "SELECT * FROM `tbl_consulting` WHERE date_sent = '".$startDate."'"; 
    }

    if(!empty($startDate) && empty($endDate) && !empty($ClientType)){
       if($ClientType == "INSURANCE-CLIENT"){
            $sql = "SELECT c.*, s.membership_id, s.scheme 
        FROM tbl_consulting c
        INNER JOIN scheme s ON c.patient_id = s.patient_id
        WHERE c.date_sent = '".$startDate."'";
            
        }else{

            $sql = "SELECT c.* 
FROM tbl_consulting c
WHERE c.patient_id NOT IN (
    SELECT patient_id FROM scheme
)
AND c.date_sent = '".$startDate."' ";


        } 
    }

    if(!empty($startDate) && !empty($endDate) && !empty($ClientType)){
        if($ClientType == "INSURANCE-CLIENT"){
            $sql = "SELECT c.*, s.membership_id, s.scheme 
        FROM tbl_consulting c
        INNER JOIN scheme s ON c.patient_id = s.patient_id
        WHERE c.date_sent >= '".$startDate."' AND c.date_sent <= '".$startDate."'   ";
            
        }else{

        //     $sql = "SELECT c.* 
        // FROM tbl_consulting c
        // LEFT JOIN scheme s ON c.patient_id = s.patient_id
        // WHERE c.date_sent >= '".$startDate."' AND c.date_sent <= '".$startDate."'   ";

         $sql = "SELECT c.* 
FROM tbl_consulting c
WHERE c.patient_id NOT IN (
    SELECT patient_id FROM scheme
)
AND c.date_sent >= '".$startDate."' AND c.date_sent <= '".$startDate."' ";


        }
       // $sql = "SELECT * FROM tbl_consulting WHERE date_sent >= '$startDate' AND date_sent <= '$endDate'";    
    }
	 
	

    // Execute the query
    $query_run = mysqli_query($connection, $sql);

    // Handle errors
    if (!$query_run) {
        die("Query Failed: " . mysqli_error($connection));
    }

    // Return the result set
    return $query_run;
    	
}


function clientType($type){
	global $connection;

   // global $connection;
    $date = date('Y-m-d');
    $sql = "";

    // Determine SQL query based on the type
    if ($type === "ALL-CLIENTS"|| $type === "") {
        $sql = "SELECT p.patient_id, p.date_created, p.surname, p.other_names, s.scheme,s.membership_id
                FROM tbl_patient_info p
                LEFT JOIN scheme s ON p.patient_id = s.patient_id
                ORDER BY s.scheme IS NOT NULL DESC, s.scheme ASC";
    } elseif ($type === "CASH-CLIENTS") {
        $sql = "SELECT p.patient_id, p.date_created, p.surname, p.other_names, NULL AS scheme
                FROM tbl_patient_info p
                LEFT JOIN scheme s ON p.patient_id = s.patient_id
                WHERE s.scheme IS NULL
                ORDER BY p.date_created DESC";
    } elseif ($type === "INSURANCE-CLIENTS") {
        $sql = "SELECT p.patient_id, p.date_created, p.surname, p.other_names, s.scheme,s.membership_id
FROM tbl_patient_info p
INNER JOIN scheme s ON p.patient_id = s.patient_id
WHERE s.scheme IS NOT NULL AND s.scheme != ''
AND s.membership_id IS NOT NULL AND s.membership_id != ''
ORDER BY s.scheme ASC
";
    } else {
       // echo "Invalid client type.";
        return;
    }

   // $query_run = mysqli_query($connection, $sql) or die(mysqli_error($connection));
	
  

    // Execute the query
    $query_run = mysqli_query($connection, $sql);

    // Handle errors
    if (!$query_run) {
        die("Query Failed: " . mysqli_error($connection));
    }

    // Return the result set
    return $query_run;
    	
}

function date_range_medication($startDate,$endDate,$ClientType){
	global $connection;

    $sql = "";


   if(empty($startDate) && empty($endDate) &&!empty($ClientType)){
 if($ClientType == "INSURANCE-CLIENT"){
            $sql = "SELECT c.*, s.membership_id, s.scheme 
        FROM tbl_precribtion c
        INNER JOIN scheme s ON c.patient_id = s.patient_id
        WHERE DATE(c.date_added) = '".$startDate."'";
            
        }else{

        //     $sql = "SELECT c.* 
        // FROM tbl_precribtion c
        // LEFT JOIN scheme s ON c.patient_id = s.patient_id
        // WHERE s.patient_id IS NULL AND DATE(c.date_added) = '".$startDate."'";

         $sql = "SELECT c.* 
FROM tbl_precribtion c
WHERE c.patient_id NOT IN (
    SELECT patient_id FROM scheme
)
AND DATE(c.date_added) = '".$startDate."' ";


        }

   // $sql = "SELECT * FROM tbl_precribtion WHERE DATE(date_added) = '".$startDate."'"; 
  
}

   if(!empty($startDate) && empty($endDate) && !empty($ClientType)){
if($ClientType == "INSURANCE-CLIENT"){
            $sql = "SELECT c.*, s.membership_id, s.scheme 
        FROM tbl_precribtion c
        INNER JOIN scheme s ON c.patient_id = s.patient_id
        WHERE DATE(c.date_added) = '".$startDate."'";
            
        }else{

        //     $sql = "SELECT c.* 
        // FROM tbl_precribtion c
        // LEFT JOIN scheme s ON c.patient_id = s.patient_id
        // WHERE s.patient_id IS NULL AND DATE(c.date_added) = '".$startDate."'";

          $sql = "SELECT c.* 
FROM tbl_precribtion c
WHERE c.patient_id NOT IN (
    SELECT patient_id FROM scheme
)
AND DATE(c.date_added) = '".$startDate."' ";


        }


    //$sql = "SELECT * FROM tbl_precribtion WHERE DATE(date_added) = '".$startDate."'"; 
   }


	if(!empty($startDate) && !empty($endDate) && !empty($ClientType)){

if($ClientType == "INSURANCE-CLIENT"){
            $sql = "SELECT c.*, s.membership_id, s.scheme 
        FROM tbl_precribtion c
        INNER JOIN scheme s ON c.patient_id = s.patient_id
        WHERE DATE(c.date_added) >= '$startDate' AND DATE(c.date_added) <= '$endDate'";
            
        }else{

        //     $sql = "SELECT c.* 
        // FROM tbl_precribtion c
        // LEFT JOIN scheme s ON c.patient_id = s.patient_id
        // WHERE s.patient_id IS NULL AND DATE(c.date_added) >= '$startDate' AND DATE(c.date_added) <= '$endDate'";

         $sql = "SELECT c.* 
FROM tbl_precribtion c
WHERE c.patient_id NOT IN (
    SELECT patient_id FROM scheme
)
AND DATE(c.date_added) >= '$startDate' AND DATE(c.date_added) <= '$endDate'";


        }



        //$sql = "SELECT * FROM tbl_precribtion WHERE DATE(date_added) >= '$startDate' AND DATE(date_added) <= '$endDate'";
    }
	
  

    // Execute the query
    $query_run = mysqli_query($connection, $sql);

    // Handle errors
    if (!$query_run) {
        die("Query Failed: " . mysqli_error($connection));
    }

    // Return the result set
    return $query_run;
    	
}

function date_range_investigation($startDate,$endDate,$ClientType){
	global $connection;
	 


    if(empty($startDate) && empty($endDate) && !empty($ClientType)){
        if($ClientType == "INSURANCE-CLIENT"){
            $sql = "SELECT c.*, s.membership_id, s.scheme 
        FROM tbl_req_investigation c
        INNER JOIN scheme s ON c.patient_id = s.patient_id
        WHERE c.status = 1 AND c.payment_status = 1 AND c.processed_date = '".$startDate."'";
            
        }else{

        //     $sql = "SELECT c.* 
        // FROM tbl_req_investigation c
        // LEFT JOIN scheme s ON c.patient_id = s.patient_id
        // WHERE s.patient_id IS NULL AND c.status = 1 AND c.payment_status = 1 AND c.processed_date = '".$startDate."'";

  $sql = "SELECT c.* 
FROM tbl_req_investigation c
WHERE c.patient_id NOT IN (
    SELECT patient_id FROM scheme
)
AND c.status = 1 AND c.payment_status = 1 AND c.processed_date = '".$startDate."'";
        }
    }

    if(!empty($startDate) && empty($endDate)&& !empty($ClientType)){

 if($ClientType == "INSURANCE-CLIENT"){
            $sql = "SELECT c.*, s.membership_id, s.scheme 
        FROM tbl_req_investigation c
        INNER JOIN scheme s ON c.patient_id = s.patient_id
        WHERE c.status = 1 AND c.payment_status = 1 AND c.processed_date = '".$startDate."'";
            
        }else{

        //     $sql = "SELECT c.* 
        // FROM tbl_req_investigation c
        // LEFT JOIN scheme s ON c.patient_id = s.patient_id
        // WHERE s.patient_id IS NULL AND c.status = 1 AND c.payment_status = 1 AND c.processed_date = '".$startDate."'";


  $sql = "SELECT c.* 
FROM tbl_req_investigation c
WHERE c.patient_id NOT IN (
    SELECT patient_id FROM scheme
)
AND c.status = 1 AND c.payment_status = 1 AND c.processed_date = '".$startDate."'";
       
    }
        }

    
    


    if(!empty($startDate) && !empty($endDate)&& !empty($ClientType)){

         if($ClientType == "INSURANCE-CLIENT"){
            $sql = "SELECT c.*, s.membership_id, s.scheme 
        FROM tbl_req_investigation c
        INNER JOIN scheme s ON c.patient_id = s.patient_id
        WHERE c.status = 1 AND c.payment_status = 1  AND c.processed_date >= '$startDate' AND c.processed_date <= '$endDate'";
            
        }else{

            $sql = "SELECT c.* 
FROM tbl_req_investigation c
WHERE c.patient_id NOT IN (
    SELECT patient_id FROM scheme
)
AND c.status = 1 AND c.payment_status = 1 AND c.processed_date >= '$startDate' AND c.processed_date <= '$endDate'";

        //     $sql = "SELECT c.* 
        // FROM tbl_req_investigation c
        // LEFT JOIN scheme s ON c.patient_id = s.patient_id
        // WHERE s.patient_id IS NULL AND c.status = 1 AND c.payment_status = 1 AND c.processed_date >= '$startDate' AND c.processed_date <= '$endDate'";


        }
   // $sql = "SELECT * FROM tbl_req_investigation WHERE processed_date >= '$startDate' AND processed_date <= '$endDate' AND status = 1 AND payment_status = 1";

    }

  
    // Execute the query
    $query_run = mysqli_query($connection, $sql);

    // Handle errors
    if (!$query_run) {
        die("Query Failed: " . mysqli_error($connection));
    }

    // Return the result set
    return $query_run;
    	
}





function get_all_consultation($report){
	global $connection;
	 
	$date = date('Y-m-d'); 

    $sql = "";

	 
		$sql = "SELECT * FROM `tbl_consulting` WHERE date_sent = '".$date."'";

        // $sql = "SELECT SUM(amount) FROM investigation_payemnt2_cashier WHERE  date_added > DATE_SUB(NOW(), INTERVAL 1 WEEK) AND state = '1' AND cashier_id = '$cashier_id' ";
	 
    
	
    $query_run = mysqli_query($connection,$sql) or die(mysqli_error());

    if($report == FALSE){
        while($row = mysqli_fetch_array($query_run) ){

            echo"
              <tr>						
              <td>".$row['patient_id']."</td>
          
          <td>".patient_name($row['patient_id'])."</td>
      
          <td>".doctor_name($row['doctor_id'])."</td> 
             </tr>
          ";
              
          }

    }else{
        return $query_run;
    }
    	
		}




    function get_week_consultation($report){
        global $connection;
         
        $date = date('Y-m-d'); 
    
        $sql = "";
    
         
            $sql = "SELECT * FROM `tbl_consulting` WHERE date_sent > DATE_SUB(NOW(), INTERVAL 1 WEEK) ";
    
            // $sql = "SELECT SUM(amount) FROM investigation_payemnt2_cashier WHERE  date_added > DATE_SUB(NOW(), INTERVAL 1 WEEK) AND state = '1' AND cashier_id = '$cashier_id' ";
         
        
        
        $query_run = mysqli_query($connection,$sql) or die(mysqli_error());

        if($report == FALSE){
            while($row = mysqli_fetch_array($query_run) ){
    
                echo"
                  <tr>						
                  <td>".$row['patient_id']."</td>
              
              <td>".patient_name($row['patient_id'])."</td>
          
              <td>".doctor_name($row['doctor_id'])."</td> 
      
             <td>".date('jS F, Y', strtotime($row['date_sent']))."</td>
                 </tr>
              ";
                  
              }

        }else{
            return $query_run;
        }
            
        	}




        function get_month_consultation($report){
            global $connection;
             
            $date = date('Y-m-d'); 
        
            $sql = "";
        
             
                $sql = "SELECT * FROM `tbl_consulting` WHERE date_sent > DATE_SUB(NOW(), INTERVAL 1 MONTH) ";
        
                // $sql = "SELECT SUM(amount) FROM investigation_payemnt2_cashier WHERE  date_added > DATE_SUB(NOW(), INTERVAL 1 WEEK) AND state = '1' AND cashier_id = '$cashier_id' ";
             
            
            
            $query_run = mysqli_query($connection,$sql) or die(mysqli_error());

            if($report == FALSE){
                while($row = mysqli_fetch_array($query_run) ){
        
                    echo"
                      <tr>						
                      <td>".$row['patient_id']."</td>
                  
                  <td>".patient_name($row['patient_id'])."</td>
              
                  <td>".doctor_name($row['doctor_id'])."</td> 
                   <td>".date('jS F, Y', strtotime($row['date_sent']))."</td>
                     </tr>
                  ";
                      
                  }

            }else {
                return $query_run;
            }
                
            	}



    
            function get_year_consultation($report){
                global $connection;
                 
                $date = date('Y-m-d'); 
            
                $sql = "";
            
                 
                    $sql = "SELECT * FROM `tbl_consulting` WHERE date_sent > DATE_SUB(NOW(), INTERVAL 1 YEAR) ";
            
                    // $sql = "SELECT SUM(amount) FROM investigation_payemnt2_cashier WHERE  date_added > DATE_SUB(NOW(), INTERVAL 1 WEEK) AND state = '1' AND cashier_id = '$cashier_id' ";
                 
                
                
                $query_run = mysqli_query($connection,$sql) or die(mysqli_error());

                if($report == FALSE){

                    while($row = mysqli_fetch_array($query_run) ){
            
                        echo"
                          <tr>						
                          <td>".$row['patient_id']."</td>
                      
                      <td>".patient_name($row['patient_id'])."</td>
                  
                      <td>".doctor_name($row['doctor_id'])."</td> 
                         <td>".date('jS F, Y', strtotime($row['date_sent']))."</td>
                         </tr>
                      ";
                          
                      }	
                    
                }else{
                    return $query_run;
                }
                    
              
            
            }


function getDrugsToday($report){
                global $connection;
                 
                $date = date('Y-m-d');
               // $user_id = $_SESSION['uid'];
                
                $sql = "SELECT * FROM tbl_precribtion WHERE DATE(date_added) = '".$date."' AND pharma_view_doc ='1' ";
                
                $query_run = mysqli_query($connection,$sql) or die(mysqli_error());
                    
                if($report==FALSE){
                    while($row = mysqli_fetch_array($query_run) ){
            
                        if($row['time_interval']=="START"){
                            $label_dosage = $row['quantity']." X ".$row['times']." ".$row['rate']."
                         ".$row['time_interval']."(s) ";
                        }else{
                            $label_dosage = $row['quantity']." X ".$row['times']." ".$row['rate']."
                         ".$row['time_interval']."(s)&nbsp; For ".$row['duration']."&nbsp;".$row['time_span'];
                        }
                
                        echo"
                        <tr>						
                        <td>".$row['patient_id']."</td>
                    
                    
                           <td>".patient_name($row['patient_id'])."</td>
                            
                          <td>".drug_name($row['drug_code'])."</td>
                
                           <td>".$label_dosage."</td>
                     
                       </tr>
                    ";
                        
                    }
                }else {
                    return $query_run;
                }	
            
            }



            function getDrugsWeekly($report){
                global $connection;
                 
                $date = date('Y-m-d');
               // $user_id = $_SESSION['uid'];
                
                $sql = "SELECT * FROM tbl_precribtion WHERE DATE(date_added) > DATE_SUB(NOW(), INTERVAL 1 WEEK) AND pharma_view_doc ='1' ";
                // $sql = "SELECT * FROM `tbl_consulting` WHERE date_sent > DATE_SUB(NOW(), INTERVAL 1 WEEK) ";
                $query_run = mysqli_query($connection,$sql) or die(mysqli_error());
                    
                if($report==FALSE){
                    while($row = mysqli_fetch_array($query_run) ){
            
                        if($row['time_interval']=="START"){
                            $label_dosage = $row['quantity']." X ".$row['times']." ".$row['rate']."
                         ".$row['time_interval']."(s) ";
                        }else{
                            $label_dosage = $row['quantity']." X ".$row['times']." ".$row['rate']."
                         ".$row['time_interval']."(s)&nbsp; For ".$row['duration']."&nbsp;".$row['time_span'];
                        }
                
                        echo"
                        <tr>						
                        <td>".$row['patient_id']."</td>
                    
                    
                           <td>".patient_name($row['patient_id'])."</td>
                            
                          <td>".drug_name($row['drug_code'])."</td>
                
                           <td>".$label_dosage."</td>
                     
                       </tr>
                    ";
                        
                    }
                }else {
                    return $query_run;
                }	
            
            }


            function getDrugsMonthly($report){
                global $connection;
                 
                $date = date('Y-m-d');
               // $user_id = $_SESSION['uid'];
                
                $sql = "SELECT * FROM tbl_precribtion WHERE DATE(date_added) > DATE_SUB(NOW(), INTERVAL 1 MONTH) AND pharma_view_doc ='1' ";
                // $sql = "SELECT * FROM `tbl_consulting` WHERE date_sent > DATE_SUB(NOW(), INTERVAL 1 WEEK) ";
                $query_run = mysqli_query($connection,$sql) or die(mysqli_error());
                    
                if($report==FALSE){
                    while($row = mysqli_fetch_array($query_run) ){
            
                        if($row['time_interval']=="START"){
                            $label_dosage = $row['quantity']." X ".$row['times']." ".$row['rate']."
                         ".$row['time_interval']."(s) ";
                        }else{
                            $label_dosage = $row['quantity']." X ".$row['times']." ".$row['rate']."
                         ".$row['time_interval']."(s)&nbsp; For ".$row['duration']."&nbsp;".$row['time_span'];
                        }
                
                        echo"
                        <tr>						
                        <td>".$row['patient_id']."</td>
                    
                    
                           <td>".patient_name($row['patient_id'])."</td>
                            
                          <td>".drug_name($row['drug_code'])."</td>
                
                           <td>".$label_dosage."</td>
                     
                       </tr>
                    ";
                        
                    }
                }else {
                    return $query_run;
                }	
            
            }


function getDrugsYearly($report){
                global $connection;
                 
                $date = date('Y-m-d');
               // $user_id = $_SESSION['uid'];
                
                $sql = "SELECT * FROM tbl_precribtion WHERE DATE(date_added) > DATE_SUB(NOW(), INTERVAL 1 YEAR) AND pharma_view_doc ='1' ";
                // $sql = "SELECT * FROM `tbl_consulting` WHERE date_sent > DATE_SUB(NOW(), INTERVAL 1 WEEK) ";
                $query_run = mysqli_query($connection,$sql) or die(mysqli_error());
                    
                if($report==FALSE){
                    while($row = mysqli_fetch_array($query_run) ){
            
                        if($row['time_interval']=="START"){
                            $label_dosage = $row['quantity']." X ".$row['times']." ".$row['rate']."
                         ".$row['time_interval']."(s) ";
                        }else{
                            $label_dosage = $row['quantity']." X ".$row['times']." ".$row['rate']."
                         ".$row['time_interval']."(s)&nbsp; For ".$row['duration']."&nbsp;".$row['time_span'];
                        }
                
                        echo"
                        <tr>						
                        <td>".$row['patient_id']."</td>
                    
                    
                           <td>".patient_name($row['patient_id'])."</td>
                            
                          <td>".drug_name($row['drug_code'])."</td>
                
                           <td>".$label_dosage."</td>
                     
                       </tr>
                    ";
                        
                    }
                }else {
                    return $query_run;
                }	
            
            }



            function getLabsToday($report){
                global $connection;
                 
                $date = date('Y-m-d');
                $payment_status = 1;
               // $user_id = $_SESSION['uid'];
               $sql = "SELECT * FROM tbl_req_investigation WHERE status = 1 AND processed_date = '".$date."' AND payment_status = '".$payment_status."' ";
              //  $sql = "SELECT * FROM tbl_precribtion WHERE DATE(date_added) = '".$date."' AND pharma_view_doc ='1' ";
                
                $query_run = mysqli_query($connection,$sql) or die(mysqli_error());
                    
                if($report==FALSE){
                    while($row = mysqli_fetch_array($query_run) ){
                
                        echo"
                        <tr>						
                        <td>".$row['patient_id']."</td>
                    
                    
                           <td>".patient_name($row['patient_id'])."</td>
                            
                          <td>".$row['request_test_name']."</td>
                
                          <td>".doctor_name($row['doctor_id'])."</td> 
      
                      <td>".date('jS F, Y', strtotime($row['processed_date']))."</td>
                       </tr>
                    ";
                        
                    }
                }else {
                    return $query_run;
                }	
            
            }


            
            function getLabsWeekly($report){
                global $connection;
                 
                $date = date('Y-m-d');
                $payment_status = 1;
               // $user_id = $_SESSION['uid'];
              // date_sent > DATE_SUB(NOW(), INTERVAL 1 YEAR) 
              // $sql = "SELECT * FROM tbl_precribtion WHERE DATE(date_added) > DATE_SUB(NOW(), INTERVAL 1 MONTH) AND pharma_view_doc ='1' ";
               $sql = "SELECT * FROM tbl_req_investigation WHERE status = 1 AND processed_date  > DATE_SUB(NOW(), INTERVAL 1 WEEK)  AND payment_status = '".$payment_status."' ";
              //  $sql = "SELECT * FROM tbl_precribtion WHERE DATE(date_added) = '".$date."' AND pharma_view_doc ='1' ";
                
                $query_run = mysqli_query($connection,$sql) or die(mysqli_error());
                    
                if($report==FALSE){
                    while($row = mysqli_fetch_array($query_run) ){
                
                        echo"
                        <tr>						
                        <td>".$row['patient_id']."</td>
                    
                    
                           <td>".patient_name($row['patient_id'])."</td>
                            
                          <td>".$row['request_test_name']."</td>
                
                          <td>".doctor_name($row['doctor_id'])."</td> 
      
                      <td>".date('jS F, Y', strtotime($row['processed_date']))."</td>
                       </tr>
                    ";
                        
                    }
                }else {
                    return $query_run;
                }	
            
            }

            function getLabsMonthly($report){
                global $connection;
                 
                $date = date('Y-m-d');
                $payment_status = 1;
               // $user_id = $_SESSION['uid'];
              // date_sent > DATE_SUB(NOW(), INTERVAL 1 YEAR) 
              // $sql = "SELECT * FROM tbl_precribtion WHERE DATE(date_added) > DATE_SUB(NOW(), INTERVAL 1 MONTH) AND pharma_view_doc ='1' ";
               $sql = "SELECT * FROM tbl_req_investigation WHERE status = 1 AND processed_date  > DATE_SUB(NOW(), INTERVAL 1 MONTH)  AND payment_status = '".$payment_status."' ";
              //  $sql = "SELECT * FROM tbl_precribtion WHERE DATE(date_added) = '".$date."' AND pharma_view_doc ='1' ";
                
                $query_run = mysqli_query($connection,$sql) or die(mysqli_error());
                    
                if($report==FALSE){
                    while($row = mysqli_fetch_array($query_run) ){
                
                        echo"
                        <tr>						
                        <td>".$row['patient_id']."</td>
                    
                    
                           <td>".patient_name($row['patient_id'])."</td>
                            
                          <td>".$row['request_test_name']."</td>
                
                          <td>".doctor_name($row['doctor_id'])."</td> 
      
                      <td>".date('jS F, Y', strtotime($row['processed_date']))."</td>
                       </tr>
                    ";
                        
                    }
                }else {
                    return $query_run;
                }	
            
            }


            function getLabsYearly($report){
                global $connection;
                 
                $date = date('Y-m-d');
                $payment_status = 1;
               // $user_id = $_SESSION['uid'];
              // date_sent > DATE_SUB(NOW(), INTERVAL 1 YEAR) 
              // $sql = "SELECT * FROM tbl_precribtion WHERE DATE(date_added) > DATE_SUB(NOW(), INTERVAL 1 MONTH) AND pharma_view_doc ='1' ";
               $sql = "SELECT * FROM tbl_req_investigation WHERE status = 1 AND processed_date  > DATE_SUB(NOW(), INTERVAL 1 YEAR)  AND payment_status = '".$payment_status."' ";
              //  $sql = "SELECT * FROM tbl_precribtion WHERE DATE(date_added) = '".$date."' AND pharma_view_doc ='1' ";
                
                $query_run = mysqli_query($connection,$sql) or die(mysqli_error());
                    
                if($report==FALSE){
                    while($row = mysqli_fetch_array($query_run) ){
                
                        echo"
                        <tr>						
                        <td>".$row['patient_id']."</td>
                    
                    
                           <td>".patient_name($row['patient_id'])."</td>
                            
                          <td>".$row['request_test_name']."</td>
                
                          <td>".doctor_name($row['doctor_id'])."</td> 
      
                      <td>".date('jS F, Y', strtotime($row['processed_date']))."</td>
                       </tr>
                    ";
                        
                    }
                }else {
                    return $query_run;
                }	
            
            }



            function all_patients($type){
                global $connection;
                $date = date('Y-m-d');
                $sql = "";
            
                // Determine SQL query based on the type
                if ($type === "ALL-CLIENTS"|| $type === "") {
                    $sql = "SELECT p.patient_id, p.date_created, p.surname, p.other_names, s.scheme,s.membership_id
                            FROM tbl_patient_info p
                            LEFT JOIN scheme s ON p.patient_id = s.patient_id
                            ORDER BY s.scheme IS NOT NULL DESC, s.scheme ASC";
                } elseif ($type === "CASH-CLIENTS") {
                    $sql = "SELECT p.patient_id, p.date_created, p.surname, p.other_names, NULL AS scheme
                            FROM tbl_patient_info p
                            LEFT JOIN scheme s ON p.patient_id = s.patient_id
                            WHERE s.scheme IS NULL
                            ORDER BY p.date_created DESC";
                } elseif ($type === "INSURANCE-CLIENTS") {
                    $sql = "SELECT p.patient_id, p.date_created, p.surname, p.other_names, s.scheme,s.membership_id
FROM tbl_patient_info p
INNER JOIN scheme s ON p.patient_id = s.patient_id
WHERE s.scheme IS NOT NULL AND s.scheme != ''
  AND s.membership_id IS NOT NULL AND s.membership_id != ''
ORDER BY s.scheme ASC
";
                } else {
                    echo "Invalid client type.";
                    return;
                }
            
                $query_run = mysqli_query($connection, $sql) or die(mysqli_error($connection));
            
                if ($query_run->num_rows > 0) {
                    while ($row = $query_run->fetch_array(MYSQLI_ASSOC)) {
                        echo "
                            <tr>						
                                <td>".$row['patient_id']."</td>
                                <td>".$row['surname']." ".$row['other_names']."</td>
                                <td>".(!empty($row['scheme']) ? $row['scheme'] : 'No Scheme')."</td>
                                 <td>".(!empty($row['membership_id']) ? $row['membership_id'] : 'N/A')."</td>
                                <td>".date('jS F, Y', strtotime($row['date_created']))."</td>
                            </tr>
                        "; 
                    }
                } else {
                    echo "<tr><td colspan='4'>No records found.</td></tr>";
                }
            }
            



////REPORTS FOR ADMIN
 

 