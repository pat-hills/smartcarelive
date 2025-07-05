<body>
<?php 
    //require '../functions/conndb.php';
    //require '../../functions/func_common.php';
    //require '../functions/func_admin.php';
?>
<div class="container-fluid" id="pcont">
    <div class="page-head">
      <h2>Records</h2>
      <ol class="breadcrumb">
        <li><a href="index.php">Home</a></li>
       
        <li class="active">Records - List Patients </li>
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
								<table class="table table-bordered" id="datatable" >
									<thead>
										<tr>
											<th>Patient ID </th>
											<th>Fullname</th>
											<th>Phone</th>
											<th>Address</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
											
                      						$patients = patients_list();
											
										?>
									</tbody>
								</table>							
							</div>
						</div>
                    </div>              
                </div>
            </div>  
    </div>