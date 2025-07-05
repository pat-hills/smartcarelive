
<body>

  <div class="container-fluid" id="pcont">
    <div class="page-head">
     <h2>Patient Medical Histories</h2>
        <ol class="breadcrumb">
          <li><a href="index.php">Home </a></li>
          <li class="active"><a href="#">Medical Histories</a></li>
          
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

               <p>
                 <a href="history_chart_vitals" class="btn btn-success" >View Vital Charts</a> 

                 </p>

               </div>
               
            </div>
            <div class="col-sm-3">
            
            </div>
          </div>
        </div>
      
    
                

        <!-- <div class="row">
				<div class="col-md-12">
					<div class="block-flat">
						<div class="header">							
							<h3>Patient's History</h3>
						</div>
						<div class="content">
							<div class="table-responsive">
								<table class="table table-bordered" id="datatable-icons" >
									<thead>
										<tr>
											<th>Date </th>
											<th>Day</th>
											<th>Doctor</th>
											<th>Consulting Room</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>

										<?php
											
										//	$date = date_history(@$_SESSION['patient_id']);
											
										?>
											
									</tbody>
								</table>							
							</div>
						</div>
					</div>				
				</div>
			</div>
					
  
 -->


      
<div class="cl-mcont">
    <div class="row">
        <div class="col-sm-12 col-md-12">
             



            <div class="tab-container">
                <?php
                //calling tab control function
              //  set_tabs(@$_SESSION['ac_tab']);
                ?>
                <ul class="nav nav-tabs">
                    <li class="pinfo active"><a href="#pinfo" data-toggle="tab">Summary</a></li>
              
                    <li class=""><a href="#vitals" data-toggle="tab">Vitals</a></li>
                    <li class="" ><a href="#complains" data-toggle="tab">Complains</a></li>

                    <li class="" ><a href="#onexaminations" data-toggle="tab">On Examinations</a></li>

                    <li class=""><a href="#investigations" data-toggle="tab"><b style="">Investigations</b></a></li>  
                    <li class=""><a href="#Scans" data-toggle="tab"><b style="">Scans</b></a></li> 
                    
                    <li class=""><a href="#Diagnosis" data-toggle="tab"><b style="">Diagnosis</b></a></li>  

                    
                    <li class=""><a href="#Prescriptions" data-toggle="tab"><b style="">Prescriptions</b></a></li>  
                    
                    <!-- <li class=""><a href="#Admission" data-toggle="tab"> Scans Admission</a></li>  -->

                    <li class=""><a href="#Review" data-toggle="tab">  Review</a></li> 
                    <li class=""><a href="#Notes" data-toggle="tab">  Notes</a></li> 
                    <li class=""><a href="#Files" data-toggle="tab">  Files</a></li> 
                </ul>
                <div class="tab-content">
                     <div class="tab-pane active cont" id="pinfo">
                     <h3 class="hthin">Patient Executive History Summary</h3> 
                       
                     <div class="">
                       
								<table>
									<thead>
										<tr>
											<th>Date </th>
											<th>Vitals</th>
											<th>Presenting Complains / History On Presenting Complains</th>

                      <th>Prescription</th>
										</tr>
									</thead>
									<tbody>

                  <?php
                   
                   $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                   $limit = 10;
                   $offset = ($page - 1) * $limit;

                   if(isset($_SESSION['patient_id'])){
                    $date = date_history_optimized1($_SESSION['patient_id']);
                   }

                  
                       
               ?>
											
									</tbody>
								</table>	
                
                <?php 
                   $limitcount = 10;
                   $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                // Total record count (grouped by date_sent)
// $count_result = mysqli_query(
//   $connection,
//   "SELECT COUNT( date_sent) as total FROM tbl_consulting WHERE patient_id = '{$_SESSION['patient_id']}'"
// );
// $total = mysqli_fetch_assoc($count_result)['total'];
// $pages = ceil($total / $limitcount);

// if ($pages > 1) {
//   echo "<div class='pagination'>";
//   for ($i = 1; $i <= $pages; $i++) {
//       echo "<a href='?page=$i'" . ($i == $page ? " class='active'" : "") . ">$i</a> ";
//   }
//   echo "</div>";
// }
                
                
                ?>
							</div>
                        

                     </div>


                     <div class="tab-pane cont" id="vitals">
                        <h3 class="hthin">Vitals History</h3> 
                       
                        <div class="content">
                            

                            
                        <div class="">
								<table  class="customers" >
									<thead>
										<tr>
											<th>Date </th>
											<th>Weight ( Kg )</th>
											<th>Temperature ( °C )</th>

                      <th>Pulse ( % )</th>

                      <th>Pressure ( mmHg )</th>

                      <th>SpO2 ( % )</th>

                      <th>Respiration ( Breath/Minute )</th>

                      <th>Taken by</th>
										  
										</tr>
									</thead>
									<tbody>

                  <?php
                   


                                     $date = vitals_history_(@$_SESSION['patient_id']);                        
               ?>
											
									</tbody>
								</table>							
							</div>



                        </div>

                        

                     </div>

                   

                     <div class="tab-pane cont" id="complains">
                       
                        <h3 class="hthin">Complains History</h3> 
                       
                       <div class="content">
                           

                       <div class="">
								<table  class="customers" >
									<thead>
										<tr>
											<th>Date </th>  

                      <th>Complains</th>

                      <th>Recorded by</th>
										  
										</tr>
									</thead>
									<tbody>

                  <?php
                   


                                      $date = complains_history_(@$_SESSION['patient_id']);                        
               ?>
											
									</tbody>
								</table>							
							</div>
                           



                       </div>
                            
                        </div>

                        <div class="tab-pane cont" id="onexaminations">
                       
                       <h3 class="hthin">On Examinations History</h3> 
                      
                      <div class="content">
                          

                      <div class="">
								<table  class="customers" >
									<thead>
										<tr>
											<th>Date </th>  

                      <th>Examinations</th>

                      <th>Recorded by</th>
										  
										</tr>
									</thead>
									<tbody>

                  <?php
                   


                                      $date = examination_history_(@$_SESSION['patient_id']);                        
               ?>
											
									</tbody>
								</table>							
							</div>
                          



                      </div>
                           
                       </div>


                        
                     <div class="tab-pane cont" id="investigations">
                       
                       <h3 class="hthin">Investigations History</h3> 
                      
                      <div class="content">
                          

                      <div class="">
                            <table  class="customers" >
                              <thead>
                            <tr>
                              <th>Date </th>  

                              <th>Investigation(s)</th>

                              <th>Recorded by</th>

                              <th>View Results</th>
                              
                            </tr>
                          </thead>
                          <tbody>

                          <?php
                          


                                              $date = investigations_history_(@$_SESSION['patient_id']);                        
                         ?>
                              
                          </tbody>
                        </table>							
						           	</div>
                          



                        </div>
                           
                       </div>

                       <div class="tab-pane cont" id="Scans">
                       
                       <h3 class="hthin">Scans History</h3> 
                      
                      <div class="content">
                          

                      <div class="">
                            <table  class="customers" >
                              <thead>
                            <tr>
                              <th>Date </th>  

                              <th>Scan(s)</th>

                               <th>Description</th>

                              <th>Recorded by</th>

                           
                              
                            </tr>
                          </thead>
                          <tbody>

                          <?php
                          


                                              $date = scan_history_(@$_SESSION['patient_id']);                        
                         ?>
                              
                          </tbody>
                        </table>							
						           	</div>
                          



                        </div>
                           
                       </div>

                       


                       
                     <div class="tab-pane cont" id="Diagnosis">
                       
                       <h3 class="hthin">Diagnosis History</h3> 
                      
                      <div class="content">
                          

                          
                      <div class="">
								<table  class="customers" >
									<thead>
										<tr>
											<th>Date </th>  

                      <th>Diagnosis</th>

                      <th>Recorded by</th>
										  
										</tr>
									</thead>
									<tbody>

                  <?php
                   


                                    $date = diagnosis_history_(@$_SESSION['patient_id']);                        
               ?>
											
									</tbody>
								</table>							
							</div>


                      </div>
                           
                       </div>



                          
                     <div class="tab-pane cont" id="Prescriptions">
                       
                       <h3 class="hthin">Prescriptions History</h3> 
                      
                      <div class="content">
                          
      
                      <div class="">
								<table  class="customers" >
									<thead>
										<tr>
											<th>Date </th>  

                      <th>Prescriptions</th>

                      <!-- <th>Recorded by</th> -->
										  
										</tr>
									</thead>
									<tbody>

                  <?php
                   


                                      $date = prescription_history_(@$_SESSION['patient_id']);                        
               ?>
											
									</tbody>
								</table>							
							</div>
              </div>
              </div>



              <div class="tab-pane cont" id="Admission">
                       
                       <h3 class="hthin">Admission History</h3> 
                      
                      <div class="content">
                          
      
                      <div class="">
								<table  class="customers" >
									<thead>
										<tr>
											<th>Date </th>  

                      <th>Ward</th>

                      <th>Status</th>

                      <th>Comments</th>
                      <th>Admitted by</th>
										  
										</tr>
									</thead>
									<tbody>

                  <?php
                   


                                    //  $date = admission_history_(@$_SESSION['patient_id']);                        
               ?>
											
									</tbody>
								</table>							
							</div>
              </div>
              </div>


              <div class="tab-pane cont" id="Review">
                       
                       <h3 class="hthin">Review History</h3> 
                      
                      <div class="content">
                          
      
                      <div class="">
								<table  class="customers" >
									<thead>
										<tr>
											<th>Date </th>  

                      <th>Comments</th>

                       <th>Requested by</th>

                       <th>Date of review</th>
										  
										</tr>
									</thead>
									<tbody>

                  <?php
                   


                                      $date = review_history_(@$_SESSION['patient_id']);                        
               ?>
											
									</tbody>
								</table>							
							</div>
              </div>
              </div>

              <div class="tab-pane cont" id="Notes">
                       
                       <h3 class="hthin">Patient Notes History</h3> 
                      
                      <div class="content">
                          
      
                      <div class="">
								<table  class="customers" >
									<thead>
										<tr>
											<th>Date </th>  

                      <th>Notes</th>

                       <th>Taken by</th>

                       <th>Taken on</th>
										  
										</tr>
									</thead>
									<tbody>

                  <?php
                   


                                      $date = notes_history_(@$_SESSION['patient_id']);                        
               ?>
											
									</tbody>
								</table>							
							</div>
              </div>
              </div>


              <div class="tab-pane cont" id="Files">
                       
                       <h3 class="hthin">Patient Files History</h3> 
                      
                      <div class="content">
                          
      
                      <div class="">
								<table  class="customers" >
									<thead>
										<tr>
											<th>Date </th>  

                      <th>Comments</th>

                       <th>Taken by</th>

                       <th>View File</th>
										  
										</tr>
									</thead>
									<tbody>

                  <?php
                   


                                      $date = file_history_(@$_SESSION['patient_id']);                        
               ?>
											
									</tbody>
								</table>							
							</div>
              </div>
              </div>




                    </div>
                    

                    

                   
 

                 
                
            </div>
        </div>


    </div>

</div>
</div>
</div>
