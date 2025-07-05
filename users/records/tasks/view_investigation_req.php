<body>

    <div class="container-fluid" id="pcont">
        <div class="page-head">
            <h2>Patient Investigation Request</h2>
            <ol class="breadcrumb">
                <li><a href="#">Request Details</a></li>

                <li class="active">View</li>
            </ol>
 
        </div>
        <div class="cl-mcont">

        <div class="row">
      <div class="col-md-12">
      
        <div class="block-flat">
          <div class="header">                          
            <h3>Detials Of Investigation Request</h3>
          </div>
    <div class="content">
            
			<div class="content">
				<div class="table-responsive">
                
				<table id='audit_trail_tbl' class="table no-border hover">
					<thead class="no-border">
						<tr>
							
							<th style="width:15%;"><strong>Patient ID</strong></th>							
							<th style="width:30%;"><strong>Fullname</strong></th>
							<th style="width:15%;"><strong>Requested Dr.</strong></th>
                            <th style="width:30%;"><strong>Lab Request(s)</strong></th>
                            <th style="width:30%;"><strong>Amount (GHS)</strong></th>
						</tr>
					</thead>
					<tbody class="no-border-y">					
							<?php

              if(isset($_SESSION['request_code'])&& !empty($_SESSION['request_code'])){
                patient_investigation_details_view($_SESSION['request_code'],$_SESSION['patient_id']);
              }


						


							?>					
					</tbody>  
				</table>	
     
				</div>
			</div>
			
			
    </div>
        </div>
        
    </div>

</div>




