<body>

  <div class="container-fluid" id="pcont">
    <div class="page-head">
     <h2>Prescriber - Diagnose / Investigate / Prescribe</h2>
        <ol class="breadcrumb">
          <li><a href="index.php">Home </a></li>
          <li class="active"><a href="#">Prescriber</a></li>
          
        </ol>
    </div>
    <?php
        if( isset($_SESSION['successMsg'])) { ?>
            <div  style="margin-top: 10px; margin-bottom: -30px; text-align: center;">
                <div class="alert alert-success alert-white rounded">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <div class="icon"><i class="fa fa-times-circle"></i></div>
                    <strong>Success!</strong> <?php echo $_SESSION['successMsg']?>
                </div>     
            </div>
      <?php unset($_SESSION['successMsg']);  }  else if( isset($_SESSION['errorMsg'])) { ?>
            <div  style="margin-top: 10px; margin-bottom: -30px; text-align: center;">
                <div class="alert alert-success alert-white rounded">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <div class="icon"><i class="fa fa-times-circle"></i></div>
                    <strong>Error!</strong>  <?php echo $_SESSION['errorMsg']?>
                </div>     
            </div>
      <?php unset($_SESSION['errorMsg']);   } ?>
    
    <div class="cl-mcont">
       
    <div class="row">
      <div class="col-md-12">
      
          <!--Fields to be updated here-->

          <div class="cl-mcont">
  
      <div class="block-flat profile-info">
          <div class="row">
            <div class="col-sm-2">
              <div class="avatar">
                <img src="<?php 
                              if( isset($_SESSION['patient_id']) ){
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
              
                <h1 class="name"><?php echo @$_SESSION['surname']." ".@$_SESSION['other_names']; ?></h1>
               <p class="description">Patient ID: <?php echo @$_SESSION['patient_id']; ?></p><p>
                <p class="description">Occupation: <?php echo @$_SESSION['occupation']; ?></p><p>
                <p class="description">Age : <?php get_age(@$_SESSION['dob']);echo" years";?></p><p>
               <p class="description">Sex: <?php echo @$_SESSION['sex']; ?></p><p>
               </p>

               </div>
               
            </div>
            <div class="col-sm-3">
            
            </div>
          </div>
        </div>
      

        <div class="row">
				<div class="col-md-12">
					<div class="block-flat">
						<div class="header">							
							<h3 style="text-align: center">
                 <?php echo @$_SESSION['surname']?>'s Medical History on 
                <?php 
                  
                  if(isset($_GET['date']) && !empty($_GET['date'])){
                      $date = $_GET['date']; 
                      echo date('jS F, Y', strtotime($date));
                  }
                  
                ?>
              </h3>
						</div>
						<div class="content">
							 <div class="tab-container tab-left">
            <ul class="nav nav-tabs flat-tabs">
              <li tooltip="Vitals" class="active"><a title="VITALS" href="#vitals" data-toggle="tab"><i class="fa fa-ambulance"></i></a></li>
              <li class=""><a title="COMPLAINS" href="#complains" data-toggle="tab"><i class="fa fa-plus-square"></i></a></li>
              <li class=""><a title="INVESTIGATIONS" href="#investigations" data-toggle="tab"><i class="fa fa-h-square"></i></a></li>
              <li class=""><a title="DIAGNOSIS" href="#diagnosis" data-toggle="tab"><i class="fa fa-user-md"></i></a></li>
              <!-- <li class=""><a href="#procedures" data-toggle="tab"><i class="fa fa-stethoscope"></i></a></li> -->
              <li class=""><a title ="PRESCRIPTIONS" href="#prescriptions" data-toggle="tab"><i class="fa fa-medkit"></i></a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane cont fade active in" id="vitals">
                    <div class="header">              
                      <h3>Bio Vitals</h3>
                    </div>
                    <div class="content">
                    <?php 

                      if(isset($_GET['date']) && !empty($_GET['date']) && !empty($_SESSION['patient_id'])){
                          $date = $_GET['date']; 
                          $bio_vitals = bio_vitals(@$_SESSION['patient_id'], $date);
                          $staff = get_staff_info($bio_vitals['taken_by']);

                          if(!empty($bio_vitals)){   ?>

                             <ul class="list-group">
                              <li class="list-group-item">Wieght: <?php echo $bio_vitals['weight'];?></li>
                              <li class="list-group-item">Height: <?php echo $bio_vitals['height'];?></li>
                              <li class="list-group-item">Blood Pressure: <?php echo $bio_vitals['blood_pressure'];?></li>
                              <li class="list-group-item">Temperature: <?php echo $bio_vitals['temperature'];?></li>
                              <li class="list-group-item">BMI: <?php echo $bio_vitals['bmi'];?></li>
                              <li class="list-group-item">Taken By: <?php echo $staff['firstName'] ." " . $staff['otherNames']; ?></li>
                            </ul>

                         <?php  } else { ?>
                            <ul class="list-group">
                              <li class="list-group-item" style="color: red; font-size: 20px;"> No information was taken on this Day</li>
                            </ul>
                        <?php   } ?>

                      <?php } else { ?>
                         
                            <ul class="list-group">
                              <li class="list-group-item" style="color: red; font-size: 20px;"> No information was taken on this Day</li>
                            </ul>
                         
                      <?php } ?>
                    </div>
                    
               
              </div>
              <div class="tab-pane cont fade" id="complains">
                    <div class="header">              
                      <h3>Patient's Complains</h3>
                    </div>
                    <div class="content">
                    <?php 

                      if(isset($_GET['date']) && !empty($_GET['date']) && !empty($_SESSION['patient_id'])){
                          $date = $_GET['date']; 
                          $complains = complains(@$_SESSION['patient_id'], $date);

                          

                          if(!empty($complains)){  
                            
                          //  echo $complains;
                            
                            ?>

                             <ul class="list-group">
                              
                              <li class="list-group-item">
							  
								Doctor:
								
								<?php 
									if($_SESSION['uid'] == $complains['doctor_id']){
										echo "You";
									} else {
										
										$doctor = get_staff_info($complains['doctor_id']);

										echo  $doctor['firstName'] . " " . $doctor['otherNames'];
									}

								?>
								
							  </li>
                              <li class="list-group-item">Complains: </li>

                                <?php  $complains = explode(',', $complains['complain']); ?>

                                <?php  foreach ($complains as $complain) { ?>
                                      <li class="list-group-item"> <?php echo complains_name($complain);?></li>
                                <?php } ?>

                            </ul>

                         <?php  } else { ?>
                            <ul class="list-group">
                              <li class="list-group-item" style="color: red; font-size: 20px;"> No complains taken on this date</li>
                            </ul>
                        <?php   } ?>

                      <?php } else { ?>
                         
                            <ul class="list-group">
                              <li class="list-group-item" style="color: red; font-size: 20px;"> No information Found For Patient</li>
                            </ul>
                         
                      <?php } ?>
                    </div>
              </div>
              <div class="tab-pane fade" id="investigations">
                    <div class="header">              
                      <h3>Investigations</h3>
                    </div>
                    <div class="content">
                    <?php 

                      if(isset($_GET['date']) && !empty($_GET['date']) && !empty($_SESSION['patient_id'])){
                          $date = $_GET['date']; 
                          $investigations = investigations(@$_SESSION['patient_id'], $date);
						  
						  $investigation_code = explode(',', $investigations['requested_test']);

                          if(!empty($investigations)){   ?>

                             <ul class="list-group">
                              <li class="list-group-item">Lab Code: <?php echo $investigations['request_code'];?></li>
                              <li class="list-group-item">Doctor:
								<?php 
									if($_SESSION['uid'] == $investigations['doctor_id']){
										echo "You";
									} else {
										
										$doctor = get_staff_info($investigations['doctor_id']);

										echo  $doctor['firstName'] . " " . $doctor['otherNames'];
									}

								?>
							  </li>
                              <li class="list-group-item">Date Requested: <?php echo date( 'jS F, Y', strtotime($investigations['requested_date'])) ;?></li>
                              <li class="list-group-item">Requested Investigations: <?php echo get_investigation_name($investigation_code);?></li>
                              <li class="list-group-item">Status: 
							  
								<?php 
									if($investigations['status'] == 1) {
										echo "Processed on : " . $investigations['processed_date'] . " Results ";
									} else if($investigations['status'] == 0) {
										echo "Not Processed";
									}
								?>
								
							  </li>
                              <li class="list-group-item">Lab Staff: 
							  
								<?php 
									$lab_staff = get_staff_info($investigations['lab_staff_id']);
									echo  $lab_staff['firstName'] . " " . $lab_staff['otherNames'];
								?>
							  
							  </li>
                            </ul>

                         <?php  } else { ?>
                            <ul class="list-group">
                              <li class="list-group-item" style="color: red; font-size: 20px;"> No information was taken on this Day</li>
                            </ul>
                        <?php   } ?>

                      <?php } else { ?>
                         
                            <ul class="list-group">
                              <li class="list-group-item" style="color: red; font-size: 20px;"> No information was taken on this Day</li>
                            </ul>
                         
                      <?php } ?>
                    </div>
              </div>
              <div class="tab-pane fade" id="diagnosis">
                    <div class="header">              
                      <h3>Diagnosis</h3>
                    </div>
                    <div class="content">
                    <?php 

                      if(isset($_GET['date']) && !empty($_GET['date']) && !empty($_SESSION['patient_id'])){
                          $date = $_GET['date']; 
                          $diagnosis = diagnosis(@$_SESSION['patient_id'], $date);

                          if(!empty($diagnosis)){   ?>

                             <ul class="list-group">
                              
                              <li class="list-group-item">Doctor: <?php echo $diagnosis['doc_id'];?></li>
                              <li class="list-group-item">Diagnosis: </li>
                             
                                <?php  $diagnosis = explode(',', $diagnosis['diagnosis']); ?>

                                <?php  foreach ($diagnosis as $diagnose) { ?>
                                      <li class="list-group-item"> <?php echo  diagnosis_name($diagnose) ?></li>
                                <?php } ?>

                            </ul>

                         <?php  } else { ?>
                            <ul class="list-group">
                              <li class="list-group-item" style="color: red; font-size: 20px;"> No information was taken on this Day</li>
                            </ul>
                        <?php   } ?>

                      <?php } else { ?>
                         
                            <ul class="list-group">
                              <li class="list-group-item" style="color: red; font-size: 20px;"> No information was taken on this Day</li>
                            </ul>
                         
                      <?php } ?>
                    </div>
              </div>
              <div class="tab-pane fade" id="procedures">
                    <div class="header">              
                      <h3>Procedures</h3>
                    </div>
                    <div class="content">
                    <?php 

                      if(isset($_GET['date']) && !empty($_GET['date']) && !empty($_SESSION['patient_id'])){
                          $date = $_GET['date']; 
                          $investigations = investigations(@$_SESSION['patient_id'], $date);

                          if(!empty($investigations)){   ?>

                             <ul class="list-group">
                              <li class="list-group-item">Lab Code: <?php echo $investigations['request_code'];?></li>
                              <li class="list-group-item">Doctor: <?php echo $investigations['doctor_id'];?></li>
                              <li class="list-group-item">Date Requested: <?php echo $investigations['requested_date'];?></li>
                              <li class="list-group-item">Requested Investigations <?php echo $investigations['requested_test'];?></li>
                              <li class="list-group-item">Status: <?php echo $investigations['status'];?></li>
                              <li class="list-group-item">Lab Staff: <?php echo $investigations['lab_staff_id'];?></li>
                            </ul>

                         <?php  } else { ?>
                            <ul class="list-group">
                              <li class="list-group-item" style="color: red; font-size: 20px;"> No information was taken on this Day</li>
                            </ul>
                        <?php   } ?>

                      <?php } else { ?>
                         
                            <ul class="list-group">
                              <li class="list-group-item" style="color: red; font-size: 20px;"> No information was taken on this Day</li>
                            </ul>
                         
                      <?php } ?>
                    </div>
              </div>
              <div class="tab-pane fade" id="prescriptions">
                    <div class="header">              
                      <h3>Prescriptions</h3>
                    </div>
                    <div class="content">

                    
                    <?php 

                      if(isset($_GET['date']) && !empty($_GET['date']) && !empty($_SESSION['patient_id'])){
                          $date = $_GET['date']; 
                          //$prescribtions = prescribtion(@$_SESSION['patient_id'], $date);

                         ?>

                             <table class="no-border">
                              <thead class="no-border">
                                <tr>
                                  <th style="width:40%;">Drug</th>
                                  <th>Dosage</th>
                                  <th >Prescribed By</th>
                                  <th >Dispensed By</th>
                                </tr>
                              </thead>
                              <tbody class="no-border-x no-border-y">
                                <?php
                                    prescribtion(@$_SESSION['patient_id'], $date);
                                ?>
                                
                              </tbody>
                            </table>

                         

                      <?php } else { ?>
                         
                            <ul class="list-group">
                              <li class="list-group-item" style="color: red; font-size: 20px;"> No information was taken on this Day</li>
                            </ul>
                         
                      <?php } ?>
                    </div>
              </div>
            </div>
          </div>
						</div>
					</div>				
				</div>
			</div>
			
     
                 		
  
