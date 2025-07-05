<div class="header">							
            <h3>Type Below</h3>
            <div class="col-sm-6"></div>
            <div class="col-sm-6"><?php
              echo @$_SESSION['comp_err'];
              unset($_SESSION['comp_err']);
              ?></div>
          </div>

          <div class="content">

          <form role="form" method="post" action="db_tasks/add_comp.php"> 
            <div class="form-group">
             <textarea cols="80" rows="3" name="complain" required='true'></textarea>
             <button class="btn btn-primary" type="submit">Add Complain</button>
             <a class="btn btn-success btn-flat md-trigger" data-modal="comp_his">Complains History</a> 

                </form>
             <div class="header">							
							<h3>Complains List</h3>
						</div>
						<div class="content">
							<div class="table-responsive">
							<table class="table no-border hover">
								<thead class="no-border">
									<tr>
										
										<th style="width:30%;"><strong>Complain</strong></th>
										
										<th style="width:15%;"><strong>Date</strong></th>
										<th style="width:15%;"><strong>Taken By</strong></th>
										<th style="width:15%;" class="text-center"><strong>Undo</strong></th>
									</tr>
								</thead>
								<tbody class="no-border-y">
									
										<?php
												get_comp(@$_SESSION['patient_id']);
										?>
										
									
									
									
								</tbody>
							</table>		
							</div>
						</div>
            </div>
     
          </div>
          
					  <!-- Nifty Modal -->
                <div class="md-modal md-dark custom-width md-effect-9" id="comp_his">
                    <div class="md-content">
                      <div class="modal-header">
                        <h3>Complains History</h3>
                        <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      </div>
                      <div class="modal-body form">
                        <div class="text-center">
                          <?php
                                get_complains_history(@$_SESSION['patient_id']);
                           ?>
                      </div>
                      <div class="modal-footer">
                       
                        <button type="button" class="btn btn-primary btn-flat md-close" data-dismiss="modal">OK</button>
                      </div>
                    </div>
                </div>
                </div>