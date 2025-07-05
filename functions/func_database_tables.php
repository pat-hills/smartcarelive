<?php
require_once"conndb.php";

global $connection;


$tbl_walk_in_request_investigation = "CREATE TABLE IF NOT EXISTS tbl_walk_in_request_investigation (
    id INT(11) NOT NULL AUTO_INCREMENT,
    walk_code  VARCHAR(128) NOT NULL,
   
    source VARCHAR(64) NOT NULL,
    source_name VARCHAR(128) NULL,
    lab_description TEXT NOT NULL,
    request_code VARCHAR(128) NOT NULL,
    requested_test VARCHAR(255) NOT NULL,
    requested_test_names VARCHAR(255) NOT NULL,
    date_requested DATETIME,
    date_processed DATETIME,
    lab_status  VARCHAR(8) NOT NULL DEFAULT '0',
    lab_staff_id  VARCHAR(128) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY walk_code (walk_code,request_code)
   )";
$query = mysqli_query($connection, $tbl_walk_in_request_investigation);
if ($query === TRUE) {
echo "<h3>tbl_walk_in_request_investigation table created OK :) </h3>"; 
} else {
echo "<h3 style='color:red'>tbl_walk_in_request_investigation table NOT created,Something went wrong :( </h3>"; 
}


$alter_tbl_req_investigation_add_view_opd_status_view_opd_status_by = "ALTER TABLE  `tbl_req_investigation` ADD ( view_opd_status VARCHAR(8) NOT NULL DEFAULT '0', view_opd_status_by VARCHAR(64) NULL ); ";

$query_two = mysqli_query($connection, $alter_tbl_req_investigation_add_view_opd_status_view_opd_status_by);
if ($query_two === TRUE) {
echo "<h3>tbl_req_investigation table is altered with view_opd_status and view_opd_status_by successfully :) </h3>"; 
} else {
echo "<h3 style='color:red'>tbl_req_investigation table NOT ALTERED,Something went wrong, Either columns exist / Operation error!!! :) </h3>"; 
}


$alter_tbl_tmp_complain_add_history_complain = "ALTER TABLE  `tbl_tmp_complain` ADD ( history_complain TEXT ); ";

$query_3 = mysqli_query($connection, $alter_tbl_tmp_complain_add_history_complain);
if ($query_3 === TRUE) {
echo "<h3>tbl_tmp_complain table is altered with history_complain successfully :) </h3>"; 
} else {
echo "<h3 style='color:red'>tbl_tmp_complain table NOT ALTERED,Something went wrong, Either column(s) exist / Operation error!!! :) </h3>"; 
}




$tbl_patient_examination = "CREATE TABLE IF NOT EXISTS tbl_patient_examination (
    id INT(11) NOT NULL AUTO_INCREMENT,
    patient_id  VARCHAR(128) NOT NULL,
    doctor_id VARCHAR(255) NOT NULL, 
    date_time_taken DATETIME NOT NULL,
    medical_examination TEXT,  
    PRIMARY KEY (id)
   )";
$query_4 = mysqli_query($connection, $tbl_patient_examination);
if ($query_4 === TRUE) {
echo "<h3>tbl_patient_examination table created OK :) </h3>"; 
} else {
echo "<h3 style='color:red'>tbl_patient_examination table NOT created,Something went wrong :( </h3>"; 
}


$alter_tbl_patient_biovitals = "ALTER TABLE  `tbl_patient_biovitals` ADD ( s_p_0_2 VARCHAR(128),respiration VARCHAR(128) ); ";

$query_5 = mysqli_query($connection, $alter_tbl_patient_biovitals);
if ($query_5 === TRUE) {
echo "<h3>tbl_patient_biovitals table is altered with s_p_0_2 and respiration successfully :) </h3>"; 
} else {
echo "<h3 style='color:red'>tbl_patient_biovitals table NOT ALTERED,Something went wrong, Either column(s) exist / Operation error!!! :) </h3>"; 
}


$alter_tbl_walk_in_request_investigation = "ALTER TABLE  `tbl_walk_in_request_investigation` MODIFY  dob VARCHAR(64) NOT NULL; ";

$query_6 = mysqli_query($connection, $alter_tbl_walk_in_request_investigation);
if ($query_6 === TRUE) {
echo "<h3>tbl_walk_in_request_investigation table is altered  and modified dob(varchar) respiration successfully :) </h3>"; 
} else {
echo "<h3 style='color:red'>tbl_walk_in_request_investigation table NOT ALTERED and MODIFIED,Something went wrong!!! :) </h3>"; 
}


$alter_add_lab_No_tbl_walk_in_request_investigation = "ALTER TABLE  `tbl_walk_in_request_investigation` ADD ( lab_no VARCHAR(128) ); ";

$query_7 = mysqli_query($connection, $alter_add_lab_No_tbl_walk_in_request_investigation);
if ($query_7 === TRUE) {
echo "<h3>tbl_walk_in_request_investigation table is altered with LAB_NO successfully :) </h3>"; 
} else {
echo "<h3 style='color:red'>tbl_walk_in_request_investigation table NOT ALTERED,Something went wrong, Either column(s) exist / Operation error!!! :) </h3>"; 
}

$alter_rename_electrolytes_bue_cr = "ALTER TABLE  `electrolytes` RENAME TO bue_cr; ";

$query_8 = mysqli_query($connection, $alter_rename_electrolytes_bue_cr);
if ($query_8 === TRUE) {
echo "<h3>electrolytes table is altered with new name bue_cr :) </h3>"; 
} else {
echo "<h3 style='color:red'>electrolytes table NOT ALTERED to new name bue_cr,Something went wrong, Operation error!!! :) </h3>"; 
}

//date_updated

$tbl_elec_tro_lytes = "CREATE TABLE IF NOT EXISTS elec_tro_lytes (
    id INT(11) NOT NULL AUTO_INCREMENT,
    request_code  VARCHAR(128) NOT NULL,
    patient_id  VARCHAR(128) NOT NULL,
    lab_staff_id VARCHAR(128) NOT NULL, 
    SODIUM VARCHAR(128) NULL, 
    POTASSIUM VARCHAR(128) NULL, 
    CHLORIDE VARCHAR(128) NULL, 
    date_submitted DATE NOT NULL,
    date_updated DATE NULL,
    PRIMARY KEY (id)
   )";
$query_9 = mysqli_query($connection, $tbl_elec_tro_lytes);
if ($query_9 === TRUE) {
echo "<h3>elec_tro_lytes table created OK :) </h3>"; 
} else {
echo "<h3 style='color:red'>elec_tro_lytes table NOT created,Something went wrong :( </h3>"; 
}


$tbl_urea_creatine = "CREATE TABLE IF NOT EXISTS urea_creatine (
    id INT(11) NOT NULL AUTO_INCREMENT,
    request_code  VARCHAR(128) NOT NULL,
    patient_id  VARCHAR(128) NOT NULL,
    lab_staff_id VARCHAR(128) NOT NULL, 
    S_UREA VARCHAR(128) NULL, 
    S_CREATININE VARCHAR(128) NULL,  
    date_submitted DATE NOT NULL,
    date_updated DATE NULL,
    PRIMARY KEY (id)
   )";
$query_10 = mysqli_query($connection, $tbl_urea_creatine);
if ($query_10 === TRUE) {
echo "<h3>urea_creatine table created OK :) </h3>"; 
} else {
echo "<h3 style='color:red'>urea_creatine table NOT created,Something went wrong :( </h3>"; 
}



$tbl_walk_in_patient = "CREATE TABLE IF NOT EXISTS tbl_walk_in_patient (
    id INT(11) NOT NULL AUTO_INCREMENT, 
    walk_code  VARCHAR(128) NOT NULL,
    full_name VARCHAR(255) NOT NULL, 
    gender VARCHAR(64) NOT NULL,
    dob DATE NOT NULL,
    contact  VARCHAR(128) NOT NULL,  
    date_created DATE NOT NULL,
    PRIMARY KEY (id)
   )";
$query_11 = mysqli_query($connection, $tbl_walk_in_patient);
if ($query_11 === TRUE) {
echo "<h3>tbl_walk_in_patient table created OK :) </h3>"; 
} else {
echo "<h3 style='color:red'>tbl_walk_in_patient table NOT created,Something went wrong :( </h3>"; 
}



$alter_drop_walk_in_patients = "ALTER TABLE  `tbl_walk_in_request_investigation` DROP COLUMN `full_name`,DROP COLUMN `gender`,DROP COLUMN `dob`, DROP COLUMN `contact`; ";

$query_12 = mysqli_query($connection, $alter_drop_walk_in_patients);
if ($query_12 === TRUE) {
echo "<h3>tbl_walk_in_request_investigation table columns drop successfully :) </h3>"; 
} else {
echo "<h3 style='color:red'>tbl_walk_in_request_investigation table fail to drop columns,Something went wrong, Operation error!!! :) </h3>"; 
}


$alter_tbl_walk_in_patient_modify_colum = "ALTER TABLE  `tbl_walk_in_patient` MODIFY  dob VARCHAR(64) NOT NULL; ";

$query_13 = mysqli_query($connection, $alter_tbl_walk_in_patient_modify_colum);
if ($query_13 === TRUE) {
echo "<h3>alter_tbl_walk_in_patient_modify_colum table is altered  and modified dob(varchar) respiration successfully :) </h3>"; 
} else {
echo "<h3 style='color:red'>alter_tbl_walk_in_patient_modify_colum table NOT ALTERED and MODIFIED,Something went wrong!!! :) </h3>"; 
}



$tbl_create_e_s_r = "CREATE TABLE IF NOT EXISTS tbl_esr (
    id INT(11) NOT NULL AUTO_INCREMENT,
    request_code  VARCHAR(128) NOT NULL,
    patient_id  VARCHAR(128) NOT NULL,
    lab_staff_id VARCHAR(128) NOT NULL, 
    ESR_LEVEL VARCHAR(128) NULL,  
    date_submitted DATE NOT NULL,
    date_updated DATE NULL,
    PRIMARY KEY (id)
   )";
$query_14 = mysqli_query($connection, $tbl_create_e_s_r);
if ($query_14 === TRUE) {
echo "<h3>tbl_esr table created OK :) </h3>"; 
} else { 
echo "<h3 style='color:red'>tbl_esr table NOT created,Something went wrong :( </h3>"; 
}


$tbl_create_crp = "CREATE TABLE IF NOT EXISTS tbl_crp (
    id INT(11) NOT NULL AUTO_INCREMENT,
    request_code  VARCHAR(128) NOT NULL,
    patient_id  VARCHAR(128) NOT NULL,
    lab_staff_id VARCHAR(128) NOT NULL, 
    CRP_LEVEL VARCHAR(128) NULL,  
    date_submitted DATE NOT NULL,
    date_updated DATE NULL,
    PRIMARY KEY (id)
   )";
$query_15 = mysqli_query($connection, $tbl_create_crp);
if ($query_15 === TRUE) {
echo "<h3>tbl_esr table created OK :) </h3>"; 
} else {
echo "<h3 style='color:red'>tbl_esr table NOT created,Something went wrong :( </h3>"; 
}


$tbl_create_tbl_blood_group = "CREATE TABLE IF NOT EXISTS tbl_blood_group (
    id INT(11) NOT NULL AUTO_INCREMENT,
    request_code  VARCHAR(128) NOT NULL,
    patient_id  VARCHAR(128) NOT NULL,
    lab_staff_id VARCHAR(128) NOT NULL, 
    BLOOD_TYPE VARCHAR(128) NULL,  
    date_submitted DATE NOT NULL,
    date_updated DATE NULL,
    PRIMARY KEY (id)
   )";
$query_16 = mysqli_query($connection, $tbl_create_tbl_blood_group);
if ($query_16 === TRUE) {
echo "<h3>tbl_blood_group table created OK :) </h3>"; 
} else { 
echo "<h3 style='color:red'>tbl_blood_group table NOT created,Something went wrong :( </h3>"; 
}



$tbl_create_tbl_uric_acid = "CREATE TABLE IF NOT EXISTS tbl_uric_acid (
    id INT(11) NOT NULL AUTO_INCREMENT,
    request_code  VARCHAR(128) NOT NULL,
    patient_id  VARCHAR(128) NOT NULL,
    lab_staff_id VARCHAR(128) NOT NULL, 
    URIC_ACID_LEVEL VARCHAR(128) NOT NULL,  
    date_submitted DATE NOT NULL,
    date_updated DATE NULL,
    PRIMARY KEY (id)
   )";
$query_17 = mysqli_query($connection, $tbl_create_tbl_uric_acid);
if ($query_17 === TRUE) {
echo "<h3>tbl_create_tbl_uric_acid table created OK :) </h3>"; 
} else { 
echo "<h3 style='color:red'>tbl_create_tbl_uric_acid table NOT created,Something went wrong :( </h3>"; 
}


$alter_urine_re = "ALTER TABLE  `urine_re` ADD
 (
    epithelial_cell VARCHAR(128) NULL, 
    pus_cell VARCHAR(128) NULL, 
    rbcs VARCHAR(128) NULL, 
    wbc_cast VARCHAR(128) NULL, 
    crystals VARCHAR(128) NULL, 
    ova VARCHAR(128)  NULL, 
    t_vaginals VARCHAR(128) NULL, 
    bacteria VARCHAR(128)  NULL, 
    yeast_like_cells VARCHAR(128) NULL, 
    s_haemoglobin VARCHAR(128) NULL
 
 ); ";

$query_18 = mysqli_query($connection, $alter_urine_re);
if ($query_18 === TRUE) {
echo "<h3>urine_re table is altered  successfully :) </h3>"; 
} else {
echo "<h3 style='color:red'>urine_re table NOT ALTERED,Something went wrong, Either column(s) exist / Operation error!!! :) </h3>"; 
}

//tables/columns ADDED ON 18TH NOVEMBER,2021


$alter_tbl_req_investigation_add_lab_no = "ALTER TABLE  `tbl_req_investigation` ADD
 (
    lab_no VARCHAR(128) NULL 
 
 ); ";

$query_19 = mysqli_query($connection, $alter_tbl_req_investigation_add_lab_no);
if ($query_19 === TRUE) {
echo "<h3>tbl_req_investigation table is altered  successfully :) </h3>"; 
} else {
echo "<h3 style='color:red'>tbl_req_investigation table NOT ALTERED,Something went wrong, Either column(s) exist / Operation error!!! :) </h3>"; 
}


$alter_glycated_haemoglobin_add_evaluation = "ALTER TABLE  `glycated_haemoglobin` ADD
 (
    evaluation VARCHAR(64) NULL 
 
 ); ";

$query_20 = mysqli_query($connection, $alter_glycated_haemoglobin_add_evaluation);
if ($query_20 === TRUE) {
echo "<h3>glycated_haemoglobin table is altered  successfully :) </h3>"; 
} else {
echo "<h3 style='color:red'>glycated_haemoglobin table NOT ALTERED,Something went wrong, Either column(s) exist / Operation error!!! :) </h3>"; 
}


$alter_tbl_crp_add_evaluation = "ALTER TABLE  `tbl_crp` ADD
 (
    evaluation VARCHAR(64) NULL 
 
 ); ";

$query_21 = mysqli_query($connection, $alter_tbl_crp_add_evaluation);
if ($query_21 === TRUE) {
echo "<h3>tbl_crp table is altered  successfully :) </h3>"; 
} else {
echo "<h3 style='color:red'>tbl_crp table NOT ALTERED,Something went wrong, Either column(s) exist / Operation error!!! :) </h3>"; 
}

 
$alter_psa_add_evaluation = "ALTER TABLE  `psa` ADD
 (
    evaluation VARCHAR(64) NULL 
 
 ); ";

$query_22 = mysqli_query($connection, $alter_psa_add_evaluation);
if ($query_22 === TRUE) {
echo "<h3>psa table is altered  successfully :) </h3>"; 
} else {
echo "<h3 style='color:red'>psa table NOT ALTERED,Something went wrong, Either column(s) exist / Operation error!!! :) </h3>"; 
}

$alter_urine_re_add_leukocytes = "ALTER TABLE  `urine_re` ADD
 (
    leukocytes VARCHAR(128) NULL
 
 ); ";

$query_23 = mysqli_query($connection, $alter_urine_re_add_leukocytes);
if ($query_23 === TRUE) {
echo "<h3>urine_re table is altered  successfully :) </h3>"; 
} else {
echo "<h3 style='color:red'>urine_re table NOT ALTERED,Something went wrong, Either column(s) exist / Operation error!!! :) </h3>"; 
}


$alter_LFT_add_direct_biliribum = "ALTER TABLE  `lft` ADD
 (S_BILIRUBIN_DIRECT VARCHAR(128) NULL); ";

$query_24 = mysqli_query($connection, $alter_LFT_add_direct_biliribum);
if ($query_24 === TRUE) {
echo "<h3>lft table is altered  successfully :) </h3>"; 
} else {
echo "<h3 style='color:red'>lft table NOT ALTERED,Something went wrong, Either column(s) exist / Operation error!!! :) </h3>"; 
}


$alter_hepa_profile_add_comments = "ALTER TABLE  `hepatitis_b_profile` ADD
 (comments TEXT); ";

$query_24 = mysqli_query($connection, $alter_hepa_profile_add_comments);
if ($query_24 === TRUE) {
echo "<h3>hepatitis_b_profile table is altered  successfully :) </h3>"; 
} else {
echo "<h3 style='color:red'>hepatitis_b_profile table NOT ALTERED,Something went wrong, Either column(s) exist / Operation error!!! :) </h3>"; 
}


$alter_tbl_patient_biovitals_FBS_RBS = "ALTER TABLE  `tbl_patient_biovitals` ADD
 (fbs VARCHAR(64),rbs VARCHAR (64)); ";

$query_25 = mysqli_query($connection, $alter_tbl_patient_biovitals_FBS_RBS);
if ($query_25 === TRUE) {
echo "<h3>tbl_patient_biovitals table is altered  successfully :) </h3>"; 
} else {
echo "<h3 style='color:red'>tbl_patient_biovitals table NOT ALTERED,Something went wrong, Either column(s) exist / Operation error!!! :) </h3>"; 
}


$tbl_patient_notes = "CREATE TABLE IF NOT EXISTS tbl_patient_notes (
   id INT(11) NOT NULL AUTO_INCREMENT,
   patient_id  VARCHAR(128) NOT NULL,
   doctor_id VARCHAR(255) NOT NULL, 
   date_time_taken DATETIME NOT NULL,
   medical_notes TEXT,  
   PRIMARY KEY (id)
  )";
$query_26 = mysqli_query($connection, $tbl_patient_notes);
if ($query_26 === TRUE) {
echo "<h3>tbl_patient_notes table created OK :) </h3>"; 
} else {
echo "<h3 style='color:red'>tbl_patient_notes table NOT created,Something went wrong :( </h3>"; 
}


$alter_lipid_profile_add_coronary_risk = "ALTER TABLE  `lipid_profile` ADD ( coronary_risk VARCHAR(64) NULL ); ";

$query_27 = mysqli_query($connection, $alter_lipid_profile_add_coronary_risk);
if ($query_27 === TRUE) {
echo "<h3>lipid_profile table is altered with coronary_risk successfully :) </h3>"; 
} else {
echo "<h3 style='color:red'>lipid_profile table NOT ALTERED,Something went wrong, Either column(s) exist / Operation error!!! :) </h3>"; 
}


$tbl_create_rbs = "CREATE TABLE IF NOT EXISTS tbl_rbs (
   id INT(11) NOT NULL AUTO_INCREMENT,
   request_code  VARCHAR(128) NOT NULL,
   patient_id  VARCHAR(128) NOT NULL,
   lab_staff_id VARCHAR(128) NOT NULL, 
   RBS_LEVEL VARCHAR(128) NULL,  
   date_submitted DATE NOT NULL,
   date_updated DATE NULL,
   PRIMARY KEY (id)
  )";
$query_28 = mysqli_query($connection, $tbl_create_rbs);
if ($query_28 === TRUE) {
echo "<h3>tbl_rbs table created OK :) </h3>"; 
} else { 
echo "<h3 style='color:red'>tbl_rbs table NOT created,Something went wrong :( </h3>"; 
}


$tbl_create_hb_electrophoresis = "CREATE TABLE IF NOT EXISTS tbl_hb_electrophoresis (
   id INT(11) NOT NULL AUTO_INCREMENT,
   request_code  VARCHAR(128) NOT NULL,
   patient_id  VARCHAR(128) NOT NULL,
   lab_staff_id VARCHAR(128) NOT NULL, 
   SICKLING VARCHAR(128) NULL,  
   GENOTYPE VARCHAR(128) NULL, 
   date_submitted DATE NOT NULL,
   date_updated DATE NULL,
   PRIMARY KEY (id)
  )";
$query_29 = mysqli_query($connection, $tbl_create_hb_electrophoresis);
if ($query_29 === TRUE) {
echo "<h3>tbl_hb_electrophoresis table created OK :) </h3>"; 
} else { 
echo "<h3 style='color:red'>tbl_create_hb_electrophoresis table NOT created,Something went wrong :( </h3>"; 
}



$tbl_create_blood_film_malaria = "CREATE TABLE IF NOT EXISTS tbl_blood_film_malaria (
   id INT(11) NOT NULL AUTO_INCREMENT,
   request_code  VARCHAR(128) NOT NULL,
   patient_id  VARCHAR(128) NOT NULL,
   lab_staff_id VARCHAR(128) NOT NULL, 
   film_status VARCHAR(128) NULL,   
   date_submitted DATE NOT NULL,
   date_updated DATE NULL,
   PRIMARY KEY (id)
  )";
$query_30 = mysqli_query($connection, $tbl_create_blood_film_malaria);
if ($query_30 === TRUE) {
echo "<h3>tbl_blood_film_malaria table created OK :) </h3>"; 
} else { 
echo "<h3 style='color:red'>tbl_blood_film_malaria table NOT created,Something went wrong :( </h3>"; 
}


$alter_tbl_blood_film_malaria = "ALTER TABLE  `tbl_blood_film_malaria` ADD (film_status_count VARCHAR(128) NULL);";

$query_31 = mysqli_query($connection, $alter_tbl_blood_film_malaria);
if ($query_31 === TRUE) {
echo "<h3>tbl_blood_film_malaria table is altered  successfully :) </h3>"; 
} else {
echo "<h3 style='color:red'>tbl_blood_film_malaria table NOT ALTERED,Something went wrong, Either column(s) exist / Operation error!!! :) </h3>"; 
}


$tbl_create_table_tyroid_function_test = "CREATE TABLE IF NOT EXISTS tbl_tyroid_function_test (
   id INT(11) NOT NULL AUTO_INCREMENT,
   request_code  VARCHAR(128) NOT NULL,
   patient_id  VARCHAR(128) NOT NULL,
   lab_staff_id VARCHAR(128) NOT NULL, 
   F_T_3 VARCHAR(128) NULL,  
   F_T_4 VARCHAR(128) NULL, 
   T_S_H VARCHAR(128) NULL, 
   date_submitted DATE NOT NULL,
   date_updated DATE NULL,
   PRIMARY KEY (id)
  )";
$query_32 = mysqli_query($connection, $tbl_create_table_tyroid_function_test);
if ($query_32 === TRUE) {
echo "<h3>tbl_create_table_tyroid_function_test table created OK :) </h3>"; 
} else { 
echo "<h3 style='color:red'>tbl_create_table_tyroid_function_test table NOT created,Something went wrong :( </h3>"; 
}



//URINE new column added (Comments,spermatozoa)//tables/columns ADDED ON TUESDAY 26TH JULY,2022 TIME: 10:27 AM

$alter_urine_spermatozoa_comments = "ALTER TABLE  `urine_re` ADD
 (
    spermatozoa VARCHAR(128) NULL, 
    comments TEXT
 
 ); ";

$query_33 = mysqli_query($connection, $alter_urine_spermatozoa_comments);
if ($query_33 === TRUE) {
echo "<h3>urine_re table is altered  successfully :) </h3>"; 
} else {
echo "<h3 style='color:red'>urine_re table NOT ALTERED,Something went wrong, Either column(s) exist / Operation error!!! :) </h3>"; 
}



 
$alter_tbl_patient_vitals_add_datetime_comments = "ALTER TABLE  `tbl_patient_biovitals` ADD
 (
    
   date_time_taken DATETIME NULL, 
   comments TEXT
 
 ); ";

$query_34 = mysqli_query($connection, $alter_tbl_patient_vitals_add_datetime_comments);
if ($query_34 === TRUE) {
echo "<h3>tbl_patients_vitals table is altered  successfully :) </h3>"; 
} else {
echo "<h3 style='color:red'>tbl_patients_vitals table NOT ALTERED,Something went wrong, Either column(s) exist / Operation error!!! :) </h3>"; 
}


$tbl_detain_patient_medications_create = "CREATE TABLE IF NOT EXISTS tbl_detain_patient_medications (
   id INT(11) NOT NULL AUTO_INCREMENT,
   drug_code  VARCHAR(128) NOT NULL,
   patient_id  VARCHAR(128) NOT NULL,
   staff_id VARCHAR(128) NOT NULL,
   qty_given VARCHAR(128) NOT NULL,    
   date_time_given DATETIME NOT NULL,
   comments TEXT,
   PRIMARY KEY (id)
  )";
$query_35 = mysqli_query($connection, $tbl_detain_patient_medications_create);
if ($query_35 === TRUE) {
echo "<h3>tbl_detain_patient_medications_create table created OK :) </h3>"; 
} else { 
echo "<h3 style='color:red'>tbl_detain_patient_medications_create table NOT created,Something went wrong :( </h3>"; 
}


$alter_tbl_patient_vitals_modify_null_comments = "ALTER TABLE  `tbl_patient_biovitals` MODIFY
 (
    
   
   comments TEXT NULL
 
 ); ";

$query_36 = mysqli_query($connection, $alter_tbl_patient_vitals_modify_null_comments);
if ($query_36 === TRUE) {
echo "<h3>tbl_patients_vitals table column Comment is nullable is altered  successfully :) </h3>"; 
} else {
echo "<h3 style='color:red'>tbl_patients_vitals column comment is table NOT ALTERED,Something went wrong, Either column(s) exist / Operation error!!! :) </h3>"; 
}




$alter_tbl_patient_vitals_add_date_time_admitted = "ALTER TABLE  `tbl_patient_biovitals` ADD
 (
    
   date_time_admitted DATETIME NULL 
 
 ); ";

$query_37 = mysqli_query($connection, $alter_tbl_patient_vitals_add_date_time_admitted);
if ($query_37 === TRUE) {
echo "<h3>tbl_patients_vitals table is altered  successfully with datetime admitted :) </h3>"; 
} else {
echo "<h3 style='color:red'>tbl_patients_vitals table NOT ALTERED with datetime admitted,Something went wrong, Either column(s) exist / Operation error!!! :) </h3>"; 
}



$alter_tbl_detain_patient_medications_add_datetime_admitted = "ALTER TABLE  `tbl_detain_patient_medications` ADD
 (
    
   date_time_admitted DATETIME NULL 
 
 ); ";

$query_38 = mysqli_query($connection, $alter_tbl_detain_patient_medications_add_datetime_admitted);
if ($query_38 === TRUE) {
echo "<h3>tbl_detain_patient_medications table is altered  successfully with date_time_admitted :) </h3>"; 
} else {
echo "<h3 style='color:red'>tbl_patients_vitals table NOT ALTERED,Something went wrong, Either column(s) exist / Operation error!!! :) </h3>"; 
}



$alter_urine_others = "ALTER TABLE  `urine_re` ADD
 (
    others VARCHAR(128) NULL
 
 ); ";

$query_39 = mysqli_query($connection, $alter_urine_others);
if ($query_39 === TRUE) {
echo "<h3>urine_re table is altered  successfully with others :) </h3>"; 
} else {
echo "<h3 style='color:red'>urine_re table NOT ALTERED,Something went wrong, Either column(s) exist / Operation error!!! :) </h3>"; 
}


$alter_urine_others_add_value = "ALTER TABLE  `urine_re` ADD
 (
    others_value VARCHAR(128) NULL
 
 ); ";

$query_40 = mysqli_query($connection, $alter_urine_others_add_value);
if ($query_40 === TRUE) {
echo "<h3>urine_re table is altered  successfully with others alter_urine_others_add_value :) </h3>"; 
} else {
echo "<h3 style='color:red'>urine_re table alter_urine_others_add_value NOT ALTERED,Something went wrong, Either column(s) exist / Operation error!!! :) </h3>"; 
}


//new table hvsre

$tbl_create_hvsre = "CREATE TABLE IF NOT EXISTS tbl_hvsre (
   id INT(11) NOT NULL AUTO_INCREMENT,
   request_code  VARCHAR(128) NOT NULL,
   patient_id  VARCHAR(128) NOT NULL,
   lab_staff_id VARCHAR(128) NOT NULL, 
   ep_cell VARCHAR(128) NULL,  
   pus_cell VARCHAR(128) NULL, 
   rbcs VARCHAR(128) NULL, 
   t_vaginalis VARCHAR(128) NULL, 
   bacteria VARCHAR(128) NULL, 
   yeast_like_cells VARCHAR(128) NULL, 
   date_submitted DATE NOT NULL,
   date_updated DATE NULL,
   PRIMARY KEY (id)
  )";
$query_41 = mysqli_query($connection, $tbl_create_hvsre);
if ($query_41 === TRUE) {
echo "<h3>tbl_hvsre table created OK :) </h3>"; 
} else {
echo "<h3 style='color:red'>tbl_hvsre table NOT created,Something went wrong :( </h3>"; 
}