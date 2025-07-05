<body>
    
  <div class="container-fluid" id="pcont">
    <div class="page-head">
      <h2>Take Patient's Picture</h2>
      <ol class="breadcrumb">
        <li><a href="index.php">Home</a></li>
       
        <li class="active">Take Patient's Picture </li>
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
      
       

        <div class="block-flat">
          <div class="header">							
            <h3>Multiple Search Area</h3>
          </div>
          <div class="contfent">
             <form class="form-horizontal group-border-dashed" method="post" action="tasks/set_photo_patient_details.php" style="border-radius: 0px;">
              <div class="form-group">
              	<div class="col-sm-2"></div>
                <label class="col-sm-3 control-label">Patient (ID/NHIS ID)</label>
               
                <div class="col-sm-3">
                  
                  <input type="hidden" name="patient_id" id="select_patient" data-placeholder="Enter Patient ID">
                  <input class="form-control col-sm-3" type="text" id="select_patient" name="get_details" />
                </div>
                 <button type="submit" class="btn btn-primary btn-rad"><i class="fa fa-search"></i> Get Details</button>
              </div>
            
            </form>
          </div>
        </div>
        
        	<!--Fields to be updated here-->

        	 
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
					<canvas id="canvas" width="500" height="480"></canvas>
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
     