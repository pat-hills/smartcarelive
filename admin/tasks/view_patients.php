<body>
<?php 
    //require '../functions/conndb.php';
    //require '../../functions/func_common.php';
    //require '../functions/func_admin.php';
?>
<div class="container-fluid" id="pcont">
    <div class="page-head">
      <h2>Admin</h2>
      <ol class="breadcrumb">
        <li><a href="index.php">Home</a></li>
       
        <li class="active">Admin - View Patients </li>
      </ol>
    </div>
    <div class="cl-mcont"> 
        <div class="row">
                <div class="col-md-12">
                    <div class="block-flat">
                        <div class="header">                            
                            <h3>Patients List</h3>
                        </div>
                        <div class="content">
							<div class="table-responsive">
								<table class="table table-bordered" id="patientsData" >
									<thead>
										<tr>
											<th>Patient ID</th>
											<th>Last name</th>
											<th>Position</th>
											<th>Office</th>
											<th>Start date</th>
											<th>Salary</th>
										</tr>
									</thead>

									<tfoot>
										<tr>
											<th>First name</th>
											<th>Last name</th>
											<th>Position</th>
											<th>Office</th>
											<th>Start date</th>
											<th>Salary</th>
										</tr>
									</tfoot>
								</table>							
							</div>
						</div>
                    </div>              
                </div>
            </div>  
    </div>