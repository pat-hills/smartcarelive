<body>
<?php
$a = 2;
if(isset($_GET['a'])){
   $a = $_GET['a'];
 } 
     
?>
  <div class="container-fluid" id="pcont">
    <div class="page-head">
      <h2>Take Patient's Picture</h2>
      <ol class="breadcrumb">
        <li><a href="index.php">Home</a></li>
       
        <li class="active">Take Patient's Picture </li>
      </ol>
    </div>
      <?php if ($a == 1) { ?>

        <div  style="margin-top: 10px; margin-bottom: -30px; text-align: center;">
                <div class="alert alert-success alert-white rounded">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <div class="icon"><i class="fa fa-times-circle"></i></div>
                    <strong>Search Found</strong>  
                </div>     
            </div>
                <?php } ?>
        <?php if ($a == 0) { ?>

        <div  style="margin-top: 10px; margin-bottom: -30px; text-align: center;">
                <div class="alert alert-success alert-white rounded">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <div class="icon"><i class="fa fa-times-circle"></i></div>
                    <strong>No Search Found</strong>  
                </div>     
            </div>
                <?php } ?>
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
      
       

        <div class=" row block-flat  "  >
                            <div class=" col-sm-12">
                                <div class="header">							
                                    <h3>Multiple Search Area</h3>
                                </div>
                                <form class="form-horizontal group-border-dashed" method="post" action="tasks/set_photo_patient_details.php" style="border-radius: 0px;">
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

                            <div class="   col-sm-12">
                                <h3>Summary Details</h3>
                                <div class=" profile-info">
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
                                        <div class="col-sm-3">


                                            <?php
                                            //	   //Initialize all sessions here and set database info	
                                            if (isset($_SESSION['patient_id'])) {
                                                $patient_info = get_patient_info($_SESSION['patient_id']);
                                            }

                                            //
                                            if (isset($_SESSION['patient_id'])) {
                                                $scheme_info = get_patient_scheme_info($_SESSION['patient_id']);
                                                $sub_metro = select_submetro($scheme_info['sub_metro']);
                                            }

                                            //
                                            if (isset($_SESSION['patient_id'])) {
                                                $family_info = get_patient_family_info($_SESSION['patient_id']);
                                            }
                                            ?>    
                                            <div class="personal">

                                                <h3 class="name"><?php echo @$patient_info['surname'] . " " . @$patient_info['other_names']; ?></h3>
                                                <p class="description">Patient ID: <?php echo @$patient_info['patient_id']; ?></p>

                                                <!-- -->
                                                    <?php if (isset($_SESSION['scheme']) && !empty($scheme_info['scheme'])) { ?>
                                                    <p class="description">Insurance Scheme: 

                                                        <?php
                                                        if ($scheme_info['scheme'] == 'p1') {
                                                            echo @strtoupper("Momentum");
                                                        } else if ($scheme_info['scheme'] == 'p2') {
                                                            echo "Non-NHIS";
                                                        } else if ($scheme_info['scheme'] == 'p3') {
                                                            echo "Non-NHIS";
                                                        } else if ($scheme_info['scheme'] == 'p4') {
                                                            echo "NHIS";
                                                        } else {
                                                            echo @strtoupper($scheme_info['scheme']);
                                                        }
                                                        ?>

                                                    </p>
                                                <?php } else { ?>
                                                    <p class="description">Insurance Scheme: None</p>
                                                <?php } ?>

                                                <!-- --><?php //echo $_SESSION['sub_metro'];  ?>
                                                <?php if (isset($_SESSION['sub_metro']) && !empty($sub_metro['name'])) { ?>
                                                    <p class="description">Sub Metro: <?php echo @$sub_metro['name']; ?></p>
<?php } ?>
                                            </div>
                                        </div>  
                                        <div class="col-sm-3">
                                            <br/><br/><br/>
                                            <!-- -->
                                            <?php if (isset($_SESSION['membership_id']) && !empty($scheme_info['membership_id'])) { ?>
                                                <p class="description">Membership ID: <?php echo @ucwords($scheme_info['membership_id']); ?></p>
                                            <?php } //else { ?>
                                    <!--<p class="description">Membership ID: </p>-->
<?php //}   ?>


                                            <p class="description">Occupation: <?php echo @$patient_info['occupation']; ?></p><p>
                                            <p class="description">Age : <?php
                                                get_age(@$patient_info['dob']);
                                                echo" years";
?></p><p>
                                            </p>
                                        </div


                                    </div>
                                    <div class="col-sm-3">
                                        <br/><br/><br/>
                                        <p class="description">Sex: <?php echo @$patient_info['sex']; ?></p><p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        
        	<!--Fields to be updated here-->

        	<div class="cl-mcont">
  
	<div class="col-sm-12 col-md-12">
        <div class="block-flat">
			<div class="header">              
				<h3>Take Picture of:  
					<span id="patient_id">
						<?php 
						  isset($_SESSION['patient_id']) ? print @$_SESSION['patient_id'] : 'Patient ID not set';	
						?>
					</span>
				</h3>
			</div>
			<div class="content">
				<div class="photo_booth">
					<video id="video" autoplay></video>
					<canvas id="canvas" width="640" height="480"></canvas>
					<!--<button id="capture">Capture</button>-->
					<!--<button id="new">New</button>--> 
					
					<!--<button id="upload" style="display:none;">Upload</button>-->
				</div>
			</div>
			
			
			<p></p>
			<div>
				<div>
					<div style="display: table; margin: 0 auto; background:#000; padding: 5px;">
					  <button id="capture" type="button" class="btn btn-transparent"><i class="fa fa-camera"></i></button>
					  <button id="new" type="button" class="btn btn-transparent"><i class="fa fa-rotate-right"></i></button>
					  <button  id="upload" type="button" class="btn btn-transparent"><i class="fa fa-upload"></i></button>
								
					</div>
					<!--<button class="btn btn-primary btn-flat md-trigger" data-modal="md-fall"> Fall</button>-->
				</div>
			</div>
			
			<!-- Nifty Modal -->
                <div style="perspective: 1300px;" class="md-modal md-effect-5" id="md-fall">
                    <div class="md-content">
                      <div class="modal-header">
                        <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">×</button>
                      </div>
                      <div class="modal-body">
                        <form role="form"> 
						<div class="form-group">
						  <label>Patient ID</label> <input placeholder="Patient ID here" class="form-control" type="patient_id">
						</div>
						
						  <button class="btn btn-primary" type="submit">Set Patient ID</button>
						  
						</form>
                      </div>
                      
                    </div>
                </div>
                <!-- Nifty Modal -->	
							
	   </div>
	</div>
     