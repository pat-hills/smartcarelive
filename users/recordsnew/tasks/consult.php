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
                <label class="col-sm-3 control-label">Patient (ID/NATIONAL ID/NHIS)</label>
               
                <div class="col-sm-3">
                  <select class="select2" name="get_details">
                     <optgroup label="ID">
                       <?php
                       //getting all patients ID in option field labelled ID
                     //  get_all_id();
                       ?>
                     </optgroup>
                     <optgroup label="NATIONAL ID">
                       <?php
                       //getting all national ID in option field labelled National ID
                     //  get_all_nid();
                       ?>
                     </optgroup>
                     <optgroup label="NHIS ID">
                      <?php
                       //getting all national health insurance ID in option field labelled NHIS
                    //  get_all_NHIS();
                       ?>
                     </optgroup>
                     
                  </select>

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
               <p class="description">Patient ID: <?php echo @$_SESSION['patient_id']; ?></p><p>
                <p class="description">Occupation: <?php echo @$_SESSION['occupation']; ?></p><p>
                <p class="description">Age : <?php get_age(@$_SESSION['dob']);echo" years";?></p><p>
               <p class="description">Sex: <?php echo @$_SESSION['sex']; ?></p><p>
               </p>
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
  <form role="form" method="post" class="form-horizontal" action="db_tasks/to_consult.php"> 
        	<div class="cl-mcont">
  
      
      <div class="col-sm-6 col-md-6">
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
                           <option value="pharmacy">Pharmacy</option>       
                          
                        
                       </optgroup>
                    </select>
                 
                </div>
                 <div class="form-group">
                 
                    <label class="control-label">Attendance Type</label>
                    
                    <select class="select2" name="attendance_type">
                       <option value="">-- Select Attendance Type --</option>
                       <optgroup label="type">
                       		
                           <option value="chroni follow-up">Chronic Follow-up</option>
                           <option value="Emergency/Acute episode">Emergency/Acute Episode</option>
                           
                          
                        
                       </optgroup>
                    </select>
                 
                </div>
                 <div class="form-group">
                 
                    <label class="control-label">Service Package</label>
                    
                    <select class="select2" name="service_package">
                       <option value="">-- Select Service Package --</option>
                       <optgroup label="type">
                       		
                           <option value="All inclusive">All Inclusive</option>
                           <option value="unbounded">Unbounded </option>
                              
                          
                        
                       </optgroup>
                    </select>
                 
                </div>
                 <div class="form-group">
                  
                    
                   
                </div>  
           
          
          </div>
        </div>				
      </div>
    
 
    
      <div class="col-sm-6 col-md-6">
        <div class="block-flat">
          <div class="header">							
            <h3>Schedule</h3>
          </div>
          <div class="content">

          


                  <div class="form-group">
                        <label class="col-sm-3 control-label">Room : </label>
                        <div class="col-sm-6">
                         <select class="form-control" name="con_room">
                        
                         <option value="">-- Select Room --</option>
                           <?php
                       //getting all patients ID in option field labelled ID
                       con_room();
                       ?>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-3 control-label">Doctor : </label>
                        <div class="col-sm-6">
                         <select class="form-control" name="doctor">
                         
                         <option value="">-- Select Doctor --</option>
                          <?php
                       //getting all doctors ID in option field labelled ID
                       get_doctors();
                       ?>
                          </select>
                        </div>
                      </div>
                  
            </div> 
            <div class="checkbox">
                <button type="submit" class="btn btn-primary btn-rad pull-right"><i class="fa fa-search"></i> Authenticate</button>
                </div>

          </form>
          
          </div>
        </div>				
      
      </div>
    </div></div>
      </div>
     </div>

	

