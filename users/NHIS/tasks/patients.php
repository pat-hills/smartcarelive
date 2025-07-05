<body>

<div class="row">
				<div class="col-md-8" style="margin-top:50px;">
					<div class="block-flat">
						<div class="header">							
							<h3>Patients</h3>
						</div>
						<div class="content">
							<div class="table-responsive">
								<table class="table table-bordered" id="datatable" >
									<thead>
										<tr>
										<th width='40%'>Photo</th>
											<th width='40%'>Name</th>
											<th width='20%'>Membership ID</th>
											<th width='10%'>Action</th>
											
										</tr>
									</thead>
									<tbody>
										<?php getAllpatientstoClaim(); ?>
										
									</tbody>
								</table>							
							</div>
						</div>
					</div>				
				</div>
			</div>
			
			  		
				
				<div class="modal fade" id="mod-patient" tabindex="-1" role="dialog">
								<div class="modal-dialog">
								  <div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									</div>
									<div class="modal-body">
										
										<div class="patientstheModels"></div>
										
									</div>
									<div class="modal-footer">
									  <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
		<a href="previous_histroy.php" style="float:left;" type="button" class="btn btn-default mike">previous history</a>

	
	
</div>
								  </div><!-- /.modal-content -->
								</div><!-- /.modal-dialog -->
 </div><!-- /.modal -->

				
				
				
				
				

			
		