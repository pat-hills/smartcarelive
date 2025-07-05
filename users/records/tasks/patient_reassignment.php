<body>

    <div class="container-fluid" id="pcont">
        <div class="page-head">
            <h2>Patient's Re-assignment</h2>
            <ol class="breadcrumb">
                <li><a href="#">Tasks</a></li>

                <li class="active">Patient Re-assignment</li>
            </ol>
            <form class="form-horizontal group-border-dashed" method="post" action="tasks/set_patient_details_cashier" style="border-radius: 0px;">
                <div class="form-group">
                    <div class="col-sm-2"></div>
                    <label class="col-sm-3 control-label">Search Patient Name To Reassign To Doctor</label>

                    <div class="col-sm-3">
 
                        <input class="form-control col-sm-3" placeholder="Begin by first name and select patient"  type="text" autocomplete="off" id="select_patient_reassign" name="get_details_reassign" />

                      
                    </div>
                    <!-- <button type="submit" class="btn btn-primary btn-rad"><i class="fa fa-search"></i> Get Details</button> -->
                </div>

                <div id="result" class="list-group"></div>

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

                   

                    <div class="cl-mcont">

<div class="col-md-6">



 

    
    
  </div> 



 <?php
 if (isset($_SESSION['doctor_id']) && !empty($_SESSION['doctor_id'])) {
     $theIndicator = 1;
 } else {
     $theIndicator = 0;
 }
 if ($theIndicator == 1) {
     ?>

     <div class="col-sm-6 col-md-6">
         <div class="block-flat">
             <div class="header">                          
                 <h3>Reassign Patient To Doctor</h3>
             </div>
             <div class="content">

                 <form role="form" action="tasks/reassign_patient.php" method="post" autocomplete="off"> 
                     <input type="hidden" value="<?php echo @$_SESSION['vitalid']; ?>" name="update">
                     <div class="form-group">
                         <label>Current Assigned Dr.</label> <input readonly  value="<?php

                         if(!empty($_SESSION['doctor_fullname'])){
                             if($_SESSION['doctor_fullname']){
                                 echo @$_SESSION['doctor_fullname'];
                             }
                         }
                        

                          
                          
                          ?>" type="text" name="doctor_id" placeholder=""  class="form-control">
                     </div>

                     <div class="header">                          
                         <h3>Select New Assignment</h3>
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

                     <button onclick='return confirm("Are you sure you want to reassign patient?")' class="btn btn-primary pull-right test" type="submit" name="update">Re-Assign Patient</button>
                     <div></div><br>
                 </form>


             </div>
         </div>              
     </div>
<?php } else { ?>

     


<?php } ?>



</div>




