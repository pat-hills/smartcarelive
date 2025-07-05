<?php  
 global $rows_count;


 


?>


<body>

  <div class="container-fluid" id="pcont">
    <div class="page-head">
     <h2>Claims Reporting</h2>
        <ol class="breadcrumb">
          <li><a href="index.php">Home </a></li>
          <li class="active"><a href="#">Claims Reporting</a></li>
          
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
               
              // set_tabs_reporting_doc_users(@$_SESSION['current_active_tab']);
               ?>
            <ul class="nav nav-tabs flat-tabs">
              <li tooltip="Consultations" class="<?php echo @$_SESSION['patients'] ?>"><a title="Consultations" href="#patients" data-toggle="tab">Claims</a></li>
              <!-- <li class="<?php //echo @$_SESSION['complains'] ?>"><a title="Complains" href="#complains" data-toggle="tab">Complains</a></li>
              <li class="<?php //echo @$_SESSION['diagnosis'] ?>"><a title="Diagnosis" href="#diagnosis" data-toggle="tab">Diagnosis</a></li> -->
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
                                            <input type="text" name="start_date_patient_claim_report" readonly="" class="form-control" size="16"   >
                                            <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                                        </div>  
                                        </div>

                                    </div>

                                    <div style="margin-left:-240px" class="form-group">
                                        <label class="col-sm-3 control-label">End Date</label>
                                        <div class="col-sm-6">
                                        <div class="input-group date datetime "  data-min-view="2" data-date-format="yyyy-mm-dd">
                                            <input type="text" name="end_date_patient_claim_report" readonly="" class="form-control" size="16"   >
                                            <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                                        </div>  
                                        </div>

                                    </div>

                                    <div style="margin-left:-240px" class="form-group">
                                        <label class="col-sm-3 control-label">Claim Provider</label>
                                        <div class="col-sm-6">
                                        <select required name="claim_provider" required="" class="form-control" style="">

                                        <option>--------------------</option>
                                        <option>All</option>
                                        <option><?php echo   list_claims_providers(); ?></option>
                                          

                                        </select>
                                        </div>

                                    </div>

                                  

                                    <div class="form-group">
                                    <label class="col-sm-3 control-label"></label>
                                        <div class="col-sm-6">
                                        <button name="Print_Patient_Claims_Report" class="btn btn-primary" type="submit">Submit Search</button>
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
                                        <a target="_blank" href="../../users/NHIS/reporting/claims_report" class="btn btn-primary" type="submit">Generate Search Report</a>
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


             

  
            </div>
          </div>
						</div>
					</div>				
				</div>
			</div>
			
     
                 		
  
