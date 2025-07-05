<?php
//session_start();
 //require '../../functions/func_cashier.php'; 
    
?>


<div class="row">
				<div class="col-md-12">
					<div class="block-flat">
						<div class="header">							
							<h3>Viewed Pending Payment</h3>
						</div>
						<div class="content">
							<div class="table-responsive">
								<table class="table table-bordered" id="getReportPendingInvestigationList" >
									<thead>
										<tr>
											<th>Patient Name</th>
											<th>Date Seen</th>
											 
											<th>Investigations</th>
											<th>Action</th>
											
											
										</tr>
									</thead>
									<tbody>
										
										<?php 
						 		
										
						 
						getReportPendingInvestigationList();

						 
										?>
										
										
																			
										
									
									</tbody>
								</table>							
							</div>
								
						</div>
						
						 

		 
							
					</div>				
				</div>
			</div>
			
			
			
			
			
			
			