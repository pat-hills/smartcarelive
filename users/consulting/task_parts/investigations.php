      
            <div class="form-group">
             <div class="header">	
              <div class="col-sm-6"></div>
            <div class="col-sm-6"><?php
           
              echo @$_SESSION['inves_err'];
              unset($_SESSION['inves_err']);
              ?></div>
          </div>	
            
          
          <div class="content">
              <form class="form-horizontal group-border-dashed" action="db_tasks/add_inves.php" method="post" style="border-radius: 0px;">
              <div class="form-group">
                <label class="col-sm-3 control-label">Select Multiple</label>
                <div class="col-sm-6">
                  <select class="select2" multiple name="investigation[]" >
                     <optgroup label="Category">
                       
                       <?php
                       get_inves_list();
                       ?>
                     </optgroup>
                     <optgroup label="Blood">
                       <option value="CA">HIV</option>
                       <option value="NV">Sickle Cell</option>
                       
                     </optgroup>
                     <optgroup label="Eye">
                       <option value="AZ">Focus</option>
                       <option value="CO">Redness</option>
                      
                     </optgroup>
                                
                    
                  </select>
			</div>
			
                </div>
                 <div class="form-group">
                <label class="col-sm-3 control-label">Remarks</label>
                <div class="col-sm-6">
                  <div class="input-group input-group-lg">
                    
                    <textarea required="true" name="remarks" class="form-control" cols="60" rows="" placeholder="Remarks"></textarea>
                   
                  </div>
			</div>
			
                </div>
                  <button class="btn btn-primary" type="submit">Request Investigation</button>
                   <a class="btn btn-success btn-flat md-trigger" data-modal="inves_his">Investigation History</a> 
                 </form>
               </div>
            
           
            
            
              
              <div class="table-responsive">
							<table class="table no-border hover">
								<thead class="no-border">
									<tr>
										
										<th style="width:30%;"><strong>Investigation</strong></th>
										
										<th style="width:15%;"><strong>Date</strong></th>
										<th style="width:15%;"><strong>Requested By</strong></th>
										<th style="width:15%;" class="text-center"><strong>Undo</strong></th>
									</tr>
								</thead>
								<tbody class="no-border-y">
									<?php
									
									get_inves(@$_SESSION['patient_id']);
									
									?>
									
									
								</tbody>
							</table>		
							</div>


            <!-- Nifty Modal -->
                <div class="md-modal md-dark custom-width md-effect-9" id="inves_his">
                    <div class="md-content">
                      <div class="modal-header">
                        <h3>Investigation History</h3>
                        <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      </div>
                      <div class="modal-body form">
                        <div class="text-center">
                          <?php
                                get_inves_his(@$_SESSION['patient_id']);
                           ?>
                      </div>
                      <div class="modal-footer">
                       
                        <button type="button" class="btn btn-primary btn-flat md-close" data-dismiss="modal">OK</button>
                      </div>
                    </div>
                </div>
                </div>
						
					