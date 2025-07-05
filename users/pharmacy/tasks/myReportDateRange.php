<body>

  

	
<div class="col-sm-12 col-md-12">
        <div class="block-flat">
          <div class="header">							
            <h3>Date Range Report</h3>
          </div>
          <div class="content">
		  <form class="form-horizontal group-border-dashed" data-parsley-validate="" novalidate=""  style="border-radius: 0px;" method="post">
		  <p>Please select the type of report duration</p>
  <div class="row">
    <div id="dateSelection" style="">
                                 
              
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">(Start) From : </label>
                                        <div class="col-sm-3">

                                            <div class="input-group date datetime " data-min-view="2" data-date-format="yyyy-mm-dd">
                                                <input type="text" name="startDate" id="startDate" class="form-control" size="16"  readonly="" >
                                                <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                                            </div>    
                                        </div>
                                    </div>

                      </div>
  </div>

      <div class="row">
                   <div id="dateSelection2" style="">
                                 
              
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">(End) To : </label>
                                        <div class="col-sm-3">

                                            <div class="input-group date datetime " data-min-view="2" data-date-format="yyyy-mm-dd">
                                                <input type="text" name="endDate" id="endDate" class="form-control" size="16"  readonly="" >
                                                <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                                            </div>    
                                        </div>
                                    </div>

                      </div>
         </div>
		 <div id="showButton" style="margin-left: 414px;"><button class="btn btn-primary"  name="load_records">Load Records</button></div>       
		 </form>		 
		 
		 <div class="row">
				<div class="col-md-12">
					<div class="block-flat">
						<div class="header">							
							<!-- <h3>Dispensaries Today</h3> -->
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
											<th>Date </th>
											
										</tr>
									</thead>
									<tbody>
										<?php 

if( isset($_POST['load_records'])) {
          
	$startDate = "";
	$endDate = "";
	$today = date('Y-m-d'); 
 
	$startDate = $_POST['startDate'];

	// if(empty($startDate)){
	//   $startDate = $today;
	// }

	$endDate = $_POST['endDate'];

	$_SESSION['startDate'] = $startDate;
	$_SESSION['endDate'] = $endDate; 
	//$_SESSION['reportType'] = $_POST['reportType'];
	getAllPharmWorkDown($startDate,$endDate); 
										
}

									
										
										
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
     