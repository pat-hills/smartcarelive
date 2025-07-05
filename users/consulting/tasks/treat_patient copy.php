
<div class="cl-mcont">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="block-flat">
                <div class="header">							
                    <h3>Multiple Search Area</h3>
                </div>
                <div class="content">
                    <form class="form-horizontal group-border-dashed" method="post" action="tasks/set_patient_details.php" style="border-radius: 0px;">
                        <div class="form-group">
                            <div class="col-sm-2"></div>
                            <label class="col-sm-3 control-label">Patient (ID/NHIS ID)</label>

                            <div class="col-sm-3">
                              <!--<select class="select2" name="get_details">
                                 <option value="">-- Type ID here --</option>
                                 <optgroup label="ID">
                                <?php
                                //getting all patients ID in option field labelled ID
                                //get_all_id();
                                ?>
                                 </optgroup>
                                <!<optgroup label="NATIONAL ID">
                                <?php
                                //getting all national ID in option field labelled National ID
                                //get_all_nid();
                                ?>
                                 </optgroup>
                                 <optgroup label="NHIS ID">
                                <?php
                                //getting all national health insurance ID in option field labelled NHIS
                                //get_all_NHIS();
                                ?>
                                 </optgroup>
                                 
                              </select> 
            
                              <!--<input type="hidden" name="patient_id" id="select_patient" data-placeholder="Enter Patient ID">-->
                                <input class="form-control col-sm-3" type="text" id="select_patient" name="get_details" />
                            </div>
                            <button type="submit" class="btn btn-primary btn-rad"><i class="fa fa-search"></i> Get Details</button>
                        </div>

                    </form>
                </div>
            </div>



            <div class="tab-container">
                <?php
                //calling tab control function
                set_tabs(@$_SESSION['ac_tab']);
                ?>
                <ul class="nav nav-tabs">
                    <li class="<?php echo @$_SESSION['per_tab']; ?>"><a href="#pinfo" data-toggle="tab">Personal Info</a></li>
                    <li class="<?php echo @$_SESSION['vit_tab']; ?>"><a href="#vitals" data-toggle="tab">Vitals</a></li>
                    <li class="<?php echo @$_SESSION['comp_tab']; ?>" ><a href="#complains" data-toggle="tab">Complains</a></li>
                    <li class="<?php echo @$_SESSION['inves_tab']; ?>"><a href="#investigation" data-toggle="tab">Investigations</a></li>
                    <li class="<?php echo @$_SESSION['procedure_tab']; ?>"><a href="#procedure" data-toggle="tab">Procedure</a></li>
                    <li class="<?php echo @$_SESSION['dia_tab'] ?>"><a href="#diagnose" data-toggle="tab"> Diagnosis</a></li>
                    <li class="<?php echo @$_SESSION['drug_tab']; ?>"><a href="#drug" data-toggle="tab">Prescribe Drugs</a></li>
                    <li class="<?php echo @$_SESSION['ward_tab']; ?>"><a href="#ward" data-toggle="tab">Ward Assignment</a></li>
                    <li class="<?php echo @$_SESSION['outcome_tab']; ?>"><a href="#outcome" data-toggle="tab">Treatment</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane <?php echo @$_SESSION['per_tab']; ?> cont" id="pinfo">
                        <h3 class="hthin">Personal Info</h3>
                        <div class="block-flat profile-info">
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="avatar">
                                        <img src="<?php
                if (isset($_SESSION['patient_id'])) {
                    echo patient_profile_picture($_SESSION['patient_id']);
                } else {
                    echo @no_image();
                }
                ?>" 
                                             class="profile-avatar">
                                    </div>
                                </div>
                                <div class="col-sm-7">

                                    <div class="personal">
                                        <h1 class="name"><?php echo @$_SESSION['surname'] . " " . @$_SESSION['other_names']; ?></h1>
                                        <p class="description">Patient ID: <?php echo @$_SESSION['patient_id']; ?></p>

                                        <!-- -->
                                        <?php if (isset($_SESSION['scheme']) && !empty($_SESSION['scheme'])) { ?>
                                            <p class="description">Insurance Scheme: <?php echo @strtoupper($_SESSION['scheme']); ?></p>
                                        <?php } else { ?>
                                            <p class="description">Insurance Scheme: None</p>
                                        <?php } ?>

                                        <!-- -->
                                        <?php if (isset($_SESSION['sub_metro']) && !empty($_SESSION['sub_metro'])) { ?>
                                            <p class="description">Sub Metro: <?php echo @$_SESSION['sub_metro']; ?></p>
                                        <?php } ?>

                                        <!-- -->
                                        <?php if (isset($_SESSION['membership_id']) && !empty($_SESSION['membership_id'])) { ?>
                                            <p class="description">Membership ID: <?php echo @ucfirst($_SESSION['membership_id']); ?></p>
                                        <?php } //else {  ?>
                                        <!--<p class="description">Membership ID: </p>-->
                                        <?php //}  ?>


                                        <p class="description">Occupation: <?php echo @$_SESSION['occupation']; ?></p><p>
                                        <p class="description">Age : <?php get_age(@$_SESSION['dob']);
                                        echo" years"; ?></p><p>
                                        <p class="description">Gender: <?php echo @$_SESSION['sex']; ?></p>
                                        <p>
                                            <a href="medical_history.php" class="btn btn-danger" >Past Medical History</a>

                                        </p></div>
                                </div>


                            </div>
                        </div>

                    </div>

                    <div class="tab-pane <?php echo @$_SESSION['vit_tab']; ?> cont" id="vitals">
                        <h3 class="hthin">Vitals</h3> 
                        <?php
                        //calling 
                        require_once "../../functions/func_consulting.php";
                        $bio_vital = get_bio(@$_SESSION['patient_id']);
                        //$staff = get_staff_info($bio_vitals['taken_by']);
                        ?>
                        <div class="content">
                            <ul class="list-group">
                                <li class="list-group-item"><strong>Weight: </strong> <?php echo @$bio_vital['weight']; ?> </li>

                                <li class="list-group-item"><strong>Height: </strong> <?php echo @$bio_vital['height']; ?> </li>
                                <li class="list-group-item"><strong>Blood Pressure: </strong> <?php echo @$bio_vital['blood_pressure']; ?> </li>
                                <li class="list-group-item"><strong>Temperature: </strong> <?php echo @$bio_vital['temperature']; ?> </li>
                                <li class="list-group-item"><strong>BMI: </strong> <?php echo @$bio_vital['bmi']; ?> </li>
                                <?php if (empty($bio_vital['date_taken'])) { ?>

                                    <li class="list-group-item"><strong>Date Taken: </strong> </li>
                                <?php } else { ?>	
                                    <li class="list-group-item"><strong>Date Taken: </strong> <?php echo date('jS F, Y', strtotime(@$bio_vital['date_taken'])) ?> @ <?php echo date('H:i', strtotime(@$bio_vital['date_taken'])) ?> </li>
                                <?php } ?>						

                                <?php
                                $staff = get_staff_info($bio_vital['taken_by']);
                                ?> 
                                <li class="list-group-item"><strong>Taken By: </strong> <?php echo $staff['firstName'] . " " . $staff['otherNames'] ?></li>

                            </ul>
                        </div>

                        <div style="text-align:center;">
                            <a class="btn btn-success btn-flat md-trigger" data-modal="update_vitals">Bio Vitals</a>
                        </div>	


                    </div>

                    <!-- Nifty Modal -->



                    <div class="md-modal colored-header md-effect-10" id="update_vitals" >
                        <div class="md-content" style="border: 1px dashed #3078EF">
                            <div class="modal-header">
                                <h3>Take or Update Bio Vitals</h3>
                                <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body form">
                                <form role="form" action="tasks/insert_vitals.php" method="post" autocomplete="off"> 
                                    <div class="form-group">
                                        <label>Weight (kg)</label> <input  type="text" name="weight" value="<?php echo @$_SESSION['weight']; ?>" placeholder="" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Height</label> <input  type="text" name="height" value="<?php echo @$_SESSION['height']; ?>" placeholder="" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Blood Pressure</label> <input  type="text" name="blood_pressure" value="<?php echo @$_SESSION['blood_pressure']; ?>" placeholder="" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Tempature</label> <input  type="text" name="temperature" value="<?php echo @$_SESSION['temperature']; ?>" placeholder="" class="form-control">
                                    </div>

                                    <div style="text-align: center;">
                                        <button class="btn btn-primary" style="text-align:center;"  type="submit" name="add">Add Vitals</button>
                                    </div>

                                    <div></div><br>
                                </form>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default btn-flat md-close" data-dismiss="modal">OK</button>

                            </div>
                        </div>
                    </div>
                    <!-- Nifty Modal -->	

                    <div class="tab-pane <?php echo @$_SESSION['comp_tab']; ?> cont" id="complains">
                        <h3 class="hthin">Complains</h3>

                        <div class="header">							

                            <div class="col-sm-6"></div>
                            <div  style="text-align: center; margin-top: 10px;">
                                <div class="col-sm-6"> <?php
                                echo @$_SESSION['comp_err'];
                                unset($_SESSION['comp_err']);
                                ?>
                                </div>
                            </div>
                        </div>

                        <div class="content">
                            <form class="form-horizontal group-border-dashed" data-parsley-namespace="data-parsley-" data-parsley-validate novalidate role="form" method="post" action="db_tasks/add_complains.php"> 
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">List Complains</label>
                                    <div class="col-sm-6">
                                        <select class="select2" multiple name="complains[]" >


                                            <optgroup label="All Complains">  

                                                <?php
                                                echo list_complains();
                                                ?>
                                            </optgroup>


                                        </select>

                                    </div>


                                </div>
                                <div class="form-group">
                                    <div style="text-align: center; margin-top: 10px;">
                                        <button class="btn btn-primary" type="submit">Save Complains</button>

                                    </div>
                                </div>
                            </form>



                            <div class="content">
                                <div class="table-responsive">
                                    <table class="table no-border hover">
                                        <thead class="no-border">
                                            <tr>

                                                <th style="width:30%;"><strong>Complains</strong></th>

                                                <th style="width:15%;"><strong>Date</strong></th>
                                                <th style="width:15%;"><strong>Taken By</strong></th>
                                                <th style="width:15%;" class="text-center"><strong>Undo</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody class="no-border-y">

                                            <?php
                                            //get_comp(@$_SESSION['patient_id']);
                                            $complain = get_complains(@$_SESSION['patient_id']);
                                            $_SESSION['complain_id'] = $complain['id'];
                                            $complain_code = explode(',', $complain['complain']);
                                            ?>
                                            <?php if (isset($complain)) { ?>

                                                <tr>
                                                    <td><?php get_complains_name($complain_code); //echo $complain['complain']; //complain_name($complain['complain']); ?></td>
                                                    <td> <?php echo date('jS F, Y', strtotime($complain['date_taken'])); ?></td>					
                                                    <td>

                                                        <?php
                                                        if ($_SESSION['uid'] == $complain['doctor_id']) {
                                                            echo "You";
                                                        } else {

                                                            $doctor = get_staff_info($complain['doctor_id']);

                                                            echo $doctor['firstName'] . " " . $doctor['otherNames'];
                                                        }
                                                        ?>

                                                    </td>

                                                    <td class='text-center'>
                                                        <a class='label label-primary md-trigger' data-modal='edit_complains'><i class='fa fa-edit'></i></a>
                                                        <a class='label label-danger' href='db_tasks/undo_complains.php?id=<?php echo $complain['id'] ?>'><i class='fa fa-times'></i></a>
                                                    </td>

                                                </tr>

<?php } ?>


                                        </tbody>
                                    </table>		
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Nifty Modal -->

                    <div class="md-modal colored-header md-effect-10" id="edit_complains" >
                        <div class="md-content" style="border: 1px dashed #3078EF">
                            <div class="modal-header">
                                <h3>Edit Complains</h3>
                                <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body form">
                                <form class="form-horizontal group-border-dashed" data-parsley-namespace="data-parsley-" data-parsley-validate novalidate role="form" method="post" action="db_tasks/edit_complains.php"> 
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">List Complains</label>

                                        <div class="col-sm-6">
                                            <select class="select2" multiple name="edit_complains[]" >

<?php
$complains = get_selected_complains(@$_SESSION['patient_id']);

foreach ($complains as $complain) {

    echo "<option selected='selected' value=" . $complain . ">" . complains_name($complain) . "</option>";
}
?>

                                                <optgroup label="All Complains">  

                                                <?php
                                                echo list_complains();
                                                ?>
                                                </optgroup>

                                            </select>

                                        </div>


                                    </div>
                                    <div class="form-group">
                                        <div style="text-align: center; margin-top: 10px;">
                                            <button class="btn btn-primary" type="submit">Save Complains</button>

                                        </div>
                                    </div>
                                </form>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default btn-flat md-close" data-dismiss="modal">OK</button>

                            </div>
                        </div>
                    </div>
                    <!-- Nifty Modal -->	


                    <div class="tab-pane <?php echo @$_SESSION['inves_tab']; ?> cont" id="investigation">
                        <h3 class="hthin">Investigations</h3>

                        <div class="form-group">
                            <div class="header">	
                                <div class="col-sm-6"></div>
                                <div class="col-sm-6"><?php
                                                echo @$_SESSION['inves_err'];
                                                unset($_SESSION['inves_err']);
                                                ?></div>
                            </div>	


                            <div class="content">
                                <form class="form-horizontal group-border-dashed" action="db_tasks/add_inves.php" method="post" style="border-radius: 0px;">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">List Investigation</label>
                                        <div class="col-sm-6">
                                            <select class="select2" multiple name="investigation[]" >
                                                <optgroup label="Investigation">

<?php
list_investigations();
?>
                                                </optgroup>
                                                <!--<optgroup label="Blood">
                                                  <option value="CA">HIV</option>
                                                  <option value="NV">Sickle Cell</option>
                                                  
                                                </optgroup>
                                                <optgroup label="Eye">
                                                  <option value="AZ">Focus</option>
                                                  <option value="CO">Redness</option>
                                                 
                                                </optgroup>-->


                                            </select>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Remarks</label>
                                        <div class="col-sm-6">
                                            <div class="input-group input-group-lg">

                                                <textarea name="remarks" class="form-control" cols="60" rows="" placeholder="Remarks"></textarea>

                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <div style="text-align: center; margin-top: 10px;">
                                            <button class="btn btn-primary" type="submit">Request Investigation</button>

                                        </div>
                                    </div>
                                </form>
                            </div>


                            <div class="table-responsive">
                                <table class="table no-border hover">
                                    <thead class="no-border">
                                        <tr>

                                            <th style="width:30%;"><strong>Investigation</strong></th>
                                            <th style="width:10%;"><strong>Amount</strong></th>
                                            <th style="width:15%;"><strong>Date</strong></th>
                                            <th style="width:15%;"><strong>Requested By</strong></th>
                                            <th style="width:15%;" class="text-center"><strong>Undo</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody class="no-border-y">


<?php
//get_comp(@$_SESSION['patient_id']);
//$complain = get_complains(@$_SESSION['patient_id']);
$investigation = get_investigations(@$_SESSION['patient_id']);
$_SESSION['investigation_id'] = $investigation['id'];
$investigation_code = explode(',', $investigation['requested_test']);
?>
                                        <?php if (isset($investigation)) { ?>

                                            <tr>
                                                <td><?php get_investigation_name($investigation_code); //echo $complain['complain']; //complain_name($complain['complain']);?></td>
                                                <td> <?php echo investigation_amount(@$_SESSION['patient_id'], @$_SESSION['request_code']); ?></td>	
                                                <td> <?php echo date('jS F, Y', strtotime($investigation['requested_date'])); ?></td>					
                                                <td>
    <?php
    if ($_SESSION['uid'] == $investigation['doctor_id']) {
        echo "You";
    } else {

        $doctor = get_staff_info($investigation['doctor_id']);
        echo $doctor['firstName'] . " " . $doctor['otherNames'];
    }
    ?>

                                                </td>

                                                <td class='text-center'>
                                                    <a class='label label-primary' href='view_lab_report.php?code=<?php echo $investigation['request_code'] ?>'><i class='fa fa-eye'></i></a>
                                                    <a class='label label-primary md-trigger' data-modal='edit_investigations' href="#"><i class='fa fa-edit'></i></a>
                                                    <a class='label label-danger' href='db_tasks/undo_investigation.php?id=<?php echo $investigation['id'] ?>'><i class='fa fa-times'></i></a>
                                                </td>

                                            </tr>

<?php } ?>
                                    </tbody>
                                </table>		
                            </div>

                        </div>
                    </div>

                    <!-- Nifty Modal -->

                    <div class="md-modal colored-header md-effect-10" id="edit_investigations" >
                        <div class="md-content" style="border: 1px dashed #3078EF">
                            <div class="modal-header">
                                <h3>Edit Investigations</h3>
                                <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body form">
                                <form class="form-horizontal group-border-dashed" data-parsley-namespace="data-parsley-" data-parsley-validate novalidate role="form" method="post" action="db_tasks/edit_investigations.php"> 
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">List Investigations</label>

                                        <div class="col-sm-6">
                                            <select class="select2" multiple name="edit_investigations[]" >

<?php
$investigations = get_selected_investigations(@$_SESSION['patient_id']);

foreach ($investigations as $investigation) {

    echo "<option selected='selected' value=" . $investigation . ">" . investigation_name($investigation) . "</option>";
}
?>

                                                <optgroup label="All Investigations">  

                                                <?php
                                                echo list_investigations();
                                                ?>
                                                </optgroup>

                                            </select>

                                        </div>


                                    </div>
                                    <div class="form-group">
                                        <div style="text-align: center; margin-top: 10px;">
                                            <button class="btn btn-primary" type="submit">Save Investigations</button>

                                        </div>
                                    </div>
                                </form>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default btn-flat md-close" data-dismiss="modal">OK</button>

                            </div>
                        </div>
                    </div>
                    <!-- Nifty Modal -->	

                    <div class="tab-pane <?php echo @$_SESSION['procedure_tab']; ?> cont" id="procedure">
                        <h3 class="hthin">Procedure</h3>

                        <div class="form-group">
                            <div class="header">	
                                <div class="col-sm-6"></div>
                                <div class="col-sm-6"><?php
                                                echo @$_SESSION['inves_err'];
                                                unset($_SESSION['inves_err']);
                                                ?></div>
                            </div>	


                            <div class="content">
                                <form class="form-horizontal group-border-dashed" action="db_tasks/add_procedure.php" method="post" style="border-radius: 0px;">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Select Procedure</label>
                                        <div class="col-sm-6">
                                            <select class="select2" multiple name="procedure[]" >
                                                <optgroup label="Category">

<?php
//get_inves_list();
?>
                                                </optgroup>
                                                <optgroup label="Blood">
                                                    <option value="CA">HIV</option>
                                                    <option value="NV">Sickle Cell</option>

                                                </optgroup>
                                                <optgroup label="Eye">
                                                    <option value="AZ">Focus</option>
                                                    <option value="CO">Redness</option>

                                                </optgroup>


                                            </select>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Remarks</label>
                                        <div class="col-sm-6">
                                            <div class="input-group input-group-lg">

                                                <textarea name="remarks" class="form-control" cols="60" rows="" placeholder="Remarks"></textarea>

                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <div style="text-align: center; margin-top: 10px;">
                                            <button class="btn btn-primary" type="submit">Request Procedure</button>	
                                        </div>
                                    </div>
                                </form>
                            </div>


                            <div class="table-responsive">
                                <table class="table no-border hover">
                                    <thead class="no-border">
                                        <tr>

                                            <th style="width:30%;"><strong>Procedure</strong></th>

                                            <th style="width:15%;"><strong>Date</strong></th>
                                            <th style="width:15%;"><strong>Requested By</strong></th>
                                            <th style="width:15%;" class="text-center"><strong>Undo</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody class="no-border-y">
<?php
//get_inves(@$_SESSION['patient_id']);
?>


                                    </tbody>
                                </table>		
                            </div>


                            <!-- Nifty Modal -->
                            <div class="md-modal md-dark custom-width md-effect-9" id="pro_his">
                                <div class="md-content">
                                    <div class="modal-header">
                                        <h3>Procedure History</h3>
                                        <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body form">
                                        <div class="text-center">
<?php
//get_inves_his(@$_SESSION['patient_id']);
?>
                                        </div>
                                        <div class="modal-footer">

                                            <button type="button" class="btn btn-primary btn-flat md-close" data-dismiss="modal">OK</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>		

                    <div class="tab-pane <?php echo @$_SESSION['dia_tab']; ?> cont" id="diagnose">
                        <h3 class="hthin">Diagnosis</h3>
                        <form class="form-horizontal group-border-dashed" method="post" name="add_diag[]" action="db_tasks/add_diagnosis.php" style="border-radius: 0px;">
                            <div class="form-group">
                                <div class="header">							
                                    <h3>Select Diagnosis</h3>
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6"><?php
echo @$_SESSION['diag_err'];
unset($_SESSION['diag_err']);
?></div>
                                </div>
                                <div class="content">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Multi Select</label>
                                        <div class="col-sm-6">
                                            <select class="select2" multiple name="pat_diag[]">
                                                <optgroup label="Diagnosis">
                                        <?php
                                        //getting list of already existing diagnosis from table
                                        list_diagnosis();
                                        ?>
                                                </optgroup>

                                            </select>
                                        </div>
                                        <button class="btn btn-primary" type="submit">Add Diagnosis</button>

                                    </div>
                                </div>
                            </div>

                        </form>

                        <form role="form"> 
                            <div class="form-group">
                                <div class="header">							
                                    <h3>Add New Diagnosis</h3>
                                </div>
                        </form>
                        <div class="content">
                            <form class="form-horizontal group-border-dashed" method="post" action="db_tasks/add_new_diagnosis.php" style="border-radius: 0px;">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">New Diagnosis Addition</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="new_diag" required="true" class="form-control"/>
                                    </div>
                                    <button class="btn btn-info" type="submit" >Add New Diagnosis</button>
                                </div>
                        </div>
                    </div>


                    </form>

                    <div class="table-responsive">
                        <table class="table no-border hover">
                            <thead class="no-border">
                                <tr>

                                    <th style="width:30%;"><strong>Diagnosis</strong></th>

                                    <th style="width:15%;"><strong>Date</strong></th>
                                    <th style="width:15%;"><strong>Taken By</strong></th>
                                    <th style="width:15%;" class="text-center"><strong>Action</strong></th>
                                </tr>
                            </thead>
                            <tbody class="no-border-y">


<?php
$diagnosis = get_diagnosis(@$_SESSION['patient_id']);
$_SESSION['diagnosis_id'] = $diagnosis['id'];
$diagnosis_code = explode(',', $diagnosis['diagnosis']);
?>
<?php if (isset($diagnosis)) { ?>

                                    <tr>
                                        <td><?php get_diagnosis_name($diagnosis_code); ?></td>
                                        <td> <?php echo date('jS F, Y', strtotime($diagnosis['date_added'])); ?></td>					
                                        <td>

                                    <?php
                                    if ($_SESSION['uid'] == $diagnosis['doc_id']) {
                                        echo "You";
                                    } else {

                                        $doctor = get_staff_info($diagnosis['doc_id']);

                                        echo $doctor['firstName'] . " " . $doctor['otherNames'];
                                    }
                                    ?>

                                        </td>

                                        <td class='text-center'>

                                            <a class='label label-primary md-trigger' data-modal='edit_diagnosis'><i class='fa fa-edit'></i></a>
                                            <a class='label label-danger' href='db_tasks/undo_diagnosis.php?id=<?php echo $diagnosis['id'] ?>'><i class='fa fa-times'></i></a>
                                        </td>

                                    </tr>

                                        <?php } ?>
                            </tbody>
                        </table>		
                    </div>

                </div>




                <!-- Nifty Modal -->

                <div class="md-modal colored-header md-effect-10" id="edit_diagnosis" >
                    <div class="md-content" style="border: 1px dashed #3078EF">
                        <div class="modal-header">
                            <h3>Edit Diagnosis</h3>
                            <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body form">
                            <form class="form-horizontal group-border-dashed" data-parsley-namespace="data-parsley-" data-parsley-validate novalidate role="form" method="post" action="db_tasks/edit_diagnosis.php"> 
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">List Diagnosis</label>

                                    <div class="col-sm-6">
                                        <select class="select2" multiple name="edit_diagnosis[]" >

<?php
$diagnosis = get_selected_diagnosis(@$_SESSION['patient_id']);

foreach ($diagnosis as $diagnose) {

    echo "<option selected='selected' value=" . $diagnose . ">" . diagnosis_name($diagnose) . "</option>";
}
?>

                                            <optgroup label="All Diagnosis">  

<?php
list_diagnosis();
?>
                                            </optgroup>

                                        </select>

                                    </div>


                                </div>
                                <div class="form-group">
                                    <div style="text-align: center; margin-top: 10px;">
                                        <button class="btn btn-primary" type="submit">Save Diagnosis</button>

                                    </div>
                                </div>
                            </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-flat md-close" data-dismiss="modal">OK</button>

                        </div>
                    </div>
                </div>
                <!-- Nifty Modal -->	

                <div class="tab-pane <?php echo @$_SESSION['drug_tab']; ?> cont" id="drug">
                    <h3 class="hthin">Drug Prescribtion</h3>

<?php
echo @$_SESSION['presc_err'];
unset($_SESSION['presc_err']);
?>

                    <div class="content">
                        <form class="form-horizontal group-border-dashed" method="post" action="db_tasks/add_prescribe.php" style="border-radius: 0px;">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Select Drug</label>
                                <div class="col-sm-6">
                                    <select class="select2" name="drug">
                                        <option value="">-- Select Drug --</option>
                                        <optgroup label="NHIS">
<?php
$nhis = 1;
list_drugs($nhis);
?>

                                        </optgroup>
                                        <optgroup label="NON NHIS">
                    <?php
                    $non_nhis = 0;
                    list_drugs($non_nhis);
                    ?>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <h4 class="hthin">Dosage </h4>
                                    <div class="col-sm-12" style="float:left;margin-left:20%">
                                        <input style="width:10%;display:inline" name="quantity" required="" class="form-control" type="text">
                                        &nbsp;X&nbsp;
                                        <input style="width:10%;display:inline" name="times" required="" class="form-control" type="text">

                                        <select name="time_interval" required="" class="form-control" style="width:20%;display:inline">
                                            <option value=""> -- Select  -- </option>
                                            <option>Hour</option>	
                                            <option>Daily</option>
                                            <option>Weekly</option>
                                            <option>Monthly</option>
                                            <option>Yearly</option>

                                        </select>
                                        <input name="duration" required="" class="form-control " style="width:10%;display:inline" type="text">
                                        <select name="time_span" required="" class="form-control" style="width:20%;display:inline">
                                            <option value=""> -- Select  -- </option>

                                            <option>Day(s)</option>
                                            <option>Week(s)</option>
                                            <option>Month(s)</option>
                                            <option>Year(s)</option>

                                        </select>

                                    </div>
                                </div> </div>



                            <!--	<div class="form-group">
                                      <label class="col-sm-3 control-label">Times : </label>
                                      <div class="col-sm-2">
                                        <input name="times" required="" class="form-control" type="text">
                                      </div>
                              </div> --->
                            <!---<div class="form-group">
                                    <label class="col-sm-3 control-label">Time : </label>
                                   
                                    <div class="col-sm-2">
      
                                                            <select name="time_interval" required="" class="form-control">
                                                                    <option value=""> -- Select  -- </option>

                                                                    <option>Daily</option>
                                                    <option>Weekly</option>
                                                    <option>Monthly</option>
                                                    <option>Yearly</option>

                                                            </select>
                                                    </div>	
                            </div> --->
                            <!--<div class="form-group">
                                    <label class="col-sm-3 control-label">Duration : </label>
                                    <div class="col-sm-2">
                                      <input name="duration" required="" class="form-control" type="text">
                                    </div>
                            </div> ---->

                            <div class="form-group">
                                <div style="text-align: center; margin-top: 10px;">
                                    <button class="btn btn-primary" type="submit">Add Prescribtion</button>

                                </div>
                            </div>

                            <!--<div class="form-group">
                                    Dosage <input type="text" name="dosage"  />
                        
                            X times <input type="number" name="times" class="form-group" />
                            Every <input type="text" name="rate" class="form-group" placeholder="number required" /> 
                            Time <select name="time">
                                    <option>Second</option>
                                    <option>Minute</option>
                                    <option>Hour</option>
                                    <option>Day</option>
                                    <option>Months</option>
                                    <option>Years</option>
                                    
                             </select>
                                    </div>-->
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table no-border hover">
                            <thead class="no-border">
                                <tr>

                                    <th style="width:20%;"><strong>Drug</strong></th>

                                    <th style="width:15%;"><strong>Dosage</strong></th>


                                    <th style="width:15%;"><strong>Prescribed By</strong></th>
                                    <th style="width:15%;" class="text-center"><strong>Action</strong></th>
                                </tr>
                            </thead>
                            <tbody class="no-border-y">

<?php
$prescribtions = get_prescribtion(@$_SESSION['patient_id']);
?>

                            </tbody>
                        </table>		
                    </div>

                </div>

                <div class="tab-pane <?php echo @$_SESSION['ward_tab']; ?> cont" id="ward">
                    <h3 class="hthin">Admission</h3>

<?php
echo @$_SESSION['ward_err'];
unset($_SESSION['ward_err']);
?>

                    <form role="form" class="form-horizontal group-border-dashed" action="db_tasks/assign_ward.php" method="post">

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Admission : </label>
                            <div class="col-sm-6">   

                                <select class="select2" name="ward">
                                    <option value="">-- Select Ward  --</option>
                                    <optgroup label="Male Ward">
                                        <option value="male_ward">Male Ward 1</option>

                                    </optgroup>
                                    <optgroup label="Female">
                                        <option value="female_ward">Female Ward 1</option>


                                    </optgroup>
                                    <optgroup label="Maternity">
                                        <option value="maternity">Maternity Ward 1</option>


                                    </optgroup>
                                    <optgroup label="Paediatric">
                                        <option value="paediatric">Paediatric Ward 1</option>


                                    </optgroup>
                                    <optgroup label="Surgical">
                                        <option value="theatre">Theatre Ward 1</option>

                                    </optgroup>        
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Comment on Ward Assignment</label>
                            <div class="col-sm-6">
                                <div class="input-group input-group-lg">

                                    <textarea name="comment" class="form-control" cols="60" rows="" placeholder="Comments here"></textarea>

                                </div>
                            </div>

                        </div>
<?php
$ward = get_ward_assignment(@$_SESSION['patient_id']);
$_SESSION['ward_id'] = $ward['id'];
?> 
<?php if (isset($ward)) { ?>

<?php } else { ?>	
                            <div style="text-align: center; margin-top: 10px;"><button class="btn btn-primary " name="assign_ward">Assign Ward</button></div>
<?php } ?>	
                    </form>

                    <div class="table-responsive">
                        <table class="table no-border hover">
                            <thead class="no-border">
                                <tr>

                                    <th style="width:40%;"><strong>Admitted to: </strong></th>
                                    <th style="width:20%;"><strong>Comment on Admission</strong></th>
                                    <th style="width:15%;"><strong>Date</strong></th>
                                    <th style="width:15%;"><strong>Admitted By</strong></th>
                                    <th style="width:10%;" class="text-center"><strong>Action</strong></th>
                                </tr>
                            </thead>
                            <tbody class="no-border-y">


                        <?php
                        //$ward = get_ward_assignment(@$_SESSION['patient_id']);
                        //$_SESSION['ward_id'] = $ward['id'];
                        ?>
                        <?php if (isset($ward)) { ?>

                                    <tr>
                                        <td><?php echo $ward['ward_name']; ?></td>
                                        <td> <?php echo $ward['comments'] ?></td>
                                        <td> <?php echo date('jS F, Y', strtotime($ward['date_added'])); ?></td>
                                        <td>

    <?php
    if ($_SESSION['uid'] == $ward['doctor_id']) {
        echo "You";
    } else {

        $doctor = get_staff_info($ward['doctor_id']);

        echo $doctor['firstName'] . " " . $doctor['otherNames'];
    }
    ?>

                                        </td>

                                        <td class='text-center'>

                                            <a class='label label-danger' href='db_tasks/undo_assignment.php?id=<?php echo $ward['id'] ?>'><i class='fa fa-times'></i></a>
                                        </td>

                                    </tr>

<?php } ?>
                            </tbody>
                        </table>		
                    </div>

                </div>

                <div class="tab-pane <?php echo @$_SESSION['outcome_tab']; ?> cont" id="outcome">
                    <h3 class="hthin">Patient's Treatment Outcome</h3>
                                        <?php
                                        echo @$_SESSION['end_err'];
                                        unset($_SESSION['end_err']);
                                        ?>
                    <form role="form" class="form-horizontal group-border-dashed" action="db_tasks/end_treatment.php" method="post">

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Outcome : </label>
                            <div class="col-sm-6">   

                                <select class="select2" name="outcome">
                                    <option value="">-- Select Outcome  --</option>
                                    <optgroup label="type">

                                        <option value="Discharged">Discharged</option>
                                        <option value="Died">Died </option>
                                        <option value="Transferred Out">Transferred Out </option>
                                        <option value="Absconded/Discharged against medical advice">Absconded/Discharged-against-medical-advice </option>

                                    </optgroup>
                                </select>
                            </div>
                        </div>

                        <div style="text-align: center; margin-top: 10px;"><button class="btn btn-primary " name="end_treatment">End Treatment</button></div>

                    </form>
                </div>
                <div class="tab-pane" id="messages">..sdfsdfsfsdf.</div>
            </div>
        </div>


    </div>

</div>
</div>
</div>
