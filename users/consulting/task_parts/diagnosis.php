      
         <form class="form-horizontal group-border-dashed" method="post" name="add_diag[]" action="db_tasks/add_diagnosis.php" style="border-radius: 0px;">
                 <div class="form-group">
             <div class="header">							
            <h3>Select Diagnosis</h3>
            <div class="col-sm-6"></div>
            <div class="col-sm-6"><?php
           
              echo @$_SESSION['diag_err'];
              unset($_SESSION['diag_err']);
              ?></div>
          </div>
          <div class="content">
              <div class="form-group">
                <label class="col-sm-3 control-label">Multi Select</label>
                <div class="col-sm-6">
                  <select class="select2" multiple name="pat_diag[]">
                     <optgroup label="Investigations">
                       <?php
                       //getting list of already existing diagnosis from table
                       get_diag_list();
                       ?>
                     </optgroup>
                
                  </select>
			</div>
			<button class="btn btn-primary" type="submit">Add Diagnosis</button>
			  <a class="btn btn-success btn-flat md-trigger" data-modal="dia_his">Diagnosis History</a> 
                </div>
                </div>
               </div>
            
             
              </form>
              
              
              
              <form role="form"> 
            <div class="form-group">
             <div class="header">							
            <h3>Add New Diagnosis</h3>
          </div>
           </form>
          <div class="content">
              <form class="form-horizontal group-border-dashed" method="post" action="db_tasks/add_new_diagnosis.php" style="border-radius: 0px;">
              <div class="form-group">
                <label class="col-sm-3 control-label">New Diagnosis Addition</label>
                <div class="col-sm-6">
                  <input type="text" name="new_diag" required="true" class="form-control"/>
			</div>
			  <button class="btn btn-info" type="submit" >Add New Diagnosis</button>
                </div>
                </div>
               </div>
            
           
              </form>
             
              <div class="table-responsive">
							<table class="table no-border hover">
								<thead class="no-border">
									<tr>
										
										<th style="width:30%;"><strong>Diagnosis</strong></th>
										
										<th style="width:15%;"><strong>Date</strong></th>
										<th style="width:15%;"><strong>Taken By</strong></th>
										<th style="width:15%;" class="text-center"><strong>Action</strong></th>
									</tr>
								</thead>
								<tbody class="no-border-y">
									
									<?php 
									//calling function to populate diagnosis table
									get_diag(@$_SESSION['patient_id']);
									
									
									?>
									
								</tbody>
							</table>		
							</div>
							
			  <!-- Nifty Modal -->
                <div class="md-modal md-dark custom-width md-effect-9" id="dia_his">
                    <div class="md-content">
                      <div class="modal-header">
                        <h3>Diagnosis History</h3>
                        <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      </div>
                      <div class="modal-body form">
                        <div class="text-center">
                          <?php
                                get_diag_his(@$_SESSION['patient_id']);
                           ?>
                      </div>
                      <div class="modal-footer">
                       
                        <button type="button" class="btn btn-primary btn-flat md-close" data-dismiss="modal">OK</button>
                      </div>
                    </div>
                </div>
                </div>
						
					