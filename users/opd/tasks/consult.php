<body>

  <div class="container-fluid" id="pcont">
    <div class="page-head">
      <h2>Patient Attendance</h2>
      <ol class="breadcrumb">
        <li><a href="#">Tasks</a></li>
       
        <li class="active">patient attendance</li>
      </ol>
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
    <div class="cl-mcont">
       
    <div class="row">
      <div class="col-md-12">
      
       

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
            	<?php
            
				        require_once "../../functions/func_search.php";
				            	
            	?>
              <div class="personal">
                <h1 class="name"><?php echo @$_SESSION['surname']." ".@$_SESSION['other_names']; ?></h1>
               <p class="description">Patient ID: <?php echo @$_SESSION['patient_id']; ?></p>
               
                <!-- -->
               <?php if(isset($_SESSION['scheme']) && !empty($_SESSION['scheme'])){ ?>
                    <p class="description">Insurance Scheme: <?php echo @strtoupper($_SESSION['scheme']); ?></p>
               <?php } else { ?>
                    <p class="description">Insurance Scheme: None</p>
               <?php } ?>

               <!-- -->
               <?php if(isset($_SESSION['sub_metro']) && !empty($_SESSION['sub_metro'])){ ?>
                    <p class="description">Sub Metro: <?php echo @$_SESSION['sub_metro']; ?></p>
               <?php } ?>

               <!-- -->
               <?php if(isset($_SESSION['membership_id']) && !empty($_SESSION['membership_id'])){ ?>
                    <p class="description">Membership ID: <?php echo @ucfirst($_SESSION['membership_id']); ?></p>
               <?php } //else { ?>
                    <!--<p class="description">Membership ID: </p>-->
               <?php //} ?>
              

                <p class="description">Occupation: <?php echo @$_SESSION['occupation']; ?></p><p>
                <p class="description">Age : <?php get_age(@$_SESSION['dob']);echo" years";?></p><p>
               <p class="description">Gender: <?php echo @$_SESSION['sex']; ?></p><p>
               </p></div>
            </div>
            <div class="col-sm-3">
              <?php
				//setting login error messages
			
				echo @$_SESSION['err_msg'];
				unset($_SESSION['err_msg']);
				?>

          <?php
                        
                        
              $consult = get_consult(@$_SESSION['patient_id']);
			  $service = get_services(@$_SESSION['patient_id']);
              $doctor_room = explode('-', $consult['doctor_room']);
              @$room = get_consulting_room($doctor_room[1]);
              @$doctor = get_doctor($doctor_room[0]);

              
          ?>
            </div>
          </div>
        </div>
        
        	<!--Fields to be updated here-->
  
        	<div class="cl-mcont">
  
           <div class="block-flat">
          <div class="header">              
            <h3>Send to Consulting</h3>
          </div>
          <div class="content">
           <?php if(empty($consult)){ ?>
          <form role="form" class="form-horizontal group-border-dashed" action="tasks/to_consult.php" method="post">
			  
			  <div class="form-group">
                  <label class="col-sm-3 control-label">Service Type : </label>
                 <div class="col-sm-6">   
               
                  <select class="select2" name="service_type">
                       <option value="">-- Select Type --</option>
                       <optgroup label="type">
                       		
                           <option value="in-patient">In-Patient</option>
                           <option value="out-patient">Out Patient</option>
                           <option value="diagnostic">Diagnostic</option>
                           <option value="pharmacy">Pharmacy</option>    
                          
                       </optgroup>
                    </select>
                </div>
              </div>	
			  
			  <div class="form-group">
                  <label class="col-sm-3 control-label">Service Type : </label>
                 <div class="col-sm-6">   
               
                  <select class="select2" name="service_package">
                       <option value="">-- Select Service Package --</option>
                       <optgroup label="type">
                       		
                           <option value="all-inclusive">All Inclusive</option>
                           <option value="unbundled">Unbundled </option>
                              
                       </optgroup>
                    </select>
                </div>
              </div>
			  
			  <div class="form-group">
                  <label class="col-sm-3 control-label">Attendance Type : </label>
                 <div class="col-sm-6">   
               
                  <select class="select2" name="attendance_type">
                       <option value="">-- Select Attendance Type --</option>
                       <optgroup label="type">
                       		
                           <option value="chronic-follow-up">Chronic Follow-up</option>
                           <option value="emergency-acute-episode">Emergency/Acute Episode</option>
                           
                       </optgroup>
                    </select>
                </div>
              </div>
			  
              <div class="form-group">
                  <label class="col-sm-3 control-label">Doctor in Consulting Room : </label>
                 <div class="col-sm-6">   
               
                  <select class="form-control" name="doctor_room">
                         
                     <option value="">-- Select Doctor --</option>
                      <?php
                         //getting all doctors ID in option field labelled ID
                         doctors_room();
                      ?>
                          </select>
                </div>
              </div>
             
             

              <?php //if(empty($consult)){ ?>

                  <div style="text-align: center; margin-top: 10px;"><button class="btn btn-primary _update_account" name="send_patient">Send Patient</button></div>
                   
              <?php // } ?>
			  
                  
              

           </form><br/>
            <?php } ?>

            <div class="table-responsive">
                  <table class="table no-border hover">
                    <thead class="no-border">
                      <tr>
                        
                        <th style="width:30%;"><strong>Sent to Doctor</strong></th>
						<th style="width:20%;"><strong>Service Type</strong></th>
						<th style="width:20%;"><strong>Service Package</strong></th>
						<th style="width:30%;"><strong>Attendance Type</strong></th>
                        
                        
                        <th style="width:15%;" class="text-center"><strong>Undo</strong></th>
                      </tr>
                    </thead>
                    <tbody class="no-border-y">
                      
                      <?php if(empty($consult)){
                          return FALSE;
                      } else { ?>
                      <tr>
                          <td><?php echo $doctor['firstName']. " " .  $doctor['otherNames'] . " in " . ucfirst($room) ?></td>
						  <td><?php echo $service['service_type'];?></td>
						  <td><?php echo $service['service_package'];?></td>
						  <td><?php echo $service['attendance_type'];?></td>
                          <td class='text-center'><a class='label label-danger' href='tasks/undo_consult.php?id=<?php echo $consult['id']?>'><i class='fa fa-times'></i></a></td>
                      </tr>
                      <?php } ?>
                      
                    </tbody>
                  </table>    
                </div>
            </div> 
            </div>
    
       <!--<div class="col-sm-6 col-md-6">
        <div class="block-flat">
          <div class="header">							
            <h3>Services</h3>
          </div>
          <div class="content">

               <div class="form-group">
                 
                    <label class="control-label">Service Type</label>
                    
                    <select class="select2" name="service_type">
                       <option value="">-- Select Type --</option>
                       <optgroup label="type">
                       		
                           <option value="in-patient">In-Patient</option>
                           <option value="out-patient">Out Patient</option>
                           <option value="diagnostic">Diagnostic</option>
                           <!--<option value="pharmacy">Pharmacy</option>  --     
                          
                       </optgroup>
                    </select>
                 
                </div>
                 <div class="form-group">
                 
                    <label class="control-label">Attendance Type</label>
                    
                    <select class="select2" name="attendance_type">
                       <option value="">-- Select Attendance Type --</option>
                       <optgroup label="type">
                       		
                           <option value="chronic-follow-up">Chronic Follow-up</option>
                           <option value="emergency-acute-episode">Emergency/Acute Episode</option>
                           
                       </optgroup>
                    </select>
                 
                </div>
                 <div class="form-group">
                 
                    <label class="control-label">Service Package</label>
                    
                    <select class="select2" name="service_package">
                       <option value="">-- Select Service Package --</option>
                       <optgroup label="type">
                       		
                           <option value="all-inclusive">All Inclusive</option>
                           <option value="unbundled">Unbounded </option>
                              
                       </optgroup>
                    </select>
                 
                </div>
                 <div class="form-group">
                  
                    
                   
                </div>  
           
          </div>
        </div>				
      </div>-->
    
      </div>
    </div></div>
      </div>
     </div>

     