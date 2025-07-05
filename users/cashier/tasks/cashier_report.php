<body>

  <div class="container-fluid" id="pcont">
    <div class="page-head">
     <h2>Revenue Report</h2>
        <ol class="breadcrumb">
          <li><a href="index">Home </a></li>
          <li class="active"><a href="#">Revenue</a></li>
          
        </ol>
    </div>
     
    
    <div class="cl-mcont">
       
    <div class="row">
      <div class="col-md-12">
      
          <!--Fields to be updated here-->

          <div class="cl-mcont">
  
      
      

        <div class="row">
				<div class="col-md-12">
					<div class="block-flat">
						<div class="header">							
							<h3 style="text-align: center">
                  
              </h3>
		</div>
						<div class="content">
							 <div class="tab-container tab-left">


                             <?php 
               
               set_tabs_reporting_cashier_users(@$_SESSION['current_active_tab']);
               ?>              
            <ul class="nav nav-tabs flat-tabs">
              <li tooltip="Defined Period Options" class="<?php echo @$_SESSION['period'] ?>"><a title="Defined Period Options" href="#period" data-toggle="tab">Defined Period Options</a></li>
              <li class="<?php echo @$_SESSION['range'] ?>"><a title="Date Range Options" href="#range" data-toggle="tab">Date Range Options</a></li> 
            </ul>
            <div class="tab-content">
              <div class="tab-pane cont fade <?php echo @$_SESSION['period']; ?>  in" id="period">
                    <div class="header">              
                      <h3>Defined Period Option</h3>
                    </div>
                    <div class="content">

                    <form class="form-horizontal group-border-dashed" method="post" action="db_tasks/process_print_search" style="border-radius: 0px;">
                            
                            <div class="col-sm-12">
                                <div class="form-group">

                               
                                   
                                    <div class="col-sm-12" style="">

                                     
                                    <div style="margin-left:-240px" class="form-group">
                                        <label class="col-sm-3 control-label">Period </label>
                                        <div class="col-sm-6">
                                        <select required name="period_report" required="" class="form-control" style="">

                                        <option>--------------------</option>
                                         <option name="Yesterday">Yesterday</option>
                                            <option name="Today">Today</option>	
                                            <option name="This-Week">One Week Ago(7 days)</option>
                                            <option name="This-Month">Last Month (30 days)</option>
                                            
                                        </select>
                                        </div>

                                    </div>

                                    <div style="margin-left:-240px" class="form-group">
                                        <label class="col-sm-3 control-label">Category </label>
                                        <div class="col-sm-6">
                                        <select required name="category" required="" class="form-control" style="">

                                        <option>--------------------</option>
                                         <option name="Consultation">Consultation</option>
                                            <option name="Drugs">Drugs</option>	
                                            <option name="Investigation">Investigation</option>

                                            <option name="All">All</option>
                                           
                                            
                                        </select>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                    <label class="col-sm-3 control-label"></label>
                                        <div class="col-sm-6">
                                        <button name="Defined_Period_Options" class="btn btn-primary" type="submit">Submit Search</button>
                                        </div>
 

                                    </div>

                                    
                                       
                                    </div>
                                </div> 
                                </div>
                                 </form>



                                 

                        <?php 

                       
                        
                        if (!empty(	$_SESSION['count_payment_consult_rows']) && isset($_SESSION['count_payment_consult_rows']) 
                        && ($_SESSION['count_payment_consult_rows'] > 0) && isset($_SESSION['count_payment_investigation_rows']) && isset( $_SESSION['count_payment_drug_consult_rows'])) { ?>


                          <div class="block-flat profile-info">
                      <h4>
                        Number of Records Found : <?php
                     
                        
                        echo 	$_SESSION['count_payment_consult_rows'] + $_SESSION['count_payment_investigation_rows'] +  $_SESSION['count_payment_drug_consult_rows']; 
                        
                        
                        ?>
                      </h4>  
                                  
                                        <div >
                                        <a target="_blank" href="../../users/cashier/reporting/period_report" class="btn btn-primary" type="submit">Generate Search Report</a>
                                        </div>
 

                  </div>
             
         
                <?php }elseif(isset($_SESSION['count_payment_consult_rows']) && $_SESSION['count_payment_consult_rows']==0) { ?>
                         
                  <div class="block-flat profile-info">
                      <h4>
                        Number of Records Found : <?php
                     
                        
                        echo 	$_SESSION['count_payment_consult_rows']; 
                        
                        
                        ?>
                      </h4>  
                 

                  </div>
                      
                   <?php } ?>
                    

                    



                    </div>
                    
               
              </div>
              <div class="tab-pane <?php echo @$_SESSION['range']; ?>  cont" id="range">
                    <div class="header">              
                      <h3>Date Range Option</h3>
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
                                            <input type="text" name="start_date_cash" readonly="" class="form-control" size="16"   >
                                            <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                                        </div>  
                                        </div>

                                    </div>

                                    <div style="margin-left:-240px" class="form-group">
                                        <label class="col-sm-3 control-label">End Date</label>
                                        <div class="col-sm-6">
                                        <div class="input-group date datetime "  data-min-view="2" data-date-format="yyyy-mm-dd">
                                            <input type="text" name="end_date_cash" readonly="" class="form-control" size="16"   >
                                            <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                                        </div>  
                                        </div>

                                    </div>

                                     
 

                                    <div class="form-group">
                                    <label class="col-sm-3 control-label"></label>
                                        <div class="col-sm-6">
                                        <button name="Date_Range_Option" class="btn btn-primary" type="submit">Submit Search</button>
                                        </div>
 

                                    </div>

                                    
                                       
                                    </div>
                                </div> 
                                </div>
                                 </form>   



                                 

                                 <?php 

                       
                        
if (!empty(	$_SESSION['count_payment_range_consult_rows']) && isset($_SESSION['count_payment_range_consult_rows']) && ($_SESSION['count_payment_range_consult_rows'] > 0)
 && isset($_SESSION['count_payment_range_inv_consult_rows']) && isset($_SESSION['count_payment_range_drg_consult_rows']))

{ ?>


  <div class="block-flat profile-info">
<h4>
Number of Records Found : <?php


echo 	$_SESSION['count_payment_range_consult_rows'] + $_SESSION['count_payment_range_inv_consult_rows'] + $_SESSION['count_payment_range_drg_consult_rows']; 


?>
</h4>  
          
                <div >
                <a target="_blank" href="../../users/cashier/reporting/range_report" class="btn btn-primary" type="submit">Generate Search Report</a>
                </div>


</div>


<?php }elseif(isset($_SESSION['count_payment_range_consult_rows']) && $_SESSION['count_payment_range_consult_rows']==0) { ?>
 
<div class="block-flat profile-info">
<h4>
Number of Records Found : <?php


echo 	$_SESSION['count_payment_range_consult_rows']; 


?>
</h4>  


</div>

<?php } ?>








                    </div>
              </div>

               
             
              <!-- <div class="tab-pane fade" id="prescriptions">
                    <div class="header">              
                      <h3>Prescriptions</h3>
                    </div>
                    <div class="content">

                    
                   
                    </div>
              </div> -->



            </div>
          </div>
						</div>
					</div>				
				</div>
			</div>
			
     
                 		
  
