<body>

  <div class="container-fluid" id="pcont">
    <div class="page-head">
      <h2>Update Patient Info</h2>
      <ol class="breadcrumb">
        <li><a href="#">Tasks</a></li>
       
        <li class="active">Update Patient</li>
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
          <div class="content">
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
                         // get_all_NHIS();
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
        
        	<!--Fields to be updated here-->

        	<div class="cl-mcont">
  
      <div class="col-sm-12 col-md-12">
        <div class="block-flat">
          <div class="header">              
            <h3>Take Picture</h3>
          </div>
          <div class="content">
			<div class="booth">
			<video id="video" width="400" height="300"></video>
			<a href="#" id="capture" class="booth-capture-button">Take Photo</a>
			<canvas id="canvas" width="400" height="300"></canvas>
			<img id="photo"  src="assets/image/no-image" width="400" height="300" alt="Photo">
			<a href="#" id="upload" class="booth-capture-button">Upload Photo</a>
		</div>
		   </div>

           </div>


      </div>
     