<?php
//session_start();
 //require '../../functions/func_cashier.php'; 
    
?>


<div class="row">
				<div class="col-md-12">
					<div class="block-flat">
						<div class="header">							
							<h3>Today's Report</h3>
						</div>
						<div class="content">
							<div class="table-responsive">
								<table class="table table-bordered" id="datatable-icons" >
									<thead>
										<tr>
											<th>Patient Name</th>
											<th>Date Seen</th>
											 
											<th>Amount (&#x20B5)</th>
											<th>Type/Item</th>
											
											
										</tr>
									</thead>
									<tbody>
										
										<?php 
						if(isset($_POST['duration'])){
						$duration = $_POST['duration'];
						}else{
						$duration = 1;//default duration is today
						}				
										
						getReportDailyConsultationList();

						getReportDailyInvestigationList();

						getReportDailyDrugDispenseList();
										?>
										
										
																			
										
									
									</tbody>
								</table>							
							</div>
								
						</div>
						
						<div class="content blue-chart" style="width:15%;color:ffffff;">
						<div class="stat-data" >
								<div class="stat-blue">
									<span>Total Received</span>
									<h2>&#x20B5;&nbsp;<?php  
									
									
									
									$cashiersTotal = 0; 
									$period_amountConsultation = load_sum_consultation_report("Daily","","");
									$period_amountInvestigation = load_sum_laboratory_report("Daily","","");
									$period_amount_Medication = load_sum_drugs_report("Daily","","");

									$cashiersTotal = $period_amountConsultation + $period_amountInvestigation +$period_amount_Medication;

									$cashiersTotal = number_format($cashiersTotal,2);
									echo $cashiersTotal;
									
									
									?></h2>
								</div>
					   </div>
						</div>

			<!-- <form action="" method="post">			
						<div class="col-sm-6" style="float:right;margin-top:-100px;">
			<div class="form-group">
                <label class="col-sm-3 control-label">Select a period</label>
                <div class="col-sm-6">
                  <select class="form-control" name="duration">
                    <option value="">Select</option>
                    <option value="1">Week</option>
                    <option value="2">Month</option>
                    <option value="3">Year</option>
                    <option value="4">Today</option>
                  </select>									
                </div>
            </div>
			<input class="btn btn-primary" type="submit" value="Get Report" name="submit">
					</div>
		   </form>				 -->
						
							
					</div>				
				</div>
			</div>
			
			
			
			
			
			
			