<body>

<div class="container-fluid" id="pcont">
    <div class="page-head">
      <h2>Laboratory</h2>
      <ol class="breadcrumb">
        <li><a href="index.php">Home</a></li>
       
        <li class="active">Laboratory test</li>
      </ol>
    </div>
    <div class="cl-mcont"> 
	<div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="block-flat">
          <div class="header">							
            <!-- <h3>Multiple Search Area</h3> -->
          </div>
          <div class="content">
<!-- 
              <form class="form-horizontal group-border-dashed" method="post" action="tasks/set_patient_details.php" style="border-radius: 0px;">
                                    <div class="form-group">
                                        <div class="col-sm-2"></div>
                                        <label class="col-sm-3 control-label">Patient (ID/NHIS ID)</label>

                                        <div class="col-sm-3">
 
                                            <input class="form-control col-sm-3" autocomplete="off" type="text" id="select_patient" name="get_details" />
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-rad"><i class="fa fa-search"></i> Get Details</button>
                                    </div>

                                </form> -->


          </div>
        </div>

        <?php
        
        if(isset($_SESSION['saved_status'])&&$_SESSION['saved_status'] == 1){

          
        echo @$_SESSION['err_msg'];
        unset($_SESSION['err_msg']);
        

        }else{

          echo @$_SESSION['err_msg_unsaved'];
          unset($_SESSION['err_msg_unsaved']);
          

        }
        
        
        ?>
        

      
      <div class="tab-container">
						<ul class="nav nav-tabs">
							<li  class="active"><a href="#test_list_nhis" data-toggle="tab">Waiting List</a></li>
							<li ><a href="#test_list" data-toggle="tab">Pending Payment</a></li>
							<li><a href="#tested_list" data-toggle="tab">Processed Results Today</a></li>
							<li><a href="#schedule_list" data-toggle="tab">Results History</a></li>
              <!-- <li><a href="#pending_patient_test" data-toggle="tab">Lab Request Selection</a></li> -->
						</ul>
						<div class="tab-content">
						   
					 <div id="test_list_nhis" class="tab-pane active cont">

<!--            
                            <div class="btn-group pull-right">
                              <button type="button" class="btn btn-sm btn-flat btn-default"><i class="fa fa-angle-left"></i></button> 
                              <button type="button" class="btn btn-sm btn-flat btn-default"><i class="fa fa-angle-right"></i></button> 
                            </div> -->

<!--                             
                            <div class="btn-group pull-right">
                              <button type="button" class="btn btn-sm btn-flat btn-default dropdown-toggle" data-toggle="dropdown">
                              Order by <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Time</a></li>
                                
                              </ul>
                            </div> -->


                              <h3 class="widget-title">Incoming Lab Request</h3>
                              <div class="row friends-list">

                              <div class="">
                       
                       <table  class="customers" >
                         <thead>
                           <tr>
                             <th>Date </th>
                            
                             <th>Patient Name </th>
                             <th>Lab Test(s)</th>

                             <th>Request Doctor</th>


                             
                             <th>Action</th>
       
                            
                           </tr>
                         </thead>
                         <tbody>
       
                         <?php
                          
                           lab_test_single_selection();
                         
                      ?>
                             
                         </tbody>
                       </table>							
                     </div>
                                  
								<?php
                                 //   echo pending_payments();
                                ?>
                                
                              </div>
                              
                        <p></p>
                        </div>
						<div id="test_list" class="tab-pane cont ">

                           <!-- <div class="btn-group pull-right">
                              <button type="button" class="btn btn-sm btn-flat btn-default"><i class="fa fa-angle-left"></i></button> 
                              <button type="button" class="btn btn-sm btn-flat btn-default"><i class="fa fa-angle-right"></i></button> 
                            </div>

                            <div class="btn-group pull-right">
                              <button type="button" class="btn btn-sm btn-flat btn-default dropdown-toggle" data-toggle="dropdown">
                              Order by <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Time</a></li>
                                
                              </ul>
                            </div> -->


                              <h3 class="widget-title">Pending Payment</h3>
                              <div class="row friends-list">
                                
								<?php
                                   echo pending_payments();
                                ?>
                                
                              </div>
                              
                        <p></p>
                        </div>
                        <div id="tested_list" class="tab-pane cont ">

<!--                         
                            <div class="btn-group pull-right">
                              <button type="button" class="btn btn-sm btn-flat btn-default"><i class="fa fa-angle-left"></i></button> 
                              <button type="button" class="btn btn-sm btn-flat btn-default"><i class="fa fa-angle-right"></i></button> 
                            </div>
                            <div class="btn-group pull-right">
                              <button type="button" class="btn btn-sm btn-flat btn-default dropdown-toggle" data-toggle="dropdown">
                              Order by <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Time</a></li>
                                
                              </ul>
                            </div> -->



                              <h3 class="widget-title">Processed Results Today</h3>
                              <div class="row friends-list">
                                  
                                  <?php
                                    echo processed_results_today();
                                  ?>
                                
                              </div>
                              
                        <p></p>
                        </div>
                        
                         <div id="schedule_list" class="tab-pane cont ">

                              <!-- 
                            <div class="btn-group pull-right">
                              <button type="button" class="btn btn-sm btn-flat btn-default"><i class="fa fa-angle-left"></i></button> 
                              <button type="button" class="btn btn-sm btn-flat btn-default"><i class="fa fa-angle-right"></i></button> 
                            </div>
                            <div class="btn-group pull-right">
                              <button type="button" class="btn btn-sm btn-flat btn-default dropdown-toggle" data-toggle="dropdown">
                              Order by <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Time</a></li>
                                
                              </ul>
                            </div> -->


                              <h3 class="widget-title">Results History - Last 30 days </h3>
                              <div class="row friends-list">
                                  
                                  <?php
                                    echo last_thirty_days_results();
                                  ?>
                                
                              </div>
                              
                             <p></p>
                        </div>


                         <!-- <div id="schedule_list" class="tab-pane cont ">

                             


                              <h3 class="widget-title">Results History - Last 30 days </h3>
                              <div class="row friends-list">
                                  
                                  <?php
                                  //  echo last_thirty_days_results();
                                  ?>
                                
                              </div>
                              
                             <p></p>
                        </div> -->



                        <div id="pending_patient_test" class="tab-pane cont ">

                             


                              <h3 class="widget-title">Individual Lab Request </h3>
                              <div class="row friends-list">
                                  
                       
                                
                              </div>
                              
                             <p></p>
                        </div>
		</div>
						 
						  
		</div>
					</div>
	
	
    
	</div> 
</div>