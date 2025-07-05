<body>
<?php 
    require '../../functions/conndb.php';
     require '../../functions/func_common.php';
    @session_start(); 
?>
<div class="container-fluid" id="pcont">
    <div class="page-head">
      <h2>Laboratory</h2>
      <ol class="breadcrumb">
        <li><a href="index.php">Home</a></li>
       
        <li class="active">Laboratory test</li>
      </ol>
    </div>
    <div class="cl-mcont"> 
	<div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="block-flat">
          <div class="header">							
            <h3>Multiple Search Area</h3>
          </div>
          <div class="content">
             <form class="form-horizontal group-border-dashed" method="post" action="tasks/set_patient_details.php" style="border-radius: 0px;" autocomplete="off">
              <div class="form-group">
                <div class="col-sm-2"></div>
                <label class="col-sm-3 control-label">Patient (ID/SURNAME/NATIONAL ID/NHIS)</label>
               
                <div class="col-sm-3">
                  <select class="select2" name="get_details">
                    <option value="">.. search here ..</option>
                     <optgroup label="ID">
                       <?php
                       //getting all patients ID in option field labelled ID
                          //  get_all_id();
                       ?>
                     </optgroup>
                     <optgroup label="NATIONAL ID">
                       <?php
                       //getting all national ID in option field labelled National ID
                         //   get_all_nid();
                       ?>
                     </optgroup>
                     <optgroup label="NHIS ID">
                      <?php
                       //getting all national health insurance ID in option field labelled NHIS
                          //  get_all_NHIS();
                       ?>
                     </optgroup>
                     
                  </select>

                </div>
                 <button type="submit" class="btn btn-primary btn-rad"><i class="fa fa-search"></i> Get Details</button>
              </div>
            
            </form>
          </div>
        </div>
        

      
      <div class="tab-container">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#test_request" data-toggle="tab">Test Request</a></li>
							<li><a href="#biochemistry" data-toggle="tab">Biochemistry</a></li>
							<li><a href="#heamatology" data-toggle="tab">Heamatology</a></li>
							<li><a href="#widal" data-toggle="tab">Widal Test</a></li>
							<li><a href="#parasitology" data-toggle="tab">Parasitology</a></li>
							<li><a href="#scan" data-toggle="tab"> Scan/X-Ray Report</a></li>
						</ul>
						<div class="tab-content">
						  <div class="tab-pane active cont" id="test_request">
								<h3 class="hthin">Test Request</h3>
								<div class="block-flat profile-info">
									<div class="row">
									<fieldset>
										<legend>Patient's Info</legend>
										<div class="col-sm-2">
										  <div class="avatar">
											<img src="images/av.jpg" class="profile-avatar">
										  </div>
										</div>
										<div class="col-sm-4">
										   <table class="no-border no-strip skills">
											<tbody class="no-border-x no-border-y">
											  <tr><td><b>Patient ID:</b></td><td><?php echo @$_SESSION['patient_id']; ?></td></tr>
                                              <tr><td><b>Full Name:</b></td><td><?php echo @$_SESSION['surname']." ".@$_SESSION['other_names']; ?> </td></tr>
                                              <tr><td><b>Occupation</b></td><td><?php echo @$_SESSION['occupation']; ?></td></tr>
                                              <tr><td><b>Sex</b></td><td><?php echo @$_SESSION['sex']; ?></td></tr>
                                              <tr><td><b>Age</b></td><td><?php echo @$_SESSION['sex']; ?></td></tr>
											</tbody>
										  </table>
										</div>
									</fieldset>	
									<div style="margin-bottom: 20px;"></div>
									</div>
									
									<div class="row">
									<fieldset>
									
										<legend>Requesting Doctor</legend>
										<div class="col-sm-2">
										  <div class="avatar">
											<img src="images/av.jpg" class="profile-avatar">
										  </div>
										</div>
										<div class="col-sm-4">
										   <table class="no-border no-strip skills">
											<tbody class="no-border-x no-border-y">
											  <tr><td><b>Doctor's Name: </b></td><td>doctor's name</td></tr>
                                              <tr><td><b>Requested Test: </b></td><td>requested test</td></tr>
                                              <tr><td><b>Remarks: </b></td><td>remarks</td></tr>
                                              <tr><td><b>Date Requested: </b></td><td>remarks</td></tr>
											</tbody>
										  </table>
										</div>
									</fieldset>		
									</div>
								</div>
								<p>
									<?php
									//calling patient info from task_parts folder
									
									
									?>
								</p>
						  </div>
						  <div class="tab-pane cont" id="biochemistry">
								<h3 class="hthin">Biochemistry</h3>
								<div class="row">
                    
                                    <div class="panel-group accordion" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                              <h4 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                    <i class="fa fa-angle-right"></i> <span style="font-size: 20px;">Reference Ranges</span>
                                                </a>
                                              </h4>
                                            </div>
                                            <div style="height: 0px;" id="collapseOne" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                  
                                                    <table>
                                                        <tbody>
                                                            <tr>
                                                                <td> <label>Sodium:</label><input style="width: 180px" type="weight" name="sodium" placeholder="" class="form-control"></td>
                                                                <td> <label>Potasium:</label><input style="width: 180px" type="weight" name="potasium" placeholder="" class="form-control"></td>
                                                                <td> <label>Chloride:</label><input style="width: 180px" type="weight" name="chloride" placeholder="" class="form-control"></td>
                                                                <td> <label>Bicarbonate:</label><input style="width: 180px" type="weight" name="bicarbonateu" placeholder="" class="form-control"></td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td> <label>Urea:</label><input style="width: 180px" type="weight" name="urea" placeholder="" class="form-control"></td>
                                                                <td> <label>Creatinine:</label><input style="width: 180px" type="weight" name="creatinine" placeholder="" class="form-control"></td>
                                                                <td> <label>Uric Acid:</label><input style="width: 180px" type="weight" name="uric_acid" placeholder="" class="form-control"></td>
                                                                <td> <label>Calcium:</label><input style="width: 180px" type="weight" name="calcium" placeholder="" class="form-control"></td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td> <label>Phosphorous:</label><input style="width: 180px" type="weight" name="phosphorous" placeholder="" class="form-control"></td>
                                                                <td> <label>Total Protein:</label><input style="width: 180px" type="weight" name="total_protein" placeholder="" class="form-control"></td>
                                                                <td> <label>Albumin:</label><input style="width: 180px" type="weight" name="albumin" placeholder="" class="form-control"></td>
                                                                
                                                                <button type="button" class="btn btn-default">Default</button>
                                                            </tr>
                                                            
                                                        </tbody>
                                                    </table>
                        
                                                </div>
                                            </div>
                                        </div>
                                     
                                    </div>	<!-- reference ranges ends -->						
                                    
                                    
                                    <div class="panel-group accordion" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                              <h4 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                    <i class="fa fa-angle-right"></i> <span style="font-size: 20px;">Reference Ranges</span>
                                                </a>
                                              </h4>
                                            </div>
                                            <div style="height: 0px;" id="collapseOne" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                  
                                                    <table>
                                                        <tbody>
                                                            <tr>
                                                                <td> <label>Sodium:</label><input style="width: 180px" type="weight" name="sodium" placeholder="" class="form-control"></td>
                                                                <td> <label>Potasium:</label><input style="width: 180px" type="weight" name="potasium" placeholder="" class="form-control"></td>
                                                                <td> <label>Chloride:</label><input style="width: 180px" type="weight" name="chloride" placeholder="" class="form-control"></td>
                                                                <td> <label>Bicarbonate:</label><input style="width: 180px" type="weight" name="bicarbonateu" placeholder="" class="form-control"></td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td> <label>Urea:</label><input style="width: 180px" type="weight" name="urea" placeholder="" class="form-control"></td>
                                                                <td> <label>Creatinine:</label><input style="width: 180px" type="weight" name="creatinine" placeholder="" class="form-control"></td>
                                                                <td> <label>Uric Acid:</label><input style="width: 180px" type="weight" name="uric_acid" placeholder="" class="form-control"></td>
                                                                <td> <label>Calcium:</label><input style="width: 180px" type="weight" name="calcium" placeholder="" class="form-control"></td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td> <label>Phosphorous:</label><input style="width: 180px" type="weight" name="phosphorous" placeholder="" class="form-control"></td>
                                                                <td> <label>Total Protein:</label><input style="width: 180px" type="weight" name="total_protein" placeholder="" class="form-control"></td>
                                                                <td> <label>Albumin:</label><input style="width: 180px" type="weight" name="albumin" placeholder="" class="form-control"></td>
                                                                
                                                                <button type="button" class="btn btn-default">Default</button>
                                                            </tr>
                                                            
                                                        </tbody>
                                                    </table>
                        
                                                </div>
                                            </div>
                                        </div>
                                     
                                    </div>  <!-- reference ranges ends -->                  
                                    	
								</div><!-- row ends -->
								
								
								
								<div style="margin-bottom: 20px;"></div>
								<fieldset>
									<legend>Reference Ranges</legend>
									<table>
										<tbody>
											<tr>
												<td> <label>Sodium:</label><input style="width: 180px" type="weight" name="sodium" placeholder="" class="form-control"></td>
												<td> <label>Potasium:</label><input style="width: 180px" type="weight" name="potasium" placeholder="" class="form-control"></td>
												<td> <label>Chloride:</label><input style="width: 180px" type="weight" name="chloride" placeholder="" class="form-control"></td>
												<td> <label>Bicarbonate:</label><input style="width: 180px" type="weight" name="bicarbonateu" placeholder="" class="form-control"></td>
											</tr>
											
											<tr>
												<td> <label>Urea:</label><input style="width: 180px" type="weight" name="urea" placeholder="" class="form-control"></td>
												<td> <label>Creatinine:</label><input style="width: 180px" type="weight" name="creatinine" placeholder="" class="form-control"></td>
												<td> <label>Uric Acid:</label><input style="width: 180px" type="weight" name="uric_acid" placeholder="" class="form-control"></td>
												<td> <label>Calcium:</label><input style="width: 180px" type="weight" name="calcium" placeholder="" class="form-control"></td>
											</tr>
											
											<tr>
												<td> <label>Phosphorous:</label><input style="width: 180px" type="weight" name="phosphorous" placeholder="" class="form-control"></td>
												<td> <label>Total Protein:</label><input style="width: 180px" type="weight" name="total_protein" placeholder="" class="form-control"></td>
												<td> <label>Albumin:</label><input style="width: 180px" type="weight" name="albumin" placeholder="" class="form-control"></td>
												
												<button type="button" class="btn btn-default">Default</button>
											</tr>
											
										</tbody>
									</table>
								</fieldset>
								<div style="margin-bottom: 20px;"></div>
								<fieldset>
									<legend>Lipid Profile</legend>
									<table>
										<tbody>
											
											<tr>
												<td> <label>Cholesterol:</label><input style="width: 180px" type="weight" name="cholesterol" placeholder="" class="form-control"></td>
												<td> <label>Triglyceride:</label><input style="width: 180px" type="weight" name="triglyceride" placeholder="" class="form-control"></td>
												<td> <label>HDL:</label><input style="width: 180px" type="weight" name="hdl" placeholder="" class="form-control"></td>
												<td> <label>LDL:</label><input style="width: 180px" type="weight" name="ldl" placeholder="" class="form-control"></td>
											</tr>
											
										</tbody>
									</table>
								</fieldset>
								<div style="margin-bottom: 20px;"></div>
								<fieldset>
									<legend>Enzymes</legend>
									<table>
										<tbody>
											<tr>
												<td> <label>SGOT:</label><input style="width: 180px" type="weight" name="sdot" placeholder="" class="form-control"></td>
												<td> <label>SGPT:</label><input style="width: 180px" type="weight" name="sgpt" placeholder="" class="form-control"></td>
												<td> <label>Alk. Phos:</label><input style="width: 180px" type="weight" name="alk_phos" placeholder="" class="form-control"></td>
												<td> <label>Amylase:</label><input style="width: 180px" type="weight" name="amylase" placeholder="" class="form-control"></td>
											</tr>
											
											<tr>
												<td> <label>Acid Phos (Total):</label><input style="width: 180px" type="weight" name="acid_phos_total" placeholder="" class="form-control"></td>
												<td> <label>Acid Phos (Prostrate):</label><input style="width: 180px" type="weight" name="acid_phos_prostate" placeholder="" class="form-control"></td>
												<td> <label>PSA:</label><input style="width: 180px" type="weight" name="psa" placeholder="" class="form-control"></td>
												
											</tr>
											
										</tbody>
									</table>
								</fieldset>
								<div style="margin-bottom: 20px;"></div>
								<fieldset>
									<legend>Glucose</legend>
									<table>
										<tbody>
											
											<tr>
												<td> <label>Fasting:</label><input style="width: 180px" type="weight" name="fasting" placeholder="" class="form-control"></td>
												<td> <label>Random:</label><input style="width: 180px" type="weight" name="random" placeholder="" class="form-control"></td>
												<td> <label>2HPP:</label><input style="width: 180px" type="weight" name="2hpp" placeholder="" class="form-control"></td>
												<td> <label>GTT:</label><input style="width: 180px" type="weight" name="gtt" placeholder="" class="form-control"></td>
											</tr>
											
										</tbody>
									</table>
								</fieldset>
								<div style="margin-bottom: 20px;"></div>
								<fieldset>
									<legend>Bilirubin</legend>
									<table>
										<tbody>
											<tr>
												<td> <label>Total:</label><input style="width: 180px" type="weight" name="total" placeholder="" class="form-control"></td>
												<td> <label>Direct:</label><input style="width: 180px" type="weight" name="direct" placeholder="" class="form-control"></td>
												<td> <label>Indirect:</label><input style="width: 180px" type="weight" name="indirect" placeholder="" class="form-control"></td>
																					
											</tr>
											
											<tr>
												<td> <label>Pregnancy Test:</label><input style="width: 180px" type="weight" name="pregnancy_test" placeholder="" class="form-control"></td>
												<td> <label>Stool Occult Blood:</label><input style="width: 180px" type="weight" name="stool_occult_blood" placeholder="" class="form-control"></td>
																					
											</tr>
										</tbody>
									</table>
								</fieldset>
								<div style="margin-bottom: 20px;"></div>
								<fieldset>
									<legend>Urinalysis</legend>
									<table>
										<tbody>
											<tr>
												<td> <label>Appearance:</label><input style="width: 180px" type="weight" name="appearance" placeholder="" class="form-control"></td>
												<td> <label>PH:</label><input style="width: 180px" type="weight" name="ph" placeholder="" class="form-control"></td>
												<td> <label>Urobilinogen:</label><input style="width: 180px" type="weight" name="urobilinogen" placeholder="" class="form-control"></td>
												<td> <label>Colour:</label><input style="width: 180px" type="weight" name="colour" placeholder="" class="form-control"></td>
											</tr>
											
											<tr>
												<td> <label>Protein:</label><input style="width: 180px" type="weight" name="protein" placeholder="" class="form-control"></td>
												<td> <label>Nitrite:</label><input style="width: 180px" type="weight" name="nitrite" placeholder="" class="form-control"></td>
												<td> <label>Glucose:</label><input style="width: 180px" type="weight" name="glucose" placeholder="" class="form-control"></td>
												<td> <label>Ascorbic Acid:</label><input style="width: 180px" type="weight" name="ascorbic_acid" placeholder="" class="form-control"></td>
											</tr>
											
											<tr>
												<td> <label>Ketones:</label><input style="width: 180px" type="weight" name="ketones" placeholder="" class="form-control"></td>
												<td> <label>SG:</label><input style="width: 180px" type="weight" name="sg" placeholder="" class="form-control"></td>
												<td> <label>Bilbriun:</label><input style="width: 180px" type="weight" name="bilriun" placeholder="" class="form-control"></td>
												<td> <label>Others:</label><input style="width: 180px" type="weight" name="others" placeholder="" class="form-control"></td>
												
											</tr>
											
										</tbody>
									</table>
								</fieldset>
								<div style="margin-bottom: 20px;"></div>
								<div style="margin-bottom: 20px;"></div>
								<?php
									//calling patient medical info from task_parts folder
									
									
								?>
								</div>
						  <div class="tab-pane cont" id="heamatology">
								<h2>Heamatology/Serology</h2>
								<div style="margin-bottom: 20px;"></div>
								<fieldset>
									<legend>*********</legend>
									<table>
										<tbody>
											<tr>
												<td> <label>Hb:</label><input style="width: 180px" type="weight" name="hb" placeholder="" class="form-control"></td>
												<td> <label>Pcv:</label><input style="width: 180px" type="weight" name="pcv" placeholder="" class="form-control"></td>
												<td> <label>WBC:</label><input style="width: 180px" type="weight" name="wbc" placeholder="" class="form-control"></td>
												<td> <label>MCHC:</label><input style="width: 180px" type="weight" name="mchc" placeholder="" class="form-control"></td>
												
											</tr>
											
											<tr>
												<td> <label>ESR:</label><input style="width: 180px" type="weight" name="esr" placeholder="" class="form-control"></td>
												<td> <label>Relics:</label><input style="width: 180px" type="weight" name="relics" placeholder="" class="form-control"></td>
												<td> <label>Malaria:</label><input style="width: 180px" type="weight" name="malaria" placeholder="" class="form-control"></td>
												
											</tr>
											
											<tr>
												<td> <label>DIFF N:</label><input style="width: 110px" type="weight" name="diff_n" placeholder="" class="form-control"></td>
												<td> <label>DIFF L:</label><input style="width: 110px" type="weight" name="diff_l" placeholder="" class="form-control"></td>
												<td> <label>DIFF M:</label><input style="width: 110px" type="weight" name="diff_m" placeholder="" class="form-control"></td>
												<td> <label>DIFF E:</label><input style="width: 110px" type="weight" name="diff_e" placeholder="" class="form-control"></td>
												<td> <label>DIFF B:</label><input style="width: 110px" type="weight" name="diff_b" placeholder="" class="form-control"></td>
											</tr>
											<tr>
												<td> <label>Blood Film Comment:</label><input style="width: 220px" type="weight" name="blood_film_comment" placeholder="" class="form-control"></td>
												<td> <label>Sicklin Test:</label><input style="width: 220px" type="weight" name="sicklin_test" placeholder="" class="form-control"></td>
												
												
											</tr>
											<tr>
												<td> <label>Platelets Count:</label><input style="width: 220px" type="weight" name="platelets_count" placeholder="" class="form-control"></td>
												<td> <label>Bleeding Time:</label><input style="width: 220px" type="weight" name="bleeding_time" placeholder="" class="form-control"></td>
												<td> <label>Clotting Time:</label><input style="width: 220px" type="weight" name="clotting_time" placeholder="" class="form-control"></td>
											</tr>
											<tr>
												<td> <label>Blood Group:</label><input style="width: 220px" type="weight" name="sodium" placeholder="" class="form-control"></td>
												<td> <label>Genotype:</label><input style="width: 220px" type="weight" name="sodium" placeholder="" class="form-control"></td>
												<td> <label>Mantoux:</label><input style="width: 220px" type="weight" name="sodium" placeholder="" class="form-control"></td>
												
											</tr>
											<tr>
												<td> <label>VDRL:</label><input style="width: 220px" type="weight" name="sodium" placeholder="" class="form-control"></td>
												<td> <label>HBSAg (Hepatitis):</label><input style="width: 220px" type="weight" name="sodium" placeholder="" class="form-control"></td>
												<td> <label>HBeAg:</label><input style="width: 220px" type="weight" name="sodium" placeholder="" class="form-control"></td>
												
											</tr>
											<tr>
												<td> <label>Coombs Test (Direct):</label><input style="width: 220px" type="weight" name="sodium" placeholder="" class="form-control"></td>
												<td> <label>Coombs Test (Indirect):</label><input style="width: 220px" type="weight" name="sodium" placeholder="" class="form-control"></td>
												
											</tr>
											
										</tbody>
									</table>
								</fieldset>
								<div style="margin-bottom: 20px;"></div>
								<?php
									//calling patient medical info from task_parts folder
									
									
									?>
								</div>
						  <div class="tab-pane cont" id="widal">
								<h2>Widal Test</h2>
								<div style="margin-bottom: 20px;"></div>
								<fieldset>
									<legend>*********</legend>
									<table>
										<tbody>
											<tr>
												<td> <label>Sodium:</label><input style="width: 220px" type="weight" name="sodium" placeholder="" class="form-control"></td>
												<td> <label>Sodium:</label><input style="width: 220px" type="weight" name="sodium" placeholder="" class="form-control"></td>
												
											</tr>
											
											<tr>
												<td> <label>Sodium:</label><input style="width: 220px" type="weight" name="sodium" placeholder="" class="form-control"></td>
												<td> <label>Sodium:</label><input style="width: 220px" type="weight" name="sodium" placeholder="" class="form-control"></td>
												
											</tr>
											
											<tr>
												<td> <label>Sodium:</label><input style="width: 220px" type="weight" name="sodium" placeholder="" class="form-control"></td>
												<td> <label>Sodium:</label><input style="width: 220px" type="weight" name="sodium" placeholder="" class="form-control"></td>
												
												
											</tr>
											<tr>
												<td> <label>Sodium:</label><input style="width: 220px" type="weight" name="sodium" placeholder="" class="form-control"></td>
												<td> <label>Sodium:</label><input style="width: 220px" type="weight" name="sodium" placeholder="" class="form-control"></td>
												
												
											</tr>
											<tr>
												<td> <label>Sodium:</label><input style="width: 220px" type="weight" name="sodium" placeholder="" class="form-control"></td>
												
												
											</tr>
											
										</tbody>
									</table>
								</fieldset>
								<div style="margin-bottom: 20px;"></div>
								<?php
									//calling patient complains info from task_parts folder
									
									
									?>
								</div>
							<div class="tab-pane cont" id="parasitology">
								<h2>Parasitology</h2>
								<div style="margin-bottom: 20px;"></div>
								<fieldset>
									<legend>Stool</legend>
									<table>
										<tbody>
											<tr>
												<td> <label>Sodium:</label><input style="width: 220px" type="weight" name="sodium" placeholder="" class="form-control"></td>
												<td> <label>Sodium:</label><input style="width: 220px" type="weight" name="sodium" placeholder="" class="form-control"></td>
																				
											</tr>
											
											<tr>
												<td> <label>Sodium:</label><input style="width: 220px" type="weight" name="sodium" placeholder="" class="form-control"></td>
												<td> <label>Sodium:</label><input style="width: 220px" type="weight" name="sodium" placeholder="" class="form-control"></td>
																						
											</tr>
											
											
										</tbody>
									</table>
								</fieldset>
								<div style="margin-bottom: 20px;"></div>
								<fieldset>
									<legend>Semen Analysis</legend>
									<table>
										<tbody>
											<tr>
												<td> <label>Sodium:</label><input style="width: 220px" type="weight" name="sodium" placeholder="" class="form-control"></td>
												<td> <label>Sodium:</label><input style="width: 220px" type="weight" name="sodium" placeholder="" class="form-control"></td>
												<td> <label>Sodium:</label><input style="width: 220px" type="weight" name="sodium" placeholder="" class="form-control"></td>
											</tr>
											
											<tr>
												<td> <label>Sodium:</label><input style="width: 220px" type="weight" name="sodium" placeholder="" class="form-control"></td>
												<td> <label>Sodium:</label><input style="width: 220px" type="weight" name="sodium" placeholder="" class="form-control"></td>
												<td> <label>Sodium:</label><input style="width: 220px" type="weight" name="sodium" placeholder="" class="form-control"></td>						
											</tr>
											<tr>
												<td colspan="3">Motility Rate(%)</td>
											</tr>
											<tr>
												
												<td> <label>Sodium:</label><input style="width: 220px" type="weight" name="sodium" placeholder="" class="form-control"></td>
												<td> <label>Sodium:</label><input style="width: 220px" type="weight" name="sodium" placeholder="" class="form-control"></td>
												<td> <label>Sodium:</label><input style="width: 220px" type="weight" name="sodium" placeholder="" class="form-control"></td>
											</tr>
											<tr>
												<td> <label><u>Total Cell</u> Count (x 10/ml):</label><input style="width: 220px" type="weight" placeholder="" class="form-control"></td>
												<td> <label><u>Morphology</u> (%) Normal Cells:</label><input style="width: 220px" type="weight" placeholder="" class="form-control"></td>
												<td> <label>Sodium:</label><input style="width: 220px" type="weight" placeholder="" class="form-control"></td>
											</tr>
											<tr>
												<td colspan="3"> <label>Comments:</label><input style="width: 500px" type="weight" placeholder="" class="form-control"></td>
												
											</tr>
											
										</tbody>
									</table>
								</fieldset>
								<div style="margin-bottom: 20px;"></div>
								<fieldset>
									<legend>Urinary Deposits</legend>
									<table>
										<tbody>
											<tr>
												<td> <label>Sodium:</label><input style="width: 220px" type="weight" name="sodium" placeholder="" class="form-control"></td>
												<td> <label>Sodium:</label><input style="width: 220px" type="weight" name="sodium" placeholder="" class="form-control"></td>
												<td> <label>Sodium:</label><input style="width: 220px" type="weight" name="sodium" placeholder="" class="form-control"></td>
											</tr>
											
											<tr>
												<td> <label>Sodium:</label><input style="width: 220px" type="weight" name="sodium" placeholder="" class="form-control"></td>
												<td> <label>Sodium:</label><input style="width: 220px" type="weight" name="sodium" placeholder="" class="form-control"></td>
												<td> <label>Sodium:</label><input style="width: 220px" type="weight" name="sodium" placeholder="" class="form-control"></td>
											</tr>
											
											<tr>
												<td> <label>Sodium:</label><input style="width: 220px" type="weight" name="sodium" placeholder="" class="form-control"></td>
												<td> <label>Sodium:</label><input style="width: 220px" type="weight" name="sodium" placeholder="" class="form-control"></td>
												<td> <label>Sodium:</label><input style="width: 220px" type="weight" name="sodium" placeholder="" class="form-control"></td>
											</tr>
											
										</tbody>
									</table>
								</fieldset>
								<div style="margin-bottom: 20px;"></div>
								<fieldset>
									<legend>Culture/Sensitivity</legend>
									<table>
										<tbody>
											<tr>
												<td> <label class="col-sm-3 control-label">Report</label>	
												<div>
													<textarea class="form-control" height="60px"></textarea>
												</div></td>
											</tr>
											
										</tbody>
									</table>
								</fieldset>
								<div style="margin-bottom: 20px;"></div>
								<?php
									//calling patient investigations info from task_parts folder
									
									
									?>
							</div>
							<div class="tab-pane cont" id="scan">
								<h2>Scan/X-Ray Report</h2>
								<?php
									//calling patient investigations info from task_parts folder
									
									
									?>
							</div>
						</div>
						 
						  
		</div>
					</div>
	
	
    
	</div> 
</div>