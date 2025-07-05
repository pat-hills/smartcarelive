<body>

<div class="container-fluid" id="pcont">
    <div class="page-head">
      <h2>Search For Patient Medical Results</h2>
      <ol class="breadcrumb">
        <li><a href="index">Home</a></li>
       
        <li class="active">Search For Patient Medical Results</li>
      </ol>
    </div>
    <div class="cl-mcont"> 
	<div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="block-flat">
          <div class="header">							
          <?php
                                                echo @$_SESSION['inves_err_exist'];
                                                unset($_SESSION['inves_err_exist']);
                                                ?>
                                                
          </div>
          <div class="content">
          <div class="row">
          <div class="col-sm-12 col-md-12">
                            <div class="block-flat">
                                <div class="header">							
                                    <h3>Search Patient</h3>
                                </div>
                                <div class="content">

                                
                                <form role="form" class="form-horizontal group-border-dashed" action="db_tasks/add_inves_exist.php" method="post"> 
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Search Fullname : </label>
                                            <div class="col-sm-6">
                                                <input autocomplete="off" type="text"  id="select_patient_medical_history" name="get_details_medical_history" class="form-control" placeholder="Search Fullname" value="">
                                            </div>
                                        </div>  


                                        <div id="result" class="list-group"></div>
 
                                       

                                       

 

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Fullname : </label>
                                            <div class="col-sm-6">
                                            <input  autocomplete="off" readonly type="text" value="<?php
                                            if(isset($_SESSION['patient_fullname']) && !empty($_SESSION['patient_fullname'])){
                                                echo $_SESSION['patient_fullname'];
                                            }
                                            
                                          
                                            
                                            
                                            ?>" name="fullname" class="form-control" placeholder="Fullname">
                                            </div>
                                        </div> 

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Contact : </label>
                                            <div class="col-sm-6">
                                            <input  autocomplete="off" readonly type="text" value="<?php
                                            if(isset($_SESSION['patient_contact']) && !empty($_SESSION['patient_contact'])){
                                                echo $_SESSION['patient_contact'];
                                            }
                                            
                                          
                                            
                                            
                                            ?>" name="patient_contact" class="form-control" placeholder="Phone / Contact">
                                            </div>
                                        </div> 

                                       

                                </div>

                            </div>


                        </div>

</div>


          </div>
        </div>

       
        
        <?php 
        
        echo @$_SESSION['err_msg'];
        unset($_SESSION['err_msg']);
        
        
        ?>
      
      <div class="tab-container">
						<ul class="nav nav-tabs">
						 
							<li class="active"><a href="#schedule_list" data-toggle="tab">Results History</a></li>
              
						</ul>
						<div class="tab-content">
						   
					  
					 
                       
                        
                         <div id="schedule_list" class="tab-pane active cont ">

 


                              <h3 class="widget-title">Results History - 


                              <?php 
                              
                              if(isset($_SESSION['patient_fullname']) && !empty($_SESSION['patient_fullname'])){

                                echo $_SESSION['patient_fullname'];
                              }
                              
                              ?>
                              </h3>
                              <div class="row friends-list">
                                  
                                  <?php
                                    if(isset($_SESSION['patient_id']) && !empty($_SESSION['patient_id'])){
                                      processed_results_single_patient($_SESSION['patient_id']);
                                    }
                                  ?>
                                
                              </div>
                              
                             <p></p>
                        </div>


                        

 
		</div>
						 
						  
		</div>
					</div>
	
	
    
	</div> 
</div>