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
             <form class="form-horizontal group-border-dashed" method="post" action="tasks/set_update_patient_details.php" style="border-radius: 0px;">
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
				
				
				<?php
           //	   //Initialize all sessions here and set database info	
				   if(isset($_SESSION['patient_id'])){
					  $patient_info = get_patient_info($_SESSION['patient_id']);
				   } 
				   
				   //
				   if(isset($_SESSION['patient_id'])){
					  $scheme_info = get_patient_scheme_info($_SESSION['patient_id']);
					  $sub_metro = select_submetro($scheme_info['sub_metro']);
				   } 
				   
					//
				   if(isset($_SESSION['patient_id'])){
					  $family_info = get_patient_family_info($_SESSION['patient_id']);
				   } 
				   
				  ?>    
              <div class="personal">
			  
                  <h1 class="name"><?php echo @$patient_info['surname']." ". @$patient_info['other_names']; ?></h1>
                 <p class="description">Patient ID: <?php echo @$patient_info['patient_id']; ?></p>
                 
                  <!-- -->
                 <?php if(isset($_SESSION['scheme']) && !empty($scheme_info['scheme'])){ ?>
                      <p class="description">Insurance Scheme: 
						
						<?php
							
							if($scheme_info['scheme'] == 'p1'){
								echo  @strtoupper("Momentum");
							} else if($scheme_info['scheme'] == 'p2'){
								echo  "Non-NHIS";
							} else if($scheme_info['scheme'] == 'p3'){
								echo  "Non-NHIS";
							} else if($scheme_info['scheme'] == 'p4'){
								echo  "NHIS";
							} else {
								echo @strtoupper($scheme_info['scheme']); 
							}
							
						?>
						
					  </p>
                 <?php } else { ?>
                      <p class="description">Insurance Scheme: None</p>
                 <?php } ?>

                 <!-- --><?php //echo $_SESSION['sub_metro'];?>
                 <?php if(isset($_SESSION['sub_metro']) && !empty($sub_metro['name'])){ ?>
                      <p class="description">Sub Metro: <?php echo @$sub_metro['name']; ?></p>
                 <?php } ?>

                 <!-- -->
                 <?php if(isset($_SESSION['membership_id']) && !empty($scheme_info['membership_id'])){ ?>
                      <p class="description">Membership ID: <?php echo @ucwords($scheme_info['membership_id']); ?></p>
                 <?php } //else { ?>
                      <!--<p class="description">Membership ID: </p>-->
                 <?php //} ?>
                

                  <p class="description">Occupation: <?php echo @$patient_info['occupation']; ?></p><p>
                  <p class="description">Age : <?php get_age(@$patient_info['dob']);echo" years";?></p><p>
                 <p class="description">Sex: <?php echo @$patient_info['sex']; ?></p><p>
                 </p>
             </div>
               
            </div>
            <div class="col-sm-3">
              
            </div>
          </div>
        </div>
      
      <div class="col-sm-12 col-md-12">
        <div class="block-flat">
          <div class="header">							
            <h3>Scheme Info</h3>
          </div>
          <div class="content">
          <?php
           
           
          ?>    
          <form role="form" class="form-horizontal group-border-dashed" action="db_tasks/update_scheme_info.php" method="post">
          	<div class="form-group">
                        
                          <p>Select Patient's subscribed scheme below</p>
                          <label class="col-sm-3 control-label">HEALTH INSURANCE SCHEME : </label>
                          
                          <div class="col-sm-6">
                          <select class="select2 select2-offscreen" name="scheme">

                            <?php
                                 if(!empty($scheme_info['scheme'])){

                                    if($scheme_info['scheme'] == 'p1'){
                                        echo "<option selected='selected' value='momentum'>Momentum</option>";
                                    } else if($scheme_info['scheme'] == 'p2'){
                                        echo "<option selected='selected' value='none'>Non-NHIS</option>";
                                    } else if($scheme_info['scheme'] == 'p3'){
                                        echo "<option selected='selected' value='none'>Non-NHIS</option>";
                                    } else if($scheme_info['scheme'] == 'p4'){
                                        echo "<option selected='selected' value='nhis'>NHIS</option>";
                                    } else {

                                        echo "<option selected='selected' value=".$scheme_info['scheme'] ."> ". strtoupper($scheme_info['scheme']) ."</option>";
                                    }

                                    
                                 } else {
                                    echo "<option value=''>-- Select Scheme --</option>";
                                 }
                             ?>
                             
                             <optgroup label="Private">
                               <!--<option value="momentum">Momentum</option>-->
                               <option value="none">Non-NHIS</option>
                               <!--
                               <option value="p2">None</option>
                               <option value="p3">Cash & Carry</option>
                               -->
                             </optgroup>
                             <optgroup label="Public">
                               <option value="nhis">NHIS</option>
                             </optgroup>
                             
                          </select>
                        
                        </div>

                      </div>
                      <div class="form-group">
                          <label class="col-sm-3 control-label">NHIS - Sub Metro : </label>
                         <div class="col-sm-6">   
                       
                          <select class="select2 select2-offscreen" name="sub_metro">
                          <?php

                              if(!empty($scheme_info['sub_metro'])){
                                  
                                  echo "<option selected='selected' value=".$sub_metro['code'].">".$sub_metro['name'] ." (Code: ".$sub_metro['code'].")"."</option>";
                              
                              } else {
                                    echo "<option value=''>-- Select Sub Metro --</option>";
                              }
                             ?>
                             <option value="none">None</option> 
                             
                             <optgroup label="National">
                               <?php
                                get_submetro_list();
                               ?>
                             </optgroup>
                          </select>
                        </div>
                      </div>
                       <div class="form-group">
                        
                        <label class="col-sm-3 control-label">Membership ID : </label>
                         <div class="col-sm-6">   
                          <input type="text" name="membership_id" class="form-control"  placeholder="Membership ID" value="<?php echo @$scheme_info['membership_id'] ?>">

                        </div>
                      </div>
                      <div class="form-group">
                           
                        <label class="col-sm-3 control-label">Serial Number : </label>
                        <div class="col-sm-6"> 
                          <input type="text" name="serial_number" class="form-control"  placeholder="Card Serial Number" value="<?php echo @$scheme_info['serial_number'] ?>">
                        </div>
                      </div>
                      <div style="text-align: center; margin-top: 10px;"><button class="btn btn-primary _update_account" name="update_scheme_info">Update Scheme Info</button></div>

           </form>
            
            </div> 
            </div>
          </div>
           
	
<div class="col-sm-12 col-md-12">
        <div class="block-flat">
          <div class="header">							
            <h3>Personal Info</h3>
          </div>
          <div class="content">
          
          <form role="form" class="form-horizontal group-border-dashed" action="db_tasks/update_personal_info.php" method="post"> 
            <div class="form-group">
                <label class="col-sm-3 control-label">Surname : </label>
                <div class="col-sm-6">
                    <input type="text" name="surname" class="form-control" placeholder="Surname" value="<?php echo @$patient_info['surname'];?>">
                </div>
            </div>  
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Other Names : </label>
                        <div class="col-sm-6">
                          <input type="text" name="other_names" class="form-control"  placeholder="Other Names" value="<?php echo @$patient_info['other_names'];?>">
                        </div>
                      </div> 
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Gender : </label>
                        <div class="col-sm-6">
                         <select class="form-control" name="sex">
                         <option selected="selected" value="<?php echo @$patient_info['sex'];?>"><?php echo @$patient_info['sex'];?></option>
                         <option value="">-- Select Gender --</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                          </select>
                        </div>
                      </div>    
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Marital Status : </label>
                        <div class="col-sm-6">
                          <select class="form-control" name="marital_stat">
                          <option selected="selected" value="<?php echo @$patient_info['marital_stat'];?>"><?php echo @$patient_info['marital_stat'];?></option>
                          <option value="">-- Select Status --</option>
                          <option value="Single">Single</option>
                          <option value="Married">Married</option>
                          <option value="Divorced">Divorced</option>
                          <option value="Widowed">Widowed</option>
                         
                        </select>
                        </div>
                      </div>    
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Occupation : </label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="occupation"  value="<?php echo @$patient_info['occupation'];?>" placeholder="Occupation" >
                        </div>
                      </div>  
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Phone : </label>
                        <div class="col-sm-6">
                          <input type="tel" name="phone" data-mask="phone" class="form-control" placeholder="(999) 999-9999" value="<?php echo @$patient_info['phone'];?>" >
                        </div>
                       </div> 
                       
                      <div class="form-group">
                      <label class="col-sm-3 control-label">Address : </label>
                      <div class="col-sm-6">
                        <textarea name="address" rows="5" class="form-control"><?php echo @$patient_info['address'];?></textarea>
                      </div>
                    </div>
                     <!-- <div class="form-group">
                        <label class="col-sm-3 control-label">Picture : </label>
                        <div class="col-sm-6">
                           <input type="file" name="ppic" class="form-control"  >
                        
                        </div>
                      </div> -->
                      
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Date of Birth : </label>
                      <div class="col-sm-6">
                        
                        <div class="input-group date datetime " data-min-view="2" data-date-format="yyyy-mm-dd">
                          <input type="text" name="dob" class="form-control" size="16"  value="<?php echo @$patient_info['dob'];?>" >
                          <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                        </div>    
                      </div>
                    </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">National ID : </label>
                        <div class="col-sm-6">
                          <input type="text" name="national_id" class="form-control" value="<?php echo @$patient_info['national_id'];?>"  placeholder="National ID">
                        </div>
                      </div>
                      <div style="text-align: center; margin-top: 10px;"><button class="btn btn-primary _update_account" name="update_personal_info">Update Patient Info</button></div>
                 </form>
               
           </div>

           </div>


      </div>
      
      <div class="col-sm-12 col-md-12">
        <div class="block-flat">
          <div class="header">              
            <h3>Family Info</h3>
          </div>
          <div class="content">
          
          <form role="form" class="form-horizontal group-border-dashed" action="db_tasks/update_family_info.php" method="post"> 
            <div class="form-group">
                          <label class="col-sm-3 control-label">Relationship : </label>
                          <div class="col-sm-6">
                          <select class="select2 select2-offscreen" name="f_relation">
                             <?php
                                 if(!empty($family_info['f_relation'])){
                                    
									//echo "<option selected='selected' value=".$family_info['f_relation'] ."> ". $family_info['f_relation'] ."</option>";
                                 
								 	if($family_info['f_relation'] == 'p1'){
                                        echo "<option value=''>-- Select Relationship --</option>";
                                    } else if($family_info['f_relation'] == 'p2'){
                                        echo "<option value=''>-- Select Relationship --</option>";
                                    } else if($family_info['f_relation'] == 'p3'){
                                        echo "<option value=''>-- Select Relationship --</option>";
                                    } else if($family_info['f_relation'] == 'p4'){
                                        echo "<option value=''>-- Select Relationship --</option>";
                                    }  else if($family_info['f_relation'] == 'p5'){
                                        echo "<option value=''>-- Select Relationship --</option>";
                                    } else if($family_info['f_relation'] == 'p6'){
                                        echo "<option value=''>-- Select Relationship --</option>";
                                    }  else if($family_info['f_relation'] == 'p7'){
                                        echo "<option value=''>-- Select Relationship --</option>";
                                    }  else if($family_info['f_relation'] == 'p8'){
                                        echo "<option value=''>-- Select Relationship --</option>";
                                    } else {
										echo "<option selected='selected' value=".$family_info['f_relation'] ."> ". $family_info['f_relation'] ."</option>";
                                 	}
								 } else {
                                    echo "<option value=''>-- Select Relationship --</option>";
                                 }
                             ?>
  
                             <optgroup label="Relationship to Patient">
								<option value="Wife">Wife</option>
								<option value="Husband">Husband</option>
								<option value="Mother">Mother</option>
								<option value="Father">Father</option>
								<option value="Aunt">Aunt</option> 
								<option value="Uncle">Uncle</option>
								<option value="Child">Child</option>
								<option value="Dependant">Dependant</option>
								<option value="Parent">Parent</option>
								<option value="Brother">Brother</option>
								<option value="Sister">Sister</option>
								<option value="Cousin">Cousin</option>
								<option value="Relative">Relative</option>
								<option value="Neighbour">Neighbour</option>
								<option value="Friend">Friend</option>
                             </optgroup>
                          </select>
                          </div>
                        
                      </div>
                      <div class="form-group">
                          <label class="col-sm-3 control-label">Phone Number: </label>
                          <div class="col-sm-6">  
                            
                            <input type="tel" name="phone" class="form-control"  placeholder="Phone" value="<?php echo @$family_info['f_Phone'];?>">
                          </div>
                      </div>
                     <div class="form-group">
                        
                        
                          <label class="col-sm-3 control-label">Blood Group : </label>
                          <div class="col-sm-6">
                          <select class="select2 select2-offscreen" name="blood_group">
                              <?php
                                 if(!empty($family_info['f_blood_group'])){
                                    echo "<option selected='selected' value=".$family_info['f_blood_group'] ."> ". $family_info['f_blood_group'] ."</option>";
                                 } else {
                                    echo "<option value=''>-- Select Blood Group --</option>";
                                 }
                             ?>
                               <option value="Not Tested">Not Tested</option>
                               <option value="O positive">O positive</option>
                               <option value="O negative">O negative</option>
                               <option value="A positive">A positive</option>
                               <option value="A negative">A negative</option>       
                               <option value="B positive">B positive</option>
                               <option value="B negative">B negative</option>
                               <option value="AB positive">AB positive</option>
                               <option value="AB negative">AB negative</option>
                          </select>
                          </div>
                        
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Name : </label>
                        <div class="col-sm-6">
                          <input type="text" name="fullname"  class="form-control" placeholder="Name" value="<?php echo @$family_info['f_Name']; ?>">
                        </div>
                      </div>
                       <div class="form-group">
                        <label class="col-sm-3 control-label">Gender : </label>
                        <div class="col-sm-6">
                         <select class="select2 select2-offscreen" name="gender">
                          <?php
                               if(!empty($family_info['f_Sex'])){
                                  echo "<option selected='selected' value=".$family_info['f_Sex'] ."> ". $family_info['f_Sex'] ."</option>";
                               } else {
                                  echo "<option value=''>-- Select Gender --</option>";
                               }
                           ?>
                         
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                          </select>
                        </div>
                      </div>
                       <!--<div class="form-group">
                      <label class="col-sm-3 control-label"> Date of Birth : </label>
                      <div class="col-sm-6">
                        
                        <div class="input-group date datetime " data-min-view="2" data-date-format="yyyy-mm-dd">
                          <input type="text" name="f_dob" class="form-control" size="16"  value="<?php //echo @$family_info['f_dob']; ?>" >
                          <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                        </div>            
                      </div>
                    </div>-->
                       
                      <div class="form-group">
                      <label class="col-sm-3 control-label">Address : </label>
                      <div class="col-sm-6">
                        <textarea name="f_address" rows="5" class="form-control"><?php echo @$family_info['f_Address']; ?></textarea>
                      </div>
                    </div>
                    <div style="text-align: center; margin-top: 10px;"><button class="btn btn-primary _update_account" name="update_family_info">Update Family Info </button></div>
                 </form>
               
           </div>

           </div>


      </div>
     