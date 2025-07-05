<body>

<div class="row">
				<div class="col-md-8" style="margin-top:50px;">
					<div class="block-flat">
						<div class="header">							
							<h3>All patients Claims</h3>
						</div>
						<div class="content">
							<div class="table-responsive">
								<table class="table table-bordered" id="datatable" >
									<thead>
										<tr>
											<th width='40%'>Date</th>
											<th width='30%'>State</th>
											<th width='25%'>Action</th>
											
										</tr>
									</thead>
									<tbody>
									<?php getAllPatientsClaims($_SESSION['pid_4previous']);
	                                    ?>	
										
									</tbody>
								</table>							
							</div>
						</div>
					</div>				
				</div>
			</div>
			