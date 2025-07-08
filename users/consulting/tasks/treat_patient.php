
<div class="cl-mcont">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="block-flat">
                <div class="header">							
                    <h3>Consulting Room</h3>
                </div>
                <div class="content">
                    <form class="form-horizontal group-border-dashed" method="post" action="tasks/set_patient_details.php" style="border-radius: 0px;">
                        <div class="form-group">
                            <div class="col-sm-2"></div>
                            <label class="col-sm-3 control-label">Search Patient</label>

                            <div class="col-sm-3"> 
                                <input required  class="form-control col-sm-3" placeholder="Begin by first name and select patient" autocomplete="off" type="text" id="select_patient" name="get_details" />
                            </div>
                            <!-- <button type="submit" class="btn btn-primary btn-rad"><i class="fa fa-search"></i> Get Details</button> -->
                        </div>

                        <div id="result" class="list-group"></div>


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
                    <li class="<?php echo @$_SESSION['red_flag']; ?>"><a href="#red_flag" data-toggle="tab"><b style="color:red">Red Flag</b></a></li>
                    <li class="<?php echo @$_SESSION['vit_tab']; ?>"><a href="#vitals" data-toggle="tab">Vitals</a></li>
                    <li class="<?php echo @$_SESSION['comp_tab']; ?>" ><a href="#complains" data-toggle="tab">Complains</a></li>
                    <li class="<?php echo @$_SESSION['onexamination_tab']; ?>" ><a href="#onexamination" data-toggle="tab">On Examination</a></li>
                    <li class="<?php echo @$_SESSION['inves_tab']; ?>"><a href="#investigation" data-toggle="tab">Investigations</a></li>
                    <li class="<?php echo @$_SESSION['scans_tab']; ?>"><a href="#Scans" data-toggle="tab">Scans</a></li>
                    <!-- <li class="<?php // echo @$_SESSION['procedure_tab']; ?>"><a href="#procedure" data-toggle="tab">Procedure</a></li> -->
                    <li class="<?php echo @$_SESSION['dia_tab'] ?>"><a href="#diagnose" data-toggle="tab"> Diagnosis</a></li>

                    <?php if(IS_ADMISSION == true) { ?>


<li class="<?php echo @$_SESSION['ward_tab']; ?>"><a href="#ward" data-toggle="tab">Admission</a></li> 


<?php } ?>
                    <li class="<?php echo @$_SESSION['drug_tab']; ?>"><a href="#drug" data-toggle="tab">Prescribe Drugs</a></li>

                    <?php if(IS_ADMISSION == true) { ?>

 
<li class="<?php echo @$_SESSION['outcome_tab']; ?>"><a href="#outcome" data-toggle="tab">  Outcome</a></li>


<?php } ?>

                    <li class="<?php echo @$_SESSION['notes_tab']; ?>" ><a href="#notes" data-toggle="tab">Notes</a></li>
                    <li class="<?php echo @$_SESSION['files_tab']; ?>" ><a href="#files" data-toggle="tab">Files</a></li>

                    <li class="<?php echo @$_SESSION['reviews']; ?>"><a href="#reviews" data-toggle="tab">Reviews</a></li>


             
                    
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
                                        <!-- <?php 
                                        
                                       // if (isset($_SESSION['sub_metro']) && !empty($_SESSION['sub_metro'])) { ?>
                                            <p class="description">Sub Metro: <?php // echo @$_SESSION['sub_metro']; ?></p>


                                        <?php// } ?> -->

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

                                        <p class="description">Blood Group: <?php 

                                            $patient_id = trim(@$_SESSION['patient_id']);
                                            $teststatus = get_patient_general_test_status($patient_id,"BLOOD GROUP");
                                            echo $teststatus;
                                         ?></p>

                                        <p class="description">Sickling: <?php 

                                        $patient_id = trim(@$_SESSION['patient_id']);
                                        $teststatus = get_patient_general_test_status($patient_id,"Sickling");
                                        echo $teststatus;
                                        ?></p>

                                            <p class="description">G6PD: <?php 

                                            $patient_id = trim(@$_SESSION['patient_id']);
                                            $teststatus = get_patient_general_test_status($patient_id,"G6PD");
                                            echo $teststatus;
                                            ?></p>

                                        <p>

                                        </p>

                                            <p class="description">RH: <?php 

                                            $patient_id = trim(@$_SESSION['patient_id']);
                                            $teststatus = get_patient_general_test_status($patient_id,"RH");
                                            echo $teststatus;
                                            ?></p>

                                        <p>
                                            <a href="medical_history" class="btn btn-danger" >Past Medical History</a>

                                        </p>
                                    </div>
                                </div>


                            </div>
                        </div>

                    </div>

                    <div class="tab-pane <?php echo @$_SESSION['vit_tab']; ?> cont" id="vitals">
                        <h3 class="hthin">Vitals Today's</h3> 
                        <?php
//calling 
                        require_once "../../functions/func_consulting.php";
                        $bio_vital = get_bio(@$_SESSION['patient_id']);
                        $bio_vital_last_vist = get_bio_last_visit(@$_SESSION['patient_id']);

                        // $bio_vital_last_vist = $bio_vital_last['data'];
                        // $source = $bio_vital_last['source'];

                    // if ($source === 'cache') {
                    //     echo "<small style='color: green;'>Source: Cache ✅</small><br>";
                    // } elseif ($source === 'db') {
                    //     echo "<small style='color: orange;'>Source: Database 🟠</small><br>";
                    // } else {
                    //     echo "<small style='color: red;'>No data found ❌</small><br>";
                    // }
                        ?>
                        <div class="content">
                            <ul class="list-group">

                            
                                <li class="list-group-item"><strong>Temperature (°C): </strong> <?php echo @$bio_vital['temperature']; ?> </li>
                                <li class="list-group-item"><strong>Blood Pressure (mmHg): </strong> <?php 
                                
                                if(isset($bio_vital['blood_pressure_top']) && isset($bio_vital['blood_pressure_down'])){
                                    echo @$bio_vital['blood_pressure_top']." / ".$bio_vital['blood_pressure_down'] ;
                                }

                               
                                
                                ?> </li>

                                
                                <li class="list-group-item"><strong>Pulse (bpm): </strong> <?php echo @$bio_vital['pulse']; ?> </li>

                                <li class="list-group-item"><strong>SpO2 (%): </strong> <?php echo @$bio_vital['s_p_0_2']; ?> </li>

                                

                                <li class="list-group-item"><strong>Respiration ( Breath/Minute ): </strong> <?php echo @$bio_vital['respiration']; ?> </li>

                                <li class="list-group-item"><strong>Weight (Kg): </strong> <?php echo @$bio_vital['weight']; ?> </li>

                                <li class="list-group-item"><strong>Fbs: </strong> <?php echo @$bio_vital['fbs']; ?> </li>

                                <li class="list-group-item"><strong>Rbs: </strong> <?php echo @$bio_vital['rbs']; ?> </li>


                                <?php if(IS_BMI == true) { ?>

                                <li class="list-group-item"><strong>Height (m): </strong> <?php echo @$bio_vital['height']; ?> </li>
                                <li class="list-group-item"><strong>BMI: </strong> <?php echo @$bio_vital['bmi']; ?> </li>

                                <?php } ?>

                             
                              
                               

                               

                   

                                <?php if (empty($bio_vital['date_taken'])) { ?>

                                    <li class="list-group-item"><strong>Date Taken: </strong> </li>
                                <?php } else { ?>	
                                    <li class="list-group-item"><strong>Date Taken: </strong> <?php echo date('jS F, Y', strtotime(@$bio_vital['date_taken'])) ?>  <?php //echo date('H:i', strtotime(@$bio_vital['date_taken'])) ?> </li>
                                <?php } ?>						

                                <?php
                                $staff = get_staff_info($bio_vital['taken_by']);
                                ?> 
                                <li class="list-group-item"><strong>Taken By: </strong> <?php echo $staff['firstName'] . " " . $staff['otherNames'] ?></li>

                            </ul>

                            <h3 class="hthin">Vitals On Last Visit</h3> 
                            <ul class="list-group">

                            <li class="list-group-item"><strong>Temperature (°C): </strong> <?php echo @$bio_vital_last_vist['temperature']; ?> </li>
                            <li class="list-group-item"><strong>Blood Pressure (mmHg): </strong> <?php echo @$bio_vital_last_vist['blood_pressure_top']." / ".$bio_vital_last_vist['blood_pressure_down']; ?> </li>
                            <li class="list-group-item"><strong>Pulse (bpm)):  </strong> <?php echo @$bio_vital_last_vist['pulse']; ?> </li>
                            <li class="list-group-item"><strong>SpO2 (%): </strong> <?php echo @$bio_vital_last_vist['s_p_0_2']; ?> </li>
                            <li class="list-group-item"><strong>Respiration ( Breath/Minute ): </strong> <?php echo @$bio_vital_last_vist['respiration']; ?> </li>

                                <li class="list-group-item"><strong>Weight (Kg): </strong> <?php echo @$bio_vital_last_vist['weight']; ?> </li>

                                <li class="list-group-item"><strong>Fbs: </strong> <?php echo @$bio_vital_last_vist['fbs']; ?> </li>

                                <li class="list-group-item"><strong>Rbs: </strong> <?php echo @$bio_vital_last_vist['rbs']; ?> </li>

                                <?php if(IS_BMI == true) { ?>
                                <li class="list-group-item"><strong>Height (m): </strong> <?php echo @$bio_vital_last_vist['height']; ?> </li>
                                <li class="list-group-item"><strong>BMI: </strong> <?php echo @$bio_vital_last_vist['bmi']; ?> </li>
                                <?php } ?>

                              
                               


                               

                              
                               
                                <?php if (empty($bio_vital_last_vist['date_taken'])) { ?>

                                    <li class="list-group-item"><strong>Date Taken: </strong> </li>
                                <?php } else { ?>	
                                    <li class="list-group-item"><strong>Date Taken: </strong> <?php  echo date('jS F, Y', strtotime(@$bio_vital_last_vist['date_taken'])) ?>  <?php //echo date('H:i', strtotime(@$bio_vital['date_taken'])) ?> </li>
                                <?php } ?>						

                                <?php
                                
                                $staff = get_staff_info($bio_vital_last_vist['taken_by']);
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
                                        <label>Weight (Kg)</label> <input  type="text" name="weight" value="<?php echo @$bio_vital['weight']; ?>" placeholder="" class="form-control">
                                    </div>

                                    <?php if(IS_BMI == true) { ?>

                                    <div class="form-group">
                                        <label>Height (m)</label> <input  type="text" name="height" value="<?php echo @$bio_vital['height']; ?>" placeholder="" class="form-control">
                                    </div>

                                    <?php } ?>

                                    <div class="form-group">
                                        <label>Pressure First,On The Top (Eg. 120) (mmHg)</label> <input  type="text" name="pressure_first" value="<?php echo @$bio_vital['blood_pressure_top']; ?>" placeholder="" class="form-control">
                                    </div>

                                    
                                    <div class="form-group">
                                        <label>Pressure Second, Below (Eg. 80) (mmHg)</label> <input  type="text" name="pressure_second" value="<?php echo @$bio_vital['blood_pressure_down']; ?>" placeholder="Pressure Second, Below (Eg. 80)" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Tempature (°C)</label> <input  type="text" name="temperature" value="<?php echo @$bio_vital['temperature']; ?>" placeholder="" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Pulse (bpm) </label> <input  type="text" name="pulse" value="<?php echo @$bio_vital['pulse']; ?>" placeholder="" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>SpO2 </label> <input  type="text" name="s_p_0_2" value="<?php echo @$bio_vital['s_p_0_2']; ?>" placeholder="" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Respiration </label> <input  type="text" name="respiration" value="<?php echo @$bio_vital['respiration']; ?>" placeholder="" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Fbs </label> <input  type="text" name="fbs" value="<?php echo @$bio_vital['fbs']; ?>" placeholder="" class="form-control">
                                    </div>


                                    <div class="form-group">
                                        <label>Rbs </label> <input  type="text" name="rbs" value="<?php echo @$bio_vital['rbs']; ?>" placeholder="" class="form-control">
                                    </div>

                                    <div style="text-align: center;">
                                        <button class="btn btn-primary" style="text-align:center;"  type="submit" name="add">Add Vitals</button>

                                        <button type="button" class="btn btn-default btn-flat md-close" data-dismiss="modal">Cancel</button>
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
                                    <label class="col-sm-3 control-label">Presenting Complains</label>
                                    <div class="col-sm-6">
                                        <select required class="select2" multiple name="complains[]" >


                                            <optgroup label="All Complains">  

                                                <?php
                                               echo list_complains();
                                                ?>
                                            </optgroup>


                                        </select>

                                    </div>


                                </div>


                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Present Or Add A Complain If Not In List</label>
                                    <div class="col-sm-6">
                                    <input type="text" autocomplete="off" name="new_diag_consulting" class="form-control"/>

                                    </div>


                                </div>




                                <div class="form-group">
                                        <label class="col-sm-3 control-label">History On Presenting Complains</label>
                                        <div class="col-sm-6">
                                            <div class="input-group input-group-lg">

                                                <textarea class="summernote"  name="history_complains" cols="60" rows="" placeholder="Remarks" class="form-control" ></textarea>

                                            </div>
                                        </div>

                                    </div>

                                <div class="form-group">
                                    <div style="text-align: center; margin-top: 10px;">
                                        <button class="btn btn-primary" type="submit">Save Complains</button>

                                    </div>
                                </div>
                            </form>


                            
                               <div class="form-group">
                                  <div class="header">							
                                    <h3>Add New Complain</h3>
                                  </div>
                            
                        <div class="content">
                            <form class="form-horizontal group-border-dashed" method="post" action="db_tasks/add_new_complain" style="border-radius: 0px;">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">New Complain Addition</label>
                                    <div class="col-sm-6">
                                        <input type="text" autocomplete="off" name="new_diag" class="form-control"/>
                                    </div>
                                    <button class="btn btn-info" type="submit" >Add New Complain</button>
                                </div>
                            </form>
                        </div>
                      </div>



                            <div class="content">
                                <div class="table-responsive">
                                    <table class="table no-border hover">
                                        <thead class="no-border">
                                            <tr>

                                                <th style="width:30%;"><strong>Complains</strong></th>

                                                <th style="width:40%;"><strong>History On Presenting Complains</strong></th>

                                                <th style="width:10%;"><strong>Date</strong></th>
                                                <th style="width:10%;"><strong>Taken By</strong></th>
                                                <th style="width:10%;" class="text-center"><strong>Undo</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody class="no-border-y">

                                            <?php
                                           // get_comp(@$_SESSION['patient_id']);
                                           $complain = get_complains(@$_SESSION['patient_id']);
                                           if(isset($complain)){
                                            $_SESSION['complain_id'] = $complain['id'];
                                            $complain_code = explode(',', $complain['complain']);
                                           }
                                           
                                            ?>
                                            <?php if (isset($complain)) { ?>

                                                <tr>
                                                    <td><?php get_complains_name($complain_code); //echo $complain['complain']; //complain_name($complain['complain']); ?></td>
                                                    <td><?php echo $complain['history_complain']; //echo $complain['complain']; //complain_name($complain['complain']); ?></td>
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
                                        <label class="col-sm-3 control-label">Presenting Complains</label>

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
                                        <label class="col-sm-3 control-label">HPC</label>
                                        <div class="col-sm-6">
                                            <div class="input-group input-group-lg">

                                                <textarea class="summernote"  name="edit_history_complains" cols="60" rows="" placeholder="" class="form-control" > <?php
                                                
                                                $history_complains = get_complains($_SESSION['patient_id']);

                                                echo $history_complains['history_complain'];
                                                
                                                ?> </textarea>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <div style="text-align: center; margin-top: 10px;">
                                            <button class="btn btn-primary" type="submit">Update/Edit Complains</button>

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


                    <div class="tab-pane <?php echo @$_SESSION['onexamination_tab']; ?> cont" id="onexamination">
                        <h3 class="hthin">On Examination</h3>

                        <div class="header">							

                            <div class="col-sm-6"></div>
                            <div  style="text-align: center; margin-top: 10px;">
                                <div class="col-sm-6"> <?php
                                echo @$_SESSION['exam_err'];
                                unset($_SESSION['exam_err']);
                                ?>
                                </div>
                            </div>
                        </div>

                        <div class="content">
                     <form class="form-horizontal group-border-dashed" data-parsley-namespace="data-parsley-" data-parsley-validate novalidate role="form" method="post" action="db_tasks/add_medical_exam"> 
                                 


                                <div class="form-group">
                                        <label class="col-sm-3 control-label">Patient Examination</label>
                                        <div class="col-sm-6">
                                            <div class="input-group input-group-lg">

                                                <textarea class="summernote"  name="patient_medical_examination" cols="60" rows="" placeholder="Remarks" class="form-control" ></textarea>

                                            </div>
                                        </div>

                                    </div>

                                <div class="form-group">
                                    <div style="text-align: center; margin-top: 10px;">
                                        <button onclick='return confirm("Are you sure you want to contitnue with action?")' class="btn btn-primary _update_account" class="btn btn-primary" type="submit"> Save </button>

                                    </div>
                                </div>
                            </form>


                            
                             



                            <div class="content">
                                <div class="table-responsive">
                                    <table class="table no-border hover">
                                        <thead class="no-border">
                                            <tr>

                                                <th style="width:30%;"><strong>On Examination</strong></th>

                                                <th style="width:15%;"><strong>Date</strong></th>
                                                <th style="width:15%;"><strong>Taken By</strong></th>
                                                <th style="width:15%;" class="text-center"><strong>Undo</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody class="no-border-y">

                                            <?php
                                           // get_comp(@$_SESSION['patient_id']);
                                           $get_examination = get_examination(@$_SESSION['patient_id']);
                                           if(isset($get_examination) && $get_examination != null){
                                            $_SESSION['examination_id'] = $get_examination['id']; 
                                           }
                                          
                                            ?>
                                            <?php if (isset($get_examination)) { ?>

                                                <tr>
                                                    <td><?php echo $get_examination['medical_examination'] ?></td>
                                                    <td> <?php echo date('jS F, Y', strtotime($get_examination['date_time_taken'])); ?></td>					
                                                    <td>

                                                        <?php
                                                        if ($_SESSION['uid'] == $get_examination['doctor_id']) {
                                                            echo "You";
                                                        } else {

                                                            $doctor = get_staff_info($get_examination['doctor_id']);

                                                            echo $doctor['firstName'] . " " . $doctor['otherNames'];
                                                        }
                                                        ?>

                                                    </td>

                                                    <td class='text-center'>
                                                        <a class='label label-primary md-trigger' data-modal='edit_exam'><i class='fa fa-edit'></i></a>
                                                        <a onclick='return confirm("Are you sure you want to contitnue with action?")'  class='label label-danger' href='db_tasks/undo_examinations?id=<?php echo $get_examination['id'] ?>'><i class='fa fa-times'></i></a>
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

                    <div class="md-modal colored-header md-effect-10" id="edit_exam" >
                        <div class="md-content" style="border: 1px dashed #3078EF">
                            <div class="modal-header">
                                <h3>Edit Examination</h3>
                                <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body form">
                                  <form class="form-horizontal group-border-dashed" data-parsley-namespace="data-parsley-" data-parsley-validate novalidate role="form" method="post" action="db_tasks/edit_examination.php"> 
                                    

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">On Exam</label>
                                        <div class="col-sm-6">
                                            <div class="input-group input-group-lg">

                                                <textarea class="summernote"  name="edit_medical_exam" cols="60" rows="" placeholder="" class="form-control" > <?php
                                                
                                                $get_examination = get_examination($_SESSION['patient_id']);

                                                echo $get_examination['medical_examination'];
                                                
                                                ?> </textarea>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <div style="text-align: center; margin-top: 10px;">
                                            <button class="btn btn-primary" type="submit">Update/Edit Examination</button>

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
                                <div class="col-sm-6">
                                    <?php
                                                echo @$_SESSION['inves_err'];
                                                unset($_SESSION['inves_err']);
                                                ?>
                                                
                                            </div>
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
                                            <th style="width:20%;"><strong>Request Status</strong></th>
                                            <th style="width:10%;"><strong>Amount(GH&cent;)</strong></th>
                                            <th style="width:15%;"><strong>Date</strong></th>
                                            <th style="width:15%;"><strong>Requested By</strong></th>
                                            <th style="width:15%;" class="text-center"><strong>Undo</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody class="no-border-y">


                                                <?php

                                                $pending_lab_results = "";
                                                //get_comp(@$_SESSION['patient_id']);
                                                //$complain = get_complains(@$_SESSION['patient_id']);
                                                $investigation = get_investigations(@$_SESSION['patient_id']);

                                                if(isset($investigation) && $investigation != null){
                                                    $_SESSION['investigation_id'] = $investigation['id'];
                                                    $investigation_code = explode(',', $investigation['requested_test']);
                                                    $status_code_lab = $investigation['status'];
                                                    $request_test_name = $investigation['request_test_name'];
    
                                                    if($status_code_lab =="0"){
                                                        $pending_lab_results = "NOT YET PROCESSED";
                                                    }else{
                                                        $pending_lab_results ="PROCESSED AND READY";
                                                    }
                                                   }
                                               

                                                ?>
                                                                                        <?php if (isset($investigation)) { ?>

                                                                                            <tr>
                                                                                                <td><?php get_investigation_name($investigation_code); //echo $complain['complain']; //complain_name($complain['complain']);?></td>
                                                                                                <td><?php echo $pending_lab_results?></td>
                                                                                                <td> <?php echo number_format(investigation_amount(@$_SESSION['patient_id'], @$_SESSION['request_code']), 2, '.', ','); ?></td>	
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

                                                  <?php if ($status_code_lab =="0") { ?>

                                                        
                                              <a title="NOT YET PROCESSED" class='label label-primary' href='#'><i><b>P</b></i></a>

                                                    
                                                    <?php }

                                               else { ?>	

                                                <?php if ($status_code_lab =="1" && $request_test_name == "LFT,") { ?>

                                                        


                                                    <a class='label label-primary' target="_blank" href='tasks/lft_lv?lab_code=<?php echo $investigation['request_code']."&patient_id=".$investigation['patient_id'] ?>'><i class='fa fa-eye'></i></a>
                                                  
                                                    <?php }

                                                    
    else if ($status_code_lab =="1" && $request_test_name == "Urine RE,") {
        ?>

<a class='label label-primary' target="_blank" href='tasks/ur_lv?lab_code=<?php echo $investigation['request_code']."&patient_id=".$investigation['patient_id'] ?>'><i class='fa fa-eye'></i></a>
                                                  
    

        <?php }                                                
    else if ($status_code_lab =="1" && $request_test_name == "FBC,") {
        ?>

<a class='label label-primary' target="_blank" href='tasks/fbc_lv?lab_code=<?php echo $investigation['request_code']."&patient_id=".$investigation['patient_id'] ?>'><i class='fa fa-eye'></i></a>
                                                  
    

        <?php }
                                                    
                                                    
                                                    
                                                    else { ?>	


          <a class='label label-primary' target="_blank" href='tasks/p_v_r?lab_code=<?php echo $investigation['request_code']."&patient_id=".$investigation['patient_id'] ?>'><i class='fa fa-eye'></i></a>
  
                                              
                                                                                                

                                                <?php } ?>

                                                
                                                <?php } ?>
                                                  
                                                  
                                                    <a class='label label-primary md-trigger' data-modal='edit_investigations' href="#"><i class='fa fa-edit'></i></a>
                                                    <a class='label label-danger' href='db_tasks/undo_investigation.php?id=<?php echo $investigation['id']."&patient_id=".$investigation['patient_id']."&patient_id=".$investigation['patient_id'] ?>'><i class='fa fa-times'></i></a>
                                                </td>

                                            </tr>

                                            <?php } ?>
                                    </tbody>
                                </table>		
                            </div>

                        </div>
                    </div>

                             <!-- SCANS -->

                             <div class="tab-pane <?php echo @$_SESSION['scans_tab']; ?> cont" id="Scans">
                        <h3 class="hthin">Record patient scans</h3>

                        <div class="form-group">
                            <div class="header">	
                                <div class="col-sm-6"></div>
                                <div class="col-sm-6"><?php
                                                echo @$_SESSION['scan_err'];
                                                unset($_SESSION['scan_err']);
                                                ?></div>
                            </div>	


                            <div class="content">
                                <form class="form-horizontal group-border-dashed" action="db_tasks/add_scans.php" method="post" style="border-radius: 0px;">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Select Type Scan</label>
                                        <div class="col-sm-6">

                                        <!-- <input  type="text" autocomplete="off" required name="allergy" value="" placeholder="Name of allergy" class="form-control"> -->


                                        <select required class="select2" multiple name="scans[]" >
                                                <optgroup label="Scans">

                                                        <?php
                                                        list_scan();
                                                        ?>
                                                </optgroup>
                                                


                                            </select>

                                        
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Summary(description) of Scan</label>
                                        <div class="col-sm-6">
                                            <div class="input-group input-group-lg">

                                                <textarea class="summernote" name="remarks" class="form-control" cols="60" rows="60" placeholder="Describe allergy"></textarea>

                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <div style="text-align: center; margin-top: 10px;">
                                            <button class="btn btn-primary" type="submit">Add Scan</button>

                                        </div>
                                    </div>
                                </form>
                            </div>


                            <div class="table-responsive">
                                <table class="table no-border hover">
                                    <thead class="no-border">
                                        <tr>

                                            <th style="width:10%;"><strong>Name of Scan(s)</strong></th>
                                            <th style="width:30%;"><strong>Summary</strong></th>
                                            <th style="width:15%;"><strong>Recorded By</strong></th>
                                            <th style="width:15%;"><strong>Date</strong></th>
                                          
                                            <th style="width:15%;" class="text-center"><strong>Undo</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody class="no-border-y">


                                                <?php
                                              
                                              get_patient_scans(@$_SESSION['patient_id']);//get_patient_reviews
                                                
                                                ?>
                                                                       
                                    </tbody>
                                </table>		
                            </div>

                        </div>
                    </div>

                    <!-- SCANS -->


                    <!-- Red Flag -->

                    <div class="tab-pane <?php echo @$_SESSION['red_flag']; ?> cont" id="red_flag">
                        <h3 class="hthin">Add Patient Allergies</h3>

                        <div class="form-group">
                            <div class="header">	
                                <div class="col-sm-6"></div>
                                <div class="col-sm-6"><?php
                                                echo @$_SESSION['allergy_err'];
                                                unset($_SESSION['allergy_err']);
                                                ?></div>
                            </div>	


                            <div class="content">
                                <form class="form-horizontal group-border-dashed" action="db_tasks/add_allergy.php" method="post" style="border-radius: 0px;">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Name of allergy</label>
                                        <div class="col-sm-6">

                                        <!-- <input  type="text" autocomplete="off" required name="allergy" value="" placeholder="Name of allergy" class="form-control"> -->


                                        <select name="allergy" required class="form-control" >
                                            <option selected="true" disabled="disabled" > SELECT CATEGORY </option>
                                            <option>Drug Allergy</option>	
                                            <option>Food Allergy</option>
                                            <option>Latex Allergy</option>
                                           
                                            <option>Pollen Allergy</option>
                                            <option>Dust Allergy</option>
                                            <option>Mold Allergy</option>

                                        </select>

                                        
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Summary(description) of allergy</label>
                                        <div class="col-sm-6">
                                            <div class="input-group input-group-lg">

                                                <textarea class="summernote" required name="description" class="form-control" cols="60" rows="60" placeholder="Describe allergy"></textarea>

                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <div style="text-align: center; margin-top: 10px;">
                                            <button class="btn btn-primary" type="submit">Add Allergy</button>

                                        </div>
                                    </div>
                                </form>
                            </div>


                            <div class="table-responsive">
                                <table class="table no-border hover">
                                    <thead class="no-border">
                                        <tr>

                                            <th style="width:10%;"><strong>Name of allergy</strong></th>
                                            <th style="width:30%;"><strong>Summary</strong></th>
                                            <th style="width:15%;"><strong>Recorded By</strong></th>
                                            <th style="width:15%;"><strong>Date</strong></th>
                                          
                                            <th style="width:15%;" class="text-center"><strong>Undo</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody class="no-border-y">


                                                <?php
                                                //get_comp(@$_SESSION['patient_id']);
                                                //$complain = get_complains(@$_SESSION['patient_id']);
                                             get_patient_allergies(@$_SESSION['patient_id']);//get_patient_reviews
                                                
                                                ?>
                                                                       
                                    </tbody>
                                </table>		
                            </div>

                        </div>
                    </div>

                    <!-- Red Flag -->




                       <!-- Patient_Reviews -->

                       <div class="tab-pane <?php echo @$_SESSION['reviews']; ?> cont" id="reviews">
                        <h3 class="hthin">Reviews (Patient Next Visit)</h3>

                        <div class="form-group">
                            <div class="header">	
                                <div class="col-sm-6"></div>
                                <div class="col-sm-6"><?php
                                                echo @$_SESSION['review_err'];
                                                unset($_SESSION['review_err']);
                                                ?></div>
                            </div>	


                            <div class="content">
                                <form class="form-horizontal group-border-dashed" action="db_tasks/add_a_next_reviews.php" method="post" style="border-radius: 0px;">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Date of next visit</label>
                                        <div class="col-sm-6">
                                        <div class="input-group date datetime "  data-min-view="2" data-date-format="yyyy-mm-dd">
                                            <input required type="text" name="dov" readonly class="form-control" size="16"   >
                                            <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                                        </div>  
                                        </div>

                                    </div>

                                    

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Comments</label>
                                        <div class="col-sm-6">
                                            <div class="input-group input-group-lg">

                                                <textarea name="remarks" class="form-control" cols="60" rows="" placeholder="Comments"></textarea>

                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <div style="text-align: center; margin-top: 10px;">
                                            <button class="btn btn-primary" type="submit">Schedule Visit</button>

                                        </div>
                                    </div>
                                </form>
                            </div>


                            <div class="table-responsive">
                                <table class="table no-border hover">
                                    <thead class="no-border">
                                        <tr>

                                            <th style="width:30%;"><strong>To Be Reviewed By</strong></th>
                                            <th style="width:10%;"><strong>Date Of Review</strong></th>
                                            <th style="width:15%;"><strong>SMS/Email Notification Sent?</strong></th>
                                           
                                            <th style="width:15%;" class="text-center"><strong>Undo</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody class="no-border-y">


                                                <?php
        get_patient_reviews(@$_SESSION['patient_id']);//get_patient_reviews
                                                ?>
                                    </tbody>
                                </table>		
                            </div>

                        </div>
                    </div>

                    <!-- Patient_Reviews -->

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
                                            <button class="btn btn-primary" type="submit">Edit/Update Investigations</button>

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

<!-- 


                    <div class="tab-pane <?php // echo @$_SESSION['procedure_tab']; ?> cont" id="procedure">
                        <h3 class="hthin">Procedure</h3>

                        <div class="form-group">
                            <div class="header">	
                                <div class="col-sm-6"></div>
                                <div class="col-sm-6"><?php
                                               // echo @$_SESSION['inves_err'];
                                               // unset($_SESSION['inves_err']);
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


                     -->

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
                                        <button class="btn btn-primary" type="submit">Diagnose Patient</button>

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
if(isset($diagnosis)){

    $_SESSION['diagnosis_id'] = $diagnosis['id'];
    $diagnosis_code = explode(',', $diagnosis['diagnosis']);
}
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
                                <select class="select2"  name="drug">
                                    <option selected="true" disabled="disabled" >SELECT DRUG</option>
                                                <optgroup label="Medications">
                                        <?php
                                        //getting list of already existing diagnosis from table
                                        list_drugs();
                                        ?>
                                                </optgroup>

                                            </select>
                                </div>

                                <div class="col-sm-3">
                                <input style="width:65%;display:inline" autocomplete="off" placeholder="Prescribed Qty" name="drug_qty" class="form-control" type="number">
        
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <h4 class="hthin">Dosage </h4>
                                    <div class="col-sm-12" style="float:left;margin-left:20%">
                                        <input style="width:12%;display:inline" autocomplete="off" placeholder="Amt to be taken" name="quantity" required class="form-control" type="number" step="0.1">
                                        &nbsp;
                                        <select id="strenght" name="strenght" required="" class="form-control" style="width:13%;display:inline">
                                            <option selected="true" disabled="disabled"> SELECT (STRENGHT) </option>
                                            <option></option>	
                                            <option>g</option>	
                                            <option>mg</option>
                                            <option>mcg </option>
                                            <option>mL</option>
                                            <!-- <option>ng</option>	 -->
                                            <option>L</option>
                                            <option>IU</option>
                                            <!-- <option>IU/mL</option> -->
                                            <option>%</option>
                                            <option>Drop(s)</option>
                                            <option>Tab(s)</option>
                                            <!-- <option>mEq</option> -->

                                        </select>
                                        <input style="width:10%;display:inline" autocomplete="off" placeholder="No. of times" name="times" required class="form-control" type="number">

                                        <select id="time_interval" name="time_interval" required="" class="form-control" style="width:15%;display:inline">
                                            <option selected="true" disabled="disabled"> SELECT ( Daily, Weekly, etc) </option>
                                            <option>Hourly</option>	
                                            <option>6 Hour(s)</option>
                                            <option>8 Hour(s)</option>
                                            <option>12 Hour(s)</option>	
                                            <option>Daily</option>
                                            <option>Weekly</option>
                                            <option>Monthly</option>
                                            <option>Yearly</option>
                                            <option>STAT</option>
                                            <option>MANE</option>
                                            <option>NOCTE</option>

                                        </select>
                                        <input id="duration" name="duration" placeholder="For How Long?" autocomplete="off" required class="form-control " style="width:9%;display:inline" type="number">
                                        <select id="time_span" name="time_span" required class="form-control" style="width:13%;display:inline">
                                            <option selected="true" disabled="disabled"> SELECT ( Day(s), Week(s), Month(s) etc) </option>

                                            <option>Day(s)</option>
                                            <option>Week(s)</option>
                                            <option>Month(s)</option>
                                            <option>Year(s)</option>

                                        </select>

                                    </div>
                                </div> </div>

                                

                              <div style="margin-left:235px;margin-top: 115px;" >

                              <div class="form-group">
                                        <label class="col-sm-3 control-label">Comments </br>
                                       (Add comments)
                                    </label>
                                        <div class="col-sm-9">
                                            <div class="input-group input-group-lg">

                                                <textarea name="pres_comment" class="form-control" cols="60" rows="" placeholder="Comments"></textarea>

                                            </div>
                                        </div>

                                </div>

                              
                              </div>


                            

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
                                    <button class="btn btn-primary" id="AddPrescription" type="submit">Add Prescription</button>

                                </div>
                            </div>

                           
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table no-border hover">
                            <thead class="no-border">
                                <tr>

                                    <th style="width:20%;"><strong>Drug</strong></th>
                                    <th style="width:20%;"><strong>Prescribed Qty</strong></th>

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

                
                <div class="tab-pane <?php echo @$_SESSION['notes_tab']; ?> cont" id="notes">
                        <h3 class="hthin">Medical Notes</h3>

                        <div class="header">							

                            <div class="col-sm-6"></div>
                            <div  style="text-align: center; margin-top: 10px;">
                                <div class="col-sm-6"> <?php
                                echo @$_SESSION['notes_err'];
                                unset($_SESSION['notes_err']);
                                ?>
                                </div>
                            </div>
                        </div>

                        <div class="content">
                      <form class="form-horizontal group-border-dashed" data-parsley-namespace="data-parsley-" data-parsley-validate novalidate role="form" method="post" action="db_tasks/add_medical_notes" enctype="multipart/form-data"> 
                                 


                                <div class="form-group">
                                        <label class="col-sm-3 control-label">Patient Medical Notes</label>
                                        <div class="col-sm-6">
                                            <div class="input-group input-group-lg">

                                                <textarea class="summernote"  name="patient_medical_examination" cols="60" rows="" placeholder="Remarks" class="form-control" ></textarea>

                                                <!-- <input type="file" id="fileToUpload" name="fileToUpload" class="form-control"> -->
                                            
                                            </div>
                                        </div>

                                    </div>

                                <div class="form-group">
                                    <div style="text-align: center; margin-top: 10px;">
                                        <button onclick='return confirm("Are you sure you want to contitnue with action?")' class="btn btn-primary _update_account" class="btn btn-primary" type="submit"> Save </button>

                                    </div>
                                </div>
                            </form>


                            
                             



                            <div class="content">
                                <div class="table-responsive">
                                    <table class="table no-border hover">
                                        <thead class="no-border">
                                            <tr>

                                                <th style="width:30%;"><strong>Medical Notes</strong></th>

                                                <th style="width:15%;"><strong>Date</strong></th>
                                                <th style="width:15%;"><strong>Taken By</strong></th>
                                                <th style="width:15%;" class="text-center"><strong>Undo</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody class="no-border-y">

                                            <?php
                                           // get_comp(@$_SESSION['patient_id']);
                                           $get_examination_notes = get_medical_notes(@$_SESSION['patient_id']);
                                           if(isset($get_examination)){
                                            $_SESSION['medical_notes_id'] = $get_examination_notes['id']; 
                                           }
                                          
                                            ?>
                                            <?php if (isset($get_examination_notes)) { ?>

                                                <tr>
                                                    <td><?php echo $get_examination_notes['medical_notes'] ?></td>
                                                    <td> <?php echo date('jS F, Y', strtotime($get_examination_notes['date_time_taken'])); ?></td>					
                                                    <td>

                                                        <?php
                                                        if ($_SESSION['uid'] == $get_examination_notes['doctor_id']) {
                                                            echo "You";
                                                        } else {

                                                            $doctor = get_staff_info($get_examination_notes['doctor_id']);

                                                            echo $doctor['firstName'] . " " . $doctor['otherNames'];
                                                        }
                                                        ?>

                                                    </td>

                                                    <td class='text-center'>
                                                        <a class='label label-primary md-trigger' data-modal='edit_medical_notes'><i class='fa fa-edit'></i></a>
                                                         
                                                        <a onclick='return confirm("Are you sure you want to contitnue with action?")'  class='label label-danger' href='db_tasks/undo_medical_notes?id=<?php echo $get_examination_notes['id'] ?>'><i class='fa fa-times'></i></a>
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

                    <div class="md-modal colored-header md-effect-10" id="edit_medical_notes" >
                        <div class="md-content" style="border: 1px dashed #3078EF">
                            <div class="modal-header">
                                <h3>Edit Medical Notes</h3>
                                <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body form">
                                  <form class="form-horizontal group-border-dashed" data-parsley-namespace="data-parsley-" data-parsley-validate novalidate role="form" method="post" action="db_tasks/edit_medical_notes"> 
                                    

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Medical Notes</label>
                                        <div class="col-sm-6">
                                            <div class="input-group input-group-lg">

                                                <textarea class="summernote"  name="edit_medical_exam" cols="60" rows="" placeholder="" class="form-control" > <?php
                                                
                                                $get_examinationb = get_medical_notes($_SESSION['patient_id']);

                                                echo $get_examinationb['medical_notes'];
                                                
                                                ?> </textarea>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <div style="text-align: center; margin-top: 10px;">
                                            <button class="btn btn-primary" type="submit">Update/Edit Notes</button>

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
                     
                    
                  <!-- PATIENTS FILES TAB   -->

                  <div class="tab-pane <?php echo @$_SESSION['files_tab']; ?> cont" id="files">
                        <h3 class="hthin">Medical Files</h3>

                        <div class="header">							

                            <div class="col-sm-6"></div>
                            <div  style="text-align: center; margin-top: 10px;">
                                <div class="col-sm-6"> <?php
                                echo @$_SESSION['files_err'];
                                unset($_SESSION['files_err']);
                                ?>
                                </div>
                            </div>
                        </div>

                        <div class="content">
                      <form class="form-horizontal group-border-dashed" data-parsley-namespace="data-parsley-" data-parsley-validate novalidate role="form" method="post" action="db_tasks/add_medical_files" enctype="multipart/form-data"> 
                                 


                                <div class="form-group">
                                        <label class="col-sm-3 control-label">Description of files</label>
                                        <div class="col-sm-6">
                                            <div class="input-group input-group-lg">

                                                <textarea class="summernote"  name="patient_medical_examination" cols="60" rows="" placeholder="Remarks" class="form-control" ></textarea>

                                                <input type="file" id="fileToUpload" name="fileToUpload" class="form-control"> 
                                            
                                            </div>
                                        </div>

                                    </div>

                                <div class="form-group">
                                    <div style="text-align: center; margin-top: 10px;">
                                        <button onclick='return confirm("Are you sure you want to contitnue with action?")' class="btn btn-primary _update_account" class="btn btn-primary" type="submit"> Save </button>

                                    </div>
                                </div>
                            </form>


                            
                             



                            <div class="content">
                                <div class="table-responsive">
                                    <table class="table no-border hover">
                                        <thead class="no-border">
                                            <tr>

                                                <th style="width:30%;"><strong>File Description</strong></th>

                                                <th style="width:15%;"><strong>Date</strong></th>
                                                <th style="width:15%;"><strong>Taken By</strong></th>
                                                <th style="width:15%;" class="text-center"><strong>Undo</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody class="no-border-y">

                                            <?php
                                           // get_comp(@$_SESSION['patient_id']);
                                           $get_examination_files = get_medical_files(@$_SESSION['patient_id']);
                                           if(isset($get_examination_files)){
                                            $_SESSION['medical_file_id'] = $get_examination_files['id']; 
                                           }
                                           
                                            ?>
                                            <?php if (isset($get_examination_files)) { ?>

                                                <tr>
                                                    <td><?php echo $get_examination_files['medical_notes'] ?></td>
                                                    <td> <?php echo date('jS F, Y', strtotime($get_examination_files['date_time_taken'])); ?></td>					
                                                    <td>

                                                        <?php
                                                        if ($_SESSION['uid'] == $get_examination_files['doctor_id']) {
                                                            echo "You";
                                                        } else {

                                                            $doctor = get_staff_info($get_examination_files['doctor_id']);

                                                            echo $doctor['firstName'] . " " . $doctor['otherNames'];
                                                        }
                                                        ?>

                                                    </td>

                                                    <td class='text-center'>
                                                  
                                                        <a class='label label-info' target='_blank' href='db_tasks/view_image.php?id=<?php echo $get_examination_files['id'] ?>'>
                                                            <i class='fa fa-eye'></i>
                                                        </a>
                                                        <a onclick='return confirm("Are you sure you want to contitnue with action?")'  class='label label-danger' href='db_tasks/undo_medical_files?id=<?php echo $get_examination_files['id'] ?>'><i class='fa fa-times'></i></a>
                                                    </td>

                                                </tr>

                                            <?php } ?>


                                        </tbody>
                                    </table>		
                                </div>
                            </div>
                        </div>

                    </div>

                   <!-- END OF PATIENTS FILE TAB -->

                <div class="tab-pane <?php echo @$_SESSION['ward_tab']; ?> cont" id="ward">
                    <h3 class="hthin">Admission</h3>

                    <?php
                    echo @$_SESSION['ward_err'];
                    unset($_SESSION['ward_err']);


                    echo @$_SESSION['end_err'];
                    unset($_SESSION['end_err']);

                    ?>

                    <form role="form" class="form-horizontal group-border-dashed" action="db_tasks/assign_ward.php" method="post">

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Admission : </label>
                            <div class="col-sm-6">   

                                <select class="select2" name="ward">
                                    <option value="">-- Select Ward  --</option>
                                    <optgroup label="ADMIT PATIENT TO WARD">
                                    <?php
 
 list_wards();
                                    ?>

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
//$ward = get_ward_assignment(@$_SESSION['patient_id']);
//$_SESSION['ward_id'] = $ward['id'];
?> 
<?php //if (isset($ward)) { ?>

<?php // } else { ?>	
                            <div style="text-align: center; margin-top: 10px;"><button class="btn btn-primary " name="assign_ward">Assign Ward</button></div>
<?php // } ?>	
                    </form>

                    <div class="table-responsive">
                        <table class="table no-border hover">
                            <thead class="no-border">
                                <tr>

                                    <th style="width:10%;"><strong>Admitted to: </strong></th>
                                    <th style="width:20%;"><strong>Comment on Admission</strong></th>
                                    <th style="width:15%;"><strong>Date</strong></th>
                                    <th style="width:15%;"><strong>Admitted By</strong></th>
                                    <th style="width:15%;"><strong>Status</strong></th>
                                    <th style="width:15%;"><strong>Outcome Date</strong></th>
                                    <th style="width:15%;"><strong>Outcome By</strong></th>
                                    <th style="width:10%;" class="text-center"><strong>Action</strong></th>
                                </tr>
                            </thead>
                            <tbody class="no-border-y">


                        <?php
                        get_ward_assignment(@$_SESSION['patient_id']);
                     //   $_SESSION['ward_id'] = $ward['id'];
                        ?>
                   
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
                            <label class="col-sm-3 control-label">Name Of Ward : </label>
                            <div class="col-sm-6">   

                            <input style="text-align:left" readonly type="text" autocomplete="off" name="r_code" 
                            
                            value="
                            
                            <?php 

                            
                            $name_of_ward = get_patient_on_admission(@$_SESSION['patient_id']);

                            if(isset($name_of_ward)){
                                $wardd_name = ward_name($name_of_ward['ward_id']);

                                if($wardd_name == null){
                                    echo "N/A";
                                }else {
                                    
                                    echo $wardd_name;
                                }
                                
                            }

                           
                            ?>
                            
                            "
                            
                            class="form-control">


                            <input style="text-align:left" readonly type="hidden" autocomplete="off" name="ward_id" 
                            
                            value="
                            
                            <?php 

                          
                            
                            $name_of_ward = get_patient_on_admission(@$_SESSION['patient_id']);

                            if(isset($name_of_ward)){
                                echo $name_of_ward['ward_id'];
                            }

                       
                            
                            ?>
                            
                            "
                            
                            class="form-control">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label">Admitted By : </label>
                            <div class="col-sm-6">   

                            <input readonly type="text" autocomplete="off" name="r_code" 
                            
                            value="<?php 
                            
                            $addmintted_by = get_patient_on_admission(@$_SESSION['patient_id']);

                            if(isset($addmintted_by)){

                                if($addmintted_by['doctor_id']==null){
                                    echo "N/A";
                                }

                            }

                          


                            if ($_SESSION['uid'] == $addmintted_by['doctor_id']) {
                                echo "You";
                            } else {

                                $doctor = get_staff_info($addmintted_by['doctor_id']);

                                echo $doctor['firstName'] . " " . $doctor['otherNames'];
                            }
                            
                            
                            ?>"
                            
                            class="form-control">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label">Date Admitted : </label>
                            <div class="col-sm-6">   

                            <input readonly type="text" autocomplete="off" name="date_admitted" 
                            
                            value="<?php 
                            
                            $date_addmitted = get_patient_on_admission(@$_SESSION['patient_id']);


                            if(isset($date_addmitted)){

                                if( $date_addmitted['date_added']==null){
                                    echo "N/A";
                                  }else{
       
                                   echo date("F jS, Y g:i A", strtotime($date_addmitted['date_added']));
                                  }

                            }


                        
                            
                            ?>"
                          
                            
                            
                            
                            class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Outcome status : </label>
                            <div class="col-sm-6">   

                            <input readonly type="text" autocomplete="off" name="date_admitted" 
                            
                            value="<?php 
                            
                            $status = get_patient_on_admission(@$_SESSION['patient_id']);

                            if(isset($status)){
                                if($status['status']==null){
                                    echo "N/A";
                                }
   
                               echo  $status['status'];

                            }

                           // echo $date_addmitted['date_added'];

                            
                            
                            
                            ?>"
                          
                            
                            
                            
                            class="form-control">
                            </div>
                        </div>


                        <input  type="hidden" autocomplete="off" name="ward_assignment_code" 
                        
                        
                        value="<?php
                        
                        
                        $ward_assignment_code = get_patient_on_admission(@$_SESSION['patient_id']);

                        if(isset($ward_assignment_code)){
                            echo $ward_assignment_code['ward_assignment_id'];
                        }


                      
                        
                        ?>"
                        
                        class="form-control">

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Outcome : </label>
                            <div class="col-sm-6">   

                                <select class="select2" name="outcome">
                                    <option value="">-- Select Outcome  --</option>
                                    <optgroup label="type">

                                        <option value="Discharged">Discharged</option>
                                        <option value="Expired">Expired </option>
                                        <option value="Reffered">Reffered </option>
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
