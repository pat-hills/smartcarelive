<body>

  <div class="container-fluid" id="pcont">
    <div class="page-head">
     <h2>Consultations History Logs</h2>
        <ol class="breadcrumb">
          <li><a href="index.php">Home </a></li>
          <li class="active"><a href="#">Consultations Histories</a></li>
          
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

          <div  class="cl-mcont">
  
      <div  class="block-flat profile-info">
      <div class="row Consultations">
				  <div class="col-md-12">
					<div class="block-flat">
						<div class="header">							
							<h3 style="text-align: center">
                 Last 30 day's Consultations Charts
                
              </h3>
						</div>

						<div   class="content">
							 <!-- <div class="tab-container tab-left"> -->
            
             
               <div  id="chart-container" >
                 <canvas  id="graphCanvasConsultations" ></canvas>
               </div>

             </div>


 


						</div>
					</div>				
				</div>
        </div>
      
    
                
 


      
<div class="cl-mcont">
    <div class="row">
        <div class="col-sm-12 col-md-12">
             



            <div class="tab-container">
                <?php
                //calling tab control function
              //  set_tabs(@$_SESSION['ac_tab']);
                ?>
                <ul class="nav nav-tabs">
                    <li class="pinfo active"><a href="#Today" data-toggle="tab">Today</a></li>
              
                    <li class=""><a href="#Yesterday" data-toggle="tab">Yesterday</a></li>
                    <li class="" ><a href="#Last7Days" data-toggle="tab">Last 7 Days</a></li>

                    <li class="" ><a href="#Last30Days" data-toggle="tab">Last 30 Days</a></li>

                    <!-- <li class=""><a href="#investigations" data-toggle="tab"><b style="">Investigations</b></a></li>  

                    
                    <li class=""><a href="#Diagnosis" data-toggle="tab"><b style="">Diagnosis</b></a></li>  

                    
                    <li class=""><a href="#Prescriptions" data-toggle="tab"><b style="">Prescriptions</b></a></li>   -->
                    
                    <!-- <li class=""><a href="#outcome" data-toggle="tab">  Outcome</a></li> -->
                </ul>
                <div class="tab-content">
                     <div class="tab-pane active cont" id="Today">
                     <h3 class="hthin">Today's Consultations</h3> 
                       
                     <div class="">
                       
								<table   class="customers" >
									<thead>
										<tr>
											<th>Date </th>
											<th>Patient Name</th>
                      <th>Action</th>
										</tr>
									</thead>
									<tbody>

                  <?php
                   


                                       $my_consulations_today = my_consulations_today();                        
               ?>
											
									</tbody>
								</table>							
							</div>
                        

                     </div>


                     <div class="tab-pane cont" id="Yesterday">
                        <h3 class="hthin">Yesterday's Consultations</h3> 
                       
                        <div class="content">
                            

                            
                        <div class="">
								<table  class="customers" >
                <thead>
										<tr>
											<th>Date </th>
											<th>Patient Name</th>
                      <th>Action</th>
										</tr>
									</thead>
									<tbody>

                  <?php
                   


                                       $my_consulations_yesterday = my_consulations_yesterday();                        
               ?>
											
									</tbody>
								</table>							
							</div>



                        </div>

                        

                     </div>

                   

                     <div class="tab-pane cont" id="Last7Days">
                       
                        <h3 class="hthin">Last 7 Days Consultations</h3> 
                       
                       <div class="content">
                           

                       <div class="">
								<table  class="customers" >
                <thead>
										<tr>
											<th>Date </th>
											<th>Patient Name</th>
                      <th>Action</th>
										</tr>
									</thead>
									<tbody>

                  <?php
                   


                                       $my_consulations_last_7_days = my_consulations_last_7_days();                        
               ?>
											
									</tbody>
								</table>							
							</div>
                           



                       </div>
                            
                        </div>

                        <div class="tab-pane cont" id="Last30Days">
                       
                       <h3 class="hthin">Last 30 Days Consultations</h3> 
                      
                      <div class="content">
                          

                      <div class="">
								<table  class="customers" >
                <thead>
										<tr>
											<th>Date </th>
											<th>Patient Name</th>
                      <th>Action</th>
										</tr>
									</thead>
									<tbody>

                  <?php
                   


                                       $my_consulations_last_30_days = my_consulations_last_30_days();                        
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
                   


                                   //    $date = investigations_history_(@$_SESSION['patient_id']);                        
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
                   


                                     //  $date = diagnosis_history_(@$_SESSION['patient_id']);                        
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
                   


                                   //    $date = prescription_history_(@$_SESSION['patient_id']);                        
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
