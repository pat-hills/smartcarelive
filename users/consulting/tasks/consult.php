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
              <form>
                <div class="form-group">
                  <div class="col-sm-12">
                    
                    <a href="medical_history.php" class="btn btn-danger" >Past Medical History</a>

                  </div>
                </div>  
              
              </form>
            </div>
          </div>
        </div>

        
      
      
           
  
