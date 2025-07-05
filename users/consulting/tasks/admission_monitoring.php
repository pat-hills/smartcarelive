<body>

  <div class="container-fluid" id="pcont">
    <div class="page-head">
     <h2>Patient Admission Monitoring</h2>
        <ol class="breadcrumb">
          <li><a href="index.php">Home </a></li>
          <li class="active"><a href="#">Admission Monitoring</a></li>
          
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

            
              
                
                 
                  

                  <!-- <a href="vitals_monitoring" class="btn btn-success" >Take Vitals</a> -->
                  

                 
                  <!-- <a href="drugs_monitoring" class="btn btn-success" >Give Drugs</a>  -->

                  <a href="admission_chart_vitals" class="btn btn-success" >View Vital Charts</a> 
                 






                
                 

               </div>
               
            </div>
            

            <div class="col-sm-3">
                                <?php
                                //setting login error messages

                                echo @$_SESSION['err_msg_admission'];
                                unset($_SESSION['err_msg_admission']);



                                echo @$_SESSION['comp_err'];
                                unset($_SESSION['comp_err']);

                      
                                ?>
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
                   
              
                    <li class="pinfo active"><a href="#vitals" data-toggle="tab">Vitals</a></li>
                    <li class="" ><a href="#complains" data-toggle="tab">Medications Prescribed</a></li>

                    <li class="" ><a href="#drugs_given" data-toggle="tab">Drugs Given</a></li>
 
                    
                    <!-- <li class=""><a href="#outcome" data-toggle="tab">  Outcome</a></li> -->
                </ul>
                <div class="tab-content">
                     


                     <div class="tab-pane active cont" id="vitals">
                        <h3 class="hthin">Vitals Taken</h3> 
                       
                        <div class="content">
                            

                            
                        <div class="">
								<table  class="customers" >
									<thead>
										<tr>
											<th>Time / Date </th>
											<th>Weight ( Kg )</th>
											<th>Temperature ( °C )</th>

                      <th>Pulse ( % )</th>

                      <th>Pressure ( mmHg )</th>

                      <th>SpO2 ( % )</th>

                      <th>Respiration ( Breath/Minute )</th>

                      <th>Comments Taken</th>

                      <th>Taken by</th>

                      <th>Remove</th>
										  
										</tr>
									</thead>
									<tbody>

                  <?php
                   


                                       $vitals_monitoring_ = vitals_monitoring_(@$_SESSION['patient_id'],$_SESSION['date_admitted']);                        
               ?>
											
									</tbody>
								</table>							
							</div>



                        </div>

                        

                     </div>

                   

                     <div class="tab-pane cont" id="complains">
                       
                        <h3 class="hthin">Medications To Be Given</h3> 
                       
                       <div class="content">
                           

                       <div class="">
								<table  class="customers" >
									<thead>
										<tr>
											<th>Drug name </th>  

                      <th>Qty</th>

                      <th>Dosage</th>


                      <th>Prescribed by</th>
										  
										</tr>
									</thead>
									<tbody>

                  <?php
                   


                                    $date = get_patient_on_admission_prescribtion(@$_SESSION['patient_id'],$_SESSION['admitted_by'],$_SESSION['date_admitted']);                        
               ?>
											
									</tbody>
								</table>							
							</div>
                           



                       </div>
                            
                        </div>



                        <div class="tab-pane cont" id="drugs_given">
                       
                       <h3 class="hthin">Drugs Given</h3> 
                      
                      <div class="content">
                          

                      <div class="">
               <table  class="customers" >
                 <thead>
                   <tr>
                     <th>Drug name </th>  

                     <th>Qty Given</th>

                     <th>Given By</th>


                     <th>Time / Date</th>

                     <th>Comments</th>

                     <th>Remove</th>
                     
                   </tr>
                 </thead>
                 <tbody>

                 <?php
                  


                                  $date = drugs_monitoring_(@$_SESSION['patient_id'],$_SESSION['date_admitted']);                        
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
