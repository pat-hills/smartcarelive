<body>

  

	
<div class="col-sm-12 col-md-12">
        <div class="block-flat">
          <div class="header">							
            <h3>My Report</h3>
          </div>
          <div class="content">

          
		  <div class="row">
				<div class="col-md-12">
					<div class="block-flat">
						<div class="header">							
							<h3>Dispensaries Today</h3>
						</div>
						<div class="content">
							<div class="table-responsive">
								<table class="table table-bordered" id="datatable" >
									<thead>
										<tr>
										<th>Patient ID</th>
											<th>Patient Name</th>
										
											
											<th>Drug Served</th>

											<th>Dosage</th>
											<th>Comment</th>

											<th>Date</th>
											
										</tr>
									</thead>
									<tbody>
										<?php 
										$startDate = "";
										$endDate = "";
										
										getAllPharmWorkDown($startDate,$endDate); 
										
										?>
										
										
										
									</tbody>
								</table>							
							</div>
						</div>
					</div>				
				</div>
			</div>
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
     </div></div></div>


      </div>
      
     
</div></div>
     