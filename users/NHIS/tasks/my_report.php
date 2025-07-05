<?php
 require '../../functions/func_cashier.php'; 
    
?>


<div class="row">
				<div class="col-md-12">
					<div class="block-flat">
						<div class="header">							
							<h3>Report</h3>
						</div>
						<div class="content">
							<div class="table-responsive">
								<table class="table table-bordered" id="datatable-icons" >
									<thead>
										<tr>
											<th>Patient Name</th>
											<th>Date Seen</th>
											<th>Amount</th>
											
											
										</tr>
									</thead>
									<tbody>
										
										<?php 
										getAllReport($_SESSION['uid']);
										?>
										
										
																			
										
									
									</tbody>
								</table>							
							</div>
						</div>
					</div>				
				</div>
			</div>