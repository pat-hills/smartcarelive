<?php

//require '../functions/conndb.php';
//create_dir();

function upload_image() {
    
}

function create_staff_account($user_id, $user_type, $username, $password, $firstname, $othernames, $gender, $dob, $occupation, $phone_number, $email, $address) {

    global $connection;

    $sql = "INSERT INTO tbl_login SET userid = '" . $user_id . "', uname = '" . $username . "', pass = '" . $password . "', acc_lvl = '" . $user_type . "'";

    if (mysqli_query($connection,$sql)) {


        $sql = "INSERT INTO tbl_staff SET staff_id = '" . $user_id . "', firstName = '" . $firstname . "', otherNames = '" . $othernames . "', 
                dob = '" . $dob . "', address = '" . $address . "', phone = '" . $phone_number . "', email = '" . $email . "', sex = '" . $gender . "', occupation = '" . $occupation . "'";

        if (mysqli_query($connection,$sql)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}

function add_room($room_name, $room_id, $date_created) {

    global $connection;

    $sql = "INSERT INTO consulting_room SET name = '" . $room_name . "', room_id = '" . $room_id . "', date_created = '" . $date_created . "'";

    if (mysqli_query($connection,$sql)) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function assign_room($room_id, $doctor_id, $shift, $assigned_by) {

    global $connection;



    $sql = "INSERT INTO doctors_room SET room_id = '" . $room_id . "', doctor_id = '" . $doctor_id . "', shift = '" . $shift . "', assigned_by = '" . $assigned_by . "'";

    if (mysqli_query($connection,$sql)) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function add_diagnosis($diagnosis, $added_by, $date_added) {

    global $connection;

    $diagnosis_code = diagnosis_code();
    $sql = "INSERT INTO tbl_diagnosis_list SET name = '" . $diagnosis . "', added_by = '" . $added_by . "', date_added = '" . $date_added . " '";

    if (mysqli_query($connection,$sql) or die(mysqli_error())) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function add_complain($category,$complain,$r_code, $added_by, $date_added) {

    global $connection;

    $complain_code = complain_code();
    $sql = "INSERT INTO complains SET complain_code = '" . $complain_code . "', category = '" . $category . "', complain = '" . $complain . "',r_code = '" . $r_code . "', added_by = '" . $added_by . "', date_added = '" . $date_added . "'";

    if (mysqli_query($connection,$sql)) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function add_ward($ward_name,$gender_ward_type,$service,$bed_capacity,$available_bed, $recorded_by) {

    global $connection;

  //  $complain_code = "WARD".complain_code();
  $date_time_recorded =  date("y-m-d");
    $sql = "INSERT INTO tbl_ward SET ward_name = '" . $ward_name . "', gender_ward_type = '" . $gender_ward_type . "',service_department = '" . $service . "', bed_capacity = '" . $bed_capacity . "',
    available_bed = '" . $available_bed . "', date_time_recorded = '" . $date_time_recorded . "', recorded_by = '" . $recorded_by . "'";

    if (mysqli_query($connection,$sql)) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function add_procedure($procedure, $category, $tarriffs, $gdrgcode, $nhis) {

    global $connection;

    $procedure_code = procedure_code();
    $sql = "INSERT INTO tbl_procedure SET procedure_code = '" . $procedure_code . "', procedure_name = '" . $procedure .
            "', tarriffs = '" . $tarriffs . "', category = '" . $category . "', gdrgcode = '" . $gdrgcode . "', nhis = '" . $nhis . "'";

    if (mysqli_query($connection,$sql) or die()) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function select_consulting_rooms() {
    global $connection;
    $sql = "SELECT * FROM consulting_room";

    $result = mysqli_query($connection,$sql) or die(mysqli_error());

    while ($row = mysqli_fetch_assoc($result)) {

        echo "
            <option value='" . $row['room_id'] . "'>" . $row['name'] . "</option>
        ";
    }
}

function select_consultants() {
    global $connection;
    $sql = "SELECT tbl_staff.staff_id, tbl_staff.firstName, tbl_staff.otherNames  FROM tbl_staff, tbl_login WHERE tbl_staff.staff_id = tbl_login.userid AND tbl_login.acc_lvl = '2'";

    $result = mysqli_query($connection,$sql) or die(mysqli_error());

    while ($row = mysqli_fetch_assoc($result)) {

        echo "
            <option value='" . $row['staff_id'] . "'>" . $row['firstName'] . " " . $row['otherNames'] . "</option>
        ";
    }
}

function list_consulting_rooms() {
    global $connection;
    $sql = "SELECT * FROM consulting_room";
    $query_run = mysqli_query($connection,$sql);

    while ($row = mysqli_fetch_array($query_run)) {
        //$doctor = staff_info($row['doctor_id']);
        echo"
			 <tr>						
				<td>" . $row['room_id'] . "</td>
				<td>" . $row['name'] . " </td>
				<td class='text-center'><a onclick='return confirm(\"CLICK OK TO CONFIRM DELETION OR CANCEL TO PREVENT DELETION...\")' class='label label-danger' href='tasks/undo_add_room.php?id=" . $row['id'] . "'><i class='fa fa-times'></i></a></td>
			
                </tr>
		";
    }
}

function list_investigations() {
    global $connection;
    $sql = "SELECT Investigations,Tarriffs,investigation_code,ID FROM tbl_investigations";
    $query_run = mysqli_query($connection,$sql);

    while ($row = mysqli_fetch_array($query_run)) {
        echo"
			 <tr>						
				<td>" . $row['Investigations'] . "</td>
				 
				<td>" . $row['Tarriffs'] . " </td>
				<td>" . $row['investigation_code'] . " </td>
			  
				<td class='text-center'><a onclick='return confirm(\"CLICK OK TO CONFIRM DELETION OR CANCEL TO PREVENT DELETION...\")' class='label label-danger' href='tasks/undo_add_investigation.php?id=" . $row['ID'] . "'><i class='fa fa-times'></i></a></td>
			</tr>
		";
    }
}

function list_diagnosis() {
    global $connection;
    $sql = "SELECT name,id FROM tbl_diagnosis_list";
    $query_run = mysqli_query($connection,$sql);

    while ($row = mysqli_fetch_array($query_run)) {
        echo"
			 <tr>						
				<td>" . $row['name'] . "</td> "."
        
			  

          <td class='text-center'><a onclick='return confirm(\"CLICK OK TO CONFIRM DELETION OR CANCEL TO PREVENT DELETION...\")' class='label label-danger' href='tasks/undo_add_diagnosis.php?id=" . $row['id'] . "'><i class='fa fa-times'></i></a></td>
			</tr>
		";
    }
}

function list_complains() {
    global $connection;
    $sql = "SELECT complain_code,complain,id,category FROM complains";
    $query_run = mysqli_query($connection,$sql);

    while ($row = mysqli_fetch_array($query_run)) {
        echo"
			 <tr>						
				<td>" . $row['complain_code'] . "</td> "
               . "<td>" . $row['complain'] . " </td>
               <td>" . $row['category'] . "</td>
			
				 

				<td class='text-center'><a onclick='return confirm(\"CLICK OK TO CONFIRM DELETION OR CANCEL TO PREVENT DELETION...\")' class='label label-danger' href='tasks/undo_add_complain.php?id=" . $row['id'] . "'><i class='fa fa-times'></i></a></td>
			
                </tr>
		";
    }
}

function list_wards() {
    global $connection;
    $sql = "SELECT ward_name,gender_ward_type,service_department,id,available_bed FROM tbl_ward";
    $query_run = mysqli_query($connection,$sql);

    while ($row = mysqli_fetch_array($query_run)) {
        echo"
			 <tr>						
				<td>" . $row['ward_name'] . "</td> "
               . "<td>" . $row['gender_ward_type'] . " </td>
               <td>" . $row['service_department'] . "</td>
               <td>" . $row['available_bed'] . "</td>
			
				 

				<td class='text-center'><a onclick='return confirm(\"CLICK OK TO CONFIRM DELETION OR CANCEL TO PREVENT DELETION...\")'
                 class='label label-danger' href='tasks/undo_add_ward.php?id=" . $row['id'] . "'><i class='fa fa-times'></i></a></td>
			
                </tr>
		";
    }
}


function list_procedure() {
    global $connection;
    $sql = "SELECT * FROM tbl_procedure";
    $query_run = mysqli_query($connection,$sql);

    while ($row = mysqli_fetch_array($query_run)) {
        echo"
			 <tr>						
								<td>" . $row['procedure_code'] . "</td> "
        . " <td>" . $row['procedure_name'] . "</td> "
        . "<td>" . $row['gdrgcode'] . " </td>"
        . "<td>" . $row['category'] . " </td>"
        . "<td>" . $row['tarriffs'] . " </td>"
        . "<td>" . $row['nhis'] . " </td > "
        . "<td class='text-center'><a onclick='return confirm(\"CLICK OK TO CONFIRM DELETION OR CANCEL TO PREVENT DELETION...\")' class='label label-danger' href='tasks/undo_add_procedure.php?id=" . $row['id'] . "'><i class='fa fa-times'></i></a></td>
			</tr>
		";
    }
}

function list_assigned_rooms() {
    global $connection;
    $sql = "SELECT * FROM doctors_room";
    $query_run = mysqli_query($connection,$sql);

    while ($row = mysqli_fetch_array($query_run)) {
        $doctor = staff_info($row['doctor_id']);
        echo"
			 <tr>						
				<td>" . get_room_name($row['room_id']) . "</td>
					
				<td>" . $doctor['firstName'] . " " . $doctor['otherNames'] . "</td>
				<td>" . $row['shift'] . " </td>
				<td class='text-center'><a onclick='return confirm(\"CLICK OK TO CONFIRM DELETION OR CANCEL TO PREVENT DELETION...\")' class='label label-danger' href='tasks/undo_doctor_assign.php?id=" . $row['id'] . "'><i class='fa fa-times'></i></a></td>
			</tr>
		";
    }
}

function get_room_name($room_id) {
    global $connection;
    $sql = "SELECT name FROM consulting_room WHERE room_id = '" . $room_id . "'";
    $result = mysqli_query($connection,$sql);
    $rows = mysqli_num_rows($result);

    if ($rows == 1) {
         $room_name = $result->fetch_assoc();
         return $room_name['name'];
    } else if ($rows == 0) {
        return "<p style='color:red'>Room Deleted. So Ask for re-assignment</p>";
    }
}

function doctors_abbr() {
    
}

function update_staff_account($user_id, $user_type, $username, $password, $firstname, $othernames, $gender, $dob, $occupation, $phone_number, $email, $address) {

    global $connection;

    $sql = "UPDATE tbl_login SET uname = '" . $username . "' , pass = '" . $password . "', acc_lvl = '" . $user_type . "' WHERE userid = '" . $user_id . "'";

    if (mysqli_query($connection,$sql) or die(mysqli_error())) {


        $sql = "UPDATE tbl_staff SET firstName = '" . $firstname . "', otherNames = '" . $othernames . "', 
                dob = '" . $dob . "', address = '" . $address . "', phone = '" . $phone_number . "', email = '" . $email . "', sex = '" . $gender . "', occupation = '" . $occupation . "' WHERE staff_id = '" . $user_id . "'";

        if (mysqli_query($connection,$sql) or die(mysqli_error())) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}

//create_staff_account($user_id, $user_type, $username, $password, $firstname, $othernames, $gender, $dob, $occupation, $phone_number, $email, $address);

function check_staff_id($staff_id) {
    $sql = "SELECT staff_id FROM tbl_staff WHERE staff_id = '" . $staff_id . "'";

    $result = mysql_query($sql) or die(mysql_error());

    $rows = mysql_num_rows($result);

    if ($rows == 1) {
        echo "Yes";
    } else if ($rows == 0) {
        echo "No";
    }
}

//check_staff_id($staff_id);

function generate_staff_id() {

    //$string = "THstaff";
    //$sql = "SELECT COUNT(userid) FROM tbl_login";
    //$result = mysql_query($sql);
    //$count = mysql_result($result, 0);
    //return $staff_id =  $string . $count;   

    $string = 'THS';
    //$year = date('y');
    $length = 4;

    $rand = random_code($length);

    //return $rand;
    return $string . $rand;
}

function view_staff_list() {

    global $connection;

    $sql = "SELECT * FROM tbl_staff";

    $result = mysqli_query($connection,$sql);
    //$rows = mysql_num_rows($result);

    while ($row = mysqli_fetch_assoc($result)) {

        echo "
            <div class='col-sm-6 col-md-4'>
                <div class='friend-widget'>
                    <img src=" . profile_picture($row['staff_id']) . ">
                    <a href='update_staff_account.php?staff_id=" . $row['staff_id'] . "'><h4>" . ucfirst($row['firstName']) . " " . ucfirst($row['otherNames']) . "</a>
                    <p>" . $row['occupation'] . "</p>
                </div>
            </div>
        ";
    }
}

function staff_info($staff_id) {
    global $connection;
    //$sql = "SELECT * FROM tbl_staff, tbl_login WHERE staff_id = '".$staff_id."'";
    $sql = "SELECT * FROM tbl_staff, tbl_login WHERE tbl_staff.staff_id = tbl_login.userid AND tbl_staff.staff_id = '" . $staff_id . "'";
    $result = mysqli_query($connection,$sql);
    //$rows = mysql_num_rows($result);

    while ($row = mysqli_fetch_assoc($result)) {

        return $row;
    }
}

function patient_list() {

    $sql = "SELECT * FROM tbl_patient_info";
    $query_run = mysql_query($sql);

    while ($row = mysql_fetch_array($query_run)) {
        echo"
			 <tr>						
				<td>" . $row['patient_id'] . "</td>
								<td>" . $row['surname'] . " </td>
				<td>" . $row['other_names'] . " </td>
				<td>" . $row['occupation'] . " </td>
				<td>" . $row['phone'] . " </td>
<td>" . $row['address'] . " </td>
				<td class='text-center'><a class='label label-danger' onclick='return confirm(\"CLICK OK TO CONFIRM DELETION OR CANCEL TO PREVENT DELETION OF PATIENT...\")' href='tasks/undo_add_patient.php?id=" . $row['id'] . "'><i class='fa fa-times'></i></a></td>
			</tr>
		";
    }
}

function patient_info() {
    
}

function complain_code() {
    $string = 'CM';
    //$year = date('y');
    $length = 6;

    $rand = random_code($length);

    //return $rand;
    return $string . $rand;
}

function procedure_code() {
    $string = 'PR';
    //$year = date('y');
    $length = 6;

    $rand = random_code($length);

    //return $rand;
    return $string . $rand;
}

function diagnosis_code() {
    $string = 'D';
    //$year = date('y');
    $length = 6;

    $rand = random_code($length);

    //return $rand;
    return $string . $rand;
}

function complain_sentence_code() {
    $string = 'SE';
    //$year = date('y');
    $length = 6;

    $rand = random_code($length);

    //return $rand;
    return $string . $rand;
}

function random_code($length) {
    $rand = 0;
    /* Only select from letters and numbers that are readable - no 0 or O etc.. */
    $characters = "23456789ABCDEFHJKLMNPRTVWXYZ";

    for ($p = 0; $p < $length; $p++) {
        $rand .= $characters[mt_rand(0, strlen($characters) - 1)];
    }

    return $rand;
}

function getInvestigation_code($length = 10) {
    $string = 0;
    /* Only select from letters and numbers that are readable - no 0 or O etc.. */
    $characters = "23456789ABCDEFHJKLMNPRTVWXYZ";

    for ($p = 0; $p < $length; $p++) {
        $string .= $characters[mt_rand(0, strlen($characters) - 1)];
    }

    return $string;
}

function getComplain_code($length = 10) {
    $string = 0;
    /* Only select from letters and numbers that are readable - no 0 or O etc.. */
    $characters = "23456789ABCDEFHJKLMNPRTVWXYZ";

    for ($p = 0; $p < $length; $p++) {
        $string .= $characters[mt_rand(0, strlen($characters) - 1)];
    }

    return $string;
}

function create_investigation($investigation, $tariffs) {
    global $connection;
    $investigation_code = getInvestigation_code();
    $theSql = "INSERT INTO tbl_investigations
            (Investigations, Tarriffs, investigation_code)
            VALUES ('" . $investigation . "','" . $tariffs . "','" . $investigation_code . "') ";
    $theInvestigation = mysqli_query($connection,$theSql);

    if ($theInvestigation) {
        return true;
    } else {

        return false;
    }
}

function create_consulting_fee($nhis_members, $nonNhis_members) {
    global $connection;

    $query = "INSERT INTO consulting_fees_settings
						(NHIS_tarrifs,nonNHIS_tarrifs,staff_id,date_added)
			VALUES    ('" . $nhis_members . "','" . $nonNhis_members . "','" . $_SESSION['uid'] . "','" . date('Y-m-d') . "')
		  
		  ";
    $qyery_run = mysqli_query($connection,$query);
    if ($qyery_run) {
        return true;
    } else {
        return false;
    }
}

function get_consulting_fee() {
    global $connection;
    $query = "SELECT * FROM consulting_fees_settings LIMIT 0,1";
    $theFessinfo = mysqli_query($connection,$query);
    if (mysqli_num_rows($theFessinfo) > 0) {
        while ($consultinginfo = mysqli_fetch_array($theFessinfo)) {
            return array('NHIS' => $consultinginfo['NHIS_tarrifs'], 'nonNHIS' => $consultinginfo['nonNHIS_tarrifs'], 'staff_id' => $consultinginfo['staff_id']);
        }
    } else {
        return false;
    }
}

function update_consulting_fee($nhis_members, $nonNhis_members) {
    global $connection;
    $updateCurrentset = 1;
    $query = "UPDATE consulting_fees_settings SET 
			NHIS_tarrifs='" . $nhis_members . "',
			nonNHIS_tarrifs='" . $nonNhis_members . "' 
			WHERE id='" . $updateCurrentset . "'  ";
    $query_run = mysqli_query($connection,$query);
    if ($query_run) {
        return true;
    } else {
        return false;
    }
}



/*function create_dir($staff_id){
    
    
    $current_dir = dirname(__FILE__);
    $staffs_folder = $current_dir . '../../../staff/';
    
    $structure = '';
    if(file_exists($staffs_folder)){
        //mkdir($current_dir . '../../staff/' . $staff_id .'/');
        $staff_folder = $staffs_folder . $staff_id .'/';
        mkdir($staff_folder);   
        
    }
   
}*/