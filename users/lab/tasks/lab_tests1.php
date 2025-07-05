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
                           // get_all_id();
                       ?>
                     </optgroup>
                     <optgroup label="NATIONAL ID">
                       <?php
                       //getting all national ID in option field labelled National ID
                           // get_all_nid();
                       ?>
                     </optgroup>
                     <optgroup label="NHIS ID">
                      <?php
                       //getting all national health insurance ID in option field labelled NHIS
                           // get_all_NHIS();
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
							<li><a href="#haematology" data-toggle="tab">Haematology</a></li>
							<li><a href="#microbiology" data-toggle="tab">Microbiology</a></li>
							<li><a href="#widal" data-toggle="tab">Widal Test</a></li>
							<li><a href="#skin" data-toggle="tab">Skin Snip / Scrapping For Fungal Ele.</a></li>
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
                                              <tr><td><b>Age</b></td><td><?php echo @$_SESSION['dob']; ?></td></tr>
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
											  <tr><td><b>Doctor's Name: </b></td><td><?php echo @$_SESSION['doctor_id']; ?></td></tr>
                                              <tr><td><b>Requested Test: </b></td><td><?php echo @$_SESSION['requested_tests']; ?></td></tr>
                                              <tr><td><b>Remarks: </b></td><td><?php echo @$_SESSION['remarks']; ?></td></tr>
                                              <tr><td><b>Date Requested: </b></td><td><?php echo @date('jS F , Y', strtotime($_SESSION['requested_date'])); ?></td></tr>
											</tbody>
										  </table>
										</div>
									</fieldset>		
									
									<div style="margin-bottom: 20px;"></div>
									</div>
									
									<div class="row">
                                    <fieldset>
                                    
                                        <legend>Upload and Submit to Doctor</legend>
                                        
                                        <div class="col-sm-6">
                                            <form role="form" id="upload_slip" action="tasks/upload_slip.php" method="post" autocomplete="off" enctype="multipart/form-data"> 
                                                <div class="form-group">
                                                  <label>Lab Results (Pink Slip)</label> <input id="pink_slip" name="pink_slip" type="file" class="file" multiple=false data-preview-file-type="any">
                                                  <img src="../../assets/images/ajax-loader.gif" id="loading-img" style="display:none;" alt="Please Wait"/>
                                                </div>
                                                
                                                <div class="progress progress-striped active">
                                                  <div class="progress-bar progress-bar-success">
                                                      <div id="progressbox">
                                                        <div id="progressbar"></div ><div id="statustxt">0%</div>
                                                      </div>
                                                  </div>
                                                  
                                                  <div id="output"></div>
                                                </div>
                                               <!-- <div class="form-group">
                                                  <label>Weight (kg)</label> <input  type="text" name="weight" placeholder="" class="form-control">
                                                </div> -->
                                                <a id="submit_results" class="btn btn-primary pull-right ">Send Result to Doctor</a>
                                                <button class="btn btn-primary pull-right test" type="submit" id="upload-btn" name="upload">Upload Slip</button>
                                                <div></div><br>
                                            </form>
                                           
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
						  <div class="tab-pane cont" id="haematology">
								<h3 class="hthin">Haematology</h3>
								<div class="row">
                    
                                    <div class="panel-group accordion" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                              <h4 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse_haematology">
                                                    <i class="fa fa-angle-right"></i> <span style="font-size: 20px;">Heamatology</span>
                                                </a>
                                              </h4>
                                            </div>
                                            <div style="height: 0px;" id="collapse_haematology" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                  <form id="haematology_form" action="tasks/haematology.php" method="post">
                                                    <table>
                                                        <tbody>
                                                            <tr>
                                                                <td> <label>Hb:</label><input style="width: 180px" id="hb" name="hb" placeholder="" class="form-control"></td>
                                                                <td> <label>Sickling:</label><input style="width: 180px" id="sickling" name="sickling" placeholder="" class="form-control"></td>   
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td> <label>PCV:</label><input style="width: 180px" id="pcv" name="pcv" placeholder="" class="form-control"></td>
                                                                <td> <label>Retics:</label><input style="width: 180px" id="retics" name="retics" placeholder="" class="form-control"></td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td> <label>T(WBC) count:</label><input style="width: 180px" id="t_wbc_count" name="t_wbc_count" placeholder="" class="form-control"></td>
                                                                <td> <label>Hb Electrophoresis:</label><input style="width: 180px" id="hb_electrophoresis"  name="hb_electrophoresis" placeholder="" class="form-control"></td>   
                                                            </tr>
                                                            <tr>
                                                                <td> <label>Neutrophils:</label><input style="width: 180px" id="neutrophils" name="neutrophils" placeholder="" class="form-control"></td>
                                                                <td> <label>ESR</label><input style="width: 180px" id="esr" name="esr" placeholder="" class="form-control"></td>      
                                                            </tr>
                                                             <tr>
                                                                <td> <label>Lymphocytes:</label><input style="width: 180px" id="lymphocytes" name="lymphocytes" placeholder="" class="form-control"></td>
                                                                <td> <label>G6PD:</label><input style="width: 180px" id="g6pd" name="g6pd" placeholder="" class="form-control"></td>         
                                                            </tr>
                                                            <tr>
                                                                <td> <label>Monocytes:</label><input style="width: 180px" id="monocytes" name="monocytes" placeholder="" class="form-control"></td>
                                                                <td> <!-- <label>Blood Group:</label><input style="width: 180px"  name="blood_group" placeholder="" class="form-control"> -->        
                                                                <label>Blood Group:</label></br>
                                                                
                                                                  <select id="blood_group" name="blood_group" style="width: 180px" class="form-control">
                                                                    <option value=""> -- Blood Group -- </option>
                                                                    
																	<option value="A+">A+</option>
                                                                    <option value="A-">A-</option>
                                                                    <option value="B+">B+</option>
                                                                    <option value="B-">B-</option>
																	<option value="O+">O+</option>
                                                                    <option value="O-">O-</option>
                                                                    <option value="AB">AB</option>
                                                                  </select>                                 
                                                                
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td> <label>Eosinophils:</label><input style="width: 180px" id="eosinophils" name="eosinophils" placeholder="" class="form-control"></td>
                                                                <td> <label>FBS:</label><input style="width: 180px" id="fbs"  name="fbs" placeholder="" class="form-control"></td>         
                                                            </tr>
                                                            <tr>
                                                                <td> <label>Basophils:</label><input style="width: 180px" id="basophils" name="basophils" placeholder="" class="form-control"></td>   
                                                                <td> <label>RBS:</label><input style="width: 180px" id="rbs" name="rbs" placeholder="" class="form-control"></td>       
                                                            </tr>
                                                            
                                                        </tbody>
                                                    </table>
                                                    <div style="margin: 10px;" class="pull-right"><button class="btn btn-primary add_haematology" name="_haematology">Add Results</button></div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                     
                                    </div>	<!-- Heamatology ends -->						
                                    
                                        
                                </div><!-- row ends -->
								
								
								</div>
								
								<div class="tab-pane cont" id="microbiology">
                                <h3 class="hthin">Microbiology</h3>
                                <div class="row">
                    
                                    <div class="panel-group accordion" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                              <h4 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse_urine">
                                                    <i class="fa fa-angle-right"></i> <span style="font-size: 20px;">Urine R/E</span>
                                                </a>
                                              </h4>
                                            </div>
                                            <div style="height: 0px;" id="collapse_urine" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                  <form id="urine_re" action="tasks/urine_re.php" method="post"> 
                                                    <table>
                                                        <tbody>
                                                            <tr>
                                                                <td> <label>Appearance:</label><input style="width: 180px" id="appearance"  name="appearance" placeholder="" class="form-control"></td>
                                                                <td> <label>Ketones:</label><input style="width: 180px" id="ketones"  name="ketones" placeholder="" class="form-control"></td>  
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td> <label>Colour:</label><input style="width: 180px" id="colour"  name="colour" placeholder="" class="form-control"></td>
                                                                <td> <label>Blood:</label><input style="width: 180px" id="blood" name="blood" placeholder="" class="form-control"></td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td> <label>Specific Gravity:</label><input style="width: 180px" id="specific_gravity" name="specific_gravity" placeholder="" class="form-control"></td>
                                                                <td> <label>Nitrite:</label><input style="width: 180px" id="nitrite" name="nitrite" placeholder="" class="form-control"></td>   
                                                            </tr>
                                                             <tr>
                                                                <td> <label>pH:</label><input style="width: 180px" id="ph" name="ph" placeholder="" class="form-control"></td>
                                                                <td> <label>Bilirubin:</label><input style="width: 180px" id="bilirubin" name="bilirubin" placeholder="" class="form-control"></td>      
                                                            </tr>
                                                             <tr>
                                                                <td> <label>Protein:</label><input style="width: 180px" id="protein" name="protein" placeholder="" class="form-control"></td>
                                                                <td> <label>Urobilinogen:</label><input style="width: 180px" id="urobilinogen"  name="urobilinogen" placeholder="" class="form-control"></td>         
                                                            </tr>
                                                             <tr>
                                                                <td> <label>Glucose:</label><input style="width: 180px" id="glucose" name="glucose" placeholder="" class="form-control"></td>         
                                                            </tr>
                                                            
                                                        </tbody>
                                                    </table>
                                                    <div style="margin: 10px;" class="pull-right"><button class="btn btn-primary add_urine_re" name="urine">Add Results</button></div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                     
                                    </div>  <!-- Urine R/E ends -->                      
                                    
                                    
                                    <div class="panel-group accordion" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                              <h4 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse_stool">
                                                    <i class="fa fa-angle-right"></i> <span style="font-size: 20px;">Stool R/E</span>
                                                </a>
                                              </h4>
                                            </div>
                                            <div style="height: 0px;" id="collapse_stool" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                   <form id="stool_re" action="tasks/stool_re.php" method="post"> 
                                                   <table>
                                                        <tbody>
                                                            
                                                            <tr>
                                                                <td> <label>Macroscopy:</label><input style="width: 180px" id="macroscopy" name="macroscopy" placeholder="" class="form-control"></td>  
                                                            </tr>
                                                             <tr>
                                                                <td> <label>Microscopy:</label><input style="width: 180px" id="microscopy" name="microscopy" placeholder="" class="form-control"></td>
                                                            </tr>
                                                            
                                                        </tbody>
                                                    </table>
                                                    <div style="margin: 10px;" class="pull-right"><button class="btn btn-primary add_stool_re" name="stool">Add Results</button></div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                     
                                    </div>  <!-- Stool R/E ends -->                  
                                        
                                
                                    <div class="panel-group accordion" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                              <h4 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse_hvs">
                                                    <i class="fa fa-angle-right"></i> <span style="font-size: 20px;">HVS(Wet Prep)</span>
                                                </a>
                                              </h4>
                                            </div>
                                            <div style="height: 0px;" id="collapse_hvs" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                  <form id="hvs_wet_prep" action="tasks/hvs_wet_prep.php" method="post"> 
                                                   <table>
                                                        <tbody>
                                                            <tr>
                                                                <td> <label>Pus Cells:</label><input style="width: 180px" id="hvs_pus_cells"  name="hvs_pus_cells" placeholder="" class="form-control"></td>
                                                                <td> <label>EC:</label><input style="width: 180px" id="hvs_ec"  name="hvs_ec" placeholder="" class="form-control"></td>
                                                                
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td> <label>RBC:</label><input style="width: 180px" id="hvs_rbc" name="hvs_rbc" placeholder="" class="form-control"></td>
                                                                <td> <label>Organism(s) (1):</label><input style="width: 180px" id="hvs_organism_one" name="hvs_organism_one" placeholder="" class="form-control"></td>
                                                                <td> <label>Organism(s) (2):</label><input style="width: 180px" id="hvs_organism_two" name="hvs_organism_two" placeholder="" class="form-control"></td> 
                                                            </tr>
                                                            
                                                        </tbody>
                                                    </table>
                                                    <div style="margin: 10px;" class="pull-right"><button class="btn btn-primary add_hvs_wetprep" name="hvs_wetprep">Add Results</button></div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                     
                                    </div>  <!-- HVS(Wet Prep) ends -->    
                                    
                                    <div class="panel-group accordion" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                              <h4 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse_gs">
                                                    <i class="fa fa-angle-right"></i> <span style="font-size: 20px;">Gram Stain</span>
                                                </a>
                                              </h4>
                                            </div>
                                            <div style="height: 0px;" id="collapse_gs" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                   <form id="gram_stain" action="tasks/gram_stain.php" method="post"> 
                                                   <table>
                                                        <tbody>
                                                            <tr>
                                                                <td> <label>Pus Cells:</label><input style="width: 180px" id="gs_pus_cells"  name="gs_pus_cells" placeholder="" class="form-control"></td>
                                                                <td> <label>EC:</label><input style="width: 180px" id="gs_ec"  name="gs_ec" placeholder="" class="form-control"></td>
                                                                
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td> <label>RBC:</label><input style="width: 180px" id="gs_rbc" name="gs_rbc" placeholder="" class="form-control"></td>
                                                                <td> <label>Organism(s) (1):</label><input style="width: 180px" id="gs_organism_one"  name="gs_organism_one" placeholder="" class="form-control"></td>
                                                                <td> <label>Organism(s) (2):</label><input style="width: 180px" id="gs_organism_two" name="gs_organism_two" placeholder="" class="form-control"></td> 
                                                            </tr>
                                                            
                                                        </tbody>
                                                    </table>
                                                    <div style="margin: 10px;" class="pull-right"><button class="btn btn-primary add_gram_stain" name="gramstain">Add Results</button></div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                     
                                    </div>  <!-- Glucose ends -->     
                                    
                                    <div class="panel-group accordion" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                              <h4 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse_gm">
                                                    <i class="fa fa-angle-right"></i> <span style="font-size: 20px;">Gerenal  Microbiology Tests</span>
                                                </a>
                                              </h4>
                                            </div>
                                            <div style="height: 0px;" id="collapse_gm" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <form id="gm" action="tasks/general_microbiology.php" method="post"> 
                                                    <table>
                                                        <tbody>
                                                            <tr>
                                                                <td> <label>Pus Cells:</label><input style="width: 180px" id="pus_cells" name="pus_cells" placeholder="" class="form-control"></td>
                                                                <td> <label>RBC's:</label><input style="width: 180px" id="rbcs" name="rbcs" placeholder="" class="form-control"></td>                                                                      
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td> <label>Epith Cells:</label><input style="width: 180px" id="epith_cells" name="epith_cells" placeholder="" class="form-control"></td>
                                                                <td> <label>T. Vaginalis:</label><input style="width: 180px" id="t_vaginalis" name="t_vaginalis" placeholder="" class="form-control"></td>                                     
                                                            </tr>
                                                            <tr>
                                                                <td> <label>Bacteriodes:</label><input style="width: 180px" id="bacteriodes" name="bacteriodes" placeholder="" class="form-control"></td>
                                                                <td> <label>Yeast Cells:</label><input style="width: 180px" id="yeast_cells"  name="yeast_cells" placeholder="" class="form-control"></td>                                     
                                                            </tr>
                                                            <tr>
                                                                <td> <label>S.H/masoni:</label><input style="width: 180px" id="s_h_masoni"  name="s_h_masoni" placeholder="" class="form-control"></td>
                                                                <td> <label>Crystals:</label><input style="width: 180px" id="crystals" name="crystals" placeholder="" class="form-control"></td>                                     
                                                            </tr>
                                                            <tr>
                                                                <td> <label>Casts:</label><input style="width: 180px" id="casts" name="casts" placeholder="" class="form-control"></td>
                                                                <td> <label>Blood Filming:</label><input style="width: 180px" id="blood_filming" name="blood_filming" placeholder="" class="form-control"></td>                                     
                                                            </tr>
                                                            <tr>
                                                                <td> </td>
                                                                <td> </td>                                     
                                                            </tr>
                                                            <tr>
                                                                <td> <label>HBsAg:</label><input style="width: 180px" id="hbsag" name="hbsag" placeholder="" class="form-control"></td>
                                                                <td> <label>VDRL/KAHN:</label><input style="width: 180px" id="vdrl_kahn" name="vdrl_kahn" placeholder="" class="form-control"></td>                                     
                                                            </tr>
                                                            <tr>
                                                                <td> <label>Urine Preg Test:</label><input style="width: 180px" id="urine_preg_test" name="urine_preg_test" placeholder="" class="form-control"></td>                                             
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <div style="margin: 10px;" class="pull-right"><button class="btn btn-primary add_general_biology" name="_gm">Add Results</button></div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                     
                                    </div>  <!-- Genenal  Microbiology Tests ends -->    
                                   
                                        
                                </div><!-- row ends -->
                                
                                
                                </div>
						  
						  <div class="tab-pane cont" id="widal">
								<h3>Widal Test</h3>
								<div style="margin-bottom: 20px;"></div>
								<fieldset>
									<legend>*********</legend>
									<form id="widal_test" action="tasks/widal_test.php" method="post"> 
									<table>
										<tbody>
										    <tr>
                                                <td> <label>S typhi 'O':</label><input style="width: 220px" id="s_typhi_o" name="s_typhi_o" placeholder="" class="form-control"></td>                                
                                            </tr>  
											<tr>
												<td> <label>S typhi 'H':</label><input style="width: 220px" id="s_typhi_h" name="s_typhi_h" placeholder="" class="form-control"></td>								
											</tr>
											<td> <label class="col-sm-3 control-label">Comment:</label>    
                                                <div>
                                                    <textarea id="comment" name="comment" class="form-control" height="60px"></textarea>
                                                </div>
                                            </td>
										</tbody>
									</table>
									<div style="margin: 10px;" class="pull-right"><button class="btn btn-primary add_widal_test" name="widaltest">Add Results</button></div>
                                    </form>
								</fieldset>
								<div style="margin-bottom: 20px;"></div>
								<?php
									//calling patient complains info from task_parts folder
									
									
									?>
								</div>
							<div class="tab-pane cont" id="skin">
								<h3>Skin Snip / Scrapping For Fungal Ele.</h3>
								<div style="margin-bottom: 20px;"></div>
								<fieldset>
									<form id="skin_snip" action="tasks/skin_snip.php" method="post"> 
									<table>
										<tbody>
											<td> <label class="col-sm-3 control-label">Skin Snip / Scrapping For Fungal Ele.:</label>    
                                                <div>
                                                    <textarea id="remarks" name="remarks" class="form-control" height="60px"></textarea>
                                                </div>
                                            </td>
											
										</tbody>
									</table>
									<div style="margin: 10px;" class="pull-right"><button class="btn btn-primary add_skin_snip" name="skinsnip">Add Results</button></div>
                                    </form>
								</fieldset>
								<div style="margin-bottom: 20px;"></div>
								
							</div>
							
						</div>
						 
						  
	              </div>
					</div>
	
	</div> 
</div>