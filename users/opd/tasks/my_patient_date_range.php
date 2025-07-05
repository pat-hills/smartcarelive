<body>

    <div class="container-fluid" id="pcont">
        <div class="page-head">
            <h2>Patients Date Selection Report 
              
            <?php if (isset($_SESSION['successMsg'])) { ?>
            <div  style="margin-top: 10px; margin-bottom: -30px; text-align: center;">
                <div class="alert alert-success alert-white rounded">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <div class="icon"><i class="fa fa-times-circle"></i></div>
                    <strong>Success!</strong> <?php echo $_SESSION['successMsg'] ?>
                </div>     
            </div>
            <?php
            unset($_SESSION['successMsg']);
        } else if (isset($_SESSION['errorMsg'])) {
            ?>
            <div  style="margin-top: 10px; margin-bottom: -30px; text-align: center;">
                <div class="alert alert-success alert-white rounded">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <div class="icon"><i class="fa fa-times-circle"></i></div>
                    <strong>Error!</strong>  <?php echo $_SESSION['errorMsg'] ?>
                </div>     
            </div>
            <?php
            unset($_SESSION['errorMsg']);
        }
        ?>

            </h2>
            <ol class="breadcrumb">
                <li><a href="#">Patients Date Selection Report</a></li>

                <li class="active">View</li>
            </ol>
 
        </div>
        <div class="cl-mcont">

        <div class="row">
      <div class="col-md-12">
   
      
        <div class="block-flat">
          <div class="header">                          
            <h3>Patients List On Date Selection </h3>
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
            
			<div class="content">
				<div class="table-responsive">
                
				<table id='get_all_patients_opd' class="table no-border hover">
					<thead class="no-border">
						<tr>
							
							<th style="width:10%;"><strong>Patient ID</strong></th>							
							<th style="width:10%;"><strong> Name</strong></th>
                            <th style="width:20%;"><strong>Vitats</strong></th>
							<th style="width:15%;"><strong>Date</strong></th>
						</tr>
					</thead>
					<tbody class="no-border-y">					
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
	getMyPatientHistory($startDate,$endDate); 
										
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




