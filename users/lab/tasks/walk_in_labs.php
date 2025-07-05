<body>

<div class="container-fluid" id="pcont">
    <div class="page-head">
      <h2>Walk In Laboratory Test</h2>
      <ol class="breadcrumb">
        <li><a href="index.php">Home</a></li>
       
        <li class="active">Walk In Laboratory Test</li>
      </ol>
    </div>
    <div class="cl-mcont"> 
	<div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="block-flat">
          <div class="header">							
          <?php
                                                echo @$_SESSION['inves_err'];
                                                unset($_SESSION['inves_err']);
                                                ?>
                                                
          </div>
          <div class="content">
          <div class="row">
          <div class="col-sm-12 col-md-12">
                            <div class="block-flat">
                                <div class="header">							
                                    <h3>Walk In Lab Registration</h3>
                                </div>
                                <div class="content">

                                
                                <form role="form" class="form-horizontal group-border-dashed" action="db_tasks/add_inves.php" method="post"> 
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Fullname : </label>
                                            <div class="col-sm-6">
                                                <input required autocomplete="off" type="text" name="fullname" class="form-control" placeholder="First name" value="">
                                            </div>
                                        </div>  
 
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Gender : </label>
                                            <div class="col-sm-6">
                                                <select required class="form-control" name="sex">
 
                                                <option selected="true" disabled="disabled" value=""> SELECT GENDER </option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                        </div>    

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Age: </label>
                                            <div class="col-sm-6">
                                                <table>
                                                    <tr> 
                                                        <td>
                                                        <input required autocomplete="off" type="number" name="dob"  class="form-control" placeholder="Eg. 30" value="" >
                                                        </td>

                                                    <td>
                                                    <select required class="form-control" name="y_d">
 
 <option selected="true" disabled="disabled" value=""> SELECT (YEARS/DAYS) </option>
     <option value="YEARS">YEAR(S)</option>
     <option value="DAYS">DAY(S)</option>
 </select>
                                                    </td>

                                                    </tr>
                                                    

                                                </table>            
                                           

                                            <!-- <label style="color:red;font:small"><i>NB. System caputre age in years only, we advised expert to convert input to age if patient is (x) number of days old</i></label> -->
                                                   
                                            </div>
                                        </div>

 

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Phone/Contact : </label>
                                            <div class="col-sm-6">
                                                <input autocomplete="off" maxlength="10" type="tel" name="phone" data-mask="phone" class="form-control" placeholder="(999) 999-9999" value="" >
                                            </div>
                                        </div> 

                                        
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Select Test: </label>
                                            <div class="col-sm-6">
                                            <select class="select2" multiple name="investigation[]" >
                                                <optgroup label="Investigation">

                                                        <?php
                                                        list_investigations();
                                                        ?>
                                                </optgroup>
                                                


                                            </select>
                                        </div>
                                        </div> 

                                        
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Source : </label>
                                            <div class="col-sm-6">
                                                <select id="source_lab_test" required class="form-control" name="source_test">
 
                                                <option selected="true" disabled="disabled" value=""> SELECT SOURCE </option>
                                                    <option value="SELF-TEST">SELF TEST</option>
                                                    <option value="NON-SELF-TEST">NON SELF TEST</option>
                                                </select>
                                            </div>
                                        </div> 


                                        <div style="display:none" class="form-group source_name">
                                            <label class="col-sm-3 control-label">Source Name : </label>
                                            <div class="col-sm-6">
                                                <input autocomplete="off" type="text" name="source_name"  class="form-control" placeholder="" value="" >
                                            </div>
                                        </div> 

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Lab No.: </label>
                                            <div class="col-sm-6">
                                            <input required autocomplete="off" type="text" name="lab_no"  class="form-control" placeholder="" value="" >
                                                   
                                            </div>
                                        </div>




                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Diagnosis : </label>
                                            <div class="col-sm-6">
                                                <textarea required required name="remarks" rows="5" class="form-control"></textarea>
                                            </div>
                                        </div>
                                       


                                        

                                         <div style="text-align: center; margin-top: 10px;"><button onclick='return confirm("Are you sure you want to contitnue with action?")' class="btn btn-primary _update_account" type="submit" name="update_personal_info">Add Lab Details</button></div>
                                   

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
							<li  class="active"><a href="#test_list_nhis" data-toggle="tab">Waiting Walk In List</a></li>
							<!-- <li ><a href="#test_list" data-toggle="tab">Pending Payment</a></li> -->
							<li><a href="#tested_list" data-toggle="tab">Processed Results Today</a></li>
							<li><a href="#schedule_list" data-toggle="tab">Results History</a></li>
              <!-- <li><a href="#pending_patient_test" data-toggle="tab">Lab Request Selection</a></li> -->
						</ul>
						<div class="tab-content">
						   
					 <div id="test_list_nhis" class="tab-pane active cont">

 


                              <h3 class="widget-title">New Added Walk In Lab Requests</h3>
                              <!-- <div style="text-align:right;">
                            <a class="btn btn-success btn-flat md-trigger" data-modal="update_vitals">Add </a>
                            </div>	 -->
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
                          
                          lab_test_single_selection_walk_in();
                         
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
                              //     echo pending_payments();
                                ?>
                                
                              </div>
                              
                        <p></p>
                        </div>
                        <div id="tested_list" class="tab-pane cont ">

 



                              <h3 class="widget-title">Processed Results Today</h3>
                              <div class="row friends-list">
                                  
                                  <?php
                                   echo processed_results_walk_in_today();
                                  ?>
                                
                              </div>
                              
                        <p></p>
                        </div>
                        
                         <div id="schedule_list" class="tab-pane cont ">

 


                              <h3 class="widget-title">Results History - Last 30 days </h3>
                              <div class="row friends-list">
                                  
                                  <?php
                                   echo last_thirty_days_results_walk_in();
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