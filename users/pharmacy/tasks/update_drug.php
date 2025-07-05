<body>
<?php

    include_once '../../functions/func_records.php';
              include_once '../../functions/func_pharmacy.php';
             include_once '../../functions/conndb.php';
              include_once '../../functions/func_search.php';
             
?>



  <div class="container-fluid" id="pcont">
    <div class="page-head">
      <h2>Manage Drugs</h2>
      <ol class="breadcrumb">
        <li><a href="#">Tasks</a></li>
       
        <li class="active">Manage drugs</li>
      </ol>
    </div>
    <div class="cl-mcont">
       
    <div class="row">
      
<?php

echo @$_SESSION['add_drug'];
unset($_SESSION['add_drug']);


 ?>
 
 
 	<div class="row">
				<div class="col-md-12">
					<div class="block-flat">
						<div class="header">							
							<h3>Manage Drugs</h3>
						</div>
						<div class="content">
							<div class="table-responsive">
								<table class="table table-bordered" id="drug_table_records" >
									<thead>
										<tr>
											<th>Name</th>
											<th>Quantity</th>
											<th>Reorder</th>
											<th>Price(GHC)</th> 
											<th>Expire Date</th> 
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php getAllavailableDrugs(); ?>
										
									</tbody>
								</table>							
							</div>
						</div>
					</div>				
				</div>
			</div>	
 
 
 
 
 
 
 
 
 
 
 
 
 
 