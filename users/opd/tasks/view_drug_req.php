<body>

    <div class="container-fluid" id="pcont">
        <div class="page-head">
            <h2>Drugs Prescriptions</h2>
            <ol class="breadcrumb">
                <li><a href="#">Drug Details</a></li>

                <li class="active">View</li>
            </ol>
 
        </div>
        <div class="cl-mcont">

        <div class="row">
      <div class="col-md-12">
      
        <div class="block-flat">
          <div class="header">                          
            <h3>Drugs Prescriptions</h3>
          </div>
    <div class="content">
            
			<div class="content">
				<div class="table-responsive">
                
				<table id='audit_trail_tbl' class="table no-border hover">
					<thead class="no-border">
						<tr>
							
							<th style=""><strong>Patient ID</strong></th>							
							<th style=""><strong>Fullname</strong></th>
							<th style=""><strong>Requested Dr.</strong></th>
           <th style=""><strong>Drug name</strong></th>
           <th style=""><strong>Dosage</strong></th>
           
                            
						</tr>
					</thead>
					<tbody class="no-border-y">					
							<?php

              if(isset($_SESSION['patient_id'])&& !empty($_SESSION['patient_id'])){
                patient_drugs_details_view($_SESSION['patient_id']);
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




