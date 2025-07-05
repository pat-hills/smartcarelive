<?php  
 global $rows_count;


 


?>


<body>

  <div class="container-fluid" id="pcont">
    <div class="page-head">
     <h2>Medical Reporting</h2>
        <ol class="breadcrumb">
          <li><a href="index.php">Home </a></li>
          <li class="active"><a href="#">Medical Reporting</a></li>
          
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
  
     
      

        <div class="row">
				<div class="col-md-12">
					<div class="block-flat">
						 
						<div class="content">
							 <div class="tab-container tab-left">
               <?php 
               
               set_tabs_reporting_doc_users(@$_SESSION['current_active_tab']);
               ?>
            <ul class="nav nav-tabs flat-tabs">
              <li tooltip="Consultations" class="<?php echo @$_SESSION['patients'] ?>"><a title="Consultations" href="#patients" data-toggle="tab">Consultations</a></li>
              <li class="<?php echo @$_SESSION['complains'] ?>"><a title="Complains" href="#complains" data-toggle="tab">Complains</a></li>
              <li class="<?php echo @$_SESSION['diagnosis'] ?>"><a title="Diagnosis" href="#diagnosis" data-toggle="tab">Diagnosis</a></li>
              <!-- <li class="<?php // echo @$_SESSION['investigations'] ?>"><a title="Investigations" href="#investigations" data-toggle="tab">Investigations</a></li> -->
              <!-- <li class=""><a href="#procedures" data-toggle="tab"><i class="fa fa-stethoscope"></i></a></li> -->
              <!-- <li class="<?php //echo @$_SESSION['medical_history'] ?>"><a title ="Medical History" href="#medical_history" data-toggle="tab">Medical History</a></li> -->
            </ul>
            <div class="tab-content">
              <div class="tab-pane cont fade <?php echo @$_SESSION['patients']; ?> in" id="patients">
              <form class="form-horizontal group-border-dashed" method="post" action="db_tasks/process_print_search" style="border-radius: 0px;">
                            
                            <div class="col-sm-12">
                                <div class="form-group">
                                   
                                    <div class="col-sm-12" style="">

                                    <div style="margin-left:-240px" class="form-group">
                                        <label class="col-sm-3 control-label">Start Date</label>
                                        <div class="col-sm-6">
                                        <div class="input-group date datetime "  data-min-view="2" data-date-format="yyyy-mm-dd">
                                            <input type="text" name="start_date_patient_consulting_report" readonly="" class="form-control" size="16"   >
                                            <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                                        </div>  
                                        </div>

                                    </div>

                                    <div style="margin-left:-240px" class="form-group">
                                        <label class="col-sm-3 control-label">End Date</label>
                                        <div class="col-sm-6">
                                        <div class="input-group date datetime "  data-min-view="2" data-date-format="yyyy-mm-dd">
                                            <input type="text" name="end_date_patient_consulting_report" readonly="" class="form-control" size="16"   >
                                            <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                                        </div>  
                                        </div>

                                    </div>

                                    <div style="margin-left:-240px" class="form-group">
                                        <label class="col-sm-3 control-label">Gender</label>
                                        <div class="col-sm-6">
                                        <select required name="gender_patient_consulting_report" required="" class="form-control" style="">

                                        <option>--------------------</option>
                                         <option>All</option>
                                            <option>Male</option>	
                                            <option>Female</option>
                                          

                                        </select>
                                        </div>

                                    </div>

                                  

                                    <div class="form-group">
                                    <label class="col-sm-3 control-label"></label>
                                        <div class="col-sm-6">
                                        <button name="Print_Patient_Consulting_Report" class="btn btn-primary" type="submit">Submit Search</button>
                                        </div>
 

                                    </div>

                                    
                                       
                                    </div>
                                </div> 
                                </div>



                           

                           
 
                        </form>   



                        <?php 

                       
                        
                        if (!empty(	$_SESSION['count_rows']) && isset($_SESSION['count_rows']) && ($_SESSION['count_rows'] > 0)) { ?>


                          <div class="block-flat profile-info">
                      <h4>
                        Number of Records Found : <?php
                     
                        
                        echo 	$_SESSION['count_rows']; 
                        
                        
                        ?>
                      </h4>  
                                  
                                        <div >
                                        <a target="_blank" href="../../users/consulting/reporting/consulting_patients" class="btn btn-primary" type="submit">Generate Search Report</a>
                                        </div>
 

                  </div>
             
         
                <?php }elseif(isset($_SESSION['count_rows']) && $_SESSION['count_rows']==0) { ?>
                         
                  <div class="block-flat profile-info">
                      <h4>
                        Number of Records Found : <?php
                     
                        
                        echo 	$_SESSION['count_rows']; 
                        
                        
                        ?>
                      </h4>  
                 

                  </div>
                      
                   <?php } ?>
                    

                 

               
              </div>
              <div class="tab-pane <?php echo @$_SESSION['complains']; ?> cont" id="complains">
                    <div class="header">              
                      <h3> Complains</h3>
                    </div>
                    <div class="content">
                   
                    <form class="form-horizontal group-border-dashed" method="post" action="db_tasks/process_print_search" style="border-radius: 0px;">
                            
                            <div class="col-sm-12">
                                <div class="form-group">
                                   
                                    <div class="col-sm-12" style="">

                                    <div style="margin-left:-240px" class="form-group">
                                        <label class="col-sm-3 control-label">Start Date</label>
                                        <div class="col-sm-6">
                                        <div class="input-group date datetime "  data-min-view="2" data-date-format="yyyy-mm-dd">
                                            <input type="text" name="start_date_complains_report" readonly="" class="form-control" size="16"   >
                                            <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                                        </div>  
                                        </div>

                                    </div>

                                    <div style="margin-left:-240px" class="form-group">
                                        <label class="col-sm-3 control-label">End Date</label>
                                        <div class="col-sm-6">
                                        <div class="input-group date datetime "  data-min-view="2" data-date-format="yyyy-mm-dd">
                                            <input type="text" name="end_date_complains_report" readonly="" class="form-control" size="16"   >
                                            <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                                        </div>  
                                        </div>

                                    </div>

                                  
                                    <div style="margin-left:-240px" class="form-group">
                                        <label class="col-sm-3 control-label">Complains</label>
                                        <div class="col-sm-6">
                                        <select required name="select_complains_report" required="" class="form-control" style="">

                                        <option>--------------------</option>
                                         <option><?php echo   list_complains(); ?></option>
                                            
                                          

                                        </select>
                                        </div>

                                    </div>


                                    <div style="margin-left:-240px" class="form-group">
                                        <label class="col-sm-3 control-label">Gender</label>
                                        <div class="col-sm-6">
                                        <select required name="gender_complains_report" required="" class="form-control" style="">

                                        <option>--------------------</option>
                                         <option>All</option>
                                            <option>Male</option>	
                                            <option>Female</option>
                                          

                                        </select>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                    <label class="col-sm-3 control-label"></label>
                                        <div class="col-sm-6">
                                        <button name="Print_Patient_Complains_Report" class="btn btn-primary" type="submit">Submit Search</button>
                                        </div>
 

                                    </div>

                                    
                                       
                                    </div>
                                </div> 
                                </div>
                                 </form>   




                                 <?php 

                       
                        
if (!empty(	$_SESSION['count_complain_rows']) && isset($_SESSION['count_complain_rows']) && ($_SESSION['count_complain_rows'] > 0)) { ?>


  <div class="block-flat profile-info">
<h4>
Number Of Complain Records Found: <?php


echo 	$_SESSION['count_complain_rows']; 


?>
</h4>  
          
                <div >
                <a target="_blank" href="../../users/consulting/reporting/complains_report" class="btn btn-primary" type="submit">Generate Search Report</a>
                </div>


</div>


<?php }elseif(isset($_SESSION['count_complain_rows']) && ($_SESSION['count_complain_rows']==0)) { ?>
 
<div class="block-flat profile-info">
<h4>
Number Of Complain Records Found: <?php

//if(isset(	$_SESSION['count_complain_rows'])){
  echo 	$_SESSION['count_complain_rows']; 
//}




?>
</h4>  


</div>

<?php } ?>




								 
                       
                    </div>
              </div>
              <div class="tab-pane <?php echo @$_SESSION['diagnosis']; ?> cont" id="diagnosis">
                    <div class="header">              
                      <h3>Diagnosis</h3>
                    </div>
                    <div class="content">


                    <form class="form-horizontal group-border-dashed" method="post" action="db_tasks/process_print_search" style="border-radius: 0px;">
                            
                            <div class="col-sm-12">
                                <div class="form-group">
                                   
                                    <div class="col-sm-12" style="">

                                    <div style="margin-left:-240px" class="form-group">
                                        <label class="col-sm-3 control-label">Start Date</label>
                                        <div class="col-sm-6">
                                        <div class="input-group date datetime "  data-min-view="2" data-date-format="yyyy-mm-dd">
                                            <input type="text" name="start_date_diagnosis_report" readonly="" class="form-control" size="16"   >
                                            <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                                        </div>  
                                        </div>

                                    </div>

                                    <div style="margin-left:-240px" class="form-group">
                                        <label class="col-sm-3 control-label">End Date</label>
                                        <div class="col-sm-6">
                                        <div class="input-group date datetime "  data-min-view="2" data-date-format="yyyy-mm-dd">
                                            <input type="text" name="end_date_diagnosis_report" readonly="" class="form-control" size="16"   >
                                            <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                                        </div>  
                                        </div>

                                    </div>

                                  
                                    <div style="margin-left:-240px" class="form-group">
                                        <label class="col-sm-3 control-label">Diagnosis</label>
                                        <div class="col-sm-6">
                                        <select required name="select_diagnosis_report" required="" class="form-control" style="">

                                        <option>--------------------</option>
                                         <option><?php echo   list_diagnosis(); ?></option>
                                            
                                          

                                        </select>
                                        </div>

                                    </div>

                                    <div style="margin-left:-240px" class="form-group">
                                        <label class="col-sm-3 control-label">Start Age</label>
                                        <div class="col-sm-6">
                                        <select required name="start_age_report" required="" class="form-control" style="">

                                        <option>--------------------</option>
                                                                                  <?php 

                                          for($i=1; $i<=100; $i++)
                                          {

                                              echo "<option value=".$i.">".$i."</option>";
                                          }
                                          ?>
                                          

                                        </select>
                                        </div>

                                    </div>


                                    <div style="margin-left:-240px" class="form-group">
                                        <label class="col-sm-3 control-label">End Age</label>
                                        <div class="col-sm-6">
                                        <select required name="end_age_report" required="" class="form-control" style="">

                                        <option>--------------------</option>
                                                                                  <?php 

                                          for($i=1; $i<=100; $i++)
                                          {

                                              echo "<option value=".$i.">".$i."</option>";
                                          }
                                          ?>

                                        </select>
                                        </div>

                                    </div>


                                    <div style="margin-left:-240px" class="form-group">
                                        <label class="col-sm-3 control-label">Gender</label>
                                        <div class="col-sm-6">
                                        <select required name="gender_diagnosis_report" required="" class="form-control" style="">

                                        <option>--------------------</option>
                                         <option>All</option>
                                            <option>Male</option>	
                                            <option>Female</option>
                                          

                                        </select>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                    <label class="col-sm-3 control-label"></label>
                                        <div class="col-sm-6">
                                        <button name="Print_Patient_Diagnosis_Report" class="btn btn-primary" type="submit">Submit Search</button>
                                        </div>
 

                                    </div>

                                    
                                       
                                    </div>
                                </div> 
                                </div>
                                 </form>   



                                 

                                 <?php 

                       
                        
if (!empty(	$_SESSION['count_diagnosis_rows']) && isset($_SESSION['count_diagnosis_rows']) && ($_SESSION['count_diagnosis_rows'] > 0)) { ?>


  <div class="block-flat profile-info">
<h4>
Number Of Diagnosis Records Found: <?php


echo 	$_SESSION['count_diagnosis_rows']; 


?>
</h4>  
          
                <div >
                <a target="_blank" href="../../users/consulting/reporting/diagnosis_report" class="btn btn-primary" type="submit">Generate Search Report</a>
                </div>


</div>


<?php }elseif(isset($_SESSION['count_diagnosis_rows']) && ($_SESSION['count_diagnosis_rows']==0)) { ?>
 
<div class="block-flat profile-info">
<h4>
Number Of Diagnosis Records Found: <?php

//if(isset(	$_SESSION['count_complain_rows'])){
  echo 	$_SESSION['count_diagnosis_rows']; 
//}




?>
</h4>  


</div>

<?php } ?>





                    
                    </div>
              </div>


              <div  class="tab-pane <?php //echo @$_SESSION['medical_history']; ?> cont" id="medical_history">
                    <div class="header">              
                      <h3>Medical History</h3>
                    </div>
                    <div class="content">

                    <form class="form-horizontal group-border-dashed" method="post" action="db_tasks/process_print_search" style="border-radius: 0px;">
                            
                            <div class="col-sm-12">
                                <div class="form-group">
                                   
                                    <div class="col-sm-12" style="">

                                    <div style="margin-left:-240px" class="form-group">
                                        <label class="col-sm-3 control-label">Start Date</label>
                                        <div class="col-sm-6">
                                        <div class="input-group date datetime "  data-min-view="2" data-date-format="yyyy-mm-dd">
                                            <input type="text" name="start_date_medical_history_report" readonly="" class="form-control" size="16"   >
                                            <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                                        </div>  
                                        </div>

                                    </div>

                                    <div style="margin-left:-240px" class="form-group">
                                        <label class="col-sm-3 control-label">End Date</label>
                                        <div class="col-sm-6">
                                        <div class="input-group date datetime "  data-min-view="2" data-date-format="yyyy-mm-dd">
                                            <input type="text" name="end_date_medical_history_report" readonly="" class="form-control" size="16"   >
                                            <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                                        </div>  
                                        </div>

                                    </div>

                                    <div style="margin-left:-240px" class="form-group">
                                        <label class="col-sm-3 control-label">Category</label>
                                        <div class="col-sm-6">
                                        <select required name="category_medical_history_report" required="" class="form-control" style="">

                                        <option>--------------------</option>
                                         <option>Vitals</option>
                                            <option>Complains</option>	
                                            <option>Investigations</option>
                                            <option>Diagnosis</option>
                                            <option>Prescriptions</option>

                                        </select>
                                        </div>

                                    </div>

                                    <div style="margin-left:-240px" class="form-group">
                                        <label class="col-sm-3 control-label">Gender</label>
                                        <div class="col-sm-6">
                                        <select required name="gender_medical_history_report" required="" class="form-control" style="">

                                        <option>--------------------</option>
                                         <option>All</option>
                                            <option>Male</option>	
                                            <option>Female</option>
                                          

                                        </select>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                    <label class="col-sm-3 control-label"></label>
                                        <div class="col-sm-6">
                                        <button name="Print_Patient_Medical_History_Report" class="btn btn-primary" type="submit">Submit Search</button>
                                        </div>
 

                                    </div>

                                    
                                       
                                    </div>
                                </div> 
                                </div>
                                 </form>   



                                 

                                 <?php 

                       
                        
if (!empty(	$_SESSION['count_medical_history_rows']) && isset($_SESSION['count_medical_history_rows']) && ($_SESSION['count_medical_history_rows'] > 0)) { ?>


  <div class="block-flat profile-info">
<h4>
Number Of Medical History Records Found: <?php


echo 	$_SESSION['count_medical_history_rows']; 


?>
</h4>


<?php if (isset($_SESSION['medical_history_category']) && !empty($_SESSION['medical_history_category']) && ($_SESSION['medical_history_category']=="Complains")) { ?>


              <div >
                <a target="_blank" href="../../users/consulting/reporting/medical_history_complains" class="btn btn-primary" type="submit">Generate Complains Search Report</a>
                </div>        
         
              
      <?php } ?>
  
          
               


</div>


<?php }elseif(isset($_SESSION['count_medical_history_rows']) && ($_SESSION['count_medical_history_rows']==0)) { ?>
 
<div class="block-flat profile-info">
<h4>
Number Of Medical History Records Found: <?php

//if(isset(	$_SESSION['count_complain_rows'])){
  echo 	$_SESSION['count_medical_history_rows']; 
//}




?>
</h4>  


</div>

<?php } ?>






                   
                    </div>
              </div>

<!-- 
              <div class="tab-pane fade" id="procedures">
                    <div class="header">              
                      <h3>-----</h3>
                    </div>
                    <div class="content">

 
                    </div>
              </div>



              <div class="tab-pane fade" id="prescriptions">
                    <div class="header">              
                      <h3>-----</h3>
                    </div>
                    <div class="content">

                   
                    </div>
              </div>

               -->
            </div>
          </div>
						</div>
					</div>				
				</div>
			</div>
			
     
                 		
  
