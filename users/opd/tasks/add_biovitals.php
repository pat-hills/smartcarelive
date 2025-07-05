<body>

    <div class="container-fluid" id="pcont">
        <div class="page-head">
            <h2>Patient's Bio Vitals</h2>
            <ol class="breadcrumb">
                <li><a href="#">Tasks</a></li>

                <li class="active">patient attendance</li>
            </ol>
            <form class="form-horizontal group-border-dashed" method="post" action="tasks/set_patient_details.php" style="border-radius: 0px;">
                <div class="form-group">
                    <div class="col-sm-2"></div>
                    <!-- <label class="col-sm-3 control-label">Patient (ID/NHIS ID)</label> -->

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
    
                      <input type="hidden" name="patient_id" id="select_patient" data-placeholder="Enter Patient ID">-->
                        <!-- <input class="form-control col-sm-3" autocomplete="off" type="text" id="select_patient" name="get_details" /> -->
                    </div>
                    <!-- <button type="submit" class="btn btn-primary btn-rad"><i class="fa fa-search"></i> Get Details</button> -->
                </div>

            </form>
        </div>
        <div class="cl-mcont">

            <div class="row">
                <div class="col-md-12">



                    <div class="block-flat profile-info">
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="avatar">
                                    <img src="
                                    <?php
                                    if (isset($_SESSION['patient_id'])) {
                                        echo @patient_profile_picture($_SESSION['patient_id']);
                                    } else {
                                        echo @no_image();
                                    }
                                    ?>
                                         " class="profile-avatar">
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
                                    <?php } //else { ?>
                            <!--<p class="description">Membership ID: </p>-->
                                    <?php //} ?>


                                    <p class="description">Occupation: <?php echo @$_SESSION['occupation']; ?></p><p>
                                    <p class="description">Age : <?php
                                        get_age(@$_SESSION['dob']);
                                        echo" years";
                                        ?></p><p>
                                    <p class="description">Gender: <?php echo @$_SESSION['sex']; ?></p><p>
                                    </p></div>
                            </div>
                            <div class="col-sm-3">
                                <?php
                                //setting login error messages

                                echo @$_SESSION['err_msg'];
                                unset($_SESSION['err_msg']);
                                ?>
                            </div>
                        </div>
                    </div>

                    <!--Fields to be updated here-->

                    <div class="cl-mcont">

                       <div class="col-md-6">



                       <?php 
                                          global $payment_before_consulation;

                                            if($payment_before_consulation == 1){
                             

                                                ?>
    
                             <div class="block-flat">
                             <div class="header">                          
                               <h3>Consultation Payment Status: <?php

                               

                              
                                    if(isset( $_SESSION['message']) && !empty( $_SESSION['message'])){
                                        echo "<i 'style color: violet'>" .$_SESSION['message']."<i>";
                                    }
                               
                               
                             
                               
                               ?></h3>
                             </div>
                             <div class="content">
                   
                            
                             
                             </div>
                           </div>  



                                                
                                                  <?php
                                                

                                            }
                                            ?>


                         


                           
                           
                         </div> 



                        <?php
                        if (isset($_SESSION['indicator'])) {
                            $theIndicator = $_SESSION['indicator'];
                        } else {
                            $theIndicator = 0;
                        }
                        if ($theIndicator == 1) {
                            ?>

                            <div class="col-sm-6 col-md-6">
                                <div class="block-flat">
                                    <div class="header">                          
                                        <h3>Confirm/Update Patient's Bio Vitals</h3>
                                    </div>
                                    <div class="content">

                                        <form role="form" action="tasks/insert_vitals.php" method="post" autocomplete="off"> 
                                            <input type="hidden" value="<?php echo @$_SESSION['vitalid']; ?>" name="update">
                                            <div class="form-group">
                                                <label>Weight (kg)</label> <input  value="<?php

                                                if(!empty($_SESSION['patient_id_vitals'])){
                                                    if($_SESSION['patient_id'] ==  $_SESSION['patient_id_vitals']){
                                                        echo @$_SESSION['weight'];
                                                    }
                                                }
                                               

                                                 
                                                 
                                                 ?>" type="text" name="weight" placeholder=""  class="form-control">
                                            </div>


                                            <?php if(IS_BMI == true) { ?>
                                            <div class="form-group">
                                                <label>Height (m)</label> <input  value="<?php
                                                 if(!empty($_SESSION['patient_id_vitals'])){
                                                    if($_SESSION['patient_id'] ==  $_SESSION['patient_id_vitals']){
                                                        echo @$_SESSION['height']; 
                                                    }
                                                }
                                                
                                                ?>" type="text" name="height" placeholder="" class="form-control">
                                            </div>


                                            <div class="form-group">
                                                <label>Body Mass Index (BMI) </label> <?php
                                                
                                                if(!empty($_SESSION['patient_id_vitals'])){
                                                    if($_SESSION['patient_id'] ==  $_SESSION['patient_id_vitals']){
                                                        echo @$_SESSION['bmi']; 
                                                    }
                                                }
                                                
                                                ?>
                                            </div>

                                            <?php } ?>
                                            <div class="form-group">
                                                <label>Blood Pressure (mmHg) - ( On The Top and Below Respectively )</label>
                                                
                                                 
                                                <table style="border:0px">
                                                <tr>
                                                    <td>

                                                    <input style="width:230px;"   type="text" name="pressure_first"  placeholder="Pressure First,On The Top (Eg. 120)" class="form-control"
                                                    
                                                    value="<?php

                                                   if(!empty($_SESSION['patient_id_vitals'])){
                                                    if($_SESSION['patient_id'] ==  $_SESSION['patient_id_vitals']){
                                                        echo @$_SESSION['blood_pressure_top']; 
                                                    }
                                                }
                                            
                                                ?>"
                                                    
                                                    >
                                                    </td>

                                                    <td>

                                                    <input style="width:230px;"   type="text" name="pressure_second"  placeholder="Pressure Second, Below (Eg. 80)" class="form-control"
                                                    
                                                    value="<?php

                                                        if(!empty($_SESSION['patient_id_vitals'])){
                                                        if($_SESSION['patient_id'] ==  $_SESSION['patient_id_vitals']){
                                                            echo @$_SESSION['blood_pressure_down']; 
                                                        }
                                                        }

                                                        ?>">

                                                    </td>
                                                </tr>
                                                <table>

                                                
                                            </div>


                                            <div class="form-group">
                                                <label>Tempature (°C )</label> <input  value="<?php

                                                   if(!empty($_SESSION['patient_id_vitals'])){
                                                    if($_SESSION['patient_id'] ==  $_SESSION['patient_id_vitals']){
                                                        echo @$_SESSION['temperature']; 
                                                    }
                                                }
                                                
                                             
                                                
                                                
                                                
                                                ?>" type="text" name="temperature" placeholder=""  class="form-control">
                                         </div>


                                         <div class="form-group">
                                                <label>Pulse (bpm)</label> <input  value="<?php

                                                   if(!empty($_SESSION['patient_id_vitals'])){
                                                    if($_SESSION['patient_id'] ==  $_SESSION['patient_id_vitals']){
                                                        echo @$_SESSION['pulse']; 
                                                    }
                                                }
                                                
                                             
                                                
                                                
                                                
                                                ?>" type="text" name="pulse" placeholder=""  class="form-control">
                                             </div>

                                             <div class="form-group">
                                                <label>SpO2</label> <input  value="<?php

                                                   if(!empty($_SESSION['patient_id_vitals'])){
                                                    if($_SESSION['patient_id'] ==  $_SESSION['patient_id_vitals']){
                                                        echo @$_SESSION['s_p_0_2']; 
                                                    }
                                                }
                                                
                                             
                                                
                                                
                                                
                                                ?>" type="text" name="spo2" placeholder=""  class="form-control">
                                             </div>

                                             <div class="form-group">
                                                <label>Respiration</label> <input  value="<?php

                                                   if(!empty($_SESSION['patient_id_vitals'])){
                                                    if($_SESSION['patient_id'] ==  $_SESSION['patient_id_vitals']){
                                                        echo @$_SESSION['respiration']; 
                                                    }
                                                }
                                                
                                             
                                                
                                                
                                                
                                                ?>" type="text" name="respiration" placeholder=""  class="form-control">
                                             </div>

                                             <div class="form-group">
                                                <label>Fbs</label> <input  value="<?php

                                                   if(!empty($_SESSION['patient_id_vitals'])){
                                                    if($_SESSION['patient_id'] ==  $_SESSION['patient_id_vitals']){
                                                        echo @$_SESSION['fbs']; 
                                                    }
                                                }
                                                
                                             
                                                
                                                
                                                
                                                ?>" type="text" name="fbs" placeholder=""  class="form-control">
                                             </div>


                                             <div class="form-group">
                                                <label>Rbs</label> <input  value="<?php

                                                   if(!empty($_SESSION['patient_id_vitals'])){
                                                    if($_SESSION['patient_id'] ==  $_SESSION['patient_id_vitals']){
                                                        echo @$_SESSION['rbs']; 
                                                    }
                                                }
                                                
                                             
                                                
                                                
                                                
                                                ?>" type="text" name="rbs" placeholder=""  class="form-control">
                                             </div>



                                            <div class="header">                          
                                                <h3>Send to Consulting Room</h3>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Doctor in Consulting Room : </label>
                                                <div class="col-sm-6">   

                                                    <select required class="form-control" name="doctor_room">

                                                        <option value="">-- Select Doctor --</option>
                                                        <?php
                                                        //getting all doctors ID in option field labelled ID
                                                        doctors_room();
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <br/>                                            <br/>
                                            <br/>

                                            <button onclick='return confirm("Are you sure you want to send vitals to consulting room?")' class="btn btn-primary pull-right test" type="submit" name="update">Confirm Patient Vitals And Send To Consulting</button>
                                            <div></div><br>
                                        </form>


                                    </div>
                                </div>              
                            </div>
<?php } else { ?>

                            <div class="col-sm-6 col-md-6">
                                <div class="block-flat">
                                    <div class="header">                          
                                        <h3>Take Patient's Bio Vitals</h3>
                                    </div>
                                    <div class="content">

                                        <form role="form" action="tasks/insert_vitals.php" method="post" autocomplete="off"> 
                                            <div class="form-group">
                                                <label>Weight (Kg)</label> <input  type="text" name="weight" placeholder="Eg. 64"  class="form-control">
                                            </div>






                                            <?php if(IS_BMI == true) { ?>

                                                <div class="form-group">
                                                <label>Height (m)</label> <input  type="text" name="height" placeholder="Eg. 1.69"  class="form-control">
                                            </div>


                                              <?php } ?>

                                            <div class="form-group">
                                                <label>Blood Pressure (mmHg)</label> 

                                                <table style="border:0px">
                                                <tr>
                                                    <td>

                                                    <input style="width:230px;"   type="text" name="pressure_first"  placeholder="Pressure First,On The Top (Eg. 120)" class="form-control">
                                                    </td>

                                                    <td>

                                                    <input style="width:230px;"   type="text" name="pressure_second"  placeholder="Pressure Second, Below (Eg. 80)" class="form-control">

                                                    </td>
                                                </tr>
                                                <table>

                                                   
                                            </div>

                                            <div class="form-group">
                                                <label>Tempature (°C )</label> <input   type="text" name="temperature" placeholder="Eg. 36.4"  class="form-control">
                                            </div>


                                            <div class="form-group">
                                                <label>Pulse(bpm)</label> <input   type="text" name="pulse" placeholder="Eg. 95 (bpm)"  class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label>SpO2 (%)</label> <input   type="text" name="spo2" placeholder="Eg. 95 (%)"  class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label>Respiration</label> <input   type="text" name="respiration" placeholder="Eg. 20"  class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label>Fbs</label> <input   type="text" name="Fbs" placeholder="Record Fbs"  class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label>Rbs</label> <input   type="text" name="Rbs" placeholder="Record Rbs"  class="form-control">
                                            </div>


                                          

                                            <br/>                                          
                                            <br/>

                                          <?php 
                                          global $payment_before_consulation;

                                            if($payment_before_consulation == 0){
                             

                                                ?>
    
    
                                                <button class="btn btn-primary pull-right test" type="submit" name="add">Take Patient Vitals</button>
      
                                                  <?php
                                                

                                            }else{


                                              



                                             if (isset( $_SESSION['message']) && $_SESSION['message']=="Paid Consultation") {
                                                 ?>


                                            <button class="btn btn-primary pull-right test" type="submit" name="add">Take Patient Vitals</button>

                                            <?php 
                                            
                                        }
                                                  
                                                
                                                
                                               }
                                            

                                          
                                            
                                            
                                            ?>

                                            <div></div><br>
                                        </form>


                                    </div>
                                </div>              
                            </div>




<?php } ?>

                        <!---
                        <div class="col-sm-6 col-md-6">
                          <div class="block-flat">
                            <div class="header">                          
                              <h3>View Bio Vitals</h3>
                            </div>
                            <div class="content">
                             
                            <form role="form">
                              <div class="form-group">
                                    <label>Weight : </label> <?php //echo @$_SESSION['weight'];    ?>
                                  </div>
                                  
                                  <div class="form-group">
                                    <label>Height</label> <?php //echo @$_SESSION['height'];    ?>
                                  </div>
                                  
                                  <div class="form-group">
                                    <label>Body Mass Index (BMI) </label> <?php //echo @$_SESSION['bmi'];    ?>
                                  </div>
                                  
                                  <div class="form-group">
                                    <label>Blood Pressure</label> <?php //echo @$_SESSION['blood_pressure'];    ?>
                                  </div>
                                  
                                  <div class="form-group">
                                    <label>Tempature</label> <?php //echo @$_SESSION['temperature'];    ?>
                                  </div>
                                  
                                    
                             </form>
                              
                            </div>
                          </div>  
                                    
                      
                              </div> ---->

                    </div>




