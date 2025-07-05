       <form role="form" method="post" action="db_tasks/add_prescribe.php"> 
            <div class="form-group">
             <div class="header">							
            <?php
            
            echo @$_SESSION['presc_err'];
			unset ($_SESSION['presc_err']);
            ?>
          </div>
          <div class="content">
              <form class="form-horizontal group-border-dashed" action="#" style="border-radius: 0px;">
              <div class="form-group">
                <label class="col-sm-3 control-label">Intelli Select</label>
                <div class="col-sm-6">
                  <select class="select2" name="drug">
                     <optgroup label="NHIS">
                      <?php
                      require_once '../../functions/func_consulting.php';
                      $nhis=1;
                      get_drugs($nhis);
                      ?>
                       
                     </optgroup>
                     <optgroup label="NON NHIS">
                     	<?php
                     	$non_nhis=0;
                      get_drugs($non_nhis);
                       ?>
                     </optgroup>
                    
                  </select>
			             </div>
                </div>
               </div>
            
             <button class="btn btn-primary" type="submit">Add Prescribtion</button>
          <a class="btn btn-success btn-flat md-trigger" data-modal="form-green">Drug History</a> 
           Dosage <input type="text" name="dosage" class="form-group" />
            
            X times <input type="number" name="times" class="form-group" />
             Every <input type="text" name="rate" class="form-group" placeholder="number required" /> 
              Time <select name="time">
             		<option>Second</option>
             		<option>Minute</option>
             		<option>Hour</option>
             		<option>Day</option>
             		<option>Months</option>
             		<option>Years</option>
             		
                 </select>
              </form>
              
              <div class="table-responsive">
							<table class="table no-border hover">
								<thead class="no-border">
									<tr>
										
										<th style="width:20%;"><strong>Drug</strong></th>
										
										<th style="width:15%;"><strong>Dosage</strong></th>
										
										
										<th style="width:15%;"><strong>Prescribed By</strong></th>
										<th style="width:15%;" class="text-center"><strong>Action</strong></th>
									</tr>
								</thead>
								<tbody class="no-border-y">
									
									<?php
										$current_date=date('Y/m/d');
										
										get_prescribtion(@$_SESSION['patient_id'], $current_date);
									?>
									
								</tbody>
							</table>		
							</div>
						
            
					  <!-- Nifty Modal -->
                <div class="md-modal md-dark custom-width md-effect-9" id="form-green">
                    <div class="md-content">
                      <div class="modal-header">
                        <h3>Drug History</h3>
                        <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      </div>
                      <div class="modal-body form">
                        <div class="text-center">
                          <?php
                                get_prescribtion_history(@$_SESSION['patient_id']);
                           ?>
                      </div>
                      <div class="modal-footer">
                       
                        <button type="button" class="btn btn-primary btn-flat md-close" data-dismiss="modal">OK</button>
                      </div>
                    </div>
                </div>
                </div>